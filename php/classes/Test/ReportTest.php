<?php
namespace DeepDiveDatingApp\DeepDiveDating\Test;


use DeepDiveDatingApp\DeepDiveDating\Report;

require_once(dirname(__DIR__) . "/autoload.php");

require_once(dirname(__DIR__, 2) . "/lib/uuid.php");

/**
 * unit test for the Report Class
 * PDO methods are located in the Report Class
 * @ see php/classes/Report.php
 * @author Taylor Smith
 */

class ReportTest extends DeepDiveDatingAppTest {
	/**
	 * protect Constant for the actual Report Agent that is used for the test
	 **/
	protected $VALID_REPORT_AGENT = "";

	/**
	 * protect Constant for the actual Report Content that is used for the test
	 **/
	protected $VALID_REPORT_CONTENT = "";

	/**
	 * protect Constant for the Report Date and Time
	 **/
	protected $VALID_REPORT_DATE = " ";

	/**
	 * protect Constant actual value for the Report Ip Address
	 **/
	protected $VALID_REPORT_IP = "";

}