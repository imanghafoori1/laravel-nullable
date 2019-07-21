#  laravel nullable
Functional paradigm in laravel

### installation:

```
composer require imanghafoori/laravel-nullable
```

This package exposes a `nullable()` global helper function with which you can wrap values that are sometime `null` and sometimes an other type object.

For example `$user = User::find(1);` the `$user` varible can be null if it is not found.
So if you forget to handle the null case with an if statement... you will have errors.

You need to something to force you and the users of your class methods to handle the `null` cases.

Simply you can refactor this code :
```php
$user = $userRepo->find($id);

if ($user === null) {
    return redirect()->route('page_bot_found');
}

```

to this :

```php

$user = $userRepo->find($id)->getOrSend(function () {
  return redirect()->route('page_bot_found');
});

// now we are sure $user is not null.
```

but remember you have to change your repo class from this :

```php

public function find ($id) {
     $user = User::find($id);
     
     return $user;
}
```

to this:

```php
public function find ($id) {
     $user = User::find($id);
     
     return nullable($user);
}
```
