<?php

declare(strict_types=1);

namespace NhanAZ\libBedrock;

use NhanAZ\libBedrock\exception\libBedrockException;
use pocketmine\item\Item;
use pocketmine\item\LegacyStringToItemParser;
use pocketmine\item\LegacyStringToItemParserException;
use pocketmine\item\StringToItemParser;

class StringToItem {

	public static function parse(string $string) : Item {
		try {
			$item = StringToItemParser::getInstance()->parse($string) ?? LegacyStringToItemParser::getInstance()->parse($string);
		} catch (LegacyStringToItemParserException $e) {
			throw new libBedrockException($e->getMessage());
		}
		if (!$item instanceof Item) {
			throw new libBedrockException("\"{$string}\" is not a item!");
		}
		return $item;
	}
}
