
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300i,400,700" rel="stylesheet"> 
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>explorateur PHP</title>
</head>
<body>
	<header id="top">
		<div class="navbar-fixed ">
			<nav class="black">
				<div class="nav-wrapper">
					<a href="index.php" class="brand-logo center">Explorateur PHP</a>
					<a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
					<ul class="right hide-on-med-and-down">

					</ul>
				</div>
			</nav>
		</div>
		<ul class="sidenav blue-grey darken-3" id="mobile-demo">
			<li><a class="white-text" href="index.php" class="sidenav-close">Home</a></li>
			<li><a href="#" class="sidenav-close">Fermer</a></li>
		</ul>
	</header>

	<div class="container content">

		<div class="row affichage">
			<?php
			// Affichage résultat de la fonction explore
			include 'explore.php';
			?>
		</div>

		<div class="button row">
			<a href="" onclick="goBack()" class="waves-effect waves-light btn-large black white-text col s3 offset-s2 m3 offset-m2 z-depth-3"> BACK</a>
			<a href="index.php" class="waves-effect waves-light btn-large black white-text col s3 offset-s2 m3 offset-m2 z-depth-3"> HOME</a>
		</div>

	<div class="fixed-action-btn">
		<a class="btn-floating btn-medium waves-effect waves-light black" href="#top">
			<i class="large material-icons">arrow_upward</i>
		</a>
	</div>
	</div>


	<script
	src="https://code.jquery.com/jquery-3.3.1.js"
	integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
	crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
	<script>
		$(document).ready(function(){
			$('.sidenav').sidenav();
		});
		$(document).ready(function(){
			$('select').formSelect();
		});
		function goBack() {
			window.history.back();
		}
	</script>

</body>
</html>



