<?php
    require __DIR__ . '/vendor/autoload.php'; // inclui o autoload e permite chamarmarmos as classes

    define('TITLE', 'Editar Produto'); // Define a constante TITLE e seu valor 'Editar Produto'

    use \App\Entity\Produto; // Define o uso da class Produto dentro do namespace App\Entity

    // VALIDAÇÃO DO ID
    if(!isset($_GET['id']) or !is_numeric($_GET['id'])) {
        // obriga o usuário a passar um ID caso o ID não tenha sido pego pelo sistema
        header('location: index.php?status=error');
        exit;
    }
    
    // CONSULTA PRODUTO PELO ID
    $objetoProduto = Produto::getSomenteUmProduto($_GET['id']);

    // VERIFICA SE O PRODUTO EXISTE NO BANCO DE DADOS
    if(!$objetoProduto instanceof Produto) {
        header('location: index.php?status=error');
        exit;
    }

    // VALIDAÇÃO DO POST
    if(isset($_POST['nome'],$_POST['numero_de_serie'], $_POST['descricao'], $_POST['quantidade'])) {
        // $objetoProduto = new Produto;
        $objetoProduto->nome = $_POST['nome'];
        $objetoProduto->numero_de_serie = $_POST['numero_de_serie'];
        $objetoProduto->descricao = $_POST['descricao'];
        $objetoProduto->quantidade = $_POST['quantidade'];
        $objetoProduto->atualizar();

        header('location: index.php?status=success');
        exit;
    }

    include __DIR__ . '/includes/header.php';
    include __DIR__ . '/includes/formulario.php';
    include __DIR__ . '/includes/footer.php';
?>