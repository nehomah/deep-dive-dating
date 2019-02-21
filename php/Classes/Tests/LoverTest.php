<?php
namespace DeepDiveDatingApp\DeepDiveDating\Test;

use DeepDiveDatingApp\DeepDiveDating\Lover;

require_once "DeepDiveDatingAppTest.php";
require_once (dirname(__DIR__) . "/autoload.php");
require_once (dirname(__DIR__, 2) . "/lib/uuid.php");


/**
 * unit test for the Lover Class
 * PDO methods are located in the Lover Class
 * @see php/Classes/Lover.php
 * @author Kathleen Mattos
 * testing 123
 */
class LoverTest extends DeepDiveDatingAppTest {
	/**
	 * placeholder activation token for the initial profile creation
	 * @var string $VALID_LOVERACTIVATIONTOKEN
	 */
	protected $VALID_LOVERACTIVATIONTOKEN = "10101010101010101010101010101010";

	/**
	 * placeholder for user agent
	 * @var string $VALID_LOVERAGENT
	 */
	protected $VALID_LOVERAGENT = "Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:47.0) Gecko/20100101 Firefox/47.0 Mozilla/5.0 (Macintosh; Intel Mac OS X x.y; rv:42.0) Gecko/20100101 Firefox/42.0.";
	/**
	 * 2nd placeholder for user agent
	 * @var string $VALID_LOVERAGENT1
	 */
	protected $VALID_LOVERAGENT1 = "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36.";

	/**
	 * valid url for the user avatar
	 * @var string $VALID_LOVERAVATARURL
	 */
	protected $VALID_LOVERAVATARURL = "avatarSAREUS.com";
	/**
	 * valid url for the user avatar
	 * @var string $VALID_LOVERAVATARURL1
	 */
	protected $VALID_LOVERAVATARURL1 = "allTheAvatars.com";

	/**
	 * valid int to tell if a user is blocked or not
	 * @var int $VALID_LOVERBLOCKED
	 */
	protected $VALID_LOVERBLOCKED = 0;
	/**
	 * valid int to tell if a user is blocked or not
	 * @var int $VALID_LOVERBLOCKED1
	 */
	protected $VALID_LOVERBLOCKED1 = 1;

	/**
	 * valid email address for user
	 * @var int $VALID_LOVEREMAIL
	 */
	protected $VALID_LOVEREMAIL = "exampleemail@test.com";
	/**
	 * valid email address for user
	 * @var string $VALID_LOVEREMAIL1
	 */
	protected $VALID_LOVEREMAIL1 = "anotherEmail@test.com";

	/**
	 * valid handle for user account
	 * @var string $VALID_LOVERHANDLE
	 */
	protected $VALID_LOVERHANDLE = "lonelyBoy";
	/**
	 * valid handle for user account
	 * @var string $VALID_LOVERHANDLE1
	 */
	protected $VALID_LOVERHANDLE1 = "lonelyGirl";

	/**
	 * valid hash for user password
	 * @var string $VALID_LOVERHASH
	 */
	protected $VALID_LOVERHASH = "weakpassword";

	/**
	 * valid binary of the user ip address
	 * @var string $VALID_LOVERIPADDRESS
	 */
	protected $VALID_LOVERIPADDRESS = "192.0.2.0/24";


	/**
	 * create all dependent objects so that the test can run properly
	 */
	/**
	 * preform the actual insert method and enforce that it meets expectations I.E corrupted data is worth nothing
	 */

	public function testValidLoverInsert(): void {
		$numRows = $this->getConnection()->getRowCount("lover");
		$loverId = generateUuidV4();

		//create the user object
		$lover = new Lover($loverId, $this->VALID_LOVERACTIVATIONTOKEN, $this->VALID_LOVERAGENT, $this->VALID_LOVERAVATARURL, $this->VALID_LOVERBLOCKED, $this->VALID_LOVEREMAIL, $this->VALID_LOVERHANDLE, $this->VALID_LOVERHASH, $this->VALID_LOVERIPADDRESS);
		//insert the user object
		$lover->insert($this->getPDO());

		//grab the data from mySQL and enforce that it meets expectations
		$pdoLover = Lover::getLoverByLoverId($this->getPDO(), $lover->getLoverId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("lover"));
		$this->assertEquals($pdoLover->getLoverId(), $loverId);
		$this->assertEquals($pdoLover->getLoverActivationToken(), $this->VALID_LOVERACTIVATIONTOKEN);
		$this->assertEquals($pdoLover->getLoverAgent(), $this->VALID_LOVERAGENT);
		$this->assertEquals($pdoLover->getLoverAvatarUrl(), $this->VALID_LOVERAVATARURL);
		$this->assertEquals($pdoLover->getLoverBlocked(), $this->VALID_LOVERBLOCKED);
		$this->assertEquals($pdoLover->getLoverEmail(), $this->VALID_LOVEREMAIL);
		$this->assertEquals($pdoLover->getLoverHandle(), $this->VALID_LOVERHANDLE);
		$this->assertEquals($pdoLover->getLoverHash(), $this->VALID_LOVERHASH);
		$this->assertEquals($pdoLover->getLoverIpAddress(), $this->VALID_LOVERIPADDRESS);
	}

