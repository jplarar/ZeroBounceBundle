# ZeroBounceBundle
Symfony 3 Zero Bounde Bundle


## Setup

### Step 1: Download JplararZeroBounceBundle using composer

Add S3 Bundle in your composer.json:

```js
{
    "require": {
        "jplarar/zero-bounce-bundle": "0.0.1"
    }
}
```

Now tell composer to download the bundle by running the command:

``` bash
$ php composer.phar update "jplarar/zero-bounce-bundle"
```


### Step 2: Enable the bundle

Enable the bundle in the kernel:

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Jplarar\ZeroBounceBundle\JplararZeroBounceBundle()
    );
}
```

### Step 3: Add configuration

``` yml
# app/config/config.yml
jplarar_zero_bounce:
        zero_bounce_api_key: %zero_bounce_api_key%
```

## Usage

**Using service**

``` php
<?php
        $zeroBounceClient = $this->get('zero_bounce_client');
?>
```

##Example

###Validate Email
``` php
<?php 
    $emialIsValid = $zeroBounceClient->validateEmail($email);
?>
```
