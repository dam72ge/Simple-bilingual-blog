<?php
$url="../../../"; 
$urlAdm="../../../cfg/adm/";

include "../../../cfg/mydb.php";
require_once "../../../cfg/class_layout.php"; $myobj=new pagina;
require_once "../../../cfg/class_admin.php"; $mysql=new mysql;

$titleIT=$myobj->charset_decode_utf_8 ($_POST['titleIT']);
$titleEN=$myobj->charset_decode_utf_8 ($_POST['titleEN']);
$testoIT=$myobj->charset_decode_utf_8 ($_POST['testoIT']);
$testoEN=$myobj->charset_decode_utf_8 ($_POST['testoEN']);

    $sql = 
    "
    INSERT INTO album
    (idAlbum,osc, titleIT, titleEN, data, idFoto, testoIT, testoEN) 
    VALUES 
    ( 
    null,
    '".stripslashes($_POST['osc'])."',
    '".mysqli_real_escape_string($conn,stripslashes($_POST['titleIT']))."',
    '".mysqli_real_escape_string($conn,stripslashes($_POST['titleEN']))."',
    '".stripslashes($_POST['data'])."',
    '0',
    '".mysqli_real_escape_string($conn,stripslashes($_POST['testoIT']))."',
    '".mysqli_real_escape_string($conn,stripslashes($_POST['testoEN']))."'
    )";
    
    $query=mysqli_query($conn,$sql);

    // id nuovo
   	$idNuovo=mysqli_insert_id($conn);

	// redir
	$redirpag=$urlAdm."modif_album.php?idAlbum=".$idNuovo;
	if ($_POST['salv']=="index"){ $redirpag=$url."cfg/index.php"; }
	header("location: $redirpag");
?>
