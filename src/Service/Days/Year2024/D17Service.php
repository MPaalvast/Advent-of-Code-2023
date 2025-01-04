<?php

namespace App\Service\Days\Year2024;

use App\Service\Days\DayServiceInterface;
use Symfony\Component\DependencyInjection\Attribute\AsTaggedItem;

#[AsTaggedItem('Y2024D17')]
class D17Service implements DayServiceInterface
{
    private string $output = '';
    private array $computer = [];
    /** curent pointer */
    private int $CP = 0;

    public function generatePart1(array|\Generator $rows): string
    {
        $this->initComputer($rows);
        $this->runProgram();
        $this->setOutput();
        return $this->output;
    }

    public function generatePart2(array|\Generator $rows): string
    {
        return 0;
    }

    private function initComputer($rows): void
    {
        $type = 'values';
        foreach ($rows as $x => $row) {
            $row = trim(preg_replace('/\r+/', '', $row));
            if (empty($row)) {
                $type = 'instructions';
                continue;
            }
            if ($type === 'values') {
                $parts = explode(': ', $row);
                $this->computer['register'][substr($parts[0], -1)] = (int)$parts[1];
            } else {
                $this->computer['program'] = array_map('intval', explode(',', explode(': ', $row)[1]));
            }
        }
        $this->computer['output'] = [];
    }

    private function runProgram(): void
    {
        while (true) {
            if (!isset($this->computer['program'][$this->CP])) {
                break;
            }
            $operand = $this->computer['program'][$this->CP];
            $literalOperand = $this->computer['program'][$this->CP+1];
            $this->operandAction($operand, $literalOperand);
        }
    }

    private function getComboOperandValue($literalOperand): int
    {
        return match ($literalOperand) {
            0 => 0,
            1 => 1,
            2 => 2,
            3 => 3,
            4 => $this->computer['register']['A'],
            5 => $this->computer['register']['B'],
            6 => $this->computer['register']['C'],
            7 => throw new \Exception('Unexpected literal operand'),
        };
    }

    private function operandAction(int $operand, int $literalOperand): void
    {
        match ($operand) {
            0 => $this->adv($literalOperand),
            1 => $this->bxl($literalOperand),
            2 => $this->bst($literalOperand),
            3 => $this->jnz($literalOperand),
            4 => $this->bxc($literalOperand),
            5 => $this->out($literalOperand),
            6 => $this->bdv($literalOperand),
            7 => $this->cdv($literalOperand),
        };
    }

    /**
     * The adv instruction (opcode 0) performs division. The numerator is the value in the A register.
     * The denominator is found by raising 2 to the power of the instruction's combo operand.
     * (So, an operand of 2 would divide A by 4 (2^2); an operand of 5 would divide A by 2^B.)
     * The result of the division operation is truncated to an integer and then written to the A register.
     */
    private function adv(int $literalOperand): void
    {
        $this->computer['register']['A'] = $this->dvCalculator($literalOperand);
        $this->increasePointer();
    }

    /**
     * The bdv instruction (opcode 6) works exactly like the adv instruction except that the result is stored in the B register.
     * (The numerator is still read from the A register.)
     */
    private function bdv(int $literalOperand): void
    {
        $this->computer['register']['B'] = $this->dvCalculator($literalOperand);
        $this->increasePointer();
    }

    /**
     * The cdv instruction (opcode 7) works exactly like the adv instruction except that the result is stored in the C register.
     * (The numerator is still read from the A register.)
     */
    private function cdv(int $literalOperand): void
    {
        $this->computer['register']['C'] = $this->dvCalculator($literalOperand);
        $this->increasePointer();
    }

    private function dvCalculator(int $literalOperand): int
    {
        $comboOperand = $this->getComboOperandValue($literalOperand);
        $power = 2 ** $comboOperand;
        return $this->computer['register']['A'] / $power;
    }

    /**
     * The bxl instruction (opcode 1) calculates the bitwise XOR of register B and the instruction's literal operand, then stores the result in register B.
     */
    private function bxl(int $literalOperand): void
    {
        $this->computer['register']['B'] ^= $literalOperand;
        $this->increasePointer();
    }

    /**
     * The bst instruction (opcode 2) calculates the value of its combo operand modulo 8
     * (thereby keeping only its lowest 3 bits), then writes that value to the B register.
     */
    private function bst(int $literalOperand): void
    {
        $comboOperand = $this->getComboOperandValue($literalOperand);
        $result = $comboOperand % 8;
        $binaryValue = decbin($result);
        $this->computer['register']['B'] = bindec(substr($binaryValue, -3));
        $this->increasePointer();
    }

    /**
     * The jnz instruction (opcode 3) does nothing if the A register is 0.
     * However, if the A register is not zero, it jumps by setting the instruction pointer to the value of its literal operand;
     * if this instruction jumps, the instruction pointer is not increased by 2 after this instruction.
     */
    private function jnz(int $literalOperand): void
    {
        if ($this->computer['register']['A'] !== 0) {
            $this->setPointer($literalOperand);
            return;
        }
        $this->increasePointer();
    }

    /**
     * The bxc instruction (opcode 4) calculates the bitwise XOR of register B and register C,
     * then stores the result in register B. (For legacy reasons, this instruction reads an operand but ignores it.)
     */
    private function bxc(int $literalOperand): void
    {
        $this->computer['register']['B'] ^= $this->computer['register']['C'];
        $this->increasePointer();
    }

    /**
     * The out instruction (opcode 5) calculates the value of its combo operand modulo 8, then outputs that value.
     * (If a program outputs multiple values, they are separated by commas.)
     */
    private function out(int $literalOperand): void
    {
        // modulo => %
        $comboOperand = $this->getComboOperandValue($literalOperand);
        $result = $comboOperand % 8;
        $this->computer['output'][] = $result;
        $this->increasePointer();
    }

    private function setPointer(int $newValue): void
    {
        $this->CP = $newValue;
    }

    private function increasePointer(): void
    {
        $this->CP += 2;
    }

    private function setOutput(): void
    {
        $this->output = implode (',', $this->computer['output']);
    }

    private function getRegisterValue(string $index): string
    {
        return $this->computer['register'][$index];
    }
}