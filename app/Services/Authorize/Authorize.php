<?php namespace App\Services\Authorize;

class Authorize {

    /**
     * Authorize.com credentials
     *
     * @var array
     */
    protected $credentials;

    /**
     * @param Config $config
     * @param bool $test
     */
    public function __construct($test = false)
    {
        $config = new Config();
        $this->credentials = ( $test ? $config->getTestCredentials() : $config->getCredentials() );
    }

    /**
     * Retrieve Profile
     *
     * @param $customerProfileId
     * @return mixed
     */
    public function getProfile($customerProfileId)
    {
        //build xml to post
        $content =
            "<?xml version=\"1.0\" encoding=\"utf-8\"?>" .
            "<getCustomerProfileRequest xmlns=\"AnetApi/xml/v1/schema/AnetApiSchema.xsd\">" .
            $this->MerchantAuthenticationBlock().
            "<customerProfileId>$customerProfileId</customerProfileId>".
            "</getCustomerProfileRequest>";

        $response = $this->send_xml_request($content);
        $parsedresponse = $this->parse_api_response($response);

        return $parsedresponse->profile;
    }

    /**
     * Create Customer
     *
     * @param $description
     * @param null $merchantCustomerId
     * @return int
     */
    public function createProfile($description, $merchantCustomerId = null)
    {
        //build xml to post
        $content =
            "<?xml version=\"1.0\" encoding=\"utf-8\"?>" .
            "<createCustomerProfileRequest xmlns=\"AnetApi/xml/v1/schema/AnetApiSchema.xsd\">" .
            $this->MerchantAuthenticationBlock().
            "<profile>".
            "<merchantCustomerId>$merchantCustomerId</merchantCustomerId>". // Your own identifier for the customer.
            "<description>$description</description>".
            "</profile>".
            "</createCustomerProfileRequest>";

        $response = $this->send_xml_request($content);
        $parsedresponse = $this->parse_api_response($response);

        return ($parsedresponse->messages->resultCode == 'Ok' ? $parsedresponse->customerProfileId : 0);
    }

    /**
     * Delete Customer
     *
     * @param $customerProfileId
     * @return string
     */
    public function deleteProfile($customerProfileId)
    {
        //build xml to post
        $content =
            "<?xml version=\"1.0\" encoding=\"utf-8\"?>" .
            "<deleteCustomerProfileRequest xmlns=\"AnetApi/xml/v1/schema/AnetApiSchema.xsd\">" .
            $this->MerchantAuthenticationBlock().
            "<customerProfileId>$customerProfileId</customerProfileId>".
            "</deleteCustomerProfileRequest>";

        $response = $this->send_xml_request($content);
        $parsedresponse = $this->parse_api_response($response);

        return ($parsedresponse->messages->resultCode == 'Ok' ? 'Ok' : $parsedresponse->messages->message->text);
    }

    /**
     * Retrieve Credit Card
     *
     * @param $customerProfileId
     * @param $customerPaymentProfileId
     * @return mixed
     */
    public function getPaymentProfile($customerProfileId, $customerPaymentProfileId)
    {
        //build xml to post
        $content =
            "<?xml version=\"1.0\" encoding=\"utf-8\"?>" .
            "<getCustomerPaymentProfileRequest xmlns=\"AnetApi/xml/v1/schema/AnetApiSchema.xsd\">" .
            $this->MerchantAuthenticationBlock().
            "<customerProfileId>$customerProfileId</customerProfileId>".
            "<customerPaymentProfileId>$customerPaymentProfileId</customerPaymentProfileId>".
            "</getCustomerPaymentProfileRequest>";

        $response = $this->send_xml_request($content);
        $parsedresponse = $this->parse_api_response($response);
        return $parsedresponse->paymentProfile;
    }

    /**
     * Create Credit Card
     *
     * @param $post
     * @return int
     */
    public function createPaymentProfile($post)
    {
        // $post must be clean($_POST)

        if(isset($post['card_code']) and !empty($post['card_code']))
            $cardCode = "<cardCode>{$post['card_code']}</cardCode>";
        else
            $cardCode = '';


        $post['credit_card_number'] = str_replace(' ', '', $post['credit_card_number']);
        $post['credit_card_number'] = str_replace('-', '', $post['credit_card_number']);


        //build xml to post
        $content =
            "<?xml version=\"1.0\" encoding=\"utf-8\"?>" .
            "<createCustomerPaymentProfileRequest xmlns=\"AnetApi/xml/v1/schema/AnetApiSchema.xsd\">" .
            $this->MerchantAuthenticationBlock().
            "<customerProfileId>{$post['customer_profile_id']}</customerProfileId>".
            "<paymentProfile>".
            "<billTo>".
            "<firstName>{$post['first_name']}</firstName>".
            "<lastName>{$post['last_name']}</lastName>".
            "<company>{$post['company']}</company>".
            "<address>{$post['address']}</address>".
            "<city>{$post['city']}</city>".
            "<state>{$post['state']}</state>".
            "<zip>{$post['zip']}</zip>".
            "<country>{$post['country']}</country>".
            "<phoneNumber>{$post['phone']}</phoneNumber>".
            "</billTo>".
            "<payment>".
            "<creditCard>".
            "<cardNumber>{$post['credit_card_number']}</cardNumber>".
            "<expirationDate>{$post['expiration_date']}</expirationDate>".
            "$cardCode".
            "</creditCard>".
            "</payment>".
            "</paymentProfile>".
            "<validationMode>{$post['validation_mode']}</validationMode>".
            "</createCustomerPaymentProfileRequest>";

        $response = $this->send_xml_request($content);
        $parsedresponse = $this->parse_api_response($response);

        return ($parsedresponse->messages->resultCode == 'Ok' ? $parsedresponse->customerPaymentProfileId : 0);
    }

