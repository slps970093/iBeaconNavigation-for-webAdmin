<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php echo e($title); ?></title>
        <link rel="stylesheet" href="<?php echo e(asset('css/bootstrap.min.css')); ?>">
        <script src="<?php echo e(asset('js/jquery.min.js')); ?>"></script>
        <script src="<?php echo e(asset('js/popper.js')); ?>"></script>
        <script src="<?php echo e(asset('js/bootstrap.min.js')); ?>"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <script type="text/javascript" src="<?php echo e(asset('js/jquery.validate.min.js')); ?>"></script>
        <script type="text/javascript" src="<?php echo e(asset('js/localization/messages_zh_TW.min.js')); ?>"></script>
        <style>
            @font-face {
              font-family: NotoSansCJK;
              src: url(../fonts/NotoSansCJKsc-Light.otf) format("opentype");
            }
            body{
                background-image: url(<?php echo e(asset('images/bg.jpg')); ?>);
                background-size:cover;
                font-family: 'NotoSansCJK';
            }

            .login{
                background-color:rgba(40, 115, 190, 0.53);
                color: #FFFFFF;
                padding:1.5%;
                width: 27%;
                position:absolute;
                left: 50%;
                top: 50%;
                margin-top: -10%;
                margin-left: -14%;
                border-style:solid;
            }
        </style>
    </head>
    <body>
    <?php if(isset($_GET['failed'])): ?>
    <div class="alert alert-danger" role="alert">
    帳號錯誤或密碼錯誤，請重新輸入！
    </div>
    <?php endif; ?>
    <?php if(isset($_GET['logout'])): ?>
    <div class="alert alert-danger" role="alert">
    你已登出成功！
    </div>
    <?php endif; ?>
        <div class="interface"></div>
        <div class="login">
            <h1><?php echo e($title); ?></h1>
            <hr>
            <form id="login" action="<?php echo e(url('login')); ?>" method="post">
                <?php echo e(csrf_field()); ?>

                <label for="username">管理者帳戶：</label>
                <input type="text" name="username" class="form-control"><br>
                <label for="password">管理者密碼：</label>
                <input type="password" name="password" class="form-control"><br>
                <input type="checkbox" name="rememeber">記住我的登入資訊<br>
                <input type="submit" name="submit" value="登入" class="btn btn-default">
            </form><br>
            程式設計：小周
            <script type="text/javascript">
                $(document).ready(function(){
                    $("#login").validate({
                        rules:{
                            username: 'required',
                            password: 'required'
                        }
                    });
                });
            </script>
        </div>
    </body>
</html>