<table>
  <ul>
    <?php foreach ($data as $page ): ?>
        <li>
          <a href="<?= $page->getSlug() ?>"><?= $page->getTitle() ?></a>
        </li>
    <?php endforeach; ?>
  </ul>
</table>
