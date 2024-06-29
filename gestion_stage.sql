CREATE DATABASE IF NOT EXISTS gestion_Stage;
USE gestion_Stage;

CREATE TABLE Departement (
    idDepartement VARCHAR(30) PRIMARY KEY,
    nom VARCHAR(30)
) ENGINE=InnoDB;

CREATE TABLE Entreprise (
    idEntreprise VARCHAR(30) PRIMARY KEY,
    description VARCHAR(30),
    nom VARCHAR(30),
    adresse VARCHAR(30),
    email VARCHAR(30),
    telephone VARCHAR(30),
    domaineActivite VARCHAR(30)
) ENGINE=InnoDB;

CREATE TABLE ResponsableDeStage (
    idResponsable VARCHAR(30) PRIMARY KEY,
    nom VARCHAR(30),
    prenom VARCHAR(30),
    email VARCHAR(30),
    telephone VARCHAR(30),
    passwd VARCHAR(30),
    titre VARCHAR(30)
) ENGINE=InnoDB;

CREATE TABLE Stage (
    idStage VARCHAR(30) PRIMARY KEY,
    description VARCHAR(30),
    competenceRequise VARCHAR(30),
    avantage VARCHAR(30),
    sujet VARCHAR(30),
    dateDebut DATE,
    duree VARCHAR(30),
    idResponsable VARCHAR(30) NOT NULL,
    FOREIGN KEY (idResponsable) REFERENCES ResponsableDeStage (idResponsable)
) ENGINE=InnoDB;

CREATE TABLE Etudiant (
    idEtudiant VARCHAR(30) PRIMARY KEY,
    nom VARCHAR(30),
    prenom VARCHAR(30),
    email VARCHAR(30),
    telephone VARCHAR(30),
    password VARCHAR(30),
    statut VARCHAR(30),
    niveau VARCHAR(30),
    idDepartement VARCHAR(30) NOT NULL,
    FOREIGN KEY (idDepartement) REFERENCES Departement (idDepartement)
) ENGINE=InnoDB;

CREATE TABLE MaitreDeStage (
    idMaitreStage VARCHAR(30) PRIMARY KEY,
    nom VARCHAR(30),
    prenom VARCHAR(30),
    email VARCHAR(30),
    telephone VARCHAR(30),
    password VARCHAR(30),
    poste VARCHAR(30),
    idEntreprise VARCHAR(30) NOT NULL,
    FOREIGN KEY (idEntreprise) REFERENCES Entreprise (idEntreprise)
) ENGINE=InnoDB;

CREATE TABLE Demande (
    statut VARCHAR(30),
    Date_demande DATE,
    idStage VARCHAR(30),
    idEtudiant VARCHAR(50),
    idDemande VARCHAR(50),
    PRIMARY KEY (idStage, idEtudiant),
    UNIQUE (idDemande),
    FOREIGN KEY (idEtudiant) REFERENCES Etudiant (idEtudiant),
    FOREIGN KEY (idStage) REFERENCES Stage (idStage)
) ENGINE=InnoDB;

CREATE TABLE Note (
    appreciation VARCHAR(30),
    note FLOAT,
    Date_note DATE,
    idStage VARCHAR(30),
    idEtudiant VARCHAR(30),
    idMaitreStage VARCHAR(30),
    idNote VARCHAR(30),
    PRIMARY KEY (idStage, idEtudiant, idMaitreStage),
    UNIQUE (idNote),
    FOREIGN KEY (idStage) REFERENCES Stage (idStage),
    FOREIGN KEY (idEtudiant) REFERENCES Etudiant (idEtudiant),
    FOREIGN KEY (idMaitreStage) REFERENCES MaitreDeStage (idMaitreStage)
) ENGINE=InnoDB;

CREATE TABLE renseigner (
    idStage VARCHAR(30),
    idEtudiant VARCHAR(30),
    PRIMARY KEY (idStage, idEtudiant),
    FOREIGN KEY (idStage) REFERENCES Stage (idStage),
    FOREIGN KEY (idEtudiant) REFERENCES Etudiant (idEtudiant)
) ENGINE=InnoDB;

-- Insert sample data
INSERT INTO Etudiant (idEtudiant, nom, prenom, email, telephone, password, statut, niveau, idDepartement) 
VALUES 
('1', 'Sagne', 'Aicha', 'aicha@esp.sn', '77', 'passer', 'etudiant1', 'licence', '1'),
('2', 'Balde', 'Adama', 'adama@esp.sn', '77', 'passer', 'etudiant2', 'licence', '2'),
('3', 'Diagne', 'Yacine', 'yacine@esp.sn', '77', 'passer', 'etudiant3', 'licence', '3'),
('4', 'Sidibe', 'Mane', 'mane@esp.sn', '77', 'passer', 'etudiant4', 'licence', '4');

INSERT INTO Departement (idDepartement, nom) 
VALUES 
('1', 'informatique'),
('2', 'informatique'),
('3', 'informatique'),
('4', 'informatique');

INSERT INTO ResponsableDeStage (idResponsable, nom, prenom, email, telephone, passwd, titre) 
VALUES 
('1', 'Ngom', 'Fatou', 'fatou@esp.sn', '77', 'passer','responsable' ),
('2', 'Fall', 'Ibrahima', 'ibrahima@esp.sn', '77', 'passer', 'responsable'),
('3', 'ba', 'Mandicou', 'mandicou@esp.sn', '77', 'passer', 'responsable');

INSERT INTO Entreprise (idEntreprise, description, nom, adresse, email, telephone, domaineActivite) 
VALUES 
('1', 'Principal fournisseur de services de télécommunications', 'SONATEL', 'Dakar', 'email@sonatel.sn', '33', 'Télécommunications'),
('2', 'Institution financière', 'SGBS', 'Dakar', 'email@sgbs.sn', '33', 'Banque'),
('3', 'Producteur de sucre', 'CSS', 'Saint-Louis', 'email@css.sn', '33', 'Agroalimentaire');

INSERT INTO MaitreDeStage (idMaitreStage, nom, prenom, email, telephone, password, poste, idEntreprise) 
VALUES 
('1', 'Mbaye', 'Moustapha', 'moustapha@esp.sn', '77', 'passer','maitre','1'),
('2', 'Fall', 'Babacar', 'babacar@esp.sn', '77', 'passer', 'maitre','2'),
('3', 'Diop', 'Mouhamed', 'mouhamed@esp.sn', '77', 'passer', 'maitre','3');

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    passwd VARCHAR(255) NOT NULL,
    role ENUM('responsable', 'maitre', 'etudiant') 
);

INSERT INTO users (username, passwd, role) VALUES
('aichasagne@esp.sn', 'passer123', 'etudiant'),
('fatoungom@esp.sn', 'passer123', 'maitre'),
('mouhameddiop@esp.sn', 'passer123', 'responsable'),
('adamabalde@esp.sn', 'passer123', 'etudiant'),
('maitre1', 'passer123', 'maitre'),
('responsable1', 'passer123', 'responsable');
