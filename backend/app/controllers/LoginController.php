<?php

require "app/models/Users.php";

class LoginController{

  public function login(){
    // TODO : remove when not in dev
    // Allow from any origin
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

      $hashedPassword = password_hash($_POST["password"], PASSWORD_DEFAULT);

      $dbh = App::get('dbh');

      // TODO : vérifier bonne valeur passé à la db, check parameters
      try{
        $req = "SELECT * FROM users WHERE name = ?";
        $statement = $dbh->prepare($req);
        $statement->bindParam(1, $_POST["username"]);
        $statement->execute();

        $users = $statement->fetchAll(PDO::FETCH_CLASS, "Users");
        $loginSuccess = false;

        if(count($users) > 0)
        {
          $user = $users[0];
          if(password_verify($_POST["password"], $user->getPassword()))
          {
            $loginSuccess = true;
            $_SESSION['userId'] = $user->getId();
          }
        }

        echo $loginSuccess;
      }
      catch(PDOException $err)
      {
        echo $err->getMessage();
      }
    }
  }

  public function logout(){
    $isLoggedOut = false;
    if($_SESSION['userId'] !== -1)
		{
      session_destroy();
      $isLoggedOut = true;
    }
    // TODO : remove when not in dev
    header("Access-Control-Allow-Origin: *");
    echo $isLoggedOut;
  }

  public function createAccount(){
    // TODO : remove when not in dev
    // Allow from any origin
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

      $hashedPassword = password_hash($_POST["password"], PASSWORD_DEFAULT);

      $dbh = App::get('dbh');
      try
      {
        // TODO : vérifier bonne valeur passé à la db, check parameters
        $req = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
        $statement = $dbh->prepare($req);
        $statement->bindParam(1, $_POST["username"]);
        $statement->bindParam(2, $_POST["email"]);
        $statement->bindParam(3, $hashedPassword);

        $creationSucces = false;

        if($statement->execute())
          $creationSucces = true;

        echo $creationSucces;
      }
      catch(PDOException $err)
      {
        echo $err->getMessage();
      }
    }
  }

}
