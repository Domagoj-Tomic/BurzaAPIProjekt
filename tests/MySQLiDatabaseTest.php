<?php

use PHPUnit\Framework\TestCase;

require_once(dirname(__DIR__) . "/system/model/MySQLiDatabase.class.php");

class MySQLiDatabaseTest extends TestCase
{
        public function testSendQuery()
        {
                // Arrange
                $mysqli = $this->createMock(mysqli::class);
                $mysqli->method('query')
                        ->willReturn(true);

                $db = new MySQLiDatabase('localhost', 'stockUser', 'stck', 'stockInfo');
                $db->mysqli = $mysqli;

                // Act
                $result = $db->sendQuery('SELECT * FROM testTable');

                // Assert
                $this->assertTrue($result);
        }
}