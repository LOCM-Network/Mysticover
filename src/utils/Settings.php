<?php

declare(strict_types=1);

namespace phuongaz\locm\mysticover\utils;

use pocketmine\utils\Config;

class Settings {

    private string $format;

    private string $language;
    private string $firstArc;

    public function __construct(Config $config) {
        $this->format = $config->get("message-format", "{message}");
        $this->language = $config->get("language", "en");
        $this->firstArc = $config->get("first_arc", "arc_1");
    }

    public function getFirstArc(): string {
        return $this->firstArc;
    }

    public function getMessageFormat(): string {
        return $this->format;
    }

    public function getLanguage(): string {
        return $this->language;
    }


}