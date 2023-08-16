<?php

declare(strict_types=1);

namespace phuongaz\locm\mysticover\timelines;

use phuongaz\locm\mysticover\timelines\scen\Scenario;

class TimeLine {

    /**
     * @var Scenario[]
     */
    private array $scenarios;

    public function __construct(array $scenario) {
        $this->scenarios = $scenario;
    }

    public function getScenarios(): array {
        return $this->scenarios;
    }

}