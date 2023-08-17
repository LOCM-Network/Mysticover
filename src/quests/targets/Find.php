<?php

declare(strict_types=1);

namespace phuongaz\locm\mysticover\quests\targets;

class Find extends Target {

    /**
     * @param array $requirement
     * ["entity:entityName:amount", "item:itemName:amount"]
     * @param array $value
     * ["entity:entityName:amount", "item:itemName:amount"]
     *
     * @return bool
     */
    public static function compare(array $requirement, array $value): bool {
        foreach ($requirement as $reqItem) {
            $reqParts = explode(':', $reqItem);
            $reqEntity = $reqParts[0];
            $reqEntityName = $reqParts[1];
            $reqAmount = (int) $reqParts[2];

            $found = false;
            foreach ($value as $valItem) {
                $valParts = explode(':', $valItem);
                $valEntity = $valParts[0];
                $valEntityName = $valParts[1];
                $valAmount = (int) $valParts[2];

                if ($reqEntity === $valEntity && $reqEntityName === $valEntityName && $valAmount >= $reqAmount) {
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