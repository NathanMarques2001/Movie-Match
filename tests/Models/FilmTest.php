<?php

namespace MovieMatch\Models;

use PHPUnit\Framework\TestCase;

class FilmTest extends TestCase
{
  public function testGettersReturnCorrectValues()
  {
    $genres = ["Action", "Adventure"];
    $streamings = ["Netflix", "Amazon Prime"];

    $film = new Film(
      "Title",
      "Overview",
      "2023-03-15",
      $genres,
      "image.jpg",
      8.5,
      $streamings,
      "background.jpg",
      "Tagline",
      1
    );

    $this->assertEquals("Title", $film->getTitle());
    $this->assertEquals("Overview", $film->getOverview());
    $this->assertEquals($genres, $film->getGenres());
    $this->assertEquals("image.jpg", $film->getImagePath());
    $this->assertEquals("background.jpg", $film->getBackgroundPath());
    $this->assertEquals("Tagline", $film->getTagline());
    $this->assertEquals(1, $film->getID());
    $this->assertEquals($streamings, $film->getStreamings());
  }

  public function testRatingPercentage()
  {
    // Teste com classificação 8.5 deve retornar 85
    $film = new Film("Title", "Overview", "2023-03-15", [], "image.jpg", 8.5, [], "background.jpg", "Tagline", 1);
    $this->assertEquals(85, $film->ratingPercentage());

    // Teste com classificação 10.0 deve retornar 100
    $film = new Film("Title", "Overview", "2023-03-15", [], "image.jpg", 10.0, [], "background.jpg", "Tagline", 1);
    $this->assertEquals(100, $film->ratingPercentage());
  }

  public function testFormatDate()
  {
    $film = new Film("Title", "Overview", "2023-03-15", [], "image.jpg", 8.5, [], "background.jpg", "Tagline", 1);
    $this->assertEquals("15/03/2023", $film->formatDate());
  }

  public function testSetUserGrade()
  {
    $film = new Film("Title", "Overview", "2023-03-15", [], "image.jpg", 8.5, [], "background.jpg", "Tagline", 1);

    // Definir uma nota para o filme
    $film->setUserGrade(7.5);

    // Verificar se a nota foi definida corretamente
    $this->assertEquals(7.5, $film->getUserGrade());
  }

  public function testGetGradeWithPercentage()
  {
    $film = new Film("Title", "Overview", "2023-03-15", ["Action", "Adventure", "Comedy"], "image.jpg", 8.5, [], "background.jpg", "Tagline", 1);

    $percentage = $film->getGradeWithPercentage(3, 7);

    $this->assertEquals(23.333333333333332, $percentage);
  }
}
