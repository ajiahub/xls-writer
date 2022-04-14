<?php
namespace Chinahub\XlsWriter\helpers;

class FileHelper
{
    public static function extendLoad(): bool
    {
        return extension_loaded('xlsWriter');
    }

    public static function getTmpDir(): string
    {
        $tmp = ini_get('upload_tmp_dir');
        if ($tmp !== false && file_exists($tmp)) {
            return realpath($tmp);
        }
        return realpath(sys_get_temp_dir());
    }
}