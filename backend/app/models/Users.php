<?php

class Users implements \JsonSerializable
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

}
