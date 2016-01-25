<?php

/**
 * Class JobHelpDev
 */
class JobHelpDev extends ADev
{
    /** 问题详情 @var string */
    static private $_wenTiDetailUrl = '';


    function __construct($arg_url)
    {
        $this->url = '';
    }

    public function getUrl($arg)
    {

    }

    public function parse($arg)
    {

    }

    public function output($arg = null)
    {
        file_put_contents('./txt.json', json_encode(self::$_output));
        $this->_clearOutput();
    }

    private function _clearOutput()
    {
        self::$_output = array();
    }
}