<?php

declare(strict_types=1);

namespace phuongaz\locm\mysticover\timelines\scen;

final class Scenario {

    private Scens $scen;

    private array $requirements;

    public function __construct(Scens $scen, array $requirements = []) {
        $this->scen = $scen;
        $this->requirements = $requirements;
    }

    public function getScen(): Scens {
        return $this->scen;
    }

    public function getRequirements(): array {
        return $this->requirements;
    }
}