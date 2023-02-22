<?php

declare(strict_types=1);

namespace NhanAZ\libBedrock;

use pocketmine\network\mcpe\protocol\PlaySoundPacket;
use pocketmine\player\Player;

class StringToItem {

	public static function play(Player $player, string $soundName, ?float $x = null, ?float $y = null, ?float $z = null, float $volume = 1.0, float $pitch = 1.0): void {
		$playerPos = $player->getPosition();
		$player->getNetworkSession()->sendDataPacket(
			PlaySoundPacket::create(
				soundName: $soundName,
				x: $x ?? $playerPos->getX(),
				y: $y ?? $playerPos->getY(),
				z: $z ?? $playerPos->getZ(),
				volume: $volume,
				pitch: $pitch
			)
		);
	}
}
