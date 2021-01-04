<?php
    session_start();
    if(!isset($_SESSION['formFound'])){
        header("Location: /contact.php");
        exit();
    }
    unset($_SESSION['formFound']);

    $page = 'form-viewer';
    $titleTag = 'Varsity Eatery | Form Viewer';
    $scripts = array('assets/js/contactUs.js');
    include_once('assets/php/include/header.inc.php');
?>
<main class="chamber">
    <?php include_once('assets/php/include/sidebar.inc.php');?>
    <article class="chamber__focal">
        <section class="showcase">
            <h2 class="showcase__title">Forms found</h2>
            <?php
                if(file_exists($_SERVER['DOCUMENT_ROOT'] . '/assets/php/include/autoloader.inc.php')){
                    include_once($_SERVER['DOCUMENT_ROOT'] . '/assets/php/include/autoloader.inc.php');
                    $formsViewObj = new FormsView();
                    $formsViewObj->dispForm($_SESSION['getfName'], $_SESSION['getEmail']);
                } else {
                    echo '<h3 class="critical-text">Internal Error: Service is currently down</h3>';
                }
            ?>
        </section>
    </article>
</main>
<?php
    include_once('assets/php/include/footer.inc.php');

    if(session_status() === PHP_SESSION_ACTIVE){
        session_unset();
        session_destroy();
    }
?>