<?php

declare(strict_types=1);

namespace NhanAZ\libBedrock\tools;

use pocketmine\item\Item;
use pocketmine\item\LegacyStringToItemParser;
use pocketmine\item\LegacyStringToItemParserException;
use pocketmine\item\StringToItemParser;
use function array_push;
use function fclose;
use function fopen;
use function fwrite;
use function in_array;
use function str_replace;
use const PHP_EOL;

class GenStringToIdMeta {

	public static function start() : void {
		$arr = [];
		$file = fopen('C:\Users\NhanAZ\Downloads\PocketMine-MP\virions\libBedrock\src\NhanAZ\libBedrock\StringToIdMeta.php', "w");
		if ($file == false) return;
		$data =
			<<<'EOF'
<?php

declare(strict_types=1);

namespace NhanAZ\libBedrock;

use NhanAZ\libBedrock\exception\libBedrockUnexpectedValueException;
use function constant;
use function define;
use function explode;
use function is_string;
use function preg_replace;
use function rtrim;
use function substr;

EOF;
		fwrite($file, $data . "\n");
		for ($id = -214; $id <= 511; $id++) {
			for ($meta = 0; $meta <= 100; $meta++) {
				$item = $id . ":" . $meta;
				try {
					$item = StringToItemParser::getInstance()->parse($item) ?? LegacyStringToItemParser::getInstance()->parse($item);
				} catch (LegacyStringToItemParserException $e) {
					$item = "Unknown";
				}
				if ($item instanceof Item) {
					$object = $item->getStateId() . $item->getTypeId();
					if (!in_array($object, $arr, true)) {
						$itemString = str_replace("'", "\'", $item->__toString());
						$idMeta = $id . ":" . $meta;
						fwrite($file, "define('" . $itemString . "', '" . $idMeta . "');" . PHP_EOL);
						array_push($arr, $object);
					}
				}
			}
		}
		$data =
			<<<'EOF'

/**
 * This class provides a method to parse a string to an array of id and meta values.
 *
 * The `parse()` method takes a string as input and returns an array with the following keys:
 *
 * * `id`: The id value.
 * * `meta`: The meta value.
 *
 * If the string cannot be parsed, the `parse()` method will throw a `libBedrockUnexpectedValueException` exception.
 */
class StringToIdMeta {

	/**
	 * Parses a string to an array of id and meta values.
	 *
	 * @param string $string The string to parse.
	 *
	 * @return array<string, int> The parsed array.
	 *
	 * @throws libBedrockUnexpectedValueException If the string cannot be parsed.
	 */
	public static function parse(string $string) : array {
		$idMeta = constant($string);
		if (!is_string($idMeta)) {
			throw new libBedrockUnexpectedValueException();
		}
		[$id, $meta] = explode(":", $idMeta);
		return [
			"id" => (int) $id,
			"meta" => (int) $meta,
		];
	}
}

EOF;
		fwrite($file, $data);
		fclose($file);
	}
}
