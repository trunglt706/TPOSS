$('form button[type="submit"]').click(function () {
    $(this)
        .addClass("disabled")
        .html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Vui lòng đợi'
        );
});
function load_ajax(route, element, async = false, method = "post") {
    $("body").append(`
    <div class="table-loading">
        <div class="spinner-grow text-success" role="status">
            <span class="visually-hidden">Loading...</span>
            </div>
            <div class="spinner-grow text-danger" role="status">
            <span class="visually-hidden">Loading...</span>
            </div>
            <div class="spinner-grow text-warning" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    `);
    $.ajax({
        method: method,
        url: route,
        async: async,
        success: function (data) {
            if (data["status"]) {
                element.html(data["data"]);
                $(".total-rows").html("(" + data["total"] + ")");
                $("body").find(".table-loading").remove();
            }
        },
    });
}
