<?php

declare(strict_types=1);

namespace phuongaz\locm\mysticover;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;

class MystiCover extends PluginBase {
    use SingletonTrait;

    public function onLoad(): void {
        self::setInstance($this);
    }

}