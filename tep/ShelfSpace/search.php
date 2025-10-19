<!doctype html>
<html lang="en">

<head>
    <title>Cerca libri</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</style>
    
</head>

<body style="background-color: #000933;">
    <header>
        <?php $current_page = 'search';
        include 'navbar.php'; ?>
    </header>
    <main>
        <div class="container my-4">
        <?php
        $query = isset($_GET['query']) ? trim($_GET['query']) : '';
        if ($query === '') {
            echo '<div class="alert alert-warning mt-4">Per favore, inserisci un termine di ricerca.</div>';
            exit();
        } else {
            echo '<h2 class="text-white">Risultati per: ' . htmlspecialchars($query) . '</h2>';
        }
        ?>
            <hr>
            <div id="results" class="row justify-content-center g-3">
                <?php include 'card-template.php'; ?>
                
                
            </div>
        </div>
    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>

    <!-- <script src="search.js"></script> -->

    <script>
        const templateCard = document.querySelector('#carta');

        const searchTerm = "<?php echo $query ?>";

        let apiUrl = 'https://www.googleapis.com/books/v1/volumes?q=' + encodeURIComponent(searchTerm);
        fetch(apiUrl)
            .then(response => response.json())
            .then(data => {
                const resultsDiv = document.querySelector('#results');
                //resultsDiv.innerHTML = '';
                if (!data.items || data.items.length === 0) {
                    resultsDiv.innerHTML = '<div class="alert alert-warning mt-4">Nessun libro trovato.</div>';
                    return;
                }
                data.items.forEach(item => {
                    const clone = templateCard.content.cloneNode(true);
                    const title = clone.querySelector('.card-title');
                    const authors = clone.querySelector('.card-authors');
                    const publishedDate = clone.querySelector('.card-publishedDate');
                    //const description = clone.querySelector('.card-description');
                    const thumbnail = clone.querySelector('.card-img-top');
                    //const isbn = clone.querySelector('.card-isbn');
                    //const favouriteBtn = clone.querySelector('.btn-outline-danger');
                    //const toReadBtn = clone.querySelector('.btn-outline-secondary');
                    //const listBtn = clone.querySelector('.btn-outline-success');
                    //const moreInfoBtn = clone.querySelector('.btn-primary');
                    const isbn = clone.querySelector(".ISBN");
                    isbn.dataset.isbn = item.id;

                    let tempp = item.volumeInfo.title || 'N/A';
                    //console.log(tempp);
                    title.textContent = tempp;
                    authors.textContent = item.volumeInfo.authors ? item.volumeInfo.authors.join(', ') : 'N/A';
                    publishedDate.textContent = item.volumeInfo.publishedDate || 'N/A';
                    //description.textContent = item.volumeInfo.description ? item.volumeInfo.description.substring(0, 100) + '...' : 'N/A';
                    if (item.volumeInfo.imageLinks?.thumbnail) {
                        thumbnail.src = item.volumeInfo.imageLinks.thumbnail;
                        thumbnail.alt = `${item.volumeInfo.title} - ${item.volumeInfo.authors?.join(", ") || "Autore non disponibile"}`;
                    } else {
                        console.log("No image available");
                        // Generate a placeholder cover with title and author using a placeholder image service
                        const title = encodeURIComponent(item.volumeInfo.title || "Titolo non disponibile");
                        const author = encodeURIComponent(item.volumeInfo.authors?.join(", ") || "Autore non disponibile");
                        thumbnail.src = `https://placehold.co/1500x2000.png?text=${title}%0A${author}`;
                        thumbnail.alt = `${item.volumeInfo.title} - ${item.volumeInfo.authors?.join(", ") || "Autore non disponibile"}`;
                    }
                    //isbn.textContent = item.volumeInfo.industryIdentifiers ? 'ISBN: ' + item.volumeInfo.industryIdentifiers.map(id => id.identifier).join(', ') : 'N/A';
                    //favouriteBtn.href = '#';
                    //toReadBtn.href = '#';
                    //listBtn.href = '#'; 
                    //moreInfoBtn.href = '#';

                    //console.log(clone);

                    resultsDiv.appendChild(clone);
                });
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    </script>
</body>

</html>