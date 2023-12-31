
<?php
include_once "../vendor/autoload.php";
use Classes\LoginSessionScanning;
$login=new LoginSessionScanning(null);
$loginObj=$login->isActiveSessions();
if(!empty($loginObj)){
    print_r($loginObj);
}
else{
    $login->connect->DBClose();
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Welcome to MaKhathi Chickens, The only place to find healthy and affordable chickens and eggs.(::By MMS HIGH TECH, Mr MS Mzobe) .&amp; Backups">
        <link rel="canonical" href="https://netchatsa.com/makhathichickens/"/>
        <meta name="keywords" content="MAKHATHI CHICKENS, AFFORDABLE CHICKENS, AFFORDABLE EGGS, AFFORDABLE GROCERIES">
        <meta name="author" content="Mr M.S Mzobe,MMS HIGH TECH,netchatsa">
        <link rel='dns-prefetch' href='https://netchatsa.com/makhathichickens//s0.wp.com' />
        <link rel='dns-prefetch' href='https://netchatsa.com/makhathichickens/'/>
        <link rel='dns-prefetch' href='https://fonts.googleapis.com' />
        <link rel='dns-prefetch' href='https://netchatsa.com/makhathichickens//s.w.org' />
        <link rel="alternate" type="application/rss+xml" title="The best edu-technology intergration  &raquo; Feed" href="https://netchatsa.com/makhathichickens/feed/" />
        <link rel="alternate" type="application/rss+xml" title="The best edu-technology intergration &raquo; Comments Feed" href="https://netchatsa.com/makhathichickens/feed/" />
        <meta property="og:title" content="netchatsa : Bringing quality education to your hands |(::By mms enterprise)|"/>
        <meta property="og:description" content="Welcome to MaKhathi Chickens, The only place to find healthy and affordable chickens and eggs.(::By MMS HIGH TECH, Mr MS Mzobe). &amp; Backups"/>
        <meta property="og:.url" content="https://netchatsa.com/makhathichickens/"/>
        <meta property="og:site_name" content="MaKhathi Chickens Admin :: Healthy and affordable chickens and Eggs." />

        <link rel="icon" href="../img/loginDisplay-removebg-preview.png">
        <title>netchatsa</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&family=Roboto:ital,wght@0,400;1,700&display=swap" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.11/typed.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>



    </head>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap');
        *{
            margin: 0;
            padding: 0;
            font-family: 'poppins', sans-serif;
        }
        section{
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 85vh;
            width: 100%;
            background: #002244 center;
            background-size: cover;
        }
        .box-shadow{
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.4);
        }
        section .form-setter{
            width: 30%;
            height: 100%;
            background: #0d0230 center;
            padding: 10px 10px;
            border-radius: 10px;
            align-self: center;
            align-items: center;
            text-align: center;
            justify-content: center;
            color:#dddddd;
        }
        section .form-setter .tagger-top{
            width: 100%;
            padding: 10px 10px;
        }
        section .form-setter .tagger-top img{
            width: 50%;
        }
        .inputbox{
            position: relative;
            margin: 30px 0;
            width: 100%;
            border-bottom: 2px solid #fff;
        }
        .inputbox label{
            position: absolute;
            top: 50%;
            left: 5px;
            transform: translateY(-50%);
            color: #fff;
            font-size: 1em;
            pointer-events: none;
            transition: .5s;
        }
        input:focus ~ label,
        input:valid ~ label{
            top: -5px;
        }
        .inputbox input {
            width: 100%;
            height: 50px;
            background: transparent;
            border: none;
            outline: none;
            font-size: 1em;
            padding:0 35px 0 5px;
            color: #fff;
        }
        .inputbox select{
            position: relative;
            width: 100%;
            height: 50px;
            background: none;
            border: none;
            outline: none;
            font-size: 1em;
            padding:0 35px 0 5px;
            color: #000;

        }
        .inputbox ion-icon{
            position: absolute;
            right: 8px;
            color: #fff;
            font-size: 1.2em;
            top: 20px;
        }
        .forget{
            margin: -15px 0 15px ;
            font-size: .9em;
            color: #fff;
            display: flex;
            justify-content: space-between;
        }

        .forget label input{
            margin-right: 3px;

        }
        .forget label a{
            color: red;
            text-decoration: none;
            font-weight: 700;
        }
        .forget label a:hover{
            text-decoration: underline;
        }
        button{
            width: 100%;
            height: 40px;
            border-radius: 40px;
            background: #1b74e4;
            color: #fff;
            border: none;
            outline: none;
            cursor: pointer;
            font-size: 1em;
            font-weight: 600;
        }
        .register{
            font-size: .9em;
            color: #ffffff8f;
            text-align: center;
            margin: 25px 0 10px;
        }
        .register p a{
            text-decoration: none;
            color: #fff;
            font-weight: 600;
        }
        .register p a:hover{
            text-decoration: underline;
        }
        .form-value .processing{
            width:100%;
            display: flex;
            border:1px solid red;
            border-radius: 20px;
        }

        @media only screen and (max-width: 1180px){
            section .form-setter{
                width:60%;
                height: auto;
                padding: 10px 10px;
                font-size: medium;

            }
        }
        @media only screen and (max-width: 800px){
            section .form-setter{
                width:90%;
                height: auto;

            }
        }
        @media only screen and (max-width: 680px){
            section .form-setter{
                width:95%;
                height: auto;
            }
        }
    </style>
    <body>
    <section class="a">
        <div class="form-setter box-shadow">
            <div class="tagger-top">
                <img src="../img/loginDisplay-removebg-preview.png" >
                <h5>MaKhathi Chickens</h5>
            </div>
            <div class="navigator-load-admin">
                <div class="form-value">
                    <div class="inputbox">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input type="email" required class="emailLogin">
                        <label for="">Email</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" required class="passLogin">
                        <label for="">Password</label>
                    </div>
                    <button onclick="siyangenaManje()">Log in</button>
                    <br>
                    <div class="processing" hidden></div>
                </div>

            </div>
        </div>

    </section>
    <section style="display: flex;
             justify-content: center;
             align-items: center;
             min-height: 15vh;
             width: 100%;
             background: #0d0230 center;
             background-size: cover;
             border-top: 3px solid white;color: whitesmoke;font-weight: bolder;font-size: smaller;font-family: Arial,serif;">
        <div class="setter-footer">
            <center>
                <p>By MMS HIGH TECH | The tech that works for you.</p>
                <p style="font-size:10px;">2018-ToDate Copyright © MMS HIGH TECH | All Rights Reserved | MaKhathi Chickens</p>
            </center>
        </div>
    </section>
    <script>
        function siyangenaManje(){
            const emailLogin = $(".emailLogin").val();
            const passLogin = $(".passLogin").val();
            // console.log(emailLogin+" - "+passLogin);
            $(".emailLogin").removeAttr("style");
            $(".passLogin").removeAttr("style");
            $(".processing").removeAttr("hidden").attr("style","color:white;border:1px solid green;").html("<div><img src='../img/loader.gif' style='width:15%;border-radius: 20px;'> Processing...</div>");
            if(emailLogin===""){
                $(".emailLogin").attr("style","border-bottom:2px solid red;");
                $(".processing").removeAttr("hidden").attr("style","color:red;border:1px solid red;").html("Email Field Missing!");
            }
            else if(passLogin===""){
                $(".passLogin").attr("style","border-bottom:2px solid red;");
                $(".processing").removeAttr("hidden").attr("style","color:red;border:1px solid red;").html("Password Field Missing!");
            }
            else{
                const dash='dash';
                $.ajax({
                    url:'../routes/postRequests.php',
                    type:'post',
                    data:{emailLogin:emailLogin,passLogin:passLogin,dash:dash},
                    success:function(e){
                        e.replace(/^"(.+)"$/,'');
                        if(e.length>1){
                            $(".processing").attr("style","padding:5px 5px;color:red;").html(e);
                        }
                        else{
                            $(".processing").attr("style","padding:5px 5px;color:green;").html("Logging into to your account..");
                            window.location=("./admin");
                        }
                    }
                });
            }
        }

    </script>
    </body>

    </html>

    <?php
}
?>
