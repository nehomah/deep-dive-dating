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
 * Run the default setup operation for each test ?
 *****************/


}

/**
 * test inserting a valid UserDetail and verify that the actual mySQL data matches
 **/
	public function testInsertValidUserDetail() : void {
	// count the number of rows and save it for later
	$numRows = $this->getConnection()->getRowCount("userDetail");
	$userDetailId = generateUuidV4();
	$userDetail = new UserDetail($userDetailId, $userDetailUserId, $this->VALID_ABOUT_ME, $this->VALID_AGE, $this->VALID_CAREER, $this->VALID_DISPLAY_EMAIL, $this->VALID_EDUCATION, $this->VALID_GENDER, $this->VALID_INTERESTS, $this->VALID_RACE, $this->VALID_RELIGION);
	$userDetail->insert($this->getPDO());
	// grab the data from mySQL and enforce the fields match our expectations
	$pdoUserDetail = UserDetail::getUserDetailByUserDetailId($this->getPDO(),$userDetail->getUserDetailId());
	$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("userDetail"));
	$this->assertEquals($pdoUserDetail->getUserDetailId(), $userDetailId);
	$this->assertEquals($pdoUserDetail->getUserDetailUserId(), $userDetailUserId);
	$this->assertEquals($pdoUserDetail->getUserDetailAboutMe(), $this->VALID_ABOUT_ME);
	$this->assertEquals($pdoUserDetail->getUserDetailAge(), $this->VALID_AGE);
	$this->assertEquals($pdoUserDetail->getUserDetailCareer(), $this->VALID_CAREER);
	$this->assertEquals($pdoUserDetail->getUserDetailDisplayEmail(), $this->VALID_DISPLAY_EMAIL);
	$this->assertEquals($pdoUserDetail->getUserDetailEducation(), $this->VALID_EDUCATION);
	$this->assertEquals($pdoUserDetail->getUserDetailGender(), $this->VALID_GENDER);
	$this->assertEquals($pdoUserDetail->getUserDetailInterests(), $this->VALID_INTERESTS);
	$this->assertEquals($pdoUserDetail->getUserDetailRace(), $this->VALID_RACE);
	$this->assertEquals($pdoUserDetail->getUserDetailReligion(), $this->VALID_RELIGION);
	}
	/**
	* Test inserting a UserDetail, editing it and then updating it
	**/
	public function testUpdateValidUserDetail() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("userDetail");
		// create a new UserDetail and insert into mySQL
		$userDetailId = generateUuidV4();
		$userDetail = new UserDetail($userDetailId, $userDetailUserId, $this->VALID_ABOUT_ME, $this->VALID_AGE, $this->VALID_CAREER, $this->VALID_DISPLAY_EMAIL, $this->VALID_EDUCATION, $this->VALID_GENDER, $this->VALID_INTERESTS, $this->VALID_RACE, $this->VALID_RELIGION);
		$userDetail->insert($this->getPDO());
		// edit the UserDetail and update it in mySQL
		$userDetail->setUserDetailAboutMe($this->VALID_ABOUT_ME);
		$userDetail->setUserDetailAge($this->VALID_AGE);
		$userDetail->setUserDetailCareer($this->VALID_CAREER);
		$userDetail->setUserDetailDisplayEmail($this->VALID_DISPLAY_EMAIL);
		$userDetail->setUserDetailEducation($this->VALID_EDUCATION);
		$userDetail->setUserDetailGender($this->VALID_GENDER);
		$userDetail->setUserDetailInterests($this->VALID_INTERESTS);
		$userDetail->setUserDetailRace($this->VALID_RACE);
		$userDetail->setUserDetailReligion($this->VALID_RELIGION);
		$userDetail->update($this->getPDO());
	// grab the data from mySQL and enforce the fields match our expectations
	$pdoUserDetail = UserDetail::getUserDetailByUserDetailId($this->getPDO(),$userDetail->getUserDetailId());
	$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("userDetail"));
	$this->assertEquals($pdoUserDetail->getUserDetailId(), $userDetailId);
	$this->assertEquals($pdoUserDetail->getUserDetailUserId(), $userDetailUserId);
	$this->assertEquals($pdoUserDetail->getUserDetailAboutMe(), $this->VALID_ABOUT_ME);
	$this->assertEquals($pdoUserDetail->getUserDetailAge(), $this->VALID_AGE);
	$this->assertEquals($pdoUserDetail->getUserDetailCareer(), $this->VALID_CAREER);
	$this->assertEquals($pdoUserDetail->getUserDetailDisplayEmail(), $this->VALID_DISPLAY_EMAIL);
	$this->assertEquals($pdoUserDetail->getUserDetailEducation(), $this->VALID_EDUCATION);
	$this->assertEquals($pdoUserDetail->getUserDetailGender(), $this->VALID_GENDER);
	$this->assertEquals($pdoUserDetail->getUserDetailInterests(), $this->VALID_INTERESTS);
	$this->assertEquals($pdoUserDetail->getUserDetailRace(), $this->VALID_RACE);
	$this->assertEquals($pdoUserDetail->getUserDetailReligion(), $this->VALID_RELIGION);
}
	/**
 	* Test creating a UserDetail and then deleting it
	**/
  public function testDeleteValidUserDetail() : void {
  			// count the number of rows and save it for later
			$numRows = $this->getConnection()->getRowCount("userDetail");

			// create a new UserDetail and insert into mySQL
			$userDetailId = generateUuidV4();
			$userDetail = new UserDetail($userDetailId, $userDetailUserId, $this->VALID_ABOUT_ME, $this->VALID_AGE, $this->VALID_CAREER, $this->VALID_DISPLAY_EMAIL, $this->VALID_EDUCATION, $this->VALID_GENDER, $this->VALID_INTERESTS, $this->VALID_RACE, $this->VALID_RELIGION);
			$userDetail->insert($this->getPDO());

			// Delete the UserDetail from the mySQL
			$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("userDetail"));
			$userDetail->delete($this->getPDO());

			// Grab the data from mySQL and enforce the UserDetail does not exist
			$pdoUserDetail = UserDetail::getUserDetailByUserDetailId($this->getPDO(),$userDetail->getUserDetailId());
			$this->assertNull(pdoUserDetail);
			$this->assertEquals($numRows, $this->getConnection()->getRowCount("userDetail"));
}

