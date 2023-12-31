<?php

namespace MovieMatch\Models;

class User
{
    private string $name;
    private array $grades;
    private array $rateds;

    public function __construct(string $name, array $grades, array $rateds)
    {
        $this->name = $name;
        $this->grades = $grades;
        $this->rateds = $rateds;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getGrades(): array
    {
        return $this->grades;
    }

    public function getGrade(int $id): int
    {
        return $this->grades[$id];
    }

    public function getRateds(): array
    {
        return $this->rateds;
    }
}
