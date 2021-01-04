<?php
  session_start();
  $page = 'contact';
  $titleTag = 'Varsity Eatery | Contact';
  $scripts = array('assets/js/contactUs.js');
  $message = 'Questions, compliments, or concerns? Contact us by filling out the form below.';
  include_once('assets/php/include/header.inc.php');
?>
<main class="chamber">
  <?php include_once('assets/php/include/sidebar.inc.php');?>
  <article class="chamber__focal">
    <section class="showcase">
      <h1 class="showcase__title">Contact Us</h1>
      <div class="content">
        <?php
          if(isset($_SESSION['formSuccess']) && $_SESSION['formSuccess'] === FALSE) {
            echo '<h3 class="critical-text">*You did not fill out the required fields!</h3>';
            unset($_SESSION['formSuccess']);
          } elseif (isset($_SESSION['sendServiceDown']) && $_SESSION['sendServiceDown'] === TRUE) {
            echo '<h3 class="critical-text">Internal Error: Service is currently down</h3>';
            unset($_SESSION['sendServiceDown']);
          } else {
            echo '<h3>Please fill out the form below</h3>';
          }
        ?>
        <form class="form" id="contactForm" action="assets/php/handle/sendContactForm.han.php" method="POST">
          <fieldset class="form__personal">
            <legend class="form__legend">Personal Information</legend>
            <label class="form__label"><span class="form__question">Name*</span>
              <?php
                if(isset($_SESSION['fName'])){
                  if($_SESSION['fName'] == 'nofName') {
                    echo '<input class="form__name critical-background" type="text" name="fName" maxlength="18" size="18" placeholder=" John" value="">';
                    echo '<p class="critical-text">*Please enter a name.</p>';
                  } elseif($_SESSION['fName'] == 'notfName') {
                    echo '<input class="form__name critical-background" type="text" name="fName" maxlength="18" size="18" placeholder=" John">';
                    echo '<p class="critical-text">*Don\'t use numbers or special characters</p>';
                  } elseif($_SESSION['fName'] == 'lenfName') {
                    echo '<input class="form__name critical-background" type="text" name="fName" maxlength="18" size="18" placeholder=" John" value="">';
                    echo '<p class="critical-text">*Name is too long.</p>';
                  } else {
                    echo '<input class="form__name" type="text" name="fName" maxlength="18" size="18" placeholder=" John" value="' . $_SESSION['fName'] . '">';
                  }
                  unset($_SESSION['fName']);
                } else {
                  echo '<input class="form__name" type="text" name="fName" maxlength="18" size="18" placeholder=" John" value="">';
                }
              ?>
            </label>
            <label class="form__label"><span class="form__question">Email*</span>
              <?php
                if(isset($_SESSION['email'])){
                  if($_SESSION['email'] == 'noEmail') {
                    echo '<input class="form__email critical-background" type="email" name="email" id="email" maxlength="254" size="18" placeholder=" jdoe@gmail.com" value="">';
                    echo '<p class="critical-text">*Please enter an email.</p>';
                  } elseif($_SESSION['email'] == 'notEmail') {
                    echo '<input class="form__email critical-background" type="email" name="email" id="email" maxlength="254" size="18" placeholder=" jdoe@gmail.com">';
                    echo '<p class="critical-text">*The email was invalid!</p>';
                  } else {
                    echo '<input class="form__email" type="email" name="email" id="email" maxlength="254" size="18" placeholder=" jdoe@gmail.com" value="' . $_SESSION['email'] . '">';
                  }
                  unset($_SESSION['email']);
                } else {
                  echo '<input class="form__email" type="email" name="email" id="email" maxlength="254" size="18" placeholder=" jdoe@gmail.com" value="">';
                }
              ?>
            </label>
            <label class="form__label"><span class="form__question">Phone number</span>
              <?php
                if(isset($_SESSION['telNum'])){
                  if($_SESSION['telNum'] == 'notTelNum'){
                    echo '<input class="form__phone-number critical-background" type="tel"  name="telNum" maxlength="10" size="18" placeholder=" 7141234567">';
                    echo '<p class="critical-text">*Please enter a 10 digit U.S. phone number.</p>';
                  } elseif($_SESSION['telNum'] == 'lenTelNum'){
                    echo '<input class="form__phone-number critical-background" type="tel"  name="telNum" maxlength="10" size="18" placeholder=" 7141234567">';
                    echo '<p class="critical-text">*Enter a 10 digit phone number.</p>';
                  } else {
                    echo '<input class="form__phone-number" type="tel"  name="telNum" maxlength="10" size="18" placeholder=" 7141234567" value=' . $_SESSION['telNum'] . '>';
                  }
                  unset($_SESSION['telNum']);
                } else {
                  echo '<input class="form__phone-number" type="tel"  name="telNum" maxlength="10" size="18" placeholder=" 7141234567">';
                }
              ?>
            </label>
            <label class="form__label"><span class="form__question">Personal favorite food</span>
              <?php
                if(isset($_SESSION['persFavFood'])){
                  if($_SESSION['persFavFood'] == 'notFood'){
                    echo '<input class="form__favorite-food critical-background" type="text" name="persFavFood" maxlength="12" size="18" placeholder=" Lobster">';
                    echo '<p class="critical-text">*Don\'t use numbers or special characters.</p>';
                  } elseif($_SESSION['persFavFood'] == 'lenFood'){
                    echo '<input class="form__favorite-food critical-background" type="text" name="persFavFood" maxlength="12" size="18" placeholder=" Lobster">';
                    echo '<p class="critical-text">*Food name too long.</p>';
                  } else {
                    echo '<input class="form__favorite-food" type="text" name="persFavFood" maxlength="12" size="18" placeholder=" Lobster" value=' . $_SESSION['persFavFood'] . '>';
                  }
                  unset($_SESSION['persFavFood']);
                } else {
                  echo '<input class="form__favorite-food" type="text" name="persFavFood" maxlength="12" size="18" placeholder=" Lobster">';
                }
              ?>
            </label>
          </fieldset>
          <fieldset class="form__feedback">
            <legend class="form__legend">Feedback</legend>
            <label class="form__label">
              <span class="form__question">Your message*</span>
              <?php
                if(isset($_SESSION['custMsg'])){
                  if($_SESSION['custMsg'] == 'noCustMsg'){
                    echo '<textarea class="form__textarea critical-background" name="custMsg" rows="5" cols="22" maxlength="256" 
                    placeholder="For example, Tell us about your experience at our eatery and/or about our website"></textarea>';
                    echo '<p class="critical-text">*Please enter your message.</p>';
                  } elseif($_SESSION['custMsg'] == 'lenCustMsg'){
                    echo '<textarea class="form__textarea critical-background" name="custMsg" rows="5" cols="22" maxlength="256" placeholder="Tell us about your experience at our eatery and/or about our website">' . $_SESSION['custMsg'] . '</textarea>';
                    echo '<p class="critical-text">*Message too long.</p>';
                  } else {
                    echo '<textarea class="form__textarea" name="custMsg" rows="5" cols="22" maxlength="256" placeholder="Tell us about your experience at our eatery and/or about our website">' . $_SESSION['custMsg'] . '</textarea>';
                  }
                  unset($_SESSION['custMsg']);
                } else {
                  echo '<textarea class="form__textarea" name="custMsg" rows="5" cols="22" maxlength="256" placeholder="Tell us about your experience at our eatery and/or about our website"></textarea>';
                }
              ?>
            </label>
            <label class="form__label">
              <span class="form__question">Rate our eatery</span>
              <div class="form__rating">
                <?php
                  if(isset($_SESSION['rating'])){
                    if($_SESSION['rating'] == 'uknRating'){
                      echo '<input class="form__slider" id="formSlider" onchange="showSliderVal(this.value)" name="rating" type="range" value="5" min="1" max="10">';
                    } else {
                      echo '<input class="form__slider" id="formSlider" onchange="showSliderVal(this.value)" name="rating" type="range" value="' . $_SESSION['rating'] . '" min="1" max="10">';
                    }
                  } else {
                    echo '<input class="form__slider" id="formSlider" onchange="showSliderVal(this.value)" name="rating" type="range" value="5" min="1" max="10">';
                  }
                ?>
                <div class="form__values">
                  <span class="form__one-rating">1</span>
                  <?php
                    if(isset($_SESSION['rating']) && $_SESSION['rating'] != 'uknRating'){
                      echo '<span class="form__value" id="sliderVal">' . $_SESSION['rating'] . '</span>';
                    } else {
                      echo '<span class="form__value" id="sliderVal">5</span>';
                    }

                    if(isset($_SESSION['rating'])){
                      unset($_SESSION['rating']);
                    }
                  ?>
                  <span class="form__ten-rating">10</span>
                </div>
              </div>
            </label>
            <span class="form__question">Would you come back here again?</span>
            <div class="form__radio">
              <?php
                echo '<label class="form__label"><input type="radio" name="retCust" value="yes" '; 
                if(isset($_SESSION['retCust'])){if($_SESSION['retCust'] == 'yes'){echo 'checked';}}
                echo '>Yes!</label>';
                echo '<label class="form__label"><input type="radio" name="retCust" value="maybe" ';
                if(isset($_SESSION['retCust'])){if($_SESSION['retCust'] == 'maybe'){echo 'checked';}}
                echo '>I would filp a coin...</label>';
                echo '<label class="form__label"><input type="radio" name="retCust" value="no" ';
                if(isset($_SESSION['retCust'])){if($_SESSION['retCust'] == 'no'){echo 'checked';}}
                echo '>No!</label>';
                unset($_SESSION['retCust']);
              ?>
            </div>
          </fieldset>
          <?php include_once('assets/php/include/contactFormCat.inc.php');?>
          <fieldset class="form__btn">
            <input class="form__clear" name="reset" type="reset" value="Clear">
            <input class="form__submit" name="submit" type="submit" value="Submit">
          </fieldset>
        </form>
      </div>
    </section>
    <section class="showcase">
      <h1 class="showcase__title">View Submitted Forms</h1>
      <div class="content form-res">
        <?php
          if(isset($_SESSION['formNotFound']) && $_SESSION['formNotFound'] === TRUE) {
            echo '<h3 class="critical-text">No forms were found</h3>';
            unset($_SESSION['formNotFound']);
          } elseif(isset($_SESSION['getFormErr']) && $_SESSION['getFormErr'] === TRUE) {
            echo '<h3 class="critical-text">*You did not fill out the required fields!</h3>';
            unset($_SESSION['getFormErr']);
          } elseif(isset($_SESSION['getServiceDown']) && $_SESSION['getServiceDown'] === TRUE) {
            echo '<h3 class="critical-text">Internal Error: Service is currently down</h3>';
            unset($_SESSION['getServiceDown']);
          } else {
            echo '<h3>Fill out the form below to retrieve your previous submitted forms</h3>';
          }
        ?>
        <form class="form" action="assets/php/handle/getContactForm.han.php" method="POST">
          <fieldset class="form__personal">
            <legend class="form__legend">Personal Information</legend>
            <label class="form__label"><span class="form__question">Name*</span>
              <?php
                if(isset($_SESSION['getfName'])){
                  if($_SESSION['getfName'] == 'nofName') {
                    echo '<input class="form__name critical-background" type="text" name="getfName" maxlength="18" size="18" placeholder=" John" value="">';
                    echo '<p class="critical-text">*Please enter a name.</p>';
                  } elseif($_SESSION['getfName'] == 'notfName') {
                    echo '<input class="form__name critical-background" type="text" name="getfName" maxlength="18" size="18" placeholder=" John">';
                    echo '<p class="critical-text">*Don\'t use numbers or special characters</p>';
                  } elseif($_SESSION['getfName'] == 'lenfName') {
                    echo '<input class="form__name critical-background" type="text" name="getfName" maxlength="18" size="18" placeholder=" John" value="">';
                    echo '<p class="critical-text">*Name is too long.</p>';
                  } else {
                    echo '<input class="form__name" type="text" name="getfName" maxlength="18" size="18" placeholder=" John" value="' . $_SESSION['getfName'] . '">';
                  }
                  unset($_SESSION['getfName']);
                } else {
                  echo '<input class="form__name" type="text" name="getfName" maxlength="18" size="18" placeholder=" John" value="">';
                }
              ?>
            </label>
            <label class="form__label"><span class="form__question">Email*</span>
              <?php
                if(isset($_SESSION['getEmail'])){
                  if($_SESSION['getEmail'] == 'noEmail') {
                    echo '<input class="form__email critical-background" type="email" name="getEmail" maxlength="254" size="18" placeholder=" jdoe@gmail.com" value="">';
                    echo '<p class="critical-text">*Please enter an email.</p>';
                  } elseif($_SESSION['getEmail'] == 'notEmail') {
                    echo '<input class="form__email critical-background" type="email" name="getEmail" maxlength="254" size="18" placeholder=" jdoe@gmail.com">';
                    echo '<p class="critical-text">*The email was invalid!</p>';
                  } else {
                    echo '<input class="form__email" type="email" name="getEmail" maxlength="254" size="18" placeholder=" jdoe@gmail.com" value="' . $_SESSION['getEmail'] . '">';
                  }
                  unset($_SESSION['getEmail']);
                } else {
                  echo '<input class="form__email" type="email" name="getEmail" maxlength="254" size="18" placeholder=" jdoe@gmail.com" value="">';
                }
              ?>
            </label>
          </fieldset>
          <fieldset class="form__btn">
            <input class="form__clear" name="reset" type="reset" value="Clear">
            <input class="form__submit" name="submit" type="submit" value="Submit">
          </fieldset>
        </form>
        <div id="formRes"></div>
      </div>
    </section>
    <section class="showcase">
      <h2 class="showcase__title">Employment</h2>
      <div class="content">
        <div class="employment">
          <p class="employment__info">Would you like to work for a winning team? Come in and fill out an application!<br><br>
          Our eatery is always looking for great and energetic individuals who love to help others get what they need.<br>
          We have positions for both part-time and full-time. This is a great way for anyone, including students, to earn extra money.<br>
          You are welcomed to stop by and pick up an application!</p>
        </div>
      </div>
    </section>
  </article>
</main>
<?php include_once('assets/php/include/footer.inc.php');?>