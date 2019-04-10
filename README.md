# CMI payment Bundle
Straight forward integration of [CMI](http://www.cmi.co.ma/) payment module into Symfony applications.

* How CMI payment process works?*

    A client fills the form on your side and then submits the form. Then the client will be redirected to CMI
    payment page to complete the payment. Once the payment has been completed the client has the option to return 
    back to your website and at the same time a callback is send from Cmi to your callback url.
	
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

And a controller action to render the form:

```php
namespace CmiPayBundle\Controller;

......

class CmiPayController extends AbstractController
{
    public function requestPay(Request $request)
    {
        $params = new CmiPay();
        // Setup new payment parameters
        $okUrl = $this->generateUrl('cmi_pay_okFail', [], UrlGeneratorInterface::ABSOLUTE_URL);
        $shopUrl = $baseurl = $request->getScheme() . '://' . $request->getHttpHost() . $request->getBasePath();
        $failUrl = $this->generateUrl('cmi_pay_okFail', [], UrlGeneratorInterface::ABSOLUTE_URL);
        $callbackUrl = $this->generateUrl('cmi_pay_callback', [], UrlGeneratorInterface::ABSOLUTE_URL);
        $rnd = microtime();
	//Sample Order Data:
        $params->setGatewayurl('https://....')// Provided by CMI
            ->setclientid('600000000')// Provided by CMI
            ->setTel('05000000')
            ->setEmail('email@domaine.ma')
            ->setBillToName('BillToName')
            ->setBillToCompany('BillToCompany')
            ->setBillToStreet1('BillToStreet1')
            ->setBillToStateProv('BillToStateProv')
            ->setBillToPostalCode('BillToPostalCode')
	//.................
        ;
	//.................        
    }
}
```

The twig template:
```twig
// src/Resources/views/payrequest.html.twig
{% extends 'base.html.twig' %}

{% block title %}Hello {% endblock %}

{% block body %}

    <form name="payForm"  id="payForm" method="post" action="{{url}}">
        {% for name, value in data %}
            <input type="hidden" name="{{ name }}" value="{{ value }}" />
        {% endfor %}
    </form>

{% endblock %}
............
```

## Callback
The default route configured in:

```xml
// src/Resources/config/routes.xml
	<route id="cmi_pay_callback" controller="cmi.pay.controller::callback" path="/cmi/callback" />
```

And a controller action : Callback:

```php
namespace CmiPayBundle\Controller;

......

class CmiPayController extends AbstractController
{
..........
    public function callback(Request $request)
    {
        .......
    }
}
```

The twig template:
```twig
// src/Resources/views/callback.html.twig
{{response}} 
```
## OK / FAIL URL
The default route configured in:

```xml
// src/Resources/config/routes.xml
	<route id="cmi_pay_okFail" controller="cmi.pay.controller::okFail" path="/cmi/okFail" />
```

And a controller action : Callback:

```php
namespace CmiPayBundle\Controller;

......

class CmiPayController extends AbstractController
{
..........
    public function okFail(Request $request)
    {
        ........
    }
}
```

The twig template:
```twig
// src/Resources/views/okFail.html.twig
{{response}}
```