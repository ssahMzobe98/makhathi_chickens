<?php

use Classes\dao\userDao;
use Classes\DBConnect\DBConnect;
use Mmshightech\service\factory\daoFactory\DaoFactory;
use Src\constants\DaoClassConstants;

if(session_status() !== PHP_SESSION_ACTIVE){
    session_start();
}
include_once "../../vendor/autoload.php";
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
    <meta name="keywords" content=" MMS HIGH TECH | <?php echo $cur_user_row['name_surname'];?> | E-Learning for all">
    <meta name="author" content="Mr M.S Mzobe">
    <link rel='dns-prefetch' href='https://makhathichickens.co.za/dash/admin//s0.wp.com' />
    <link rel='dns-prefetch' href='https://makhathichickens.co.za/dash/admin'/>
    <link rel='dns-prefetch' href='https://makhathichickens.co.za/dash/admin//fonts.googleapis.com' />
    <link rel='dns-prefetch' href='https://makhathichickens.co.za/dash/admin//s.w.org' />
    <link rel="alternate" type="application/rss+xml" title="E-Learning for all &raquo; Feed" href="https://makhathichickens.co.za/dash/admin/feed/" />
    <link rel="alternate" type="application/rss+xml" title="E-Learning for all &raquo; Comments Feed" href="https://makhathichickens.co.za/dash/admin/feed/" />
    <meta property="og:title" content="MMS HIGH TECH | "/>
    <meta property="og:description" content="MMS HIGH TECH | "/>

    <title><?php echo $cur_user_row['name_surname'];?></title>
    <link rel="icon" href="../../img/loginDisplay-removebg-preview.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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

    <link href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Arial, serif;
        font-size: small;
        font-weight: bold;
    }
    .badge{
        cursor: pointer;
    }
    .sidebar{
        position: fixed;
        height: 100%;
        width: 240px;
        background: #FFFFFF;
        transition: all 0.5s ease;
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.8);
    }
    .sidebar .logo-details{
        height: 80px;
        display: flex;
        align-items: center;
    }
    .sidebar .logo-details i{
        font-size: 28px;
        font-weight: 500;
        color: #000000;
        min-width: 60px;
        text-align: center
    }
    .largeModal{
        width:1300px;
        margin-left: -78%;

    }
    .sidebar .logo-details .logo_name{
        color: #000000;
        font-size: 18px;
        font-weight: 500;
    }
    .sidebar .nav-links{
        margin-top: 10px;
        margin-left: -21px;
    }
    .sidebar .nav-links li{
        position: relative;
        list-style: none;
        height: 50px;
    }
    .sidebar .nav-links li a{
        height: 100%;
        width: 100%;
        display: flex;
        align-items: center;
        text-decoration: none;
        transition: all 0.4s ease;
    }
    .sidebar .nav-links li a.active{
        background: #000;
    }
    .sidebar .nav-links li a:hover{
        background: #dddddd;
    }
    .sidebar .nav-links li i{
        min-width: 60px;
        text-align: center;
        font-size: 18px;
        color: #000000;
    }

    .sidebar .nav-links li a .links_name{
        color: #000000;
        font-size: 15px;
        font-weight: 400;
        white-space: nowrap;
        cursor: pointer;
    }
    .sidebar .nav-links .log_out{
        position: absolute;
        bottom: 0;
        width: 100%;
    }
    .home-section{
        position: relative;
        background: #dddddd;
        min-height: 100vh;
        width: calc(100% - 240px);
        left: 240px;
        transition: all 0.5s ease;
    }
    .sidebar.active ~ .home-section{
        width: calc(100% - 60px);
        left: 60px;
    }
    .home-section nav{
        display: flex;
        justify-content: space-between;
        height: 80px;
        background: #FFFFFF;
        align-items: center;
        position: fixed;
        width: calc(100% - 240px);
        left: 240px;
        z-index: 100;
        padding: 0 20px;
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.5);
        transition: all 0.5s ease;
    }
    .sidebar.active ~ .home-section nav{
        left: 60px;
        width: calc(100% - 60px);
    }
    .home-section nav .sidebar-button{
        display: flex;
        align-items: center;
        font-size: 24px;
        font-weight: 500;
        color:#000000;
    }
    nav .sidebar-button i{
        font-size: 35px;
        margin-right: 10px;
    }
    .maKhathiSpazaSearch{
        padding: 0 10px;
        width: 40%;
    }
    .maKhathiSpazaSearch input{
        width:100%;
        padding: 10px 10px;
        background: none;
        border:1px solid #000000;
        text-align: left;
        color:#000000;
        border-radius: 10px;

    }
    .home-section nav .search-box{
        position: relative;
        height: 50px;
        max-width: 550px;
        width: 100%;
        margin: 0 20px;
        font-size: 18px;
        color:#000000;
    }
    .home-section nav .profile-details{
        display: flex;
        align-items: center;
        background: #dddddd;;
        border: 2px solid #000000;
        border-radius: 6px;
        height: 50px;
        min-width: 190px;
        padding: 0 15px 0 2px;
    }
    nav .profile-details img{
        height: 40px;
        width: 40px;
        border-radius: 6px;
        object-fit: cover;
    }
    th,td{
        color: #000000;
    }

    nav .profile-details .admin_name{
        font-size: 15px;
        font-weight: 500;
        color: #000000;
        margin: 0 10px;
        white-space: nowrap;
    }
    nav .profile-details i{
        font-size: 25px;
        color: #000000;
    }
    .home-section .home-content{
        position: relative;
        padding-top: 104px;
    }
    .overview-boxes .box{
        display: flex;
        align-items: center;
        justify-content: center;
        width: calc(100% / 4 - 15px);
        background: #FFFFFF;
        padding: 15px 14px;
        border-radius: 12px;
        box-shadow: 0 5px 10px rgba(0,0,0,0.5);
        color:#000000;
    }
    .home-content .box .indicator i{
        height: 20px;
        width: 20px;
        background: #000000;
        line-height: 20px;
        text-align: center;
        border-radius: 50%;
        color: #000000;
        font-size: 20px;
        margin-right: 5px;
    }
    .home-content .masomane{
        display: flex;
        justify-content: space-between;
        /* padding: 0 20px; */
    }
    .orderDataSet .orderDataSetHeader .maKhathiOrdersSearch input{
        width:100%;
        padding: 4px 10px;
        border:1px solid #212121;
        color:#000000;
        background: none;
        border-radius: 10px;
    }
    /* left box */
    .home-content .masomane .makhanyile{
        width: 100%;
        background: #FFFFFF;
        padding: 20px 30px;
        margin: 0 20px;
        border-radius: 12px;
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.5);
        color:#000000;
        overflow-y: scroll;
        overflow-wrap: break-word;
        word-wrap: break-word;
        hyphens: auto;
        height: 82vh;

    }
    .home-content .masomane .makhanyile::-webkit-scrollbar{
        width:1px;
    }
    .home-content .masomane .makhanyile::-webkit-scrollbar-thumb {
        background: red;
        border-radius: 10px;
    }
    .masomane .makhanyileDtails li{
        list-style: none;
        margin: 8px 0;
    }

    .masomane .makhanyileDtails li a{
        font-size: 18px;
        color: #000000;
        text-decoration: none;
        cursor: pointer;
    }
    .masomane .box .button a{
        color: #000000;
        background: #dddddd;
        padding: 4px 12px;
        font-size: 15px;
        font-weight: 400;
        border-radius: 4px;
        text-decoration: none;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    .masomane .box .button a:hover{
        background:  #dddddd;
    }
    .masomane .maKhathi li{
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin: 10px 0;
    }
    .masomane .maKhathi li a img{
        height: 40px;
        width: 40px;
        object-fit: cover;
        border-radius: 12px;
        margin-right: 10px;
        background: #333;
    }
    .masomane .maKhathi li a{
        display: flex;
        align-items: center;
        text-decoration: none;
        cursor: pointer;
    }
    .modal-content{
        background: #FFFFFF;
    }
    .inputVals{
        width: 100%;
        padding:10px 10px;
    }
    .modal-title{
        text-align: center;
        color: #000000;

    }
    .inputVals .addMasomaneNewSchool{
        border:2px solid #000000;
        color:#000000;
        border-radius: 100px;
        text-align: center;
        cursor: pointer;
    }
    .inputVals input,select{
        width:100%;
        border:none;
        border-bottom: 2px solid #000000;
        background:none;
        color:#000000;
        padding: 10px 10px;
    }
    select{
        background: #FFFFFF;
        color: #000000;
    }
    .button-success{
        background: #008000;
        color: #FFFFFF;
        padding: 10px 10px;
        text-align: center;
        border-radius: 10px;
    }
    .button-red{
        background: #ff0000;
        color: #FFFFFF;
        padding: 10px 10px;
        text-align: center;
        border-radius: 10px;
    }
    .rightPadding{
        width:70%;
        padding: 10px 10px;
    }
    .leftPadding{
        width: 30%;
        padding: 10px 10px;
    }
    .box-shadow{
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.4);
    }
    .order-details, .details{
        width: 100%;
        border-radius: 10px;
        border:1px solid #dddddd;
        padding: 10px 10px;

    }
    .flex{
        display: flex;
    }
    .flex-wrap{
        flex-wrap: wrap-reverse;
    }
    .label{
        padding: 5px 5px;
    }
    .datetimeDetailsPaddding{
        width:50%;
        padding: 10px 10px;

    }
    .padding-10{
        padding: 10px 10px;
    }
    .w-100{
        width:100%;
    }
    .padding-5{
        padding: 5px 5px;
    }
    .productInput{
        width:100%;
        padding: 10px 10px;
        border:none;
    }
    .padding-20{
        padding: 20px 20px;
    }
    .center-content{
        align-content: center;
        justify-content: center;
        justify-items: center;
        justify-self: center;
        text-align: center;
    }
    .datetimeDetailsPaddding input{
        padding: 5px 5px;
        border:none;
        border-bottom: 2px solid #000000;
        color:#000000;
    }
    .Order-time-line{}
    /* Responsive Media Query */
    @media (max-width: 1240px) {
        .sidebar{
            width: 60px;
        }
        .sidebar.active{
            width: 220px;
        }
        .home-section{
            width: calc(100% - 60px);
            left: 60px;
        }
        .sidebar.active ~ .home-section{
            /* width: calc(100% - 220px); */
            overflow: hidden;
            left: 220px;
        }
        .home-section nav{
            width: calc(100% - 60px);
            left: 60px;
        }
        .sidebar.active ~ .home-section nav{
            width: calc(100% - 220px);
            left: 220px;
        }
    }
    @media (max-width: 1150px) {
        .home-content .masomane{
            flex-direction: column;
        }
        .home-content .masomane .box{
            width: 100%;
            overflow-x: scroll;
            margin-bottom: 30px;
        }
        .home-content .masomane .maKhathi{
            margin: 0;
        }
    }
    @media (max-width: 1000px) {
        .overview-boxes .box{
            width: calc(100% / 2 - 15px);
            margin-bottom: 15px;
        }
    }
    @media (max-width: 700px) {
        nav .sidebar-button .dashboard,
        nav .profile-details .admin_name,
        nav .profile-details i{
            display: none;
        }
        .home-content .masomane .makhanyile{
            margin: 0;
        }
        .home-section nav .profile-details{
            height: 50px;
            min-width: 40px;
        }
    }
    @media (max-width: 550px) {
        .overview-boxes .box{
            width: 100%;
            margin-bottom: 15px;
        }
        .sidebar.active ~ .home-section nav .profile-details{
            display: none;
        }
    }
    @media (max-width: 400px) {
        .sidebar{
            width: 0;
        }
        .home-section{
            width: 100%;
            left: 0;
        }
        .sidebar.active ~ .home-section{
            left: 60px;
            width: calc(100% - 60px);
        }
        .home-section nav{
            width: 100%;
            left: 0;
        }
        .sidebar.active ~ .home-section nav{
            left: 60px;
            width: calc(100% - 60px);
        }
    }
