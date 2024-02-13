create table leaf_regeneration (
    dateRegeneration date unique
);
insert into leaf_regeneration values ('2024-01-01'),('2024-02-01');

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
insert into leaf_variete values (null , 'variete1' , 1.8 , 2);
alter table leaf_variete add column prixDeVente decimal(11,2) default 0;
alter table leaf_cueilleur add column poidMinimal decimal(11,2) default 0;
alter table leaf_cueilleur add column bonus decimal(11,2) default 0;
alter table leaf_cueilleur add column mallus decimal(11,2) default 0;

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

create table leaf_user (
    idUser int auto_increment,
    nom varchar(50) , 
    eMail varchar(50) , 
    motDePasse varchar(64),
    primary key(idUser)
)engine=innoDB;

create table leaf_cueillette (
    idCueillette int auto_increment,
    dateCueillette date,
    idCueilleur int,
    numeroParcelle int,
    poidCueilli decimal(11,2),
    primary key(idCueillette),
    foreign key (idCueilleur) references leaf_cueilleur(idCueilleur),
    foreign key (numeroParcelle) references leaf_parcelle(numeroParcelle),
    constraint nonNull check (poidCueilli>0)
)engine=innoDB;

create table leaf_depense(
    idDepense int auto_increment,
    dateDepense date,
    idCategorie int,
    montant decimal(11,2),
    primary key(idDepense),
    foreign key(idCategorie) references leaf_categorieDepense(idCategorie)
);


create or replace view v_leaf_infoParcelle as
select 
    leaf_parcelle.idParcelle,
    leaf_parcelle.numeroParcelle,
    (leaf_parcelle.surface*10000) as surface,
    leaf_variete.occupation,
    leaf_variete.rendement,
    Floor(((leaf_parcelle.surface*10000)/leaf_variete.occupation)*leaf_variete.rendement) as poid
from leaf_parcelle
join leaf_variete 
    on leaf_parcelle.idVariete = leaf_variete.idVariete;




create or replace view v_leaf_sommePoidCueilliParcelle as
select 
    sum(leaf_cueillette.poidCueilli) as sommePoid,
    leaf_cueillette.numeroParcelle, 
    leaf_cueillette.dateCueillette
from leaf_cueillette group by numeroParcelle,year(leaf_cueillette.dateCueillette),month(leaf_cueillette.dateCueillette);


create or replace view v_leaf_poidRestantPercelle as
select
    v_leaf_infoParcelle.numeroParcelle ,
    (v_leaf_infoParcelle.poid-v_leaf_sommePoidCueilliParcelle.sommePoid) as difference,
    v_leaf_sommePoidCueilliParcelle.dateCueillette
from v_leaf_infoParcelle
join v_leaf_sommePoidCueilliParcelle on v_leaf_infoParcelle.numeroParcelle = v_leaf_sommePoidCueilliParcelle.numeroParcelle;



create or replace view v_leaf_parcelle as
select 
    leaf_parcelle.idParcelle , 
    leaf_parcelle.numeroParcelle , 
    leaf_parcelle.surface , 
    leaf_variete.nomVariete 
from leaf_parcelle 
join leaf_variete 
    on leaf_parcelle.idVariete = leaf_variete.idVariete; 


create or replace view v_leaf_cueilleur as
select 
    leaf_cueilleur.idCueilleur , 
    leaf_cueilleur.nom , 
    leaf_genre.nom as genre, 
    leaf_cueilleur.dateNaissance 
from leaf_cueilleur 
join leaf_genre 
    on leaf_cueilleur.idGenre = leaf_genre.idGenre;


create or replace view v_leaf_selaireCueilleur as
select 
    leaf_salaireCueilleur.idSalaire , 
    leaf_cueilleur.nom , 
    leaf_salaireCueilleur.montant 
from leaf_salaireCueilleur 
join leaf_cueilleur 
    on leaf_salaireCueilleur.idCueilleur = leaf_cueilleur.idCueilleur;


create or replace view v_leaf_cueillette as
select 
    leaf_cueillette.idCueillette,
    leaf_cueillette.dateCueillette,
    leaf_cueilleur.nom,
    leaf_parcelle.numeroParcelle,
    leaf_cueillette.poidCueilli
from leaf_cueillette 
join leaf_cueilleur 
    on leaf_cueillette.idCueilleur = leaf_cueilleur.idCueilleur
join leaf_parcelle on leaf_cueillette.numeroParcelle = leaf_parcelle.numeroParcelle;


create or replace view v_leaf_depense as
select 
    leaf_depense.idDepense,
    leaf_depense.dateDepense,
    leaf_categorieDepense.categorie,
    leaf_depense.montant
from leaf_depense
join leaf_categorieDepense on leaf_depense.idCategorie = leaf_categorieDepense.idCategorie;


INSERT INTO leaf_admin VALUES(null, "Michel", "michel@itu.mg", "michel08");

INSERT INTO leaf_admin VALUES(null, "Nicolas", "nico@itu.mg", "nico07");    

INSERT INTO leaf_user VALUES(null, "Miarantsoa", "miarantsoa@itu.mg", "miarantsoa27");   


create or replace view v_leaf_paiementCueilleur as
select 
    leaf_cueillette.dateCueillette,
    leaf_cueilleur.nom,
    sum(leaf_cueillette.poidCueilli) as poidTotal,
    leaf_cueilleur.bonus,
    leaf_cueilleur.mallus,
    leaf_cueilleur.poidMinimal,
    leaf_salaireCueilleur.montant
from leaf_cueillette 
join leaf_cueilleur 
    on leaf_cueillette.idCueilleur = leaf_cueilleur.idCueilleur
join leaf_salaireCueilleur
    on leaf_cueillette.idCueilleur = leaf_salaireCueilleur.idCueilleur;
where leaf_cueillette.dateCueillette>'2024-01-31'
group by leaf_cueillette.idCueilleur;

create or replace view v_leaf_vente as
select 
    leaf_cueillette.dateCueillette,
    leaf_cueillette.numeroParcelle,
    leaf_cueillette.poidCueilli,
    sum(leaf_variete.prixDeVente*leaf_cueillette.poidCueilli) as produit
from leaf_cueillette
join leaf_parcelle 
    on leaf_cueillette.numeroParcelle = leaf_parcelle.numeroParcelle
join leaf_variete on leaf_parcelle.idVariete = leaf_variete.idVariete;
