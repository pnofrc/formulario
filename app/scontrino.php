  <?php  
    function permanenza($conto, $giorni) {
        $guests = $conto->numero_ospiti ?? 1;
        $tot = 0;
        switch ($conto->tipologia_stanza) {
            case 'camerata':
                $tot += 20 * $giorni * $guests;
                break;
            case 'cameratina':
                 $tot += 25 * $giorni * $guests;
                break;
            case 'camerella':
                if ($guests == 2) {
                    $tot += 45 * $giorni;
                } elseif ($guests == 1) {
                    $tot += 25 * $giorni;
                }
                break;
        }

        return $tot;
    }


    function totale_extra($extra, $numero_ospiti) {
    $totale = 0;

    foreach ($extra as $evento) {
        $totale += ($evento['costo'] ?? 0) * $numero_ospiti;
    }

    return $totale;
}
