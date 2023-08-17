<?php

declare(strict_types=1);

namespace phuongaz\locm\mysticover\npc;

use pocketmine\entity\Skin;

final class NPCType {

    private string $type;
    private Skin $skin;

    private string $name;

    public function __construct(string $name, string $type, Skin $skin) {
        $this->name = $name;
        $this->type = $type;
        $this->skin = $skin;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getSkin(): Skin {
        return $this->skin;
    }
}