<div class="text-center lead">

    <h1 class="cover-heading display-4">Welcome To AlBlog</h1>

    <?php if(isset($success,$pseudo)): ?>
    <h2 class="display-5"><?= $success.' '.$pseudo?></h2>
    <?php endif; ?>

    <div class="slogan">
        <p>Aujourd'hui nous sommes le <?= $laDateDuJour ?> et il est <?= $heureDuJour ?> à Paris</p>
        <p>Au calendrier chinois c'est l'année</p>
        <h5><?= $calendarChinese ?></h5>
        <p>Bonjour à vous</p>
    </div>

</div>
