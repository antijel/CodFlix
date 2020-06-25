<?php

require_once( 'model/user.php' );

/****************************
* ----- LOAD SIGNUP PAGE -----
****************************/

function signupPage() {

  $user     = new stdClass();
  $user->id = isset( $_SESSION['user_id'] ) ? $_SESSION['user_id'] : false;

  if( !$user->id ):
    require('view/auth/signupView.php');
  else:
    require('view/homeView.php');
  endif;

}

/***************************
* ----- SIGNUP FUNCTION -----
***************************/

function verificationSignUpForm($post ) {

  $data = new stdClass();
  $data->email = $post['email'];
  $data->password = crypt($post['password'],'SHA-2256');
  $data->password_confirm = crypt($post['password_confirm'],'SHA-2256');

  $user           = new User( $data );
  $userData       = $user-> createUser();
}