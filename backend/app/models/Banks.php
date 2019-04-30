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
    $retBalance["balance"] = $this->balance;
    return $retBalance;
  }

  public static function edit($userId,$betId,$betOpt,$price,$w)
  {
    $dbh = App::get('dbh');
    if($w==$betOpt)
    {
        $req = "UPDATE bank_accounts SET balance = (balance + :p) WHERE userId = :id";

        $statement = $dbh->prepare($req);
        $statement->bindParam(':p', $price);
        $statement->bindParam(':id', $userId);
    }
    else {
      $req = "UPDATE bank_accounts SET balance = (balance - :p) WHERE userId = :id";

      $statement = $dbh->prepare($req);
      $statement->bindParam(':p', $price);
      $statement->bindParam(':id', $userId);
    }

    return $statement->execute();
  }

}
