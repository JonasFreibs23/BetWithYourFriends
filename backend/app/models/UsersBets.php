<?php

class UsersBets extends Model
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

  public static function fetchUsersBetsById($id){
    parent::fetchById("users_bets", $id, "UsersBets");
  }

  public function save(){
    $dbh = App::get('dbh');

    $req = "INSERT INTO users_bets VALUES (?, ?, ?)";
    $statement = $dbh->prepare($req);
    $statement->bindParam(1, $this->userId);
    $statement->bindParam(2, $this->betId);
    $statement->bindParam(3, $this->betOpt);

    return $statement->execute();
  }

}
