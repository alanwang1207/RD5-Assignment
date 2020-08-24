create database test;

use test;

CREATE TABLE `user` (
  `id` int NOT NULL auto_increment primary key,
  `username` varchar(20) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `user` (`id`,`username`,`password`) VALUES
(1,'aaa','111'),
(2,'bbb','222');