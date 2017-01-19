@extends('admin::layouts.login')
@section('page_title')后台登录@endsection
@section('header')
<style>
    /* 登录样式 */
    body{
        background-image: -webkit-gradient(radial, 587 -52, 197, 580 -115, 589, from(rgb(104, 91, 95)), to(rgb(67, 66, 102)));
        background-image: url('/images/1158269529265500905.jpg');
        -webkit-background-size: cover;
        -moz-background-size: cover;
        background-size: cover;
        /*color: #E3D3D3;*/
    }
    .login-form{
        float: none;
        padding: 4rem 4rem 2rem;
        overflow: hidden;
        background: rgba(0,0,0,.2);
        /*border-radius: 0.4em;*/
        border: 1px solid #191919;
        box-shadow: inset 0 0 2px 1px rgba(255,255,255,0.08), 0 16px 10px -8px rgba(0, 0, 0, 0.6);
        max-width: 480px;
        position: relative;
        margin: 60px auto 2rem;
    }
    @media (max-width:768px){
        .login-form{
            margin: 40px auto 2rem;
        }
    }
    .login-form::before {
        border-style: none;
        content: "";
        width: 41px;
        height: 35px;
        position: absolute;
        left: 37%;
        top: -88px;
        background-color: red;
        border-radius: 50%;
        box-shadow: 0 0 124px 179px #d8d8d8;
    }
    .login-form::after {
        content: "";
        height: 1px;
        width: 33%;
        position: absolute;
        left: 20%;
        top: 0;
        background: -moz-linear-gradient(left, transparent, #444, #b6b6b8, #444, transparent);
        background: -ms-linear-gradient(left, transparent, #444, #b6b6b8, #444, transparent);
        background: -o-linear-gradient(left, transparent, #444, #b6b6b8, #444, transparent);
        background: -webkit-gradient(linear, 0 0, 100% 0, from(transparent), color-stop(0.25, #444), color-stop(0.5, #b6b6b8), color-stop(0.75, #444), to(transparent));
        /* background: -webkit-linear-gradient(left, transparent, #444, #b6b6b8, #444, transparent); */
        background: linear-gradient(left, transparent, #444, #b6b6b8, #444, transparent);
    }
    .login-form form:nth-child(1)::before {
        content: "";
        width: 250px;
        height: 100px;
        position: absolute;
        top: 0;
        left: 45px;
        -webkit-transform: rotate(75deg);
        -moz-transform: rotate(75deg);
        -ms-transform: rotate(75deg);
        -o-transform: rotate(75deg);
        transform: rotate(75deg);
        background: -moz-linear-gradient(50deg, rgba(255,255,255,0.15), rgba(0,0,0,0));
        background: -ms-linear-gradient(50deg, rgba(255,255,255,0.15), rgba(0,0,0,0));
        background: -o-linear-gradient(50deg, rgba(255,255,255,0.15), rgba(0,0,0,0));
        background: -webkit-linear-gradient(50deg, rgba(255,255,255,0.15), rgba(0,0,0,0));
        background: linear-gradient(50deg, rgba(255,255,255,0.15), rgba(0,0,0,0));
        pointer-events: none;
    }
    .text-animate{
        text-shadow: 1px 1px 1px rgba(255,255,255,0.3);
        background: -moz-linear-gradient(left, rgba(105,94,127,0.54) 0%, rgba(255,92,92,0.57) 15%, rgba(255,160,17,0.59) 27%, rgba(252,236,93,0.61) 37%, rgba(255,229,145,0.63) 46%, rgba(111,196,173,0.65) 58%, rgba(106,132,186,0.67) 69%, rgba(209,119,195,0.69) 79%, rgba(216,213,125,0.7) 89%, rgba(216,213,125,0.72) 100%), -moz-repeating-linear-gradient(-45deg, rgba(255,255,255,0.5), transparent 20px, rgba(255,255,255,0.3) 40px);
        background: -webkit-linear-gradient(left, rgba(105,94,127,0.54) 0%,rgba(255,92,92,0.57) 15%,rgba(255,160,17,0.59) 27%,rgba(252,236,93,0.61) 37%,rgba(255,229,145,0.63) 46%,rgba(111,196,173,0.65) 58%,rgba(106,132,186,0.67) 69%,rgba(209,119,195,0.69) 79%,rgba(216,213,125,0.7) 89%,rgba(216,213,125,0.72) 100%), -webkit-repeating-linear-gradient(-45deg, rgba(255,255,255,0.5), transparent 20px, rgba(255,255,255,0.3) 40px);
        background: -ms-linear-gradient(left, rgba(105,94,127,0.54) 0%,rgba(255,92,92,0.57) 15%,rgba(255,160,17,0.59) 27%,rgba(252,236,93,0.61) 37%,rgba(255,229,145,0.63) 46%,rgba(111,196,173,0.65) 58%,rgba(106,132,186,0.67) 69%,rgba(209,119,195,0.69) 79%,rgba(216,213,125,0.7) 89%,rgba(216,213,125,0.72) 100%), -ms-repeating-linear-gradient(-45deg, rgba(255,255,255,0.5), transparent 20px, rgba(255,255,255,0.3) 40px);
        background: linear-gradient(left, rgba(105,94,127,0.54) 0%,rgba(255,92,92,0.57) 15%,rgba(255,160,17,0.59) 27%,rgba(252,236,93,0.61) 37%,rgba(255,229,145,0.63) 46%,rgba(111,196,173,0.65) 58%,rgba(106,132,186,0.67) 69%,rgba(209,119,195,0.69) 79%,rgba(216,213,125,0.7) 89%,rgba(216,213,125,0.72) 100%), repeating-linear-gradient(-45deg, rgba(255,255,255,0.5), transparent 20px, rgba(255,255,255,0.3) 40px);
        background-size: 300% 100%;
        -webkit-background-clip: text;
        -moz-background-clip: text;
        background-clip: text;
        -moz-border-radius: 90px 15px;
        animation: it-animate 20s infinite;
        -moz-animation: it-animate 20s infinite alternate;    /* Firefox */
        -webkit-animation: it-animate 20s infinite alternate;    /* Safari 和 Chrome */
        -ms-animation: it-animate 20s infinite alternate;    /* Opera */
    }
    @-webkit-keyframes it-animate{
        from {
            background-position: center right, top right;
            color: rgba(39,137,149,0.5);
            -moz-box-shadow: 0px 0px 0px 10px rgba(39,137,149, 0.9);
        }
        to {
            background-position: center left, top left;
            color: rgba(255,255,255,0.1);
            -moz-box-shadow: 0px 0px 0px 10px rgba(255,255,255,0.4);
        }
    }
    .main-content{
        margin: 0;
        padding-top: 3em;
    }
    .fa-lock:before {
        /* password input hack */
        font-size: 1.3em;
    }
    .main-container:before {
        /* body background hack */
        background-color: inherit;
    }
    .page-content{
        /* body background hack */
        background-color: inherit;
    }
    @media (min-width:768px){
        .form-horizontal .control-label{
            text-align:left;
        }
    }
    @media only screen and (max-width: 479px){
        .main-content {
            padding-top: 0;
        }
        .login-form {
            margin: 0 auto;
            margin-bottom: 2em;
            padding: 3rem;
        }
    }
    .form-control{
        border-radius: inherit;
    }
    .btn{
        border-radius: inherit;
    }
</style>
@endsection
@section('content')
    <div class="container">

        <div class="page-header">
            <h1 class="" title="这玩意持续占50%CPU，好玩吧？"><b>{{ config('app.name') }}</b> <small class="hidden-xs">管理后台权限检查</small></h1>
            您在此页面的操作将会被记录并可能触发警报，请谨慎！
        </div>
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <div class="login-container">
                    <div class="login-form">
                        <div id='loadingbar' class="waiting"><dt/><dd/></div>
                        <form class="form-horizontal" role="form" action="" method="post" id="login-form">
                            {{ csrf_field() }}
                            <input name="login_type" value="email" type="hidden">

                            <div class="form-group has-feedback">
                                <div class="col-sm-3">
                                    <label for="email-input" class="control-label">邮箱</label>
                                </div>
                                <div class="col-sm-9">
                                    <input id="email-input" name="email" type="email" class="form-control" placeholder="Email" autofocus>
                                    <i class="glyphicon glyphicon-envelope form-control-feedback"></i>
                                </div>
                            </div>
                            <div class="form-group has-feedback">
                                <div class="col-sm-3">
                                    <label for="password-input" class="control-label">密码</label>
                                </div>
                                <div class="col-sm-9">
                                    <input id="password-input" name="password" type="password" class="form-control" placeholder="Password">
                                    <i class="glyphicon glyphicon-eye-open form-control-feedback"></i>
                                </div>
                            </div>
                            <div class="form-group has-feedback">
                                <div class="col-sm-3">
                                    <label for="verify_code-input" class="control-label">验证码</label>
                                </div>
                                <div class="col-sm-5">
                                <span class="block input-icon input-icon-right">
                                    <input id="verify_code-input" name="verify_code" type="text" class="form-control" placeholder="verify code">
                                    <i class="glyphicon glyphicon-font warning form-control-feedback"></i>
                                </span>
                                </div>
                                <div class="col-sm-4">
                                    <img style="cursor: pointer;" src="{{captcha_src()}}" onclick="this.src='{{ url('captcha/default?') }}' + Math.floor(Math.random()*(100000000-10000000+1)+10000000);" width="100%" height="34" />
                                </div>
                            </div>
                            <div class="space"></div>
                            <div class="form-group">
                                <label class="col-sm-4 text-center">
                                    <input name="remember" type="checkbox" class="ace">
                                    <span class="lbl">  记住我</span>
                                </label>
                                <div class="col-sm-8 text-right">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="glyphicon glyphicon-off"></i>
                                        <b>登入</b>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </div>

@endsection

@section('footer')
    <script>
        if ((/webkit/.test(navigator.userAgent.toLowerCase()))) {
            $("h1").addClass("text-animate")
        }
        $('#login-form').validate({
            errorElement: 'div',
            errorClass: 'help-block',
            focusInvalid: false,
            rules: {
                username: {
                    required: true,
                    minlength: 4,
                    email:true
                },
                password: {
                    required: true,
                    minlength: 4
                },
                verify_code: {
                    required: true,
                    rangelength: [4, 4]
                },
            },
            messages: {
                email: {
                    required: '请输入账号',
                    email:'账号需要是email格式',
                },
                password: {
                    required: '请输入密码',
                    minlength: '密码最少4位长度',
                },
                verify_code: {
                    required: '请输入验证码',
                    rangelength: '验证码长度为4',
                },
            },
            highlight: function (e) {
                $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
            },
            success: function (e) {
                $(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
                $(e).remove();
            },
            errorPlacement: function (error, element) {
                if(element.is(':checkbox') || element.is(':radio')) {
                    var controls = element.closest('div[class*="col-"]');
                    if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
                    else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
                }
                else if(element.is('.select2')) {
                    error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
                }
                else if(element.is('.chosen-select')) {
                    error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
                }
                else {
                    error.insertAfter(element);
                }
            },
        });
    </script>
@endsection