
<p>Bienvenue sur <?= $slug ?> le blog numéro <?= $id ?></p>
<div class="card border-light text-white bg-dark mb-3 bg-black">
    <img class="card-img-top" src="<?= $post['images'] ?>" alt="<?= $post['title'] ?>">
    <div class="card-body">
        <h5 class="card-title"><?= htmlspecialchars( $post['title']) ?></h5>
        <p class="card-text"><?= nl2br(htmlspecialchars($post['content']))  ?></p>
        <p class="text-muted"><?= $post['create_at'] ?></p>
    </div>
</div>