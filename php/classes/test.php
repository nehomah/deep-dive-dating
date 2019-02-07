<?php
namespace Edu\Cnm\DataDesign\Test;

use PHPUnit\Framework\TestCase;
use PHPUnit\DbUnit\TestCaseTrait;
use PHPUnit\DbUnit\DataSet\QueryDataSet;
use PHPUnit\DbUnit\Database\Connection;
use PHPUnit\DbUnit\Operation\{Composite, Factory, Operation};

// grab the encrypted properties file
require_once("/etc/apache2/capstone-mysql/Secret.php");

require_once(dirname(__DIR__, 3) . "/vendor/autoload.php");

/**
 * Abstract class containing universal and project specific mySQL parameters
 *
 * This class is designed to lay the foundation of the unit tests per project. It loads the all the database
 * parameters about the project so that table specific tests can share the parameters in on place. To use it:
 *
 * 1. Rename the class from DataDesignTest to a project specific name (e.g., ProjectNameTest)
 * 2. Rename the namespace to be the same as in (1) (e.g., Edu\Cnm\ProjectName\Test)
 * 3. Modify DataDesignTest::getDataSet() to include all the tables in your project.
 * 4. Modify DataDesignTest::getConnection() to include the correct mySQL properties file.
 * 5. Have all table specific tests include this class.
 *
 * *NOTE*: Tables must be added in the order they were created in step (2).
 *
 * @author Dylan McDonald <dmcdonald21@cnm.edu>
 * referenced from: https://bootcamp-coders.cnm.edu/class-materials/unit-testing/phpunit/
 **/