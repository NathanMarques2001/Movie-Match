<?php

namespace MovieMatch\Models;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class TMDBServiceTest extends TestCase
{
    private TMDBService $service;

    protected function setUp(): void
    {
        $this->service = new TMDBService();
    }

    public function testGetTopRatedRetornaArrayCom20Resultados()
    {
        $response = $this->service->getTopRated(1);
        self::assertCount(20, $response->results);
    }

    public function testGetMovieRetornaTituloCorreto()
    {
        $response = $this->service->getMovie(238);
        self::assertEquals("O Poderoso Chefão", $response->title);
    }

    public function testGetProvidersRetornaIDCorreto()
    {
        $response = $this->service->getProviders(238);
        self::assertEquals(238, $response->id);
    }

    public function testGetGenresRetornaArrayComQuantidadeCorretaDeGeneros()
    {
        $response = $this->service->getGenres();
        self::assertCount(19, $response->genres);
    }

    public function testGetImageRetornaURLDaImagemCorretamente()
    {
        $imagePath = "test_image.jpg";
        $expectedURL = "https://image.tmdb.org/t/p/w300/test_image.jpg";
        self::assertEquals($expectedURL, $this->service->getImage($imagePath));
    }

    public function testGetBackgroundRetornaURLDoBackgroundCorretamente()
    {
        $backgroundPath = "test_background.jpg";
        $expectedURL = "https://image.tmdb.org/t/p/w500/test_background.jpg";
        self::assertEquals($expectedURL, $this->service->getBackground($backgroundPath));
    }
}
