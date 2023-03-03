<?php

  include("DatabaseConnectionForLoginInformationRegistration.php");
  include("DatabaseImageRegistrationProcess.php");
  $files = getAllFile();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>アップロードフォーム</title>
  <link rel="stylesheet" href="virtualRealityInquiry.css">
</head>
<?php
    include "virtualRealityInquiryHeader.php";
    ?>

<body>
  <form enctype="multipart/form-data" action="file_upload.php" method="POST">
    <diV class="file-up">
      <input type="hidden" name="MAX_FILE_SIZE" value="1048576" /></input>
      <p class="btn btn-outline-secondary"><input type="file" name="img" accept="image/*" /> </input></p>
    </div>
    <diV>
      <textarea class="PlaceOfPost" name="caption" placeholder="キャプション(140文字以下)" id="caption"></textarea>
    </div>
    <div class="SendButtonMove">
      <p class="btn btn-outline-primary"> <input type="submit" value="送信" class="btn"></input></p>
    </div>
  </form>
  <div>
    <?php foreach($files as $file): ?>
    <img class="imageSizeInVr" src="<?php echo "{$file['file_path']}" ; ?>" alt=""></img>
    <p class="imageSizeInVr"><?php echo h("{$file['description']}") ; ?></p>
    <?php  endforeach;  ?>
  </div>
  <?php
    include "virtualRealityInquiryFooter.php";
    ?>
</body>

</html>