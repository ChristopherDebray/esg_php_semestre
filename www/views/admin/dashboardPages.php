<table>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Slug</th>
        <th>Date inserted</th>
        <th>Date updated</th>
        <th>Theme</th>
        <th>Status</th>
        <th>Modifier</th>
        <th>Supprimer</th>
    </tr>
    <?php foreach ($data as $page ): ?>
        <tr>
            <td><?= $page->getId() ?></td>
            <td><?= $page->getTitle() ?></td>
            <td><?= $page->getSlug() ?></td>
            <td><?= $page->getDateInserted() ?></td>
            <td><?= $page->getDateUpdated() ?></td>
            <td><?= $page->getTheme() ?></td>
            <td><?= $page->getStatus() ?></td>
            <td><a class="button --warning" href="update-page?id=<?= $page->getId() ?>">Modifier</a></td>
            <td>
                <a class="button <?= $page->isPageActive() ? '--danger' : '--success' ?>" href="switch-page-status?id=<?= $page->getId() ?>">
                    <?= $page->isPageActive() ? 'Supprimer' : 'Réactiver' ?>
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
