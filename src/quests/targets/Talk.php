<?php

declare(strict_types=1);

namespace phuongaz\locm\mysticover\quests\targets;

class Talk extends Target {

    /**
     * @param array $requirement
     * ["npcName", "npcName"]
     * @param array $value
     * ["npcName", "npcName"]
     * @return bool
     */
    public static function compare(array $requirement, array $value): bool {
        sort($requirement);
        sort($value);

        return $requirement === $value;
    }

}