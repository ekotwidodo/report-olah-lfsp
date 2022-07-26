<?php
    include './autoload.php';
    include './config/database.php';
    include './functions/query-evaluasi.php';

    $q = $_GET['q'];
    $judul = $_GET['title'];

    $conn = new Database();
    $result = queryUtama($conn, $q);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluasi | Query ke-<?php echo $id;?></title>
    <link rel="shortcut icon" href="https://bpslampung.id/landing/img/logo.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
</head>
<body>
    <?php include './includes/navbar.php' ?>
    <div class="container">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <h3 class="text-center mb-5"><?php echo $judul;?></h3>
            <button href="#" class="btn btn-danger" disabled>Export to Excel</button>
            <div id="showTable"></div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#table-result').DataTable({
                "pageLength": 50
            })

            function showTable(data) {
                // Extract value for html header
                let col = []
                for (let i = 0; i < data.length; i++) {
                    for (let key in data[i]) {
                        if (col.indexOf(key) === -1) {
                            col.push(key)
                        }
                    }
                }

                // Create dynamic table
                let table = document.createElement("table")
                table.className = "table striped table-border mt-4"
                table.setAttribute("id", "table-result")

                // Create html table header row using the extracted headers above
                let tr = table.insertRow(-1)

                for (let j = 0; j < col.length; j++) {
                    let th = document.createElement("th")
                    th.innerHTML = col[j]
                    tr.appendChild(th)
                }

                // Add JSON data to the tables as rows
                for (let k = 0; k < data.length; k++) {
                    tr = table.insertRow(-1)
                    for (let l = 0; l < col.length; l++) {
                        let tabCell = tr.insertCell(-1)
                        tabCell.innerHTML = data[k][col[l]]
                    }
                }

                // Finally add the newlu created table 
                let divContainer = document.getElementById("showTable")
                divContainer.innerHTML = ""
                divContainer.appendChild(table)
            }

            const result = '<?php echo json_encode($result) ?>'
            showTable(JSON.parse(result))
        })
    </script>
</body>
</html>