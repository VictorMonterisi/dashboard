<?php
    require __DIR__ . '/vendor/autoload.php'; // inclui o autoload e permite chamarmarmos as classes

    define('TITLE', 'Cadastrar Produto'); // Define a constante TITLE e seu valor 'Cadastrar Produto'

    use \App\Entity\Produto; // Define o uso da class Produto dentro do namespace App\Entity
    $objetoProduto = new Produto;

    // VALIDAÇÃO DO POST
    if(isset($_POST['nome'],$_POST['numero_de_serie'], $_POST['descricao'], $_POST['quantidade'])) {
        $objetoProduto->nome = $_POST['nome'];
        $objetoProduto->numero_de_serie = $_POST['numero_de_serie'];
        $objetoProduto->descricao = $_POST['descricao'];
        $objetoProduto->quantidade = $_POST['quantidade'];
        $objetoProduto->cadastrar();

        header('location: index.php?status=success');
        exit;
    }

    include __DIR__ . '/includes/header.php';
    include __DIR__ . '/includes/formulario.php';
    include __DIR__ . '/includes/footer.php';
?>