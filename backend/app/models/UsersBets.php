<?php

class UsersBets extends Model implements JsonSerializable
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

  public function jsonSerialize()
  {
    return get_object_vars($this);
  }

  public static function fetchUsersBetsById($id){
    return parent::fetchById("users_bets", "userId", $id, "UsersBets");
  }

  public static function fetchTrendingBetsId(){
    $dbh = App::get('dbh');

    $req = "SELECT betId FROM users_bets GROUP BY betId ORDER BY COUNT(*) DESC";
    $statement = $dbh->prepare($req);
    $statement->execute();

    return $statement->fetchAll();
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
