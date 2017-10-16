CREATE TABLE IF NOT EXISTS `images`(
    `ID`  int(11) NOT NULL AUTO_INCREMENT,
    `TITLE` varchar(255) NOT NULL,
    `FILEPATH` varchar(255) NOT NULL,
    `DESCRIPTION` varchar(255),
    `WIDTH` int,
    `HEIGHT` int,
    PRIMARY KEY (ID))