/* DATABASE NAME: bcc_digital_payment */

CREATE TABLE `admin_tb` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_category` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO admin_tb VALUES("1","admin","","admin","21232f297a57a5a743894a0e4a801fc3");



CREATE TABLE `adminannoucement` (
  `announcement_id` int(11) NOT NULL AUTO_INCREMENT,
  `post` varchar(225) NOT NULL,
  `post_date` datetime NOT NULL,
  `post_type` varchar(225) NOT NULL,
  `posted` varchar(255) NOT NULL,
  PRIMARY KEY (`announcement_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO adminannoucement VALUES("1","GOOD DAY USERS","2023-08-15 14:09:22","All","not-active");
INSERT INTO adminannoucement VALUES("4","System maintenance ","2023-09-12 21:26:31","Buyer","not-active");
INSERT INTO adminannoucement VALUES("6","Purchase under maintenance right now","2023-09-12 21:32:05","Buyer","not-active");
INSERT INTO adminannoucement VALUES("8","GOOD MORNING","2023-09-12 21:37:22","Canteen Staff","not-active");
INSERT INTO adminannoucement VALUES("14","good day","2023-09-16 13:58:27","All","not-active");
INSERT INTO adminannoucement VALUES("20","pang evaluate na","2023-11-30 11:37:45","All","not-active");
INSERT INTO adminannoucement VALUES("21","Hello users!","2023-11-30 11:40:45","All","not-active");
INSERT INTO adminannoucement VALUES("24","System Under maintenance ","2023-12-03 15:35:10","Buyer","active");



