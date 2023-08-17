<?php

declare(strict_types=1);

namespace phuongaz\locm\mysticover\npc;

use pocketmine\entity\Human;

class HumanNPC extends Human {

    private NPCType $type;

    private SpawnSettings $spawnSettings;

    public function __construct(NPCType $type, SpawnSettings $spawnSettings) {
        parent::__construct(
            $spawnSettings->getLocation(),
            $type->getSkin(),
            $spawnSettings->getNBT($spawnSettings->getLocation()->asVector3()));
        $this->type = $type;
        $this->spawnSettings = $spawnSettings;
    }

    public function getNPCType(): NPCType {
        return $this->type;
    }

    public function getSpawnSettings(): SpawnSettings {
        return $this->spawnSettings;
    }
}