<?php
/**
<<<<<<< HEAD
 * Downgraded for PHP 7.2 compatibility. Do not edit.
=======
 * Downgraded for PHP 7.4 compatibility. Do not edit.
>>>>>>> 65cb868516d40f3fcbaffd3799194a6a5a8cbd7f
 * @noinspection ALL
 */
function loco_parse_wp_locale( string $tag ):array { if( ! preg_match( '/^([a-z]{2,3})(?:[-_]([a-z]{2}))?(?:[-_]([a-z\\d]{3,8}))?$/i', $tag, $tags ) ){ throw new InvalidArgumentException('Invalid WordPress locale: '.json_encode($tag) ); } $data = [ 'lang' => strtolower( $tags[1] ), ]; if( array_key_exists(2,$tags) && $tags[2] ){ $data['region'] = strtoupper($tags[2]); } if( array_key_exists(3,$tags) && $tags[3] ){ $data['variant'] = strtolower($tags[3]); } return $data; }
