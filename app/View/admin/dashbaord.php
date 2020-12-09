<h1 class="display-2 mt-5 mb-5"> <?= $titre ?> </h1>
<div class="row">
    <div class="col col-md-12">Actuellement le blog compte <?= count($users) ?> membres tout status confondu</div>
    <div class="col col-md-12">
        <h3 class="mt-3">Table des Membres</h3>
        <div class="table-responsive">
            <table class="table table-bordered table-dark table-hover">
                <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Pseudo</th>
                    <th scope="col"  class="hidden">Role</th>
                    <th scope="col">First name</th>
                    <th scope="col">Last name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Zip Code</th>
                    <th scope="col">City</th>
                    <th scope="col">Country</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $membre) : ?>
                    <?php if (isset($users) && $membre['roles'] == 3) :?>
                        <tr>
                            <th scope="row"><?= $membre['idUsers'] ?></th>
                            <td><?= $membre['pseudo'] ?></td>
                            <td  class="hidden"><?= $membre['roles'] ?></td>
                            <td><?= $membre['firstname'] ?></td>
                            <td><?= $membre['lastname'] ?></td>
                            <td><?= $membre['email'] ?></td>
                            <td><?= $membre['zip_code'] ?></td>
                            <td><?= $membre['city'] ?></td>
                            <td><?= $membre['country'] ?></td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="col col-md-12">
        <h3 class="mt-3">Table des Blogers</h3>
        <div class="table-responsive">
            <table class="table table-bordered table-light table-hover">
                <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Pseudo</th>
                    <th scope="col" class="hidden">Role</th>
                    <th scope="col">First name</th>
                    <th scope="col">Last name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Zip Code</th>
                    <th scope="col">City</th>
                    <th scope="col">Country</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $bloger) : ?>
                    <?php if (isset($users) && $bloger['roles'] == 2) :?>
                        <tr>
                            <th scope="row"><?= $bloger['idUsers'] ?></th>
                            <td><?= $bloger['pseudo'] ?></td>
                            <td  class="hidden"><?= $bloger['roles'] ?></td>
                            <td><?= $bloger['firstname'] ?></td>
                            <td><?= $bloger['lastname'] ?></td>
                            <td><?= $bloger['email'] ?></td>
                            <td><?= $bloger['zip_code'] ?></td>
                            <td><?= $bloger['city'] ?></td>
                            <td><?= $bloger['country'] ?></td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="col col-md-12">
        <h3 class="mt-3">Table des administrateurs</h3>
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-secondary">
                <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Pseudo</th>
                    <th scope="col"  class="hidden">Role</th>
                    <th scope="col">First name</th>
                    <th scope="col">Last name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Zip Code</th>
                    <th scope="col">City</th>
                    <th scope="col">Country</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $admin) : ?>
                    <?php if (isset($users) && $admin['roles'] == 1) :?>
                        <tr>
                            <th scope="row"><?= $admin['idUsers'] ?></th>
                            <td><?= $admin['pseudo'] ?></td>
                            <td  class="hidden"><?= $admin['roles'] ?></td>
                            <td><?= $admin['firstname'] ?></td>
                            <td><?= $admin['lastname'] ?></td>
                            <td><?= $admin['email'] ?></td>
                            <td><?= $admin['zip_code'] ?></td>
                            <td><?= $admin['city'] ?></td>
                            <td><?= $admin['country'] ?></td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col col-md-7">
        <h3 class="mt-3">Liste des articles du site</h3>
        <p>Nombres d'article <?= count($posts) ?></p>
    </div>
    <div class="col col-md-5">
        <h3 class="mt-3">Liste des commentaires </h3>
        <p>Nombre de commentaires <?= count($comments) ?></p>
    </div>
    <div class="col col-md-7 mt-5">
        <?php foreach ($posts as $post) : ?>
            <ul>
                <li class="media my-1">
                    <a href="/<?= $post['postTitle']?>/<?= $post['idPosts']?>">
                    <img class="mr-3 rounded" style="width: 3em;" src="./images/<?= $post['images'] ?>" alt="Generic placeholder image">
                    </a>
                    <div class="media-body">
                        <p><strong><?= $post['postTitle']?></strong> <?= 'par '.$post['pseudo'].' <em>'.$post['create_at'] ?></em></p>
                    </div>
                </li>
            </ul>
        <?php endforeach; ?>
    </div>
    <div class="col col-md-5 dashContentView mt-5">
        <?php foreach ($comments as $comment) : ?>
            <ul>
                <li class="media my-1">
                    <div class="media-body">
                        <p><strong><?= $comment['commentTitle']?></strong> <?= 'par '.$comment['pseudo'].' <em>'.$comment['dateCreate_at'] ?></em></p>
                    </div>
                </li>
            </ul>
        <?php endforeach; ?>
    </div>
    <div class="col col-md-12">
        <?php if(isset($comments['signal']) && $comments['signal'] == true): ?>
        <?php else: ?>
        <p>Aucun commentaires signaler</p>
        <?php endif;?>
    </div>
</div>