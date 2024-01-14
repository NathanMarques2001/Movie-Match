<nav class="navbar navbar-expand-lg" style="background-color: #378ca1;">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="http://moviematch.com/assets/logo.png" alt="Logo" height="50" width="auto">
    </a>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="link-light" aria-current="page" href="http://moviematch.com/home?page=<?= $_SESSION['currentPage'] ?>">Início</a>
        </li>
        <li class="nav-item">
          <a class="link-light" href="http://moviematch.com/list">Lista</a>
        </li>
        <li class="nav-item">
          <a class="link-light" href="http://moviematch.com/assessments">Avaliações</a>
        </li>
      </ul>
      <form class="d-flex" method="POST">
        <button class="btn btn-light" type="submit" name="Logout">Sair</button>
      </form>
    </div>
</nav>