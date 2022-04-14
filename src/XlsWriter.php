<?php

namespace Chinahub\XlsWriter;

use Cassandra\Exception\ConfigurationException;
use Chinahub\XlsWriter\helpers\FileHelper;

class XlsWriter
{
    private $excel;

    private $config;

    public function __construct(array $config = [])
    {
        $this->config = array_merge(['path' => FileHelper::getTmpDir()], $config);
    }

    public function instance()
    {
        if (!FileHelper::extendLoad()) {
            throw new ConfigurationException('xlsWriter extension required.');
        }
        if (!$this->excel instanceof \Vtiful\Kernel\Excel) {
            $this->excel = new \Vtiful\Kernel\Excel($this->config);
        }
        return $this;
    }

    public function __call($name, $arguments)
    {
        if (method_exists($this->excel, $name)) {
            $this->excel = call_user_func_array([$this->excel, $name], $arguments);
        }else{
            throw new \Exception('Getting unknown method: ' . get_class($this) . '::' . $name);
        }
        return $this;
    }

    public function __get($name)
    {
        if(property_exists($this,$name)){
            return $this->$name;
        }
        throw new \Exception('Getting unknown property: ' . get_class($this) . '::' . $name);
    }
}