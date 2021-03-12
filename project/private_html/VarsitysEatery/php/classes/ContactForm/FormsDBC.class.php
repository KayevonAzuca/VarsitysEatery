<?php
  // ==========================================================================
  // file: FormsDBC.class.php
  // ==========================================================================
  // Developer: Kayevon Azuca
  // Date: 1/5/2021
  // Description: 
  //   This is the database and table connection used for the 
  //   ContactForm MVC pattern.
  // ==========================================================================

  declare(strict_types = 1);
  namespace ContactForm;

  // ==== FormsDBC ============================================================
  //
  // Establish a database and table connection instance and provide the table
  // name to any class extenting this class.
  //
  // ==========================================================================
  class FormsDBC {

    // ==== Property Declarations =============================================
    // ========================================================================

    private $host = "";
    private $user = "";
    private $pwd = "";
    private $dbName = "";
    protected $formsTableName = "";

    // ==== End of Property Declarations ======================================
    // ========================================================================

    // ==== Method Declarations ===============================================
    // ========================================================================

    // ==== connect ===========================================================
    //
    // Establish a database and table connection.
    //
    // Parameters:
    //   none
    //
    // Return:
    //   $pdo       -- database connect instance
    // ========================================================================
    protected function connect() {
      $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbName;
      $pdo = new \PDO($dsn, $this->user, $this->pwd);
      $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
      $pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
      return $pdo;
    } // end of "connect()"

    // ==== End of Method Declarations ========================================
    // ========================================================================

  } // end of "FormsDBC"

  // ==== End of FormsDBC =====================================================
  // ==========================================================================