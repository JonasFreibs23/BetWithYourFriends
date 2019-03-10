<?php

class BaseController
{

  public function checkIsLogged()
  {
    if($_SESSION['userId'] === -1)
      exit(0);
  }

}
