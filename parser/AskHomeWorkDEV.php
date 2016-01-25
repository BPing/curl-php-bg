<?php

/**
 * Class AskHomeWorkDEV
 */
class AskHomeWorkDEV extends ADev
{
    /** 问题详情 @var string */
    static private $_wenTiDetailUrl = 'http://www.7wenta.com/mobile/wenTiSanheyi.json?limit=10&offset=0&wenTiId=';

    /** 过滤器 年级-科目 @var array */
    static private $_filters = array(
        "&filters=1-1",
        "&filters=1-2",
        "&filters=1-3",
    );

    function __construct($arg_url)
    {
        $this->url = 'http://www.7wenta.com/mobile/qs-down.json?offset=0&limit=20&forAward=0&withoutAnswer=0';
    }

    public function getUrl($arg)
    {
        $filters = ((int)$arg) % 3;
        return $this->url . self::$_filters[$filters];
    }

    public function parse($arg)
    {
        if (!is_string($arg)) return;

        $json = json_decode($arg, true); //转换成json格式

        if (!is_array($json) || $json['result']['resultCode']['code'] != 0) return;

        foreach ($json['result']['value']['qs'] as $oneQues) {
            if (!isset($oneQues['id'])) continue;
            $res = json_decode(api_curl(self::$_wenTiDetailUrl . $oneQues['id'], [], 'get'), true);
            if (!is_array($res) || $res['result']['resultCode']['code'] != 0) continue;
            $res = $res['result']['value'];
            $qs = array();
            $qs["content"] = $res['wenTiMm']["content"];
            $qs['imgUrl'] = $res['wenTiMm']["imgUrl"];
            $qs['id'] = $res['wenTiMm']["id"];
            $qs['course'] = $res['wenTiMm']["course"];
            $qs['answerNum'] = count($res['otherAnswers']);
            $qs['answer'] = $res['otherAnswers'];
            array_push(self::$_output, $qs);
        }
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