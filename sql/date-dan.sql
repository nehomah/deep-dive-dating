ALTER	DATABASE dating CHARACTER SET utf8 COLLATE utf8_unicode_ci;

DROP TABLE IF EXISTS user;
DROP TABLE IF EXISTS userDetail;
DROP TABLE IF EXISTS question;
DROP TABLE IF EXISTS answer;
DROP TABLE IF EXISTS `match`;
DROP TABLE IF EXISTS report;

CREATE TABLE user (
	userId BINARY(16) NOT NULL,
	userActivationToken CHAR(32),
	userAgent VARCHAR(255),
	userAvatarUrl VARCHAR(255),
	userBlocked TINYINT,
	userEmail VARCHAR(128) NOT NULL,
	userHandle VARCHAR(32) NOT NULL,
	userHash CHAR(97) NOT NULL,
	userIpAddress BINARY(16) NOT NULL,
	UNIQUE (userHandle),
	UNIQUE (userEmail),
	INDEX (userHandle),
	PRIMARY KEY(userId)

);

CREATE TABLE userDetail (
	userDetailId BINARY(16) NOT NULL,
	userDetailUserId BINARY(16) NOT NULL,
	userDetailAboutMe VARCHAR(144),
	userDetailAge INT(3) NOT NULL,
	userDetailCareer VARCHAR(32),
	userDetailDisplayEmail VARCHAR(128),
	userDetailEducation VARCHAR(144),
	userDetailGender VARCHAR(32) NOT NULL,
	userDetailInterests VARCHAR(144),
	userDetailRace VARCHAR(32),
	userDetailReligion VARCHAR(32),
	FOREIGN KEY(userDetailUserId) REFERENCES user(detailUserId),
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

CREATE TABLE `match` (
	matchUserId BINARY(16) NOT NULL,
	matchToUserId BINARY(16) NOT NULL,
	matchApproved TINYINT(1) NOT NULL,
	INDEX (matchUserId),
	INDEX (matchToUserId),
	FOREIGN KEY (matchUserId) REFERENCES user(userId),
	FOREIGN KEY (matchToUserId) REFERENCES user(userId),
	PRIMARY KEY (matchUserId, matchToUserId)
);

CREATE TABLE report (
	reportUserId BINARY(16) NOT NULL,
	reportAbuserId BINARY(16) NOT NULL,
	reportAgent VARCHAR(255) NOT NULL,
	reportContent VARCHAR(255) NOT NULL,
	reportDate DATETIME(6) NOT NULL,
	reportIp BINARY (16) NOT NULL,
	INDEX (reportUserId),
	INDEX (reportAbuserId),
	FOREIGN KEY (reportUserId) REFERENCES user(userId),
	FOREIGN KEY (reportAbuserId) REFERENCES user(userId),
	PRIMARY KEY (reportUserId, reportAbuserId)
);
