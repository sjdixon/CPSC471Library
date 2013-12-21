use library;

# Create new patrons with our email addresses
delete from Patron where pAccount=80 or pAccount=90 or pAccount=70 or pAccount=60;
insert into Patron (pAccount, membershipStartDate, membershipExpired, name, phone, address, email) values (60, "2010-01-01", 1, "ExpiredPatron", "4031234567", "1001 1st Street NW Calgary", "fake-email@me.com");
insert into Patron (pAccount, membershipStartDate, membershipExpired, name, phone, address, email) values (70, curdate(), 0, "Gaby Comeau", "5874339487", "gabys address", "gabychan@me.com");
insert into Patron (pAccount, membershipStartDate, membershipExpired, name, phone, address, email) values (80, curdate(), 0, "Stephen Dixon", "5874339487", "stephens address", "sjdixon2@gmail.com");
insert into Patron (pAccount, membershipStartDate, membershipExpired, name, phone, address, email) values (90, curdate(), 0, "Rhianne Hadfield", "5874339487", "rhiannes address", "dawg_rh@hotmail.com");
insert into Patron (pAccount, membershipStartDate, membershipExpired, name, phone, address, email) values (100, curdate(), 0, "Patron with Fines", "1234567890", "some address", "totaljerk@me.com");
update Patron set membershipExpiryDate = curdate() + interval 1 year where pAccount!=60;
update Patron set membershipExpiryDate = "2013-10-10" where pAccount=60;

