<main class="pagina">
    <h2 class="pagina__heading"><?php echo $titulo; ?></h2>
    <p class="pagina__descripcion">Elige tu Plan</p>

    <div class="paquetes__grid">
        <div class="paquete">
            <h3 class="paquete__nombre">Pase Gratis</h3>
            <ul class="paquete__lista">
                <li class="paquete__elemento">Acceso Virtual a DevWebCamp</li>
            </ul>
            <p class="paquete__precio">$0</p>
            <form method="POST" action="/finalizar-registro/gratis">
                <input class="paquetes__submit" type="submit" value="Inscripción Gratis">
            </form>
        </div>

        <div class="paquete">
            <h3 class="paquete__nombre">Pase Presencial</h3>
            <ul class="paquete__lista">
                <li class="paquete__elemento">Acceso Presencial a DevWebCamp</li>
                <li class="paquete__elemento">Pase por 2 Días</li>
                <li class="paquete__elemento">Acceso a Talleres y Conferencias</li>
                <li class="paquete__elemento">Acceso a las Grabaciones</li>
                <li class="paquete__elemento">Camisa del Evento</li>
                <li class="paquete__elemento">Comida y Bebida</li>
            </ul>
            <p class="paquete__precio">$199</p>

            <div id="smart-button-container">
                <div style="text-align: center;">
                    <div id="paypal-button-container-presencial"></div>
                </div>
            </div>
        </div>

        <div class="paquete">
            <h3 class="paquete__nombre">Pase Virtual</h3>
            <ul class="paquete__lista">
                <li class="paquete__elemento">Acceso Virtual a DevWebCamp</li>
                <li class="paquete__elemento">Pase por 2 Días</li>
                <li class="paquete__elemento">Acceso a Talleres y Conferencias</li>
                <li class="paquete__elemento">Acceso a las Grabaciones</li>
            </ul>
            <p class="paquete__precio">$49</p>

            <div id="smart-button-container">
                <div style="text-align: center;">
                    <div id="paypal-button-container-virtual"></div>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="https://www.paypal.com/sdk/js?client-id=Ac9bbug3KuBkH5iu7FrTRDtxPRoCl4dAaPyQmhLdjOL_zdXxCW66jmGBn3qMzTZw15cCrrkx3MIrZgxv&components=buttons&disable-funding=venmo&currency=USD" data-sdk-integration-source="button-factory"></script>

<script>
    function initPayPalButton() {
        // ------------------------------------------------
        // BOTÓN 1: PASE PRESENCIAL
        // ------------------------------------------------
        paypal.Buttons({
            style: {
                shape: 'rect',
                color: 'blue',
                layout: 'vertical',
                label: 'pay',
            },

            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        "description": "1", // 1 = Pase Presencial
                        "amount": {
                            "currency_code": "USD",
                            "value": 199 // Precio del presencial
                        }
                    }]
                });
            },

            onApprove: function(data, actions) {
                return actions.order.capture().then(function(orderData) {

                    const datos = new FormData();
                    datos.append('paquete_id', orderData.purchase_units[0].description);
                    datos.append('pago_id', orderData.purchase_units[0].payments.captures[0].id);

                    fetch('/finalizar-registro/pagar', {
                        method: 'POST',
                        body: datos
                    })
                    .then(respuesta => respuesta.json())
                    .then(resultado => {
                        if (resultado.resultado === true) {
                            window.location.href = '/finalizar-registro/conferencias';
                        } else {
                            // En producción puedes cambiar esto por un SweetAlert
                            alert('Hubo un error: ' + resultado.error); 
                        }
                    })
                    .catch(error => console.log(error));
                });
            },

            onError: function(err) {
                console.log(err);
            }
        }).render('#paypal-button-container-presencial'); // ID del Div Presencial


        // ------------------------------------------------
        // BOTÓN 2: PASE VIRTUAL
        // ------------------------------------------------
        paypal.Buttons({
            style: {
                shape: 'rect',
                color: 'blue',
                layout: 'vertical',
                label: 'pay',
            },

            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        "description": "2", // 2 = Pase Virtual
                        "amount": {
                            "currency_code": "USD",
                            "value": 49 // Precio del virtual
                        }
                    }]
                });
            },

            onApprove: function(data, actions) {
                return actions.order.capture().then(function(orderData) {

                    const datos = new FormData();
                    datos.append('paquete_id', orderData.purchase_units[0].description);
                    datos.append('pago_id', orderData.purchase_units[0].payments.captures[0].id);

                    fetch('/finalizar-registro/pagar', {
                        method: 'POST',
                        body: datos
                    })
                    .then(respuesta => respuesta.json())
                    .then(resultado => {
                        if (resultado.resultado === true) {
                            window.location.href = '/boleto?id=' + resultado.token;
                        } else {
                            // En producción puedes cambiar esto por un SweetAlert
                            alert('Hubo un error: ' + resultado.error); 
                        }
                    })
                    .catch(error => console.log(error));
                });
            },

            onError: function(err) {
                console.log(err);
            }
        }).render('#paypal-button-container-virtual'); // ID del Div Virtual
    }

    initPayPalButton();
</script>