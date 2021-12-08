<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    //
    public function index(){
        return view('student.index');
    }
    public function store(Request $request){
        $unique_name= '';
        if ( $request->hasFile('photo'))
        {
            $file = $request->file('photo');
            $unique_name = md5(time().rand()).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('media/student'),$unique_name);
        }

        Student::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'cell'=>$request->cell,
            'uname'=>$request->uname,
            'gender'=>$request->gender,
            'photo'=> $unique_name

        ]);

    }

    /**
     * all student data
     */
    public function all(){
        $all_student = Student::latest()->get();


        $content='';
        $i=1;
        foreach ($all_student as $std){
            $content.= '<tr>';
            $content.= '<td>'.$i;$i++.'</td>';
            $content.= '<td>'.$std->name.'</td>';
            $content.= '<td>'.$std->email.'</td>';
            $content.= '<td>'.$std->cell.'</td>';
            $content.= '<td>'.$std->gender.'</td>';
            $content.= '<td>'.$std->uname.'</td>';
            $content.= '<td> <img src="media/student/'.$std->photo.'"></td>';
            $content.= '<td>';
            $content.= '<button id="show_button" value="'.$std->id.'" class="btn btn-primary btn-sm">View</button> ';
            $content.= '<button id="edit_button" value="'.$std->id.'" class="btn btn-warning btn-sm">Edit</button> ';
            $content.= '<button id="delete_button" value="'.$std->id.'" class="btn btn-danger btn-sm">Delete</button> ';

            $content.= '</td>';

            $content.= '</tr>';
        }
        return $content;

    }
    public function delete($id){
        $delete_data = Student::find($id);
        //$delete_data = delete();

        if ( file_exists(public_path('media/student/').$delete_data->photo))
        {
           unlink(public_path('media/student/').$delete_data->photo );
        }
        $delete_data -> delete();

        return 'Student deleted successful!';
    }
    public function show($id){
        $data = Student::find($id);
        $content= '';
        $content .='<img style="width:350px;height:250px;"  src="media/student/'.$data->photo .'" class="img-thumbnail" alt="">';
        $content .=' <table class="table table-striped">';
        $content .= '<tr>
                        <td>Name</td>
                        <td> '.$data->name.'</td>
                    </tr>
                    <tr>
                        <td>email</td>
                        <td> '.$data->email.'</td>
                    </tr>
                    <tr>
                        <td>Cell</td>
                        <td> '.$data->cell.'</td>
                    </tr>
                    <tr>
                        <td>Gender</td>
                        <td> '.$data->gender.'</td>
                    </tr>
                    <tr>
                        <td>Username</td>
                        <td> '.$data->uname.'</td>
                    </tr>
                    </table>';

        return $content;


    }
    public function edit($id){
        $data =Student::find($id);

        // which radio button to checked
        $male_checked = '';
        $female_checked = '';
        if ( $data->gender == 'Male')
        {
            $male_checked .= 'checked';
        }
        else
        {
            $female_checked .= 'checked';
        }
        $content = '';
        $content .= '
                     <div class="form-group">
                        <label for=""></label>
                        <input type="text" name="id" value="'.$data->id.'" class="form-control" hidden>
                    </div>
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" value="'.$data->name.'" class="form-control">
                    </div>
                     <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" name="email" value="'.$data->email.'" class="form-control">
                    </div>
                     <div class="form-group">
                        <label for="">Cell</label>
                        <input type="text" name="cell" value="'.$data->cell.'" class="form-control">
                    </div>
                     <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" name="uname" value="'.$data->uname.'" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Gender</label>
                        <input class="" type="radio" value="Male" name="gender" id="Male"'.$male_checked.' ><label for="Male">Male</label>
                        <input class="" type="radio" value="Female" name="gender" id="Female" '.$female_checked.'><label for="Female">Female</label>
                    </div>
                    <div class="form-group">
                        <label for=""></label>
                        <input type="" name="old_photo"  value="'.$data->photo.'" class="" hidden>
                    </div>
                    <div id="form_group">
                    <img style="width:100px;height:100px;"  src="media/student/'.$data->photo .'" class="img-thumbnail" alt="">
                    </div>

                    <div class="form-group">
                        <label for="">Photo</label>
                        <input type="file" name="new_photo" class="form-control">
                    </div>

        ';
        return $content;
    }
    public function update(Request $request,$id){


        $update_data = Student::find($id);

        // photo
        if( $request->hasFile('new_photo'))
        {
            $file = $request->file('new_photo');
            $unique_name = md5(time().rand()). '.'.$file->getClientOriginalExtension();
            $file->move(public_path('media/student/'),$unique_name);

            if ( file_exists(public_path('media/student/').$request->old_photo))
            {
                unlink(public_path('media/student/').$request->old_photo);


            }
        }
        else{
            $unique_name = $request->old_photo;
        }

        // data
        $update_data->name = $request->name;
        $update_data->email = $request->email;
        $update_data->cell = $request->cell;
        $update_data->gender = $request->gender;
        $update_data->uname = $request->uname;
        $update_data->photo = $unique_name;

        $update_data ->update();



        //return $request->name.$id.$update_data->name.$request->old_photo;

    }
}
