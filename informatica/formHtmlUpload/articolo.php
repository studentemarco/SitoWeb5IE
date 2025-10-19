<?php
class Articolo {
    private int $id;
    private string $titolo;
    private string $descrizione;
    private float $prezzo;
    private string $categoria;
    private string $immagine;
    private DateTime $dataCreazione;

    public function __construct(
        int $id,
        string $titolo,
        string $descrizione,
        float $prezzo,
        string $categoria,
        string $immagine
    ) {
        $this->id = $id;
        $this->titolo = $titolo;
        $this->descrizione = $descrizione;
        $this->prezzo = $prezzo;
        $this->categoria = $categoria;
        $this->immagine = $immagine;
        $this->dataCreazione = new DateTime();
    }

    // Getter & Setter ID
    public function getId(): int { return $this->id; }
    public function setId(int $id): void { $this->id = $id; }

    // Getter & Setter Titolo
    public function getTitolo(): string { return $this->titolo; }
    public function setTitolo(string $titolo): void { $this->titolo = $titolo; }

    // Getter & Setter Descrizione
    public function getDescrizione(): string { return $this->descrizione; }
    public function setDescrizione(string $descrizione): void { $this->descrizione = $descrizione; }

    // Getter & Setter Prezzo
    public function getPrezzo(): float { return $this->prezzo; }
    public function setPrezzo(float $prezzo): void {
        if ($prezzo < 0) throw new InvalidArgumentException("Prezzo non valido");
        $this->prezzo = $prezzo;
    }

    // Getter & Setter Categoria
    public function getCategoria(): string { return $this->categoria; }
    public function setCategoria(string $categoria): void { $this->categoria = $categoria; }

    // Getter & Setter Immagine
    public function getImmagine(): string { return $this->immagine; }
    public function setImmagine(string $immagine): void { $this->immagine = $immagine; }

    // DataCreazione (solo getter)
    public function getDataCreazione(): DateTime { return $this->dataCreazione; }
    public function show() : string {
        return "<div class='card' style='width: 18rem;'>
                <img src='img/". $this->getImmagine() ."' class='card-img-top' alt='Immagine Prodotto'>
                <div class='card-body'>
                    <h5 class='card-title'>".$this->getTitolo()."</h5>
                    <p class='card-text'>Descrizione: ".$this->getDescrizione() ."</p>
                    <p class='card-text'>Prezzo: ".number_format($this->getPrezzo(), 2, ',', '.') ."€</p>
                    <p class='card-text'>Categoria: ".$this->getCategoria() ."</p>
                    <!-- <a href='#' class='btn btn-primary'>Go somewhere</a> -->
                </div>
            </div>";
    }
}
?>
