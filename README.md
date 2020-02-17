![Laravel Overflow Logo](https://raw.githubusercontent.com/CraftLogan/Laravel-Overflow/master/Laravel%20Overflow.png#logo)
<!-- ALL-CONTRIBUTORS-BADGE:START - Do not remove or modify this section -->
[![All Contributors](https://img.shields.io/badge/all_contributors-6-orange.svg?style=flat-square)](#contributors-)
<!-- ALL-CONTRIBUTORS-BADGE:END -->


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

#### Create Model

You should create a model which will use the overflow method.
```bash
php artisan make:model TestModel -m
```
-m option generates database migration with the model.

``` php
   <?php
   
   namespace App;
   
   use Illuminate\Database\Eloquent\Model;
   
   class TestModel extends Model
   {
     
       protected $guarded = [];   // you should use either $fillable or $guarded
   }

```

#### Edit Migration

When setting up a migration you can use a json column or a text column:

``` php
    public function up()
    {
        Schema::create('test_models', function (Blueprint $table){
            $table->increments('id');
            $table->string('name');
            //$table->text('properties');  // Use this column type if you are using sqlite or a mysql version less than 5.7
            //$table->json('properties');  // If your database supports json then I would recommend using the json column
            $table->timestamps();
        });
    }

```
After setting up fields you should migrate your table.
```bash
php artisan migrate
```

#### Available Macros
There are `allWithOverflow` and `overflow` macros.You can payload Model and Overflow Field for each macros.

#### `allWithOverflow`
This macro returns all fields of model as an array
``` php
    $request->allWithOverflow(Model_Name,Overflow_Field)
    
    //Returns

    [
        "properties" => "{"key1":"key1_value","key2":"key2_value"}",
        "name" => "overflow"
    ]
```

#### `overflow`
This macro returns only Overflow Field as a json object
``` php
    $request->overflow(Model_Name,Overflow_Field)

    //Returns

    "{"key1":"key1_value","key2":"key2_value"}"
```

#### Insert record via ``create`` method

You can use `Illuminate\Http\Request` for retrieving Http Requests.

``` php
public function store(Request $request)
{
    $testmodel = TestModel::create($request->allWithOverflow(new TestModel(),'properties'));
}
```
Also, you can use your custom `Form Request`.

``` php
public function store(\App\Http\Requests\TestFormRequest $request)
{
    $testmodel = TestModel::create($request->allWithOverflow(new TestModel(),'properties'));
}
```
#### Insert record via ``save`` method

Using with the object Attributes:

``` php
    public function store(Request $request)
    {
        $testmodel = new TestModel();
        $testmodel->name = $request->name;
        $testmodel->properties = $request->overflow(new TestModel(),'properties');
        $testmodel->save();
    }   
```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.


## Contributors ✨

Thanks goes to these wonderful people ([emoji key](https://allcontributors.org/docs/en/emoji-key)):

<!-- ALL-CONTRIBUTORS-LIST:START - Do not remove or modify this section -->
<!-- prettier-ignore-start -->
<!-- markdownlint-disable -->
<table>
  <tr>
    <td align="center"><a href="https://logancraft.dev"><img src="https://avatars0.githubusercontent.com/u/10950466?v=4" width="100px;" alt=""/><br /><sub><b>Logan H. Craft</b></sub></a><br /><a href="https://github.com/CraftLogan/Laravel-Overflow/commits?author=CraftLogan" title="Code">💻</a> <a href="https://github.com/CraftLogan/Laravel-Overflow/commits?author=CraftLogan" title="Documentation">📖</a></td>
    <td align="center"><a href="https://github.com/DanielGilB"><img src="https://avatars0.githubusercontent.com/u/32772927?v=4" width="100px;" alt=""/><br /><sub><b>Daniel</b></sub></a><br /><a href="https://github.com/CraftLogan/Laravel-Overflow/commits?author=DanielGilB" title="Code">💻</a></td>
    <td align="center"><a href="https://laravel-news.com"><img src="https://avatars0.githubusercontent.com/u/6818566?v=4" width="100px;" alt=""/><br /><sub><b>Laravel News</b></sub></a><br /><a href="#blog-laravelnews" title="Blogposts">📝</a></td>
    <td align="center"><a href="https://twitter.com/paulredmond"><img src="https://avatars3.githubusercontent.com/u/177773?v=4" width="100px;" alt=""/><br /><sub><b>Paul Redmond</b></sub></a><br /><a href="#blog-paulredmond" title="Blogposts">📝</a></td>
    <td align="center"><a href="http://pierrearnissolle.com"><img src="https://avatars0.githubusercontent.com/u/5046159?v=4" width="100px;" alt=""/><br /><sub><b>Pierre Arnissolle</b></sub></a><br /><a href="https://github.com/CraftLogan/Laravel-Overflow/commits?author=parnissolle" title="Code">💻</a></td>
    <td align="center"><a href="https://www.linkedin.com/in/hayricanbarcin/"><img src="https://avatars2.githubusercontent.com/u/17090831?v=4" width="100px;" alt=""/><br /><sub><b>Hayri Can BARÇIN</b></sub></a><br /><a href="https://github.com/CraftLogan/Laravel-Overflow/commits?author=HayriCan" title="Documentation">📖</a></td>
  </tr>
</table>

<!-- markdownlint-enable -->
<!-- prettier-ignore-end -->
<!-- ALL-CONTRIBUTORS-LIST:END -->


## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

This project follows the [all-contributors](https://github.com/all-contributors/all-contributors) specification. Contributions of any kind welcome!

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.


This package used scafolding from the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com) built by [Marcel Pociot](https://twitter.com/marcelpociot)
