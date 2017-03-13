//submit le formulaire si changement su select
$(function () {
    "use strict";
    $(".myselect").change(function () {
        var form = $(this).parents("form")[0];
        form.submit();
    });
});