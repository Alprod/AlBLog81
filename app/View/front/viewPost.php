<div class="mt-5"></div>
<h3><?= $slug ?></h3>

<div class="card border-dark text-white bg-dark mb-3 bg-black">
    <img class="card-img-top" src="./../images/<?= $post['images'] ?>" alt="<?= $post['postTitle'] ?>">
    <div class="card-body">
        <h5 class="card-title"><?= htmlspecialchars( $post['postTitle']) ?></h5>
        <p class="card-text"><?= nl2br(htmlspecialchars($post['postContent']))  ?></p>
        <p>Visitez le site <a href="<?= $post['link']; ?>" class="font-italic" target="_blank"><?= htmlspecialchars( $post['postTitle']) ?></a></p>
        <p class="text-muted"><?= $post['create_at'] ?></p>
        <a href="/blogs" class="btn btn-outline-light btn-sm mb-2">retour</a>

        <?php if (isset($_SESSION['id_membre'])):?>
        <button class="btn btn-outline-light btn-sm mb-2" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            Rediger un commentaire
        </button>
        <?php endif; ?>

        <div class="collapse row bg-dark" id="collapseExample">
            <div class="card card-body mb-5 p-5 bg-dark border border-dark">
                <form method="POST" action="<?php '/'.$slug.'/'.$id ?>">
                    <div class="col-md-12 mt-3">
                        <label for="inputCommentName">Nom/Pseudo</label>
                        <input type="text" name="commentName" id="inputCommentName" value="<?= $_SESSION['pseudo_membre'] ?? '' ?>" class="inputCommentName text-white rounded-lg form-control border border-dark">
                    </div>
                    <div class="col-md-12 mt-3">
                        <label for="inputCommentEmail">Titre</label>
                        <input type="text" name="commentTitle" id="inputCommentEmail" class="inputCommentEmail text-white rounded-lg form-control border border-dark">
                    </div>

                    <div class="col-md-12 mt-3">
                        <label for="commentaire">Commentaire</label>
                        <textarea name="Commentaire" id="commentaire" cols="30" rows="10" class="inputComment text-white rounded form-control border border-dark"></textarea>
                    </div>
                    <button type="submit" class="btn btn-outline-light ml-3 mt-3">Envoyer</button>
                </form>
            </div>
        </div>
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