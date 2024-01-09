<?php

namespace MovieMatch\Controllers;

use MovieMatch\Models\Session;

class LogoutController
{
  private Session $session;

  public function __construct(Session $session)
  {
    $this->session = $session;
  }

  public function request(): void
  {
    $this->session->logout();
  }
}
