        <footer class="text-center bg-dark py-2 text-light">
            <p class="mt-3"><?= lang("Main.all_rights_reserved") ?> &copy; <?= date("Y") ?> - Máté Jámbor - <a href="https://fullstackvoid.com/" class="link link-light">fullstackvoid.com</a></p>
        </footer>
        <script>
            const csrf_token = "<?= csrf_token() ?>";
            const csrf_hash = "<?= csrf_hash() ?>";
            const site_locale = "<?= esc($common_data["locale"], "js") ?>";

            const translates = {
                unknown_error: "<?= esc(lang("Common.unknown_error"), "js") ?>",
                unknown_error_part: "<?= esc(lang("Common.unknown_error_part"), "js") ?>"
            }
        </script>
        <script src="/resources/js/bootstrap.bundle.min.js"></script>
        <script src="/resources/js/jquery-3.7.1.min.js"></script>
        <script src="/resources/js/common.js?v=<?= $common_data["custom_common_cfg"]->version ?>"></script>
        <script src="/resources/js/main.js?v=<?= $common_data["custom_common_cfg"]->version ?>"></script>
    </body>
</html>