/**
 * Test inserting a UserDetail and regrabbing it from mySQL
**/
public function testGetValidUserDetailByUserDetailId() : void {
			// count the number of rows and save it for later
			$numRows = $this->getConnection()->getRowCount("userDetail");
			// create a new UserDetail and insert into mySQL
			$userDetailId = generateUuidV4();
			$userDetail = new UserDetail($userDetailId, $userDetailUserId, $this->VALID_ABOUT_ME, $this->VALID_AGE, $this->VALID_CAREER, $this->VALID_DISPLAY_EMAIL, $this->VALID_EDUCATION, $this->VALID_GENDER, $this->VALID_INTERESTS, $this->VALID_RACE, $this->VALID_RELIGION);
			$userDetail->insert($this->getPDO());
			// grab the data from mySQL and enforce the fields match our expectations
			// grab the data from mySQL and enforce the fields match our expectations
			$pdoUserDetail = UserDetail::getUserDetailByUserDetailId($this->getPDO(),$userDetail->getUserDetailId());
			$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("userDetail"));
			$this->assertEquals($pdoUserDetail->getUserDetailId(), $userDetailId);
			$this->assertEquals($pdoUserDetail->getUserDetailUserId(), $userDetailUserId);
			$this->assertEquals($pdoUserDetail->getUserDetailAboutMe(), $this->VALID_ABOUT_ME);
			$this->assertEquals($pdoUserDetail->getUserDetailAge(), $this->VALID_AGE);
			$this->assertEquals($pdoUserDetail->getUserDetailCareer(), $this->VALID_CAREER);
			$this->assertEquals($pdoUserDetail->getUserDetailDisplayEmail(), $this->VALID_DISPLAY_EMAIL);
			$this->assertEquals($pdoUserDetail->getUserDetailEducation(), $this->VALID_EDUCATION);
			$this->assertEquals($pdoUserDetail->getUserDetailGender(), $this->VALID_GENDER);
			$this->assertEquals($pdoUserDetail->getUserDetailInterests(), $this->VALID_INTERESTS);
			$this->assertEquals($pdoUserDetail->getUserDetailRace(), $this->VALID_RACE);
			$this->assertEquals($pdoUserDetail->getUserDetailReligion(), $this->VALID_RELIGION);
}

/**
 * Test grabbing a UserDetail that does not exist
**/
public function testGetInvalidUserDetailbyUserDetailId() : void {
			// grab a userDetailId that exceeds the maximum allowable userDetailId
			$fakeUserDetailId = generateUuidV4();
			$userDetail = UserDetail::getUserDetailByUserDetailId($this->getPDO(), $fakeUserDetailId);
			$this->assertNull($userDetail);
}

/** Test grabbing a UserDetail by userId */