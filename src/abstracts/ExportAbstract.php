<?php

namespace Chinahub\XlsWriter\abstracts;

use Chinahub\XlsWriter\interfaces\ExportInterface;

abstract class ExportAbstract
{
    /**
     * @var ExportInterface
     */
    protected $imp;

    /**
     * ExportAbstract constructor.
     *
     * @param ExportInterface $export
     */
    public function __construct(ExportInterface $export)
    {
        $this->imp = $export;
    }

    abstract public function output();

    abstract public function download();
}