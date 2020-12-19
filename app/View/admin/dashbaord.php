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
                    <?php if (isset($users) && $membre->getRoles() == 3) :?>
                        <tr>
                            <th scope="row"><?= $membre->getIdUsers() ?></th>
                            <td><?= $membre->getPseudo() ?></td>
                            <td  class="hidden"><?= $membre->getRoles() ?></td>
                            <td><?= $membre->getFirstname() ?></td>
                            <td><?= $membre->getLastname() ?></td>
                            <td><?= $membre->getEmail() ?></td>
                            <td><?= $membre->getZipCode() ?></td>
                            <td><?= $membre->getCity() ?></td>
                            <td><?= $membre->getCountry() ?></td>
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
                    <?php if (isset($users) && $bloger->getRoles() == 2) :?>
                        <tr>
                            <th scope="row"><?= $bloger->getIdUsers() ?></th>
                            <td><?= $bloger->getPseudo() ?></td>
                            <td  class="hidden"><?= $bloger->getRoles() ?></td>
                            <td><?= $bloger->getFirstname() ?></td>
                            <td><?= $bloger->getLastname() ?></td>
                            <td><?= $bloger->getEmail() ?></td>
                            <td><?= $bloger->getZipCode() ?></td>
                            <td><?= $bloger->getCity() ?></td>
                            <td><?= $bloger->getCountry() ?></td>
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
                    <?php if (isset($users) && $admin->getRoles() == 1) :?>
                        <tr>
                            <th scope="row"><?= $admin->getIdUsers() ?></th>
                            <td><?= $admin->getPseudo() ?></td>
                            <td  class="hidden"><?= $admin->getRoles() ?></td>
                            <td><?= $admin->getFirstname() ?></td>
                            <td><?= $admin->getLastname() ?></td>
                            <td><?= $admin->getEmail() ?></td>
                            <td><?= $admin->getZipCode() ?></td>
                            <td><?= $admin->getCity() ?></td>
                            <td><?= $admin->getCountry() ?></td>
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
                    <a href="/<?= $post->getPostTitle() ?>/<?= $post->getIdPosts() ?>">
                    <img class="mr-3 rounded" style="width: 3em;" src="./images/<?= $post->getImages()?>" alt="Generic placeholder image">
                    </a>
                    <div class="media-body">
                        <p><strong><?= $post->getPostTitle() ?></strong> <?= 'par '.$post->getUserId()->getPseudo().' <em>'.$post->getDateCreateAt() ?></em></p>
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
                        <p><strong><?= $comment->getCommentTitle()?></strong> <?= 'par '.$comment->getUserId()->getPseudo().' <em>'.$comment->getPostId()->getDateCreateAt() ?></em></p>
                    </div>
                </li>
            </ul>
        <?php endforeach; ?>
    </div>
    <div class="col col-md-12">
        <?php if ($comments == true) : ?>
        <?php else : ?>
        <p>Aucun commentaires signaler</p>
        <?php endif;?>
    </div>
</div>