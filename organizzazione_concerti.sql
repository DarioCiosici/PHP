-- creazione database
CREATE DATABASE organizzazione_concerti;

-- usa database
USE organizzazione_concerti;

-- creazione tabella concerti
CREATE TABLE concerti (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codice VARCHAR(255),
    titolo VARCHAR(255),
    descrizione VARCHAR(255),
    dataConcerto VARCHAR(255)
);
CREATE TABLE pezzi(
    id INT AUTO_INCREMENT PRIMARY KEY,
    codice INT;
    titolo varchar(255)
);
CREATE TABLE concerto_pezzi(
    id_concerto INT,
    id_pezzo INT
);
ALTER TABLE concerto_pezzi
ADD FOREIGN KEY (id_concerto) REFERENCES concerti(id),
ADD FOREIGN KEY (id_pezzo) REFERENCES pezzi(id);
-- creazione user
CREATE USER 'utente'@'localhost' IDENTIFIED BY 'viola';

-- assegnazione privileggi al user
GRANT ALL PRIVILEGES ON *.* TO 'utente'@'localhost' WITH GRANT OPTION;