<?php
$url="../"; 
include "../cfg/mydb.php";

if(isset($_POST['w'])){ $w=$_POST['w']; }
if(!isset($w) && isset($_GET['w'])){ $w=$_GET['w']; }
if(!isset($w) | $w==""){ 
	$redirpag=$url."blog/index.php";
	header("location: $redirpag");
	}

// carica elementi comuni layout
require_once "../cfg/class_layout.php"; $myobj=new pagina;
require_once "../cfg/class_blog.php"; $myblg=new myblg;
require_once "../cfg/class_search.php"; $mysrc=new mysrc;

$title="Streppacugge | Blog | Search '".$w."'"; $fold="blog";
include "../cfg/head.php";

// parametri lingua
$par_titolo="Post title"; $titolo="titleEN";
$par_testo="Post text"; $testo="testoEN";
$par_commento="Comment"; $commento="testo";
$par_autore="Commentator"; $autore="autore";
$par_album="Album"; $album="titleEN";
$par_album_testo="Album description"; $album_testo="testoEN";
$par_foto="Image"; $foto="titleEN";
if ($ling=="it"){
$par_titolo="Titolo del post"; $titolo="titleIT";	
$par_testo="Testo del post"; $testo="testoIT";
$par_commento="Commento"; $commento="testo";
$par_autore="Commentatore"; $autore="autore";
$par_album="Album"; $album="titleIT";
$par_album_testo="Descrizione album"; $album_testo="testoIT";
$par_foto="Immagine"; $foto="titleIT";
}

// articoli - titolo
	$sql="SELECT idArt, ".$titolo." FROM articoli WHERE osc='n' AND ".$titolo." LIKE '%".$w."%'";
	$result = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){

		// riscontro -> percentuale esattezza completa
		$stringa=$row[$titolo];
		$perc=$mysrc->perc($w,$stringa);		

		// esattezza: completa ma non sensitive
		if ($perc==0){
			$parz=strtolower($stringa);
			$cfr=strtolower($w);
			$perc=$mysrc->perc($cfr,$parz);
			}
		// parola o parte contenuta
		if ($perc==0){
			$pos=mb_strpos($stringa,$w);
			$ad=$pos-50; if($ad<0) $ad=0;
			$lungh=strlen($stringa);
			$w_lungh=strlen($w);
			$parz=trim(strtolower(substr($stringa,$pos,$w_lungh)));	
			$cfr=trim(strtolower($w));
			$perc=$mysrc->perc($cfr,$parz);
			}
		
		// registra parola e estratto
		if ($perc>0){
			$estratto=$mysrc->estratto($row[$titolo],$w);	
			$dati=$mysrc->add_array($dati,"a",$row['idArt'],0,0,0,"",$row[$titolo],$par_titolo,$estratto,$perc);
		}
	}
	$perc=0;

// articoli - testo
	$sql="SELECT idArt, ".$titolo.", ".$testo." FROM articoli WHERE osc='n' AND ".$testo." LIKE '%".$w."%'";
	$result = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){

		// riscontro -> percentuale esattezza completa
		$stringa=$row[$testo];
		$perc=$mysrc->perc($w,$stringa);		

		// esattezza: completa ma non sensitive
		if ($perc==0){
			$parz=strtolower($stringa);
			$cfr=strtolower($w);
			$perc=$mysrc->perc($cfr,$parz);
			}
		// parola o parte contenuta
		if ($perc==0){
			$pos=mb_strpos($stringa,$w);
			$ad=$pos-50; if($ad<0) $ad=0;
			$lungh=strlen($stringa);
			$w_lungh=strlen($w);
			$parz=trim(strtolower(substr($stringa,$pos,$w_lungh)));	
			$cfr=trim(strtolower($w));
			$perc=$mysrc->perc($cfr,$parz);
			}
		
		// registra parola e estratto
		if ($perc>0){
			$estratto=$mysrc->estratto($row[$titolo],$w);	
			$dati=$mysrc->add_array($dati,"a",$row['idArt'],0,0,0,"",$row[$titolo],$par_testo,$estratto,$perc);
		}
	}
	$perc=0;


