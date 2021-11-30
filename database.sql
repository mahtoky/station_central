CREATE DATABASE central_station;
CREATE ROLE admin_station LOGIN PASSWORD '123456';
ALTER DATABASE central_station OWNER TO admin_station;

-- *************************************
CREATE SEQUENCE stationseq;
CREATE TABLE station(
  codeStation varchar(10) default 'STT'||nextval('stationseq'),
  ville varchar(20),
  villeabv varchar(5),
  primary key(codeStation)
);

insert into station values('STT1', 'Bira', 'BIR'), ('STT2', 'Tamaga', 'TMG'), ('STT3', 'Nosybe', 'NSB');

CREATE SEQUENCE adminseq;
CREATE TABLE admins(
  idAdmin varchar(5) default 'USR'||nextval('adminseq'),
  username varchar(50),
  password varchar(50),
  primary key(idAdmin)
);

CREATE SEQUENCE productseq;
CREATE TABLE product(
  idProduct integer default nextval('productseq'),
  productName varchar(50),
  sellPrice decimal,
  returnPrice decimal,
  evaporation integer,
  primary key(idProduct)
);

CREATE SEQUENCE movementseq;
CREATE TABLE movement(
  idMovement integer default nextval('movementseq'),
  idStation varchar(10),
  idproduct integer,
  entry decimal,
  sell decimal,
  valuesell decimal,
  datemovement date default now(),
  primary key(idMovement),
  foreign key(idproduct) references product(idproduct),
  foreign key(idStation) references station(codeStation)
);

-- ************** create VIEW

CREATE OR REPLACE VIEW produitparstation as
select st.*, pr.* from station st cross join product pr;

CREATE OR REPLACE VIEW totalVente as
select st.codestation as idstation, st.ville, coalesce(sum(mv.valuesell),0) as totalvente, coalesce(sum(mv.valuesell),0) as totalmontantvente
from movement mv right join station st on mv.idstation = st.codeStation group by st.codestation, st.ville;

CREATE OR REPLACE VIEW totalVenteParJour as
select st.codestation as idstation, st.ville, coalesce(sum(mv.valuesell),0) as totalvente, mv.datemovement
from movement mv right join station st on mv.idstation = st.codeStation group by st.codestation, st.ville, mv.datemovement;

CREATE OR REPLACE VIEW totalVenteParProduit as
select ps.codestation as idstation, ps.ville, coalesce(sum(mv.valuesell),0) as totalvente, coalesce(sum(mv.sell),0) as totalqte, mv.datemovement, ps.idproduct, ps.productname
from movement mv right join produitparstation ps on mv.idstation = ps.codestation and mv.idproduct = ps.idproduct
group by ps.codestation, ps.ville, mv.datemovement, ps.idproduct, ps.productname;

CREATE OR REPLACE VIEW evolutionvente as
select datemovement, coalesce(sum(totalvente), 0) as totalvente
from totalventeparjour group by datemovement;

CREATE OR REPLACE VIEW recapTotalParProduit as
select ps.idproduct, ps.productname, coalesce(sum(mv.sell),0) as totalVente
from movement mv right join produitparstation ps on mv.idproduct = ps.idproduct
group by ps.idproduct, ps.productname;

CREATE OR REPLACE VIEW totalventeProduit as
select idproduct, productname, sum(totalvente) as totalvente, sum(totalqte) as totalqte from totalventeparproduit group by idproduct, productname;

CREATE OR REPLACE VIEW beneficeParProduit as
select tv.idproduct, tv.productname, coalesce(tv.totalvente -(ps.returnprice*tv.totalqte), 0) as benefice
from product ps left join totalventeProduit tv on ps.idproduct = tv.idproduct;

CREATE OR REPLACE VIEW beneficetotal as
select sum(benefice) as beneficetotal
from beneficeParProduit;

CREATE OR REPLACE VIEW sumMovement as
  select idproduct, sum(entry) as entry, sum(sell) as sell
  from movement group by idproduct;

CREATE OR REPLACE VIEW sumMovementStation as
  select idstation, idproduct, sum(entry) as entry, sum(sell) as sell
  from movement group by idproduct, idstation;

CREATE OR REPLACE VIEW stock as
  select pr.idproduct, pr.productname, pr.sellprice, pr.returnprice, coalesce((sm.entry - sm.sell), 0.0) as stock
    from sumMovement sm right join produitparstation pr on pr.idproduct = sm.idproduct;

CREATE OR REPLACE VIEW stockProduit as
  select pr.codestation, pr.ville, pr.productname, pr.idproduct, coalesce((sm.entry - sm.sell), 0.0) as stock
  from sumMovementStation sm right join produitparstation pr on pr.idproduct = sm.idproduct and pr.codestation = sm.idstation
  group by pr.codestation, pr.productname, pr.idproduct, pr.ville, sm.entry, sm.sell;
