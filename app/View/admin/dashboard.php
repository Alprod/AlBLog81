<h1 class="display-2 mt-5 mb-5 dashTitle"> <?= $titre ?> </h1>
<div class="row">
    <div class="col col-md-12">Actuellement le blog compte <?= count($users) ?> membres tout status confondu</div>
    <div class="col col-md-12">
        <h3 class="mt-3">Table des Membres</h3>
        <div class="table-responsive">
            <table class="table
                          table-bordered
                          table-dark
                          table-hover">
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
                    <th scope="col">Supp</th>
                    <th scope="col">Bloggeur</th>
                    <th scope="col">Admin</th>
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
                            <td>
                                <div class="d-flex justify-content-center">
                                    <form action="<?= url('deletedMember') ?>" method="post">
                                        <input hidden name="idUsers" value="<?= $membre->getIdUsers() ?>" type="text">
                                        <button type="submit" class="bg-transparent border-0">
                                            <i class="bi bi-trash text-center" style="color: crimson"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <form action="<?= url('updateMemberToBlogger') ?>" method="post">
                                        <input hidden name="idUsers" value="<?= $membre->getIdUsers() ?>" type="text">
                                        <button type="submit" class="bg-transparent border-0">
                                            <i class="bi bi-person-fill" style="color: dodgerblue"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <form action="<?= url('updateMemberToSuperAdmin') ?>" method="post">
                                        <input hidden name="idUsers" value="<?= $membre->getIdUsers() ?>" type="text">
                                        <button type="submit" class="bg-transparent border-0">
                                            <i class="bi bi-person-square" style="color: forestgreen"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
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
            <table class="table
                          table-bordered
                          table-light
                          table-hover">
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
                    <th scope="col">Supp</th>
                    <th scope="col">Membre</th>
                    <th scope="col">Admin</th>
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
                            <td>
                                <div class="d-flex justify-content-center">
                                    <form action="<?= url('deletedMember') ?>" method="post">
                                        <input hidden name="idUsers" value="<?= $bloger->getIdUsers() ?>" type="text">
                                        <button type="submit" class="bg-transparent border-0">
                                            <i class="bi bi-trash text-center" style="color: crimson"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <form action="<?= url('updateToMember') ?>" method="post">
                                        <input hidden name="idUsers" value="<?= $bloger->getIdUsers() ?>" type="text">
                                        <button type="submit" class="bg-transparent border-0">
                                            <i class="bi bi-person"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <form action="<?= url('updateMemberToSuperAdmin') ?>" method="post">
                                        <input hidden name="idUsers" value="<?= $bloger->getIdUsers() ?>" type="text">
                                        <button type="submit" class="bg-transparent border-0">
                                            <i class="bi bi-person-square" style="color: forestgreen"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
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
            <table class="table
                          table-bordered
                          table-hover
                          table-secondary">
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
                    <th scope="col">Supp</th>
                    <th scope="col">Blogger</th>
                    <th scope="col">Membre</th>
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
                            <td>
                                <div class="d-flex justify-content-center">
                                    <form action="<?= url('deletedMember') ?>" method="post">
                                        <input hidden name="idUsers" value="<?= $admin->getIdUsers() ?>" type="text">
                                        <button type="submit" class="bg-transparent border-0">
                                            <i class="bi bi-trash text-center" style="color: crimson"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <form action="<?= url('updateMemberToBlogger') ?>" method="post">
                                        <input hidden name="idUsers" value="<?= $admin->getIdUsers() ?>" type="text">
                                        <button type="submit" class="bg-transparent border-0">
                                            <i class="bi bi-person-fill" style="color: dodgerblue"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <form action="<?= url('updateToMember') ?>" method="post">
                                        <input hidden name="idUsers" value="<?= $bloger->getIdUsers() ?>" type="text">
                                        <button type="submit" class="bg-transparent border-0">
                                            <i class="bi bi-person"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                    <?php endif; ?>
                <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col col-md-12 mt-4">
        <div class="row">
            <div class="col col-md-6">
                <h3 class="mt-3">Liste des articles du site</h3>
                <p>Nombres d'article <?= count($posts) ?></p>
                <div class="dashContentView mt-2">
                    <ul class="p-0">
                        <?php foreach ($posts as $post) : ?>
                            <li class="media my-4">
                                <a href="/<?= $post->getPostTitle() ?>/<?= $post->getIdPosts() ?>">
                                    <?php if (!empty($post->getImages())) : ?>
                                        <img class="mr-3 rounded"
                                             style="width: 3em;"
                                             src="./images/<?= $post->getImages()?>"
                                             alt="<?= $post->getPostTitle() ?>">
                                    <?php else :  ?>
                                        <img src="https://picsum.photos/id/1074/45"
                                             class="mr-3 rounded"
                                             alt="pas d'image">
                                    <?php endif; ?>
                                </a>
                                <div class="media-body">
                                    <p>
                                        <strong><?= $post->getPostTitle() ?></strong> <?= 'par '.$post->getUserId()->getPseudo().' <em>'.$post->getDateCreateAt() ?></em>
                                    </p>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
           <div class="col col-md-6">
               <h3 class="mt-3">Liste des commentaires </h3>
               <p>Nombre de commentaires <?= count($comments) ?></p>
               <div class="dashContentView mt-2">
                   <ul class="p-0">
                       <?php foreach ($comments as $comment) : ?>
                           <li class="media my-3">
                               <div class="media-body">
                                   <p>
                                       <strong><?= ($comment->getCommentTitle()) ? $comment->getCommentTitle() : 'Pas de titre indiqué' ?></strong><?= ' par '.$comment->getUserId()->getPseudo().' <em>'.$comment->getCommentCreateAt() ?></em>
                                   </p>
                               </div>
                           </li>
                       <?php endforeach; ?>
                   </ul>
               </div>
           </div>
        </div>
    </div>

    <div class="col col-md-12 mt-4">
        <h3 class="mt-3">Commentaire signalé</h3>
        <p> actuelement <?= count($reports)?> Commentaire<?=(count($reports) > 1) ? " signalés" : " signalé"?></p>
        <div class="profilCommentContentView">
            <?php foreach ($reports as $commentReport) :?>
                <div class="card border-danger font-weight-bold bg-transparent mb-3 w-100">
                    <div class="card-header h5">Article : <?= $commentReport->getPostId()->getPostTitle() ?></div>
                    <div class="row">
                        <div class="col col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><?= $commentReport->getCommentTitle() ?></h5>
                                <p class="card-text"><?= html_entity_decode($commentReport->getCommentContent()) ?></p>
                                <p class="card-text">Commentaire écrit par : <?=$commentReport->getUserId()->getPseudo()?></p>
                            </div>
                        </div>
                        <div class="col col-md-4 d-flex justify-content-around">
                            <div class="d-flex align-items-center">
                                <form method="post" action="/deleteReport">
                                    <input type="hidden" name="idComments" value="<?= $commentReport->getIdComments() ?>">
                                    <button type="submit" class="btn btn-danger mx-2"
                                            title="Supprimer le commentaire">
                                        <i class="bi bi-trash text-center"></i>
                                    </button>
                                </form>
                                <form method="post" action="/updateReport">
                                    <input type="hidden" name="idComments" value="<?= $commentReport->getIdComments() ?>">
                                    <button type="submit" class="btn btn-info mx-2" title="Approuver le commentaire">
                                        <i class="bi bi-check text-center"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach;?>
        </div>
    </div>
</div>