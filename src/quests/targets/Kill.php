<?php

declare(strict_types=1);

namespace phuongaz\locm\mysticover\quests\targets;

class Kill extends Target {

    public static function compare(array $requirement, array $value): bool {
        foreach ($requirement as $requirementItem) {
            [$requiredEntity, $requiredAmount] = explode(':', $requirementItem);

            if (!array_key_exists($requiredEntity, $value)) {
                return false;
            }

            $actualAmount = $value[$requiredEntity];

            if ($actualAmount < $requiredAmount) {
                return false;
            }
        }

        return true;
    }

}