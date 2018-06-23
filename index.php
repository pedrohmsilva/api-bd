<?php

include "route.php";
include "bd/Connection.php";

include "src/UnidadePrisional.php";
include "src/Fornecedor.php";
include "src/Pavilhao.php";
include "src/Bloco.php";
include "src/Cela.php";
include "src/Prisioneiro.php";
include "src/Familiar.php";
include "src/Servidor.php";

include "request.php";

header("Access-Control-Allow-Origin: *");

$route = new Route();
$route->add('/', null, null);
$route->add('test', 'Request', 'test');

$route->add('unidades/listar', 'UnidadePrisional', 'listar');
$route->add('unidades/criar', 'UnidadePrisional', 'criar');
$route->add('unidades/alterar', 'UnidadePrisional', 'alterar');
$route->add('unidades/remover', 'UnidadePrisional', 'remover');
$route->add('unidades/buscar', 'UnidadePrisional', 'buscar');

$route->add('fornecedores/listar', 'Fornecedor', 'listar');
$route->add('fornecedores/criar', 'Fornecedor', 'criar');
$route->add('fornecedores/alterar', 'Fornecedor', 'alterar');
$route->add('fornecedores/remover', 'Fornecedor', 'remover');
$route->add('fornecedores/buscar', 'Fornecedor', 'buscar');

$route->add('pavilhoes/listar', 'Pavilhao', 'listar');
$route->add('pavilhoes/criar', 'Pavilhao', 'criar');
$route->add('pavilhoes/alterar', 'Pavilhao', 'alterar');
$route->add('pavilhoes/remover', 'Pavilhao', 'remover');
$route->add('pavilhoes/buscar', 'Pavilhao', 'buscar');

$route->add('blocos/listar', 'Bloco', 'listar');
$route->add('blocos/criar', 'Bloco', 'criar');
$route->add('blocos/alterar', 'Bloco', 'alterar');
$route->add('blocos/remover', 'Bloco', 'remover');
$route->add('blocos/buscar', 'Bloco', 'buscar');

$route->add('celas/listar', 'Cela', 'listar');
$route->add('celas/criar', 'Cela', 'criar');
$route->add('celas/alterar', 'Cela', 'alterar');
$route->add('celas/remover', 'Cela', 'remover');
$route->add('celas/buscar', 'Cela', 'buscar');

$route->add('prisioneiros/listar', 'Prisioneiro', 'listar');
$route->add('prisioneiros/criar', 'Prisioneiro', 'criar');
$route->add('prisioneiros/alterar', 'Prisioneiro', 'alterar');
$route->add('prisioneiros/remover', 'Prisioneiro', 'remover');
$route->add('prisioneiros/buscar', 'Prisioneiro', 'buscar');

$route->add('familiares/listar', 'Familiar', 'listar');
$route->add('familiares/criar', 'Familiar', 'criar');
$route->add('familiares/alterar', 'Familiar', 'alterar');
$route->add('familiares/remover', 'Familiar', 'remover');
$route->add('familiares/buscar', 'Familiar', 'buscar');

$route->add('servidores/listar', 'Servidor', 'listar');
$route->add('servidores/criar', 'Servidor', 'criar');
$route->add('servidores/alterar', 'Servidor', 'alterar');
$route->add('servidores/remover', 'Servidor', 'remover');
$route->add('servidores/buscar', 'Servidor', 'buscar');

$result = $route->submit();

echo $result;