<?php

namespace App\Controllers;

use App\Models\ContactModel;

class Main extends BaseController
{
    public function index() {
        $contact_model = new ContactModel();

        return view('main_page', [
            "contacts"      => $contact_model->findAll(),
            "current_page"  => "main_page",
            "common_data"   => view_common_data()
        ]);
    }


    public function ajaxCreateContact(){
        $data = $this->request->getPost(["first_name", "last_name", "tel", "email"]);
        $contact_model = new ContactModel();

        $data["tel"] = str_replace(" ", "", $data["tel"]);

        if($contact_model->where("tel", $data["tel"])->countAllResults() > 0){
            return $this->response->setJSON([
                "success"           => false,
                "simple_errors"     => ["tel_already_added"],
                "message"           => lang("Main.phone_number_already_added")
            ]);
        }

        $created_id = $contact_model->insert($data); //a validálást a model végzi

        if($created_id){
            return $this->response->setJSON([
                "success"   => true,
                "message"   => lang("Main.contact_added_feedback"),
                "html"      => view("includes/contact_list_item", [
                    "contact" => array_merge($data, ["id" => $created_id])
                ])
            ]);
        }
        else {
            return $this->response->setJSON(["success" => false]);
        }
    }


    public function ajaxDeleteContact(){
        $contact_model = new ContactModel();
        $id = (int)$this->request->getPost("id");

        $success = (bool)$contact_model->delete($id);

        return $this->response->setJSON(["success" => $success]);
    }
}
