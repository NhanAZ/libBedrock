<?php

declare(strict_types=1);

namespace NhanAZ\libBedrock;

use NhanAZ\libBedrock\exception\libBedrockUnexpectedValueException;
use pocketmine\plugin\PluginBase;
use pocketmine\resourcepacks\ResourcePack;
use pocketmine\resourcepacks\ZippedResourcePack;
use pocketmine\utils\Filesystem;
use Symfony\Component\Filesystem\Path;
use function array_search;
use function is_array;
use function is_null;
use function is_string;
use function mb_strtolower;
use function preg_replace;
use function str_contains;
use function unlink;

class ResourcePackManager {

	private static ?ResourcePack $pack = null;

	public static function registerResourcePack(PluginBase $plugin) : void {
		$plugin->getLogger()->debug('Compiling resource pack');
		$zip = new \ZipArchive();
		$zip->open(Path::join($plugin->getDataFolder(), $plugin->getName() . '.mcpack'), \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

		foreach ($plugin->getResources() as $resource) {
			if ($resource->isFile() && str_contains($resource->getPathname(), $plugin->getName() . ' Pack')) {
				$path = preg_replace("/.*[\/\\\\]{$plugin->getName()}\hPack[\/\\\\].*/U", '', $resource->getPathname());
				if (!is_string($path)) {
					throw new libBedrockUnexpectedValueException();
				}
				$relativePath = Path::normalize($path);
				$plugin->saveResource(Path::join($plugin->getName() . ' Pack', $relativePath), false);
				$zip->addFile(Path::join($plugin->getDataFolder(), $plugin->getName() . ' Pack', $relativePath), $relativePath);
			}
		}

		$zip->close();
		Filesystem::recursiveUnlink(Path::join($plugin->getDataFolder() . $plugin->getName() . ' Pack'));
		$plugin->getLogger()->debug('Resource pack compiled');

		$plugin->getLogger()->debug('Registering resource pack');
		$plugin->getLogger()->debug('Resource pack compiled');
		self::$pack = $pack = new ZippedResourcePack(Path::join($plugin->getDataFolder(), $plugin->getName() . '.mcpack'));
		$manager = $plugin->getServer()->getResourcePackManager();

		$reflection = new \ReflectionClass($manager);

		$property = $reflection->getProperty("resourcePacks");
		$currentResourcePacks = $property->getValue($manager);
		if (!is_array($currentResourcePacks)) {
			throw new libBedrockUnexpectedValueException();
		}
		$currentResourcePacks[] = $pack;
		$property->setValue($manager, $currentResourcePacks);

		$property = $reflection->getProperty("uuidList");
		$currentUUIDPacks = $property->getValue($manager);
		if (!is_array($currentUUIDPacks)) {
			throw new libBedrockUnexpectedValueException();
		}
		$currentUUIDPacks[mb_strtolower($pack->getPackId())] = $pack;
		$property->setValue($manager, $currentUUIDPacks);

		$property = $reflection->getProperty("serverForceResources");
		$property->setValue($manager, true);

		$plugin->getLogger()->debug('Resource pack registered');
	}

	public static function unRegisterResourcePack(PluginBase $plugin) : void {
		$manager = $plugin->getServer()->getResourcePackManager();
		$pack = self::$pack;

		$reflection = new \ReflectionClass($manager);

		$property = $reflection->getProperty("resourcePacks");
		$currentResourcePacks = $property->getValue($manager);
		if (!is_array($currentResourcePacks)) {
			throw new libBedrockUnexpectedValueException();
		}
		$key = array_search($pack, $currentResourcePacks, true);

		if ($key !== false) {
			unset($currentResourcePacks[$key]);
			$property->setValue($manager, $currentResourcePacks);
		}

		$property = $reflection->getProperty("uuidList");
		$currentUUIDPacks = $property->getValue($manager);

		if (is_null($pack)) {
			throw new libBedrockUnexpectedValueException();
		}
		if (isset($currentResourcePacks[mb_strtolower($pack->getPackId())])) {
			if (!is_array($currentUUIDPacks)) {
				throw new libBedrockUnexpectedValueException();
			}
			unset($currentUUIDPacks[mb_strtolower($pack->getPackId())]);
			$property->setValue($manager, $currentUUIDPacks);
		}
		$plugin->getLogger()->debug('Resource pack unregistered');

		unlink(Path::join($plugin->getDataFolder(), $plugin->getName() . '.mcpack'));
		$plugin->getLogger()->debug('Resource pack file deleted');
	}
}
