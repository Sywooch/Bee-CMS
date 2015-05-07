<?php
/**
 * @package     BeeCMS
 * @subpackage  String
 */

namespace common\libs\Helpers;

use Yii;
use yii\helpers\StringHelper;

/**
 * String handling class
 */
class BeeString extends StringHelper
{
	/**
	 * Make a string lowercase
	 * Note: The concept of a characters "case" only exists is some alphabets
	 * such as Latin, Greek, Cyrillic, Armenian and archaic Georgian - it does
	 * not exist in the Chinese alphabet, for example. See Unicode Standard
	 * Annex #21: Case Mappings
	 *
	 * @param   string  $string  String being processed
	 *
	 * @return  mixed  Either string in lowercase or FALSE is UTF-8 invalid
	 *
	 * @see     http://www.php.net/strtolower
	 */
	public static function strtolower($string)
	{
		return mb_strtolower($string);
	}

	/**
	 * Make a string uppercase
	 * Note: The concept of a characters "case" only exists is some alphabets
	 * such as Latin, Greek, Cyrillic, Armenian and archaic Georgian - it does
	 * not exist in the Chinese alphabet, for example. See Unicode Standard
	 * Annex #21: Case Mappings
	 *
	 * @param   string  $string  String being processed
	 *
	 * @return  mixed  Either string in uppercase or FALSE is UTF-8 invalid
	 *
	 * @see     http://www.php.net/strtoupper
	 */
	public static function strtoupper($string)
	{
		return mb_strtoupper($string);
	}

	/**
	 * Returns the number of characters in the string (NOT THE NUMBER OF BYTES),
	 *
	 * @param   string  $string  UTF-8 string.
	 *
	 * @return  integer  Number of UTF-8 characters in string.
	 *
	 * @see     http://www.php.net/strlen
	 */
	public static function strlen($string)
	{
		return mb_strlen($string);
	}

	/**
	 * Find position of first occurrence of a string.
	 *
	 * @param   string   $string     String being examined
	 * @param   string   $search  String being searched for
	 * @param   integer  $offset  Optional, specifies the position from which the search should be performed
	 *
	 * @return  mixed  Number of characters before the first match or FALSE on failure
	 *
	 * @see     http://www.php.net/strpos
	 */
	public static function strpos($string, $search, $offset = FALSE) {
		if ( $offset === FALSE ) {
			return mb_strpos($string, $search);
		} else {
			return mb_strpos($string, $search, $offset);
		}
	}
}
