<?php

declare(strict_types=1);

namespace phuongaz\locm\mysticover\database;

use Generator;
use phuongaz\locm\mysticover\database\player\Process;
use pocketmine\player\Player;
use poggit\libasynql\DataConnector;
use SOFe\AwaitGenerator\Await;

class PlayerDatabase {

    public function __construct(
        private readonly DataConnector $connector,
        private readonly Session $playerSession
    ){}

    public function getPlayerSession(): Session {
        return $this->playerSession;
    }

    public function getConnector(): DataConnector {
        return $this->connector;
    }

    public function init() :void {
        Await::f2c(function () {
            yield from $this->asyncGeneric(DBEnums::PLAYER_INIT->toString());
        });
    }

    public function session(Player $player, ?callable $callable = null): void{
        Await::f2c(function () use ($player, $callable) {
            $rows = yield from $this->asyncSelect(DBEnums::PLAYER_SELECT->toString(), [
                "name" => $player->getName()
            ]);
            if(!empty($rows)){
                $process = Process::fromRaw($rows[0]);
                $this->playerSession->addPlayer($player, $process);
                if ($callable !== null) $callable($player, $process);
            } else {
                $this->insert($player, $callable);
            }
        });
    }

    public function insert(Player $player, ?callable $callable = null): void{
        Await::f2c(function () use ($player, $callable) {
            $process = new Process($player->getName());
            yield from $this->asyncInsert(DBEnums::PLAYER_INSERT->toString(), [
                "player_name" => $player->getName(),
                "process_raw" => $process->toRaw()
            ]);
            $this->playerSession->addPlayer($player, $process);
            if ($callable !== null) $callable($player, $process);
        });
    }

    public function update(Player $player, ?callable $callable = null): void{
        Await::f2c(function () use ($player, $callable) {
            $process = $this->playerSession->getPlayerSession($player);
            yield from $this->asyncChange(DBEnums::PLAYER_UPDATE->toString(), [
                "player_name" => $player->getName(),
                "process_raw" => $process->toRaw()
            ]);
            if ($callable !== null) $callable($player, $process);
        });
    }

    public function asyncGeneric(string $query, array $args = []): Generator{
        $this->connector->executeGeneric($query, $args, yield, yield Await::REJECT);
        return yield Await::ONCE;
    }

    public function asyncChange(string $query, array $args = []): Generator{
        $this->connector->executeChange($query, $args, yield, yield Await::REJECT);
        return yield Await::ONCE;
    }

    public function asyncInsert(string $query, array $args = []): Generator{
        $this->connector->executeInsert($query, $args, yield, yield Await::REJECT);
        return yield Await::ONCE;
    }

    public function asyncSelect(string $query, array $args = []): Generator{
        $this->connector->executeSelect($query, $args, yield, yield Await::REJECT);
        return yield Await::ONCE;
    }
}