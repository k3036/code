<?php

include("DatabaseConnectionForLoginInformationRegistration.php");
class AdministratorLogic{


  public static function AdministratorRegistration($data) {

    $result = false ;

    $sql = 'INSERT INTO ManagementScreenSecurity ( name, email, password )VALUES(?,?,?)';

    $arr = [];
    $arr[] = $data['username'] ;
    $arr[] = $data['email'] ;
    $arr[] = password_hash( $data['password'] , PASSWORD_DEFAULT  ) ;

    try{

      $stmt  = connect()->prepare($sql);
      $result = $stmt -> execute($arr);
      return $result ;

    }catch(\Exception $e){

      return $result ;

    }




  }


/**
 * Summary of LoginProcess
 * @param string $email
 * @param string $password
 * @return bool  $result
 */
public static function LoginProcess ( $email , $password ){


    $result = false;

    $user = self :: getUserByEmail( $email );

    if(!$user){

      $_SESSION['msg'] = 'emailが一致しません。';
          return $result  ;

    }



    if(password_verify($password,$user['password'])){

      $_SESSION['login_user'] = $user ;
      $result = true ;
      return $result ;

      }

      $_SESSION['msg'] = 'パスワードが一致しません。';
      return $result  ;

}

/**
 * Summary of LoginProcess
 * @param string $email
 * @return bool  $user| false
 */
public static function getUserByEmail ( $email ){


    $sql = 'SELECT * FROM ManagementScreenSecurity WHERE email = ?';

    $arr = [];
    $arr[] = $email ;


    try{

      $stmt  = connect()->prepare($sql);
      $stmt -> execute($arr);

      $user = $stmt -> fetch() ;
      return $user ;

    }catch(\Exception $e){

      return $user ;

    }

}

}