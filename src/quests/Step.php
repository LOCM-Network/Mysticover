<?php

declare(strict_types=1);

namespace phuongaz\locm\mysticover\quests;

use phuongaz\locm\mysticover\quests\targets\Target;

class Step {

    /** @var Target[]  */
    private array $targets;
    private array $rewards = [];
    private Type $type;

    private string $missingMessage;
    private string $completedMessage;

    public function __construct(Type $type, array $targets, array $rewards, string $missingMessage, string $completedMessage) {
        $this->type = $type;
        $this->targets = $targets;
        $this->rewards = $rewards;
        $this->missingMessage = $missingMessage;
        $this->completedMessage = $completedMessage;
    }

    public function getTargets(): array {
        return $this->targets;
    }

    public function getRewards(): array {
        return $this->rewards;
    }

    public function getType(): Type {
        return $this->type;
    }

    public function getMissingMessage(): string {
        return $this->missingMessage;
    }

    public function getCompletedMessage(): string {
        return $this->completedMessage;
    }

    public function compareRequirements(array $value): bool {
        $requirements = $this->getTargets();
        $mustBeCompleted = count($requirements);
        foreach($requirements as $requirement) {
            if($this->getType()->compare($requirement, $value)) {
                $mustBeCompleted--;
            }
        }
        return $mustBeCompleted === 0;
    }

}