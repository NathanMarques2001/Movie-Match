<?php

namespace MovieMatch\Models;

use Phpml\Tokenization\WhitespaceTokenizer;

class NLPProcessor
{
  private array $connectives;
  private WhitespaceTokenizer $tokenizer;
  public function __construct()
  {
    $this->tokenizer = new WhitespaceTokenizer();
    $this->connectives = [
      'a', 'as', 'o', 'os', 'e', 'ou', 'mas', 'porém', 'contudo', 'todavia', 'pois', 'porque', 'porquanto', 'logo', 'portanto', 'assim', 'se', 'caso', 'embora', 'conquanto', 'quando', 'enquanto', 'como', 'que', 'além', 'entretanto', 'senão', 'outra', 'isto', 'isso', 'por', 'em', 'quer', 'de', 'saber', 'é', 'dizer', 'filme', 'história', 'personagem', 'diretor', 'atores', 'cinema', 'cena', 'trama', 'enredo', 'produção', 'lançamento', 'gênero', 'roteiro', 'crítica', 'recomendação', 'avaliação', 'público', 'espectadores', 'bilheteria', 'sucesso', 'fracasso', 'trailer', 'roteirista', 'lançado', 'prêmios'
    ];
  }

  public function calculateSimilarity(string $filmDbOverview, Film $currentFilm)
  {
    $freq1 = $this->calculateFrequency($filmDbOverview);
    $freq2 = $this->calculateFrequency($currentFilm->getOverview());
    $similarity = $this->cosineSimilarity($freq1, $freq2);

    return $similarity * 100;
  }

  // Extrai cada palavra e conta sua frequência em cada texto
  private function calculateFrequency(string $text)
  {
    $tokens = $this->tokenizer->tokenize(strtolower($text));
    // Remove conectivos
    $filteredTokens = array_diff($tokens, $this->connectives);

    return array_count_values($filteredTokens);
  }

  // Função para calcular a similaridade dos cossenos
  private function cosineSimilarity($frequency1, $frequency2)
  {
    // Calcula o produto escalar das palavras em comum
    $product = 0;
    foreach ($frequency1 as $word => $quantity1) {
      if (isset($frequency2[$word])) {
        $quantity2 = $frequency2[$word];
        $product += $quantity1 * $quantity2;
      }
    }

    // Calcula as normas euclidianas do vetor 1
    $sumOfSquares1 = 0;
    foreach ($frequency1 as $quantity) {
      $sumOfSquares1 += $quantity ** 2;
    }
    $euclideanNorm1 = sqrt($sumOfSquares1);

    // Calcula as normas euclidianas do vetor 2
    $sumOfSquares2 = 0;
    foreach ($frequency2 as $quantity) {
      $sumOfSquares2 += $quantity ** 2;
    }
    $euclideanNorm2 = sqrt($sumOfSquares2);

    // Verificar se a magnitude é zero para evitar divisão por zero
    if ($euclideanNorm1 == 0 || $euclideanNorm2 == 0) {
      return 0;
    }

    // Calcular e retornar a similaridade de cosseno
    return $product / ($euclideanNorm1 * $euclideanNorm2);
  }
}
