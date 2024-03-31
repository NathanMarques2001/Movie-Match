<?php

namespace MovieMatch\Models;

class Session
{
  public function start()
  {
    if (!isset($_SESSION)) {
      session_start();
    }
  }

  public function destroy()
  {
    if (isset($_SESSION)) {
      session_destroy();
      $_SESSION = null;
    }
  }


  public function get(string $key)
  {
    $this->start();
    if (isset($_SESSION[$key])) {
      return $_SESSION[$key];
    }
    return null;
  }

  public function set(string $key, mixed $value)
  {
    $this->start();
    $_SESSION[$key] = $value;
  }
}
