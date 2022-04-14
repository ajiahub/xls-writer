<?php

require __DIR__ . '/vendor/autoload.php';

use Chinahub\XlsWriter\Export;
use Chinahub\XlsWriter\interfaces\ExportInterface;

class UserExport implements ExportInterface
{
    public function headers(): array
    {
        return ['id','name','email'];
    }

    public function data(): array
    {
        return [
            [1,'tom','test@qq.com'],
            [2,'lily','test@gmail.com'],
            [3,'lisa','test@163.com'],

        ];
    }
}

//output path
$export = new Export(new UserExport());
$export->config = ['path' => '/www'];
$export->fileName = 'user.xlsx';
$export->output();

//download
$export = new Export(new ExportTest());
$export->fileName = 'user.xlsx';
$export->download();
