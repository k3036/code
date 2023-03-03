<?php

        include "virtualRealityInquiryHeader.php";

?>
<?php
include("DatabaseConnectionForLoginInformationRegistration.php");
include("DatabaseImageRegistrationProcess.php");

$file = $_FILES["img"] ;
$fileName = basename($file["name"]) ;
$tmp_path = $file["tmp_name"] ;
$file_err = $file["error"] ;
$fileSize = $file["size"] ;

$imageSaveFile = './SaveImage/imageSaveFile/imageStorageCenter';
$imageSaveFile = './SaveImage/imageSaveFile/imageStorageCenter';
$upload_dir = $imageSaveFile ;
$save_fileName = date("YmdHis") . $fileName ;
$err_msgs = array();
$save_pass = $upload_dir . $save_fileName ;


$caption = filter_input(INPUT_POST,"caption",FILTER_SANITIZE_SPECIAL_CHARS) ;



if(empty($caption)){

        array_push( $err_msgs ,"キャプションを入力してください。" ) ;

}


if(strlen($caption) > 140){

        array_push( $err_msgs, "キャプションは140文字以内で入力してください。" ) ;

}else if(empty($caption)){

        array_push( $err_msgs ,"キャプションが入力されていません。" ) ;

}


if($fileSize>1048576 || $file_err == 2){

        array_push( $err_msgs ,'ファイルサイズは1MB未満にしてください。' ) ;

}

$allow_ext = array("jpg","jpeg","png") ;
$file_ext = pathinfo($fileName, PATHINFO_EXTENSION) ;

if(!in_array(strtolower($file_ext),$allow_ext)){

        array_push( $err_msgs , "画像ファイルを添付してください。" ) ;

}

if(count($err_msgs)===0){



        if(is_uploaded_file($tmp_path)){

                if( move_uploaded_file ($tmp_path,$save_pass)){

                        echo $fileName . 'を'. $upload_dir .'へアップしました。' ;
                        $result = fileSave( $fileName , $save_pass ,$caption );
                        ?><p class="btn btn-outline-secondary">
  <button type=“button” onclick="location.href='upload_form.php'">Image
    UploadPage</button>
</p><?php
if($result){


exit();

}else{
echo "アップロードが失敗しました！" ;
}

}else{

echo 'アップロードが失敗しました！' ;

}

}else{

echo "画像が選択されていません。" ;

}

}else{

foreach( $err_msgs as $msg ){//エラーがある場合はここで出力

echo $msg ;
echo "</br>" ;

}

}

?>