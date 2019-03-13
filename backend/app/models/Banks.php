<?php

class Banks extends Model implements JsonSerializable
{

  private $userId;
  private $balance;

  public function getUserId()
  {
      return $this->userId;
  }

  public function setUserId($val)
  {
      $this->userId = $val;
  }

  public function getBalance()
  {
      return $this->balance;
  }

  public function setBalance($val)
  {
      $this->balance = $val;
  }

  public static function fetchBankById($userId)
  {
    return parent::fetchById("bank_accounts", "userId", $userId, "Banks");
  }

  public function save()
  {
    // TODO
  }

  public function jsonSerialize()
  {
    return get_object_vars($this);
  }

}
