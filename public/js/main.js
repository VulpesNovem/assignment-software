function showModal(title, content, footer) {
    $('#MainModal .modal-title').html(title);
    $('#MainModal .modal-body').html(content);
    $('#MainModal .modal-footer').html(footer);
    $('#MainModal').modal('show');
}

function clearModal() {
    $('#MainModal').modal('hide');
    $('#MainModal .modal-title').html('');
    $('#MainModal .modal-body').html('');
    $('#MainModal .modal-footer').html('');
    return;
}

function loadCourses (semesterid) {
    // console.log('hello')
    $.get('/courses/ajax/show.course.details',{SemesterID:semesterid},function(response){}).done(function(response) {
        // console.log('hello')
        $('#courseList').html(response);
    })
}

function addNewCourse () {
    $.get('/courses/ajax/add.new.course',{},function(response){}).done(function(response){
        showModal('Add New Course',response);
    });
}

function updateCourse (formid) {
    var data = $('#' + formid).serialize();
    $.post('/courses/ajax/update.course',data,function(response){}).done(function(response){
        location.reload();
    });
}

function updateUser (formid) {
    var data = $('#' + formid).serialize();
    $.post('/settings/ajax/update.user',data,function(response){}).done(function(response){
        location.reload();
    });
}