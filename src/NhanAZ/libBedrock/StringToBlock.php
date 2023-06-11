<?php

declare(strict_types=1);

namespace NhanAZ\libBedrock;

use NhanAZ\libBedrock\exception\libBedrockException;
use pocketmine\block\Block;
use pocketmine\item\ItemBlock;

class StringToBlock {

	public static function parse(string $string) : Block {
		$item = StringToItem::parse($string);
		if (!$item instanceof ItemBlock) {
			throw new libBedrockException("\"{$string}\" is not a block!");
		}
		return $item->getBlock();
	}
}
