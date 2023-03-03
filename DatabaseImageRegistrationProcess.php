<?php
/**
 * ファイルデータを保存
 * @param string $fileName ファイル名
 * @param string $save_pass 保存先のパス
 * @param string $caption 投稿の説明
 * @return bool $result
 */
function fileSave( $fileName , $save_pass ,$caption ){

  $result=false;

  $sql = "INSERT INTO file_table ( file_name,file_path,description )VALUE(?,?,?)" ;

  try{

    $stmt = connect() -> prepare($sql) ;
    $stmt  -> bindValue( 1,$fileName ) ;
    $stmt  -> bindValue( 2,$save_pass ) ;
    $stmt  -> bindValue( 3,$caption ) ;
    $result = $stmt -> execute() ;
    return $result ;

  }catch(\Exception $e){

    echo $e->getMessage() ;
    return $result ;

  }

}





/**
 * ファイルデータを取得
 * @return array $fileDate
 */


function getAllFile(){

      $sql = " SELECT * FROM file_table " ;
      $fileDate =  connect() -> query($sql);
      return $fileDate ;

}




function h($s){
    return htmlspecialchars($s, ENT_QUOTES,"UTF-8") ;
}