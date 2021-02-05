<!DOCTYPE html>
<html lang="fr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="Content-language" content="fr" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#563d7c">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2"
          crossorigin="anonymous">
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z"
          crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
    <link rel="stylesheet" media="screen" type="text/css" href="/css/styles.css">
    <title>AlBLog | <?= $titre ?? "404" ?></title>
</head>

<body>
    <div class="cover-container
                d-flex
                px-3
                w-100
                h-100
                mx-auto
                flex-column
                vh-100">
        <header class="masthead mb-auto bg-black p-4">
            <h2 class="masthead-brand"><a class="iconTitle" href="/">Alblog</a></h2>
            <div class="inner">
                <nav class="nav
                            nav-masthead
                            justify-content-center">
                    <a class="nav-link active"
                       href="<?= url('home'); ?>">Home
                    </a>
                    <a class="nav-link"
                       href="<?= url('blogs'); ?>">Articles
                    </a>
                    <?php if (isset($_SESSION['membre']) && ($_SESSION['membre']->isAdmin() || $_SESSION['membre']->isSuperAdmin())) : ?>
                    <a class="nav-link"
                       href="<?= url('editPost'); ?>">Nouveau post
                    </a>
                    <?php endif; ?>
                    <a class="nav-link"
                       href="<?= url('contact'); ?>">Contact
                    </a>
                    <?php if (!isset($_SESSION['id_membre'])) : ?>
                    <a class="nav-link"
                       href="<?= url('register'); ?>">Inscription
                    </a>
                    <a class="nav-link connexion"
                       href="<?= url('login'); ?>">Connexion
                    </a>
                    <?php else : ?>
                    <a class="nav-link"
                       href="<?= url('profil'); ?>"><?= $_SESSION['membre']->getPseudo() ?>
                    </a>
                    <a class="nav-link connexion"
                       href="<?= url('logout'); ?>">Déconnexion
                    </a>
                    <?php endif; ?>
                </nav>
            </div>
        </header>

        <main role="main" class="inner cover">
            <?php
            if (isset($content)) {
                echo $content;

            }
            ?>
        </main>
        <footer class="mastfoot mt-auto bg-black">
            <div class="inner mb-4">
                <p class="mt-2">&copy; Copyright | Alain Germain, <a href="/">Alblog</a> | <?= date('Y') ?>.</p>
                <?php if (isset($_SESSION['membre']) && $_SESSION['membre']->isSuperAdmin()) : ?>
                    <a class="btn btn-outline-warning" href="<?= url('dashboard'); ?>">Dashboard</a>
                <?php endif; ?>
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <ul class="nav mx-auto flex-column w-50 footNavUl">
                            <li class="nav-item">
                                <a class="nav-link" href="<?= url('home'); ?>">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= url('blogs'); ?>">Articles</a>
                            </li>
                            <?php if (isset($_SESSION['membre']) && ($_SESSION['membre']->isAdmin() || $_SESSION['membre']->isSuperAdmin())) : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= url('editPost'); ?>">Nouveau post</a>
                            </li>
                            <?php endif; ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= url('contact'); ?>">Contact</a>
                            </li>
                            <?php if (!isset($_SESSION['id_membre'])) : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= url('register'); ?>">Inscription</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link connexion" href="<?= url('login'); ?>">Connexion</a>
                            </li>
                            <?php else : ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?= url('profil'); ?>"><?= $_SESSION['membre']->getPseudo() ?></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link connexion" href="<?= url('logout'); ?>">Déconnexion</a>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <div class="col-md-4 justify-content-center">
                        <div class="footIcons">
                            <a href="https://github.com/Alprod"> <i class="bi bi-github icons"> </i></a>
                            <a href="https://facebook.com/alprod81"><i class="bi bi-facebook icons"></i></a>
                            <a href="https://linkedin.com/alaingermain81"><i class="bi bi-linkedin icons"></i></a>
                            <a href=""><i class="bi bi-instagram icons"></i></a>
                        </div>
                    </div>
                    <div class="col-md-4"></div>
                </div>
            </div>
        </footer>

    </div>
    <script
        src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous">
    </script>
    <script
        src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous">
    </script>
    <script
        src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous">
    </script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script
        src="https://cdn.tiny.cloud/1/wftx01l19j73eqd3lxfxvjs65ev4exm5ya9c86abnlftvmx8/tinymce/5/tinymce.min.js"
        referrerpolicy="origin">
    </script>
    <script
        src="https://cdn.tiny.cloud/1/wftx01l19j73eqd3lxfxvjs65ev4exm5ya9c86abnlftvmx8/tinymce/5/jquery.tinymce.min.js"
        referrerpolicy="origin">
    </script>
    <script src="/js/script.js"></script>

</body>

</html>
