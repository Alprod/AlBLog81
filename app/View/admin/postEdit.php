<div class="row">
    <div class="col-md-10 m-auto">
        <h1 class="display-2 mt-5 mb-5"><?= $titre ?></h1>

        <form enctype="multipart/form-data" method="post" action="/addPost">
            <div class="form-group">
                <label for="titlePost">Titre de l'article</label>
                <input type="text" name="titlePost" class="form-control Subcribe text-white border border-dark" id="titlePost" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="contenuPost">Rediger votre article</label>
                <textarea name="contenuPost" rows="8" class="form-control Subcribe text-white border border-dark" id="contenuPost"></textarea>
            </div>
            <div class="form-group">
                <label for="imagePost">Ajouter votre photo/images.</label>
                <input type="file" name="photo" value="" class="form-control-file Subcribe border border-dark" id="imagePost">
            </div>
            <div class="form-group">
                <label for="linkPost">Ajouter un Lien référence</label>
                <input type="text" name="linkPost" value="" class="form-control Subcribe text-white border border-dark" id="linkPost">
            </div>
            <button type="submit" class="btn btn-outline-dark btn-block text-white mt-3">Valider</button>
        </form>
    </div>
</div>

