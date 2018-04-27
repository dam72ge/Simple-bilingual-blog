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
	$allegato="";
	if ($_POST['file']!="") {$allegato=$myobj->mb_convert_encoding($_POST['file']);}

	$sql="UPDATE articoli SET  
            titleIT='".mysqli_real_escape_string($conn,stripslashes($titleIT))."', 
            titleEN='".mysqli_real_escape_string($conn,stripslashes($titleEN))."', 
            testoIT='".mysqli_real_escape_string($conn,stripslashes($testoIT))."', 
            testoEN='".mysqli_real_escape_string($conn,stripslashes($testoEN))."', 
            osc='".stripslashes($_POST['osc'])."', 
            datetime='".stripslashes($_POST['datetime'])."', 
            dateday='".stripslashes($_POST['dateday'])."', 
            idFoto='".stripslashes($_POST['idFoto'])."', 
            tagIT='".mysqli_real_escape_string($conn,stripslashes($_POST['tagIT']))."', 
            tagEN='".mysqli_real_escape_string($conn,stripslashes($_POST['tagEN']))."',
            idAlbum='".stripslashes($_POST['idAlbum'])."',
            file='".mysqli_real_escape_string($conn,stripslashes($allegato))."' 
    WHERE idArt='".$_POST['idArt']."'";

//print $sql; break;


    $query=mysqli_query($conn,$sql);

	// redir
	$redirpag=$urlAdm."modif_post.php?idArt=".$_POST['idArt'];
}
else{
// rimuovi post
	$sql="DELETE FROM articoli WHERE idArt='".$_POST['idArt']."'";
    $query=mysqli_query($conn,$sql);
	
	// redir
	$redirpag=$url."cfg/index.php";
}

header("location: $redirpag");
?>

