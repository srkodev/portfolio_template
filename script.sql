--
-- 1) Création de l'utilisateur MySQL dédié
--
CREATE USER IF NOT EXISTS 'portfolio_jules'@'localhost' IDENTIFIED BY 'portfolio_jules';
GRANT ALL PRIVILEGES ON *.* TO 'portfolio_jules'@'localhost';
FLUSH PRIVILEGES;

--
-- 2) Création de la base de données
--
CREATE DATABASE IF NOT EXISTS portfolio_jules;
USE portfolio_jules;

--
-- 3) Accorder à l'utilisateur l'accès complet sur cette base
--
GRANT ALL PRIVILEGES ON portfolio_jules.* TO 'portfolio_jules'@'localhost';
FLUSH PRIVILEGES;

--
-- 4) Création des tables
--

-- Table: competences
CREATE TABLE competences (
    id INT(11) NOT NULL AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    icon VARCHAR(255),
    category VARCHAR(50) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);


-- Table: contents
CREATE TABLE contents (
    id INT(11) NOT NULL AUTO_INCREMENT,
    content_key VARCHAR(100) NOT NULL UNIQUE,
    content_text TEXT,
    content_image VARCHAR(255),
    PRIMARY KEY (id)
);

-- Table: project_galleries
CREATE TABLE project_gallery (
    id INT(11) NOT NULL AUTO_INCREMENT,
    project_id INT(11) NOT NULL,
    src VARCHAR(255) NOT NULL,
    alt VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    FOREIGN KEY (project_id) REFERENCES projects(id) ON DELETE CASCADE
);

-- Table: projects
CREATE TABLE projects (
    id INT(11) NOT NULL AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    subtitle VARCHAR(255),
    description TEXT,
    techno TEXT NOT NULL,
    presentation TEXT NOT NULL,
    image VARCHAR(255),
    link VARCHAR(255),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
);

-- Table: users
CREATE TABLE users (
    id INT(11) NOT NULL AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
);
