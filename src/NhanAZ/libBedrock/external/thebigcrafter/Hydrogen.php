<?php

declare(strict_types=1);

namespace NhanAZ\libBedrock\external\thebigcrafter;

use pocketmine\plugin\Plugin;
use thebigcrafter\Hydrogen\Hydrogen as thebigcrafterHydrogen;

class Hydrogen {

	/**
	 * Notify if an update is available on Poggit.
	 */
	public static function checkForUpdates(Plugin $plugin) : void {
		thebigcrafterHydrogen::checkForUpdates($plugin);
	}
}
