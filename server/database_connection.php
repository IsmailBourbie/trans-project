<?php


//some constant for the host and everything we need to eshtablish a connection to database
define('DATABASE_SERVER','localhost');
define('DATABASE_USER','root');
define('DATABASE_PASSWORD','');
define('DATABASE_NAME','traduction_database');

class database_connection {
    public $connection;
    
    //a counstructor
    function __construct() {
        $this->connection = $this->connect();
    }
    
    //function will be called from the constructor
    public function connect() {
        
        //we rrtuen a connection and store it int the public field $connection
        
        return mysqli_connect(DATABASE_SERVER,
                DATABASE_USER,
                DATABASE_PASSWORD,
                DATABASE_NAME);
    }

}