</style>
        <body>
        <div class="sidebar ">
            <div class="logo-details">
                <i class='bx bxl-c-plus-plus'></i>
                <span class="logo_name">MaKhathi Chickens</span>
            </div>
            <ul class="nav-links">

                <li>
                    <a data-bs-toggle="modal" data-bs-target="#addNewUser">
                        <i class='bx bx-grid-alt' ></i>
                        <span class="links_name">Create User</span>
                    </a>
                </li>
                <li>
                    <a onclick='loadAfterQuery(".makhanyile","../../src/forms/admin/manageUsersForm.php")'>
                        <i class='bx bx-grid-alt' ></i>
                        <span class="links_name">Manage users</span>
                    </a>
                </li>
                <li>
                    <a onclick='loadAfterQuery(".makhanyile","../../src/forms/admin/addNewProduct.php")'>
                        <i class='bx bx-list-ul' ></i>
                        <span class="links_name">Create Product</span>
                    </a>
                </li>
                <li>
                    <a onclick='loadAfterQuery(".makhanyile","../../src/forms/admin/manageProduct.php?status=A")'>
                        <i class='bx bx-pie-chart-alt-2' ></i>
                        <span class="links_name">Manage Products</span>
                    </a>
                </li>
                <li>
                    <a onclick='loadAfterQuery(".makhanyile","../../src/forms/admin/onCredits.php")'>
                        <i class='bx bx-pie-chart-alt-2' ></i>
                        <span class="links_name">On Credits</span>
                    </a>
                </li>
                <li>
                    <a onclick='loadAfterQuery(".makhanyile","../../src/forms/admin/financialStatement.php")'>
                        <i class='bx bx-pie-chart-alt-2' ></i>
                        <span class="links_name">Transactions</span>
                    </a>
                </li>
                <li>
                    <a onclick='loadAfterQuery(".makhanyile","../../src/forms/admin/ordersForm.php")'>
                        <i class='bx bx-pie-chart-alt-2' ></i>
                        <span class="links_name">Orders</span>
                    </a>
                </li>
                

                <li class="log_out">
                    <a onclick="logout()">
                        <i class='bx bx-log-out'></i>
                        <span class="links_name logoutSet">Log out</span>
                    </a>
                </li>
            </ul>
        </div>
        <section class="home-section">
            <nav>
                <div class="sidebar-button">
                    <i class='bx bx-menu sidebarBtn' style="cursor: pointer;"></i>
                    <span style="padding:0 8px;" class="dashboard"><i class="fa fa-arrow-left" style="font-size:15px;cursor: pointer;" aria-hidden="true"></i></span>
                    <span style="padding:0 8px;" class="dashboard"><i class="fa fa-arrow-right" style="font-size:15px;cursor: pointer;" aria-hidden="true"></i></span>
                </div>
                <div class="search-box" >
                    MaKhathi Chickens <span class="username"> ~ <?php echo $cur_user_row['name_surname']." : ".$cur_user_row['id'];?>
                </div>
                <div class="maKhathiSpazaSearch">
                    <input type="search-box" class="maKhathiSpazaSearchInput" placeholder="Global Search...">
                </div>
                <div class="profile-details">
                    <img src="../../img/loginDisplay-removebg-preview.png" alt="">
                    <span class="admin_name"><?php echo $cur_user_row['name_surname'];?></span>
                    <i class='bx bx-chevron-down' ></i>
                </div>
            </nav>

            <div class="home-content">
                <div class="masomane">
                    <div class="makhanyile box">

                    </div>
                    <!-- <div class="maKhathi box">
                      <div class="maKhathiSpazaSearch">
                        <input type="search-box" class="maKhathiSpazaSearchInput" placeholder="Search Spaza...">
                      </div>
                    </div> -->
                </div>
            </div>
        </section>
        <div class="modal" id="addNewUser">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" style="text-align: center;">Create User</h4>
                        <button type="button" style="color: white;" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="inputVals">
                            <input type="text" required class="fname" placeholder="User First Name ...">
                        </div>
                        <div class="inputVals">
                            <input type="text" required class="lname" placeholder="User Last Name">
                        </div>
                        <div class="inputVals">
                            <select class="gender">
                                <option value="">-- Select Gender--</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <!-- <div class="inputVals">
                            <input type="date" required class="userDOB" placeholder="date of birth">
                        </div> -->
                        <div class="inputVals">
                            <input type="number" required class="userPhoneNo" placeholder="User Phone No.">
                        </div>
                        <div class="inputVals">
                            <input type="email" required class="userEmailAddress" placeholder="Email Address">
                        </div>
                        <div class="inputVals">
                            <input type="password" required class="userPassword" placeholder="User Password">
                        </div>

                        <br>
                        <div class="inputVals">
                            <center>
                                <span style="padding:10px 10px;border:1px solid #ddd;" class="addNewUser" onclick="addNewUser()"> Create New User <span style="padding:2px 2px;"><i style="padding:10px 10px;color:green;" class="fa fa-plus"></i></span></span>
                            </center>
                        </div>
                        <div class="errorAddNewUser" hidden></div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>
        <div class="modal" id="smallModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="smallModal"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>
        <div class="modal" id="largeModal">
            <div class="modal-dialog">
                <div class="modal-content largeModal">

                    <div class="showlargeModal"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>
        <div class="modal" id="addNetchatsaSubjects">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" style="text-align: center;">Add Netchatsa Subject</h4>
                        <button type="button" style="color: white;" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function(){
                $("#dataTable").DataTable();
                loadAfterQuery(".makhanyile","../../src/forms/admin/ordersForm.php");
            });
            function loadAfterQuery(rclass,dir){
                $(rclass).html("<center><img src='../../img/loader.gif' style='width:30%;padding:10px 10px;justify-content:center;align-content:center;text-align:center;'></center>").load(dir);
            }
            function openOrderDetails(orderUid){
                domeSquareModal("orderDetails",orderUid)
            }
            function openUserOnCredit(userId){
                domeSquareModal("userCreditDetails",userId)
            }
            function removeProduct(removeProductUid,statusCodeRemoval){
                const url="../../routes/adminRequests.php";
                $.ajax({
                    url:url,
                    type:'post',
                    data:{removeProductUid:removeProductUid,statusCodeRemoval:statusCodeRemoval},
                    beforeSend:function(){
                        $(".removeLog"+removeProductUid).html("<img style='width:5%;' src='../../img/loader.gif'><h5 style='color:green;'>Processing Data..</h5>");
                    },
                    success:function(e){
                        response = JSON.parse(e);
                        if(response['responseStatus']==='S'){
                            $(".removeLog"+removeProductUid).removeAttr("hidden").attr("style","padding:10px 10px;width:100%;color:green;").html("Removed!");
                            $(".removeLogRow"+removeProductUid).attr("hidden",'true');
                        }
                        else{
                            $(".removeLog"+removeProductUid).removeAttr("hidden").attr("style","padding:10px 10px;width:100%;color:red;border:2px solid red;border-radius:10px;").html(response['responseMessage']);
                        }
                    }
                });
            }
            function widthdraw(){
                let WithDrawalReason = $(".WithDrawalReason").val();
                let withdrawalAmount = $(".withdrawalAmount").val();
                let withDrawer = $(".withDrawer").val();
                $(".processing").removeAttr("hidden").attr("style","color:red;border:1px solid red;background:white;").html("<div><img src='../../img/loader.gif' style='width:15%;border-radius: 20px;'> Processing...</div>");
                if(WithDrawalReason===""){
                    $(".WithDrawalReason").attr("style","border:1px solid red;");
                    $(".processing").attr("style","border:1px solid red;color:red;").html("Missing Field!");
                }
                else if(withdrawalAmount===""){
                    $(".withdrawalAmount").attr("style","border:1px solid red;");
                    $(".processing").attr("style","border:1px solid red;color:red;").html("Missing Field!");
                }
                else if(withDrawer===""){
                    $(".withDrawer").attr("style","border:1px solid red;");
                    $(".processing").attr("style","border:1px solid red;color:red;").html("Missing Field!");
                }
                else{
                    getResponse(WithDrawalReason,withdrawalAmount,withDrawer,'withdraw');
                }
            }
            function deposit(){
                let DepositReason = $(".DepositReason").val();
                let DepositAmount = $(".DepositAmount").val();
                let Depositer = $(".Depositer").val();
                $(".processing1").removeAttr("hidden").attr("style","color:red;border:1px solid red;background:white;").html("<div><img src='../../img/loader.gif' style='width:15%;border-radius: 20px;'> Processing...</div>");
                if(DepositReason===""){
                    $(".DepositReason").attr("style","border:1px solid red;");
                    $(".processing1").attr("style","border:1px solid red;color:red;").html("Missing Field!");
                }
                else if(DepositAmount===""){
                    $(".DepositAmount").attr("style","border:1px solid red;");
                    $(".processing1").attr("style","border:1px solid red;color:red;").html("Missing Field!");
                }
                else if(Depositer===""){
                    $(".Depositer").attr("style","border:1px solid red;");
                    $(".processing1").attr("style","border:1px solid red;color:red;").html("Missing Field!");
                }
                else{
                    getResponse(DepositReason,DepositAmount,Depositer,'deposit');
                }
            }
            function getResponse(transactReason,transactAmount,transactPerson,transactType){
                const url="../../routes/adminRequests.php";
                let processing = (transactType==='deposit')?".processing1":".processing";
                $.ajax({
                    url:url,
                    type:'post',
                    data:{transactReason:transactReason,transactAmount:transactAmount,transactPerson:transactPerson,transactType:transactType},
                    beforeSend:function(){
                        $(processing).html("<img style='width:5%;' src='../../img/loader.gif'><h5 style='color:green;'>Processing Data..</h5>");
                    },
                    success:function(e){
                        response = JSON.parse(e);
                        if(response['responseStatus']==='S'){
                            $(processing).attr("style","padding:10px 10px;width:100%;color:green;").html(transactType+" success");
                            if(transactType==='deposit'){
                                $(".DepositReason").val('');
                                $(".DepositAmount").val('');
                                $(".Depositer").val('');
                                //loadAfterQuery(".classCallerDeposit","../../src/forms/admin/transactionHistory.php?query=deposit");
                            }
                            else{
                                $(".WithDrawalReason").val('');
                                $(".withdrawalAmount").val('');
                                $(".withDrawer").val('');
                                //loadAfterQuery(".classCallerwithDraw","../../src/forms/admin/transactionHistory.php?query=withdraw");
                            }
                            loadAfterQuery(".makhanyile","../../src/forms/admin/financialStatement.php")
                        }
                        else{
                            $(processing).attr("style","padding:10px 10px;width:100%;color:red;border:2px solid red;border-radius:10px;").html(response['responseMessage']);
                        }
                    }
                });
            }
            function logout(){
                logout = "logout";
                const url="../../routes/adminRequests.php";
                $.ajax({
                    url:url,
                    type:'post',
                    data:{logout:logout},
                    success:function(e){
                        $('.logoutSet').html("Logging out....");
                        window.location=("../");
                    }
                });
            }
            function UpdateProduct(ProductIdUpdateDetails){
                $(".imgResponseRequest").removeAttr("hidden").attr("style","color:red;border:1px solid red;background:white;").html("<div><img src='../../img/loader.gif' style='width:5%;border-radius: 20px;'> Processing...</div>");
                const productTitleUpdate = $('.productTitleUpdate').val();
                const productProductTypeUpdate = $('.productProductTypeUpdate').val();
                const productSubTitleUpdate = $('.productSubTitleUpdate').val();
                const productSizeUpdate = $('.productSizeUpdate').val();
                const productPriceUpdate = $('.productPriceUpdate').val();
                const productInstockUpdate = $('.productInstockUpdate').val();
                const productDescriptionUpdate = $('.productDescriptionUpdate').val();
                if(productTitleUpdate===''){
                    $('.productTitleUpdate').attr('style','border:1px solid red;');
                    $('imgResponseRequest').attr('style','color:red;').html("Field required*");
                }
                else if(productProductTypeUpdate===''){
                    $('.productProductTypeUpdate').attr('style','border:1px solid red;');
                    $('imgResponseRequest').attr('style','color:red;').html("Field required*");
                }
                else if(productSubTitleUpdate===''){
                    $('.productSubTitleUpdate').attr('style','border:1px solid red;');
                    $('imgResponseRequest').attr('style','color:red;').html("Field required*");
                }
                else if(productSizeUpdate===''){
                    $('.productSizeUpdate').attr('style','border:1px solid red;');
                    $('imgResponseRequest').attr('style','color:red;').html("Field required*");
                }
                else if(productPriceUpdate===''){
                    $('.productPriceUpdate').attr('style','border:1px solid red;');
                    $('imgResponseRequest').attr('style','color:red;').html("Field required*");
                }
                else if(productInstockUpdate===''){
                    $('.productInstockUpdate').attr('style','border:1px solid red;');
                    $('imgResponseRequest').attr('style','color:red;').html("Field required*");
                }
                else if(productDescriptionUpdate===''){
                    $('.productDescriptionUpdate').attr('style','border:1px solid red;');
                    $('imgResponseRequest').attr('style','color:red;').html("Field required*");
                }
                else{
                    const url="../../routes/adminRequests.php";
                    $.ajax({
                        url:url,
                        type:'post',
                        data:{productTitleUpdate:productTitleUpdate,
                                productProductTypeUpdate:productProductTypeUpdate,
                                productSubTitleUpdate:productSubTitleUpdate,
                                productSizeUpdate:productSizeUpdate,
                                productPriceUpdate:productPriceUpdate,
                                productInstockUpdate:productInstockUpdate,
                                productDescriptionUpdate:productDescriptionUpdate,
                                ProductIdUpdateDetails:ProductIdUpdateDetails
                            },
                        beforeSend:function(){
                            $(".imgResponseRequest").html("<img style='width:5%;' src='../../img/loader.gif'><h5 style='color:green;'>Processing Data..</h5>");
                        },
                        success:function(e){
                            response = JSON.parse(e);
                            if(response['responseStatus']==='S'){
                                $(".imgResponseRequest").removeAttr("hidden").attr("style","padding:10px 10px;width:100%;color:green;").html("Successfully Updated!");
                                domeSquareModal('ProductDetails',ProductIdUpdateDetails);

                            }
                            else{
                                $(".imgResponseRequest").removeAttr("hidden").attr("style","padding:10px 10px;width:100%;color:red;border:2px solid red;border-radius:10px;").html(response['responseMessage']);
                            }
                        }
                    });
                }
            }
            function addNewUser(){
                var fname = $(".fname").val();
                var lname = $(".lname").val();
                var userPhoneNo = $(".userPhoneNo").val();
                var userEmailAddress = $(".userEmailAddress").val();
                var userPassword = $(".userPassword").val();
                var gender = $(".gender").val();
                $(".errorAddNewUser").removeAttr("hidden").attr("style","color:red;border:1px solid red;background:white;").html("<div><img src='../../img/loader.gif' style='width:5%;border-radius: 20px;'> Processing...</div>");
                if(fname ===""){
                    $(".fname").attr("style","border:1px solid red;");
                    $(".errorAddNewUser").attr("style","color:red;border:1px solid red;padding:5px;text-align:left;").html("field required*");
                }
                else if(lname ===""){
                    $(".lname").attr("style","border:1px solid red;");
                    $(".errorAddNewUser").attr("style","color:red;border:1px solid red;padding:5px;text-align:left;").html("field required*");
                }
                else if(userPhoneNo ===""){
                    $(".userPhoneNo").attr("style","border:1px solid red;");
                    $(".errorAddNewUser").attr("style","color:red;border:1px solid red;padding:5px;text-align:left;").html("field required*");
                }
                else if(userEmailAddress ===""){
                    $(".userEmailAddress").attr("style","border:1px solid red;");
                    $(".errorAddNewUser").attr("style","color:red;border:1px solid red;padding:5px;text-align:left;").html("field required*");
                }
                else if(userPassword ===""){
                    $(".userPassword").attr("style","border:1px solid red;");
                    $(".errorAddNewUser").attr("style","color:red;border:1px solid red;padding:5px;text-align:left;").html("field required*");
                }
                else if(gender ===""){
                    $(".gender").attr("style","border:1px solid red;");
                    $(".errorAddNewUser").attr("style","color:red;border:1px solid red;padding:5px;text-align:left;").html("field required*");
                }
                else{
                    fname = fname+" "+lname;
                    const url="../../routes/adminRequests.php";
                    $.ajax({
                        url:url,
                        type:'post',
                        data:{fname:fname,userPhoneNo:userPhoneNo,userEmailAddress:userEmailAddress,userPassword:userPassword,gender:gender},
                        beforeSend:function(){
                            $(".errorAddNewUser").html("<img style='width:5%;' src='../../img/loader.gif'><h5 style='color:green;'>Processing Data..</h5>");
                        },
                        success:function(e){
                            response = JSON.parse(e);
                            if(response['responseStatus']==='S'){
                                $(".errorAddNewUser").removeAttr("hidden").attr("style","padding:10px 10px;width:100%;color:green;").html("New User added!!");
                            }
                            else{
                                $(".errorAddNewUser").removeAttr("hidden").attr("style","padding:10px 10px;width:100%;color:red;border:2px solid red;border-radius:10px;").html(response['responseMessage']);
                            }
                        }
                    });
                }
            }
            function fileAddProductUpdate(ProductImgUpdateId){
                $(".imgResponseRequest").removeAttr("hidden").attr("style","color:red;border:1px solid red;background:white;").html("<div><img src='../../img/loader.gif' style='width:5%;border-radius: 20px;'> Processing...</div>");
                const fileAddProduct = document.getElementById('fileAddProductUpdate').files;
                var form_data = new FormData();
                terminate = false
                for(var i=0;i<fileAddProduct.length;i++){
                    if(fileAddProduct[i]===""){
                        break;
                        terminate=true;
                    }
                    form_data.append("imgResponseRequest",fileAddProduct[i]);
                }
                if(terminate){
                    $(".imgResponseRequest").attr("style","color:red;border:1px solid red;background:white;").html("File input required.");
                }
                else{
                    form_data.append("productImgUpdateId",ProductImgUpdateId);
                    const url="../../routes/adminRequests.php";
                    $(".imgResponseRequest").removeAttr("hidden").attr("style","padding:10px 10px;width:100%;color:green;").html("<img style='width:10%;' src='../../img/loader.gif'><h5 style='color:green;'>Processing Request..</h5>");
                    $.ajax({
                        url:url,
                        processData: false,
                        contentType: false,
                        type:"POST",
                        data:form_data,
                        cache:false,
                        enctype: 'multipart/form-data',
                        success:function(e){
                            response = JSON.parse(e);
                            if(response['responseStatus']==='S'){
                                $(".imgResponseRequest").removeAttr("hidden").attr("style","padding:10px 10px;width:100%;color:green;").html("Product IMG updated");
                                domeSquareModal('ProductDetails',ProductImgUpdateId);
                            }
                            else{
                                $(".imgResponseRequest").removeAttr("hidden").attr("style","padding:10px 10px;width:100%;color:red;border:2px solid red;border-radius:10px;").html(response['responseMessage']);
                            }
                        }
                    });
                }
            }
            function addNewProduct(){
                const fileAddProduct = document.getElementById('fileAddProduct').files;
                const productTitle = $(".productTitle").val();
                const productProductType = $(".productProductType").val();
                const productSubTitle = $(".productSubTitle").val();
                const productSize = $(".productSize").val();
                const productPrice = $(".productPrice").val();
                const productInstock = $(".productInstock").val();
                const productDescription = $(".productDescription").val();
                $('.productInput').removeAttr('style');
                $(".processing").removeAttr("hidden").attr("style","color:red;border:1px solid red;background:white;").html("<div><img src='../../img/loader.gif' style='width:15%;border-radius: 20px;'> Processing...</div>");

                if(fileAddProduct===""){
                    $('.fileAddProduct').attr("style","border:1px solid red;");
                    $(".processing").removeAttr("hidden").attr("style","color:red;border:1px solid red;background:white;").html("Please Add Product thumbnail.");
                }
                else if(productTitle===""){
                    $('.productTitle').attr("style","border:1px solid red;");
                    $(".processing").removeAttr("hidden").attr("style","color:red;border:1px solid red;background:white;").html("Product title missing.");
                }
                else if(productSubTitle===""){
                    $('.productSubTitle').attr("style","border:1px solid red;");
                    $(".processing").removeAttr("hidden").attr("style","color:red;border:1px solid red;background:white;").html("Product Sub title missing.");
                }
                else if(productProductType===""){
                    $('.productProductType').attr("style","border:1px solid red;");
                    $(".processing").removeAttr("hidden").attr("style","color:red;border:1px solid red;background:white;").html("Product Type missing.");
                }
                else if(productSize===""){
                    $('.productSize').attr("style","border:1px solid red;");
                        $(".processing").removeAttr("hidden").attr("style","color:red;border:1px solid red;background:white;").html("Product Size missing.");
                }
                else if(productPrice===""){
                    $('.productPrice').attr("style","border:1px solid red;");
                        $(".processing").removeAttr("hidden").attr("style","color:red;border:1px solid red;background:white;").html("Product price missing.");
                }
                else if(productInstock===""){
                        $('.productInstock').attr("style","border:1px solid red;");
                        $(".processing").removeAttr("hidden").attr("style","color:red;border:1px solid red;background:white;").html("Please add number in stock.");
                }
                else if(productDescription===""){
                        $('.productDescription').attr("style","border:1px solid red;");
                        $(".processing").removeAttr("hidden").attr("style","color:red;border:1px solid red;background:white;").html("Product description Missing.");
                }
                else{
                    var form_data = new FormData();
                    terminate = false
                    for(var i=0;i<fileAddProduct.length;i++){
                        if(fileAddProduct[i]===""){
                            break;
                            terminate=true;
                        }
                        form_data.append("fileAddProduct",fileAddProduct[i]);
                    }
                    if(!terminate){
                        form_data.append("productTitle",productTitle);
                        form_data.append("productProductType",productProductType);
                        form_data.append("productSubTitle",productSubTitle);
                        form_data.append("productSize",productSize);
                        form_data.append("productPrice",productPrice);
                        form_data.append("productInstock",productInstock);
                        form_data.append("productDescription",productDescription);
                        
                        // form_data.append("filesUpload",1);
                        const url="../../routes/adminRequests.php";
                        $(".processing").removeAttr("hidden").attr("style","padding:10px 10px;width:100%;color:green;").html("<img style='width:10%;' src='../../img/loader.gif'><h5 style='color:green;'>Processing Request..</h5>");
                        $.ajax({
                            url:url,
                            processData: false,
                            contentType: false,
                            type:"POST",
                            data:form_data,
                            cache:false,
                            enctype: 'multipart/form-data',
                            success:function(e){
                                response = JSON.parse(e);
                                if(response['responseStatus']==='S'){
                                    $(".processing").removeAttr("hidden").attr("style","padding:10px 10px;width:100%;color:green;").html("Product list added!!");
                                }
                                else{
                                    $(".processing").removeAttr("hidden").attr("style","padding:10px 10px;width:100%;color:red;border:2px solid red;border-radius:10px;").html(response['responseMessage']);
                                }
                            }
                        });
                    }
                    else{
                        $('.fileAddProduct').attr("style","border:1px solid red;");
                        $(".processing").removeAttr("hidden").attr("style","color:red;border:1px solid red;background:white;").html("Please Add Product thumbnail.");
                    }
                    
                }
            }
            // $(document).on("change",".filesUpload",function(){
            //     const filesUpload = document.getElementById('filesUpload').files;
            //     // console.log("sending "+filesUpload);
            //     var form_data = new FormData();
            //     for(var i=0;i<filesUpload.length;i++){
            //         form_data.append("filesUpload"+i,filesUpload[i]);
            //     }
            //     form_data.append("filesUpload",1);
            //     const url="../controller/mmshightech/processor.php";
            //     $(".displayResponse").removeAttr("hidden").attr("style","padding:10px 10px;width:100%;color:green;").html("<img style='width:10%;' src='../img/loader.gif'><h5 style='color:green;'>Processing Request..</h5>");
            //     $.ajax({
            //         url:url,
            //         processData: false,
            //         contentType: false,
            //         type:"POST",
            //         data:form_data,
            //         cache:false,
            //         enctype: 'multipart/form-data',
            //         success:function(e){
            //             if(e.length==1){
            //                 $(".displayResponse").removeAttr("hidden").attr("style","padding:10px 10px;width:100%;color:green;").html("Product list added!!");
            //             }
            //             else{
            //                 $(".displayResponse").removeAttr("hidden").attr("style","padding:10px 10px;width:100%;color:red;border:2px solid red;border-radius:10px;").html(e);
            //             }
            //         }
            //     });
            // });
            // function getOrderInfo(orderNo){
            //     domeSquareModal('ordersFormData',orderNo);
            // }
            // function getSpazaInfo(spazaNo){
            //     domeSquareModal('spazaFormData',spazaNo);
            // }
            // function addNewSpaza(userId){
            //     domeSmallModal('addNewSpaza',userId);
            // }
            // function getUserInfo(userId){
            //     domeSquareModal('manageUsersFormData',userId);
            // }
            // let sidebar = document.querySelector(".sidebar");
            // let sidebarBtn = document.querySelector(".sidebarBtn");
            // sidebarBtn.onclick = function() {
            //     sidebar.classList.toggle("active");
            //     if(sidebar.classList.contains("active")){
            //         sidebarBtn.classList.replace("bx-menu" ,"bx-menu-alt-right");
            //     }else
            //         sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
            // }
            // function changeToggle(domea){
            //     const dome = (domea===1)?0:1;
            //     $.ajax({
            //         url:'../controller/mmshightech/processor.php',
            //         type:'post',
            //         data:{dome:dome},
            //         success:function(e){
            //             console.log(e);
            //             if(e.length>1){
            //                 $(".processing").attr("style","padding:5px 5px;color:red;text-align:center;").html(e);
            //             }
            //             else{
            //                 $(".processing").attr("style","padding:5px 5px;color:green;text-align:center;border:1px solid green;").html("Signing onto to your account..");
            //                 window.location=("./spaza");
            //             }
            //         }
            //     });
            // }
            // function domeSmallModal(filename,request){
            //     $.ajax({
            //         url:'../model/'+filename+'.php',
            //         type:'post',
            //         data:{'request':request},
            //         beforeSend:function(){
            //             $(".smallModal").html("<img style='width:10%;' src='../img/loader.gif'><h5 style='color:green;'>Fetching Data..</h5>");
            //         },
            //         success:function(e){
            //             // console.log(e);
            //             $(".smallModal").html(e);
            //         }
            //     });
            //     $("#smallModal").modal("show");
            // }
            function creditRequestAmount(maxAmount,clientUserId){
                let requestAmount=parseFloat($(".creditRequestAmount").val());
                if(requestAmount>0 && requestAmount>maxAmount){
                    $(".responseError").removeAttr('hidden').attr("style","color:red;").html("Cannot exceed available amount : "+maxAmount);
                    $("#badgeDome").removeClass("badge-primary").addClass("badge-secondary").attr("disabled","true").removeAttr("onclick");
                }
                else{
                    if(requestAmount>0){
                        const tax = parseFloat(requestAmount*0.15);
                        const interest= parseFloat(requestAmount*0.30);
                        const systemFee = parseFloat(5.00);
                        const rr=(requestAmount+tax+interest+systemFee).toFixed(2);
                        $(".responseError").removeAttr('hidden').attr("style","color:green;").html("Payable Amount: R"+ rr+" Tax : R"+(requestAmount*0.15)+" Intertest : R"+requestAmount*0.30+" Fee: R"+systemFee);
                        $("#badgeDome").removeClass("badge-secondary").addClass("badge-primary").removeAttr("disabled").attr("onclick","sendCreditRequest("+maxAmount+","+clientUserId+")");
                    }   
                }
            }
            function creditPaymentRequestAmount(payableAmount,clientUserId){
                let creditPaymentRequestAmount=parseFloat($(".creditPaymentRequestAmount").val());
                if(creditPaymentRequestAmount>0 && creditPaymentRequestAmount>payableAmount){
                    $(".repaymentResponseError").removeAttr('hidden').attr("style","color:red;").html("Cannot exceed available amount : "+payableAmount);
                    $("#sendCreditPaymentRequest").removeClass("badge-primary").addClass("badge-secondary").attr("disabled","true").removeAttr("onclick");
                }
                else{
                    if(creditPaymentRequestAmount>0){
                        
                        const rr=(payableAmount-creditPaymentRequestAmount).toFixed(2);
                        if(rr<0){
                            $(".repaymentResponseError").removeAttr('hidden').attr("style","color:red;").html("Cannot exceed Payable amount: R"+payableAmount);
                            $("#sendCreditPaymentRequest").removeClass("badge-primary").addClass("badge-secondary").attr("disabled","true").removeAttr("onclick");
                        }
                        else{
                            $(".repaymentResponseError").removeAttr('hidden').attr("style","color:green;").html("Payable amount left: R"+rr);
                            $("#sendCreditPaymentRequest").removeClass("badge-secondary").addClass("badge-primary").removeAttr("disabled").attr("onclick","sendCreditPaymentRequest("+payableAmount+","+clientUserId+")");
                        }
                    }   
                }
            }
            function sendCreditPaymentRequest(re_payment_payableAmount,re_payment_clientUserId){
                const re_payment_Payment=$(".creditPaymentRequestAmount").val();
                if(re_payment_Payment=="" || re_payment_Payment<0){
                    $(".repaymentResponseError").removeAttr('hidden').attr("style","color:red;").html("Field required to be > 0");
                }
                else if(re_payment_Payment>re_payment_payableAmount){
                    $(".responseError").removeAttr('hidden').attr("style","color:red;").html("Field Must be < "+re_payment_payableAmount);
                }
                else{
                    const url="../../routes/adminRequests.php";
                    $(".repaymentResponseError").removeAttr("hidden").attr("style","padding:10px 10px;width:100%;color:green;").html("<img style='width:10%;' src='../../img/loader.gif'><h5 style='color:green;'>Processing Request..</h5>");
                    $.ajax({
                        url:url,
                        type:'post',
                        data:{'re_payment_payableAmount':re_payment_payableAmount,'re_payment_clientUserId':re_payment_clientUserId,'re_payment_Payment':re_payment_Payment},
                        beforeSend:function(){
                            $(".repaymentResponseError").html("<img style='width:10%;' src='../../img/loader.gif'><h5 style='color:green;'>Fetching Data..</h5>");
                        },
                        success:function(e){
                            response = JSON.parse(e);
                            if(response['responseStatus']==='S'){
                                $(".repaymentResponseError").removeAttr("hidden").attr("style","padding:10px 10px;width:100%;color:green;").html("Request Successful");
                                openUserOnCredit(re_payment_clientUserId);
                            }
                            else{
                                $(".repaymentResponseError").removeAttr("hidden").attr("style","padding:10px 10px;width:100%;color:green;").html(response['responseMessage']);
                            }
                        }
                    });
                }
            }
            function sendCreditRequest(maxAmount,clientUserId){
                const requestAmount=$(".creditRequestAmount").val();
                if(requestAmount==""||requestAmount<1){
                    $(".responseError").removeAttr('hidden').attr("style","color:red;").html("Field required to be > 0");
                }
                else if(requestAmount>maxAmount){
                    $(".responseError").removeAttr('hidden').attr("style","color:red;").html("Field Must be < "+maxAmount);
                }
                else{
                    const url="../../routes/adminRequests.php";
                    $(".responseError").removeAttr("hidden").attr("style","padding:10px 10px;width:100%;color:green;").html("<img style='width:10%;' src='../../img/loader.gif'><h5 style='color:green;'>Processing Request..</h5>");
                    $.ajax({
                        url:url,
                        type:'post',
                        data:{'requestAmount':requestAmount,'maxAmount':maxAmount,'clientUserId':clientUserId},
                        beforeSend:function(){
                            $(".responseError").html("<img style='width:10%;' src='../../img/loader.gif'><h5 style='color:green;'>Fetching Data..</h5>");
                        },
                        success:function(e){
                            response = JSON.parse(e);
                            if(response['responseStatus']==='S'){
                                $(".responseError").removeAttr("hidden").attr("style","padding:10px 10px;width:100%;color:green;").html("Request Successful");
                                openUserOnCredit(clientUserId);

                            }
                            else{
                                $(".responseError").removeAttr("hidden").attr("style","padding:10px 10px;width:100%;color:green;").html(response['responseMessage']);
                            }
                        }
                    });
                }
            }
            function domeSquareModal(filename,request){
                $.ajax({
                    url:'../../src/forms/admin/'+filename+'.php',
                    type:'post',
                    data:{'request':request},
                    beforeSend:function(){
                        $(".showlargeModal").html("<img style='width:10%;' src='../../img/loader.gif'><h5 style='color:green;'>Fetching Data..</h5>");
                    },
                    success:function(e){
                        // console.log(e);
                        $(".showlargeModal").html(e);
                    }
                });
                $("#largeModal").modal("show");
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
