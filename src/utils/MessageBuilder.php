<?php

declare(strict_types=1);

namespace phuongaz\locm\mysticover\utils;

class MessageBuilder {

    public static function build(string $message, array $replaces = []): string {
        foreach ($replaces as $key => $value) {
            $message = str_replace("{" . $key . "}", $value, $message);
        }
        return $message;
    }
}