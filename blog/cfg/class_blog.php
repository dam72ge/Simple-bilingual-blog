<?php
// post, commenti, album e immagini
class myblg extends pagina{

// ultimi 4 post estratto homepage, senza immagini allegate
	function latest_post($conn,$ling,$lang){

			$sql="SELECT idArt, titleEN, titleIT, datetime, dateday, idFoto FROM articoli WHERE OSC='n' ORDER BY idArt DESC LIMIT 4";
			$result = mysqli_query($conn, $sql);
			while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
			// data
				$pdata=$this->dataEN($row['datetime'],$row['dateday']);
				if($ling=="it"){ $pdata=$this->dataIT($row['datetime'],$row['dateday']); }
				
			// codifica utf8
				$titolo=$this->mb_convert_encoding($row['titleEN']);
				if($ling=="it"){
					$titolo=$this->mb_convert_encoding($row['titleIT']);
				}

			// estratto titolo
			$lunghezza=strlen($titolo);
			if ($lunghezza>75){ $titolo=substr($titolo,0,75); $titolo.="...";}

			?>
			<a href="blog/post.php?idArt=<?php print $row['idArt'];?>">
			    <div class="col-lg-3">
                    <div class="card">

					<?php
					// immagine allegata
						if($row['idFoto']>0) {
						$sql1="SELECT file,titleIT,titleEN FROM foto WHERE OSC='n' AND idFoto='".$row['idFoto']."'";	
						$result1 = mysqli_query($conn, $sql1);
						$f = mysqli_fetch_array($result1,MYSQLI_ASSOC);
							if($f['file']!="") { 
							print "<img src='images/".$f["file"]."' alt='immagine' style='width:100%; height:200px'>";
							}					
						}
						else{
							print "<img src='sfondi/nuclear.jpg' style='width:100%; height:200px'>";							
							}
						?>
                        <h4><?php print $titolo;?></h4>
						<p class="small text-muted"><?php print $pdata;?></p>
						<br/><br/>                      
                        <a href="blog/post.php?idArt=<?php print $row['idArt'];?>" class="blue-button"><?php print $lang['BT_READMORE']; ?></a> <br/><br/>
                    </div>
                    <br/><br/>
                </div>
            </a>
			<?php		
			}	
	}
	
// post estratti pagina blog centro, con immagini allegate
	function blog($tipo,$url,$conn,$ling,$lang,$where){
	?>
	<div class="index-content" style="margin:0; padding:0">
	<?php
	if ($tipo!="latest" && $ling=="it"){
		print "<div class='text-center'><h1 class='w3-lobster'>Post che contengono <span style='color:red'>".$tipo."</span></h1></div>";
		}
	if ($tipo!="latest" && $ling=="en"){
		print "<div class='text-center'><h1 class='w3-lobster'>Posts including <span style='color:red'>".$tipo."</span></h1></div>";
		}


			$sql="SELECT idArt, titleEN, titleIT, testoEN, testoIT, datetime, dateday, idFoto, tagIT, tagEN, idAlbum, file FROM articoli ".$where;
			$result = mysqli_query($conn, $sql);
			while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {	
			// data
				$pdata=$this->dataEN($row['datetime'],$row['dateday']);
				if($ling=="it"){ $pdata=$this->dataIT($row['datetime'],$row['dateday']); }
			
			// codifica utf8
				$titolo=$this->mb_convert_encoding($row['titleEN']);
				$testo=$this->mb_convert_encoding($row['testoEN']);
				if($ling=="it"){
					$titolo=$this->mb_convert_encoding($row['titleIT']);
					$testo=$this->mb_convert_encoding($row['testoIT']);
				}
			// estratto testo (500 caratteri max)
				$lunghezza=strlen($testo);
				if ($lunghezza>75){ $testo=substr($testo,0,500); $testo.=" [...]"; }

			// immagine allegata
				$img=""; $imgtit="";
				if($row['idFoto']>0) {
					$sql1="SELECT file,titleIT,titleEN FROM foto WHERE OSC='n' AND idFoto='".$row['idFoto']."'";
					$result1 = mysqli_query($conn, $sql1);
					$f = mysqli_fetch_array($result1,MYSQLI_ASSOC);
					if($f['file']!="") { 
						$img=$url."images/".$f['file'];
						// codifica utf8
						$imgtit=$this->mb_convert_encoding($f['titleEN']);
						if($ling=="it"){
							$imgtit=$this->mb_convert_encoding($f['titleIT']);
						}
					}
				}

			// visualizza
			$this->print_post($url,$conn,$ling,$lang,"estratto",$row['idArt'],$titolo,$testo,$pdata,$img,$imgtit,$row['idAlbum'],$row['file'],0);
			}	
	?>
	</div>
	<?php
	}
	
