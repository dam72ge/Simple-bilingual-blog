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
    INSERT INTO articoli
    (idArt,osc, titleIT, titleEN, datetime, dateday, testoIT, testoEN, idFoto, tagIT,tagEN, idAlbum, file) 
    VALUES 
    ( 
    null,
    '".stripslashes($_POST['osc'])."',
    '".mysqli_real_escape_string($conn,stripslashes($titleIT))."',
    '".mysqli_real_escape_string($conn,stripslashes($titleEN))."',
    '".stripslashes($_POST['datetime'])."',
    '".stripslashes($_POST['dateday'])."',
    '".mysqli_real_escape_string($conn,stripslashes($testoIT))."',
    '".mysqli_real_escape_string($conn,stripslashes($testoEN))."',
    '0',
    '".mysqli_real_escape_string($conn,stripslashes($_POST['tagIT']))."',
    '".mysqli_real_escape_string($conn,stripslashes($_POST['tagEN']))."',
    '".$_POST['idAlbum']."',
    '".mysqli_real_escape_string($conn,stripslashes($_POST['file']))."'
    )";
    
    $query=mysqli_query($conn,$sql);

    // id nuovo
   	$idNuovo=mysqli_insert_id($conn);

	// redir
	$redirpag=$urlAdm."modif_post.php?idArt=".$idNuovo;
	if ($_POST['salv']=="index"){ $redirpag=$url."cfg/index.php"; }

	header("location: $redirpag");

?>
