<?php

declare(strict_types=1);

namespace phuongaz\locm\mysticover\utils;

enum GlobalEnum {
    case GO;
    case END;

    public static function parse(string $handle) :?self {
        return match ($handle) {
            "go" => self::GO,
            "end" => self::END,
            default => null,
        };
    }

    public function parseEnum(string $value) :array {
        return match ($this) {
            self::GO => explode(":", $value)
        };
    }

    public function isLastQuest() :bool {
        return $this === self::END;
    }
}