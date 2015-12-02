<?php

function f_help($params){
  echo "List des fonctions disponible : pwd, echo, exit, ls, cat, env, cd, setenv, unsetenv, clear\n";
  echo "Pour obtenire des informations sur ses fonctions faite : h_[le nom de la fonction]\n";
}

function f_h_pwd($params){
  echo "Retourne le dossier de travail courant\n";
}

function f_h_echo($params){
  echo "Affiche une chaîne de caractères\n";
  echo "Usage => echo [chaine de carracteres] [...]\n";
  echo "Redirection => echo [chaine de carracteres] [> ou >>] [fichier de destination]\n";
  echo "Redirection => > : remplace le contenu du fichier par la chaine de carractere || >> : ajoute la chaine de carractere au fichier\n";
}

function f_h_cat($params){
  echo "Affiche sur la sortie standard le contenu de chacun des fichiers indiqués\n";
  echo "Usage => cat [chemin du fichier à ouvrir] [...]\n";
}

function f_h_exit($params){
  echo "Termine le programme\n";
}

function f_h_ls($params){
  echo "Visualise le contenu d'une dossier\n";
  echo "Usage => ls [chemin du dossier] (si laissé vide affiche le dossier courant)\n";
  echo "Redirection => ls [chemin du dossier(ne peut etre vide, utilisez '.')] [> ou >>] [fichier de destination]\n";
  echo "Redirection => > : remplace le contenu du fichier par la chaine de carractere || >> : ajoute la chaine de carractere au fichier\n";
}

function f_h_env($params){
  echo "Affiche toutes les variables d'environnement\n";
}

function f_h_setenv($params){
  echo "Change ou ajoute une variable d'environnement\n";
  echo "Usage => setenv [Nom de la variable] [Valeur]\n";
}


function f_h_unsetenv($params){
  echo "Efface une variable d'environnement\n";
  echo "Usage => unsetenv [Nom de la variable] [...]\n";
}

function f_h_help($params){
  echo "affiche l'aide\n";
}

function f_h_clear($params){
  echo "efface l'ecran";
}