<?php

declare(strict_types=1);

namespace NhanAZ\libBedrock;

use pocketmine\item\Item;
use pocketmine\nbt\LittleEndianNbtSerializer;
use pocketmine\nbt\TreeRoot;
use function base64_encode;

class ItemFactory {

	/** @return mixed[] */
	public static function jsonSerialize(Item $item) : array {
		$idMeta = StringToIdMeta::parse($item->__toString());
		$id = $idMeta["id"];
		$meta = $idMeta["meta"];

		$data = ["id" => $id];

		if ($meta !== 0) {
			$data["damage"] = $meta;
		}

		if ($item->getCount() !== 1) {
			$data["count"] = $item->getCount();
		}

		if ($item->hasNamedTag()) {
			$data["nbt_b64"] = base64_encode((new LittleEndianNbtSerializer())->write(new TreeRoot($item->getNamedTag())));
		}

		return $data;
	}
}
