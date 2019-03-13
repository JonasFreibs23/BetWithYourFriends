<?php

class BankController
{

  public function getUserBalance()
  {
    // TODO ne pas mettre en dur
    $userId = 1;

    // TODO : remove when not in dev
    header("Access-Control-Allow-Origin: *");
    header('Content-type: application/json');
    echo json_encode(Banks::fetchBankById($userId));
  }

}
