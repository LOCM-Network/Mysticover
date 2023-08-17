<?php

declare(strict_types=1);

namespace phuongaz\locm\mysticover\npc\dialog;

use phuongaz\locm\mysticover\npc\dialog\enums\ButtonHandles;
use phuongaz\locm\mysticover\utils\GlobalEnum;
use phuongaz\locm\mysticover\utils\ItemUtils;
use phuongaz\locm\mysticover\utils\MessageBuilder;
use pocketmine\player\Player;

final class Button {

    private string $text;
    private array $stories = [];

    private array $handle = [];
    private GlobalEnum $go;

    private string $nextButton = "";
    private string $doneButton = "";


    public function __construct(string $text, array $handle, GlobalEnum $go, array $stories = []) {
        $this->text = $text;
        $this->stories = $stories;
        $this->handle = $handle;
        $this->go = $go;
        $this->nextButton = MessageBuilder::build("button-next");
        $this->doneButton = MessageBuilder::build("button-done");
    }

    public function getText(): string {
        return $this->text;
    }

    public function getStories(): array {
        return $this->stories;
    }

    public function getHandle(): array {
        return $this->handle;
    }

    public function getGo(): GlobalEnum {
        return $this->go;
    }

    public function getNextButton(): string {
        return $this->nextButton;
    }

    public function getDoneButton(): string {
        return $this->doneButton;
    }

    public function hasStories() :bool {
        return count($this->stories) > 0;
    }

    public function getFirstStoryMessage() :?string {
        return $this->stories[0];
    }

    public function isLastStoryMessage(string $message) :bool {
        return $this->stories[count($this->stories) - 1] === $message;
    }

    public function getNextStoryMessage(string $message) :?string {
        $index = array_search($message, $this->stories);
        if(isset($this->stories[$index + 1])) {
            return $this->stories[$index + 1];
        }
        return null;
    }

    public function handle(Player $player) :void {
        $handles = $this->getHandle();
        foreach ($handles as $handle => $value) {
            $type = ButtonHandles::parseKey($handle);
            match ($type) {
                ButtonHandles::GIVE => $this->handleGive($player, $value),
                ButtonHandles::TAKE => $this->handleTake($player, $value),
                ButtonHandles::NOTICE => $this->handleNotice($player, $value),
                default => null,
            };
        }

    }

    private function handleGive(Player $player, array $value) :void {
       $typeGive = array_keys($value);
        foreach ($typeGive as $type) {
            $type = ButtonHandles::parseKey($type);
            match ($type) {
                ButtonHandles::GIVE_ITEM => $this->handleGiveItem($player, $value[$type]),
                default => null,
            };
        }
    }

    public function handleGiveItem(Player $player, array $items) :void {
        foreach ($items as $item) {
            $player->getInventory()->addItem(ItemUtils::fromArray($item));
        }
    }

    public function handleTake(Player $player, array $value) :void {
        $typeTake = array_keys($value);
        foreach ($typeTake as $type) {
            $type = ButtonHandles::parseKey($type);
            match ($type) {
                ButtonHandles::GIVE_ITEM => $this->handleTakeItem($player, $value[$type]),
                default => null,
            };
        }
    }

    public function handleTakeItem(Player $player, array $items) :void {
        foreach ($items as $item) {
            $item = ItemUtils::fromArray($item);
            if($player->getInventory()->contains($item)) {
                $player->getInventory()->removeItem($item);
            }
        }
    }

    public function handleNotice(Player $player, array $value) :void {
        $notices = implode("\n", $value);
        $player->sendToastNotification(
            MessageBuilder::build("title-notice"),
            MessageBuilder::build($notices, ["player" => $player->getName()]
            ));
    }

}