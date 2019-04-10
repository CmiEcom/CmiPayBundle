<?php

namespace CmiPayBundle\Controller;

use CmiPayBundle\CmiPay;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

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
        $params->setGatewayurl('https://testpayment.cmi.co.ma/fim/est3Dgate')
		    ->setclientid('600000000')
            ->setTel('05000000')
            ->setEmail('email@domaine.ma')
            ->setBillToName('BillToName')
            ->setBillToCompany('BillToCompany')
            ->setBillToStreet1('BillToStreet1')
            ->setBillToStateProv('BillToStateProv')
            ->setBillToPostalCode('BillToPostalCode')
            ->setBillToCity('BillToCity')
            ->setBillToCountry('MA')
            ->setOid('12345ABCD')
            ->setCurrency('504')
            ->setAmount('31.50')
            ->setOkUrl($okUrl)
            ->setCallbackUrl($callbackUrl)
            ->setFailUrl($failUrl)
            ->setShopurl($shopUrl)
            ->setEncoding('UTF-8')
            ->setStoretype('3D_PAY_HOSTING')
            ->setHashAlgorithm('ver3')
            ->setTranType('PreAuth')
            ->setRefreshtime('5')
            ->setLang('fr')
            ->setRnd($rnd)
        ;  
        $data = $this->convertData($params);
        $hash =  $this->hashValue($data);
        $data['HASH']=$hash;
        $data = $this->unsetData($data);
        return $this->render('@CmiPay/payrequest.html.twig', [
            'data' => $data,
            'url' => $params->getGatewayurl()
        ]);
    }
    public function okFail(Request $request)
    {
        $postData = $request->request->all();
        if( $postData){
            $actualHash = $this->hashValue($postData);
            $retrievedHash = $postData["HASH"];
            if($retrievedHash == $actualHash && $postData["ProcReturnCode"] == "00" )	{
                $response = "HASH is successfull";	
            }else {
                $response = "Security Alert. The digital signature is not valid";
            }
        } else {
            $response = "No Data POST";
        }		
        return $this->render('@CmiPay/okFail.html.twig', [
            "response" => $response
        ]);
    }
    public function callback(Request $request)
    {
        $postData = $request->request->all();
        if( $postData){
        $actualHash = $this->hashValue($postData);
        $retrievedHash = $postData["HASH"];
            if($retrievedHash == $actualHash && $_POST["ProcReturnCode"] == "00" )	{
                $response = "ACTION=POSTAUTH";	
            }else {
                $response = "APPROVED";
            }
        } else {
            $response = "No Data POST";
        }		
        
        return $this->render('@CmiPay/callback.html.twig', [
            "response" => $response
        ]);
    }
    public function hashValue($data)
    {
        $params = new CmiPay();
        $params->setSecretKey('TEST1234');
        $storeKey = $params->getSecretKey('TEST1234');
        $data = $this->unsetData($data);
        $postParams = array();
        foreach ($data as $key => $value){
            array_push($postParams, $key);
        }			
			natcasesort($postParams);		
			
			$hashval = "";					
			foreach ($postParams as $param){
                $paramValue = trim(html_entity_decode(preg_replace("/\n$/","",$data[$param]), ENT_QUOTES, 'UTF-8')); 				
                $escapedParamValue = str_replace("|", "\\|", str_replace("\\", "\\\\", $paramValue));	
				$escapedParamValue = preg_replace('/document(.)/i', 'document.', $escapedParamValue);	
					
				$lowerParam = strtolower($param);
				if($lowerParam != "hash" && $lowerParam != "encoding" )	{
					$hashval = $hashval . $escapedParamValue . "|";
				}
			}
			
			
			$escapedStoreKey = str_replace("|", "\\|", str_replace("\\", "\\\\", $storeKey));	
            $hashval = $hashval . $escapedStoreKey;
			
			$calculatedHashValue = hash('sha512', $hashval);  
            $hash = base64_encode (pack('H*',$calculatedHashValue));
        
        return $hash;
    }
    public function convertData(CmiPay $params)
    {
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
        $jsonContent = $serializer->serialize($params, 'json');
        $data =  (array)  json_decode($jsonContent);
        foreach ($data as $key => $value){
            $data[$key] = trim(html_entity_decode($value));
        }
        return $data;
    }
    public function unsetData($data)
    {
        unset($data['gatewayurl'],  $data['secretKey']);
        return $data;
    }
}
