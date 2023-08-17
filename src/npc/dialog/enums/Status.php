<?php

declare(strict_types=1);

namespace phuongaz\locm\mysticover\npc\dialog;

enum Status {
    case START;
    CASE IN_PROGRESS;
    CASE COMPLETED;
}