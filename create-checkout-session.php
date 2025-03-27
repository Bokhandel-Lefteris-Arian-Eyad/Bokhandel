<?php
require 'vendor/autoload.php';
\Stripe\Stripe::setApiKey('sk_test_51R738bH66N1S076wBNod0Zd6dyKVJ5ibwZtqmgOR9onHmwNHVoMooti2uPMSKNApWO9j39p6Lr8GGcQlCeH48bjx00hR5IBawg');

try {
  $session = \Stripe\Checkout\Session::create([
    'payment_method_types' => ['card'],
    'mode' => 'payment',
    'line_items' => [[
      'price_data' => [
        'currency' => 'sek',
        'product_data' => [
          'name' => 'Lär dig PHP – Lefteris, Arian och Eyad',
        ],
        'unit_amount' => 19900, // 199 kr i ören
      ],
      'quantity' => 1,
    ]],
    'success_url' => 'http://localhost:8000/success.php',
    'cancel_url' => 'http://localhost:8000/cancel.php',
  ]);

  echo json_encode(['url' => $session->url]);
} catch (Exception $e) {
  http_response_code(500);
  echo json_encode(['error' => $e->getMessage()]);
}
