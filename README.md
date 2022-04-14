# xls-writer
php xls library based on xlsWriter

## Installation

Run the following command to install the latest applicable version of the package:

```bash
composer require chinahub/xls-writer
```

## Env Required
- `xlswriter` extention
- recommend `PHP` > 7.4

## Usage
### Export
```php
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
```
#### output path
```php
use Chinahub\XlsWriter\Export;

$excel = new Export(new UserExport());
$excel->config = ['path' => '/www'];
$excel->fileName = 'user.xlsx';
$excel->output();
```
#### output download
```php
use Chinahub\XlsWriter\Export;

$excel = new Export(new UserExport());
$excel->fileName = 'user.xlsx';
$excel->download();
```

### Import
get all data from sheet
```php
use Chinahub\XlsWriter\Import;

$excel = new Import('user.xlsx');
$excel->getSheet();
```
get row from sheet
```php
use Chinahub\XlsWriter\Import;

$excel = new Import('user.xlsx');
while (($row = $excel->nextRow()) !== NULL) {
    var_dump($row);
}
```
