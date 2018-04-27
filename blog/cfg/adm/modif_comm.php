<?php
$url="../../"; 
$urlAdm="../../cfg/adm/";

// carica elementi comuni layout
require_once "../class_layout.php"; $myobj=new pagina;
require_once "../class_admin.php"; $mysql=new mysql;

$my=$url."cfg/mydb.php";
include $my;

if(!isset($_GET['idComm']) | $_GET['idComm']<=0){
	$redirpag=$url."cfg/index.php";
	header("location: $redirpag");
}
$idComm=$_GET['idComm'];

$title="Admin | Manage comments"; $fold="post";
include "../adm/head.php";
?>

<div class="container-fluid">
	<br/><br/><br/>
    <h2>Manage comment n. <?php print $idComm;?></h2>
    <?php 
    // menu
    $sql="SELECT idComm FROM commenti ORDER BY idComm DESC LIMIT 1";
       $result = mysqli_query($conn, $sql);
	   $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	   $ultimo=$row['idComm'];
	   $mysql->avad($conn,"modif_comm.php?idComm=",$idComm,$ultimo);
	// form
			$sql="SELECT idComm,idArt,osc, testo, data, autore, email, streppa FROM commenti WHERE idComm='".$idComm."'";
			$result = mysqli_query($conn, $sql);
			$q = mysqli_fetch_array($result,MYSQLI_ASSOC);
			
			// eliminato?
			if ($q['idComm']==""){
				$mysql->form_removed();
				}
			else{

			// codifica
			$autore=$myobj->mb_convert_encoding($q['autore']);
			$email=$myobj->mb_convert_encoding($q['email']);
			$testo=$myobj->mb_convert_encoding($q['testo']);

		?>	
		<form action="post/update_comm.php" method="post">
			
		<div class="row form">
		
			<div class="col-sm-4"> 
				<label>Comment status</label><br/>
				<p style="border:1px solid #4CB310; padding:5px">
				<input type="radio" name="osc" value="a" <?php if($q['osc']=="a") print "checked"; ?> /> New, awaiting authorization<br/>
				<input type="radio" name="osc" value="n" <?php if($q['osc']=="n") print "checked"; ?> /> Public<br/>
				<input type="radio" name="osc" value="s" <?php if($q['osc']=="s") print "checked"; ?> /> Obscured<br/>
				<input type="radio" name="osc" value="r" <?php if($q['osc']=="r") print "checked"; ?> /> Completely remove</p>

				<?php
				$mysql->form_data($q['data'],"data","required");
				$mysql->form_artcomm($conn,$q['idArt']);
				?>
			</div>
		
			<div class="col-sm-4"> 
				<?php
				$label="Author";
				$mysql->form_input($label,"autore",$autore,"Please insert the author name","required"); // $label,$name,$value,$placeholder, $required

				$label="Author e-mail";
				$mysql->form_input($label,"email",$email,"[facultative]","");
				?>

				<label>Type of author</label><br/>
				<p style="border:1px solid #4CB310; padding:5px">
				<input type="radio" name="streppa" value="n" <?php if($q['streppa']=="n") print "checked"; ?> /> Guest<br/>
				<input type="radio" name="streppa" value="s" <?php if($q['streppa']=="s") print "checked"; ?> /> ADMIN reply<br/>
				</p>

			</div>
			
			<div class="col-sm-4"> 
				<?php
				$label="Comment";
				$mysql->form_textarea($label,"testo",$testo,"Please insert a text","required"); // $label,$name,$value,$placeholder, $required
				?>
			</div>

			<input type="hidden" value="<?php print $q['idComm'];?>" name="idComm">


		</div>
		<br/><br/><br/>
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
