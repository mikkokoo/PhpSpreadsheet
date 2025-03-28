<?php

declare(strict_types=1);

namespace PhpOffice\PhpSpreadsheetTests\Calculation\Functions\Statistical;

use PhpOffice\PhpSpreadsheet\Calculation\Calculation;

class FisherInvTest extends AllSetupTeardown
{
    #[\PHPUnit\Framework\Attributes\DataProvider('providerFISHERINV')]
    public function testFISHERINV(mixed $expectedResult, mixed ...$args): void
    {
        $this->runTestCases('FISHERINV', $expectedResult, ...$args);
    }

    public static function providerFISHERINV(): array
    {
        return require 'tests/data/Calculation/Statistical/FISHERINV.php';
    }

    #[\PHPUnit\Framework\Attributes\DataProvider('providerFisherArray')]
    public function testFisherArray(array $expectedResult, string $values): void
    {
        $calculation = Calculation::getInstance();

        $formula = "=FISHERINV({$values})";
        $result = $calculation->_calculateFormulaValue($formula);
        self::assertEqualsWithDelta($expectedResult, $result, 1.0e-14);
    }

    public static function providerFisherArray(): array
    {
        return [
            'row vector' => [
                [[-0.7162978701990245, 0.197375320224904, 0.6351489523872873, 0.9051482536448664]],
                '{-0.9, 0.2, 0.75, 1.5}',
            ],
        ];
    }
}
