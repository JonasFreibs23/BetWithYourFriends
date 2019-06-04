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

  public static function edit($userId, $betId, $betOpt, $price, $winningOption)
  {
    $dbh = App::get('dbh');
    if($winningOption == $betOpt)
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

  public static function editBalance($userIdAsk, $userIdAccept, $value)
  {
    $dbhAsk = App::get('dbh');
    $reqAsk = "UPDATE bank_accounts SET balance = (balance + ?) WHERE userId = ?";
    $statementAsk = $dbhAsk->prepare($reqAsk);
    $statementAsk->bindParam(1, $value);
    $statementAsk->bindParam(2, $userIdAsk);
    $resultAsk=$statementAsk->execute();

    $dbhAcc = App::get('dbh');
    $reqAcc = "UPDATE bank_accounts SET balance = (balance - ?) WHERE userId = ?";
    $statementAcc = $dbhAcc->prepare($reqAcc);
    $statementAcc->bindParam(1, $value);
    $statementAcc->bindParam(2, $userIdAccept);
    $resultAcc=$statementAcc->execute();

    return ($resultAsk||$resultAcc);
  }

}
