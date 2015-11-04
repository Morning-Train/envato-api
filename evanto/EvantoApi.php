<?php
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class EvantoApi{

	protected $api_token = '';
	
	protected $client;

	public function __construct($api_token) {
		$this->api_token = $api_token;
		$this->client = new Client([
			'base_uri' => 'https://api.envato.com/'
			]);		
	}


	private function GET($endpoint, $query = []){
		try {
			$response = $this->client->request('GET', $endpoint,[
				'query' => $query,
				'headers' => [
					'Authorization' => 'Bearer '.$this->api_token]
				]);
			return $this->checkResponse($response);
		} catch (ClientException $e) {
			echo '<h1>Error!!!</h1>';
			echo '<h3>Message:</h3>';
			echo $e->getMessage();
			echo '<h3>Request Uri:</h3>';
			echo $e->getRequest()->getUri();
			echo '<h3>Response body:</h3>';
			echo $e->getResponse()->getBody();
		}
	}

	private function checkResponse($response) {
		$success = [200, 201];
		$statusCode = $response->getStatusCode();
		if(in_array($statusCode, $success)) {
			$data = json_decode($response->getBody());
			if(is_object($data) && isset($data->data)){
				$data = $data->data;
			}
			return $data;
		}
		return false;
	}

	public function getItems ( $query = []) {
		return $this->GET('v1/discovery/search/search/item',  $query);
	}

	public function getComments ( $query = []) {
		return $this->GET('v1/discovery/search/search/comment',  $query);
	}

	public function getMoreLikeThis ( $query = []) {
		return $this->GET('v1/discovery/search/search/more_like_this',  $query);
	}

	public function getActiveThreads ($site) {
		return $this->GET('v1/market/active-threads:'.$site.'.json');
	}

	public function getNumberOfFiles ($site) {
		return $this->GET('v1/market/number-of-files:'.$site.'.json');
	}

	public function getForumPosts ($username) {
		return $this->GET('v1/market/forum_posts:'.$username.'.json');
	}

	public function getThreadStatus ($threadId) {
		return $this->GET('v1/market/thread-status:'.$threadId.'.json');
	}

	public function getTotalUsers () {
		return $this->GET('v1/market/total-users.json');
	}

	public function getTotalItems () {
		return $this->GET('v1/market/total-items.json');
	}

	public function getItemPrices ($itemId) {
		return $this->GET('v1/market/item-prices:'.$itemId.'.json');
	}

	public function getUser ($username) {
		return $this->GET('v1/market/user:'.$username.'.json');
	}

	public function getUserItemsBySite ($username) {
		return $this->GET('v1/market/user-items-by-site:'.$username.'.json');
	}

	public function getPopular ($site) {
			return $this->GET('v1/market/popular:'.$site.'.json');
	}

	public function getCategories ($site) {
		return $this->GET('v1/market/categories'.$site.'.json');
	}

	public function getFeatures ($site) {
		return $this->GET('v1/market/features:'.$site.'.json');
	}

	public function getNewFiles ($site, $category) {
		return $this->GET('v1/market/new-files:'.$site.','.$category.'.json');
	}

	public function getNewFilesFromUser ($username, $site) {
		return $this->GET('v1/market/new-files-from-user:'.$username.','.$site.'.json');
	}

	public function getRandomNewFiles ($site) {
		return $this->GET('v1/market/random-new-files:'.$site.'.json');
	}

	public function getUserBadges ($username) {
		return $this->GET('v1/market/user-badges:'.$username.'.json');
	}

	public function getEarningsAndSalesByMonth () {
		return $this->GET('v1/market/private/user/earnings-and-sales-by-month.json');
	}

	public function getPrivateStatements () {
		return $this->GET('v1/market/private/user/statement.json');
	}

	public function getPrivateDownloadPurshases ($purchaseCode) {
		return $this->GET('v1/market/private/user/download-purchase:'.$purchaseCode.'.json');
	}

	public function getPrivateAccount () {
		return $this->GET('v1/market/private/user/account.json');
	}

	public function getPrivateUsername () {
		return $this->GET('v1/market/private/user/username.json');
	}

	public function getPrivateEmail () {
		return $this->GET('v1/market/private/user/email.json');
	}

	public function getAuthorSale ($code) {
		$query = ['code' => $code];
		return $this->GET('v2/market/author/sale',  $query);
	}

	public function getAuthorSales ($page) {
		$query = ['page' => $page];
		return $this->GET('v2/market/author/sales',  $query);
	}

	public function getBuyerDownload ( $query = []) {
		return $this->GET('v2/market/buyer/download',  $query);
	}

	public function getBuyerPurchase ( $query = []) {
		return $this->GET('v2/market/buyer/purchase',  $query);
	}

	public function getBuyerPurchases ($page) {
		$query = ['page' => $page];
		return $this->GET('v2/market/buyer/purchases',  $query);
	}

	public function getCatalogCollection ($id) {
		$query = ['id' => $id];
		return $this->GET('v2/market/catalog/collection',  $query);
	}

	public function getCatalogItem ($id) {
		$query = ['id' => $id];
		return $this->GET('v2/market/catalog/item',  $query);
	}

	public function getUserCollection ($id) {
		$query = ['id' => $id];
		return $this->GET('v2/market/user/collection',  $query);
	}

	public function getUserCollections () {
		return $this->GET('v2/market/user/collections');
	}

}
