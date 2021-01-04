<?php
  class FormsView extends FormsModel {
    public function isForm($fName, $email) {
      $res = $this->chkForm($fName, $email);
      return $res;
    } // end of "isForm()"

    public function dispForm($fName, $email) {

      // Create & return a HTML <td> element with form data
      function mkCellData($data) {
        $td = '<td class="form-res__cell">';
        //isset($data) ? $td .= $data : $td .= 'N/A';
        if(isset($data)){
          $td .= $data;
        } else {
          $td .= 'N/A';
        }
        $td .= '</td>';
        return $td;
      } // end of "mkCellData()"

      // Get all forms from database
      $res = $this->getForm($fName, $email);
      
      // Display data in HTML
      for($i = 0; $i < count($res); ++$i){
        echo('<div class="content form-res">');
        echo <<<EOD
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

        echo(mkCellData($res[$i]['fName']));
        echo(mkCellData($res[$i]['email']));

        echo <<<EOD
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

        echo(mkCellData($res[$i]['telNum']));
        echo(mkCellData($res[$i]['persFavFood']));

        echo <<<EOD
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

        echo(mkCellData($res[$i]['custMsg']));
        echo(mkCellData($res[$i]['rating']));
        echo(mkCellData($res[$i]['retCust']));

        echo <<<EOD
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
        echo('<td class="form-res__cell">');

        if(isset($res[$i]['favCat'])){
          $catArr = explode(",", $res[$i]['favCat']);
          echo('<ul class="form-res__ul>">');

          foreach($catArr as $cat){
            echo('<li class="form-res__li">' . $cat . '</li>');
          }
          echo('</ul>');
        } else {
          echo('N/A');
        }

        echo('</td>');

        // Closing table/div tags
        echo <<<EOD
          </tr>
          </tbody>
          </table>
          </div>
        EOD;

        // Display form submission timestamp
        if(isset($res[$i]['ts'])){
          echo('<div>' . $res[$i]['ts'] . '</div>');
        }
        echo('</div>');

      } // end of for()
    } // end of "dispForm()"
  } // end of "FormsView"
?>