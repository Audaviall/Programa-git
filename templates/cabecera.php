!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equi="X-UA-Compatible" content="ie=edge">    
    <title>Tienda</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


// imagen de fondo
    <style>
        body {
            background-image: url(../archivos/fenix.png);
            background-size: cover;
            filter: blur(60%); /* Ajusta el valor para controlar el nivel de desenfoque */
        }
    </style>









    
</head>
<body>



<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <a class="navbar-brand" href="index.php"> 
    <img src="/archivos/fenix.png" alt="Logo de la empresa AUDAVIALL" width="50" height="50" class="d-inline-block align-top">
 AUDAVIALL</a>
    <button class="navbar-toggler" data-target="#my-nav" data-toggle="collapse" aria-controls="my-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div id="my-nav" class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="index.php"><i class="fas fa-home"></i> Home</a>
            </li> 
            
            
            <li class="nav-item active">
                <a class="nav-link" href="mostrarCarrito.php"><i class="fas fa-shopping-cart"></i> Carrito(<?php
                echo (empty ($_SESSION['CARRITO']))?0: count ($_SESSION['CARRITO']);
                ?>)</a>

                
            </li> 
            
        </ul>
        <img src="/archivos/fenix.png" alt="Logo de la empresa AUDAVIALL" width="50" height="50" class="d-inline-block align-top">
 AUDAVIALL</a>
    </div>
</nav>




<br/>
<br/>
<div class="container">