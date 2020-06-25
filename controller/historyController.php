<?php

require_once( 'model/user.php' );

function history() {

    $user     = new stdClass();
    $user->id = isset( $_SESSION['user_id'] ) ? $_SESSION['user_id'] : false;
    $supp_id = isset( $_GET['supp'] ) ? $_GET['supp'] : null;

    //Delete media id from history of user
    if($supp_id !== null){      
        User::suppMediaFromHistory($supp_id);
    }

    //GET all history for user id
    $history = User::getHistory($user->id);  

    require('view/historyView.php');

}