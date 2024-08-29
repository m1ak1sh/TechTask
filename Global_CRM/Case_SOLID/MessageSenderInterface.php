<?php

interface MessageSenderInterface
{
    public function send($message, $recipients);
}
