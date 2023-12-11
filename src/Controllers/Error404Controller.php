<?php

namespace MovieMatch\Controllers;

class Error404Controller
{
  public function processRequest(): void
  {
    http_response_code(404);
  }
}
