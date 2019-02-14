<?php

namespace DeepDiveDatingApp\DeepDiveDating\Test;
require_once ("autoload.php");
require_once (dirname(__DIR__, 2) . "/vendor/autoload.php");

use Ramsey\Uuid\Uuid;
/**
 * unit test for the User Class
 * PDO methods are located in the User Class
 * @ see php/classes/User.php
 * @author Kathleen Mattos
 */
class UserTest extends UserTestSetup {
			/**
			 * valid user profile
			 * @var User user
			 */
			protected $user = null;

			/**
			 * id for this user
			 * @var Uuid $VALID_USERID
			 */
			protected $VALID_USERID;

			/**
			 * placeholder activation token for the initial profile creation
			 * @var string $VALID_USERACTIVATIONTOKEN
			 */
			protected $VALID_USERACTIVATIONTOKEN;

			/**
			 * placeholder for user agent
			 * @var string $VALID_USERAGENT
			 */
			protected $VALID_USERAGENT = "";

			/**
			 * valid url for the user avatar
			 * @var string $VALID_USERAVATARURL
			 */
			protected $VALID_USERAVATARURL = "avatarSAREUS.com";

			/**
			 * valid int to tell if a user is blocked or not
			 * @var int $VALID_USERBLOCKED
			 */
			protected $VALID_USERBLOCKED = "";

			/**
			 * valid email address for user
			 * @var string $VALID_USEREMAIL
			 */
			protected $VALID_USEREMAIL = "exampleemail@test.com";

			/**
			 * valid handle for user account
			 * @var string $VALID_USERHANDLE
			 */
			protected $VALID_USERHANDLE = "lonelyBoy";

			/**
			 * valid hash for user password
			 * @var string $VALID_USERHASH
			 */
			protected $VALID_USERHASH = "";

			/**
			 * valid binary of the user ip address
			 * @var string $VALID_USERIPADDRESS
			 */
			protected $VALID_USERIPADDRESS = "";

			/**
			 * create all dependent objects so that the test can run properly
			 */
			/**
			 * preform the actual insert method and enforce that it meets expectations I.E corrupted data is worth nothing
			 */

			public function testValidQuoteInsert() {
				$numRows = $this->getConnection()->getRowCount("user");

				//create the user object
				$user = new User(generateUuidV4(), $this->VALID_USERID, $this->VALID_USERACTIVATIONTOKEN, $this->VALID_USERAGENT, $this->VALID_USERAVATARURL, $this->VALID_USERBLOCKED, $this->VALID_USEREMAIL, $this->VALID_USERHANDLE, $this->VALID_USERHASH, $this->VALID_USERIPADDRESS);
				//insert the user object
				$user->insert($this->getPDO());

				//grab the data from mySQL and enforce that it meets expectations
				$pdoUser = User::getUserByUserId($this->getPDO(), $user->getUserId());
				$this->assertEquals($numRows + 1, $this->getConnection()->getRowCount("user"));
				$this->assertEquals($pdoUser->getUserId(), $user->getUserId());
				$this->assertEquals($pdoUser->getUser(), $user->getUser());
				$this->assertEquals($pdoUser->getUserActivationToken(), $user->getUserActivationToken());
				$this->assertEquals($pdoUser->getUserAgent(), $user->getUserAgent());
				$this->assertEquals($pdoUser->getUserAvatarUrl(), $user->getUserAvatarUrl());
				$this->assertEquals($pdoUser->getUserBlocked(), $user->getUserBlocked());
				$this->assertEquals($pdoUser->getUserEmail(), $user->getUserEmail());
				$this->assertEquals($pdoUser->getUserHandle(), $user->getUserHandle());
				$this->assertEquals($pdoUser->getUserHash(), $user->getUserHash());
				$this->assertEquals($pdoUser->getUserIpAddress(), $user->getUserIpAddress());
			}

			/**
			 * create a user object, update it in the database and then enforce that it meets expectations
			 */
			public function testValidUserUpdate() {
				//grab the number of rows and save it for the test
				$numRows = $this->getConnection()->getRowCount("user");

				//create the user object and then insert it
				$user = new User(generateUuidV4(), $this->VALID_USERID, $this->VALID_USERACTIVATIONTOKEN, $this->VALID_USERAGENT, $this->VALID_USERAVATARURL, $this->VALID_USERBLOCKED, $this->VALID_USEREMAIL, $this->VALID_USERHANDLE, $this->VALID_USERHASH, $this->VALID_USERIPADDRESS);
				$user->insert($this->getPDO());

				//edit the user object then insert it back into the database
				$user->setUserHandle($this->VALID_USERHANDLE);
				$user->update($this->getPDO());
				$pdoUser = User::getUserByUserId($this->getPDO(), $user->getUserId());

				$this->assertEquals($pdoUser->getUserId(), $user->getUserId());
				$this->assertEquals($pdoUser->getUser(), $user->getUser());
				$this->assertEquals($pdoUser->getUserActivationToken(), $user->getUserActivationToken());
				$this->assertEquals($pdoUser->getUserAgent(), $user->getUserAgent());
				$this->assertEquals($pdoUser->getUserAvatarUrl(), $user->getUserAvatarUrl());
				$this->assertEquals($pdoUser->getUserBlocked(), $user->getUserBlocked());
				$this->assertEquals($pdoUser->getUserEmail(), $user->getUserEmail());
				$this->assertEquals($pdoUser->getUserHandle(), $user->getUserHandle());
				$this->assertEquals($pdoUser->getUserHash(), $user->getUserHash());
				$this->assertEquals($pdoUser->getUserIpAddress(), $user->getUserIpAddress());
			}

			/**
			 * create a quote object, delete it, then enforce that it was deleted
			 */
			public function testValidUserDelete() {
				//grab the numbers of rows and save it for the test
				$numRows = $this->getConnection()->getRowCount("user");

				//create the User object
				$user = new User(generateUuidV4(), $this->VALID_USERID, $this->VALID_USERACTIVATIONTOKEN, $this->VALID_USERAGENT, $this->VALID_USERAVATARURL, $this->VALID_USERBLOCKED, $this->VALID_USEREMAIL, $this->VALID_USERHANDLE, $this->VALID_USERHASH, $this->VALID_USERIPADDRESS);

				//insert the user object
				$user->insert->($this->getPDO());

				//delete the quote from the database
				$this->assertSame($numRows + 1, $this->getConnection()->("user"));
				$user->delete($this->getPDO());

				//enforce that the deletion was successful
				$pdoUser = User::getUserByUserId($this->getPDO(), $user->getUserId());
				$this->assertNull($pdoUser);
				$this->assertEquals($numRows, $this->getConnection()->getRowCount("user"));
			}

			/**
			 * try to grab the user by a primary key that does not exist
			 */
			public function testInvalidGetByUserId() {
				//grab the user by an invalid key
				$user = User::getUserByUserId($this->getPDO(), UserTestSetup::INVALID_KEY);
				$this->assertEmpty($user);
			}

			/**
			 * insert a quote object, grab it by the user handle and enforce that it meets expectations
			 */
			public function testValidGetUserByHandle() {

				$numRows = $this->getConnection()->getRowCount("user");
			}

}
