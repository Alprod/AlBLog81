<h1 class="mb-4">Nous contactez</h1>

<form action="/sendMail" method="post">
    <div class="row">
        <div class="col-md-9 formulaire">
            <div class="col-md-12 mt-3">
                <label for="inputName">Nom/Pseudo</label>
                <input type="text" name="inputName" id="inputName" class="text-white rounded-lg form-control border border-dark">
            </div>

            <div class="col-md-12 mt-3">
                <label for="inputEmail">Email</label>
                <input type="email" name="inputEmail" id="inputEmail" class="text-white rounded-lg form-control border border-dark">
            </div>

            <div class="col-md-12 mt-3">
                <label for="message">Message</label>
                <textarea name="message" id="message" cols="30" rows="10" class="text-white rounded form-control border border-dark"></textarea>
            </div>
            <div class="col-md-12">
                <button type="submit" class="btn btn-outline-dark btn-block text-white mt-3">Envoyer</button>
            </div>
        </div>
        <div class="col-md-3 mt-4 messageText">
            <h2>Nous sommes a votre disposition</h2>
        </div>
    </div>
</form>

