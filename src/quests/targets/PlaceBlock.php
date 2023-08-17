<?php

declare(strict_types=1);

namespace phuongaz\locm\mysticover\quests\targets;

class PlaceBlock extends Target {

    /**
     * @param array $requirement
     * ["block_name:amount", "block_name:amount"]
     * @param array $value
     * ["block_name:amount", "block_name:amount"]
     * @return bool
     */
    public static function compare(array $requirement, array $value): bool {
        foreach ($requirement as $reqItem) {
            [$reqBlockName, $reqAmount] = explode(':', $reqItem);
            $found = false;

            foreach ($value as $valItem) {
                [$valBlockName, $valAmount] = explode(':', $valItem);

                if ($reqBlockName === $valBlockName && (int)$valAmount >= (int)$reqAmount) {
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