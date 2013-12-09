use library;

# Book
delete from Book where libraryCode > 1;
delete from Item where libraryCode > 1;
set @v1 = (select max(i.libraryCode) from Item as i) + 1;
insert into Item values (@v1,'Book','Fantasy Section','Harry Potter and the Philosophers Stone','1997',0,"Fantasy", "Children");
insert into Book (libraryCode, ISBN, authors) values (@v1, 0563533390, "JK Rowling");
set @v1 = @v1 + 1;
insert into Item values (@v1,'Book','Fantasy Section','Harry Potter and the Chamber of Secrets','1998',0,"Fantasy", "Children");
insert into Book (libraryCode, ISBN, authors) values (@v1, 1408810557, "JK Rowling");
set @v1 = @v1 + 1;
insert into Item values (@v1,'Book','Fantasy Section','Harry Potter and the Prisoner of Azkaban','2000',0,"Fantasy", "Children");
insert into Book (libraryCode, ISBN, authors) values (@v1, 1408810565, "JK Rowling");
