fetchBooks(url)
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

                    titolo.textContent = element.volumeInfo.title || "Titolo non disponibile";
                    autore.textContent = element.volumeInfo.authors?.join(", ") || "Autore non disponibile";
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