    /**
     * Edit Credit Card
     *
     * @param $post
     * @return string
     */
    public function editPaymentProfile($post)
    {
        // $post must be clean($_POST)

        $expirationDate = $post['expirationDate'];

        if( $expirationDate != 'XXXX' && strlen( str_replace('/','',$expirationDate) )==4 )
        {
            $expirationDate = str_replace('/', '', $expirationDate);
            $month = substr($expirationDate,0,2);
            $year = '20'.substr($expirationDate,2,3);
            $expirationDate = "$year-$month";
        }


        if(isset($post['cardCode']) and !empty($post['cardCode']))
            $cardCode = "<cardCode>{$post['cardCode']}</cardCode>";
        else
            $cardCode = '';


        $post['cardNumber'] = str_replace(' ', '', $post['cardNumber']);
        $post['cardNumber'] = str_replace('-', '', $post['cardNumber']);


        //build xml to post
        $content =
            "<?xml version=\"1.0\" encoding=\"utf-8\"?>" .
            "<updateCustomerPaymentProfileRequest xmlns=\"AnetApi/xml/v1/schema/AnetApiSchema.xsd\">" .
            $this->MerchantAuthenticationBlock().
            "<customerProfileId>{$post['customerProfileId']}</customerProfileId>".
            "<paymentProfile>".
            "<billTo>".
            "<firstName>{$post['firstName']}</firstName>".
            "<lastName>{$post['lastName']}</lastName>".
            "<company>{$post['company']}</company>".
            "<address>{$post['address']}</address>".
            "<city>{$post['city']}</city>".
            "<state>{$post['state']}</state>".
            "<zip>{$post['zip']}</zip>".
            "<country>{$post['country']}</country>".
            "<phoneNumber>{$post['phoneNumber']}</phoneNumber>".
            "</billTo>".
            "<payment>".
            "<creditCard>".
            "<cardNumber>{$post['cardNumber']}</cardNumber>".
            "<expirationDate>$expirationDate</expirationDate>".
            "$cardCode".
            "</creditCard>".
            "</payment>".
            "<customerPaymentProfileId>{$post['customerPaymentProfileId']}</customerPaymentProfileId>".
            "</paymentProfile>".
            "<validationMode>{$post['validationMode']}</validationMode>".
            "</updateCustomerPaymentProfileRequest>";

        $response = $this->send_xml_request($content);
        $parsedresponse = $this->parse_api_response($response);

        return ($parsedresponse->messages->resultCode == 'Ok' ? 'Ok' : $parsedresponse->messages->message->text);
    }

    /**
     * Delete Credit Card
     *
     * @param $customerProfileId
     * @param $customerPaymentProfileId
     * @return string
     */
    public function deletePaymentProfile($customerProfileId, $customerPaymentProfileId)
    {
        $content =
            "<?xml version=\"1.0\" encoding=\"utf-8\"?>" .
            "<deleteCustomerPaymentProfileRequest xmlns=\"AnetApi/xml/v1/schema/AnetApiSchema.xsd\">" .
            $this->MerchantAuthenticationBlock().
            "<customerProfileId>$customerProfileId</customerProfileId>".
            "<customerPaymentProfileId>$customerPaymentProfileId</customerPaymentProfileId>".
            "</deleteCustomerPaymentProfileRequest>";

        $response = $this->send_xml_request($content);
        $parsedresponse = $this->parse_api_response($response);

        return ($parsedresponse->messages->resultCode == 'Ok' ? 'Ok' : $parsedresponse->messages->message->text);
    }

    /**
     * Submit Payment
     *
     * @param $post
     * @return mixed
     */
    public function createTransaction($post)
    {
        // $post must be clean($_POST)

        $content =
            "<?xml version=\"1.0\" encoding=\"utf-8\"?>" .
            "<createCustomerProfileTransactionRequest xmlns=\"AnetApi/xml/v1/schema/AnetApiSchema.xsd\">" .
            $this->MerchantAuthenticationBlock().
            "<transaction>".
            "<profileTransAuthCapture>".
            "<amount>{$post['total_amount']}</amount>".
            "<customerProfileId>{$post['customerProfileId']}</customerProfileId>".
            "<customerPaymentProfileId>{$post['customerPaymentProfileId']}</customerPaymentProfileId>".
            "<order>".
            "<invoiceNumber>{$post['invoiceNumber']}</invoiceNumber>".
            "<description>{$post['description']}</description>".
            "</order>".
            "</profileTransAuthCapture>".
            "</transaction>".
            "</createCustomerProfileTransactionRequest>";

        $response = $this->send_xml_request($content);
        $parsedresponse = $this->parse_api_response($response);

        return $parsedresponse;
    }

