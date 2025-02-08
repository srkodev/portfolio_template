--
-- 1) Création de l'utilisateur MySQL dédié
--
CREATE USER IF NOT EXISTS 'portfolio_user'@'localhost' IDENTIFIED BY 'portfolio_user';
GRANT ALL PRIVILEGES ON *.* TO 'portfolio_user'@'localhost';
FLUSH PRIVILEGES;

--
-- 2) Création de la base de données
--
CREATE DATABASE IF NOT EXISTS portfolio_db;
USE portfolio_db;

--
-- 3) Accorder à l'utilisateur l'accès complet sur cette base
--
GRANT ALL PRIVILEGES ON portfolio_db.* TO 'portfolio_user'@'localhost';
FLUSH PRIVILEGES;

--
-- 4) Création des tables
--

-- TABLE 'users' : pour l'admin
DROP TABLE IF EXISTS users;
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL,
  password VARCHAR(255) NOT NULL
);

-- Insérer un utilisateur admin (username=admin, mdp=admin => haché via password_hash())
INSERT INTO users (username, password)
VALUES ('admin', '$2y$10$QCe8qUOAXhVDtj2zsif4xu5unL72y3GbKsJPT9aImn997jEQR9mOS');

-- TABLE 'contents' : pour stocker "À propos", "Compétences", etc.
DROP TABLE IF EXISTS contents;
CREATE TABLE contents (
  id INT AUTO_INCREMENT PRIMARY KEY,
  content_key VARCHAR(100) NOT NULL UNIQUE,
  content_text TEXT
);

-- Exemples de contenus initiaux
INSERT INTO contents (content_key, content_text)
VALUES 
  ('about_me', 'Bonjour, je suis Jules. Étudiant en MMI et passionné de développement web.'),
  ('competences', 'HTML/CSS, JavaScript, PHP, Tailwind, etc.');

-- TABLE 'projects' : pour les projets
DROP TABLE IF EXISTS projects;
CREATE TABLE projects (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  description TEXT,
  detail LONGTEXT,
  image VARCHAR(255),
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Exemples de projets
INSERT INTO projects (title, description, detail, image)
VALUES 
  ('Projet 1', 'Description rapide du projet 1', 'Détails plus complets...', 'uploads/projet1.jpg'),
  ('Projet 2', 'Description rapide du projet 2', 'Détails plus complets...', 'uploads/projet2.jpg');





