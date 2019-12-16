<?php
namespace App\resources\packages\database\dbconnection;

use \PDO;

/**
 * PDO connection to the database.
 *
 * @author Dilan Madhusanka
 */
class DBConnection extends PDO {
    private $options = array(
        PDO::ATTR_PERSISTENT => true,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    );

    public function __construct() {
        parent::__construct(DB_DRIVER . ':host=' . DB_HOST . ';dbname=' . DB_DATABASE, DB_USERNAME, DB_PASSWORD, $this->options);
    }
}