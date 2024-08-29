<?php

namespace LogKB\Domain\Model;

class TransactionItem
{
    private $id;
    private $transaction;
    private $field;
    private $value;

    public function __construct(object $transactionId, string $field, mixed $value)
    {
        $this->transaction = $transactionId;
        $this->field = $field;
        $this->value = $value;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getTransaction(): int
    {
        return $this->transaction;
    }

    /**
     * @return string
     */
    public function getField(): string
    {
        return $this->field;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }
}