<?php
session_start();

include("accessAdminKey.php");


$err = [] ;


if(!$email = filter_input(INPUT_POST,'email')){

  $err['email'] = "メールアドレスを入力してください。" ;

}

if(!$password = filter_input(INPUT_POST, 'password')){
  $err['password'] = "パスワードを入力してください。" ;
}

if( count($err) > 0 ){
echo "OUT" ;

  $_SESSION = $err ;
  header('Location: adminEntrance.php');
  return ;

}


$result = AdministratorLogic :: LoginProcess ( $email , $password ) ;


if(!$result){

echo"ログイン失敗です。" ;
  return ;

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>管理者登録完了画面</title>
  <link href="virtualRealityInquiry.css" rel="stylesheet">


  <link href="bootstrap.min.css" rel="stylesheet">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

  <script src="bootstrap.min.js"></script>
</head>

<body>
  <?php
    include "virtualRealityInquiryHeader.php";
    ?>
  <div class=" AdminLoginPageCentered ">
    <?php if(count($err)>0): ?>
    <?php foreach($err as $e): ?>
    <?php echo $e ?>
    <?php endforeach; ?>
    <?php else : ?>
    <button onclick="location.href='inquiryManagementScreen.php'">管理者画面へ</button>
    <?php endif ?> <br>
    <a href="adminEntrance.php">戻る</a>
  </div>
  <?php
    include "virtualRealityInquiryFooter.php";
    ?>
</body>

</html>