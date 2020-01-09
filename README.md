![Laravel Overflow Logo](https://raw.githubusercontent.com/CraftLogan/Laravel-Overflow/master/Laravel%20Overflow.png#logo)


[![Latest Version on Packagist](https://img.shields.io/packagist/v/craftlogan/laravel-overflow.svg?style=flat-square)](https://packagist.org/packages/craftlogan/laravel-overflow)
![GitHub Workflow Status](https://img.shields.io/github/workflow/status/spatie/laravel-responsecache/run-tests?label=tests)
[![MIT Licensed](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Quality Score](https://img.shields.io/scrutinizer/g/craftlogan/laravel-overflow.svg?style=flat-square)](https://scrutinizer-ci.com/g/craftlogan/laravel-overflow)
[![Total Downloads](https://img.shields.io/packagist/dt/craftlogan/laravel-overflow.svg?style=flat-square)](https://packagist.org/packages/craftlogan/laravel-overflow)

# Laravel Overflow

The Laravel Overflow package will allow adding an overflow column to a form request easily. Use this package to make it easy to store overflow request values in a JSON or Text column on a database table:)
## Installation

You can install the package via composer:

```bash
composer require craftlogan/laravel-overflow
```

## Usage

Defining the overflow column and table using a custom form request:

``` php
<?php

namespace CraftLogan\LaravelOverflow\Requests;

use Illuminate\Foundation\Http\FormRequest;
use CraftLogan\LaravelOverflow\Overflowable;

class OverflowFormRequest extends FormRequest
{
    use Overflowable;
    public $table = 'test_models';
    public $overflow_column = 'properties';


    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }
}
```

Using with the CREATE Method:

``` php
public function store(CustomFormRequest $request)
{
    $testmodel = TestModel::create($request->allWithOverflow());
}
```

Using with the object Attributes:

``` php
        $testmodel = new TestModel();
        $testmodel->name = $request->name;
        $testmodel->properties = $request->overflow();
        $testmodel->save();
```


When setting up a migration you can use a json column or a text column:

``` php
    public function up()
    {
        Schema::create('test_models', function (Blueprint $table){
            $table->increments('id');
            //$table->text('properties');  // Use this column type if you are using sqlite or a mysql version less than 5.7
            //$table->json('properties');  // If your database supports json then I would recommend using the json column
            $table->timestamps();
        });
    }

```


### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.


## Credits

- [Logan H. Craft](https://github.com/craftlogan)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.


This package used scafolding from the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com) built by [Marcel Pociot](https://twitter.com/marcelpociot)
