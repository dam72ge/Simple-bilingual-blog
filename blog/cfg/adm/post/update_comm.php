<?php
$url="../../../"; 
$urlAdm="../../../cfg/adm/";

include "../../../cfg/mydb.php";
require_once "../../../cfg/class_layout.php"; $myobj=new pagina;
require_once "../../../cfg/class_admin.php"; $mysql=new mysql;

if ($_POST['osc']!="r") {
// aggiorna
$testo=$myobj->charset_decode_utf_8 ($_POST['testo']);
$autore=$myobj->charset_decode_utf_8 ($_POST['autore']);
$email=$myobj->charset_decode_utf_8 ($_POST['email']);

	$sql="UPDATE commenti SET  
            autore='".mysqli_real_escape_string($conn,stripslashes($autore))."', 
            email='".mysqli_real_escape_string($conn,stripslashes($email))."', 
            testo='".mysqli_real_escape_string($conn,stripslashes($testo))."', 
            osc='".stripslashes($_POST['osc'])."', 
            data='".stripslashes($_POST['data'])."', 
            idArt='".stripslashes($_POST['idArt'])."',
            streppa='".stripslashes($_POST['streppa'])."'
    WHERE idComm='".$_POST['idComm']."'";
    $query=mysqli_query($conn,$sql);

	// redir
	$redirpag=$urlAdm."modif_comm.php?idComm=".$_POST['idComm'];
}
else{
// rimuovi post
	$sql="DELETE FROM commenti WHERE idComm='".$_POST['idComm']."'";
    $query=mysqli_query($conn,$sql);
	
	// redir
	$redirpag=$url."cfg/index.php";
}

header("location: $redirpag");
?>

