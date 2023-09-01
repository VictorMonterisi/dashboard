<?php
    require __DIR__ . '/vendor/autoload.php'; // inclui o autoload e permite chamarmarmos as classes
    use \App\Entity\Produto;
    $produtos = Produto::getProdutos();
    include __DIR__ . '/includes/header.php';
    include __DIR__ . '/includes/listagem.php';
    include __DIR__ . '/includes/footer.php';
?>