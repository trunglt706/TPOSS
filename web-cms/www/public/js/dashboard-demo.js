"use strict";
function filterColumn(t, a) {
    if (5 == t) {
        var e = $(".start_date").val(),
            l = $(".end_date").val();
        "" !== e && "" !== l && filterByDate(t, e, l), $(".dt-advanced-search").dataTable().fnDraw();
    } else $(".dt-advanced-search").DataTable().column(t).search(a, !1, !0).draw();
}
var separator = " - ",
    rangePickr = $(".flatpickr-range"),
    dateFormat = "MM/DD/YYYY",
    options = { autoUpdateInput: !1, autoApply: !0, locale: { format: dateFormat, separator: separator }, opens: "rtl" === $("html").attr("data-textdirection") ? "left" : "right" };
    rangePickr.length &&
    rangePickr.flatpickr({
        mode: "range",
        dateFormat: "m/d/Y",
        onClose: function (t, a, e) {
            var l = "",
                n = new Date();
            null != t[0] && ((l = t[0].getMonth() + 1 + "/" + t[0].getDate() + "/" + t[0].getFullYear()), $(".start_date").val(l)),
                null != t[1] && ((n = t[1].getMonth() + 1 + "/" + t[1].getDate() + "/" + t[1].getFullYear()), $(".end_date").val(n)),
                $(rangePickr).trigger("change").trigger("keyup");
        },
    });
var filterByDate = function (t, a, e) {
        $.fn.dataTableExt.afnFiltering.push(function (l, n, o) {
            var r = normalizeDate(n[t]),
                d = normalizeDate(a),
                s = normalizeDate(e);
            return (d <= r && r <= s) || (r >= d && "" === s && "" !== d) || (r <= s && "" === d && "" !== s);
        });
    },
    normalizeDate = function (t) {
        var a = new Date(t);
        return a.getFullYear() + "" + ("0" + (a.getMonth() + 1)).slice(-2) + ("0" + a.getDate()).slice(-2);
    };

var data = [
    {
    "id": 1,
    "create_date": "06/20/2022",
    "supplier": "Nuclear",
    "value": "$896.35",
    "tax": "$12.54",
    "delivery_date": "06/21/2022",
    "status": 2
    },
    {
    "id": 2,
    "create_date": "06/20/2022",
    "supplier": "Nuclear",
    "value": "$896.35",
    "tax": "$12.54",
    "delivery_date": "06/21/2022",
    "status": 1
    },
    {
    "id": 3,
    "create_date": "06/20/2022",
    "supplier": "Nuclear",
    "value": "$896.35",
    "tax": "$12.54",
    "delivery_date": "06/21/2022",
    "status": 3
    },
    {
    "id": 4,
    "create_date": "06/20/2022",
    "supplier": "Nuclear",
    "value": "$896.35",
    "tax": "$12.54",
    "delivery_date": "06/21/2022",
    "status": 4
    },
    {
    "id": 5,
    "create_date": "06/20/2022",
    "supplier": "Nuclear",
    "value": "$896.35",
    "tax": "$12.54",
    "delivery_date": "06/21/2022",
    "status": 5
    },
    {
    "id": 6,
    "create_date": "06/20/2022",
    "supplier": "Nuclear",
    "value": "$896.35",
    "tax": "$12.54",
    "delivery_date": "06/21/2022",
    "status": 1
    },
    {
    "id": 7,
    "create_date": "06/20/2022",
    "supplier": "Nuclear",
    "value": "$896.35",
    "tax": "$12.54",
    "delivery_date": "06/21/2022",
    "status": 2
    },
    {
    "id": 8,
    "create_date": "06/20/2022",
    "supplier": "Nuclear",
    "value": "$896.35",
    "tax": "$12.54",
    "delivery_date": "06/21/2022",
    "status": 3
    },
    {
    "id": 9,
    "create_date": "06/20/2022",
    "supplier": "Nuclear",
    "value": "$896.35",
    "tax": "$12.54",
    "delivery_date": "06/21/2022",
    "status": 4
    },
    {
    "id": 10,
    "create_date": "06/20/2022",
    "supplier": "Nuclear",
    "value": "$896.35",
    "tax": "$12.54",
    "delivery_date": "06/21/2022",
    "status": 5
    },
    {
    "id": 11,
    "create_date": "06/20/2022",
    "supplier": "Nuclear",
    "value": "$896.35",
    "tax": "$12.54",
    "delivery_date": "06/21/2022",
    "status": 1
    },
];

