<?php
    $valueNome = !empty($objetoProduto->nome) ? $objetoProduto->nome : '';
    $valueNumeroDeSerie = !empty($objetoProduto->numero_de_serie) ? $objetoProduto->numero_de_serie : '';
    $valueDescricao = !empty($objetoProduto->descricao) ? $objetoProduto->descricao : '';
    $valueQuantidade = !empty($objetoProduto->quantidade) ? $objetoProduto->quantidade : '';
?>

<main>
    <h2 class="mt-3"><?=TITLE?></h2>
    <form method="post"> <!-- Não tem action pois a ação do formulário sempre é para a mesma página -->
        <div class="form-group">
            <label>Nome</label>
            <input type="text" name="nome" value="<?=$valueNome?>" class="form-control">
        </div>
        <div class="form-group">
            <label>Número de Série</label>
            <input type="number" name="numero_de_serie" value="<?=$valueNumeroDeSerie?>" class="form-control">
        </div>
        <div class="form-group">
            <label>Descrição</label>
            <textarea name="descricao" rows="2" class="form-control"><?=$valueDescricao?></textarea>
        </div>
        <div class="form-group">
            <label>Quantidade</label>
            <input type="number" name="quantidade" value="<?=$valueQuantidade?>" class="form-control">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success">Enviar</button>
        </div>
    </form>
</main>