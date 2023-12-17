<?php
/**
 * OpenAI API Client
 *
 * This file is part of OpenAI API Client.
 *
 * @author     Muhammet ŞAFAK <info@muhammetsafak.com.tr>
 * @copyright  Copyright © 2023 Muhammet ŞAFAK
 * @license    ./LICENSE  MIT
 * @version    1.0
 * @link       https://www.muhammetsafak.com.tr
 */

declare(strict_types=1);
namespace MuhammetSafak\OpenAI;

use Exception;
use Throwable;

trait Clientable
{

    protected function sendRequest(string $method, string $url, array $headers = [], array $body = []): array
    {
        try {
            $header = [];
            foreach ($headers as $key => $value) {
                $header[] = (is_string($key) ? $key . ': ' : '')
                    . $value;
            }
            $headers = $header;

            $body = json_encode($body);

            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL             => $url,
                CURLOPT_CUSTOMREQUEST   => strtoupper($method),
                CURLOPT_RETURNTRANSFER  => true,
                CURLOPT_POST            => 1,
                CURLOPT_POSTFIELDS      => $body,
                CURLOPT_HTTPHEADER      => $headers,
                CURLOPT_MAXREDIRS       => 10,
                CURLOPT_TIMEOUT         => 300,
                CURLOPT_FOLLOWLOCATION  => true,
                CURLOPT_HEADER          => 0,
            ]);
            $res = curl_exec($curl);
            if (curl_errno($curl)) {
                throw new Exception(curl_error($curl));
            }
            curl_close($curl);

            $response = json_decode($res, true);
            $status = empty($response['error']);
            if (!$status) {
                $message = $response['error']['message'] ?? 'Bilinmeyen bir hata oluştu!';
            } else {
                $message = '';
            }

            return [
                'status'            => empty($response['error']),
                'message'           => $message,
                'response'          => $response,
            ];
        } catch (Throwable $throwable) {
            return [
                'status'        => false,
                'message'       => $throwable->getMessage(),
                'response'      => []
            ];
        }
    }

}
