
USE brx553jfhvrjufqsjwzs;

Create TABLE Proprietari(
IdProprietario INTEGER AUTO_INCREMENT primary key not null,
Nome VARCHAR(30) not null,    
Cognome VARCHAR(30) not null,
Telefono VARCHAR(15) not null,
Email VARCHAR(30) not null
)engine='InnoDB';

Create TABLE comuni(
IdComune INTEGER AUTO_INCREMENT primary key not null,
CAP INTEGER(5) not null,    
Comune VARCHAR(35) not null,
Provincia VARCHAR(2) not null,
Nazione VARCHAR(35) not null
)engine='InnoDB';

Create TABLE appartamenti(
IdAppartamento INTEGER AUTO_INCREMENT primary key not null,    
Toponimo VARCHAR(10) not null,
Nomevia VARCHAR(20) not null,
Civico INTEGER(3) not null,
idComuneApp INTEGER not null,
Prezzo double not null,
Descrizione VARCHAR(1000) not null,
idProprietario INTEGER not null,
Posizione VARCHAR(500) not null,
image VARCHAR(200) not null,
FOREIGN KEY (idComuneApp) REFERENCES comuni(IdComune),
FOREIGN KEY (idProprietario) REFERENCES Proprietari(IdProprietario)    
)engine='InnoDB';

Create TABLE clienti(
UsernameCliente VARCHAR(20) primary key not null,
Nome VARCHAR(30) not null,    
Cognome VARCHAR(30) not null,
Telefono VARCHAR(15) not null,
Email VARCHAR(30) not null,
Password VARCHAR(256) not null,
Toponimo VARCHAR(10) not null,
Nomevia VARCHAR(40) not null,
Civico INTEGER(3) not null,
idComuneCli INTEGER not null,
FOREIGN KEY (idComuneCli) REFERENCES comuni(IdComune),
NumCreditCard bigint(16) not null,
TipoCreditCard VARCHAR(20) not null
)engine='InnoDB';

Create TABLE affitti(
IdAffitto INTEGER AUTO_INCREMENT primary key not null,
Checkin date not null,
Checkout date not null,
Import decimal(10.0) not null,
idAppartamento INTEGER not null,
usernameCliente VARCHAR(20) not null,
FOREIGN KEY (idAppartamento) REFERENCES appartamenti(IdAppartamento),
FOREIGN KEY (usernameCliente) REFERENCES clienti(UsernameCliente)
)engine='InnoDB';


INSERT INTO Proprietari(Nome, Cognome, Telefono, Email) 
VALUES 

("Rocco","Siffredi","3439469753","membrogrosso@gmail.com"),
("Simone","Deleonardis","3452364253","facciolatrap@gmail.com"),
("Macchia","Marica","3840341046","monopattino@gmail.com"),
("Frank","Loizzi","3784568357","giudosemprecamion@gmail.com"),
("Mimmo","Sacchetti","3924226284","IngDomeSac@gmail.com");


INSERT INTO comuni(CAP, Comune, Provincia, Nazione) 
VALUES 

(70125,"Bari","BA","Italia"),
(70564,"Catania","CA","Italia"),
(70234,"Milano","MI","Italia"),
(70657,"Torino","TO","Italia"),
(70926,"Cosenza","CS","Italia"),
(70267,"Roma","RM","Italia"),
(70280,"Catanzaro","CA","Italia"),
(70932,"Bologna","BO","Italia"),
(70042,"Caserta","CE","Italia"),
(70728,"Napoli","NA","Italia"),
(70267,"Reggio Emilia","RE","Italia"),
(70235,"Reggio Calabria","RC","Italia"),
(70586,"Rimini","RM","Italia"),
(70368,"Venezia","VE","Italia"),
(70124,"Bari","BA","Italia"),
(70235,"Avellino","AV","Italia"),
(70255,"Agrigento","AG","Italia"),
(70267,"Cuneo","CN","Italia"),
(70379,"Bari","BA","Italia"),
(56831,"Lumingen","LU","Germania"),
(56342,"Parigi","PG","Francia"),
(46956,"Amstedam","AM","Olanda"),
(96263,"Barcellona","BL","Spagna");

INSERT INTO appartamenti(Toponimo, Nomevia, Civico, idComuneApp, Prezzo, Descrizione, idProprietario, Posizione) 
VALUES ("de Grecis","Via Guido La Vespa",86,3,130,"pipo",3,"centrale");

INSERT INTO clienti(UsernameCliente, Nome, Cognome, Telefono, Email, Password, Toponimo, Nomevia, Civico, idComuneCli, NumCreditCard, TipoCreditCard) 
VALUES 
("Prismer", "andrea", "tauro", "3351323456", "faiilserio@gmail.com", "SiSonoSerio", "tOPONIMO", "Via Dal Naso", 69,1,1234567890123456, "visa"),
("Pluto", "andrea", "Menolascina", "234675442", "MenoPluto@gmail.com", "PlutonePaperone", "slet", "Via Dal Culo", 69,1,2569526895795621, "visa"),
("LeccoLaGaFi", "Lecco", "Tutto", "1234567890", "LeccaLecca@gmail.com", "Mammamamma", "CatCalling", "Via Dante Alighieri", 69,1,5743219549256384, "visa"),
("SickG", "Giulio", "Catania", "3345678921", "SICKG@gmail.com", "NonSonoSerio", "Madre", "Via Bossetti Dal Carcere", 69,1,4507890135702589, "visa"),
("FakeTrader", "Gabriele", "Squeo", "7824246743", "SuperFakeMoney@gmail.com", "ClapClap", "TRADER", "Via Dalla Chiesa", 69,1,3598701587632549, "visa"),
("CaccaPupu", "cacca", "Pupu", "123492321", "Caccona@gmail.com", "PAPPAPPPPPA", "SLAPP", "Via Della Macchia", 69,1,0854963023485791, "visa");