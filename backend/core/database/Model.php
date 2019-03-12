<?php

abstract class Model
{

  public static function fetchAll($table, $intoClass){
    $dbh = App::get('dbh');

    $req = "SELECT * FROM {$table}";
    $statement = $dbh->prepare($req);
    $statement->execute();

    return $statement->fetchAll(PDO::FETCH_CLASS, $intoClass);
  }

  public static function fetchById($table, $id, $intoClass){
    $dbh = App::get('dbh');

    $req = "SELECT * FROM {$table} WHERE id = ?";
    $statement = $dbh->prepare($req);
    $statement->bind(1, $id);
    $statement->execute();

    return $statement->fetchAll(PDO::FETCH_CLASS, $intoClass);
  }

  public abstract function save();

}
