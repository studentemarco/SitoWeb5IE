<!doctype html>
<html lang="en">
    <head>
        <title>Consumo di API rest tramite PHP</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    </head>

    <body>
        <?php
        $api_url = 'https://ca076f12ff2ff3151f09.free.beeceptor.com/api/users/';
        
            function get() {
                global $api_url;
                $response = file_get_contents($api_url);
                $data = json_decode($response, true);

                foreach ($data as $item) {
                    echo "<tr>
                            <td>{$item['id']}</td>
                            <td>{$item['nome']}</td>
                            <td>{$item['cognome']}</td>
                            <td>{$item['email']}</td>
                            <td>
                                <button class='btn btn-sm btn-warning' name='edit' value='{$item['id']}'>Modifica</button>
                                <button class='btn btn-sm btn-danger' name='delete' value='{$item['id']}'>Elimina</button>
                            </td>
                            </tr>";
                }
            }

            function post($nome, $cognome, $email) {
                global $api_url;
                $curl = curl_init();

                curl_setopt_array($curl, array(
                CURLOPT_URL => $api_url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS =>'{
                    "nome": "'.$nome.'",
                    "cognome": "'.$cognome.'",
                    "email": "'.$email.'"
                }',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);
                //echo $response;

            }
            if (isset($_POST['submit'])){
                post($_POST['nome'], $_POST['cognome'], $_POST['email']);
                /*echo "<script>location.reload();</script>";*/
            }

            function delete($id) {
                global $api_url;
                $curl = curl_init();

                curl_setopt_array($curl, array(
                CURLOPT_URL => $api_url . $id,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'DELETE',
                ));

                $response = curl_exec($curl);

                curl_close($curl);
                //echo $response;
            }

            function put($id, $nome, $cognome, $email) {
                global $api_url;
                $curl = curl_init();

                curl_setopt_array($curl, array(
                CURLOPT_URL => $api_url . $id,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'PUT',
                CURLOPT_POSTFIELDS =>'{
                    "nome": "'.$nome.'",
                    "cognome": "'.$cognome.'",
                    "email": "'.$email.'"
                }',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);
                //echo $response;
            }
            if (isset($_POST['edit'])){
                put($_POST['edit'], $_POST['nome'], $_POST['cognome'], $_POST['email']);
                /*echo "<script>location.reload();</script>";*/
            }
            if (isset($_POST['delete'])){
                delete($_POST['delete']);
                /*echo "<script>location.reload();</script>";*/
            }
        ?>
        <main>            
            <div class="container">
                <div id=form>
                    <form id="data-form" method="post">
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome">
                        </div>
                        <div class="mb-3">
                            <label for="cognome" class="form-label">Cognome</label>
                            <input type="text" class="form-control" id="cognome" name="cognome">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit">Invia</button>
                </div>

                <div id=contenuto class="contenuto"> </div>

                <div id="tabella" class="mt-4">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Cognome</th>
                                <th>Email</th>
                                <th>Azioni</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                            <!-- I dati verranno inseriti qui dinamicamente -->
                            <?php 
                                get();
                            ?>
                        </tbody>
                    </table>
                </div>
                
            </div>

        </main>
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>