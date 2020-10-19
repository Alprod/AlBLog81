<h1 class="text-center m-5 cover-heading display-4">Mes Articles</h1>
<div class="row">
    <?php foreach ($listPost as $post) : ?>
        <div class="col-sm-6 mt-4">
            <div class="card bg-black">
                <img src="<?= $post['images'] ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($post['postTitle']) ?></h5>
                    <p class="text-muted"><?= $post['create_at'] ?></p>
                    <p class="text-muted">Ecrit par <?= $post['pseudo'] ?></p>
                    <a href="<?= str_replace(' ','-',$post['postTitle']).'/'.$post['idPosts'] ?>" class="btn btn-outline-light btn-sm">Lire</a>
                </div>
            </div>
        </div>
    <?php
    endforeach;
    ?>
</div>
