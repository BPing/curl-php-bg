<?php

/**
 * Class CurlFacade
 */
class CurlFacade
{

    /** 处理驱动器 @var ADev null */
    private $_dev = null;

    /** 配置 @var array */
    private $_config = array(
        "count" => 10,
    );

    public function __construct($arg_options = array(), $arg_dev = null)
    {
        if (is_array($arg_options))
            $this->_config = array_merge($this->_config, $arg_options);
        $this->setDev($arg_dev);
    }

    public function setDev($arg_dev)
    {
        if ($arg_dev instanceof ADev) {
            $this->_dev = $arg_dev;
        }
    }

    /**
     * @throws Exception
     */
    public function startUp()
    {
        if (is_null($this->_dev)) throw new Exception("the dev doesn't exist");

        $count = (int)$this->_config["count"];
        for ($i = 0; $i < $count; $i++) {
            $this->_dev->parse(api_curl($this->_dev->getUrl($i), [], "get"));
        }
        $this->_dev->output();
    }


}