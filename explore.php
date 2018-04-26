<?php

// si le repertoire a été changé
if (isset($_GET['dossier'])) {
	$dossier = $_GET['dossier'];
}else{
	//changer pour explorer le dossier racine
	$dossier = 'assets';
	//$dossier = '../explo_php';
}

// fonction pour meilleure lecture des tailles
function formatBytes($size, $precision = 2)
{
    $base = log($size, 1024);
    $suffixes = array('octets', 'Ko', 'Mo', 'Go', 'To');   

    return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
}

//lance la fonction
explore($dossier);


function explore($dossier){

	//affiche le repertoire courant
	echo '<div class="card-panel col s12 m6 offset-m3 grey lighten-1 black-text center current z-depth-3"><h5>'.$dossier.'/</h5></div><br><br>';
	$iterator = new FilesystemIterator($dossier, FilesystemIterator::UNIX_PATHS);

	foreach($iterator as $element){

			// si c'est un dossier
		if ($element->isDir()) {

				// mise en forme et lien
				// réassigne le répertoire si clique et relance la fonction
				// compte le nb de fichiers dans dossier
			$dir = $element->getPathname();
			$nbFiles = (count(scandir($dir)) - 2);

			echo '<div class="col s12 m6 l4"><div class="card horizontal grey darken-3 z-depth-3"><div class="card-image valign-wrapper"><img src="./images/folder.png"></div><div class="card-stacked"><div class="card-content valign-wrapper"><p><a href="index.php?dossier='.$dir.'" class="white-text">'.$element->getFilename().'</a><br><a class="black-text files">'.$nbFiles.' fichier(s)</a></p></div></div></div></div>'.PHP_EOL;
		}

			// si c'est un fichier
		if ($element->isFile()) {

			$path = $element->getPathname();

			if(preg_match("/\.(gif|png|jpg|jpeg|svg)$/", $element)){

				echo '<div class="col s12 m6 l4"><div class="card horizontal grey darken-3 z-depth-3"><div class="card-image valign-wrapper"><img src="./images/jpg.png" width="64" height="64"></div><div class="card-stacked"><div class="card-content valign-wrapper"><p><a href="'.$path.'" class="white-text">'.$element->getFilename().'</a><br><a class="black-text files">'.formatBytes($element->getSize()).'</a></p></div></div></div></div>'.PHP_EOL;

			}
			elseif (preg_match("/\.(mp3|flac|wav|wma)$/", $element)) {
				echo '<div class="col s12 m6 l4"><div class="card horizontal grey darken-3 z-depth-3"><div class="card-image valign-wrapper"><img src="./images/mp3.png" width="64" height="64"></div><div class="card-stacked"><div class="card-content valign-wrapper"><p><a href="'.$path.'" class="white-text">'.$element->getFilename().'</a><br><a class="black-text files">'.formatBytes($element->getSize()).'</a></p></div></div></div></div>'.PHP_EOL;
			}
			elseif (preg_match("/\.(mp4|mkv|avi|webm|ogg|mpg|mpeg|mp2|mpv|m4p|m4v|mpe|flv)$/", $element)) {

				echo '<div class="col s12 m6 l4"><div class="card horizontal grey darken-3 z-depth-3"><div class="card-image valign-wrapper"><img src="./images/mpg.png" width="64" height="64"></div><div class="card-stacked"><div class="card-content valign-wrapper"><p><a href="'.$path.'" class="white-text">'.$element->getFilename().'</a><br><a class="black-text files">'.formatBytes($element->getSize()).'</a></p></div></div></div></div>'.PHP_EOL;
			}
			elseif (preg_match("/\.(pdf)$/", $element)) {

				echo '<div class="col s12 m6 l4"><div class="card horizontal grey darken-3 z-depth-3"><div class="card-image valign-wrapper"><img src="./images/pdf.png" width="64" height="64"></div><div class="card-stacked"><div class="card-content valign-wrapper"><p><a href="'.$path.'" class="white-text">'.$element->getFilename().'</a><br><a class="black-text files">'.formatBytes($element->getSize()).'</a></p></div></div></div></div>'.PHP_EOL;
			}
			elseif (preg_match("/\.(html|php|js|xml|htm|mpg|css)$/", $element)) {

				echo '<div class="col s12 m6 l4"><div class="card horizontal grey darken-3 z-depth-3"><div class="card-image valign-wrapper"><img src="./images/xml.png" width="64" height="64"></div><div class="card-stacked"><div class="card-content valign-wrapper"><p><a href="'.$path.'" class="white-text">'.$element->getFilename().'</a><br><a class="black-text files">'.formatBytes($element->getSize()).'</a></p></div></div></div></div>'.PHP_EOL;
			}
			elseif (preg_match("/\.(rar|tar|zip|7z)$/", $element)) {

				echo '<div class="col s12 m6 l4"><div class="card horizontal grey darken-3 z-depth-3"><div class="card-image valign-wrapper"><img src="./images/zip.png" width="64" height="64"></div><div class="card-stacked"><div class="card-content valign-wrapper"><p><a href="'.$path.'" class="white-text">'.$element->getFilename().'</a><br><a class="black-text files">'.formatBytes($element->getSize()).'</a></p></div></div></div></div>'.PHP_EOL;
			}
			elseif (!(preg_match("/\.(gif|png|jpg|jpeg|svg)$/", $element)) && !(preg_match("/\.(mp3|flac|wav|wma)$/", $element)) && !(preg_match("/\.(mp4|mkv|avi|webm|ogg|mpg|mpeg|mp2|mpv|m4p|m4v|mpe)$/", $element)) ) {

				echo '<div class="col s12 m6 l4"><div class="card horizontal grey darken-3 z-depth-3"><div class="card-image valign-wrapper"><img src="./images/txt.png" width="64" height="64"></div><div class="card-stacked"><div class="card-content valign-wrapper"><p><a href="'.$path.'" class="white-text">'.$element->getFilename().'</a><br><a class="black-text files">'.formatBytes($element->getSize()).'</a></p></div></div></div></div>'.PHP_EOL;

			}
			

		}
	}
}

?> 
