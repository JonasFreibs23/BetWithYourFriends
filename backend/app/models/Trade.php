<?php

class Trade extends Model implements JsonSerializable
{
  private $tradeId;
  private $userIdAsk;
  private $userIdAccept;
  private $isAccepted;
  private $isPaid;
  private $value;

  public function getTradeId()
  {
      return $this->tradeId;
  }

  public function setTradeId($val)
  {
      $this->tradeId = $val;
  }

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
      return $this->userIdAccept;
  }

  public function setUserIdAccept($val)
  {
      $this->userIdAccept = $val;
  }

  public function getIsAccepted()
  {
      return $this->isAccepted;
  }

  public function setIsAccepted($val)
  {
      $this->isAccepted = $val;
  }

  public function getIsPaid()
  {
      return $this->isPaid;
  }

  public function setIsPaid($val)
  {
      $this->isPaid = $val;
  }

  public function getValue()
  {
      return $this->value;
  }

  public function setValue($val)
  {
      $this->value = $val;
  }

  public static function fetchTradeToBeAcceptedByName($userId)
  {
    $dbh = App::get('dbh');
    $req = "SELECT * FROM trade WHERE userIdAccept = ? AND isAccepted IS NULL AND isPaid IS NULL";

    $statement = $dbh->prepare($req);
    $statement->bindParam(1, $userId);
    $statement->execute();

    $res = $statement->fetchAll(PDO::FETCH_CLASS, "Trade");

    for ($i=0; $i < count($res); $i++) {
      $res[$i]->setUserIdAsk(Users::getNameById($res[$i]->getUserIdAsk()));
      $res[$i]->setUserIdAccept(Users::getNameById($res[$i]->getUserIdAccept()));
    }
    return $res;
  }

  public static function fetchTradeToBePaidByName($userId)
  {
    $dbh = App::get('dbh');
    $req = "SELECT * FROM trade WHERE userIdAccept = ? AND isAccepted = TRUE AND isPaid is NULL";
    $statement = $dbh->prepare($req);
    $statement->bindParam(1, $userId);
    $statement->execute();

    $res = $statement->fetchAll(PDO::FETCH_CLASS, "Trade");

    for ($i=0; $i < count($res); $i++) {
      $res[$i]->setUserIdAsk(Users::getNameById($res[$i]->getUserIdAsk()));
      $res[$i]->setUserIdAccept(Users::getNameById($res[$i]->getUserIdAccept()));
    }

    return $res;
  }

  public static function fetchTradeFinished($userId)
  {
    $dbh = App::get('dbh');
    $req = "SELECT * FROM trade WHERE userIdAccept = ? AND isAccepted = TRUE AND isPaid = TRUE";
    $statement = $dbh->prepare($req);
    $statement->bindParam(1, $userId);
    $statement->execute();

    $res = $statement->fetchAll(PDO::FETCH_CLASS, "Trade");

    for ($i=0; $i < count($res); $i++) {
      $res[$i]->setUserIdAsk(Users::getNameById($res[$i]->getUserIdAsk()));
      $res[$i]->setUserIdAccept(Users::getNameById($res[$i]->getUserIdAccept()));
    }

    return $res;
  }

  public function jsonSerialize()
  {
    return get_object_vars($this);
  }

  public function save()
  {
    $dbh = App::get('dbh');

    $req = "INSERT INTO trade (userIdAsk, userIdAccept,  value) VALUES (?, ?, ?)";
    $statement = $dbh->prepare($req);
    $statement->bindParam(1, $this->userIdAsk);
    $statement->bindParam(2, $this->userIdAccept);
    $statement->bindParam(3, $this->value);

    return $statement->execute();
  }

  public static function deleteById($tradeId)
  {
    $dbh = App::get('dbh');

    $req = "DELETE FROM trade WHERE tradeId = ?";
    $statement = $dbh->prepare($req);
    $statement->bindParam(1, $tradeId);

    return $statement->execute();
  }

  public static function updateState($tradeId)
  {
    $dbhSelect = App::get('dbh');
    $reqSelect = "SELECT * FROM trade WHERE tradeId = ?";
    $statementSelect = $dbhSelect->prepare($reqSelect);
    $statementSelect->bindParam(1, $tradeId);
    $statementSelect->execute();
    $result = $statementSelect->fetch()["isAccepted"];

    if($result == 1){
      //trade paid

      $dbh = App::get('dbh');
      $req = "SELECT userIdAsk,userIdAccept,value FROM trade WHERE tradeId = ?";
      $statement = $dbh->prepare($req);
      $statement->bindParam(1, $tradeId);
      $statement->execute();

      $res = $statement->fetchAll();

      $userIdAsk = $res[0]["userIdAsk"];
      $userIdAccept = $res[0]["userIdAccept"];
      $value = $res[0]["value"];

      $dbhUpdate = App::get('dbh');
      $reqUpdate = "UPDATE trade SET isPaid = TRUE WHERE tradeId = ?";
      $statementUpdate = $dbh->prepare($reqUpdate);
      $statementUpdate->bindParam(1, $tradeId);
      $statementUpdate->execute();

      return Banks::editBalance($userIdAsk, $userIdAccept, $value);
    }
    else {
      //trade accepted

      $dbh = App::get('dbh');
      $req = "UPDATE trade SET isAccepted = TRUE WHERE tradeId = ?";
      $statement = $dbh->prepare($req);
      $statement->bindParam(1, $tradeId);
      return $statement->execute();
    }

  }
}
