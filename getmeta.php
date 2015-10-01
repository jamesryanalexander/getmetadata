<?php
/**
 * Script to allow for the gathering of external site meta data via ajax call. 
 *  Not designed to be used via the browser.
 *
 *
 *
 * @file
 * @author James Alexander
 * @copyright © 2015 James Ryan Alexander
 * @license MIT at http://opensource.org/licenses/MIT and LICENSE.txt which should be in the root folder of this software
 * @version 1.0 - 2015-09-30
 */


date_default_timezone_set( 'UTC' );

$urlarray = null;
$url = null;
$action = null;

if ( isset( $_POST['action'] ) ) {

	$action = $_POST['action'];

}

if ( isset( $_POST['url'] ) ) {

	$url = $_POST['url'];
	
}

function getPageData( $url ) {
	
	$ch = curl_init( $url );

	curl_setopt( $ch, CURLOPT_HEADER, 0 );
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
	curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1 );

	$result = curl_exec( $ch );

	curl_close( $ch );

	return $result;

}

function getTitle( $url ) {

	$pagedata = getPageData( $url );

	if ( $pagedata ) {

		$page = new DomDocument();
		libxml_use_internal_errors(true);
		$page->loadHTML( $pagedata );

		$titleDom = $page->getelementsbytagname( 'title' );

		if ($titleDom->length > 0) 
		{
			$title = $titleDom->item(0)->textContent;
		}

		return $title;
	} else {
		return 'no data recieved';
	}

}


if ( $action ) {


	switch ( $action ) {
		case 'title':

			if ( $url ) {

				$result = getTitle( $url );

				echo json_encode( $result );

			} else {
				echo json_encode( 'no url detected, bitch at maintainer' );
			}

			break;


		
		default:
		echo json_encode( "not title?" );
			break;
	} 

} 

/* 
//For testing
else {
	echo getTitle( "http://php.net/manual/en/class.domnodelist.php" );
}
*/