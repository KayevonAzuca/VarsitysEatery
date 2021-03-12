<?php
  // ==========================================================================
  // file: FormsView.class.php
  // ==========================================================================
  // Developer: Kayevon Azuca
  // Date: 1/4/2021
  // Description: This is the View of the ContactForm MVC pattern.
  // ==========================================================================

  declare(strict_types = 1);
  namespace ContactForm;

  // ==== FormsView ===========================================================
  //
  // Obtain information on database rows for the purpose of displaying.
  //
  // ==========================================================================
  class FormsView extends FormsContr {

    // ==== Property Declarations =============================================
    // ========================================================================

    // ==== End of Property Declarations ======================================
    // ========================================================================

    // ==== Method Declarations ===============================================
    // ========================================================================

    // ==== getNumForms() =====================================================
    //
    // Get number of forms that are in the database using a name and a email.
    //
    // Parameters:
    //   $name       -- string of a name
    //   $email      -- string of a email
    //
    // Return:
    //   return      -- int number of contact forms found
    // ========================================================================
    public function getNumForms(string $name, string $email) {
      return $this->chkRecByNameEmail($name, $email);
    } // end of getNumForms()

    // ==== getFormatedForms() ================================================
    //
    // Download contact form data from the database using a name and email.
    //
    // Parameters:
    //   $name          -- string of a name
    //   $email         -- string of a email
    //
    // Return:
    //   $formatedRes   -- form results formated with HTML elements
    // ========================================================================
    public function getFormatedForms(string $name, string $email) {
      
      // ==== mkCellData() ====================================================
      //
      // Create & return a HTML <td> element with form data
      //
      // Parameters:
      //   $data       -- possibly contain data
      //
      // Return:
      //   return      -- HTML <td> element
      // ======================================================================
      function mkCellData($data) {
        $td = '<td class="form-res__cell">';
        if(isset($data)){
          $td .= $data;
        } else {
          $td .= 'N/A';
        }
        $td .= '</td>';
        return $td;
      } // end of mkCellData()

      // ==== UTCToPST() ======================================================
      //
      // Convert UTC timestamp to PST
      //
      // Parameters:
      //   $utc         -- UTC timestamp
      //
      // Return:
      //   return      -- formated date & time
      // ======================================================================
      function UTCToPST(string $utc) {
        $dt = new \DateTime($utc);
        $tz = new \DateTimeZone('America/Los_Angeles'); // or whatever zone you're after

        $dt->setTimezone($tz);
        return $dt->format('Y-m-d h:i:s a');
      } // end of UTCToPST()

      // Get all forms from database
      $res = $this->downloadForm($name, $email);

      if(!$res){
        return FALSE;
      }

      // echo variable
      $formatedRes = '';
      
      // Display data in HTML
      for($i = 0; $i < count($res); ++$i){
        $formatedRes .= '<div class="form-res">';
        $formatedRes .= <<<EOD
          <div class="form-res__subset">
          <h3 class="form-res__title">Personal Information</h3>
          <table class="form-res__table">
          <tbody class="form-res__tbody">
          <tr class="form-res__row">
          <th class="form-res__cell form-res__cell--header">Name</th>
          <th class="form-res__cell form-res__cell--header">Email</th>
          </tr>
          <tr class="form-res__row">
        EOD;

        $formatedRes .= mkCellData($res[$i]['name']);
        $formatedRes .= mkCellData($res[$i]['email']);

        $formatedRes .= <<<EOD
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
        EOD;

        $formatedRes .= mkCellData($res[$i]['telNum']);
        $formatedRes .= mkCellData($res[$i]['persFavFood']);

        $formatedRes .= <<<EOD
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
        EOD;

        $formatedRes .= mkCellData($res[$i]['msg']);
        $formatedRes .= mkCellData($res[$i]['rating']);
        $formatedRes .= mkCellData($res[$i]['retCust']);

        $formatedRes .= <<<EOD
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
        EOD;

        // Display favorite food categories
        $formatedRes .= '<td class="form-res__cell">';

        if(isset($res[$i]['favCat'])){
          $catArr = explode(",", $res[$i]['favCat']);
          $formatedRes .= '<ul class="form-res__ul>">';

          foreach($catArr as $cat){
            $formatedRes .= '<li class="form-res__li">' . $cat . '</li>';
          }
          $formatedRes .= '</ul>';
        } else {
          $formatedRes .= 'N/A';
        }

        $formatedRes .= '</td>';

        // Closing table/div tags
        $formatedRes .= <<<EOD
          </tr>
          </tbody>
          </table>
          </div>
        EOD;

        // Display form submission timestamp
        if(isset($res[$i]['ts'])){
          $formatedRes .= '<div class="form-res__subset form-res__subset--ts">' . UTCToPST($res[$i]['ts']) . ' PST</div>';
        }
        $formatedRes .= '</div>';

      } // end of for()

      return $formatedRes;
      
    } // end of getFormatedForms()

    // ==== End of Method Declarations ========================================
    // ========================================================================

  } // end of FormsView

  // ==== End of FormsView ====================================================
  // ==========================================================================