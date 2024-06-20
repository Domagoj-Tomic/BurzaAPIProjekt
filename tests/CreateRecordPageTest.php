<?php

use PHPUnit\Framework\TestCase;

require_once(dirname(__DIR__) . "/system/AppCore.class.php"); 
require_once(dirname(__DIR__) . "/system/model/MySQLiDatabase.class.php"); 
require_once(dirname(__DIR__) . "/system/control/AbstractPage.class.php"); 
require_once(dirname(__DIR__) . "/system/control/CreateRecordPage.class.php"); 

class CreateRecordPageTest extends TestCase
{
    public function testGenerateRandomString()
    {
        // Arrange
        $createRecord = new CreateRecordPage();

        // Act
        $randString = $createRecord->generateRandomString();

        // Assert
        $this->assertMatchesRegularExpression('/^[A-Z]{3,4}$/', $randString);
    }

    public function testCreateTableAndInsertData()
    {
        // Arrange
        $createRecord = new CreateRecordPage();
        $createRecord->adminKey = "admin";
        $database = $this->createConfiguredMock(
            MySQLiDatabase::class,
            [
                'sendQuery' => (object) ['num_rows' => 0],
            ],
            );
            $timeseries = array(
                2024-01-25 => [
                    "1. open"=>"184.96",
                    "2. high"=>"196.90",
                    "3. low"=>"184.83",
                    "4. close"=>"190.43",
                    "5. volume"=>"29596239"
                ],
                2024-01-26 => [
                    "1. open"=>"184.96",
                    "2. high"=>"196.90",
                    "3. low"=>"184.83",
                    "4. close"=>"190.43",
                    "5. volume"=>"29596239"
                ]
            );

        // Act
        $createRecord->db = $database;
        $response = $createRecord->createTableAndInsertData("IBM",$timeseries);

        // Assert
        $this->assertEquals('Table for IBM created',$response->Info);
    }
}