	/**
	 * create a user object, update it in the database and then enforce that it meets expectations
	 */
	public function testValidLoverUpdate() {
		//grab the number of rows and save it for the test
		$numRows = $this->getConnection()->getRowCount("lover");
		$loverId = generateUuidV4();

		//create the user object and then insert it
		$lover = new Lover($loverId, $this->VALID_LOVERACTIVATIONTOKEN, $this->VALID_LOVERAGENT, $this->VALID_LOVERAVATARURL, $this->VALID_LOVERBLOCKED, $this->VALID_LOVEREMAIL, $this->VALID_LOVERHANDLE, $this->VALID_LOVERHASH, $this->VALID_LOVERIPADDRESS);
		$lover->insert($this->getPDO());

		//edit the user object then insert it back into the database
		$lover->setLoverAgent($this->VALID_LOVERAGENT);
		$lover->setLoverAvatarUrl($this->VALID_LOVERAVATARURL1);
		$lover->setLoverBlocked($this->VALID_LOVERBLOCKED1);
		$lover->setLoverEmail($this->VALID_LOVEREMAIL1);
		$lover->setLoverHandle($this->VALID_LOVERHANDLE1);
		$lover->update($this->getPDO());
		// grab the data from mySQL and enforce the fields match our expectations
		$pdoLover = Lover::getLoverByLoverId($this->getPDO(), $lover->getLoverId());
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("lover"));
		$this->assertEquals($pdoLover->getLoverId(), $loverId);
		$this->assertEquals($pdoLover->getLoverActivationToken(), $this->VALID_LOVERACTIVATIONTOKEN);
		$this->assertEquals($pdoLover->getLoverAgent(), $this->VALID_LOVERAGENT);
		$this->assertEquals($pdoLover->getLoverAvatarUrl(), $this->VALID_LOVERAVATARURL);
		$this->assertEquals($pdoLover->getLoverBlocked(), $this->VALID_LOVERBLOCKED);
		$this->assertEquals($pdoLover->getLoverEmail(), $this->VALID_LOVEREMAIL);
		$this->assertEquals($pdoLover->getLoverHandle(), $this->VALID_LOVERHANDLE);
		$this->assertEquals($pdoLover->getLoverHash(), $this->VALID_LOVERHASH);
		$this->assertEquals($pdoLover->getLoverIpAddress(), $this->VALID_LOVERIPADDRESS);
	}

		/**
		 * create a user object, delete it, then enforce that it was deleted
		 */
	public function testValidLoverDelete() {
			//grab the numbers of rows and save it for the test
		$numRows = $this->getConnection()->getRowCount("lover");
		$loverId = generateUuidV4();

			//create the User object
		$lover = new Lover($loverId, $this->VALID_LOVERACTIVATIONTOKEN, $this->VALID_LOVERAGENT, $this->VALID_LOVERAVATARURL, $this->VALID_LOVERBLOCKED, $this->VALID_LOVEREMAIL, $this->VALID_LOVERHANDLE, $this->VALID_LOVERHASH, $this->VALID_LOVERIPADDRESS);

			//insert the user object
		$lover->insert($this->getPDO());

			//delete the user from the database
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("lover"));
		$lover->delete($this->getPDO());

			//enforce that the deletion was successful
		$pdoLover = Lover::getLoverByLoverId($this->getPDO(), $lover->getLoverId());
		$this->assertNull($pdoLover);
		$this->assertEquals($numRows, $this->getConnection()->getRowCount("lover"));
	}

		/**
		 * try to grab the user by a primary key that does not exist
		 */
	public function testInvalidGetByLoverId() {
			//grab the user by an invalid key
		$lover = Lover::getLoverByLoverId($this->getPDO(), DeepDiveDatingAppTest::INVALID_KEY);
		$this->assertEmpty($lover);
	}

		/**
		 * insert a user object, grab it by the user handle and enforce that it meets expectations
		 */
	public function testValidGetLoverByHandle() {

		$numRows = $this->getConnection()->getRowCount("lover");
		$loverId = generateUuidV4();
			//create a user object and insert it into the database
		$lover = new Lover($loverId, $this->VALID_LOVERACTIVATIONTOKEN, $this->VALID_LOVERAGENT, $this->VALID_LOVERAVATARURL, $this->VALID_LOVERBLOCKED, $this->VALID_LOVEREMAIL, $this->VALID_LOVERHANDLE, $this->VALID_LOVERHASH, $this->VALID_LOVERIPADDRESS);

			//insert the user into the database
		$lover->insert($this->getPDO());

			//grab the user from the database
		$results = Lover::getLoverByLoverHandle($this->getPDO(), $this->VALID_LOVERHANDLE);
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("lover"));
			//enforce no other objects are bleeding into the profile

			//enforce results meet expectations
		$pdoLover = $results[0];
		$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("lover"));
		$this->assertEquals($pdoLover->getLoverId(), $loverId);
		$this->assertEquals($pdoLover->getLoverActivationToken(), $this->VALID_LOVERACTIVATIONTOKEN);
		$this->assertEquals($pdoLover->getLoverAgent(), $this->VALID_LOVERAGENT);
		$this->assertEquals($pdoLover->getLoverAvatarUrl(), $this->VALID_LOVERAVATARURL);
		$this->assertEquals($pdoLover->getLoverBlocked(), $this->VALID_LOVERBLOCKED);
		$this->assertEquals($pdoLover->getLoverEmail(), $this->VALID_LOVEREMAIL);
		$this->assertEquals($pdoLover->getLoverHandle(), $this->VALID_LOVERHANDLE);
		$this->assertEquals($pdoLover->getLoverHash(), $this->VALID_LOVERHASH);
		$this->assertEquals($pdoLover->getLoverIpAddress(), $this->VALID_LOVERIPADDRESS);
	}

		/**
		 * try and grab the user by a handle that does not exist
		 */
		public function testInvalidGetByHandle() {
			$lover = Lover::getLoverByLoverId($this->getPDO(), "notLonelyPerson");
				$this->assertEmpty($lover);
			}

		/**
		 * insert a user object, grab it by the email address, and enforce it meets expectations
		 */
		public function testValidGetLoverByEmail() {

			$numRows = $this->getConnection()->getRowCount("lover");
			$loverId = generateUuidV4();

			//create a user object and insert it into the database
			$lover = new Lover($loverId, $this->VALID_LOVERACTIVATIONTOKEN, $this->VALID_LOVERAGENT, $this->VALID_LOVERAVATARURL, $this->VALID_LOVERBLOCKED, $this->VALID_LOVEREMAIL, $this->VALID_LOVERHANDLE, $this->VALID_LOVERHASH, $this->VALID_LOVERIPADDRESS);

				//insert the user into the database
				$lover->insert($this->getPDO());

				//grab the user from the database
				$pdoLover = Lover::getLoverByEmail($this->getPDO(), $lover->getLoverEmail());
			$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("lover"));
			$this->assertEquals($pdoLover->getLoverId(), $loverId);
			$this->assertEquals($pdoLover->getLoverActivationToken(), $this->VALID_LOVERACTIVATIONTOKEN);
			$this->assertEquals($pdoLover->getLoverAgent(), $this->VALID_LOVERAGENT);
			$this->assertEquals($pdoLover->getLoverAvatarUrl(), $this->VALID_LOVERAVATARURL);
			$this->assertEquals($pdoLover->getLoverBlocked(), $this->VALID_LOVERBLOCKED);
			$this->assertEquals($pdoLover->getLoverEmail(), $this->VALID_LOVEREMAIL);
			$this->assertEquals($pdoLover->getLoverHandle(), $this->VALID_LOVERHANDLE);
			$this->assertEquals($pdoLover->getLoverHash(), $this->VALID_LOVERHASH);
			$this->assertEquals($pdoLover->getLoverIpAddress(), $this->VALID_LOVERIPADDRESS);
			}


		/**
		 * try to grab a user by an email that does not exist
		 */
		public function testInvalidGetByEmail() {
			$lover = Lover::getLoverByEmail($this->getPDO(), "liarlairpantsonfire@email.com");
				$this->assertEmpty($lover);
			}

		/**
		 * insert a user, use getAll method, then enforce it meets expectations
		 */
		public function testGetAllLovers(): void {
			$numRows = $this->getConnection()->getRowCount("lover");
			$loverId = generateUuidV4();

			//insert the user into the database
			$lover = new Lover($loverId, $this->VALID_LOVERACTIVATIONTOKEN, $this->VALID_LOVERAGENT, $this->VALID_LOVERAVATARURL, $this->VALID_LOVERBLOCKED, $this->VALID_LOVEREMAIL, $this->VALID_LOVERHANDLE, $this->VALID_LOVERHASH, $this->VALID_LOVERIPADDRESS);

				//insert the user into the database
				$lover->insert($this->getPDO());

			//grab the results from mySQL and enforce they meet expectations
			$results = Lover::getAllLovers($this->getPDO());
			$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("lover"));
			$this->assertCount(1, $results);

			//grab the results from the array and make sure it meets expectations
			$pdoLover = $results[0];
			$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("lover"));
			$this->assertEquals($pdoLover->getLoverId(), $loverId);
			$this->assertEquals($pdoLover->getLoverActivationToken(), $this->VALID_LOVERACTIVATIONTOKEN);
			$this->assertEquals($pdoLover->getLoverAgent(), $this->VALID_LOVERAGENT);
			$this->assertEquals($pdoLover->getLoverAvatarUrl(), $this->VALID_LOVERAVATARURL);
			$this->assertEquals($pdoLover->getLoverBlocked(), $this->VALID_LOVERBLOCKED);
			$this->assertEquals($pdoLover->getLoverEmail(), $this->VALID_LOVEREMAIL);
			$this->assertEquals($pdoLover->getLoverHandle(), $this->VALID_LOVERHANDLE);
			$this->assertEquals($pdoLover->getLoverHash(), $this->VALID_LOVERHASH);
			$this->assertEquals($pdoLover->getLoverIpAddress(), $this->VALID_LOVERIPADDRESS);
			}
	}

