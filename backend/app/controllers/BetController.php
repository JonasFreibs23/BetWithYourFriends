<?php

require_once "app/controllers/BaseController.php";
require_once "app/controllers/BankController.php";

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
    if (isset($_SERVER['HTTP_ORIGIN']))
    {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');
    }

    try
    {
      $bets = Bets::fetchBets();
      header('Content-type: application/json');
      echo json_encode($bets);
    }
    catch(Exception $err)
    {
      echo $err->getMessage();
    }
    catch(PDOException $er)
    {
      echo $err->getMessage();
    }
  }

  /**
   * @ApiDescription(section="BetController", description="Get the most trendy bets")
   * @ApiMethod(type="get")
   * @ApiRoute(name="/getTrendingBets")
   * @ApiReturn(type="json", sample="Bets")
   */
  public function getTrendingBets()
  {
    $trendingBetsIds = UsersBets::fetchTrendingBetsId();

    $bets = [];
    foreach($trendingBetsIds as $trendingBetId)
    {
      $bet = Bets::fetchBetById($trendingBetId[0]);
      array_push($bets, $bet[0]);
    }

    if (isset($_SERVER['HTTP_ORIGIN']))
    {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');
    }

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

    if (isset($_SERVER['HTTP_ORIGIN']))
    {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');
    }

    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS')
    {
        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

        exit(0);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        parent::checkIsLogged();

        $_POST = json_decode(file_get_contents("php://input"), true);

         if(isset($_POST["title"]) && isset($_POST["description"]) && isset($_POST["option1"]) && isset($_POST["option2"])
            && isset($_POST["eventDate"]) && isset($_POST["participationPrice"]))
         {
          $bet = new Bets();

          header("Access-Control-Allow-Origin: ".$_SERVER['HTTP_ORIGIN']);
          header('Access-Control-Allow-Credentials: true');

          try
          {
            $bet->setTitle($_POST["title"]);
            $bet->setDescription($_POST["description"]);
            $bet->setWinOpt1($_POST["option1"]);
            $bet->setWinOpt2($_POST["option2"]);
            $bet->setEventDate($_POST["eventDate"]);
            $bet->setParticipationPrice($_POST["participationPrice"]);
          }
          catch(Exception $err)
          {
            echo $err->getMessage();
          }

          try
          {
            echo $bet->save();
          }
          catch(PDOException $err){
            echo $err->getMessage();
          }
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

    if (isset($_SERVER['HTTP_ORIGIN']))
    {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }

    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS')
    {

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

        exit(0);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
      parent::checkIsLogged();

      $_POST = json_decode(file_get_contents("php://input"), true);

       if(isset($_POST["betId"]) && ctype_digit($_POST["betId"]) && isset($_POST["betOpt"]))
       {
         header("Access-Control-Allow-Origin: ".$_SERVER['HTTP_ORIGIN']);
         header('Access-Control-Allow-Credentials: true');

        try
        {
          $usersBets = new UsersBets();
          $usersBets->setUserId($_SESSION["userId"]);
          $usersBets->setBetId($_POST["betId"]);
          $usersBets->setBetOpt($_POST["betOpt"]);

          echo $usersBets->save();
        }
        catch(PDOException $err)
        {
          if($err->getCode() === "23000")
          {
            echo "Vous avez déjà un pari existant pour cet événement";
            exit(0);
          }
          echo $err->getMessage();
        }
        catch(Exception $err)
        {
          echo $err->getMessage();
        }
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
    parent::checkIsLogged();

    try
    {
      header("Access-Control-Allow-Origin: ".$_SERVER['HTTP_ORIGIN']);
      header('Access-Control-Allow-Credentials: true');
  		$usersBets = UsersBets::fetchUsersBetsById($_SESSION['userId']);

      header('Content-type: application/json');
      echo json_encode($usersBets);
    }
    catch(PDOException $err)
    {
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
  public function getBetById()
  {
    $betId = $_GET["betId"];
    $dbh = App::get('dbh');
    try
    {
      header("Access-Control-Allow-Origin: ".$_SERVER['HTTP_ORIGIN']);
      header('Access-Control-Allow-Credentials: true');
  		$bets = Bets::fetchBetById($betId);

      header('Content-type: application/json');
      echo json_encode($bets);
    }
    catch(PDOException $err){
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
  public function editBet()
  {
    parent::checkIsLogged();

    if (isset($_SERVER['HTTP_ORIGIN']))
    {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }

    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS')
    {

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
            header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

        exit(0);
    }

    if(isset($_GET["betId"]) && ctype_digit($_GET["betId"]) && isset($_GET["betWinningOpt"]))
    {
      $betId = $_GET["betId"];
      $betWinningOpt = $_GET["betWinningOpt"];
      $bets = Bets::fetchBetById($betId);
      $betCreatorId = $bets[0]->getId();
      $betHasBeenAltered = $bets[0]->getAltered();

      if($betId === $betCreatorId)
      {
        if(!$betHasBeenAltered)
        {
          $dbh = App::get('dbh');
          try
          {
            header("Access-Control-Allow-Origin: ".$_SERVER['HTTP_ORIGIN']);
            header('Access-Control-Allow-Credentials: true');
            $bet = new Bets();
            $bet->setId($betId);
            $bet->setWinningOption($betWinningOpt);

            echo $bet->edit();
          }
          catch(PDOException $err)
          {
            echo $err->getMessage();
          }
          catch(Exception $err)
          {
            echo $err->getMessage();
          }
        }
        else
        {
          echo "L'issu de ce pari a déjà été donnée et ne peut plus être modifiée";
        }
      }
      else
      {
        echo "Vous n'êtes pas le créateur de ce pari et n'êtes pas en mesure de le modifier";
      }
    }
  }

}
