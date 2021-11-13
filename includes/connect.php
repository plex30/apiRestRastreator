<?php 
require __DIR__ . './../vendor/autoload.php';
include_once dirname(__FILE__) . '/config.php';

class Connect {
    private $connect;
   

    function __construct()
    {
        
    }

   function connectDB(){
       try {
          $this->connect = new MongoDB\Client('mongodb+srv://root:root@cluster0.6f37h.mongodb.net/dbRastreator?retryWrites=true&w=majority');
        
       } catch (MongoDB\Exception\Exception $e) {
           echo "Cannnot connect to MongoDb";
       }

       return $this->connect;
   }

}