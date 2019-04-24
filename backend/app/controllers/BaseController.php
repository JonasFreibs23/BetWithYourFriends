<?php

class BaseController
{

  /**
   * @ApiDescription(section="BaseController", description="Check if the user is logged")
   */
  public function checkIsLogged()
  {
    if($_SESSION['userId'] === -1)
      exit(0);
  }

}
