<?php

require_once PPPDF_DIR . '/vendor/dropbox-sdk/vendor/autoload.php';

use Kunnu\Dropbox\Dropbox;
use Kunnu\Dropbox\DropboxApp;
use Kunnu\Dropbox\DropboxFile;
use Kunnu\Dropbox\Exceptions\DropboxClientException;

/**
 * Send an email when a donation is made using IPN paypal data.
 *
 * @return void
 */
function pppdf_process_ipn() {

	if ( isset( $_GET['donation'] ) && 'IPN' === $_GET['donation'] ) {
		
		add_filter( 'wp_mail_from_name', 'The Cura Foundation' );

		$data = array(
			'first_name'    => 'Cura',
			'last_name'     => 'Foundation',
			'date'          => date( 'F jS, Y', strtotime( date( 'Y-m-d' ) ) ),
			'payer_email'   => 'contact@thecurafoundation.org',
			'organization'  => '',
			'payment_gross' => '5.00',
			'txn_id'        => '000000',
		);

		$data = wp_parse_args( $_POST, $data );

		$file_name = 'cura-' . strtolower( $data['first_name'] ) . '-' . strtolower( $data['last_name'] ) . '-' . date( 'Y-m-d' ) . '-' . $data['txn_id'] . '.pdf';

		$data['path']      = WP_CONTENT_DIR . '/uploads/pdf/' . $file_name;
		$data['file_name'] = $file_name;

		pppdf_send_email( $data );

		pppdf_upload_pdf_to_dropbox( $data['path'], $data['file_name'] );
	}

}
add_action( 'init', 'pppdf_process_ipn' );


function pppdf_mail_from( $email ) {
    return 'info@stemforlife.org';
}
add_filter( 'wp_mail_from', 'pppdf_mail_from' );

/**
 * Send email with pdf attachment
 *
 * @param array $data
 * @return void
 */
function pppdf_send_email( $data = array() ) {

	$to          = $data['payer_email'];
	$subject     = 'The Cura Foundation';
	$body        = 'Thank you for your support. Please find the donation receipt letter attached.
- Cura Foundation';
	$headers     = array( 'Content-Type: text/html; charset=UTF-8' );
	$pdf         = pppdf_create_pdf( $data );
	$attachments = array( $data['path'] );

	if ( $pdf ) {
		$headers[] = 'Bcc: info@thecurafoundation.org';
		wp_mail( $to, $subject, $body, $headers, $attachments );
		wp_mail( 'info@thecurafoundation.org', 'New Donation', 'New donation from ' . $data['payer_email'], array( 'Content-Type: text/html; charset=UTF-8' ), $attachments );
		
	}

}

/**
 * Create pdf from paypal data and save
 *
 * @param array $data
 * @return boolean
 */
function pppdf_create_pdf( $data = array() ) {

	if ( ! file_exists( WP_CONTENT_DIR . '/uploads/pdf' ) ) {
		mkdir( WP_CONTENT_DIR . '/uploads/pdf', 0775, true );
	}

	$page = get_page_by_path( 'pdf' );
	$html = $page ? wpautop( $page->post_content ) : '<h1>Thanks for your support!</h1>';

	$html = pppdf_process_html( $html, $data );

	$stylesheet = '
        p {
            padding: 5px 0;
            font-family: Arial;
        }
        .small {
            font-size: 10px;
        }
    ';

	$mpdf = new \Mpdf\Mpdf();
	$mpdf->WriteHTML( $stylesheet, 1 );
	$mpdf->WriteHTML( $html, 2 );
	$pdf = $mpdf->Output( $data['path'], \Mpdf\Output\Destination::FILE );

	return true;

}

/**
 * Replace tokens in html with data
 *
 * @param string $html
 * @param array  $data
 * @return string
 */
function pppdf_process_html( $html = '', $data = array() ) {

	$tokens = array(
		'{{first_name}}',
		'{{last_name}}',
		'{{date}}',
		'{{organization}}',
		'{{email}}',
		'{{donation_amount}}',
	);

	$values = array(
		$data['first_name'],
		$data['last_name'],
		$data['date'],
		$data['organization'],
		$data['payer_email'],
		'$' . $data['payment_gross'],
	);

	$string = str_replace( $tokens, $values, $html );

	return $string;

}

/**
 * Upload pdf to dropbox
 *
 * @param string $path
 * @param string $file_name
 * @return void
 */
function pppdf_upload_pdf_to_dropbox( $path = '', $file_name = '' ) {

	// @TODO create an app in dropbox and use those credentials instead of OOTB plugin.
	$_app_key        = 'm3n3zyvyr59cdjb'; // Hard coded in out of the box plugin App.php file.
	$_app_secret     = 'eu73x5upk7ehes4'; // Hard coded in out of the box plugin App.php file.
	$_app_settings   = get_option( 'out_of_the_box_settings' );
	$_app_secret_key = isset( $_app_settings['dropbox_app_token'] ) ? $_app_settings['dropbox_app_token'] : null;

	if ( $_app_secret_key && '' !== $path ) {

		// Load up Dropbox service and create a file object.
		$app     = new DropboxApp( $_app_key, $_app_secret, $_app_secret_key );
		$dropbox = new Dropbox( $app );

		// Try to upload the pdf.
		try {
			$dropbox_file  = new DropboxFile( $path );
			$uploaded_file = $dropbox->upload( $dropbox_file, '/donation-pdf/' . $file_name, [ 'autorename' => false ] );
		} catch ( DropboxClientException $e ) {
			// error_log( $e->getMessage() );
		}
	}

}
