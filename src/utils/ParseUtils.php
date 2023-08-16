<?php

declare(strict_types=1);

namespace phuongaz\locm\mysticover\utils;

use phuongaz\locm\mysticover\timelines\scen\Scenario;
use phuongaz\locm\mysticover\timelines\scen\Scens;

class ParseUtils {

    public static function parseScenarios(array $senarios): array {
        $result = [];
        foreach ($senarios as $key => $value) {
            $result[] = new Scenario(Scens::parse($key), $value["requirements"]);
        }
        return $result;
    }
}