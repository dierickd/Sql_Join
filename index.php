<?php
require_once 'connect.php';

$sql = new PDO(
   'mysql:host=' . APP_DB_HOST . '; dbname=' . APP_DB_NAME . '; charset=utf8',
   APP_DB_USER,
   APP_DB_PWD, [
      PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC
   ]
);

$test = $sql->query("SELECT p.role, t.name, w.firstname, w.lastname FROM player p
                            JOIN wizard w
                            ON p.wizard_id=w.id
                            JOIN team t 
                            ON p.team_id=t.id
                            ORDER BY t.name, p.role, w.lastname, w.firstname");

$data = $test->fetchAll();
$count = count($data);

$test2 = $sql->query("SELECT p.role, w.firstname, w.lastname FROM player p
                            JOIN wizard w
                            ON p.wizard_id=w.id
                            WHERE p.role='seeker'
                            ORDER BY w.lastname, w.firstname");

$role = $test2->fetchAll();
$count2 = count($role);

$test3 = $sql->query("SELECT t.name, w.firstname, w.lastname FROM player p
                            JOIN wizard w
                            ON p.wizard_id=w.id
                            JOIN team t 
                            ON p.team_id=t.id
                            WHERE t.name=null");

$team = $test3->fetchAll();
$count3 = count($team);
?>

<!doctype html>
<html lang="fr">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="description" content="">
   <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
   <meta name="generator" content="Jekyll v3.8.6">
   <title>Sticky Footer Navbar Template · Bootstrap</title>

   <!-- Bootstrap core CSS -->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body class="d-flex flex-column h-100">
<header>
   <!-- Fixed navbar -->
   <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand" href="#">Fixed navbar</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
         <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
               <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="#">Link</a>
            </li>
         </ul>
      </div>
   </nav>
</header>

<!-- Begin page content -->
<main role="main" class="flex-shrink-0 mt-5">
   <div class="container-fluid">
      <div class="row mt-5">
         <div class="col-md-5 col-sm-12">
            <h5 class="text-center">Retourne les noms, prénoms, rôle et équipe de tous les joueurs, classés dans l’ordre alphabétique par équipe, puis par rôle dans l’équipe, puis par nom de famille, puis par prénom.</h5>
            <table class="table">
               <thead class="thead-dark">
               <tr>
                  <th scope="col">Team</th>
                  <th scope="col">Role</th>
                  <th scope="col">Lastname</th>
                  <th scope="col">Firstname</th>
               </tr>
               </thead>
               <tbody>
               <?php for ($i=0; $i < $count; $i++): ?>
                  <tr>
                     <td><?= $data[$i]['name'] ?></td>
                     <td><?= $data[$i]['role'] ?></td>
                     <td><?= $data[$i]['lastname'] ?></td>
                     <td><?= $data[$i]['firstname'] ?></td>
                  </tr>
               <?php endfor ?>
               </tbody>
            </table>
         </div>
         <div class="col-md-4 col-sm-12">

            <h5 class="text-center">Retourne uniquement les prénom et nom des joueurs ayant le rôle de seeker (attrapeur), classés par ordre alphabétique de nom puis prénom</h5>
            <table class="table">
               <thead class="thead-dark">
               <tr>
                  <th scope="col">Lastname</th>
                  <th scope="col">Firstname</th>
                  <th scope="col">Role</th>
               </tr>
               </thead>
               <tbody>
               <?php for ($i=0; $i < $count2; $i++): ?>
                  <tr>
                     <td><?= $role[$i]['lastname'] ?></td>
                     <td><?= $role[$i]['firstname'] ?></td>
                     <td><?= $role[$i]['role'] ?></td>
                  </tr>
               <?php endfor ?>
               </tbody>
            </table>
         </div>
         <div class="col-md-3 col-sm-12">

            <h5 class="text-center">Retourne la liste de tous les sorciers qui ne pratiquent pas le quidditch.</h5>
            <table class="table">
               <thead class="thead-dark">
               <tr>
                  <th scope="col">Lastname</th>
                  <th scope="col">Firstname</th>
                  <th scope="col">Role</th>
               </tr>
               </thead>
               <tbody>
               <?php for ($i=0; $i < $count3; $i++): ?>
                  <tr>
                     <td><?= $team[$i]['lastname'] ?></td>
                     <td><?= $team[$i]['firstname'] ?></td>
                     <td><?= $team[$i]['name'] ?></td>
                  </tr>
               <?php endfor ?>
               </tbody>
            </table>
         </div>
      </div>
   </div>
</main>

<footer class="footer mt-auto py-3">
   <div class="container">
      <span class="text-muted">Place sticky footer content here.</span>
   </div>
</footer>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="/docs/4.4/assets/js/vendor/jquery.slim.min.js"><\/script>')</script><script src="/docs/4.4/dist/js/bootstrap.bundle.min.js" integrity="sha384-6khuMg9gaYr5AxOqhkVIODVIvm9ynTT5J4V1cfthmT+emCG6yVmEZsRHdxlotUnm" crossorigin="anonymous"></script></body>
</html>

