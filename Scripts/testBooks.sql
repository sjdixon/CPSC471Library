use library;

# Book
set @v1 := (select max(i.libraryCode) from Item i) + 1;
insert into item values (@v1,'Book','Fantasy Section','Harry Potter and the Philosophers Stone','1997',0,"Fantasy", "Children");
insert into Book (libraryCode, ISBN, author) values (@v1, 0563533390, "JK Rowling");
set @v1 = @v1 + 1
insert into item values (@v1,'Book','Fantasy Section','Harry Potter and the Chamber of Secrets','1997',0,"Fantasy", "Children");
insert into Book (libraryCode, ISBN, author) values (@v1, 1408810557, "JK Rowling");
set @v1 = @v1 + 1
insert into item values (@v1,'Book','Fantasy Section','Harry Potter and the Prisoner of Azkaban','1997',0,"Fantasy", "Children");
insert into Book (libraryCode, ISBN, author) values (@v1, 1408810565, "JK Rowling");
