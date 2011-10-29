<?php

/**
 * Class with static methods for converting numbers from decimal to a given base number system
 * 
 * @author Andrija Vucinic, Marko Andrijasevic
 * @version 1.1
 */
class NumberConverter {
	/**
	 * Array to be used for conversion
	 */ 
	private static $base = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz+=";

	/**
	 * Get's the $index character from $base array 
	 * 
	 * @param index - the position of the character needed
	 * @return Returns a character from $base for a given $number 
	 */
	private static function getCharacter($index) {
		return self::$base{$index};
	}

	/**
	 * Converts a decimal number to a given base 
	 * 
	 * @param number - Number to be converted
	 * @param toBase - Number base to be converted to [optional]
	 * 
	 * @return String - Converted number 
	 * @throws Exception
	 */
	public static function fromDecimalToBase($number, $toBase = 64){

		// Check if the base is greater then the max possible base
		if ($toBase > strlen(self::$base)) {
			throw new Exception('Base too big.');
		}
		// Convert number to integer (better safe than sorry)
		$number = intval($number);

		// Set a flag if the number is negative, do a positive conversion then just add the minus sign
		$isNegative = false;
		if ($number <= 0) {
			$isNegative = true;
			$number = abs($number);
		}

		$converted = "";
		while ($number != 0) {
			// Get a number in the new base
			$modulus = $number % $toBase;
			// Get the number representation in that base
			$converted = self::getCharacter($modulus) . $converted;
			// Remove the extracted number and continue until the number is 0
			$number = intval(($number - $modulus) / $toBase);
		}

		// Add the minus sign if it was negative
		if ($isNegative) {
			$converted = "-" . $converted;
		}
		 
		return $converted;

	}
}

?>