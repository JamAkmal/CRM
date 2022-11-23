<?php
session_start();

//logout condition

if( $_POST['action'] == "logout")  {
    session_unset();
    session_destroy();
    echo 'logout';
}else{
    echo 'logout_error';
}
