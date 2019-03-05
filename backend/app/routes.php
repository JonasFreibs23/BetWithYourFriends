<?php

$router->define([
  'getBets' => 'BetController@getBets',
  'createBet' => 'BetController@createBet',
  'applyToBet' => 'BetController@applyToBet',
  'getUsersBets' => 'BetController@getUsersBets',
  'getBetById' => 'BetController@getBetById',
  'login' => 'LoginController@login',
  'logout' => 'LoginController@logout',
  'createAccount' => 'LoginController@createAccount'
]);
