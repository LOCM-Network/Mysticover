<?php

declare(strict_types=1);

namespace phuongaz\locm\mysticover\quests\targets;

class TameAnimal extends Target {

    /**
     * @param array $requirement
     * ["entityName:amount", "entityName:amount"]
     * @param array $value
     * ["entityName:amount", "entityName:amount"]
     * @return bool
     */
    public static function compare(array $requirement, array $value): bool {
        foreach ($requirement as $reqItem) {
            [$reqEntityName, $reqAmount] = explode(':', $reqItem);
            $found = false;

            foreach ($value as $valItem) {
                [$valEntityName, $valAmount] = explode(':', $valItem);

                if ($reqEntityName === $valEntityName && (int)$valAmount >= (int)$reqAmount) {
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