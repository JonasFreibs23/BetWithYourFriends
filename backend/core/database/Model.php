<?php

abstract class Model
{

  public static function fetchAll($table, $intoClass)
  {
    $dbh = App::get('dbh');

    $req = "SELECT * FROM {$table}";
    $statement = $dbh->prepare($req);
    $statement->execute();

    return $statement->fetchAll(PDO::FETCH_CLASS, $intoClass);
  }

  public static function fetchById($table, $colId, $id, $intoClass)
  {
    $dbh = App::get('dbh');

    $req = "SELECT * FROM {$table} WHERE {$colId} = ?";
    $statement = $dbh->prepare($req);
    $statement->bindParam(1, $id);
    $statement->execute();

    return $statement->fetchAll(PDO::FETCH_CLASS, $intoClass);
  }

  public abstract function save();

}
