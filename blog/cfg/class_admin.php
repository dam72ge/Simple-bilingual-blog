<?php
// post, commenti, album e immagini
class mysql extends pagina{

// menù avanti indietro
	function avad($conn,$urlpag,$id,$ultimo){   		
	$ad=$id-1; if($ad<=0){ $ad=$ultimo; }
	print "<a href='".$urlpag.$ad."'>Back</a> | ";
	$av=$id+1; if($av>$ultimo){ $av=1; }
	print "<a href='".$urlpag.$av."'>Forward</a> | ";
	print "<a href='".$urlpag."1'>Start</a> | ";
	print "<a href='".$urlpag.$ultimo."'>Last</a>";	
	print "<hr><br/>";
    }

// ELEMENTI FORM COMUNI
	function form_removed(){
				print "
				<br/><br/><br/><br/>
				<p>REMOVED. You can not modify or substitute this element any more.</p>
				<br/><br/><br/><br/><br/>
				<br/><br/><br/><br/><br/>
				<br/><br/><br/><br/><br/>
				<br/><br/><br/><br/><br/>
				";
	}

	function form_osc($sel){
		?>
				<label>Visibility</label><br/>
				<p style="border:1px solid #4CB310; padding:5px">
				<input  type="radio" name="osc" value="n" <?php if($sel=="n") print "checked"; ?> /> Public<br/>
				<input class="w3-radio" type="radio" name="osc" value="s" <?php if($sel=="s") print "checked"; ?> /> Draft<br/>
				<input class="w3-radio" type="radio" name="osc" value="r" <?php if($sel=="r") print "checked"; ?> /> Remove
				</p>
		
		<?php
	}
	function form_data($sel,$name,$required){
		?>
				<label><b>Datetime</b> (<i>AAAA-MM-GG HH-MM-SS</i>)</label> <!-- year month day, hours(0-24)-min-sec -->
				<input class="form-control" type="datetime-local" value="<?php print $sel;?>" name="<?php print $name; ?>" <?php print $required; ?>>
		<?php
	}
	function form_giorno($sel, $required){
		?>
				<label><b>Day</b> (<i>Mon-Sun GMT</i>)</label> <!-- day(Mon-Sun) -->
				<input class="form-control" type="text" value="<?php print $sel;?>" name="dateday" <?php print $required; ?>>
		<?php
	}
	function form_foto($url,$label,$conn,$idFoto,$where){
		?>
				<label><b><?php print $label; ?></b></label><br/>
				<select name="idFoto" class="form-control" style="border:1px solid #4CB310; padding:5px">
					<?php
					$foto=""; $fotoNome="";
					$sql1="SELECT idFoto,titleIT,file FROM foto WHERE osc='n' ".$where." ORDER BY titleIT ASC";
					$result1 = mysqli_query($conn, $sql1);
					while($f=mysqli_fetch_array($result1,MYSQLI_ASSOC)){
						print "<option value='".$f['idFoto']."' ";
						if ($idFoto==$f['idFoto'] && $idFoto>0) {print "selected"; $foto=$f['file']; $fotoNome=$f['titleIT']; }
						print ">".$f['titleIT']."</option>";
					}
						print "<option value='0' ";
						if ($idFoto==0){ print "selected"; }
						print ">Np file attached</option>";
					?>
				</select>
				
				<?php
				if ($foto!=""){
					print "<label><b>Thumbnail</b></label><br/>";
					print "<img src='".$url."images/".$foto."' width='100px' title='".$fotoNome."'><br/><br/><br/>"; 
					}
	}
	function form_album($url,$conn,$idAlbum){
				?>
				<label>Album</label><br/>
				<select class="form-control" name="idAlbum" style="border:1px solid #4CB310; padding:5px">
					<?php
					$sql1="SELECT idAlbum,titleIT FROM album WHERE osc='n' ORDER BY titleIT ASC";
					$result1 = mysqli_query($conn, $sql1);
					while($f=mysqli_fetch_array($result1,MYSQLI_ASSOC)){
						print "<option value='".$f['idAlbum']."' ";
						if ($idAlbum==$f['idAlbum'] && $idAlbum>0) {print "selected"; }
						print ">".$f['titleIT']."</option>";
					}
						print "<option value='0' ";
						if ($idAlbum==0){ print "selected"; }
						print ">No album</option>";
					?>
				</select>
				<br/>
				<?php
	}
	function form_file($url,$nomeFile){
				?>
				<label>File</label><br/>
				<select class="form-control" name="file" class="form-control" style="border:1px solid #4CB310; padding:5px">
					<?php
					$f=$this->read_files($url); // array file nella cartella files
					$arrlength=count($f);
					if ($arrlength>0){
						for($x = 0; $x < $arrlength; $x++) {
							$item=$this->charset_decode_utf_8 ($f[$x]);
							print "<option value='".$item."' ";
							if ($nomeFile==$item) {print "selected"; }
							print ">".$item."</option>";	
						}
					}
						print "<option value='' ";
						if ($nomeFile==""){ print "selected"; }
						print ">No file attached</option>";
					?>
				</select>
				<br/>
				<?php
	}
	function form_artcomm($conn,$idCfr){
				?>
				<label>Linked post</label><br/>
				<select name="idArt" class="form-control" style="border:1px solid #4CB310; padding:5px">
					<?php
						print "<option value='0' ";
						if ($idCfr==0){ print "selected"; }
						print ">No post</option>";
					$idArt=""; 
					$sql1="SELECT idArt,titleIT FROM articoli ORDER BY titleIT ASC";
					$result1 = mysqli_query($conn, $sql1);
					while($a=mysqli_fetch_array($result1,MYSQLI_ASSOC)){
						print "<option value='".$a['idArt']."' ";
						if ($idCfr==$a['idArt']) {print "selected"; }
						$articolo=$this->mb_convert_encoding($a['titleIT']);
						print ">".$articolo."</option>";
					}
					?>
				</select>
				<?php
	}

