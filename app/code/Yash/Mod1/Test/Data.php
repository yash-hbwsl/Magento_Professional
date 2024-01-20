<?php

namespace Yash\Mod1\Test;

use Yash\Mod1\Test\CustomClass;

class Data
{
    protected $array;
    protected $string;
    protected CustomClass $custom;
    public function __construct(CustomClass $customClass, $array = [2, 3, 4], $string = "hello")
    {
        $this->array = $array;
        $this->custom = $customClass;
        $this->string = $string;
    }

    public function displayParams()
    {
        var_dump($this->array);
        echo "<br>";
        echo 'String value:'. $this->string;
    }
}
