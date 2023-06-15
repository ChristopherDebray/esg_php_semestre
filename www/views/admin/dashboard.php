<table>
    <tr>
        <th>ID</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
        <th>Date inserted</th>
        <th>Date updated</th>
        <th>Status</th>
        <th>Rôle</th>
        <th>Modifier</th>
        <th>Supprimer</th>
    </tr>
    <?php foreach ($data as $user ): ?>
        <tr>
            <td><?= $user->getId() ?></td>
            <td><?= $user->getFirstname() ?></td>
            <td><?= $user->getLastname() ?></td>
            <td><?= $user->getEmail() ?></td>
            <td><?= $user->getDateInserted() ?></td>
            <td><?= $user->getDateUpdated() ?></td>
            <td><?= $user->getStatus() ?></td>
            <td><?= $user->getRole() ?></td>
            <td><a class="button --warning" href="update-user?id=<?= $user->getId() ?>">Modifier</a></td>
            <td><a class="button --danger" href="hard-delete-user?id=<?= $user->getId() ?>">Supprimer</a></td>
        </tr>
    <?php endforeach; ?>
</table>
   