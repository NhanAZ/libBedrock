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