$(function () {
    $("html").attr("data-textdirection");
    var e = $(".dt-advanced-search");
    
    if (e.length)
        e.DataTable({
            data: data,
            columns: [{ data: "id" }, { data: "create_date" }, { data: "supplier" }, { data: "value" }, { data: "tax" }, { data: "delivery_date" }, { data: "status" }],
            columnDefs: [
                { className: "control", orderable: !1, targets: 0 },
                {
                    targets: -1,
                    render: function (t, a, e, l) {
                        var n = e.status,
                            o = {
                                1: { title: "Current", class: "badge-light-primary" },
                                2: { title: "Success", class: " badge-light-success" },
                                3: { title: "Rejected", class: " badge-light-danger" },
                                4: { title: "Resigned", class: " badge-light-warning" },
                                5: { title: "Applied", class: " badge-light-info" },
                            };
                        return void 0 === o[n] ? t : '<span class="badge rounded-pill ' + o[n].class + '">' + o[n].title + "</span>";
                    },
                },
            ],
            displayLength: 5,
            lengthMenu: [5, 10, 25, 50],
            dom: '<"d-flex justify-content-between align-items-center mx-0 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"d-flex justify-content-between mx-0 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            orderCellsTop: !0,
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function (t) {
                            return "Details of " + t.data().full_name;
                        },
                    }),
                    type: "column",
                    renderer: function (t, a, e) {
                        var l = $.map(e, function (t, a) {
                            return "" !== t.title ? '<tr data-dt-row="' + t.rowIndex + '" data-dt-column="' + t.columnIndex + '"><td>' + t.title + ":</td> <td>" + t.data + "</td></tr>" : "";
                        }).join("");
                        return !!l && $('<table class="table"/><tbody />').append(l);
                    },
                },
            },
            language: { paginate: { previous: "&nbsp;", next: "&nbsp;" } },
        });
    if (
        ($("input.dt-input").on("keyup", function () {
            filterColumn($(this).attr("data-column"), $(this).val());
        }))
    )
    $(".dataTables_filter .form-control").removeClass("form-control-sm"), $(".dataTables_length .form-select").removeClass("form-select-sm").removeClass("form-control-sm");
});




