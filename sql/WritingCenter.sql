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
