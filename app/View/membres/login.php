<div class="row">
    <div class="col-md-8 m-auto">
        <h1 class="display-2 mt-5 mb-5"><?= $titre ?></h1>

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

        <form method="post" action="/loginVerif">
            <div class="form-group">
                <label for="emailCo">Email address</label>
                <input type="email" name="email" class="form-control Subcribe text-white border border-dark" id="emailCo" aria-describedby="emailHelp">
                <small id="emailHelp" class="form-text text-white">Afin d'être en conformité au loi RGPD, toutes info ne seront communiquées.</small>
            </div>
            <div class="form-group">
                <label for="mdpCo">Password</label>
                <input type="password" name="password" class="form-control Subcribe text-white border border-dark" id="mdpCo">
            </div>
            <button type="submit" class="btn btn-outline-dark btn-block text-white mt-3">Valider</button>
        </form>
    </div>
</div>
