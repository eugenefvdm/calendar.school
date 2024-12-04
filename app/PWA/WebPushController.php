<?php

namespace App\PWA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Minishlink\WebPush\Subscription;
use Minishlink\WebPush\WebPush;

class WebPushController extends Controller
{
    public function sendNotification(Request $request)
    {
        // Assuming the subscription details are sent as JSON in the request body
        $subscription = Subscription::create($request->input());

        $auth = [
            'VAPID' => [
                'subject' => 'https://github.com/Minishlink/web-push-php-example/',
                'publicKey' => config('webpush.vapid.public_key'),
                'privateKey' => config('webpush.vapid.private_key'),
//                'publicKey' => file_get_contents(storage_path('app/keys/public_key.txt')),
//                'privateKey' => file_get_contents(storage_path('app/keys/private_key.txt')),
            ],
        ];

        $webPush = new WebPush($auth);

        $report = $webPush->sendOneNotification(
            $subscription,
            '{"title":"Hello from WebPushController","body":"Hello! 👋"}'
        );

        // Handle eventual errors here, and remove the subscription from your server if it is expired
        $endpoint = $report->getRequest()->getUri()->__toString();

        if ($report->isSuccess()) {
            return response()->json(['message' => "Message sent successfully for subscription {$endpoint}."]);
        } else {
            return response()->json(['error' => "Message failed to send for subscription {$endpoint}: {$report->getReason()}"], 500);
        }
    }
}
