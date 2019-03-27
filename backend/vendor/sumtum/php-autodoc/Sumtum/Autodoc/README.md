php-autodoc
==========

Generate documentation for php API based application. No dependency. No framework required.

* [Requirements](#requirements)
* [Installation](#installation)
* [Usage](#usage)
* [Available Methods](#methods)
* [Tips](#tips)
* [Known issues](#known-issues)

### <a id="requirements"></a>Requirements

PHP >= 5.3.2

### <a id="installation"></a>Installation

The recommended installation is via composer. Just add the following line to your composer.json:

```json
{
    ...
    "require": {
        ...
        "sumtum/php-autodoc": "*"
    }
}
```

```bash
$ php composer.phar update
```

or just run below in terminal

```bash
$ composer install sumtum/php-autodoc
```

### <a id="usage"></a>Usage

```php
<?php

namespace Some\Namespace;

class User
{
    /**
     * @ApiDescription(section="User", description="Get information about user")
     * @ApiMethod(type="get")
     * @ApiRoute(name="/user/get/{id}")
     * @ApiParams(name="id", type="integer", input_type="text", nullable=false, description="User id")
     * @ApiParams(name="data", type="object", input_type="text", description="User Data", sample="{'user_id':'int','user_name':'string','profile':{'email':'string','age':'integer'}}")
     * @ApiReturnHeaders(sample="HTTP 200 OK")
     * @ApiReturn(type="object", sample="{
     *  'transaction_id':'int',
     *  'transaction_status':'string'
     * }")
     */
    public function get()
    {

    }

    /**
     * @ApiDescription(section="User", description="Create's a new user")
     * @ApiMethod(type="post")
     * @ApiRoute(name="/user/create")
     * @ApiParams(name="username", type="string", nullable=false, description="Username")
     * @ApiParams(name="email", type="string", nullable=false, description="Email")
     * @ApiParams(name="password", type="string", nullable=false, description="Password")
     * @ApiParams(name="age", type="integer", nullable=true, description="Age")
     */
    public function create()
    {

    }
}
```

Create an autodocs/autodoc.php file in your project root folder as follow:


```php
# autodoc.php
<?php

require "../vendor/autoload.php";
use Sumtum\Autodoc\Builder;
use Sumtum\Autodoc\Exception;

$classes = array(
    'Some\Namespace\User',
    'Some\Namespace\OtherClass',
);

$output_dir  = __DIR__.'/';
$output_file = 'index.html'; // defaults to index.html

try {
    $builder = new Builder($classes, $output_dir, 'Name of the API', 'http://something.com/project_folder/public');
    $builder->generate();
} catch (Exception $e) {
    echo 'There was an error generating the documentation: ', $e->getMessage();
}

```

Then, execute it via CLI

```php
$ php autodoc.php
```

or simply go to your browser to http://something.com/project_folder/autodocs/autodoc.php to generate the documentation.

### <a id="methods"></a>Available Methods

Here is the list of methods available so far :

* @ApiDescription(section="...", description="...")
* @ApiMethod(type="(get|post|put|delete|patch")
* @ApiRoute(name="...")
* @ApiParams(name="...", type="...", input_type="...", nullable=..., description="...", [sample=".."])
* @ApiHeaders(name="...", type="...", nullable=..., description="...", sample="...")
* @ApiReturnHeaders(sample="...")
* @ApiReturn(name="...", type="...", sample="...")
* @ApiBody(sample="...")

### <a id="tips"></a>Tips

To generate complex object sample input, use the ApiParam "type=(object|array(object)|array)":

```php
* @ApiParams(name="data", type="object", input_type="...", description="...", sample="{'user_id':'int','profile':{'email':'string','age':'integer'}}")
```

### <a id="knownissues"></a>Known issues

I don't know any, but please tell me if you find something. PS: I have tested it only in Chrome !

