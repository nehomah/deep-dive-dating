<?php
namespace DeepDiveDatingApp\DeepDiveDating;
require_once("autoload.php");
require_once(dirname(__DIR__, 2) . "/vendor/autoload.php");

use Ramsey\Uuid\Uuid;
/**
 * The userDetail class that will be used for each of the users that want to add more
 * information about themselves
 *
 * The userDetail contains all of the information that will be displayed on the user page/profile
 **/
class UserDetail implements \JsonSerializable {
	use ValidateUuid;
	/**
	 * Id for for this users details, this is the primary key
	 * @var string|Uuid $userDetailId
	 **/
	private $userDetailId;
	/**
	 * Id to link user details to correct user, this is a foreign key
	 * @var string|Uuid $userDetailUserId
	 **/
	private $userDetailUserId;
	/**
	 * space for user to type in information they choose about themselves
	 * @var string|Uuid $userDetailAboutMe
	 **/
	private $userDetailAboutMe;
	/**
	 * Age of user
	 * @var int $userDetailAge
	 **/
	private $userDetailAge;
	/**
	 * Information about users career
	 * @var string $userDetailCareer
	 **/
	private $userDetailCareer;
	/**
	 * Users email that will display
	 * @var string $userDetailDisplayEmail
	 **/
	private $userDetailDisplayEmail;
	/**
	 * Education level of user
	 * @var string $userDetailEducation
	 **/
	private $userDetailEducation;
	/**
	 * Gender for user
	 * @var string $userDetailGender
	 **/
	private $userDetailGender;
	/**
	 * Users interests
	 * @var string $userDetailInterests
	 **/
	private $userDetailInterests;
	/**
	 * Users race
	 * @var string $userDetailRace
	 **/
	private $userDetailRace;
	/**
	 * Users religion
	 * @var string $userDetailReligion
	 **/
	private $userDetailReligion;

/*******Constructor for UserDetail class************
*
*@param string|Uuid $newUserDetailId id for new user detail
*@param string|Uuid $newUserDetailUserId id that links the details to the user?*
*@param string $newUserDetailAboutMe string showing users about me section
*@param int $newUserDetailAge number depicting users age
*@param string $newUserIdCareer string showing users career information
*@param string $newUserDetailDisplayEmail string showing users display email
*@param string $newUserDetailEducation string showing users education
*@param string $newUserDetailGender string showing users gender
*@param string $newUserDetailInterests string showing users interests
*@param string $newUserDetailRace string showing users race
*@param string $newUserDetailReligion string showing users religion
*@throws \InvalidArgumentException if data types are not valid
*@throws \RangeException if data values are out of bounds
*@throws \Exception for when an exception is thrown
*@throws \TypeError if data types violate type hints
*
************************************************************/
public function __construct($newUserDetailId, $newUserDetailUserId, $newUserDetailAboutMe, $newUserDetailAge, $newUserDetailCareer, $newUserDetailDisplayEmail, $newUserDetailEducation, $newUserDetailGender, $newUserDetailInterests, $newUserDetailRace, $newUserDetailReligion) {
	try {
		$this->setUserDetailId($newUserDetailId);
		$this->setUserDetailUserId($newUserDetailUserId);
		$this->setUserDetailAboutMe($newUserDetailAboutMe);
		$this->setUserDetailAge($newUserDetailAge);
		$this->setUserDetailCareer($newUserDetailCareer);
		$this->setUserDetailDisplayEmail($newUserDetailDisplayEmail);
		$this->setUserDetailEducation($newUserDetailEducation);
		$this->setUserDetailGender($newUserDetailGender);
		$this->setUserDetailInterests($newUserDetailInterests);
		$this->setUserDetailRace($newUserDetailRace);
		$this->setUserDetailReligion($newUserDetailReligion);
	}
	//determine the exception that was thrown
	catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
		$exceptionType = get_class($exception);
		throw(new $exceptionType($exception->getMessage(), 0, $exception));
	}
}
/******Accessor method for user detail id`***************/

public function getUserDetailId(): Uuid {
	return ($this->userDetailId);
}

/**********Mutator method for user detail id***************

 * @param Uuid| string $newUserDetailId value of new user detail id
 * @throws \RangeException if $newUserDetailId is not positive
 * @throws \TypeError if the user detail id is not correct type
**/

public function setUserDetailId($newUserDetailId): void {
	try{
		$uuid = self::validateUuid($newUserDetailId);
	} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
		$exceptionType = get_class($exception);
		throw(new $exceptionType($exception->getMessage(), 0, $exception));
	}
	//convert and store the profile id
	$this->userDetailId = $uuid;
}

	/******Accessor method for user detail user id***************/

	public function getUserDetailUserId(): Uuid {
		return ($this->userDetailUserId);
	}

	/*********Mutator method for user detail user id************
* @param Uuid| string $newUserDetailUserId value of new user detail user id
* @throws \RangeException if $newUserDetailUserId is not positive
* @throws \TypeError if the user detail user id is not correct type
**/
	public function setUserDetailUserId($newUserDetailUserId): void {
		try {
			$uuid = self::validateUuid($newUserDetailUserId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		//convert and store the user detail user id
		$this->userDetailUserId = $uuid;
	}

	/************Accessor method for user detail about me **************/

	public function getUserDetailAboutMe(): string {
		return ($this->userDetailAboutMe);
	}

	/***********Mutator method for user detail about me ****************
	*
	** @param string $newUserDetailAboutMe value of new user detail about me
	 * @throws \InvalidArgumentException when about me is too big
	 **/
	public function setUserDetailAboutMe(?string $newUserDetailAboutMe): void {
		if($newUserDetailAboutMe === null) {
			$this->userDetailAboutMe = null;
		}
		$newUserDetailAboutMe = trim($newUserDetailAboutMe);
		$newUserDetailAboutMe = filter_var($newUserDetailAboutMe, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

		if(strlen($newUserDetailAboutMe) > 1024) {
				throw(new \InvalidArgumentException("About Me is too large"));
		}
		//convert and store the about me section
		$this->userDetailAboutMe = $newUserDetailAboutMe;
}