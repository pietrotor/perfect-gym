$(document).ready(function() {
  fetchTasks();
  function fetchTasks() {
    $.ajax({
      url: 'cliente-tabla.php',
      type: 'GET',
      success: function(response) {
        let tasks = JSON.parse(response);
        let template = '';
        tasks.forEach(task => {
          template += `
            <tr taskId="${task.id}">
              <td>${task.id}</td>
              <td>
                ${task.nombre}
              </td>
              <td>${task.apellido}</td>
              <td>${task.carnet_identidad}</td>
              <td>${task.edad}</td>
              <td>
                <button class=" btn btn-danger">
                  Eliminar
                </button>
              </td>
              <td>
                <button class=" btn btn-success">
                  Editar
                </button>
              </td>
            </tr>
          `
        });
        $('#tasks').html(template);
      }
    })
  }
});
