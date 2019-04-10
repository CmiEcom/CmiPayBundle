# CMI payment Bundle
Straight forward integration of [CMI](http://www.cmi.co.ma/) payment module into Symfony applications.

# Setup
*This bundle allows you to add cmi payment process with minimum changes to your code. These instructions will also guide you through the installation of that bundle.*

## Installation
Install with composer:

    composer require cmiecom/cmi-pay-bundle

Include `routing.yml` in your routing file :

```yml
// config/routes.yaml

_cmi_pay:
    resource: '@CmiPayBundle/Resources/config/routes.xml'
```
