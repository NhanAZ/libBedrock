## API documentation

#### `StringToItem::parse()` - Parse a string to an item object
```php
use NhanAZ\libBedrock\StringToItem;

$item = StringToItem::parse("stone");
# You can also use id "1:0" instead of "stone"
$player->getInventory()->addItem($item);
```

#### `StringToBlock::parse()` - Parse a string to an block object
```php
use NhanAZ\libBedrock\StringToBlock;

$block = StringToBlock::parse("stone");
# You can also use id "1:0" instead of "stone"
$world->setBlock($position, $block);
```

#### `Sounder::play()` - Play a sound for the player
```php
use NhanAZ\libBedrock\Sounder;

Sounder::play($player, "sound.name");

Sounder::play($player, "sound.name", $x, $y, $z, $volume, $pitch);
```

#### `ConfigChecker::checkConfigVersion()` - Check the plugin's config version
```php
use NhanAZ\libBedrock\ConfigChecker;

ConfigChecker::checkConfigVersion($this, $this->getConfig(), "configKey", "latestVersion");
```

#### `Jwt::parse()` - Parse clientDataJwt
```php
use NhanAZ\libBedrock\Jwt;
use pocketmine\event\server\DataPacketReceiveEvent;

public function onRecieve(DataPacketReceiveEvent $event): void {
	$packet = $event->getPacket();
	if ($packet instanceof LoginPacket) {
		$jwt = Jwt::parse($p->clientDataJwt);
		$deviceModel = $jwt->getDeviceModel();
		# More: https://github.com/NhanAZ/libBedrock/blob/master/src/NhanAZ/libBedrock/Jwt.php
		var_dump("$deviceModel device join the server!")
	}
}
```

#### `BedrockMath::Center()`
This method is used to calculate the center of a Vector3 by adding the values 0.5 to the elements of the vector. For example, if you have a vector with 3 elements (x, y, z) by adding 0.5 to these elements you will get a new vector with elements (x + 0.5, y + 0.5, z + 0.5).

This has meaning because when you calculate the center of a Vector3, you want to return a value closest to the center of the vector. By adding 0.5 to each element of the vector, you will get the result closest to the center of the vector.

See demo in: https://github.com/nhanaz-pm-pl/BetterCancel

Here is an example of how this method can be used:

```php
use NhanAZ\libBedrock\BedrockMath;

// Create a Vector3 with the values (10, 20, 30)
$vector = new Vector3(10, 20, 30);

// Calculate the center of the vector
$center = BedrockMath::Center($vector);

// Print the result
echo $center; // Output: (10.5, 20.5, 30.5)
```