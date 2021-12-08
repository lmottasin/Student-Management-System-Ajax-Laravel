
// custom msg function

function customMsg(msg, type='danger'){
    return '<p class="alert alert-'+type+'">'+msg+'<button class="close" data-dismiss="alert">&times;</button></p>';
}
all_student()   ;
//all student data
function all_student(){

$.ajax({
    url: 'student/all',
    success: function (data){
            $('tbody#all_student_table').html(data);
            //alert(data);
    }
});
}


