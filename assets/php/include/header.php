<?php
    if(!isset($scripts))
        $scripts = array();
    if(!isset($styles))
        $styles = array();
?>
<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <link href="assets/css/style.css" type="text/css" rel="stylesheet">
    <script defer src="assets/js/googleMap.js"></script>
	<title><?php echo $titleTag;?></title>
    <?php foreach($scripts as $script):?>
        <script src="<?php echo $script; ?>"></script>
    <?php endforeach;?>
</head>
<body>
	<header class="antechamber">
	    <div class="antechamber__banner">
	        <a class="antechamber__logo-link" href="index.php"><img class="antechamber__img" src="images/banner.png" alt="Eatery logo"></a>
	    </div>
	    <nav class="antechamber__nav">
	        <ul class="antechamber__list">
	            <li class="antechamber__item">
	            	<a class="antechamber__link <?php if($page == "home"){echo 'antechamber__link--highlight';}?>" href="index.php">Home</a>
	            </li>
	            <li class="antechamber__item">
	            	<a class="antechamber__link <?php if($page == "menu"){echo 'antechamber__link--highlight';}?>" href="menu.php">Menu</a>
	            </li>
	            <li class="antechamber__item">
	            	<a class="antechamber__link <?php if($page == "about"){echo 'antechamber__link--highlight';}?>" href="about.php">About</a>
	            </li>
	            <li class="antechamber__item">
	            	<a class="antechamber__link <?php if($page == "contact"){echo 'antechamber__link--highlight';}?>" href="contact.php">Contact</a>
	            </li>
	        </ul>
		</nav>
	</header>