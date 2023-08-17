<?php

declare(strict_types=1);

namespace phuongaz\locm\mysticover\quests\targets;

class EnchantItem extends Target {

    /**
     * @param array $requirement
     * ["itemName:EnchantmentName:level", "itemName:EnchantmentName:level"]
     * @param array $value
     * ["itemName:EnchantmentName:level", "itemName:EnchantmentName:level"]
     * @return bool
     */
    public static function compare(array $requirement, array $value): bool {
        foreach ($requirement as $reqItem) {
            $reqParts = explode(':', $reqItem);
            $reqItemName = $reqParts[0];
            $reqEnchantmentName = $reqParts[1];
            $reqLevel = (int) $reqParts[2];

            $found = false;
            foreach ($value as $valItem) {
                $valParts = explode(':', $valItem);
                $valItemName = $valParts[0];
                $valEnchantmentName = $valParts[1];
                $valLevel = (int) $valParts[2];

                if ($reqItemName === $valItemName && $reqEnchantmentName === $valEnchantmentName && $valLevel >= $reqLevel) {
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