<?php

namespace MovieMatch\Models;

class Film
{
    private string $title;
    private string $overview;
    private string $date;
    private array $genres;
    private string $imagePath;
    private float $rate;
    private array $streamings;
    private string $backgroundPath;
    private string $tagline;
    private int $id;
    private float $userGrade;

    public function __construct(string $title, string $overview, string $date, array $genres, string $imagePath, float $rate, array $streamings, string $backgroundPath, string $tagline, int $id)
    {
        $this->title = $title;
        $this->overview = $overview;
        $this->date = $date;
        $this->genres = $genres;
        $this->rate = $rate;
        $this->imagePath = $imagePath;
        $this->streamings = $streamings;
        $this->backgroundPath = $backgroundPath;
        $this->tagline = $tagline;
        $this->id = $id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getOverview(): string
    {
        return $this->overview;
    }

    public function getImagePath(): string
    {
        return $this->imagePath;
    }

    public function getBackgroundPath(): string
    {
        return $this->backgroundPath;
    }

    public function getTagline(): string
    {
        return $this->tagline;
    }

    public function getID(): int
    {
        return $this->id;
    }

    public function getStreamings(): array
    {
        return $this->streamings;
    }

    public function getDay(): string
    {
        return substr($this->date, 8);
    }

    public function getMonth(): string
    {
        return substr($this->date, 5, 2);
    }

    public function getYear(): string
    {
        return substr($this->date, 0, 4);
    }

    public function getGenres(): array
    {
        return $this->genres;
    }

    public function extractGenres(): string
    {
        $genreNames = array_map(function ($genre) {
            return $genre->name;
        }, $this->genres);

        return implode(', ', $genreNames);
    }

    public function ratingPercentage(): int
    {
        return round($this->rate * 10);
    }

    public function formatDate(): string
    {
        return $this->getDay() . "/" . $this->getMonth() . "/" . $this->getYear();
    }

    public function getUserGrade(): float
    {
        return $this->userGrade;
    }

    public function setUserGrade(float $userGrade): void
    {
        $this->userGrade = $userGrade;
    }

    public function getGradeWithPercentage(int $genres, int $grade): float
    {
        return ($grade * 100) / ($genres * 10);
    }
}
