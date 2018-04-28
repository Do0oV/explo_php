<?php

// si le repertoire a été changé et si l'url ne contient pas de /../
if (isset($_GET['dossier']) && (strpos($_GET['dossier'], '../') === FALSE)) {
	$dossier = $_GET['dossier'];
}else{
	//changer pour explorer le dossier racine
	$dossier = 'assets';
	//$dossier = '../explo_php';
}

if (isset($_GET['file'])) {
	$file_name = $_GET['file'];

	if(is_file($file_name)) {

		header('Content-Description: File Transfer');
		header('Content-Type: application/octet-stream');
		header('Content-Disposition: attachment; filename='.basename($file_name));
		header('Content-Transfer-Encoding: binary');
		header('Expires: 0');
		header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
		header('Pragma: public');
		header('Content-Length: ' . filesize($file_name));
		ob_clean();
		flush();
		readfile($file_name);
		exit;
	}
	else {
		die('The provided file path is not valid.');
	}
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
	
	//::UNIX_PATHS -> évite le mix entre \ et / dans les paths
	$iterator = new FilesystemIterator($dossier, FilesystemIterator::UNIX_PATHS); 

	foreach($iterator as $element){

		$infos = date('d F Y - H:i:s', filemtime($element));
		

		// si c'est un dossier
		if ($element->isDir()) {

			// mise en forme et lien
			// réassigne le répertoire si clique et relance la fonction
			// compte le nb de fichiers dans dossier
			$dir = $element->getPathname();
			$nbFiles = (count(scandir($dir)) - 2);

			echo '<div class="col s12 m6 xl4"><div class="card horizontal grey darken-3 z-depth-3"><div class="card-image valign-wrapper"><img src="./images/folder.png" alt=""></div><div class="card-stacked"><div class="card-content valign-wrapper"><p><a href="index.php?dossier='.$dir.'" class="white-text">'.$element->getFilename().'</a><br><a class="black-text files">'.$nbFiles.' fichier(s)</a><br><a class="black-text files">'.$infos.'</a></p></div></div></div></div>'.PHP_EOL;
		}

		// si c'est un fichier
		if ($element->isFile()) {

			$path = $element->getPathname();

			if(preg_match("/\.(gif|png|jpg|jpeg|svg)$/", $element)){

				echo '<div class="col s12 m6 xl4"><div class="card horizontal grey darken-3 z-depth-3"><div class="card-image valign-wrapper"><img src="./images/jpg.png" width="64" height="64" alt="folderIcon"></div><div class="card-stacked"><div class="card-content valign-wrapper"><p><a href="?file='.$path.'" class="white-text">'.$element->getFilename().'</a><br><a class="black-text files">'.formatBytes($element->getSize()).'</a><br><a class="black-text files">'.$infos.'</a></p></div></div></div></div>'.PHP_EOL;
			}
			// autre manière de forcer le download
			elseif (preg_match("/\.(mp3|flac|wav|wma)$/", $element)) {
				echo '<div class="col s12 m6 xl4"><div class="card horizontal grey darken-3 z-depth-3"><div class="card-image valign-wrapper"><img src="./images/mp3.png" width="64" height="64" alt="imageIcon"></div><div class="card-stacked"><div class="card-content valign-wrapper"><p><a href="'.$path.'" class="white-text" download>'.$element->getFilename().'</a><br><a class="black-text files">'.formatBytes($element->getSize()).'</a><br><a class="black-text files">'.$infos.'</a></p></div></div></div></div>'.PHP_EOL;

			}elseif (preg_match("/\.(mp4|mkv|avi|webm|ogg|mpg|mpeg|mp2|mpv|m4p|m4v|mpe|flv)$/", $element)) {

				echo '<div class="col s12 m6 xl4"><div class="card horizontal grey darken-3 z-depth-3"><div class="card-image valign-wrapper"><img src="./images/mpg.png" width="64" height="64" alt="videoIcon"></div><div class="card-stacked"><div class="card-content valign-wrapper"><p><a href="?file='.$path.'" class="white-text">'.$element->getFilename().'</a><br><a class="black-text files">'.formatBytes($element->getSize()).'</a><br><a class="black-text files">'.$infos.'</a></p></div></div></div></div>'.PHP_EOL;

			}elseif (preg_match("/\.(pdf)$/", $element)) {

				echo '<div class="col s12 m6 xl4"><div class="card horizontal grey darken-3 z-depth-3"><div class="card-image valign-wrapper"><img src="./images/pdf.png" width="64" height="64" alt="pdfIcon"></div><div class="card-stacked"><div class="card-content valign-wrapper"><p><a href="?file='.$path.'" class="white-text">'.$element->getFilename().'</a><br><a class="black-text files">'.formatBytes($element->getSize()).'</a><br><a class="black-text files">'.$infos.'</a></p></div></div></div></div>'.PHP_EOL;

			}elseif (preg_match("/\.(html|php|js|xml|htm|mpg|css)$/", $element)) {

				echo '<div class="col s12 m6 xl4"><div class="card horizontal grey darken-3 z-depth-3"><div class="card-image valign-wrapper"><img src="./images/xml.png" width="64" height="64" alt="codeIcon"></div><div class="card-stacked"><div class="card-content valign-wrapper"><p><a href="?file='.$path.'" class="white-text">'.$element->getFilename().'</a><br><a class="black-text files">'.formatBytes($element->getSize()).'</a><br><a class="black-text files">'.$infos.'</a></p></div></div></div></div>'.PHP_EOL;

			}elseif (preg_match("/\.(rar|tar|zip|7z)$/", $element)) {

				echo '<div class="col s12 m6 xl4"><div class="card horizontal grey darken-3 z-depth-3"><div class="card-image valign-wrapper"><img src="./images/zip.png" width="64" height="64" alt="archiveIcon"></div><div class="card-stacked"><div class="card-content valign-wrapper"><p><a href="?file='.$path.'" class="white-text">'.$element->getFilename().'</a><br><a class="black-text files">'.formatBytes($element->getSize()).'</a><br><a class="black-text files">'.$infos.'</a></p></div></div></div></div>'.PHP_EOL;

			}else{

				echo '<div class="col s12 m6 xl4"><div class="card horizontal grey darken-3 z-depth-3"><div class="card-image valign-wrapper"><img src="./images/txt.png" width="64" height="64" alt="textIcon"></div><div class="card-stacked"><div class="card-content valign-wrapper"><p><a href="?file='.$path.'" class="white-text">'.$element->getFilename().'</a><br><a class="black-text files">'.formatBytes($element->getSize()).'</a><br><a class="black-text files">'.$infos.'</a></p></div></div></div></div>'.PHP_EOL;
			}
		}
	}
}
?> 

