<?php

namespace MovieMatch\Models;

use PHPUnit\Framework\TestCase;

class NLPProcessorTest extends TestCase
{
  public function testCalculateSimilarity(): void
  {
    $processor = new NLPProcessor();

    $filmDbOverview = "This is a movie overview with some keywords like director, actors, and plot.";

    $currentFilm = new Film("Title", "This is a movie overview with some keywords like director, actors, and plot.", "2023-01-01", ["Action"], "image.jpg", 8.0, [], "background.jpg", "Tagline", 1);

    $expectedSimilarity = 100.0;
    $similarity = $processor->calculateSimilarity($filmDbOverview, $currentFilm);

    $roundedSimilarity = round($similarity, 2);

    $this->assertEquals($expectedSimilarity, $roundedSimilarity);

    $currentFilm2 = new Film("Title", "This is a different movie overview.", "2023-01-01", ["Action"], "image.jpg", 8.0, [], "background.jpg", "Tagline", 1);

    $expectedSimilarity2 = 38.73;
    $similarity2 = $processor->calculateSimilarity($filmDbOverview, $currentFilm2);

    $roundedSimilarity2 = round($similarity2, 2);

    $this->assertEquals($expectedSimilarity2, $roundedSimilarity2);
  }
}
