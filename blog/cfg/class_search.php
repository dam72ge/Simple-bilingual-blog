<?php
// motore ricerca interno
class mysrc extends pagina{

// percentuale esattezza riscontro (confrontando parola cercata con intero estratto db)
	function perc($w,$stringa){
		$tot=strlen($stringa);
		$perc=0;
		$conta=0;
		if ($tot>0){
			for ($i=0; $i<$tot; $i++){
			if (substr($w,$i,1)==substr($stringa,$i,1)){ $conta++; }
			}
			$perc=ceil(($conta/$tot)*100);
		}
		return $perc;
		}

	
// estratto
	function estratto($stringa,$w){
		$pos=mb_strpos($stringa,$w);
		$ad=$pos-50; if($ad<0) $ad=0;
		$lungh=strlen($stringa);
		$w_lungh=strlen($w);
		
		$parz=substr($stringa,0,($pos))."<u>".$w."</u>".substr($stringa,($pos+$w_lungh),($lungh+7));
		
		if ($lungh<100) { $estratto=$parz; }else{ 
			$estratto="...".substr($parz,$ad, 100)."..."; 
			}
		return $estratto;
		}

// aggiungi all'array ricerca
	function add_array($array,$ord,$idArt,$idComm,$idAlbum,$idFoto,$file,$titolo,$tipo,$estratto,$perc){
		$array['ord'][]=$ord;
		$array['idArt'][]=$idArt;
		$array['idComm'][]=$idComm;
		$array['idAlbum'][]=$idAlbum;
		$array['idFoto'][]=$idFoto;
		$array['file'][]=$file;
		$array['titolo'][]=$titolo;
		$array['tipo'][]=$tipo;
		$array['estratto'][]=$estratto;
		$array['perc'][]=$perc;
		return $array;
	}

// visualizza risultati
	function risultati($url,$conn,$ling,$dati,$i){

	if ($dati['perc'][$i]>0){
	
		
		switch($dati['ord'][$i]){

			case "a":
			print "<h4><a href='".$url."blog/post.php?idArt=".$dati['idArt'][$i]."'>".$dati['titolo'][$i]."</a></h4>";
			print "<p class='post'><i>".$dati['estratto'][$i]."</i></p>";
			print "<p class='small' style='color:green'>Accuracy: <b>".$dati['perc'][$i]."%</b> - Type of result: <b>".$dati['tipo'][$i]."</b></p><br/>";
			break;
			
			case "b":
			print "<h4><a href='".$url."index.php#album'>".$dati['tipo'][$i]."</a></h4>";
			$this->lightbox($url,$conn,$ling,$dati['idAlbum'][$i],$dati['titolo'][$i],"","thumb"); print "<br/>";
			print "<p class='post'><i>".$dati['estratto'][$i]."</i></p>";
			print "<p class='small' style='color:green'>Accuracy: <b>".$dati['perc'][$i]."%</b> - Type of result: <b>".$dati['tipo'][$i]."</b></p><br/>";
			break;

			case "c":
			print "<p class='post' style='color:#005AB2'><b>".$dati['tipo'][$i]."</b></p>";
			print "<img src='".$url."images/".$dati['file'][$i]."' alt='immagine' class='img-thumbnail img-rounded' style='width:auto; height:150px; cursor:pointer' 
    onclick='onClick(this)'><br/>";
			print "<p class='post'><i>".$dati['estratto'][$i]."</i></p>";
			print "<p class='small' style='color:green'>Accuracy: <b>".$dati['perc'][$i]."%</b> - Type of result: <b>".$dati['tipo'][$i]."</b></p><br/>";
			break;
		}

	}
	}







// fine classe
}
?>
