<?php

/**
 * Class ADev
 */
abstract class ADev implements IOutput, IParser
{
    /** 请求 @var string */
    protected $url = '';

    /** 输出数组 @var array */
    static protected $_output = array();

    abstract function getUrl($arg);


}