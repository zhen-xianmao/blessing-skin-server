/*!
 * Blessing Skin Chinese Translations
 *
 * @see https://github.com/printempw/blessing-skin-server
 * @author printempw <h@prinzeugen.net>
 *
 * NOTE: this file must be saved in UTF-8 encoding.
 */

(function ($) {
    'use strict';

    $.locales['zh_CN'] = {
        auth: {
            // Login
            emptyIdentification: '你还没有填写邮箱/角色名哦',
            emptyPassword: '密码要好好填哦',
            emptyCaptcha: '你还没有填写验证码哦',
            login: '登录',
            loggingIn: '登录中',
            tooManyFails: '你尝试的次数太多啦，请输入验证码',

            // Register
            emptyEmail: '你还没有填写邮箱哦',
            invalidEmail: '邮箱格式不正确！',
            invalidPassword: '无效的密码。密码长度应该大于 8 并小于 32。',
            emptyConfirmPwd: '确认密码不能为空',
            invalidConfirmPwd: '密码和确认的密码不一样诶？',
            emptyNickname: '你还没有填写昵称哦',
            emptyPlayerName: '你还没有填写角色名哦',
            register: '注册',
            registering: '注册中',

            // Reset Password
            send: '发送',
            sending: '发送中',
            reset: '重置',
            resetting: '重置中'
        },
        skinlib: {
            // Like
            addToCloset: '添加至衣柜',
            removeFromCloset: '从衣柜中移除',
            setItemName: '给你的皮肤起个名字吧~',
            applyNotice: '收藏后可以在我的衣柜里将皮肤应用至角色',
            emptyItemName: '你还没有填写要收藏的材质名称啊',
            anonymous: '请先登录',
            private: '私密',

            // Skinlib
            filter: {
                skin: '（任意模型）',
                steve: '（Steve）',
                alex: '（Alex）',
                cape: '（披风）',
                uploader: '用户（UID = :uid）上传',
                allUsers: '所有用户'
            },
            sort: {
                time: '最新上传',
                likes: '最多收藏'
            },

            // Preview
            badSkinSize: '所选皮肤文件的尺寸不对哦',
            badCapeSize: '所选披风文件的尺寸不对哦',

            // Rename
            setNewTextureName: '请输入新的材质名称：',
            emptyNewTextureName: '你还没有输入新名称啊',

            // Change Model
            setNewTextureModel: '请选择新的材质适用模型：',

            // Upload
            emptyTextureName: '给你的材质起个名字吧',
            emptyTextureType: '请选择材质的类型',
            emptyUploadFile: '你还没有上传任何文件哦',
            encodingError: '错误：这张图片编码不对哦',
            fileExtError: '错误：皮肤文件必须为 PNG 格式',
            upload: '确认上传',
            uploading: '上传中',
            redirecting: '正在跳转...',

            // Change Privacy
            setAsPrivate: '设为隐私',
            setAsPublic: '设为公开',
            setPublicNotice: '要将此材质设置为公开吗？',

            deleteNotice: '真的要删除此材质吗？'
        },
        user: {
            // Signing in
            signRemainingTime: ':time :unit 后可签到',
            timeUnitHour: '小时',
            timeUnitMin: '分钟',

            // Closet
            emptyClosetMsg: '<p>衣柜里啥都没有哦~</p><p>去<a href=":url">皮肤库</a>看看吧~</p>',
            renameItem: '重命名物品',
            removeItem: '从衣柜中移除',
            setAsAvatar: '设为头像',
            viewInSkinlib: '在皮肤库中查看',
            switch2dPreview: '切换 2D 预览',
            switch3dPreview: '切换 3D 预览',
            removeFromClosetNotice: '确定要从衣柜中移除此材质吗？',
            emptySelectedPlayer: '你还没有选择角色哦',
            emptySelectedTexture: '你还没有选择要应用的材质哦',
            renameClosetItem: '请输入此衣柜物品的新名称：',

            // Player
            changePlayerName: '请输入角色名：',
            emptyPlayerName: '你还没有填写名称哦',
            clearTexture: '确定要重置该用户的皮肤/披风吗？',
            deletePlayer: '真的要删除该玩家吗？',
            deletePlayerNotice: '这将是永久性的删除',
            chooseClearTexture: '选择要删除的材质类型',
            noClearChoice: '您还没选择要删除的材质类型',

            // Profile
            setAvatar: '确定要将此材质设置为用户头像吗？',
            setAvatarNotice: '将会自动截取皮肤头部',
            emptyNewNickName: '你还没有填写新昵称啊',
            changeNickName: '确定要将昵称设置为 :new_nickname 吗？',
            emptyPassword: '原密码不能为空',
            emptyNewPassword: '新密码要好好填哦',
            emptyNewEmail: '你还没有填写新邮箱啊',
            changeEmail: '确定要将用户邮箱更改为 :new_email 吗？',
            emptyDeletePassword: '请先输入当前用户密码'
        },
        admin: {
            operationsTitle: '更多操作',

            // Users
            ban: '封禁',
            unban: '解封',
            setAdmin: '设为管理员',
            unsetAdmin: '解除管理员',
            deleteUser: '删除用户',
            cannotDeleteAdmin: '你不能删除管理员账号哦',
            cannotDeleteSuperAdmin: '超级管理员账号不能被这样删除的啦',
            changeEmail: '修改邮箱',
            changeNickName: '修改昵称',
            changePassword: '更改密码',
            changeVerification: '修改邮箱验证状态',
            newUserEmail: '请输入新邮箱：',
            newUserNickname: '请输入新昵称：',
            newUserPassword: '请输入新密码：',
            deleteUserNotice: '真的要删除此用户吗？此操作不可恢复',
            scoreTip: '输入修改后的积分，回车提交',
            inspectHisOwner: '点击查看该角色的所有者',
            inspectHisPlayers: '点击查看该用户的角色',

            // Status
            banned: '封禁',
            normal: '普通用户',
            admin: '管理员',
            superAdmin: '超级管理员',

            // Verification
            unverified: '未验证',
            verified: '已验证',

            // Players
            textureType: '材质类型',
            skin: '皮肤（:model 模型）',
            cape: '披风',
            pid: '材质 ID',
            pidNotice: '输入要更换的材质的 TID，输入 0 即可清除该角色的材质',
            changePlayerTexture: '更换角色 :player 的材质',
            changeTexture: '更换材质',
            changePlayerName: '更改角色名',
            changeOwner: '更换角色拥有者',
            deletePlayer: '删除角色',
            changePlayerOwner: '请输入此角色要让渡至的用户 UID：',
            deletePlayerNotice: '真的要删除此角色吗？此操作不可恢复',
            targetUser: '目标用户：:nickname',
            noSuchUser: '没有这个用户哦~',
            changePlayerNameNotice: '请输入新的角色名：',
            emptyPlayerName: '您还没填写角色名呢',

            // Plugins
            configurePlugin: '插件配置',
            noPluginConfigNotice: '插件已被禁用或无配置页',
            deletePlugin: '删除插件',
            noDependencies: '无要求',
            whyDependencies: '为什么会这样？',
            statusEnabled: '已启用',
            statusDisabled: '已禁用',
            enablePlugin: '启用插件',
            disablePlugin: '禁用插件',
            confirmDeletion: '真的要删除这个插件吗？',
            noDependenciesNotice: '此插件没有声明任何依赖关系，这代表它有可能并不兼容此版本的 Blessing Skin，请将此插件升级至可能的最新版本。强行启用可能导致无法预料的后果。你确定要启用此插件吗？',

            // Update
            preparing: '正在准备',
            downloadCompleted: '更新包下载完成',
            extracting: '正在解压更新包'
        },
        general: {
            skin: '皮肤',
            cape: '披风',
            fatalError: '严重错误（请联系作者）',
            confirmLogout: '确定要登出吗？',
            confirm: '确定',
            cancel: '取消',
            more: '更多',
            pagination: '第 :page 页，共 :total 页',
            searchResult: '（关键词 “:keyword” 的搜索结果）',
            noResult: '无结果'
        },
        vendor: {
            fileinput: {
                fileSingle: '文件',
                filePlural: '个文件',
                browseLabel: '选择 &hellip;',
                removeLabel: '移除',
                removeTitle: '清除选中文件',
                cancelLabel: '取消',
                cancelTitle: '取消进行中的上传',
                uploadLabel: '上传',
                uploadTitle: '上传选中文件',
                msgNo: '没有',
                msgNoFilesSelected: '',
                msgCancelled: '取消',
                msgPlaceholder: '选择 {files}...',
                msgZoomModalHeading: '详细预览',
                msgFileRequired: '必须选择一个文件上传.',
                msgSizeTooSmall: '文件 "{name}" (<b>{size} KB</b>) 必须大于限定大小 <b>{minSize} KB</b>.',
                msgSizeTooLarge: '文件 "{name}" (<b>{size} KB</b>) 超过了允许大小 <b>{maxSize} KB</b>.',
                msgFilesTooLess: '你必须选择最少 <b>{n}</b> {files} 来上传. ',
                msgFilesTooMany: '选择的上传文件个数 <b>({n})</b> 超出最大文件的限制个数 <b>{m}</b>.',
                msgFileNotFound: '文件 "{name}" 未找到!',
                msgFileSecured: '安全限制，为了防止读取文件 "{name}".',
                msgFileNotReadable: '文件 "{name}" 不可读.',
                msgFilePreviewAborted: '取消 "{name}" 的预览.',
                msgFilePreviewError: '读取 "{name}" 时出现了一个错误.',
                msgInvalidFileName: '文件名 "{name}" 包含非法字符.',
                msgInvalidFileType: '不正确的类型 "{name}". 只支持 "{types}" 类型的文件.',
                msgInvalidFileExtension: '不正确的文件扩展名 "{name}". 只支持 "{extensions}" 的文件扩展名.',
                msgFileTypes: {
                    'image': 'image',
                    'html': 'HTML',
                    'text': 'text',
                    'video': 'video',
                    'audio': 'audio',
                    'flash': 'flash',
                    'pdf': 'PDF',
                    'object': 'object'
                },
                msgUploadAborted: '该文件上传被中止',
                msgUploadThreshold: '处理中...',
                msgUploadBegin: '正在初始化...',
                msgUploadEnd: '完成',
                msgUploadEmpty: '无效的文件上传.',
                msgUploadError: 'Error',
                msgValidationError: '验证错误',
                msgLoading: '加载第 {index} 文件 共 {files} &hellip;',
                msgProgress: '加载第 {index} 文件 共 {files} - {name} - {percent}% 完成.',
                msgSelected: '{n} {files} 选中',
                msgFoldersNotAllowed: '只支持拖拽文件! 跳过 {n} 拖拽的文件夹.',
                msgImageWidthSmall: '图像文件的"{name}"的宽度必须是至少{size}像素.',
                msgImageHeightSmall: '图像文件的"{name}"的高度必须至少为{size}像素.',
                msgImageWidthLarge: '图像文件"{name}"的宽度不能超过{size}像素.',
                msgImageHeightLarge: '图像文件"{name}"的高度不能超过{size}像素.',
                msgImageResizeError: '无法获取的图像尺寸调整。',
                msgImageResizeException: '调整图像大小时发生错误。<pre>{errors}</pre>',
                msgAjaxError: '{operation} 发生错误. 请重试!',
                msgAjaxProgressError: '{operation} 失败',
                ajaxOperations: {
                    deleteThumb: '删除文件',
                    uploadThumb: '上传文件',
                    uploadBatch: '批量上传',
                    uploadExtra: '表单数据上传'
                },
                dropZoneTitle: '拖拽文件到这里 &hellip;',
                dropZoneClickTitle: '<br>(或点击{files}按钮选择文件)',
                fileActionSettings: {
                    removeTitle: '删除文件',
                    uploadTitle: '上传文件',
                    uploadRetryTitle: 'Retry upload',
                    zoomTitle: '查看详情',
                    dragTitle: '移动 / 重置',
                    indicatorNewTitle: '没有上传',
                    indicatorSuccessTitle: '上传',
                    indicatorErrorTitle: '上传错误',
                    indicatorLoadingTitle: '上传 ...'
                },
                previewZoomButtonTitles: {
                    prev: '预览上一个文件',
                    next: '预览下一个文件',
                    toggleheader: '缩放',
                    fullscreen: '全屏',
                    borderless: '无边界模式',
                    close: '关闭当前预览'
                }
            },
            datatables: {
                sProcessing: '处理中...',
                sLengthMenu: '显示 _MENU_ 项结果',
                sZeroRecords: '没有匹配结果',
                sInfo: '显示第 _START_ 至 _END_ 项结果，共 _TOTAL_ 项',
                sInfoEmpty: '显示第 0 至 0 项结果，共 0 项',
                sInfoFiltered: '(由 _MAX_ 项结果过滤)',
                sInfoPostFix: '',
                sSearch: '搜索:',
                sUrl: '',
                sEmptyTable: '表中数据为空',
                sLoadingRecords: '载入中...',
                sInfoThousands: ',',
                oPaginate: {
                    sFirst: '首页',
                    sPrevious: '上页',
                    sNext: '下页',
                    sLast: '末页'
                },
                oAria: {
                    sSortAscending:  ': 以升序排列此列',
                    sSortDescending: ': 以降序排列此列'
                }
            }
        }
    };
})(window.jQuery);
