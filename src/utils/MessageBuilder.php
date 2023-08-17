<?php

declare(strict_types=1);

namespace phuongaz\locm\mysticover\utils;

use phuongaz\locm\mysticover\MystiCover;
use phuongaz\openclan\util\MessageContruct;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;

class MessageBuilder {


    private string $format;

    private string $tag;
    private array $params;

    private array $lines = [];

    public function __construct(string $tag, array $params = []) {
        $this->format = MystiCover::getInstance()->getSettings()->getMessageFormat();
        $this->tag = $tag;
        $this->params = $params;
        $this->lines[] = $this;
    }

    public function getTag(): string {
        return $this->tag;
    }

    public function getParams(): array {
        return $this->params;
    }

    public function parse() :string {
        $language = MystiCover::getInstance()->getLanguage();
        $tag = $this->tag;
        $format = $this->format;
        $params = $this->params;
        return str_replace("{message}", $language->parse($tag, $params), $format);
    }

    public function addLine(string $tag, array $params = []) :self {
        $this->lines[] = new MessageContruct($tag, $params);
        return $this;
    }

    public function sendTo(Player|CommandSender $target) :void {
        foreach ($this->lines as $line) {
            $target->sendMessage($line->parse());
        }
    }

    public static function new(string $tag, array $params = []) :MessageContruct {
        return new MessageContruct($tag, $params);
    }

}