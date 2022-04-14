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
    private $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    private function openSheet(){
        return (new XlsWriter())->instance()->openFile($this->file)->openSheet();
    }

    public function getSheet()
    {
        return $this->openSheet()->getSheetData();
    }

    public function getRow()
    {
        return $this->openSheet()->nextRow();
    }
}