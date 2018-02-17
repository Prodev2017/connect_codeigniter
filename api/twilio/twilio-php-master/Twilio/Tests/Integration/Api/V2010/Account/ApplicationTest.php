<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Tests\Integration\Api\V2010\Account;

use Twilio\Exceptions\DeserializeException;
use Twilio\Exceptions\TwilioException;
use Twilio\Http\Response;
use Twilio\Tests\HolodeckTestCase;
use Twilio\Tests\Request;

class ApplicationTest extends HolodeckTestCase {
    public function testCreateRequest() {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->api->v2010->accounts("ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa")
                                     ->applications->create("friendlyName");
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $values = array(
            'FriendlyName' => "friendlyName",
        );

        $this->assertRequest(new Request(
            'post',
            'https://api.twilio.com/2010-04-01/Accounts/ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Applications.json',
            null,
            $values
        ));
    }

    public function testCreateResponse() {
        $this->holodeck->mock(new Response(
            201,
            '
            {
                "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "api_version": "2010-04-01",
                "date_created": "Mon, 22 Aug 2011 20:59:45 +0000",
                "date_updated": "Tue, 18 Aug 2015 16:48:57 +0000",
                "friendly_name": "Application Friendly Name",
                "message_status_callback": "http://www.example.com/sms-status-callback",
                "sid": "APaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "sms_fallback_method": "GET",
                "sms_fallback_url": "http://www.example.com/sms-fallback",
                "sms_method": "GET",
                "sms_status_callback": "http://www.example.com/sms-status-callback",
                "sms_url": "http://example.com",
                "status_callback": "http://example.com",
                "status_callback_method": "GET",
                "uri": "/2010-04-01/Accounts/ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Applications/APaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa.json",
                "voice_caller_id_lookup": false,
                "voice_fallback_method": "GET",
                "voice_fallback_url": "http://www.example.com/voice-callback",
                "voice_method": "GET",
                "voice_url": "http://example.com"
            }
            '
        ));

        $actual = $this->twilio->api->v2010->accounts("ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa")
                                           ->applications->create("friendlyName");

        $this->assertNotNull($actual);
    }

