<?php
class UsuarioOrigem {

    public static function Listar() {

        GLOBAL $conn_origem;

        $result = $conn_origem->query('SELECT * FROM usuarios');

        $usuarios = [];

        while($row = $result->fetch_object()) {
            array_push($usuarios, $row);
        }

        return $usuarios;
    }

    public static function ObterPatrocinador($id_usuario) {
        GLOBAL $conn_origem;

        $result = $conn_origem->query('SELECT id_patrocinador_direto FROM rede WHERE id_usuario = '. $id_usuario .'');

        $patrocinador = 0;

        while($row = $result->fetch_object()) {
            $patrocinador = $row->id_patrocinador_direto;
        }

        return $patrocinador;
    }

    public static function ObterChaveBinaria($id_usuario, $lado) {
        GLOBAL $conn_origem;

        $result = $conn_origem->query('SELECT id_usuario FROM rede WHERE id_patrocinador_direto = '. $id_usuario .' and chave_binaria = '. $lado .'');

        $usuario = 0;

        while($row = $result->fetch_object()) {
            $usuario = $row->id_usuario;
        }

        return $usuario;
    }

    public static function ObterConta($id_usuario) {
        GLOBAL $conn_origem;

        $result = $conn_origem->query('SELECT * FROM usuarios_contas WHERE id_usuario = '. $id_usuario .'');

        $conta = null;

        while($row = $result->fetch_object()) {
            $conta = $row;
        }

        return $conta;
    }

    public static function ObterStatus($id_usuario) {
        GLOBAL $conn_origem;

        $result = $conn_origem->query('SELECT status FROM faturas WHERE id_usuario = '. $id_usuario .' and status = 1');

        $fatura = null;

        while($row = $result->fetch_object()) {
            $fatura = $row;
        }

        if ($fatura != null && $fatura->status == 1)
            return 'active';
        
        return 'inactive';
    }

    public static function ObterPontuacaoBinaria($id_usuario, $lado) {
        GLOBAL $conn_origem;

        $result = $conn_origem->query('SELECT * FROM rede_pontos_binario WHERE id_usuario = '. $id_usuario .' and chave_binaria = '. $lado .'');

        $pontos = 0;

        while($row = $result->fetch_object()) {
            $pontos += $row->pontos;
        }

        return $pontos;
    }

    public static function ObterStatusDaRede($id_usuario) {
        GLOBAL $conn_origem;

        $result = $conn_origem->query('SELECT plano_ativo FROM rede WHERE id_usuario = '. $id_usuario .'');

        $status = null;

        while($row = $result->fetch_object()) {
            $status = $row;
        }

        if ($status != null && $status->plano_ativo == 1)
            return true;
        
        return false;
    }

    public static function ObterGanhos($id_usuario) {
        GLOBAL $conn_origem;

        $result = $conn_origem->query('SELECT * FROM usuarios WHERE id = '. $id_usuario .'');

        $ganhos = 0;

        while($row = $result->fetch_object()) {
            $ganhos = ($row->saldo_rendimentos);
        }

        return $ganhos;
    }

}
?>