create table Patron(
	pAccount int,
	membershipStartDate date,
	membershipExpiryDate date,
	membershipExpired bool,
	name varchar(40) not null,
	address varchar(50) not null,
	phone varchar(15) not null,
	email varchar(50) not null,
	primary key(pAccount)
);
create table Librarian(
	id int,
	name varchar(40) not null,
	startDate date NOT NULL,
	endDate date default NULL,
	username varchar(255) not null,
	password varchar(255) not null,
	primary key(id)
);
create table Item(
	libraryCode int,
	itemType varchar(10) not null, # DOUBLECHECK THIS
	shelfLoc varchar(20),
	title varchar(40) not null,
	year int,
	isReference bool default 0,
	genre varchar(30) not null,
	audience varchar(30) not null,
	primary key(libraryCode)
);
create table Item_Instance(
	stocknum int,
	libraryCode int,
	state varchar(10),
	foreign key(libraryCode) references Item(libraryCode),
	primary key(stocknum, libraryCode)
);
create table Fine(
	fineNo int not null auto_increment,
	pAccount int,
	libraryCode int,
	stocknum int,
	reason varchar(10),
	dateFined date,
	amountPaid decimal default 0,
	amountWaived decimal default 0,
	balance decimal default 0.20,
	foreign key(pAccount) references Patron(pAccount),
	foreign key(libraryCode) references Item_Instance(libraryCode),
	foreign key(stocknum) references Item_Instance(stocknum),
	primary key(fineNo) # DOUBLECHECK WHETHER THE OTHER ONES ARE NEEDED
);
create table Loan(
	pAccount int not null,
	stocknum int not null,
	libraryCode int not null,
	dateLoaned date NOT NULL,
	dateDue date NOT NULL,
	returned date default NULL,
	loanNum int not null auto_increment,
	foreign key(stocknum) references Item_Instance(stocknum),
	foreign key(libraryCode) references Item_Instance(libraryCode),
	foreign key(pAccount) references Patron(pAccount),
	primary key(loanNum)
);
create table Hold(
    pAccount int,
    libraryCode int,
    dateHeld datetime NOT NULL,
    expiryDate date,
    availDate date default NULL,
    shelfDate date default NULL,
    pickupDate date default NULL,
    removalDate date default NULL,
    timeToPickup varchar(20),
    stocknum int default NULL,
    foreign key(pAccount) references Patron(pAccount),
    foreign key(stocknum) references Item_Instance(stocknum),
    foreign key(libraryCode) references Item(libraryCode),
    primary key(libraryCode, pAccount, dateHeld)

);
create table Fine_Updated_By(
	fineNo int,
	libId int,
	dateUpdated date NOT NULL,
	foreign key(fineNo) references Fine(fineNo),
	foreign key(libId) references Librarian(id),
	primary key(fineNo,libId,dateUpdated)
);
create table Newspaper(
    issue date,
    libraryCode int,
    publisher varchar(50),
    foreign key(libraryCode) references Item(libraryCode),
    primary key(libraryCode)
);
create table Book(
    authors varchar(70),
    ISBN int,
    libraryCode int,
    foreign key(libraryCode) references Item(libraryCode),
    primary key(libraryCode)
);
create table Magazine(
    issue date,
    subtitle varchar(40),
    publisher varchar(30),
    libraryCode int,
    foreign key(libraryCode) references Item(libraryCode),
    primary key(libraryCode)
);
create table Audio(
    libraryCode int,
    artists varchar(40),
    productionCompany varchar(40),
    UPC int,
    foreign key(libraryCode) references Item(libraryCode),
    primary key(libraryCode)
);
create table Video(
    libraryCode int,
    UPC int,
    director varchar(50),
    productionCompany varchar(40),
    foreign key(libraryCode) references Item(libraryCode),
    primary key(libraryCode)
);

INSERT INTO Librarian (id, name, startDate, endDate, username, password) VALUES (0, "Default Librarian", now(), NULL, "default", "c21f969b5f03d33d43e04f8f136e7682");
