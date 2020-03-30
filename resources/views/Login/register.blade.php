<!doctype html>
<html  class="x-admin-sm">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>注册</title>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link rel="stylesheet" href="/css/font.css">
    <link rel="stylesheet" href="/css/login.css">
    <link rel="stylesheet" href="/css/xadmin.css">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="/lib/layui/layui.js" charset="utf-8"></script>
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="login-bg">

<div class="login layui-anim layui-anim-up">

    <div class="message">注册</div>
    <div id="darkbannerwrap"></div>

    <form method="post" action='registerto' class="layui-form" >
                <!--  @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif -->
        @csrf
        <input name="tel" placeholder="电话号码"  type="text" lay-verify="required" class="layui-input" >
        <p style="color:red" class="p">{{$errors->first('tel')}}</p>
        <hr class="hr15">
        <input name="password" lay-verify="required" placeholder="密码"  type="password" class="layui-input">
        <p style="color:red" class="p">{{$errors->first('password')}}</p>
        <hr class="hr15">
        <input name="password2" lay-verify="required" placeholder="确认密码"  type="password" class="layui-input">
        <p style="color:red" class="p">{{$errors->first('password2')}}</p>
        <hr class="hr15">
        <input class="code" placeholder="验证码" id="validatecode" type="text">
        <input class="code" onclick='duanxin()' value="获取验证码" id="btn" type="button">
        <hr class="hr10">
        <input value="注册" lay-submit lay-filter="login" style="width:100%;" type="submit">
        <hr class="hr20" >
    </form>
</div>
</body>
</html>
<script src='{{ asset("/static/js/jquery-3.2.1.min.js") }}'></script>
<script>      
    function duanxin() {
//获取手机ID
// alert('haha1');return;//查看是否引入js
        var iphone = $("#tel").val();
        alert(iphone);return;
        $.ajax({
            url: 'index/registerto',
            data: {'tel': iphone},
            type: "GET",
            dataType: "Json",
            success: function (msg) {
                if (msg['stat'] == '100') {
                    alert('发送成功');
                } else {
                    alert('发送失败');
                }
 
            }
        });
    }
</script>       
