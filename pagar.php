<?php
include 'global/config.php';
include 'global/conexion.php';
include 'carrito.php';
include 'templates/cabecera.php';
?>
<?php 
if($_POST){

    $total=0;
    $SID=session_id();
    $Correo=$_POST['email']; 

    foreach ($_SESSION['CARRITO'] as $indice => $producto) {
      $total = $total+($producto['PRECIO']*$producto['CANTIDAD']);  
    }
    $sentencia = $pdo ->prepare("INSERT INTO `tblventas` 
              (`ID`, `ClaveTransacion`, `PaypalDatos`, `Fecha`, `Correo`, `Total`, `status`) 
    VALUES (NULL,:ClaveTransaccion , '', NOW(), :Correo,:Total, 'pendiente');");
    
    $sentencia->bindParam(":ClaveTransaccion",$SID);
    $sentencia->bindParam(":Correo",$Correo);
    $sentencia->bindParam(":Total",$total);    
    $sentencia->execute();
    $idVenta=$pdo->lastInsertId(); 

    foreach ($_SESSION['CARRITO'] as $indice => $producto) {

      $sentencia = $pdo ->prepare("INSERT INTO 
      `tbldetalleventa` (`ID`, `IDVENTA`, `IDPRODUCTO`, `PRECIOUNITARIO`, `CANTIDAD`, `DESCARGADO`) 
      VALUES (NULL,:IDVENTA,:IDPRODUCTO,:PRECIOUNITARIO,:CANTIDAD, '0');");

      $sentencia->bindParam(":IDVENTA",$idVenta);
      $sentencia->bindParam(":IDPRODUCTO",$producto['ID']);
      $sentencia->bindParam(":PRECIOUNITARIO",$producto['PRECIO']);    
      $sentencia->bindParam(":CANTIDAD",$producto['CANTIDAD']);    
      $sentencia->execute();
    }
   /*  echo "<h3>".$total. "</h3>"; */
}

?>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>            <!-- pypal -->

<style>
    
    /* Media query for mobile viewport */
    @media screen and (max-width: 400px) {
        #paypal-button-container {
            width: 100%;
        }
    }
    
    /* Media query for desktop viewport */
    @media screen and (min-width: 400px) {
        #paypal-button-container {
            width: 250px;
            display: inline-block;
        }
    }
    
</style>

<div class="jumbotron text-center ">
  <h1 class="display-4">¡Paso Final!</h1>  
  <hr class="my-4">
  <p class="lead">Estas a punto de pagar con paypal la cantidad de:
    <h4>$ <?php echo number_format($total,2); ?></h4>
    <div id="paypal-button-container" class="text-center"></div>                       <!-- boton de paypal -->
  </p>

    <p>El contenido podra ser descargado una vez que se realice el pago<br>
      <strong>(para aclaraciones: gutierrezsanabria@gmail.com) </strong>
    </p>
</div>

<script>
    //boton de pago

    paypal.Button.render({
        env: 'sandbox', // sandbox | production
        style: {
            label: 'checkout',  // checkout | credit | pay | buynow | generic
            size: 'responsive', // small | medium | large | responsive
            shape: 'pill',   // pill | rect
            color: 'gold'   // gold | blue | silver | black
        },
 
        // PayPal Client IDs - reemplaza con tus propias credenciales
        // Crea una aplicación PayPal: https://developer.paypal.com/developer/applications/create
        client: {
            sandbox: 'AULrclT1bl8LMQvQhQEu13E_20yqUxDfsw0A7-gnIkJZejamQInWOAKJ7H-3iAMsU7KIvBRFMVMmdQ3k',
            production: ''
        },
 
        // Espera a que el botón de PayPal sea clicado
        payment: function(data, actions) {
            return actions.payment.create({
                payment: {
                    transactions: [
                        {
                            amount: { total: '<?php echo $total; ?>', currency: 'MXN' }, 
                            description: "Compra de productos a AUDAVIALL:$<?php echo number_format ($total,2); ?>",
                            custom: "<?php echo $SID; ?>#<?php echo openssl_encrypt($idVenta,COD,KEY); ?>"
                        }
                    ]
                }
            });
        },
 
        // Espera a que el pago sea autorizado por el cliente
        onAuthorize: function(data, actions) {
            return actions.payment.execute().then(function() {
                console.log(data);
                window.location = "verificador.php?paymentToken=" + data.paymentToken + "&paymentID=" + data.paymentID;
            });
        }
    }, '#paypal-button-container');
</script>
    

<?php  include 'templates/pie.php'; ?>