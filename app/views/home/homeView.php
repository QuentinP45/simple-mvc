<h1>Accueils</h1>
<h2>Mes derniers articles</h2>

<?php foreach($data as $article): ?>
<p>
    Titre: <?= $article->getTitle() ?><br/>
    Titre: <?= $article->getDate() ?><br/>
    Titre: <?= $article->getCOntent() ?>
</p>
<?php endforeach ?>