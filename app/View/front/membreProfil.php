<h1 class="text-center m-5 cover-heading display-4"><?= $titre ?></h1>
<h2 class="m-3">Profil de <?= $profil['pseudo'] ?></h2>

<div class="row">
    <div class="col-md-6">
        <div class="border rounded shadow-sm p-2">
            <p><?= $profil['lastname'].' '.$profil['firstname']  ?></p>
            <p>Prseudo : <?= $profil['pseudo'] ?></p>
            <p>Email : <?= $profil['email'] ?></p>
            <p>Pays : <?= $profil['country']  ?></p>
            <hr class="my-4 border-white">
            <p>Date d'inscription :  <?= $dateInscription ?></p>
        </div>
    </div>
    <div class="col-md-6">
        <div class="border rounded shadow-sm formMdp">

            <h3 class="mb-3">Modifier mot de passe</h3>

            <?php if (isset($errorMdp)) : ?>
                <div class="col-md-12">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= $errorMdp ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            <?php endif; ?>

            <form action="/mdpUpdate" method="post">

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
    </div>
    <div class="<?= (isset($isAdmin) && $isAdmin) ? 'col-md-6' : 'col-md-12' ?> overflow-auto mt-5" id="commentsUser">
        <h2>Vos commentaires</h2>

        <?php if (!empty($comments)) :
            foreach ($comments as $comment) : ?>
            <div class="media bg-black mt-3 rounded">
                <img src="<?= './images/'.$comment['images'] ?>"
                     class="align-self-center m-3 rounded-lg"
                     style="width: 80px;height: 80px"
                     alt="<?= htmlspecialchars($comment['postTitle']) ?>">

                <div class="media-body">
                    <h5 class="mt-2"><?= htmlspecialchars($comment['postTitle']) ?></h5>
                    <hr class="my-4 mr-4 border-white">
                    <p> <?= htmlspecialchars(html_entity_decode($comment['commentTitle'])) ?> </p>
                    <p> <?= html_entity_decode($comment['commentContent']) ?> </p>
                    <p>Créer le : <?= $comment['dateCreateAt'] ?> </p>
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
    <?php if (isset($isAdmin) && $isAdmin) : ?>
    <div class="col-md-6 overflow-auto mt-5" id="commentsUser">
        <h2>Vos articles</h2>
        <?php foreach ($posts as $post) : ?>
            <div class="media bg-black mt-3 rounded">
                <img src="<?= './images/'.$post['images'] ?>"
                     class="align-self-center m-3 rounded-lg"
                     style="width: 80px;height: 80px"
                     alt="<?= htmlspecialchars($post['postTitle']) ?>">

                <div class="media-body">
                    <h5 class="mt-2"><?= htmlspecialchars(html_entity_decode($post['postTitle'])) ?></h5>
                    <hr class="my-4 mr-4 border-white">
                    <p> <?= html_entity_decode($post['postContent']) ?> </p>
                    <p>Créer le : <?= $post['create_at'] ?> </p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>
