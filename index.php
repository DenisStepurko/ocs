<html>
<head>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
    <!--<script type="text/javascript" src="js/bootstrap.min.js"></script>-->
    <link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="css/bootstrap-responsive.css" rel="stylesheet" type="text/css" />
    <link href="css/stylesheet.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="top_bar_black">
    <div id="logo_container">
        <a href="index.php">
            <div id="logo_image">
            </div>
        </a>
        <div id="nav_block" style="color:white">
            <?php if(isset($_COOKIE['user']) && $_COOKIE['user'] >= 0){?>
            <center style="padding-top: 35px">Hi <span id="name_user_header"></span> <a href='#' id='exit_button'>Выйти</a></center>
            <?php }?>
        </div>
    </div>
</div>
<div id="content_container">
    <?php
    if(!isset($_COOKIE['user'])){
        setcookie('user',-1);
    }
    if(isset($_COOKIE['user']) && $_COOKIE['user'] >= 0){
        include_once('templates/index.template.php');
    } else {
        include_once('templates/login.template.php');
     }
    ?>
</div>



<div id="bottom_bar_black"> <div id="main_container">

    </div>
</body>
</html>

