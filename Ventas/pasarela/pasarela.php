<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="https://www.paypal.com/sdk/js?client-id=ATtIh_sUwNXj36bwlqrcVDNI4NPYq6rengo0A5qR6kSO0lT2dTV2kvT3Rwl8j7wuRR4O22WQCHIE_bGl"></script>

</head>
<body>
    <div id="paypal-button-container">    </div>

    <script>
        paypal.Buttons({
            style:{
                color:'blue',
                shape:'pill',
                label:'pay'
            },
            createOrder: function(data, actions){
                return actions.order.create({
                    purchase_units:[{
                        amount:{
                            value:<?php echo $total; ?>
                        }
                    }]
                });
            },
            onApprove: function(data,actions){
                let URL = 'clases/captura.php'
                actions.order.capture().then(function(detalles){

                    console.log(detalles)
                });
            },

            onCancel: function(data){
                alert("Pago cancelado")
                console.log(data);
            }
        }).render('#paypal-button-container');
    </script>
</body> 
</html>