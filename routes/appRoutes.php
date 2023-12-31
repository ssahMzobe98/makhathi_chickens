<?php
if(isset($_GET['getRequest'])){
    switch ($_GET['getRequest']){
        case "home":
            include_once ("../src/forms/home.php");
            break;
        case "cart":
            include_once ("../src/forms/cart.php");
            break;
        case "myorders":
            include_once ("../src/forms/myorders.php");
            break;
        case "settings":
            include_once ("../src/forms/settings.php");
            break;
        default:
            include_once ("../src/forms/home.php");
    }
}
else{
    echo"UNKNOWN REQUEST";
}
?>
