<?php
namespace Edu\Cnm\DateDan\Test;
require_once("autoload.php");
require_once(dirname(__DIR__, 2) . "/vendor/autoload.php");
use Ramsey\Uuid\Uuid;


/**
 * Match
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
	 * @var $matchApproved
	 */
	private $matchApproved;

	/**
	 * Constructor for this Match
	 *
	 * @param string|Uuid $matchUserId id of the user who liked a profile
	 * @param string|Uuid $matchToUserId id of the user who's profile was liked
	 * @param int $matchApproved value representing match reciprocity
	 * @throws \InvalidArgumentException if data types are invalid
	 * @throws \TypeError if data types violate provided hints
	 * @throws \Exception for other exceptions
	 */
	public function __construct($newMatchUserId, $newMatchToUserId, $newMatchApproved) {
		try {
			$this->setMatchUserId($newMatchUserId);
			$this->setMatchToUserId($newMatchToUserId);
			$this->setMatchApproved($newMatchApproved);
		}

		catch (\InvalidArgumentException | \TypeError | \Exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}
}