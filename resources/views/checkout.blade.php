<!-- resources/views/checkout.blade.php -->
<form action="/charge" method="POST" id="payment-form">
    @csrf
    <script
        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
        data-key="{{ env('STRIPE_KEY') }}"
        data-amount="2000"
        data-name="Test Payment"
        data-description="Using Stripe"
        data-image="https://stripe.com/img/documentation/checkout/marketplace.png"
        data-locale="auto"
        data-currency="usd">
    </script>
</form>
