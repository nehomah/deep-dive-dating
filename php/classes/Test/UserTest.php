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

}
