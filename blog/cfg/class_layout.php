<?php
// FUNZIONI STRUTTURA PAGINA

class pagina{

// codifica-utf8
   function mb_convert_encoding($t) {
	$t = mb_convert_encoding($t, 'UTF-8');	   
    $t = str_replace("&gt;", ">", $t); // mantieni codici html 
    $t = str_replace("&lt;", "<",  $t); // mantieni codici html 
    $virg=chr(34); 
    $t = str_replace("''", $virg, $t); // sostituisci virgolette    
	return $t;
   }

// decodifica-utf8
function charset_decode_utf_8 ($string) {
    $string = stripslashes($string); // no barre #1
    $string=trim($string); // togli spazi ai lati

	/* Only do the slow convert if there are 8-bit characters */
    /* avoid using 0xA0 (\240) in ereg ranges. RH73 does not like that */
    if (!preg_match("/[\200-\237]/", $string)
     && !preg_match("/[\241-\377]/", $string)
    ) {
        return $string;
    }

    // decode three byte unicode characters
    $string = preg_replace("/([\340-\357])([\200-\277])([\200-\277])/e",
        "'&#'.((ord('\\1')-224)*4096 + (ord('\\2')-128)*64 + (ord('\\3')-128)).';'",
        $string
    );

    // decode two byte unicode characters
    $string = preg_replace("/([\300-\337])([\200-\277])/e",
        "'&#'.((ord('\\1')-192)*64+(ord('\\2')-128)).';'",
        $string
    );

	// mantieni codici html
    $string = str_replace(">", "&gt;", $string); 
    $string = str_replace("<", "&lt;", $string); 
    
	//$string=htmlentities($string);
    return $string;
    }



// array datetime: 2017-08-24 03:21:15 
	function mesiIT(){
		$mm['01']="Gennaio"; $mm['02']="Febbraio"; $mm['03']="Marzo";
		$mm['04']="Aprile"; $mm['05']="Maggio"; $mm['06']="Giugno";
		$mm['07']="Luglio"; $mm['08']="Agosto"; $mm['09']="Settembre";
		$mm['10']="Ottobre"; $mm['11']="Novembre"; $mm['12']="Dicembre";
	return $mm;
	}
	  function dayIT(){
	   $dd['Lunedì']="Mon"; $dd['Martedì']="Tue"; $dd['Mercoledì']="Wed";
		$dd['Giovedì']="Thu"; $dd['Venerdì']="Fri"; $dd['Sabato']="Sat";
		$dd['Domenica']="Sun";
	return $dd;
	}
	function mesiEN(){
	   $mm['01']="January"; $mm['02']="February"; $mm['03']="March";
		$mm['04']="April"; $mm['05']="May"; $mm['06']="June";
		$mm['07']="July"; $mm['08']="August"; $mm['09']="September";
		$mm['10']="October"; $mm['11']="November"; $mm['12']="Dicember";
	return $mm;
	}
	function dayEN(){
		$dd['Monday']="Mon"; $dd['Tuesday']="Tue"; $dd['Wednesday']="Wed";
		$dd['Thursday']="Thu"; $dd['Friday']="Fri"; $dd['Saturday']="Sat";
		$dd['Sunday']="Sun";
	return $dd;
	}
   

   function dataIT($datetime,$dateday) {
   $mm=$this->mesiIT();
   $mese=substr($datetime,5,2);
   $d=substr($datetime,8,2)." ".$mm[$mese]." ".substr($datetime,0,4);
   if ($dateday!=""){
	   $dd=$this->dayIT();
	   $key = array_search($dateday,$dd);
	   $d=$key." ".$d;
	   }
   $d=$d." <span class='glyphicon glyphicon-time'></span> ".substr($datetime,11,8);
   return $d;
   }

