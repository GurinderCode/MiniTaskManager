<?php session_start(); ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome <?php echo $_SESSION['forename'] ?> </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
   
</head>
<body>
    <?php require 'partials/_nav.php' ?>
    <H1 class = "text-center welcomeheading">Welcome <?php echo $_SESSION['forename'] ?> to Task Manager</H1>
    <form id = "taskform" class="mytasks">
       <div class="mb-3">
         <label for="task" class="form-label"></label>
         <input type="text" class="form-control taskinput" id="task" name="task"  placeholder="Please enter your task"  aria-describedby="emailHelp">
       </div>
        <button type="submit" id="savebtn"  class="btn btn-primary">Add task</button>
    </form>

   <div id="showTasks" class="container my-4">
    <div class=task>
         <h2 class = "text-center">Your Tasks</h2>
         <h3 id="tasks"></h3>
    </div>
</div>

  <div class="modal" tabindex="-1">
     <div class="modal-dialog">
         <div class="modal-content">
           <div class="modal-header">
              <h5 class="modal-title">Modal title</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick = "closeModal()"></button>
          </div>
          <div class="modal-body">
              <input type="text"  class="form-control taskinput" id="edittaskinput" name="edittask"  placeholder="Please enter your task"  aria-describedby="emailHelp">    
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary closebtn" onclick="closeModal()" data-bs-dismiss="modal" >Close</button>
            <button type="button" id="saveUpdate" class="btn btn-primary">Save changes</button>
         </div>
       </div>
    </div>
  </div>
</body>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js" integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" 
 crossorigin="anonymous"></script>
  <script src="control.js"></script>
</html>