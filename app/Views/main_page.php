<?php
    helper("form");
?>
<?= view("includes/header") ?>
<?= view("includes/nav") ?>
<div id="main_wrap" class="bg-light py-5 px-sm-5">
    <div class="row justify-content-between mw-100 mx-auto">
        <div class="col-12 col-lg-6 p-0">
            <h2 class="h3 mb-4 pt-2 px-2 px-sm-0"><?= lang("Main.heading_2") ?></h2>
            <div id="contact_container">
                <?php foreach($contacts as $contact): ?>
                    <?= view("includes/contact_list_item", ["contact" => $contact]) ?>
                <?php endforeach ;?>
            </div>
        </div>
        <div id="form_container" class="col-12 col-lg-6 ps-lg-5 d-none d-lg-block bg-light">
            <div class="sticky-top mx-auto mw-600">
                <h2 class="h4 mb-4 text-secondary pt-2"><?= lang("Main.add_new_contact") ?></h2>
                <?= form_open("", ["id" => "add_contact_form", "class" => "mt-4"]) ?>
                    <div id="form_feedback_container"></div>
                    <div class="row g-2">
                        <div class="col-sm">
                            <div class="form-floating mb-2 shadow-sm">
                                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="<?= lang("Main.first_name") ?>">
                                <label for="first_name"><?= lang("Common.first_name") ?></label>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="form-floating mb-3 shadow-sm">
                                <input type="text" class="form-control" id="last_name" name="last_name" placeholder="<?= lang("Main.last_name") ?>">
                                <label for="last_name"><?= lang("Common.last_name") ?></label>
                            </div>
                        </div>
                    </div>
                    <div class="form-floating mb-3 shadow-sm">
                        <input value="+421" type="tel" class="form-control" id="tel" name="tel" placeholder="<?= lang("Main.phone_number") ?>">
                        <label for="tel"><?= lang("Common.phone_number") ?></label>
                    </div>
                    <div class="form-floating mb-3 shadow-sm">
                        <input type="email" class="form-control" id="email" name="email" placeholder="<?= lang("Common.email_placeholder") ?>">
                        <label for="email"><?= lang("Common.email_address") ?></label>
                    </div>
                    <div class="text-center pt-2">
                        <button type="button" class="close-form-btn btn btn-outline-secondary btn-lg d-none me-4"><?= lang("Main.back") ?></button>
                        <button type="submit" class="btn btn-dark btn-lg shadow"><?= lang("Main.add_contact") ?></button>
                    </div>
                </form>
            </div>
            <a class="close-form-btn position-fixed end-0 top-0 fs-3 p-2 text-decoration-none link-dark" href="#">×</a>
        </div>
    </div>
</div>
<a id="form_modal_btn" href="#"></a>
<script>
    document.addEventListener("DOMContentLoaded", function(){
        addValidation("add_contact_form", {
            first_name: {
                required: ["<?= lang("Common.v.required") ?>"],
                max_length: [["<?= lang("Common.v.max_length", [32]) ?>"], 32],
                min_length: [["<?= lang("Common.v.min_length", [2]) ?>"], 2]
            },
            last_name: {
                required: ["<?= lang("Common.v.required") ?>"],
                max_length: [["<?= lang("Common.v.max_length", [32]) ?>"], 32],
                min_length: [["<?= lang("Common.v.min_length", [2]) ?>"], 2]
            },
            tel: {
                required: ["<?= lang("Common.v.required") ?>"],
                max_length: [["<?= lang("Common.v.max_length", [16]) ?>"], 16],
                matches_regex: ["<?= lang("Common.v.valid_tel") ?>", /^\+421(?:\s?\d){9}$/]
            },
            email: {
                required: ["<?= lang("Common.v.required") ?>"],
                valid_email: ["<?= lang("Common.v.valid_email") ?>"],
                max_length: [["<?= lang("Common.v.max_length", [48]) ?>"], 48]
            },
        })
    })
</script>
<?= view("includes/footer") ?>