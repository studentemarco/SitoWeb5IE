<!doctype html>
<html lang="en">
    <head>
        <title>Form HTML</title>
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
                <form id="form" action="insert.php" method="GET"> <!--   -->
                        <!--
                            private int $id;
                            private string $titolo;
                            private string $descrizione;
                            private float $prezzo;
                            private string $categoria;
                            private string $immagine;
                            private DateTime $dataCreazione; 
                        -->
                    <label for="id" class="form-label">ID Articolo</label>
                    <input class="form-control" type="number" min="1" name="id" id="id">

                    <hr>

                    <label for="titolo" class="form-label">Titolo Articolo</label>
                    <input class="form-control" type="text" name="titolo" id="titolo">

                    <hr>

                    <label for="descrizione" class="form-label">Descrizione Articolo</label>
                    <textarea class="form-control" name="descrizione" id="descrizione"></textarea>

                    <hr>

                    <label for="prezzo" class="form-label">Prezzo</label>
                    <input class="form-control" type="float" min="0.01" name="prezzo" id="prezzo">

                    <hr>

                    <label for="categoria" class="form-label">Categoria Articolo</label>
                    <select class="form-select" name="categoria" id="categoria">
                        <option value="default">Nessuna</option>
                        <option value="PC">Componenti PC</option>
                        <option value="TV">TV</option>
                        <option value="elettronica">Elettronica</option>
                    </select>

                    <hr>

                    <input
                        id="submitBtn"
                        type="button"
                        value="crea articolo"
                        class="btn btn-primary"
                    >
                    <!-- type="submit" -->
                    <input
                        id="visualizza"
                        type="button"
                        value="visualizza articoli"
                        class="btn btn-primary"
                    >
                    

                </form>
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

        <script
            src="./script.js"
        ></script>
    </body>
</html>