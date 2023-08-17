<?php

declare(strict_types=1);

namespace phuongaz\locm\mysticover\listeners\event\dialogs;

use ColinHDev\libAsyncEvent\AsyncEvent;
use ColinHDev\libAsyncEvent\ConsecutiveEventHandlerExecutionTrait;
use phuongaz\locm\mysticover\npc\dialog\Button;
use phuongaz\locm\mysticover\npc\HumanNPC;
use pocketmine\event\Cancellable;
use pocketmine\event\CancellableTrait;
use pocketmine\event\Event;
use pocketmine\player\Player;

class DialogButtonEvent extends Event implements AsyncEvent, Cancellable {
    use CancellableTrait, ConsecutiveEventHandlerExecutionTrait;

    public const DIALOG_BUTTON_PRESSED = "dialog.button.pressed";
    public const DIALOG_STORIES_END = "dialog.stories.end";

    private HumanNPC $npc;
    private Player $player;

    private Button $button;

    private string $eventType;

    public function __construct(HumanNPC $npc, Player $player, Button $button, string $eventType = self::DIALOG_BUTTON_PRESSED) {
        $this->npc = $npc;
        $this->player = $player;
        $this->button = $button;
        $this->eventType = $eventType;
    }

    public function getNPC(): HumanNPC {
        return $this->npc;
    }

    public function getPlayer(): Player {
        return $this->player;
    }

    public function getButton(): Button {
        return $this->button;
    }

    public function getEventType(): string {
        return $this->eventType;
    }


}