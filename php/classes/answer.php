<?php
namespace DeepDiveDatingApp\DeepDiveDating;
require_once("test.php");
require_once(dirname(__DIR__, 2) . "/vendor/autoload.php");
use Ramsey\Uuid\Uuid;

/**
 * answer class is where the answers to users questions based on Dan's interests appear. They will be graded on their
 * answers to those questions.
 **/

class answer implements \JsonSerializable {
	use ValidateUuid;

	/**Id for answers user will be graded by, this is the primary key
	@var string|Uuid $answerUserId
	 **/

	private $answerUserId;
	/**
	 * Id to link answer to user, this is a foreign key
	 * @var string|Uuid $answerQuestionId
	 **/
	private $answerQuestionId;
	/**
	 * Space where the answer to the question appears
	 * @var string|Uuid $answerResult
	 **/
	private $answerResult;
	/**
	 *Actual score for user based on answers
	 **/
	private $answerScore;
}
/**


/*******Constructor for answer class************
 *
 *@param string|Uuid $newAnswerUserId id for new answers linked to user
 *@param string $newAnswerQuestionId id for new answers linked to questions
 *@param string $newAnswerResult id for result of answer from user
 *@param TINYINT $newAnswerScore value that gets calculated from answers to questions
 *@throws \InvalidArgumentException if data types are not valid
 *@throws \RangeException if data values are out of bounds
 *@throws \Exception for when an exception is thrown
 *@throws \TypeError if data types violate type hints
 **/
	public function __construct($newAnswerUserId, $newAnswerQuestionId, $newAnswerResult, $newAnswerScore) {
	try {
		$this->setAnswerUserId($newAnswerUserId);
		$this->setAnswerQuestionId($newAnswerQuestionId);
		$this->setAnswerResult($newAnswerResult);
		$this->setAnswerScore($newAnswerScore);
		//determine what exception type was thrown
	} catch(\InvalidArgumentException | \RangeException | \TypeError $exception) {
		$exceptionType = get_class($exception);
		throw(new $exceptionType ($exception->getMessage(), 0, $exception));
	}
}

/**
 * accessor method for answer user id
 *
 * @return string value of answer id (null if new user)
 **/
public function getAnswerUserId(): string {
	return ($this->answerUserId);
}
/**
 * mutator method for question id
 *
 * @param Uuid|string $newAnswerUserId is not positive
 * @throws \InvalidArgumentException if the id is not a string or is insecure
 * @throws \RangeException if $newAnswerUserId is not positive
 * @throws \TypeError if $newAnswerUserId is not a uuid or string
 **/
public function setAnswerUserId($newAnswerUserId): void {
	try {
		$uuid = self::validateUuid($newAnswerUserId);
	} catch(InvalidArguementException | \RangeException |Exception |\TypeError $exception) {
		$exceptionType = get_class($exception);
		throw(new $exceptionType ($exception->getMessage(), 0, $exception));
	}

	//convert and store answer user id
	$this->answerUserId = $uuid;
}
/**
 * accessor method for answer question id
 *
 * @return string value for answer question id
 **/

public function getAnswerQuestionId(): string {
	return ($this->answerQuestionId);
}

/**
 * mutator method for answer question id
 *
 * @param string $newAnswerQuestionId new value answer question id
 * @throws \InvalidArgumentException if the answer question id is empty
 * @throws \RangeException if the answer question id is longer than 16 characters
 **/

public function setAnswerQuestionId(string $newAnswerQuestionId) {
	if(empty($newAnswerQuestionId) == true){
		throw(new \InvalidArgumentException("This URL is empty."));
	}
	//verify the URL is no longer than 255 characters
	if(strlen($newAnswerQuestionId)>16) {
		throw(new \RangeException("This URL is too long. It must be no longer than 16 characters."));
	}
	//Store the author avatar URL
	$this->answerQuestionId = $newAnswerQuestionId;
}
