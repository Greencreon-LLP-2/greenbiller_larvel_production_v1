<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class SmsService
{
    public function send($mobile, $msg)
    {
        $siteData = DB::table('core_settings')->where('id', 1)->first();

        if (!$siteData) {
            return false;
        }

       if ($siteData->enable_greensms == true) {
            $expire = strtotime("+8 minute");
            $accessToken = $siteData->greensms_access_token;
            $accessTokenKey = $siteData->greensms_access_token_key;
            $requestFor = "send-sms";

            $signature = md5(
                md5($accessToken . md5($requestFor . "sms@rits-v1.0" . $expire)) .
                $accessTokenKey
            );

            $params = [
                'accessToken' => $accessToken,
                'expire' => $expire,
                'authSignature' => $signature,
                'route' => "transactional",
                'smsHeader' => $siteData->sms_sender_id,
                'messageContent' => $msg,
                'recipients' => $mobile,
                'contentType' => "text",
                'entityId' => $siteData->sms_entity_id,
                'templateId' => $siteData->sms_dlt_id,
                'removeDuplicateNumbers' => "1"
            ];

            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => 'https://sms.greencreon.com/api/sms/v1.0/send-sms',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_POSTFIELDS => http_build_query($params),
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_HTTPHEADER => [
                    "accept: application/json"
                ]
            ]);
            $response = curl_exec($curl);
            curl_close($curl);

            return $response;
        }
        return false;
    }
}