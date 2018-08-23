XerviceCli
====

XerviceCli can be used to run helper functions.  


Install
----------
```
# Latest version
composer global require xervice/xervicecli dev-master
```


Configuration
-----------------
You have to add the ProjectNamespace "XerviceCli":
```php
use Xervice\Core\CoreConfig;

$config[CoreConfig::PROJECT_NAMESPACES] = [
    'XerviceCli'
];
```


Usage
-----------
```
# Create a new project structure
~/.composer/vendor/bin/xervice xervice:create:project <projectname> <namespace>

# Create a new service (run command in src directory)
~/.composer/vendor/bin/xervice xervice:create:project <servicename> <namespace>
```

