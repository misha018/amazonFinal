CREATE SCHEMA IF NOT EXISTS amazon;

USE amazon; 

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';


CREATE TABLE IF NOT EXISTS korisnikk  (
id int auto_increment primary key,
username varchar(20) not null unique,
password varchar(15) not null,
ime varchar(30) not null,
prezime varchar(30) not null
) ENGINE = INNODB;


CREATE TABLE IF NOT EXISTS roles (
id int primary key auto_increment,
ime varchar(30) not null unique
) ENGINE = INNODB;


CREATE TABLE IF NOT EXISTS korisnik_roles (
korisnik_id int,
role_id int,
FOREIGN KEY (korisnik_id) REFERENCES korisnikk(id) ON UPDATE CASCADE ON DELETE CASCADE,
FOREIGN KEY (role_id) REFERENCES roles(id) ON UPDATE CASCADE ON DELETE CASCADE,
PRIMARY KEY (korisnik_id, role_id)
) ENGINE = INNODB;


CREATE TABLE IF NOT EXISTS artikl (
id int primary key auto_increment,
cena int not null,
kolicina int not null,
ime varchar(30) not null,
opis_proizvoda text not null
) ENGINE = INNODB;



CREATE TABLE IF NOT EXISTS korisnik_logs (
id int primary key auto_increment,
action text not null,
artikl varchar(50) not null,
created datetime not null
) ENGINE = INNODB;


CREATE TABLE IF NOT EXISTS korisnik_has_logs (
log_id int,
korisnik_id int,
FOREIGN KEY (log_id) REFERENCES korisnik_logs(id) ON UPDATE CASCADE ON DELETE RESTRICT,
FOREIGN KEY (korisnik_id) REFERENCES korisnikk(id) ON UPDATE CASCADE ON DELETE RESTRICT,
PRIMARY KEY (log_id, korisnik_id)
) ENGINE = INNODB;

INSERT INTO roles (id, ime) VALUES (1, 'korisnik'), (2, 'menadzer'), (3, 'admin');
INSERT INTO korisnik_roles (korisnik_id, role_id) VALUES (1, 3);
INSERT INTO korisnikk (id, username, password, ime, prezime) VALUES (1, 'admin', 'admin', 'admin', 'admin'),
(2, 'menadzer', 'menadzer', 'menadzer', 'menadzer');
INSERT INTO artikl (id, cena, kolicina, ime, opis_proizvoda) VALUES (1, 140, 1, 'Airpods 2nd gen', 'Apple slusalice'),
(2, 950, 1, 'iPhone 14', 'iPhone original'), (3, 1150, 1, 'iPhone 14 PRO', 'iPhone original'),
(4, 250, 1, 'Airpods Pro', 'Airpods pro Apple original');