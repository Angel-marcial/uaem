<?php

namespace App\Http\Controllers\Firebase;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//use Kreait\Firebase\Contract\Database;
use Kreait\Firebase\Contract\Database;

class ContactsControler extends Controller
{
    
    protected $database;
    protected $tablename;

    public function __construct(Database $database)
    {

        $this->database = $database;
        $this->tablename = 'contacts';

    }
    

    public function index()
    {
        $contacts = $this->database->getReference($this->tablename)->getValue();


        return view('firebase.contact.index', compact('contacts'));
    }

    public function create()
    {
        return view('firebase.contact.create');
    }

    public function store(Request $request)
    {
        

        $postData = [
            'fname' => $request ->first_name,
            'lname' => $request ->last_name,
            'phone' => $request ->phone,
            'email' => $request ->email,
        ];

        $postRef = $this->database->getReference($this->tablename)->push($postData);

        if($postRef)
        {
            return redirect('contacts')->with('status', 'Contact added successfully');
        }
        else
        {
            return redirect('contacts')->with('status','contact error ');
        }
    } 


    public function edit($id)
    {
        
        $key = $id;
        $editdata = $this->database->getReference($this->tablename)->getChild($key)->getValue();

        if($editdata)
        {
            return view('firebase.contact.edit', compact('editdata','key'));
        }
        else
        {
            return redirect('contacts')->with('status','Contac ID not Found');
        }
 
    }

    public function update(Request $request, $id)
    {
        $key = $id;

        $updateData = [
            'fname' => $request ->first_name,
            'lname' => $request ->last_name,
            'phone' => $request ->phone,
            'email' => $request ->email,
        ];


       $res_update = $this->database->getReference($this->tablename.'/'.$key)->update($updateData);

        if($res_update)
        {
            return redirect('contacts')->with('status', 'Contac update successful');
        }
        else
        {
            return redirect('contacts')->with('status', 'Contac not update successful');
        }

    }

    public function delete($id)
    {
        $key = $id;
        $del_data = $this->database->getReference($this->tablename.'/'.$key)->remove();

        if($del_data)
        {
            return redirect('contacts')->with('status', 'Contac delete successful');
        }
        else
        {
            return redirect('contacts')->with('status', 'Contac not delete successful');
        }
    }
        

}
