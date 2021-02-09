<h1 class="text-center m-5 cover-heading display-4"><?php echo $titre ?></h1>
<h2 class="m-3">Profil de <?php echo $profil->getPseudo() ?></h2>

<div class="row">
    <div class="col-md-6">
        <div class="border rounded shadow-sm p-2">
            <p><?php echo $profil->getLastName().' '.$profil->getFirstname() ?></p>
            <p>Prseudo : <?php echo $profil->getPseudo() ?></p>
            <p>Email : <?php echo $profil->getEmail() ?></p>
            <p>Pays : <?php echo $profil->getCountry() ?></p>
            <?php if (isset($success)) :?>
                <div class="alert alert-success btn-sm alert-dismissible fade show" role="alert">
                    <?php echo $success ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
            <a
                href="<?php echo url('updateRegister')?>"
                value="Modifier l'article"
                class="btn btn-outline-info btn-sm btn-block mb-2">
                Mettre à jour
            </a>
            <hr class="my-4 border-white">
            <p>Date d'inscription :  <?php echo $dateInscription ?></p>
        </div>
    </div>
    <div class="col-md-6">
        <div class="border rounded shadow-sm formMdp">

            <h3 class="mb-3">Modifier mot de passe</h3>

            <?php if (isset($errorMdp)) : ?>
                <div class="col-md-12">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php echo $errorMdp ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            <?php endif; ?>

            <form action="<?php echo url('mdpUpdate') ?>" method="post">

                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Actuel</span>
                    </div>
                    <input type="password"
                           name="mdpActuel"
                           class="text-white form-control mdp"
                           aria-label="Sizing example input"
                           aria-describedby="inputGroup-sizing-sm">
                </div>

                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Nouveau</span>
                    </div>
                    <input type="password"
                           name="mdpNew"
                           class="text-white form-control mdp"
                           aria-label="Sizing example input"
                           aria-describedby="inputGroup-sizing-sm">
                </div>

                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Comfirmer</span>
                    </div>
                    <input type="password"
                           name="mdpComfirm"
                           class="text-white form-control mdp"
                           aria-label="Sizing example input"
                           aria-describedby="inputGroup-sizing-sm">
                </div>

                <button type="submit" class="btn btn-outline-light btn-sm btn-block">Validez</button>
            </form>
        </div>
        <div class="px-5 bg-black mt-3 rounded">
            <p class="text-center py-3"><i class="p-1 mb-1 bi bi-exclamation-triangle bg-warning rounded text-dark" style="font-size: 1rem;"> Attention</i> Une fois que vous supprimez votre compte, il n'y a plus de retour en arrière. Toutes les données vous concernent seront supprimées Soyez certain.</p>
        </div>
        <div class="d-flex justify-content-center">
            <form method="post" action="<?php echo url('deleteRegister') ?>">
                <input hidden name="idUsers" value="<?php echo $profil->getIdUsers() ?>">
                <button type="submit" class="btn btn-danger">Supprimer votre profil</button>
            </form>
        </div>
    </div>
    <div class="<?php echo ($profil->isAdmin() || $profil->isSuperAdmin()) ? 'col-md-6' : 'col-md-12' ?> overflow-auto mt-5 mb-5" id="commentsUser">
        <h2>Vos commentaires</h2>
        <div class="profilCommentContentView">
            <?php if (!empty($comments)) :
                foreach ($comments as $comment) : ?>
                <div class="media bg-black mt-3 rounded">
                    <img src="<?php echo './images/'.$comment->getPostId()->getImages() ?>"
                         class="align-self-center m-3 rounded-lg"
                         style="width: 80px;height: 80px"
                         alt="<?php echo htmlspecialchars($comment->getPostId()->getPostTitle()) ?>">

                    <div class="media-body">
                        <h5 class="mt-2"><?php echo htmlspecialchars($comment->getPostId()->getPostTitle()) ?></h5>
                        <hr class="my-4 mr-4 border-white">
                        <p> <?php echo htmlspecialchars(html_entity_decode($comment->getCommentTitle())) ?> </p>
                        <p>Créer le : <?php echo $comment->getCommentCreateAt() ?> </p>
                    </div>
                </div>
                <?php endforeach;
            else :
                ?>
                <p>Désolé mais vous avez fais aucun commentaire sur un article.</p>
                <?php
            endif;
            ?>
        </div>
    </div>
    <?php if ($profil->isAdmin() || $profil->isSuperAdmin()) : ?>
    <div class="col-md-6 mt-5" id="commentsUser">
        <h2>Vos articles</h2>
        <div class="profilPostContentView">
        <?php foreach ($posts as $post) : ?>
            <div class="media bg-black mt-3 rounded">
                <a href="<?php echo '/'.$post->getPostTitle().'/'.$post->getIdPosts() ?>">
                    <img src="<?php echo './images/'.$post->getImages() ?>"
                         class="align-self-center m-3 rounded-lg"
                         style="width: 80px;height: 80px"
                         alt="<?php echo htmlspecialchars($post->getPostTitle()) ?>">
                </a>
                <div class="media-body">
                    <h5 class="mt-2"><?php echo htmlspecialchars(html_entity_decode($post->getPostTitle())) ?></h5>
                    <hr class="my-4 mr-4 border-white">
                    <p>Créer le : <?php echo $post->getDateCreateAt() ?> </p>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>
</div>
