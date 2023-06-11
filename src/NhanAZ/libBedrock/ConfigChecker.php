<?php

declare(strict_types=1);

namespace NhanAZ\libBedrock;

use NhanAZ\libBedrock\exception\libBedrockUnexpectedValueException;
use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\ClosureTask;
use pocketmine\utils\Config;
use function basename;
use function explode;
use function is_string;
use function rename;
use function str_replace;
use function trim;
use function version_compare;

class ConfigChecker {

	/**
	 * @return array<string>
	 */
	private static function getConfigData(Config $config) : array {
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

	public static function checkConfigVersion(PluginBase $plugin, Config $config, string $configKey, string $latestVersion, string $updateMessage = "") : bool {
		$configKey = $config->get($configKey);
		if (!is_string($configKey)) {
			throw new libBedrockUnexpectedValueException('Parameter #3 $configKey of method NhanAZ\libBedrock\ConfigChecker::checkConfigVersion() expects string, mixed given.');
		}
		if (($config->exists($configKey)) && !version_compare($configKey, $latestVersion, "<>")) {
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
		$task = new ClosureTask(function () use ($plugin, $updateMessage) : void {
			$plugin->getLogger()->critical($updateMessage);
		});
		$plugin->getScheduler()->scheduleDelayedTask($task, 3 * 20);
		return true;
	}
}
