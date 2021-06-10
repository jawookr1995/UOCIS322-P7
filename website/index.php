<html>
    <head>
        <title>Brevet Calculation Result</title>
        <link rel="stylesheet"
            href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <script
            src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js">
        </script>
    </head>

    <body>
    <h3 class="text-center">/listAll</h3>
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col col-lg-2">
                </div>
                <div class="col-md-auto">
                <?php
                    $json = file_get_contents('http://laptop-service/listAll');
                    $obj = json_decode($json);
                    $ddt = $obj->ddt;
                    $header = $obj->header;
                    $items = $obj->items;
                    echo "<table class=\"table table-bordered\">";
                    foreach ($ddt as $l) {
                        echo "<tr>";
                        foreach($l as $i) {
                            echo "<td>$i</td>";
                        }
                        echo "</tr>";
                    }
                    echo "</table>";
                    echo "<br>";
                    echo "<table class=\"table table-bordered\">";
                    echo "<thead>";
                    foreach ($header as $l) {
                        echo "<tr>";
                        echo "<th>#Brevet</th>";
                        foreach($l as $i) {
                            echo "<th>$i</th>";
                        }
                        echo "</tr>";
                    }
                    echo "</thead>";
                    $index = 1;
                    echo "<tbody>";
                    foreach ($items as $l) {
                        echo "<tr>";
                        echo "<th>$index</th>";
                        foreach($l as $i) {
                            echo "<td>$i</td>";
                        }
                        echo "</tr>";
                        $index++;
                    }
                    echo "</tbody>";
                    echo "</table>";
                    $json = 0;
                ?>
                </div>
                <div class="col col-lg-2">
                </div>
            </div>
        </div>

        <h3 class="text-center">/listOpenOnly</h3>
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col col-lg-2">
                </div>
                <div class="col-md-auto">
                <?php
                    $json = file_get_contents('http://laptop-service/listOpenOnly');
                    $obj = json_decode($json);
                    $ddt = $obj->ddt;
                    $header = $obj->header;
                    $items = $obj->items;
                    echo "<table class=\"table table-bordered\">";
                    foreach ($ddt as $l) {
                        echo "<tr>";
                        foreach($l as $i) {
                            echo "<td>$i</td>";
                        }
                        echo "</tr>";
                    }
                    echo "</table>";
                    echo "<br>";
                    echo "<table class=\"table table-bordered\">";
                    echo "<thead>";
                    foreach ($header as $l) {
                        echo "<tr>";
                        echo "<th>#Brevet</th>";
                        foreach($l as $i) {
                            echo "<th>$i</th>";
                        }
                        echo "</tr>";
                    }
                    echo "</thead>";
                    $index = 1;
                    echo "<tbody>";
                    foreach ($items as $l) {
                        echo "<tr>";
                        echo "<th>$index</th>";
                        foreach($l as $i) {
                            echo "<td>$i</td>";
                        }
                        echo "</tr>";
                        $index++;
                    }
                    echo "</tbody>";
                    echo "</table>";
                    $json = 0;
                ?>
                </div>
                <div class="col col-lg-2">
                </div>
            </div>
        </div>

        <h3 class="text-center">/listCloseOnly</h3>
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col col-lg-2">
                </div>
                <div class="col-md-auto">
                <?php
                    $json = file_get_contents('http://laptop-service/listCloseOnly');
                    $obj = json_decode($json);
                    $ddt = $obj->ddt;
                    $header = $obj->header;
                    $items = $obj->items;
                    echo "<table class=\"table table-bordered\">";
                    foreach ($ddt as $l) {
                        echo "<tr>";
                        foreach($l as $i) {
                            echo "<td>$i</td>";
                        }
                        echo "</tr>";
                    }
                    echo "</table>";
                    echo "<br>";
                    echo "<table class=\"table table-bordered\">";
                    echo "<thead>";
                    foreach ($header as $l) {
                        echo "<tr>";
                        echo "<th>#Brevet</th>";
                        foreach($l as $i) {
                            echo "<th>$i</th>";
                        }
                        echo "</tr>";
                    }
                    echo "</thead>";
                    $index = 1;
                    echo "<tbody>";
                    foreach ($items as $l) {
                        echo "<tr>";
                        echo "<th>$index</th>";
                        foreach($l as $i) {
                            echo "<td>$i</td>";
                        }
                        echo "</tr>";
                        $index++;
                    }
                    echo "</tbody>";
                    echo "</table>";
                    $json = 0;
                ?>
                </div>
                <div class="col col-lg-2">
                </div>
            </div>
        </div>

        <h3 class="text-center">/listAll/json</h3>
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col col-lg-2">
                </div>
                <div class="col-md-auto">
                <?php
                    $json = file_get_contents('http://laptop-service/listAll/json');
                    $obj = json_decode($json);
                    $ddt = $obj->ddt;
                    $header = $obj->header;
                    $items = $obj->items;
                    echo "<table class=\"table table-bordered\">";
                    foreach ($ddt as $l) {
                        echo "<tr>";
                        foreach($l as $i) {
                            echo "<td>$i</td>";
                        }
                        echo "</tr>";
                    }
                    echo "</table>";
                    echo "<br>";
                    echo "<table class=\"table table-bordered\">";
                    echo "<thead>";
                    foreach ($header as $l) {
                        echo "<tr>";
                        echo "<th>#Brevet</th>";
                        foreach($l as $i) {
                            echo "<th>$i</th>";
                        }
                        echo "</tr>";
                    }
                    echo "</thead>";
                    $index = 1;
                    echo "<tbody>";
                    foreach ($items as $l) {
                        echo "<tr>";
                        echo "<th>$index</th>";
                        foreach($l as $i) {
                            echo "<td>$i</td>";
                        }
                        echo "</tr>";
                        $index++;
                    }
                    echo "</tbody>";
                    echo "</table>";
                    $json = 0;
                ?>
                </div>
                <div class="col col-lg-2">
                </div>
            </div>
        </div>

        <h3 class="text-center">/listOpenOnly/json</h3>
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col col-lg-2">
                </div>
                <div class="col-md-auto">
                <?php
                    $json = file_get_contents('http://laptop-service/listOpenOnly/json');
                    $obj = json_decode($json);
                    $ddt = $obj->ddt;
                    $header = $obj->header;
                    $items = $obj->items;
                    echo "<table class=\"table table-bordered\">";
                    foreach ($ddt as $l) {
                        echo "<tr>";
                        foreach($l as $i) {
                            echo "<td>$i</td>";
                        }
                        echo "</tr>";
                    }
                    echo "</table>";
                    echo "<br>";
                    echo "<table class=\"table table-bordered\">";
                    echo "<thead>";
                    foreach ($header as $l) {
                        echo "<tr>";
                        echo "<th>#Brevet</th>";
                        foreach($l as $i) {
                            echo "<th>$i</th>";
                        }
                        echo "</tr>";
                    }
                    echo "</thead>";
                    $index = 1;
                    echo "<tbody>";
                    foreach ($items as $l) {
                        echo "<tr>";
                        echo "<th>$index</th>";
                        foreach($l as $i) {
                            echo "<td>$i</td>";
                        }
                        echo "</tr>";
                        $index++;
                    }
                    echo "</tbody>";
                    echo "</table>";
                    $json = 0;
                ?>
                </div>
                <div class="col col-lg-2">
                </div>
            </div>
        </div>

        <h3 class="text-center">/listCloseOnly/json</h3>
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col col-lg-2">
                </div>
                <div class="col-md-auto">
                <?php
                    $json = file_get_contents('http://laptop-service/listCloseOnly/json');
                    $obj = json_decode($json);
                    $ddt = $obj->ddt;
                    $header = $obj->header;
                    $items = $obj->items;
                    echo "<table class=\"table table-bordered\">";
                    foreach ($ddt as $l) {
                        echo "<tr>";
                        foreach($l as $i) {
                            echo "<td>$i</td>";
                        }
                        echo "</tr>";
                    }
                    echo "</table>";
                    echo "<br>";
                    echo "<table class=\"table table-bordered\">";
                    echo "<thead>";
                    foreach ($header as $l) {
                        echo "<tr>";
                        echo "<th>#Brevet</th>";
                        foreach($l as $i) {
                            echo "<th>$i</th>";
                        }
                        echo "</tr>";
                    }
                    echo "</thead>";
                    $index = 1;
                    echo "<tbody>";
                    foreach ($items as $l) {
                        echo "<tr>";
                        echo "<th>$index</th>";
                        foreach($l as $i) {
                            echo "<td>$i</td>";
                        }
                        echo "</tr>";
                        $index++;
                    }
                    echo "</tbody>";
                    echo "</table>";
                    $json = 0;
                ?>
                </div>
                <div class="col col-lg-2">
                </div>
            </div>
        </div>
        <h3 class="text-center">/listAll/csv</h3>
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col col-lg-2">
                </div>
                <div class="col-md-auto">
                <?php
                    $json = file_get_contents('http://laptop-service/listAll/csv');
                    $json = str_replace(array('\"', '"'), '', $json);
                    $json = str_replace(array('\n'), '\\', $json);
                    $row = str_getcsv($json, '\n');
                    $rlen = count($row) - 1;
                    echo "<table class=\"table table-bordered\">";
                    echo "<tbody>";
                    
                    for($i = 0; $i < $rlen; $i++) {
                        $col = str_getcsv($row[$i], ',');
                        $clen = count($col);
                        echo "<tr>";
                        for($j = 0; $j < $clen; $j++) {
                            if ($col[$j] != "" || $j == 2) {
                                echo "<td>$col[$j]</td>";
                            }
                        }
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";
                    $json = 0;
                ?>
                </div>
                <div class="col col-lg-2">
                </div>
            </div>
        </div>
        <h3 class="text-center">/listOpenOnly/csv</h3>
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col col-lg-2">
                </div>
                <div class="col-md-auto">
                <?php
                    $json = file_get_contents('http://laptop-service/listOpenOnly/csv');
                    $json = str_replace(array('\"', '"'), '', $json);
                    $json = str_replace(array('\n'), '\\', $json);
                    $row = str_getcsv($json, '\n');
                    $rlen = count($row) - 1;
                    echo "<table class=\"table table-bordered\">";
                    echo "<tbody>";
                    
                    for($i = 0; $i < $rlen; $i++) {
                        $col = str_getcsv($row[$i], ',');
                        $clen = count($col);
                        echo "<tr>";
                        for($j = 0; $j < $clen; $j++) {
                            if ($col[$j] != "" || $j == 2) {
                                echo "<td>$col[$j]</td>";
                            }
                        }
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";
                    $json = 0;
                ?>
                </div>
                <div class="col col-lg-2">
                </div>
            </div>
        </div>
        <h3 class="text-center">/listCloseOnly/csv</h3>
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col col-lg-2">
                </div>
                <div class="col-md-auto">
                <?php
                    $json = file_get_contents('http://laptop-service/listCloseOnly/csv');
                    $json = str_replace(array('\"', '"'), '', $json);
                    $json = str_replace(array('\n'), '\\', $json);
                    $row = str_getcsv($json, '\n');
                    $rlen = count($row) - 1;
                    echo "<table class=\"table table-bordered\">";
                    echo "<tbody>";
                    
                    for($i = 0; $i < $rlen; $i++) {
                        $col = str_getcsv($row[$i], ',');
                        $clen = count($col);
                        echo "<tr>";
                        for($j = 0; $j < $clen; $j++) {
                            if ($col[$j] != "" || $j == 2) {
                                echo "<td>$col[$j]</td>";
                            }
                        }
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";
                    $json = 0;
                ?>
                </div>
                <div class="col col-lg-2">
                </div>
            </div>
        </div>
        <h3 class="text-center">/listAll/json?top=2</h3>
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col col-lg-2">
                </div>
                <div class="col-md-auto">
                <?php
                    $json = file_get_contents('http://laptop-service/listAll/json?top=2');
                    $obj = json_decode($json);
                    $ddt = $obj->ddt;
                    $header = $obj->header;
                    $items = $obj->items;
                    echo "<table class=\"table table-bordered\">";
                    foreach ($ddt as $l) {
                        echo "<tr>";
                        foreach($l as $i) {
                            echo "<td>$i</td>";
                        }
                        echo "</tr>";
                    }
                    echo "</table>";
                    echo "<br>";
                    echo "<table class=\"table table-bordered\">";
                    echo "<thead>";
                    foreach ($header as $l) {
                        echo "<tr>";
                        echo "<th>#Brevet</th>";
                        foreach($l as $i) {
                            echo "<th>$i</th>";
                        }
                        echo "</tr>";
                    }
                    echo "</thead>";
                    $index = 1;
                    echo "<tbody>";
                    foreach ($items as $l) {
                        echo "<tr>";
                        echo "<th>$index</th>";
                        foreach($l as $i) {
                            echo "<td>$i</td>";
                        }
                        echo "</tr>";
                        $index++;
                    }
                    echo "</tbody>";
                    echo "</table>";
                    $json = 0;
                ?>
                </div>
                <div class="col col-lg-2">
                </div>
            </div>
        </div>

        <h3 class="text-center">/listOpenOnly/json?top=5</h3>
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col col-lg-2">
                </div>
                <div class="col-md-auto">
                <?php
                    $json = file_get_contents('http://laptop-service/listOpenOnly/json?top=5');
                    $obj = json_decode($json);
                    $ddt = $obj->ddt;
                    $header = $obj->header;
                    $items = $obj->items;
                    echo "<table class=\"table table-bordered\">";
                    foreach ($ddt as $l) {
                        echo "<tr>";
                        foreach($l as $i) {
                            echo "<td>$i</td>";
                        }
                        echo "</tr>";
                    }
                    echo "</table>";
                    echo "<br>";
                    echo "<table class=\"table table-bordered\">";
                    echo "<thead>";
                    foreach ($header as $l) {
                        echo "<tr>";
                        echo "<th>#Brevet</th>";
                        foreach($l as $i) {
                            echo "<th>$i</th>";
                        }
                        echo "</tr>";
                    }
                    echo "</thead>";
                    $index = 1;
                    echo "<tbody>";
                    foreach ($items as $l) {
                        echo "<tr>";
                        echo "<th>$index</th>";
                        foreach($l as $i) {
                            echo "<td>$i</td>";
                        }
                        echo "</tr>";
                        $index++;
                    }
                    echo "</tbody>";
                    echo "</table>";
                    $json = 0;
                ?>
                </div>
                <div class="col col-lg-2">
                </div>
            </div>
        </div>

        <h3 class="text-center">/listCloseOnly/json?top=4</h3>
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col col-lg-2">
                </div>
                <div class="col-md-auto">
                <?php
                    $json = file_get_contents('http://laptop-service/listCloseOnly/json?top=4');
                    $obj = json_decode($json);
                    $ddt = $obj->ddt;
                    $header = $obj->header;
                    $items = $obj->items;
                    echo "<table class=\"table table-bordered\">";
                    foreach ($ddt as $l) {
                        echo "<tr>";
                        foreach($l as $i) {
                            echo "<td>$i</td>";
                        }
                        echo "</tr>";
                    }
                    echo "</table>";
                    echo "<br>";
                    echo "<table class=\"table table-bordered\">";
                    echo "<thead>";
                    foreach ($header as $l) {
                        echo "<tr>";
                        echo "<th>#Brevet</th>";
                        foreach($l as $i) {
                            echo "<th>$i</th>";
                        }
                        echo "</tr>";
                    }
                    echo "</thead>";
                    $index = 1;
                    echo "<tbody>";
                    foreach ($items as $l) {
                        echo "<tr>";
                        echo "<th>$index</th>";
                        foreach($l as $i) {
                            echo "<td>$i</td>";
                        }
                        echo "</tr>";
                        $index++;
                    }
                    echo "</tbody>";
                    echo "</table>";
                    $json = 0;
                ?>
                </div>
                <div class="col col-lg-2">
                </div>
            </div>
        </div>
        <h3 class="text-center">/listAll/csv?top=2</h3>
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col col-lg-2">
                </div>
                <div class="col-md-auto">
                <?php
                    $json = file_get_contents('http://laptop-service/listAll/csv?top=2');
                    $json = str_replace(array('\"', '"'), '', $json);
                    $json = str_replace(array('\n'), '\\', $json);
                    $row = str_getcsv($json, '\n');
                    $rlen = count($row) - 1;
                    echo "<table class=\"table table-bordered\">";
                    echo "<tbody>";
                    
                    for($i = 0; $i < $rlen; $i++) {
                        $col = str_getcsv($row[$i], ',');
                        $clen = count($col);
                        echo "<tr>";
                        for($j = 0; $j < $clen; $j++) {
                            if ($col[$j] != "" || $j == 2) {
                                echo "<td>$col[$j]</td>";
                            }
                        }
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";
                    $json = 0;
                ?>
                </div>
                <div class="col col-lg-2">
                </div>
            </div>
        </div>
        <h3 class="text-center">/listOpenOnly/csv?top=3</h3>
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col col-lg-2">
                </div>
                <div class="col-md-auto">
                <?php
                    $json = file_get_contents('http://laptop-service/listOpenOnly/csv?top=3');
                    $json = str_replace(array('\"', '"'), '', $json);
                    $json = str_replace(array('\n'), '\\', $json);
                    $row = str_getcsv($json, '\n');
                    $rlen = count($row) - 1;
                    echo "<table class=\"table table-bordered\">";
                    echo "<tbody>";
                    
                    for($i = 0; $i < $rlen; $i++) {
                        $col = str_getcsv($row[$i], ',');
                        $clen = count($col);
                        echo "<tr>";
                        for($j = 0; $j < $clen; $j++) {
                            if ($col[$j] != "" || $j == 2) {
                                echo "<td>$col[$j]</td>";
                            }
                        }
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";
                    $json = 0;
                ?>
                </div>
                <div class="col col-lg-2">
                </div>
            </div>
        </div>
        <h3 class="text-center">/listCloseOnly/csv?top=5</h3>
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col col-lg-2">
                </div>
                <div class="col-md-auto">
                <?php
                    $json = file_get_contents('http://laptop-service/listCloseOnly/csv?top=5');
                    $json = str_replace(array('\"', '"'), '', $json);
                    $json = str_replace(array('\n'), '\\', $json);
                    $row = str_getcsv($json, '\n');
                    $rlen = count($row) - 1;
                    echo "<table class=\"table table-bordered\">";
                    echo "<tbody>";
                    
                    for($i = 0; $i < $rlen; $i++) {
                        $col = str_getcsv($row[$i], ',');
                        $clen = count($col);
                        echo "<tr>";
                        for($j = 0; $j < $clen; $j++) {
                            if ($col[$j] != "" || $j == 2) {
                                echo "<td>$col[$j]</td>";
                            }
                        }
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";
                    $json = 0;
                ?>
                </div>
                <div class="col col-lg-2">
                </div>
            </div>
        </div>
    </body>
</html>
