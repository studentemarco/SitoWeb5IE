<!doctype html>
<html lang="en">

<head>
    <title>Impostazioni account</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<?php
    session_start();
    if(!isset($_SESSION["name"])){
        header("location: accesso/accedi.php");
        exit();
    }
?>

<body style="background-color: #000933ff;">
    <header>
        <?php $current_page = 'account'; include 'navbar.php'; ?>
    </header>
    <main>
        <?php
            include 'message.php';
        ?>
        <div class="container text-white" style="margin-top: 50px;">
            <h1>Impostazioni Account</h1>
            <p>Benvenuto, <?php echo htmlspecialchars($_SESSION["name"]); ?>! Qui puoi gestire le impostazioni del tuo account.</p>
            <!-- Aggiungi qui altre funzionalità per la gestione dell'account -->
            <h3 class="mt-4">Le tue informazioni</h3>
            <form action="account_update.php" method="post" class="row g-3 needs-validation" novalidate>
                <div class="col-md-6">
                    <label for="username" class="form-label">Nome utente</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($_SESSION["name"]); ?>" required>
                    <div class="invalid-feedback">
                        Inserisci il nome utente.
                    </div>
                    <!-- cambia solo il nome utente -->
                    <input type="button" class="btn btn-secondary mt-2" value="Cambia nome utente" onclick="document.getElementById('current_password').required = false; document.getElementById('new_password').required = false; document.getElementById('confirm_password').required = false; this.form.submit();">
                </div>
                <!-- <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($_SESSION["email"]); ?>" required>
                    <div class="invalid-feedback">
                        Inserisci una email valida.
                    </div>
                </div> -->
                <div class="col-12 mt-3">
                    <h5>Cambia password</h5>
                </div>
                <div class="col-md-6">
                    <label for="current_password" class="form-label">Password attuale</label>
                    <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Password attuale">
                </div>
                <div class="col-md-6">
                    <label for="new_password" class="form-label">Nuova password</label>
                    <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Nuova password">
                </div>
                <div class="col-md-6">
                    <label for="confirm_password" class="form-label">Conferma nuova password</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Conferma nuova password" required>
                    <div class="invalid-feedback" id="passwordMismatchFeedback">
                        Le password non corrispondono.
                    </div>
                </div>
                <div class="col-12 mt-4">
                    <button type="submit" class="btn btn-primary">Salva modifiche</button>
                </div>
            </form>
            <script>
                // Bootstrap form validation + password match check
                (() => {
                  'use strict'
                  const forms = document.querySelectorAll('.needs-validation')
                  Array.from(forms).forEach(form => {
                    form.addEventListener('submit', event => {
                      const newPassword = form.querySelector('#new_password');
                      const confirmPassword = form.querySelector('#confirm_password');
                      let valid = form.checkValidity();

                      // Password match check
                      if (newPassword && confirmPassword && newPassword.value !== confirmPassword.value) {
                        confirmPassword.setCustomValidity('Le password non corrispondono.');
                        valid = false;
                      } else {
                        confirmPassword.setCustomValidity('');
                      }

                      if (!valid) {
                        event.preventDefault();
                        event.stopPropagation();
                      }
                      form.classList.add('was-validated');
                    }, false);

                    // Live password match feedback
                    const newPassword = form.querySelector('#new_password');
                    const confirmPassword = form.querySelector('#confirm_password');
                    if (newPassword && confirmPassword) {
                      confirmPassword.addEventListener('input', () => {
                        if (newPassword.value !== confirmPassword.value) {
                          confirmPassword.setCustomValidity('Le password non corrispondono.');
                        } else {
                          confirmPassword.setCustomValidity('');
                        }
                      });
                    }
                  });
                })()
            </script>
            <hr>
            
            <button class="btn btn-outline-light" type="button" onclick="location.href='accesso/logout.php'">Logout</button>
        </div>
    </main>
    <footer>
        <!-- place footer here -->
    </footer>

    <script src="deleteMessage.js"></script>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>