<?php

/**
 *
 */
class Connection
{
  public static function make($config)
  {
    try
    {
      $pdo = new PDO(
        $config['host'].';port='.$config['db_port'].';dbname='.$config['db_name'],
        $config['username'],
        $config['password'],
        $config['options']
      );

      return $pdo;
    } catch (PDOException $e)
    {
      print_r($e);
      die('Could not connect');
    }
  }
}
