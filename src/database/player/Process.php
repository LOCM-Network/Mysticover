<?php

declare(strict_types=1);

namespace phuongaz\locm\mysticover\database\player;

use phuongaz\locm\mysticover\quests\Type;

class Process {

    /** @var string $questRaw "questName:step:{value}" */
    private string $questRaw;

    private string $questName;
    private int $step;

    /**
     * @var array $process
     * [
     * "type" => "type",
     * "value" => []
     * ]
     */
    private array $process;

    public function __construct(string $questRaw) {
        $this->questRaw = $questRaw;
        $this->parse();
    }

    public function parse() :void {
        $data = explode(":", $this->questRaw);
        $this->questName = $data[0];
        $this->step = (int) $data[1];
        $this->process = json_decode($data[2], true);
    }

    public function setStep(int $step) :void {
        $this->step = $step;
    }

    public function getQuestName(): string {
        return $this->questName;
    }

    public function getStep(): int {
        return $this->step;
    }

    public function getQuestRaw(): string {
        return $this->questRaw;
    }

    public function getProcess(): array {
        return $this->process;
    }

    public function getProcessType(): Type {
        return Type::parse($this->process["type"]);
    }

    public function getProcessValue(): array {
        return $this->process["value"];
    }

    public function toRaw(): string {
        return $this->getQuestName() . ":" . $this->getStep() . ":" . json_encode($this->getProcess());
    }

    public static function fromRaw(string $raw): Process {
        return new Process($raw);
    }

}