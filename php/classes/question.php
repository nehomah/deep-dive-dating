<?php
namespace DeepDiveDatingApp\DeepDiveDating;
require_once("test.php");
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

/*******Constructor for question class************
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

}