use library;
insert into Loan (pAccount, libraryCode, stocknum, dateLoaned, expiryDate) values (100, 8, 1, curdate() - 1 month, curdate() - interval 1 week);
insert into Loan (pAccount, libraryCode, stocknum, dateLoaned, expiryDate) values (90, 8, 2, curdate() - 1 month, curdate() + interval 1 week);
insert into Hold (pAccount, libraryCode, stocknum, dateHeld, availDate, shelfDate, expiryDate, returnedDate, pickupDate) values (100,8,2, curdate() - interval 1 year, curdate()- interval 50 week, curdate() - interval 48 week, curdate() - interval 45 week, curdate() - interval 44 week, NULL);
