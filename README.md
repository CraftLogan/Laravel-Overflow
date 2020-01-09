![Laravel Overflow Logo](https://raw.githubusercontent.com/CraftLogan/Laravel-Overflow/master/Laravel%20Overflow.png)

# Laravel Overflow
[![Latest Version on Packagist](https://img.shields.io/packagist/v/craftlogan/laravel-overflow.svg?style=flat-square)](https://packagist.org/packages/craftlogan/laravel-overflow)
[![Build Status](https://img.shields.io/travis/craftlogan/laravel-overflow/master.svg?style=flat-square)](https://travis-ci.org/craftlogan/laravel-overflow)
[![Quality Score](https://img.shields.io/scrutinizer/g/craftlogan/laravel-overflow.svg?style=flat-square)](https://scrutinizer-ci.com/g/craftlogan/laravel-overflow)
[![Total Downloads](https://img.shields.io/packagist/dt/craftlogan/laravel-overflow.svg?style=flat-square)](https://packagist.org/packages/craftlogan/laravel-overflow)

The Laravel Overflow package will allow to easily add an overflow column to a form request. Use this package to make it easy to store overflow request values in a json column on database table:)
## Installation

You can install the package via composer:

```bash
composer require craftlogan/laravel-overflow
```

## Usage

Defining the overflow column and table using a custom form request:

``` php
<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use CraftLogan\LaravelOverflow\Overflowable;

class CustomFormRequest extends FormRequest
{
    use Overflowable;
    public $table = 'programs';
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
    $mymodel = MyModel::create($request->allWithOverflow());
}
```

Using with the object Attributes:

``` php
// Usage description here
```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email craftlogan@gmail.com instead of using the issue tracker.

## Credits

- [Logan H. Craft](https://github.com/craftlogan)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
