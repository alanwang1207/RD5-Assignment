create database test2;

use test2;

CREATE TABLE `user` (
  `id` int NOT NULL auto_increment primary key,
  `username` varchar(20) NOT NULL,
  `password` varchar(30) NOT NULL,
  `cash` int 
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `detail`(
  `did` int NOT NULL auto_increment primary key,
  `uid` int not null,
  `decash` int default 0,
  `dcash` int default 0,
  FOREIGN KEY (`uid`) REFERENCES `user`(`id`),
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `user` (`id`,`username`,`password`,`cash`) VALUES
(1,'aaa','111',111),
(2,'bbb','222',0);
