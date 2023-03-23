CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `photo_profile` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO `users` (`user_id`, `username`, `fullname`, `photo_profile`) VALUES
	(1, 'muazramdany', 'Muaz Ramdany', 'default.png');
