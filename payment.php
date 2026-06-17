<?php
// PhonePe integration placeholder. Add real Merchant ID, Salt Key, and Salt Index from PhonePe Business.
// Keep these values outside public git in production, preferably in environment variables.
define('PHONEPE_MERCHANT_ID', getenv('PHONEPE_MERCHANT_ID') ?: 'YOUR_PHONEPE_MERCHANT_ID');
define('PHONEPE_SALT_KEY', getenv('PHONEPE_SALT_KEY') ?: 'YOUR_PHONEPE_SALT_KEY');
define('PHONEPE_SALT_INDEX', getenv('PHONEPE_SALT_INDEX') ?: '1');
define('PHONEPE_PAY_URL', getenv('PHONEPE_PAY_URL') ?: 'https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/pay');

function phonepe_payload(array $reservation, string $redirectUrl, string $callbackUrl): array {
    $merchantTransactionId = $reservation['transaction_id'];
    $payload = [
        'merchantId' => PHONEPE_MERCHANT_ID,
        'merchantTransactionId' => $merchantTransactionId,
        'merchantUserId' => 'USER_' . ($reservation['user_id'] ?? 'GUEST'),
        'amount' => ((int)$reservation['amount_inr']) * 100,
        'redirectUrl' => $redirectUrl,
        'redirectMode' => 'POST',
        'callbackUrl' => $callbackUrl,
        'paymentInstrument' => ['type' => 'PAY_PAGE'],
    ];
    $base64 = base64_encode(json_encode($payload));
    $checksum = hash('sha256', $base64 . '/pg/v1/pay' . PHONEPE_SALT_KEY) . '###' . PHONEPE_SALT_INDEX;
    return ['request' => $base64, 'X-VERIFY' => $checksum, 'endpoint' => PHONEPE_PAY_URL];
}
?>
