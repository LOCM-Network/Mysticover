<?php

declare(strict_types=1);

namespace phuongaz\locm\mysticover\quests\targets;

class Travel extends Target {

    /**
     * @param array $requirement
     * ["world" => "world", "x" => 0, "y" => 0, "z" => 0, "distance" => 0]
     * @param array $value
     * ["world" => "world", "x" => 0, "y" => 0, "z" => 0]
     * @return bool
     */
    public static function compare(array $requirement, array $value): bool {
        $requiredWorld = $requirement["world"] ?? null;
        $requiredX = $requirement["x"] ?? null;
        $requiredY = $requirement["y"] ?? null;
        $requiredZ = $requirement["z"] ?? null;
        $requiredDistance = $requirement["distance"] ?? null;

        $actualWorld = $value["world"] ?? null;
        $actualX = $value["x"] ?? null;
        $actualY = $value["y"] ?? null;
        $actualZ = $value["z"] ?? null;

        if (
            $requiredWorld !== $actualWorld ||
            $requiredX !== $actualX ||
            $requiredY !== $actualY ||
            $requiredZ !== $actualZ
        ) {
            return false;
        }

        if ($requiredDistance !== null) {
            $calculatedDistance = sqrt(
                ($requiredX - $actualX) ** 2 +
                ($requiredY - $actualY) ** 2 +
                ($requiredZ - $actualZ) ** 2
            );

            if ($calculatedDistance > $requiredDistance) {
                return false;
            }
        }

        return true;
    }

}