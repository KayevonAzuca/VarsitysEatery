<?php
  class FormsDBC {
    private $host = "";
    private $user = "";
    private $pwd = "";
    private $dbName = "";
    protected $formsTableName = "";

    protected function connect() {
      $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName;
      $pdo = new PDO($dsn, $this->user, $this->pwd);
      $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
      return $pdo;
    } // end of "connect()"
  } // end of "FormsDBC"
 ?>