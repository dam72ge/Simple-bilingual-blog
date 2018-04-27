<?php
$url="../"; 
include "../cfg/mydb.php";

if(!isset($_POST['idArt']) | $_POST['idArt']<=0){
	$redirpag=$url."blog/index.php";
	header("location: $redirpag");
}
$idArt=$_POST['idArt'];

// carica elementi comuni layout
require_once "../cfg/class_layout.php"; $myobj=new pagina;
require_once "../cfg/class_blog.php"; $myblg=new myblg;


// salva commento idComm, osc, idArt, testo, autore, data, email
$autore=$myobj->charset_decode_utf_8 ($_POST['autore']);
$testo=$myobj->charset_decode_utf_8 ($_POST['testo']);
$email=$myobj->charset_decode_utf_8 ($_POST['email']);

    $sql = 
    "
    INSERT INTO commenti
    (idComm,osc, idArt, testo, autore, data, email) 
    VALUES 
    ( 
    '',
    '".stripslashes($_POST['osc'])."',
    '".stripslashes($_POST['idArt'])."',
    '".mysqli_real_escape_string($conn,stripslashes($testo))."',
    '".mysqli_real_escape_string($conn,stripslashes($autore))."',
    '".mysqli_real_escape_string($conn,stripslashes($_POST['data']))."',
    '".mysqli_real_escape_string($conn,stripslashes($email))."'

    )";
   $query=mysqli_query($conn,$sql);


$title="Streppacugge | Blog"; $fold="blog";

include "../cfg/head.php";

// testo avviso
$lb_title="Grazie per aver inviato il tuo commento";
$lb_text="Il tuo messaggio sarà letto e valutato il prima possibile. Se non saranno ravvisati problemi, verrà pubblicato sotto l'articolo.";
$lb_video="Nel frattempo, goditi la vita!<br/>(O, se preferisci, un sacco di strabilianti performance come questa)";
$lb_butt="CLICCA QUI PER TORNARE ALL'ARTICOLO";
if ($ling=="en"){
$lb_title="Thanks for having sent your comment";
$lb_text="Your message will be read and evaluated as soon as possible. If there are no problems, it will be published under the article.";
$lb_video="Meanwhile, have a good time!<br/>(Or loads of stunning performances like this one, if you prefer)";
$lb_butt="CLICK HERE TO RETURN TO THE POST";
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

				<a href="post.php?idArt=<?php print $idArt; ?>"><button class="btn btn-success" type="button" name="login"><?php print $lb_butt; ?></button></a>

				<br/><br/><br/><br/>
				<br/><br/><br/><br/>

				<p><?php print $lb_video; ?></p>
				
				<br/><br/>
				<div class="embed-responsive embed-responsive-4by3">
				<iframe width="560" height="315" src="https://www.youtube.com/embed/V7edkwJsgN0" frameborder="0" allowfullscreen></iframe>
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
		$where="WHERE OSC='n' AND idArt!='".$idArt."' ORDER BY idArt DESC LIMIT 0,15";
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
