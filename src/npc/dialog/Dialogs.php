<?php

declare(strict_types=1);

namespace phuongaz\locm\mysticover\npc\dialog;

use cosmicpe\npcdialogue\dialogue\NpcDialogue;
use cosmicpe\npcdialogue\NpcDialogueBuilder;
use phuongaz\locm\mysticover\listeners\event\dialogs\DialogButtonEvent;
use phuongaz\locm\mysticover\npc\HumanNPC;
use pocketmine\player\Player;

class Dialogs {

    private Status $status;
    private string $firstText = "";
    private array $buttons = [];

    private HumanNPC $npc;

    public function __construct(Status $status, string $firstText, array $buttons, HumanNPC $npc) {
        $this->status = $status;
        $this->firstText = $firstText;
        $this->buttons = $buttons;
        $this->npc = $npc;
    }

    public function getStatus(): Status {
        return $this->status;
    }

    public function getFirstText(): string {
        return $this->firstText;
    }

    public function getButtons(): array {
        return $this->buttons;
    }

    public function getButton(int $index): Button {
        return $this->buttons[$index];
    }

    public function getNPC(): HumanNPC {
        return $this->npc;
    }

    public function createDialog(string $text, array $buttons): NpcDialogue {
        $dialogue = NpcDialogueBuilder::create();
        $dialogue->setName($this->npc->getName());
        $dialogue->setText($text);
        foreach ($buttons as $button) {
            $dialogue->addSimpleButton($button->getText(), function(Player $player) use ($button, $text) {
               $event = new DialogButtonEvent($this->npc, $player, $button);
               $event->setCallback(function(DialogButtonEvent $event) {
                  $button = $event->getButton();
                  if($button->hasStories()) {
                      $this->createStoriesFromButton($button, $button->getFirstStoryMessage(), $button->getText());
                  } else {
                      $button->handle($event->getPlayer());
                  }
               });
               $event->call();
            });
        }
        return $dialogue->build();
    }

    public function createStoriesFromButton(Button $button, string $currentStory, string $buttonText): NpcDialogue {
        $dialogue = NpcDialogueBuilder::create();
        $dialogue->setName($this->npc->getName());
        $dialogue->setText($currentStory);
        $storiesCloser = function (Player $player) use ($currentStory, $button) {
            if(!$button->isLastStoryMessage($currentStory)) {
                $nextStory = $button->getNextStoryMessage($currentStory);
                if($nextStory !== null) {
                    $nextButton = $button->getNextButton();
                    if ($button->getNextStoryMessage($nextStory) == null) {
                        $nextButton = $button->getDoneButton();
                    }
                    $this->createStoriesFromButton($button, $nextStory, $nextButton);
                }
            } else {
                $event = new DialogButtonEvent($this->npc, $player, $button, DialogButtonEvent::DIALOG_STORIES_END);
                $event->setCallback(function (DialogButtonEvent $event) {
                    $button = $event->getButton();
                    $button->handle($event->getPlayer());
                });
                $event->call();
            }
        };
        $dialogue->addSimpleButton($buttonText, $storiesCloser);
        $dialogue->setCloseListener($storiesCloser);
        return $dialogue->build();
    }

}

