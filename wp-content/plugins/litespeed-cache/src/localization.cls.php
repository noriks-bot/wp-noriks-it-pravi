<?php
<<<<<<< HEAD
// phpcs:ignoreFile

/**
 * The localization class.
 *
 * @since       3.3
=======
/**
 * The localization class.
 *
 * @since   3.3
 * @package LiteSpeed
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
 */

namespace LiteSpeed;

<<<<<<< HEAD
defined('WPINC') || exit();

=======
defined( 'WPINC' ) || exit();

/**
 * Localization - serve external resources locally.
 *
 * @since 3.3
 */
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
class Localization extends Base {

	const LOG_TAG = '🛍️';

	/**
	 * Init optimizer
	 *
	 * @since  3.0
	 * @access protected
	 */
	public function init() {
<<<<<<< HEAD
		add_filter('litespeed_buffer_finalize', array( $this, 'finalize' ), 23); // After page optm
=======
		add_filter( 'litespeed_buffer_finalize', [ $this, 'finalize' ], 23 ); // After page optm
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
	}

	/**
	 * Localize Resources
	 *
	 * @since  3.3
<<<<<<< HEAD
	 */
	public function serve_static( $uri ) {
		$url = base64_decode($uri);

		if (!$this->conf(self::O_OPTM_LOCALIZE)) {
			// wp_redirect( $url );
			exit('Not supported');
		}

		if (substr($url, -3) !== '.js') {
			// wp_redirect( $url );
			// exit( 'Not supported ' . $uri );
		}

		$match   = false;
		$domains = $this->conf(self::O_OPTM_LOCALIZE_DOMAINS);
		foreach ($domains as $v) {
			if (!$v || strpos($v, '#') === 0) {
=======
	 *
	 * @param string $uri Base64-encoded URL.
	 */
	public function serve_static( $uri ) {
		$url = base64_decode( $uri ); // phpcs:ignore WordPress.PHP.DiscouragedPHPFunctions.obfuscation_base64_decode

		if ( ! $this->conf( self::O_OPTM_LOCALIZE ) ) {
			exit( 'Not supported' );
		}

		$match   = false;
		$domains = $this->conf( self::O_OPTM_LOCALIZE_DOMAINS );
		foreach ( $domains as $v ) {
			if ( ! $v || 0 === strpos( $v, '#' ) ) {
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
				continue;
			}

			$type   = 'js';
			$domain = $v;
			// Try to parse space split value
<<<<<<< HEAD
			if (strpos($v, ' ')) {
				$v = explode(' ', $v);
				if (!empty($v[1])) {
					$type   = strtolower($v[0]);
=======
			if ( strpos( $v, ' ' ) ) {
				$v = explode( ' ', $v );
				if ( ! empty( $v[1] ) ) {
					$type   = strtolower( $v[0] );
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
					$domain = $v[1];
				}
			}

<<<<<<< HEAD
			if (strpos($domain, 'https://') !== 0) {
				continue;
			}

			if ($type != 'js') {
				continue;
			}

			// if ( strpos( $url, $domain ) !== 0 ) {
			if ($url != $domain) {
=======
			if ( 0 !== strpos( $domain, 'https://' ) ) {
				continue;
			}

			if ( 'js' !== $type ) {
				continue;
			}

			if ( $url !== $domain ) {
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
				continue;
			}

			$match = true;
			break;
		}

<<<<<<< HEAD
		if (!$match) {
			// wp_redirect( $url );
			exit('Not supported2');
		}

		header('Content-Type: application/javascript');

		// Generate
		$this->_maybe_mk_cache_folder('localres');

		$file = $this->_realpath($url);

		self::debug('localize [url] ' . $url);
		$response = wp_safe_remote_get($url, array(
			'timeout' => 180,
			'stream' => true,
			'filename' => $file,
		));

		// Parse response data
		if (is_wp_error($response)) {
			$error_message = $response->get_error_message();
			file_exists($file) && unlink($file);
			self::debug('failed to get: ' . $error_message);
			wp_redirect($url);
			exit();
		}

		$url = $this->_rewrite($url);

		wp_redirect($url);
=======
		if ( ! $match ) {
			exit( 'Not supported2' );
		}

		header( 'Content-Type: application/javascript' );

		// Generate
		$this->_maybe_mk_cache_folder( 'localres' );

		$file = $this->_realpath( $url );

		self::debug( 'localize [url] ' . $url );
		$response = wp_safe_remote_get( $url, [
			'timeout'  => 180,
			'stream'   => true,
			'filename' => $file,
		] );

		// Parse response data
		if ( is_wp_error( $response ) ) {
			$error_message = $response->get_error_message();
			if ( file_exists( $file ) ) {
				wp_delete_file( $file );
			}
			self::debug( 'failed to get: ' . $error_message );
			wp_safe_redirect( $url );
			exit();
		}

		$url = $this->_rewrite( $url );

		wp_safe_redirect( $url );
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
		exit();
	}

	/**
	 * Get the final URL of local avatar
	 *
<<<<<<< HEAD
	 * @since  4.5
	 */
	private function _rewrite( $url ) {
		return LITESPEED_STATIC_URL . '/localres/' . $this->_filepath($url);
=======
	 * @since 4.5
	 *
	 * @param string $url Original external URL.
	 * @return string Rewritten local URL.
	 */
	private function _rewrite( $url ) {
		return LITESPEED_STATIC_URL . '/localres/' . $this->_filepath( $url );
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
	}

	/**
	 * Generate realpath of the cache file
	 *
	 * @since  4.5
	 * @access private
<<<<<<< HEAD
	 */
	private function _realpath( $url ) {
		return LITESPEED_STATIC_DIR . '/localres/' . $this->_filepath($url);
=======
	 *
	 * @param string $url Original external URL.
	 * @return string Absolute file path.
	 */
	private function _realpath( $url ) {
		return LITESPEED_STATIC_DIR . '/localres/' . $this->_filepath( $url );
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
	}

	/**
	 * Get filepath
	 *
<<<<<<< HEAD
	 * @since  4.5
	 */
	private function _filepath( $url ) {
		$filename = md5($url) . '.js';
		if (is_multisite()) {
=======
	 * @since 4.5
	 *
	 * @param string $url Original external URL.
	 * @return string Relative file path.
	 */
	private function _filepath( $url ) {
		$filename = md5( $url ) . '.js';
		if ( is_multisite() ) {
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
			$filename = get_current_blog_id() . '/' . $filename;
		}
		return $filename;
	}

	/**
	 * Localize JS/Fonts
	 *
	 * @since 3.3
	 * @access public
<<<<<<< HEAD
	 */
	public function finalize( $content ) {
		if (is_admin()) {
			return $content;
		}

		if (!$this->conf(self::O_OPTM_LOCALIZE)) {
			return $content;
		}

		$domains = $this->conf(self::O_OPTM_LOCALIZE_DOMAINS);
		if (!$domains) {
			return $content;
		}

		foreach ($domains as $v) {
			if (!$v || strpos($v, '#') === 0) {
=======
	 *
	 * @param string $content Page HTML content.
	 * @return string Modified content with localized URLs.
	 */
	public function finalize( $content ) {
		if ( is_admin() ) {
			return $content;
		}

		if ( ! $this->conf( self::O_OPTM_LOCALIZE ) ) {
			return $content;
		}

		$domains = $this->conf( self::O_OPTM_LOCALIZE_DOMAINS );
		if ( ! $domains ) {
			return $content;
		}

		foreach ( $domains as $v ) {
			if ( ! $v || 0 === strpos( $v, '#' ) ) {
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
				continue;
			}

			$type   = 'js';
			$domain = $v;
			// Try to parse space split value
<<<<<<< HEAD
			if (strpos($v, ' ')) {
				$v = explode(' ', $v);
				if (!empty($v[1])) {
					$type   = strtolower($v[0]);
=======
			if ( strpos( $v, ' ' ) ) {
				$v = explode( ' ', $v );
				if ( ! empty( $v[1] ) ) {
					$type   = strtolower( $v[0] );
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
					$domain = $v[1];
				}
			}

<<<<<<< HEAD
			if (strpos($domain, 'https://') !== 0) {
				continue;
			}

			if ($type != 'js') {
				continue;
			}

			$content = str_replace($domain, LITESPEED_STATIC_URL . '/localres/' . base64_encode($domain), $content);
=======
			if ( 0 !== strpos( $domain, 'https://' ) ) {
				continue;
			}

			if ( 'js' !== $type ) {
				continue;
			}

			$content = str_replace( $domain, LITESPEED_STATIC_URL . '/localres/' . base64_encode( $domain ), $content ); // phpcs:ignore WordPress.PHP.DiscouragedPHPFunctions.obfuscation_base64_encode
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
		}

		return $content;
	}
}
