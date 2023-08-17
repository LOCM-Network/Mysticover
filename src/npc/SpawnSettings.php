<?php

declare(strict_types=1);

namespace phuongaz\locm\mysticover\npc;

use pocketmine\entity\Location;
use pocketmine\math\Vector3;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\nbt\tag\DoubleTag;
use pocketmine\nbt\tag\FloatTag;
use pocketmine\nbt\tag\ListTag;
use pocketmine\Server;

final class SpawnSettings {

    private string $worldName;
    private float $x;
    private float $y;
    private float $z;
    private float $yaw = 0;
    private float $pitch = 0;

    private string $spawnTime;

    private string $lifeTime;

    public function __construct(string $worldName, float $x, float $y, float $z, float $yaw, float $pitch, string $spawnTime, string $lifeTime) {
        $this->worldName = $worldName;
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
        $this->yaw = $yaw;
        $this->pitch = $pitch;
        $this->spawnTime = $spawnTime;
        $this->lifeTime = $lifeTime;
    }

    public function getWorldName(): string {
        return $this->worldName;
    }

    public function getX(): float {
        return $this->x;
    }

    public function getY(): float {
        return $this->y;
    }

    public function getZ(): float {
        return $this->z;
    }

    public function getYaw(): float {
        return $this->yaw;
    }

    public function getPitch(): float {
        return $this->pitch;
    }

    public function getSpawnTime(): string {
        return $this->spawnTime;
    }

    public function getLifeTime(): string {
        return $this->lifeTime;
    }

    public function getLocation() :Location {
        $world = Server::getInstance()->getWorldManager()->getWorldByName($this->worldName);
        return new Location($this->x, $this->y, $this->z, $world, $this->yaw, $this->pitch);
    }

    public function getNBT(Vector3 $position, ?Vector3 $motion = null, float $yaw = 0.0, float $pitch = 0.0): CompoundTag{
        return CompoundTag::create()
            ->setTag("Pos", new ListTag([
                new DoubleTag($position->x),
                new DoubleTag($position->y),
                new DoubleTag($position->z)
            ]))
            ->setTag("Motion", new ListTag([
                new DoubleTag($motion !== null ? $motion->x : 0),
                new DoubleTag($motion !== null ? $motion->y : 0),
                new DoubleTag($motion !== null ? $motion->z : 0)
            ]))
            ->setTag("Rotation", new ListTag([
                new FloatTag($yaw),
                new FloatTag($pitch)
            ]));
    }

}