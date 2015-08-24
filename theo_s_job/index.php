<?php
require_once './parsers/IdxParser.inc';
require_once './parsers/DictParser.inc';
require_once './resources/Resources.inc';
require_once './Translator.inc';
require_once './Dictionary.inc';

$index_p = IdxParser::get_instance();
$dict = new Dictionary(new DictParser(), $index_p);
$trans = new Translator($dict);

$trans->run();