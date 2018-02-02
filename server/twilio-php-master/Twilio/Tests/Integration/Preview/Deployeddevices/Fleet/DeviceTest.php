<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Tests\Integration\Preview\Deployeddevices\Fleet;

use Twilio\Exceptions\DeserializeException;
use Twilio\Exceptions\TwilioException;
use Twilio\Http\Response;
use Twilio\Tests\HolodeckTestCase;
use Twilio\Tests\Request;

class DeviceTest extends HolodeckTestCase {
    public function testFetchRequest() {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->preview->deployedDevices->fleets("FLaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa")
                                                   ->devices("THaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa")->fetch();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'get',
            'https://preview.twilio.com/DeployedDevices/Fleets/FLaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Devices/THaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa'
        ));
    }

    public function testFetchResponse() {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "sid": "THaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "unique_name": "unique_name",
                "friendly_name": "friendly_name",
                "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "fleet_sid": "FLaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "enabled": true,
                "deployment_sid": "DLaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "identity": "bob@twilio.com",
                "date_created": "2016-07-30T20:00:00Z",
                "date_updated": "2016-07-30T20:00:00Z",
                "date_authenticated": null,
                "url": "https://preview.twilio.com/DeployedDevices/Fleets/FLaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Devices/THaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"
            }
            '
        ));

        $actual = $this->twilio->preview->deployedDevices->fleets("FLaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa")
                                                         ->devices("THaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa")->fetch();

        $this->assertNotNull($actual);
    }

    public function testDeleteRequest() {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->preview->deployedDevices->fleets("FLaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa")
                                                   ->devices("THaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa")->delete();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'delete',
            'https://preview.twilio.com/DeployedDevices/Fleets/FLaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Devices/THaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa'
        ));
    }

    public function testDeleteResponse() {
        $this->holodeck->mock(new Response(
            204,
            null
        ));

        $actual = $this->twilio->preview->deployedDevices->fleets("FLaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa")
                                                         ->devices("THaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa")->delete();

        $this->assertTrue($actual);
    }

    public function testCreateRequest() {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->preview->deployedDevices->fleets("FLaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa")
                                                   ->devices->create();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'post',
            'https://preview.twilio.com/DeployedDevices/Fleets/FLaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Devices'
        ));
    }

    public function testCreateResponse() {
        $this->holodeck->mock(new Response(
            201,
            '
            {
                "sid": "THaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "unique_name": "unique_name",
                "friendly_name": "friendly_name",
                "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "fleet_sid": "FLaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "enabled": true,
                "deployment_sid": "DLaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "identity": "bob@twilio.com",
                "date_created": "2016-07-30T20:00:00Z",
                "date_updated": "2016-07-30T20:00:00Z",
                "date_authenticated": null,
                "url": "https://preview.twilio.com/DeployedDevices/Fleets/FLaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Devices/THaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"
            }
            '
        ));

        $actual = $this->twilio->preview->deployedDevices->fleets("FLaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa")
                                                         ->devices->create();

        $this->assertNotNull($actual);
    }

    public function testReadRequest() {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->preview->deployedDevices->fleets("FLaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa")
                                                   ->devices->read();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'get',
            'https://preview.twilio.com/DeployedDevices/Fleets/FLaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Devices'
        ));
    }

    public function testReadEmptyResponse() {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "devices": [],
                "meta": {
                    "first_page_url": "https://preview.twilio.com/DeployedDevices/Fleets/FLaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Devices?PageSize=50&Page=0",
                    "key": "devices",
                    "next_page_url": null,
                    "page": 0,
                    "page_size": 50,
                    "previous_page_url": null,
                    "url": "https://preview.twilio.com/DeployedDevices/Fleets/FLaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Devices?PageSize=50&Page=0"
                }
            }
            '
        ));

        $actual = $this->twilio->preview->deployedDevices->fleets("FLaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa")
                                                         ->devices->read();

        $this->assertNotNull($actual);
    }

    public function testReadFullResponse() {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "devices": [
                    {
                        "sid": "THaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "unique_name": "unique_name",
                        "friendly_name": "friendly_name",
                        "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "enabled": true,
                        "fleet_sid": "FLaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "deployment_sid": "DLaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "identity": "bob@twilio.com",
                        "date_created": "2016-07-30T20:00:00Z",
                        "date_updated": "2016-07-30T20:00:00Z",
                        "date_authenticated": null,
                        "url": "https://preview.twilio.com/DeployedDevices/Fleets/FLaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Devices/THaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"
                    }
                ],
                "meta": {
                    "first_page_url": "https://preview.twilio.com/DeployedDevices/Fleets/FLaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Devices?PageSize=50&Page=0",
                    "key": "devices",
                    "next_page_url": null,
                    "page": 0,
                    "page_size": 50,
                    "previous_page_url": null,
                    "url": "https://preview.twilio.com/DeployedDevices/Fleets/FLaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Devices?PageSize=50&Page=0"
                }
            }
            '
        ));

        $actual = $this->twilio->preview->deployedDevices->fleets("FLaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa")
                                                         ->devices->read();

        $this->assertGreaterThan(0, count($actual));
    }

    public function testUpdateRequest() {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->preview->deployedDevices->fleets("FLaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa")
                                                   ->devices("THaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa")->update();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'post',
            'https://preview.twilio.com/DeployedDevices/Fleets/FLaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Devices/THaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa'
        ));
    }

    public function testUpdateResponse() {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "sid": "THaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "unique_name": "unique_name",
                "friendly_name": "friendly_name",
                "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "fleet_sid": "FLaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "enabled": true,
                "deployment_sid": "DLaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "identity": "bob@twilio.com",
                "date_created": "2016-07-30T20:00:00Z",
                "date_updated": "2016-07-30T20:00:00Z",
                "date_authenticated": null,
                "url": "https://preview.twilio.com/DeployedDevices/Fleets/FLaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Devices/THaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"
            }
            '
        ));

        $actual = $this->twilio->preview->deployedDevices->fleets("FLaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa")
                                                         ->devices("THaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa")->update();

        $this->assertNotNull($actual);
    }
}