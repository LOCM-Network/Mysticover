<?php

declare(strict_types=1);

namespace phuongaz\locm\mysticover;

use phuongaz\locm\mysticover\database\PlayerDatabase;
use phuongaz\locm\mysticover\listeners\EventHandler;
use phuongaz\locm\mysticover\utils\Language;
use phuongaz\locm\mysticover\utils\Settings;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\SingletonTrait;
use poggit\libasynql\libasynql;

class MystiCover extends PluginBase {
    use SingletonTrait;
    private PlayerDatabase $playerDatabase;
    private Language $language;
    private Settings $settings;

    public function onLoad(): void {
        self::setInstance($this);
        $connector = libasynql::create($this, $this->getConfig()->get("database"), [
            "sqlite" => "sqlite.sql",
        ]);
        $this->playerDatabase = new PlayerDatabase($connector);
        $this->language =  new Language($this->getConfig()->get("language"), $this->getDataFolder() . "language". DIRECTORY_SEPARATOR);
    }

    public function onEnable(): void {
        $this->getServer()->getPluginManager()->registerEvents(new EventHandler(), $this);
    }

    public function getPlayerDatabase(): PlayerDatabase {
        return $this->playerDatabase;
    }

    public function getLanguage(): Language {
        return $this->language;
    }

    public function getSettings(): Settings {
        return $this->settings;
    }

}