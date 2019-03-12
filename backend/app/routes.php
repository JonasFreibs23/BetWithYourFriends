<?php

$router->define([
  'getBets' => 'BetController@getBets',
  'createBet' => 'BetController@createBet',
  'applyToBet' => 'BetController@applyToBet',
  'getUsersBets' => 'BetController@getUsersBets',
  'getBetById' => 'BetController@getBetById',
  'editBet' => 'BetController@editBet',
  'login' => 'LoginController@login',
  'logout' => 'LoginController@logout',
  'createAccount' => 'LoginController@createAccount'
]);
