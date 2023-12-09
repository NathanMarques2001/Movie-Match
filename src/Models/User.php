<?php

namespace MovieMatch\Models;

class User
{
    private string $name;
    private array $grades;
    private array $likes;
    private array $dislikes;

    public function __construct(string $name, array $grades, array $likes, array $dislikes)
    {
        $this->name = $name;
        $this->grades = $grades;
        $this->likes = $likes;
        $this->dislikes = $dislikes;
    }

    public function getName(): string
    {
        return $this->name;
    }
}