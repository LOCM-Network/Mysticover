<?php

declare(strict_types=1);

namespace phuongaz\locm\mysticover\quests\targets;
class MilkCow extends Target {

    /**
     * @param array $requirement
     * ["amount" => 1]
     *
     * @param array $value
     * ["amount" => 1]
    */
    public static function compare(array $requirement, array $value) :bool {
        $amount = $requirement["amount"] ?? null;

        if($amount === null) {
            return false;
        }

        return $value["amount"] >= $amount;
    }
}