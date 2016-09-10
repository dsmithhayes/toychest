# ToyChest

An extremely basic dependency container.

## Adding Dependencies

Adding a dependency to the container is easy. The `ToyChest` container
implements the `\ArrayAccess` SPL interface so you can treat it like an array.

```php
<?php

use ToyChest\ToyChest;
use Some\ORM\Model;

$container = new ToyChest();

$container['user'] = function ($container) {
    return new Model('User', $container['dbh']);
};
```
