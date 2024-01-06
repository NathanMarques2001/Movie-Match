<?php

namespace MovieMatch\Controllers;

class Controller
{
  protected function view($view, $data = [])
  {
    extract($data);
    include __DIR__ . "/../../templates/views/{$view}.php";
  }
}
