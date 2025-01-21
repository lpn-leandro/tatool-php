SET foreign_key_checks = 0;

DROP TABLE IF EXISTS users;
CREATE TABLE users
(
  id         INT AUTO_INCREMENT PRIMARY KEY,
  name       VARCHAR(255)        NOT NULL,
  email      VARCHAR(100) UNIQUE NOT NULL,
  encrypted_password   VARCHAR(255)        NOT NULL,
  user_type  ENUM ('T', 'U')     NOT NULL COMMENT 'T = Tattooist, U = User',
  bio        TEXT,
  rate_id    INT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


DROP TABLE IF EXISTS works;
CREATE TABLE works
(
  id           INT AUTO_INCREMENT PRIMARY KEY,
  image_url    VARCHAR(255),
  description  TEXT,
  created_at   TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  tattooists_id INT NOT NULL REFERENCES users (id) ON DELETE RESTRICT
);

DROP TABLE IF EXISTS ratings;
CREATE TABLE ratings
(
  id           INT AUTO_INCREMENT PRIMARY KEY,
  rating       INT,
  comment      TEXT,
  CREATED_AT   TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  users_id     INT NOT NULL REFERENCES users (id) ON DELETE RESTRICT,
  tattooists_id INT NOT NULL REFERENCES users (id) ON DELETE RESTRICT
);

DROP TABLE IF EXISTS studios;
CREATE TABLE studios
(
  id         INT AUTO_INCREMENT PRIMARY KEY,
  name       VARCHAR(255) NOT NULL,
  address    VARCHAR(255) NOT NULL,
  CREATED_AT TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS studio_tattooists;
CREATE TABLE studio_tattooists
(
  PRIMARY KEY (studios_id, tattooists_id),
  studios_id   INT NOT NULL REFERENCES studios (id) ON DELETE RESTRICT,
  tattooists_id INT NOT NULL REFERENCES users (id) ON DELETE RESTRICT
);

DROP TABLE IF EXISTS appointments;
CREATE TABLE appointments
(
  id           INT AUTO_INCREMENT PRIMARY KEY,
  date         DATETIME,
  size         VARCHAR(50),
  location     VARCHAR(255),
  status       enum ('pendente', 'confirmado', 'cancelado', 'completado') DEFAULT 'pendente',
  users_id     INT NOT NULL REFERENCES users (id) ON DELETE RESTRICT,
  tattooists_id INT NOT NULL REFERENCES users (id) ON DELETE RESTRICT
);

DROP TABLE IF EXISTS works_users;
CREATE TABLE works_users
(
  works_id INT NOT NULL REFERENCES works (id) ON DELETE RESTRICT,
  users_id  INT NOT NULL REFERENCES users (id) ON DELETE RESTRICT
);

SET foreign_key_checks = 1;
