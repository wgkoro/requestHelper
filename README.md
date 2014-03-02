requestHelper
=============

HTTP, Server, and Session helper class of PHP.

This classes are made for pure-PHP codes not using framework.

Using pure PHP, it's bother to get params value like $_GET, $_POST, $_SESSION...etc.
```PHP
if(isset($_GET["val"])){
    $val = $_GET["val"];
}
else{
    $val = null;
}
```

Here're easy ways to get values using class methods.
```PHP
// Example url: http://aaa.bbb.com/?val=1
$val = Http::get("val");    // => string("1")
$val2 = Http::get("val2");  // => null

// You can specify default values at second argument.
// Example url: http://aaa.bbb.com/
$val = Http::get("val", "No value");    // => string("No value")

// If you wish to cast value,set type name to 3rd argument. ※Default cast value is "String"
// Example url: http://aaa.bbb.com/?val=111
$val = Http::get("val", 0, "int");    // => int(111)

// If cast failed, method returns default value.
// Example url: http://aaa.bbb.com/?val=abc
$val = Http::get("val", 0, "int");    // => int(0)
```

## Type name

You can use these name to 3rd argument.

- str
- string
- int
- integer
- bool
- boolean
- array
- object
- unset

## Methods
=============

### Http::method()

Returns request method name.(Example: "GET", "POST", "PUT"...)
=============
### Http::get(key_name, default_value=null, cast_type="string")

Returns $_GET value.
=============
### Http::post(key_name, default_value=null, cast_type="string")

Returns $_POST value.
=============
### Http::request(key_name, default_value=null, cast_type="string")

Returns $_REQUEST value.
=============
### Http::coolie(key_name, default_value=null, cast_type="string")

Returns $_COOKIE value.
=============
### Env::session(key_name, default_value=null, cast_type="string")

Returns $_SESSION value.
=============
### Env::server(key_name, default_value=null, cast_type="string")

Returns $_SERVER value.
