<?php

class Users extends Model implements JsonSerializable
{

  private $id;

  private $name;

  private $email;

  private $password;

  public function getId()
  {
    return $this->id;
  }

  public function setId($val)
  {
    $this->id = $val;
  }

  public function getName()
  {
    return $this->name;
  }

  public function setName($val)
  {
    $this->name = $val;
  }

  public function getEmail()
  {
    return $this->email;
  }

  public function setEmail($val)
  {
    $this->email = $val;
  }

  public function getPassword()
  {
    return $this->password;
  }

  public function setPassword($val)
  {
    $this->password = $val;
  }

  public function jsonSerialize()
  {
    return get_object_vars($this);
  }

  public function getByName()
  {
    $dbh = App::get('dbh');

    $req = "SELECT * FROM users WHERE name = ?";
    $statement = $dbh->prepare($req);
    $statement->bindParam(1, $this->name);
    $statement->execute();

    return $statement->fetchAll(PDO::FETCH_CLASS, "Users");
  }

  public static function getIdFromName($name)
  {
    $dbh = App::get('dbh');

    $req = "SELECT id FROM users WHERE name = ?";
    $statement = $dbh->prepare($req);
    $statement->bindParam(1, $name);
    $statement->execute();

    return $statement->fetchAll()[0]["id"];
  }

  public function save(){
    $dbh = App::get('dbh');

    $req = "INSERT INTO users (id, name, email, password) VALUES (DEFAULT, ?, ?, ?)";
    $statement = $dbh->prepare($req);
    $statement->bindParam(1, $this->name);
    $statement->bindParam(2, $this->email);
    $statement->bindParam(3, $this->password);

    return $statement->execute();
  }

  public static function fetchNameId()
  {
    $dbh = App::get('dbh');

    $req = "SELECT id,name FROM users";
    $statement = $dbh->prepare($req);
    $statement->execute();
    
    return $statement->fetchAll();
  }
}
