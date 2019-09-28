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
    if(strlen($value) < 3)
      throw new Exception("Title length is smaller than 3");
    $this->title = $value;
  }

  public function getDescription()
  {
    return $this->description;
  }

  public function setDescription($value)
  {
    if(strlen($value) < 3)
      throw new Exception("Description length is smaller than 3");
    $this->description = $value;
  }

  public function getEventDate()
  {
    return $this->eventDate;
  }

  public function setEventDate($value)
  {
    $date_now = date("Y-m-d");
    if($value <= $date_now)
      throw new Exception("The date is not upcoming");
    $this->eventDate = $value;
  }

  public function getWinOpt1()
  {
    return $this->winOpt1;
  }

  public function setWinOpt1($value)
  {
    if(strlen($value) < 1)
      throw new Exception("Option 1 length is smaller than 1");
    if(!ctype_alnum($value))
      throw new Exception("Option 2 does not contain only alpha numeric");
    $this->winOpt1 = $value;
  }

  public function getWinOpt2()
  {
    return $this->winOpt2;
  }

  public function setWinOpt2($value)
  {
    if(strlen($value) < 1)
      throw new Exception("Option 2 length is smaller than 1");
    if(!ctype_alnum($value))
      throw new Exception("Option 2 does not contain only alpha numeric");
    $this->winOpt2 = $value;
  }

  public function getParticipationPrice()
  {
    return $this->participationPrice;
  }

  public function setParticipationPrice($value)
  {
    if(!ctype_digit($_POST["participationPrice"]))
      throw new Exception("Partication price is not numeric");
    if($value < 0)
      throw new Exception("Partication price is smaller than 0");
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
