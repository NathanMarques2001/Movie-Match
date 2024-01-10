<?php

namespace MovieMatch\Controllers;

use MovieMatch\Models\Database;
use MovieMatch\Models\GenreDatabase;
use MovieMatch\Models\Redirect;
use MovieMatch\Models\Session;
use MovieMatch\Models\UserDatabase;

class LoginController extends Controller
{
  public function render()
  {
    $redirect = new Redirect();
    $redirect->redirectIfIsLoggedIn();

    return $this->view("login");
  }

  public function request()
  {
    $userDatabase = new UserDatabase(new Database());
    $genreDatabase = new GenreDatabase(new Database());
    $session = new Session();
    try {
      $email = $_POST['email'] ?? '';
      $password = $_POST['password'] ?? '';

      $login = $userDatabase->findUser($email, $password);

      if ($login !== false) {

        $session->start();
        $session->set('id', $login['id']);
        $session->set('name', $login['name']);
        $session->set('currentPage', 1);

        if ($session->get('genre_assessment') == null) {
          $session->set('genre_assessment', $genreDatabase->checkGenreAssessment($login['id']));
        }

        $genreDatabaseController = new GenreDatabaseController();

        if (!$genreDatabaseController->request()) {
          header('Location: /first-login');
          exit();
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
