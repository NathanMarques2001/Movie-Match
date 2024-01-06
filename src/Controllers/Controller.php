<?php

namespace MovieMatch\Controllers;

abstract class Controller
{
  protected function view($view, $data = [])
  {
    extract($data);
    include __DIR__ . "/../../templates/views/{$view}.php";
  }

  abstract public function index();
}
