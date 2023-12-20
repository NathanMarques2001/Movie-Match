<?php

function translateGenres($englishGenre)
{
  $translations = array(
    "Action" => "Ação",
    "Adventure" => "Aventura",
    "Animation" => "Animação",
    "Comedy" => "Comédia",
    "Crime" => "Crime",
    "Documentary" => "Documentário",
    "Drama" => "Drama",
    "Family" => "Família",
    "Fantasy" => "Fantasia",
    "History" => "História",
    "Horror" => "Terror",
    "Music" => "Música",
    "Mystery" => "Mistério",
    "Romance" => "Romance",
    "Science Fiction" => "Ficção Científica",
    "TV Movie" => "Filme para TV",
    "Thriller" => "Suspense",
    "War" => "Guerra",
    "Western" => "Faroeste"
  );

  if (array_key_exists($englishGenre, $translations)) {
    return $translations[$englishGenre];
  } else {
    return $englishGenre;
  }
}
