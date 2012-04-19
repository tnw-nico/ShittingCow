<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Twitter OAuth library.
 * Sample controller.
 * Requirements: enabled Session library, enabled URL helper
 */

class Twitter extends CI_Controller
{
	/**
	 * TwitterOauth class instance.
	 */
	private $connection;
	
	/**
	 * Controller constructor
	 */
	function __construct()
	{
		parent::__construct();
		// Loading TwitterOauth library. Delete this line if you choose autoload method.
		$this->load->library('twitteroauth');

		// Loading twitter configuration.
		$this->config->load('twitter');
		$this->load->library('session');

		if($this->session->userdata('access_token') && $this->session->userdata('access_token_secret'))
		{
			// If user already logged in
			$this->connection = $this->twitteroauth->create($this->config->item('twitter_consumer_token'), $this->config->item('twitter_consumer_secret'), $this->session->userdata('access_token'),  $this->session->userdata('access_token_secret'));
		}
		elseif($this->session->userdata('request_token') && $this->session->userdata('request_token_secret'))
		{
			// If user in process of authentication
			$this->connection = $this->twitteroauth->create($this->config->item('twitter_consumer_token'), $this->config->item('twitter_consumer_secret'), $this->session->userdata('request_token'), $this->session->userdata('request_token_secret'));
		}
		else
		{
			// Unknown user
			$this->connection = $this->twitteroauth->create($this->config->item('twitter_consumer_token'), $this->config->item('twitter_consumer_secret'));
		}
	}
	
	/**
	 * Here comes authentication process begin.
	 * @access	public
	 * @return	void
	 */
	public function auth()
	{
		if($this->session->userdata('access_token') && $this->session->userdata('access_token_secret'))
		{
			// User is already authenticated. Add your user notification code here.
			redirect(base_url('/twitter/vote'));
		}
		else
		{
			// Making a request for request_token
			$request_token = $this->connection->getRequestToken(base_url('/twitter/callback'));
			$this->session->set_userdata('request_token', $request_token['oauth_token']);
			$this->session->set_userdata('request_token_secret', $request_token['oauth_token_secret']);
			
			if($this->connection->http_code == 200)
			{
				$url = $this->connection->getAuthorizeURL($request_token);
				redirect($url);
			}
			else
			{
				// An error occured. Make sure to put your error notification code here.
				redirect(base_url('/'));
			}
		}
	}
	
	/**
	 * Callback function, landing page for twitter.
	 * @access	public
	 * @return	void
	 */
	public function callback()
	{
		if($this->input->get('oauth_token') && $this->session->userdata('request_token') !== $this->input->get('oauth_token'))
		{
			$this->reset_session();
			redirect(base_url('/twitter/auth'));
		}
		else
		{
			$access_token = $this->connection->getAccessToken($this->input->get('oauth_verifier'));
			if ($this->connection->http_code == 200)
			{
				$this->session->set_userdata('access_token', $access_token['oauth_token']);
				$this->session->set_userdata('access_token_secret', $access_token['oauth_token_secret']);
				$this->session->set_userdata('twitter_user_id', $access_token['user_id']);
				$this->session->set_userdata('twitter_screen_name', $access_token['screen_name']);

				$this->session->unset_userdata('request_token');
				$this->session->unset_userdata('request_token_secret');
				
				redirect(base_url('/twitter/vote'));
			}
			else
			{
				// An error occured. Add your notification code here.
				redirect(base_url('/'));
			}
		}
	}
	
	
	
	/**
	 * Reset session data
	 * @access	private
	 * @return	void
	 */
	public function reset_session()
	{
		$this->session->unset_userdata('access_token');
		$this->session->unset_userdata('access_token_secret');
		$this->session->unset_userdata('request_token');
		$this->session->unset_userdata('request_token_secret');
		$this->session->unset_userdata('twitter_user_id');
		$this->session->unset_userdata('twitter_screen_name');
	
	}

	public function vote() {

		$message = "hi there " . time();
		if(!$message || mb_strlen($message) > 140 || mb_strlen($message) < 1)
		{
			// Restrictions error. Notification here.
			redirect(base_url('/'));
		}
		else
		{
			if($this->session->userdata('access_token') && $this->session->userdata('access_token_secret'))
			{
				$content = $this->connection->get('account/verify_credentials');
				if(isset($content->error))
				{
					// Most probably, authentication problems. Begin authentication process again.
					$this->reset_session();
					redirect(base_url('/twitter/auth'));
				}
				else
				{
					$this->load->model('vote_model');

					$votes = $this->session->userdata('votes');


					$tweet = $this->vote_model->create_tweet($votes);



					$options = array(
					"My Dungville predictions are: " . $tweet . " dungville.com #klara",
					"Just convinced #klara to start following " . $tweet . " dungville.com",
					"I'm guessing #klara will like " . $tweet . " dungville.com",
					"I think #klara has a thing for " . $tweet . " dungville.com",
					"Guess what? #klara is also a big fan of " . $tweet . " dungville.com"
					);

					shuffle($options);
					$data = array(
						'status' => $options[0]
					);

					$result = $this->connection->post('statuses/update', $data);
					$this->load->model('user_model');
					$result = ($this->user_model->save_social_user('twitter', $result->user->id, (array)$result));
					if ($result !== false) {
						if ($this->vote_model->save_votes($votes, $result) === TRUE) {
							$call = "twitter_vote_success()";
						} else {
							$call = "twitter_vote_failed()";
						}
					} else {
						$call = "twitter_vote_failed()";
					}
				}
			}
			else
			{
				// User is not authenticated.
				redirect(base_url('/twitter/auth'));
			}
		}
		$this->view_vars['call'] = $call;

		//echo $call;
		//exit();
		$this->layout_vars['content'] = $this->load->view('twitter/vote', $this->view_vars, true);
		$this->load->view('twitter/vote', $this->layout_vars);
	}

	function test() {
		$this->load->model('vote_model');
		//debug($this->vote_model->create_tweet(array(1,2,3)));
		//
		//
		//$this->session->set_userdata('votes', array(1,2,3));

		//var_dump($this->session->userdata('votes'));
		//var_dump($this->vote_model->create_tweet($this->session->userdata('votes')));
		debug($this->session);
	}
}

/* End of file twitter.php */
/* Location: ./application/controllers/twitter.php */