	<?php 
        $page = 'menu';
        $titleTag = 'Varsity Eatery | Menu';
        $scripts = array('assets/js/menu.js');
        $message = 'This is our current Menu at our eatery! Feel free to check out our menu or learn more about us!';
        include_once('assets/php/include/header.inc.php');
    ?>
    <main class="chamber">
    	<?php include_once('assets/php/include/sidebar.inc.php');?>
        <article class="chamber__focal">
            <section class="showcase">
                <h1 class="showcase__title">Menu</h1>
            	<div class="content">
                    <div class="menu">
                        <nav class="menu__nav" id="menuNav"></nav>
                        <p class="menu__info"></p>
                        <p class="menu__disclaimer">Prices do not include tax and are subject to change.</p>
                    </div>
	            </div>
            </section>
            <section class="showcase">
            	<h2 class="showcase__title" id="categoryTitle"></h2>
            	<div class="content">
                    <div class="category" id="category"></div>
	            </div>
        	</section>
        	<section class="showcase">
            	<div class="content">
                    <div class="menu">
                        <p class="menu__info"></p>
                        <p class="menu__disclaimer">Prices do not include tax and are subject to change.</p>
                    </div>
	            </div>
        	</section>
        </article>
    </main>
    <?php include_once('assets/php/include/footer.inc.php');?>