<?php

declare(strict_types=1);

namespace phuongaz\locm\mysticover\quests\targets;

class CraftItem extends Target {

    /**
     * @param array $requirement
     * ["itemName:amount", "itemName:amount"]
     * @param array $value
     * ["itemName:amount", "itemName:amount"]
     * @return bool
     */
    public static function compare(array $requirement, array $value): bool {
        foreach ($requirement as $reqItem) {
            [$reqItemName, $reqAmount] = explode(':', $reqItem);
            $found = false;

            foreach ($value as $valItem) {
                [$valItemName, $valAmount] = explode(':', $valItem);

                if ($reqItemName === $valItemName && (int)$valAmount >= (int)$reqAmount) {
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