   function dataEN($datetime,$dateday) {
   $mm=$this->mesiEN();
   $mese=substr($datetime,5,2);
   $d=$mm[$mese]." ".substr($datetime,8,2);
   $suff="th"; $num=substr($datetime,9,1);
   if ($num=="1"){ $suff="st";}
   if ($num=="2"){ $suff="nd";}
   if ($num=="3"){ $suff="rd";}      
   $d=$d.$suff.", ".substr($datetime,0,4);
   if ($dateday!=""){
	   $dd=$this->dayEN();
	   $key = array_search($dateday,$dd);
	   $d=$key.", ".$d;
	   }
   $d=$d." <span class='glyphicon glyphicon-time'></span> ".substr($datetime,11,8);
   return $d;
   }

// leggi cartella file
	function read_files($url){
	$array=array();

		//Imposto la directory da leggere
		$directory = $url."files/";
		// Apriamo una directory e leggiamone il contenuto.
		if (is_dir($directory)) {
			//Apro l'oggetto directory
			if ($directory_handle = opendir($directory)) {
				//Scorro l'oggetto fino a quando non è termnato cioè false
				while (($file = readdir($directory_handle)) !== false) {
				//Se l'elemento trovato è diverso da una directory
				//o dagli elementi . e .. lo visualizzo a schermo
				if( (!is_dir($file))&($file!=".")&($file!="..")&($file!="index.php") ){
					$nome=$this->charset_decode_utf_8 ($file);
					$array[]=$nome;
					}
				}
			//Chiudo la lettura della directory.
			closedir($directory_handle);
			}
		}
	return $array;
	}

//	esegui sound
	function play_sound($src,$tipo){
	print "<audio controls>";
	print "<source src='".$src."' type='".$tipo."'>";
	print "</audio>";
	}

	
	
// visualizza album selezionato -> immagini modal
	function lightbox($url,$conn,$ling,$idAlbum,$album,$copertina,$riduz){
	$conta=0;

	$flink="Click to see all the pics";
	if($ling=="it"){
	$flink="Clicca per sfogliare le immagini contenute nell'album";
	}

			$sql_m="SELECT idFoto, titleEN, titleIT, data, file FROM foto WHERE OSC='n' AND idAlbum='".$idAlbum."' ORDER BY idFoto ASC";
			$result_m = mysqli_query($conn, $sql_m);
			while($m = mysqli_fetch_array($result_m,MYSQLI_ASSOC)) {

			// codifica utf8
			$titolo=$this->mb_convert_encoding($m['titleEN']);
				if($ling=="it"){
					$titolo=$this->mb_convert_encoding($m['titleIT']);
					}
			// data
			$pdata="";
			$pdata=$this->dataIT($m['data'],""); if ($ling=="en"){ $pdata=$this->dataEN($m['data'],""); }

			?>
					<a class="example-image-link" href="<?php print $url."images/".$m['file'];?>" title="<?php print $flink;?>" data-lightbox="example-set" data-title="<?php print $titolo." - ".$pdata." - Album: ".$album; ?>">

			<?php
				if ($copertina!=""){
					print "<img src='".$copertina."' ";
					}
					else{
					print "<img src='".$url."lay/streppa.png' ";
					}
					
				if ($conta>0){
					print "style='display: none' ";
					}
				if ($conta==0 && $riduz=="thumb"){
					print "style='width:auto; height: 150px;'";
					}
				if ($conta==0 && $riduz=="single"){
					print "class='img-thumbnail img-rounded' style='width:auto; height: 400px;'";
					}
				print "></a>";
			$conta++;
			}
		
	}


// text modal
	function textmodal($url,$myModal,$titolo,$testo,$chiudi){
?>
					<!-- Modal testo -->
					<div id="<?php print $myModal; ?>" class="modal fade" role="dialog" style="color: #444">
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
								<button type="button" class="btn btn-default" data-dismiss="modal"><?php print $chiudi;?></button>
								</div>
							</div>
						</div>
					</div>
<?php
}



// conta commenti per articolo
	function comm_conta($idArt,$conn){
		$tot=0;
			$sqlc="SELECT idComm FROM commenti WHERE OSC='n' AND idArt='".$idArt."'";
			$resultc = mysqli_query($conn, $sqlc);
			while($rowc = mysqli_fetch_array($resultc,MYSQLI_ASSOC)) {
				$tot++;
			}
		return $tot;
	}

// visualizza album allegato articolo
	function print_album($url,$conn,$ling,$idAlbum,$titoloSez){
		$sqla="SELECT album.idAlbum, album.titleIT, album.titleEN, album.testoEN, album.testoIT, foto.file, album.data FROM album, foto WHERE album.osc='n' AND album.idFoto=foto.idFoto AND album.idAlbum='".$idAlbum."'";
		$res_a = mysqli_query($conn, $sqla);
		$a = mysqli_fetch_array($res_a,MYSQLI_ASSOC);
		$copertina=$url."images/".$a['file'];
		$album=$this->mb_convert_encoding($a['titleEN']);
		$testo=$this->mb_convert_encoding($a['testoEN']);
			if($ling=="it"){
			$album=$this->mb_convert_encoding($a['titleIT']);
			$testo=$this->mb_convert_encoding($a['testoIT']);
			}
		$pdata="";
		$pdata=$this->dataIT($a['data'],""); if ($ling=="en"){ $pdata=$this->dataEN($a['data'],""); }
		// apri singole immagini dell'album in modal
		?>
				<div class="row">
					<div class="col-md-4">
					<h4 class="w3-lobster text-muted"><?php print $titoloSez; ?></h4>
					</div>
					<div class="col-md-4 text-center">
					<?php $this->lightbox($url,$conn,$ling,$idAlbum,$album,$copertina,"thumb"); ?>
					</div>
					<div class="col-md-4 text-left">
					<p style="color: #444"><?php print $album; ?> - <?php print $pdata; ?><br/><?php print $testo; ?></p>
					</div>
				</div>
		<?php
	}

// visualizza post
	function print_post($url,$conn,$ling,$lang,$tipo,$idArt,$titolo,$testo,$data,$img,$imgtit,$idAlbum,$file,$tag){
		?>
		<div class="card" style="margin:20px; padding:20px">
			<div class="row">
			<?php
			// immagine allegata
			if($img!="") {
			?>
					<div class="col-md-8">
					<p class="titblg"><?php print $titolo;?></p>
					<p class="small text-muted"><?php print $data; ?><br/><br/></p>
					</div>
					
					<div class="col-md-4 text-left">
					<div class="text-center text-muted small">
						<img src="<?php print $img; ?>" alt="immagine" class="img-thumbnail img-rounded" style="width:auto; height:150px; cursor:pointer" 
    onclick="onClick(this)"><br/><?php print $imgtit;?></a>
					</div>
					</div>
			<?php
			}
			else{
			?>
					<div class="col-md-12">
					<p class="titblg"><?php print $titolo;?></p>
					<p class="small text-muted"><?php print $data; ?><br/><br/></p>
					</div>
			<?php
			}
			?>	
			</div>

			<!-- file audio + nota -->
			<?php
			$estensione=strtolower(pathinfo($file,PATHINFO_EXTENSION));
			$src=$url."files/".$file;
			if ($tipo!="estratto" && $file!="" && $estensione=="mp3" | $estensione=="ogg"){ 
				print "<div style='background-color: #E3F1F5; margin:10px; padding:15px'>";
				?>
				<div class="row">
									
					<div class="col-md-8 text-left">
						<br/>
						<?php
						$this->play_sound($src,"audio/mpeg"); 		
						?>
						<br/><br/>
					</div>
					<div class="col-md-4 text-left">
						<br/>
						 <a data-toggle="collapse" data-target="#nota"> <span class="glyphicon glyphicon-info-sign"></span> <span class="text-muted"><?php print $lang['ATT_BT']; ?></span></a>
						<div id="nota" class="collapse"><?php print $lang['ATT_TXT']; ?></div> 
						<br/><br/>
					</div>
					

				</div>



			<?php
			print "</div>";
			}
			?>


	
			<!-- testo -->
			<div class="row">
					<div class="col-md-12">
					<p class="post">
						<?php 
						if ($tipo=="estratto"){
						$testo=strip_tags($testo);							
						}
						print nl2br($testo);
						?>
					</p>
					<br/><br/><br/><br/>
					</div>
			</div>
				
		<?php
		// post: estratto in pagina blog
		if ($tipo=="estratto"){
				?>
				<div class="row">
					<div class="col-md-6">
					<?php
					print "<p><a href='post.php?idArt=".$idArt."'><button class='btn btn-success btn-lg'>";
					print $lang['BT_READMORE'];
					print "</button></a></p>";
					?>
					</div>

					<?php
					$didComm="Comments";
					$attached="Attached";
					if ($ling=="it"){ 
					$didComm="Commenti";
					$attached="Allegato";
					}
					$commenti=$this->comm_conta($idArt,$conn);
					?>
					<div class="col-md-6">
					<p><span class="text-right post"><b>
					<?php
					if ($commenti>0){ print $didComm." <span class='label label-info'>".$commenti."</span>&nbsp;&nbsp;"; }
					if ($idAlbum>0){ print $attached." <span class='label label-default'> Album </span>&nbsp;&nbsp;"; }
					if ($file!=""){ print $attached." <span class='label label-default'> File </span>&nbsp;&nbsp;"; }
					?>
					</b>
					</p>
					</div>


				</div>
				
		</div>
		<?php
		}
		else{
		// visualizza allegati album
			if ($idAlbum>0){ 
				print "<div style='background-color: #F1F1F1; border-top:1px dashed #444; margin:10px; padding:15px'>";
				$titAlb="Attached album"; if ($ling=="it"){ $titAlb="Album allegato"; }
				$this->print_album($url,$conn,$ling,$idAlbum,$titAlb); 
				print "</div>";
				}

		// visualizza allegati file
			if ($file!="" && $estensione!="mp3" && $estensione!="ogg"){ 
				print "<div style='background-color: #F1F1F1; border-top:1px dashed #444; margin:10px; padding:15px'>";
				?>
				<div class="row">
					
					<div class="col-md-6">
					<h4 class="w3-lobster text-muted"><?php if ($ling=="en"){ print "Attached file"; }else{ print "File allegato"; } ?></h4>
					</div>
					<div class="col-md-6 text-left"><br/>
				<?php
					$peso=filesize($src); $kb=ceil($peso/1024);
					print "<a href='".$src."'><span class='glyphicon glyphicon-download-alt'></span> ".$file." (".$kb." Kb) </a>";					
				?>
					</div>
				</div>
				</div>
				<?php
				}
		
		// tag articolo
			if(count($tag)>0){
				print "<div class='row'>";
				print "<div class='col-md-12'>";
				print "<p class='post' style='line-height: 2em'><span class='label label-default'>TAG</span>&nbsp;&nbsp;";
				for ($i=0;$i<count($tag);$i++) {
					print "<a href='".$url."blog/tag.php?tag=".$tag[$i]."'> <button type='button' class='btn btn-warning'>".$tag[$i]."</button></a>&nbsp;";
					//<span class='label label-warning'>".$tag[$i]."</span></a>&nbsp;&nbsp;";
					}
				print "</p>";
				print "</div>";
				print "</div>";
			}
		?>
		</div>
		<?php
		// visualizza i commenti
			$tot=$this->comm_conta($idArt,$conn);
			if ($tot>0){
			?>
			<div class="card" style="margin:20px; padding:20px">

				<div class="row">					
					<div class="col-md-12 text-center">
					<h3 class="w3-lobster text-muted">
					<?php 
					if ($ling=="it"){ print "Commenti";}else{ print "Comments";}
					?>
					</h3>
					</div>
				</div>

				<?php
				$sqlv="SELECT idComm,autore,testo,data,streppa FROM commenti WHERE OSC='n' AND idArt='".$idArt."' ORDER BY data DESC";
				$resultv = mysqli_query($conn, $sqlv);
				while($v = mysqli_fetch_array($resultv,MYSQLI_ASSOC)) {
					$autore=$this->mb_convert_encoding($v['autore']);
					$testo=$this->mb_convert_encoding($v['testo']);

					print "<div class='row'>";
						print "<div class='col-md-3 text-right'>";
						print "<h4 class='lead'><span class='glyphicon glyphicon-comment small'></span> <b>";
						// commento admin?
						if ($v['streppa']=="s"){
							print "<span style='color:red'>Streppacugge</span>";
							}
							else{
							print $autore;
							}
						print "</b></h4> ";

						$pdata="";
						$pdata=$this->dataIT($v['data'],""); if ($ling=="en"){ $pdata=$this->dataEN($v['data'],""); }
						print "<p class='small'>".$pdata."</p>";	
						print "</div>";
						print "<div class='col-md-9 text-left'>";
						print "<p class='bg-info post' style='padding:20px'>".nl2br($testo)."</p>";
						print "</div>";
					print "</div>";
					}
			?>
			</div>
			<?php
			}
		}
	}

// elenco o selezione completa dei tag (parole chiave) per tutti gli articoli 
   function print_keys($url,$conn,$ling,$quante,$titolo) {
	   $tag="tagEN"; if ($ling=="it"){ $tag="tagIT"; }

		$total=array();			//array voti (classif)
		// estrai tag		
			$sql="SELECT ".$tag." FROM articoli WHERE osc='n' ORDER BY idArt ASC";
			$result = mysqli_query($conn, $sql);
			while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)){

				$array=$this->mb_convert_encoding($row[$tag]);
				$tagkey =  explode(',', $array);
				foreach ($tagkey as $item) {
					if($item!=""){
						array_push($total, stripslashes(strtolower(trim($item))));					// accoda variabili nell'array voti
					}
				
				}
			}

		// conteggi
		$tagtot=count($total);

		asort ($total); 			// ordina lista
		$confronto=$total;		// crea lista x confronto
		$tr1=array_unique($confronto); 	// scrematura
		$tr2=array_flip($tr1);
		$confronto=$tr2;

		for(reset($confronto); $index=key($confronto); next($confronto))
		{
		$a=0;
		$confronto[$index]=$a;
		}

		for($n=0; $n<$tagtot; $n++)		// conteggio
		{
		$chiave=$total[$n];
		if (array_key_exists($chiave, $confronto)) 
		{
		$confronto[$chiave]++;
		}
		}

		arsort($confronto);		// ordinamento
		$classifica=$confronto;		// array classifica (definitivo x visualizzazione)

		// visualizza tag
		$j=0;
		?>
		<div class="index-content text-center" style="margin:0; padding:0">
		<div class="list-group" style="padding:20px">
			<div class="text-center">
			<h2 class="w3-lobster text-info"><?php print $titolo; ?></h2><br/>
		<p style="line-height: 3em">
		<?php
		for(reset($classifica); $index=key($classifica); next($classifica))
		{
		$j++;
		if ($j<=$quante){
			$ptg=stripslashes(trim(strtolower($index)));
			print "<a href='".$url."blog/tag.php?tag=".$ptg."'><button type='button' class='btn btn-primary'>".$ptg." <span class='badge'>".$classifica[$index]."</span></button></a> ";
			}
		}
		?>
		</p>
		</div>
		</div>
		</div>
		<?php


   }


// funzione
   function nomefunzione() {
   }
}   
?>
