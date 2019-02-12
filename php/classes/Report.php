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
 */

class Report implements \JsonSerializable {
	use ValidateUuid;
	/**
	 * id for the user who submitted the report
	 * @var \Uuid $reportUserId
	 */
	private $reportUserId;
	/**
	 * id for the user accused of misconduct
	 * @var \Uuid $reportAbuserId
	 */
	private $reportAbuserId;
	/**
	 * User Agent information
	 * @var \string $reportAgent
	 */
	private $reportAgent;
	/**
	 * details of the incident being reported
	 * @var \string $reportContent
	 */
	private $reportContent;
	/**
	 * date and time that the report was made
	 * @var \DateTime $reportDate
	 */
	private $reportDate;
	/**
	 * Ip address of the user making the report
	 * @var \Binary $reportIp
	 */
	private $reportIp;

	/**
	 * Constructor Method for Report
	 *
	 * @param string|Uuid $newReportUserId user id for the account making the report
	 * @param string|Uuid $newReportAbuserId user id for the account detailed in the report
	 * @param string $newReportAgent agent information for the user who made the report
	 * @param string $newReportContent value/contents of the report
	 * @param \DateTime
	 * @param
	 */
}

/**
 * reportUserId BINARY(16) NOT NULL,
 * reportAbuserId BINARY(16) NOT NULL,
 * reportAgent VARCHAR(255) NOT NULL,
 * reportContent VARCHAR(255) NOT NULL,
 * reportDate DATETIME(6) NOT NULL,
 * reportIp BINARY (16) NOT NULL,
 */