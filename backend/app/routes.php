<?php

$router->define([
  // '' => 'controllers/index.php',  // by conventions all controllers are in 'controllers' folder
  'getBets' => 'BetController@getBets',
  'createBet' => 'BetController@createBet',
  'applyToBet' => 'BetController@applyToBet',
  'getUsersBets' => 'BetController@getUsersBets',
  'getBetById' => 'BetController@getBetById'
]);
