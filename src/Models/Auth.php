<?php

namespace MovieMatch\Models;

class Auth
{
  public static function isLoggedIn()
  {
    $session = new Session();

    return $session->get('id') != null;
  }

  public static function logout()
  {
    $session = new Session();
    $session->start();

    session_unset();
    session_destroy();

    header("Location: /");
    exit();
  }
}
