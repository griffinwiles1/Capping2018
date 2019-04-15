DROP TABLE IF EXISTS Prayer_Religion;
DROP TABLE IF EXISTS User_religion;
DROP TABLE IF EXISTS Prayer_Tag;
DROP TABLE IF EXISTS Religion;
DROP TABLE IF EXISTS Tag;
DROP TABLE IF EXISTS Prayer;
DROP TABLE IF EXISTS Message;
DROP TABLE IF EXISTS Comment;
DROP TABLE IF EXISTS Notifications;


DROP TABLE IF EXISTS Prayer_Tags;
DROP TABLE IF EXISTS Prayer_Religions;
DROP TABLE IF EXISTS User_Messages;
DROP TABLE IF EXISTS User_Religions;
DROP TABLE IF EXISTS Likes;
DROP TABLE IF EXISTS Messages;
DROP TABLE IF EXISTS Comments;
DROP TABLE IF EXISTS Tags;
DROP TABLE IF EXISTS Prayers;
DROP TABLE IF EXISTS Users;
DROP TABLE IF EXISTS Religions;


CREATE TABLE Religions(
    relid INT(10) PRIMARY KEY AUTO_INCREMENT,
    religion_name VARCHAR(30),
    dateLastMaint DATETIME DEFAULT CURRENT_TIMESTAMP,
    dateAdded DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Users(
    userid INT(10) PRIMARY KEY AUTO_INCREMENT,
    fname VARCHAR(20),
    lname VARCHAR(20),
    username VARCHAR(12),
    user_password VARCHAR(15),
    bio TEXT,
    zipCode INT(10),
    Primary_religion INT(10),
    theme VARCHAR(20) DEFAULT 'LIGHT',
    email VARCHAR(30),
    phone_number VARCHAR(15),
    pPicture VARCHAR(20),
    bPicture VARCHAR(20),
    securityquest VARCHAR(100),
    securityAnswer VARCHAR(20),
    dateLastMaint DATETIME DEFAULT CURRENT_TIMESTAMP,
    dateAdded DATETIME DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT FK_Users_Religions FOREIGN KEY (Primary_religion) REFERENCES Religions (relid)
);

CREATE TABLE Tags(
    tagid INT(10) PRIMARY KEY AUTO_INCREMENT,
    tag_name VARCHAR(14),
    dateLastMaint DATETIME DEFAULT CURRENT_TIMESTAMP,
    dateAdded DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE Prayers(
    prayid INT(10) PRIMARY KEY AUTO_INCREMENT,
    userid INT(10),
    content VARCHAR(140),
    descript TEXT,
    pray_status INT(1),
    exclusive INT(1),
    post_date DATETIME,
    img VARCHAR(15),
    dateLastMaint DATETIME DEFAULT CURRENT_TIMESTAMP,
    dateAdded DATETIME DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT FK_Users_Prayer FOREIGN KEY (userid) REFERENCES Users (userid)
);

CREATE TABLE Prayer_Tags(
    prayid INT(10),
    tagid INT(10),
    PRIMARY KEY(prayid, tagid),
    dateLastMaint DATETIME DEFAULT CURRENT_TIMESTAMP,
    dateAdded DATETIME DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT FK_Prayer_PrayerTags FOREIGN KEY (prayid) REFERENCES Prayers (prayid),
    CONSTRAINT FK_Tag_PrayerTags FOREIGN KEY (tagid) REFERENCES Tags (tagid)
);

CREATE TABLE Prayer_Religions(
    prayid INT(10),
    relid INT(10),
    PRIMARY KEY(prayid, relid),
    dateLastMaint DATETIME DEFAULT CURRENT_TIMESTAMP,
    dateAdded DATETIME DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT FK_Prayer_PrayerReligions FOREIGN KEY (prayid) REFERENCES Prayers (prayid),
    CONSTRAINT FK_Religion_PrayerReligions FOREIGN KEY (relid) REFERENCES Religions (relid)
);


CREATE TABLE User_Religions(
    userid INT(10),
    relid INT(10),
    reputation INT(10) DEFAULT 0,
    isMod BOOLEAN DEFAULT 0,
    dateLastMaint DATETIME DEFAULT CURRENT_TIMESTAMP,
    dateAdded DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(userid, relid),
    CONSTRAINT FK_User_UserReligion FOREIGN KEY (userid) REFERENCES Users (userid) ON DELETE RESTRICT,
    CONSTRAINT FK_Religion_UserReligion FOREIGN KEY (relid) REFERENCES Religions (relid) ON DELETE RESTRICT
);

CREATE TABLE Likes(
    userid INT(10),
    prayid INT(10),
    isChecked BOOLEAN DEFAULT 0,
    isLike BOOLEAN,
    dateLastMaint DATETIME DEFAULT CURRENT_TIMESTAMP,
    dateAdded DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(userid, prayid),
    CONSTRAINT FK_User_Likes FOREIGN KEY (userid) REFERENCES Users (userid),
    CONSTRAINT FK_Prayer_Likes FOREIGN KEY (prayid) REFERENCES Prayers (prayid)
);

CREATE TABLE Comments(
    commid INT(10) PRIMARY KEY AUTO_INCREMENT,
    userid INT(10),
    prayid INT(10),
    comment VARCHAR(5000),
    isChecked BOOLEAN DEFAULT 0,
    dateLastMaint DATETIME DEFAULT CURRENT_TIMESTAMP,
    dateAdded DATETIME DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT FK_User_Comments FOREIGN KEY (userid) REFERENCES Users (userid),
    CONSTRAINT FK_Prayer_Comments FOREIGN KEY (prayid) REFERENCES Prayers (prayid)
);

CREATE TABLE Messages(
    messageid INT(10) PRIMARY KEY AUTO_INCREMENT,
    msg VARCHAR(5000),
    userid INT(10),
    img VARCHAR(5000),
    dateLastMaint DATETIME DEFAULT CURRENT_TIMESTAMP,
    dateAdded DATETIME DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT FK_User_Messages FOREIGN KEY (userid) REFERENCES Users (userid)
);

CREATE TABLE User_Messages(
    messageid INT(10),
    userid INT(10),
    isChecked BOOLEAN DEFAULT 0,
    dateLastMaint DATETIME DEFAULT CURRENT_TIMESTAMP,
    dateAdded DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (messageid, userid),
    CONSTRAINT FK_User_Messages_Users FOREIGN KEY (userid) REFERENCES Users (userid),
    CONSTRAINT FK_Messages_UserMessages FOREIGN KEY (messageid) REFERENCES Messages (messageid)
);

Insert into Religions(religion_name) VALUES
('Admin Updates'),
('Christianity'),
('Judaism'),
('Islam'),
('Buddhism'),
('Hinduism'),
("Baha'i"),
('Confucianism'),
('Jainism'),
('Shinto'),
('Sikhism'),
('Taoism'),
('Agnosticism'),
('Atheism'),
('Mormonism'),
('Scientology'),
('Zoroastrianism');

INSERT INTO USERS (fname,lname,username,user_password,zipCode,primary_religion, email,phone_number, pPicture, bPicture)VALUES
('P.R.A.Y.', 'Admin','Admin','D0N0t@M3', 12601, 1, 'Admin@pray.com', '888-888-8888', '1.jpg', '1.jpg'),
('Test', 'User', 'TestUser', 'Marist', 12601, 2, 'TestUser@pray.com', '888-777-66666','2.jpg', '2.jpg'),
('Riley', 'Stadel', 'RStadel', 'Marist', 12601, 2, 'Riley.stadel1@gmail.com', '717-723-7629','2.jpg', '2.jpg'),
('Griffin', 'Wiles', 'GWiles', 'Marist', 12601, 2, 'TestUser@pray.com', '888-777-66666','2.jpg', '2.jpg'),
('Dan', 'Schroeder', 'DSchroeder', 'Marist', 12601, 2, 'TestUser@pray.com', '888-777-66666','2.jpg', '2.jpg'),
('Ryan', 'Demayo', 'RDemayo', 'Marist', 12601, 2, 'TestUser@pray.com', '888-777-66666','2.jpg', '2.jpg'),
('Christian', 'Gorokhovsky', 'CGorokhovsky', 'Marist', 12601, 2, 'TestUser@pray.com', '888-777-66666','2.jpg', '2.jpg');

INSERT INTO Prayers(userid, content)VALUES
(1,'Welcome to P.R.A.Y.');

INSERT INTO Prayer_Religions(prayid, relid)
VALUES(1,1);

INSERT INTO Comments(userid,prayid,comment)VALUES
(1,1,'Choose a Religion to Start'),
(2,1,'Great Prayer!!!');


INSERT INTO User_Religions (userid, relid, reputation, isMod)VALUES
(1, 1, 500, 1),
(2, 2, 200, 0),
(3, 2, 200, 0),
(4, 2, 200, 0),
(5, 2, 200, 0),
(6, 2, 200, 0),
(7, 2, 200, 0),
(2, 3, 50, 0),
(2, 4, 0, 0);

INSERT INTO TAGS(tag_name)VALUES
('God'),
('Religion'),
('Pray'),
('Faith'),
('Believe');

INSERT INTO PRAYER_TAGS(prayid, tagid) VALUES
(1, 3),
(1, 5);

INSERT INTO Messages(userid, msg)VALUES
(2,'This is a test message right here'),
(1,'I will be making'),
(2,'Many test messages'),
(2,'Just to test how'),
(1,'This messaging system will work.'),
(1,'This message will be really long because I need to make sure that really long messages still look nice in the message feed. In contrast the next message will be'),
(2,'Short');

INSERT INTO User_Messages(messageid,userid,isChecked)VALUES
(1,1,0),
(2,2,1),
(3,1,1),
(4,1,1),
(5,2,1),
(6,2,1),
(7,1,1);

INSERT INTO Likes(userid,prayid,isChecked,isLike)VALUES
(1,1,0,1),
(2,1,0,1);
