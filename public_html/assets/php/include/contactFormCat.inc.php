<fieldset class="form__additional">
    <legend>Additional</legend>
    <span class="form__question">Favorite food category from our eatery</span>

    <?php
        if(file_exists('assets/json/menu.json')){
            $menuJSON = json_decode(file_get_contents('assets/json/menu.json'), TRUE);
            $counter = 1;
            foreach($menuJSON as $menuCat){
                $chkVal = FALSE;
                if(isset($_SESSION['favCat']) && in_array($menuCat['category'], $_SESSION['favCat'])){
                    $chkVal = TRUE;
                }

                if($counter === 1){
                    echo('<div class="form__checkboxes">');
                }

                echo('<label class="form__label"><input type="checkbox" name="favCat[]" value="' . $menuCat['category'] . '"');
                if($chkVal){echo('checked');}
                echo('>' . $menuCat['category'] . '</label><br>');

                if($counter === 4){
                    echo('</div>');
                    $counter = 1;
                    continue;
                }

                ++$counter;
            }

            if($counter !== 1){
                echo('</div>');
            }

        }
        if(isset($_SESSION['favCat'])){
            unset($_SESSION['favCat']);
        }
    ?>
</fieldset>