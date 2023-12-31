<?php
if(isset($_GET['login'])){
    include_once ("../src/forms/login.php");
}
elseif (isset($_GET['createAccount'])){
    include_once ("../src/forms/register.php");
}
elseif (isset($_GET['verifyAccount'])){
    include_once ("../src/forms/verifyAccount.php");
}
else{
    echo"UNKNOWN REQUEST";
}
?>
