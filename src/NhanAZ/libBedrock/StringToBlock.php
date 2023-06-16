<?php

declare(strict_types=1);

namespace NhanAZ\libBedrock;

use NhanAZ\libBedrock\exception\libBedrockException;
use pocketmine\block\Block;
use pocketmine\item\ItemBlock;

class StringToBlock {

	/**
	 * Converts a string to a block.
	 *
	 * @param string $string The string to convert.
	 *
	 * @return Block The block represented by the string.
	 *
	 * @throws libBedrockException if the string does not represent a valid block.
	 */
	public static function parse(string $string): Block {
		$item = StringToItem::parse($string);
		if (!$item instanceof ItemBlock) {
			throw new libBedrockException("\"{$string}\" is not a block!");
		}
		return $item->getBlock();
	}
}
