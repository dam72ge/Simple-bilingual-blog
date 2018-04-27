<?php
$url="../../"; 
$urlAdm="../../cfg/adm/";

// carica elementi comuni layout
require_once "../class_layout.php"; $myobj=new pagina;
require_once "../class_admin.php"; $mysql=new mysql;

$my=$url."cfg/mydb.php";
include $my;

if (!isset($_SESSION['username']) | $_SESSION['username'] != 'admin') {
		$redirpag=$url."index.php";
		header("location: $redirpag");
	}

$title="Admin | New pic"; $fold="img";
include "../adm/head.php";
?>

<div class="container-fluid">
	<br/><br/><br/>
    <h2>New pic</h2>
    <hr/><br/>
		<form action="img/insert_img.php" method="post" enctype="multipart/form-data">
			
		<div class="row form">
		
			<div class="col-sm-4"> 
				<?php 
				$mysql->form_osc("n");
				$oggi=date("Y-m-d H:i:s");
				$mysql->form_data($oggi,"data","required");
				?>
				<label><b>After the saving</b></label><br/>
				<p style="border:1px solid #4CB310; padding:5px">
					<input class="w3-radio" type="radio" name="salv" value="index" checked> Back to the Admin<br/>
					<input class="w3-radio" type="radio" name="salv" value="modif"> Select and modify the image
				</p><br/>
			</div>

			<div class="col-sm-4"> 
				<label>File</label><br/>
				<input class="w3-input w3-border w3-margin-bottom" type="file" name="file" accept="image/*" multiple required>
				<?php
				$mysql->form_album($url,$conn,0);
				?>
			</div>
			
			<div class="col-sm-4"> 
				<?php
				$label="Titolo <img src='".$url."lay/it.gif'>";
				$mysql->form_input($label,"titleIT","","Imposta il titolo italiano","required");
				$label="Title <img src='".$url."lay/en.gif'>";
				$mysql->form_input($label,"titleEN","","Insert the english title","required");
				?>
			</div>

		</div>
		<button class="btn btn-info" type="submit" name="submit">SAVE</button>
		<br/><br/><br/>
      </form>

</div>

<?php
include "../adm/footer.php";
?>
