<?php 
    $d;
    if(isset($_GET['uIn'])){
        $d = $_GET['uIn'];
    } else {
        header("Location: /contact.php");
        exit();
    }
?>
    <?php 
        $page = 'contact';
        $title = 'Varsity Eatery | Submitted';
        $scripts = array('/assets/js/contactUs.js');
        include('/usr/local/www/apache24/data/assets/php/include/header.php');
    ?>
    <main class="chamber">
        <?php include('/usr/local/www/apache24/data/assets/php/include/sidebar.php');?>
        <article class="chamber__focal">
            <section class="showcase">
                <h2 class="showcase__title">Contact us</h2>
                <div class="content">
                    <p>Form has been submitted!<br>Thank you for your time completing our form <span class="good-text bold-text"><?php echo $d['name'];?></span>. We'll contact you if needed.</p>
                </div>
            </section>
        </article>
    </main>
    <?php include('/usr/local/www/apache24/data/assets/php/include/footer.php');?>