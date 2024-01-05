<?php

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
    }
  }

  public function get(string $key)
  {
    $this->start();
    if (isset($_SESSION[$key])) {
      $_SESSION[$key];
    }
  }

  public function set(string $key, $value)
  {
    $this->start();
    $_SESSION[$key] = $value;
  }
}
