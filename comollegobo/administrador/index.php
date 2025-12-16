<!DOCTYPE html>
<html>
<head>
    <title>Simple Map</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="estilos.css">
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places"></script>
    <script>
        var map;
            <?php
            $con = mysqli_connect("localhost", "root", "superusuario", "comollego") or die("Problemas con la conexion a la base de datos");
            $registros = mysqli_query($con, "select * from parada") or die("Error en la consulta sql: ". mysqli_error($con));
            $cantidaddepuntos = 0;

        while ($reg = mysqli_fetch_array($registros)) {
            $id[$cantidaddepuntos] = $reg['idparada'];
            $lat[$cantidaddepuntos] = $reg['latitud'];
            $lng[$cantidaddepuntos] = $reg['longitud'];
            $cantidaddepuntos++;
        }
        mysqli_close($con);
        ?>
        var puntos = [<?php
        for ($i = 0; $i < $cantidaddepuntos; $i++) {
            if ($i != 0) {
                echo ",\n            ";
            }
            echo "new google.maps.LatLng(" . $lat[$i] . ", " . $lng[$i] . ")";
        }
        ?>];
        var id = [<?php
        for ($i = 0; $i < $cantidaddepuntos; $i++) {
            if ($i != 0) {
                echo ", ";
            }
            echo "\"" . htmlspecialchars($id[$i], ENT_QUOTES, 'UTF-8') . "\"";
        }
        ?>];
    </script>
    <script type="text/javascript" src="codigo.js"></script>
</head>
<body>
<div id="map-canvas"></div>
</body>
</html>
