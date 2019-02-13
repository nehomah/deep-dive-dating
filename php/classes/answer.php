<?php
namespace DeepDiveDatingApp\DeepDiveDating;
require_once("autoload.php");
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
		throw(new \InvalidArgumentException("This answer question id is empty."));
	}
	//verify the answer question id is no longer than 16 characters
	if(strlen($newAnswerQuestionId)>16) {
		throw(new \RangeException("This answer question id is too long. It must be no longer than 16 characters."));
	}
	//Store the answer question id
	$this->answerQuestionId = $newAnswerQuestionId;
}
/**
 * accessor method for answer result
 *
 * @return tinyint value of answer result
 **/

public function getAnswerResult(): tinyint {
	return ($this->answerResult);
}

/**
 * mutator method for answer result
 *
 * @param tinyint $newAnswerResult new value answer result
 * @throws \InvalidArgumentException if the answer result is empty
 * @throws \RangeException if the answer is result is longer than 1
 **/

public function setAnswerResult(tinyint $newAnswerResult) {
	if(empty($newAnswerResult) == true){
		throw(new \InvalidArgumentException("This answer result is empty."));
	}
	//verify the answer result is no longer than 1 integer.
	if(tinyint($newAnswerResult)>1) {
		throw(new \RangeException("This answer result is too long. It must be no longer than 1 character."));
	}
	//Store the answer result
	$this->answerResult = $newAnswerResult;
}
/**
 * accessor method for answer score
 *
 * @return tinyint value of answer score
 **/

public function getAnswerScore(): tinyint {
	return ($this->answerScore);
}

/**
 * mutator method for answer score
 *
 * @param tinyint $newAnswerScore new value answer score
 * @throws \InvalidArgumentException if the answer score is empty
 * @throws \RangeException if the answer score is longer than one integer
 **/

public function setAnswerScore(tinyint $newAnswerScore) {
	if(empty($newAnswerScore) == true){
		throw(new \InvalidArgumentException("This score is empty."));
	}
	//verify the answer score is no longer than one integer
	if(tinyint($newAnswerScore)>1) {
		throw(new \RangeException("This answer score is too long. It must be no longer than 1 character."));
	}
	//Store the answer score
	$this->answerScore = $newAnswerScore;
}
/**
 * insert this answer in mySQL
 *
 * @param \PDO $pdo PDO connection object
 * @throws \PDOException when mySQL related errors occur
 * @throws \TypeError if $pdo is not a PDO connection object
 **/

public function insert(\PDO $pdo): void {
	// create query template
	$query = "INSERT INTO answer(answerUserId, answerQuestionId, answerResult, answerScore) VALUES(:answerUserId, :answerQuestionId, :answerResult, :answerScore)";
	$statement = $pdo->prepare($query);

	//bind the member variables to the place holders in the template
	$parameters = ["answerUserId" => $this->answerUserId->getBytes(), "answerQuestionId" => $this->answerQuestionId->getBytes(), "answerResult" => $this->answerResult, "answerScore"=> $this->answerScore->getBytes()];
	$statement->execute($parameters);
}
/**
 * deletes this answer from mySQL
 *
 * @param \PDO $pdo PDO connection object
 * @throws \PDOException when mySQL related errors occur
 * @throws \TypeError if $pdo is not a PDO connection object
 **/
public function delete(\PDO $pdo) : void {

	// create query template
	$query = "DELETE FROM answer WHERE answerUserId = :answerUserId";
	$statement = $pdo->prepare($query);

	// bind the member variables to the place holder in the template
	$parameters = ["answerUserId" => $this->answerUserId->getBytes()];
	$statement->execute($parameters);
}
/**
/**
 * updates this answer in MySQL
 *
 * @param \PDO $pdo connection object
 * @throws \PDOException when mySQL related errors occur
 * @throws \TypeError if $pdo is not a PDO connection object
 */
public function update (\PDO $pdo) : void {

	//create query template
	$query = "UPDATE answer SET answerUserId = :answerUserId, answerQuestionId = :answerQuestionId, answerResult = :answerResult, answerScore = :answerScore";
	$statement = $pdo->prepare($query);

	$parameters = ["answerUserId"=> $this->answerUserId->getBytes(), "answerQuestionId"=> $this->answerQuestionId, "answerResult"=> $this->answerResult, "answerScore"=> $this->answerScore];
	$statement->execute($parameters);
}
/**
 * gets the Answer by answerUserId
 *
 * @param \PDO $pdo PDO connection object
 * @param Uuid|string $answerUserId answer user id
 * @return Author|null Answer found or null if not found
 * @throws \PDOException when mySQL related errors occur
 * @throws \TypeError when a variable are not the correct data type
 **/
public static function getAnswerByAnswerUserId(\PDO $pdo, $authorId) : ?Answer {
	// sanitize the answerUserId before searching
	try {
		$authorId = self::validateUuid($authorId);
	} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
		throw(new \PDOException($exception->getMessage(), 0, $exception));
	}

	// create query template
	$query = "SELECT answerUserId, answerQuestionId, answerResult, answerScore FROM answer WHERE answerUserId = :answerUserId";
	$statement = $pdo->prepare($query);

	// bind the tweet id to the place holder in the template
	$parameters = ["answerUserId" => $answerUserId->getBytes()];
	$statement->execute($parameters);

	// grab the answer from mySQL
	try {
		$answer = null;
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		$row = $statement->fetch();
		if($row !== false) {
			$answer= new Answer($row["answerUSerId"], $row["answerQuestionId"], $row["answerResult"], $row["answerScore"]);
		}
	} catch(\Exception $exception) {
		// if the row couldn't be converted, rethrow it
		throw(new \PDOException($exception->getMessage(), 0, $exception));
	}
	return ($answer);
}
/**
 *
 * gets all Authors
 *
 * @param \PDO $pdo PDO connection object
 * @return \SplFixedArray SplFixedArray of Aunswer found or null if not found
 * @throws \PDOException when mySQL related errors occur
 * @throws \TypeError when variables are not the correct data type
 **/
public static function getAllAnswers(\PDO $pdo) : \SPLFixedArray {
	// create query template
	$query = "SELECT answerUserId, answerQuestionId, answerResult, answerScore FROM answer";
	$statement = $pdo->prepare($query);
	$statement->execute();

	// build an array of authors
	$answer = new \SplFixedArray($statement->rowCount());
	$statement->setFetchMode(\PDO::FETCH_ASSOC);
	while(($row = $statement->fetch()) !== false) {
		try {
			$answer = new Answer($row["answerUserId"], $row["answerQuestionId"], $row["answerResult"], $row["answerScore"]);
			$answer[$answer->key()] = $answer;
			$answer->next();
		} catch(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
	}
	return ($answer);
}

/**
 * formats the state variables for JSON serialization
 *
 * @return array resulting state variables to serialize
 **/
public function jsonSerialize() : array {
	$fields = get_object_vars($this);

	$fields["answerUserId"] = $this->answerUserId->toString();
	$fields["answerQuestionId"] = $this->answerQuestionId->toString();

	//format the date so that the front end can consume it
	$fields["answerResult"] = round(floatval($this->answerResult->format("U.u")) * 1000);
	return($fields);
}
}