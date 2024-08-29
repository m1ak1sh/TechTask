<?php

namespace Global_CRM\Case_FOOBAR;

interface ValueHandlerInterface {
    public function generate(): array;

    public function print(): void;
}
