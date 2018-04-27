<?php
$url="../../"; 
$urlAdm="../../cfg/adm/";

// carica elementi comuni layout
require_once "../class_layout.php"; $myobj=new pagina;
require_once "../class_admin.php"; $mysql=new mysql;

$my=$url."cfg/mydb.php";
include $my;

if(!isset($_GET['idAlbum']) | $_GET['idAlbum']<=0){
	$redirpag=$url."cfg/index.php";
	header("location: $redirpag");
}
$idAlbum=$_GET['idAlbum'];

$title="Admin | Modify album"; $fold="album";
include "../adm/head.php";
?>

<div class="container-fluid">
	<br/><br/><br/>
    <h2>Modify album n. <?php print $idAlbum;?></h2>
    <?php 
    // menu
    $sql="SELECT idAlbum FROM album ORDER BY idAlbum DESC LIMIT 1";
       $result = mysqli_query($conn, $sql);
	   $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	   $ultimo=$row['idAlbum'];
	   $mysql->avad($conn,"modif_album.php?idAlbum=",$idAlbum,$ultimo);
	// form
		
			$sql="SELECT idAlbum,osc, titleIT, titleEN, data, idFoto, testoIT, testoEN FROM album WHERE idAlbum='".$idAlbum."'";
			$result = mysqli_query($conn, $sql);
			$q = mysqli_fetch_array($result,MYSQLI_ASSOC);
			
			// post eliminato?
			if ($q['idAlbum']==""){
				$mysql->form_removed();
				}
			else{

			// codifica
			$titleIT=$myobj->mb_convert_encoding($q['titleIT']);
			$titleEN=$myobj->mb_convert_encoding($q['titleEN']);
			$testoIT=$myobj->mb_convert_encoding($q['testoIT']);
			$testoEN=$myobj->mb_convert_encoding($q['testoEN']);

		?>	
		<form action="album/update_album.php" method="post">
			
		<div class="row form">
		
			<div class="col-sm-4"> 
				<?php
				$mysql->form_osc($q['osc']);
				$mysql->form_data($q['data'],"data","required");
				$where="AND idAlbum='".$q['idAlbum']."'";
				$mysql->form_foto($url,"Copertina",$conn,$q['idFoto'],$where);
				?>
			</div>
		
			<div class="col-sm-4"> 
				<?php
				$label="Titolo <img src='".$url."lay/it.gif'>";
				$mysql->form_input($label,"titleIT",$titleIT,"","required");

				$label="Testo <img src='".$url."lay/it.gif'>";
				$mysql->form_textarea($label,"testoIT",$testoIT,"","required");
				?>
			</div>
			
			<div class="col-sm-4"> 
				<?php
				$label="Titolo <img src='".$url."lay/en.gif'>";
				$mysql->form_input($label,"titleEN",$titleEN,"","required");

				$label="Testo <img src='".$url."lay/it.gif'>";
				$mysql->form_textarea($label,"testoEN",$testoEN,"","required");
				?>
			</div>

			<input type="hidden" value="<?php print $q['idAlbum'];?>" name="idAlbum">


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
