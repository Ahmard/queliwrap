Queliwrap, PHP QueryList Wrapper.
==============================================

Queliwrap is a wrapper that provides easy helper functions
around PHP popular web scrapper, QueryList library.

# Installation

Make sure that you have composer installed
[Composer](http://getcomposer.org).

If you don't have Composer run the below command
```bash
curl -sS https://getcomposer.org/installer | php
```

Now, let's install Queliwrap:

```bash
composer require ahmard/queliwrap
```

Now update composer libraries to match current latest releases.

 ```bash
composer update
 ```

After installing, require Composer's autoloader in your code:

```php
require 'vendor/autoload.php';
```

# Usage
```php
use Queliwrap\Client;

$request = Queliwrap::get($url);
if($request->success()){
    $ql = $request->getQL();
    $lists = $ql->find('ul')->eq(0)
        ->find('li');
    .
    .
    .
}else{
    echo $request->getError()->getMessage();
}
```
or you can directly check if error occured using below syntax
```php
if($request->error()){
    $request->getError()->getMessage();
}
```

In favor to those who wants perform simple operations,
simpler syntax is provided.
```php
$request->error(function($error){
    echo "Error code: {$error->getCode()}<br/>";
    echo "Message: {$error>getMessage()}";
});
```
as you probably have it in mind, you can pass closure to success method too
```php
$request->success(function($ql){
    $text = $ql->find('ul')->eq(0)
        ->find('li')->eq(0);
        ->text();
    echo $text;
});
```

# Summary
```php
- getQL()
returns QL\QueryListHome

- getError()
returns GuzzleHttp\Exception\TransferException;

- success()
returns bool || QL\QueryListHome

- error()
returns bool || GuzzleHttp\Exception\TransferException;
```

# Documentations
- [QueryList](https://github.com/jae-jae/QueryList)
- [Guzzle](http://guzzlephp.org/)
