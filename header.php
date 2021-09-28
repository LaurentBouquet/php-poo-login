<?php

function chargerClasse(string $classe)
{
  include $classe . '.php'; // On inclut la classe correspondante au paramètre passé.
}

// On enregistre la fonction en autoload 
// pour qu'elle soit appelée dès qu'on instanciera une classe non déclarée.
spl_autoload_register('chargerClasse'); 

include "conf.php";