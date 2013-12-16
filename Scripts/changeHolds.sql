drop table Hold;
create table Hold(
    pAccount int,
    libraryCode int,
    dateHeld date NOT NULL,
    expiryDate date,
    availDate date default NULL,
    pickupDate date default NULL,
    timeToPickup varchar(20),
    stocknum int default NULL,
    foreign key(pAccount) references Patron(pAccount),
    foreign key(stocknum) references Item_Instance(stocknum),
    foreign key(libraryCode) references Item(libraryCode),
    primary key(libraryCode, pAccount, dateHeld)
);

