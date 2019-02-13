<?php
namespace DeepDiveDatingApp\DeepDiveDating;

use DeepDiveDatingApp{
	User, UserDetail, Question, Answer, Match, Report
};

//grab the class under scrutiny
require_once(dirname(__DIR__)) . "/autoload.php";

// grab the uuid generator
require_once(dirname(__DIR__, 2) . "lib/uuid.php");

/**
 * Full PHPUnit test for the UserDetail class
 *
 * This is a complete PHPUnit test of the UserDetail class. It is complete because *ALL* mySQL/PDO enabled methods
 * are tested for both invalid and valid inputs.
 *
 * @see UserDetail
 * @author Dylan McDonald <dmcdonald21@cnm.edu>
 **/

class UserDetailTest extends DeepDiveDatingAppTest {
	/**
	 * User that created the detail; this is for foreign key relations
	 * @var userDetailId
	 */
	protected $userDetailId = null;
	/**
	 * Detail from the user detail/ user id relationship ; this is for foreign key relations
	 * @var userDetailUserId
	 **/
	protected $userDetailUserId = null;
	/**
	 * Detail about the user
	 * @var Style style
	 **/
	protected $userDetailAboutMe = null;
	protected $userDetailAge;
	protected $userDetailCareer;
	protected $userDetailDisplayEmail;
	protected $userDetailEducation;
	protected $userDetailGender;
	protected $userDetailInterests;
	protected $userDetailRace;
	protected $userDetailReligion;