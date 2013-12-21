use library;
insert into Loan (pAccount, libraryCode, stocknum, dateLoaned, dateDue) values (100, 4, 1, curdate() - interval 1 month, curdate() - interval 1 week);
insert into Loan (pAccount, libraryCode, stocknum, dateLoaned, dateDue) values (90, 4, 2, curdate() - interval 1 month, curdate() + interval 1 week);
insert into Hold (pAccount, libraryCode, stocknum, dateHeld, availDate, shelfDate, expiryDate, removalDate, pickupDate) values (100,4,2, curdate() - interval 1 year, curdate()- interval 50 week, curdate() - interval 48 week, curdate() - interval 45 week, curdate() - interval 44 week, NULL);
