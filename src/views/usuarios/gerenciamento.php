<?php
/** @var array $usuarios */
require_once __DIR__ . '/../../seguranca/csrf.php';
?>
<main>
    <h1>Gerenciamento de Usuários</h1>

    <div class="table-responsive">
        <table class="table tabela-usuarios">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Perfil</th>
                    <th scope="col" class="coluna-status">Status</th>
                    <th scope="col" class="coluna-acoes">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($usuarios as $usuario): ?>
                    <tr>
                        <td><?= htmlspecialchars($usuario['nome']) ?></td>
                        <td><?= htmlspecialchars($usuario['email']) ?></td>
                        <td><?= htmlspecialchars($usuario['perfil']) ?></td>
                        <td class="coluna-status"><?= htmlspecialchars($usuario['status']) ?></td>
                        <td class="coluna-acoes">
                            <form method="POST" action="/processar-usuario.php">
                                <input type="hidden" name="id_usuario" value="<?= $usuario['id'] ?>">
                                <input type="hidden" name="tokenCSRF" value="<?= htmlspecialchars(gerarTokenCSRF()) ?>">

                                <?php if($usuario['perfil'] !== 'Administrador'):?>
                                    <?php if($usuario['status'] === 'bloqueado'): ?>
                                    <button type="submit" name="acao" value="desbloquear" class="btn btn-success">Desbloquear</button>

                                    <?php else: ?>
                                        <button type="submit" name="acao" value="bloquear" class="btn btn-danger">Bloquear</button>
                                    <?php endif ?>
                                <?php endif ?>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>