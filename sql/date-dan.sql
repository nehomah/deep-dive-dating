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
	userDetailId BINARY(16) NOT NULL,
	userDetailUserId BINARY(16) NOT NULL,
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
	questionId BINARY(16) NOT NULL,
	questionUserId BINARY(16) NOT NULL,
	questionContent VARCHAR (128) NOT NULL,
	questionValue TINYINT (1) NOT NULL,
	FOREIGN KEY(questionUserId) REFERENCES user(userId),
	PRIMARY KEY(questionId)
);

CREATE TABLE answer (
	answerUserId BINARY(16) NOT NULL,
	answerQuestionId BINARY(16) NOT NULL,
	answerResult TINYINT(1) NOT NULL,
	answerScore TINYINT(1) NOT NULL,
	FOREIGN KEY (answerUserId) REFERENCES user(userId),
	FOREIGN KEY (answerQuestionId) REFERENCES question(questionId),
	INDEX answer(userId, questionId)
);

CREATE TABLE match (

);

CREATE TABLE report (

);
