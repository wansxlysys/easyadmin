{extend name="common@layout/layout" /}

{block name="css"}
<style>
    body,
    html {
        height: 100%;
    }

    .one-user-login {
        position: relative;
        left: 0;
        top: 0;
        padding: 110px 0;
        height: 100%;
        min-height: 100%;
        box-sizing: border-box;
        background: url("{:static_url('/admin/img/login.jpg')}") no-repeat center;
        background-size: cover;
    }

    .one-user-login-main {
        width: 380px;
        position: absolute;
        left: 50%;
        top: 50%;
        margin-left: -190px;
        margin-top: -190px;
        background: rgba(255, 255, 255, 1);
        -webkit-border-radius: 2px;
        -moz-border-radius: 2px;
        border-radius: 2px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.3)
    }

    .one-user-login-box {
        padding: 20px
    }

    .one-user-login-header {
        text-align: center
    }

    .one-user-login-header h2 {
        margin-top: 20px;
        margin-bottom: 10px;
        font-weight: 300;
        font-size: 30px;
        color: #000
    }

    .one-user-login-header p {
        font-weight: 300;
        color: #666
    }

    .one-user-login-body .layui-form-item {
        position: relative
    }

    .one-user-login-icon {
        position: absolute;
        left: 1px;
        top: 1px;
        width: 38px;
        line-height: 36px;
        text-align: center;
        color: #666
    }

    .one-user-login-body .layui-form-item .layui-input {
        padding-left: 38px
    }

    .one-user-login-codeimg {
        max-height: 38px;
        width: 100%;
        cursor: pointer;
        box-sizing: border-box
    }

    .one-user-login-footer span {
        padding: 0 5px
    }

    .one-user-login-footer a {
        padding: 0 5px;
        color: rgba(0, 0, 0, .5)
    }

    .one-user-login-footer a:hover {
        color: rgba(0, 0, 0, 1)
    }

    .one-user-login-main[bgimg] {
        background-color: #fff;
        box-shadow: 0 0 5px rgba(0, 0, 0, .05)
    }

    .one-user-login-captcha {
        margin-left: 10px;
    }
</style>
{/block}

{block name="content"}
<div class="one-user-login">
    <div class="one-user-login-main">
        <div class="one-user-login-box one-user-login-header">
            <h2>{$systemSetting.systemName}</h2>
            <p>{$systemSetting.systemSlogan}</p>
        </div>
        <div class="one-user-login-box one-user-login-body layui-form">
            <form class="layui-form" autocomplete="off">
                <div class="layui-form-item">
                    <label class="one-user-login-icon layui-icon layui-icon-username" for="account"></label>
                    <input type="text" name="account" id="account" lay-verify="required" placeholder="账号" class="layui-input">
                </div>
                <div class="layui-form-item">
                    <label class="one-user-login-icon layui-icon layui-icon-password" for="password"></label>
                    <input type="password" name="password" id="password" lay-verify="required" placeholder="密码" class="layui-input">
                </div>
                <div class="layui-form-item">
                    <div class="layui-row">
                        <div class="layui-col-xs7">
                            <label class="one-user-login-icon layui-icon layui-icon-vercode" for="captcha"></label>
                            <input type="text" name="captcha" id="captcha" lay-verify="required" placeholder="验证码" class="layui-input">
                        </div>
                        <div class="layui-col-xs5">
                            <div class="one-user-login-captcha">
                                <img src="{:url('admin/SystemLogin/captcha')}" class="one-user-login-codeimg" id="captchaImg">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <button class="layui-btn layui-btn-default layui-btn-fluid" lay-submit>登 录
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
{/block}

{block name="js"}
<script>
    layui.use(['oneModule'], function () {

        const form = layui.form;
        const oneAdmin = layui.oneAdmin;

        const captchaImg = jQuery("#captchaImg");

        form.on('submit', function (obj) {
            event.preventDefault();
            oneAdmin.ajaxPost({
                url: "{:url('admin/SystemLogin/login')}",
                data: obj.field,
                success: function (result) {
                    window.location.href = result.url;
                },
                error: function () {
                    refreshVerify();
                }
            });
        });

        captchaImg.click(function () {
            refreshVerify();
        });

        function refreshVerify() {
            captchaImg.attr("src", "{:url('admin/SystemLogin/captcha')}?time=" + new Date().getTime());
        }
    });
</script>
{/block}