<?php
// Require the bundled autoload file - the path may need to change
// based on where you downloaded and unzipped the SDK
require __DIR__ . '/Twilio/autoload.php';

// Use the REST API Client to make requests to the Twilio REST API
use Twilio\Rest\Client;

// Your Account SID and Auth Token from twilio.com/console
$sid = 'AC8fefbe2d6de44537d84bb94cf11cfd00';
$token = '0e6bef240c32e01d0668cde8b6bc5e74';
$client = new Client($sid, $token);

// Use the client to do fun stuff like send text messages!


try{
$client->calls->create(
    // the number you'd like to send the message to
    '+447765278322',
    '+441133206631',
    array("url" => "http://demo.twilio.com/docs/voice.xml")


    );

  } catch(Exception $e) {
    echo "Error: " . $e->getMessage();
  }



  // try{
  // $client->messages->create(
  //     // the number you'd like to send the message to
  //     '+447765278322',
  //     array(
  //         // A Twilio phone number you purchased at twilio.com/console
  //         'from' => '+441133206631',
  //         // the body of the text message you'd like to send
  //         'body' => "this is a twilio test from penny"
  //     )
  //
  //     );
  //
  //   } catch(Exception $e) {
  //     echo "Error: " . $e->getMessage();
  //   }
