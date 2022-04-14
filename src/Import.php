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

    public function __construct($file)
    {
        $this->fileName = basename($file);
        $this->config = ['path'=>dirname($file)];
    }

    public function getSheet()
    {
        return (new XlsWriter($this->config))->instance()->openFile($this->fileName)->openSheet()->getSheetData();
    }

    public function instance()
    {
        $xlsWriter = (new XlsWriter($this->config))->instance()->openFile($this->fileName)->openSheet();
        return $xlsWriter->excel;
    }
}