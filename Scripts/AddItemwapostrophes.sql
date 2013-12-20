Use library;
insert into Item values (@v1,'Book','Children\'s Section','Treasure Island','1779',0,"Childrens", "Children");
insert into Book (libraryCode, ISBN, authors) values (@v1, 123e4321, "Robert Louis Stevenson");
insert into Item_Instance values (1, @v1, 'New');
insert into Item_Instance values (2, @v1, 'New');
insert into Item_Instance values (3, @v1, 'New');






