<?php

class Trade extends Model implements JsonSerializable
{

  private $userIdAsk;
  private $userIdAccept;
  private $isAccepted;
  private $isPaid;
  private $value;

  public function getUserIdAsk()
  {
      return $this->userIdAsk;
  }

  public function setUserIdAsk($val)
  {
      $this->userIdAsk = $val;
  }

  public function getUserIdAccept()
  {
      return $this->userIdccept;
  }

  public function setUserIdAccept($val)
  {
      $this->userIdAccept = $val;
  }

  public function getIsAccepted()
  {
      return $this->$isAccepted;
  }

  public function setisAccepted($val)
  {
      $this->$isAccepted = $val;
  }

  public function getIsPaid()
  {
      return $this->$isPaid;
  }

  public function setIsPaid($val)
  {
      $this->$isPaid = $val;
  }

  public function getValue()
  {
      return $this->$value;
  }

  public function setValued($val)
  {
      $this->$value = $val;
  }

  public static function fetchTradeById($userId)
  {
    #return parent::fetchById("bank_accounts", "userId", $userId, "Banks");
    return parent::fetchById("trade", "userIdAsk", $userId, "Trade");

  }

  public function jsonSerialize()
  {
    return get_object_vars($this);
  }

  public function save()
  {
    // TODO
  }

}
