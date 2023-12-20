<?php

namespace MovieMatch\Models;

class User
{
    private string $name;
    private array $grades;
    private array $likes;
    private array $dislikes;

    public function __construct(string $name, array $grades)
    {
        $this->name = $name;
        $this->grades = $grades;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getGrades(): array
    {
        return $this->grades;
    }
}
