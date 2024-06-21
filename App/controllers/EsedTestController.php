<?php

namespace App\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Promise\Utils;
use GuzzleHttp\RequestOptions;

class EsedTestController {

  public function __construct() {
  }

  /**
   * List all products
   *
   * @return void
   */
  public function index() {

    $client = new Client();
    $urls = [
      'https://3gxdus4fe2.execute-api.eu-west-3.amazonaws.com/v1',
      //'http://clj-online.com/api.php?endpoint=endpoint1',
      'https://3gxdus4fe2.execute-api.eu-west-3.amazonaws.com/v2',
      //'http://clj-online.com/api.php?endpoint=endpoint2',
      'https://3gxdus4fe2.execute-api.eu-west-3.amazonaws.com/v3'
      //'http://clj-online.com/api.php?endpoint=endpoint3'
    ];

    $allSuccess = false;

    while (!$allSuccess) {
      $promises = [];
      foreach ($urls as $url) {
        $promises[] = $this->fetchWithRetries($client, $url);
      }

      try {
        $results = Utils::settle($promises)->wait();
        $res = [];

        $allSuccess = true;
        foreach ($results as $i => $result) {
          if ($result['state'] === 'fulfilled') {
            $jsonResponse = json_decode($result['value'], true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $res["endpoint" . ($i + 1)] = $jsonResponse;
            } else {
                $allSuccess = false;
            }
          } elseif ($result['state'] === 'rejected' && $result['reason'] instanceof ConnectException) {
              $allSuccess = false;
          } else {
              $allSuccess = false;
          }
        }

        if($allSuccess) {
          $finalResult = $this->manipulateResults($res);

          loadView('index', [
            'finalResult' => $finalResult
          ]);
        }
      } catch (ConnectException $e) {
        echo "Connection timeout: " . $e->getMessage() . "\n";
        $allSuccess = false;
      }
    }
  }

  /**
   * Function to call API's end points with retries
   *
   * @param Client $client
   * @param string $url
   * @param float $backoffFactor
   * @return PromiseInterface
   */
  public function fetchWithRetries(Client $client, $url, $backoffFactor = 1.0) {
    $attempt = 0;

    $makeRequest = function () use ($client, $url, &$attempt, $backoffFactor, &$makeRequest) {
        return $client->getAsync($url, [
            RequestOptions::TIMEOUT => 30,
        ])->then(
            function ($response) {
                return $response->getBody()->getContents();
            },
            function ($exception) use (&$attempt, $backoffFactor, &$makeRequest, $url) {
                if ($exception instanceof ConnectException) {
                    $attempt++;
                    $delay = $backoffFactor * (2 ** $attempt);
                    echo "Request to {$url} timed out or failed: {$exception->getMessage()}. Retrying in {$delay} seconds...\n";
                    return Utils::sleep($delay * 1000)->then(function () use ($makeRequest) {
                        return $makeRequest();
                    });
                } else {
                    throw $exception;
                }
            }
        );
    };

    return $makeRequest();
  }

  /**
   * Function to normalize results
   *
   * @param array $results
   * @return results
   */
  public function manipulateResults($res) {
    $finalResult = [];
    foreach ($res as $endpoint => $data) {
      foreach ($data as $item) {
        $normalizedItem = [
          'name' => $item['name'],
          'path' => $item['path'],
          'mass' => isset($item['weight']) ? $item['weight'] : (isset($item['mass']) ? $item['mass'] : 0),
          'mass_unit' => isset($item['weight_unit']) ? $item['weight_unit'] : (isset($item['mass_unit']) ? $item['mass_unit'] : ''),
          'family' => isset($item['family']) ? $item['family'] : (isset($item['category']) ? $item['category'] : (isset($item['tag']) ? $item['tag'] : '')),
          'user' => isset($item['user']) ? $item['user'] : 'anonymous'
        ];
        $finalResult[] = $normalizedItem;
      }
    }

    return $finalResult;
  }
}
