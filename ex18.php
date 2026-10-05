<?php

function ordenarConsultas($consultas) {
    usort($consultas, function($a, $b) {

        $dataA = $a['data'] . ' ' . $a['horario'];
        $dataB = $b['data'] . ' ' . $b['horario'];
        return strcmp($dataA, $dataB);
    });
    return $consultas;
}


function quantidadePacientes($consultas) {
    $pacientes = array_column($consultas, 'paciente');
 return count(array_unique($pacientes));
}


function quantidadeEspecialidade($consultas) {
$especialidades = array_column($consultas, 'especialidade');

    return array_count_values($especialidades);
}


function primeiroAtendimento($consultas) {
    return $consultas[0] ?? null;
}


function horarioDuplicado($consultas) {
    $horarios = [];
    foreach($consultas as $consulta) {
        $horario = $consulta['data'] . ' ' . $consulta['horario'];

        if(isset($horarios[$horario])) {
            return true;
        }
        $horarios[$horario] = true;
    }

    return false;
}


function pesquisaPaciente($consultas, $pacienteBusca) {
    if(empty(trim($pacienteBusca))) {
        return [];
    }
    $termo = mb_strtolower(trim($pacienteBusca), 'UTF-8');

    return array_values(array_filter($consultas, function($consulta) use ($termo) {
        return mb_strpos(
            mb_strtolower($consulta['paciente'], 'UTF-8'),
            $termo
        ) !== false;

    }));
}


function organizarAgenda($consultas, $pacienteBusca) {
    $agendaOrdenada = ordenarConsultas($consultas);

    return [
        'totalConsultas' => count($consultas),
        'pacientesDiferentes' => quantidadePacientes($consultas),
        'primeiroAtendimento' => primeiroAtendimento($agendaOrdenada),
        'horariosDuplicados' => horarioDuplicado($consultas),
        'resultadoPesquisa' => pesquisaPaciente( $consultas, $pacienteBusca),
        'porEspecialidade' => quantidadeEspecialidade($consultas),
        'agendaOrdenada' => $agendaOrdenada
    ];
}


$agendaCli = [
    [
        'paciente' => 'Verstappen',
        'especialidade' => 'Cardiologia',
        'data' => '12-08-26',
        'horario' => '21:40'
    ],
    [
        'paciente' => 'Patati',
        'especialidade' => 'Tomografia',
        'data' => '12-08-26',
        'horario' => '08:30'
    ]

];


$relatorio = organizarAgenda($agendaCli, 'Jorge');


// Mostrar quantidade de consultas

echo "Quantidade de consultas: " . $relatorio['totalConsultas'] . "<br>";


echo "Pacientes diferentes: ". $relatorio['pacientesDiferentes'] . "<br>";

$primeiro = $relatorio['primeiroAtendimento'];

echo "Primeiro atendimento: " . $primeiro['paciente'] . $primeiro['data'] . $primeiro['horario'] . "<br>";


if($relatorio['horariosDuplicados']) {
    echo "Existem horários duplicados.<br>";

} else {
    echo "Não existem horários duplicados.<br>";
}
echo "<br>Pesquisa por paciente:<br>";
foreach($relatorio['resultadoPesquisa'] as $consulta) {
    echo $consulta['paciente'] . $consulta['data'] . $consulta['horario'] . "<br>";
}



echo "<br>Agenda ordenada:<br>";
foreach($relatorio['agendaOrdenada'] as $consulta) {
    echo $consulta['paciente'] . $consulta['especialidade'] . $consulta['data'] . $consulta['horario'] . "<br>" ;

}

?>