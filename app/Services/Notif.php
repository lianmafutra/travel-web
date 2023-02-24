<?php

namespace App\Action\Notif;



class Notif
{

   protected $tokenUser;
   protected $token_fcm;

   public function __construct()
   {
      $this->token_fcm = "key=AAAAAMmZkVE:APA91bEb5mIPAiLV2hWvsW4-YghkmoOVKV1ZuPFtjvqDZ8OYxuOlazEM55AYVwXA4C6lZEz5t9XMiv7Gd8pWZPvGUDDLybEbHwzz_Te6BXZt1HuS4NBrx95e8Zya-nJQHkVVOINOQmy-";
   }

   public function kirim($title, $message, $token_user)
   {
      $msg = array(
         'title' => $title,
         'body'  => $message,
         'click_action' => "data"
      );
      $fields = array(
         'to'           =>  $token_user,
         'notification' => $msg,
         'data'         => array (
            
         )
      );
      $headers = array(
         'Authorization: ' . $this->token_fcm,
         'Content-Type: application/json'
      );
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
      $result = curl_exec($ch);
      curl_close($ch);
      return response($result)->send();
   }
}