// commenti - autore
	$sql="SELECT idComm, idArt, ".$autore." FROM commenti WHERE osc='n' AND ".$autore." LIKE '%".$w."%'";
	$result = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){

		// riscontro -> percentuale esattezza completa
		$stringa=$row[$autore];
		$perc=$mysrc->perc($w,$stringa);		

		// esattezza: completa ma non sensitive
		if ($perc==0){
			$parz=strtolower($stringa);
			$cfr=strtolower($w);
			$perc=$mysrc->perc($cfr,$parz);
			}
		// parola o parte contenuta
		if ($perc==0){
			$pos=mb_strpos($stringa,$w);
			$ad=$pos-50; if($ad<0) $ad=0;
			$lungh=strlen($stringa);
			$w_lungh=strlen($w);
			$parz=trim(strtolower(substr($stringa,$pos,$w_lungh)));	
			$cfr=trim(strtolower($w));
			$perc=$mysrc->perc($cfr,$parz);
			}
		
		// registra parola e estratto
		if ($perc>0){
			$estratto=$mysrc->estratto($row[$autore],$w);	
			$dati=$mysrc->add_array($dati,"a",$row['idArt'],$row['idComm'],0,0,"",$row[$autore],$par_autore,$estratto,$perc);
			}
	}
	$perc=0;

// commenti - testo
	$sql="SELECT idComm, idArt, ".$autore.", ".$commento." FROM commenti WHERE osc='n' AND ".$commento." LIKE '%".$w."%'";
	$result = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){

		// riscontro -> percentuale esattezza completa
		$stringa=$row[$commento];
		$perc=$mysrc->perc($w,$stringa);		

		// esattezza: completa ma non sensitive
		if ($perc==0){
			$parz=strtolower($stringa);
			$cfr=strtolower($w);
			$perc=$mysrc->perc($cfr,$parz);
			}
		// parola o parte contenuta
		if ($perc==0){
			$pos=mb_strpos($stringa,$w);
			$ad=$pos-50; if($ad<0) $ad=0;
			$lungh=strlen($stringa);
			$w_lungh=strlen($w);
			$parz=trim(strtolower(substr($stringa,$pos,$w_lungh)));	
			$cfr=trim(strtolower($w));
			$perc=$mysrc->perc($cfr,$parz);
			}
		
		// registra parola e estratto
		if ($perc>0){
			$estratto=$mysrc->estratto($row[$commento],$w);	
			$dati=$mysrc->add_array($dati,"a",$row['idArt'],$row['idComm'],0,0,"",$row[$autore],$par_commento,$estratto,$perc);
			}
	}
	$perc=0;

// album - titolo
	$sql="SELECT idAlbum, ".$album." FROM album WHERE osc='n' AND ".$album." LIKE '%".$w."%'";
	$result = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){

		// riscontro -> percentuale esattezza completa
		$stringa=$row[$album];
		$perc=$mysrc->perc($w,$stringa);		

		// esattezza: completa ma non sensitive
		if ($perc==0){
			$parz=strtolower($stringa);
			$cfr=strtolower($w);
			$perc=$mysrc->perc($cfr,$parz);
			}
		// parola o parte contenuta
		if ($perc==0){
			$pos=mb_strpos($stringa,$w);
			$ad=$pos-50; if($ad<0) $ad=0;
			$lungh=strlen($stringa);
			$w_lungh=strlen($w);
			$parz=trim(strtolower(substr($stringa,$pos,$w_lungh)));	
			$cfr=trim(strtolower($w));
			$perc=$mysrc->perc($cfr,$parz);
			}
		
		// registra parola e estratto
		if ($perc>0){
			$estratto=$mysrc->estratto($row[$album],$w);
			$dati=$mysrc->add_array($dati,"b",0,0,$row['idAlbum'],0,"",$row[$album],$par_album,$estratto,$perc);
			}
	}
	$perc=0;
	
// album - descrizione
	$sql="SELECT idAlbum, ".$album.", ".$album_testo." FROM album WHERE osc='n' AND ".$album_testo."='".$w."'";
	$result = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){

		// riscontro -> percentuale esattezza completa
		$stringa=$row[$album_testo];
		$perc=$mysrc->perc($w,$stringa);		

		// esattezza: completa ma non sensitive
		if ($perc==0){
			$parz=strtolower($stringa);
			$cfr=strtolower($w);
			$perc=$mysrc->perc($cfr,$parz);
			}
		// parola o parte contenuta
		if ($perc==0){
			$pos=mb_strpos($stringa,$w);
			$ad=$pos-50; if($ad<0) $ad=0;
			$lungh=strlen($stringa);
			$w_lungh=strlen($w);
			$parz=trim(strtolower(substr($stringa,$pos,$w_lungh)));	
			$cfr=trim(strtolower($w));
			$perc=$mysrc->perc($cfr,$parz);
			}
		
		// registra parola e estratto
		if ($perc>0){
			$estratto=$mysrc->estratto($row[$album_testo],$w);
			$dati=$mysrc->add_array($dati,"b",0,0,$row['idAlbum'],0,"",$row[$album],$par_album_testo,$estratto,$perc);
			}
	}
	$perc=0;

