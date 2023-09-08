<?php

    $mensagem = '';

    if(isset($_GET['status'])) {
        switch ($_GET['status']) {
            case 'success':
                $mensagem = '<div class="alert alert-success">Ação executada com sucesso!</div>';
                break;
            case 'error':
                $mensagem = '<div class="alert alert-danger">Houve um erro! Ação não executada!</div>';
                break;
        }
    }

    $resultados = '';

    foreach ($produtos as $produto):
        $resultados .= "<tr>
                            <td>{$produto->id}</td>
                            <td>{$produto->nome}</td>
                            <td>{$produto->numero_de_serie}</td>
                            <td>{$produto->descricao}</td>
                            <td>".($produto->quantidade > 0 ? $produto->quantidade : 'Sem estoque!')."</td>
                            <td><a href='editar.php?id={$produto->id}' class='btn btn-primary'>Editar</a></td>
                            <td><a href='excluir.php?id={$produto->id}' class='btn btn-danger'>Excluir</a></td>
                        </tr>";
    endforeach;

    $resultados = !empty($resultados) ? $resultados : '<tr><td colspan="6" class="text-center">Nenhum produto encontrado</td></tr>';
?>
<main>
    <div class="mt-3">
        <?=$mensagem?>
    </div>

    <div>
        <table class="table bg-light mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Número de Série</th>
                    <th>Descrição</th>
                    <th>Quantidade</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?=$resultados?>
            </tbody>
        </table>
    </div>
</main>