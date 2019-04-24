<?php

// TODO : how to serve Vuejs frontend

require 'core/bootstrap.php';

$uri = Request::uri();

$router = Router::load('routes.php');

$router->direct($uri);
