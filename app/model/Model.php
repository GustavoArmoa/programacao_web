<?php

namespace CRUD\model;

use PDO;

abstract class Model {

    protected static $pdo;
    private static $host = "localhost";
    private static $db   = "undb";
    private static $user = "root";
    private static $pass = "123456";

    public static function getPDO(){
        try{

            if(!isset(self::$pdo)){
                self::$pdo = new PDO(
                    'mysql:host='.self::$host.';dbname='.self::$db,
                    self::$user,
                    self::$pass,
                    [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"]
                );
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$pdo->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_EMPTY_STRING);
            }

            return self::$pdo;

        } catch (\Exception $e){
            throw $e;
        }
    }
}