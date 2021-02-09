<h1 class="text-center mb-4 mt-5">Contactez-nous</h1>
<div class="row mb-5">
    <div class="col-md-6 mt-4 messageText">
        <div class="resumContact">
            <h2>Nous sommes a votre écoute</h2>
            <p>Entrer en contact avec nous, afin de nous faire savoir se dont vous désirez</p>
        </div>
    </div>
    <div class="col-md-6 formContact">

        <?php if (isset($success, $name)) : ?>
        <div class="alert
                    alert-success
                    alert-dismissible
                    fade
                    show" role="alert">
            <p class="text-dark m-auto"><?php echo $success.', Merci '.$name.'.'?></p>
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
            <p class="text-dark m-auto"><?php echo $error ?></p>
            <button type="button"
                    class="close"
                    data-dismiss="alert"
                    aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php endif; ?>

        <form action="<?php echo url('sendMail') ?>" method="post">
            <div class="col-md-12 mt-3">
                <label for="inputName">Nom/Pseudo</label>
                <input type="text"
                       name="nameContact"
                       id="inputName"
                       value="<?php echo $_SESSION['pseudo_membre'] ?? '' ?>"
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
                       value="<?php echo $_SESSION['email_membre'] ?? '' ?>"
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

