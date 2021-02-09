<h1 class="display-2 mt-5 mb-5 dashTitle"> <?php echo $titre?> </h1>
<div class="row mb-5">
    <div class="col col-md-12">Actuellement le blog compte <?php echo count($users)?> membres tout status confondu</div>
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
                            <th scope="row"><?php echo $membre->getIdUsers()?></th>
                            <td><?php echo $membre->getPseudo()?></td>
                            <td  class="hidden"><?php echo $membre->getRoles()?></td>
                            <td><?php echo $membre->getFirstname()?></td>
                            <td><?php echo $membre->getLastname()?></td>
                            <td><?php echo $membre->getEmail()?></td>
                            <td><?php echo $membre->getZipCode()?></td>
                            <td><?php echo $membre->getCity()?></td>
                            <td><?php echo $membre->getCountry()?></td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <form action="<?php echo url('deletedMember')?>" method="post">
                                        <input hidden name="idUsers" value="<?php echo $membre->getIdUsers()?>" type="text">
                                        <button type="submit" class="bg-transparent border-0">
                                            <i class="bi bi-trash text-center" style="color: crimson"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <form action="<?php echo url('updateMemberToBlogger')?>" method="post">
                                        <input hidden name="idUsers" value="<?php echo $membre->getIdUsers()?>" type="text">
                                        <button type="submit" class="bg-transparent border-0">
                                            <i class="bi bi-person-fill" style="color: dodgerblue"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <form action="<?php echo url('updateMemberToSuperAdmin')?>" method="post">
                                        <input hidden name="idUsers" value="<?php echo $membre->getIdUsers()?>" type="text">
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
                            <th scope="row"><?php echo $bloger->getIdUsers()?></th>
                            <td><?php echo $bloger->getPseudo()?></td>
                            <td  class="hidden"><?php echo $bloger->getRoles() ?></td>
                            <td><?php echo $bloger->getFirstname()?></td>
                            <td><?php echo $bloger->getLastname()?></td>
                            <td><?php echo $bloger->getEmail()?></td>
                            <td><?php echo $bloger->getZipCode()?></td>
                            <td><?php echo $bloger->getCity()?></td>
                            <td><?php echo $bloger->getCountry()?></td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <form action="<?php echo url('deletedMember')?>" method="post">
                                        <input hidden name="idUsers" value="<?php echo $bloger->getIdUsers()?>" type="text">
                                        <button type="submit" class="bg-transparent border-0">
                                            <i class="bi bi-trash text-center" style="color: crimson"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <form action="<?php echo url('updateToMember')?>" method="post">
                                        <input hidden name="idUsers" value="<?php echo $bloger->getIdUsers()?>" type="text">
                                        <button type="submit" class="bg-transparent border-0">
                                            <i class="bi bi-person"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <form action="<?php echo url('updateMemberToSuperAdmin')?>" method="post">
                                        <input hidden name="idUsers" value="<?php echo $bloger->getIdUsers()?>" type="text">
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
                            <th scope="row"><?php echo $admin->getIdUsers()?></th>
                            <td><?php echo $admin->getPseudo()?></td>
                            <td  class="hidden"><?php echo $admin->getRoles()?></td>
                            <td><?php echo $admin->getFirstname()?></td>
                            <td><?php echo $admin->getLastname()?></td>
                            <td><?php echo $admin->getEmail()?></td>
                            <td><?php echo $admin->getZipCode()?></td>
                            <td><?php echo $admin->getCity()?></td>
                            <td><?php echo $admin->getCountry()?></td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <form action="<?php echo url('deletedMember')?>" method="post">
                                        <input hidden name="idUsers" value="<?php echo $admin->getIdUsers()?>" type="text">
                                        <button type="submit" class="bg-transparent border-0">
                                            <i class="bi bi-trash text-center" style="color: crimson"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <form action="<?php echo url('updateMemberToBlogger')?>" method="post">
                                        <input hidden name="idUsers" value="<?php echo $admin->getIdUsers()?>" type="text">
                                        <button type="submit" class="bg-transparent border-0">
                                            <i class="bi bi-person-fill" style="color: dodgerblue"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <form action="<?php echo url('updateToMember')?>" method="post">
                                        <input hidden name="idUsers" value="<?php echo $bloger->getIdUsers()?>" type="text">
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
                <p>Nombres d'article <?php echo count($posts)?></p>
                <div class="dashContentView mt-2">
                    <ul class="p-0">
                        <?php foreach ($posts as $post) : ?>
                            <li class="media my-4">
                                <a href="/<?php echo $post->getPostTitle()?>/<?php echo $post->getIdPosts()?>">
                                    <?php if (!empty($post->getImages())) : ?>
                                        <img class="mr-3 rounded"
                                             style="width: 3em;"
                                             src="./images/<?php echo $post->getImages()?>"
                                             alt="<?php echo $post->getPostTitle()?>">
                                    <?php else :  ?>
                                        <img src="https://picsum.photos/id/1074/45"
                                             class="mr-3 rounded"
                                             alt="pas d'image">
                                    <?php endif; ?>
                                </a>
                                <div class="media-body">
                                    <p>
                                        <strong><?php echo $post->getPostTitle() ?></strong> <?php echo 'par '.$post->getUserId()->getPseudo().' <em>'.$post->getDateCreateAt() ?></em>
                                    </p>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
           <div class="col col-md-6">
               <h3 class="mt-3">Liste des commentaires </h3>
               <p>Nombre de commentaires <?php echo count($comments) ?></p>
               <div class="dashContentView mt-2">
                   <ul class="p-0">
                       <?php foreach ($comments as $comment) : ?>
                           <li class="media my-3">
                               <div class="media-body">
                                   <p>
                                       <strong><?php echo ($comment->getCommentTitle()) ? $comment->getCommentTitle() : 'Pas de titre indiqué' ?></strong><?php echo ' par '.$comment->getUserId()->getPseudo().' <em>'.$comment->getCommentCreateAt()?></em>
                                   </p>
                               </div>
                           </li>
                       <?php endforeach; ?>
                   </ul>
               </div>
           </div>
        </div>
    </div>

    <div class="col col-md-6 mt-4">
        <h3 class="mt-3">Commentaire signalé</h3>
        <p> actuelement <?php echo count($reports)?><?php echo (count($reports) > 1) ? ' Commentaires signalés' : ' Commentaire signalé'?></p>
        <div class="dashContentView">
            <?php foreach ($reports as $commentReport) :?>
                <div class="card font-weight-bold bg-black mt-3 w-100">
                    <div class="card-header h5">Article : <?php echo $commentReport->getPostId()->getPostTitle()?></div>
                    <div class="row">
                        <div class="col col-md-8">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $commentReport->getCommentTitle()?></h5>
                                <p class="card-text"><?php echo html_entity_decode($commentReport->getCommentContent())?></p>
                                <p class="card-text">Commentaire écrit par : <?php echo $commentReport->getUserId()->getPseudo()?></p>
                            </div>
                        </div>
                        <div class="col col-md-4 d-flex justify-content-around">
                            <div class="d-flex align-items-center">
                                <form method="post" action="/deleteReport">
                                    <input type="hidden" name="idComments" value="<?php echo $commentReport->getIdComments()?>">
                                    <button type="submit" class="btn btn-danger mx-2"
                                            title="Supprimer le commentaire">
                                        <i class="bi bi-trash text-center"></i>
                                    </button>
                                </form>
                                <form method="post" action="/updateReport">
                                    <input type="hidden" name="idComments" value="<?php echo $commentReport->getIdComments()?>">
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
    <div class="col col-md-6 mt-4 w-100">
        <h3 class="mt-3">Email Contact envoyer par les utilisateurs</h3>
        <p>Il y à <?php echo count($mailContact)?> <?php echo ($mailContact > 1) ? ' emails' : ' email' ?> reçu par les utilisateurs</p>
        <div class="dashContentView">
            <?php foreach ($mailContact as $mail) : ?>
                <div class="row no-gutters mt-3 justify-content-around bg-dark p-4">
                    <div class="col col-md-3"><p class="ml-3 mt-2 mb-0"> <?php echo $mail->getCreatedMailDate() ?> </p></div>
                    <div class="col col-md-3"><p class="ml-3 mt-2 mb-0"><?php echo $mail->getNameContact() ?></p></div>
                    <div class="col col-md-5"><p class="ml-3 mt-2 mb-0"><?php echo $mail->getEmail() ?></p></div>
                    <div class="col col-md-1">
                        <button class="btn btn-primary border-0 rounded bg-transparent" type="button" data-toggle="collapse" data-target="#<?php echo $mail->getIdContacts() ?>" aria-expanded="false" aria-controls="<?php echo $mail->getIdContacts() ?>">
                            <i class="bi bi-eye-fill rounded"></i>
                        </button>
                    </div>
                </div>
                <div class="collapse" id="<?php echo $mail->getIdContacts() ?>">
                    <div class="card card-body bg-black">
                        <?php echo $mail->getMessage() ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>