<?php
$url="../../"; 
$urlAdm="../../cfg/adm/";

// carica elementi comuni layout
require_once "../class_layout.php"; $myobj=new pagina;
require_once "../class_admin.php"; $mysql=new mysql;

$my=$url."cfg/mydb.php";
include $my;

if(!isset($_GET['idArt']) | $_GET['idArt']<=0){
	$redirpag=$url."cfg/index.php";
	header("location: $redirpag");
}
$idArt=$_GET['idArt'];

$title="Admin | Modify post"; $fold="post";
include "../adm/head.php";
?>

<div class="container-fluid">
	<br/><br/><br/>
    <h2>Modify post n. <?php print $idArt;?></h2>
    <?php 
    // menu
    $sql="SELECT idArt FROM articoli ORDER BY idArt DESC LIMIT 1";
       $result = mysqli_query($conn, $sql);
	   $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	   $ultimo=$row['idArt'];
	   $mysql->avad($conn,"modif_post.php?idArt=",$idArt,$ultimo);

	// form
			$sql="SELECT idArt,osc, titleIT, titleEN, datetime, dateday, testoIT, testoEN, idFoto, tagIT, tagEN, idAlbum, file FROM articoli WHERE idArt='".$idArt."'";
			$result = mysqli_query($conn, $sql);
			$q = mysqli_fetch_array($result,MYSQLI_ASSOC);
			
			// post eliminato?
			if ($q['idArt']==""){
				$mysql->form_removed();
				}
			else{

			// codifica
			$titleIT=$myobj->mb_convert_encoding($q['titleIT']);
			$titleEN=$myobj->mb_convert_encoding($q['titleEN']);
			$testoIT=$myobj->mb_convert_encoding($q['testoIT']);
			$testoEN=$myobj->mb_convert_encoding($q['testoEN']);
			$allegato=""; 
			if ($q['file']!="") {$allegato=$myobj->mb_convert_encoding($q['file']);}

		?>	
		<form action="post/update_post.php" method="post">
			
		<div class="row form">
		
			<div class="col-sm-4"> 
				<?php
				$mysql->form_osc($q['osc']);
				$mysql->form_data($q['datetime'],"datetime","required");
				$mysql->form_giorno($q['dateday'],"required");
				$mysql->form_foto($url,"Attached pic",$conn,$q['idFoto'],"");
				$mysql->form_album($url,$conn,$q['idAlbum']);
				$mysql->form_file($url,$allegato);
				?>
			</div>
		
			<div class="col-sm-4"> 
				<?php
				$label="Titolo <img src='".$url."lay/it.gif'>";
				$mysql->form_input($label,"titleIT",$titleIT,"","required");

				$label="Testo <img src='".$url."lay/it.gif'>";
				$mysql->form_textarea($label,"testoIT",$testoIT,"","required");

				$label="TAG <img src='".$url."lay/it.gif'>";
				$mysql->form_input($label,"tagIT",$q['tagIT'],"Parola-chiave, parola-chiave, parola-chiave, ecc..","");
				?>
			</div>
			
			<div class="col-sm-4"> 
				<?php
				$label="Title <img src='".$url."lay/en.gif'>";
				$mysql->form_input($label,"titleEN",$titleEN,"","required");

				$label="Text <img src='".$url."lay/it.gif'>";
				$mysql->form_textarea($label,"testoEN",$testoEN,"","required");

				$label="TAG <img src='".$url."lay/en.gif'>";
				$mysql->form_input($label,"tagEN",$q['tagEN'],"Parola-chiave, parola-chiave, parola-chiave, ecc..","");
				?>
			</div>

			<input type="hidden" value="<?php print $q['idArt'];?>" name="idArt">


		</div>
		<button class="btn btn-info" type="submit" name="submit">SAVE</button>
		<br/><br/><br/>
      </form>
	<?php
	}



    ?>
</div>

<?php
include "../footer.php";
?>
