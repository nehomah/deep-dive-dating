<?php
namespace DeepDiveDatingApp\DeepDiveDating;
require_once("autoload.php");
require_once(dirname(__DIR__, 2) . "/vendor/autoload.php");
use Ramsey\Uuid\Uuid;

/**
 * question class is where users answer questions based on Dan's interests. They will be graded on their answers to
 * those questions.
 **/

class question implements \JsonSerializable {
use ValidateUuid;

/**Id for questions user will be graded by, this is the primary key
  @var string|Uuid $questionId
 **/

private $questionId;
/**
 * Id to link question to user, this is a foreign key
 * @var string|Uuid $questionUserId
 **/
private $questionUserId;
/**
 * Space where question content appears
 * @var string|Uuid $questionContent
 **/
private $questionContent;
/**
*Value assigned to each user by question section
 **/
private $questionValue;
}
/**

/**Constructor for question class
 *
 *@param string|Uuid $newQuestionId id for question set
 *@param string $newQuestionUserId id for new user to answer questions
 *@param string $newQuestionContent space where question appears
 *@param TINYINT $newQuestionValue value that gets calculated from answers to questions
 *@throws \InvalidArgumentException if data types are not valid
 *@throws \RangeException if data values are out of bounds
 *@throws \Exception for when an exception is thrown
 *@throws \TypeError if data types violate type hints
 *
 **/
public function __construct($newQuestionId, $newQuestionUserId, $newQuestionContent, $newQuestionValue) {
	try {
		$this->setQuestionId($newQuestionId);
		$this->setQuestionUserId($newQuestionUserId);
		$this->setQuestionContent($newQuestionContent);
		$this->setQuestionValue($newQuestionValue);
		//determine what exception type was thrown
	} catch(\InvalidArgumentException | \RangeException | \TypeError $exception) {
		$exceptionType = get_class($exception);
		throw(new $exceptionType ($exception->getMessage(),0, $exception));
	}
}

/**
 * accessor method for question id
 *
 * @return string value of question id (null if it is a new question id)
 **/
public function getQuestionId(): string {
	return ($this->questionId);
}
/**
 * mutator method for question id
 *
 * @param Uuid|string $newQuestionId is not positive
 * @throws \InvalidArgumentException if the id is not a string or is insecure
 * @throws \RangeException if $newQuestionId is not positive
 * @throws \TypeError if $newQuestionId is not a uuid or string
 **/
public function setQuestionId($newQuestionId): void {
	try {
		$uuid = self::validateUuid($newQuestionId);
	} catch(InvalidArguementException | \RangeException |Exception |\TypeError $exception) {
		$exceptionType = get_class($exception);
		throw(new $exceptionType ($exception->getMessage(), 0, $exception));
	}

	//convert and store question id
	$this->questionId = $uuid;
}
/**
 * accessor method for author avatar url
 *
 * @return string value of author avatar url
 **/

public function getAuthorAvatarUrl(): string {
	return ($this->authorAvatarUrl);
}

/**
 * mutator method for author avatar url
 *
 * @param string $newAuthorAvatarUrl new value author avatar url
 * @throws \InvalidArgumentException if the author url is empty
 * @throws \RangeException if the url is longer than 255 characters
 **/

public function setAuthorAvatarUrl(string $newAuthorAvatarUrl) {
	if(empty($newAuthorAvatarUrl) == true){
		throw(new \InvalidArgumentException("This URL is empty."));
	}
	//verify the URL is no longer than 255 characters
	if(strlen($newAuthorAvatarUrl)>255) {
		throw(new \RangeException("This URL is too long. It must be no longer than 255 characters."));
	}
	//Store the author avatar URL
	$this->authorAvatarUrl = $newAuthorAvatarUrl;
}
