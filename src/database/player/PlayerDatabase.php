<?php

declare(strict_types=1);

namespace phuongaz\locm\mysticover\database;

use Generator;
use poggit\libasynql\DataConnector;
use SOFe\AwaitGenerator\Await;

class PlayerDatabase {

    public function __construct(
        private readonly DataConnector $connector
    ){}

    public function getConnector(): DataConnector {
        return $this->connector;
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