<?php
/** @var array $usuarios */
?>
<main>
    <h1>Gerenciamento de Usuários</h1>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">E-mail</th>
                <th scope="col">Perfil</th>
                <th scope="col">Status</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($usuarios as $usuario): ?>
                <tr>
                    <td><?= htmlspecialchars($usuario['nome']) ?></td>
                    <td><?= htmlspecialchars($usuario['email']) ?></td>
                    <td><?= htmlspecialchars($usuario['perfil']) ?></td>
                    <td><?= htmlspecialchars($usuario['status']) ?></td>
                    <td>
                        <form method="POST" action="/processar-usuario.php">
                            <input type="hidden" name="id_usuario" value="<?= $usuario['id'] ?>">

                            <?php if($usuario['perfil'] !== 'Administrador'):?>
                                <?php if($usuario['status'] == 'bloqueado'): ?>
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
</main>