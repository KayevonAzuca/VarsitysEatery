    <?php 
        $page = 'contact';
        $titleTag = 'Varsity Eatery | Contact';
        $scripts = array('/assets/js/contactUs.js');
        $message = 'Questions, compliments, or concerns? Contact us by filling out the form below.';
        include('/usr/local/www/apache24/data/assets/php/include/header.php');
    ?>
    <main class="chamber">
        <?php include('/usr/local/www/apache24/data/assets/php/include/sidebar.php');?>
        <article class="chamber__focal">
            <section class="showcase">
                <h1 class="showcase__title">Contact Us</h1>
                <div class="content">
                    <?php
                        $e;
                        $d;
                        if(isset($_GET['uEr'])){
                            $e = $_GET['uEr'];
                            echo '<h3 class="critical-text">You did not fill in the necessary fields!</h3>';
                        }
                        if(isset($_GET['uIn'])){
                            $d = $_GET['uIn'];
                        }
                    ?>
                    <form class="form" id="contactForm" action="/validateForm.php" method="POST">
                        <fieldset class="form__personal">
                            <legend class="form__legend">Personal Information</legend>
                            <label class="form__label"><span class="form__question">Name:</span><br>
                            <?php
                                if(isset($e)){
                                    if(in_array('noName', $e)) {
                                        echo '<input class="form__name critical-background" type="text" name="name" id="name" maxlength="18" size="18" placeholder=" John" value="">';
                                        echo '<p class="critical-text">*Please enter a name.</p>';
                                    } elseif(in_array('notName', $e)) {
                                        echo '<input class="form__name critical-background" type="text" name="name" id="name" maxlength="18" size="18" placeholder=" John" value="' . $d['name'] . '">';
                                        echo '<p class="critical-text">*Don\'t use special characters</p>';
                                    } elseif(in_array('lenName', $e)) {
                                        echo '<input class="form__name critical-background" type="text" name="name" id="name" maxlength="18" size="18" placeholder=" John" value="">';
                                        echo '<p class="critical-text">*Name has too many characters!</p>';
                                    } else {
                                        echo '<input class="form__name" type="text" name="name" id="name" maxlength="18" size="18" placeholder=" John" value="' . $d['name'] . '">';
                                    }
                                } else {
                                    echo '<input class="form__name" type="text" name="name" id="name" maxlength="18" size="18" placeholder=" John" value="">';
                                }
                            ?>
                            </label>
                            <label class="form__label"><span class="form__question">Email:</span><br>
                            <?php
                                if(isset($e)){
                                    if(in_array('noEmail', $e)) {
                                        echo '<input class="form__email critical-background" type="email" name="email" id="email" maxlength="254" size="18" placeholder=" jdoe@gmail.com" value="">';
                                        echo '<p class="critical-text">*Please enter an email.</p>';
                                    } elseif(in_array('notEmail', $e)) {
                                        echo '<input class="form__email critical-background" type="email" name="email" id="email" maxlength="254" size="18" placeholder=" jdoe@gmail.com" value="' . $d['email'] . '">';
                                        echo '<p class="critical-text">*The email was invalid!</p>';
                                    } else {
                                        echo '<input class="form__email" type="email" name="email" id="email" maxlength="254" size="18" placeholder=" jdoe@gmail.com" value="' . $d['email'] . '">';
                                    }
                                } else {
                                    echo '<input class="form__email" type="email" name="email" id="email" maxlength="254" size="18" placeholder=" jdoe@gmail.com" value="">';
                                }
                            ?>
                            </label>
                            <label class="form__label"><span class="form__question">Phone number:</span><br>
                            <?php
                                if(isset($e)){
                                    if(in_array('notPhNum', $e)){
                                        echo '<input class="form__phone-number critical-background" type="tel"  name="phoneNum" maxlength="10" size="18" placeholder=" 7141234567" value=' . $d['phoneNum'] . '>';
                                        echo '<p class="critical-text">*Please enter a 10 digit U.S. phone number.</p>';
                                    } elseif(in_array('lenPhNum', $e)){
                                        echo '<input class="form__phone-number critical-background" type="tel"  name="phoneNum" maxlength="10" size="18" placeholder=" 7141234567" value=' . $d['phoneNum'] . '>';
                                        echo '<p class="critical-text">*Only 10 digit phone number.</p>';
                                    } else {
                                        echo '<input class="form__phone-number" type="tel"  name="phoneNum" maxlength="10" size="18" placeholder=" 7141234567" value=' . $d['phoneNum'] . '>';
                                    }
                                } else {
                                    echo '<input class="form__phone-number" type="tel"  name="phoneNum" maxlength="10" size="18" placeholder=" 7141234567">';
                                }
                            ?>
                            </label>
                            <label class="form__label"><span class="form__question">Personal favorite food:</span><br>
                            <?php
                                if(isset($e)){
                                    if(in_array('notFood', $e)){
                                        echo '<input class="form__favorite-food critical-background" type="text" name="favFood" maxlength="12" size="18" placeholder=" Lobster" value=' . $d['favFood'] . '>';
                                        echo '<p class="critical-text">*Please don\'t use special characters.</p>';
                                    } elseif(in_array('lenFood', $e)){
                                        echo '<input class="form__favorite-food critical-background" type="text" name="favFood" maxlength="12" size="18" placeholder=" Lobster" value=' . $d['favFood'] . '>';
                                        echo '<p class="critical-text">*Food name too long.</p>';
                                    } else {
                                        echo '<input class="form__favorite-food" type="text" name="favFood" maxlength="12" size="18" placeholder=" Lobster" value=' . $d['favFood'] . '>';
                                    }
                                } else {
                                    echo '<input class="form__favorite-food" type="text" name="favFood" maxlength="12" size="18" placeholder=" Lobster">';
                                }
                            ?>
                            </label>
                        </fieldset>
                        <fieldset class="form__feedback">
                            <legend class="form__legend">Feedback</legend>
                            <label class="form__label">
                                <span class="form__question">Your message:</span><br>
                            <?php
                                if(isset($e)){
                                    if(in_array('noCustMessage', $e)){
                                        echo '<textarea class="form__textarea critical-background" name="custMessage" rows="5" cols="22" maxlength="256" placeholder="For example, Tell us about your experience at our eatery and/or about our website">' . $d['custMessage'] . '</textarea>';
                                        echo '<p class="critical-text">*Please enter your message.</p>';
                                    } elseif(in_array('lenCustMessage', $e)){
                                        echo '<textarea class="form__textarea critical-background" name="custMessage" rows="5" cols="22" maxlength="256" placeholder="Example: Tell us about your experience at our eatery and/or about our website">' . $d['custMessage'] . '</textarea>';
                                        echo '<p class="critical-text">*Message too long.</p>';
                                    } else {
                                        echo '<textarea class="form__textarea" name="custMessage" rows="5" cols="22" maxlength="256" placeholder="Example: Tell us about your experience at our eatery and/or about our website">' . $d['custMessage'] . '</textarea>';
                                    }
                                } else {
                                    echo '<textarea class="form__textarea" name="custMessage" rows="5" cols="22" maxlength="256" placeholder="Example: Tell us about your experience at our eatery and/or about our website"></textarea>';
                                }
                            ?>
                            </label>
                            <label class="form__label">
                                <span class="form__question">Rate our eatery</span>
                                <div class="form__rating">
                                    <?php
                                        if(isset($e)){
                                            echo '<input class="form__slider" id="formSlider" onchange="showSliderVal(this.value)" name="rating" type="range" value="' . $d['rating'] . '" min="1" max="10">';
                                        } else {
                                            echo '<input class="form__slider" id="formSlider" onchange="showSliderVal(this.value)" name="rating" type="range" value="5" min="1" max="10">';
                                        }
                                    ?>
                                    <div class="form__values">
                                        <span class="form__one-rating">1</span>
                                        <?php
                                            if(isset($e)){
                                                echo '<span class="form__value" id="sliderVal">' . $d['rating'] . '</span>';
                                            } else {
                                                echo '<span class="form__value" id="sliderVal">5</span>';
                                            }
                                        ?>
                                        <span class="form__ten-rating">10</span>
                                    </div>
                                </div>
                            </label>
                            <span class="form__question">Would you come back here again?</span>
                            <div class="form__radio">
                                <label class="form__label"><input type="radio" name="returningCust" value="yes" <?php if(isset($e)){if($d['returningCust'] == 'yes'){echo 'checked';}}?>>Yes!</label>
                                <label class="form__label"><input type="radio" name="returningCust" value="maybe" <?php if(isset($e)){if($d['returningCust'] == 'maybe'){echo 'checked';}}?>>I would filp a coin first...</label>
                                <label class="form__label"><input type="radio" name="returningCust" value="no" <?php if(isset($e)){if($d['returningCust'] == 'no'){echo 'checked';}}?>>No!</label>
                            </div>
                        </fieldset>
                        <fieldset class="form__additional">
                            <legend>Additional</legend>
                            <span class="form__question">Favorite food category form our eatery:</span>
                            <div class="form__checkboxes">
                                <label class="form__label"><input type="checkbox" name="favCateg[]" value="burgers" <?php if(isset($d['favCateg'])){if(in_array('burgers', $d['favCateg'])){echo 'checked';}}?>>Charbrioled Burgers</label><br>
                                <label class="form__label"><input type="checkbox" name="favCateg[]" value="breakfast" <?php if(isset($d['favCateg'])){if(in_array('breakfast', $d['favCateg'])){echo 'checked';}}?>>Breakfast</label><br>
                                <label class="form__label"><input type="checkbox" name="favCateg[]" value="salads" <?php if(isset($d['favCateg'])){if(in_array('salads', $d['favCateg'])){echo 'checked';}}?>>Salads</label><br>
                                <label class="form__label"><input type="checkbox" name="favCateg[]" value="mexicanFood" <?php if(isset($d['favCateg'])){if(in_array('mexicanFood', $d['favCateg'])){echo 'checked';}}?>>Mexican Food</label><br>
                            </div>
                            <div class="form__checkboxes">
                                <label class="form__label"><input type="checkbox" name="favCateg[]" value="sandwiches" <?php if(isset($d['favCateg'])){if(in_array('sandwiches', $d['favCateg'])){echo 'checked';}}?>>Sandwiches</label><br>
                                <label class="form__label"><input type="checkbox" name="favCateg[]" value="sides" <?php if(isset($d['favCateg'])){if(in_array('sides', $d['favCateg'])){echo 'checked';}}?>>Sides</label><br>
                                <label class="form__label"><input type="checkbox" name="favCateg[]" value="beverages" <?php if(isset($d['favCateg'])){if(in_array('beverages', $d['favCateg'])){echo 'checked';}}?>>Beverages</label><br>
                                <label class="form__label"><input type="checkbox" name="favCateg[]" value="quickOrderCombos" <?php if(isset($d['favCateg'])){if(in_array('quickOrderCombos', $d['favCateg'])){echo 'checked';}}?>>Quick Order Combos</label><br>
                            </div>
                            <div class="form__checkboxes">
                                <label class="form__label"><input type="checkbox" name="favCateg[]" value="kidsMeals" <?php if(isset($d['favCateg'])){if(in_array('kidsMeals', $d['favCateg'])){echo 'checked';}}?>>Kids Meals</label><br>
                                <label class="form__label"><input type="checkbox" name="favCateg[]" value="otherFoods" <?php if(isset($d['favCateg'])){if(in_array('otherFoods', $d['favCateg'])){echo 'checked';}}?>>Other Foods</label><br>
                            </div>
                        </fieldset>
                        <fieldset class="form__btn">
                            <input class="form__clear" name="reset" type="reset" value="Clear">
                            <input class="form__submit" name="submit" type="submit" value="Submit">
                        </fieldset>
                    </form>
                </div>
            </section>
            <section class="showcase">
                <h2 class="showcase__title">Employment</h2>
                <div class="content">
                    <div class="employment">
                        <p class="employment__info">Would you like to work for a winning team? Come in and fill out an application!<br><br>
                        Our eatery is always looking for great and energetic individuals who love to help others get what they need.<br>
                        We have posistions for both part-time and full-time. This is a great way for anyone, including students, to earn extra money.<br>
                        You are welcomed to stop by and pick up an application!</p>
                    </div>
                </div>
            </section>
        </article>
    </main>
    <?php include('/usr/local/www/apache24/data/assets/php/include/footer.php');?>