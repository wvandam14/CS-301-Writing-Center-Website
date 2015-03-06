create table AccountTypes
(
accountTypeId int NOT NULL UNIQUE AUTO_INCREMENT,
`type` varchar(20),
primary key (accountTypeId)
);

create table AccountDetails
(
accountDetailId int NOT NULL UNIQUE AUTO_INCREMENT,
class_standing varchar(50) NOT NULL,
graduation_year int UNSIGNED NULL,
major varchar(50) NOT NULL,
secondary_major varchar(50) NULL,
minor varchar(50) NULL,
bio text(500) NULL,
missed_appointments int unsigned NULL,
primary key (accountDetailId)
);

create table Accounts
(
accountId int NOT NULL UNIQUE AUTO_INCREMENT,
fname varchar(50) NOT NULL,
lname varchar(50) NOT NULL,
email_address varchar(100) NOT NULL,
`password` varchar(128),
accountTypeId int NOT NULL,
accountDetails int NULL,
primary key (accountId),
FOREIGN KEY (accountTypeId) REFERENCES AccountTypes(accountTypeId),
FOREIGN KEY (accountDetails) REFERENCES AccountDetails(accountDetailId)
);

create table Pages
(
pageId int NOT NULL UNIQUE AUTO_INCREMENT,
pagename varchar(50),
primary key (pageId)
);

create table ViewPagePermissions
(
permId int NOT NULL UNIQUE AUTO_INCREMENT,
accountTypeId int NOT NULL,
pageId int NOT NULL,
primary key (permId),
FOREIGN KEY (accountTypeId) REFERENCES AccountTypes(accountTypeId),
FOREIGN KEY (pageId) REFERENCES Pages(pageId)
);


create table Email_options
( Client_ID int,
Make_appt boolean,
Modify_appt boolean,
Delete_appt boolean,
Announcement boolean,
Reminderof_appt boolean,
iCal_link boolean,
FOREIGN KEY (Client_ID) references Accounts(accountId)
);

create table Post_Consultation_Notes
( FormID int unsigned NOT NULL UNIQUE AUTO_INCREMENT,
Client_ID int NOT NULL,
Consultant_ID int NOT NULL,
Native_Language varchar(50),
Copy_Sent boolean,
Class_ varchar(50),
Assignment varchar(100),
Professor varchar(50),
Date_ date,
Understand_Assignment boolean,
Generate_Ideas varchar(10),
Thesis varchar(10),
Focusing_Subject varchar(10),
Audience varchar(10),
Organization varchar(10),
Content_Development varchar(10),
Introduction_Conclusion varchar(10),
Sources_Research varchar(10),
Citations varchar(10),
Document_Design varchar(10),
Sentence_Structure varchar(10),
Grammar_Mechanics varchar(10),
Notes text(500),
primary key (FormID),
FOREIGN KEY (Client_ID) REFERENCES Accounts(accountId),
FOREIGN KEY (Consultant_ID) REFERENCES Accounts(accountId)
);

create table Consultant_Evaluation_Form
(
FormId int unsigned NOT NULL UNIQUE AUTO_INCREMENT,
Consultant_ID int,
Date_ date,
Explained_Ideas int,
Addressed_Concerns int,
Comfortable int,
Learned text(500),
Additional_Feedback text(500),
PRIMARY KEY (FormId),
FOREIGN KEY (Consultant_ID) references Accounts(accountId)
);