<?php

require "app/controllers/BaseController.php";

class BankController extends BaseController
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
    parent::checkIsLogged();
    // TODO : remove when not in dev
    header("Access-Control-Allow-Origin: ".$_SERVER['HTTP_ORIGIN']);
    header('Access-Control-Allow-Credentials: true');
    header('Content-type: application/json');

    echo json_encode(Banks::fetchBankById($_SESSION['userId']));
  }

}
