<?php

require_once( 'database.php' );

class User {

  protected $id;
  protected $email;
  protected $password;

  public function __construct( $user = null ) {

    if( $user != null ):
      $this->setId( isset( $user->id ) ? $user->id : null );
      $this->setEmail( $user->email );
      $this->setPassword( $user->password, isset( $user->password_confirm ) ? $user->password_confirm : false );
    endif;
  }

  /***************************
  * -------- SETTERS ---------
  ***************************/

  public function setId( $id ) {
    $this->id = $id;
  }

  public function setEmail( $email ) {

    if ( !filter_var($email, FILTER_VALIDATE_EMAIL)):
      throw new Exception( 'Email incorrect' );
    endif;

    $this->email = $email;

  }

  public function setPassword( $password, $password_confirm = false ) {

    if( $password_confirm && $password != $password_confirm ):
      throw new Exception( 'Vos mots de passes sont différents' );
    endif;

    $this->password = $password;
  }

  /***************************
  * -------- GETTERS ---------
  ***************************/

  public function getId() {
    return $this->id;
  }

  public function getEmail() {
    return $this->email;
  }

  public function getPassword() {
    return $this->password;
  }

  /***********************************
  * -------- CREATE NEW USER ---------
  ************************************/

  public function createUser() {

    // Open database connection
    $db   = init_db();

    // Check if email already exist
    $req  = $db->prepare( "SELECT * FROM user WHERE email = ?" );
    $req->execute( array( $this->getEmail() ) );

    if( $req->rowCount() > 0 ) throw new Exception( "Email ou mot de passe incorrect" );

    // Insert new user
    $req->closeCursor();

    $req  = $db->prepare( "INSERT INTO user ( email, password ) VALUES ( :email, :password )" );
    $req->execute( array(
      'email'     => $this->getEmail(),
      'password'  => $this->getPassword()
    ));

    // Close databse connection
    $db = null;

  }

  /**************************************
  * -------- GET USER DATA BY ID --------
  ***************************************/

  public static function getUserById( $id ) {

    // Open database connection
    $db   = init_db();

    $req  = $db->prepare( "SELECT * FROM user WHERE id = ?" );
    $req->execute( array( $id ));

    // Close databse connection
    $db   = null;

    return $req->fetch();
  }

  /***************************************
  * ------- GET USER DATA BY EMAIL -------
  ****************************************/

  public function getUserByEmail() {

    // Open database connection
    $db   = init_db();

    $req  = $db->prepare( "SELECT * FROM user WHERE email = ?" );
    $req->execute( array( $this->getEmail() ));

    // Close databse connection
    $db   = null;

    return $req->fetch();
  }

    //Add media to history of user
    public static function addHistory( $id, $user_id ) {

      $db   = init_db();
  
      $req  = $db->prepare( "SELECT * FROM history WHERE media_id = ".$id." AND user_id = ".$user_id );
      $req->execute();
  
      if($req->fetchAll() == null){// IF media is NOT in history of user
  
        $req  = $db->prepare( "INSERT INTO `history`(`user_id`, `media_id`, `start_date`) VALUES (".$user_id.",".$id.",'".date('Y-m-d')."')" );
        $req->execute();
  
      }else{  // IF media is in history of user
  
        $req  = $db->prepare( "UPDATE `history` SET `start_date`= ".date('Y-m-d')." WHERE `id` = ".$id." AND `user_id` = ".$user_id );
        $req->execute();
  
      }
  
    
      $db   = null;
    
      return $req->fetchAll();
      
    }
  
    //Get history of user_id
    public static function getHistory( $user_id ) {
  
      $db   = init_db();
    
      $req  = $db->prepare( "SELECT * FROM `history`, `media` WHERE history.media_id = media.id AND user_id = ".$user_id );
      $req->execute( array( '%' . $user_id . '%') );
  
      $db   = null;
  
      return $req->fetchAll();
    
    }

    //Get history of user_id
    public static function suppMediaFromHistory( $id_histo ) {

      $user     = new stdClass();
      $user->id = isset( $_SESSION['user_id'] ) ? $_SESSION['user_id'] : false;
  
      $db   = init_db();

      if($id_histo == 0){

        $req  = $db->prepare( "DELETE FROM `history` WHERE user_id = ".$user->id );
        $req->execute( array( '%' . $id_histo . '%') );

      }else{

        $req  = $db->prepare( "DELETE FROM `history` WHERE id = ".$id_histo );
        $req->execute( array( '%' . $id_histo . '%') );

      }
      
      $db   = null;
      
      return $req->fetchAll();
        
    }

    //Get history of user_id
    public static function changeUserLogin( $mail , $password, $old_password) {

      $user     = new stdClass();
      $user->id = isset( $_SESSION['user_id'] ) ? $_SESSION['user_id'] : false;
      
      $db   = init_db();

      $req  = $db->prepare("SELECT password FROM user WHERE id = $user->id");
      $req->execute();
      $current_password = $req->fetch();
      

      if($mail !== null){
    
        $req  = $db->prepare("UPDATE user SET email = '$mail' WHERE id = $user->id ");
        $req->execute();

        $reponse = 'Mail modifié';
      }
      

      if($password !== null ){
        if($old_password == $current_password[0]){
          $reponse = 'Mot de passe modifié';
          $cryptedPassword = crypt($password,'SHA-256');
      
          $req  = $db->prepare( "UPDATE user SET password = '$cryptedPassword' WHERE id = $user->id");
          $req->execute();
        }else{
          $reponse = 'Ancien mot de passe incorrect';
        }


      }         
          
      $db   = null;
          
      return $reponse;
            
    }

    public static function deleteUser( $password, $old_password) {
      $user     = new stdClass();
      $user->id = isset( $_SESSION['user_id'] ) ? $_SESSION['user_id'] : false;

      $db   = init_db();

      $req  = $db->prepare("SELECT password FROM user WHERE id = $user->id");
      $req->execute();
      $current_password = $req->fetch();

      if($old_password == $current_password[0]){
        $req  = $db->prepare("DELETE FROM user WHERE id = $user->id ");
        $req->execute();
        $req  = $db->prepare("DELETE FROM history WHERE user_id = $user->id ");
        $req->execute();
        $reponse = 'Compte utilisateur supprimé';
        session_destroy();
      }else{
        $reponse = 'Ancien mot de passe incorrect';
      }

      $db   = null;

      

      return $reponse;
    }
    
}


