<?php
  // ==========================================================================
  // file: FormsModel.class.php
  // ==========================================================================
  // Developer: Kayevon Azuca
  // Date: 1/4/2021
  // Description: This is the Model of the ContactForm MVC pattern.
  // ==========================================================================

  declare(strict_types = 1);
  namespace ContactForm;

  // ==== FormsModel ==========================================================
  //
  // Provides an interface to upload, download, or check database row(s).
  //
  // ==========================================================================
  class FormsModel extends FormsDBC {

    // ==== Property Declarations =============================================
    // ========================================================================

    // ==== End of Property Declarations ======================================
    // ========================================================================

    // ==== Method Declarations ===============================================
    // ========================================================================

    // ==== getForm() =========================================================
    //
    // Recieve all rows using name & email parameters
    //
    // Parameters:
    //   $name       -- string of a name
    //   $email      -- string of a email
    //
    // Return:
    //   TRUE        -- database results found
    //   FALSE       -- no database results found
    // ========================================================================
    protected function getForm(string $name, string $email) {
      $sql = "SELECT * FROM " . $this->formsTableName . " WHERE name = ? AND email = ?";
      $stmt = $this->connect()->prepare($sql);
      $stmt->bindParam(1, $name, \PDO::PARAM_STR);
      $stmt->bindParam(2, $email, \PDO::PARAM_STR);
      $stmt->execute();
      $res = $stmt->fetchAll();
      if($res){
        return $res;
      } else {
        return FALSE;
      }
    } // end of getForm()

    // ==== setForm() =========================================================
    //
    // Upload the contact form data into the database.
    //
    // Parameters:
    //   $arr       -- associated array of contact form data
    //
    // Return:
    //   TRUE       -- insertion of contact form successful
    //   FALSE      -- unsccessful insertion of contact form
    // ========================================================================
    protected function setForm(array $arr) {
      $sql = "INSERT INTO " . $this->formsTableName . " (name, email, telNum, persFavFood, msg, rating, retCust, favCat, ts) 
      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
      $stmt = $this->connect()->prepare($sql);
      $res = $stmt->execute([$arr['name'], $arr['email'], $arr['telNum'], $arr['persFavFood'], $arr['msg'], $arr['rating'], $arr['retCust'], $arr['favCat'], $arr['ts']]);
      if($res){
        return TRUE;
      } else {
        return FALSE;
      }
    } // end of setForm()

    // ==== getRecByEmail() ===================================================
    //
    // Check how many rows exists in the database with the email parameter.
    //
    // Parameters:
    //   $email       -- string of an email
    //
    // Return:
    //   $res         -- string number of rows found
    // ========================================================================
    protected function getRecByEmail(string $email) {
      $sql = "SELECT COUNT(*) FROM " . $this->formsTableName . " WHERE email = ?";
      $stmt = $this->connect()->prepare($sql);
      $stmt->bindParam(1, $email, \PDO::PARAM_STR);
      $stmt->execute();
      $res = $stmt->fetchAll();
      return $res[0]['COUNT(*)'];
    } // end of getRecByEmail()

    // ==== getRecByNameEmail() ===============================================
    //
    // Check how many rows exists in the database with the name & email 
    // parameters.
    //
    // Parameters:
    //   $name        -- string of a name
    //   $email       -- string of an email
    //
    // Return:
    //   $res         -- string number of rows found
    // ========================================================================
    protected function getRecByNameEmail(string $name, string $email) {
      $sql = "SELECT COUNT(*) FROM " . $this->formsTableName . " WHERE name = ? AND email = ?";
      $stmt = $this->connect()->prepare($sql);
      $stmt->bindParam(1, $name, \PDO::PARAM_STR);
      $stmt->bindParam(2, $email, \PDO::PARAM_STR);
      $stmt->execute();
      $res = $stmt->fetchAll();
      return $res[0]['COUNT(*)'];
    } // end of getRecByNameEmail()

    // ==== delRecByEmail() ===================================================
    //
    // Find and delete the oldest contact form using the email parameter
    //
    // Parameters:
    //   $email      -- string of a email
    //
    // Return:
    //   TRUE        -- row deletion successful
    //   FALSE       -- row deletion failed
    // ========================================================================
    protected function delRecByEmail(string $email) {
      try {
        $sql = "DELETE FROM " . $this->formsTableName . " WHERE email = ? ORDER BY ts ASC LIMIT 1";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bindParam(1, $email, \PDO::PARAM_STR);
        $stmt->execute();
        $res = $stmt->fetchAll();
        return TRUE;
      } catch(PDOException $e) {
        return FALSE;
      }
    } // end of delRecByEmail()

    // ==== End of Method Declarations ========================================
    // ========================================================================

  } // end of FormsModel

  // ==== End of FormsModel ===================================================
  // ==========================================================================