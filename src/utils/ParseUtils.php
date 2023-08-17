<?php

declare(strict_types=1);

namespace phuongaz\locm\mysticover\utils;

use phuongaz\locm\mysticover\MystiCover;
use phuongaz\locm\mysticover\quests\BaseQuest;
use phuongaz\locm\mysticover\quests\Step;
use phuongaz\locm\mysticover\quests\Type;
use phuongaz\locm\mysticover\timelines\scen\Scenario;
use phuongaz\locm\mysticover\timelines\scen\Scens;
use pocketmine\utils\Config;

class ParseUtils {

    public static function parseScenarios(array $senarios): array {
        $result = [];
        foreach ($senarios as $key => $value) {
            $result[] = new Scenario(Scens::parse($key), $value["requirements"]);
        }
        return $result;
    }

    /**
     * Example:
     * "MAIN:quest_1"
     * return main quest with file name "quest_1"
     * "SUB:sub_1"
     * return sub quest with file name "sub_1"
     *
     * @param string $value
     *
     * @return BaseQuest|null
     */
    public static function parseGoToQuest(string $value): ?BaseQuest {
        $globalEnum = GlobalEnum::GO;
        [$arcName, $questType, $questName] = $globalEnum->parseEnum($value);

        $separator = DIRECTORY_SEPARATOR;
        $path = MystiCover::getInstance()->getDataFolder() . "arcs" . $separator . $arcName . $separator;
        $file = $questType . $separator . $questName .".yml";

        return self::parseFileToQuest($path, $file);
    }

    public static function parseFileToQuest(string $path, string $file): ?BaseQuest {
        $config = new Config($file, Config::YAML);

        $title = $config->get("title");
        $description = $config->get("description");
        $rewards = $config->get("rewards");
        $targets = $config->get("targets");
        $go = $config->get("go");
        $steps = self::parseTargetToSteps($targets);

        return new BaseQuest($title, $description, $rewards, $steps, $go);
    }


    public static function parseTargetToSteps(array $targets) :array {
        $result = [];
        foreach ($targets as $key => $value) {
            $type = Type::parse($key);
            $reward = $value["rewards"] ?? [];
            $missingMessage = $value["missing_message"] ?? "";
            $completedMessage = $value["completed_message"] ?? "";
            $result[] = new Step($type, $value["targets"], $reward, $missingMessage, $completedMessage);
        }
        return $result;
    }

}