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
	 * valid about me for user
	 * @var string $VALID_USERDETAILABOUTME
	 **/
	protected $VALID_USERDETAILABOUTME = "This section is about me and no one else.";
	/**
	 * Valid age of user
	 * @var int $VALID_USERDETAILAGE
	 **/
	protected $VALID_USERDETAILAGE = 25;
	/**
	 * Valid career info
	 * @var string $VALID_USERDETAILCAREER
	 **/
	protected $VALID_USERDETAILCAREER = "I have a career I love.";
	/**
	 * valid display email
	 * @var string $VALID_USERDETAILDISPLAYEMAIL
	 **/
	protected $VALID_USERDETAILDISPLAYEMAIL = "single@ready2mingle.com";
	/**
	 * valid education
	 * @var string $VALID_USEREDUCATION
	 **/
	protected $VALID_USEREDUCATION = "I've learned stuff about stuff.";
	/**
	 * valid gender
	 * @var string $VALID_USERDETAILGENDER
	 **/
	protected $VALID_USERDETAILGENDER = "Mixed";
	/**
	 * Valid interests
	 * @var string $VALID_USERDETAILINTERESTS
	 **/
	protected $VALID_USERDETAILINTERESTS = "I am interested in stuff and things.";
	/**
	 * Valid race
	 * @var string $VALID_USERDETAILRACE
	 **/
	protected $VALID_USERDETAILRACE = "Many races, mixed.";
	/**
	 * Valid religion
	 * @var string $VALID_USERDETAILRELIGION
	 **/
	protected $VALID_USERDETAILRELIGION = "I only believe in science.";

/*****************
 * Run the default setup operation for each test
 *****************/


}