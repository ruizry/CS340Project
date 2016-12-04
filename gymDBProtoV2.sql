/*
Student Name: Ryan Ruiz, Johnny Sanchez
OSU id: ruizry, sanchjoh
*********************************************************************
*/

DROP TABLE IF EXISTS `isEmployee`;
DROP TABLE IF EXISTS `isInstructor`;
DROP TABLE IF EXISTS `isStudent`;
DROP TABLE IF EXISTS `isMember`;
DROP TABLE IF EXISTS `class_tbl`;
DROP TABLE IF EXISTS `employee_tbl`;
DROP TABLE IF EXISTS `gym`;
DROP TABLE IF EXISTS `member_tbl`;


CREATE TABLE `member_tbl` (
  memberid int(11) NOT NULL AUTO_INCREMENT,
  fname varchar(255) NOT NULL,
  lname varchar(255) NOT NULL,
  phonenum varchar(255),
  PRIMARY KEY (memberid)
) ENGINE=InnoDB;

CREATE TABLE `gym` (
  gymid int(11) NOT NULL AUTO_INCREMENT,
  locationName varchar(255) NOT NULL,
  zipCode int(11) NOT NULL,
  PRIMARY KEY (gymid)
) ENGINE=InnoDB;

CREATE TABLE `employee_tbl` (
  empid int(11) NOT NULL AUTO_INCREMENT,
  fname varchar(255) NOT NULL,
  lname varchar(255) NOT NULL,
  PRIMARY KEY (empid)
) ENGINE=InnoDB;

CREATE TABLE `class_tbl` (
  classid int(11) NOT NULL AUTO_INCREMENT,
  gid int(11) NOT NULL,
  name varchar(255) NOT NULL,
  classDay varchar(255),
  classTime varchar(255),
  durationMin int(11),
  capacity int(11),
  FOREIGN KEY (gid) REFERENCES gym (gymid)
    ON DELETE CASCADE ON UPDATE CASCADE,
  PRIMARY KEY (classid)
) ENGINE=InnoDB;


