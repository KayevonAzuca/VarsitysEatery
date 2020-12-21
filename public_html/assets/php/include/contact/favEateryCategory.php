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