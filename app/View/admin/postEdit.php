<div class="row">
    <div class="col-md-10 m-auto">
        <h1 class="display-2 mt-5 mb-5"><?= $titre ?></h1>
        <form
            enctype="multipart/form-data"
            method="post"
            action="<?= (isset($blog_actuel)) ? '/updatePost' : '/addPost' ?>">
            <input
                type="hidden"
                name="idPosts"
                value="<?= (isset($blog_actuel)) ? $blog_actuel['idPosts'] : '' ?>">

            <div class="form-group">
                <label for="postTitle">Titre de l'article</label>
                <input
                        type="text"
                        name="postTitle"
                        class="form-control Subcribe text-white border border-dark"
                        value="<?= $blog_actuel['postTitle'] ?? '' ?>"
                        id="postTitle"
                        aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="postContent">Rediger votre article</label>
                <textarea
                        name="postContent"
                        rows="8"
                        class="form-control Subcribe text-white border border-dark"
                        id="postContent"><?= $blog_actuel['postContent'] ?? '' ?>
                </textarea>
            </div>
            <div class="form-group">
                <?php if (isset($blog_actuel['photo'])) : ?>
                    <img
                        src="./images/<?= $blog_actuel['photo'] ?>"
                        class="w-25 h-25 m-3 rounded-lg"
                        alt="<?= $blog_actuel['postTitle'] ?>">
                <?php endif; ?>
                <label for="imagePost">Ajouter votre photo/images.</label>
                <input
                        type="file"
                        name="images"
                        value="<?= $blog_actuel['images'] ?? '' ?>"
                        class="form-control-file Subcribe border border-dark"
                        id="imagePost">
            </div>
            <div class="form-group">
                <label for="link">Ajouter un Lien référence</label>
                <input
                        type="text"
                        name="link"
                        value="<?= $blog_actuel['link'] ?? '' ?>"
                        class="form-control Subcribe text-white border border-dark"
                        id="link">
            </div>
            <button
                    type="submit"
                    class="btn btn-outline-dark btn-block text-white mt-3">Valider
            </button>
        </form>
    </div>
</div>

