<?php
    session_start();
    if($_SESSION['formSuccess']){

    } else {
        header("Location: contact.php");
        exit();
    }
?>
<?php
    $page = 'contact';
    $title = 'Varsity Eatery | Submitted';
    $scripts = array('assets/js/contactUs.js');
    include('assets/php/include/header.php');
?>
<main class="chamber">
    <?php include('assets/php/include/sidebar.php');?>
    <article class="chamber__focal">
        <section class="showcase">
            <h2 class="showcase__title">Contact us</h2>
            <div class="content content-center">
                <p class="submitted">Form has been submitted!<br>
                Thank you for your time 
                <span class="good-text bold-text"><?php echo $_SESSION['fName'];?></span> your message was sent!<br>
                A copy of your submission was also sent to you for your record.</p>
            </div>
        </section>
    </article>
</main>
<?php include('assets/php/include/footer.php');?>
<?php
    if(session_status() === PHP_SESSION_ACTIVE){
        session_unset();
        session_destroy();
    }
?>