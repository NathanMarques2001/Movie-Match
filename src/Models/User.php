<?php

namespace MovieMatch\Models;

class User
{
    private string $name;
    private array $grades;
    private array $likes;
    private array $dislikes;

    public function __construct()
    {
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
