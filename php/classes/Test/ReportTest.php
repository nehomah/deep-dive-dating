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
	 * @var string $VALID_REPORT_AGENT value of test user agent info
	 **/
	protected $VALID_REPORT_AGENT = "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.103 Safari/537.36";

	/**
	 * protect Constant for the actual Report Agent that is used for the test
	 * @var string $VALID_REPORT_AGENT1 value of test user agent info
	 **/
	protected $VALID_REPORT_AGENT1 = "Mozilla/5.0 (iPhone; CPU iPhone OS 10_3_1 like Mac OS X) AppleWebKit/603.1.30 (KHTML, like Gecko) Version/10.0 Mobile/14E304 Safari/602.1";

	/**
	 * protect Constant for the actual Report Content that is used for the test
	 * @var string $VALID_REPORT_CONTENT value of test report content
	 **/
	protected $VALID_REPORT_CONTENT = "This guy is a super creep!";

	/**
	 * protect Constant for the actual Report Content that is used for the test
	 * @var string $VALID_REPORT_CONTENT1 value of test report content
	 **/
	protected $VALID_REPORT_CONTENT1 = "This girl will not leave me alone!";

	/**
	 * protect Constant for the Report Date and Time
	 * @var \DateTime $VALID_REPORT_DATE actual value of test date and time
	 **/
	protected $VALID_REPORT_DATE = "2018-02-14 14:16:18";

	/**
	 * protect Constant for the Report Date and Time
	 * @var \DateTime $VALID_REPORT_DATE1 actual value of test date and time
	 **/
	protected $VALID_REPORT_DATE1 = "2018-01-14 4:16:18";

	/**
	 * protect Constant actual value for the Report Ip Address
	 * @var string $VALID_REPORT_IP actual value for test Ip
	 **/
	protected $VALID_REPORT_IP = "192.0.2.16";

	/**
	 * protect Constant actual value for the Report Ip Address
	 * @var string $VALID_REPORT_IP1 actual value for test Ip
	 **/
	protected $VALID_REPORT_IP1 = "192.0.2.7";


}