CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE rooms (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    description TEXT
);

CREATE TABLE education_level (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    duration INT DEFAULT 1
);

CREATE TABLE education (
    id INT PRIMARY KEY AUTO_INCREMENT,
    room_id INT NOT NULL,
    education_level_id INT NOT NULL,

);

CREATE TABLE tests (
    id INT PRIMARY KEY AUTO_INCREMENT,
    education_level_id INT NOT NULL,
    question TEXT NOT NULL,

);

CREATE TABLE results_tests (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    test_id INT NOT NULL,
    date DATE NOT NULL,

);

CREATE TABLE arrival_announcements (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    room_id INT NOT NULL,
    date_f_coming DATE NOT NULL,

);

CREATE TABLE arrivals (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    room_id INT NOT NULL,
    arrival_time DATETIME NOT NULL,
    departure time DATETIME,
    signature TEXT NOT NULL,
    gdpr BOOLEAN NOT NULL,
);
