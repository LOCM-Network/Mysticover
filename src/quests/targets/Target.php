<?php

declare(strict_types=1);

namespace phuongaz\locm\mysticover\quests\targets;

abstract class Target {

    abstract public static function compare(array $requirement, array $value) :bool;
}