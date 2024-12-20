<?php

namespace App\Tests\Service\Days\Year2024;

use App\Service\Days\Year2024\D1Service;
use PHPUnit\Framework\TestCase;

class D1ServiceTest extends TestCase
{
    private D1Service $d1Service;

    protected function setUp(): void
    {
        $this->d1Service = new D1Service();
    }

    /**
     * Test calculateTotalSum with a simple dataset where columns match exactly once.
     */
    public function testCalculateTotalSumWithMatchingColumns(): void
    {
        $columnData = [
            'left' => [1, 2, 3],
            'right' => [3, 2, 1],
        ];

        $result = $this->invokePrivateMethod('calculateTotalSum', $columnData);

        $this->assertEquals(6, $result); // (1*1 + 2*1 + 3*1)
    }

    /**
     * Test calculateTotalSum with a dataset containing duplicate values in the right column.
     */
    public function testCalculateTotalSumWithDuplicates(): void
    {
        $columnData = [
            'left' => [2, 3],
            'right' => [3, 3, 2, 2],
        ];

        $result = $this->invokePrivateMethod('calculateTotalSum', $columnData);

        $this->assertEquals(10, $result); // (2*2 + 3*2)
    }

    /**
     * Test calculateTotalSum with no matching values.
     */
    public function testCalculateTotalSumWithNoMatches(): void
    {
        $columnData = [
            'left' => [1, 2],
            'right' => [3, 4],
        ];

        $result = $this->invokePrivateMethod('calculateTotalSum', $columnData);

        $this->assertEquals(0, $result);
    }

    /**
     * Test calculateTotalSum with empty input.
     */
    public function testCalculateTotalSumWithEmptyInput(): void
    {
        $columnData = [
            'left' => [],
            'right' => [],
        ];

        $result = $this->invokePrivateMethod('calculateTotalSum', $columnData);

        $this->assertEquals(0, $result);
    }

    /**
     * Test calculateTotalSum with a mix of matching and non-matching values.
     */
    public function testCalculateTotalSumWithPartialMatches(): void
    {
        $columnData = [
            'left' => [1, 2, 3, 4],
            'right' => [2, 4, 6],
        ];

        $result = $this->invokePrivateMethod('calculateTotalSum', $columnData);

        $this->assertEquals(6, $result); // (2*1 + 4*1)
    }


    /**
     * Test calculateDiff with a simple dataset where left and right columns have matching values.
     */
    public function testCalculateDiffWithMatchingValues(): void
    {
        $columnData = [
            'left' => [1, 2, 3],
            'right' => [1, 2, 3],
        ];

        $result = $this->invokePrivateMethod('calculateDiff', $columnData);

        $this->assertEquals(0, $result); // No differences
    }

    /**
     * Test calculateDiff where left and right columns have some different values.
     */
    public function testCalculateDiffWithPartialDifferences(): void
    {
        $columnData = [
            'left' => [1, 2, 3],
            'right' => [3, 2, 1],
        ];

        $result = $this->invokePrivateMethod('calculateDiff', $columnData);

        $this->assertEquals(0, $result); // |1-1| + |2-2| + |3-3|
    }

    /**
     * Test calculateDiff where all values differ.
     */
    public function testCalculateDiffWithAllDifferences(): void
    {
        $columnData = [
            'left' => [1, 2, 3],
            'right' => [4, 5, 6],
        ];

        $result = $this->invokePrivateMethod('calculateDiff', $columnData);

        $this->assertEquals(9, $result); // |1-4| + |2-5| + |3-6|
    }

    /**
     * Test calculateDiff with empty input.
     */
    public function testCalculateDiffWithEmptyInput(): void
    {
        $columnData = [
            'left' => [],
            'right' => [],
        ];

        $result = $this->invokePrivateMethod('calculateDiff', $columnData);

        $this->assertEquals(0, $result); // No data
    }

    /**
     * Helper method to invoke private methods on the D1Service class.
     */
    private function invokePrivateMethod(string $methodName, array $params)
    {
        $reflectionClass = new \ReflectionClass(D1Service::class);

        return $reflectionClass->getMethod($methodName)->invoke($this->d1Service, $params);
    }
}
