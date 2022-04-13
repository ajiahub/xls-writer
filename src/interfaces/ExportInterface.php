<?php
namespace Chinahub\XlsWriter\interfaces;

interface ExportInterface
{
    /**
     * @return array
     */
    public function headers() : array;

    /**
     * @return array
     */
    public function data():array ;
}