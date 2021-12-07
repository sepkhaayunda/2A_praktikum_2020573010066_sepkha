<?php
session_start();
if(!empty($_SESSION['username'])){
    session_destroy();
    echo "<script> window.location='../signin'; </script>";
}
elseif(empty($_SESSION['username'])){
    echo "<script> window.location='../signin'; </script>";
}
?>