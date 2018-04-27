<?php
$url="../"; 
include "../cfg/mydb.php";

// carica elementi comuni layout
require_once "../cfg/class_layout.php"; $myobj=new pagina;
//require_once "../cfg/class_blog.php"; $myblg=new myblg;

$title="Streppacugge | Media"; $fold="media";

include "../cfg/head.php";
?>
	
<!-- Page Content -->
<div class="w3-animate-opacity" style="position:relative; text-align: center; color: white">
  <img src="../sfondi/bladerunner.jpg" style="width:100%;min-height:350px;max-height:600px;">
 <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"><h1 class="w3-lobster"><?php print $lang['TXT_MEDIA'];?></h1></div>
</div>
<div class="container-fluid">


	<div class="row text-center">
        <div class="col-sm-4" id="album">
		<br/><br/><br/>
		<h2 class="titsez"><?php print $lang['MEDIA_IMG'];?></h2>
		<br/>
		<?php print $lang['TXT_MEDIA_IMG'];?>
		<br/><br/><br/>
		
					<?php
					// ALBUM
					$sql="SELECT album.idAlbum, album.titleIT, album.titleEN, album.testoEN, album.testoIT, foto.file, album.data FROM album, foto WHERE album.osc='n' AND album.idFoto=foto.idFoto ORDER BY album.idAlbum ASC";
					$result = mysqli_query($conn, $sql);
					while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
					$idAlbum=$row['idAlbum'];					
					$copertina=$url."files/".$row['file'];
					$album=$myobj->mb_convert_encoding($row['titleEN']);
					$testo=$myobj->mb_convert_encoding($row['testoEN']);
						if($ling=="it"){
						$album=$myobj->mb_convert_encoding($row['titleIT']);
						$testo=$myobj->mb_convert_encoding($row['testoIT']);
						}
					$pdata="";
					$pdata=$myobj->dataIT($row['data'],""); if ($ling=="en"){ $pdata=$myobj->dataEN($row['data'],""); }

					?>		
					<br/><br/>
					<h4><i><?php print $album; ?></i> <span class="small"><span class='glyphicon glyphicon-time'></span> <?php print $pdata; ?></span></h4>
					<div class="thumbnail" style="background-color:#BAEEFA">
					<?php

					$myobj->lightbox($url,$conn,$ling,$idAlbum,$album,$copertina,"thumb");

					?>		
					</div>
					<p style="color: #444"><i><?php print $testo; ?></i></p>
					<?php
					}
					?>
					<br/><br/><br/>
		</div>
		

        <div class="col-sm-4" id="sounds">
		<br/><br/><br/>
		<h2 class="titsez"><?php print $lang['MEDIA_MP3'];?></h2>
		<br/>
		<?php print $lang['TXT_MEDIA_MP3'];?>
		<br/><br/><br/>

					<?php
					$sql="SELECT titleIT,titleEN,testoIT,testoEN,file,data FROM musica WHERE OSC='n' ORDER BY idMus DESC";
					$result = mysqli_query($conn, $sql);
					while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){

					$titolo=$myobj->mb_convert_encoding($row['titleEN']);
					$testo=$myobj->mb_convert_encoding($row['testoEN']);
						if($ling=="it"){
						$titolo=$myobj->mb_convert_encoding($row['titleIT']);
						$testo=$myobj->mb_convert_encoding($row['testoIT']);
						}
					$lunghezza=strlen($titolo);
					if ($lunghezza>75){ $titolo=substr($titolo,0,75); $titolo.="...";}
					$pdata="";
					$pdata=$myobj->dataIT($row['data'],""); if ($ling=="en"){ $pdata=$myobj->dataEN($row['data'],""); }
					
					// link
					$flink="Click to see the text";
						if($ling=="it"){
						$flink="Clicca per vedere il testo";
						}
					?>
					<br/><br/>
					<h4><i><?php print $titolo; ?></i> <span class="small"><span class='glyphicon glyphicon-time'></span> <?php print $pdata; ?></span></h4>
					<div class="thumbnail" style="background-color:#FCFF85">

						<img src="../lay/streppa.png" alt="canale youtube" class="img-circle" title="<?php print $flink; ?>" data-toggle="modal" data-target="#myMusic"><br/><br/>

						<?php print $myobj->play_sounds($url, $row['file']); ?><br/>
						<h4 title="<?php print $flink; ?>" data-toggle="modal" data-target="#myMusic"><?php print $titolo; ?></h4>
					<br/><br/>

					<!-- Modal testo file musicale -->
					<div id="myMusic" class="modal fade" role="dialog" style="color: #444">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title"><?php print $titolo; ?></h4>
								</div>
								
								<div class="modal-body">
								<p><?php print nl2br($testo); ?></p>
								</div>
								
								<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal"><?php print $lang['BT_CLOSE'];?></button>
								</div>
							</div>
						</div>
					</div>

					</div>
					<?php
					}
					?>
					<br/><br/><br/>
		</div>


        <div class="col-sm-4" id="video">
		<br/><br/><br/>
		<h2 class="titsez"><?php print $lang['MEDIA_VID'];?></h2>
		<br/>
		<?php print $lang['TXT_MEDIA_VID'];?>
		<br/><br/><br/>

					<?php
					$sql="SELECT codice,data FROM video WHERE OSC='n' ORDER BY idVideo DESC";
					$result = mysqli_query($conn, $sql);
					while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){
					?>
					<br/><br/>
					<h4><span class='glyphicon glyphicon-time'></span> <?php print $row['data']; ?></h4>
					<div class="thumbnail" style="background-color:#A1FB9B">
					<?php print $row['codice']; ?><br/>
					<br/><br/>
					</div>
					<?php
					}
					?>
					<br/><br/><br/>
		</div>

	<!-- END row-->
	</div>
		

<!-- END container-->
</div>


<?php
include "../cfg/footer.php";
?>
