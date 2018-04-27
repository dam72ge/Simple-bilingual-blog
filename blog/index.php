<?php
$url=""; 
include "cfg/mydb.php";

// carica elementi comuni layout
require_once "cfg/class_layout.php"; $myobj=new pagina;
require_once "cfg/class_blog.php"; $myblg=new myblg;

$title="BlogName"; $fold="home";

include "cfg/head.php";
?>
	
<!-- Page Content -->

<header class="container-fluid">
        <div class='carousel'>
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="7500" data-pause="hover">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="3"></li>
                </ol>
                <!-- Wrapper for slides -->
                <div class="carousel-inner text-center" role="listbox">
                    <div class="item active">
                        <div class="col-lg-8 pull-right">
                            <img src="sfondi/malta1.jpg" style="padding-bottom:25px">
                        </div>
                        <div class="col-lg-4">
							<h2 class="w3-lobster"><?php print $lang['HMC_STREPPA']; ?></h2>
                            <p class="text-justify" ><br/><?php print $lang['HMC_STREPPA_TXT']; ?></p>
                        </div>
                    </div>
                    <div class="item">                    
                        <div class="col-lg-8 pull-right">
                            <img src="sfondi/malta2.jpg" style="padding-bottom:25px">
                        </div>
                        <div class="col-lg-4">                            
                            <h2 class="w3-lobster"><?php print $lang['HMC_ABOUT']; ?></h2>
                            <p class="small text-justify" ><br/><br/><?php print $lang['HMC_ABOUT_TXT']; ?></p>
                        </div>                    
                    </div> 
                    <div class="item">                    
                        <div class="col-lg-8 pull-right">
                            <img src="sfondi/malta3.jpg" style="padding-bottom:25px">
                        </div>
                        <div class="col-lg-4">                            
							<h2 class="w3-lobster"><?php print $lang['HMC_BLOG']; ?></h2>
                            <p class="small text-justify" ><br/><?php print $lang['HMC_BLOG_TXT']; ?></p>    
                            <br/><br>
                            <p class="post text-center">
						<?php
						if ($ling=="en"){
						print "<a href='?ling=it'>Vuoi passare alla versione italiana?<br/>Click here if you want this website in Italian</a>";
						}
						else{
						print "<a href='?ling=en'>Do you prefer this site in English?<br/>Clicca qui se desideri passare alla versione inglese</a>";
						}
						?>
							</p>
                            
                        </div>                    
                    </div> 
                    <div class="item">                    
                        <div class="col-lg-8 pull-right">
                            <img src="sfondi/malta4.jpg" style="padding-bottom:25px">
                        </div>
                        <div class="col-lg-4">                            
                            <h2 class="w3-lobster"><?php print $lang['HMC_WORK']; ?></h2>
                            <p class="small text-justify" ><br/><br/><?php print $lang['HMC_WORK_TXT']; ?></p>
                           </p>       
                        </div>                    
                    </div> 
                </div>
                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
</header>
<br/><br/>

<!-- Parallax 0 -->
	<div class="bg-0" style="height:600px">
	<br/><br/><br/><br/><br/>
		<div class="col-sm-6 col-sm-offset-3 text-center">
			<br/><br/>
			<div style="background-image:url('lay/black-trasp.png'); padding:10px; border-radius:10px; color: #fff">
			<br/><br/><br/>
			
				<div class="prompt" style="font-size:24px">
					<div class="w3-lobster">
					<?php
					if($ling=="it"){
					print "<p>Citazione</p>";
					}
					else{
					print "<p>Quotation</p>";
					}
					?>
					</div>
				<p class="small">Author</p>
				</div>

			<br/><br/><br/>
			</div>
		</div>
	</div>


<!-- BLOG Latest 4 posts -->
<div class="index-content text-center" id="post">
<br/><br/>
<h1 class="titsez"><?php print $lang['HOME_BLOG'];?></h1>
<br/><br/><br/><br/>

    <div class="container-fluid">
		<?php 
		$myblg->latest_post($conn,$ling,$lang);
		?>
    </div>

<br/><br/>
</div>

<!-- Parallax 1 -->
	<div class="bg-1" style="height:600px">
	<br/><br/><br/><br/><br/>
		<div class="col-sm-6 col-sm-offset-3 text-center">
			<br/><br/>
			<div style="background-image:url('lay/black-trasp.png'); padding:10px; border-radius:10px; color: #fff">
			<br/><br/><br/>
				<div class="prompt" style="font-size:24px">
					<div class="w3-lobster">
					<?php
					if($ling=="it"){
						print "<p>Citazione, citazione</p>";
						print "<p>citazione</p>";
					}
					else{
						print "<p>Quotation, quotation</p>";
						print "<p>quotation</p>";
					}
					?>
					</div>
				<p class="small">Author</p>
				</div>
			<br/><br/><br/>
			</div>
		</div>
	</div>


