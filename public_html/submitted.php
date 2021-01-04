<?php
    session_start();
    if(!isset($_SESSION['formSuccess'])){
        header("Location: /contact.php");
        exit();
    }
    unset($_SESSION['formSuccess']);

    $page = 'submitted';
    $titleTag = 'Varsity Eatery | Submitted';
    $scripts = array('assets/js/contactUs.js');
    include_once('assets/php/include/header.inc.php');
?>
<main class="chamber">
    <?php include_once('assets/php/include/sidebar.inc.php');?>
    <article class="chamber__focal">
        <section class="showcase">
            <h2 class="showcase__title">Contact us</h2>
            <div class="content content-center">
                <p class="submitted">Form has been submitted!<br>
                Thank you <span class="good-text bold-text"><?php echo $_SESSION['fName'];?></span> your message was sent!<br>
                We appreciate your feedback.</p>
            </div>
        </section>
        <section class="showcase">
            <h2 class="showcase__title">Copy of Form Submission</h2>
            <div class="content form-res">
                <div class="form-res__subset">
                    <h3 class="form-res__title">Personal Information</h3>
                    <table class="form-res__table">
                        <tbody class="form-res__tbody">
                            <tr class="form-res__row">
                                <th class="form-res__cell form-res__cell--header">Name</th>
                                <th class="form-res__cell form-res__cell--header">Email</th>
                            </tr>
                            <tr class="form-res__row">
                                <td class="form-res__cell"><?php echo($_SESSION['fName']);?></td>
                                <td class="form-res__cell"><?php echo($_SESSION['email']);?></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="form-res__table">
                        <tbody class="form-res__tbody">
                            <tr class="form-res__row">
                                <th class="form-res__cell form-res__cell--header">Phone Number</th>
                                <th class="form-res__cell form-res__cell--header">Personal Favorite Food</th>
                            </tr>
                            <tr class="form-res__row">
                                <td class="form-res__cell"><?php if(isset($_SESSION['telNum'])){echo($_SESSION['telNum']);}else{echo('N/A');}?></td>
                                <td class="form-res__cell"><?php if(isset($_SESSION['persFavFood'])){echo($_SESSION['persFavFood']);}else{echo('N/A');}?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="form-res__subset">
                    <h3 class="form-res__title">Feedback</h3>
                    <table class="form-res__table">
                        <tbody class="form-res__tbody">
                            <tr class="form-res__row">
                                <th class="form-res__cell form-res__cell--header">Your message</th>
                                <th class="form-res__cell form-res__cell--header">Rating</th>
                                <th class="form-res__cell form-res__cell--header">Returning customer</th>
                            </tr>
                            <tr class="form-res__row">
                                <td class="form-res__cell"><?php if(isset($_SESSION['custMsg'])){echo($_SESSION['custMsg']);}else{echo('N/A');}?></td>
                                <td class="form-res__cell"><?php if(isset($_SESSION['rating'])){echo($_SESSION['rating']);}else{echo('N/A');}?></td>
                                <td class="form-res__cell"><?php if(isset($_SESSION['retCust'])){echo($_SESSION['retCust']);}else{echo('N/A');}?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="form-res__subset">
                    <h3 class="form-res__title">Additional</h3>
                    <table class="form-res__table">
                        <tbody class="form-res__tbody">
                            <tr class="form-res__row">
                                <th class="form-res__cell form-res__cell--header">Favorite Food Categories</th>
                            </tr>
                            <tr class="form-res__row">
                                <td class="form-res__cell"><?php 
                                if(isset($_SESSION['favCat'])){
                                    echo('<ul class="form-res__ul>">');
                                    foreach($_SESSION['favCat'] as $cat){
                                        echo('<li class="form-res__li">' . $cat . '</li>');
                                    }
                                    echo('</ul>');
                                } else {
                                    echo('N/A');
                                }
                                ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div><?php echo($_SESSION['formTS']);?></div>
            </div>
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