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

  public static function edit($userId,$betId,$betOpt,$price)
  {
    // var_dump("user");
    // var_dump($userId);
    // var_dump("bet");
    // var_dump($betId);
    // var_dump("opt");
    // var_dump($betOpt);
    //

    //TODO : verif si ils ont bien parié ou non
    $dbh = App::get('dbh');

    $req = "UPDATE bank_accounts SET balance = balance + ? WHERE userId = ?";
    $statement = $dbh->prepare($req);
    $statement->bindParam(1, $price);
    $statement->bindParam(2, $userId);

    return $statement->execute();
  }

}
