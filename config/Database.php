<?php 
  class Database {
    // DB Params
    //Define the class properties here
    //private $conn; for example

    // DB Connect
    public function connect() {
      $url = getenv('JAWSDB_URL');
      $dbparts = parse_url($url);

      $hostname = $dbparts['host'];
      $username = $dbparts['user'];
      $password = $dbparts['pass'];
      $database = ltrim($dbparts['path'],'/');
      //You cannot do the above for your local dev environment, just Heroku

      //Create your new PDO connection here


    function __construct() {
      $this->url = getenv('JAWSDB_URL');
    }

     // This is also from the Heroku docs showing the PDO connection:

    try {
      $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
      // set the PDO error mode to exception
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo "Connected successfully";
      }
    catch(PDOException $e)
      {
      echo "Connection failed: " . $e->getMessage();
      }
  }
}
