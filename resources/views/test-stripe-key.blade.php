<?php
require 'vendor/autoload.php';

\Stripe\Stripe::setApiKey('sk_test_your_secret_key_here');

try {
    $paymentIntent = \Stripe\PaymentIntent::create([
        'amount' => 1000,
        'currency' => 'usd',
    ]);
    $clientSecret = $paymentIntent->client_secret;
} catch (\Exception $e) {
    $error = $e->getMessage();
    $clientSecret = null;
}
?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <title>اختبار مفتاح Stripe</title>
    <style>
        /* ... أنماط CSS كما في كودك السابق ... */
    </style>
</head>
<body>

<h2>اختبار مفتاح Stripe</h2>
<div id="result">جارٍ التحقق...</div>

<script>
    // استلام القيمة من PHP وتمريرها إلى JS
    const clientSecret = <?php echo json_encode($clientSecret); ?>;
    const error = <?php echo json_encode($error ?? null); ?>;

    const resultEl = document.getElementById('result');

    if (error) {
        resultEl.textContent = '❌ خطأ: ' + error;
        resultEl.className = 'error';
        console.error('خطأ في إنشاء PaymentIntent:', error);
    } else if (clientSecret && clientSecret.startsWith('pi_') && clientSecret.includes('_secret_')) {
        resultEl.textContent = '✔️ المفتاح موجود وصحيح يمكنك استخدامه.';
        resultEl.className = 'success';
        console.log('clientSecret:', clientSecret);
    } else {
        resultEl.textContent = '❌ المفتاح غير موجود أو غير صحيح!';
        resultEl.className = 'error';
        console.error('Client secret غير موجود أو غير صحيح');
    }
</script>

</body>
</html>
