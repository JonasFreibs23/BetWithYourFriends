<?php

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
      $req = "SELECT id FROM users WHERE name = ? and password = ?";
      $statement = $dbh->prepare($req);
      $statement->bindParam(1, $_POST["username"]);
      $statement->bindParam(2, $hashedPassword);
      $statement->execute();

      // TODO CHECK user and password ok

      exit(0);
    }
  }

  public function logout(){
    // TODO
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

      // TODO : vérifier bonne valeur passé à la db, check parameters
      $req = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
      $statement = $dbh->prepare($req);
      $statement->bindParam(1, $_POST["username"]);
      $statement->bindParam(2, $_POST["email"]);
      $statement->bindParam(3, $hashedPassword);
      $statement->execute();

      // TODO CHECK EXECUTION OK

      exit(0);
    }
  }

}
