<?php

namespace Mailer;

ini_set( "display_errors", 0 );
ini_set( "error_reporting", E_ALL );

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/templating.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



function send ( $envelope ) {

	date_default_timezone_set( 'Asia/Kolkata' );

	// Extract and set default arguments
	if ( empty( $envelope ) ) {
		throw new Exception( 'No arguments were passed to the mailer.' );
	}
	if ( empty( $envelope[ 'username' ] ) or empty( $envelope[ 'password' ] ) ) {
		throw new Exception( 'Credentials were not provided.' );
	}

	// Create a new PHPMailer instance
	$mail = new PHPMailer( true );

	try {

		// Enable SMTP debugging
		// 0 = off (for production use)
		// 1 = client messages
		// 2 = client and server messages
		$mail->SMTPDebug = 0;

		// Tell PHPMailer to use SMTP
		$mail->isSMTP();

		// Ask for HTML-friendly debug output
		$mail->Debugoutput = 'html';

		// Set the hostname of the mail server
		$mail->Host = 'smtp.gmail.com';

		// Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
		$mail->Port = 587;

		// Set the encryption system to use - ssl (deprecated) or tls
		$mail->SMTPSecure = 'tls';

		// Use SMTP authentication
		$mail->SMTPAuth = true;

		// Username to use for SMTP authentication - use full email address for gmail
		$mail->Username = $envelope[ 'username' ];

		// Password to use for SMTP authentication
		$mail->Password = $envelope[ 'password' ];

		// Set who the message is to be sent from
		$mail->setFrom( $envelope[ 'from' ][ 'email' ], $envelope[ 'from' ][ 'name' ] );

		// Set an alternative reply-to address
		// $mail->addReplyTo('replyto@example.com', 'First Last');

		// Set who the message is to be sent to
		$mail->addAddress( $envelope[ 'to' ][ 'email' ], '' );
		$mail->addCC( 'adityabhat@lazaro.in', '' );

		$mail->isHTML( true );

		// Set the subject line
		$mail->Subject = $envelope[ 'subject' ];

		// Set the mail body
		$mail->Body = $envelope[ 'body' ];

		// Add attachments if present
		if ( ! empty( $envelope[ 'attachment' ] ) ) {
			$name = $envelope[ 'attachment' ][ 'name' ];
			$path = $envelope[ 'attachment' ][ 'url' ];
			$content = file_get_contents( $path );
			$mail->addStringAttachment( $content, $name );
		}

		// Send the message
		$mail->send();

		return 'Mail sent.';

	} catch ( Exception $e ) {

		throw new Exception( $mail->ErrorInfo );

	}

}

function sendMessage ( $data ) {

	$toName = $data[ 'name' ] ?? '';
	$toEmail = $data[ 'email' ];
	$subject = $data[ 'subject' ];
	$body = $data[ 'message' ];
	// Templating\render( __DIR__ . '/templates/from-dasta.php', $enquiry )

	// Prepare the envelope
	$envelope = [
		'username' => 'google@lazaro.in',
		'password' => 't34m,l4z4r0',
		'from' => [
			'email' => 'google@lazaro.in',
			'name' => 'Lazaro'
		],
		'to' => [
			'name' => $toName,
			'email' => $toEmail
		],
		'subject' => $subject,
		'body' => $body
	];

	return send( $envelope );

}
