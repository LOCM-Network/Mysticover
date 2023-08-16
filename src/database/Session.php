<?php

declare(strict_types=1);

namespace phuongaz\locm\mysticover\database;

use muqsit\invmenu\session\PlayerSession;
use pocketmine\player\Player;
use SplObjectStorage;

final class Session {

    private static SplObjectStorage $players;

    public static function init(): void {
        self::$players = new SplObjectStorage();
    }

    public static function addPlayer(Player $player, PlayerSession $playerSession): void {
        self::$players[$player] = $playerSession;
    }

    public static function removePlayer(Player $player): void {
        unset(self::$players[$player]);
    }

    public static function getPlayerSession(Player $player): ?PlayerSession {
        return self::$players[$player] ?? null;
    }

    public static function isPlayerSession(Player $player): bool {
        return isset(self::$players[$player]);
    }

    public static function getPlayerSessions(): SplObjectStorage {
        return self::$players;
    }

}