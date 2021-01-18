<h1 class="text-center mb-4">Contactez-nous</h1>
<div class="row">
    <div class="col-md-6 mt-4 messageText">
        <h2>Nous sommes a votre disposition</h2>
    </div>
    <div class="col-md-6 formulaire">

        <?php if (isset($success, $name)) : ?>
        <div class="alert
                    alert-success
                    alert-dismissible
                    fade
                    show" role="alert">
            <p class="text-dark m-auto"><?= $success.', Merci '.$name.'.'?></p>
            <button type="button"
                    class="close"
                    data-dismiss="alert"
                    aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php elseif (isset($error, $success) && $success == false) : ?>
        <div class="alert
                    alert-danger
                    alert-dismissible
                    fade
                    show" role="alert">
            <p class="text-dark m-auto"><?= $error ?></p>
            <button type="button"
                    class="close"
                    data-dismiss="alert"
                    aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php endif; ?>

        <form action="<?= url('sendMail') ?>" method="post">
            <div class="col-md-12 mt-3">
                <label for="inputName">Nom/Pseudo</label>
                <input type="text"
                       name="nameContact"
                       id="inputName"
                       value="<?= $_SESSION['pseudo_membre'] ?? '' ?>"
                       class="inputName
                              text-white
                              rounded-lg
                              form-control
                              border
                              border-dark">
            </div>

            <div class="col-md-12 mt-3">
                <label for="inputEmail">Email</label>
                <input type="email"
                       name="email"
                       id="inputEmail"
                       value="<?= $_SESSION['email_membre'] ?? '' ?>"
                       class="inputEmail
                              text-white
                              rounded-lg
                              form-control
                              border
                              border-dark">
            </div>

            <div class="col-md-12 mt-3">
                <label for="inputSujet">Sujet</label>
                <input type="text"
                       name="sujet"
                       id="inputSujet"
                       class="inputSujet
                              text-white
                              rounded-lg
                              form-control
                              border
                              border-dark">
            </div>

            <div class="col-md-12 mt-3">
                <label for="message">Message</label>
                <textarea name="message"
                          id="message"
                          cols="30"
                          rows="10"
                          class="message
                                 text-white
                                 rounded
                                 form-control
                                 border
                                 border-dark">
                </textarea>
            </div>
            <div class="col-md-12">
                <button type="submit"
                        class="btn
                               btn-outline-dark
                               btn-block
                               text-white
                               mt-3">Envoyer
                </button>
            </div>
        </form>
    </div>
</div>

