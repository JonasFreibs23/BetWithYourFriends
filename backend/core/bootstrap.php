<?php

// TODO include the configuration file

require 'core/Router.php';
require 'core/Request.php';
require 'core/App.php';
require 'core/database/Connection.php';
require "core/database/Model.php";
require "app/models/Bets.php";
require "app/models/Users.php";
require "app/models/UsersBets.php";
require "app/models/Banks.php";
require 'helpers/Helper.php';

App::load_config("config.php");

App::set('config', require 'config.php');

App::set('dbh', Connection::make(App::get('config')));

session_start();

if(!isset($_SESSION['flag']))
{
	$_SESSION['flag'] = true;
	$_SESSION['userId'] = -1;
}
