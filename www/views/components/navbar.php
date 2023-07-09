<?php use App\core\Security; ?>

<nav>
    <span class="nav-toggle" id="js-nav-toggle">
        O
    </span>
    <div class="logo">
    </div>
    <ul id="js-menu">
      <li>
        <a href="pages-list">Listing des pages</a>
      </li>
      <?php if(Security::isConnected()): ?>
        <?php if(Security::hasRole(['admin'])): ?>
          <li>
            <a href="components-documentation">Documentation composants</a>
          </li>
          <li>
            <div class="dropdown">
              <button class="dropbtn">Gestion du site</button>
              <div class="dropdown-content">
              <a href="dashboard">Utilisateurs</a>
              <a href="dashboard-pages">Pages</a>
              <a href="dashboard-reportings">Signalements</a>
              </div>
            </div> 
          </li>
        <?php endif; ?>

        <li>
          <a href="deconnexion">Déconnexion</a>
        </li>
      <?php else: ?>
        <li>
          <a href="se-connecter">Connexion</a>
        </li>
        <li>
          <a href="s-inscrire">Inscription</a>
        </li>
      <?php endif; ?>
    </ul>
  </nav>