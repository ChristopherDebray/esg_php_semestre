<table>
    <tr>
        <th>ID</th>
        <th>Date inserted</th>
        <th>Date updated</th>
        <th>Id du commentaire</th>
        <th>Status</th>
        <th>Valider</th>
        <th>Bloquer</th>
    </tr>
    <?php foreach ($data as $report ): ?>
        <tr>
            <td><?= $report->getId() ?></td>
            <td><?= $report->getDateInserted() ?></td>
            <td><?= $report->getDateUpdated() ?></td>
            <td><?= $report->getComment() ?></td>
            <td><?= $report->getStatus() ?></td>
            <td><a class="button --success" href="validate-comment?id=<?= $report->getId() ?>">Valider le commentaire</a></td>
            <td><a class="button --danger" href="block-comment?id=<?= $report->getId() ?>">Bloquer le commentaire</a></td>
        </tr>
    <?php endforeach; ?>
</table>
