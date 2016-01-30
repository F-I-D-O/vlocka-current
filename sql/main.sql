
ALTER TABLE `vlocka`.`uzivatele` 
CHANGE COLUMN `heslo` `heslo` BINARY(60) NOT NULL;

ALTER TABLE `vlocka`.`uzivatele` 
ADD COLUMN `remember_token` VARCHAR(100) NULL AFTER `aktivni`;