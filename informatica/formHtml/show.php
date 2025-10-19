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
            <h3>Articoli</h3>
            
            <div class="container mt-4" style="display: flex; flex-wrap: wrap; gap: 1rem;">
                
            <?php
                require "articolo.php"; 

                //leggiamo il file json
                $file = 'articoli.json';
                if(!file_exists($file)){
                    echo '<div class="alert alert-info" role="alert">
                            <strong>Info!</strong> Nessun articolo presente.
                          </div>';
                    return;
                }
                $articoli = json_decode(file_get_contents($file), true);
                if(count($articoli) == 0){
                    echo '<div class="alert alert-info" role="alert">
                            <strong>Info!</strong> Nessun articolo presente.
                          </div>';
                    return;
                }
                foreach($articoli as $a){
                    $articolo = new Articolo($a["id"], $a["titolo"], $a["descrizione"], $a["prezzo"], $a["categoria"], $a["immagine"]);
                    echo $articolo->show();
                }
            ?>
                </div>

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

