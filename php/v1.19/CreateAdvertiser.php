<?php
/**
 * This example creates an advertiser in the current DFA network.
 *
 * Tags: advertiser.saveAdvertiser
 *
 * PHP version 5.3
 * PHP extensions: google/apiclient, SoapClient.
 *
 * Copyright 2014, Google Inc. All Rights Reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * @package    GoogleApiAdsDfa
 * @category   WebServices
 * @copyright  2014, Google Inc. All Rights Reserved.
 * @license    http://www.apache.org/licenses/LICENSE-2.0 Apache License,
 *             Version 2.0
 * @author     Jonathon Imperiosi <api.jimper@gmail.com>
 */

require_once 'DfaUtils.php';

// Set SOAP and XML settings.
$advertiserWsdl = 'https://advertisersapi.doubleclick.net/v1.19/api/' .
    'dfa-api/advertiser?wsdl';
$options = array('encoding' => 'utf-8');

// Authenticate with the API and retrieve auth token.
$token = DfaUtils::authenticate();

// Get AdvertiserService.
$advertiserService = new SoapClient($advertiserWsdl, $options);

// Set headers.
$headers = array(DfaUtils::generateWsseHeader($token),
    DfaUtils::generateRequestHeader());
$advertiserService->__setSoapHeaders($headers);

// Create advertiser structure.
$advertiser = array(
    'id' => 0,
    'name' => 'Advertiser ' . uniqid(),
    'networkId' => 0,
    'approved' => true,
    'advertiserGroupId' => 0,
    'hidden' => false,
    'impressionExchangeEnabled' => false,
    'inventoryAdvertiser' => false,
    'spotId' => 0,
    'subnetworkId' => 0);

try {
  // Save the advertiser.
  $result = $advertiserService->saveAdvertiser($advertiser);
} catch (Exception $e) {
  print $e->getMessage();
  exit(1);
}

// Display the ID of the newly created advertiser.
print 'Advertiser with ID ' . $result->id . " was created.\n";
