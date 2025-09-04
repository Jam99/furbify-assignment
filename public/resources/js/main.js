
const main_ajax_url = "/ajax/";


function form_feedback(msg, type){
    let $alert = $('<div class="alert alert-'+ type +' alert-dismissible fade show" role="alert">' +
        msg + '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');

    $("#form_feedback_container").html($alert);
}


$("#add_contact_form").on("real_submit", function(e){
    e.preventDefault();
    let $form = $(this);
    setFormPendingStatus("add_contact_form");

    $.post(main_ajax_url + "create-contact", $form.serialize(), function(response){
        setFormPendingStatus("add_contact_form", false);

        if(response.success){
            form_feedback(response.message, "success");
            $("#form_container.show-form").removeClass("show-form");
            $form[0].reset();
            $("#contact_container").append(response.html);
        }
        else {
            if (response.simple_errors) {
                handleSimpleErrors(response.simple_errors, {
                    tel_already_added: function () {
                        form_feedback(response.message, "danger");
                    }
                });
            }
            else{
                handleSimpleErrors();
            }
        }
    }, "json");
})


$(document).on("click", ".del-contact-btn", function(e){
    e.preventDefault();
    let $a = $(this);
    let $item = $a.closest(".contact-container-item");
    $item.addClass("disabled");

    let data = {
        id: Number($item.data("id"))
    }
    data[csrf_token] = csrf_hash;

    $.post(main_ajax_url + "del-contact", data, function(response){
        if(response.success){
            $item.slideUp(250, function(){
                $item.remove();
            })
        }
        else{
            $item.removeClass("disabled");
            handleSimpleErrors()
        }
    }, "json")
})


$("#form_modal_btn").click(function(e){
    e.preventDefault();
    $("#form_container").addClass("show-form")
})

$(".close-form-btn").click(function(e){
    e.preventDefault();
    $("#form_container").removeClass("show-form")
})