<?php

require "app/models/Bets.php";

class BetController
{
    public function getBets()
    {
        // TODO : Généricité
        $dbh = App::get('dbh');

        $req = "SELECT * FROM bets";
		$statement = $dbh->prepare($req);
		$statement->execute();

        // TODO : debate opt 1 vs opt 2
		/*$bets = $statement->fetchAll(PDO::FETCH_CLASS, "Bets");
        echo $bets;*/

		$bets = $statement->fetchAll(PDO::FETCH_ASSOC);
        // TODO : remove when not in dev
        header("Access-Control-Allow-Origin: *");
        echo json_encode($bets);
    }

}
