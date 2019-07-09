<?php

class Invoice {
    public static function Adicionar($fatura, $plano) {
        GLOBAL $conn_destino;

        $dataDeCriacao = date('Y-m-d');
        $status = $fatura->status == 1 ? 'paid' : 'open';

        $conn_destino->query("INSERT INTO invoices(user_id,
                                                   type,
                                                   date,
                                                   date_payment,
                                                   status,
                                                   total,
                                                   tax,
                                                   discount,
                                                   codigo_boleto,
                                                   payment_method,
                                                   hash) VALUES ($fatura->id_usuario,
                                                                 'investment',
                                                                 '$dataDeCriacao',
                                                                 '$fatura->data_pagamento',
                                                                 '$status',
                                                                 $plano->valor,
                                                                 0,
                                                                 0,
                                                                 NULL,
                                                                 NULL,
                                                                 NULL)");

        $invoice_id = $conn_destino->insert_id;

        return Invoice::ObterInvoicePorId($invoice_id);
    }

    public static function ObterInvoicePorId($id) {
        GLOBAL $conn_destino;

        $result = $conn_destino->query("SELECT * from invoices WHERE id = $id");

        $invoice = 0;

        while($row = $result->fetch_object()) {
            $invoice = $row;
        }

        return $invoice;
    }

    public static function AdicionarItem($invoice, $plano) {
        GLOBAL $conn_destino;

        $name = Invoice::ObterNomeDoPacote($plano);

        $conn_destino->query("INSERT INTO invoices_items(invoice_id,
                                                         type,
                                                         item_id,
                                                         price,
                                                         quantity,
                                                         name) VALUES ($invoice->id,
                                                                       'investment',
                                                                       -1,
                                                                       $invoice->total,
                                                                       1,
                                                                       '$name')");
    }

    public static function ObterNomeDoPacote($plano) {
        return str_replace('Aporte ', '', $plano->nome);
    }
}