<h1 class="display-1 mt-5 mb-5">Inscription</h1>
<form action="/addRegister" method="post">
    <div class="row">
        <?php if(isset($error)): ?>
        <div class="col-md-12">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= $error ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
        <?php endif; ?>

        <?php if(isset($success,$pseudo)): ?>
        <div class="col-md-12">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $success.', Bienvenue a toi <strong>'.$pseudo.'</strong>' ?>
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
                <input type="text" name="firstname" id="firstname" value="<?= $_POST['firstname'] ?? '' ?>" class="Subcribe firstname text-white rounded-lg form-control border border-dark">
            </div>
            <div class="col-md-6 mt-3">
                <label for="lastname">Prénom</label>
                <input type="text" name="lastname" id="lastname" value="<?= $_POST['lastname'] ?? '' ?>" class="Subcribe lastname text-white rounded-lg form-control border border-dark">
            </div>
            <div class="col-md-6 mt-3">
                <label for="pseudo">Pseudo</label>
                <input type="text" name="pseudo" id="pseudo" value="<?= $_POST['pseudo'] ?? '' ?>" class="Subcribe pseudo text-white rounded-lg form-control border border-dark">
            </div>

            <div class="col-md-6 mt-3">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" value="<?= $_POST['email'] ?? '' ?>" class="Subcribe email text-white rounded-lg form-control border border-dark">
            </div>
            </div>
        </fieldset>
        </div>

        <div class="col-md-12 mt-3">
            <fieldset class="border border-light rounded-lg p-4">
                <legend class="legend">Mot de passe</legend>
                <label for="Subcribemdp">Mot de passe</label>
                <input type="password" name="mdp" id="Subcribemdp" value="<?= $_POST['mdp'] ?? '' ?>" class="Subcribe mdp text-white rounded-lg form-control border border-dark">
                <label for="Subcribemdp2" class="mt-2">Répéter mot de passe</label>
                <input type="password" name="mdp2" id="Subcribemdp2" value="<?= $_POST['mdp2'] ?? '' ?>" class="Subcribe mdp2 text-white rounded-lg form-control border border-dark">
            </fieldset>
        </div>

        <div class="col-md-12 mt-3">
            <fieldset>
                <legend>Coordonner</legend>
                <div class="row">
                    <div class="col-md-3 mt-3">
                        <label for="voie">Num/Voie</label>
                        <input type="text" name="voie" id="voie" value="<?= $_POST['voie'] ?? '' ?>" class="Subcribe voie text-white rounded-lg form-control border border-dark">
                    </div>
                    <div class="col-md-9 mt-3">
                        <label for="adresse">Adresse</label>
                        <input type="text" name="adresse" id="adresse" value="<?= $_POST['adresse'] ?? '' ?>" class="Subcribe adresse text-white rounded-lg form-control border border-dark">
                    </div>
                    <div class="col-md-3 mt-3">
                        <label for="zipcode">Code Postal</label>
                        <input type="number" name="zipcode" id="zipcode" value="<?= $_POST['zipcode'] ?? '' ?>" class="Subcribe zipcode text-white rounded-lg form-control border border-dark">
                    </div>
                    <div class="col-md-9 mt-3">
                        <label for="city">Ville</label>
                        <input type="text" name="city" id="city" value="<?= $_POST['city'] ?? '' ?>" class="Subcribe city text-white rounded-lg form-control border border-dark">
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="state">Departement</label>
                        <input type="text" name="state" id="state" value="<?= $_POST['state'] ?? '' ?>" class="Subcribe state text-white rounded-lg form-control border border-dark">
                    </div>
                    <div class="col-md-6 mt-3">
                        <label for="country">Pays</label>
                        <input type="text" name="country" id="country" value="<?= $_POST['country'] ?? '' ?>" class="Subcribe country text-white rounded-lg form-control border border-dark">
                    </div>
                </div>
            </fieldset>
        </div>
        <div class="col-md-12">
            <input type="submit" value="Envoyer" class="btn btn-outline-dark btn-block text-white mt-3"/>
        </div>
    </div>
</form>
