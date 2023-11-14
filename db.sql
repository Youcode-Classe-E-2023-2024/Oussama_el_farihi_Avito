-- Create the database
CREATE DATABASE IF NOT EXISTS avito_database;
USE avito_database;

-- Create the Utilisateur table
CREATE TABLE Utilisateur (
    id INT PRIMARY KEY,
    nom VARCHAR(255),
    email VARCHAR(255),
    mot_de_passe VARCHAR(255)
);

-- Create the Annonce table
CREATE TABLE Annonce (
    id INT PRIMARY KEY,
    titre VARCHAR(255),
    description TEXT,
    prix FLOAT,
    date_poste DATE,
    utilisateur_id INT,
    FOREIGN KEY (utilisateur_id) REFERENCES Utilisateur(id)
);
