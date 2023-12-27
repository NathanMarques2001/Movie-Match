-- Criação do banco de dados
CREATE SCHEMA IF NOT EXISTS `movie_match`;

-- Tabela 'users'
CREATE TABLE IF NOT EXISTS `movie_match`.users ( 
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL
) engine=InnoDB;

-- Tabela 'genres'
CREATE TABLE IF NOT EXISTS `movie_match`.genres ( 
    id INT NOT NULL PRIMARY KEY,
    name VARCHAR(20)
) engine=InnoDB;

-- Tabela 'genre_assessment'
CREATE TABLE IF NOT EXISTS `movie_match`.genre_assessment ( 
    id_user INT NOT NULL,
    id_genre INT NOT NULL,
    grade INT NOT NULL,
    CONSTRAINT pk_genre_assessment PRIMARY KEY (id_user, id_genre),
    CONSTRAINT fk_genre_assessment_users FOREIGN KEY (id_user) REFERENCES `movie_match`.users (id) ON DELETE NO ACTION ON UPDATE NO ACTION,
    CONSTRAINT fk_genre_assessment_genres FOREIGN KEY (id_genre) REFERENCES `movie_match`.genres (id) ON DELETE NO ACTION ON UPDATE NO ACTION
) engine=InnoDB;

-- Tabela 'rated_films'
CREATE TABLE IF NOT EXISTS `movie_match`.rated_films ( 
    id_user INT NOT NULL,
    id_film INT NOT NULL,
    overview VARCHAR(255) NOT NULL,
    rated INT NOT NULL,
    CONSTRAINT fk_rated_films_users FOREIGN KEY (id_user) REFERENCES `movie_match`.users (id) ON DELETE NO ACTION ON UPDATE NO ACTION
) engine=InnoDB;

-- Populando tabelas com dados padrões
INSERT IGNORE INTO genres (id, name)
VALUES
  (28, 'Action'),
  (12, 'Adventure'),
  (16, 'Animation'),
  (35, 'Comedy'),
  (80, 'Crime'),
  (99, 'Documentary'),
  (18, 'Drama'),
  (10751, 'Family'),
  (14, 'Fantasy'),
  (36, 'History'),
  (27, 'Horror'),
  (10402, 'Music'),
  (9648, 'Mystery'),
  (10749, 'Romance'),
  (878, 'Science-Fiction'),
  (10770, 'TV-Movie'),
  (53, 'Thriller'),
  (10752, 'War'),
  (37, 'Western');
