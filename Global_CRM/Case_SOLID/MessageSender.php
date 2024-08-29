<?php

class MessageSender implements MessageSenderInterface
{
    private $sender;

    public function __construct(MessageSender $sender)
    {
        $this->sender = $sender;
    }

    public function send($message, $recipients)
    {
        $this->sender->send($message, $recipients);
    }
}
