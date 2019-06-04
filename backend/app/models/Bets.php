<?php

class Bets extends Model implements JsonSerializable
{
  // Attributes
  private $id;

  private $title;

  private $description;

  private $eventDate;

  private $winOpt1;

  private $winOpt2;

  private $participationPrice;

  private $winningOption;

  private $altered;

  public function getId()
  {
    return $this->id;
  }

  public function setId($value)
  {
    $this->id = $value;
  }

  public function getTitle()
  {
    return $this->title;
  }

  public function setTitle($value)
  {
    $this->title = $value;
  }

  public function getDescription()
  {
    return $this->description;
  }

  public function setDescription($value)
  {
    $this->description = $value;
  }

  public function getEventDate()
  {
    return $this->eventDate;
  }

  public function setEventDate($value)
  {
    $this->eventDate = $value;
  }

  public function getWinOpt1()
  {
    return $this->winOpt1;
  }

  public function setWinOpt1($value)
  {
    $this->winOpt1 = $value;
  }

  public function getWinOpt2()
  {
    return $this->winOpt2;
  }

  public function setWinOpt2($value)
  {
    $this->winOpt2 = $value;
  }

  public function getParticipationPrice()
  {
    return $this->participationPrice;
  }

  public function setParticipationPrice($value)
  {
    $this->participationPrice = $value;
  }

  public function getWinningOption()
  {
    return $this->winningOption;
  }

  public function setWinningOption($value)
  {
    $this->winningOption = $value;
  }

  public function getAltered()
  {
    return $this->winningOption;
  }

  public function setAltered($value)
  {
    $this->altered = $value;
  }

  public function jsonSerialize()
  {
    return get_object_vars($this);
  }

  public static function fetchBets(){
    return parent::fetchAll("bets", "Bets");
  }

  public static function fetchBetById($id){
    return parent::fetchById("bets", "id", $id, "Bets");
  }

  public function save()
  {
    $dbh = App::get('dbh');
    $req = "INSERT INTO bets (title, description, eventDate, winOpt1, winOpt2, participationPrice) VALUES (?, ?, ?, ?, ?, ?)";
    $statement = $dbh->prepare($req);
    $statement->bindParam(1, $this->title);
    $statement->bindParam(2, $this->description);
    $statement->bindParam(3, $this->eventDate);
    $statement->bindParam(4, $this->winOpt1);
    $statement->bindParam(5, $this->winOpt2);
    $statement->bindParam(6, $this->participationPrice);
    return $statement->execute();
  }

  public function edit()
  {
    $dbh = App::get('dbh');
    $req = "UPDATE bets SET winningOption = ?, altered = TRUE WHERE id = ?";
    $statement = $dbh->prepare($req);
    $statement->bindParam(1, $this->winningOption);
    $statement->bindParam(2, $this->id);
    return $statement->execute();
  }

}