// immagine titolo
	$sql="SELECT idFoto, file, ".$foto." FROM foto WHERE osc='n' AND ".$foto." LIKE '%".$w."%'";
	$result = mysqli_query($conn, $sql);
	while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){

		// riscontro -> percentuale esattezza completa
		$stringa=$row[$foto];
		$perc=$mysrc->perc($w,$stringa);		

		// esattezza: completa ma non sensitive
		if ($perc==0){
			$parz=strtolower($stringa);
			$cfr=strtolower($w);
			$perc=$mysrc->perc($cfr,$parz);
			}
		// parola o parte contenuta
		if ($perc==0){
			$pos=mb_strpos($stringa,$w);
			$ad=$pos-50; if($ad<0) $ad=0;
			$lungh=strlen($stringa);
			$w_lungh=strlen($w);
			$parz=trim(strtolower(substr($stringa,$pos,$w_lungh)));	
			$cfr=trim(strtolower($w));
			$perc=$mysrc->perc($cfr,$parz);
			}
		
		// registra parola e estratto
		if ($perc>0){
			$estratto=$mysrc->estratto($row[$foto],$w);
			$dati=$mysrc->add_array($dati,"c",0,0,0,$row['idFoto'],$row['file'],$row[$foto],$par_foto,$estratto,$perc);
			}
	}
	$perc=0;

	

		// ordina array ricerca  array1,sorting order,sorting type 
		array_multisort(
			$dati['perc'], SORT_NUMERIC, SORT_DESC,
			$dati['ord'], SORT_STRING, SORT_ASC,
			$dati['tipo'], SORT_STRING, SORT_ASC,
			$dati['titolo'], SORT_STRING, SORT_ASC,
			$dati['idArt'], SORT_NUMERIC, SORT_DESC,
			$dati['idComm'], SORT_NUMERIC, SORT_DESC,
			$dati['idAlbum'], SORT_NUMERIC, SORT_DESC,
			$dati['idFoto'], SORT_NUMERIC, SORT_DESC,
			$dati['file'], SORT_STRING, SORT_ASC,
			$dati['estratto'], SORT_STRING, SORT_ASC
			);
?>
	
<!-- Page Content -->
<div class="container-fluid" style="background: #eee url('../lay/carta02.jpg') repeat">

	<div class="row">

        <!-- Blog Entries Column -->
        <div class="col-sm-8">
		<br/><br/><br/>

			<div class="index-content" style="margin:0; padding:0">
			<?php
			if (count($dati['ord'])>0){
			
				// titolo	
				if ($ling=="it"){
				print "<div class='text-center'><h1 class='w3-lobster'>Risultati della ricerca per <span style='color:red'>".$w."</span></h1></div>";
				print "<p class='text-center small'>Trovate ".count($dati['ord'])." occorrenze tra articoli, commenti, album e immagini.</p><br/><br/>";
				}
				else{
				print "<div class='text-center'><h1 class='w3-lobster'>Results of the research for <span style='color:red'>".$w."</span></h1></div>";
				print "<p class='text-center small'>".count($dati['ord'])." results found among post, comments, albums and images.</p><br/><br/>";
				}


				// risultati ricerca
				print "<div class='card' style='margin:0; padding:20px'>";
				for ($i=0; $i<count($dati['ord']); $i++){
					$mysrc->risultati($url,$conn,$ling,$dati,$i);
					}
				print "</div>";
			}
			else{

				if ($ling=="it"){
				print "<div class='text-center'><h1 class='w3-lobster'>Nessun risultato trovato per <span style='color:red'>".$w."</span></h1></div>";
				print "<p class='text-center small'>Prova a cercare di nuovo utilizzando l'apposito form.</p>";
				}
				else{
				print "<div class='text-center'><h1 class='w3-lobster'>Sorry, no result found for <span style='color:red'>".$w."</span></h1></div>";
				print "<p class='text-center small'>Try to repeat the operation by using the search form.</p>";
				}
				
			}
			?>
			</div>
	
		</div>

        <!-- Sidebar Widgets Column -->
        <div class="col-sm-4">
		<br/><br/><br/>
		
			<!-- Posts -->
			<?php
			$myblg->blog_search($url,$ling,$w)
			?>

			<!-- Posts ordered by date-->
			<?php
			$myblg->blog_data($url,$conn,$ling)
			?>
 
			<!-- Labels / keys -->
			<?php
			$myobj->print_keys($url,$conn,$ling,20,"Keys");
			?>
		
		</div>

	<!-- END row-->
	</div>

<!-- END container-->
</div>


<?php
include "../cfg/footer.php";
?>
