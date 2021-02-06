<div class="base text-center lead mt-5">
    <?php if (!empty($_SESSION['id_membre'])) : ?>
        <h2 class="display-5"><?= $success.' '.$membreUser->getPseudo()?> !</h2>
    <?php endif; ?>
    <h1 class="cover-heading display-4">Welcome To AlBlog</h1>

    <div class="slogan">
        <p>Aujourd'hui nous sommes le <?= $laDateDuJour ?> et il est <?= $heureDuJour ?> à Paris</p>
        <p>Au calendrier chinois c'est l'année</p>
        <h5><?= $calendarChinese ?></h5>
        <p>J'espère que <?= (!empty($_SESSION['id_membre'])) ? 'tu vas' : 'vous allez' ?> prendre plaisir à visiter mon blog</p>
    </div>
    <h2 class="text-left mt-5">Retrouver les <?= count($lastPost) ?> derniers articles publiés</h2>
    <div class="fiveLastPost pt-4 pb-4">
        <div class="card-group justify-content-around bg-transparent">
            <?php foreach ($lastPost as $post) : ?>
                <div class="card text-dark text-left mx-auto my-3 bg-transparent" style="max-width: 15rem;">
                    <?php if (!empty($post->getImages())) : ?>
                    <img class="card-img-top" src="./images/<?= $post->getImages() ?>" alt="<?= $post->getPostTitle() ?>">
                    <?php endif; ?>
                    <div class="card-body text-white bg-dark">
                        <h5 class="card-title"><?= $post->getPostTitle() ?></h5>
                        <p class="card-text"><small class="text-muted">Ecrit Par : <?= $post->getUserId()->getPseudo() ?></small></p>
                        <div class="d-inline-flex align-self-end">
                            <a href="<?= $post->getPostTitle().'/'.$post->getIdPosts() ?>" class="btn btn-outline-light btn-sm">Lire</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<div class="resumer bg-black p-4 m-5 rounded">
    <div class="media">
        <img class="mr-3 resumeImage" src="./images/Salut-35_IMG_0001.jpg" alt="Generic placeholder image">
        <div class="media-body">
            <h5 class="mt-0">Qui je suis ?</h5>
            <p>Je me présent je m'appele alain Germain et je suis développeur web.
                Je pourrais faire toute une nomenclature de ce que je suis.<br/> Mais je vais rester a l'essentiel,
                de par mon blog que vous visité actuellement vous voyer de quoi je suis capable, et que se que vous voyez vous plaisent,
                Mais revenons a l'essentiel.<br/>
                Fortement orienté développement et innovation,
                je peux intervenir dans le développement de vos projets.
                Amélioration ou correction des codes, travail sur l'UX-design, ma contribution peut être multiple.<br/>
                Une soif de connaissances, à partir des technicités acquit ces derniers mois.<br/>
                Je m'engage à m'investir totalement et à continuer à apprendre pour évoluer et de contribuer au quotidien
                avec votre équipe sur vos projets. Trop de gens traversent la vie en attendant
                que les choses arrivent au lieu de faire en sorte qu’elles se produisent.<br/>
                Retrouver tout les détails technique me consernent sur <a href="https://www.alain-germain.fr" target="_blank">alain-germain.fr</a>
            </p>
        </div>
    </div>
</div>