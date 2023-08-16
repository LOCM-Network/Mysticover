<?php

declare(strict_types=1);

namespace phuongaz\locm\mysticover\timelines;

use SplObjectStorage;

class TimelineCache {

    private SplObjectStorage $storyLines;

    public function __construct() {
        $this->storyLines = new SplObjectStorage();
    }

    public function addStoryLine(StoryLine $storyLine): void {
        $this->storyLines->attach($storyLine);
    }

    public function getStoryLines(): SplObjectStorage {
        return $this->storyLines;
    }

    public function getStoryLine(string $name): ?StoryLine {
        foreach($this->storyLines as $storyLine) {
            if($storyLine->getName() === $name) {
                return $storyLine;
            }
        }
        return null;
    }

    public function getStoryLineByArc(string $arc): ?StoryLine {
        foreach($this->storyLines as $storyLine) {
            if($storyLine->getArc() === $arc) {
                return $storyLine;
            }
        }
        return null;
    }

    public function getStoryLineByQuest(string $quest): ?StoryLine {
        foreach($this->storyLines as $storyLine) {
            if($storyLine->getQuestsLength() > 0) {
                foreach($storyLine->getQuests() as $quest) {
                    if($quest->getName() === $quest) {
                        return $storyLine;
                    }
                }
            }
        }
        return null;
    }
}