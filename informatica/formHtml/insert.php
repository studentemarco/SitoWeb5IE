<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
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
            <?php
                require "articolo.php"; //oltre ad includerlo, lo rende obbligatorio (e deve anche andare tutto), senza non può andare avanti l'esecuzione
                //include "articolo.php";   //anche se non riesce a prenderlo, fa niente
                //var_dump($_GET); //descrive oggetto/variabile

                //controllo dei parametri passati

                if($_GET["id"] < 0 || count_chars($_GET["titolo"])<=0 || count_chars($_GET["prezzo"])<=0 || count_chars($_GET["categoria"])<=0 ){
                    echo '  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Errore!</strong> I parametri non sono corretti!.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                    return;
                }

                $immagine = "".$_GET["categoria"].".png";

                if($_GET["categoria"]!="elettronica" && $_GET["categoria"]!="PC" && $_GET["categoria"]!="TV" && $_GET["categoria"]!="default"){
                    $immagine = "default.png";
                }

                $articolo= new Articolo($_GET["id"], $_GET["titolo"], $_GET["descrizione"], $_GET["prezzo"], $_GET["categoria"], $immagine);
                echo $articolo->show();

                //salva l'articolo in un file json
                $file = 'articoli.json';
                //controllo se il file esiste
                if(!file_exists($file)){
                    //creo il file
                    file_put_contents($file, json_encode([]));
                }
                //leggo il file
                $articoli = json_decode(file_get_contents($file), true);
                //aggiungo l'articolo
                $articoli[] = [
                    'id' => $articolo->getId(),
                    'titolo' => $articolo->getTitolo(),
                    'descrizione' => $articolo->getDescrizione(),
                    'prezzo' => $articolo->getPrezzo(),
                    'categoria' => $articolo->getCategoria(),
                    'immagine' => $articolo->getImmagine()
                ];
                //salvo il file
                file_put_contents($file, json_encode($articoli, JSON_PRETTY_PRINT));
            ?>

            <!-- <div class="card" style="width: 18rem;">
                <img src="img/<?= $articolo->getImmagine(); ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?= $articolo->getTitolo(); ?></h5>
                    <p class="card-text">Descrizione: <?= $articolo->getDescrizione(); ?></p>
                    <p class="card-text">Prezzo: <?= $articolo->getPrezzo(); ?></p>
                    <p class="card-text">Categoria: <?= $articolo->getCategoria(); ?></p>
                </div>
            </div> -->

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

