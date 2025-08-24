console.log("Control.js loaded");

//show all tasks
var tasksArray = [];
function showTasks() {
  fetch("http://localhost/MiniTaskManager/api-fetchall.php") //API call to get all tasks
    .then((response) => response.json())
    .then((data) => {
      console.log("data = ", data);

      let taskBody = document.getElementById("tasks");
      taskBody.innerHTML = ""; // Clear existing rows

      data.forEach((tasks, index) => {
        tasksArray.push(tasks);
        console.log("task = ", tasks);
        taskBody.innerHTML += index + 1 + " " + tasks.task;
        // taskBody.innerHTML += "<br>";
        // taskBody.appendChild(document.createElement("hr"));

        // Create Delete button
        const deleteBtn = document.createElement("button");
        deleteBtn.textContent = "Delete";
        deleteBtn.className = "deletebtn";
        deleteBtn.id = index; // assuming tasks has an 'id' property
        deleteBtn.setAttribute("onclick", "deleteTask('" + index + "')");
        taskBody.appendChild(deleteBtn);

        // Create Edit button
        const editBtn = document.createElement("button");
        editBtn.textContent = "Edit";
        editBtn.className = "editbtn";
        editBtn.setAttribute("onclick", "updateTask('" + index + "')");
        editBtn.id = index; // assuming tasks has an 'id' property
        taskBody.appendChild(editBtn);
        taskBody.innerHTML += "<br>";
        taskBody.appendChild(document.createElement("hr"));
      });

      // Attach event listeners to edit buttons
      //   Array.from(document.getElementsByClassName("edit")).forEach((element) => {
      //     element.addEventListener("click", (e) => {
      //       let tr = e.target.parentNode.parentNode;
      //       let task = tr.getElementsByTagName("td")[0].innerText;
      //       document.getElementById("task").value = task;
      //       document.getElementById("savebtn").style.display = "none";
      //       document.getElementById("updatebtn").style.display = "block";
      //       document
      //         .getElementById("updatebtn")
      //         .setAttribute("data-id", e.target.id);
      //     });
      //   });

      // Attach event listeners to delete buttons
      //   Array.from(document.getElementsByClassName("delete")).forEach(
      //     (element) => {
      //       element.addEventListener("click", (e) => {
      //         let id = e.target.id.substr(1);

      //         if (confirm("Are you sure you want to delete this task?")) {
      //           fetch("http://localhost/MiniTaskManager/api-delete.php", {
      //             method: "POST",
      //             headers: {
      //               "Content-Type": "application/json",
      //             },
      //             body: JSON.stringify({ id: id }),
      //           })
      //             .then((response) => response.json())
      //             .then((data) => {
      //               console.log("Success:", data);
      //               location.reload();
      //             })
      //             .catch((error) => {
      //               console.error("Error:", error);
      //             });
      //         }
      //       });
      //     }
      //   );
    });
}

showTasks();

//Insert tasks
document.getElementById("savebtn").addEventListener("click", function (e) {
  let task = document.getElementById("task").value;

  if (task == "") {
    alert("Title or Description cannot be blank");
  } else {
    let myobj = {
      task: task,
    };

    //Send the data to server
    fetch("http://localhost/MiniTaskManager/api-insert.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(myobj),
    })
      .then((response) => response.json())
      .then((data) => {
        console.log("Success:", data);
        // Optionally, you can refresh the page or update the UI here
        location.reload();
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  }
});

let updateIndex = null;
// update recort
function updateTask(index) {
  console.log("tasksArray:", tasksArray);
  console.log("tasksArray[0]:", tasksArray[0]);
  console.log("tasksArray[0].task:", tasksArray[index].task);

  console.log("updateTask function called");
  // You can add more logic here to handle the update
  document.querySelector(".modal").style.display = "block";
  document.getElementById("edittaskinput").value = tasksArray[index].task;

  updateIndex = index;
  console.log("updateIndex set to:", updateIndex);
}
//update
document.getElementById("saveUpdate").addEventListener("click", function (e) {
  let originalTask = tasksArray[updateIndex].task;
  let task = document.getElementById("edittaskinput").value;

  if (task == "") {
    alert("Title or Description cannot be blank");
  } else {
    let myobj = {
      task: task,
      id: tasksArray[updateIndex]._id.$oid, // Use the correct ID field
    };

    //Send the data to server
    fetch("http://localhost/MiniTaskManager/api-update.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(myobj),
    })
      .then((response) => response.json())
      .then((data) => {
        console.log("Success:", data);
        // Optionally, you can refresh the page or update the UI here
        location.reload();
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  }
});

function closeModal() {
  document.querySelector(".modal").style.display = "none";
}

//delete task

function deleteTask(index) {
  if (confirm("Are you sure you want to delete this task?")) {
    fetch("http://localhost/MiniTaskManager/api-delete.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ id: tasksArray[index]._id.$oid }),
    })
      .then((response) => response.json())
      .then((data) => {
        console.log("deleteSuccess:", data);
        location.reload();
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  }
}
