<?php

namespace Global_CRM\Case_FOOBAR;

use JetBrains\PhpStorm\NoReturn;

class ValueHandler implements ValueHandlerInterface
{
    use ValidationTrait;

    private array $argv;

    private array $result;

    public function __construct(array $argv)
    {
        $this->argv = $argv;
        $this->correctData();
    }

    public function generate(): array
    {
        $result = array_map(function ($element) {
            return match (true) {
                $element === 0 => $element,
                $element % 3 === 0 && $element % 5 === 0 => self::NAME[2],
                $element % 3 === 0 => self::NAME[0],
                $element % 5 === 0 => self::NAME[1],
                default => $element
            };
        }, range($this->argv[1], $this->argv[2]));

        $this->result = $result;

        return $result;
    }

    public function print(): void
    {
        print_r($this->result);
    }

    private function correctData(): void
    {
        if ($this->argv[0] !== "run.php") {
            $this->printError(self::ERROR['only_console']);
        }

        if (count($this->argv) < self::MAX_ELEMENTS) {
            $this->printError(self::ERROR['less']);
        } elseif (count($this->argv) > self::MAX_ELEMENTS) {
            $this->printError(self::ERROR['many']);
        }

        if (!$this->valueToInt($this->argv[1]) or !$this->valueToInt($this->argv[2])) {
            $this->printError(self::ERROR['not_int']);
        }

        if ($this->argv[1] >= $this->argv[2]) {
            $this->printError(self::ERROR['range']);
        }
    }

    #[NoReturn] private function printError(string $error): void
    {
        print_r($error);
        exit;
    }
}