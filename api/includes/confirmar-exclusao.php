<?php
    $valueNome = !empty($objetoProduto->nome) ? $objetoProduto->nome : '';
    $valueNumeroDeSerie = !empty($objetoProduto->numero_de_serie) ? $objetoProduto->numero_de_serie : '';
    $valueDescricao = !empty($objetoProduto->descricao) ? $objetoProduto->descricao : '';
    $valueQuantidade = !empty($objetoProduto->quantidade) ? $objetoProduto->quantidade : '';
?>

<main>
    <section>
        <a href="index.php" class="btn btn-success">Voltar</a>
    </section>
    <h2 class="mt-3">Excluir Produto</h2>
    <form method="post"> <!-- Não tem action pois a ação do formulário sempre é para a mesma página -->
        <div class="form-group">
            <p>Tem certeza que deseja excluir o produto <strong><?=$objetoProduto->nome?></strong>?</p>
        </div>
        <div class="form-group">
            <a href="index.php" class="btn btn-success">Cancelar</a>
            <button type="submit" name="excluir" class="btn btn-danger">Excluir</button>
        </div>
    </form>
</main>