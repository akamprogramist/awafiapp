<?php

namespace App\Http\Controllers;

use App\Models\Order;
use \Firebase\JWT\JWT;
use Nette\Schema\Helpers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ZainCashController extends Controller
{

    public function payment(Request $request)
    {

        $order = Order::where(['id' => $request['order_id']])->first();
        if ($request['status_id'] == 1) {
            $order->transaction_reference = $request['transaction_id'];
            $order->payment_method = 'zaincash';
            $order->payment_status = 'paid';
            $order->order_status = 'confirmed';
            $order->confirmed = now();
            $order->save();
            Helpers::send_order_notification($order);
            if ($order->callback != null) {
                return redirect($order->callback . '&status=success');
            } else {
                return \redirect()->route('payment-success');
            }
        } else {
            DB::table('orders')
                ->where('id', $request['order_id'])
                ->update([
                    'payment_method'        => 'zaincash',
                    'order_status'          => 'failed',
                    'failed'             => now(),
                    'updated_at'            => now(),
                ]);
        }
        // if ($order->callback != null) {
        //     return redirect($order->callback . '&status=fail');
        // } else {
        //     return \redirect()->route('payment-fail');
        // }

    }
    public function gateway()
    {
        // ----------------- Merchant Details --------------------------
        // Your wallet number (ZainCash IT will provide it for you)
        $msisdn = '9647835077893';

        // Secret (ZainCash IT will provide it for you)
        $secret = '$2y$10$hBbAZo2GfSSvyqAyV2SaqOfYewgYpfR1O19gIh4SqyGWdmySZYPuS';

        // Merchant ID (ZainCash IT will provide it for you)
        $merchantid = '5ffacf6612b5777c6d44266f';

        // Test credentials or Production credentials (true=production, false=test)
        $production_cred = false;

        // Language 'ar'=Arabic 'en'=english
        $language = 'en';

        $amount = 250;

        // Type of service you provide, like 'Books', 'ecommerce cart', 'Hosting services', ...
        $service_type = 'A book';

        // Order id, you can use it to help you in tagging transactions with your website IDs,
        // if you have no order numbers in your website, leave it 1
        // Variable Type is STRING, MAX: 512 chars
        $order_id = 'Bill_1234567890';

        // After a successful or failed order, the user will be redirected to this URL
        $redirection_url = 'http://localhost/PHP/redirect.php';

        $data = [
            'amount' => $amount,
            'serviceType' => $service_type,
            'msisdn' => $msisdn, // Your wallet phone number
            'orderId' => $order_id,
            'redirectUrl' => $redirection_url,
            'iat' => time(),
            'exp' => time() + 60 * 60 * 4
        ];

        // Encoding Token
        $newtoken = JWT::encode(
            $data,      // Data to be encoded in the JWT
            $secret,
            'HS256' // secret is requested from ZainCash
        );

        $tUrl = 'https://test.zaincash.iq/transaction/init';
        $rUrl = 'https://test.zaincash.iq/transaction/pay?id=';

        // POSTing data to ZainCash API
        $data_to_post = [
            'token' => $newtoken,
            'merchantId' => $merchantid, // Your merchant ID is requested from ZainCash
            'lang' => $language,
        ];

        $options = [
            'http' => [
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data_to_post),
            ],
        ];

        $context = stream_context_create($options);
        $response = file_get_contents($tUrl, false, $context);

        // Parsing response
        $array = json_decode($response, true);
        $transaction_id = $array['id'];
        $newurl = $rUrl . $transaction_id;

        header('Location: ' . $newurl);

        exit(); // Ensure script execution is terminated after redirection
    }
}
