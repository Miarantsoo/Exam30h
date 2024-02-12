create table leaf_admin (
    idAdmin int auto_increment,
    nom varchar(50) , 
    eMail varchar(50) , 
    motDePasse varchar(64),
    primary key(idAdmin)
)engine=innoDB;

create table leaf_variete (
    idVariete int auto_increment,
    nomVariete varchar(50),
    occupation decimal(11,2),
    rendement decimal(11,2),
    primary key(idVariete)
)engine=innoDB;

create table leaf_parcelle (
    idParcelle int auto_increment,
    numeroParcelle int unique,
    surface decimal(11 , 2),
    idVariete int,
    primary key(idParcelle),
    foreign key(idVariete) references leaf_variete(idVariete)
)engine=innoDB;

create table leaf_genre (
    idGenre int auto_increment,
    nom varchar(20),
    primary key(idGenre)
)engine=innoDB;

create table leaf_cueilleur (
    idCueilleur int auto_increment,
    nom varchar(50),
    idGenre int,
    dateNaissance date,
    primary key(idCueilleur),
    foreign key(idGenre) references leaf_genre(idGenre)
)engine=innoDB;

create table leaf_categorieDepense (
    idCategorie int auto_increment,
    categorie varchar(50),
    primary key (idCategorie)
)engine=innoDB;

create table leaf_salaireCueilleur (
    idSalaire int auto_increment,
    idCueilleur int,
    montant decimal(11,2),
    primary key (idSalaire),
    foreign key (idCueilleur) references leaf_cueilleur(idCueilleur)
)engine=innoDB;

create or replace view v_parcelle as
select 
    leaf_parcelle.idParcelle , 
    leaf_parcelle.numeroParcelle , 
    leaf_parcelle.surface , 
    leaf_variete.nomVariete 
from leaf_parcelle 
join leaf_variete 
    on leaf_parcelle.idVariete = leaf_variete.idVariete; 