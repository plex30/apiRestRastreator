<?php

require_once dirname(__FILE__) . '/connect.php';
require __DIR__ . './../vendor/autoload.php';

class dbHandler{

   
    private $colecction;
    private $connection;

    function __construct()
    {
        try {
            $db = new connect();
            $this->connection = $db->connectDB();
            
            
             
        } catch (MongoDB\Driver\Exception\Exception $e) {
        
            $filename = basename(__FILE__);
            
            echo "The $filename script has experienced an error.\n"; 
            echo "It failed with the following exception:\n";
            
            echo "Exception:", $e->getMessage(), "\n";
            echo "In file:", $e->getFile(), "\n";
            echo "On line:", $e->getLine(), "\n";       
        }
        

    }

    public function getAllBancos(){
       
        $this->collection = $this->connection->dbRastreator->bancos;
      

        print_r($this->collection->find()->toArray());
    }

    public function getAllSeguros(){
       
        $this->collection = $this->connection->dbRastreator->seguros;
      

        print_r($this->collection->find()->toArray());
    }
}