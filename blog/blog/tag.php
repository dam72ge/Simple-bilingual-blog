<?php
$url="../"; 
include "../cfg/mydb.php";

if(!isset($_GET['tag']) | $_GET['tag']==""){
	$redirpag=$url."blog/index.php";
	header("location: $redirpag");
}
$tag=$_GET['tag'];
$tag=stripslashes(trim($tag));

// carica elementi comuni layout
require_once "../cfg/class_layout.php"; $myobj=new pagina;
require_once "../cfg/class_blog.php"; $myblg=new myblg;



$title="Streppacugge | Blog | Tag: ".strtoupper($tag); $fold="blog";

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
			$where="WHERE OSC='n' AND tagEN LIKE '%".$tag."%' ORDER BY idArt DESC";
			if ($ling=="it"){ $where="WHERE OSC='n' AND tagIT LIKE '%".$tag."%' ORDER BY idArt DESC";}
			$myblg->blog($tag,$url,$conn,$ling,$lang,$where);
			?>
			</div>
	
		</div>

        <!-- Sidebar Widgets Column -->
        <div class="col-sm-4">
		<br/><br/><br/>
		
			<!-- Posts -->
		<?php
		$where="WHERE OSC='n' ORDER BY idArt DESC LIMIT 0,20";
		$myblg->menu_post($conn,$ling,$where);
		?>
		
			<!-- Labels / keys -->
			<?php
			$myobj->print_keys($url,$conn,$ling,50,"All keys");
			?>
		
		</div>

	<!-- END row-->
	</div>

<!-- END container-->
</div>


<?php
include "../cfg/footer.php";
?>
