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

$title="Admin | New album"; $fold="album";
include "../adm/head.php";
?>

<div class="container-fluid">
	<br/><br/><br/>
    <h2>New album</h2>
    <hr/><br/>
		<form action="album/insert_album.php" method="post">
			
		<div class="row form">
		
			<div class="col-sm-4"> 
				<?php 
				$mysql->form_osc("n");
				$oggi=date("Y-m-d H:i:s");
				$mysql->form_data($oggi,"data","required");
				?>
				<label>Cover</label><br/>
				<i>The image can only be added when editing.</i><br/><br/>
				<label><b>After saving</b></label><br/>
				<p style="border:1px solid #4CB310; padding:5px">
					<input class="w3-radio" type="radio" name="salv" value="index" checked> Back to the Admin<br/>
					<input class="w3-radio" type="radio" name="salv" value="modif"> Select and modify the post
				</p><br/>
			</div>

			<div class="col-sm-4"> 
				<?php
				$label="Titolo <img src='".$url."lay/it.gif'>";
				$mysql->form_input($label,"titleIT","","Imposta il titolo italiano","required");

				$label="Testo <img src='".$url."lay/it.gif'>";
				$mysql->form_textarea($label,"testoIT","","Digita il testo italiano","required");
				?>
			</div>
			
			<div class="col-sm-4"> 
				<?php
				$label="Title <img src='".$url."lay/en.gif'>";
				$mysql->form_input($label,"titleEN","","Insert the english title","required");

				$label="Text <img src='".$url."lay/it.gif'>";
				$mysql->form_textarea($label,"testoEN","","Insert the english text","required");
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
