$(document).ready(function() {
  $('#edit-btn').hide();
  show_tasks();

  $(document).on('click', '.edit-action-btn', function() {
    let id = $(this).data('id');
    let name = $(this).data('name');
    if ($('#edit-btn').is(":hidden")) {
      $('#edit-btn').show();
      $('#add-btn').hide();
    }
    $('input[name="task-name"]').val(name);
    $('input[name="task-id"]').val(id);
  });

  $('#add-btn').on('click', function(e) {
    e.preventDefault();

    let name = $('input[name="task-name"]').val();

    if (!name) {
      alert('Please enter a valid name!');
      return;
    } 

    $.ajax({
      url: 'add_task',
      type: 'POST',
      dataType: 'JSON',
      data: { name },
      success: function (data) {
        if (data.status) {
          alert('Successfully created task!');
          $('input[name="task-name"]').val('')
          clear();
          show_tasks();
        } else {
          alert(data.message);
        }
      }
    });
  });

  $('#edit-btn').on('click', function(e) {
    e.preventDefault();
    $.ajax({
      url: 'edit_task',
      type: 'POST',
      dataType: 'JSON',
      data: {
        id: $('input[name="task-id"]').val(),
        name: $('input[name="task-name"]').val()
      },
      success: function (data) {
        if (data.status) {
          alert("Successfully edited task.");
          $('input[name="task-id"]').val('')
          $('input[name="task-name"]').val('')
          clear();
          show_tasks();
        } else {
          alert(data.message);
        }

        $('#edit-btn').hide();
        $('#add-btn').show();
      }
    });
  });

  $(document).on('click', '.delete-btn', function(e) {
    let id = $(this).data('id');
    let go = confirm('Are you sure?');
    if (go === true) {
      $.ajax({
        url: 'delete_task',
        type: 'POST',
        dataType: 'JSON',
        data: { id },
        success: function (data) {
          if (data.status) {
            alert('Successfully deleted task!');
            clear();
            show_tasks();
          } else {
            alert(data.message);
          }
        }
      });
    }
  });

  function show_tasks() {
    $.ajax({
      url: 'get_tasks',
      type: 'GET',
      dataType: 'JSON',
      success: function (data) {
        if (data.length > 0) {
          data.forEach((row) => {
            let ele = `<div class="col-md-12 col-sm-12 col-12">${row.name}`
              + '<div class="float-right col-md-2 col-sm-12 col-12">'
              + '<button type="button" '
              + 'class="btn btn-warning btn-circle '
              + `edit-action-btn" data-name="${row.name}" data-id="${row.id}">E</button>`
              + '<button type="button" class="btn btn-danger btn-circle delete-btn" '
              + `data-id="${row.id}">D</button>`
              + '</div></div>';
            $('.todo-row').append(ele);
          });
        }
      }
    });
  }

  function clear() {
    $('.todo-row').empty();
  }
});