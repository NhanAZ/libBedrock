<?php

declare(strict_types=1);

namespace NhanAZ\libBedrock;

use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\ClosureTask;
use pocketmine\utils\Config;
use pocketmine\network\mcpe\protocol\PlaySoundPacket;
use pocketmine\player\Player;

class libBedrock {

	public static function CheckConfigVersion(PluginBase $plugin, Config $config, string $configKey, string $latestVersion, string $updateMessage = ""): bool {
		if (($config->exists($configKey)) && !version_compare(strval($config->get($configKey)), $latestVersion, "<>")) {
			return false;
		}
		$configData = self::getConfigData($config);
		$configPath = $configData["configPath"];
		$originalConfig = $configData["configName"];
		$oldConfig = $configData["oldConfigName"];
		if (trim($updateMessage) === "") {
			$updateMessage = "Your $originalConfig file is outdated. Your old $originalConfig has been saved as $oldConfig and a new $originalConfig file has been generated. Please update accordingly.";
		}
		rename($configPath . $originalConfig, $configPath . $oldConfig);
		$plugin->saveDefaultConfig();
		$plugin->getConfig()->reload();
		$task = new ClosureTask(function () use ($plugin, $updateMessage): void {
			$plugin->getLogger()->critical($updateMessage);
		});
		$plugin->getScheduler()->scheduleDelayedTask($task, 3 * 20);
		return true;
	}

	/**
	 * @return array<string>
	 */
	private static function getConfigData(Config $config): array {
		$configPath = $config->getPath();
		$configData = explode(".", basename($configPath));

		$configName = $configData[0];
		$configExtension = $configData[1];

		$originalConfigName = $configName . "." . $configExtension;
		$oldConfigName = $configName . "_old." . $configExtension;

		$configPath = str_replace($originalConfigName, "", $configPath);
		$pluginPath = str_replace("plugin_data", "plugins", $configPath);

		return [
			"configPath" => $configPath,
			"pluginPath" => $pluginPath,
			"configName" => $originalConfigName,
			"oldConfigName" => $oldConfigName
		];
	}

	public static function PlaySound(Player $player, string $soundName, ?float $x = null, ?float $y = null, ?float $z = null, float $volume = 1.0, float $pitch = 1.0): void {
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
