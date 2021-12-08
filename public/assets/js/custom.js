(function ($){
    $(document).ready(function(){

        //add new student modal
        $('a#add_new_student_modal_btn').click(function (e){
           e.preventDefault();
           $('#add_new_student_modal').modal('show');
        });

        //student store
        $(document).on('submit','form#add_student_form',function (e){
           e.preventDefault()   ;

           let name = $('form#add_student_form input[name="name"]').val();
           let email = $('form#add_student_form input[name="email"]').val();
           let cell = $('form#add_student_form input[name="cell"]').val();
           let uname = $('form#add_student_form input[name="uname"]').val();
           let checkEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

           // validation with functions.js file

           if ( name=='' || email=='' || cell=='' || uname=='')
           {
               $('.msg').html(customMsg('All feilds are required!','danger'));
           }
           else if( checkEmail.test(email)== false){
               $('.msg').html(customMsg('Email address is not valid!','warning'));
           }
           else{
               $.ajax({
                   url : 'student/store',
                   method : "POST",
                   data :  new FormData(this),
                   contentType : false,
                   processData : false,
                   success : function(data){
                       all_student();
                       $('form#add_student_form')[0].reset();
                       $('.msg').html(customMsg('Student Added Successful!','success'));
                   }
               });

           }




        });

        // delete student data
        $(document).on('click','button#delete_button', function (){
            let id= $(this).val();
            $.ajax({
                url:'student/delete/'+id,
                success: function (data){
                    $('.msg_delete_notification').html(customMsg('Student deleted successful!','success'));
                    all_student()   ;
                }
            });
        });
        // view student data button
        $(document).on('click','button#show_button', function (){
            let id= $(this).val();
            $.ajax({
                url:'student/show/'+id,
                success: function (data){
                    /*$('.msg_delete_notification').html(customMsg('Student deleted successful!','success'));
                    all_student()   ;*/
                    //alert(data);
                    $('#show_student_modal').modal('show');
                    $('#show_modal_body').html(data);

                }
            });
        });
        // edit student ajax request
        $(document).on('click','button#edit_button', function (){
            let id= $(this).val();
            $.ajax({
                url:'student/edit/'+id,
                success: function (data){
                    /*$('.msg_delete_notification').html(customMsg('Student deleted successful!','success'));
                    all_student()   ;*/
                    //alert(data);
                    $('#edit_student_modal').modal('show');
                    $('#edit_modal_body').html(data);

                }
            });
        });
        //student update
        $(document).on('submit','form#edit_student_form',function (e){
            e.preventDefault()   ;
            let id = $('form#edit_student_form input[name="id"]').val();

                $.ajax({
                    url : 'student/update/'+id,
                    method : "POST",
                    data :  new FormData(this),
                    contentType : false,
                    processData : false,
                    success : function(data){
                        //$('.msg_update_notification').html(customMsg('Student updated successful!','success'));
                        all_student()   ;
                        $.ajax({
                            url:'student/edit/'+id,
                            success: function (data){
                                /*$('.msg_delete_notification').html(customMsg('Student deleted successful!','success'));
                                all_student()   ;*/
                                //alert(data);
                                $('#edit_student_modal').modal('show');
                                $('#edit_modal_body').html(data);
                                $('.msg_update_notification').html(customMsg('Student updated successful!','success'))

                            }
                        });
                    }
                });

        });


    });
})(jQuery)
