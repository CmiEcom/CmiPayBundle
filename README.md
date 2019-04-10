# CMI payment Bundle
Straight forward integration of [CMI](http://www.cmi.co.ma/) payment module into Symfony applications.

* How CMI process works?*

    A client fills the form on your side and then submits the form. Then the client will be redirected to CMI
    payment page to complete the payment. Once the payment has been completed the client has the option to return 
    back to your website and at the same time a callback is send from Cmi to your notify url.
	
# Setup
This bundle allows you to add cmi payment process with minimum changes to your code. These instructions will also guide you through the installation of that bundle.


## Installation
Install with composer:

    composer require cmiecom/cmi-pay-bundle

Include `routes.xml` in your routing file :

```yml
// config/routes.yaml

_cmi_pay:
    resource: '@CmiPayBundle/Resources/config/routes.xml'
```

# Usage
## Rendering the form and redirect client to CMI page payment
The default route configured in:

```xml
// src/Resources/config/routes.xml
	<route id="cmi_pay_request" controller="cmi.pay.controller::requestPay" path="/cmi/requestpayment" />
```