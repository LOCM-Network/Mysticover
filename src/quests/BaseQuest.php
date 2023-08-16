<?php

declare(strict_types=1);

namespace phuongaz\locm\mysticover\quests;

abstract class BaseQuest {

    private string $title;
    private string $description;
    private array $targets;
    private array $rewards;

    private string $go;

    public function __construct(
        string $title,
        string $description,
        array $targets,
        array $rewards,
        string $go
    ) {
        $this->title = $title;
        $this->description = $description;
        $this->targets = $targets;
        $this->rewards = $rewards;
        $this->go = $go;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getTargets(): array {
        return $this->targets;
    }

    public function getRewards(): array {
        return $this->rewards;
    }

    public function getGo(): string {
        return $this->go;
    }
}