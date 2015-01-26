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
	Notes text(500)
);

create table Focus
(	FormID int references Post_Consultation_Notes,
	Understand_Assignment boolean,
	Generate_Ideas boolean,
	Thesis boolean,
	Focusing_Subject boolean,
	Audience boolean,
	Organization boolean,
	Content_Development boolean,
	Introduction_Conclusion boolean,
	Sources_Research boolean,
	Citations boolean,
	Document_Design boolean,
	Sentence_Structure boolean,
	Grammar_Mechanics boolean	
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
