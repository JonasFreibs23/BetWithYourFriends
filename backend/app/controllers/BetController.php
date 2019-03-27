<?php

require "app/controllers/BaseController.php";
// TODO : check user is logged to api call

class BetController extends BaseController
{

  /**
   * @ApiDescription(section="BetController", description="Get existing bets")
   * @ApiMethod(type="get")
   * @ApiRoute(name="/getBets")
   * @ApiReturn(type="json", sample="Bets")
   */
  public function getBets()
  {
    $bets = Bets::fetchBets();

    // TODO : remove when not in dev
    header("Access-Control-Allow-Origin: *");
    header('Content-type: application/json');
    echo json_encode($bets);
  }

  /**
   * @ApiDescription(section="BetController", description="Create a new bet")
   * @ApiMethod(type="post")
   * @ApiRoute(name="/createBet")
   * @ApiReturn(type="boolean")
   */
  public function createBet()
  {
    $bet = new Bets;
    // TODO : remove when not in dev
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');
    }

    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

        exit(0);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = json_decode(file_get_contents("php://input"), true);

      $bet = new Bets();
      $bet->setTitle($_POST["title"]);
      $bet->setDescription($_POST["description"]);
      $bet->setWinOpt1($_POST["option1"]);
      $bet->setWinOpt2($_POST["option2"]);
      $bet->setEventDate($_POST["eventDate"]);
      $bet->setParticipationPrice($_POST["participationPrice"]);

      try{
        header("Access-Control-Allow-Origin: *");
        echo $bet->save();
      }
      catch(PDOException $err){
        header("Access-Control-Allow-Origin: *");
        echo $err->getMessage();
      }
    }
  }

  /**
   * @ApiDescription(section="BetController", description="Apply to a bet")
   * @ApiMethod(type="post")
   * @ApiRoute(name="/applyToBet")
   * @ApiReturn(type="boolean")
   */
  public function applyToBet(){

    // TODO : remove when not in dev
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }

    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

        exit(0);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $_POST = json_decode(file_get_contents("php://input"), true);

      try{
        $usersBets = new UsersBets();
        $usersBets->setUserId($_POST["userId"]);
        $usersBets->setBetId($_POST["betId"]);
        $usersBets->setBetOpt($_POST["betOpt"]);

        header("Access-Control-Allow-Origin: *");
        echo $usersBets->save();
      }
      catch(PDOException $err){
        header("Access-Control-Allow-Origin: *");
        echo $err->getMessage();
      }

    }
  }

  /**
   * @ApiDescription(section="BetController", description="Get the bets the user has applied to")
   * @ApiMethod(type="get")
   * @ApiRoute(name="/getUsersBets")
   * @ApiReturn(type="json", sample="UsersBets")
   */
  public function getUsersBets(){
    // TODO : change hard coded userid
    $userId = 1;
    try{
  		$usersBets = UsersBets::fetchUsersBetsById($userId);

      header("Access-Control-Allow-Origin: *");
      header('Content-type: application/json');
      echo json_encode($usersBets);
    }
    catch(PDOException $err){
      header("Access-Control-Allow-Origin: *");
      echo $err->getMessage();
    }
  }

  /**
   * @ApiDescription(section="BetController", description="Get a bet by id")
   * @ApiMethod(type="get")
   * @ApiRoute(name="/getBetById")
   * @ApiParams(name="betId", type="int", description="The bet's id")
   * @ApiReturn(type="json", sample="Bets")
   */
  public function getBetById(){
    $betId = $_GET["betId"];
    $dbh = App::get('dbh');
    try{
  		$bets = Bets::fetchBetById($betId);

      header("Access-Control-Allow-Origin: *");
      header('Content-type: application/json');
      echo json_encode($bets);
    }
    catch(PDOException $err){
      header("Access-Control-Allow-Origin: *");
      echo $err->getMessage();
    }
  }

  /**
   * @ApiDescription(section="BetController", description="Set the winning option to a bet by id")
   * @ApiMethod(type="get")
   * @ApiRoute(name="/editBet")
   * @ApiParams(name="betId", type="int", description="The bet's id")
   * @ApiReturn(type="boolean")
   */
  public function editBet(){
    // TODO : check valid data
    $betId = $_GET["betId"];
    $betWinningOpt = $_GET["betWinningOpt"];
    $dbh = App::get('dbh');
    try{
      $bet = new Bets();
      $bet->setId($betId);
      $bet->setWinningOption($betWinningOpt);

      header("Access-Control-Allow-Origin: *");
      echo $bet->edit();
    }
    catch(PDOException $err){
      header("Access-Control-Allow-Origin: *");
      echo $err->getMessage();
    }
  }

}
