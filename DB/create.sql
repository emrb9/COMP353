CREATE TABLE Persons
(
    SSN          INT PRIMARY KEY,
    cellNumber   VARCHAR(15) NOT NULL,
    firstName    VARCHAR(63) NOT NULL,
    lastName     VARCHAR(63) NOT NULL,
    citizenship  VARCHAR(63) NOT NULL,
    dateOfBirth  DATE        NOT NULL,
    emailAddress VARCHAR(63) NOT NULL,
    occupation   VARCHAR(63) NOT NULL
);

CREATE TABLE Employees
(
    SSN            INT PRIMARY KEY,
    medicareNumber VARCHAR(12) NOT NULL,
    role           VARCHAR(63) NOT NULL,
    UNIQUE (medicareNumber)
);

CREATE TABLE LivesWith
(
    personSSN    INT,
    employeeSSN  INT,
    relationship VARCHAR(63) NOT NULL,
    FOREIGN KEY (personSSN) REFERENCES Persons (SSN),
    FOREIGN KEY (employeeSSN) REFERENCES Employees (SSN),
    PRIMARY KEY (personSSN, employeeSSN)
);

CREATE TABLE Vaccinations
(
    SSN        INT,
    doseNumber INT,
    type       VARCHAR(31),
    date       DATE         NOT NULL,
    address    VARCHAR(127) NOT NULL,
    postalCode VARCHAR(7)   NOT NULL,
    FOREIGN KEY (SSN) REFERENCES Persons (SSN),
    PRIMARY KEY (SSN, doseNumber, type)
);

CREATE TABLE Infections
(
    SSN  INT,
    type VARCHAR(63),
    date DATE,
    FOREIGN KEY (SSN) REFERENCES Persons (SSN),
    PRIMARY KEY (SSN, type, date)
);

CREATE TABLE Residences
(
    address       VARCHAR(127),
    postalCode    VARCHAR(7),
    city          VARCHAR(63) NOT NULL,
    province      VARCHAR(31) NOT NULL,
    type          VARCHAR(31) NOT NULL,
    phoneNumber   VARCHAR(15) NOT NULL,
    bedroomNumber INT         NOT NULL,
    PRIMARY KEY (address, postalCode)
);

CREATE TABLE PrimaryResidences
(
    SSN          INT PRIMARY KEY,
    address      VARCHAR(127) NOT NULL,
    postalCode   VARCHAR(7)   NOT NULL,
    startingDate DATE         NOT NULL,
    FOREIGN KEY (SSN) REFERENCES Persons (SSN),
    FOREIGN KEY (address, postalCode) REFERENCES Residences (address, postalCode)
);

CREATE TABLE SecondaryResidences
(
    SSN          INT,
    address      VARCHAR(127) NOT NULL,
    postalCode   VARCHAR(7)   NOT NULL,
    startingDate DATE         NOT NULL,
    FOREIGN KEY (SSN) REFERENCES Persons (SSN),
    FOREIGN KEY (address, postalCode) REFERENCES Residences (address, postalCode),
    PRIMARY KEY (SSN, address, postalCode)
);

CREATE TABLE Facilities
(
    address     VARCHAR(127),
    postalCode  VARCHAR(7),
    name        VARCHAR(127) NOT NULL,
    city        VARCHAR(63)  NOT NULL,
    province    VARCHAR(31)  NOT NULL,
    type        VARCHAR(31)  NOT NULL,
    phoneNumber VARCHAR(15)  NOT NULL,
    capacity    INT          NOT NULL,
    webAddress  VARCHAR(63)  NOT NULL,
    managerSSN  INT          NOT NULL,
    UNIQUE (managerSSN),
    FOREIGN KEY (managerSSN) REFERENCES Employees (SSN),
    PRIMARY KEY (address, postalCode)
);

CREATE TABLE WorksAt
(
    SSN        INT          NOT NULL,
    startDate  DATE         NOT NULL,
    endDate    DATE,
    address    VARCHAR(127) NOT NULL,
    postalCode VARCHAR(7)   NOT NULL,
    FOREIGN KEY (SSN) REFERENCES Employees (SSN),
    FOREIGN KEY (address, postalCode) REFERENCES Facilities (address, postalCode),
    PRIMARY KEY (SSN, startDate, address, postalCode)
);

CREATE TABLE Schedules
(
    SSN        INT          NOT NULL,
    address    VARCHAR(127) NOT NULL,
    postalCode VARCHAR(7)   NOT NULL,
    startTime  TIME         NOT NULL,
    endTime    TIME         NOT NULL,
    date       DATE         NOT NULL,
    FOREIGN KEY (SSN) REFERENCES Employees (SSN),
    FOREIGN KEY (address, postalCode) REFERENCES Facilities (address, postalCode),
    PRIMARY KEY (SSN, address, postalCode, startTime, date)
);

CREATE TABLE Logs
(
    logId    INT PRIMARY KEY AUTO_INCREMENT,
    date     DATETIME     NOT NULL,
    sender   VARCHAR(127) NOT NULL, # Facility name
    receiver VARCHAR(127) NOT NULL, # Person's email address
    subject  VARCHAR(127) NOT NULL, # Facility name + Schedule (CLSC Outremont Schedule for Monday 20Feb-2023 to Sunday 26-Feb-2023)
    body     VARCHAR(255) NOT NULL  # First 100 words of email body
);