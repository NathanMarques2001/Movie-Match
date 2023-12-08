<?php

namespace Models;

use MovieMatch\Models\TMDBService;
use PHPUnit\Framework\TestCase;

class MovieTest extends TestCase
{
    private TMDBService $service;

    protected function setUp(): void
    {
        $this->service = new TMDBService();
    }

    public function testDevePegarArrayComTopRateds()
    {
        $response = $this->service->getTopRated(1);
        self::assertCount(20, $response->results);
    }

    public function testDeveEcontrarOFilmeCorreto()
    {
        $response = $this->service->getMovie(238);
        self::assertEquals("O Poderoso Chefão", $response->title);
    }

    public function testDeveEcontrarOFilmeCorretoNosProviders()
    {
        $response = $this->service->getProviders(238);
        self::assertEquals(238, $response->id);
    }

    public function testDeveEcontrarQuantidadeCorretaDeGeneros()
    {
        $response = $this->service->getGenres();
        self::assertCount(19, $response->genres);
    }
}