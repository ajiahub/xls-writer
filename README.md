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
```php
use Chinahub\XlsWriter\Export;
use Chinahub\XlsWriter\interfaces\ExportInterface;

class ExportTest implements ExportInterface
{
    public function headers(): array
    {
        return ['item', 'Cost'];
    }

    public function data(): array
    {
        return [
            ['test', 1000],
            ['Gas', 100],
            ['Food', 300],
            ['Gym', 50],
        ];
    }
}

//output path
$export = new Export(new ExportTest());
$export->config = ['path' => '/www'];
$export->fileName = 'test.xlsx';
$export->output();

//download
$export = new Export(new ExportTest());
$export->fileName = 'test.xlsx';
$export->download();
```