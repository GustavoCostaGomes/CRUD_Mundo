create database CRUD_Mundo;
use CRUD_Mundo;

create table paises (
    id_pais int primary key auto_increment,
    nome varchar(80) not null,
    continente varchar (20) not null,
    populacao int not null,
    idioma varchar(20) not null
);

create table cidades (
	id_cidade int primary key auto_increment,
    nome varchar(80) not null,
    populacao int not null,
    id_pais int not null,
    foreign key (id_pais) references paises (id_pais) on delete cascade
);

select * from paises;
select * from cidades;