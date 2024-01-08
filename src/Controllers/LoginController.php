<?php

namespace MovieMatch\Controllers;

use MovieMatch\Models\GenreDatabase;
use MovieMatch\Models\Session;
use MovieMatch\Models\UserDatabase;

class LoginController extends Controller
{
  private UserDatabase $userDatabase;
  private GenreDatabase $genreDatabase;
  private Session $session;

  public function __construct(UserDatabase $userDatabase, GenreDatabase $genreDatabase, Session $session)
  {
    $this->userDatabase = $userDatabase;
    $this->genreDatabase = $genreDatabase;
    $this->session = $session;
  }

  public function render()
  {
    return $this->view("login");
  }

  public function request()
  {
    try {
      $email = $_POST['email'] ?? '';
      $password = $_POST['password'] ?? '';

      $login = $this->userDatabase->findUser($email, $password);

      if ($login !== false) {

        $this->session->start();
        $this->session->set('id', $login['id']);
        $this->session->set('name', $login['name']);
        $this->session->set('currentPage', 1);

        if ($this->session->get('genre_assessment') == null) {
          $this->session->set('genre_assessment', $this->genreDatabase->checkGenreAssessment($login['id']));
        }

        header('Location: /home');
        exit();
      }
    } catch (\Exception $e) {
      echo $e->getMessage();
    }
    exit();
  }
}
