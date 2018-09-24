<?php
namespace MorningTrain\EnvatoApi;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class EnvatoApi{

	protected $api_token = '';
	
	protected $client;

	public function __construct($api_token) {
		$this->api_token = $api_token;
		$this->client = new Client([
			'base_uri' => 'https://api.envato.com/'
			]);		
	}


	protected function GET($endpoint, $query = []){
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

	protected function checkResponse($response) {
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

	/**
	 * Search for items
	 * @param  array  $query The query string containing the search parameters
	 * @return string        json containing the search results 
	 */
	public function getItems ( $query = []) {
		return $this->GET('v1/discovery/search/search/item',  $query);
	}

	/**
	 * Search for comments
	 * @param  array  $query The query string containing the search parameters
	 * @return string        json containing the search results 
	 */
	public function getComments ( $query = []) {
		return $this->GET('v1/discovery/search/search/comment',  $query);
	}

	/**
	 * Search for similar items
	 * @param  array  $query The query string containing the search parameters
	 * @return string        json containing the search results 
	 */
	public function getMoreLikeThis ( $query = []) {
		return $this->GET('v1/discovery/search/search/more_like_this',  $query);
	}

	/**
	 * Get threads with the most recent messages activity.
	 * @param  string $site 
	 * @return string        json containing the search results 
	 */
	public function getActiveThreads ($site) {
		return $this->GET('v1/market/active-threads:'.$site.'.json');
	}

	/**
	 * Shows the number of files in the major categories of a particular site.
	 * @param  string $site 
	 * @return string        json containing the search results 
	 */
	public function getNumberOfFiles ($site) {
		return $this->GET('v1/market/number-of-files:'.$site.'.json');
	}

	/**
	 * Returns a list of the latest forum messages for the user.
	 * @param  string $username 
	 * @return string json containing the search results 
	 */
	public function getForumPosts ($username) {
		return $this->GET('v1/market/forum_posts:'.$username.'.json');
	}

	/**
	 * Details of a single thread
	 * @param  integer $threadId
	 * @return string  json containing the search results 
	 */
	public function getThreadStatus ($threadId) {
		return $this->GET('v1/market/thread-status:'.$threadId.'.json');
	}

	/**
	 * Shows the total number of subscribed users to Envato Market
	 * @return string   json containing the result
	 */
	public function getTotalUsers () {
		return $this->GET('v1/market/total-users.json');
	}

	/**
	 * Shows the total number of items available on Envato Market
	 * @return string  json containing the result
	 */
	public function getTotalItems () {
		return $this->GET('v1/market/total-items.json');
	}

	/**
	 * Return available licenses and prices for the given item ID
	 * @param  integer $itemId item id
	 * @return string  json containing the search results 
	 */
	public function getItemPrices ($itemId) {
		return $this->GET('v1/market/item-prices:'.$itemId.'.json');
	}

	/**
	 * Shows username, country, number of sales, number of followers, location and image for a user. 
	 * @param  string $username
	 * @return string  json containing details about the user account
	 */
	public function getUser ($username) {
		return $this->GET('v1/market/user:'.$username.'.json');
	}

	/**
	 * Show the number of items an author has for sale on each site
	 * @param  string $username
	 * @return string  json containing the number of items
	 */
	public function getUserItemsBySite ($username) {
		return $this->GET('v1/market/user-items-by-site:'.$username.'.json');
	}

	/**
	 * Returns the popular files for a particular site
	 * @param  string $site 
	 * @return string  json containing the popular files of the given site
	 */
	public function getPopular ($site) {
			return $this->GET('v1/market/popular:'.$site.'.json');
	}

	/**
	 * Lists the categories of a particular site
	 * @param  string $site
	 * @return string  json containing gategories list
	 */
	public function getCategories ($site) {
		return $this->GET('v1/market/categories:'.$site.'.json');
	}

	/**
	 * Shows the current site features.
	 * @param  string $site
	 * @return string  json containing a list of features
	 */
	public function getFeatures ($site) {
		return $this->GET('v1/market/features:'.$site.'.json');
	}

	/**
	 * New files, recently uploaded to a particular site
	 * @param  string $site     
	 * @param  string $category 
	 * @return string json containing a list of the new files
	 */
	public function getNewFiles ($site, $category) {
		return $this->GET('v1/market/new-files:'.$site.','.$category.'.json');
	}

	/**
	 * Shows the newest 25 files a user has uploaded to a particular site
	 * @param  string $username
	 * @param  string $site     
	 * @return string json containing a list of the last 25 files
	 */
	public function getNewFilesFromUser ($username, $site) {
		return $this->GET('v1/market/new-files-from-user:'.$username.','.$site.'.json');
	}

	/**
	 * Shows a random list of newly uploaded files from a particular site (i.e. like the homepage)
	 * @param  string $site
	 * @return string json containing a list of files
	 */
	public function getRandomNewFiles ($site) {
		return $this->GET('v1/market/random-new-files:'.$site.'.json');
	}

	/**
	 * Shows a list of badges for the given user
	 * @param  string $username 
	 * @return string json containing a list of badges
	 */
	public function getUserBadges ($username) {
		return $this->GET('v1/market/user-badges:'.$username.'.json');
	}

	/**
	 * Returns the monthly sales data, as displayed on the user's earnings page.
	 * @return string json containing the user earning
	 */
	public function getEarningsAndSalesByMonth () {
		return $this->GET('v1/market/private/user/earnings-and-sales-by-month.json');
	}

	/**
	 * Returns the last 100 events as seen on the user's statement page. Only shows data from the last 28 days.
	 * @return string json containing the current user statement
	 */
	public function getPrivateStatements () {
		return $this->GET('v1/market/private/user/statement.json');
	}

	/**
	 * URL to download an item you have purchased
	 * @param  string $purchaseCode
	 * @return string the download url
	 */
	public function getPrivateDownloadPurshases ($purchaseCode) {
		return $this->GET('v1/market/private/user/download-purchase:'.$purchaseCode.'.json');
	}

	/**
	 * Returns the first name, surname, earnings available to withdraw, total deposits, balance (deposits + earnings) and country.
	 * @return string json containing account details
	 */
	public function getPrivateAccount () {
		return $this->GET('v1/market/private/user/account.json');
	}

	/**
	 * Returns the currently logged in user's Envato Account username
	 * @return string username of the currently logged in user
	 */
	public function getPrivateUsername () {
		return $this->GET('v1/market/private/user/username.json');
	}

	/**
	 * Returns the currently logged in user's email address
	 * @return string the email address
	 */
	public function getPrivateEmail () {
		return $this->GET('v1/market/private/user/email.json');
	}

	/**
	 * Returns the details of an author's sale identified by the purchase code
	 * @param  string $code The unique code of the sale to return
	 * @return string json containing details about the sale
	 */
	public function getAuthorSale ($code) {
		$query = ['code' => $code];
		return $this->GET('v2/market/author/sale',  $query);
	}

	/**
	 * Lists all unrefunded sales of the authenticated user's items listed on Envato Market.
	 * @param  integer $page A page number to start the results from
	 * @return string json containing sales list
	 */
	public function getAuthorSales ($page) {
		$query = ['page' => $page];
		return $this->GET('v2/market/author/sales',  $query);
	}

	/**
	 * Download purchased items by either the item_id or the purchase_code. Each invokation of this endpoint will count against the items daily download limit.
	 * @param  array  $query The query string containing the search parameters
	 * @return string json containing a downloads list
	 */
	public function getBuyerDownload ( $query = []) {
		return $this->GET('v2/market/buyer/download',  $query);
	}

	/**
	 * Returns the details of a user's purchase identified by the purchase code
	 * @param  string $code The unique code of the purchase to return
	 * @return string json containing details about the purchase
	 */
	public function getBuyerPurchase ( $code) {
		$query = ['code' => $code];
		return $this->GET('v2/market/buyer/purchase',  $query);
	}

	/**
	 * Lists all purchases that the authenticated user has made of the app creator's listed items
	 * @param  integer $page A page number to start the results from
	 * @return string json that contains a list of purchases
	 */
	public function getBuyerPurchases ($page) {
		$query = ['page' => $page];
		return $this->GET('v2/market/buyer/purchases',  $query);
	}

	/**
	 * Returns details of, and items contained within, a public collection
	 * @param  integer $id The numeric ID of the collection to return
	 * @return string json that contains details about the collection
	 */
	public function getCatalogCollection ($id) {
		$query = ['id' => $id];
		return $this->GET('v2/market/catalog/collection',  $query);
	}

	/**
	 * Returns all details of a particular item on Envato Market
	 * @param  integer $id The numeric ID of the item to return
	 * @return string json containing details about the item
	 */
	public function getCatalogItem ($id) {
		$query = ['id' => $id];
		return $this->GET('v2/market/catalog/item',  $query);
	}

	/**
	 * Returns details and items for public or the user's private collections
	 * @param  integer $id The numeric ID of the collection to return
	 * @return string json containing the collection details
	 */
	public function getUserCollection ($id) {
		$query = ['id' => $id];
		return $this->GET('v2/market/user/collection',  $query);
	}

	/**
	 * Lists all of the user's private and public collections
	 * @return string json containing a list of the user's collections
	 */
	public function getUserCollections () {
		return $this->GET('v2/market/user/collections');
	}

}
