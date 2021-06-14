<?php
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASSWORD", "");
define("DB_DATABASE", "grootan");
$connect = mysqli_connect(DB_SERVER , DB_USER, DB_PASSWORD);
mysqli_query($connect,"CREATE database ".DB_DATABASE." ;");
mysqli_select_db($connect, DB_DATABASE);
if ($connect->connect_error) {
  die("Connection failed: " . $connect->connect_error);
}
if(isset($_POST['import'])){
  $password_sections=array();
  $cryptkey="Grootan";
  $file=$_FILES['file']['tmp_name'];
  $filename=explode('.',$_FILES['file']['name'])[0];
  $filename = preg_replace( '/[\W]/', '', $filename);
  $handle=fopen($file,"r");
  $fileopen=fgetcsv($handle,10000,",");
  $headers=$fileopen;
  $sql = "CREATE TABLE $filename ( " ;
    foreach ($headers as $key => $value) {
    if ($value=="password"){
    array_push($password_sections,$key);
    }
    $value=preg_replace( '/[\W]/', '', $value);
    $sql=$sql."$value VARCHAR(200),";
    }
    $sql=rtrim($sql,",");
    $sql=$sql.");";
    mysqli_query($connect,$sql);
    while(($fileopen=fgetcsv($handle,10000,","))!==false){
      $sql="insert into $filename values(";
      foreach ($fileopen as $key => $value) {
        if (in_array($key,$password_sections)){
          $value=openssl_encrypt($value,"AES-128-ECB",$cryptkey);
        }
        $sql=$sql."'$value',";
      }
      $sql=rtrim($sql,",");
      $sql=$sql.");";
      $result=mysqli_query($connect,$sql);
    }
    if(!$result){
      echo "CSV file imported to databse";
    }
    else{
      echo "unable to import csv file";
    }
    mysqli_close($connect);
  }
  ?>
