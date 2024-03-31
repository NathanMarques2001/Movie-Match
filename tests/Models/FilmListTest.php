<?php

namespace MovieMatch\Models;

use PHPUnit\Framework\TestCase;

class FilmListTest extends TestCase
{
  public function testAddAndGetList(): void
  {
    $filmList = new FilmList();

    $film1 = new Film("Title 1", "Overview 1", "2023-01-01", ["Action"], "image1.jpg", 8.0, [], "background1.jpg", "Tagline 1", 1);
    $film2 = new Film("Title 2", "Overview 2", "2023-01-02", ["Adventure"], "image2.jpg", 7.5, [], "background2.jpg", "Tagline 2", 2);

    $filmList->add($film1);
    $filmList->add($film2);

    $expectedList = [$film1, $film2];
    $this->assertEquals($expectedList, $filmList->getList());
  }

  public function testAddAll(): void
  {
    $filmList = new FilmList();

    $filmData1 = (object) [
      "title" => "Title 1",
      "overview" => "Overview 1",
      "release_date" => "2023-01-01",
      "genre_ids" => ["Action"],
      "backdrop_path" => "image1.jpg",
      "vote_average" => 8.0,
      "poster_path" => "background1.jpg",
      "id" => 1
    ];

    $filmData2 = (object) [
      "title" => "Title 2",
      "overview" => "Overview 2",
      "release_date" => "2023-01-02",
      "genre_ids" => ["Adventure"],
      "backdrop_path" => "image2.jpg",
      "vote_average" => 7.5,
      "poster_path" => "background2.jpg",
      "id" => 2
    ];

    $filmsData = [$filmData1, $filmData2];

    $filmList->addAll($filmsData);

    $expectedList = [
      new Film("Title 1", "Overview 1", "2023-01-01", ["Action"], "image1.jpg", 8.0, [], "background1.jpg", "", 1),
      new Film("Title 2", "Overview 2", "2023-01-02", ["Adventure"], "image2.jpg", 7.5, [], "background2.jpg", "", 2)
    ];

    $this->assertEquals($expectedList, $filmList->getList());
  }
}
