<?php
namespace Cmi\PayBundle;

class CmiPay { 
   /**
   * Gateway URL 
   *
   * @var string
   */
  private $gatewayurl;

  /**
   * Secret Key
   *
   * @var string
   */
  private $secretKey;

  
  // Customer fields
  /**
   * Merchant unique customer numeric id
   *
   * @var string
   */
  private $clientid;
  /**
   * Customer email address
   *
   * @var string
   */
  private $tel;
  /**
   * Customer phone
   *
   * @var string
   */
  private $email;
  /**
   * Customer name for shipping
   *
   * @var string
   */
  private $BillToName;
  /**
   * Customer company name for shipping
   *
   * @var string
   */
  private $BillToCompany;
  /**
   * Customer address for shipping
   *
   * @var string
   */
  private $BillToStreet1;
  /**
   * Customer state for shipping
   *
   * @var string
   */
  private $BillToStateProv;
  /**
   * Customer ZIP Code for shipping
   *
   * @var string
   */
  private $BillToPostalCode;
  /**
   * Customer city for shipping
   *
   * @var string
   */
  private $BillToCity;
  /**
   * Customer country for shipping
   *
   * @var string
   */
  private $BillToCountry;

  // Order Fields
  /**
   * Merchant internal unique order ID
   *
   * @var string
   */
  private $oid;
  /**
   * Currency for the current order
   *
   * @var string
   */
  private $currency;
  /**
   * The transaction amount
   *
   * @var float
   */
  private $amount;

  // Template and Control Fields
  /**
   * The URL where to redirect the customer after the transaction processing
   *
   * @var string
   */
  private $okUrl ;

  /**
   * A URL that will be notified of the status of the transaction
   *
   * @var string
   */
  private $callbackUrl;
  /**
   * The URL where to redirect the customer after the payment failed
   *
   * @var string
   */
  private $failUrl;
  /**
   * The URL where to redirect the customer after click on cancel button
   *
   * @var string
   */
  private $shopurl;
  /**
   * Encoding 
   *
   * @var string
   */
  private $Encoding;
  /**
   * storetype 
   *
   * @var string
   */
  private $storetype;
  /**
   * TranType 
   *
   * @var string
   */
  private $TranType;
  /**
   * refreshtime 
   *
   * @var string
   */
  private $refreshtime;
  /**
   * hashAlgorithm 
   *
   * @var string
   */
  private $hashAlgorithm;
  /**
   * lang 
   *
   * @var string
   */
  private $lang;
  /**
   * timestamp
   *
   * @var string
   */
  private $rnd;
  
  public function getGatewayurl() {
    return $this->gatewayurl;
  }

  public function setGatewayurl($gatewayurl) {
    $this->gatewayurl = $gatewayurl;
    return ($this);
  }
  
  public function getSecretKey() {
    return $this->secretKey;
  }

  public function setSecretKey($secretKey) {
    $this->secretKey = $secretKey;
    return ($this);
  }

  public function getclientid() {
    return $this->clientid;
  }

  public function setclientid($clientid) {
    $this->clientid = $clientid;
    return ($this);
  }

  public function getTel() {
    return $this->tel;
  }

  public function setTel($tel) {
    $this->tel = $tel;
    return ($this);
  }

  public function getEmail() {
    return $this->email;
  }
  public function setEmail($email) {
    $this->email = $email;
    return ($this);
  }
  public function getBillToName() {
    return $this->BillToName ;
  }
  public function setBillToName($BillToName) {
    $this->BillToName = $BillToName;
    return ($this);
  }
  public function getBillToCompany() {
    return $this->BillToCompany;
  }
  public function setBillToCompany($BillToCompany) {
    $this->BillToCompany = $BillToCompany;
    return ($this);
  }
  public function getBillToStreet1() {
    return  $this->BillToStreet1;
  }
  public function setBillToStreet1($BillToStreet1) {
    $this->BillToStreet1 = $BillToStreet1;
    return ($this);
  }
  public function getBillToStateProv() {
    return $this->BillToStateProv;
  }
  public function setBillToStateProv($BillToStateProv) {
    $this->BillToStateProv = $BillToStateProv;
    return ($this);
  }
  
  public function getBillToPostalCode() {
    return $this->BillToPostalCode;
  }
  public function setBillToPostalCode($BillToPostalCode) {
   $this->BillToPostalCode = $BillToPostalCode;
    return ($this);
  }
  public function getBillToCity() {
    return  $this->BillToCity;
  }
  public function setBillToCity($BillToCity) {
    $this->BillToCity = $BillToCity;
    return ($this);
  }
  public function getBillToCountry() {
    return  $this->BillToCountry;
  }
  public function setBillToCountry($BillToCountry) {
    $this->BillToCountry = $BillToCountry;
    return ($this);
  }
  public function getOid() {
    return  $this->oid;
  }
  public function setOid($oid) {
    $this->oid = $oid;
    return ($this);
  }
  public function getCurrency() {
    return  $this->currency;
  }
  public function setCurrency($currency) {
    $this->currency = $currency;
    return ($this);
  }
  public function getAmount() {
    return  $this->amount;
  }
  public function setAmount($amount) {
    $this->amount = $amount;
    return ($this);
  }
  public function getOkUrl() {
    return  $this->okUrl;
  }
  public function setOkUrl($okUrl) {
    $this->okUrl = $okUrl;
    return ($this);
  }
  public function getCallbackUrl() {
    return  $this->callbackUrl;
  }
  public function setCallbackUrl($callbackUrl) {
    $this->callbackUrl = $callbackUrl;
    return ($this);
  }
  public function getFailUrl() {
    return  $this->failUrl;
  }
  public function setFailUrl($failUrl) {
    $this->failUrl = $failUrl;
    return ($this);
  }
  public function getShopurl() {
    return  $this->shopurl;
  }
  public function setShopurl($shopurl) {
    $this->shopurl = $shopurl;
    return ($this);
  }
  public function getRnd() {
    return  $this->rnd;
  }
  public function setRnd($rnd) {
    $this->rnd = $rnd;
    return ($this);
  }
  public function getEncoding() {
    return  $this->Encoding;
  }
  public function setEncoding($Encoding) {
    $this->Encoding = $Encoding;
    return ($this);
  }
  public function getStoretype() {
    return  $this->storetype;
  }
  public function setStoretype($storetype) {
    $this->storetype = $storetype;
    return ($this);
  }
  public function getTranType() {
    return  $this->TranType;
  }
  public function setTranType($TranType) {
    $this->TranType = $TranType;
    return ($this);
  }
  public function getRefreshtime() {
    return  $this->refreshtime;
  }
  public function setRefreshtime($refreshtime) {
    $this->refreshtime = $refreshtime;
    return ($this);
  }
  public function getHashAlgorithm() {
    return  $this->hashAlgorithm;
  }
  public function setHashAlgorithm($hashAlgorithm) {
    $this->hashAlgorithm = $hashAlgorithm;
    return ($this);
  }
  public function getLang() {
    return  $this->lang;
  }
  public function setLang($lang) {
    $this->lang = $lang;
    return ($this);
  }
}