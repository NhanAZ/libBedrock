<?php

declare(strict_types=1);

namespace NhanAZ\libBedrock;

use pocketmine\plugin\PluginBase;

class libBedrock {

	public function __construct(
		private PluginBase $plugin /** @phpstan-ignore-line */
	) {
	}
}
