<script>
    var t = "rtl" === $("html").attr("data-textdirection");
    var data_register_usings = [];

    $(document).ready(function() {
        load_ajax("{{ route('admin.home_header') }}", $('.home-header'));
    });

    function load_register_usings() {

    }

    $(function() {
        var t = "rtl" === $("html").attr("data-textdirection");

        var p = document.querySelector("#register_usings-chart"),
            c = {
                chart: {
                    height: 400,
                    type: "scatter",
                    zoom: {
                        enabled: !0,
                        type: "xy"
                    },
                    parentHeightOffset: 0,
                    toolbar: {
                        show: !1
                    }
                },
                grid: {
                    xaxis: {
                        lines: {
                            show: !0
                        }
                    }
                },
                legend: {
                    show: !0,
                    position: "top",
                    horizontalAlign: "start"
                },
                colors: [window.colors.solid.warning, window.colors.solid.primary, window.colors.solid.success],
                series: [{
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
                        formatter: function(e) {
                            return parseFloat(e).toFixed(1);
                        },
                    },
                },
                yaxis: {
                    opposite: t
                },
            };
        void 0 !== typeof p && null !== p && new ApexCharts(p, c).render();

        var h = document.querySelector("#revenue-chart"),
            m = {
                chart: {
                    height: 400,
                    type: "line",
                    zoom: {
                        enabled: !1
                    },
                    parentHeightOffset: 0,
                    toolbar: {
                        show: !1
                    }
                },
                series: [{
                    data: [280, 200, 220, 180, 270, 250, 70, 90, 200, 150, 160, 100, 150, 100, 50]
                }],
                markers: {
                    strokeWidth: 7,
                    strokeOpacity: 1,
                    strokeColors: [window.colors.solid.white],
                    colors: [window.colors.solid.warning]
                },
                dataLabels: {
                    enabled: !1
                },
                stroke: {
                    curve: "straight"
                },
                colors: [window.colors.solid.warning],
                grid: {
                    xaxis: {
                        lines: {
                            show: !0
                        }
                    },
                    padding: {
                        top: -20
                    }
                },
                tooltip: {
                    custom: function(e) {
                        return '<div class="px-1 py-50"><span>' + e.series[e.seriesIndex][e
                                .dataPointIndex
                            ] +
                            "%</span></div>";
                    },
                },
                xaxis: {
                    categories: ["7/12", "8/12", "9/12", "10/12", "11/12", "12/12", "13/12", "14/12", "15/12",
                        "16/12",
                        "17/12", "18/12", "19/12", "20/12", "21/12"
                    ]
                },
                yaxis: {
                    opposite: t
                },
            };
        void 0 !== typeof h && null !== h && new ApexCharts(h, m).render();
    });
</script>
