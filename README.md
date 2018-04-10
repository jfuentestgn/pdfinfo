PDF Info
=======================

Simple class to retrieve basic information from PDF file

This class extends uses spatie/pdftotext and extends it to read metadata from a PDF file. It acts as a wrapper for pdfinfo command.

## Requirements

* PHP >= 5.6.4
* pdfinfo

Be sure to check if pdfinfo is installed in your system before using this package

## Installation

You should use the pdfinfo class with composer, from command line:

```bash
$ composer require jfuentestgn/pdfinfo
```

or declaring it in your project's composer.json file:

```json
{
    "require": {
        "jfuentestgn/pdfinfo": "dev-master"
    }
}
```



## Configuration

No config needed

## Usage

You can use the Pdf class in a similar way thay you would do with spatie's one:

```php
use JFuentesTgn\pdfinfo\Pdf;

$info = (new Pdf())->setPdf('dummy.pdf')->info();
print_r($info);
```
or:
```php
$info = \JFuentesTgn\pdfinfo\Pdf::getInfo('dummy.pdf');
```

## Credits

This package is maintained by [Juan Fuentes](https://github.com/jfuentestgn). It's based on [spatie/pdftotext](https://github.com/spatie/pdftotext).


## License

This package is licensed under [The MIT License (MIT)](LICENSE).