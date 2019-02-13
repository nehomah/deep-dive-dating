<?php
namespace DeepDiveDatingApp\DeepDiveDating;
require_once("autoload.php");
require_once(dirname(__DIR__, 2) . "/vendor/autoload.php");

use MongoDB\BSON\Binary;
use Ramsey\Uuid\Uuid;

/**
 * Report Class
 *
 * this class is used to store information regarding malicious user activity
 *
 * @author Taylor Smith
 **/

class Report implements \JsonSerializable {
	use ValidateUuid;
	/**
	 * id for the user who submitted the report
	 * @var \Uuid $reportUserId
	 **/
	private $reportUserId;
	/**
	 * id for the user accused of misconduct
	 * @var \Uuid $reportAbuserId
	 **/
	private $reportAbuserId;
	/**
	 * User Agent information
	 * @var \string $reportAgent
	 **/
	private $reportAgent;
	/**
	 * details of the incident being reported
	 * @var \string $reportContent
	 **/
	private $reportContent;
	/**
	 * date and time that the report was made
	 * @var \DateTime $reportDate
	 **/
	private $reportDate;
	/**
	 * Ip address of the user making the report
	 * @var \Binary $reportIp
	 **/
	private $reportIp;

	/**
	 * Constructor Method for Report
	 *
	 * @param string|Uuid $newReportUserId user id for the account making the report
	 * @param string|Uuid $newReportAbuserId user id for the account detailed in the report
	 * @param string $newReportAgent agent information for the user who made the report
	 * @param string $newReportContent value/contents of the report
	 * @param \DateTime|string $newReportDate date and time report was sent
	 * @param string|Binary $newReportIp Ip address of user who submits this report
	 * @throws \InvalidArgumentException if data type is invalid
	 * @throws \RangeException if data values exceed limits
	 * @throws \TypeError if data types violate type hints
	 * @throws \Exception if some other exception occurs
	 **/
	public function __construct($newReportUserId, $newReportAbuserId, $newReportAgent, $newReportContent, $newReportDate, $newReportIp) {
		try {
			$this->setReportUserId($newReportUserId);
			$this->setReportAbuserId($newReportAbuserId);
			$this->setReportAgent($newReportAgent);
			$this->setReportContent($newReportContent);
			$this->setReportDate($newReportDate);
			$this->setReportIp($newReportIp;)
		}

		catch (\InvalidArgumentException | \TypeError | \RangeException | \Exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * Accessor Method for Report User Id
	 *
	 * @return Uuid value of User Id for the person who made the report
	 **/
	public function getReportUserId() : Uuid {
		return($this->reportUserId);
	}

	/**
	 * Mutator Method for Report User Id
	 *
	 * @param Uuid|string new value of Report User Id
	 * @throws \RangeException if $newReportUserId is not positive
	 * @throws \TypeError if $newReportUserId is not a Uuid or string
	 **/
	public function setReportUserId( $newReportUserId ) : void {
		try {
			$uuid = self::validateUuid($newReportUserId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
		$this->reportUserId = $uuid;
	}

	/**
	 * Accessor Method for Report Abuser Id
	 *
	 * @return Uuid value of User Id for the person who the report is about
	 **/
	public function getReportAbuserId() : Uuid {
		return($this->reportAbuserId);
	}

	/**
	 * Mutator Method for Report Abuser Id
	 *
	 * @param Uuid|string $newReportAbuserId new value of Report Abuser Id
	 * @throws \RangeException if $newReportAbuserId is not positive
	 * @throws \TypeError if $newReportAbuserId is not a Uuid or string
	 **/
	public function setReportAbuserId( $newReportAbuserId ) : void {
		try {
			$uuid = self::validateUuid($newReportAbuserId);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			$exceptionType = get_class($exception);
			throw(new $exception($exception->getMessage(), 0, $exception));
		}
		$this->reportAbuserId = $uuid;
	}

	/**
	 * Accessor Method for Report Agent
	 *
	 * @return string user agent details
	 **/
	public function getReportAgent() : string {
		return($this->reportAgent);
	}

	/**
	 * Mutator Method for Report Agent
	 *
	 * @param string $newReportAgent user agent info for the person making the report
	 * @throws \InvalidArgumentException if $newReportAgent is not a string or insecure
	 * @throws \RangeException if $newReportAgent is > 255 characters
	 * @throws \TypeError if $newReportAgent is not a string
	 **/
	public function setReportAgent( $newReportAgent ) {
		// verify that agent is secure
		$newReportAgent = trim($newReportAgent);
		$newReportAgent = filter_var($newReportAgent, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newReportAgent) === true ) {
			throw(new \InvalidArgumentException("Agent information is empty or insecure"));
		}
		// check that length will fit in database
		if(strlen($newReportAgent) > 255 ) {
			throw(new \RangeException("Agent Information is to Large"));
		}
		// store agent
		$this->reportAgent = $newReportAgent;
	}

	/**
	 * Accessor Method for Report Content
	 *
	 * @return string details of incident being reported
	 **/
	public function getReportContent() : string {
		return($this->reportContent);
	}

	/**
	 * Mutator Method for Report Content
	 **/
	public function setReportContent( $newReportContent ) {
		//verify that content is secure
		$newReportContent = trim($newReportContent);
		$newReportContent = filter_var($newReportContent, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newReportContent) === true ) {
			throw(new \InvalidArgumentException("Content is empty or insecure"));
		}
		//check that length will fit in database
		if(strlen($newReportContent) > 255 ) {
			throw(new \RangeException("Report Content is too large"));
		}
		//store content
		$this->reportContent = $newReportContent;
	}

	/**
	 * Accessor Method for Report Date
	 *
	 * @return \DateTime value of report date and time
	 **/
	public function getReportDate() : \DateTime {
		return($this->reportDate);
	}

	/**
	 * Mutator Method for
	 **/

	/**
	 * Accessor Method for Report Ip
	 *
	 * @return string|Binary Ip address of the person making the report
	 **/
	public function getReportIp() : string {
		return($this->reportIp);
	}

	/**
	 * Mutator Method for
	 **/

}

/**
 * reportUserId BINARY(16) NOT NULL,
 * reportAbuserId BINARY(16) NOT NULL,
 * reportAgent VARCHAR(255) NOT NULL,
 * reportContent VARCHAR(255) NOT NULL,
 * reportDate DATETIME(6) NOT NULL,
 * reportIp BINARY (16) NOT NULL,
 */