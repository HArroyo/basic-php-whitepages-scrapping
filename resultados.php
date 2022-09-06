<?php

$name = $_GET['name'];
$page = 1;

if(isset($_GET['page'])){
    $page = $_GET['page'];
}

$url = file_get_contents('http://www.paginasblancas.pe/persona/'.$name.'/p-'.$page);

$dom = new DOMDocument();
@$dom->loadHTML($url);

$xpath = new DOMXpath($dom);

$count = $xpath->query('//span[contains(@class, "m-header--count")]');
$divs = $xpath->query('//li[contains(@class, "m-results-business")]');

$results = $int_var = (int)filter_var($count[0]->nodeValue, FILTER_SANITIZE_NUMBER_INT);

$pages = $results % 15;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta Blancas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="https://getbootstrap.com/docs/5.2/examples/sign-in/signin.css">
</head>
<body>
    <main class="form-signin w-100 m-auto" style="max-width:90%;">
        <h3 style="margin-bottom:20px;"><?php echo $results; ?> Resultados:</h3>
        <table id="tabla_resultados">
            <thead>
                <tr>
                    <th>Nombres</th>
                    <th>Direccion</th>
                    <th>Teléfono</th>
                </tr>
            </thead>
            <tbody>
                <?php

                    foreach($divs as $div){
                        $div_info = $xpath->query('./div[contains(@class, "info")]', $div);
                        $div_last_section = $xpath->query('./div[contains(@class, "m-results-business-section-last")]', $div);    

                        $div_business_header = $xpath->query('./div[contains(@class, "m-results-business-header")]', $div_info[0]);
                        $div_infoline = $xpath->query('./div[contains(@class, "m-results--infoline")]', $div_info[0]);

                        $h3_business_name = $xpath->query('./h3[contains(@class, "m-results-business--name")]', $div_business_header[0]);

                        $div_address = $xpath->query('./div[contains(@class, "m-results-business--address")]', $div_infoline[0]);


                        $ul_results_business = $xpath->query('./ul[contains(@class, "m-results-business--social-actions")]', $div_last_section[0]);
                        $div_results_business_see = $xpath->query('./li/div[contains(@class, "m-button--results-business--see-phone")]', $ul_results_business[0]);
                        $span_phone = $xpath->query('./span[contains(@class, "m-icon--single-phone")]', $div_results_business_see[0]);

                        //Datos Finales:
                        $nombres = $h3_business_name[0]->nodeValue;
                        $direccion = $div_address[0]->nodeValue;
                        $telefono = $span_phone[0]->nodeValue;

                        echo '<tr>';
                        echo '<td>'.$nombres.'</td>';
                        echo '<td>'.$direccion.'</td>';
                        echo '<td>'.$telefono.'</td>';
                        echo '</tr>';
                    }                    
                ?>
            </tbody>
        </table>
        <nav aria-label="Page navigation example" style="margin-top:20px;">
            <ul class="pagination">
                <?php for($i = 1; $i<=$pages; $i++){ ?>
                <li class="page-item"><a class="page-link" href="<?php echo 'resultados.php?name='.$name.'&page='.$i; ?>"><?php echo $i; ?></a></li>
                <?php } ?>
            </ul>
        </nav>
    </main>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script>
        $(document).ready( function () {
            $('#tabla_resultados').DataTable({
                dom: 'Bfrtip',
                paging: false,
                searching: false,
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdfHtml5'
                ]
            });
        } );
    </script>
</body>
</html>