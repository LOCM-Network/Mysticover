<?php

declare(strict_types=1);

namespace phuongaz\locm\mysticover\quests\targets;

class Give extends Target {

    /**
     * @param array $requirement
     * ["entity:npcName:entityName:amount", "entity:npcName:entityName:amount"]
     * @param array $value
     * ["entity:npcName:entityName:amount", "entity:npcName:entityName:amount"]
     * @return bool
     */
    public static function compare(array $requirement, array $value): bool {
        foreach ($requirement as $reqItem) {
            [$reqEntity, $reqNpcName, $reqEntityName, $reqAmount] = explode(':', $reqItem);
            $found = false;

            foreach ($value as $valItem) {
                [$valEntity, $valNpcName, $valEntityName, $valAmount] = explode(':', $valItem);

                if (
                    $reqEntity === $valEntity &&
                    $reqNpcName === $valNpcName &&
                    $reqEntityName === $valEntityName &&
                    (int)$valAmount >= (int)$reqAmount
                ) {
                    $found = true;
                    break;
                }
            }

            if (!$found) {
                return false;
            }
        }

        return true;
    }

}