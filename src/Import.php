<?php

namespace Chinahub\XlsWriter;

use Chinahub\XlsWriter\abstracts\ImportAbstract;

/**
 * export
 *
 * @package Chinahub\XlsWriter
 */
class Import extends ImportAbstract
{
    private string $fileName;
    private array $config;
    private string $file;

    public function __construct($file)
    {
        $this->file = $file;
        $this->fileName = basename($file);
        $this->config = ['path'=>dirname($file)];
    }

    public function getSheet()
    {
        if(!file_exists($this->file)){
            throw new \Exception('File'.$this->file.' Not Found.');
        }
        return (new XlsWriter($this->config))->instance()->openFile($this->fileName)->openSheet()->getSheetData();
    }

    public function instance()
    {
        if(!file_exists($this->file)){
            throw new \Exception('File'.$this->file.' Not Found.');
        }
        $xlsWriter = (new XlsWriter($this->config))->instance()->openFile($this->fileName)->openSheet();
        return $xlsWriter->excel;
    }
}