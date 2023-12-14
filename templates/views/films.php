<?php

use MovieMatch\Models\TMDBService;
// <?= $tmdb->getImage($film->backdrop_path); 
$tmdb = new TMDBService();
$result = $tmdb->getTopRated(1);
$films = $result->results;
?>

<?php foreach ($films as $film) : ?>
  <div class="card mb-3" style="max-width: 540px;">
    <div class="row g-0">
      <div class="col-md-4">
        <img src="" class="img-fluid rounded-start" alt="...">
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <h5 class="card-title"><?= $film->title ?></h5>
          <p class="card-text"><?= $film->overview ?></p>
          <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
        </div>
      </div>
    </div>
  </div>
<?php endforeach; ?>