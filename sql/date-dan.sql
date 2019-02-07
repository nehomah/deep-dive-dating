ALTER	DATABASE dating CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS user;
DROP TABLE IF EXISTS userDetail;
DROP TABLE IF EXISTS question;
DROP TABLE IF EXISTS answer;
DROP TABLE IF EXISTS match;
DROP TABLE IF EXISTS report;

CREATE TABLE user (

);

CREATE TABLE userDetail (
	userDetailId(16) NOT NULL,
	userDetailUserId(16) NOT NULL,
	userDetailAboutMe VARCHAR(144),
	userDetailAge INT NOT NULL,
	userDetailCareer VARCHAR(32),
	userDetailDisplayEmail VARCHAR(128),
	userDetailEducation VARCHAR(144),
	userDetailGender VARCHAR(144),
	userDetailInterests VARCHAR(),
	userDetailRace VARCHAR(),
	userDetailReligion VARCHAR(),
	FOREIGN KEY(userDetailUserId),
	PRIMARY KEY(userDetailId)

);

CREATE TABLE question (

);

CREATE TABLE answer (

);

CREATE TABLE match (

);

CREATE TABLE report (

);
