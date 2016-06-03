# PHP TPWebCP Executor Library
[![Build Status](https://travis-ci.org/TPWeb/tpwebcp-executor.svg?branch=master)](https://travis-ci.org/TPWeb/tpwebcp-executor)
[![Coverage Status](https://coveralls.io/repos/github/TPWeb/tpwebcp-executor/badge.svg?branch=master)](https://coveralls.io/github/TPWeb/tpwebcp-executor?branch=master)
[![Latest Stable Version](https://poser.pugx.org/tpweb/tpwebcp-executor/v/stable.svg)](https://packagist.org/packages/tpweb/tpwebcp-executor)
[![Latest Unstable Version](https://poser.pugx.org/tpweb/tpwebcp-executor/v/unstable.svg)](https://packagist.org/packages/tpweb/tpwebcp-executor)
[![Total Downloads](https://poser.pugx.org/tpweb/tpwebcp-executor/d/total.svg)](https://packagist.org/packages/tpweb/tpwebcp-executor)
[![License](https://poser.pugx.org/tpweb/tpwebcp-executor/license.svg)](https://packagist.org/packages/tpweb/tpwebcp-executor)

#Installation

Require this package in your `composer.json` and update composer.

```php
"tpweb/tpwebcp-executor": "~1.*"
```

After updating composer, add the ServiceProvider to the providers array in `config/app.php`

```php
TPWeb\TPWebCP\Executor\ExecutorServiceProvider::class,
```

You can use the facade for shorter code. Add this to your aliases:

```php
'Executor' => TPWeb\TPWebCP\Executor\ExecutorFacade::class,
```

# Documentation


# Support

Support github or mail: tjebbe.lievens@madeit.be

# Contributing

Please try to follow the psr-2 coding style guide. http://www.php-fig.org/psr/psr-2/
t
# License

This package is licensed under LGPL. You are free to use it in personal and commercial projects. The code can be forked and modified, but the original copyright author should always be included!