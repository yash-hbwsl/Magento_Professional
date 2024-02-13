<?php

namespace Yash\Mod1\Test;

class Data
{
    protected String $string;
    protected CustomClass $custom;
    /** @var array<mixed>  $array*/
    private array $array = [];
    /**
     * @param array<int> $array
     * @param string $string
     */
    public function __construct(CustomClass $customClass, array $array = ['a' => 2, 'b' => 3, 'c' => 4], String $string = "hello")
    {

        $this->array = $array;
        $this->custom = $customClass;
        $this->string = $string;
    }

    public function displayParams(): void
    {
        dump(json_encode($this->array));
        $writer = new \Zend_Log_Writer_Stream(BP . '/var/log/custom.log');
        $logger = new \Zend_Log();
        $logger->addWriter($writer);
        $logger->info(json_encode($this->array));
        dump('String value: ' . $this->string);
        if (!$this->custom instanceof \Yash\Mod1\Api\Data\Custom) {
            throw new \InvalidArgumentException(
                'Invalid category instance. Category must implement Custom Interface.'
            );
        }
    }
}
