<?php
namespace unsure;
require_once("autoload.php");
require_once(dirname(__DIR__, 2) . "/vendor/autoload.php");
use Ramsey\Uuid\Uuid;

/**
 * question class is where users answer questions based on Dan's interests. They will be graded on their answers to
 * those questions.
 **/

class question implements \JsonSerializable {
use ValidateUuid;

/**Id for questions user will be graded by, this is the primary key
  @var string|Uuid $questionId
 **/

private $questionId;
/**
 * Id to link question to user, this is a foreign key
 * @var string|Uuid $questionUserId
 **/
private $questionUserId;
/**
 * Space where question content appears
 * @var string|Uuid $questionContent
 **/
private $questionContent;
/**
*Value assigned to each user by question section
 **/
private $questionValue;
}
/**


/*******Constructor for UserDetail class************
 *
 *@param string|Uuid $newQuestionId id for question set
*@param string $newQuestionUserId id for new user to answer questions
 *@param string $newQuestionContent space where question appears
 *@param TINYINT $newQuestionValue value that gets calculated from answers to questions
 *@throws \InvalidArgumentException if data types are not valid
 *@throws \RangeException if data values are out of bounds
 *@throws \Exception for when an exception is thrown
 *@throws \TypeError if data types violate type hints
 *
 ************************************************************/
