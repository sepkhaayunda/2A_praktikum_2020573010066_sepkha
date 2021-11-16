<?php
session_start();
if(!empty($_SESSION['username'])) {
    session_destroy();
    echo '<script>window.location="../sign-in/index.php"</script>';
} else {
    echo '<script>window.location="../sign-in/index.php"</script>';
}
?>