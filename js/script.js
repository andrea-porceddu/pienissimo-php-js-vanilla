$(document).ready(function(){

  // read
  $('.btn-read').click(function() {
    let tr = $(this).closest("tr"); 
    let taskID = tr.find(".task-id").text();
    // console.log(taskID);
    $.ajax({
      url: './tasks/read.php',
      type: 'post',
      data: {
        taskID: taskID
      },
      success: function(res){
        // console.log(typeof(res));
        // console.log(typeof(JSON.parse(res)));
        objRes = JSON.parse(res);
        $('.read-response-task-id').text(objRes.id);
        $('.read-response-task-title').text(objRes.titolo);
        $('.read-response-task-note').text(objRes.nota);
        $('.read-response-task-created-at').text(objRes.dataCreazione);
        $('.read-response-task-updated-at').text(objRes.ultimoAggiornamento);
      }
    });
  });

  // create
  $('.btn-create').click(function() {
    let taskTitle = $('input[name="task-edit-title"]').val();
    let taskNote = $('textarea[name="task-edit-note"]').val();
    let userID = $('input[name="task-user-id"]').val();
    // console.log(userID);
    $.ajax({
      url: './tasks/create.php',
      type: 'post',
      data: {
        userID: userID,
        taskTitle: taskTitle,
        taskNote: taskNote
      },
      success: function(res){
        // objRes = JSON.parse(res);
        // console.log(objRes.user_id, objRes.titolo, objRes.nota);
        $("#modal-create").on('click', function() {
          $('.modal-create-close').modal('hide');
        });
        location.reload();
      }
    });
  });

});