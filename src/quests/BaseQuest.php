<?php

declare(strict_types=1);

namespace phuongaz\locm\mysticover\quests;

use phuongaz\locm\mysticover\utils\GlobalEnum;
use phuongaz\locm\mysticover\utils\ParseUtils;

class BaseQuest {

    private string $title;
    private string $description;
    private array $rewards;
    private array $steps;
    private string $go;

    public function __construct(
        string $title,
        string $description,
        array $rewards,
        array $steps,
        string $goValue
    ) {
        $this->title = $title;
        $this->description = $description;
        $this->rewards = $rewards;
        $this->steps = $steps;
        $this->go = $goValue;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getRewards(): array {
        return $this->rewards;
    }

    public function getGo(): string {
        return $this->go;
    }

    public function getSteps(): array {
        return $this->steps;
    }

    public function getStepsOfTarget(): int {
        return count($this->getSteps());
    }

    public function getStep(int $index) :array {
        return $this->getSteps()[$index];
    }

    public function isCompleted(int $step, array $value): bool {
        return $this->getSteps()[$step]->compareRequirements($value);
    }

    public function isLastStep(Step $step) :bool {
        return $this->getSteps()[$this->getStepsOfTarget() - 1] === $step;
    }

    public function isLastQuest() :bool {
        return GlobalEnum::parse($this->getGo())->isLastQuest();
    }

    public function getNextQuest() :?self {
        return ($this->isLastQuest()) ? null : ParseUtils::parseGoToQuest($this->getGo());
    }

}