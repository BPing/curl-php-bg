<?php
require_once 'CurlFacade.php';
require_once 'CurlFunctions.php';
require_once 'parser/IParser.php';
require_once 'parser/IOutput.php';
require_once 'parser/ADev.php';
require_once 'parser/AskHomeWorkDEV.php';


$instance = new CurlFacade(array(), new AskHomeWorkDEV(''));
$instance->startUp();