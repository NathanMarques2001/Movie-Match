<?php

namespace MovieMatch\Models;

class Movie
{
    private string $title;
    private string $overview;
    private string $year;
    private array $genres;
    private string $imagePath;
    private array $streamings;

    public function __construct(string $title, string $overview, string $year, array $genres, string $imagePath, array $streamings)
    {
        $this->title = $title;
        $this->overview = $overview;
        $this->year = $year;
        $this->genres = $genres;
        $this->imagePath = $imagePath;
        $this->streamings = $streamings;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getOverview(): string
    {
        return $this->overview;
    }

    public function setOverview(string $overview): void
    {
        $this->overview = $overview;
    }

    public function getYear(): string
    {
        return $this->year;
    }

    public function setYear(string $year): void
    {
        $this->year = $year;
    }

    public function getGenres(): array
    {
        return $this->genres;
    }

    public function setGenres(array $genres): void
    {
        $this->genres = $genres;
    }

    public function getImagePath(): string
    {
        return $this->imagePath;
    }

    public function setImagePath(string $imagePath): void
    {
        $this->imagePath = $imagePath;
    }

    public function getStreamings(): array
    {
        return $this->streamings;
    }

    public function setStreamings(array $streamings): void
    {
        $this->streamings = $streamings;
    }
}