// post selezionato in centro con immagine allegata
	function post($idArt,$url,$conn,$ling,$lang){
			$sql="SELECT idArt, osc, titleEN, titleIT, testoEN, testoIT, datetime, dateday,idFoto,idAlbum,file FROM articoli WHERE idArt='".$idArt."'";
			$result = mysqli_query($conn, $sql);
			$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
				
			// data
				$pdata=$this->dataEN($row['datetime'],$row['dateday']);
				if($ling=="it"){ $pdata=$this->dataIT($row['datetime'],$row['dateday']); }
			
			// codifica utf8
				$titolo=$this->mb_convert_encoding($row['titleEN']);
				$testo=$this->mb_convert_encoding($row['testoEN']);
				if($ling=="it"){
					$titolo=$this->mb_convert_encoding($row['titleIT']);
					$testo=$this->mb_convert_encoding($row['testoIT']);
				}
			// immagine allegata
				$img=""; $imgtit="";
				if($row['idFoto']>0) {
					$sql1="SELECT file,titleIT,titleEN FROM foto WHERE OSC='n' AND idFoto='".$row['idFoto']."'";
					$result1 = mysqli_query($conn, $sql1);
					$f = mysqli_fetch_array($result1,MYSQLI_ASSOC);
					if($f['file']!="") { 
						$img=$url."images/".$f['file'];
						// codifica utf8
						$imgtit=$this->mb_convert_encoding($f['titleEN']);
						if($ling=="it"){
							$imgtit=$this->mb_convert_encoding($f['titleIT']);
						}
					}
				}
			// tag
					$tag=array();
					$sql_t="SELECT tagEN, tagIT FROM articoli WHERE osc='n' AND idArt='".$idArt."'";
					$result_t = mysqli_query($conn, $sql_t);
					$t = mysqli_fetch_array($result_t,MYSQLI_ASSOC);			
						$array=$this->mb_convert_encoding($t['tagEN']);
						if($ling=="it"){$array=$this->mb_convert_encoding($t['tagIT']);}
						$tagkey =  explode(',', $array);
						foreach ($tagkey as $item) {
						if($item!="") $tag[]=trim(strtolower($item)); 
						}


			// visualizza
			$this->print_post($url,$conn,$ling,$lang,"completo",$row['idArt'],$titolo,$testo,$pdata,$img,$imgtit,$row['idAlbum'],$row['file'],$tag);
	}

