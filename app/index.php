<?php

use Classes\dao\userDao;
use Classes\DBConnect\DBConnect;
use Mmshightech\service\factory\daoFactory\DaoFactory;
use Src\constants\DaoClassConstants;

if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}
include_once "../vendor/autoload.php";
if(isset($_SESSION['user_agent'],$_SESSION['var_agent'])){
    /** @var  userDao $userDao */
    $userDao = DaoFactory::make(DaoClassConstants::USER_DAO,[(new Classes\DBConnect\DBConnect(null))->getConnectionClass()]);
    $cur_user_row =$userDao->getCurrentUserByEmail($_SESSION['user_agent']);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="E-Learning for all SGELA is an app engineered to simplify all tertiary & bursary applications and easily accessible.">
    <meta name="keywords" content=" MAKHATHI CHICKENS | <?php echo $cur_user_row['name_surname'];?> | E-Learning for all">
    <meta name="author" content="Mr M.S Mzobe">
    <link rel='dns-prefetch' href='https://makhathichickens.co.za/app//s0.wp.com' />
    <link rel='dns-prefetch' href='https://makhathichickens.co.za/app/'/>
    <link rel='dns-prefetch' href='https://makhathichickens.co.za/app//fonts.googleapis.com' />
    <link rel='dns-prefetch' href='https://makhathichickens.co.za/app//s.w.org' />
    <link rel="alternate" type="application/rss+xml" title="E-Learning for all &raquo; Feed" href="https://makhathichickens.co.za/app/feed/" />
    <link rel="alternate" type="application/rss+xml" title="E-Learning for all &raquo; Comments Feed" href="https://makhathichickens.co.za/app/feed/" />
    <meta property="og:title" content="MMS HIGH TECH | "/>
    <meta property="og:description" content="MMS HIGH TECH | "/>

    <title><?php echo $cur_user_row['name_surname'];?></title>
    <link rel="icon" href="../img/loginDisplay-removebg-preview.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" crossorigin="anonymous">-->
    <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>-->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://www.payfast.co.za/onsite/engine.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <!-- <script src="https://kit.fontawesome.com/a076d05399.js"></script> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
</head>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap');
    *{
        margin: 0;
        padding: 0;
        font-family: 'poppins', sans-serif;
        width:100%;
    }
    body{
        width:100%;
    }
    section{
        justify-content: center;
        align-items: center;
        justify-items: center;
        align-content: center;
        align-self: center;
        height: 100vh;
        width: 100%;
        background: #002244 center;
        background-size: cover;
    }
    .box-shadow{
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.4);
    }
    section .bodyTag{
        width:100%;
        height: 81%;
        overflow-y: scroll;
        overflow-wrap: break-word;
        word-wrap: break-word;
        hyphens: auto;
        align-items: center;
        justify-items: center;
        align-content: center;
        align-self: center;
    }
    section .bodyTag::-webkit-scrollbar{
        width:1px;
        height: 1px;
    }
    section .bodyTag::-webkit-scrollbar-thumb {
        background: white;
        border-radius: 10px;
    }
    .imgLogoSetter{
        width:100%;
        padding: 10px 10px;
        justify-content: center;
        align-items: center;
        justify-items: center;
        align-content: center;
        align-self: center;
        text-align: center;
        color:white;

    }
    .imgLogoSetter img{
        width:50%;
        justify-content: center;
        align-items: center;
        justify-items: center;
        align-content: center;
        align-self: center;
        padding: 10px 10px;
    }
    .SetterBodyHaiv{
        padding: 10px 10px;
        width: 100%;
    }
    .headerMet{
        background:#0d0230 center;
        padding: 10px 10px;
        width:100%;
    }
    .headerMet .subTexted{
        width:100%;
        font-weight: bolder;
        font-size: x-small;
        display: flex;

    }
    .headerMet .subTexted .addressSelected{
        background: none;
        color:white;
        font-weight: bolder;
        font-size: 12px;
        border:none;
        width:70%;
    }
    .headerMet .subTexted span{
        width:30%;
        color: white;
        font-size: 12px;
        padding: 10px 10px;
        background:#002244;
        border-radius: 50px;
    }
    .searchItem{
        width:100%;
    }
    .searchItem input{
        width: 100%;
        padding:10px 10px;
        background: none;
        border-radius: 50px;
        border:1px solid #ddd;
        color: white;
    }
    .SetterBodyHaiv{
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        width: 100%;
        color: #dddddd;
    }
    .SetterBodyHaiv .massivBlockDisplay{
        padding: 10px 10px;
        width:50%;
    }
    .SetterBodyHaiv .massivBlockDisplay .ProductReader{
        padding: 2px 2px;
        border-radius: 10px;
        width:100%;
        height: 180px;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.5);
        background:#0d0230 center;
    }
    .reform-format{
        width: 100%;
        height: 60%;
        display: flex;
    }
    .reform-format .img-tag{
        width:80%;
        height: 100%;
    }
    .reform-format .img-tag img{
        width: 100%;
        height: 100%;
    }
    .reform-format .Counter-tag{
        width: 20%;
        padding: 1px 1px;

    }
    .reform-format .Counter-tag .dopeIn-ex{
        width: 100%;
        height: 95%;
        border-radius: 50px;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.4);
        background:#002244;
        color: #dddddd;
    }
    .footer{
        width: 100%;
        padding:5px 5px;
        background: #0d0230 center;
        color:#dddddd;
        display: flex;
    }
    .footer .global-setter{
        padding: 5px 5px;
        width: 100%;
        text-align: center;
        align-content: center;
        justify-items: center;
        justify-content: center;
    }
    .footer-narrow{
        padding: 5px 5px;
        border-radius: 100%;
        border: 2px solid #dddddd;
        width:65%;
    }
    .footer-narrow i{
        font-size: 20px;
        color: #dddddd;
        padding: 5px 5px;

    }
</style>
<body>
    <section>
        <div class="headerMet box-shadow">
            <div class="subTexted">
                <select class="form-select addressSelected ">
                    <option value="">-- Select Address --</option>
                </select>

                    <span class="box-shadow">Add Address</span>

            </div>
            <div class="searchItem">
                <input class="searchItemInput" id="searchItemInput" type="search" onchange="" placeholder="Search Item here...">
            </div>



        </div>
        <div class="bodyTag"></div>
        <div class="box-shadow footer">
            <div class="global-setter">
                <div class="footer-narrow home" onclick="loaderNav('home')"><i class="fa fa-home" aria-hidden="true"></i></div>
            </div>
            <div class="global-setter">
                <div class="footer-narrow cart" onclick="loaderNav('cart')"><i class="fa fa-cart-plus" aria-hidden="true"></i></div>
            </div>
            <div class="global-setter">
                <div class="footer-narrow MyOrders" onclick="loaderNav('myorders')"><i class="fa fa-shopping-basket" aria-hidden="true"></i></div>
            </div>
            <div class="global-setter">
                <div class="footer-narrow settings" onclick="loaderNav('settings')"><i class="fa fa-cog" aria-hidden="true"></i></div>
            </div>
            <div class="global-setter">
                <div class="footer-narrow manu"><i class="fa fa-bars" aria-hidden="true"></i></div>
            </div>
        </div>
    </section>
<script>
    loaderNav("home");
    function loaderNav(tVar){
        $(".bodyTag").html("<img src='../img/loader.gif' style='width:100%;border-radius: 20px;'>").load("../routes/appRoutes.php?getRequest="+tVar);
    }
</script>
</body>
</html>
<?php
}
else{
    session_destroy();
    ?>
    <script>
        window.location=("../");
    </script>
<?php
}
?>
