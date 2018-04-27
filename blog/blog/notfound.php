<?php
$url="../"; 
include "../cfg/mydb.php";

// carica elementi comuni layout
require_once "../cfg/class_layout.php"; $myobj=new pagina;
require_once "../cfg/class_blog.php"; $myblg=new myblg;

$title="Streppacugge | Blog"; $fold="blog";

include "../cfg/head.php";

// testo avviso
$lb_title="Attenzione!";
$lb_text="L'articolo selezionato non è disponibile. Potrebbe non esistere più, essere stato spostato o semplicemente oscurato per aggiornamenti.<br/>Prova a selezionarne un altro o a tornare alla pagina principale.";
$lb_video="Nel frattempo, goditi la vita!<br/>(O, se preferisci, un sacco di strabilianti performance come questa)";
$lb_butt="CLICCA QUI PER TORNARE AL BLOG";
if ($ling=="en"){
$lb_title="Warning!";
$lb_text="Sorry, the post you're looking for is unavailable. It might been removed, moved or simply set off line for updating.<br/>Try to select another one  or get back to the main page.";
$lb_video="Meanwhile, have a good time!<br/>(Or loads of stunning performances like this one, if you prefer)";
$lb_butt="CLICK HERE TO RETURN TO THE BLOG";
}
?>
	
<!-- Page Content -->
<div class="container-fluid" style="background: #eee url('../lay/carta02.jpg') repeat">
<div class="index-content">

	<div class="row">

        <!-- Blog Entries Column -->
        <div class="col-sm-8">

			<div class="card">
			<div class="text-center">
				<br/><br/><br/><br/>
				
				<h1 class="titblg"><?php print $lb_title; ?></h1>
				<br/><br/><br/>
				<?php print $lb_text; ?>
				<br/><br/>
				<br/><br/>

				<a href="index.php"><button class="btn btn-success" type="button" name="login"><?php print $lb_butt; ?></button></a>

				<br/><br/><br/><br/>
				<br/><br/><br/><br/>

				<p><?php print $lb_video; ?></p>
				
				<br/><br/>
				<div class="embed-responsive embed-responsive-4by3">
				<iframe width="560" height="315" src="https://www.youtube.com/embed/iG8c4NkR9tU" frameborder="0" allowfullscreen></iframe>
				</div>
				<br/><br/><br/><br/>
				<br/><br/><br/><br/>
			</div>
			</div>

		</div>

        <!-- Sidebar Widgets Column -->
        <div class="col-sm-4">
		
			<!-- Posts -->
		<?php
		$where="WHERE OSC='n' ORDER BY idArt DESC LIMIT 0,15";
		$myblg->menu_post($conn,$ling,$where);
		?>
		
		
		</div>

	<!-- END row-->
	</div>

<!-- END container-->
</div>
</div>

<?php
include "../cfg/footer.php";
?>
