<?php
function quantidadeCaracteres($string) {
    return strlen($string);
}

function quantidadePalavras($string) {
    return str_word_count($string);
}

function quantidadeFrases($string) {
    return substr_count($string, '.') + substr_count($string, '!') + substr_count($string, '?');
}

function palavraLonga($string) {
    $string = trim($string);
    $string = preg_replace('/\s+/', ' ', $string);

    $palavras = explode(' ',$string);
    $palavraMaisLonga = '';
    foreach ($palavras as $palavra) {
        if (strlen($palavra) > strlen($palavraMaisLonga)) {
            $palavraMaisLonga = $palavra;
        }
    }
    return $palavraMaisLonga;
}

function palavraCurta($string) {
    $string = trim($string);
    $string = preg_replace('/\s+/', ' ', $string);

    $palavras = explode(' ',$string);
    $palavraMaisCurta = $palavras[0];
    foreach ($palavras as $palavra) {
        if (strlen($palavra) < strlen($palavraMaisCurta)) {
            $palavraMaisCurta = $palavra;
        }
    }
    return $palavraMaisCurta;
}

function palavrasRepetidas($string) {
    $string = trim($string);
    $string = preg_replace('/\s+/', ' ', $string);

    $palavras = explode(' ', $string);
    $contagem = array_count_values($palavras);
    $repetidas = array_filter($contagem, function($count) {
        return $count > 1;
    });
    return array_keys($repetidas);
}

function palavrasFrequentes($string) {
    $string = trim($string);
    $string = preg_replace('/\s+/', ' ', $string);

    $palavras = explode(' ', $string);
    $contagem = array_count_values($palavras);
    arsort($contagem);
    return array_slice($contagem, 0, 5);
}

function semEspacos($string) {
    return trim(preg_replace('/\s+/', ' ', $string));
}

function textoFormatado($string) {
    $string = trim($string);
    $string = preg_replace('/\s+/', ' ', $string);
    $string = ucwords(strtolower($string));
    return $string;
}
function processarTexto($string) {
    $quantidadeCaracteres = quantidadeCaracteres($string);
    $quantidadePalavras = quantidadePalavras($string);
    $quantidadeFrases = quantidadeFrases($string);
    $palavraMaisLonga = palavraLonga($string);
    $palavraMaisCurta = palavraCurta($string);
    $palavrasRepetidas = palavrasRepetidas($string);
    $palavrasFrequentes = palavrasFrequentes($string);
    $textoFormatado = textoFormatado($string);

    return [
        'quantidadeCaracteres' => $quantidadeCaracteres,
        'quantidadePalavras' => $quantidadePalavras,
        'quantidadeFrases' => $quantidadeFrases,
        'palavraMaisLonga' => $palavraMaisLonga,
        'palavraMaisCurta' => $palavraMaisCurta,
        'palavrasRepetidas' => $palavrasRepetidas,
        'palavrasFrequentes' => $palavrasFrequentes,
        'textoFormatado' => $textoFormatado
    ];
}

$texto ="Já parou para pensar que a Nintendo era zoada por causa dos preços do jogos, e hoje em dia <br> quase todos os jogos tem o mesmo preço se não mais. Além que parece que a Nintendo pensa mais nos jogadores do que a Sony, eu estou falando bem da Nintendo nunca pensei que ia fazer isso.";
$resultado = processarTexto($texto);

echo "Texto: $texto<br>";
echo "Quantidade de Caracteres: " . $resultado['quantidadeCaracteres'] . "<br>";
echo "Quantidade de Palavras: " . $resultado['quantidadePalavras'] . "<br>";
echo "Quantidade de Frases: " . $resultado['quantidadeFrases'] . "<br>";
echo "Palavra Mais Longa: " . $resultado['palavraMaisLonga'] . "<br>";
echo "Palavra Mais Curta: " . $resultado['palavraMaisCurta'] . "<br>";
echo "Palavras Repetidas: " . implode(', ', $resultado['palavrasRepetidas']) . "<br>";
echo "Palavras Frequêntes: " . implode(', ', array_keys($resultado['palavrasFrequentes'])) . "<br>";
echo "Texto Formatado: " . $resultado['textoFormatado'] . "<br>";