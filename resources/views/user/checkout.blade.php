<p>決算ページ花</p>
<script src="https://js.stripe.com/v3/"></script>
<script>
    const publicKey = '{{ $publicKey }}'
    const stripe = Stripe(publicKey)
    window.onload = function() {
        stripe.redirectToCheckout({
            sessionId: '{{ $session->id }}' //checkアウトメソッドで作った、購入情報やユーザー情報を入れたセッションセッションを指定
        }).then(function(result) {
            window.location.href = '{{ route('user.cart.cancel') }}';
        });
    }
</script>
