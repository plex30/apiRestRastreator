<?php

use function MongoDB\BSON\toJSON;

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
            
            
             
        } catch (MongoDB\Exception\Exception $e) {
        
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
      
      
        $cursor = $this->collection->find();
        foreach ($cursor as $document) {
            $bson = MongoDB\BSON\fromPHP($document);
            $response[]= json_decode(MongoDB\BSON\toJSON($bson), true);
        }

        foreach ($response as $key => $value) {
            foreach ($value as $key => $val) {
                if ($key != '_id') { 
                    if ($val['max'] >= 10000) {
                       
                        $json[] =["name"=>$key] + $val;
                       
                    }    
                }
            }
        }
        
        usort($json, function ($a, $b)
        {
            $t1 = $a['max'];
            $t2 = $b['max'];
            return $t1 - $t2;
        }    );


        return $json;
    
    }

    public function getAllSeguros(){
       
        $this->collection = $this->connection->dbRastreator->seguros;
      
        $cursor = $this->collection->find();

        foreach ($cursor as $document) {
            $bson = MongoDB\BSON\fromPHP($document);
            $response[]= json_decode(MongoDB\BSON\toJSON($bson), true);
        }
        foreach ($response as $key => $value) {
            foreach ($value as $key => $val) {
                if ($key != '_id') { 
                    $jsonBasic[] = ["name"=>$key]+$val['basic']; 
                    $jsonPlus[] = ["name"=>$key]+$val['plus']; 
                    $jsonFull[] = ["name"=>$key]+$val['full']; 
                }
            }
        }
        usort($jsonBasic, function ($a, $b)
        {
            $t1 = $a['price_from'];
            $t2 = $b['price_from'];
            return $t1 - $t2;
        }    );

        usort($jsonPlus, function ($a, $b)
        {
            $t1 = $a['price_from'];
            $t2 = $b['price_from'];
            return $t1 - $t2;
        }    );

        usort($jsonFull, function ($a, $b)
        {
            $t1 = $a['price_from'];
            $t2 = $b['price_from'];
            return $t1 - $t2;
        }    );

        $json = [$jsonBasic[0], $jsonPlus[0], $jsonFull[0]];

        return $json;
        
    }

  
}