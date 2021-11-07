<?php
  class DB {
      private static  function connect()
      {
         $pdo = new PDO('mysql:host=127.0.0.1;dbname=impulse;charset=utf8', 'root' , '');
         $pdo->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
         return $pdo;
      }
      public static function query($query , $param)
      {
         $statement = self::connect()->prepare($query);
         $statement->execute($param);
         if (explode(' ' , $query)[0] == 'SELECT') {
             $data = $statement->fetchAll();
             return $data;
         }
      }
  }
?>