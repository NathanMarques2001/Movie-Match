<?php

require_once "../vendor/autoload.php";

use MovieMatch\Models\NLP;

$nlp = new NLP();
$fr1 = $nlp->calculateFrequency("Em um mundo pós-apocalíptico, um grupo de sobreviventes luta para encontrar um refúgio seguro enquanto enfrenta ameaças de criaturas mutantes. No caminho, descobrem segredos sombrios sobre a origem da catástrofe que destruiu a civilização.");
$fr2 = $nlp->calculateFrequency("Num futuro distópico, a sociedade enfrenta o colapso devido a uma pandemia mortal. Um pequeno grupo de pessoas tenta sobreviver, explorando cidades abandonadas em busca de recursos essenciais. Confrontos com outros sobreviventes e a busca por uma cura desencadeiam reviravoltas surpreendentes.");
$cosineSimilarity = $nlp->cosineSimilarity($fr1, $fr2);
echo "Similaridade do Cosseno: " . $cosineSimilarity . PHP_EOL;