// visualizza form per commentare - idComm, osc, idArt, testo, autore, data, email
	function comm_form($idArt,$ling){
		$lb_text="Commenta questo post"; $lb_text_ph="Scrivi qui il tuo commento";
		$lb_auth="Il tuo nome"; $lb_auth_ph="Scrivi qui il tuo nome";
		$lb_mail="La tua mail"; $lb_mail_ph="tuoindirizzo@host.it";
		$lb_fac="facoltativa, non sarà pubblicata";
		$lb_obbl="campo obbligatorio";
		$lb_subm="INVIA";
		if ($ling=="en"){
		$lb_text="Leave your comment"; $lb_text_ph="Write here your comment";
		$lb_auth="Your name"; $lb_auth_ph="Write here your name";
		$lb_mail="Your e-mail"; $lb_mail_ph="youraddress@host.com";
		$lb_fac="facultative, will not be published";
		$lb_obbl="required field";
		$lb_subm="SEND";
		}
    ?>
	<div class="card" style="margin:20px; padding:40px">

       <form id="modulo" name="modulo" method="post" action="sendcomm.php?idArt=<?php print $idArt; ?>">
		<div class="row form-group">

			<div class="col-md-6 w3-col">
				<label class="w3-lobster" for="comment"><b><?php print $lb_text; ?> <span style="color:red">*</span></b></label><br/>
				<textarea class="form-control" name="testo" rows="10" cols="30" placeholder="<?php print $lb_text_ph; ?>" required></textarea>
				<br/><br/>
			</div>
			
			<div class="col-md-6 w3-col w3-padding">
				<label class="w3-lobster" for="name"><b><?php print $lb_auth; ?> <span style="color:red">*</span></b></label><br/>
				<input class="form-control" type="text" name="autore" placeholder="<?php print $lb_auth_ph; ?>" required><br/><br/>
				<label class="w3-lobster" for="email"><b><?php print $lb_mail; ?></b></label> (<?php print $lb_fac; ?>)<br/>
				<input class="form-control" type="email" name="email" placeholder="<?php print $lb_mail_ph; ?>"><br/><br/>
				<input type="hidden" value="a" name="osc">
				<input type="hidden" value="<?php print $idArt;?>" name="idArt">
				<input type="hidden" value="<?php print date("Y-m-d H:i:s");?>" name="data">
				<br/>
				<button class="btn btn-success btn-block" type="submit" name="login"><?php print $lb_subm; ?></button>
				<br/>
				<span style="color:red"><b>*</b></span> <span style="color:gray">= <?php print $lb_obbl; ?></span><br/>
			</div>

		</div>
       </form>
	</div>
    <?php
	}

// menu articolo - lista post recenti (colonna dx, visualizza singolo articolo)
	function menu_post($conn,$ling,$where){
		?>
	<div class="index-content" style="margin:0; padding:0">
		<div class="list-group" style="padding:20px">
		<div class="text-center">
		<h2 class="w3-lobster text-info">
			<?php
			if($ling=="it"){ print "Post recenti"; } else { print "Recent posts"; }
			?>
		</h2>
		</div>
<?php
			$sql="SELECT idArt, titleEN, titleIT, datetime, dateday FROM articoli ".$where;
			$result = mysqli_query($conn, $sql);
			while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
			// data
				$pdata=$this->dataEN($row['datetime'],$row['dateday']);
				if($ling=="it"){ $pdata=$this->dataIT($row['datetime'],$row['dateday']); }
				
			// codifica utf8
			$titolo=$this->mb_convert_encoding($row['titleEN']);
				if($ling=="it"){
					$titolo=$this->mb_convert_encoding($row['titleIT']);
				}

			// estratto titolo (75 caratteri max)
			$lunghezza=strlen($titolo);
			if ($lunghezza>75){ $titolo=substr($titolo,0,75); $titolo.="...";}

			?>
			<a href="post.php?idArt=<?php print $row['idArt'];?>" class="list-group-item"> <p><b><?php print $titolo;?></b></p><span class="small"><?php print $pdata;?></span></a>
			<?php
			}	
		?>
		</div>
		<br/><br/>
</div>
		<?php
	}


