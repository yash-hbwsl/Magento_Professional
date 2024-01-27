<?php

namespace Yash\Mod1\Test;

use Yash\Mod1\Test\CustomClass;

class Data
{
    protected $array;
    protected $string;
    protected CustomClass $custom;
    public function __construct(CustomClass $customClass, $array = ['a' => 2, 'b' => 3, 'c' => 4], $string = "hello")
    {
        $this->array = $array;
        $this->custom = $customClass;
        $this->string = $string;
    }

    public function displayParams()
    {
        dump(json_encode($this->array));
        $writer = new \Zend_Log_Writer_Stream(BP . '/var/log/custom.log');
        $logger = new \Zend_Log();
        $logger->addWriter($writer);
        $logger->info(json_encode($this->array));
        echo "<br>";
        echo 'String value: ' . $this->string;
        if (!$this->custom instanceof \Yash\Mod1\Api\Data\Custom) {
            throw new \InvalidArgumentException(
                'Invalid category instance. Category must implement Custom Interface.'
            );
        }
    }
}
