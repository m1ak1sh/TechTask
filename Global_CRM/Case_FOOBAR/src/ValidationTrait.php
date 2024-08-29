<?php

namespace Global_CRM\Case_FOOBAR;

trait ValidationTrait
{
    private const int MAX_ELEMENTS = 3;

    private const array ERROR = [
        "only_console" => "На данный момент поддерживается только запуск через консоль",
        "not_int" => "Элементы должны быть целым числом",
        "range" => "Первый элемент должен быть меньше второго элемента",
        "many" => "Слишком много аргументов, допускается два",
        "less" => "Мало аргументов, необходимо два",
    ];

    private const array NAME = [
        'Foo',
        'Bar',
        'FooBar'
    ];

    private function valueToInt(mixed $value): ?bool
    {
        return is_numeric($value) && settype($value, "int");
    }
}