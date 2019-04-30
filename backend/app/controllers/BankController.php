<?php

require_once "app/controllers/BaseController.php";
require_once "app/models/Banks.php";


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

  public static function editBalance($betId,$betWinningOpt)
  {
    $dbhPrice=App::get('dbh');
    $reqPrice="SELECT participationPrice FROM bets WHERE id=?";
    $statementPrice = $dbhPrice->prepare($reqPrice);
    $statementPrice->bindParam(1, $betId);
    $statementPrice->execute();

    $res=$statementPrice->fetchAll();

    $price=$res[0]["participationPrice"];

    $dbh = App::get('dbh');
    $req = "SELECT * FROM users_bets WHERE users_bets.betId = ?";
    $statement = $dbh->prepare($req);
    $statement->bindParam(1, $betId);
    $statement->execute();

    while ($row = $statement->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {

      $dbhWinner=App::get('dbh');
      $reqWinner = "SELECT winOpt1,winOpt2 FROM Bets WHERE id = ?";
      $statementWin = $dbh->prepare($reqWinner);
      $statementWin->bindParam(1, $row[1]);
      $statementWin->execute();
      $r=$statementWin->fetchAll();

      if($r[0]["winOpt1"]==$betWinningOpt)
      {
        $w='0';
      }
      else {
        $w='1';
      }
      Banks::edit($row[0],$row[1],$row[2],$price,$w);
    }

  }

}
