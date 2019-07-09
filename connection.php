<?php

/**
 * Dados de Conexão de Origem
 */
DEFINE('HOST_ORIGEM', "127.0.0.1");
DEFINE('USER_ORIGEM', "root");
DEFINE('PASSWORD_ORIGEM', "");
DEFINE('DATABASE_ORIGEM', "toro_origem");

$conn_origem = mysqli_connect(HOST_ORIGEM, USER_ORIGEM, PASSWORD_ORIGEM, DATABASE_ORIGEM);

/**
 * Dados de Conexáo de Destino
 */
DEFINE('HOST_DESTINO', "127.0.0.1");
DEFINE('USER_DESTINO', "root");
DEFINE('PASSWORD_DESTINO', "");
DEFINE('DATABASE_DESTINO', "toro_destino");

$conn_destino = mysqli_connect(HOST_DESTINO, USER_DESTINO, PASSWORD_DESTINO, DATABASE_DESTINO);