<?php

/**
 * PHP Wrapper for swiftintern api
 * @author Faizan Ayubi
 */
class Swiftintern {

	// Declaring class variables and arrays 
	public $source;
	private $baseUrl = "http://swiftintern.com/";
	
	/**
     * Construct method called on instantiation of object
     * @param string $url the url to be scraped
     */
	function __construct() {
		// Setting attribute
	}

    /**
     * Method for making a GET request using cURL
     * @param string $url the url to be scraped
     * @return string        results
     */
    public function curlGet($url) {
		$ch = curl_init(); // Initialising cURL session    
		// Setting cURL options
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);  // Returning transfer as a string    
    	curl_setopt($ch, CURLOPT_URL, $url);  // Setting URL    
    	$results = curl_exec($ch);  // Executing cURL session    
    	curl_close($ch);  // Closing cURL session
    	return $results;  // Return the results  
    }

    /**
     * Method to submit form using cURL POST method 
     * @param  string $postUrl       the url where we have to send request
     * @param  string $postFields    the parameters
     * @param  string $successString success string
     * @return string                final result
     */
    public function curlPost($postUrl, $postFields, $successString) {
    	$useragent = 'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10.5; en-US; rv:1.9.2.3) Gecko/20100401 Firefox/3.6.3';
    	// Setting user agent of a popular browser    
    	$cookie = 'cookie.txt';  // Setting a cookie file to store cookie    
    	$ch = curl_init();  // Initialising cURL session
    	// Setting cURL options  
    	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);  // Prevent cURL from verifying SSL certificate  
    	curl_setopt($ch, CURLOPT_FAILONERROR, TRUE);  // Script should fail silently on error  
    	curl_setopt($ch, CURLOPT_COOKIESESSION, TRUE);  // Use cookies  
    	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);  // Follow Location: headers  
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);  // Returning transfer as a string  
    	curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);  // Setting cookiefile  
    	curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);  // Setting cookiejar  
    	curl_setopt($ch, CURLOPT_USERAGENT, $useragent);  // Setting useragent  c
    	url_setopt($ch, CURLOPT_URL, $postUrl);  // Setting URL to POST to        
    	curl_setopt($ch, CURLOPT_POST, TRUE);  // Setting method as POST  
    	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postFields));  // Setting POST fields as array       
    	$results = curl_exec($ch);  // Executing cURL session  
    	curl_close($ch);  // Closing cURL session    
    	// Checking if login was successful by checking existence of string  
    	if (strpos($results, $successString)) {
    		return $results;
    	} else {
    		return FALSE;
    	}
    }

    public function build_url($param) {
    	return $this->baseUrl. $param .".json";
    }

    public function opportunityList() {
        $response = $this->curlGet($this->build_url("home"));
        return $response;
    }
}

?>