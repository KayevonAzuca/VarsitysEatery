<?php
  class FormsModel extends FormsDBC {

    protected function chkForm($fName, $email) {
      $sql = "SELECT * FROM " . $this->formsTableName . " WHERE fName = ? AND email = ?";
      $stmt = $this->connect()->prepare($sql);
      $stmt->bindParam(1, $fName, PDO::PARAM_STR);
      $stmt->bindParam(2, $email, PDO::PARAM_STR);
      $stmt->execute();
      $res = $stmt->fetchAll();
      if($res){
        return TRUE;
      } else {
        return FALSE;
      }
    } // end of "chkForm()"

    protected function getForm($fName, $email) {
      $sql = "SELECT * FROM " . $this->formsTableName . " WHERE fName = ? AND email = ?";
      $stmt = $this->connect()->prepare($sql);
      $stmt->bindParam(1, $fName, PDO::PARAM_STR);
      $stmt->bindParam(2, $email, PDO::PARAM_STR);
      $stmt->execute();
      $res = $stmt->fetchAll();
      return $res;
    } // end of "getForm()"

    protected function setForm($arr) {
      $sql = "INSERT INTO " . $this->formsTableName . "(fName, email, custMsg, telNum, persFavFood, rating, retCust, favCat, ts) 
      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
      $stmt = $this->connect()->prepare($sql);
      $stmt->execute([$arr['fName'], $arr['email'], $arr['custMsg'], $arr['telNum'], $arr['persFavFood'], $arr['rating'], $arr['retCust'], $arr['favCat'], $arr['ts']]);
    } // end of "getForm()"
  } // end of "FormsModel"
 ?>