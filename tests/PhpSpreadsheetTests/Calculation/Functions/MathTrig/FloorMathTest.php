<?php

declare(strict_types=1);

namespace PhpOffice\PhpSpreadsheetTests\Calculation\Functions\MathTrig;

use PhpOffice\PhpSpreadsheet\Calculation\Calculation;

class FloorMathTest extends AllSetupTeardown
{
    #[\PHPUnit\Framework\Attributes\DataProvider('providerFLOORMATH')]
    public function testFLOORMATH(mixed $expectedResult, string $formula): void
    {
        $this->mightHaveException($expectedResult);
        $sheet = $this->getSheet();
        $sheet->setCellValue('A2', 1.3);
        $sheet->setCellValue('A3', 2.7);
        $sheet->setCellValue('A4', -3.8);
        $sheet->setCellValue('A5', -5.2);
        $sheet->getCell('A1')->setValue("=FLOOR.MATH($formula)");
        $result = $sheet->getCell('A1')->getCalculatedValue();
        self::assertEqualsWithDelta($expectedResult, $result, 1E-12);
    }

    public static function providerFLOORMATH(): array
    {
        return require 'tests/data/Calculation/MathTrig/FLOORMATH.php';
    }

    #[\PHPUnit\Framework\Attributes\DataProvider('providerFloorArray')]
    public function testFloorArray(array $expectedResult, string $argument1, string $argument2): void
    {
        $calculation = Calculation::getInstance();

        $formula = "=FLOOR.MATH({$argument1}, {$argument2})";
        $result = $calculation->_calculateFormulaValue($formula);
        self::assertEqualsWithDelta($expectedResult, $result, 1.0e-14);
    }

    public static function providerFloorArray(): array
    {
        return [
            'matrix' => [[[3.14, 3.14], [3.14155, 3.141592]], '3.1415926536', '{0.01, 0.002; 0.00005, 0.000002}'],
        ];
    }
}
