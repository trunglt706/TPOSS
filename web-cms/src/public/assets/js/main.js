feather.replace();

(window.colors = {
    solid: {
        primary: "#0EABAF",
        secondary: "#636E72",
        success: "#28C76F",
        info: "#00cfe8",
        warning: "#FF9F43",
        danger: "#EA5455",
        dark: "#2D3436",
        black: "#000",
        white: "#fff",
        body: "#f8f8f8",
    },
    light: {
        primary: "#0EABAF1a",
        secondary: "#636E721a",
        success: "#28C76F1a",
        info: "#00cfe81a",
        warning: "#FF9F431a",
        danger: "#EA54551a",
        dark: "#2D34361a",
    },
}),
    (function (a, e, t) {
        "use strict";
        var s = t("html"),
            n = t("body"),
            o = "#4e5154",
            r = "";
        if (
            (t(a).on("load", function () {
                var r = !1;
                (n.hasClass("menu-collapsed") ||
                    "true" === localStorage.getItem("menuCollapsed")) &&
                    (r = !0),
                    t("html").data("textdirection"),
                    setTimeout(function () {
                        s.removeClass("loading").addClass("loaded");
                    }, 1200),
                    t.app.menu.init(r);
                !1 === t.app.nav.initialized &&
                    t.app.nav.init({
                        speed: 300,
                    }),
                    Unison.on("change", function (a) {
                        t.app.menu.change(r);
                    });
                [].slice
                    .call(e.querySelectorAll('[data-bs-toggle="tooltip"]'))
                    .map(function (a) {
                        return new bootstrap.Tooltip(a);
                    });
                t('a[data-action="collapse"]').on("click", function (a) {
                    a.preventDefault(),
                        t(this)
                            .closest(".card")
                            .children(".card-content")
                            .collapse("toggle"),
                        t(this)
                            .closest(".card")
                            .find('[data-action="collapse"]')
                            .toggleClass("rotate");
                }),
                    t(".touchspin-cart").length > 0 &&
                        t(".touchspin-cart").TouchSpin({
                            buttondown_class: "btn btn-primary",
                            buttonup_class: "btn btn-primary",
                            buttondown_txt: feather.icons.minus.toSvg(),
                            buttonup_txt: feather.icons.plus.toSvg(),
                        }),
                    t(
                        ".dropdown-notification .dropdown-menu, .dropdown-cart .dropdown-menu"
                    ).on("click", function (a) {
                        a.stopPropagation();
                    }),
                    t(".scrollable-container").each(function () {
                        new PerfectScrollbar(t(this)[0], {
                            wheelPropagation: !1,
                        });
                    }),
                    t('a[data-action="reload"]').on("click", function () {
                        var a = t(this).closest(".card");
                        if (s.hasClass("dark-layout")) var e = "#10163a";
                        else e = "#fff";
                        a.block({
                            message: feather.icons["refresh-cw"].toSvg({
                                class: "font-medium-1 spinner text-primary",
                            }),
                            timeout: 2e3,
                            overlayCSS: {
                                backgroundColor: e,
                                cursor: "wait",
                            },
                            css: {
                                border: 0,
                                padding: 0,
                                backgroundColor: "none",
                            },
                        });
                    }),
                    t('a[data-action="close"]').on("click", function () {
                        t(this).closest(".card").removeClass().slideUp("fast");
                    }),
                    t('.card .heading-elements a[data-action="collapse"]').on(
                        "click",
                        function () {
                            var a,
                                e = t(this).closest(".card");
                            parseInt(e[0].style.height, 10) > 0
                                ? ((a = e.css("height")),
                                  e.css("height", "").attr("data-height", a))
                                : e.data("height") &&
                                  ((a = e.data("height")),
                                  e.css("height", a).attr("data-height", ""));
                        }
                    ),
                    t("input:disabled, textarea:disabled")
                        .closest(".input-group")
                        .addClass("disabled"),
                    t(".main-menu-content")
                        .find("li.active")
                        .parents("li")
                        .addClass("sidebar-group-active");
                var l = n.data("menu");
                "horizontal-menu" != l &&
                    !1 === r &&
                    t(".main-menu-content")
                        .find("li.active")
                        .parents("li")
                        .addClass("open"),
                    "horizontal-menu" == l &&
                        (t(".main-menu-content")
                            .find("li.active")
                            .parents("li:not(.nav-item)")
                            .addClass("open"),
                        t(".main-menu-content")
                            .find("li.active")
                            .closest("li.nav-item")
                            .addClass("sidebar-group-active open"));
                var i = t(".chartjs"),
                    c = i.children("canvas").attr("height"),
                    d = t(".main-menu");
                if (
                    (i.css("height", c),
                    n.hasClass("boxed-layout") &&
                        n.hasClass("vertical-overlay-menu"))
                ) {
                    var h = d.width(),
                        u = t(".app-content").position().left - h;
                    n.hasClass("menu-flipped")
                        ? d.css("right", u + "px")
                        : d.css("left", u + "px");
                }
                t(".char-textarea").on("keyup", function (e) {
                    !(function (e, s) {
                        var n = parseInt(t(e).data("length")),
                            r = t(".textarea-counter-value"),
                            l = t(".char-textarea");
                        (function (a) {
                            return (
                                8 == a.keyCode ||
                                46 == a.keyCode ||
                                37 == a.keyCode ||
                                38 == a.keyCode ||
                                39 == a.keyCode ||
                                40 == a.keyCode
                            );
                        })(s) ||
                            (e.value.length < n - 1 &&
                                (e.value = e.value.substring(0, n)));
                        t(".char-count").html(e.value.length),
                            e.value.length > n
                                ? (r.css(
                                      "background-color",
                                      a.colors.solid.danger
                                  ),
                                  l.css("color", a.colors.solid.danger),
                                  l.addClass("max-limit"))
                                : (r.css(
                                      "background-color",
                                      a.colors.solid.primary
                                  ),
                                  l.css("color", o),
                                  l.removeClass("max-limit"));
                    })(this, e),
                        t(this).addClass("active");
                }),
                    t(".content-overlay").on("click", function () {
                        t(".search-list").removeClass("show");
                        var a = t(".search-input-close").closest(
                            ".search-input"
                        );
                        a.hasClass("open") &&
                            (a.removeClass("open"),
                            w.val(""),
                            w.blur(),
                            y.removeClass("show")),
                            t(".app-content").removeClass("show-overlay"),
                            t(".bookmark-wrapper .bookmark-input").removeClass(
                                "show"
                            );
                    });
                var f = e.getElementsByClassName("main-menu-content");
                f.length > 0 &&
                    f[0].addEventListener("ps-scroll-y", function () {
                        t(this).find(".ps__thumb-y").position().top > 0
                            ? t(".shadow-bottom").css("display", "block")
                            : t(".shadow-bottom").css("display", "none");
                    });
            }),
            t(e).on("click", ".sidenav-overlay", function (a) {
                return t.app.menu.hide(), !1;
            }),
            "undefined" != typeof Hammer)
        ) {
            var l;
            "rtl" == t("html").data("textdirection") && (l = !0);
            var i = e.querySelector(".drag-target"),
                c = "panright",
                d = "panleft";
            if (
                (!0 === l && ((c = "panleft"), (d = "panright")),
                t(i).length > 0)
            )
                new Hammer(i).on(c, function (a) {
                    if (n.hasClass("vertical-overlay-menu"))
                        return t.app.menu.open(), !1;
                });
            setTimeout(function () {
                var a,
                    s = e.querySelector(".main-menu");
                t(s).length > 0 &&
                    ((a = new Hammer(s)).get("pan").set({
                        direction: Hammer.DIRECTION_ALL,
                        threshold: 250,
                    }),
                    a.on(d, function (a) {
                        if (n.hasClass("vertical-overlay-menu"))
                            return t.app.menu.hide(), !1;
                    }));
            }, 300);
            var h = e.querySelector(".sidenav-overlay");
            if (t(h).length > 0)
                new Hammer(h).on("tap", function (a) {
                    if (n.hasClass("vertical-overlay-menu"))
                        return t.app.menu.hide(), !1;
                });
        }

        if (
            (t(e).on("click", ".menu-toggle, .modern-nav-toggle", function (e) {
                return (
                    e.preventDefault(),
                    t.app.menu.toggle(),
                    setTimeout(function () {
                        t(a).trigger("resize");
                    }, 200),
                    t("#collapse-sidebar-switch").length > 0 &&
                        setTimeout(function () {
                            n.hasClass("menu-expanded") ||
                            n.hasClass("menu-open")
                                ? t("#collapse-sidebar-switch").prop(
                                      "checked",
                                      !1
                                  )
                                : t("#collapse-sidebar-switch").prop(
                                      "checked",
                                      !0
                                  );
                        }, 50),
                    n.hasClass("menu-expanded") || n.hasClass("menu-open")
                        ? localStorage.setItem("menuCollapsed", !1)
                        : localStorage.setItem("menuCollapsed", !0),
                    !1
                );
            }),
            t(".navigation").find("li").has("ul").addClass("has-sub"),
            t(a).resize(function () {
                t.app.menu.manualScroller.updateHeight();
            }),
            t("#sidebar-page-navigation").on(
                "click",
                "a.nav-link",
                function (a) {
                    a.preventDefault(), a.stopPropagation();
                    var e = t(this),
                        s = e.attr("href"),
                        n = t(s).offset().top - 80;
                    t("html, body").animate(
                        {
                            scrollTop: n,
                        },
                        0
                    ),
                        setTimeout(function () {
                            e
                                .parent(".nav-item")
                                .siblings(".nav-item")
                                .children(".nav-link")
                                .removeClass("active"),
                                e.addClass("active");
                        }, 100);
                }
            ))
        )
            var p = t(".search-input input").data("search"),
                v = t(".bookmark-wrapper"),
                g = t(".bookmark-wrapper .bookmark-star"),
                b = t(".bookmark-wrapper .bookmark-input"),
                C = t(".nav-link-search"),
                k = t(".search-input"),
                w = t(".search-input input"),
                y = t(".search-input .search-list"),
                x = t(".app-content"),
                S = t(".bookmark-input .search-list");
        if (
            (g.on("click", function (a) {
                a.stopPropagation(),
                    b.toggleClass("show"),
                    b.find("input").val(""),
                    b.find("input").blur(),
                    b.find("input").focus(),
                    v.find(".search-list").addClass("show");
            }),
            C.on("click", function () {
                t(this);
                t(this)
                    .parent(".nav-search")
                    .find(".search-input")
                    .addClass("open"),
                    w.focus(),
                    b.removeClass("show");
            }),
            t(".search-input-close").on("click", function () {
                t(this);
                var a = t(this).closest(".search-input");
                a.hasClass("open") &&
                    (a.removeClass("open"),
                    w.val(""),
                    w.blur(),
                    y.removeClass("show"),
                    x.removeClass("show-overlay"));
            }),
            t(".search-list-main").length)
        )
            var I = new PerfectScrollbar(".search-list-main", {
                wheelPropagation: !1,
            });
        if (t(".search-list-bookmark").length)
            new PerfectScrollbar(".search-list-bookmark", {
                wheelPropagation: !1,
            });

        w.on("keyup", function (a) {
            if (
                (t(this).closest(".search-list").addClass("show"),
                38 !== a.keyCode && 40 !== a.keyCode && 13 !== a.keyCode)
            ) {
                27 == a.keyCode &&
                    (x.removeClass("show-overlay"),
                    b.find("input").val(""),
                    b.find("input").blur(),
                    w.val(""),
                    w.blur(),
                    k.removeClass("open"),
                    k.hasClass("show") &&
                        (t(this).removeClass("show"), k.removeClass("show")));
                var e = t(this).val().toLowerCase(),
                    n = !1;
                if (
                    (t(this).parent().hasClass("bookmark-input") && (n = !0),
                    "" != e)
                ) {
                    x.addClass("show-overlay"),
                        b.focus()
                            ? S.addClass("show")
                            : (y.addClass("show"), S.removeClass("show")),
                        !1 === n && (y.addClass("show"), S.removeClass("show"));
                } else
                    x.hasClass("show-overlay") && x.removeClass("show-overlay"),
                        y.hasClass("show") && y.removeClass("show");
            }
        }),
            Waves.init(),
            Waves.attach(
                ".btn:not([class*='btn-relief-']):not([class*='btn-gradient-']):not([class*='btn-outline-']):not([class*='btn-flat-'])",
                ["waves-float", "waves-light"]
            ),
            Waves.attach("[class*='btn-outline-']"),
            Waves.attach("[class*='btn-flat-']"),
            t(".form-password-toggle .input-group-text").on(
                "click",
                function (a) {
                    a.preventDefault();
                    var e = t(this),
                        s = e.closest(".form-password-toggle"),
                        n = e,
                        o = s.find("input");
                    "text" === o.attr("type")
                        ? (o.attr("type", "password"),
                          feather &&
                              n.find("svg").replaceWith(
                                  feather.icons.eye.toSvg({
                                      class: "font-small-4",
                                  })
                              ))
                        : "password" === o.attr("type") &&
                          (o.attr("type", "text"),
                          feather &&
                              n.find("svg").replaceWith(
                                  feather.icons["eye-off"].toSvg({
                                      class: "font-small-4",
                                  })
                              ));
                }
            ),
            t(a).on("scroll", function () {
                t(this).scrollTop() > 400
                    ? t(".scroll-top").fadeIn()
                    : t(".scroll-top").fadeOut();
            }),
            t(".scroll-top").on("click", function () {
                t("html, body").animate(
                    {
                        scrollTop: 0,
                    },
                    75
                );
            });
    })(window, document, jQuery),
    "function" == typeof jQuery.validator &&
        jQuery.validator.setDefaults({
            errorElement: "span",
            errorPlacement: function (a, e) {
                e.parent().hasClass("input-group") ||
                e.hasClass("select2") ||
                "checkbox" === e.attr("type")
                    ? a.insertAfter(e.parent())
                    : e.hasClass("form-check-input")
                    ? a.insertAfter(e.parent().siblings(":last"))
                    : a.insertAfter(e),
                    e.parent().hasClass("input-group") &&
                        e.parent().addClass("is-invalid");
            },
            highlight: function (a, e, t) {
                $(a).addClass("error"),
                    $(a).parent().hasClass("input-group") &&
                        $(a).parent().addClass("is-invalid");
            },
            unhighlight: function (a, e, t) {
                $(a).removeClass("error"),
                    $(a).parent().hasClass("input-group") &&
                        $(a).parent().removeClass("is-invalid");
            },
        });
