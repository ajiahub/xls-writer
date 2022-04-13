<?php

namespace Chinahub\XlsWriter;

use Cassandra\Exception\ConfigurationException;

class XlsWriter
{
    private $excel;

    private $config;

    public function __construct(array $config = [])
    {
        $this->config = array_merge(['path' => $this->getTmpDir()], $config);
    }

    public function instance()
    {
        if (!$this->extendLoad()) {
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
        }
        return $this;
    }

    private function extendLoad(): bool
    {
        return extension_loaded('xlsWriter');
    }

    private function getTmpDir(): string
    {
        $tmp = ini_get('upload_tmp_dir');
        if ($tmp !== false && file_exists($tmp)) {
            return realpath($tmp);
        }
        return realpath(sys_get_temp_dir());
    }
}