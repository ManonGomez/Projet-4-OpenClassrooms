<body>
    <header id="fixe">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="index.php">Billet simple pour l'Alaska</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?action=contact">Contact</a>
                    </li>

                    <?php
                    if (!empty($_SESSION['username']) and !empty($_SESSION['mail'])) {
                        echo '<li class="nav-item"><a class="nav-link" href="disconnect.php" class="disconnect log">Déconnexion</a></li>';
                        if ($_SESSION['admin'] == 1) {
                            echo '<li class="nav-item"><a class="nav-link" href="gestion.php" class="gestion log">Gestion</a></li>';
                        }
                    } 
                    ?>

                </ul>
            </div>
        </nav>
    </header>