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
}

function showSpinner() {
    $('#loadingSpinner').show();
}

function hideSpinner() {
    $('#loadingSpinner').hide();
}

function loadCourses (semesterid) {
    // console.log('hello')
    $.get('/courses/ajax/show.course.details',{SemesterID:semesterid},function(response){}).done(function(response) {
        // console.log('hello')
        $('#courseList').html(response);
    })
}

function updateCourse (formid) {
    var data = $('#' + formid).serialize();
    $.post('/courses/ajax/update.course',data,function(response){}).done(function(response){
        location.reload();
    });
}

function editCourse (courseid) {
    $.get('/courses/ajax/edit.current.course',{CourseID: courseid},function(response){}).done(function(response){
        showModal('Edit Course',response);
    });
}

function addNewCourse () {
    $.get('/courses/ajax/add.new.course',{},function(response){}).done(function(response){
        showModal('Add New Course',response);
    });
}

function updateAssignment (formid) {
    var data = $('#' + formid).serialize();
    $.post('/assignments/ajax/update.assignment',data,function(response){}).done(function(response){
        location.reload();
    });
}

function editAssignment (assignmentid) {
    $.get('/assignments/ajax/edit.current.assignment',{AssignmentID: assignmentid},function(response){}).done(function(response){
        showModal('Edit Assignment',response);
    });
}

function addNewAssignment (courseid) {
    $.get('/assignments/ajax/add.new.assignment',{CourseID: courseid},function(response){}).done(function(response){
        showModal('Add New Assignment',response);
    });
}

function updateAssignmentCompletion(assignmentid, input){
    $.get('/assignments/ajax/update.assignment',{AssignmentID: assignmentid, Complete: ($(input).is(':checked') ? 1 : 0)},function(response){})
}

function updateUser (formid) {
    showSpinner();
    var data = $('#' + formid).serialize();
    $.post('/account/ajax/update.user',data,function(response){}).done(function(response){
        location.reload();
    });
}

function updateUserProfilePhoto (formid, userid) {
    showSpinner();
    var formData = new FormData();
    formData.append('ProfilePicture', $('#ProfilePictureUpload')[0].files[0]);

    $.ajax({type : 'POST', url : '/account/ajax/update.user.profile.photo?UserID=' + userid, data : formData, processData: false, contentType: false,}).done(function(response){
    });

    return false;
}

function updateTaskCompletion(taskid, input){
    $.get('/tasks/ajax/update.task',{TaskID: taskid, Complete: ($(input).is(':checked') ? 1 : 0)},function(response){})
}

function updateTaskOrder (data) {
    console.log(data);
    $.post('/tasks/ajax/update.task.order', { data: JSON.stringify(data) });
}

function taskListsSortable (sortablelisttag, sortableitemtag, sortablehandletag, sortablegrouptag) {
    $(sortablelisttag).sortable({
        cursor: "grabbing",
        connectWith: sortablegrouptag,
        handle: sortablehandletag,
        items: sortableitemtag,

        update: function () { send(this); },
        receive: function () { send(this); }
    });

    function send(ctx) {
        let sortableArray = $(ctx).sortable('toArray');
        let data = {};
        for (let i = 0; i < sortableArray.length; i++) {
            data[i] = {
                TaskID: $('#' + sortableArray[i]).data('taskid'),
                TaskListID: $(ctx).data('tasklistid'),
                TaskListOrdering: i
            };
        }
        updateTaskOrder(data);
    }
}