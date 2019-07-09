<?php

require_once('connection.php');
require_once('UsuarioOrigem.php');
require_once('UsuarioDestino.php');

Migrar();

function Migrar() {
    $usuariosDeOrigem = UsuarioOrigem::Listar();

    foreach($usuariosDeOrigem as $usuario) {        

        $patrocinador = UsuarioOrigem::ObterPatrocinador($usuario->id);
        $conta = UsuarioOrigem::ObterConta($usuario->id);

        UsuarioDestino::Adicionar($usuario, $patrocinador, $conta);

        $esquerda = UsuarioOrigem::ObterChaveBinaria($usuario->id, 1);
        $direita = UsuarioOrigem::ObterChaveBinaria($usuario->id, 2);
        UsuarioDestino::AdicionarBinario($usuario->id, $esquerda, $direita);

    }

    echo 'Processamento concluído!';
}

$conn_origem->close();
$conn_destino->close();

