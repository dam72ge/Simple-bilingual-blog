<?php
$url="../../"; 
$urlAdm="../../cfg/adm/";

// carica elementi comuni layout
require_once "../class_layout.php"; $myobj=new pagina;
require_once "../class_admin.php"; $mysql=new mysql;

$my=$url."cfg/mydb.php";
include $my;

if(!isset($_GET['idFoto']) | $_GET['idFoto']<=0){
	$redirpag=$url."cfg/index.php";
	header("location: $redirpag");
}
$idFoto=$_GET['idFoto'];

$title="Admin | Modify pic"; $fold="img";
include "../adm/head.php";
?>

<div class="container-fluid">
	<br/><br/><br/>
    <h2>Modify pic n. <?php print $idFoto;?></h2>
    <?php 
    // menu
    $sql="SELECT idFoto FROM foto ORDER BY idFoto DESC LIMIT 1";
       $result = mysqli_query($conn, $sql);
	   $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	   $ultimo=$row['idFoto'];
	   $mysql->avad($conn,"modif_img.php?idFoto=",$idFoto,$ultimo);
	// form
			$sql="SELECT idFoto,osc,titleIT,titleEN,data,file,idAlbum FROM foto WHERE idFoto='".$idFoto."'";
			$result = mysqli_query($conn, $sql);
			$q = mysqli_fetch_array($result,MYSQLI_ASSOC);
			
			// post eliminato?
			if ($q['idFoto']==""){
				$mysql->form_removed();
				}
			else{

			// codifica
			$titleIT=$myobj->mb_convert_encoding($q['titleIT']);
			$titleEN=$myobj->mb_convert_encoding($q['titleEN']);

		?>	
		<form action="img/update_img.php" method="post" enctype="multipart/form-data">
			
		<div class="row form">
		
			<div class="col-sm-4"> 
				<?php
				$mysql->form_osc($q['osc']);
				$mysql->form_data($q['data'],"data","required");
				?>
			</div>
		
			<div class="col-sm-4"> 
				<?php
				if($q['file']!="") {
				print "<img src='".$url."images/".$q["file"]."' style='width:100px'></a><br/><br/>";
				}
				?>
				<label>Change the file</label><br/>
				<input type="hidden" value="<?php print $q['file'];?>" name="oldFile">
				<input class="form-control" type="file" name="newFile" accept="image/*"><br/><br/>

				<?php
				$mysql->form_album($url,$conn,$q['idAlbum']);
				?>
			</div>
			
			<div class="col-sm-4"> 
				<?php
				$label="Titolo <img src='".$url."lay/it.gif'>";
				$mysql->form_input($label,"titleIT",$titleIT,"","required");
				$label="Title <img src='".$url."lay/en.gif'>";
				$mysql->form_input($label,"titleEN",$titleEN,"","required");
				?>
			</div>

			<input type="hidden" value="<?php print $q['idFoto'];?>" name="idFoto">


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
