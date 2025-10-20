<style>
    /* Stile base dei bottoni moderni */
        .modern-btn {
            font-size: 1rem;
            padding: 0.5rem 1rem;
            border-radius: 12px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        /* Effetto hover */
        .modern-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 12px rgba(0,0,0,0.2);
        }

        /* Colori personalizzati */
        .danger-btn {
            background: linear-gradient(135deg, #ff5f6d, #ffc371);
            color: white;
        }

        .secondary-btn {
            background: linear-gradient(135deg, #bdc3c7, #2c3e50);
            color: white;
        }

        .success-btn {
            background: linear-gradient(135deg, #43e97b, #38f9d7);
            color: white;
        }

        /* Effetto click */
        .modern-btn:active {
            transform: translateY(1px);
            box-shadow: 0 4px 6px rgba(0,0,0,0.15);
        }

        .button-bar {
            display: flex;
            gap: 8px;
            padding: 0 10px;
            width: 100%;
            box-sizing: border-box;
        }

        .flex-btn {
            flex: 1 1 0;
            min-width: 40px; /* O quanto basta per contenere l’emoji */
            text-align: center;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            padding: 0.5rem 0; /* Riduci padding orizzontale per spazi stretti */
            font-size: 1.2rem; /* Per rendere le emoji ben visibili */
        }
    </style>

<template id="carta">
    <div class="col-6 col-sm-4 col-md-3 col-lg-2 d-flex">
        <div class="card shadow-sm w-100 ISBN" data-isbn="" style="min-width: 150px; max-width: 200px; min-height: 250px; background-color: rgba(106, 159, 190, 1);">
            <div class="d-flex justify-content-between" style="height: 300px">
                <img src="" class="card-img-top" alt="Copertina non disponibile" style="object-fit: cover;">
            </div>
            
            <?php if (isset($_SESSION['name'])):?>
            <div class="button-bar mt-2">
                <button class="btn modern-btn flex-btn" onclick="addToFavourites(this)">❤</button><!--danger-btn-->
                <button class="btn modern-btn flex-btn" onclick="addToReadList(this)">📚</button><!--secondary-btn-->
                <!-- <button class="btn modern-btn flex-btn" onclick="addToList(this)">📖</button> -->
                <!--success-btn-->
                <script>refreshBtns();</script>
            </div>
            <?php endif ?>
            
            <div class="card-body">
                <h6 class="card-title mb-1" style="font-size: 1rem;"></h6>
                <p class="card-authors" style="font-size: 0.875rem;"></p>
                <p class="card-publishedDate" style="font-size: 0.875rem;"></p>
            </div>
        </div>
    </div>
</template>

<?php if (isset($_SESSION["userdata"])): ?>
<script>
    const userLists = {
        preferiti: <?php echo json_encode($_SESSION["userdata"]->preferiti ?? []); ?>,
        libriLetti: <?php echo json_encode($_SESSION["userdata"]->libriLetti ?? []); ?>
    };
</script>
<?php endif; ?>

<script>

    function sendToSession(isbn, list) {
        fetch('lists_handler.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `ISBN=${encodeURIComponent(isbn)}&REMOVE=false&LIST=${encodeURIComponent(list)}`
        })
        .then(response => response.json())
        .then(data => {
            console.log(data.message);
        })
        .catch(err => console.error('Errore:', err));
    }

    function removeFromSession(isbn, list) {
        fetch('lists_handler.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `ISBN=${encodeURIComponent(isbn)}&REMOVE=true&LIST=${encodeURIComponent(list)}`
        })
        .then(response => response.json())
        .then(data => {
            console.log(data.message);
        })
        .catch(err => console.error('Errore:', err));
    }

    function addToFavourites(btn) {
        const card = btn.closest('.card');
        const isbn = card.getAttribute('data-isbn');

        if (btn.classList.contains('danger-btn')) {
            btn.classList.remove('danger-btn');
            removeFromSession(isbn, "preferiti");
            bannerSuccess("Rimosso dai preferiti!");
            return;
        } else {
            btn.classList.add('danger-btn');
        }

        sendToSession(isbn, "preferiti");

        bannerSuccess("Aggiunto ai preferiti!");
    }

    function addToReadList(btn) {
        const card = btn.closest('.card');
        const isbn = card.getAttribute('data-isbn');

        if (btn.classList.contains('success-btn')) {
            btn.classList.remove('success-btn');
            removeFromSession(isbn, "libriLetti");
            bannerSuccess("Rimosso dalla lista dei letti!");
            return;
        } else {
            btn.classList.add('success-btn');
        }

        sendToSession(isbn, "libriLetti")
    }

    function addToList(btn) {
        const card = btn.closest('.card');
        const isbn = card.getAttribute('data-isbn');

        // Crea o mostra il menu delle liste aggiuntive
        let menu = card.querySelector('.list-menu');
        if (!menu) {
            menu = document.createElement('div');
            menu.className = 'list-menu';
            menu.style.position = 'absolute';
            menu.style.top = btn.offsetTop + btn.offsetHeight + 5 + 'px';
            menu.style.left = btn.offsetLeft + 'px';
            menu.style.background = '#fff';
            menu.style.border = '1px solid #ccc';
            menu.style.borderRadius = '8px';
            menu.style.boxShadow = '0 2px 8px rgba(0,0,0,0.15)';
            menu.style.zIndex = 1000;
            menu.style.padding = '8px';
            menu.style.minWidth = '120px';

            // Definisci le liste aggiuntive
            const extraLists = [
                { key: 'wishlist', label: 'Wishlist' },
                { key: 'daLeggere', label: 'Da leggere' },
                { key: 'inPrestito', label: 'In prestito' }
            ];

            extraLists.forEach(list => {
                const item = document.createElement('button');
                item.className = 'modern-btn flex-btn';
                item.textContent = list.label;

                // Stato: evidenzia se già presente
                if (userLists[list.key] && userLists[list.key].includes(isbn)) {
                    item.classList.add('secondary-btn');
                    item.textContent += ' ✓';
                }

                item.onclick = function(e) {
                    e.stopPropagation();
                    if (userLists[list.key] && userLists[list.key].includes(isbn)) {
                        removeFromSession(isbn, list.key);
                        item.classList.remove('secondary-btn');
                        item.textContent = list.label;
                        bannerSuccess("Rimosso da " + list.label);
                    } else {
                        sendToSession(isbn, list.key);
                        item.classList.add('secondary-btn');
                        item.textContent = list.label + ' ✓';
                        bannerSuccess("Aggiunto a " + list.label);
                    }
                };
                menu.appendChild(item);
            });

            // Chiudi il menu cliccando fuori
            document.addEventListener('click', function handler(e) {
                if (!menu.contains(e.target) && e.target !== btn) {
                    menu.remove();
                    document.removeEventListener('click', handler);
                }
            });

            card.style.position = 'relative';
            card.appendChild(menu);
        } else {
            menu.remove();
        }

        sendToSession(isbn, "preferiti")
    }

    function refreshBtns() {
        const cards = document.querySelectorAll('.card');

        cards.forEach(card => {
            const isbn = card.getAttribute('data-isbn');
            const favBtn = card.querySelector('.modern-btn:nth-child(1)');
            const readBtn = card.querySelector('.modern-btn:nth-child(2)');

            // Reset stato
            favBtn.classList.remove('danger-btn');
            readBtn.classList.remove('success-btn');

            // Se il libro è nei preferiti
            if (userLists.preferiti.includes(isbn)) {
                favBtn.classList.add('danger-btn');
            }

            // Se il libro è nella lista dei letti
            if (userLists.libriLetti.includes(isbn)) {
                readBtn.classList.add('success-btn');
            }
        });
    }

</script>

<script src="banner.js"></script>