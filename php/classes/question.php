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
	 * @var string|Uuid $questionId
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

	/**
	 *
	 * /**Constructor for question class
	 *
	 * @param string|Uuid $newQuestionId id for question set
	 * @param string $newQuestionUserId id for new user to answer questions
	 * @param string $newQuestionContent space where question appears
	 * @param TINYINT $newQuestionValue value that gets calculated from answers to questions
	 * @throws \InvalidArgumentException if data types are not valid
	 * @throws \RangeException if data values are out of bounds
	 * @throws \Exception for when an exception is thrown
	 * @throws \TypeError if data types violate type hints
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
			throw(new $exceptionType ($exception->getMessage(), 0, $exception));
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
	 * accessor method for question user id
	 *
	 * @return string value of question user id
	 **/

	public function getQuestionUserId(): string {
		return ($this->questionUserId);
	}

	/**
	 * mutator method for question user id
	 * @param binary $newQuestionUserId new value question user id
	 * @throws \InvalidArgumentException if the question user id is empty
	 * @throws \RangeException if the question user id is too long
	 **/

	public function setQuestionUserId(binary $newQuestionUserId) {
		if(empty($newQuestionUserId) == true) {
			throw(new \InvalidArgumentException("This question is empty."));
		}
		//verify the question user id is no longer than 16 characters.
		if(binary($newQuestionUserId) > 1) {
			throw(new \RangeException("This question is too long. It must be no longer than 16 characters."));
		}
		//Store the question user id
		$this->questionUserId = $newQuestionUserId;
	}

	/**
	 * accessor method for question content
	 *
	 * @return  value of question content
	 **/

	public function getQuestionContent(): binary {
		return ($this->questionContent);
	}

	/**
	 * mutator method for question content
	 *
	 * @param varchar $newQuestionContent new value question content
	 * @throws \InvalidArgumentException if the question content is empty
	 * @throws \RangeException if the question content is longer than one integer
	 **/

	public function setQuestionContent(varchar $newQuestionContent) {
		if(empty($newQuestionContent) == true) {
			throw(new \InvalidArgumentException("This question content is empty."));
		}
		//verify the question content is no longer than 128 characters
		if(varchar($newQuestionContent) > 1) {
			throw(new \RangeException("This question content is too long. It must be no longer than 128 characters."));
		}
		//Store the question
		$this->questionContent = $newQuestionContent;
	}

	/**
	 * insert this question content in mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/

	public function insert(\PDO $pdo): void {
		// create query template
		$query = "INSERT INTO question(questionId, questionUserId, questionContent, questionValue) VALUES(:questionId, :questionUserId, :questionContent, :questionValue)";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holders in the template
		$parameters = ["questionId" => $this->questionId->getBytes(), "questionUserId" => $this->questionUserId->getBytes(), "questionContent" => $this->questionContent, "questionValue" => $this->questionValue->getBytes()];
		$statement->execute($parameters);
	}

	/**
	 * deletes this question from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 **/
	public function delete(\PDO $pdo): void {

		// create query template
		$query = "DELETE FROM question WHERE questionContent = :questionContent";
		$statement = $pdo->prepare($query);

		// bind the member variables to the place holder in the template
		$parameters = ["questionContent" => $this->questionContent->getBytes()];
		$statement->execute($parameters);
	}

	/**
	 * /**
	 * updates this question in MySQL
	 *
	 * @param \PDO $pdo connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 */
	public function update(\PDO $pdo): void {

		//create query template
		$query = "UPDATE question SET questionId = :questionId, questionUserId = :questionUserId, questionContent = :questionContent, questionValue = :questionValue";
		$statement = $pdo->prepare($query);

		$parameters = ["questionId" => $this->questionId->getBytes(), "questionUserId" => $this->questionUserId, "questionContent" => $this->questionContent, "questionValue" => $this->questionValue];
		$statement->execute($parameters);
	}

	/**
	 * gets the Question by questionId
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid|string $questionId question id
	 * @return Author|null Question found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when a variable are not the correct data type
	 **/
	public static function getQuestionByQuestionId(\PDO $pdo, $questionId): ?Question {
		// sanitize the questionId before searching
		try {
			$authorId = self::validateUuid($questionId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}

		// create query template
		$query = "SELECT questionId, questionUserId, questionContent, questionValue FROM question WHERE questionId = :questionId";
		$statement = $pdo->prepare($query);

		// bind the question id to the place holder in the template
		$parameters = ["questionId" => $questionId->getBytes()];
		$statement->execute($parameters);

		// grab the question from mySQL
		try {
			$question = null;
			$statement->setFetchMode(\PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$question = new Question($row["questionId"], $row["questionUserId"], $row["questionContent"], $row["questionValue"]);
			}
		} catch(\Exception $exception) {
			// if the row couldn't be converted, rethrow it
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		return ($question);
	}

	/**
	 *
	 * gets all Questions
	 *
	 * @param \PDO $pdo PDO connection object
	 * @return \SplFixedArray SplFixedArray of Question found or null if not found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError when variables are not the correct data type
	 **/
	public static function getAllQuestions(\PDO $pdo): \SPLFixedArray {
		// create query template
		$query = "SELECT questionId, questionUserId, questionContent, questionValue FROM question";
		$statement = $pdo->prepare($query);
		$statement->execute();

		// build an array of authors
		$question = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$question = new Question($row["questionId"], $row["questionUserId"], $row["questionContent"], $row["questionValue"]);
				$question[$question->key()] = $question;
				$question->next();
			} catch(\Exception $exception) {
				// if the row couldn't be converted, rethrow it
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($question);
	}

	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize(): array {
		$fields = get_object_vars($this);

		$fields["questionId"] = $this->questionId->toString();
		$fields["questionUserId"] = $this->questionUserId->toString();

		//format the date so that the front end can consume it
		$fields["questionContent"] = round(floatval($this->questionContent->format("U.u")) * 1000);
		return ($fields);
	}
}