<?php
class UsuarioDestino {

    public static function Adicionar($usuarioOrigem, $patrocinador, $conta) {
        GLOBAL $conn_destino;

        $banned = $usuarioOrigem->block ? 'Y' : 'N';
        $chave_binaria = $usuarioOrigem->chave_binaria == 1 ? 'left' : 'right';

        $carteira_bitcoin = isset($conta->carteira_bitcoin) != null ? $conta->carteira_bitcoin : null;
        $codigo_banco = isset($conta->codigo_banco) != null ? $conta->codigo_banco : null;
        $agencia = isset($conta->agencia) ? $conta->agencia : null;
        $agencia_digito = isset($conta->agencia_digito) ? $conta->agencia_digito : null;
        $conta_numero = isset($conta->conta) ? $conta->conta : null;
        $conta_digito = isset($conta->digito_conta) ? $conta->digito_conta : null;
        $conta_operacao = isset($conta->operacao) ? $conta->operacao : null;

        $conn_destino->query("INSERT INTO users(username,
                                                password,
                                                email,
                                                status,
                                                email_status,
                                                banned,
                                                full_name,
                                                birthday,
                                                cpf,
                                                gender,
                                                phone,
                                                balance,
                                                balance_network,
                                                balance_reserved,
                                                earnings,
                                                sponsor_id,
                                                create_date,
                                                token_activation,
                                                token_recovery,
                                                token_recovery_time,
                                                new_article,
                                                bitcoin_address,
                                                title_id,
                                                graduation_points,
                                                binary_direction,
                                                binary_position,
                                                binary_left_points,
                                                binary_left_points_total,
                                                binary_left_members,
                                                binary_left_last_member,
                                                binary_right_points,
                                                binary_right_points_total,
                                                binary_right_members,
                                                binary_right_last_member,
                                                bonus_daily,
                                                banco,
                                                agencia,
                                                digitoagencia,
                                                conta,
                                                digitoconta,
                                                operacao,
                                                contamibank,
                                                contaurpay,
                                                patrocinado,
                                                urpay_user_id,
                                                address,
                                                district,
                                                city,
                                                state_abbreviation,
                                                zip_code,
                                                pacote) VALUES ('$usuarioOrigem->login',
                                                                '$usuarioOrigem->senha',
                                                                '$usuarioOrigem->email',
                                                                'active',
                                                                'active',
                                                                '$banned',
                                                                '$usuarioOrigem->nome',
                                                                '1990-01-01',
                                                                '$usuarioOrigem->cpf',
                                                                'male',
                                                                '$usuarioOrigem->celular',
                                                                $usuarioOrigem->saldo_rendimentos,
                                                                $usuarioOrigem->saldo_indicacoes,
                                                                0,
                                                                0,
                                                                $patrocinador,
                                                                '$usuarioOrigem->data_cadastro',
                                                                NULL,
                                                                NULL,
                                                                NULL,
                                                                '0',
                                                                '$carteira_bitcoin',
                                                                $usuarioOrigem->plano_carreira,
                                                                0,
                                                                '$chave_binaria',
                                                                NULL,
                                                                0,
                                                                0,
                                                                0,
                                                                0,
                                                                0,
                                                                0,
                                                                0,
                                                                0,
                                                                0,
                                                                '$codigo_banco',
                                                                '$agencia',
                                                                '$agencia_digito',
                                                                '$conta_numero',
                                                                '$conta_digito',
                                                                '$conta_operacao',
                                                                NULL,
                                                                NULL,
                                                                NULL,
                                                                '',
                                                                NULL,
                                                                NULL,
                                                                NULL,
                                                                NULL,
                                                                NULL,
                                                                NULL)");
    }

    public static function AdicionarBinario($id_usuario, $esquerda, $direita) {
        GLOBAL $conn_destino;

        $conn_destino->query("INSERT INTO tree_binary(user_id,
                                                      user_left,
                                                      user_right) VALUES ($id_usuario,
                                                                          $esquerda,
                                                                          $direita)");
    }
}