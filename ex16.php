<?php
function contarMaiusculas($string) {
    $count = 0;
    for ($i = 0; $i < strlen($string); $i++) {
        if (ctype_upper($string[$i])) {
            $count++;
        }
    }
    return $count;
}
function contarMinusculas($string) {
    $count = 0;
    for ($i = 0; $i < strlen($string); $i++) {
        if (ctype_lower($string[$i])) {
            $count++;
        }
    }
    return $count;
}
function contarCaracteres($string) {
    return strlen($string);
}
function contarNumeros($string) {
    $count = 0;
    for ($i = 0; $i < strlen($string); $i++) {
        if (is_numeric($string[$i])) {
            $count++;
        }
    }
    return $count;
}

function classificarSenha($senha, $maiusculas, $minusculas, $caracteres, $numeros, $tamanho) {
    if ($tamanho < 8) {
        return "Senha Fraca";
    }  elseif ($maiusculas >= 1 && $minusculas >= 1 && $numeros >= 1 && $tamanho >= 8) {
        return "Senha Forte";
    } else {
        return "Senha Média";
    }
}

function analisarSenha($senha) {
    $maiusculas = contarMaiusculas($senha);
    $minusculas = contarMinusculas($senha);
    $caracteres = contarCaracteres($senha);
    $numeros = contarNumeros($senha);
    $tamanho = strlen($senha);

    return classificarSenha($senha, $maiusculas, $minusculas, $caracteres, $numeros, $tamanho);
}

$senha = "SenhaB0lada33";
$resultado = analisarSenha($senha);

echo "Senha: $senha<br>";
echo "Resultado: $resultado<br>";
echo "Maiúsculas: " . contarMaiusculas($senha) . "<br>";
echo "Minúsculas: " . contarMinusculas($senha) . "<br>";
echo "Caracteres: " . contarCaracteres($senha) . "<br>";
echo "Números: " . contarNumeros($senha) . "<br>";
echo "Tamanho: " . strlen($senha) . "<br>";
echo "Classificação: " . analisarSenha($senha) . "<br>";
?>