<!-- Album -->
<div class="container-fluid text-center" style="background-color: #386FA4; color:#fff" id="album">
<br/><br/><br/><br/><br/>
<h1 class="titsez" style="color: yellow"><?php print $lang['HOME_ALB'];?></h1>
<a name="albumsel"></a>
<br/><br/><br/><br/>
<?php

	$id=0;
	if(!isset($_POST['id'])){
		$sqla="SELECT album.idAlbum, album.titleIT, album.titleEN, album.testoEN, album.testoIT, foto.file, album.data FROM album, foto WHERE album.osc='n' AND album.idFoto=foto.idFoto ORDER BY idAlbum DESC LIMIT 0,1";
	}
	else{
		$sqla="SELECT album.idAlbum, album.titleIT, album.titleEN, album.testoEN, album.testoIT, foto.file, album.data FROM album, foto WHERE album.osc='n' AND album.idFoto=foto.idFoto AND album.idAlbum='".$_POST['id']."'";
		$id=$_POST['id'];
	}

	
		$sql="SELECT idAlbum, titleIT, titleEN FROM album WHERE osc='n' ORDER BY idAlbum DESC";
		$query = mysqli_query($conn, $sql);
	?>
       <form id="album_sel" class="form-inline" name="album_sel" method="post" action="#albumsel">
		   <div class="form-group">
		   <select name="id" style="padding:3px; color:#000" class="form-group">
			   <?php
				while($row = mysqli_fetch_array($query,MYSQLI_ASSOC)){
					print "<option value='".$row['idAlbum']."'";
					if ($row['idAlbum']==$id) print " selected";
						$album=$myobj->mb_convert_encoding($row['titleEN']);
						if($ling=="it"){
						$album=$myobj->mb_convert_encoding($row['titleIT']);
						}
					print ">".$album."</option>";
					}
			   ?>		   
		   </select>
		   </div>
		   <input type="submit" class="btn btn-success" value="<?php print $lang['BT_CHANGE'];?>" onClick="document.getElementById('album_sel').submit()">
       </form>
       <br/>

	<?php
		$res_a = mysqli_query($conn, $sqla);
		$a = mysqli_fetch_array($res_a,MYSQLI_ASSOC);
		$idAlbum=$a['idAlbum'];
		$copertina=$url."images/".$a['file'];
		$album=$myobj->mb_convert_encoding($a['titleEN']);
		$testo=$myobj->mb_convert_encoding($a['testoEN']);
			if($ling=="it"){
			$album=$myobj->mb_convert_encoding($a['titleIT']);
			$testo=$myobj->mb_convert_encoding($a['testoIT']);
			}
		$pdata="";
		$pdata=$myobj->dataIT($a['data'],""); if ($ling=="en"){ $pdata=$myobj->dataEN($a['data'],""); }
		?>
					<?php $myobj->lightbox($url,$conn,$ling,$idAlbum,$album,$copertina,"single"); ?>
					<br/>
					<p style="color: white"><?php print $album; ?> - <?php print $pdata; ?><br/><?php print $testo; ?></p>
		<?php
?>

<br/><br/><br/><br/><br/>
</div>

<!-- Tags -->
<div class="container-fluid text-center" id="tag">
<br/><br/><br/><br/><br/>
<?php
$myobj->print_keys($url,$conn,$ling,10,$lang['HOME_ARG']);
?>

<br/><br/><br/><br/><br/>
</div>

<!-- Parallax 2 -->
	<div class="bg-2" style="height:600px">
	<br/><br/><br/><br/><br/>
		<div class="col-sm-6 col-sm-offset-3 text-center">
			<br/><br/>
			<div style="background-image:url('lay/black-trasp.png'); padding:10px; border-radius:10px; color: #fff">
			<br/><br/><br/>

				<div class="prompt" style="font-size:24px">
					<div class="w3-lobster">
					<?php
					if($ling=="it"){
						print "<p>Citazione, citazione</p>";
					}
					else{
						print "<p>Quotation, quotation</p>";
					} 
					?>
					</div>
				<p class="small">Author</p>
				</div>

			<br/><br/><br/>
			</div>
		</div>
	</div>

	<?php
	//$myobj->textmodal($url,"myAbout",$lang['HMD_ABOUT'],$lang['HMD_ABOUT_ALL'],$lang['BT_CLOSE']);
	?>

<?php
include "cfg/footer.php";
?>
