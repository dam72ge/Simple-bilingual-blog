<?php
$url="../"; 
include "../cfg/mydb.php";

// carica elementi comuni layout
require_once "../cfg/class_layout.php"; $myobj=new pagina;
require_once "../cfg/class_blog.php"; $myblg=new myblg;


$title="Streppacugge | Blog"; $fold="blog";

include "../cfg/head.php";
?>


<!-- Page Content -->
<div class="container-fluid" style="background: #eee url('../lay/carta02.jpg') repeat">

	<div class="row">

        <!-- Blog Entries Column -->
        <div class="col-sm-8">
		<br/><br/><br/>

			<!-- Blog Post -->
			<?php
			$where="WHERE OSC='n' ORDER BY idArt DESC LIMIT 5";
			$tipo="latest";
			$myblg->blog($tipo,$url,$conn,$ling,$lang,$where);
			?>

		</div>

        <!-- Sidebar Widgets Column -->
        <div class="col-sm-4">
		<br/><br/><br/>
		
			<!-- Posts -->
			<?php
			$myblg->blog_search($url,$ling,"")
			?>

			<!-- Posts ordered by date-->
			<?php
			$myblg->blog_data($url,$conn,$ling)
			?>
 
			<!-- Labels / keys -->
			<?php
			$myobj->print_keys($url,$conn,$ling,20,"Keys");
			?>
  
		</div>

	<!-- END row-->
	</div>

<!-- END container-->
</div>

<?php
include "../cfg/footer.php";
?>
