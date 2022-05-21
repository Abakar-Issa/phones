<!DOCTYPE html>
<html lang="fr">
<head>
	<title><?php echo $title ?></title>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="skin/screen.css" />
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">


	<nav>
	<div id="main">
        <div id="header">
            <div id="logo">
              	<div id="logo_text">
                  	<h1><span class="logo_colour">ASC Phones</span></h1>
                </div>
            </div>



            <div id="menubar">
                <ul id="menu">
                	<?php
						        foreach ($this->menu as $text => $link) {
							         echo "<li><a href=\"$link\">$text</a></li>";
						        }
					        ?>
                </ul>
            </div>
        </div>
  </nav>
</head>




<body>
	<div id = "page-container">
		<div id = "content">
			<?php if ($this->feedback !== '') { ?>
				<div class ="feedback"><?php echo $this->feedback; ?></div>
			<?php } ?>
			<main>
				<h1><?php echo $title; ?></h1>
				<?php echo $content; ?>
			</main>
		</div>
		<footer id = "footer">
		<p>Copyright© ASC Phones. Tous droits réservés.</p>
		</footer>
	</div>





<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>

</html>
