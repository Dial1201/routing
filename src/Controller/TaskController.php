<?php

namespace App\Controller;

use Exception;
use Symfony\Component\Routing\Annotation\Route;

class TaskController
{
    /**
     * @Route("/", name="list")
     */
    public function index(array $currentRoute)
    {
        $generator = $currentRoute['generator'];

        // On récupère les tâches
        $data = require_once 'data.php';

        require __DIR__ . '/../../pages/list.html.php';
    }

    /**
     * @Route("/create" , name="create", host="localhost", schemes={"http", "https"}, methods={"GET","POST"})
     */
    public function create(array $currentRoute)
    {
        $generator = $currentRoute['generator'];

        // Si la requête arrive en POST, c'est qu'on a soumis le formulaire :
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Traitement à la con (enregistrement en base de données, redirection, envoi d'email, etc)...
            var_dump("Bravo, le formulaire est soumis (TODO : traiter les données)", $_POST);

            // Arrêt du script
            return;
        }

        require __DIR__ . '/../../pages/create.html.php';
    }

    /**
     * @Route("/show{id<\d+>}", name="show",)
     */
    public function show(array $currentRoute)
    {
        $generator = $currentRoute['generator'];

        // On appelle la liste des tâches
        $data = require_once "data.php";

        // Par défaut, on imagine qu'aucun id n'a été précisé
        $id = $currentRoute['id'];

        // Si aucun id n'est passé ou que l'id n'existe pas dans la liste des tâches, on arrête tout !
        if (!$id || !array_key_exists($id, $data)) {
            throw new Exception("La tâche demandée n'existe pas !");
        }

        // Si tout va bien, on récupère la tâche correspondante et on affiche
        $task = $data[$id];

        require __DIR__ . '/../../pages/show.html.php';
    }
}
