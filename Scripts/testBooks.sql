use library;

# Book
set @v1 = 1;
insert into Item values (@v1,'Book','Fantasy Section','Harry Potter and the Philosopher\'s Stone','1997',0,"Fantasy", "Children");
insert into Book (libraryCode, ISBN, authors) values (@v1, 0563533390, "JK Rowling");
delete from Item_Instance where libraryCode=@v1;
insert into Item_Instance values (1, @v1, 'New');
insert into Item_Instance values (2, @v1, 'New');
insert into Item_Instance values (3, @v1, 'New');
set @v1 = @v1 + 1;
insert into Item values (@v1,'Book','Fantasy Section','Harry Potter and the Chamber of Secrets','1998',0,"Fantasy", "Children");
insert into Book (libraryCode, ISBN, authors) values (@v1, 1408810557, "JK Rowling");
delete from Item_Instance where libraryCode=@v1;
insert into Item_Instance values (1, @v1, 'New');
insert into Item_Instance values (2, @v1, 'New');
insert into Item_Instance values (3, @v1, 'New');
set @v1 = @v1 + 1;
insert into Item values (@v1,'Book','Fantasy Section','Harry Potter and the Prisoner of Azkaban','2000',0,"Fantasy", "Children");
insert into Book (libraryCode, ISBN, authors) values (@v1, 1408810565, "JK Rowling");
delete from Item_Instance where libraryCode=@v1;
insert into Item_Instance values (1, @v1, 'New');
insert into Item_Instance values (2, @v1, 'New');
insert into Item_Instance values (3, @v1, 'New');
set @v1 = @v1 + 1;
insert into Item values (@v1, "Book", "Fantasy", "Harry Potter and the Goblet of Fire", "2001", 0, "Fantasy", "Children");
insert into Book (libraryCode, ISBN, authors) values (@v1, 1408814567, "JK Rowling");
insert into Item_Instance values (1, @v1, 'New');
insert into Item_Instance values (2, @v1, 'New');
insert into Item_Instance values (3, @v1, 'New');
insert into Item_Instance values (4, @v1, 'New');
insert into Item_Instance values (5, @v1, 'New');
insert into Item_Instance values (6, @v1, 'New');
insert into Item_Instance values (7, @v1, 'New');
insert into Item_Instance values (8, @v1, 'New');
insert into Item_Instance values (9, @v1, 'New');
insert into Item_Instance values (10, @v1, 'New');
insert into Item_Instance values (11, @v1, 'New');
insert into Item_Instance values (12, @v1, 'New');
insert into Item_Instance values (13, @v1, 'New');
insert into Item_Instance values (14, @v1, 'New');

set @v1 = @v1 + 1;
insert into Item values (@v1, "Audio", "Music Section", "Time 1", "2012", 0, "Metal", "Young Adult");
insert into Audio (libraryCode, artists, productionCompany, UPC) values (@v1, "Wintersun", "Nuclear Blast Records", 1238754);
insert into Item_Instance values (1, @v1, 'New');
insert into Item_Instance values (2, @v1, 'New');
insert into Item_Instance values (3, @v1, 'New');
insert into Item_Instance values (4, @v1, 'New');

set @v1 = @v1 + 1;
insert into Item values (@v1, "Audio", "Music Section", "01011001", "2008", 0, "Metal", "Young Adult");
insert into Audio (libraryCode, artists, productionCompany, UPC) values (@v1, "Ayreon", "Take Two Records", 467890325);
insert into Item_Instance values (1, @v1, 'New');
insert into Item_Instance values (2, @v1, 'New');
insert into Item_Instance values (3, @v1, 'New');
insert into Item_Instance values (4, @v1, 'New');
insert into Item_Instance values (5, @v1, 'New');
insert into Item_Instance values (6, @v1, 'New');
insert into Item_Instance values (7, @v1, 'New');

set @v1 = @v1 + 1;
insert into Item values (@v1, "Video", "Blu-Ray Section", "Avatar", "2011", 0, "Action", "Young Adult");
insert into Video (libraryCode, director, productionCompany, UPC) values (@v1, "James Cameron", "Warner Brothers", 43287554);
insert into Item_Instance values (1, @v1, 'New');
insert into Item_Instance values (2, @v1, 'New');
insert into Item_Instance values (3, @v1, 'New');

set @v1 = @v1 + 1;
insert into Item values (@v1, "Video", "DVD Section", "Gladiator", "2008", 0, "Action", "Young Adult");
insert into Video (libraryCode, director, productionCompany, UPC) values (@v1, "Ridley Scott", "Lionsgate", 01011001);
insert into Item_Instance values (1, @v1, 'New');
insert into Item_Instance values (2, @v1, 'New');

set @v1 = @v1 + 1;
insert into Item values (@v1, "Magazine", "Magazine Rack", "National Geographic", "2011", 1, "Reference", "Adult");
insert into Magazine (libraryCode, issue, subtitle, publisher) values (@v1, "2011-05-01", "Science is cool", "National Geographic");
insert into Item_Instance values (1, @v1, 'New');

set @v1 = @v1 + 1;
insert into Item values (@v1, "Magazine", "Magazine Rack", "Time", "2013", 0, "Periodical", "Adult");
insert into Magazine (libraryCode, issue, subtitle, publisher) values (@v1, "2013-12-12", "Person of the Year", "Time Warner");
insert into Item_Instance values (1, @v1, 'New');
insert into Item_Instance values (2, @v1, 'New');
insert into Item_Instance values (3, @v1, 'New');

set @v1 = @v1 + 1;
insert into Item values (@v1, "Newspaper", "Current Newspapers", "Time", "2013", 0, "Periodical", "Adult");
insert into Newspaper (libraryCode, issue, publisher) values (@v1, "2013-12-12", "CanWest Media Corp");
insert into Item_Instance values (1, @v1, 'New');
insert into Item_Instance values (2, @v1, 'New');
insert into Item_Instance values (3, @v1, 'New');

