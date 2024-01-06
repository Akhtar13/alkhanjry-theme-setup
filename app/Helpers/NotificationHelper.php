<?php

namespace App\Helpers;

use App\Models\SmsLog;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client;

class NotificationHelper
{
    public static function sendNotification($array): string
    {
        $fields = [];

        $path_to_firebase_cm = 'https://fcm.googleapis.com/fcm/send';

        if ($array['os_type'] === 'IOS') {
            $fields = [
                'registration_ids' => $array['to'],
                'notification' =>
                    [
                        'mutable-content' => true,
                        'vibrate' => "1",
                        'sound' => "mySound",
                        'badge' => 1,
                        "priority" => "high",
                        'title' => $array['title'],
                        'body' => $array['body'],
                        'promo_code' => $array['promo_code'] ?? null,
                        'promo_code_value' => $array['promo_code_value'] ?? null,
                        'promo_code_id' => $array['promo_code_id'] ?? null,
                        'promo_code_end_date' => $array['promo_code_end_date'] ?? null,
                        'type' => $array['type'] ?? 1,
                        'meet_and_greet' => $array['meet_and_greet'] ?? [],
                        'user' => $array['user'] ?? [],
                        'service_detail' => $array['service_detail'] ?? [],
                    ],
                'data' =>
                    [
                        'type' => $array['type'] ?? 1,
                        'content' => ""
                    ],
            ];
        }
        if ($array['os_type'] === 'ANDROID') {
            $fields = [
                'registration_ids' => $array['to'],
                'priority' => 'high',
                'title' => $array['title'],
                'body' => $array['body'],
                'meet_and_greet' => $array['meet_and_greet'] ?? [],
                'user' => $array['user'] ?? [],
                'service_detail' => $array['service_detail'] ?? [],
                'promo_code' => $array['promo_code'] ?? null,
                'promo_code_value' => $array['promo_code_value'] ?? null,
                'promo_code_id' => $array['promo_code_id'] ?? null,
                'promo_code_end_date' => $array['promo_code_end_date'] ?? null,
                'type' => $array['type'] ?? 1,
                'data' => [
                    'message' => $array['body'],
                    'body' => $array['body'],
                    'type' => $array['type'] ?? 1,
                    'title' => $array['title'],
                    'meet_and_greet' => $array['meet_and_greet'] ?? [],
                    'user' => $array['user'] ?? [],
                    'service_detail' => $array['service_detail'] ?? [],
                    'promo_code' => $array['promo_code'] ?? null,
                    'promo_code_value' => $array['promo_code_value'] ?? null,
                    'promo_code_id' => $array['promo_code_id'] ?? null,
                    'promo_code_end_date' => $array['promo_code_end_date'] ?? null,
                ],
            ];
        }
        if (count($fields) > 0) {
            $headers = [
                'Authorization:key=' . env('FCM_KEY'),
                'Content-Type:application/json',
            ];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $path_to_firebase_cm);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
            $result = curl_exec($ch);
            curl_close($ch);
            \Log::info($array);
            \Log::info($result);
        }
        return true;
    }

    public static function sendSMS($array)
    {
        if(env('APP_TYPE')!='staging'){
            $twilio_sid = "ACab61cf092e67df10ad7f0c58a498d485";
            $twilio_token = "26ed33e2ac2c29654f66507c0bd06e92";
            $twilio_number = '+12154582562';
            $mobile_number = '+1' . $array['mobile_number'];

            $sms_content_array = array(
                'from' => $twilio_number,
                'body' => 'Cuddlytails: ' . $array['message']
            );
            if (isset($array['image'])) {
                $sms_content_array['mediaUrl'] = $array['image'];
            }
            try {
                $client = new Client($twilio_sid, $twilio_token);
                $message = $client->messages->create(
                    $mobile_number,
                    $sms_content_array
                );
                \Log::info($message->sid);
                self::smsLog([
                    'mobile_number' => $mobile_number,
                    'title' => json_encode($sms_content_array),
                    'status' => 1,
                    'response' => json_encode($message->sid),
                ]);
                return 'success';
            } catch (TwilioException $e) {
                self::smsLog([
                    'mobile_number' => $mobile_number,
                    'title' => json_encode($sms_content_array),
                    'status' => 0,
                    'response' => json_encode($e),
                ]);
                \Log::info('TWILIO ERROR', (array)$e);
                return 'error';
            }
        }
        return 'success';
    }

    public static function smsLog($array): bool
    {
        $mobile_number = $array['mobile_number'];
        $response = $array['response'];
        $title = $array['title'] ?? null;
        $status = $array['status'] ?? null;
        $created_at = date('Y-m-d H:i:s');

        SmsLog::create([
            'mobile_number' => $mobile_number,
            'response' => $response,
            'title' => $title,
            'status' => $status,
            'created_at' => $created_at,
        ]);
        return true;
    }
}