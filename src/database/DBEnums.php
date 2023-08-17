<?php

declare(strict_types=1);

namespace phuongaz\locm\mysticover\database;

enum DBEnums {

    case PLAYER_INIT;
    case PLAYER_INSERT;
    case PLAYER_UPDATE;
    case PLAYER_SELECT;
    case PLAYER_DELETE;

    public function toString(): string {
        $prefix = "mysticover";
        return match ($this) {
            self::PLAYER_INIT => $prefix . ".player.init",
            self::PLAYER_INSERT => $prefix . ".player.insert",
            self::PLAYER_UPDATE => $prefix . ".player.update",
            self::PLAYER_SELECT => $prefix . ".player.select",
            self::PLAYER_DELETE => $prefix . ".player.delete",
        };
    }
}