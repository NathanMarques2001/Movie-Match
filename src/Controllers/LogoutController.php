<?php

namespace MovieMatch\Controllers;

use MovieMatch\Models\Session;

class LogoutController
{
  public function request(): void
  {
    $session = new Session();
    $session->logout();
  }
}
