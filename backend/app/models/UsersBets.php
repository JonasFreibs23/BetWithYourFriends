<?php

class UsersBets
{
  // Attributes
  private $userId;

  private $betId;

  private $betOpt;


  public function getUserId()
  {
    return $this->userId;
  }

  public function setUserId($value)
  {
    $this->userId = $value;
  }

  public function getBetId()
  {
    return $this->betId;
  }

  public function setBetId($value)
  {
    $this->betId = $value;
  }

  public function getBetOpt()
  {
    return $this->betOpt;
  }

  public function setBetOpt($value)
  {
    $this->betOpt = $value;
  }

}
