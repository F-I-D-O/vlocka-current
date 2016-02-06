
ALTER TABLE `vlocka`.`uzivatele` 
CHANGE COLUMN `heslo` `heslo` BINARY(60) NOT NULL;

ALTER TABLE `vlocka`.`uzivatele` 
ADD COLUMN `remember_token` VARCHAR(100) NULL AFTER `aktivni`;

ALTER TABLE `novinky`
CHANGE COLUMN `datum` `created_at`  datetime NOT NULL AFTER `nadpis`,
ADD COLUMN `updated_at`  datetime NULL ON UPDATE CURRENT_TIMESTAMP AFTER `aktivni`