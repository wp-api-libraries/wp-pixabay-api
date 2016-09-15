<?php
/**
 * WP Pixabay API (https://pixabay.com/api/docs/)
 *
 * @package WP-Pixabay-API
 */

/* Exit if accessed directly */
if ( ! defined( 'ABSPATH' ) ) { exit; }

/* Check if class exists. */
if ( ! class_exists( 'PixabayAPI' ) ) {


	/**
	 * PixabayAPI class.
	 */
	class PixabayAPI {

		 /**
		 * API Key.
		 *
		 * @var string
		 */
		static private $api_key;

		/**
		 * URL to the API.
		 *
		 * @var string
		 */
		private $base_uri = 'https://pixabay.com/api/';

		 /**
		 * __construct function.
		 *
		 * @access public
		 * @param mixed $api_key API Key.
		 * @return void
		 */
		public function __construct( $api_key ) {

			static::$api_key = $api_key;

		}

		/**
		 * Fetch the request from the API.
		 *
		 * @access private
		 * @param mixed $request Request URL.
		 * @return $body Body.
		 */
		private function fetch( $request ) {

			$request .= '?key=' .static::$api_key;

			$response = wp_remote_get( $request );
			$code = wp_remote_retrieve_response_code( $response );

			if ( 200 !== $code ) {
				return new WP_Error( 'response-error', sprintf( __( 'Server response code: %d', 'text-domain' ), $code ) );
			}

			$body = wp_remote_retrieve_body( $response );

			return json_decode( $body );

		}

		/**
		 * search_images function.
		 *
		 * @access public
		 * @param mixed $q
		 * @param mixed $lang
		 * @param mixed $id
		 * @param mixed $response_group
		 * @param mixed $image_type
		 * @param mixed $orientation
		 * @param mixed $category
		 * @param mixed $min_width
		 * @param mixed $min_height
		 * @param mixed $editors_choice
		 * @param mixed $safesearch
		 * @param mixed $order
		 * @param mixed $page
		 * @param mixed $per_page
		 * @param mixed $callback
		 * @param mixed $pretty
		 * @return void
		 */
		public function search_images( $q, $lang, $id, $response_group, $image_type, $orientation, $category, $min_width, $min_height, $editors_choice, $safesearch, $order, $page, $per_page, $callback, $pretty ) {

			$request = $this->base_uri;
			return $this->fetch( $request );

		}

		/**
		 * search_videos function.
		 *
		 * @access public
		 * @param mixed $q
		 * @param mixed $lang
		 * @param mixed $id
		 * @param mixed $video_type
		 * @param mixed $category
		 * @param mixed $min_width
		 * @param mixed $min_height
		 * @param mixed $editors_choice
		 * @param mixed $safesearch
		 * @param mixed $order
		 * @param mixed $page
		 * @param mixed $per_page
		 * @param mixed $callback
		 * @param mixed $pretty
		 * @return void
		 */
		public function search_videos( $q, $lang, $id, $video_type, $category, $min_width, $min_height, $editors_choice, $safesearch, $order, $page, $per_page, $callback, $pretty ) {

			$request = $this->base_uri . 'videos/';
			return $this->fetch( $request );
		}


		// TODO - Add Response Key with Descriptions.

	}

}
