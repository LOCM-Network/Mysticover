<?php

declare(strict_types=1);

namespace phuongaz\locm\mysticover\timelines;

class StoryLine {

    public function __construct(
       private readonly string $name,
       private readonly string $description,
       private readonly string $arc,
       private readonly int    $quests_length,
       private readonly array  $onStart,
       private readonly array  $onEnd
    ) {}

    public function getName(): string {
        return $this->name;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getArc(): string {
        return $this->arc;
    }

    public function getQuestsLength(): int {
        return $this->quests_length;
    }

    public function getOnStart(): array {
        return $this->onStart;
    }

    public function getOnEnd(): array {
        return $this->onEnd;
    }

}