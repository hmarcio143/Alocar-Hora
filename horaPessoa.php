<?php
require_once("templetes/header.php"); 
require_once("globals.php");
require_once("./bd.php");
require_once("models/Message.php");
require_once("models/User.php"); 
require_once("dao/UserDao.php");
require_once("selectsHoraMes.php");




$userDao = new UserDao($conn, $BASE_URL);
$userData = $userDao->verifyToken(true);

$message = new Message($BASE_URL);
$user = new User();
$usuario = $user->getFullName($userData);


?>
<main class="main-container">

<h2>Olá, <?= $usuario?>. Essas são as suas horas:</h2>

<div class="select_head">
        <form method="get" action="tabelaHoraMes.php">
            <label>Buscar por Mês</label>
            <select name="mes">
                <option>Janeiro</option>
                <option>Fevereiro</option>
                <option>Março</option>
                <option>Abril</option>
                <option>Maio</option>
                <option>Junho</option>
                <option>Julho</option>
                <option>Agosto</option>
                <option>Setembro</option>
                <option>Outubro</option>
                <option>Novembro</option>
                <option>Dezembro</option>
            </select>
            <input type="submit" value="Pesquisar">
        </form>

</div>

<!-- Tabelas da soma das horas meses -->
<div class="table-view">
<table>
<thead>
<tr class="head-table">
    <th>Mês</th>
    <th>Total de horas</th>
</tr>
</thead>
<tbody>
    <tr>     
        <td>Janeiro</td>
        <td><?= $horaMesJaneiro[0][0]?></td>
    </tr>

    <tr>     
        <td>Fevereiro</td>
        <td><?= $horaMesFevereiro[0][0]?></td>
    </tr>

    <tr>     
        <td>Março</td>
        <td><?= $horaMesMarco[0][0]?></td>
    </tr>

    <tr>     
        <td>Abril</td>
        <td><?= $horaMesAbril[0][0]?></td>
    </tr>

    <tr>     
        <td>Maio</td>
        <td><?= $horaMesMaio[0][0]?></td>
    </tr>

    <tr>     
        <td>Junho</td>
        <td><?= $horaMesJunho[0][0]?></td>
    </tr>

    <tr>     
        <td>Julho</td>
        <td><?= $horaMesJulho[0][0]?></td>
    </tr>

    <tr>     
        <td>Agosto</td>
        <td><?= $horaMesAgosto[0][0]?></td>
    </tr>

    <tr>     
        <td>Setembro</td>
        <td><?= $horaMesSetembro[0][0]?></td>
    </tr>

    <tr>     
        <td>Outubro</td>
        <td><?= $horaMesOutubro[0][0]?></td>
    </tr>

    <tr>     
        <td>Novembro</td>
        <td><?= $horaMesNovembro[0][0]?></td>
    </tr>

    <tr>     
        <td>Dezembro</td>
        <td><?= $horaMesDezembro[0][0]?></td>
    </tr>

</tbody>

</table>
</div>

</main>