CREATE TABLE `isStudent` (
  mid int(11) NOT NULL,
  cid int(11) NOT NULL,
  PRIMARY KEY  (mid, cid),
  FOREIGN KEY (mid) REFERENCES member_tbl (memberid)
    ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (cid) REFERENCES class_tbl (classid)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `isMember` (
  mid int(11) NOT NULL,
  gid int(11) NOT NULL,
  startdate date,
  activeMember boolean,
  PRIMARY KEY  (mid, gid),

  FOREIGN KEY (mid) REFERENCES member_tbl (memberid)
    ON DELETE CASCADE ON UPDATE CASCADE,

  FOREIGN KEY (gid) REFERENCES gym (gymid)
    ON DELETE CASCADE ON UPDATE CASCADE

) ENGINE=InnoDB;

CREATE TABLE `isInstructor` (
  eid int(11) NOT NULL,
  cid int(11) NOT NULL,
  PRIMARY KEY  (eid, cid),
  FOREIGN KEY (eid) REFERENCES employee_tbl (empid)
    ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (cid) REFERENCES class_tbl (classid)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `isEmployee` (
  eid int(11) NOT NULL,
  gid int(11) NOT NULL,
  startdate date,
  position varchar(255),
  PRIMARY KEY  (eid, gid),

  FOREIGN KEY (eid) REFERENCES employee_tbl (empid)
    ON DELETE CASCADE ON UPDATE CASCADE,

  FOREIGN KEY (gid) REFERENCES gym (gymid)
    ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB;


insert  into member_tbl(fname,lname) values ('Rick','Smith'),('Eddy','Fox'),('Chris','Blake'),('Maggie','Klein'),('Amy','Renolds'),('Joyce','Edwards'),('Ron','Wayne');



insert  into gym(locationName,zipCode) values ('Bellevue, WA',98015),('Kirkland, WA',98033),('Renton, WA',98057);



insert  into employee_tbl(fname,lname) values ('Ronald','Blake'),('Megan','Holloway'),('Edward','Chan'),('Kelly','Hanson'),('Frank','Bernard');



insert  into class_tbl(gid,name,classDay,classTime,durationMin,capacity) values ((SELECT gymid FROM gym WHERE locationName='Bellevue, WA'),'Yoga','Wednesday','1:30pm',60,30),((SELECT gymid FROM gym WHERE locationName='Bellevue, WA'),'Zumba','Friday','5:30pm',30,30),((SELECT gymid FROM gym WHERE locationName='Bellevue, WA'),'Step Aerobics','Monday','4:30pm',60,30);




insert  into isMember(mid,gid,startdate,activeMember) values
((SELECT memberid FROM member_tbl WHERE fname='Rick' AND lname='Smith'),(SELECT gymid FROM gym WHERE locationName='Bellevue, WA'),'2005-01-05',True),
((SELECT memberid FROM member_tbl WHERE fname='Rick' AND lname='Smith'),(SELECT gymid FROM gym WHERE locationName='Kirkland, WA'),'2005-01-05',True),
((SELECT memberid FROM member_tbl WHERE fname='Maggie' AND lname='Klein'),(SELECT gymid FROM gym WHERE locationName='Bellevue, WA'),'2008-04-08',True),
((SELECT memberid FROM member_tbl WHERE fname='Amy' AND lname='Renolds'),(SELECT gymid FROM gym WHERE locationName='Bellevue, WA'),'2012-01-20',True),
((SELECT memberid FROM member_tbl WHERE fname='Ron' AND lname='Wayne'),(SELECT gymid FROM gym WHERE locationName='Renton, WA'),'2016-11-08',True),
((SELECT memberid FROM member_tbl WHERE fname='Ron' AND lname='Wayne'),(SELECT gymid FROM gym WHERE locationName='Kirkland, WA'),'2015-01-15',True),
((SELECT memberid FROM member_tbl WHERE fname='Joyce' AND lname='Edwards'),(SELECT gymid FROM gym WHERE locationName='Renton, WA'),'2012-11-07',True),
((SELECT memberid FROM member_tbl WHERE fname='Eddy' AND lname='Fox'),(SELECT gymid FROM gym WHERE locationName='Renton, WA'),'2009-06-20',True);


insert  into isEmployee(eid,gid,startdate,position) values
((SELECT empid FROM employee_tbl WHERE fname='Ronald' AND lname='Blake'),(SELECT gymid FROM gym WHERE locationName='Bellevue, WA'),'2005-01-05','Trainer'),
((SELECT empid FROM employee_tbl WHERE fname='Megan' AND lname='Holloway'),(SELECT gymid FROM gym WHERE locationName='Kirkland, WA'),'2015-11-05','Trainer'),
((SELECT empid FROM employee_tbl WHERE fname='Edward' AND lname='Chan'),(SELECT gymid FROM gym WHERE locationName='Bellevue, WA'),'2008-04-08','Supervisor'),
((SELECT empid FROM employee_tbl WHERE fname='Kelly' AND lname='Hanson'),(SELECT gymid FROM gym WHERE locationName='Bellevue, WA'),'2012-01-20','Manager'),
((SELECT empid FROM employee_tbl WHERE fname='Frank' AND lname='Bernard'),(SELECT gymid FROM gym WHERE locationName='Renton, WA'),'2016-11-08','Trainer'),
((SELECT empid FROM employee_tbl WHERE fname='Frank' AND lname='Bernard'),(SELECT gymid FROM gym WHERE locationName='Kirkland, WA'),'2015-01-15','Trainer'),
((SELECT empid FROM employee_tbl WHERE fname='Kelly' AND lname='Hanson'),(SELECT gymid FROM gym WHERE locationName='Renton, WA'),'2012-01-20','Manager'),
((SELECT empid FROM employee_tbl WHERE fname='Kelly' AND lname='Hanson'),(SELECT gymid FROM gym WHERE locationName='Kirkland, WA'),'2012-01-20','Manager');


insert  into isStudent(mid,cid) values
((SELECT memberid FROM member_tbl WHERE fname='Rick' AND lname='Smith'),(SELECT classid FROM class_tbl WHERE name='Yoga')),
((SELECT memberid FROM member_tbl WHERE fname='Amy' AND lname='Renolds'),(SELECT classid FROM class_tbl WHERE name='Step Aerobics')),
((SELECT memberid FROM member_tbl WHERE fname='Joyce' AND lname='Edwards'),(SELECT classid FROM class_tbl WHERE name='Zumba'));


insert  into isInstructor(eid,cid) values
((SELECT empid FROM employee_tbl WHERE fname='Ronald' AND lname='Blake'),(SELECT classid FROM class_tbl WHERE name='Yoga')),
((SELECT empid FROM employee_tbl WHERE fname='Edward' AND lname='Chan'),(SELECT classid FROM class_tbl WHERE name='Step Aerobics')),
((SELECT empid FROM employee_tbl WHERE fname='Frank' AND lname='Bernard'),(SELECT classid FROM class_tbl WHERE name='Zumba'));
