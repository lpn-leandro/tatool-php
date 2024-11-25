DROP TABLE IF EXISTS users;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  email VARCHAR(100) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

DROP TABLE IF EXISTS tattooists;

CREATE TABLE tattooists (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  email VARCHAR(100) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  bio TEXT,
  rate_id INT
);

DROP TABLE IF EXISTS works;

CREATE TABLE works (
  id INT AUTO_INCREMENT PRIMARY KEY,
  image_url VARCHAR(255),
  description TEXT
);

DROP TABLE IF EXISTS rating;

CREATE TABLE rating (
  id INT AUTO_INCREMENT PRIMARY KEY,
  rating INT,
  comment TEXT
);

DROP TABLE IF EXISTS studios;

CREATE TABLE studios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  address VARCHAR(255) NOT NULL,
  tattooists_id INT,
);

DROP TABLE IF EXISTS appointments;

CREATE TABLE appointments (
  id INT AUTO_INCREMENT PRIMARY KEY,
  date DATETIME,
  size VARCHAR(50),
  image_url VARCHAR(255),
  location VARCHAR(255),
  status VARCHAR(50),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  user_id INT,
  tattooist_id INT
);

CREATE TABLE works_has_users_tattooists (
  works_id INT,
  users_id INT,
  tattooists_id INT
);