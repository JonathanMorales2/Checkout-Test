<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect payment data from the form
    $amount = $_POST['amount'];
    $currency = $_POST['currency'];
    // ... Collect other relevant data from the form

    // Set up API endpoint and headers
    $endpoint = 'https://api.sandbox.checkout.com/tokens'; 
    $headers = [
        'Authorization: Basic ' . base64_encode('k_sbox_fzspyszrkddxsgozkyqjbw4w7aw:sk_sbox_o2nulev2arguvyf6w7sc5fkznas'),
        'Content-Type: application/json',
    ];

    // Create payment data array
    $paymentData = [
        'channel_id' => 'pc_zs5fqhybzc2e3jmq3efvybybpq',
        'amount' => $amount,
        'currency' => $currency,
        // ... Add other payment-related data
    ];

    // Send payment request to the payment provider's API
    $ch = curl_init($endpoint);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($paymentData));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);
    curl_close($ch);

    // Process the response from the payment provider
    $responseData = json_decode($response, true);

    if ($responseData['status'] === 'success') {
        // Payment was successful
        // ... Handle successful payment
    } else {
        // Payment failed
        // ... Handle payment failure
    }
}
?>


