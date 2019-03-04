<?php

class Bets
{
  // Attributes
  private $id;

  private $title;

  private $description;

  private $eventDate;

  private $winOpt1;

  private $winOpt2;

  private $participationPrice;

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

}
