<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../gear_functions.php';

class GearTest extends TestCase
{
    public function testCreateGearBerhasil()
    {
        // Mock cek user
        $checkStmt = $this->createMock(PDOStatement::class);

        $checkStmt->method('execute')
                  ->willReturn(true);

        $checkStmt->method('fetch')
                  ->willReturn(['id' => 1]);

        // Mock insert gear
        $insertStmt = $this->createMock(PDOStatement::class);

        $insertStmt->method('execute')
                   ->willReturn(true);

        // Mock PDO
        $pdoMock = $this->createMock(PDO::class);

        $pdoMock->method('prepare')
                ->willReturnOnConsecutiveCalls(
                    $checkStmt,
                    $insertStmt
                );

        // Test function
        $result = createGear(
            $pdoMock,
            1,
            'Carrier Eiger',
            'Carrier',
            1,
            'Outdoor gear'
        );

        $this->assertTrue($result);
    }

    public function testCreateGearUserTidakAda()
    {
        // Mock user tidak ditemukan
        $checkStmt = $this->createMock(PDOStatement::class);

        $checkStmt->method('execute')
                  ->willReturn(true);

        $checkStmt->method('fetch')
                  ->willReturn(false);

        // Mock PDO
        $pdoMock = $this->createMock(PDO::class);

        $pdoMock->method('prepare')
                ->willReturn($checkStmt);

        // Test
        $result = createGear(
            $pdoMock,
            99,
            'Tas',
            'Carrier',
            0,
            'Testing'
        );

        $this->assertFalse($result);
    }
}