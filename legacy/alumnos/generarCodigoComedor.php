<?
    function generarCodigo($numeroDocumento) {
        $pesos = array(2, 1, 2, 1, 2, 1, 2, 1);
        $suma = 0;
        $digitos = str_split($numeroDocumento);

        for ($i = 0; $i < count($digitos); $i++) {
            $suma += $digitos[$i] * $pesos[$i % 8];
        }

        $modulo = $suma % 11;
        $verificador = 11 - $modulo;

        if ($verificador == 10) {
            $verificador = 0;
        }

        return $verificador;
    }
?>