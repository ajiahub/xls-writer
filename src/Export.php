<?php

namespace Chinahub\XlsWriter;

use Chinahub\XlsWriter\abstracts\ExportAbstract;
use Chinahub\XlsWriter\interfaces\ExportInterface;
use Exception;

/**
 * export
 *
 * @package Chinahub\XlsWriter
 */
class Export extends ExportAbstract
{
    public string $fileName;
    public array $config = [];

    /**
     * Export constructor.
     *
     * @param ExportInterface $export
     */
    public function __construct(ExportInterface $export)
    {
        parent::__construct($export);
    }

    /**
     * output filePath
     *
     * @return mixed
     * @throws Exception
     */
    public function output()
    {
        if (empty($this->fileName)) {
            throw new Exception('fileName require');
        }
        /** @var \Vtiful\Kernel\Excel $instance */
        $instance = (new XlsWriter($this->config))->instance();
        return $instance->fileName($this->fileName)
            ->header($this->imp->headers())
            ->data($this->imp->data())
            ->output();
    }

    /**
     * download xls
     *
     * @throws Exception
     */
    public function download()
    {
        $xlsWriter = $this->output();
        $filePath = $xlsWriter->excel;
        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header('Content-Disposition: attachment;filename="' . $this->fileName . '"');
        header('Content-Length: ' . filesize($filePath));
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate');
        header('Cache-Control: max-age=0');
        header('Pragma: public');

        ob_clean();
        flush();

        if (copy($filePath, 'php://output') === false) {
            throw new Exception('copy error');
        }
        @unlink($filePath);
    }
}