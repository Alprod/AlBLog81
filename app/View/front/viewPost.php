<div class="mt-5"></div>
<h3><?= $slug ?></h3>

<div class="card postView border-dark text-white bg-dark mb-3 bg-black">
    <?php if (!empty($post->getImages())) : ?>
    <img
        class="card-img-top"
        src="./../images/<?= $post->getImages() ?>"
        alt="<?= $post->getPostTitle() ?>">
    <?php endif; ?>
    <div class="card-body">

        <h5 class="card-title"><?= $post->getPostTitle() ?></h5>
        <p class="card-text"><?= html_entity_decode($post->getPostContent())  ?></p>

        <?php if (!empty($post->getLink())) : ?>
        <p>Visitez le site
            <a
                href="https://<?= $post->getLink(); ?>"
                class="font-italic"
                target="_blank"><?= htmlspecialchars($post->getLink()) ?>
            </a>
        </p>
        <?php endif; ?>

        <p class="text-muted">Auteur de l'article : <?= $post->getUserId()->getPseudo() ?></p>
        <p class="text-muted">Créer le : <?= $post->getDateCreateAt() ?></p>
        <a href="<?= url('blogs')?>" class="btn btn-outline-light btn-sm mb-2">retour</a>

        <?php if (isset($_SESSION['id_membre'], $_SESSION['membre'])) :?>
        <button
                class="btn btn-outline-light btn-sm mb-2"
                type="button"
                data-toggle="collapse"
                data-target="#collapseExample"
                aria-expanded="false"
                aria-controls="collapseExample">Commentaire
        </button>
            <?php if ($post->getPostUserId() == $_SESSION['membre']->getIdUsers()) : ?>
                <a
                        href="<?= '/posts/' . $post -> getIdPosts() ?>"
                        value="Modifier l'article"
                        class="btn btn-outline-info btn-sm mb-2"><?= $changer ?>
                </a>
                <div class="d-flex justify-content-end">
                    <form method="post" action="<?= url('deletePost')?>">
                        <input type="hidden" name="idPost" value="<?= $post -> getIdPosts() ?>">
                        <button type="submit" class="btn btn-outline-danger btn-sm">Supprimer</button>
                    </form>

                </div>
                <?php
            endif;
        endif; ?>

        <div class="collapse row bg-dark" id="collapseExample">
            <div class="card card-body mb-5 p-5 bg-dark border border-dark">
                <form method="POST" action="<?php '/'.$slug.'/'.$id ?>">
                    <div class="col-md-12 mt-3">
                        <label for="inputCommentName">Nom/Pseudo</label>
                        <input
                                type="text"
                                name="commentName"
                                id="inputCommentName"
                                value="<?= $_SESSION['pseudo_membre'] ?? '' ?>"
                                class="inputCommentName text-white rounded-lg form-control border border-dark">
                    </div>
                    <div class="col-md-12 mt-3">
                        <label for="inputCommentEmail">Titre</label>
                        <input
                                type="text"
                                name="commentTitle"
                                id="inputCommentEmail"
                                class="inputCommentEmail text-white rounded-lg form-control border border-dark">
                    </div>

                    <div class="col-md-12 mt-3">
                        <label for="commentaire">Commentaire</label>
                        <textarea
                                name="Commentaire"
                                id="commentaire"
                                cols="30"
                                rows="10"
                                class="inputComment text-white rounded form-control border border-dark">
                        </textarea>
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
            if (isset($comments)) :
                foreach ($comments as $comment) :
                    ?>
                    <div class="media pl-3 pr-3 mb-3" >
                        <img src="https://picsum.photos/id/1074/64"
                             class="align-self-start mr-3 rounded-circle"
                             alt="...">
                        <div class="media-body">
                            <h5 class="mt-0">
                                <?= htmlspecialchars(html_entity_decode($comment->getCommentTitle())); ?>
                            </h5>
                            <?php if ($comment->getSignal() == 0) :  ?>
                                <p><?= html_entity_decode($comment->getCommentContent()); ?></p>
                            <?php else : ?>
                                <p class="font-italic pt-3">Le Commentaire de cet article a été signaler.<br/> Ce commentaire est par conséquent en cours de modération.</p>
                            <?php endif; ?>

                            <p class="font-italic">Posté par <?= $comment->getUserId()->getPseudo(); ?></p>
                            <p class="text-muted">Créer le : <?= $comment->getCommentCreateAt(); ?></p>
                            <?php if (!isset($_SESSION['id_membre'])) : ?>
                            <p class="font-italic text-muted">
                                Si vous trouvez se texte inapproprié. Veuillez soit vous
                                <a href="/register">inscrire</a> ou vous <a href="/login">connectez</a>
                            </p>
                            <?php else : ?>
                            <form action="<?= url('updateSignal')?>" method="post" class="row">
                                <div class="col col-md-8 m-auto">
                                    <input type="hidden" name="signal" value="<?= $comment->getSignal() ?>">
                                    <input type="hidden" name="idComments" value="<?= $comment->getIdComments() ?>">
                                    <input type="hidden" name="userId" value="<?= $comment->getUserId()->getIdUsers() ?>">
                                    <p class="font-italic text-muted">
                                        Si vous constatez que le commentaire vous semble inapproprié,
                                        veuillez le signaler et nous ferons le nécessaire
                                    </p>
                                </div>
                                <div class="col col-md-4 m-auto">
                                    <button type="submit" class="btn btn-sm btn-outline-danger m-auto">Signaler</button>
                                </div>
                            </form>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php
                endforeach;
            endif;
            ?>
        </div>
    </div>
</div>