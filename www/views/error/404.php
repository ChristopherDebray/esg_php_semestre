<div class="container">
    <div class="row">
        <div class="col-12 pl-2">
            <h1>Oops ...</h1>
            <h2>Une erreur est survenue</h2>
            <p><?= $message ?? 'Page introuvable' ?></p>

            <a class="button button--secondary" href="/">Retourner à l'accueil</a>
            <a class="button button--info ml-3" href="javascript:history.go(-1)">Retourner en arrière</a>
        </div>
    </div>
</div>