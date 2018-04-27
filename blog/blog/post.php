<?php
$url="../"; 
include "../cfg/mydb.php";

// carica elementi comuni layout
require_once "../cfg/class_layout.php"; $myobj=new pagina;
require_once "../cfg/class_blog.php"; $myblg=new myblg;

// riconosci idArt

$idArt=0;
$titleEN="";
$titleIT="";

if(isset($_GET['idArt']) && $_GET['idArt']>0){

	$sql="SELECT idArt,titleEN, titleIT FROM articoli WHERE osc='n'";
	$result = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {	

		if ($_GET['idArt']==$row['idArt']){ 
			$idArt=$row['idArt']; 
			
			// codifica utf8
				$titleEN=$myobj->mb_convert_encoding($row['titleEN']);
				$lunghezza=strlen($titleEN);
				if ($lunghezza>75){ $titleEN=substr($titleEN,0,500); $titleEN.="..."; }
			// codifica utf8
				$titleIT=$myobj->mb_convert_encoding($row['titleIT']);
				$lunghezza=strlen($titleIT);
				if ($lunghezza>75){ $titleIT=substr($titleIT,0,500); $titleIT.="..."; }
		}

	}
}

if($idArt==0){
	$redirpag=$url."blog/notfound.php";
	header("location: $redirpag");
}






/*
if(!isset($_GET['idArt']) | $_GET['idArt']<=0){
	$redirpag=$url."blog/index.php";
	header("location: $redirpag");
}
$idArt=$_GET['idArt'];
*/





$title="Streppacugge | "; $fold="blog";

include "../cfg/head.php";
?>
	
<!-- Page Content -->
<div class="container-fluid" style="background: #eee url('../lay/carta02.jpg') repeat">

	<div class="row">

        <!-- Blog Entries Column -->
        <div class="col-sm-8">
		<br/><br/><br/>

			<div class="index-content" style="margin:0; padding:0">
			<?php
			$myblg->post($idArt,$url,$conn,$ling,$lang);
			$myblg->comm_form($idArt,$ling);
			?>
			</div>
	
		</div>

        <!-- Sidebar Widgets Column -->
        <div class="col-sm-4">
		<br/><br/><br/>
		
			<!-- Posts -->
		<?php
		$where="WHERE OSC='n' AND idArt!='".$idArt."' ORDER BY idArt DESC LIMIT 0,15";
		$myblg->menu_post($conn,$ling,$where);
		?>
		
			<!-- Labels / keys -->
			<?php
			$myobj->print_keys($url,$conn,$ling,15,"Keys");
			?>
		
		</div>

	<!-- END row-->
	</div>

<!-- END container-->
</div>


<?php
include "../cfg/footer.php";
?>
