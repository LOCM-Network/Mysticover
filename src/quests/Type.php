<?php

declare(strict_types=1);

namespace phuongaz\locm\mysticover\quests;

use phuongaz\locm\mysticover\quests\targets\BreakBlock;
use phuongaz\locm\mysticover\quests\targets\BrewPotion;
use phuongaz\locm\mysticover\quests\targets\CraftItem;
use phuongaz\locm\mysticover\quests\targets\DrinkPotion;
use phuongaz\locm\mysticover\quests\targets\EatFood;
use phuongaz\locm\mysticover\quests\targets\EnchantItem;
use phuongaz\locm\mysticover\quests\targets\Find;
use phuongaz\locm\mysticover\quests\targets\Fish;
use phuongaz\locm\mysticover\quests\targets\Give;
use phuongaz\locm\mysticover\quests\targets\Kill;
use phuongaz\locm\mysticover\quests\targets\MilkCow;
use phuongaz\locm\mysticover\quests\targets\PlaceBlock;
use phuongaz\locm\mysticover\quests\targets\ShearSheep;
use phuongaz\locm\mysticover\quests\targets\SmeltItem;
use phuongaz\locm\mysticover\quests\targets\Talk;
use phuongaz\locm\mysticover\quests\targets\TameAnimal;
use phuongaz\locm\mysticover\quests\targets\Travel;

enum Type {

    case KILL;
    case BREAK;
    case PLACE;
    case CRAFT;
    case SMELT;
    case BREW;
    case FISH;
    case ENCHANT;
    case TAME;
    case SHEAR;
    case MILK;
    case EAT;
    case DRINK;
    case TRAVEL;
    case FIND;
    case GIVE;
    case TALK;

    public function toString() :string {
        return match ($this) {
            self::KILL => "KILL",
            self::BREAK => "BREAK",
            self::PLACE => "PLACE",
            self::CRAFT => "CRAFT",
            self::SMELT => "SMELT",
            self::BREW => "BREW",
            self::FISH => "FISH",
            self::ENCHANT => "ENCHANT",
            self::TAME => "TAME",
            self::SHEAR => "SHEAR",
            self::MILK => "MILK",
            self::EAT => "EAT",
            self::DRINK => "DRINK",
            self::TRAVEL => "TRAVEL",
            self::FIND => "FIND",
            self::GIVE => "GIVE",
            self::TALK => "TALK",
        };
    }

    public static function parse(string $type): Type {
        return match ($type) {
            "KILL" => self::KILL,
            "BREAK" => self::BREAK,
            "PLACE" => self::PLACE,
            "CRAFT" => self::CRAFT,
            "SMELT" => self::SMELT,
            "BREW" => self::BREW,
            "FISH" => self::FISH,
            "ENCHANT" => self::ENCHANT,
            "TAME" => self::TAME,
            "SHEAR" => self::SHEAR,
            "MILK" => self::MILK,
            "EAT" => self::EAT,
            "DRINK" => self::DRINK,
            "TRAVEL" => self::TRAVEL,
            "FIND" => self::FIND,
            "GIVE" => self::GIVE,
            "TALK" => self::TALK,
            default => throw new \InvalidArgumentException("Invalid quest type: $type"),
        };
    }

    public static function make(Type $type, string $name, string $description, array $targets, array $rewards, string $go) :BaseQuest {
        return match ($type) {
            self::KILL => new Kill($name, $description, $targets, $rewards, $go),
            self::BREW => new BrewPotion($name, $description, $targets, $rewards, $go),
            self::BREAK => new BreakBlock($name, $description, $targets, $rewards, $go),
            self::PLACE => new PlaceBlock($name, $description, $targets, $rewards, $go),
            self::CRAFT => new CraftItem($name, $description, $targets, $rewards, $go),
            self::SMELT => new SmeltItem($name, $description, $targets, $rewards, $go),
            self::FISH => new Fish($name, $description, $targets, $rewards, $go),
            self::ENCHANT => new EnchantItem($name, $description, $targets, $rewards, $go),
            self::GIVE => new Give($name, $description, $targets, $rewards, $go),
            self::EAT => new EatFood($name, $description, $targets, $rewards, $go),
            self::DRINK => new DrinkPotion($name, $description, $targets, $rewards, $go),
            self::FIND => new Find($name, $description, $targets, $rewards, $go),
            self::TALK => new Talk($name, $description, $targets, $rewards, $go),
            self::TRAVEL => new Travel($name, $description, $targets, $rewards, $go),
            self::TAME => new TameAnimal($name, $description, $targets, $rewards, $go),
            self::MILK => new MilkCow($name, $description, $targets, $rewards, $go),
            self::SHEAR => new ShearSheep($name, $description, $targets, $rewards, $go),
            default => throw new \InvalidArgumentException("Invalid quest type: ". $type->toString())
        };
    }
}