<h1 class="text-center m-5 cover-heading display-4">Mes Articles</h1>
<div class="row mb-5">
    <?php if (isset($_SESSION['id_membre'], $isAdmin) && $isAdmin) : ?>
    <div class="col-md-12">
        <a class="btn btn-outline-light" href="/editPost/create">Ajouter un nouvelle article</a>
    </div>
        <?php
    endif;
    foreach ($listPost as $post) : ?>
        <div class="col-md-4 mt-4">
            <div class="card bg-black">
                <img src="./images/<?= $post['images'] ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($post['postTitle']) ?></h5>
                    <p class="text-muted"><?= $post['create_at'] ?></p>
                    <p class="text-muted">Ecrit par <?= $post['pseudo'] ?></p>
                    <a
                        href="<?= str_replace(' ', '-', $post['postTitle']).'/'.$post['idPosts'] ?>"
                        class="btn btn-outline-light btn-sm">Lire
                    </a>
                </div>
            </div>
        </div>
        <?php
    endforeach;
    ?>
</div>
