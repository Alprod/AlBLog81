<div class="row">
    <div class="col-md-10 m-auto">
        <h1 class="display-2 mt-5 mb-5"><?= $titre?></h1>
        <form
            enctype="multipart/form-data"
            method="post"
            action="<?= (!empty($blog_actuel)) ? url('updatePost') : url('addPost')?>">
            <input
                type="hidden"
                name="idPosts"
                value="<?= (!empty($blog_actuel)) ? $blog_actuel->getIdPosts() : ''?>">

            <div class="form-group">
                <label for="postTitle">Titre de l'article</label>
                <input
                        type="text"
                        name="postTitle"
                        class="form-control
                               Subcribe
                               text-white
                               border
                               border-dark"
                        value="<?= (!empty($blog_actuel)) ? $blog_actuel->getPostTitle() : ''?>"
                        id="postTitle"
                        aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="postContent">Rediger votre article</label>
                <textarea
                        name="postContent"
                        rows="8"
                        class="form-control
                               Subcribe
                               text-white
                               border
                               border-dark"
                        id="postContent"><?= (!empty($blog_actuel)) ? $blog_actuel->getPostContent() : ''?>
                </textarea>
            </div>
            <div class="form-group">
                <?php if (!empty($blog_image)) : ?>
                    <img
                        src="./images/<?= $blog_image?>"
                        class="w-25 h-25 m-3 rounded-lg"
                        alt="<?= $blog_actuel->getPostTitle()?>">
                <?php endif; ?>
                <label for="imagePost">Votre photo/images actuel.</label>
                <input
                        type="file"
                        name="images"
                        value="<?= (!empty($blog_actuel)) ? $blog_actuel->getImages() : ''?>"
                        class="form-control-file
                               Subcribe
                               border
                               border-dark"
                        id="imagePost">
            </div>
            <div class="form-group">
                <label for="link">Ajouter un Lien référence</label>
                <input
                        type="text"
                        name="link"
                        value="<?= (!empty($blog_actuel)) ? $blog_actuel->getLink() : ''?>"
                        class="form-control
                               Subcribe
                               text-white
                               border
                               border-dark"
                        id="link">
            </div>
            <button
                    type="submit"
                    class="btn
                           btn-outline-dark
                           btn-block
                           text-white
                           mt-3">Valider
            </button>
        </form>
    </div>
</div>

