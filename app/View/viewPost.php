<div class="mt-5"></div>
<h3><?= $slug ?></h3>
<div class="card border-dark text-white bg-dark mb-3 bg-black">
    <img class="card-img-top" src="<?= $post['images'] ?>" alt="<?= $post['postTitle'] ?>">
    <div class="card-body">
        <h5 class="card-title"><?= htmlspecialchars( $post['postTitle']) ?></h5>
        <p class="card-text"><?= nl2br(htmlspecialchars($post['postContent']))  ?></p>
        <p>Visitez le site <a href="<?= $post['link']; ?>" class="font-italic" target="_blank"><?= htmlspecialchars( $post['postTitle']) ?></a></p>
        <p class="text-muted"><?= $post['create_at'] ?></p>
        <a href="/blogs" class="btn btn-outline-light btn-sm">retour</a>
    </div>
    <hr class="m-4 bg-black">
    <div class="row">
        <div class="col-sm mt-3">
            <?php
            if(isset($comments)):
            foreach ($comments as $comment):
                ?>
            <div class="media pl-3">
                <img src="https://via.placeholder.com/64" class="align-self-start mr-3 rounded-circle" alt="...">
                <div class="media-body">
                    <h5 class="mt-0"><?= htmlspecialchars($comment['commentTitle']); ?></h5>
                    <p><?= $comment['commentContent']; ?></p>
                    <p class="font-italic">Posté par <?= $comment['pseudo']; ?></p>
                    <p class="text-muted"><?= $comment['dateCreate_at']; ?></p>
                </div>
            </div>
            <?php
            endforeach;
            endif;
            ?>
        </div>
    </div>
</div>