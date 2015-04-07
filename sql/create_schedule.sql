create table schedules
(
scheduleID int NOT NULL UNIQUE AUTO_INCREMENT PRIMARY KEY, 
consultantID int NOT NULL,
date_ date,
time_slot varchar(5),
status_ varchar(20),
adminID int NOT NULL,
date_created timestamp,
FOREIGN KEY (consultantID) references Accounts(accountID),
FOREIGN KEY (adminID)  REFERENCES Accounts(accountID)
);
