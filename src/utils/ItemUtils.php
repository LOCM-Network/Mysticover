<?php

declare(strict_types=1);

namespace phuongaz\locm\mysticover\utils;

use pocketmine\item\enchantment\EnchantmentInstance;
use pocketmine\item\enchantment\StringToEnchantmentParser;
use pocketmine\item\Item;
use pocketmine\item\StringToItemParser;
use pocketmine\item\WritableBook;
use pocketmine\utils\TextFormat;

class ItemUtils {
    public static function fromArray(array $item) :?Item {
        $itemExplode = explode(":", $item['item']);
        if(is_numeric($itemExplode[0])) {
            $itemObject = StringToItemParser::getInstance()->parse($itemExplode[0]);
        }else {
            $itemObject = StringToItemParser::getInstance()->parse($itemExplode[0]);
            if($itemObject != null) {
                $itemObject = $itemObject->setCount($itemExplode[1] ?? 1);
            }
        }
        if(isset($item['name'])) {
            $itemObject->setCustomName(TextFormat::colorize($item['name'] ?? $itemObject->getVanillaName()));
        }
        if(isset($item['lore'])) {
            $itemObject->setLore(array_map(function($lore){
                return TextFormat::colorize($lore);
            }, $item['lore']));
        }
        if(isset($item['enchantments'])) {
            foreach($item['enchantments'] as $enchantmentString) {
                $enchantExplode = explode(":", $enchantmentString);
                $enchantId = $enchantExplode[0];
                $enchantLevel = (int) $enchantExplode[1];
                $itemObject = self::enchant($itemObject, $enchantId, $enchantLevel);
            }
        }
        if(isset($item['nbt'])) {
            $itemObject->setNamedTag($item['nbt']);
        }

        return $itemObject instanceof Item ? $itemObject : null;
    }

    public static function parseItemFromJson(string $json) :Item {
        $data = json_decode($json, true);
        return self::fromArray($data);
    }

    public static function ItemsFromArray(array $items) :array {
        $itemObjects = [];
        foreach($items as $item){
            $itemObjects[] = self::fromArray($item);
        }
        return $itemObjects;
    }

    public static function serializeItem(Item $item) :string {
        $data = [
            'item' => StringToItemParser::getInstance()->lookupAliases($item)[0] . ":" . $item->getCount(),
            'name' => $item->getCustomName(),
            'lore' => $item->getLore(),
            'enchantments' => [],
            'nbt' => $item->getNamedTag()
        ];
        foreach($item->getEnchantments() as $enchantment){
            $data['enchantments'][] = $enchantment->getType()->getName() . ":" . $enchantment->getLevel();
        }
        return json_encode($data);
    }

    public static function serializeItems(array $items) :string {
        $data = [];
        foreach($items as $item){
            $data[] = self::serializeItem($item);
        }
        return json_encode($data);
    }

    public static function unserializeItems(string $json) :array {
        $data = json_decode($json, true);
        $items = [];
        foreach($data as $item){
            $items[] = self::parseItemFromJson($item);
        }
        return $items;
    }

    public static function random(array $items) :Item {
        return self::fromArray($items[array_rand($items)]);
    }

    public static function enchant(Item $item, string $enchantId, int $level = 1) :Item {
        $enchantment = StringToEnchantmentParser::getInstance()->parse($enchantId);
        $enchantInstance = new EnchantmentInstance($enchantment, $level);
        $item->addEnchantment($enchantInstance);
        return $item;
    }

    public static function exportBook(Item $item) :Item {
        if($item instanceof WritableBook) {
            $text = json_encode($item);
            foreach(mb_str_split($text, 200) as $k => $v){
                $item->setPageText($k, $v);
            }
        }
        return $item;
    }
}