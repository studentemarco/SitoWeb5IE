<!doctype html>
<html lang="en">

<head>
    <title>Home</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

    
</head>

<body style="background-color: #000933;">
    <header>
        <?php $current_page = 'home'; include 'navbar.php'; ?>
    </header>
    <main>
        <div class="container my-4">
            <div class="row justify-content-center g-3" id="contenitore">
                <?php include 'card-template.php'; ?>
            </div>
        </div>
    </main>
    <footer>
        <!-- place footer here -->
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>

        <!-- <script type="module">
            import { fetchBooks } from './fetch.js';
            const url = "https://www.googleapis.com/books/v1/volumes?q=subject:fiction&orderBy=relevance&maxResults=30";
            fetchBooks(url);
        </script> -->
    <script>
        const url = "https://www.googleapis.com/books/v1/volumes?q=subject:fiction&orderBy=relevance&maxResults=30";
        
        fetch(url)
            .then(response => response.json())
            .then(data => {
                const container = document.querySelector("#contenitore");
                const template = document.querySelector("#carta");

                data.items.forEach(element => {
                    const clone = template.content.cloneNode(true);
                    const titolo = clone.querySelector(".card-title");
                    const autore = clone.querySelector(".card-authors");
                    const dataPubblicazione = clone.querySelector(".card-publishedDate");
                    const immagine = clone.querySelector(".card-img-top");
                    const isbn = clone.querySelector(".ISBN");

                    titolo.textContent = element.volumeInfo.title || "Titolo non disponibile";
                    autore.textContent = element.volumeInfo.authors?.join(", ") || "Autore non disponibile";
                   
                    //isbn.dataset.isbn = element.volumeInfo.industryIdentifiers.find(id => id.type === "ISBN_13")?.identifier;
                   
                    isbn.dataset.isbn = element.id;
                    
                    //dataPubblicazione.textContent = element.volumeInfo.publishedDate || "Data di pubblicazione non disponibile";
                    if (element.volumeInfo.publishedDate) {
                        const dateStr = element.volumeInfo.publishedDate;
                        let formattedDate = "Data di pubblicazione non disponibile";
                        // Try to parse YYYY-MM-DD, YYYY-MM, or YYYY
                        const parts = dateStr.split("-");
                        if (parts.length === 3) {
                            // YYYY-MM-DD
                            formattedDate = `${parts[2]}/${parts[1]}/${parts[0]}`;
                        } else if (parts.length === 2) {
                            // YYYY-MM
                            formattedDate = `01/${parts[1]}/${parts[0]}`;
                        } else if (parts.length === 1) {
                            // YYYY
                            formattedDate = `01/01/${parts[0]}`;
                        }
                        dataPubblicazione.textContent = formattedDate;
                    } else {
                        dataPubblicazione.textContent = "Data di pubblicazione non disponibile";
                    }
                    if (element.volumeInfo.imageLinks?.thumbnail) {
                        immagine.src = element.volumeInfo.imageLinks.thumbnail;
                        immagine.alt = `${element.volumeInfo.title} - ${element.volumeInfo.authors?.join(", ") || "Autore non disponibile"}`;
                    } else {
                        console.log("No image available");
                        // Generate a placeholder cover with title and author using a placeholder image service
                        const title = encodeURIComponent(element.volumeInfo.title || "Titolo non disponibile");
                        const author = encodeURIComponent(element.volumeInfo.authors?.join(", ") || "Autore non disponibile");
                        immagine.src = `https://placehold.co/1500x2000.png?text=${title}%0A${author}`;
                        immagine.alt = `${element.volumeInfo.title} - ${element.volumeInfo.authors?.join(", ") || "Autore non disponibile"}`;
                    }

                    container.appendChild(clone);
                });
            })
            .catch(error => console.error("Error:", error));
    </script>
</body>

</html>
