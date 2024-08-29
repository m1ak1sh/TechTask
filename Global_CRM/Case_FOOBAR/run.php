<?php

require 'vendor/autoload.php';

use Global_CRM\Case_FOOBAR\ValueHandler;

$generate = new ValueHandler($_SERVER['argv']);
$generate->generate();
$generate->print();
