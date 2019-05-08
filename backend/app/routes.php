<?php

$router->define([
  'getBets' => 'BetController@getBets',
  'getTrendingBets' => 'BetController@getTrendingBets',
  'createBet' => 'BetController@createBet',
  'applyToBet' => 'BetController@applyToBet',
  'getUsersBets' => 'BetController@getUsersBets',
  'getBetById' => 'BetController@getBetById',
  'editBet' => 'BetController@editBet',
  'login' => 'LoginController@login',
  'logout' => 'LoginController@logout',
  'createAccount' => 'LoginController@createAccount',
  'getUserBalance' => 'BankController@getUserBalance',
  'getUserTrades' => 'BankController@getUserTrades'
]);
