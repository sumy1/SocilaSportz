<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter Linked API Class
 *
 *
 * @package         CodeIgniter
 * @subpackage      Libraries
 * @category        Libraries
 * @author          Muhamamd Hafeez
 */
class Linkedin {

    function __construct(){
		// Load fb config
    }

    public function getAuthorizationCode() {
		$CI =& get_instance();
		$CI->load->config('linkedin');
        $params = array(
			'response_type' => $CI->config->item('response_type'),
            'client_id' => $CI->config->item('client_id'),
            'scope' => $CI->config->item('scope'),
            'state' => $CI->config->item('state'), // unique long string
            'redirect_uri' => $CI->config->item('redirect_uri'),
        );
        // Authentication request
        $url = 'https://www.linkedin.com/uas/oauth2/authorization?' . http_build_query($params);

        // Needed to identify request when it returns to us
        $_SESSION['state'] = $params['state'];

        // Redirect user to authenticate
        header("Location: $url");
        exit;
    }

     public function getAccessToken() {
		 $CI =& get_instance();
		$CI->load->config('linkedin');
        $params = array(
			'grant_type' => $CI->config->item('grant_type'),
            'client_id' => $CI->config->item('client_id'),
            'client_secret' => $CI->config->item('client_secret'),
            'code' => $_GET['code'],
            'redirect_uri' => $CI->config->item('redirect_uri'),
        );
        // Access Token request
        $url = 'https://www.linkedin.com/uas/oauth2/accessToken?' . http_build_query($params);
		
        // Tell streams to make a POST request
        $context = stream_context_create(
                array('http' =>
                    array('method' => 'POST',
                    )
                )
        );

        // Retrieve access token information
        $response = file_get_contents($url,false,$context);
		// Native PHP object, please
        $token = json_decode($response);
		// Store access token and expiration time
        $_SESSION['access_token'] = $token->access_token; // guard this! 
        $_SESSION['expires_in'] = $token->expires_in; // relative time (in seconds)
        $_SESSION['expires_at'] = time() + $_SESSION['expires_in']; // absolute time
        return true;
    }

    public function fetch($method, $resource, $body = '') {
        $params = array('oauth2_access_token' => $_SESSION['access_token'],
            'format' => 'json',
        );

        // Need to use HTTPS
        $url = 'https://api.linkedin.com' . $resource . '?' . http_build_query($params);
        // Tell streams to make a (GET, POST, PUT, or DELETE) request
        $context = stream_context_create(
                array('http' =>
                    array('method' => $method,
                    )
                )
        );


        // Hocus Pocus
        $response = file_get_contents($url, false, $context);

        // Native PHP object, please
        return json_decode($response);
    }
	
	public function generateAuthorizeUrl(){
		return base_url('account/linkedin/profile');
	}

}

/* End of file Linked.php */
/* Location: ./application/libraries/linkedin.php */