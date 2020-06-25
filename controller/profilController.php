<?php

require_once( 'model/user.php' );

/***************************
* ----- LOAD HOME PAGE -----
***************************/

function profil() {

    $mail = isset( $_POST['mail'] ) ? $_POST['mail'] : null;
    $password = isset( $_POST['password'] ) ? $_POST['password'] : null;
    $old_password = isset( $_POST['old_password'] ) ? $_POST['old_password'] : null;
    $old_password = crypt($old_password,'SHA-256');
    $supp = isset( $_POST['supp'] ) ? $_POST['supp'] : null;

    $message = null;

    // IF user deleted his account then go back to home
    if(isset($_POST['supp'])){
        $message = User::deleteUser($password, $old_password);

        if($message == 'OK'){
        ?>  
        
        <script type="text/javascript">
            window.location = "index.php?action=login"
        </script>

        <?php 
        }

    // IF user wants to modify his account
    }else{
        //IF user wants to change his mail or his password
        if(isset($mail) || isset($password)){
            $message = User::changeUserLogin($mail, $password, $old_password);
        }   
      
    }
    $user     = new stdClass();
    $user->id = isset( $_SESSION['user_id'] ) ? $_SESSION['user_id'] : false;
        
    $profilData = User::getUserById( $user->id );

    require('view/profilView.php');


}