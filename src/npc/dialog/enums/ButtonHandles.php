<?php

declare(strict_types=1);

namespace phuongaz\locm\mysticover\npc\dialog\enums;

enum ButtonHandles {
    case GIVE;
    case TAKE;

    case GIVE_ITEM;
    case NOTICE;

    public static function parseKey(string $handle) :?self {
        return match ($handle) {
            "give" => self::GIVE,
            "take" => self::TAKE,
            default => null,
        };
    }

    public static function parseType(string $handle) :?self {
        return match ($handle) {
            "items" => self::GIVE_ITEM,
            "notice" => self::NOTICE,
            default => null,
        };
    }


}