<?php
define ('UA_SEED','WEBAPP');
// apri sessione e controlla dati
session_start();
// controllo sicurezza
if (!isset($_SESSION['user_agent'])){ $_SESSION['user_agent']=md5($_SERVER['HTTP_USER_AGENT'].UA_SEED);}
   else{
     if ($_SESSION['user_agent']!=md5($_SERVER['HTTP_USER_AGENT'].UA_SEED)){
     // violazione sicurezza!
     header ("location: logout.php");
     }
   }
if (!isset($_SESSION['username']) | $_SESSION['username'] != 'admin') {
session_destroy();
// effettua redirect
header ("location: logout.php");
}


$url="../"; 
$urlAdm="../cfg/adm/";

// carica elementi comuni layout
require_once "class_layout.php"; $myobj=new pagina;
require_once "class_admin.php"; $mysql=new mysql;

$my=$url."cfg/mydb.php";
include $my;

$title="Admin"; $fold="admin";
include "adm/head.php";
?>

<!-- PAGINA ADMIN -->
<div class="w3-container">
<br/><br/><br/>

<div class="container-fluid">
	<h1>Welcome</h1>
	<br/><br/><hr/>
	<?php
	print "<i>Datetime</i>: ".date("Y-m-d H:i:s - D");
	?>
	</p>
	<br/><hr/><br/>

	<div class="row">
		
		<div class="col-sm-4"> 
		<h2>Select post</h2>
		<p>Post in descending chronological order<br/><br/>
		<?php
		$mysql->lista_post($urlAdm,$conn,"ORDER BY idArt DESC");  
		?>
		</p>

		</div>
		<div class="col-sm-4"> 
		<h2>Select comments</h2>
		<p>Legenda: A=to be authorized, N=ok, S=obscured<br/><br/>
		<?php
		$mysql->lista_commenti($urlAdm,$conn,"ORDER BY osc ASC, idComm DESC");  
		?>
		</p>
		</div>

		<div class="col-sm-4"> 
		<h2>Select album</h2>
		<p>Album in ID order<br/><br/>
		<?php
		$mysql->lista_album($urlAdm,$conn,"ORDER BY idAlbum ASC");  
		?>
		</p>
		</div>
		
	</div>
	<div class="row">
		<div class="col-sm-12"> 
		<br/><br/><br/>
		<h2>Select pic</h2>
		<p>Images in alphabetical order of album<br/><br/>
		<?php
		$mysql->lista_foto($url,$urlAdm,$conn);  
		?>
		</p>
		</div>
	
	</div>


	<br/><hr/><br/>

</div>

<?php
include "adm/footer.php";
?>
