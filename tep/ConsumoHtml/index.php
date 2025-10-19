<!doctype html>
<html lang="en">
    <head>
        <title>Consumo di API rest tramite JS</title>
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
        <header>
            <!-- place navbar here -->
        </header>
        <main>

            <div class="container">                
                <!-- <div>
                    <input type="button" id="get" value="GET" class="btn btn-primary">
                    <input type="button" id="post" value="POST" class="btn btn-primary">
                    <input type="button" id="put" value="PUT" class="btn btn-primary">
                    <input type="button" id="delete" value="DELETE" class="btn btn-primary">
                </div> -->

                <div id=form>
                    <form id="data-form">
                        <!-- <div class="mb-3">
                            <label for="id" class="form-label">ID (necessario per PUT e DELETE)</label>
                            <input type="number" class="form-control" id="id" name="id" min="1">
                        </div> -->
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
                        <button type="submit" class="btn btn-primary">Invia</button>
                </div>

                <div id=contenuto class="contenuto"> </div>

                
                <div id="contenitore" class="d-flex flex-wrap gap-3">
                    <?php
                    $api_url = 'https://api.restful-api.dev/objects';
                    $curl = curl_init();

                        curl_setopt_array($curl, array(
                        CURLOPT_URL => $api_url,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'GET',
                        ));

                    $response = curl_exec($curl);
                    curl_close($curl);
                    $elementi = json_decode($response);

                    foreach($elementi as $elemento)
                    {
                        $titolo = $elemento -> name;
                        $testo = "";
                        $bottone = "";
                    ?>
                        <div class="card" style="width: 18rem;">
                            <img src="https://picsum.photos/200/100?pippo=<?php echo $elemento->id; ?>" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $titolo; ?></h5>
                                <p class="card-text"><?php echo $testo; ?></p>
                                <a class="btn btn-primary" href="<?php echo $bottone; ?>"></a>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>

        </main>
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Libraries -->
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