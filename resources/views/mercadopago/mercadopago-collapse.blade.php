<label class="mt-3">Detalle de la Tarjeta:</label>

<div class="form-group form-row">
    <div class="col-5">
        <input type="text" id="cardNumber" data-checkout="cardNumber" placeholder="Numero de Tarjeta" class="form-control">
    </div>
    <div class="col-2">
        <input type="text" data-checkout="securityCode" placeholder="Codigo de Tarjeta" class="form-control">
    </div>
        
    <div class="col-2">
        <input type="text" data-checkout="cardExpirationMonth" placeholder="MM" class="form-control">
    </div>
    <div class="col-2">
        <input type="text" data-checkout="cardExpirationYear" placeholder="YY" class="form-control">
    </div>
</div>

<div class="form-group form-row">
    <div class="col-5">
        <input type="text" data-checkout="cardholderName" placeholder="Nombre" class="form-control">
    </div>
    <div class="col-5">
        <input type="email" name="email" data-checkout="cardholderEmail" placeholder="example@example.com" class="form-control">
    </div>
</div>

<div class="form-group form-row">
    <div class="col-5">
        <label for="docType">Tipo de documento</label>
        <select class="custom-select" id="docType" data-checkout="docType">
        </select>
    </div>
    <div class="col-3">
        <input type="text" data-checkout="docNumber" placeholder="Documento" class="form-control">
    </div>
</div>

<div class="form-group form-row">
    <div class="col">
        <small class="form-text text-muter" role="alert">
            Su pago sera convertido a {{strtoupper(config('services.mercadopago.base_currency'))}}
        </small>
    </div>
</div>
<div class="form-group form-row">
    <div class="col">
        <small class="form-text text-danger" id="paymentsErrors" role="alert">
        </small>
    </div>
</div>

<input type="hidden" id="cardNetwork" name="card_network">
<input type="hidden" id="cardToken" name="card_token">

@push('scripts')
<script src="https://secure.mlstatic.com/sdk/javascript/v1/mercadopago.js"></script>

<script>
    const mercadoPago = window.Mercadopago;

    mercadoPago.setPublishableKey('{{ config('services.mercadopago.key') }}');
    
    mercadoPago.getIdentificationTypes();
</script>

<script>
    const mercadoPagoForm = document.getElementById("paymentForm");

    mercadoPagoForm.addEventListener('submit', function (e) {
        
        e.preventDefault();

        const cardNumber = document.getElementById("cardNumber");
        mercadoPago.getPaymentMethod(
            { "bin": cardNumber.value.substring(0,6) },
            function(status, response) {
                const cardNetwork = document.getElementById("cardNetwork");
                cardNetwork.value = response[0].id;
            }
        );
        
        if (mercadoPagoForm.elements.payment_platform.value === "{{ $paymentPlatform->id }}") {
            mercadoPago.createToken(mercadoPagoForm, async function(status, response) {
                if (status != 200 && status != 201) {
                    const errors = document.getElementById("paymentErrors");
                    errors.textContent = response.cause[0].description;
                } else {
                    const cardToken = document.getElementById("cardToken");
                    cardToken.value = response.id;
                    mercadoPagoForm.submit();
                }
            });
        }
        
    });
</script>
@endpush