

<form class="form" method="post" action="">
    <h1>Mot de passe oublié</h1>
    <div class="form-group">
        <input type="email" name="email"required>
        <label for="email">Email *</label>
    </div>
    <p><?= $errorMail ?></p>
    <button class="submit" type="submit" name="sendPassword">Récupérer mot de passe</button>
        
</form>