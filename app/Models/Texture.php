<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Texture extends Model
{
    public $primaryKey = 'tid';
    public $timestamps = false;

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'tid' => 'integer',
        'likes' => 'integer',
        'size' => 'integer',
        'uploader' => 'integer',
        'public' => 'integer',
    ];

    public function setPrivacy($public)
    {
        $this->public = $public ? "1" : "0";
        return $this->save();
    }

    public function scopeLike($query, $field, $value)
    {
        return $query->where($field, 'LIKE', "%$value%");
    }
}
