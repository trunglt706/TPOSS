$(function () {
    "use strict";
    var e = $(".flat-picker"),
        t = "rtl" === $("html").attr("data-textdirection"),
        a = { series1: "#0EABAF", series2: "#0EABAF88", bg: "#0EABAF44" },
        o = { series1: "#0EABAF", series2: "#FF9F43", series3: "#28C76F", series4: "#EA5455", series5: "#00CFE8" },
        r = { series3: "#a4f8cd", series2: "#60f2ca", series1: "#2bdac7" };
    function s(e, t) {
        for (var a = 0, o = []; a < e; ) {
            var r = "w" + (a + 1).toString(),
                s = Math.floor(Math.random() * (t.max - t.min + 1)) + t.min;
            o.push({ x: r, y: s }), a++;
        }
        return o;
    }
    if (e.length) {
        new Date();
        e.each(function () {
            $(this).flatpickr({ mode: "range", defaultDate: ["2019-05-01", "2019-05-10"] });
        });
    }
    var i = document.querySelector("#line-area-chart"),
        n = {
            chart: { height: 400, type: "area", parentHeightOffset: 0, toolbar: { show: !1 } },
            dataLabels: { enabled: !1 },
            stroke: { show: !1, curve: "straight" },
            legend: { show: !0, position: "top", horizontalAlign: "start" },
            grid: { xaxis: { lines: { show: !0 } } },
            colors: [r.series3, r.series2, r.series1],
            series: [
                { name: "Visits", data: [100, 120, 90, 170, 130, 160, 140, 240, 220, 180, 270, 280, 375] },
                { name: "Clicks", data: [60, 80, 70, 110, 80, 100, 90, 180, 160, 140, 200, 220, 275] },
                { name: "Sales", data: [20, 40, 30, 70, 40, 60, 50, 140, 120, 100, 140, 180, 220] },
            ],
            xaxis: { categories: ["7/12", "8/12", "9/12", "10/12", "11/12", "12/12", "13/12", "14/12", "15/12", "16/12", "17/12", "18/12", "19/12", "20/12"] },
            fill: { opacity: 1, type: "solid" },
            tooltip: { shared: !1 },
            yaxis: { opposite: t },
        };
    void 0 !== typeof i && null !== i && new ApexCharts(i, n).render();
    var l = document.querySelector("#column-chart"),
        d = {
            chart: { height: 400, type: "bar", stacked: !0, parentHeightOffset: 0, toolbar: { show: !1 } },
            plotOptions: { bar: { columnWidth: "15%", colors: { backgroundBarColors: [a.bg, a.bg, a.bg, a.bg, a.bg], backgroundBarRadius: 10 } } },
            dataLabels: { enabled: !1 },
            legend: { show: !0, position: "top", horizontalAlign: "start" },
            colors: [a.series1, a.series2],
            stroke: { show: !0, colors: ["transparent"] },
            grid: { xaxis: { lines: { show: !0 } } },
            series: [
                { name: "Apple", data: [90, 120, 55, 100, 80, 125, 175, 70, 88, 180] },
                { name: "Samsung", data: [85, 100, 30, 40, 95, 90, 30, 110, 62, 20] },
            ],
            xaxis: { categories: ["7/12", "8/12", "9/12", "10/12", "11/12", "12/12", "13/12", "14/12", "15/12", "16/12"] },
            fill: { opacity: 1 },
            yaxis: { opposite: t },
        };
    void 0 !== typeof l && null !== l && new ApexCharts(l, d).render();
    var p = document.querySelector("#scatter-chart"),
        c = {
            chart: { height: 400, type: "scatter", zoom: { enabled: !0, type: "xy" }, parentHeightOffset: 0, toolbar: { show: !1 } },
            grid: { xaxis: { lines: { show: !0 } } },
            legend: { show: !0, position: "top", horizontalAlign: "start" },
            colors: [window.colors.solid.warning, window.colors.solid.primary, window.colors.solid.success],
            series: [
                {
                    name: "Angular",
                    data: [
                        [5.4, 170],
                        [5.4, 100],
                        [6.3, 170],
                        [5.7, 140],
                        [5.9, 130],
                        [7, 150],
                        [8, 120],
                        [9, 170],
                        [10, 190],
                        [11, 220],
                        [12, 170],
                        [13, 230],
                    ],
                },
                {
                    name: "Vue",
                    data: [
                        [14, 220],
                        [15, 280],
                        [16, 230],
                        [18, 320],
                        [17.5, 280],
                        [19, 250],
                        [20, 350],
                        [20.5, 320],
                        [20, 320],
                        [19, 280],
                        [17, 280],
                        [22, 300],
                        [18, 120],
                    ],
                },
                {
                    name: "React",
                    data: [
                        [14, 290],
                        [13, 190],
                        [20, 220],
                        [21, 350],
                        [21.5, 290],
                        [22, 220],
                        [23, 140],
                        [19, 400],
                        [20, 200],
                        [22, 90],
                        [20, 120],
                    ],
                },
            ],
            xaxis: {
                tickAmount: 10,
                labels: {
                    formatter: function (e) {
                        return parseFloat(e).toFixed(1);
                    },
                },
            },
            yaxis: { opposite: t },
        };
    void 0 !== typeof p && null !== p && new ApexCharts(p, c).render();
    var h = document.querySelector("#line-chart"),
        m = {
            chart: { height: 400, type: "line", zoom: { enabled: !1 }, parentHeightOffset: 0, toolbar: { show: !1 } },
            series: [{ data: [280, 200, 220, 180, 270, 250, 70, 90, 200, 150, 160, 100, 150, 100, 50] }],
            markers: { strokeWidth: 7, strokeOpacity: 1, strokeColors: [window.colors.solid.white], colors: [window.colors.solid.warning] },
            dataLabels: { enabled: !1 },
            stroke: { curve: "straight" },
            colors: [window.colors.solid.warning],
            grid: { xaxis: { lines: { show: !0 } }, padding: { top: -20 } },
            tooltip: {
                custom: function (e) {
                    return '<div class="px-1 py-50"><span>' + e.series[e.seriesIndex][e.dataPointIndex] + "%</span></div>";
                },
            },
            xaxis: { categories: ["7/12", "8/12", "9/12", "10/12", "11/12", "12/12", "13/12", "14/12", "15/12", "16/12", "17/12", "18/12", "19/12", "20/12", "21/12"] },
            yaxis: { opposite: t },
        };
    void 0 !== typeof h && null !== h && new ApexCharts(h, m).render();
    var f = document.querySelector("#bar-chart"),
        w = {
            chart: { height: 400, type: "bar", parentHeightOffset: 0, toolbar: { show: !1 } },
            plotOptions: { bar: { horizontal: !0, barHeight: "30%", endingShape: "rounded" } },
            grid: { xaxis: { lines: { show: !1 } }, padding: { top: -15, bottom: -10 } },
            colors: window.colors.solid.info,
            dataLabels: { enabled: !1 },
            series: [{ data: [700, 350, 480, 600, 210, 550, 150] }],
            xaxis: { categories: ["MON, 11", "THU, 14", "FRI, 15", "MON, 18", "WED, 20", "FRI, 21", "MON, 23"] },
            yaxis: { opposite: t },
        };
    void 0 !== typeof f && null !== f && new ApexCharts(f, w).render();
    var g = document.querySelector("#candlestick-chart"),
        u = {
            chart: { height: 400, type: "candlestick", parentHeightOffset: 0, toolbar: { show: !1 } },
            series: [
                {
                    data: [
                        { x: new Date(15387786e5), y: [150, 170, 50, 100] },
                        { x: new Date(15387804e5), y: [200, 400, 170, 330] },
                        { x: new Date(15387822e5), y: [330, 340, 250, 280] },
                        { x: new Date(1538784e6), y: [300, 330, 200, 320] },
                        { x: new Date(15387858e5), y: [320, 450, 280, 350] },
                        { x: new Date(15387876e5), y: [300, 350, 80, 250] },
                        { x: new Date(15387894e5), y: [200, 330, 170, 300] },
                        { x: new Date(15387912e5), y: [200, 220, 70, 130] },
                        { x: new Date(1538793e6), y: [220, 270, 180, 250] },
                        { x: new Date(15387948e5), y: [200, 250, 80, 100] },
                        { x: new Date(15387966e5), y: [150, 170, 50, 120] },
                        { x: new Date(15387984e5), y: [110, 450, 10, 420] },
                        { x: new Date(15388002e5), y: [400, 480, 300, 320] },
                        { x: new Date(1538802e6), y: [380, 480, 350, 450] },
                    ],
                },
            ],
            xaxis: { type: "datetime" },
            yaxis: { tooltip: { enabled: !0 }, opposite: t },
            grid: { xaxis: { lines: { show: !0 } }, padding: { top: -23 } },
            plotOptions: { candlestick: { colors: { upward: window.colors.solid.success, downward: window.colors.solid.danger } }, bar: { columnWidth: "40%" } },
        };
    void 0 !== typeof g && null !== g && new ApexCharts(g, u).render();
    var x = document.querySelector("#heatmap-chart"),
        y = {
            chart: { height: 350, type: "heatmap", parentHeightOffset: 0, toolbar: { show: !1 } },
            plotOptions: {
                heatmap: {
                    enableShades: !1,
                    colorScale: {
                        ranges: [
                            { from: 0, to: 10, name: "0-10", color: "#D0FAFB" },
                            { from: 11, to: 20, name: "10-20", color: "#B1F0F1" },
                            { from: 21, to: 30, name: "20-30", color: "#5FDFE3" },
                            { from: 31, to: 40, name: "30-40", color: "#5ADFE2" },
                            { from: 41, to: 50, name: "40-50", color: "#20B2B6" },
                            { from: 51, to: 60, name: "50-60", color: "#1B9598" },
                        ],
                    },
                },
            },
            dataLabels: { enabled: !1 },
            legend: { show: !0, position: "bottom" },
            grid: { padding: { top: -25 } },
            series: [
                { name: "SUN", data: s(24, { min: 0, max: 60 }) },
                { name: "MON", data: s(24, { min: 0, max: 60 }) },
                { name: "TUE", data: s(24, { min: 0, max: 60 }) },
                { name: "WED", data: s(24, { min: 0, max: 60 }) },
                { name: "THU", data: s(24, { min: 0, max: 60 }) },
                { name: "FRI", data: s(24, { min: 0, max: 60 }) },
                { name: "SAT", data: s(24, { min: 0, max: 60 }) },
            ],
            xaxis: { labels: { show: !1 }, axisBorder: { show: !1 }, axisTicks: { show: !1 } },
        };
    void 0 !== typeof x && null !== x && new ApexCharts(x, y).render();
    var b = document.querySelector("#radialbar-chart"),
        S = {
            chart: { height: 350, type: "radialBar", dropShadow: { enabled: 1, blur: 3, left: 1, top: 1, opacity: 0.1 } },
            colors: [o.series1, o.series2, o.series4],
            plotOptions: {
                radialBar: {
                    size: 185,
                    hollow: { size: "25%" },
                    track: { margin: 15 },
                    dataLabels: {
                        name: { fontSize: "2rem", fontFamily: "Manrope" },
                        value: { fontSize: "1rem", fontFamily: "Manrope" },
                        total: {
                            show: !0,
                            fontSize: "1rem",
                            label: "Comments",
                            formatter: function (e) {
                                return "80%";
                            },
                        },
                    },
                },
            },
            grid: { padding: { top: -35, bottom: -30 } },
            legend: { show: !0, position: "bottom" },
            stroke: { lineCap: "round" },
            series: [80, 50, 35],
            labels: ["Comments", "Replies", "Shares"],
        };
    void 0 !== typeof b && null !== b && new ApexCharts(b, S).render();
    var v = document.querySelector("#radar-chart"),
        k = {
            chart: { height: 400, type: "radar", toolbar: { show: !1 }, parentHeightOffset: 0, dropShadow: { enabled: 1, blur: 7, left: 1, top: 1, opacity: 0.2 } },
            legend: { show: !0, position: "bottom" },
            yaxis: { show: !1 },
            series: [
                { name: "iPhone 11", data: [41, 64, 81, 60, 42, 42, 33, 23] },
                { name: "Samsung s20", data: [65, 46, 42, 25, 58, 63, 76, 43] },
            ],
            colors: [ o.series2, o.series1],
            xaxis: { categories: ["Battery", "Brand", "Camera", "Memory", "Storage", "Display", "OS", "Price"] },
            fill: { opacity: [1, 0.8] },
            stroke: { show: !1, width: 0 },
            markers: { size: 0 },
            grid: { show: !1, padding: { top: -20, bottom: -20 } },
        };
    void 0 !== typeof v && null !== v && new ApexCharts(v, k).render();
    var O = document.querySelector("#donut-chart"),
        D = {
            chart: { height: 350, type: "donut" },
            legend: { show: !0, position: "bottom" },
            labels: ["Operational", "Networking", "Hiring", "R&D"],
            series: [85, 16, 50, 50],
            colors: [o.series1, o.series5, o.series3, o.series2],
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
                                    return parseInt(e) + "%";
                                },
                            },
                            total: {
                                show: !0,
                                fontSize: "1.5rem",
                                label: "Operational",
                                formatter: function (e) {
                                    return "31%";
                                },
                            },
                        },
                    },
                },
            },
            responsive: [
                { breakpoint: 992, options: { chart: { height: 380 } } },
                { breakpoint: 576, options: { chart: { height: 320 }, plotOptions: { pie: { donut: { labels: { show: !0, name: { fontSize: "1.5rem" }, value: { fontSize: "1rem" }, total: { fontSize: "1.5rem" } } } } } } },
            ],
        };
    void 0 !== typeof O && null !== O && new ApexCharts(O, D).render();
});