// menu blog - articoli per data (colonna dx)
	function blog_data($url,$conn,$ling){

		// conta post per anno (al fine di visualizzare solo anni attivi)
		$dati=array(
		"anno" => array (""),
		"post" => array ("")
		);
		$sql_p="SELECT datetime FROM articoli WHERE osc='n' ORDER BY datetime DESC, idArt DESC";
		$result_p = mysqli_query($conn, $sql_p);
		while($p = mysqli_fetch_array($result_p,MYSQLI_ASSOC)){
		$cfr=substr($p['datetime'],0,4);	
		if(!in_array($cfr,$dati['anno'])){ $dati['anno'][]=$cfr; $dati['post'][]=1;}
		else { 
		$q=array_search($cfr,$dati['anno']); $dati['post'][$q]=$dati['post'][$q]+1;
		}
		}
		$totAnni=count($dati['anno']);
		?>
		
		<div class="index-content text-center" style="margin:20px; padding:0">
		<div class="card" style="padding:20px">
			<br/><br/>
			<h3 class="w3-lobster text-info">
			<?php
			if($ling=="en"){ print "All posts ordered by date"; } else{ print "Tutti i post ordinati per data"; }
			?>
			</h3>
			<br/>

			<?php
			if($ling=="en"){ $mm=$this->mesiEN(); $dd=$this->dayEN();} else{ $mm=$this->mesiIT(); $dd=$this->dayIT(); }
			
			for($x=1; $x<$totAnni; $x++){
			$year=$dati['anno'][$x];

			print "<button class='accordion'><h2>".$year." <span class='badge'>".$dati['post'][$x]."</span> </h2></button>"; 
			print "<div class='panel'>";	
					
				for($y=12; $y>0; $y--){
				$z=$y; if($z<10){$z="0".$z;}
				print "<h4>".$mm[$z]."</h4>";

				$cfr=$year."-"; if ($y<10){ $cfr.="0";} $cfr.=$y;

					$sql_mm="SELECT idArt,titleEN,titleIT,datetime,dateday FROM articoli WHERE osc='n' ORDER BY datetime DESC, idArt DESC";
					$result_mm = mysqli_query($conn, $sql_mm);
					while($a = mysqli_fetch_array($result_mm,MYSQLI_ASSOC)){
							$estr=substr($a['datetime'],0,7); 
							$key = "<b>".substr($a['datetime'],8,2).", ".array_search($a['dateday'],$dd)."</b>";

							// codifica utf8
							$titolo=$this->mb_convert_encoding($a['titleEN']);
							if($ling=="it"){
							$titolo=$this->mb_convert_encoding($a['titleIT']);
							}
							// visualizza
							if ($cfr==$estr){ 								
								print "<span style='color:#777; '>".$key."</span> <a href='".$url."blog/post.php?idArt=".$a['idArt']."' class='datapost'><i>, ".$titolo."</i></a><br/>";
								}
							}
							

				}

			print "</div>";			
			}
			?>
		<br/><br/><br/><br/>
		</div>
		</div>
		<?php

	}

// menu blog - form cerca nei post
	function blog_search($url,$ling,$word){
		$lb_w="Cosa stai cercando?"; $lb_text_w="Scrivi qui la parola o la frase da trovare";
		$lb_subm="TROVA";
		if ($ling=="en"){
		$lb_w="What are you looking for?"; $lb_text_w="Please write here the word o the phrase";
		$lb_subm="SEARCH";
		}
		if ($word!=""){ $word="value='".$word."'";}
    ?>
	<div class="index-content" style="margin:0; padding:0">
	<div class="card text-center" style="margin:20px; padding:40px">

       <form id="cerca" name="cerca" method="post" action="<?php print $url;?>blog/search.php">
		<div class="row form-group">

			<div class="col-md-12">
				<label class="w3-lobster" for="word"><b><?php print $lb_w; ?></b></label><br/>
				<input class="form-control" type="text" name="w" placeholder="<?php print $lb_text_w; ?>" <?php print $word; ?> required><br/><br/>
				<button class="btn btn-success" type="submit" name="cerca"><?php print $lb_subm; ?></button>
			</div>

		</div>
       </form>
	</div>
	</div>
    <?php
	}


// fine classe
}
?>
