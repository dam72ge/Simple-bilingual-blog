<?php
$url="../../../"; 
$urlAdm="../../../cfg/adm/";

include "../../../cfg/mydb.php";
require_once "../../../cfg/class_layout.php"; $myobj=new pagina;
require_once "../../../cfg/class_admin.php"; $mysql=new mysql;

if ($_POST['osc']!="r") {
// aggiorna
$titleIT=$myobj->charset_decode_utf_8 ($_POST['titleIT']);
$titleEN=$myobj->charset_decode_utf_8 ($_POST['titleEN']);
$testoIT=$myobj->charset_decode_utf_8 ($_POST['testoIT']);
$testoEN=$myobj->charset_decode_utf_8 ($_POST['testoEN']);

	$sql="UPDATE album SET  
            titleIT='".mysqli_real_escape_string($conn,stripslashes($titleIT))."', 
            titleEN='".mysqli_real_escape_string($conn,stripslashes($titleEN))."', 
            testoIT='".mysqli_real_escape_string($conn,stripslashes($testoIT))."', 
            testoEN='".mysqli_real_escape_string($conn,stripslashes($testoEN))."', 
            osc='".stripslashes($_POST['osc'])."', 
            idFoto='".stripslashes($_POST['idFoto'])."',
            data='".stripslashes($_POST['data'])."'
    WHERE idAlbum='".$_POST['idAlbum']."'";
    $query=mysqli_query($conn,$sql);

	// redir
	$redirpag=$urlAdm."modif_album.php?idAlbum=".$_POST['idAlbum'];
}
else{
// rimuovi post
	$sql="DELETE FROM album WHERE idAlbum='".$_POST['idAlbum']."'";
    $query=mysqli_query($conn,$sql);
	
	// redir
	$redirpag=$urlAdm."index.php";
}

header("location: $redirpag");
?>

