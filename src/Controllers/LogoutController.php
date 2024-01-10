<?php

namespace MovieMatch\Controllers;

use MovieMatch\Models\Auth;

class LogoutController
{
  public function request(): void
  {
    $auth = new Auth();
    $auth->logout();
  }
}
