$(".js-example-placeholder-single").select2({
    placeholder: "Chọn danh mục sản phẩm",
    allowClear: true,
});
$(".js-example-tokenizer").select2({
    tags: true,
    placeholder: "Nhập tags cho sản phẩm",
    tokenSeparators: [","],
});

$(document).ready(function () {
    $(".selected_sale").click(function (e) {
        e.preventDefault();
        $checkClass = $(this)
            .closest(".form-group")
            .find(".number_sale")
            .hasClass("active");
        if ($checkClass == true) {
            $(this)
                .closest(".form-group")
                .find(".number_sale")
                .removeClass("active")
                .show();
        } else {
            $(this)
                .closest(".form-group")
                .find(".number_sale")
                .addClass("active")
                .hide();
        }
    });
});
