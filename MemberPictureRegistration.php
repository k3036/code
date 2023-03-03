<?php

session_start();

include('loginLogic.php');

$err = [];

if(!$username = filter_input(INPUT_POST,'username')){
  $err['username'] = 'ユーザー名を記入して下さい。';
}
if(!$email = filter_input(INPUT_POST,'email')){
  $err['email'] = 'メールアドレスを記入して下さい。';
}
  $password = filter_input(INPUT_POST, 'password');

if(!preg_match("/\A[a-z\d]{1,10}+\z/i",$password)){
  $err['password'] = 'パスワードは英数字8文字以上10文字以下にして下さい。';
}
$password_conf = filter_input(INPUT_POST, 'password_conf');
if($password !== $password_conf){
  $err['password_conf'] = 'パスワードと確認用パスワードが異なっています。';
}

if(count($err)>0){


  $_SESSION = $err;
  header('Location: signupFromMember.php');
  return;

}

if(count($err)===0){


  $hasCreated = UserLogic::createUser($_POST);


  if(!$hasCreated){

    $err[] = '登録に失敗しました';

  }

}
?>
<!DOCTYPE html>
<html lang="ja">

<head>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=google">
  <meta name="viewport" content="width = device - width=device-width, initial-scale = 1.0">
  <title>ユーザー登録完了画面</title>


  <link href="bootstrap.min.css" rel="stylesheet">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

  <script src="bootstrap.min.js"></script>

</head>

<?php
    include "virtualRealityInquiryHeader.php";
    ?>

<body class="bg-info" class="AdminLoginPageCentered">
  <?php if(count($err)>0):?>
  <?php foreach($err as $e):?>
  <p class="bg-danger">
    <?php echo $e ?>
  <p>
    <?php endforeach; ?>
    <?php else : ?>
  <p class="text-center" class="container">ユーザー登録完了しました。</p>
  <?php endif ?>
  <a href="signupFromMember.php">戻る</a>

</body>

<?php
    include "virtualRealityInquiryFooter.php";
    ?>

</html>