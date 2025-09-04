//client side validation
function runValidation(e){
    const form_rules = e.data;

    let $element = $(this);
    let $form = $element.closest("form");
    let field_name = $element.attr("name");
    let invalid_feedbacks = [];
    let val = $element.val();

    //if($element.is("[type=hidden]") && $element.val() === "0")
    //val = null;

    if($element.is("[type=checkbox]"))
        val = $element.is(":checked");

    if(form_rules[field_name]){
        let k = Object.keys(form_rules[field_name]);
        let v = Object.values(form_rules[field_name]);

        for(let i=0; i<k.length; i++){
            let tmp = checkValidationRule($element, $form, k[i], v[i], val);
            if(tmp !== true)
                invalid_feedbacks.push(tmp);
        }
    }

    if(invalid_feedbacks.length){
        for(let i=0; i<invalid_feedbacks.length; i++){
            $element.siblings(".invalid-feedback").each(function(){
                if(!invalid_feedbacks.includes($element.text())){
                    $(this).remove();
                }
            })

            if(!$element.siblings(".invalid-feedback:contains("+ invalid_feedbacks[i] +")").length)
                addInvalidFeedback($element, invalid_feedbacks[i]);
        }
    }
    else{
        $element.filter(".is-invalid").removeClass("is-invalid").siblings(".invalid-feedback").remove();
    }

    //sync validation
    let sync_validation = $element.data("sync-validation");
    if(sync_validation){
        $form.find("[name="+sync_validation+"]").trigger("change", ["validation_event"]);
    }
}


function checkValidationRule($element, $form, rule_name, rule_args, check_val = null){
    //if field is empty it is ok
    if(check_val !== null && check_val.length === 0 && rule_name !== "required" && rule_name !== "required_with_radio_option" && rule_name !== "required_with_checkbox"){
        return true;
    }

    //if field is disabled it is ok
    if($element.prop("disabled")) {
        return true;
    }

    switch(rule_name){
        case "required":
            if(check_val)
                return true;
            break;
        case "required_with_radio_option":
            if($form.find("[name="+ rule_args[1] +"]:checked").val() !== rule_args[2])
                return true;
            else if(check_val)
                return true;
            break;
        case "min_length":
            if(check_val.length >= rule_args[1])
                return true;
            break;
        case "max_length":
            if(check_val.length <= rule_args[1])
                return true;
            break;
        case "valid_email":
            if(check_val.toLowerCase() === check_val && check_val.match(/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/))
                return true;
            break;
        case "matches":
            if(check_val === $form.find("[name="+ rule_args[1] +"]").val())
                return true;
            break;
        case "not_matches":
            if(check_val !== $form.find("[name="+ rule_args[1] +"]").val())
                return true;
            break;
        case "matches_regex":
            if(check_val.match(rule_args[1]))
                return true;
            break;
        case "valid_domain":
            if(check_val.match(/^([a-z0-9]+(-[a-z0-9]+)*\.)+[a-z]{2,}$/))
                return true;
            break;
        default:
            console.error("Invalid validation rule.");
            return;
    }

    return rule_args[0];
}


function addValidation(form_id, form_rules){
    let $form = $("#"+form_id);

    if(!$form.length)
        return;

    $form.find("input,textarea").on("input", form_rules, runValidation);
    $form.find("input,textarea,select").on("change", form_rules, runValidation);
    $form.on("submit", function(e){
        e.preventDefault();
        e.stopImmediatePropagation();

        //triggering events on submit to run validations
        $form.find("input,textarea,select").trigger("change", ["validation_event"]);
        //client side checking of reCAPTCHA
        let captcha_is_ok = true;
        $captcha = $form.find(".g-recaptcha");
        if($captcha.length && !$form.find(".g-recaptcha-response").val()) {
            captcha_is_ok = false;
            if(!$captcha.is(".look-here")) {
                $captcha.addClass("look-here");
                setTimeout(function () {
                    $captcha.removeClass("look-here");
                }, 500)
            }
        }

        let $invalid_inputs = $form.find(".is-invalid:not(.skip-validation)");

        if($invalid_inputs.length)
            $invalid_inputs.first().focus();
        else if(captcha_is_ok)
            $form.trigger("real_submit");
    });

    //preparing data sync attributes for optimized validation
    let v = Object.values(form_rules);
    let k = Object.keys(form_rules);
    for(let i=0; i<v.length; i++){
        let _v = Object.values(v[i]);
        let _k = Object.keys(v[i]);
        for(let j=0; j<_k.length; j++){
            if(_k[j] === "matches" || _k[j] === "not_matches"){
                $form.find("[name="+ _v[j][1] +"]").attr("data-sync-validation", k[i]);
            }
        }
    }
}


function addInvalidFeedback($input, text){
    $input.filter(":not(.is-invalid)").addClass("is-invalid");
    $input.parent().append("<div class='invalid-feedback'>"+ text +"</div>");
}


function handleSimpleErrors(errors = [], handlers = {}){
    let unknown_count = 0;

    for(let i=0; i<errors.length; i++){
        if(handlers[errors[i]])
            handlers[errors[i]]();
        else
            unknown_count++;
    }

    if(unknown_count > 0){
        alert(unknown_count + " " + translates.unknown_error_part);
    }
    else if(errors.length === 0){
        alert(translates.unknown_error);
    }
}


function setFormPendingStatus(form_id, pending_status = true){
    let $form = $("#"+form_id)
    let $submit = $form.find("button[type=submit]");

    if(pending_status){
        $submit.prop("disabled", true);
        $submit.prepend("<span class='spinner-border spinner-border-sm me-1' role='status'></span>");
    }
    else{
        $submit.prop("disabled", false);
        $submit.children("span").remove();
    }
}