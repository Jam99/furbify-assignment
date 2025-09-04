<div data-id="<?= esc($contact["id"], "attr") ?>" class="contact-container-item my-sm-3 bg-dark text-light rounded ignore-rounded-below-sm shadow position-relative">
    <div class="row mw-100 mx-auto justify-content-center justify-content-md-between align-items-center">
        <div class="col-3 col-md-2 text-center">
            <img class="img-fluid" width="64" height="64" src="/resources/img/phone.png" draggable="false" alt="Kontakt ikon">
        </div>
        <ul class="list-unstyled m-0 col-9 col-md-10 row py-3">
            <li class="col-12 p-2 fw-bold fs-5"><?= esc($contact["first_name"]) ?> <span class="ms-2"><?= esc($contact["last_name"]) ?></span></li>
            <li class="col-12 col-md-auto p-2"><a class="link-light text-decoration-none" href="tel:<?= esc($contact["tel"], "attr") ?>"><?= esc($contact["tel"]) ?></a></li>
            <li class="col-12 col-md-auto ms-2 p-2"><a class="link-light text-decoration-none" href="mailto:<?= esc($contact["email"], "attr") ?>"><?= esc($contact["email"]) ?></a></li>
        </ul>
    </div>
    <a class="del-contact-btn px-2 py-1 fw-bold text-light text-decoration-none d-inline-block position-absolute top-0 end-0" href="#">×</a>
</div>