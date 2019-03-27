<?php

class BankController
{

  /**
   * @ApiDescription(section="BankController", description="Get user balance")
   * @ApiMethod(type="get")
   * @ApiRoute(name="/getUserBalance")
   * @ApiReturn(type="json", sample="{
   *  'balance':'double',
   * }")
   */
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
