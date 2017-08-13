<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Facebook {

	 /**
     * @var FB
     */
    private $fb;

    /**
     * @var FacebookRedirectLoginHelper|FacebookCanvasHelper|FacebookJavaScriptHelper|FacebookPageTabHelper
     */
    private $helper;


    public function __construct()
    {

    	// Load config
        $this->load->config('facebook');

		$this->fb = new Facebook\Facebook([
		  'app_id' => $this->config->item('facebook_app_id'), // Replace {app-id} with your app id
		  'app_secret' => $this->config->item('facebook_app_secret'),
		  'default_graph_version' => $this->config->item('facebook_graph_version'),
		  ]);



    }

    public function __get($var)
    {
        return get_instance()->$var;
    }

    /**
     * @return FB
     */
    public function object()
    {
        return $this->fb;
    }

    public function request($method, $endpoint, $params = [], $access_token = null)
    {
        try
        {
            $response = $this->fb->{strtolower($method)}($endpoint, $params, $access_token);
            return $response->getDecodedBody();
        }
        catch(FacebookResponseException $e)
        {
            return $this->logError($e->getCode(), $e->getMessage());
        }
        catch (FacebookSDKException $e)
        {
            return $this->logError($e->getCode(), $e->getMessage());
        }
    }

    /**
     * Generate Facebook login url for Facebook Redirect Login (web)
     *
     * @return  string
     */
    public function login_url()
    {

    	$this->helper = $this->fb->getRedirectLoginHelper();

        return $this->helper->getLoginUrl(
            base_url() . $this->config->item('facebook_login_redirect_url'),
            $this->config->item('facebook_permissions')
        );
    }

    public function js_login_callback()
    {

		$this->helper = $this->fb->getJavaScriptHelper();

		try {
		  $accessToken = $this->helper->getAccessToken();
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
		  // When Graph returns an error
		  echo 'Graph returned an error: ' . $e->getMessage();
		  exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
		  // When validation fails or other local issues
		  echo 'Facebook SDK returned an error: ' . $e->getMessage();
		  exit;
		}

        // long token 
		$longToken = $this->_long_live_token($accessToken);

        return $longToken;
    }

    private function _long_live_token($shortToken)
    {
		# v5
		$client = $this->fb->getOAuth2Client();

		try {
		  // Returns a long-lived access token
		  $longToken = $client->getLongLivedAccessToken($shortToken);
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
		  // There was an error communicating with Graph
		  echo $e->getMessage();
		  exit;
		}

		return $longToken;
    }

    private function is_long_live_still_valid()
    {

    }



}


?>