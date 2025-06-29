function loadCourses (semesterid) {
    // console.log('hello')
    $.get('/courses/ajax/show.course.details',{SemesterID:semesterid},function(response){}).done(function(response) {
        // console.log('hello')
        $('#courseList').html(response);
    })
}