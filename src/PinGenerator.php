<?php

namespace Bfg\Task;

class PinGenerator
{
    
    const PIN_LENGTH = 4;      /** Length of the PIN */
    const TOTAL_PINS = 5;      /** Number of PINs to generate */
    const MIN_PIN = 0;         
    const MAX_PIN = 9999;    

    /** Method to generate valid PINs */
    public function generate() {
        $pins = [];
        while (count($pins) < self::TOTAL_PINS) {
            $pin = $this->generateFourDigitPin();
            if ($this->isValidatePin($pin) && !in_array($pin, $pins)) {
                $pins[] = $pin;
            }
        }
        return $pins;
    }

    /** Method to generate a random 4-digit pin */
    private function generateFourDigitPin() {
        return str_pad(rand(self::MIN_PIN, self::MAX_PIN), self::PIN_LENGTH, '0', STR_PAD_LEFT);
    }

    /** Method to check if a PIN is valid (non-sequential, non-repeating, and non-palindrome) */
    private function isValidatePin($pin) {
        return !$this->isSequentialPin($pin) && !$this->isRepeatingDigitPin($pin) && !$this->isPalindromePin($pin);
    }

    /** Check if the PIN is sequential */
    private function isSequentialPin($pin) {
        for ($i = 0; $i < self::PIN_LENGTH - 1; $i++) {
            if ((int)$pin[$i + 1] !== (int)$pin[$i] + 1) {
                return false;
            }
        }
        return true;
    }

    /** Check if the PIN has repeating digits  */
    private function isRepeatingDigitPin($pin) {
        return preg_match('/(\d)\1/', $pin); // This checks for any repeating digits.
    }

    /** Check if the PIN is a palindrome */
    private function isPalindromePin($pin) {
        return $pin === strrev($pin);
    }
}
