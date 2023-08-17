<?php

declare(strict_types=1);

namespace phuongaz\locm\mysticover\utils;

class Language {

    private array|false $messages;

    private string $type;

    private string $path;

    public function __construct(string $type, string $path) {
        $this->type = $type;
        $this->path = $path;
        $this->load();
    }

    public function load(): void{
        $this->messages = parse_ini_file($this->path . $this->type . ".ini", true);
    }

    public function get(string $key): string{
        return $this->messages[$key] ?? "";
    }

    /**
     * @param string $key
     * @param array $args ["{key}" => "value"]
     *
     * @return string
     */
    public function parse(string $key, array $args = []): string{
        $message = $this->get($key);
        foreach($args as $key => $value){
            $message = str_replace("%" . $key . "%", (string)$value, $message);
        }
        return $message;
    }

    public function getType(): string{
        return $this->type;
    }

    public function getPath(): string{
        return $this->path;
    }

    public function changeType(string $type): Language{
        $this->type = $type;
        $this->load();
        return $this;
    }
}