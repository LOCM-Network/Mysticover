<?php

declare(strict_types=1);

namespace phuongaz\locm\mysticover\quests\targets;

class ShearSheep extends Target {

    /**
     * @param array $requirement
     * ["amount"]
     * @param array $value
     * ["amount"]
     * @return bool
     */
    public static function compare(array $requirement, array $value): bool {
        $reqAmount = isset($requirement[0]) ? (int) $requirement[0] : 0;
        $valAmount = isset($value[0]) ? (int) $value[0] : 0;

        return $valAmount >= $reqAmount;
    }

}