	function form_input($label,$name,$value,$placeholder, $required){
				?>
				<label><?php print $label; ?></label>
				<input class="form-control" type="text" value="<?php print $value;?>" name="<?php print $name;?>" placeholder="<?php print $placeholder;?>" <?php print $required; ?>>
				<?php
	}
	function form_textarea($label,$name,$value,$placeholder, $required){
				?>
				<label><?php print $label;?></label>
				<textarea class="form-control" name="<?php print $name;?>" rows="10" cols="30" placeholder="<?php print $placeholder;?>" <?php print $required; ?>><?php print $value;?></textarea>
				<?php
	}


// LISTS ORDERED BY SELECTION

	// lista post
	function lista_post($urlAdm,$conn,$where){    
	$sql="SELECT idArt, titleIT, datetime FROM articoli ".$where;
	$result = mysqli_query($conn, $sql);
			while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
				
			// codifica utf8
			$titleIT=$this->mb_convert_encoding($row['titleIT']);

			print $row['idArt']. ") <a href='".$urlAdm."modif_post.php?idArt=".$row['idArt']."'>".$titleIT. "</a> ".$row["datetime"]."<br/>";
			}
    }


	// lista commenti
	function lista_commenti($urlAdm,$conn,$where){    
	$sql="SELECT idComm, osc, autore, data, streppa FROM commenti ".$where;
	$result = mysqli_query($conn, $sql);
			while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
				
			// codifica utf8
			$stato="<span class='bg-warning'>NEW, TO BE AUTHORIZED</span>";
			switch($row['osc']){
				case "s": $stato="<span class='bg-danger'>OBSCURED</span>"; break;
				case "n": $stato="<span class='bg-success'>PUBLISHED</span>"; break;
				}

			// autore
			$autore=$this->mb_convert_encoding($row['autore']);
			if($row['streppa']=="s"){ $autore="<b>".$autore."</b> [ADMIN]"; }

			print $row['idComm']. ") <a href='".$urlAdm."modif_comm.php?idComm=".$row['idComm']."'>".$autore. "</a> ".$stato. " - ".$row["data"]."<br/>";
			}
    }


	// lista album
	function lista_album($urlAdm,$conn,$where){    
	$sql="SELECT idAlbum, titleIT, data FROM album ".$where;
	$result = mysqli_query($conn, $sql);
			while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
			print $row['idAlbum']. ") <a href='".$urlAdm."modif_album.php?idAlbum=".$row['idAlbum']."'>".$row["titleIT"]. "</a> ".$row["data"]."<br/>";
			}
    }



	// lista foto per album
	function lista_foto($url,$urlAdm,$conn){    
	$sql="SELECT idAlbum, titleIT FROM album ORDER BY titleIT ASC";
	$result = mysqli_query($conn, $sql);
			while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
			print "<h3>".$row["titleIT"]. "</h3>";

				$sql_f="SELECT idFoto, titleIT, idAlbum,file FROM foto WHERE idAlbum='".$row['idAlbum']."' ORDER BY idFoto DESC";
				$result_f = mysqli_query($conn, $sql_f);
				while($f = mysqli_fetch_array($result_f,MYSQLI_ASSOC)) {
				print "<a href='".$urlAdm."modif_img.php?idFoto=".$f['idFoto']."'><img src='".$url."images/".$f["file"]."' style='width:50px' title='".$f["titleIT"]."'></a>&nbsp;&nbsp;&nbsp;";
				}
				
			print "<br/><br/>";

			}


    }




// fine classe
}
?>
