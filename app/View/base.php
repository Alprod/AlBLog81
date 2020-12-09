<div class="text-center lead">
    <?php if (!empty($_SESSION['id_membre'])) : ?>
        <h2 class="display-5"><?= $success.' '.$pseudo?> !</h2>
    <?php endif; ?>
    <h1 class="cover-heading display-4">Welcome To AlBlog</h1>

    <div class="slogan">
        <p>Aujourd'hui nous sommes le <?= $laDateDuJour ?> et il est <?= $heureDuJour ?> à Paris</p>
        <p>Au calendrier chinois c'est l'année</p>
        <h5><?= $calendarChinese ?></h5>
        <p>J'espère que <?= (!empty($_SESSION['id_membre'])) ? 'tu vas' : 'vous allez' ?> prendre plaisir à visiter mon blog</p>
    </div>

</div>