CREATE TABLE `cashier_tb` (
  `cashier_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname_cashier` varchar(255) NOT NULL,
  `lastname_cashier` varchar(255) NOT NULL,
  `user_category` varchar(255) NOT NULL,
  `phonenumber` bigint(20) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`cashier_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO cashier_tb VALUES("1","Rosana","Dela torres","cashier","9123437548","MALE","BRGY.POBLASION, BAGO CITY","cashier@gmail.com","cashier","6ac2470ed8ccf204fd5ff89b32a355cf");



CREATE TABLE `cashierrates_tb` (
  `cashierRates_id` int(11) NOT NULL AUTO_INCREMENT,
  `cashierRates_request` varchar(255) NOT NULL,
  `cashierRatesCertificate` varchar(255) NOT NULL,
  `cashierRates_amount` int(11) NOT NULL,
  PRIMARY KEY (`cashierRates_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO cashierrates_tb VALUES("1","Non Bago Fee","Non Bago Fee","500");
INSERT INTO cashierrates_tb VALUES("2","Transcript of Record","Transcript of Records","130");
INSERT INTO cashierrates_tb VALUES("3","certificate","Certificate of Enrollment","20");
INSERT INTO cashierrates_tb VALUES("4","certificate","Certificate of Transfer Crendential","100");
INSERT INTO cashierrates_tb VALUES("7","certificate","Grades","50");



CREATE TABLE `cashin_tb` (
  `cashin_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `cashin_amount` int(11) NOT NULL,
  `ref_num` varchar(200) NOT NULL,
  `cashin_noti` tinyint(1) NOT NULL,
  `cashin_date` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`cashin_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `cashin_tb_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_tb` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO cashin_tb VALUES("12","36","40","9726843150","0","2023-10-03 12:54:03");
INSERT INTO cashin_tb VALUES("20","36","30","7489526310","0","2023-10-03 13:32:12");
INSERT INTO cashin_tb VALUES("30","79","500","1365890742","1","2023-10-11 23:02:57");
INSERT INTO cashin_tb VALUES("32","79","500","7283651049","1","2023-10-12 11:23:11");
INSERT INTO cashin_tb VALUES("33","79","500","3479621085","1","2023-10-13 10:32:41");
INSERT INTO cashin_tb VALUES("34","79","200","4158632970","1","2023-10-13 12:42:37");
INSERT INTO cashin_tb VALUES("35","79","1000","6704359812","1","2023-10-14 23:30:06");
INSERT INTO cashin_tb VALUES("36","79","500","3598170462","1","2023-10-15 00:27:27");
INSERT INTO cashin_tb VALUES("37","79","500","7153290486","1","2023-10-15 11:43:17");
INSERT INTO cashin_tb VALUES("38","79","50","2846719503","1","2023-10-15 12:54:00");
INSERT INTO cashin_tb VALUES("39","79","50","1947386052","1","2023-10-15 12:54:12");
INSERT INTO cashin_tb VALUES("42","79","500","2793541608","1","2023-10-16 22:49:12");
INSERT INTO cashin_tb VALUES("43","79","500","0458739612","1","2023-10-17 16:56:57");
INSERT INTO cashin_tb VALUES("44","79","300","3816027594","1","2023-10-18 00:20:08");
INSERT INTO cashin_tb VALUES("46","79","500","4085623719","1","2023-10-19 08:26:54");
INSERT INTO cashin_tb VALUES("47","83","1000","0645719823","1","2023-10-19 09:01:25");
INSERT INTO cashin_tb VALUES("49","86","2000","3961287450","1","2023-11-05 21:44:45");
INSERT INTO cashin_tb VALUES("50","79","6","7239148065","1","2023-11-07 00:23:00");
INSERT INTO cashin_tb VALUES("52","89","500","1376924058","0","2023-11-09 09:21:48");
INSERT INTO cashin_tb VALUES("53","79","500","3286790514","1","2023-11-12 00:59:31");
INSERT INTO cashin_tb VALUES("54","79","500","6952130847","1","2023-11-15 14:42:59");
INSERT INTO cashin_tb VALUES("55","90","1000","0975362481","1","2023-11-16 10:39:30");
INSERT INTO cashin_tb VALUES("56","79","23","5614207398","1","2023-11-24 13:55:02");
INSERT INTO cashin_tb VALUES("57","92","500","8507269134","1","2023-11-27 13:16:54");
INSERT INTO cashin_tb VALUES("58","83","200","8369075124","1","2023-11-30 09:55:51");
INSERT INTO cashin_tb VALUES("59","83","500","3985701462","1","2023-11-30 10:23:51");
INSERT INTO cashin_tb VALUES("60","93","10","9784210365","0","2023-11-30 10:30:25");
INSERT INTO cashin_tb VALUES("62","96","1000","1498657230","0","2023-11-30 10:37:03");
INSERT INTO cashin_tb VALUES("63","88","1000","6257431098","0","2023-11-30 10:39:28");
INSERT INTO cashin_tb VALUES("64","97","2000","9368271504","0","2023-11-30 10:50:20");
INSERT INTO cashin_tb VALUES("65","98","500","3719084265","0","2023-11-30 10:53:21");
INSERT INTO cashin_tb VALUES("66","100","1000","9471502863","0","2023-11-30 11:02:03");
INSERT INTO cashin_tb VALUES("67","99","1000","5096824713","0","2023-11-30 11:02:37");
INSERT INTO cashin_tb VALUES("68","101","1000","5806723149","0","2023-11-30 11:02:52");
INSERT INTO cashin_tb VALUES("69","102","1000","7029356481","0","2023-11-30 11:03:16");
INSERT INTO cashin_tb VALUES("70","104","1000","4562908317","0","2023-11-30 11:03:44");
INSERT INTO cashin_tb VALUES("71","105","1000","8943607152","0","2023-11-30 11:04:35");
INSERT INTO cashin_tb VALUES("72","108","1000","6485973210","0","2023-11-30 11:05:07");
INSERT INTO cashin_tb VALUES("73","111","1000","0829645173","0","2023-11-30 11:30:33");
INSERT INTO cashin_tb VALUES("74","110","1000","2574610938","1","2023-11-30 11:31:20");
INSERT INTO cashin_tb VALUES("75","113","1000","7041289365","0","2023-11-30 11:31:41");
INSERT INTO cashin_tb VALUES("76","112","50000","7532016849","0","2023-11-30 11:32:01");
INSERT INTO cashin_tb VALUES("77","111","4","2765148309","0","2023-11-30 11:38:11");
INSERT INTO cashin_tb VALUES("79","114","1000","7149802536","0","2023-11-30 13:07:24");
INSERT INTO cashin_tb VALUES("80","115","1000","9743526801","0","2023-11-30 13:12:42");
INSERT INTO cashin_tb VALUES("81","116","500","5136842097","0","2023-11-30 13:21:04");
INSERT INTO cashin_tb VALUES("82","117","1100","5426791830","0","2023-11-30 13:22:42");
INSERT INTO cashin_tb VALUES("83","119","500","8926534701","0","2023-11-30 13:23:57");
INSERT INTO cashin_tb VALUES("84","118","1000","0416539872","0","2023-11-30 13:24:33");
INSERT INTO cashin_tb VALUES("85","120","100","0672485913","1","2023-11-30 13:46:02");
INSERT INTO cashin_tb VALUES("86","121","500","6951847230","0","2023-11-30 13:46:55");
INSERT INTO cashin_tb VALUES("87","123","500","0356782941","0","2023-11-30 13:47:25");
INSERT INTO cashin_tb VALUES("88","122","1500","4693012758","0","2023-11-30 13:48:02");
INSERT INTO cashin_tb VALUES("89","124","1000","6952104837","0","2023-11-30 13:49:50");
INSERT INTO cashin_tb VALUES("90","126","5","9536817024","0","2023-11-30 13:57:42");
INSERT INTO cashin_tb VALUES("91","126","995","8593761420","0","2023-11-30 13:59:12");
INSERT INTO cashin_tb VALUES("92","90","1000","6531409278","1","2023-12-03 12:49:42");
INSERT INTO cashin_tb VALUES("93","79","500","6482910753","0","2023-12-03 15:15:17");
INSERT INTO cashin_tb VALUES("94","83","500","3570461298","0","2023-12-03 15:16:13");



CREATE TABLE `cashout_tb` (
  `cashout_id` int(11) NOT NULL AUTO_INCREMENT,
  `teller_id` int(11) NOT NULL,
  `cashout_date` datetime NOT NULL DEFAULT current_timestamp(),
  `cashout_amount` int(11) NOT NULL,
  `cashout_status` varchar(100) NOT NULL,
  `cashout_noti` tinyint(1) NOT NULL,
  `cashout_refnum` varchar(255) NOT NULL,
  PRIMARY KEY (`cashout_id`),
  KEY `teller_id` (`teller_id`),
  CONSTRAINT `cashout_tb_ibfk_1` FOREIGN KEY (`teller_id`) REFERENCES `telleruser_tb` (`teller_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO cashout_tb VALUES("1","1","2023-10-10 23:53:20","50","accepted","1","4971032586");
INSERT INTO cashout_tb VALUES("5","1","2023-10-15 11:39:48","20","accepted","1","8620973145");
INSERT INTO cashout_tb VALUES("6","1","2023-10-16 11:42:29","100","accepted","1","7143580962");
INSERT INTO cashout_tb VALUES("7","1","2023-10-18 12:43:14","100","accepted","1","2104953786");
INSERT INTO cashout_tb VALUES("10","1","2023-11-07 00:18:42","6","accepted","1","0789612435");
INSERT INTO cashout_tb VALUES("11","1","2023-12-02 22:19:21","120","accepted","1","9346102587");
INSERT INTO cashout_tb VALUES("13","1","2023-12-03 12:46:43","500","accepted","1","3964107582");
INSERT INTO cashout_tb VALUES("14","1","2023-12-03 12:50:46","300","accepted","1","9527860413");
INSERT INTO cashout_tb VALUES("15","1","2023-12-03 12:52:14","200","accepted","1","3452187609");
INSERT INTO cashout_tb VALUES("16","1","2023-12-03 15:19:40","2402","accepted","0","3852064917");



CREATE TABLE `category_tb` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `teller_id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  PRIMARY KEY (`category_id`),
  KEY `category_tb_ibfk_1` (`teller_id`),
  CONSTRAINT `category_tb_ibfk_1` FOREIGN KEY (`teller_id`) REFERENCES `telleruser_tb` (`teller_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO category_tb VALUES("13","1","Drinks");
INSERT INTO category_tb VALUES("15","1","Biscuits");
INSERT INTO category_tb VALUES("16","1","Candy");
INSERT INTO category_tb VALUES("17","2","Coolers");
INSERT INTO category_tb VALUES("18","2","Biscuit ");
INSERT INTO category_tb VALUES("19","2","Fruits");
INSERT INTO category_tb VALUES("20","3","Drinks");
INSERT INTO category_tb VALUES("22","3","Curls");
INSERT INTO category_tb VALUES("26","4","Supplies");
INSERT INTO category_tb VALUES("27","4","Necessities");
INSERT INTO category_tb VALUES("28","3","Candies");
INSERT INTO category_tb VALUES("29","3","Meals");
INSERT INTO category_tb VALUES("30","1","Meals");



CREATE TABLE `digitalpayment_tb` (
  `digitalPayment_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `payment_amount` varchar(100) NOT NULL,
  `payment_type` varchar(100) NOT NULL,
  `payment_ref` varchar(100) NOT NULL,
  `semester_year` varchar(50) NOT NULL,
  `request_noti` tinyint(1) NOT NULL,
  `requestType` varchar(100) NOT NULL,
  `payment_date` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`digitalPayment_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `digitalpayment_tb_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_tb` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO digitalpayment_tb VALUES("1","79","50","Transcript of Record","9501486237","first-semester","1","accepted","2023-10-18 23:15:37");
INSERT INTO digitalpayment_tb VALUES("3","79","100","Certificate of Transfer Crendential","1245309768","first-semester","1","accepted","2023-10-18 23:17:32");
INSERT INTO digitalpayment_tb VALUES("4","79","50","Certificate of Enrollment","4901578263","first-semester","1","accepted","2023-10-19 00:06:50");
INSERT INTO digitalpayment_tb VALUES("5","79","100","Certificate of Transfer Crendential","6835172904","first-semester","1","accepted","2023-10-19 00:07:07");
INSERT INTO digitalpayment_tb VALUES("6","79","100","Certificate of Transfer Crendential","9427810356","first-semester","1","accepted","2023-10-19 00:14:05");
INSERT INTO digitalpayment_tb VALUES("7","79","50","Certificate of Enrollment","3158460297","first-semester","1","accepted","2023-10-19 00:14:36");
INSERT INTO digitalpayment_tb VALUES("8","79","50","Certificate of Enrollment","1742695038","first-semester","1","accepted","2023-10-19 00:14:56");
INSERT INTO digitalpayment_tb VALUES("10","79","50","Transcript of Record","7361204985","first-semester","1","accepted","2023-10-19 00:37:34");
INSERT INTO digitalpayment_tb VALUES("12","79","100","Certificate of Transfer Crendential","5327081649","first-semester","1","accepted","2023-10-19 08:28:07");
INSERT INTO digitalpayment_tb VALUES("13","79","50","Transcript of Record","0615982347","first-semester","1","accepted","2023-10-19 08:28:18");
INSERT INTO digitalpayment_tb VALUES("14","83","20","Certificate of Enrollment","9732540861","first-semester","1","accepted","2023-10-19 09:09:36");
INSERT INTO digitalpayment_tb VALUES("36","89","500","Non Bago Fee","6742083591","first-semester","0","accepted","2023-11-09 11:02:14");
INSERT INTO digitalpayment_tb VALUES("37","79","100","Certificate of Transfer Crendential","2359740618","first-semester","1","accepted","2023-11-12 01:01:51");
INSERT INTO digitalpayment_tb VALUES("38","79","130","Transcript of Record","0869751234","first-semester","1","accepted","2023-11-12 01:14:58");
INSERT INTO digitalpayment_tb VALUES("39","91","500","Non Bago Fee","2750396418","first-semester","0","accepted","2023-11-16 10:57:42");
INSERT INTO digitalpayment_tb VALUES("62","92","500","Non Bago Fee","7352401968","first-semester","0","accepted","2023-11-27 13:17:56");
INSERT INTO digitalpayment_tb VALUES("63","79","130","Transcript of Records","9360451728","first-semester","1","accepted","2023-11-27 13:42:13");
INSERT INTO digitalpayment_tb VALUES("64","79","130","Transcript of Records","9520173468","first-semester","1","cancel","2023-11-28 16:42:19");
INSERT INTO digitalpayment_tb VALUES("65","83","50","Grades","7645380912","first-semester","1","cancel","2023-11-28 16:53:59");
INSERT INTO digitalpayment_tb VALUES("66","79","130","Transcript of Records","3542916780","first-semester","1","cancel","2023-11-28 17:00:03");
INSERT INTO digitalpayment_tb VALUES("67","79","130","Transcript of Records","2984367501","first-semester","1","cancel","2023-11-28 17:02:57");
INSERT INTO digitalpayment_tb VALUES("68","79","130","Transcript of Records","9476381250","first-semester","1","cancel","2023-11-28 17:11:18");
INSERT INTO digitalpayment_tb VALUES("69","79","130","Transcript of Records","5248936107","first-semester","1","cancel","2023-11-28 17:11:36");
INSERT INTO digitalpayment_tb VALUES("70","79","130","Transcript of Records","5918023476","first-semester","1","cancel","2023-11-28 17:11:51");
INSERT INTO digitalpayment_tb VALUES("71","97","500","Non Bago Fee","8479106235","first-semester","0","accepted","2023-11-30 10:50:49");
INSERT INTO digitalpayment_tb VALUES("72","97","130","Transcript of Records","4391705682","first-semester","0","accepted","2023-11-30 10:55:49");
INSERT INTO digitalpayment_tb VALUES("73","97","100","Certificate of Transfer Crendential","0267514893","first-semester","0","accepted","2023-11-30 10:56:14");
INSERT INTO digitalpayment_tb VALUES("74","111","130","Transcript of Records","8940637512","first-semester","0","accepted","2023-11-30 11:37:13");
INSERT INTO digitalpayment_tb VALUES("75","114","100","Certificate of Transfer Crendential","8693714052","first-semester","1","accepted","2023-11-30 13:08:44");
INSERT INTO digitalpayment_tb VALUES("76","122","500","Non Bago Fee","6279453810","first-semester","0","accepted","2023-11-30 13:48:49");
INSERT INTO digitalpayment_tb VALUES("78","83","130","Transcript of Records","7950231684","first-semester","1","accepted","2023-12-03 09:40:48");
INSERT INTO digitalpayment_tb VALUES("79","83","100","Certificate of Transfer Crendential","7184395602","first-semester","0","accepted","2023-12-03 12:17:08");
INSERT INTO digitalpayment_tb VALUES("80","79","20","Certificate of Enrollment","1083452697","first-semester","0","accepted","2023-12-03 14:50:39");



CREATE TABLE `order_tb` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `teller_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `orderproduct_name` varchar(255) NOT NULL,
  `order_num` varchar(255) NOT NULL,
  `order_productcategory` varchar(255) NOT NULL,
  `order_time` datetime NOT NULL,
  `deadline_time` datetime DEFAULT NULL,
  `order_amount` int(11) NOT NULL,
  `order_quantity` int(11) NOT NULL,
  `num_noti` tinyint(1) DEFAULT NULL,
  `statues` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`order_id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`),
  KEY `teller_id` (`teller_id`),
  CONSTRAINT `order_tb_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_tb` (`user_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  CONSTRAINT `order_tb_ibfk_2` FOREIGN KEY (`teller_id`) REFERENCES `telleruser_tb` (`teller_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=486 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO order_tb VALUES("18","38","1","1","Mountain dew","6383295511","Drinks","2023-08-24 13:05:36","2023-08-24 13:33:21","20","1","1","PROCEED");
INSERT INTO order_tb VALUES("20","38","1","1","Mountain dew","6383295512","Drinks","2023-08-24 13:31:34","2023-08-24 13:41:58","20","1","1","PROCEED");
INSERT INTO order_tb VALUES("28","36","1","10","Coke","6383295516","Drinks","2023-08-26 00:01:47","2023-08-27 10:43:51","20","1","1","PROCEED");
INSERT INTO order_tb VALUES("34","34","1","10","Coke","7914538602","Drinks","2023-08-26 12:14:10","2023-08-26 12:24:35","20","1","1","PROCEED");
INSERT INTO order_tb VALUES("36","34","1","1","Mountain dew","7914538602","Drinks","2023-08-26 12:14:10","2023-08-26 12:24:35","20","1","1","PROCEED");
INSERT INTO order_tb VALUES("41","35","1","1","Mountain dew","1605379842","Drinks","2023-08-27 10:18:10","2023-08-27 10:58:37","20","1","1","PROCEED");
INSERT INTO order_tb VALUES("65","36","1","1","Mountain dew","8063592417","Drinks","2023-08-27 22:40:46","2023-08-27 22:43:07","20","1","1","PROCEED");
INSERT INTO order_tb VALUES("79","34","1","1","Mountain dew","6041327895","Drinks","2023-08-28 00:37:00","2023-08-28 00:48:11","20","1","1","PROCEED");
INSERT INTO order_tb VALUES("96","46","2","26","Fita","1935867402","Biscuit","2023-09-11 13:56:08","","16","2","0","");
INSERT INTO order_tb VALUES("97","46","2","23","Iced Coffee","1935867402","Coolers","2023-09-11 13:56:08","","30","1","0","");
INSERT INTO order_tb VALUES("101","47","2","28","Hansel","0698145237","Biscuit","2023-09-11 14:05:15","","16","2","0","");
INSERT INTO order_tb VALUES("102","47","2","23","Iced Coffee","0698145237","Coolers","2023-09-11 14:05:15","","30","1","0","");
INSERT INTO order_tb VALUES("248","79","1","20","maxx","5213096748","Candy","2023-10-13 09:21:47","2023-10-13 09:52:07","2","1","1","PROCEED");
INSERT INTO order_tb VALUES("249","79","1","56","Le Minerale","5213096748","Drinks","2023-10-13 09:21:47","2023-10-13 09:52:07","20","1","1","PROCEED");
INSERT INTO order_tb VALUES("250","79","1","16","mountain dew","5213096748","Drinks","2023-10-13 09:21:47","2023-10-13 09:52:07","20","1","1","PROCEED");
INSERT INTO order_tb VALUES("251","79","1","20","maxx","0765418239","Candy","2023-10-13 09:40:42","2023-10-13 10:11:07","2","1","1","PROCEED");
INSERT INTO order_tb VALUES("252","79","1","56","Le Minerale","0765418239","Drinks","2023-10-13 09:40:42","2023-10-13 10:11:07","20","1","1","PROCEED");
INSERT INTO order_tb VALUES("253","79","1","16","mountain dew","0765418239","Drinks","2023-10-13 09:40:42","2023-10-13 10:11:07","20","1","1","PROCEED");
INSERT INTO order_tb VALUES("254","79","1","19","showbear","3941605728","Candy","2023-10-13 13:33:25","2023-10-13 14:09:29","2","1","1","PROCEED");
INSERT INTO order_tb VALUES("255","79","1","17","Fita","3941605728","Biscuit","2023-10-13 13:33:25","2023-10-13 14:09:29","8","1","1","PROCEED");
INSERT INTO order_tb VALUES("258","79","1","19","showbear","4629810375","Candy","2023-10-13 15:36:11","2023-10-13 15:39:02","2","1","","CANCELED");
INSERT INTO order_tb VALUES("259","79","1","18","Hansel","4629810375","Biscuit","2023-10-13 15:36:11","2023-10-13 15:39:02","7","1","","CANCELED");
INSERT INTO order_tb VALUES("260","79","1","19","showbear","1897643502","Candy","2023-10-13 15:36:40","2023-10-13 15:37:30","2","1","1","CANCELED");
INSERT INTO order_tb VALUES("261","79","1","17","Fita","1897643502","Biscuit","2023-10-13 15:36:40","2023-10-13 15:37:30","8","1","1","CANCELED");
INSERT INTO order_tb VALUES("264","79","1","56","Le Minerale","6705314928","Drinks","2023-10-13 15:43:15","2023-10-13 15:43:33","20","1","1","CANCELED");
INSERT INTO order_tb VALUES("265","79","1","19","showbear","6705314928","Candy","2023-10-13 15:43:15","2023-10-13 15:43:33","2","1","1","CANCELED");
INSERT INTO order_tb VALUES("266","79","1","56","Le Minerale","0698243715","Drinks","2023-10-13 15:48:42","2023-10-13 15:56:46","20","1","1","CANCELED");
INSERT INTO order_tb VALUES("267","79","1","19","showbear","0698243715","Candy","2023-10-13 15:48:42","2023-10-13 15:56:46","2","1","1","CANCELED");
INSERT INTO order_tb VALUES("268","79","1","22","Nature Spring","2960831754","Drinks","2023-10-13 15:54:23","2023-10-13 15:54:54","20","1","1","CANCELED");
INSERT INTO order_tb VALUES("269","79","1","56","Le Minerale","2960831754","Drinks","2023-10-13 15:54:23","2023-10-13 15:54:54","20","1","1","CANCELED");
INSERT INTO order_tb VALUES("270","79","1","16","mountain dew","8470132659","Drinks","2023-10-13 15:55:34","2023-10-13 15:55:59","20","1","1","CANCELED");
INSERT INTO order_tb VALUES("271","79","1","56","Le Minerale","0893647125","Drinks","2023-10-13 15:56:59","2023-10-13 16:28:33","20","1","1","PROCEED");
INSERT INTO order_tb VALUES("272","79","1","19","showbear","0893647125","Candy","2023-10-13 15:56:59","2023-10-13 16:28:33","2","1","1","PROCEED");
INSERT INTO order_tb VALUES("273","79","1","56","Le Minerale","7098635142","Drinks","2023-10-18 11:14:17","2023-10-18 11:15:14","20","1","1","CANCELED");
INSERT INTO order_tb VALUES("274","79","1","16","mountain dew","7098635142","Drinks","2023-10-18 11:14:17","2023-10-18 11:15:14","20","1","1","CANCELED");
INSERT INTO order_tb VALUES("275","79","1","19","showbear","2814603975","Candy","2023-10-23 15:40:20","2023-11-07 01:17:21","2","1","1","PROCEED");
INSERT INTO order_tb VALUES("276","79","1","18","Hansel","2814603975","Biscuit","2023-10-23 15:40:20","2023-11-07 01:17:21","7","1","1","PROCEED");
INSERT INTO order_tb VALUES("277","79","1","56","Le Minerale","7560129348","Drinks","2023-11-07 00:16:45","2023-11-07 00:53:44","20","1","1","PROCEED");
INSERT INTO order_tb VALUES("278","79","1","16","mountain dew","7560129348","Drinks","2023-11-07 00:16:45","2023-11-07 00:53:44","15","1","1","PROCEED");
INSERT INTO order_tb VALUES("279","79","1","56","Le Minerale","3842617590","Drinks","2023-11-07 00:38:31","2023-11-07 01:32:42","20","1","1","PROCEED");
INSERT INTO order_tb VALUES("280","79","1","18","Hansel","3842617590","Biscuit","2023-11-07 00:38:31","2023-11-07 01:32:42","7","1","1","PROCEED");
INSERT INTO order_tb VALUES("281","79","1","19","showbear","3650147298","Candy","2023-11-12 00:59:57","2023-11-12 01:30:35","2","1","1","PROCEED");
INSERT INTO order_tb VALUES("282","79","1","16","mountain dew","3650147298","Drinks","2023-11-12 00:59:57","2023-11-12 01:30:35","15","1","1","PROCEED");
INSERT INTO order_tb VALUES("283","79","1","17","Fita","9283756401","Biscuit","2023-11-13 13:34:11","2023-12-01 12:26:22","8","1","1","CANCELED");
INSERT INTO order_tb VALUES("284","79","1","21","Dutch Mill","8392106475","Drinks","2023-11-13 13:34:55","2023-12-01 12:26:19","50","2","1","CANCELED");
INSERT INTO order_tb VALUES("285","79","1","18","Hansel","8392106475","Biscuit","2023-11-13 13:34:55","2023-12-01 12:26:19","14","2","1","CANCELED");
INSERT INTO order_tb VALUES("286","90","1","21","Dutch Mill","7125834069","Drinks","2023-11-16 10:40:07","2023-11-16 10:41:41","25","1","1","PROCEED");
INSERT INTO order_tb VALUES("287","90","1","17","Fita","7125834069","Biscuit","2023-11-16 10:40:07","2023-11-16 10:41:41","16","2","1","PROCEED");
INSERT INTO order_tb VALUES("288","90","1","16","mountain dew","7125834069","Drinks","2023-11-16 10:40:07","2023-11-16 10:41:41","15","1","1","PROCEED");
INSERT INTO order_tb VALUES("289","79","1","0","","7698412503","","2023-11-17 15:20:56","2023-11-17 15:20:56","50","0","1","PURCHASE");
INSERT INTO order_tb VALUES("290","79","1","16","mountain dew","1967308425","Drinks","2023-11-23 16:54:01","2023-12-01 12:26:16","30","2","1","CANCELED");
INSERT INTO order_tb VALUES("291","79","1","18","Hansel","1967308425","Biscuit","2023-11-23 16:54:01","2023-12-01 12:26:16","21","3","1","CANCELED");
INSERT INTO order_tb VALUES("292","79","1","18","Hansel","2956731840","Biscuit","2023-11-24 12:17:02","2023-12-01 12:26:09","7","1","1","CANCELED");
INSERT INTO order_tb VALUES("293","79","1","16","mountain dew","2956731840","Drinks","2023-11-24 12:17:02","2023-12-01 12:26:09","15","1","1","CANCELED");
INSERT INTO order_tb VALUES("294","83","1","16","mountain dew","5319862704","Drinks","2023-11-28 13:44:32","","15","1","","");
INSERT INTO order_tb VALUES("295","83","1","57","rare object","8324095716","Candy","2023-11-28 15:37:22","2023-11-28 15:50:51","5","1","1","PROCEED");
INSERT INTO order_tb VALUES("296","79","1","57","rare object","2486910735","Candy","2023-11-28 15:41:59","2023-11-28 15:42:25","45","9","1","CANCELED");
INSERT INTO order_tb VALUES("297","83","1","0","","3691428507","","2023-11-30 09:42:51","2023-11-30 09:42:51","20","0","1","PURCHASE");
INSERT INTO order_tb VALUES("298","79","1","0","","3725806194","","2023-11-30 09:43:30","2023-11-30 09:43:30","30","0","1","PURCHASE");
INSERT INTO order_tb VALUES("299","79","1","0","","9718345026","","2023-11-30 09:46:42","2023-11-30 09:46:42","30","0","1","PURCHASE");
INSERT INTO order_tb VALUES("300","79","1","0","","2730891456","","2023-11-30 09:47:27","2023-11-30 09:47:27","30","0","1","PURCHASE");
INSERT INTO order_tb VALUES("301","79","1","0","","4370196825","","2023-11-30 09:48:26","2023-11-30 09:48:26","30","0","1","PURCHASE");
INSERT INTO order_tb VALUES("302","83","1","16","mountain dew","4870129635","Drinks","2023-11-30 09:59:26","","15","1","","");
INSERT INTO order_tb VALUES("303","83","1","17","Fita","4625970318","Biscuits","2023-11-30 10:03:18","2023-11-30 10:09:26","8","1","1","PROCEED");
INSERT INTO order_tb VALUES("304","83","1","21","Dutch Mill","4625970318","Drinks","2023-11-30 10:03:18","2023-11-30 10:09:26","25","1","1","PROCEED");
INSERT INTO order_tb VALUES("305","83","1","16","mountain dew","4625970318","Drinks","2023-11-30 10:03:18","2023-11-30 10:09:26","30","2","1","PROCEED");
INSERT INTO order_tb VALUES("306","83","1","61","Cream-o","8245903176","Biscuits","2023-11-30 10:16:01","2023-11-30 10:17:28","10","1","1","CANCELED");
INSERT INTO order_tb VALUES("307","83","1","22","Nature Spring","8245903176","Drinks","2023-11-30 10:16:01","2023-11-30 10:17:28","20","1","1","CANCELED");
INSERT INTO order_tb VALUES("308","83","1","21","Dutch Mill","8245903176","Drinks","2023-11-30 10:16:01","2023-11-30 10:17:28","25","1","1","CANCELED");
INSERT INTO order_tb VALUES("309","83","1","17","Fita","8245903176","Biscuits","2023-11-30 10:16:01","2023-11-30 10:17:28","8","1","1","CANCELED");
INSERT INTO order_tb VALUES("310","83","1","16","mountain dew","8245903176","Drinks","2023-11-30 10:16:01","2023-11-30 10:17:28","15","1","1","CANCELED");
INSERT INTO order_tb VALUES("311","83","1","0","","8906412753","","2023-11-30 10:20:47","2023-11-30 10:20:47","20","0","1","PURCHASE");
INSERT INTO order_tb VALUES("312","83","1","0","","0816534729","","2023-11-30 10:20:47","2023-11-30 10:20:47","20","0","1","PURCHASE");
INSERT INTO order_tb VALUES("313","83","1","0","","0231978546","","2023-11-30 10:20:47","2023-11-30 10:20:47","20","0","1","PURCHASE");
INSERT INTO order_tb VALUES("314","83","1","0","","9572613840","","2023-11-30 10:20:47","2023-11-30 10:20:47","20","0","1","PURCHASE");
INSERT INTO order_tb VALUES("315","83","1","0","","1240935768","","2023-11-30 10:20:47","2023-11-30 10:20:47","20","0","1","PURCHASE");
INSERT INTO order_tb VALUES("316","83","1","0","","6089713254","","2023-11-30 10:20:47","2023-11-30 10:20:47","20","0","1","PURCHASE");
INSERT INTO order_tb VALUES("317","83","1","0","","8279604351","","2023-11-30 10:20:47","2023-11-30 10:20:47","20","0","1","PURCHASE");
INSERT INTO order_tb VALUES("318","83","1","0","","2975804361","","2023-11-30 10:20:47","2023-11-30 10:20:47","20","0","1","PURCHASE");
INSERT INTO order_tb VALUES("319","83","1","0","","5627149380","","2023-11-30 10:20:47","2023-11-30 10:20:47","20","0","1","PURCHASE");
INSERT INTO order_tb VALUES("320","83","1","0","","3456719208","","2023-11-30 10:20:47","2023-11-30 10:20:47","20","0","1","PURCHASE");
INSERT INTO order_tb VALUES("321","83","1","0","","6359742180","","2023-11-30 10:20:47","2023-11-30 10:20:47","20","0","1","PURCHASE");
INSERT INTO order_tb VALUES("322","93","1","18","Hansel","9403182576","Biscuits","2023-11-30 10:32:01","","7","1","","");
INSERT INTO order_tb VALUES("323","93","1","19","snowbear","9403182576","Candy","2023-11-30 10:32:01","","2","1","","");
INSERT INTO order_tb VALUES("324","83","1","16","mountain dew","4325860917","Drinks","2023-11-30 10:51:12","","15","1","","");
INSERT INTO order_tb VALUES("325","98","1","16","mountain dew","0197682453","Drinks","2023-11-30 10:54:02","2023-11-30 10:57:21","15","1","1","CANCELED");
INSERT INTO order_tb VALUES("326","98","1","17","Fita","3698150247","Biscuits","2023-11-30 10:54:40","2023-11-30 12:05:24","8","1","1","PROCEED");
INSERT INTO order_tb VALUES("327","98","1","18","Hansel","3698150247","Biscuits","2023-11-30 10:54:40","2023-11-30 12:05:24","7","1","1","PROCEED");
INSERT INTO order_tb VALUES("328","97","4","44","Wet wipes","4708612953","Necessities","2023-11-30 10:55:10","","20","1","","");
INSERT INTO order_tb VALUES("329","97","4","43","Sanitary pads","4708612953","Necessities","2023-11-30 10:55:10","","8","1","","");
INSERT INTO order_tb VALUES("330","97","3","31","Nova","4708612953","Curls","2023-11-30 10:55:10","","15","1","","");
INSERT INTO order_tb VALUES("331","97","2","28","Hansel","4708612953","Biscuit ","2023-11-30 10:55:10","","8","1","","");
INSERT INTO order_tb VALUES("332","97","2","23","Iced Coffee","4708612953","Coolers","2023-11-30 10:55:10","","30","1","","");
INSERT INTO order_tb VALUES("333","97","1","61","Cream-o","4708612953","Biscuits","2023-11-30 10:55:10","2023-11-30 10:56:53","10","1","1","CANCELED");
INSERT INTO order_tb VALUES("334","97","1","60","Shawarma Rice","4708612953","Meals","2023-11-30 10:55:10","2023-11-30 10:56:53","40","1","1","CANCELED");
INSERT INTO order_tb VALUES("335","97","1","22","Nature Spring","4708612953","Drinks","2023-11-30 10:55:10","2023-11-30 10:56:53","20","1","1","CANCELED");
INSERT INTO order_tb VALUES("336","97","1","21","Dutch Mill","4708612953","Drinks","2023-11-30 10:55:10","2023-11-30 10:56:53","25","1","1","CANCELED");
INSERT INTO order_tb VALUES("337","98","1","16","mountain dew","8056413927","Drinks","2023-11-30 10:55:11","2023-11-30 12:06:36","60","4","1","ACCEPTED");
INSERT INTO order_tb VALUES("338","98","1","17","Fita","8056413927","Biscuits","2023-11-30 10:55:11","2023-11-30 12:06:36","8","1","1","ACCEPTED");
INSERT INTO order_tb VALUES("339","98","1","19","snowbear","8056413927","Candy","2023-11-30 10:55:11","2023-11-30 12:06:36","2","1","1","ACCEPTED");
INSERT INTO order_tb VALUES("340","98","1","18","Hansel","8056413927","Biscuits","2023-11-30 10:55:11","2023-11-30 12:06:36","7","1","1","ACCEPTED");
INSERT INTO order_tb VALUES("341","98","1","20","maxx","8056413927","Candy","2023-11-30 10:55:11","2023-11-30 12:06:36","2","1","1","ACCEPTED");
INSERT INTO order_tb VALUES("342","98","1","21","Dutch Mill","8056413927","Drinks","2023-11-30 10:55:11","2023-11-30 12:06:36","25","1","1","ACCEPTED");
INSERT INTO order_tb VALUES("343","98","1","56","Le Minerale","8056413927","Drinks","2023-11-30 10:55:11","2023-11-30 12:06:36","20","1","1","ACCEPTED");
INSERT INTO order_tb VALUES("344","98","1","22","Nature Spring","8056413927","Drinks","2023-11-30 10:55:11","2023-11-30 12:06:36","20","1","1","ACCEPTED");
INSERT INTO order_tb VALUES("345","98","1","61","Cream-o","8056413927","Biscuits","2023-11-30 10:55:11","2023-11-30 12:06:36","10","1","1","ACCEPTED");
INSERT INTO order_tb VALUES("346","98","1","58","Egg Omelette","8056413927","Meals","2023-11-30 10:55:11","2023-11-30 12:06:36","15","1","1","ACCEPTED");
INSERT INTO order_tb VALUES("347","98","1","60","Shawarma Rice","8056413927","Meals","2023-11-30 10:55:11","2023-11-30 12:06:36","40","1","1","ACCEPTED");
INSERT INTO order_tb VALUES("348","98","2","23","Iced Coffee","9780163245","Coolers","2023-11-30 10:57:09","","150","5","","");
INSERT INTO order_tb VALUES("349","98","2","24","Apple","9780163245","Fruits","2023-11-30 10:57:09","","15","1","","");
INSERT INTO order_tb VALUES("350","98","2","26","Fita","9780163245","Biscuit ","2023-11-30 10:57:09","","8","1","","");
INSERT INTO order_tb VALUES("351","98","2","25","Lemonade","9780163245","Coolers","2023-11-30 10:57:09","","15","1","","");
INSERT INTO order_tb VALUES("352","98","2","55","Cream-o","9780163245","Biscuit ","2023-11-30 10:57:09","","9","1","","");
INSERT INTO order_tb VALUES("353","98","2","28","Hansel","9780163245","Biscuit ","2023-11-30 10:57:09","","8","1","","");
INSERT INTO order_tb VALUES("354","98","2","29","Orange","9780163245","Fruits","2023-11-30 10:57:09","","13","1","","");
INSERT INTO order_tb VALUES("355","98","2","54","Gulaman","9780163245","Coolers","2023-11-30 10:57:09","","15","1","","");
INSERT INTO order_tb VALUES("356","102","1","61","Cream-o","5170642938","Biscuits","2023-11-30 11:06:01","","10","1","","");
INSERT INTO order_tb VALUES("357","102","1","16","mountain dew","5170642938","Drinks","2023-11-30 11:06:01","","15","1","","");
INSERT INTO order_tb VALUES("358","102","1","60","Shawarma Rice","5170642938","Meals","2023-11-30 11:06:01","","40","1","","");
INSERT INTO order_tb VALUES("359","108","1","60","Shawarma Rice","2084713569","Meals","2023-11-30 11:07:01","","40","1","","");
INSERT INTO order_tb VALUES("360","108","1","60","Shawarma Rice","1893254067","Meals","2023-11-30 11:08:03","2023-12-01 16:39:01","40","1","1","CANCELED");
INSERT INTO order_tb VALUES("361","101","2","23","Iced Coffee","5430897126","Coolers","2023-11-30 11:08:12","","60","2","","");
INSERT INTO order_tb VALUES("362","101","1","19","snowbear","5430897126","Candy","2023-11-30 11:08:12","","2","1","","");
INSERT INTO order_tb VALUES("363","101","1","16","mountain dew","5430897126","Drinks","2023-11-30 11:08:12","","30","2","","");
INSERT INTO order_tb VALUES("364","113","1","60","Shawarma Rice","4968751302","Meals","2023-11-30 11:33:36","2023-11-30 12:44:48","40","1","1","ACCEPTED");
INSERT INTO order_tb VALUES("365","113","1","61","Cream-o","4968751302","Biscuits","2023-11-30 11:33:36","2023-11-30 12:44:48","10","1","1","ACCEPTED");
INSERT INTO order_tb VALUES("366","113","1","18","Hansel","4968751302","Biscuits","2023-11-30 11:33:36","2023-11-30 12:44:48","7","1","1","ACCEPTED");
INSERT INTO order_tb VALUES("367","113","1","56","Le Minerale","4968751302","Drinks","2023-11-30 11:33:36","2023-11-30 12:44:48","20","1","1","ACCEPTED");
INSERT INTO order_tb VALUES("368","113","1","16","mountain dew","4968751302","Drinks","2023-11-30 11:33:36","2023-11-30 12:44:48","15","1","1","ACCEPTED");
INSERT INTO order_tb VALUES("369","111","1","58","Egg Omelette","2695310478","Meals","2023-11-30 11:34:49","2023-11-30 11:35:07","15","1","1","CANCELED");
INSERT INTO order_tb VALUES("370","111","1","61","Cream-o","2695310478","Biscuits","2023-11-30 11:34:49","2023-11-30 11:35:07","10","1","1","CANCELED");
INSERT INTO order_tb VALUES("371","111","1","62","Sky Flakes","2695310478","Biscuits","2023-11-30 11:34:49","2023-11-30 11:35:07","9","1","1","CANCELED");
INSERT INTO order_tb VALUES("372","111","1","60","Shawarma Rice","2695310478","Meals","2023-11-30 11:34:49","2023-11-30 11:35:07","40","1","1","CANCELED");
INSERT INTO order_tb VALUES("373","111","1","56","Le Minerale","2695310478","Drinks","2023-11-30 11:34:49","2023-11-30 11:35:07","20","1","1","CANCELED");
INSERT INTO order_tb VALUES("374","111","1","22","Nature Spring","2695310478","Drinks","2023-11-30 11:34:49","2023-11-30 11:35:07","20","1","1","CANCELED");
INSERT INTO order_tb VALUES("375","111","1","16","mountain dew","2695310478","Drinks","2023-11-30 11:34:49","2023-11-30 11:35:07","15","1","1","CANCELED");
INSERT INTO order_tb VALUES("376","111","1","19","snowbear","2695310478","Candy","2023-11-30 11:34:49","2023-11-30 11:35:07","2","1","1","CANCELED");
INSERT INTO order_tb VALUES("377","111","1","18","Hansel","2695310478","Biscuits","2023-11-30 11:34:49","2023-11-30 11:35:07","7","1","1","CANCELED");
INSERT INTO order_tb VALUES("378","111","1","17","Fita","2695310478","Biscuits","2023-11-30 11:34:49","2023-11-30 11:35:07","8","1","1","CANCELED");
INSERT INTO order_tb VALUES("379","110","1","21","Dutch Mill","2079483561","Drinks","2023-11-30 11:34:58","2023-12-01 16:25:20","25","1","1","ACCEPTED");
INSERT INTO order_tb VALUES("380","110","1","19","snowbear","2079483561","Candy","2023-11-30 11:34:58","2023-12-01 16:25:20","2","1","1","ACCEPTED");
INSERT INTO order_tb VALUES("381","110","1","18","Hansel","2079483561","Biscuits","2023-11-30 11:34:58","2023-12-01 16:25:20","7","1","1","ACCEPTED");
INSERT INTO order_tb VALUES("382","110","1","17","Fita","2079483561","Biscuits","2023-11-30 11:34:58","2023-12-01 16:25:20","8","1","1","ACCEPTED");
INSERT INTO order_tb VALUES("383","110","1","16","mountain dew","2079483561","Drinks","2023-11-30 11:34:58","2023-12-01 16:25:20","15","1","1","ACCEPTED");
INSERT INTO order_tb VALUES("384","111","1","22","Nature Spring","5231708964","Drinks","2023-11-30 11:35:57","2023-12-01 12:55:24","20","1","1","ACCEPTED");
INSERT INTO order_tb VALUES("385","111","1","21","Dutch Mill","5231708964","Drinks","2023-11-30 11:35:57","2023-12-01 12:55:24","25","1","1","ACCEPTED");
INSERT INTO order_tb VALUES("386","111","1","18","Hansel","5231708964","Biscuits","2023-11-30 11:35:57","2023-12-01 12:55:24","7","1","1","ACCEPTED");
INSERT INTO order_tb VALUES("387","111","1","16","mountain dew","5231708964","Drinks","2023-11-30 11:35:57","2023-12-01 12:55:24","15","1","1","ACCEPTED");
INSERT INTO order_tb VALUES("388","111","1","17","Fita","5231708964","Biscuits","2023-11-30 11:35:57","2023-12-01 12:55:24","8","1","1","ACCEPTED");
INSERT INTO order_tb VALUES("389","110","3","49","XO","5890672314","Candies","2023-11-30 11:39:21","","10","10","","");
INSERT INTO order_tb VALUES("390","110","3","34","Chuckie","5890672314","Drinks","2023-11-30 11:39:21","","40","2","","");
INSERT INTO order_tb VALUES("391","110","3","51","V-fresh","5890672314","Candies","2023-11-30 11:39:21","","5","5","","");
INSERT INTO order_tb VALUES("392","110","3","50","Yakult","5890672314","Drinks","2023-11-30 11:39:21","","30","3","","");
INSERT INTO order_tb VALUES("393","120","1","16","mountain dew","3928650741","Drinks","2023-11-30 13:50:38","2023-11-30 15:31:39","50","2","1","ACCEPTED");
INSERT INTO order_tb VALUES("394","120","1","60","Shawarma Rice","3928650741","Meals","2023-11-30 13:50:38","2023-11-30 15:31:39","40","1","1","ACCEPTED");
INSERT INTO order_tb VALUES("395","127","2","25","Lemonade","9312875604","Coolers","2023-11-30 14:23:41","","15","1","","");
INSERT INTO order_tb VALUES("396","127","2","23","Iced Coffee","9312875604","Coolers","2023-11-30 14:23:41","","30","1","","");
INSERT INTO order_tb VALUES("397","86","1","56","Le Minerale","4378205916","Drinks","2023-11-30 14:25:46","2023-11-30 15:41:15","20","1","1","PROCEED");
INSERT INTO order_tb VALUES("398","86","1","60","Shawarma Rice","4378205916","Meals","2023-11-30 14:25:46","2023-11-30 15:41:15","40","1","1","PROCEED");
INSERT INTO order_tb VALUES("399","79","1","56","Le Minerale","3120945867","Drinks","2023-12-01 10:56:32","2023-12-01 12:23:48","20","1","1","PROCEED");
INSERT INTO order_tb VALUES("400","79","1","19","snowbear","3120945867","Candy","2023-12-01 10:56:32","2023-12-01 12:23:48","1","1","1","PROCEED");
INSERT INTO order_tb VALUES("401","79","1","56","Le Minerale","5041823697","Drinks","2023-12-01 12:30:07","2023-12-01 12:30:25","20","1","1","CANCELED");
INSERT INTO order_tb VALUES("402","79","1","16","mountain dew","5041823697","Drinks","2023-12-01 12:30:07","2023-12-01 12:30:25","25","1","1","CANCELED");
INSERT INTO order_tb VALUES("403","79","1","19","snowbear","0278935164","Candy","2023-12-01 16:21:32","2023-12-01 16:23:41","1","1","1","PROCEED");
INSERT INTO order_tb VALUES("404","79","1","17","Fita","0278935164","Biscuits","2023-12-01 16:21:32","2023-12-01 16:23:41","8","1","1","PROCEED");
INSERT INTO order_tb VALUES("405","79","1","60","Shawarma Rice","5913402867","Meals","2023-12-01 16:24:50","2023-12-01 16:26:10","40","1","1","PROCEED");
INSERT INTO order_tb VALUES("406","79","1","56","Le Minerale","5913402867","Drinks","2023-12-01 16:24:50","2023-12-01 16:26:10","20","1","1","PROCEED");
INSERT INTO order_tb VALUES("407","79","1","16","mountain dew","9025176834","Drinks","2023-12-01 16:27:06","2023-12-01 16:28:29","25","1","1","PROCEED");
INSERT INTO order_tb VALUES("408","79","1","19","snowbear","9025176834","Candy","2023-12-01 16:27:06","2023-12-01 16:28:29","5","5","1","PROCEED");
INSERT INTO order_tb VALUES("409","79","1","17","Fita","5349876012","Biscuits","2023-12-01 21:15:45","2023-12-01 23:27:47","8","1","1","ACCEPTED");
INSERT INTO order_tb VALUES("410","79","1","16","mountain dew","5349876012","Drinks","2023-12-01 21:15:45","2023-12-01 23:27:47","25","1","1","ACCEPTED");
INSERT INTO order_tb VALUES("411","79","1","16","mountain dew","2340657891","Drinks","2023-12-01 21:36:08","2023-12-01 23:20:16","25","1","1","PROCEED");
INSERT INTO order_tb VALUES("412","79","1","17","Fita","2340657891","Biscuits","2023-12-01 21:36:09","2023-12-01 23:20:16","8","1","1","PROCEED");
INSERT INTO order_tb VALUES("413","79","1","16","mountain dew","1652703948","Drinks","2023-12-01 23:21:37","2023-12-01 23:23:12","25","1","1","ACCEPTED");
INSERT INTO order_tb VALUES("414","79","1","18","Hansel","1652703948","Biscuits","2023-12-01 23:21:37","2023-12-01 23:23:12","7","1","1","ACCEPTED");
INSERT INTO order_tb VALUES("415","79","1","56","Le Minerale","8573901426","Drinks","2023-12-02 11:22:43","2023-12-02 11:37:00","20","1","1","PROCEED");
INSERT INTO order_tb VALUES("416","79","1","16","mountain dew","8573901426","Drinks","2023-12-02 11:22:43","2023-12-02 11:37:00","25","1","1","PROCEED");
INSERT INTO order_tb VALUES("417","79","1","16","mountain dew","8750632194","Drinks","2023-12-02 11:37:02","2023-12-02 12:08:23","25","1","1","PROCEED");
INSERT INTO order_tb VALUES("418","79","1","18","Hansel","8750632194","Biscuits","2023-12-02 11:37:02","2023-12-02 12:08:23","7","1","1","PROCEED");
INSERT INTO order_tb VALUES("419","79","1","19","snowbear","9048126573","Candy","2023-12-02 12:11:40","2023-12-02 12:41:50","1","1","1","PROCEED");
INSERT INTO order_tb VALUES("420","79","1","21","Dutch Mill","9048126573","Drinks","2023-12-02 12:11:40","2023-12-02 12:41:50","25","1","1","PROCEED");
INSERT INTO order_tb VALUES("421","79","1","56","Le Minerale","1074362895","Drinks","2023-12-02 12:21:38","2023-12-02 12:56:27","20","1","1","PROCEED");
INSERT INTO order_tb VALUES("422","79","1","16","mountain dew","1074362895","Drinks","2023-12-02 12:21:38","2023-12-02 12:56:27","25","1","1","PROCEED");
INSERT INTO order_tb VALUES("423","79","1","18","Hansel","8309165247","Biscuits","2023-12-02 12:57:00","2023-12-02 12:58:13","7","1","1","PROCEED");
INSERT INTO order_tb VALUES("424","79","1","16","mountain dew","8309165247","Drinks","2023-12-02 12:57:00","2023-12-02 12:58:13","25","1","1","PROCEED");
INSERT INTO order_tb VALUES("425","79","1","62","Sky Flakes","0168759423","Biscuits","2023-12-02 13:01:00","2023-12-02 13:24:24","9","1","1","CANCELED");
INSERT INTO order_tb VALUES("426","79","1","16","mountain dew","0168759423","Drinks","2023-12-02 13:01:00","2023-12-02 13:24:24","25","1","1","CANCELED");
INSERT INTO order_tb VALUES("427","79","1","56","Le Minerale","1428075639","Drinks","2023-12-02 13:30:39","2023-12-02 21:00:51","20","1","1","ACCEPTED");
INSERT INTO order_tb VALUES("428","79","1","17","Fita","1428075639","Biscuits","2023-12-02 13:30:39","2023-12-02 21:00:51","8","1","1","ACCEPTED");
INSERT INTO order_tb VALUES("429","79","1","17","Fita","8913564702","Biscuits","2023-12-02 21:55:07","2023-12-02 21:55:37","8","1","1","CANCELED");
INSERT INTO order_tb VALUES("430","79","1","16","mountain dew","8913564702","Drinks","2023-12-02 21:55:07","2023-12-02 21:55:37","25","1","1","CANCELED");
INSERT INTO order_tb VALUES("431","79","1","17","Fita","5471603829","Biscuits","2023-12-02 22:35:41","","8","1","1","");
INSERT INTO order_tb VALUES("432","79","1","16","mountain dew","5471603829","Drinks","2023-12-02 22:35:41","","25","1","1","");
INSERT INTO order_tb VALUES("433","79","1","21","Dutch Mill","8106243795","Drinks","2023-12-03 09:43:31","2023-12-03 09:43:50","525","21","1","CANCELED");
INSERT INTO order_tb VALUES("434","79","1","21","Dutch Mill","3675192804","Drinks","2023-12-03 09:50:14","2023-12-03 10:04:19","475","19","1","PROCEED");
INSERT INTO order_tb VALUES("435","79","1","21","Dutch Mill","9483065721","Drinks","2023-12-03 10:15:37","2023-12-03 10:15:52","275","11","1","CANCELED");
INSERT INTO order_tb VALUES("436","83","1","20","maxx","4687913025","Candy","2023-12-03 11:34:29","2023-12-03 11:40:34","1","1","1","PROCEED");
INSERT INTO order_tb VALUES("437","83","1","21","Dutch Mill","4687913025","Drinks","2023-12-03 11:34:29","2023-12-03 11:40:34","25","1","1","PROCEED");
INSERT INTO order_tb VALUES("438","83","1","16","mountain dew","4687913025","Drinks","2023-12-03 11:34:29","2023-12-03 11:40:34","25","1","1","PROCEED");
INSERT INTO order_tb VALUES("439","83","1","18","Hansel","6471395208","Biscuits","2023-12-03 11:37:39","2023-12-03 11:39:08","7","1","1","PROCEED");
INSERT INTO order_tb VALUES("440","90","1","20","maxx","7683210495","Candy","2023-12-03 12:24:34","2023-12-03 12:26:04","5","5","1","PROCEED");
INSERT INTO order_tb VALUES("441","90","1","21","Dutch Mill","7683210495","Drinks","2023-12-03 12:24:34","2023-12-03 12:26:04","25","1","1","PROCEED");
INSERT INTO order_tb VALUES("442","90","1","61","Cream-o","7683210495","Biscuits","2023-12-03 12:24:34","2023-12-03 12:26:04","10","1","1","PROCEED");
INSERT INTO order_tb VALUES("443","90","1","17","Fita","4615230978","Biscuits","2023-12-03 12:25:40","2023-12-03 12:26:56","8","1","1","PROCEED");
INSERT INTO order_tb VALUES("444","90","1","16","mountain dew","1258403697","Drinks","2023-12-03 12:29:36","2023-12-03 12:30:51","25","1","1","PROCEED");
INSERT INTO order_tb VALUES("445","90","1","58","Egg Omelette","4301596827","Meals","2023-12-03 12:54:31","2023-12-03 12:59:43","135","9","1","PROCEED");
INSERT INTO order_tb VALUES("446","83","1","56","Le Minerale","7346981025","Drinks","2023-12-03 12:54:43","2023-12-03 12:58:03","20","1","1","PROCEED");
INSERT INTO order_tb VALUES("447","83","1","22","Nature Spring","7346981025","Drinks","2023-12-03 12:54:43","2023-12-03 12:58:03","40","2","1","PROCEED");
INSERT INTO order_tb VALUES("448","83","1","21","Dutch Mill","7346981025","Drinks","2023-12-03 12:54:43","2023-12-03 12:58:03","25","1","1","PROCEED");
INSERT INTO order_tb VALUES("449","83","1","20","maxx","7346981025","Candy","2023-12-03 12:54:43","2023-12-03 12:58:03","1","1","1","PROCEED");
INSERT INTO order_tb VALUES("450","83","1","60","Shawarma Rice","7346981025","Meals","2023-12-03 12:54:43","2023-12-03 12:58:03","120","3","1","PROCEED");
INSERT INTO order_tb VALUES("451","90","1","21","Dutch Mill","9742531608","Drinks","2023-12-03 12:57:34","2023-12-03 13:02:54","25","1","1","PROCEED");
INSERT INTO order_tb VALUES("452","90","1","22","Nature Spring","9742531608","Drinks","2023-12-03 12:57:34","2023-12-03 13:02:54","20","1","1","PROCEED");
INSERT INTO order_tb VALUES("453","90","1","18","Hansel","9742531608","Biscuits","2023-12-03 12:57:34","2023-12-03 13:02:54","7","1","1","PROCEED");
INSERT INTO order_tb VALUES("454","83","1","56","Le Minerale","3527964810","Drinks","2023-12-03 13:00:03","2023-12-03 13:01:11","20","1","0","PROCEED");
INSERT INTO order_tb VALUES("455","83","1","20","maxx","3527964810","Candy","2023-12-03 13:00:03","2023-12-03 13:01:11","1","1","0","PROCEED");
INSERT INTO order_tb VALUES("456","83","1","60","Shawarma Rice","3527964810","Meals","2023-12-03 13:00:03","2023-12-03 13:01:11","40","1","0","PROCEED");
INSERT INTO order_tb VALUES("457","90","1","16","mountain dew","9207615438","Drinks","2023-12-03 13:12:57","2023-12-03 13:14:42","1500","60","1","PROCEED");
INSERT INTO order_tb VALUES("458","90","1","60","Shawarma Rice","9207615438","Meals","2023-12-03 13:12:57","2023-12-03 13:14:42","280","7","1","PROCEED");
INSERT INTO order_tb VALUES("459","90","1","19","snowbear","8325601479","Candy","2023-12-03 13:13:14","2023-12-03 13:14:42","4","4","0","PROCEED");
INSERT INTO order_tb VALUES("460","79","1","19","snowbear","4015829376","Candy","2023-12-03 13:19:31","2023-12-03 13:22:05","1","1","1","PROCEED");
INSERT INTO order_tb VALUES("461","79","1","58","Egg Omelette","4015829376","Meals","2023-12-03 13:19:31","2023-12-03 13:22:05","15","1","1","PROCEED");
INSERT INTO order_tb VALUES("462","83","1","16","mountain dew","1346209857","Drinks","2023-12-03 13:25:39","2023-12-03 13:26:47","25","1","0","PROCEED");
INSERT INTO order_tb VALUES("463","83","1","17","Fita","4607513289","Biscuits","2023-12-03 13:26:15","2023-12-03 13:27:28","8","1","0","PROCEED");
INSERT INTO order_tb VALUES("464","79","1","20","maxx","3570821694","Candy","2023-12-03 14:30:52","2023-12-03 14:33:37","1","1","1","PROCEED");
INSERT INTO order_tb VALUES("465","79","1","17","Fita","3570821694","Biscuits","2023-12-03 14:30:52","2023-12-03 14:33:37","8","1","1","PROCEED");
INSERT INTO order_tb VALUES("466","79","3","49","XO","4906238157","Candies","2023-12-03 14:53:03","","1","1","","");
INSERT INTO order_tb VALUES("467","79","3","30","Patata","4906238157","Curls","2023-12-03 14:53:03","","8","1","","");
INSERT INTO order_tb VALUES("468","79","1","22","Nature Spring","4906238157","Drinks","2023-12-03 14:53:03","","20","1","","");
INSERT INTO order_tb VALUES("469","79","1","16","mountain dew","4906238157","Drinks","2023-12-03 14:53:03","","25","1","","");
INSERT INTO order_tb VALUES("470","79","3","51","V-fresh","5817469320","Candies","2023-12-03 14:53:28","","1","1","","");
INSERT INTO order_tb VALUES("471","79","3","32","Cracklings","5817469320","Curls","2023-12-03 14:53:28","","9","1","","");
INSERT INTO order_tb VALUES("472","79","1","56","Le Minerale","5817469320","Drinks","2023-12-03 14:53:28","2023-12-03 15:29:25","20","1","0","PROCEED");
INSERT INTO order_tb VALUES("473","79","1","16","mountain dew","5817469320","Drinks","2023-12-03 14:53:28","2023-12-03 15:29:25","25","1","0","PROCEED");
INSERT INTO order_tb VALUES("474","79","2","29","Orange","0278314956","Fruits","2023-12-03 14:53:48","","13","1","","");
INSERT INTO order_tb VALUES("475","79","2","24","Apple","0278314956","Fruits","2023-12-03 14:53:48","","15","1","","");
INSERT INTO order_tb VALUES("476","79","1","0","","1263094578","","2023-12-03 15:00:18","2023-12-03 15:00:18","50","0","1","PURCHASE");
INSERT INTO order_tb VALUES("477","79","1","0","","5892037641","","2023-12-03 15:01:27","2023-12-03 15:01:27","50","0","1","PURCHASE");
INSERT INTO order_tb VALUES("478","79","1","0","","8520364197","","2023-12-03 15:01:27","2023-12-03 15:01:27","50","0","1","PURCHASE");
INSERT INTO order_tb VALUES("479","79","1","0","","2830947561","","2023-12-03 15:01:27","2023-12-03 15:01:27","50","0","1","PURCHASE");
INSERT INTO order_tb VALUES("480","79","1","0","","6904871523","","2023-12-03 15:01:27","2023-12-03 15:01:27","50","0","1","PURCHASE");
INSERT INTO order_tb VALUES("481","79","1","0","","6732815940","","2023-12-03 15:01:27","2023-12-03 15:01:27","50","0","1","PURCHASE");
INSERT INTO order_tb VALUES("482","79","1","0","","6172983504","","2023-12-03 15:01:27","2023-12-03 15:01:27","50","0","1","PURCHASE");
INSERT INTO order_tb VALUES("483","79","1","0","","7095134286","","2023-12-03 15:01:27","2023-12-03 15:01:27","50","0","1","PURCHASE");
INSERT INTO order_tb VALUES("484","79","1","0","","5102346987","","2023-12-03 15:01:27","2023-12-03 15:01:27","50","0","1","PURCHASE");
INSERT INTO order_tb VALUES("485","79","1","16","mountain dew","3269541780","Drinks","2023-12-03 15:31:05","","25","1","","");



CREATE TABLE `personnel_tb` (
  `personnel_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `personnelUser_id` varchar(100) NOT NULL,
  `department` varchar(255) NOT NULL,
  PRIMARY KEY (`personnel_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `personnel_tb_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_tb` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO personnel_tb VALUES("1","34","1234567890","SASO");
INSERT INTO personnel_tb VALUES("2","35","1234567891","Guidance");
INSERT INTO personnel_tb VALUES("3","38","1234567892","Admin");
INSERT INTO personnel_tb VALUES("4","36","1234567893","Admin");
INSERT INTO personnel_tb VALUES("7","48","1234567896","SSG");



CREATE TABLE `product_tb` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `teller_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `producer_price` int(11) NOT NULL,
  `date_post` date NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`product_id`),
  KEY `category_id` (`category_id`),
  KEY `teller_id` (`teller_id`),
  CONSTRAINT `product_tb_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category_tb` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `product_tb_ibfk_2` FOREIGN KEY (`teller_id`) REFERENCES `telleruser_tb` (`teller_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO product_tb VALUES("17","15","1","Fita","8","185","150","2023-08-29","fita-64fdd6e8d8944.jpeg");
INSERT INTO product_tb VALUES("18","15","1","Hansel","7","186","180","2023-08-29","hansel-choco-sandwich-64ee0ae77871c.jpg");
INSERT INTO product_tb VALUES("19","16","1","snowbear","1","175","200","2023-09-10","snowbear-64fdd755b51b4.jpg");
INSERT INTO product_tb VALUES("20","16","1","maxx","1","183","200","2023-09-10","maxx-64fdd7933fe07.jpg");
INSERT INTO product_tb VALUES("21","13","1","Dutch Mill","25","1","400","2023-09-11","dutchmill-64f56e1fa2939-64fe971262c90.jpeg");
INSERT INTO product_tb VALUES("22","13","1","Nature Spring","20","43","750","2023-09-11","nature spring-64f56df68f994-64fe974e186cf.jpeg");
INSERT INTO product_tb VALUES("23","17","2","Iced Coffee","30","9","200","2023-09-11","iced coffee-64f5507b9f3a5-64fe97e827018.jpg");
INSERT INTO product_tb VALUES("24","19","2","Apple","15","99","1300","2023-09-11","apple-64f54ac5b3da4-64fe980226904.jpg");
INSERT INTO product_tb VALUES("25","17","2","Lemonade","15","17","200","2023-09-11","lemonade-64f551159d2da-64fe985e2ff5d.jpg");
INSERT INTO product_tb VALUES("26","18","2","Fita","8","51","320","2023-09-11","fita-64f54a56dbb8a-64fe98947f16a.jpeg");
INSERT INTO product_tb VALUES("27","18","2","Fita Spreadz","9","100","800","2023-09-11","fita-64f56f51d1b65-64fe98c0e5f9b.jpeg");
INSERT INTO product_tb VALUES("28","18","2","Hansel","8","19","110","2023-09-11","hansel-choco-sandwich-64ee0ae77871c-64fe9914ef205.jpg");
INSERT INTO product_tb VALUES("29","19","2","Orange","13","20","150","2023-09-11","orange-64f54a8909a6f-64fe995a5fa74.jpeg");
INSERT INTO product_tb VALUES("30","22","3","Patata","8","100","650","2023-09-11","patata-64fea5ed95a19.jpeg");
INSERT INTO product_tb VALUES("31","22","3","Nova","15","49","600","2023-09-11","nova-64fea62d0db5e.jpeg");
INSERT INTO product_tb VALUES("32","22","3","Cracklings","9","20","120","2023-09-11","cracklings-64fea672772d2.jpeg");
INSERT INTO product_tb VALUES("33","20","3","Le Minerale","25","49","900","2023-09-11","le minerale-64fea6a4b1bca.jpg");
INSERT INTO product_tb VALUES("34","20","3","Chuckie","20","20","300","2023-09-11","chuckie-64fea6cc5e124.jpeg");
INSERT INTO product_tb VALUES("43","27","4","Sanitary pads","8","80","500","2023-09-11","pads-64feacf57ffab.jpg");
INSERT INTO product_tb VALUES("44","27","4","Wet wipes","20","18","300","2023-09-11","wipes-64fead2067002.jpg");
INSERT INTO product_tb VALUES("45","27","4","Tissue roll","10","20","120","2023-09-11","tissue-64fead5c39d15.jpeg");
INSERT INTO product_tb VALUES("46","26","4","Yellow pad","60","9","550","2023-09-11","yellow pad-64fead88279df.jpeg");
INSERT INTO product_tb VALUES("47","26","4","Faber Castel 0.5","15","20","150","2023-09-11","Ballpen-64feadb4a5beb.jpeg");
INSERT INTO product_tb VALUES("48","26","4","Short Bondpaper","1","1000","750","2023-09-11","bondpaper-64feadf85bd91.jpeg");
INSERT INTO product_tb VALUES("49","28","3","XO","1","100","70","2023-09-11","xo-64feaed1adccb.jpeg");
INSERT INTO product_tb VALUES("50","20","3","Yakult","10","100","900","2023-09-11","yakult-64feaf05479fb.jpg");
INSERT INTO product_tb VALUES("51","28","3","V-fresh","1","100","70","2023-09-11","vfresh-64feaf901823d.jpeg");
INSERT INTO product_tb VALUES("52","28","3","Fres","1","100","60","2023-09-11","fres-64feafb845a21.jpg");
INSERT INTO product_tb VALUES("53","20","3","Absolute","20","20","300","2023-09-11","absolute-64feb0aa49f1a.jpg");
INSERT INTO product_tb VALUES("54","17","2","Gulaman","15","19","150","2023-09-11","gulaman-64feb1711b91e.jpeg");
INSERT INTO product_tb VALUES("55","18","2","Cream-o","9","100","750","2023-09-11","cream-o-64feb18b6a4c3.jpeg");
INSERT INTO product_tb VALUES("56","13","1","Le Minerale","20","81","1500","2023-09-11","le minerale-64feb25421c70.jpg");
INSERT INTO product_tb VALUES("58","30","1","Egg Omelette","15","9","150","2023-11-30","egg omelete-6567e843a215f.jpg");
INSERT INTO product_tb VALUES("60","30","1","Shawarma Rice","40","50","600","2023-11-30","shawarma-6567e9991377e.jpg");
INSERT INTO product_tb VALUES("61","15","1","Cream-o","10","97","800","2023-11-30","cream-6567e9d4d7123.jpg");
INSERT INTO product_tb VALUES("62","15","1","Sky Flakes","9","24","210","2023-11-30","sky flakes-6567ea3b04312.png");
INSERT INTO product_tb VALUES("64","13","1","mountain dew","20","100","800","2023-12-03","null");



CREATE TABLE `semesteryear_tb` (
  `semesterYear_id` int(11) NOT NULL AUTO_INCREMENT,
  `semester` varchar(100) NOT NULL,
  `semester_start` date NOT NULL DEFAULT current_timestamp(),
  `semester_end` date DEFAULT NULL,
  `semester_pair` int(11) NOT NULL,
  PRIMARY KEY (`semesterYear_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO semesteryear_tb VALUES("1","first-semester","2018-06-27","2018-11-01","1");
INSERT INTO semesteryear_tb VALUES("14","second-semester","2018-11-01","2019-04-01","1");
INSERT INTO semesteryear_tb VALUES("15","first-semester","2019-06-01","2019-11-01","2");
INSERT INTO semesteryear_tb VALUES("16","second-semester","2019-11-01","2020-04-01","2");
INSERT INTO semesteryear_tb VALUES("17","first-semester","2020-06-01","2020-11-01","3");
INSERT INTO semesteryear_tb VALUES("18","second-semester","2020-11-01","2021-04-01","3");
INSERT INTO semesteryear_tb VALUES("19","first-semester","2021-06-01","2021-11-01","4");
INSERT INTO semesteryear_tb VALUES("20","second-semester","2021-11-01","2022-04-01","4");
INSERT INTO semesteryear_tb VALUES("21","first-semester","2022-06-01","2022-11-01","5");
INSERT INTO semesteryear_tb VALUES("22","second-semester","2022-11-01","2023-04-01","5");
INSERT INTO semesteryear_tb VALUES("23","first-semester","2023-04-01","","6");



CREATE TABLE `sendbalance_tb` (
  `sendBalance_id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `send_amount` int(11) NOT NULL,
  `sendBalance_ref` varchar(50) NOT NULL,
  `sendbalance_noti` tinyint(1) NOT NULL,
  `sendBalance_Date` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`sendBalance_id`),
  KEY `sender_id` (`sender_id`),
  KEY `receiver_id` (`receiver_id`),
  CONSTRAINT `sendbalance_tb_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `user_tb` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `sendbalance_tb_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `user_tb` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO sendbalance_tb VALUES("3","79","83","100","3928164750","1","2023-10-24 23:18:21");
INSERT INTO sendbalance_tb VALUES("6","79","83","100","9134607285","1","2023-10-24 23:31:44");
INSERT INTO sendbalance_tb VALUES("10","79","83","500","9286351704","1","2023-10-26 07:46:54");
INSERT INTO sendbalance_tb VALUES("12","79","87","500","7392846510","1","2023-11-09 07:57:11");
INSERT INTO sendbalance_tb VALUES("13","87","79","180","0269758431","1","2023-11-09 07:58:17");
INSERT INTO sendbalance_tb VALUES("14","79","86","500","7351286409","1","2023-11-12 00:58:52");
INSERT INTO sendbalance_tb VALUES("15","83","79","500","9078516432","1","2023-11-16 09:20:40");
INSERT INTO sendbalance_tb VALUES("17","86","79","1000","3471902856","1","2023-11-16 10:48:35");
INSERT INTO sendbalance_tb VALUES("18","86","91","1000","9361580274","1","2023-11-16 10:57:06");
INSERT INTO sendbalance_tb VALUES("19","79","86","2180","4752680913","1","2023-11-16 11:06:11");
INSERT INTO sendbalance_tb VALUES("20","90","86","44","2063719485","1","2023-11-16 11:08:14");
INSERT INTO sendbalance_tb VALUES("21","86","90","24","3409125687","1","2023-11-28 15:41:26");
INSERT INTO sendbalance_tb VALUES("22","86","90","100","8029764153","1","2023-11-28 15:45:33");
INSERT INTO sendbalance_tb VALUES("23","83","90","20","5061829347","1","2023-11-28 21:46:16");
INSERT INTO sendbalance_tb VALUES("24","83","64","20","6570394281","1","2023-11-28 21:47:54");
INSERT INTO sendbalance_tb VALUES("25","83","79","20","7289041356","1","2023-11-30 10:06:51");
INSERT INTO sendbalance_tb VALUES("26","83","79","20","1079246835","1","2023-11-30 10:06:58");
INSERT INTO sendbalance_tb VALUES("27","83","90","5","4792685031","1","2023-11-30 10:18:59");
INSERT INTO sendbalance_tb VALUES("28","97","98","500","3425169870","0","2023-11-30 10:58:08");
INSERT INTO sendbalance_tb VALUES("29","97","98","500","9750123486","0","2023-11-30 10:58:13");
INSERT INTO sendbalance_tb VALUES("30","112","111","1","6381902457","0","2023-11-30 11:32:27");
INSERT INTO sendbalance_tb VALUES("31","112","111","1","9471635820","0","2023-11-30 11:32:39");
INSERT INTO sendbalance_tb VALUES("32","110","111","1","3817295460","1","2023-11-30 11:33:11");
INSERT INTO sendbalance_tb VALUES("33","112","111","2","7263954108","0","2023-11-30 11:33:14");
INSERT INTO sendbalance_tb VALUES("34","111","110","1","3518240967","1","2023-11-30 11:36:24");
INSERT INTO sendbalance_tb VALUES("35","111","110","1","7823605149","1","2023-11-30 11:36:51");
INSERT INTO sendbalance_tb VALUES("36","113","110","8","8563247901","1","2023-11-30 11:36:56");
INSERT INTO sendbalance_tb VALUES("37","113","110","8","5314726890","1","2023-11-30 11:36:59");
INSERT INTO sendbalance_tb VALUES("38","112","111","2","3045718629","0","2023-11-30 11:45:47");
INSERT INTO sendbalance_tb VALUES("39","112","111","2","8479365102","0","2023-11-30 11:46:20");
INSERT INTO sendbalance_tb VALUES("40","112","110","5000","3019742865","0","2023-11-30 11:47:01");
INSERT INTO sendbalance_tb VALUES("41","83","79","10","7682901435","1","2023-11-30 12:45:07");
INSERT INTO sendbalance_tb VALUES("42","79","83","10","5104276938","1","2023-11-30 12:47:50");
INSERT INTO sendbalance_tb VALUES("43","79","83","10","5840961372","1","2023-11-30 12:48:34");
INSERT INTO sendbalance_tb VALUES("44","83","79","10","6832590417","1","2023-11-30 12:48:52");
INSERT INTO sendbalance_tb VALUES("45","83","79","2","2841930576","1","2023-11-30 12:50:20");
INSERT INTO sendbalance_tb VALUES("46","123","121","100","3897614520","0","2023-11-30 13:49:42");
INSERT INTO sendbalance_tb VALUES("47","121","123","100","3206814759","0","2023-11-30 13:50:41");
INSERT INTO sendbalance_tb VALUES("48","122","121","500","9582134076","0","2023-11-30 13:51:12");
INSERT INTO sendbalance_tb VALUES("49","86","127","1100","2098563147","1","2023-11-30 14:19:33");
INSERT INTO sendbalance_tb VALUES("50","90","79","5","0173294658","1","2023-12-03 12:31:02");
INSERT INTO sendbalance_tb VALUES("51","79","90","500","0849361725","1","2023-12-03 14:56:38");
INSERT INTO sendbalance_tb VALUES("52","79","90","500","6951327840","1","2023-12-03 14:58:25");



CREATE TABLE `student_tb` (
  `studentID_number` bigint(20) NOT NULL,
  `course` varchar(255) NOT NULL,
  `program_description` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `rfid_number` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  KEY `user_id` (`user_id`),
  CONSTRAINT `student_tb_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_tb` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO student_tb VALUES("1164973821","BSOA","","3rd","","46");
INSERT INTO student_tb VALUES("1234567891","BSCRIM","","3rd","","47");
INSERT INTO student_tb VALUES("2020590400","BEED","","4th","","50");
INSERT INTO student_tb VALUES("2023019305","BSED","","1st","2059831325","64");
INSERT INTO student_tb VALUES("2021117366","BSOA","","3rd","0463113411","66");
INSERT INTO student_tb VALUES("2021116715","BSOA","","3rd","0472665361","67");
INSERT INTO student_tb VALUES("2021116526","BSCRIM","","3rd","","68");
INSERT INTO student_tb VALUES("2019113585","BSIS","","3rd","3391757350","69");
INSERT INTO student_tb VALUES("2022017958","BSED","","2nd","0461417986","70");
INSERT INTO student_tb VALUES("2022018006","BSED","","2nd","0455007746","71");
INSERT INTO student_tb VALUES("2020115788","BSED","","4th","0688068140","72");
INSERT INTO student_tb VALUES("2020115817","BSED","","4th","","73");
INSERT INTO student_tb VALUES("2020115739","BSCRIM","","4th","","74");
INSERT INTO student_tb VALUES("2022118767","BSCRIM","","2nd","0485950241","75");
INSERT INTO student_tb VALUES("2020115752","BSIS","BACHELOR OF SCIENCE IN INFORMATION SYSTEM","4th","0472321553","79");
INSERT INTO student_tb VALUES("2020114925","BSIS","","4th","0478138897","83");
INSERT INTO student_tb VALUES("2020115048","BSIS","BACHELOR OF SCIENCE IN INFORMATION SYSTEM","4th","0442750691","86");
INSERT INTO student_tb VALUES("2020115216","BSIS","BACHELOR OF SCIENCE IN INFORMATION SYSTEM","4th","0469329666","87");
INSERT INTO student_tb VALUES("2020115731","BSIS","BACHELOR OF SCIENCE IN INFORMATION SYSTEM","4th","0473475857","88");
INSERT INTO student_tb VALUES("2020115166","BSIS","BACHELOR OF SCIENCE IN INFORMATION SYSTEM","4th","0476723473","89");
INSERT INTO student_tb VALUES("2020115558","BSIS","BACHELOR OF SCIENCE IN INFORMATION SYSTEM","4th","0477300257","90");
INSERT INTO student_tb VALUES("2020115392","BSIS","BACHELOR OF SCIENCE IN INFORMATION SYSTEM","4th","0470901777","91");
INSERT INTO student_tb VALUES("2021116471","BSIS","BACHELOR OF SCIENCE IN INFORMATION SYSTEM","3rd","0485373457","92");
INSERT INTO student_tb VALUES("2021116391","BSIS","BACHELOR OF SCIENCE IN INFORMATION SYSTEM","3rd","0438090210","93");
INSERT INTO student_tb VALUES("2020115287","BSIS","BACHELOR OF SCIENCE IN INFORMATION SYSTEM","4th","0474080017","94");
INSERT INTO student_tb VALUES("2020115761","BSIS","BACHELOR OF SCIENCE IN INFORMATION SYSTEM","4th","0437282034","96");
INSERT INTO student_tb VALUES("2020114742","BSIS","BACHELOR OF SCIENCE IN INFORMATION SYSTEM","4th","0475784721","97");
INSERT INTO student_tb VALUES("2020115364","BSIS","BACHELOR OF SCIENCE IN INFORMATION SYSTEM","4th","0444258546","98");
INSERT INTO student_tb VALUES("2021116449","BSIS","BACHELOR OF SCIENCE IN INFORMATION SYSTEM","3rd","0472735249","99");
INSERT INTO student_tb VALUES("2021116474","BSIS","BACHELOR OF SCIENCE IN INFORMATION SYSTEM","3rd","0485643537","100");
INSERT INTO student_tb VALUES("2021116459","BSIS","BACHELOR OF SCIENCE IN INFORMATION SYSTEM","3rd","0456229139","101");
INSERT INTO student_tb VALUES("2021117017","BSIS","BACHELOR OF SCIENCE IN INFORMATION SYSTEM","3rd","0445879538","102");
INSERT INTO student_tb VALUES("2023120257","BSED","BACHELOR OF SECONDARY EDUCATION MAJOR IN FILIPINO","1st","4158521805","103");
INSERT INTO student_tb VALUES("2021116446","BSIS","BACHELOR OF SCIENCE IN INFORMATION SYSTEM","3rd","0463066115","104");
INSERT INTO student_tb VALUES("2021116468","BSIS","BACHELOR OF SCIENCE IN INFORMATION SYSTEM","3rd","0447422707","105");
INSERT INTO student_tb VALUES("2023120293","BSED","BACHELOR OF SECONDARY EDUCATION MAJOR IN FILIPINO","1st","2771009310","106");
INSERT INTO student_tb VALUES("2023019305","BSED","BACHELOR OF SECONDARY EDUCATION MAJOR IN FILIPINO","1st","2059831325","107");
INSERT INTO student_tb VALUES("2021116458","BSIS","BACHELOR OF SCIENCE IN INFORMATION SYSTEM","3rd","0446198259","108");
INSERT INTO student_tb VALUES("2021116421","BSIS","BACHELOR OF SCIENCE IN INFORMATION SYSTEM","3rd","0456796419","109");
INSERT INTO student_tb VALUES("2021116431","BSIS","BACHELOR OF SCIENCE IN INFORMATION SYSTEM","3rd","0372089772","110");
INSERT INTO student_tb VALUES("2021116410","BSIS","BACHELOR OF SCIENCE IN INFORMATION SYSTEM","3rd","0477882897","111");
INSERT INTO student_tb VALUES("2021116435","BSIS","BACHELOR OF SCIENCE IN INFORMATION SYSTEM","3rd","0439794402","112");
INSERT INTO student_tb VALUES("2021116478","BSIS","BACHELOR OF SCIENCE IN INFORMATION SYSTEM","3rd","0543836487","113");
INSERT INTO student_tb VALUES("2020114786","BSCRIM","BACHELOR OF SCIENCE IN CRIMINOLOGY","4th","","114");
INSERT INTO student_tb VALUES("2020116305","BSCRIM","BACHELOR OF SCIENCE IN CRIMINOLOGY","4th","","115");
INSERT INTO student_tb VALUES("2022018112","BSOA","BACHELOR OF SCIENCE IN OFFICE ADMINISTRATION","2nd","0465896977","116");
INSERT INTO student_tb VALUES("2022118292","BSOA","BACHELOR OF SCIENCE IN OFFICE ADMINISTRATION","2nd","1887313997","117");
INSERT INTO student_tb VALUES("2022018153","BSOA","BACHELOR OF SCIENCE IN OFFICE ADMINISTRATION","2nd","0469115153","118");
INSERT INTO student_tb VALUES("2022118203","BSOA","BACHELOR OF SCIENCE IN OFFICE ADMINISTRATION","2nd","0469193745","119");
INSERT INTO student_tb VALUES("2020114706","BSIS","BACHELOR OF SCIENCE IN INFORMATION SYSTEM","4th","0485029633","120");
INSERT INTO student_tb VALUES("2021116527","ABE","BACHELOR OF ARTS IN ENGLISH LANGUAGE","3rd","","121");
INSERT INTO student_tb VALUES("2021117025","ABE","BACHELOR OF ARTS IN ENGLISH LANGUAGE","3rd","0534610727","122");
INSERT INTO student_tb VALUES("2021117043","ABE","BACHELOR OF ARTS IN ENGLISH LANGUAGE","3rd","0371655564","123");
INSERT INTO student_tb VALUES("2021116470","ABE","BACHELOR OF ARTS IN ENGLISH LANGUAGE","3rd","","124");
INSERT INTO student_tb VALUES("2021117454","ABE","BACHELOR OF ARTS IN ENGLISH LANGUAGE","3rd","","125");
INSERT INTO student_tb VALUES("2022017856","BSIS","BACHELOR OF SCIENCE IN INFORMATION SYSTEM","2nd","1887681741","126");
INSERT INTO student_tb VALUES("2023119950","BSIS","BACHELOR OF SCIENCE IN INFORMATION SYSTEM","1st","2770698334","127");



CREATE TABLE `telleruser_tb` (
  `teller_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname_teller` varchar(255) NOT NULL,
  `lastname_teller` varchar(255) NOT NULL,
  `phonenumber_teller` bigint(20) NOT NULL,
  `store_name` varchar(255) NOT NULL,
  `teller_gender` varchar(50) NOT NULL,
  `teller_qr` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tellerqr_image` varchar(255) NOT NULL,
  `user_category` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`teller_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO telleruser_tb VALUES("1","Ninang","Dela cruz","9123456789","EATScetera","female","58213946","","58213946.png","teller","teller1","8f2ffd75dd4cd9e86ed995b7728a75e2");
INSERT INTO telleruser_tb VALUES("2","Marlyn","Garcia","9537583912","Mags Food Hub","female","76293105","","76293105.png","teller","marlyn","f15f8f0c7451118642dd9b602718c562");
INSERT INTO telleruser_tb VALUES("3","Grace","Mhie","9437482741","Yanong's Store","female","90456278","","90456278.png","teller","grace","15e5c87b18c1289d45bb4a72961b58e8");
INSERT INTO telleruser_tb VALUES("4","Kenny","Belarte","9767686589","JD's Eatery","female","62783140","","62783140.png","teller","belarte","4df89289675f6a76284818a1e5ca6925");
INSERT INTO telleruser_tb VALUES("12","Melvin","Sadio","9388995680","Melvin","female","40652973","KIANSADIO@GMAIL.COM","40652973.png","teller","melvin","827ccb0eea8a706c4c34a16891f84e7b");
INSERT INTO telleruser_tb VALUES("13","Anthony","Malabanan","9388995698","Sir M store","male","95083617","SIRM@GMAIL.COM","95083617.png","teller","sirm","43bcdedce25d2de9d47fd9d54ddd18b8");



CREATE TABLE `user_tb` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phonenumber` bigint(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `complete_address` varchar(255) NOT NULL,
  `usertype` varchar(20) DEFAULT NULL,
  `user_category` varchar(255) NOT NULL,
  `statues` varchar(20) NOT NULL,
  `image_profile` text DEFAULT NULL,
  `register_date` date NOT NULL DEFAULT current_timestamp(),
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=128 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO user_tb VALUES("34","Ninang","Dela Cruz","ninang@gmail.com","9987123654","female","non-bago","","personnel","user_buyer","not-active","","2023-09-09","ninang","d54fd1674b1e312cba3cec56add7e00a");
INSERT INTO user_tb VALUES("35","Pablo","San jose","pablo@gmail.com","9159357246","other","bago","","personnel","user_buyer","not-active","","2023-09-06","pablo","7e4b64eb65e34fdfad79e623c44abd94");
INSERT INTO user_tb VALUES("36","Jia mae","Gaspar","jiabadgirl@gmail.com","9725468164","female","bago","","personnel","user_buyer","not-active","","2023-09-10","jia","a6907acf5b337a322193f19b6698c867");
INSERT INTO user_tb VALUES("38","Angelo","Cortez","angelo@gmail.com","9873465982","male","bago","","personnel","user_buyer","not-active","","2023-09-10","angelo","98a8d3f11b400ddc06d7343375b71a84");
INSERT INTO user_tb VALUES("46","Koa","Montelibano","koaknox8210@gmail.com","9493582858","male","bago","","student","user_buyer","not-active","","2023-09-11","KoaKnox","8028d74fe6ae33700bad6be602886890");
INSERT INTO user_tb VALUES("47","Keam","Casseus","keamcasseus8210@gmail.com","9103199898","female","non-bago","","student","user_buyer","not-active","","2023-09-11","keamcasseus","9dd736dbbbec565cfe90e38e93c5e3cd");
INSERT INTO user_tb VALUES("48","sherly","carpio","sherly@gmail.com","9759872245","female","non-bago","","personnel","user_buyer","not-active","","2023-09-12","sherly","1c8b06358890d6c512859b21557315b4");
INSERT INTO user_tb VALUES("50","ashly","sunga","ashly@gmail.com","9582349023","female","non-bago","","student","user_buyer","not-active","","2023-09-18","ashly","c114e447529c910fb405cc586adabe8f");
INSERT INTO user_tb VALUES("64","KISSHA VERONICA","BELARTE","","9810552536","female","bago","","student","user_buyer","not-active","","2023-10-11","2023019305","3fd0f9eb0dee1fa44f22cec8d806a07a");
INSERT INTO user_tb VALUES("66","ROSALY","BARREDO","BARREDOROSALY@GMAIL.COM","9301020253","female","non-bago","","student","user_buyer","not-active","","2023-10-11","2021117366","a9eb8cb1236b1ff06141a564f9a71381");
INSERT INTO user_tb VALUES("67","JONA MAY","ODELMO","ODELMOJONAMAY@GMAIL.COM","9152630029","female","non-bago","","student","user_buyer","not-active","","2023-10-11","2021116715","9e5b014336f2f454bd95480fbe6327ef");
INSERT INTO user_tb VALUES("68","CRIS DHENIEL","BATHAN","CRISDHENIELBATHAN@GMAIL.COM","9122443890","male","non-bago","","student","user_buyer","not-active","","2023-10-11","2021116526","91cb88099fb85538ff3068ba143fd554");
INSERT INTO user_tb VALUES("69","JOSHUA JADE","DE ASIS","JOSHUAJADE2000@GMAIL.COM","9076715377","male","non-bago","","student","user_buyer","not-active","","2023-10-11","2019113585","11943f599ef8db7d79e3559be7726eb2");
INSERT INTO user_tb VALUES("70","CHOLEN KATE","VILLAHERMOZA","","9565709333","female","bago","","student","user_buyer","not-active","","2023-10-11","2022017958","1946359365173169d03238de8e79e1f1");
INSERT INTO user_tb VALUES("71","JUARHT","VALENZUELA","NONOYARHTBOY@GMAIL.COM","9506451553","male","non-bago","","student","user_buyer","not-active","","2023-10-11","2022018006","6dd93c8a6f36b0e40c2ef65b1df844f8");
INSERT INTO user_tb VALUES("72","MA. ALCREZA","ALAMPAYAN","MAALCREZAALAMPAYAN25@GMAIL.COM","9101086430","female","bago","","student","user_buyer","not-active","","2023-10-11","2020115788","5b498e58edc0b2aee39277f88d7107b7");
INSERT INTO user_tb VALUES("73","MEL JHON","MALINAO","MELJHONMALINAO18@GMAIL.COM","9163170404","male","non-bago","","student","user_buyer","not-active","","2023-10-11","2020115817","bc499d94a3bd353ff3ddaee4fe55d99c");
INSERT INTO user_tb VALUES("74","CLARENCE","GALEA","","9369448732","male","bago","","student","user_buyer","not-active","","2023-10-11","2020115739","8f465e4dfb551860ff6b3cc8212ab6c8");
INSERT INTO user_tb VALUES("75","BIANCA MARIE","SION","","9388042554","female","non-bago","","student","user_buyer","not-active","","2023-10-11","2022118767","911ff67ab51513c03af3127f7c755592");
INSERT INTO user_tb VALUES("79","GABRIEL","CARPIO","GABRIELCARPIO178@GMAIL.COM","9708038647","male","bago","PUROK. CAMATIS, PACOL, BAGO CITY","student","user_buyer","not-active","368373550_1242782896270126_3083459317382118447_n-655d88ac67417.jpg","2023-10-11","gabrielcarpio","505df4a053be83dbe1d6675d4c22031d");
INSERT INTO user_tb VALUES("83","KENNY","BELARTE","KNYBELARTE1120@GMAIL.COM","9777180551","female","bago","PRK MABINULIGON, SAMPINIT, BAGO CITY","student","user_buyer","not-active","3924c89780944c587365ec045b600df9-655f12a243ed5-6567f28199be1.jpg","2023-10-19","2020114925","88594835d20004f1de8c2b9fdf7cf942");
INSERT INTO user_tb VALUES("86","JULIE","VILLACRUSIS","VILLACRUSISJULIE6@GMAIL.COM","9107855364","female","bago","PRK. MASINADYAHON, BUSAY, BAGO CITY","student","user_buyer","active","377150595_2311701749218785_4162283291870533900_n-655c2403b5653.jpg","2023-11-05","2020115048","25d55ad283aa400af464c76d713c07ad");
INSERT INTO user_tb VALUES("87","JIA MAE","GASPAR","GASPARJIA@GMAIL.COM","9278824722","female","bago","HDA. JALANDONI, MAILUM, BAGO CITY","student","user_buyer","not-active","","2023-11-09","2020115216","76381c40751ce6d619fce48cec72978a");
INSERT INTO user_tb VALUES("88","GECIL","HOYOHOY","HOYOHOYGECIL@GMAIL.COM","9759337504","female","non-bago","CAMPVALDEZ, MAMBAROTO, SIPALAY CITY","student","user_buyer","not-active","","2023-11-09","2020115731","56bc1a8be77aa63545f7883b6ce7411a");
INSERT INTO user_tb VALUES("89","ABEGAIL","EPAROSA","AEEPAROSA@GMAIL.COM","9302442883","female","non-bago","VENDORS, SIBUCAO, SAN ENRIQUE","student","user_buyer","not-active","","2023-11-09","2020115166","448d581442ea70e5b3d7a5e04bc2a56d");
INSERT INTO user_tb VALUES("90","KIAN","SADIO","KIANSADIO283@GMAIL.COM","9939064484","male","bago","SITIO TABIDIAO, BRGY. MAILUM, BAGO CITY","student","user_buyer","active","","2023-11-16","2020115558","4c1e134b3672bccc4a34decb4df6bf59");
INSERT INTO user_tb VALUES("91","JOSHUA JOI","LORENZO","","9672547984","male","non-bago","BLK. 07, MASVILLE, BRGY. CUBAY, LA CARLOTA CITY","student","user_buyer","not-active","","2023-11-16","2020115392","5204e7eac3bfa00b2609cf508f9b3c8f");
INSERT INTO user_tb VALUES("92","JULIO","MARTINEZ","CRIMSONLOVE12345@GMAIL.COM","9605104758","male","non-bago","BUCROZ DIOTAY, II, LA CARLOTA CITY","student","user_buyer","not-active","","2023-11-27","2021116471","f15391636ea1d143ec415942c8de4c09");
INSERT INTO user_tb VALUES("93","EARL JOHN","PAILDAN","PAILDANEARLJOHN@GMAIL.COM","9616035691","male","bago","PUROK HIGH SCHOOL, TALOC, BAGO CITY","student","user_buyer","not-active","","2023-11-30","2021116391","9726d50cd27d46539fbe50ac4ce10b7e");
INSERT INTO user_tb VALUES("94","ROSELYN","ALVAREZ","ROSELYNALVAREZ149@GMAIL.COM","9070345290","female","bago","PRK ROSAS, BRGY. BALINGASAG, BAGO CITY","student","user_buyer","not-active","","2023-11-30","2020115287","9548bf9074be2a6ddef483b567cf6f8f");
INSERT INTO user_tb VALUES("96","ARIEL","GABIANDAN","COLUMNAARIEL460@GMAIL.COM","9922073188","male","non-bago","HACIENDA REMEDIOS, BARANGAY BALABAG, LA CARLOTA CITY","student","user_buyer","not-active","","2023-11-30","2020115761","14dd636b3d9ecb0e98b616c4c2f1f0a4");
INSERT INTO user_tb VALUES("97","RUTH","TURTOLA","BHEBZTURTOLA13@GMAIL.COM","9393777844","female","non-bago","PRK. ORCHIDS, SAN MIGUEL, MURCIA","student","user_buyer","not-active","","2023-11-30","2020114742","70d2732e7b92bc85c9db2d37876a45d9");
INSERT INTO user_tb VALUES("98","LIEZEL","VILLAESTER","LIEZELVILLAESTER03@GMAIL.COM","9770271057","female","bago","16 STREET, CALUMANGAN, BAGO CITY","student","user_buyer","not-active","","2023-11-30","2020115364","a102d88fdcb13d3433921eb823b3a64b");
INSERT INTO user_tb VALUES("99","JED","RAMOS","JEDRAMOS246@GMAIL.COM","9129403678","male","non-bago","QUEZON STREET, BARANGAY 4, MOISES PADILLA (MAGALLON)","student","user_buyer","not-active","","2023-11-30","2021116449","9dadeb115d9bc52bd5e4bb539c78fad3");
INSERT INTO user_tb VALUES("100","NIEL ALLEN","OSORIO","OSORIOALLEN4@GMAIL.COM","9156063497","male","non-bago","SITIO GINGS, ZONE 6, PULUPANDAN","student","user_buyer","not-active","","2023-11-30","2021116474","67df1f06269fedb60d0b290938d567f9");
INSERT INTO user_tb VALUES("101","DAISY","ORBITA","DAISYFRIASORBITA@GMAIL.COM","9306958970","female","non-bago","PRK. IPIL-IPIL, BRGY. MABINI, VALLADOLID","student","user_buyer","not-active","","2023-11-30","2021116459","5ab9308758e9d94cd3ee60ae7d889935");
INSERT INTO user_tb VALUES("102","CHRISTIN","PONTINO","TINNIEPONTINO2@GMAIL.COM","9913392545","female","non-bago","PRK ESHOA, ZONE 2, PULUPANDAN","student","user_buyer","not-active","","2023-11-30","2021117017","be14934b59269816d443f84e18ed3d4c");
INSERT INTO user_tb VALUES("103","RAZEL MAE","OQUINDO","","9695936571","female","non-bago","PUROK MALINONG, TANGUB, BACOLOD CITY","student","user_buyer","not-active","","2023-11-30","2023120257","b821263bc852ea0b791868c806e1a6be");
INSERT INTO user_tb VALUES("104","ANDREA","ANDRADE","ANDREAANDRADE062902@GMAIL.COM","9513442746","female","non-bago","SANTA FELOMINA STREET, ZONE-2, PULUPANDAN","student","user_buyer","not-active","","2023-11-30","2021116446","379caad86d2e94b0df352b831658d04c");
INSERT INTO user_tb VALUES("105","GRACELYN JOYCE","PLIMONES","GRACELYNJOYCEPLIMONES@GMAIL.COM","9501572157","female","non-bago","PUROK KAPAYAS, PALAKA NORTE, PULUPANDAN","student","user_buyer","not-active","","2023-11-30","2021116468","8c3fe45cc6a121c7b6f7072644aacb1e");
INSERT INTO user_tb VALUES("106","JASMIN","PEROCHO","","9516073603","female","bago","PUROK BAYABAS 2, CARIDAD, BAGO CITY","student","user_buyer","not-active","","2023-11-30","2023120293","b32c540d708f313d8a8a7937a460e592");
INSERT INTO user_tb VALUES("107","KISSHA VERONICA","BELARTE","","9810552536","female","bago","MABINULIGON, SAMPINIT, BAGO CITY","student","user_buyer","not-active-account","","2023-11-30","2023019305","50ac0c7166ec0e8aeaf491f8f4b45995");
INSERT INTO user_tb VALUES("108","CHERRY MAE","SABANAL","CHERRYMAESABANAL1628@GMAIL.COM","9360747458","female","bago","LOT 1, LAG ASAN, BAGO CITY","student","user_buyer","not-active","","2023-11-30","2021116458","b53f807aa123d98a0d7a80ccc8a00849");
INSERT INTO user_tb VALUES("109","CHRISTINE MAE","ALTAMERA","ALTAMERACHRISTINE@GMAIL.COM","9512996913","female","bago","PUROK PAHO HDA PADER, BRGY.MAAO, BAGO CITY","student","user_buyer","not-active","","2023-11-30","2021116421","0fc5362075e8593e5adec6484d82228b");
INSERT INTO user_tb VALUES("110","KURT AERIOLE","PADILLA","KURTPAD2000@GMAIL.COM","9777115655","male","bago","PRK. PROPER NORTH, TALOC, BAGO CITY","student","user_buyer","not-active","","2023-11-30","2021116431","933b32e15b30a1805716b1522392fedf");
INSERT INTO user_tb VALUES("111","ANGEL MARIE","VICENTINO","ANGELMARIEVICENTINO39@GMAIL.COM","9515702176","female","non-bago","RIEGO ST., BRGY.ZONE 02, PULUPANDAN","student","user_buyer","not-active","","2023-11-30","2021116410","131a30bc39124cd993cb184374eac080");
INSERT INTO user_tb VALUES("112","CHARLIE","PELLE","CHARLIEPELLE5@GMAIL.COM","9480691056","male","bago","HDA D-64, BRGY. MA-AO, BAGO CITY","student","user_buyer","not-active","","2023-11-30","2021116435","f09e7eec376d60021acda15a2a22bdbb");
INSERT INTO user_tb VALUES("113","IAN","GODACA","IANPARCONGODACA@GMAIL.COM","9917583639","male","bago","PUROK DAISY, ABUANAN, BAGO CITY","student","user_buyer","not-active","","2023-11-30","2021116478","583bbea7a82f3f20b78326c5441a9051");
INSERT INTO user_tb VALUES("114","CHERRY MAE","ESMERES","CHERRYMAEESMERES@GMAIL.COM","9274687585","female","bago","PRK. MAHILIUGYON I, BRGY. SAMPINIT, BAGO CITY, SAMPINIT, BAGO CITY","student","user_buyer","not-active","","2023-11-30","2020114786","020964d0ab37eef82f472826f6bfbadd");
INSERT INTO user_tb VALUES("115","ELAINE MAE","MANSAN","","9153224131","female","bago","., MA-AO, BAGO CITY","student","user_buyer","not-active","","2023-11-30","2020116305","699acd77ff49d8101b577afe6b2be144");
INSERT INTO user_tb VALUES("116","DARREN LEE","BUENO","BUENODARRENLEE@GMAIL.COM","9480668070","female","bago","PRK. MALIPAYON, SAGASA, BAGO CITY","student","user_buyer","not-active","","2023-11-30","2022018112","13270901b8d848b2901c6e85d3a84e14");
INSERT INTO user_tb VALUES("117","MARIEL","DIVINO","","9457256720","female","bago","PUROK SALONG PAIT, MALINGIN, BAGO CITY","student","user_buyer","not-active","","2023-11-30","2022118292","6b3d9b77207328cf919db5a78d9e407f");
INSERT INTO user_tb VALUES("118","ANGEL FAITH","DALISAY","DALISAYANGELFAITH0210@GMAIL.COM","9196560582","female","bago","PRK MABUHAY, SAGASA, BAGO CITY","student","user_buyer","not-active","","2023-11-30","2022018153","9703284ce23356d8536ba55e4436e612");
INSERT INTO user_tb VALUES("119","EZA MAE","TENERIFE","","909513005","female","bago","PUROK CAMATIS, BRGY. PACOL, BAGO CITY","student","user_buyer","not-active","","2023-11-30","2022118203","6229cb936295db01aab91c4ef2be7962");
INSERT INTO user_tb VALUES("120","JOMAR","PEDILO","JOMARPEDILO285@GMAIL.COM","9091378666","male","bago","PUROK TACLARON, BARANGAY MALINGIN, BAGO CITY","student","user_buyer","not-active","","2023-11-30","2020114706","d8c7ee7050166e9b819e22d1e79d78cf");
INSERT INTO user_tb VALUES("121","MAILA","ANOBLING","MAILANOBLING@GMAIL.COM","9707138136","female","bago","XX, XX, BAGO CITY","student","user_buyer","not-active","","2023-11-30","2021116527","6f814fc7070564c9ade36fca550f43e6");
INSERT INTO user_tb VALUES("122","ALPHA MAE","GAPULAN","SEUNGHYUBS.EAM@GMAIL.COM","9122258999","female","non-bago","RIZAL STREET, III, HINIGARAN","student","user_buyer","not-active","","2023-11-30","2021117025","8ddcb70a36e9a268e2c8288fb1617df2");
INSERT INTO user_tb VALUES("123","BIA","ZAMORA","BIAASPILAZAMORA@GMAIL.COM","9704656480","female","bago","PUROK MAINUGYUNON, BARANGGAY NAPOLES, BAGO CITY","student","user_buyer","not-active","","2023-11-30","2021117043","4196720b4004bdeda68291c5bffb6abc");
INSERT INTO user_tb VALUES("124","RODELYN","NARVASA","RODELYNNARVASA20@GMAIL.COM","9971474824","female","bago","PUROK MALUNGGAY-A, ILIJAN, BAGO CITY","student","user_buyer","not-active","","2023-11-30","2021116470","bf69b2832440274f6e0f30d684d219ee");
INSERT INTO user_tb VALUES("125","JOANNE MARIE","RONQUILLO","J31MARIERONQUILLO@GMAIL.COM","9150852111","female","bago","PRK. PUCATOD, MA-AO, BAGO CITY","student","user_buyer","not-active","","2023-11-30","2021117454","30064816235f6a08d8688baff9dedbf7");
INSERT INTO user_tb VALUES("126","JOHN PAUL","SARONA","SARONAJOHNPAULT@GMAIL.COM","9611857008","male","bago","PRK. PARA 1, TALOC, BAGO CITY","student","user_buyer","not-active","","2023-11-30","2022017856","decf82f99d1ae8c50142c686eeb7c426");
INSERT INTO user_tb VALUES("127","BEN MARK","REGALA","BENMARKREGALA05@GMAIL.COM","9665618405","male","non-bago","PUROK LANGIS, BANAGO, BACOLOD CITY","student","user_buyer","not-active","","2023-11-30","2023119950","b9113f3f00646df90a51a0fb3d716d18");



CREATE TABLE `userwebusages_tb` (
  `userWebUsages_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_category` varchar(255) NOT NULL,
  `use_date` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`userWebUsages_id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO userwebusages_tb VALUES("1","1","teller","2023-01-10");
INSERT INTO userwebusages_tb VALUES("2","40","user_buyer","2023-02-10");
INSERT INTO userwebusages_tb VALUES("3","1","cashier","2023-03-10");
INSERT INTO userwebusages_tb VALUES("4","2","teller","2023-04-10");
INSERT INTO userwebusages_tb VALUES("5","45","user_buyer","2023-05-10");
INSERT INTO userwebusages_tb VALUES("6","37","user_buyer","2023-06-10");
INSERT INTO userwebusages_tb VALUES("7","36","user_buyer","2023-07-10");
INSERT INTO userwebusages_tb VALUES("8","41","user_buyer","2023-08-10");
INSERT INTO userwebusages_tb VALUES("9","5","teller","2023-09-10");
INSERT INTO userwebusages_tb VALUES("10","33","user_buyer","2023-09-10");
INSERT INTO userwebusages_tb VALUES("11","1","teller","2023-09-11");
INSERT INTO userwebusages_tb VALUES("12","2","teller","2023-09-11");
INSERT INTO userwebusages_tb VALUES("13","4","teller","2023-09-11");
INSERT INTO userwebusages_tb VALUES("14","45","user_buyer","2023-09-11");
INSERT INTO userwebusages_tb VALUES("15","3","teller","2023-09-11");
INSERT INTO userwebusages_tb VALUES("16","46","user_buyer","2023-09-11");
INSERT INTO userwebusages_tb VALUES("17","40","user_buyer","2023-09-11");
INSERT INTO userwebusages_tb VALUES("18","47","user_buyer","2023-09-11");
INSERT INTO userwebusages_tb VALUES("19","1","cashier","2023-09-11");
INSERT INTO userwebusages_tb VALUES("20","48","user_buyer","2023-09-12");
INSERT INTO userwebusages_tb VALUES("21","6","teller","2023-09-13");
INSERT INTO userwebusages_tb VALUES("22","7","teller","2023-09-13");
INSERT INTO userwebusages_tb VALUES("23","41","user_buyer","2023-09-17");
INSERT INTO userwebusages_tb VALUES("24","8","teller","2023-09-19");
INSERT INTO userwebusages_tb VALUES("25","9","teller","2023-09-25");
INSERT INTO userwebusages_tb VALUES("26","10","teller","2023-09-28");
INSERT INTO userwebusages_tb VALUES("27","1","cashier","2023-10-01");
INSERT INTO userwebusages_tb VALUES("28","40","user_buyer","2023-10-01");
INSERT INTO userwebusages_tb VALUES("29","58","user_buyer","2023-10-01");
INSERT INTO userwebusages_tb VALUES("30","33","user_buyer","2023-10-03");
INSERT INTO userwebusages_tb VALUES("31","1","teller","2023-10-03");
INSERT INTO userwebusages_tb VALUES("32","61","user_buyer","2023-10-03");
INSERT INTO userwebusages_tb VALUES("33","63","user_buyer","2023-10-11");
INSERT INTO userwebusages_tb VALUES("34","79","user_buyer","2023-10-11");
INSERT INTO userwebusages_tb VALUES("35","81","user_buyer","2023-10-19");
INSERT INTO userwebusages_tb VALUES("36","83","user_buyer","2023-10-19");
INSERT INTO userwebusages_tb VALUES("37","84","user_buyer","2023-10-25");
INSERT INTO userwebusages_tb VALUES("38","1","cashier","2023-11-01");
INSERT INTO userwebusages_tb VALUES("39","79","user_buyer","2023-11-01");
INSERT INTO userwebusages_tb VALUES("40","84","user_buyer","2023-11-05");
INSERT INTO userwebusages_tb VALUES("41","1","teller","2023-11-05");
INSERT INTO userwebusages_tb VALUES("42","86","user_buyer","2023-11-05");
INSERT INTO userwebusages_tb VALUES("43","87","user_buyer","2023-11-09");
INSERT INTO userwebusages_tb VALUES("44","83","user_buyer","2023-11-09");
INSERT INTO userwebusages_tb VALUES("45","80","user_buyer","2023-11-09");
INSERT INTO userwebusages_tb VALUES("46","89","user_buyer","2023-11-09");
INSERT INTO userwebusages_tb VALUES("47","90","user_buyer","2023-11-16");
INSERT INTO userwebusages_tb VALUES("48","88","user_buyer","2023-11-25");
INSERT INTO userwebusages_tb VALUES("49","3","teller","2023-11-30");
INSERT INTO userwebusages_tb VALUES("50","93","user_buyer","2023-11-30");
INSERT INTO userwebusages_tb VALUES("51","95","user_buyer","2023-11-30");
INSERT INTO userwebusages_tb VALUES("52","97","user_buyer","2023-11-30");
INSERT INTO userwebusages_tb VALUES("53","106","user_buyer","2023-11-30");
INSERT INTO userwebusages_tb VALUES("54","103","user_buyer","2023-11-30");
INSERT INTO userwebusages_tb VALUES("55","100","user_buyer","2023-11-30");
INSERT INTO userwebusages_tb VALUES("56","101","user_buyer","2023-11-30");
INSERT INTO userwebusages_tb VALUES("57","110","user_buyer","2023-11-30");
INSERT INTO userwebusages_tb VALUES("58","111","user_buyer","2023-11-30");
INSERT INTO userwebusages_tb VALUES("59","112","user_buyer","2023-11-30");
INSERT INTO userwebusages_tb VALUES("60","114","user_buyer","2023-11-30");
INSERT INTO userwebusages_tb VALUES("61","117","user_buyer","2023-11-30");
INSERT INTO userwebusages_tb VALUES("62","120","user_buyer","2023-11-30");
INSERT INTO userwebusages_tb VALUES("63","126","user_buyer","2023-11-30");
INSERT INTO userwebusages_tb VALUES("64","79","user_buyer","2023-12-01");
INSERT INTO userwebusages_tb VALUES("65","124","user_buyer","2023-12-01");
INSERT INTO userwebusages_tb VALUES("66","1","teller","2023-12-01");
INSERT INTO userwebusages_tb VALUES("67","1","cashier","2023-12-01");
INSERT INTO userwebusages_tb VALUES("68","86","user_buyer","2023-12-01");
INSERT INTO userwebusages_tb VALUES("69","123","user_buyer","2023-12-01");
INSERT INTO userwebusages_tb VALUES("70","83","user_buyer","2023-12-03");
INSERT INTO userwebusages_tb VALUES("71","90","user_buyer","2023-12-03");

