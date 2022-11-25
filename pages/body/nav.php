<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="login">Gestion des factures</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?= $page == "dashboard" ? 'text-info fw-bold' : "" ?>" href="dashboard">Tableau de bord</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= $page == "clients" ? 'text-info fw-bold' : "" ?>" href="clients">Clients</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= $page == "produits" ? 'text-info fw-bold' : "" ?>" href="produits">Produits</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= $page == "commandes" ? 'text-info fw-bold' : "" ?>" href="commandes">Commandes</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= $page == "factures" ? 'text-info fw-bold' : "" ?>" href="factures">Factures</a>
                </li>

            </ul>
            <ul class="navbar-nav  d-flex">
                <li class="nav-item">
                    <a class="nav-link <?= $page == "login" ? 'text-info fw-bold' : "" ?>" href="login">Login</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= $page == "register" ? 'text-info fw-bold' : "" ?>" href="register">Register</a>
                </li>
            </ul>
        </div>
    </div>
</nav>