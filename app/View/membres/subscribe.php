<h1 class="display-2 mt-5 mb-2"><?= $titre ?></h1>
<form action="<?= (empty($user)) ? url('addRegister') : url('updateMembreRegister')?>" method="post">
    <div class="row">
        <?php if (isset($error)) : ?>
        <div class="col-md-12">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= $error ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        <?php endif; ?>

        <div class="col-md-12 mt-3">
        <fieldset>
            <legend>Identité</legend>
            <div class="row">
            <div class="col-md-6 mt-3">
                <label for="firstname">Nom</label>
                <input type="text"
                       name="firstname"
                       id="firstname"
                       value="<?= (!empty($user)) ?  $user->getFirstname() : ''?>"
                       class="Subcribe
                              firstname
                              text-white
                              rounded-lg
                              form-control
                              border
                              border-dark">
            </div>
            <div class="col-md-6 mt-3">
                <label for="lastname">Prénom</label>
                <input type="text"
                       name="lastname"
                       id="lastname"
                       value="<?= (!empty($user)) ?  $user->getLastname() : ''?>"
                       class="Subcribe
                              lastname
                              text-white
                              rounded-lg
                              form-control
                              border
                              border-dark">
            </div>
            <div class="col-md-6 mt-3">
                <label for="pseudo">Pseudo</label>
                <input type="text"
                       name="pseudo"
                       id="pseudo"
                       value="<?= (!empty($user)) ?  $user->getPseudo() : ''?>"
                       class="Subcribe
                              pseudo
                              text-white
                              rounded-lg
                              form-control
                              border
                              border-dark">
            </div>

            <div class="col-md-6 mt-3">
                <label for="email">Email</label>
                <input type="text"
                       name="email"
                       id="email"
                       value="<?= (!empty($user)) ?  $user->getEmail() : ''?>"
                       class="Subcribe
                              email
                              text-white
                              rounded-lg
                              form-control
                              border
                              border-dark">
            </div>
            </div>
        </fieldset>
        </div>

        <div class="col-md-12 mt-3">
            <fieldset class="border border-light rounded-lg p-4">
                <legend class="legend">Mot de passe</legend>
                <label for="Subcribemdp">Mot de passe</label>
                <input type="password"
                       name="mdp"
                       id="Subcribemdp"
                       value="<?= $_POST['mdp'] ?? '' ?>"
                       class="Subcribe
                              mdp
                              text-white
                              rounded-lg
                              form-control
                              border
                              border-dark">

                <label for="Subcribemdp2" class="mt-2">Répéter mot de passe</label>
                <input type="password"
                       name="mdp2"
                       id="Subcribemdp2"
                       value="<?= $_POST['mdp2'] ?? '' ?>"
                       class="Subcribe
                              mdp2
                              text-white
                              rounded-lg
                              form-control
                              border
                              border-dark">
            </fieldset>
        </div>
        <div class="col-md-12 mt-3">
            <fieldset>
                <legend>Coordonner</legend>
                <div class="row">
                    <div class="col-md-3 mt-3">
                        <label for="addressNumber">Num/addressNumber</label>
                        <input type="text"
                               name="addressNumber"
                               id="addressNumber"
                               value="<?= (!empty($user)) ?  $user->getAddressNumber() : ''?>"
                               class="Subcribe
                                      voie
                                      text-white
                                      rounded-lg
                                      form-control
                                      border
                                      border-dark">
                    </div>
                    <div class="col-md-9 mt-3">
                        <label for="addressName">Adresse</label>
                        <input type="text"
                               name="addressName"
                               id="addressName"
                               value="<?= (!empty($user)) ?  $user->getAddressName() : '' ?>"
                               class="Subcribe
                                      adresse
                                      text-white
                                      rounded-lg
                                      form-control
                                      border border-dark">
                    </div>
                    <div class="col-md-3 mt-3">
                        <label for="zipcode">Code Postal</label>
                        <input type="number"
                               name="zipcode"
                               id="zipcode"
                               value="<?= (!empty($user)) ? $user->getZipCode() : '' ?>"
                               class="Subcribe
                                      zipcode
                                      text-white
                                      rounded-lg
                                      form-control
                                      border
                                      border-dark">
                    </div>
                    <div class="col-md-9 mt-3">
                        <label for="city">Ville</label>
                        <input type="text"
                               name="city"
                               id="city"
                               value="<?= (!empty($user)) ? $user->getCity() : '' ?>"
                               class="Subcribe
                                      city
                                      text-white
                                      rounded-lg
                                      form-control
                                      border
                                      border-dark">
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="state">Departement</label>
                        <input type="text"
                               name="state"
                               id="state"
                               value="<?= (!empty($user)) ? $user->getDepartement() :'' ?>"
                               class="Subcribe
                                      state
                                      text-white
                                      rounded-lg
                                      form-control
                                      border
                                      border-dark">
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="country">Pays</label>
                        <input type="text"
                               name="country"
                               id="country"
                               value="<?= (!empty($user)) ? $user->getCountry() :'' ?>"
                               class="Subcribe
                                      country
                                      text-white
                                      rounded-lg
                                      form-control
                                      border
                                      border-dark">
                    </div>
                </div>
            </fieldset>
        </div>
        <div class="col-md-12">
            <input type="submit"
                   value="Envoyer"
                   class="btn
                          btn-outline-dark
                          btn-block
                          text-white mt-3"/>
        </div>
    </div>
</form>
