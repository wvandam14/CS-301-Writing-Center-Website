<<<<<<< HEAD
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
=======
use WritingCenter;

create table Clients
(	Client_ID int unsigned not null auto_increment primary key,
	fname char(50) not null,
	lname char(50) not null,
	email_address char(100) not null,
	class_standing char(20) not null,
	Graduation_year int unsigned,
	major char(50),
	secondary_major char(50),
	minor char(50),
	password char(45),
	missed_appointments int unsigned
);

create table Email_options
( 	Client_ID int references Clients,
	Make_appt boolean,
	Modify_appt boolean,
	Delete_appt boolean,
	Announcement boolean,
	Reminderof_appt boolean,
	iCal_link boolean
);


create table Consultants
(	Consultant_ID int unsigned not null auto_increment primary key,
	fname char(50) not null,
	lname char(50) not null,
	class_standing char(20) not null,
	major char(50),
	bio text(500)
);

create table Post_Consultation_Notes
(   FormID int unsigned not null auto_increment primary key,
	Client_ID int references Clients,
	Consultant_ID int references Consultants,
	Native_Language char(50),
	Copy_Sent boolean, 
	Class_ char(50),
	Assignment char(100),
	Professor char(50),
	Date_ date,
	Understand_Assignment boolean,
	Generate_Ideas char(10),
	Thesis char(10),
	Focusing_Subject char(10),
	Audience char(10),
	Organization char(10),
	Content_Development char(10),
	Introduction_Conclusion char(10),
	Sources_Research char(10),
	Citations char(10),
	Document_Design char(10),
	Sentence_Structure char(10),
	Grammar_Mechanics char(10),	
	Notes text(500)
);

create table Consultant_Evaluation_Form
(	Consultant_ID int references Consultants,
	Date_ date,
	Explained_Ideas int,
	Addressed_Concerns int,
	Comfortable int,
	Learned text(500),
	Additional_Feedback text(500)
);

create table `consultant_availability_times` (
	consultant_Id int NOT NULL,
	day_Id int(1) NOT NULL,
	times varchar(22) NOT NULL,
	FOREIGN KEY (consultant_Id) REFERENCES Accounts(accountId),
	PRIMARY KEY (consultant_Id, day_Id)
>>>>>>> d4fc3f0920d289e86f962a18cba75902bef60861
);