<?php

class cart
{

    /**
     * Initialisiert die Klasse, muss in jeder Seite ausgeführt werden.
     */
    public function initial_cart() {
        $cart = array();
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = $cart;
        }
    }

    /**
     * 
     * Fügt einen Artikel in das Array ein
     * @param unknown_type $Artikelnummer
     * @param unknown_type $Beschreibung
     * @param unknown_type $Verkäufer
     * @param unknown_type $Kosten
     * @param unknown_type $MwstSatz
     * @param unknown_type $MwSt
     * @param unknown_type $ZwischenSumme
     * @param unknown_type $Anzahl
     * @param unknown_type $gesamt
     */
    public function insertArtikel($Artikelnummer, $Beschreibung, $Verkäufer, $kosten, $MwstSatz, $MwSt, $ZwischenSumme, $Anzahl, $gesamt)
    {

        $Artikel = array($Artikelnummer, $Beschreibung, $Verkäufer, $kosten, $MwstSatz, $MwSt, $ZwischenSumme, $Anzahl, $gesamt);
        $cart = $_SESSION['cart'];
        array_push($cart, $Artikel);
        $_SESSION['cart'] = $cart;
    }

    /**
     * 
     * Gibt Alle Artikel des Array in einer Tabelle aus.
     */
    public function getCart()
    {
        $Array = $_SESSION['cart'];
        echo "<table width='100%'>";
        echo "<tr><th>Artikel Nummer</th><th>Beschreibung</th><th>Verkäufer</th><th>Summe</th><th>MwSt Satz</th><th>MwSt Summe</th><th>Zwischen Summe</th><th>Anzahl</th><th>Summe</th></tr>";
        for ($i = 0; $i < count($Array); $i++) {
            $innerArray = $Array[$i];

            echo "<tr>
            <td>$innerArray[0]</td>
            <td>$innerArray[1]</td>
            <td>$innerArray[2]</td>
            <td>$innerArray[3]</td>
            <td>$innerArray[4]</td>
            <td>$innerArray[5]</td>
            <td>$innerArray[6]</td>
            <td>$innerArray[7]</td>
            <td>$innerArray[8]</td>
            </tr>";
        }

        echo "</table>";
    }


    /**
     * 
     * Löscht den Waren Korb
     */
    public function undo_cart()
    {
        $_SESSION['cart'] = array();
    }


    /**
     * 
     * Gibt einen Datensatz Zurück
     * @param int $point
     */
    public function get_cartValue_at_Point($n)
    {

        $Array = $_SESSION['cart'];
        return $Array[$n];
    }

    /**
     * 
     * Entfernt ein Artikel am Point n
     * @param int $point
     */
    public function delete_cartValue_at_Point($point)
    {
        $Array = $_SESSION['cart'];
        unset($Array[$point]);
    }

    /**
     * 
     * Gibt die Anzahl der Artikel zurück
     */
    public function get_cart_count()
    {
        return count($_SESSION['cart']);
    }
}

?>


