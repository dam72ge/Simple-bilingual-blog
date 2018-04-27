<?php
$url="../../../"; 
$urlAdm="../../../cfg/adm/";

include "../../../cfg/mydb.php";
require_once "../../../cfg/class_layout.php"; $myobj=new pagina;
require_once "../../../cfg/class_admin.php"; $mysql=new mysql;

if ($_POST['osc']!="r") {
$nomeFile=$_POST['oldFile'];
$cart=$url."images/";


	// file
	if($_FILES['newFile']['tmp_name']!=""){

		// salva nuovo file
		$nomeFile = $_FILES['newFile']['name'];
		$target_file = $cart . basename($_FILES['newFile']['name']);
		move_uploaded_file($_FILES['newFile']['tmp_name'], $target_file);
		
		// cancella oldFile
		$urlFile=$url."images/".$_POST['oldFile'];
		if (file_exists($urlFile)) { unlink($urlFile);}   
		
	}


// aggiorna
$titleIT=$myobj->charset_decode_utf_8 ($_POST['titleIT']);
$titleEN=$myobj->charset_decode_utf_8 ($_POST['titleEN']);

	$sql="UPDATE foto SET  
            titleIT='".mysqli_real_escape_string($conn,stripslashes($titleIT))."', 
            titleEN='".mysqli_real_escape_string($conn,stripslashes($titleEN))."', 
            osc='".stripslashes($_POST['osc'])."', 
            data='".stripslashes($_POST['data'])."',
            idAlbum='".stripslashes($_POST['idAlbum'])."',
            file='".stripslashes($nomeFile)."'
    WHERE idFoto='".$_POST['idFoto']."'";
    $query=mysqli_query($conn,$sql);

	// redir
	$redirpag=$urlAdm."modif_img.php?idFoto=".$_POST['idFoto'];
}
else{
// rimuovi post

	$urlFile=$url."images/".$_POST['oldFile'];
	if (file_exists($urlFile)) { unlink($urlFile);}   	
	$sql="DELETE FROM foto WHERE idFoto='".$_POST['idFoto']."'";
    $query=mysqli_query($conn,$sql);
	
	// redir
	$redirpag=$url."cfg/index.php";
}

header("location: $redirpag");
?>

