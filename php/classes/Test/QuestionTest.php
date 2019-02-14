<?php


namespace DeepDiveDatingApp\DeepDiveDating\QuestionTest;
require_once("autoload.php");
require_once(dirname(__DIR__,2)."/lib/uuid.php");
use DeepDiveDatingApp\DeepDiveDating\Question\Question;
/**
 * unit test for the Question class
 * PDO methods are located in the Question class
 * @ see php/classes/Question.php
 * @author Natalie Woodard
 */
class QuestionTest extends DeepDiveDatingAppTest {
	/**
	* Questions for users
	 * @var Question question
	 **/
	protected $question = null;

	/**
	 * valid id to create the question object to own the test
	 *@var string $VALID_QUESTIONID
	 **/
protected $VALID_QUESTION_ID;

	/**
	 * Content of questions
	 * @var string $VALID_QUESTIONCONTENT
	 **/
	protected $VALID_QUESTION_CONTENT = "PHPUnit test passing";

	/**
	 * Value applied to questions based on Dan's preferences
	 * @var int $VALID_QUESTIONVALUE
	 **/
	protected $VALID_QUESTION_VALUE;
}