    /**
     * Void Transaction
     *
     * @param $customerProfileId
     * @param $customerPaymentProfileId
     * @param $transId
     * @return string
     */
    public function voidTransaction($customerProfileId, $customerPaymentProfileId, $transId)
    {
        $content =
            "<?xml version=\"1.0\" encoding=\"utf-8\"?>" .
            "<createCustomerProfileTransactionRequest xmlns=\"AnetApi/xml/v1/schema/AnetApiSchema.xsd\">" .
            $this->MerchantAuthenticationBlock().
            "<transaction>".
            "<profileTransVoid>".
            "<customerProfileId>$customerProfileId</customerProfileId>".
            "<customerPaymentProfileId>$customerPaymentProfileId</customerPaymentProfileId>".
            "<transId>$transId</transId>".
            "</profileTransVoid>".
            "</transaction>".
            "</createCustomerProfileTransactionRequest>";

        $response = $this->send_xml_request($content);
        $parsedresponse = $this->parse_api_response($response);

        return ($parsedresponse->messages->resultCode == 'Ok' ? 'Ok' : $parsedresponse->messages->message->text);
    }

    /**
     * Convert XML file to array
     *
     * @param $xml
     * @return array
     */
    public function xml2array($xml)
    {
        $arr = array();

        foreach ($xml as $element)
        {
            $tag = $element->getName();
            $e = get_object_vars($element);
            if (!empty($e))
            {
                $arr[$tag] = $element instanceof \SimpleXMLElement ? $this->xml2array($element) : $e;
            }
            else
            {
                $arr[$tag] = trim($element);
            }
        }

        return $arr;
    }

    /**
     * Send xml request to Api.
     *
     * @param $content
     * @return mixed
     */
    private function send_xml_request($content)
    {
        return $this->send_request_via_fsockopen($this->credentials['g_apihost'],$this->credentials['g_apipath'],$content);
    }

    /**
     * Send xml request via fsockopen.
     * It is a good idea to check the http status code.
     *
     * @param $host
     * @param $path
     * @param $content
     * @return bool|string
     */
    private function send_request_via_fsockopen($host,$path,$content)
    {
        $posturl = "ssl://" . $host;
        $header = "Host: $host\r\n";
        $header .= "User-Agent: PHP Script\r\n";
        $header .= "Content-Type: text/xml\r\n";
        $header .= "Content-Length: ".strlen($content)."\r\n";
        $header .= "Connection: close\r\n\r\n";
        $fp = fsockopen($posturl, 443, $errno, $errstr, 30);
        if (!$fp)
        {
            $body = false;
        }
        else
        {
            error_reporting(E_ERROR);
            fputs($fp, "POST $path  HTTP/1.1\r\n");
            fputs($fp, $header.$content);
            fwrite($fp, $out);
            $response = "";
            while (!feof($fp))
            {
                $response = $response . fgets($fp, 128);
            }
            fclose($fp);
            error_reporting(E_ALL ^ E_NOTICE);

            $len = strlen($response);
            $bodypos = strpos($response, "\r\n\r\n");
            if ($bodypos <= 0)
            {
                $bodypos = strpos($response, "\n\n");
            }
            while ($bodypos < $len && $response[$bodypos] != '<')
            {
                $bodypos++;
            }
            $body = substr($response, $bodypos);
        }
        return $body;
    }

    /**
     * Send xml request via curl.
     *
     * @param $host
     * @param $path
     * @param $content
     * @return mixed
     */
    private function send_request_via_curl($host,$path,$content)
    {
        $posturl = "https://" . $host . $path;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $posturl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Content-Type: text/xml"));
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);
        return $response;
    }

    /**
     * Parse the api response
     * The code uses SimpleXML. http://us.php.net/manual/en/book.simplexml.php
     * There are also other ways to parse xml in PHP depending on the version and what is installed.
     *
     * @param $content
     * @return \SimpleXMLElement
     */
    private function parse_api_response($content)
    {
        $parsedresponse = simplexml_load_string($content, "SimpleXMLElement", LIBXML_NOWARNING);
        // if ("Ok" != $parsedresponse->messages->resultCode) {
        // 	echo "The operation failed with the following errors:<br>";
        // 	foreach ($parsedresponse->messages->message as $msg) {
        // 		echo "[" . htmlspecialchars($msg->code) . "] " . htmlspecialchars($msg->text) . "<br>";
        // 	}
        // 	echo "<br>";
        // }
        return $parsedresponse;
    }

    /**
     * Create xml merchant authentication
     *
     * @return string
     */
    private function MerchantAuthenticationBlock() {
        return
            "<merchantAuthentication>".
            "<name>" . $this->credentials['g_loginname'] . "</name>".
            "<transactionKey>" . $this->credentials['g_transactionkey'] . "</transactionKey>".
            "</merchantAuthentication>";
    }

}