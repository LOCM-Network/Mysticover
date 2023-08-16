<?php

declare(strict_types=1);

namespace phuongaz\locm\mysticover\timelines\scen;

use InvalidArgumentException;

enum Scens {
    case MOVE;
    case TALK;
    case FIGHT;
    case QUEST;
    case STORY;
    case FIND;
    case SPAWN;
    case END;

    public static function parse(string $str): Scens {
        return match (strtolower($str)) {
            "move" => self::MOVE,
            "talk" => self::TALK,
            "fight" => self::FIGHT,
            "quest" => self::QUEST,
            "story" => self::STORY,
            "find" => self::FIND,
            "spawn" => self::SPAWN,
            "end" => self::END,
            default => throw new InvalidArgumentException("Invalid scenario: $str"),
        };
    }
}