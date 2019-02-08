<?php
namespace unsure;
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
	 * @var Uuid $userDetailId
	 **/
	private $userDetailId;
	/**
	 * Id to link user details to correct user, this is a foreign key
	 * @var Uuid $userDetailUserId
	 **/
	private $userDetailUserId;
	/**
	 * space for user to type in information they choose about themselves
	 * @var $userDetailAboutMe
	 **/
	private $userDetailAboutMe;
	/**
	 * Age of user
	 * @var int $userDetailAge
	 **/
	private $userDetailAge;
	/**
	 * Information about users career
	 * @var $userDetailCareer
	 **/
	private $userDetailCareer;
	/**
	 * Users email that will display
	 * @var string $userDetailDisplayEmail
	 **/
	private $userDetailDisplayEmail;
	/**
	 * Education level of user
	 * @var $userDetailEducation
	 **/
	private $userDetailEducation;
	/**
	 * Gender for user
	 * @var $userDetailGender
	 **/
	private $userDetailGender;
	/**
	 * Users interests
	 * @var $userDetailInterests
	 **/
	private $userDetailInterests;
	/**
	 * Users race
	 * @var $userDetailRace
	 **/
	private $userDetailRace;
	/**
	 * Users religion
	 * @var $userDetailReligion
	 **/
	private $userDetailReligion;
}