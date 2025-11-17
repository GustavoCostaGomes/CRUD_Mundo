create database CRUD_Mundo;
use CRUD_Mundo;

create table paises (
    id_pais int primary key auto_increment,
    nome varchar(80) not null,
    continente varchar (20) not null,
    populacao int not null,
    idioma varchar(20) not null,
    bandeira varchar(255) not null
);

create table cidades (
	id_cidade int primary key auto_increment,
    nome varchar(80) not null,
    populacao int not null,
    id_pais int not null,
    foreign key (id_pais) references paises (id_pais) on delete cascade
);

INSERT INTO paises (nome, continente, populacao, idioma, bandeira) VALUES
('Brazil', 'South America', 215000000, 'Portuguese', 'Brasil.jpg'),
('United States', 'North America', 333000000, 'English', 'eua.png'),
('France', 'Europe', 67400000, 'French', 'frança.png'),
('Japan', 'Asia', 125700000, 'Japanese', 'japao.jpg'),
('United Kingdom', 'Europe', 67800000, 'English', 'uk.png');

INSERT INTO cidades (nome, populacao, id_pais) VALUES
('São Paulo', 12300000, 1),
('Rio de Janeiro', 6748000, 1),
('Brasília', 3055149, 1),
('Salvador', 2886698, 1),
('Fortaleza', 2686612, 1),

('New York', 8419600, 2),
('Los Angeles', 3980400, 2),
('Chicago', 2716000, 2),
('Houston', 2328000, 2),
('Miami', 478250, 2),

('Paris', 2161000, 3),
('Marseille', 870731, 3),
('Lyon', 518635, 3),
('Toulouse', 486828, 3),
('Nice', 342522, 3),

('Tokyo', 13960000, 4),
('Osaka', 2725000, 4),
('Kyoto', 1466000, 4),
('Yokohama', 3757630, 4),
('Sapporo', 1952000, 4),

('London', 8982000, 5),
('Manchester', 553230, 5),
('Birmingham', 1141816, 5),
('Liverpool', 498042, 5),
('Edinburgh', 536775, 5);

select * from paises;
select * from cidades;