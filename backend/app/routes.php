<?php

$router->define([
  '' => 'IndexController',
  '/' => 'IndexController',
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
  'getUserTradesToBeAccepted' => 'BankController@getUserTradesToBeAccepted',
  'getUserTradesToBePaid' => 'BankController@getUserTradesToBePaid',
  'createTrade' => 'BankController@createTrade',
  'fetchNameId' => 'BankController@fetchNameId',
  'applyToTrade' => 'BankController@applyToTrade',
  'getUserTradesFinished' => 'BankController@getUserTradesFinished'
]);
