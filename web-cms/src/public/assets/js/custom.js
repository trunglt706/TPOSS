$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

$('form button[type="submit"]').click(function () {
    $(this)
        .addClass("disabled")
        .html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Vui lòng đợi'
        );
});
function load_ajax(route, element, async = false, method = "post") {
    $.ajax({
        method: method,
        url: route,
        async: async,
        success: function (data) {
            if (data["status"]) {
                element.html(data["data"]);
                $(".total-rows").html("(" + data["total"] + ")");
            }
            return data["status"];
        },
    });
}

var searchWait = 0;
var searchWaitInterval;
$("input[name='search']").on("keyup change", function () {
    var item = $(this);
    searchWait = 0;
    if (!searchWaitInterval)
        searchWaitInterval = setInterval(function () {
            if (searchWait >= 3) {
                clearInterval(searchWaitInterval);
                searchWaitInterval = "";
                filterTable();
                searchWait = 0;
            }
            searchWait++;
        }, 200);
});

function show_loading(element) {
    // element.addClass("position-relative");
    element.append(`
    <div class="table-loading">
        <div class="spinner-grow text-success ms-1" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <div class="spinner-grow text-danger ms-1" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <div class="spinner-grow text-warning ms-1" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    `);
}

function hide_loading(element) {
    // element.removeClass("position-relative");
    element.find(".table-loading").remove();
}

$(function () {
    "use strict";
    var credit = $(".credit-card-mask"),
        phone = $(".phone-number-mask"),
        numeral = $(".numeral-mask");
    credit.length &&
        credit.each(function () {
            new Cleave($(this), { creditCard: !0 });
        }),
        phone.length && new Cleave(phone, { phone: !0, phoneRegionCode: "VN" }),
        numeral.length &&
            new Cleave(numeral, {
                numeral: !0,
                numeralThousandsGroupStyle: "thousand",
            });

    var basic = $(".flatpickr-basic"),
        time = $(".flatpickr-time"),
        date_time = $(".flatpickr-date-time"),
        range = $(".flatpickr-range");
    basic.length && basic.flatpickr(),
        time.length && time.flatpickr({ enableTime: !0, noCalendar: !0 }),
        date_time.length && date_time.flatpickr({ enableTime: !0 }),
        range.length && range.flatpickr({ mode: "range" });
});
