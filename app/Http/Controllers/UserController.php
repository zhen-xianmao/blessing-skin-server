<?php

namespace App\Http\Controllers;

use App;
use Mail;
use View;
use Schema;
use Session;
use App\Models\User;
use App\Models\Texture;
use Illuminate\Http\Request;
use App\Events\UserProfileUpdated;
use App\Exceptions\PrettyPageException;
use App\Services\Repositories\UserRepository;

class UserController extends Controller
{
    /**
     * Current user instance.
     *
     * @var App\Models\User
     */
    private $user = null;

    public function __construct(UserRepository $users)
    {
        $this->user = $users->get(session('uid'));

        // Do nothing if new columns are not ready
        if (Schema::hasColumn('users', 'verified') && option('require_verification')) {
            // Send email verification link to newly registered users
            $this->user->verification_token || $this->sendVerificationEmail();
        }
    }

    public function index()
    {
        return view('user.index')->with([
            'user' => $this->user,
            'statistics' => [
                'players' => $this->calculatePercentageUsed($this->user->players->count(), option('score_per_player')),
                'storage' => $this->calculatePercentageUsed($this->user->getStorageUsed(), option('score_per_storage'))
            ]
        ]);
    }

    /**
     * Calculate percentage of resources used by user.
     *
     * @param  int $used
     * @param  int $rate
     * @return array
     */
    protected function calculatePercentageUsed($used, $rate)
    {
        // Initialize default value to avoid division by zero.
        $result['used']       = $used;
        $result['total']      = 'UNLIMITED';
        $result['percentage'] = 0;

        if ($rate != 0) {
            $result['total'] = $used + floor($this->user->getScore() / $rate);
            $result['percentage'] = $result['total'] ? $used / $result['total'] * 100 : 100;
        }

        return $result;
    }

    /**
     * Handle user signing.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function sign()
    {
        if ($this->user->canSign()) {
            $acquiredScore = $this->user->sign();

            return json([
                'errno'          => 0,
                'msg'            => trans('user.sign-success', ['score' => $acquiredScore]),
                'score'          => $this->user->getScore(),
                'storage'        => $this->calculatePercentageUsed($this->user->getStorageUsed(), option('score_per_storage')),
                'remaining_time' => $this->getUserSignRemainingTimeWithPrecision()
            ]);
        } else {
            $remaining_time = $this->getUserSignRemainingTimeWithPrecision();
            return json(trans('user.cant-sign-until', [
                'time' => $remaining_time >= 1
                    ? $remaining_time : round($remaining_time * 60),
                'unit' => $remaining_time >= 1
                    ? trans('user.time-unit-hour') : trans('user.time-unit-min')
            ]), 1);
        }
    }

    public function getUserSignRemainingTimeWithPrecision()
    {
        $hours = $this->user->getSignRemainingTime() / 3600;

        return $hours > 1 ? round($hours) : $hours;
    }

    public function sendVerificationEmail()
    {
        if (!option('require_verification') || !Schema::hasColumn('users', 'verified')) {
            return json(trans('user.verification.disabled'), 1);
        }

        // Rate limit of 60s
        $remain = 60 + session('last_mail_time', 0) - time();

        if ($remain > 0) {
            return json(trans('user.verification.frequent-mail'), 1);
        }

        if ($this->user->verified) {
            return json(trans('user.verification.verified'), 1);
        }

        $token = generate_random_token();
        $this->user->verification_token = $token;
        $this->user->save();

        $email = $this->user->email;
        $url = option('site_url')."/auth/verify?uid={$this->user->uid}&token=$token";

        try {
            Mail::send('mails.email-verification', compact('url'), function ($m) use ($email) {
                $site_name = option_localized('site_name');

                $m->from(config('mail.username'), $site_name);
                $m->to($email)->subject(trans('user.verification.mail.title', ['sitename' => $site_name]));
            });
        } catch (\Exception $e) {
            // Write the exception to log
            report($e);

            return json(trans('user.verification.failed', ['msg' => $e->getMessage()]), 2);
        }

        Session::put('last_mail_time', time());

        return json(trans('user.verification.success'), 0);
    }

    public function profile()
    {
        return view('user.profile')->with('user', $this->user);
    }

    /**
     * Handle changing user profile.
     *
     * @param  Request $request
     * @param  UserRepository $users
     * @return mixed
     */
    public function handleProfile(Request $request, UserRepository $users)
    {
        $action = $request->input('action', '');

        switch ($action) {
            case 'nickname':
                $this->validate($request, [
                    'new_nickname' => 'required|no_special_chars|max:255'
                ]);

                $nickname = $request->input('new_nickname');

                if ($this->user->setNickName($nickname)) {
                    event(new UserProfileUpdated($action, $this->user));
                    return json(trans('user.profile.nickname.success', ['nickname' => $nickname]), 0);
                }

                break;   // @codeCoverageIgnore

            case 'password':
                $this->validate($request, [
                    'current_password' => 'required|min:6|max:32',
                    'new_password'     => 'required|min:8|max:32'
                ]);

                if (! $this->user->verifyPassword($request->input('current_password')))
                    return json(trans('user.profile.password.wrong-password'), 1);

                if ($this->user->changePasswd($request->input('new_password'))) {
                    event(new UserProfileUpdated($action, $this->user));

                    session()->flush();

                    return json(trans('user.profile.password.success'), 0)
                            ->withCookie(cookie()->forget('uid'))
                            ->withCookie(cookie()->forget('token'));
                }

                break;   // @codeCoverageIgnore

            case 'email':
                $this->validate($request, [
                    'new_email' => 'required|email',
                    'password'  => 'required|min:6|max:32'
                ]);

                if ($users->get($request->input('new_email'), 'email')) {
                    return json(trans('user.profile.email.existed'), 1);
                }

                if (! $this->user->verifyPassword($request->input('password')))
                    return json(trans('user.profile.email.wrong-password'), 1);

                if ($this->user->setEmail($request->input('new_email'))) {
                    // Set account status to unverified
                    $this->user->verified = false;
                    $this->user->verification_token = '';
                    $this->user->save();

                    event(new UserProfileUpdated($action, $this->user));

                    return json(trans('user.profile.email.success'), 0)
                            ->withCookie(cookie()->forget('uid'))
                            ->withCookie(cookie()->forget('token'));
                }

                break;   // @codeCoverageIgnore

            case 'delete':
                $this->validate($request, [
                    'password' => 'required|min:6|max:32'
                ]);

                if (! $this->user->verifyPassword($request->input('password')))
                    return json(trans('user.profile.delete.wrong-password'), 1);

                if ($this->user->delete()) {
                    session()->flush();

                    return response()
                        ->json([
                            'errno' => 0,
                            'msg' => trans('user.profile.delete.success')
                        ])
                        ->cookie('uid', '', time() - 3600, '/')
                        ->cookie('token', '', time() - 3600, '/');
                }

                break;   // @codeCoverageIgnore

            default:
                return json(trans('general.illegal-parameters'), 1);
                break;
        }
    }                    // @codeCoverageIgnore

    /**
     * Set user avatar.
     *
     * @param Request $request
     */
    public function setAvatar(Request $request)
    {
        $this->validate($request, [
            'tid' => 'required|integer'
        ]);

        $result = Texture::find($request->input('tid'));

        if ($result) {
            if ($result->type == "cape")
                return json(trans('user.profile.avatar.wrong-type'), 1);

            if ($this->user->setAvatar($request->input('tid'))) {
                return json(trans('user.profile.avatar.success'), 0);
            }
        } else {
            return json(trans('skinlib.non-existent'), 1);
        }
    }                    // @codeCoverageIgnore

}
