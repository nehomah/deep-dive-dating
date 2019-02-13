<?php
namespace DeepDiveDatingApp\DeepDiveDating;
require_once("autoload.php");
require_once(dirname(__DIR__, 2) . "/vendor/autoload.php");
use Ramsey\Uuid\Uuid;


/**
 * Match Class
 *
 * This class will be used to store and monitor when a user likes or matches with another user
 *
 * @author Taylor Smith
 * @version 1
 */

class Match implements \JsonSerializable {
	use ValidateUuid;
	/**
	 * id for the user who liked a profile; this is a foreign key
	 * @var Uuid $matchUserId
	 */
	private $matchUserId;
	/**
	 * id for the user who's profile was liked; this is a foreign key
	 * @var Uuid $matchToUserId
	 */
	private $matchToUserId;
	/**
	 * value of match; 1 = true, both users are matched; 0 = false, at least one user has not matched
	 * @var Int $matchApproved
	 */
	private $matchApproved;

	/**
	 * Constructor for this Match
	 *
	 * @param string|Uuid $newMatchUserId id of the user who liked a profile
	 * @param string|Uuid $newMatchToUserId id of the user who's profile was liked
	 * @param int $newMatchApproved value representing match reciprocity
	 * @throws \InvalidArgumentException if data types are invalid
	 * @throws \RangeException if values are too long or negative
	 * @throws \TypeError if data types violate provided hints
	 * @throws \Exception for other exceptions
	 */
	public function __construct($newMatchUserId, $newMatchToUserId, $newMatchApproved) {
		try {
			$this->setMatchUserId($newMatchUserId);
			$this->setMatchToUserId($newMatchToUserId);
			$this->setMatchApproved($newMatchApproved);
		}

		catch (\InvalidArgumentException | \TypeError | \RangeException | \Exception $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * accessor method for Match User Id
	 *
	 * @return Uuid value of User Id for the person who liked a profile
	 */
	public function getMatchUserId() : Uuid {
		return ($this->matchUserId);
	}
	/**
	 * accessor method for Match To User Id
	 *
	 * @return Uuid value of the Id for the person who;s page was liked
	 */
	public function getMatchToUserId() : Uuid {
		return ($this->matchToUserId);
	}
	/**
	 * accessor method for Match Approved
	 *
	 * @return INT value 1 or 0 representing if a match is mutual or not
	 */
	public function getMatchApproved() : INT {
		return ($this->matchApproved);
	}

	/**
	 * mutator method for Match Approved
	 *
	 * @param INT new Match Approved Value
	 * @throws \InvalidArgumentException if input is not a valid type
	 * @throws \RangeException if integer is not 0 or 1
	 */
	public function setMatchApproved(INT $newMatchApproved) : INT {
		// check if input is valid
		if ($newMatchApproved !== 1 | $newMatchApproved !==0) {
			throw(new \RangeException("Match Approved Value is invalid"));
		}
		//store new value on server
		$this->matchApproved = $newMatchApproved;
	}

	/**
	 * inserts match into mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 */
	public function insert(\PDO $pdo) : void {
		//first create query template
		$query = "INSERT INTO `match` (matchUserId, matchToUserId, matchApproved) VALUES (:matchUserId, :matchToUserId, :matchApproved)";
		$statement = $pdo->prepare($query);
		//then bind member variables to placeholders in the template
		$parameters = ["matchUserId" => $this->matchUserId->getBytes(),  "matchToUserId" => $this->matchToUserId->getBytes(), "matchApproved" => $this->matchApproved];
		$statement->execute($parameters);
	}

	/**
	 * deletes this match from mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 */
	public function delete(\PDO $pdo) : void {
		//first create query template
		$query = "DELETE FROM `match` WHERE matchUserId = :matchUserId";
		$statement = $pdo->prepare($query);
		//then bind member variables to the placeholders in the template
		$parameters = ["matchUserId" => $this->matchUserId->getBytes()];
		$statement->execute($parameters);
	}

	/**
	 * updates this match in mySQL
	 *
	 * @param \PDO $pdo PDO connection object
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 */
	public function update(\PDO $pdo) : void {
		//first create query template
		$query = "UPDATE `match` SET matchApproved = :matchApproved WHERE matchUserId = :matchUserId";
		$statement = $pdo->prepare($query);
		//then bind member variables to the placeholder in the template
		$parameters = ["matchApproved" => $this->matchApproved];
		$statement->execute($parameters);
	}

	/**
	 * gets all matches from User Id
	 *
	 * @param \PDO $pdo PDO connection object
	 * @param Uuid|string $matchUserId to search by/with
	 * @return \SplFixedArray SPl Fixed Array of matches found
	 * @throws \PDOException when mySQL related errors occur
	 * @throws \TypeError if $pdo is not a PDO connection object
	 */
	public static function getMatchesByMatchUserId(\PDO $pdo, $matchUserId) : \SplFixedArray {
		//sanitize the Uuid
		try {
			$matchUserId = self::validateUuid($matchUserId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			throw(new \PDOException($exception->getMessage(), 0, $exception));
		}
		//create query template
		$query = "SELECT matchToUserId, matchApprove FROM `match` WHERE macthUserId = :matchUserId";
		$statement = $pdo->prepare($query);
		//bind elements to template
		$parameters = ["matchUserId" => $matchUserId->getBytes()];
		$statement->execute($parameters);
		//build array
		$matches = new \SplFixedArray($statement->rowCount());
		$statement->setFetchMode(\PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false) {
			try {
				$match = new Match($row["matchUserId"], $row["matchToUserId"], $row["matchApproved"]);
				$matches[$matches->key()] = $match;
				$matches->next();
			} catch(\Exception $exception) {
				throw(new \PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return ($matches);
	}

	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize() : array {
		$fields = get_object_vars($this);

		$fields["matchUSerId"] = $this->matchUserId->toString();
		$fields["matchToUserId"] = $this->matchToUserId->toString();

		return($fields);
	}
}