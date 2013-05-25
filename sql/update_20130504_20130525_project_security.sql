ALTER TABLE `criminal` ADD COLUMN `passport_country` varchar(255) NOT NULL AFTER `snp`;
ALTER TABLE `criminal` ADD COLUMN `passport_seria` varchar(255) NOT NULL AFTER `passport_country`;
ALTER TABLE `criminal` ADD COLUMN `passport_number` varchar(255) NOT NULL AFTER `passport_seria`;
ALTER TABLE `criminal` DROP COLUMN snp;
