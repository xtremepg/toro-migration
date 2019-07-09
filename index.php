<?php

require_once('connection.php');
require_once('UsuarioOrigem.php');
require_once('UsuarioDestino.php');
require_once('Fatura.php');
require_once('Invoice.php');

MigrarUsuarios();
MigrarFaturas();

function MigrarUsuarios() {
    $usuariosDeOrigem = UsuarioOrigem::Listar();

    foreach($usuariosDeOrigem as $usuario) {        

        $patrocinador = UsuarioOrigem::ObterPatrocinador($usuario->id);
        $conta = UsuarioOrigem::ObterConta($usuario->id);

        UsuarioDestino::Adicionar($usuario, $patrocinador, $conta);

        if (UsuarioOrigem::ObterStatusDaRede($usuario->id)) {

            $esquerda = UsuarioOrigem::ObterChaveBinaria($usuario->id, 1);
            $direita = UsuarioOrigem::ObterChaveBinaria($usuario->id, 2);

            UsuarioDestino::AdicionarBinario($usuario->id, $esquerda, $direita);
        }
    }

    echo '<p>Processamento de Usuários concluído!</p>';
}

function MigrarFaturas() {

    $faturas = Fatura::Listar();

    foreach($faturas as $fatura) {
        
        $plano = Fatura::ObterPlano($fatura->id_plano);

        if ($plano != null) {

            $invoice = Invoice::Adicionar($fatura, $plano);
            Invoice::AdicionarItem($invoice, $plano);
            UsuarioDestino::AtualizarPacote($fatura->id_usuario, $plano);
        }
    }

    echo '<p>Processamento de Faturas concluído!</p>';
}

$conn_origem->close();
$conn_destino->close();

