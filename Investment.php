<?php

class Investment {
    public static function Adicionar($invoice) {
        GLOBAL $conn_destino;

        $earnings = UsuarioOrigem::ObterGanhos($invoice->user_id);
        $max_earnings = ($invoice->total * 2);

        $conn_destino->query("INSERT INTO investments(user_id,
                                                      start_date,
                                                      finish_date,
                                                      value,
                                                      status,
                                                      earnings,
                                                      max_earnings) VALUES ($invoice->user_id,
                                                                            '$invoice->date_payment',
                                                                            null,
                                                                            $invoice->total,
                                                                            'active',
                                                                            $earnings,
                                                                            $max_earnings)");
    }
}