<?php
$url="../../../"; 
$urlAdm="../../../cfg/adm/";
$cart="../../../images/";
$nomeFile="";

include "../../../cfg/mydb.php";
require_once "../../../cfg/class_layout.php"; $myobj=new pagina;
require_once "../../../cfg/class_admin.php"; $mysql=new mysql;

$titleIT=$myobj->charset_decode_utf_8 ($_POST['titleIT']);
$titleEN=$myobj->charset_decode_utf_8 ($_POST['titleEN']);

	// file
	if(isset($_FILES['file']['name'])){
		$nomeFile = basename($_FILES["file"]["name"]);
		$target_file = $cart . basename($_FILES["file"]["name"]);
		move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
	}

	// record
    $sql = 
    "
    INSERT INTO foto
    (idFoto,idAlbum,osc,data,titleIT,titleEN,file) 
    VALUES 
    ( 
    null,
    '".stripslashes($_POST['idAlbum'])."',
    '".stripslashes($_POST['osc'])."',
    '".stripslashes($_POST['data'])."',
    '".mysqli_real_escape_string($conn,stripslashes($_POST['titleIT']))."',
    '".mysqli_real_escape_string($conn,stripslashes($_POST['titleEN']))."',
    '".$nomeFile."'
    )";
    
    $query=mysqli_query($conn,$sql);

    // id nuovo
   	$idNuovo=mysqli_insert_id($conn);
	
	// redir
	$redirpag=$urlAdm."modif_img.php?idFoto=".$idNuovo;
	if ($_POST['salv']=="index"){ $redirpag=$url."cfg/index.php"; }
	header("location: $redirpag");

?>
