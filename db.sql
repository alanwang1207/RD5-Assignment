create database test2;

use test2;

CREATE TABLE `user` (
  `id` int NOT NULL auto_increment primary key,
  `username` varchar(20) NOT NULL,
  `password` varchar(30) NOT NULL,
  `tid` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `cash` int 
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `detail`(
  `did` int NOT NULL auto_increment primary key,
  `uid` int not null,
  `cash` int,
  `decash` int default 0,
  `dcash` int default 0,
  `date` varchar(20),
  FOREIGN KEY (`uid`) REFERENCES `user`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `user` (`id`,`username`,`password`,`tid`,`email`,`cash`) VALUES
(1,'aaa','111','A123456789','aaa111@gmail.com',111),
(2,'bbb','222','B123456789','bbb222@gmail.com',0);


INSERT INTO `detail` (`uid`,`decash`,`dcash`,`cash`,`date`) VALUES
(1,100,0,current_timestamp()),
(1,100,0,current_timestamp()),
(1,100,0,current_timestamp()),
(2,0,200,current_timestamp()),
(2,50,0,current_timestamp()),
(2,0,100,current_timestamp());



select decash,dcash,cash,date from detail d join user u on d.uid = u.id where uid = 1

select cid,username,dis from customer c join block_list b on c.cid = b.bid ;