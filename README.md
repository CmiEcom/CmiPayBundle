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
		    ->setclientid('600000000')
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