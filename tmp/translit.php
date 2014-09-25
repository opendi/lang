<?php

require '../vendor/autoload.php';

use Opendi\Lang\String;

var_dump(String::translit('ÄebeRaa@@as1!""!%$'));

var_dump(String::translit('  Multiple-/-\\-- Weird -{}- Char123acters !"#$%&/(()=??*'));
var_dump(String::translit('  Multiple-/-\\-- Weird -{}- Characters !"#$%&/(()=??*', '-'));