$(window).on("load", function () {
    "use strict";
    var o,
        e,
        r,
        t,
        a,
        s,
        c = "#f3f3f3",
        w = "#EBEBEB",
        p = "#b9b9c3",
        u = document.querySelector("#statistics-order-chart"),
        g = document.querySelector("#statistics-profit-chart"),
        b = document.querySelector("#earnings-chart"),
        y = document.querySelector("#revenue-report-chart"),
        m = document.querySelector("#budget-chart");
    setTimeout(function () {
        toastr.success("You have successfully logged in to NxCloud. Now you can start to explore!", "🎉 Welcome Vinh Trần!", { closeButton: !0, tapToDismiss: !1});
    }, 2e3),
        (o = {
            chart: { height: 70, type: "bar", stacked: !0, toolbar: { show: !1 } },
            grid: { show: !1, padding: { left: 0, right: 0, top: -15, bottom: -15 } },
            plotOptions: { bar: { horizontal: !1, columnWidth: "20%", startingShape: "rounded", colors: { backgroundBarColors: [c, c, c, c, c], backgroundBarRadius: 5 } } },
            legend: { show: !1 },
            dataLabels: { enabled: !1 },
            colors: [window.colors.solid.warning],
            series: [{ name: "2020", data: [45, 85, 65, 45, 65] }],
            xaxis: { labels: { show: !1 }, axisBorder: { show: !1 }, axisTicks: { show: !1 } },
            yaxis: { show: !1 },
            tooltip: { x: { show: !1 } },
        }),
        new ApexCharts(u, o).render(),
        (e = {
            chart: { height: 70, type: "line", toolbar: { show: !1 }, zoom: { enabled: !1 } },
            grid: { borderColor: w, strokeDashArray: 5, xaxis: { lines: { show: !0 } }, yaxis: { lines: { show: !1 } }, padding: { top: -30, bottom: -10 } },
            stroke: { width: 3 },
            colors: [window.colors.solid.info],
            series: [{ data: [0, 20, 5, 30, 15, 45] }],
            markers: {
                size: 2,
                colors: window.colors.solid.info,
                strokeColors: window.colors.solid.info,
                strokeWidth: 2,
                strokeOpacity: 1,
                strokeDashArray: 0,
                fillOpacity: 1,
                discrete: [{ seriesIndex: 0, dataPointIndex: 5, fillColor: "#ffffff", strokeColor: window.colors.solid.info, size: 5 }],
                shape: "circle",
                radius: 2,
                hover: { size: 3 },
            },
            xaxis: { labels: { show: !0, style: { fontSize: "0px" } }, axisBorder: { show: !1 }, axisTicks: { show: !1 } },
            yaxis: { show: !1 },
            tooltip: { x: { show: !1 } },
        }),
        new ApexCharts(g, e).render(),
        (r = {
            chart: { type: "donut", height: 120, toolbar: { show: !1 } },
            dataLabels: { enabled: !1 },
            series: [53, 16, 31],
            legend: { show: !1 },
            comparedResult: [2, -3, 8],
            labels: ["App", "Service", "Product"],
            stroke: { width: 0 },
            colors: ["#28c76f66", "#28c76f33", window.colors.solid.success],
            grid: { padding: { right: -20, bottom: -8, left: -20 } },
            plotOptions: {
                pie: {
                    startAngle: -10,
                    donut: {
                        labels: {
                            show: !0,
                            name: { offsetY: 15 },
                            value: {
                                offsetY: -15,
                                formatter: function (o) {
                                    return parseInt(o) + "%";
                                },
                            },
                            total: {
                                show: !0,
                                offsetY: 15,
                                label: "App",
                                formatter: function (o) {
                                    return "53%";
                                },
                            },
                        },
                    },
                },
            },
            responsive: [
                { breakpoint: 1325, options: { chart: { height: 100 } } },
                { breakpoint: 1200, options: { chart: { height: 120 } } },
                { breakpoint: 1045, options: { chart: { height: 100 } } },
                { breakpoint: 992, options: { chart: { height: 120 } } },
            ],
        }),
        new ApexCharts(b, r).render(),
        (t = {
            chart: { height: 230, stacked: !0, type: "bar", toolbar: { show: !1 } },
            plotOptions: { bar: { columnWidth: "17%", endingShape: "rounded" }, distributed: !0 },
            colors: [window.colors.solid.primary, window.colors.solid.warning],
            series: [
                { name: "Earning", data: [95, 177, 284, 256, 105, 63, 168, 218, 72] },
                { name: "Expense", data: [-145, -80, -60, -180, -100, -60, -85, -75, -100] },
            ],
            dataLabels: { enabled: !1 },
            legend: { show: !1 },
            grid: { padding: { top: -20, bottom: -10 }, yaxis: { lines: { show: !1 } } },
            xaxis: { categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep"], labels: { style: { colors: p, fontSize: "0.86rem" } }, axisTicks: { show: !1 }, axisBorder: { show: !1 } },
            yaxis: { labels: { style: { colors: p, fontSize: "0.86rem" } } },
        }),
        new ApexCharts(y, t).render(),
        (a = {
            chart: { height: 80, toolbar: { show: !1 }, zoom: { enabled: !1 }, type: "line", sparkline: { enabled: !0 } },
            stroke: { curve: "smooth", dashArray: [0, 5], width: [2] },
            colors: [window.colors.solid.primary, "#dcdae3"],
            series: [{ data: [61, 48, 69, 52, 60, 40, 79, 60, 59, 43, 62] }, { data: [20, 10, 30, 15, 23, 0, 25, 15, 20, 5, 27] }],
            tooltip: { enabled: !1 },
        }),
        new ApexCharts(m, a).render(),
        (s = {
            chart: { height: 30, width: 30, type: "radialBar" },
            grid: { show: !1, padding: { left: -15, right: -15, top: -12, bottom: -15 } },
            colors: [window.colors.solid.primary],
            series: [54.4],
            plotOptions: { radialBar: { hollow: { size: "22%" }, track: { background: w }, dataLabels: { showOn: "always", name: { show: !1 }, value: { show: !1 } } } },
            stroke: { lineCap: "round" },
        });


    var O = document.querySelector("#invoice-report-chart"),
        o = { series1: "#0EABAF", series2: "#FF9F43", series3: "#28C76F", series4: "#EA5455", series5: "#00CFE8" },
        D = {
        chart: { height: 350, type: "donut", dropShadow: { enabled: 1, blur: 3, left: 1, top: 1, opacity: 0.1 } },
        legend: { show: !0, position: "bottom" },
        labels: ["Đã thanh toán", "TT 1 phần", "Chưa thanh toán", "Quá hạn", "Chưa gửi"],
        series: [85, 16, 50, 50, 3],
        colors: [o.series1, o.series5, o.series3, o.series2, o.series4],
        dataLabels: {
            enabled: !0,
            formatter: function (e, t) {
                return parseInt(e) + "%";
            },
        },
        plotOptions: {
            pie: {
                donut: {
                    labels: {
                        show: !0,
                        name: { fontSize: "2rem", fontFamily: "Manrope" },
                        value: {
                            fontSize: "1rem",
                            fontFamily: "Manrope",
                            formatter: function (e) {
                                return parseInt(e) + " hóa đơn";
                            },
                        },
                        total: {
                            show: !0,
                            fontSize: "1.5rem",
                            label: "204",
                            formatter: function (e) {
                                return "Hóa đơn";
                            },
                        },
                    },
                },
            },
        },
        stroke: {show: false},
        responsive: [
            { breakpoint: 992, options: { chart: { height: 380 } } },
            { breakpoint: 576, options: { chart: { height: 320 }, plotOptions: { pie: { donut: { labels: { show: !0, name: { fontSize: "1.5rem" }, value: { fontSize: "1rem" }, total: { fontSize: "1.5rem" } } } } } } },
        ],
    };
    new ApexCharts(O, D).render();
    
    var b = document.querySelector("#contract-report-chart"),
        S = {
            chart: { height: 350, type: "radialBar", dropShadow: { enabled: 1, blur: 3, left: 1, top: 1, opacity: 0.1 } },
            colors: [o.series2, o.series3, o.series4],
            plotOptions: {
                radialBar: {
                    size: 185,
                    hollow: { size: "30%" },
                    track: { margin: 15 },
                    dataLabels: {
                        name: { fontSize: "2rem", fontFamily: "Manrope" },
                        value: { fontSize: "1rem", fontFamily: "Manrope" },
                        total: {
                            show: !0,
                            fontSize: "1rem",
                            label: "Total",
                            formatter: function (e) {
                                return "165";
                            },
                        },
                    },
                },
            },
            grid: { padding: { top: -10, bottom: -20 } },
            legend: { show: !0, position: "bottom" },
            stroke: { lineCap: "round" },
            series: [80, 50, 35],
            labels: ["Chờ phản hồi", "Chấp nhận", "Từ chối"],
        };
    new ApexCharts(b, S).render();

    var z = document.querySelector("#project-report-chart"),
        Z = {
        chart: { height: 350, type: "pie", dropShadow: { enabled: 1, blur: 3, left: 1, top: 1, opacity: 0.1 } },
        legend: { show: !0, position: "bottom" },
        labels: ["Đang triển khai", "Chờ duyệt", "Từ chối"],
        series: [ 16, 6, 3],
        colors: [o.series1, o.series2, o.series4],
        stroke: {show: false},
        responsive: [
            { breakpoint: 992, options: { chart: { height: 380 } } },
            { breakpoint: 576, options: { chart: { height: 320 } } },
        ],
    };
    new ApexCharts(z, Z).render();
});


$(function () {
    var e = $(".task-due-date"),
        a = $(".sidebar-todo-modal"),
        m = $("#task-assigned"),
        p = $("#task-tag"),
        h = $(".body-content-overlay"),
        y = $(".todo-task-list-wrapper");
    var S = document.getElementById("todo-task-list");
    function q(t) {
        return t.id ? '<div class="d-flex align-items-center"><img class="d-block rounded-circle me-50" src="' + $(t.element).data("img") + '" height="26" width="26" alt="' + t.text + '"><p class="mb-0">' + t.text + "</p></div>" : t.text;
    }
    if (
        (void 0 !== typeof S &&
            null !== S &&
            dragula([S], {
                moves: function (t, e, a) {
                    return a.classList.contains("drag-icon");
                },
            }),
            h.length &&
                h.on("click", function (t) {
                    f.removeClass("show"), h.removeClass("show"), $(a).modal("hide");
                }),
            m.length &&
                (m.wrap('<div class="position-relative"></div>'),
                m.select2({
                    placeholder: "Unassigned",
                    dropdownParent: m.parent(),
                    templateResult: q,
                    templateSelection: q,
                    escapeMarkup: function (t) {
                        return t;
                    },
                })),
            p.length && (p.wrap('<div class="position-relative"></div>'), p.select2({ placeholder: "Select tag" })),
            e.length && e.flatpickr({
                    dateFormat: "Y-m-d",
                    defaultDate: "today",
                    onReady: function (t, e, a) {
                        a.isMobile && $(a.mobileInput).attr("step", null);
                    },
                }),
            y.on("change", ".form-check", function (t) {
                var e = $(this).find("input");
                e.prop("checked") ? (e.closest(".todo-item").addClass("completed"), toastr.success("Task Completed", "Congratulations!!", { closeButton: !0, tapToDismiss: !1,})) : e.closest(".todo-item").removeClass("completed");
            }),
            y.on("click", ".form-check", function (t) {
                t.stopPropagation();
            }),
            $(document).on("click", ".todo-task-list-wrapper .todo-item", function (e) {
                a.modal("show")})
        )
    )
    ;
}),
$(window).on("resize", function () {
    $(window).width() > 992 && $(".body-content-overlay").hasClass("show") && ($(".sidebar-left").removeClass("show"), $(".body-content-overlay").removeClass("show"), $(".sidebar-todo-modal").modal("hide"));
});