    public function testDeleteRequest() {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->api->v2010->accounts("ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa")
                                     ->applications("APaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa")->delete();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'delete',
            'https://api.twilio.com/2010-04-01/Accounts/ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Applications/APaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa.json'
        ));
    }

    public function testDeleteResponse() {
        $this->holodeck->mock(new Response(
            204,
            null
        ));

        $actual = $this->twilio->api->v2010->accounts("ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa")
                                           ->applications("APaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa")->delete();

        $this->assertTrue($actual);
    }

    public function testFetchRequest() {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->api->v2010->accounts("ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa")
                                     ->applications("APaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa")->fetch();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'get',
            'https://api.twilio.com/2010-04-01/Accounts/ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Applications/APaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa.json'
        ));
    }

    public function testFetchResponse() {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "api_version": "2010-04-01",
                "date_created": "Mon, 22 Aug 2011 20:59:45 +0000",
                "date_updated": "Tue, 18 Aug 2015 16:48:57 +0000",
                "friendly_name": "Application Friendly Name",
                "message_status_callback": "http://www.example.com/sms-status-callback",
                "sid": "APaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "sms_fallback_method": "GET",
                "sms_fallback_url": "http://www.example.com/sms-fallback",
                "sms_method": "GET",
                "sms_status_callback": "http://www.example.com/sms-status-callback",
                "sms_url": "http://example.com",
                "status_callback": "http://example.com",
                "status_callback_method": "GET",
                "uri": "/2010-04-01/Accounts/ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Applications/APaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa.json",
                "voice_caller_id_lookup": false,
                "voice_fallback_method": "GET",
                "voice_fallback_url": "http://www.example.com/voice-callback",
                "voice_method": "GET",
                "voice_url": "http://example.com"
            }
            '
        ));

        $actual = $this->twilio->api->v2010->accounts("ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa")
                                           ->applications("APaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa")->fetch();

        $this->assertNotNull($actual);
    }

    public function testReadRequest() {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->api->v2010->accounts("ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa")
                                     ->applications->read();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'get',
            'https://api.twilio.com/2010-04-01/Accounts/ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Applications.json'
        ));
    }

    public function testReadFullResponse() {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "applications": [
                    {
                        "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "api_version": "2010-04-01",
                        "date_created": "Fri, 21 Aug 2015 00:07:25 +0000",
                        "date_updated": "Fri, 21 Aug 2015 00:07:25 +0000",
                        "friendly_name": "d8821fb7-4d01-48b2-bdc5-34e46252b90b",
                        "message_status_callback": null,
                        "sid": "APaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "sms_fallback_method": "POST",
                        "sms_fallback_url": null,
                        "sms_method": "POST",
                        "sms_status_callback": null,
                        "sms_url": null,
                        "status_callback": null,
                        "status_callback_method": "POST",
                        "uri": "/2010-04-01/Accounts/ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Applications/APaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa.json",
                        "voice_caller_id_lookup": false,
                        "voice_fallback_method": "POST",
                        "voice_fallback_url": null,
                        "voice_method": "POST",
                        "voice_url": null
                    }
                ],
                "end": 0,
                "first_page_uri": "/2010-04-01/Accounts/ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Applications.json?PageSize=1&Page=0",
                "last_page_uri": "/2010-04-01/Accounts/ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Applications.json?PageSize=1&Page=35",
                "next_page_uri": null,
                "num_pages": 36,
                "page": 0,
                "page_size": 1,
                "previous_page_uri": null,
                "start": 0,
                "total": 36,
                "uri": "/2010-04-01/Accounts/ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Applications.json?PageSize=1&Page=0"
            }
            '
        ));

        $actual = $this->twilio->api->v2010->accounts("ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa")
                                           ->applications->read();

        $this->assertGreaterThan(0, count($actual));
    }

    public function testReadEmptyResponse() {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "applications": [],
                "end": 0,
                "first_page_uri": "/2010-04-01/Accounts/ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Applications.json?PageSize=1&Page=0",
                "last_page_uri": "/2010-04-01/Accounts/ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Applications.json?PageSize=1&Page=35",
                "next_page_uri": null,
                "num_pages": 36,
                "page": 0,
                "page_size": 1,
                "previous_page_uri": null,
                "start": 0,
                "total": 36,
                "uri": "/2010-04-01/Accounts/ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Applications.json?PageSize=1&Page=0"
            }
            '
        ));

        $actual = $this->twilio->api->v2010->accounts("ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa")
                                           ->applications->read();

        $this->assertNotNull($actual);
    }

    public function testUpdateRequest() {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->api->v2010->accounts("ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa")
                                     ->applications("APaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa")->update();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'post',
            'https://api.twilio.com/2010-04-01/Accounts/ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Applications/APaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa.json'
        ));
    }

    public function testUpdateResponse() {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "api_version": "2010-04-01",
                "date_created": "Mon, 22 Aug 2011 20:59:45 +0000",
                "date_updated": "Tue, 18 Aug 2015 16:48:57 +0000",
                "friendly_name": "Application Friendly Name",
                "message_status_callback": "http://www.example.com/sms-status-callback",
                "sid": "APaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "sms_fallback_method": "GET",
                "sms_fallback_url": "http://www.example.com/sms-fallback",
                "sms_method": "GET",
                "sms_status_callback": "http://www.example.com/sms-status-callback",
                "sms_url": "http://example.com",
                "status_callback": "http://example.com",
                "status_callback_method": "GET",
                "uri": "/2010-04-01/Accounts/ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Applications/APaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa.json",
                "voice_caller_id_lookup": false,
                "voice_fallback_method": "GET",
                "voice_fallback_url": "http://www.example.com/voice-callback",
                "voice_method": "GET",
                "voice_url": "http://example.com"
            }
            '
        ));

        $actual = $this->twilio->api->v2010->accounts("ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa")
                                           ->applications("APaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa")->update();

        $this->assertNotNull($actual);
    }
}