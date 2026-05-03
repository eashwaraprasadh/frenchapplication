/*!
 * Webflow: Front-end site library
 * @license MIT
 * Inline scripts may access the api using an async handler:
 *   var Webflow = Webflow || [];
 *   Webflow.push(readyFunction);
 */

(() => {
    var Uv = Object.create;
    var Cr = Object.defineProperty;
    var Hv = Object.getOwnPropertyDescriptor;
    var Bv = Object.getOwnPropertyNames;
    var Wv = Object.getPrototypeOf,
        zv = Object.prototype.hasOwnProperty;
    var ve = (e, t) => () => (e && (t = e(e = 0)), t);
    var d = (e, t) => () => (t || e((t = {
            exports: {}
        }).exports, t), t.exports),
        Pe = (e, t) => {
            for (var r in t) Cr(e, r, {
                get: t[r],
                enumerable: !0
            })
        },
        fa = (e, t, r, n) => {
            if (t && typeof t == "object" || typeof t == "function")
                for (let i of Bv(t)) !zv.call(e, i) && i !== r && Cr(e, i, {
                    get: () => t[i],
                    enumerable: !(n = Hv(t, i)) || n.enumerable
                });
            return e
        };
    var le = (e, t, r) => (r = e != null ? Uv(Wv(e)) : {}, fa(t || !e || !e.__esModule ? Cr(r, "default", {
            value: e,
            enumerable: !0
        }) : r, e)),
        Ye = e => fa(Cr({}, "__esModule", {
            value: !0
        }), e);
    var Bn = d(() => {
        "use strict";
        window.tram = function(e) {
            function t(c, y) {
                var A = new v.Bare;
                return A.init(c, y)
            }

            function r(c) {
                return c.replace(/[A-Z]/g, function(y) {
                    return "-" + y.toLowerCase()
                })
            }

            function n(c) {
                var y = parseInt(c.slice(1), 16),
                    A = y >> 16 & 255,
                    O = y >> 8 & 255,
                    w = 255 & y;
                return [A, O, w]
            }

            function i(c, y, A) {
                return "#" + (1 << 24 | c << 16 | y << 8 | A).toString(16).slice(1)
            }

            function o() {}

            function a(c, y) {
                l("Type warning: Expected: [" + c + "] Got: [" + typeof y + "] " + y)
            }

            function s(c, y, A) {
                l("Units do not match [" + c + "]: " + y + ", " + A)
            }

            function u(c, y, A) {
                if (y !== void 0 && (A = y), c === void 0) return A;
                var O = A;
                return Ge.test(c) || !Ce.test(c) ? O = parseInt(c, 10) : Ce.test(c) && (O = 1e3 * parseFloat(c)), 0 > O && (O = 0), O === O ? O : A
            }

            function l(c) {
                se.debug && window && window.console.warn(c)
            }

            function m(c) {
                for (var y = -1, A = c ? c.length : 0, O = []; ++y < A;) {
                    var w = c[y];
                    w && O.push(w)
                }
                return O
            }
            var f = function(c, y, A) {
                    function O(oe) {
                        return typeof oe == "object"
                    }

                    function w(oe) {
                        return typeof oe == "function"
                    }

                    function R() {}

                    function Q(oe, ge) {
                        function V() {
                            var xe = new ae;
                            return w(xe.init) && xe.init.apply(xe, arguments), xe
                        }

                        function ae() {}
                        ge === A && (ge = oe, oe = Object), V.Bare = ae;
                        var ue, _e = R[c] = oe[c],
                            je = ae[c] = V[c] = new R;
                        return je.constructor = V, V.mixin = function(xe) {
                            return ae[c] = V[c] = Q(V, xe)[c], V
                        }, V.open = function(xe) {
                            if (ue = {}, w(xe) ? ue = xe.call(V, je, _e, V, oe) : O(xe) && (ue = xe), O(ue))
                                for (var Zt in ue) y.call(ue, Zt) && (je[Zt] = ue[Zt]);
                            return w(je.init) || (je.init = oe), V
                        }, V.open(ge)
                    }
                    return Q
                }("prototype", {}.hasOwnProperty),
                g = {
                    ease: ["ease", function(c, y, A, O) {
                        var w = (c /= O) * c,
                            R = w * c;
                        return y + A * (-2.75 * R * w + 11 * w * w + -15.5 * R + 8 * w + .25 * c)
                    }],
                    "ease-in": ["ease-in", function(c, y, A, O) {
                        var w = (c /= O) * c,
                            R = w * c;
                        return y + A * (-1 * R * w + 3 * w * w + -3 * R + 2 * w)
                    }],
                    "ease-out": ["ease-out", function(c, y, A, O) {
                        var w = (c /= O) * c,
                            R = w * c;
                        return y + A * (.3 * R * w + -1.6 * w * w + 2.2 * R + -1.8 * w + 1.9 * c)
                    }],
                    "ease-in-out": ["ease-in-out", function(c, y, A, O) {
                        var w = (c /= O) * c,
                            R = w * c;
                        return y + A * (2 * R * w + -5 * w * w + 2 * R + 2 * w)
                    }],
                    linear: ["linear", function(c, y, A, O) {
                        return A * c / O + y
                    }],
                    "ease-in-quad": ["cubic-bezier(0.550, 0.085, 0.680, 0.530)", function(c, y, A, O) {
                        return A * (c /= O) * c + y
                    }],
                    "ease-out-quad": ["cubic-bezier(0.250, 0.460, 0.450, 0.940)", function(c, y, A, O) {
                        return -A * (c /= O) * (c - 2) + y
                    }],
                    "ease-in-out-quad": ["cubic-bezier(0.455, 0.030, 0.515, 0.955)", function(c, y, A, O) {
                        return (c /= O / 2) < 1 ? A / 2 * c * c + y : -A / 2 * (--c * (c - 2) - 1) + y
                    }],
                    "ease-in-cubic": ["cubic-bezier(0.550, 0.055, 0.675, 0.190)", function(c, y, A, O) {
                        return A * (c /= O) * c * c + y
                    }],
                    "ease-out-cubic": ["cubic-bezier(0.215, 0.610, 0.355, 1)", function(c, y, A, O) {
                        return A * ((c = c / O - 1) * c * c + 1) + y
                    }],
                    "ease-in-out-cubic": ["cubic-bezier(0.645, 0.045, 0.355, 1)", function(c, y, A, O) {
                        return (c /= O / 2) < 1 ? A / 2 * c * c * c + y : A / 2 * ((c -= 2) * c * c + 2) + y
                    }],
                    "ease-in-quart": ["cubic-bezier(0.895, 0.030, 0.685, 0.220)", function(c, y, A, O) {
                        return A * (c /= O) * c * c * c + y
                    }],
                    "ease-out-quart": ["cubic-bezier(0.165, 0.840, 0.440, 1)", function(c, y, A, O) {
                        return -A * ((c = c / O - 1) * c * c * c - 1) + y
                    }],
                    "ease-in-out-quart": ["cubic-bezier(0.770, 0, 0.175, 1)", function(c, y, A, O) {
                        return (c /= O / 2) < 1 ? A / 2 * c * c * c * c + y : -A / 2 * ((c -= 2) * c * c * c - 2) + y
                    }],
                    "ease-in-quint": ["cubic-bezier(0.755, 0.050, 0.855, 0.060)", function(c, y, A, O) {
                        return A * (c /= O) * c * c * c * c + y
                    }],
                    "ease-out-quint": ["cubic-bezier(0.230, 1, 0.320, 1)", function(c, y, A, O) {
                        return A * ((c = c / O - 1) * c * c * c * c + 1) + y
                    }],
                    "ease-in-out-quint": ["cubic-bezier(0.860, 0, 0.070, 1)", function(c, y, A, O) {
                        return (c /= O / 2) < 1 ? A / 2 * c * c * c * c * c + y : A / 2 * ((c -= 2) * c * c * c * c + 2) + y
                    }],
                    "ease-in-sine": ["cubic-bezier(0.470, 0, 0.745, 0.715)", function(c, y, A, O) {
                        return -A * Math.cos(c / O * (Math.PI / 2)) + A + y
                    }],
                    "ease-out-sine": ["cubic-bezier(0.390, 0.575, 0.565, 1)", function(c, y, A, O) {
                        return A * Math.sin(c / O * (Math.PI / 2)) + y
                    }],
                    "ease-in-out-sine": ["cubic-bezier(0.445, 0.050, 0.550, 0.950)", function(c, y, A, O) {
                        return -A / 2 * (Math.cos(Math.PI * c / O) - 1) + y
                    }],
                    "ease-in-expo": ["cubic-bezier(0.950, 0.050, 0.795, 0.035)", function(c, y, A, O) {
                        return c === 0 ? y : A * Math.pow(2, 10 * (c / O - 1)) + y
                    }],
                    "ease-out-expo": ["cubic-bezier(0.190, 1, 0.220, 1)", function(c, y, A, O) {
                        return c === O ? y + A : A * (-Math.pow(2, -10 * c / O) + 1) + y
                    }],
                    "ease-in-out-expo": ["cubic-bezier(1, 0, 0, 1)", function(c, y, A, O) {
                        return c === 0 ? y : c === O ? y + A : (c /= O / 2) < 1 ? A / 2 * Math.pow(2, 10 * (c - 1)) + y : A / 2 * (-Math.pow(2, -10 * --c) + 2) + y
                    }],
                    "ease-in-circ": ["cubic-bezier(0.600, 0.040, 0.980, 0.335)", function(c, y, A, O) {
                        return -A * (Math.sqrt(1 - (c /= O) * c) - 1) + y
                    }],
                    "ease-out-circ": ["cubic-bezier(0.075, 0.820, 0.165, 1)", function(c, y, A, O) {
                        return A * Math.sqrt(1 - (c = c / O - 1) * c) + y
                    }],
                    "ease-in-out-circ": ["cubic-bezier(0.785, 0.135, 0.150, 0.860)", function(c, y, A, O) {
                        return (c /= O / 2) < 1 ? -A / 2 * (Math.sqrt(1 - c * c) - 1) + y : A / 2 * (Math.sqrt(1 - (c -= 2) * c) + 1) + y
                    }],
                    "ease-in-back": ["cubic-bezier(0.600, -0.280, 0.735, 0.045)", function(c, y, A, O, w) {
                        return w === void 0 && (w = 1.70158), A * (c /= O) * c * ((w + 1) * c - w) + y
                    }],
                    "ease-out-back": ["cubic-bezier(0.175, 0.885, 0.320, 1.275)", function(c, y, A, O, w) {
                        return w === void 0 && (w = 1.70158), A * ((c = c / O - 1) * c * ((w + 1) * c + w) + 1) + y
                    }],
                    "ease-in-out-back": ["cubic-bezier(0.680, -0.550, 0.265, 1.550)", function(c, y, A, O, w) {
                        return w === void 0 && (w = 1.70158), (c /= O / 2) < 1 ? A / 2 * c * c * (((w *= 1.525) + 1) * c - w) + y : A / 2 * ((c -= 2) * c * (((w *= 1.525) + 1) * c + w) + 2) + y
                    }]
                },
                p = {
                    "ease-in-back": "cubic-bezier(0.600, 0, 0.735, 0.045)",
                    "ease-out-back": "cubic-bezier(0.175, 0.885, 0.320, 1)",
                    "ease-in-out-back": "cubic-bezier(0.680, 0, 0.265, 1)"
                },
                h = document,
                _ = window,
                T = "bkwld-tram",
                I = /[\-\.0-9]/g,
                C = /[A-Z]/,
                S = "number",
                P = /^(rgb|#)/,
                N = /(em|cm|mm|in|pt|pc|px)$/,
                L = /(em|cm|mm|in|pt|pc|px|%)$/,
                B = /(deg|rad|turn)$/,
                W = "unitless",
                z = /(all|none) 0s ease 0s/,
                $ = /^(width|height)$/,
                ie = " ",
                F = h.createElement("a"),
                x = ["Webkit", "Moz", "O", "ms"],
                D = ["-webkit-", "-moz-", "-o-", "-ms-"],
                U = function(c) {
                    if (c in F.style) return {
                        dom: c,
                        css: c
                    };
                    var y, A, O = "",
                        w = c.split("-");
                    for (y = 0; y < w.length; y++) O += w[y].charAt(0).toUpperCase() + w[y].slice(1);
                    for (y = 0; y < x.length; y++)
                        if (A = x[y] + O, A in F.style) return {
                            dom: A,
                            css: D[y] + c
                        }
                },
                q = t.support = {
                    bind: Function.prototype.bind,
                    transform: U("transform"),
                    transition: U("transition"),
                    backface: U("backface-visibility"),
                    timing: U("transition-timing-function")
                };
            if (q.transition) {
                var Z = q.timing.dom;
                if (F.style[Z] = g["ease-in-back"][0], !F.style[Z])
                    for (var re in p) g[re][0] = p[re]
            }
            var M = t.frame = function() {
                    var c = _.requestAnimationFrame || _.webkitRequestAnimationFrame || _.mozRequestAnimationFrame || _.oRequestAnimationFrame || _.msRequestAnimationFrame;
                    return c && q.bind ? c.bind(_) : function(y) {
                        _.setTimeout(y, 16)
                    }
                }(),
                X = t.now = function() {
                    var c = _.performance,
                        y = c && (c.now || c.webkitNow || c.msNow || c.mozNow);
                    return y && q.bind ? y.bind(c) : Date.now || function() {
                        return +new Date
                    }
                }(),
                j = f(function(c) {
                    function y(te, ce) {
                        var me = m(("" + te).split(ie)),
                            de = me[0];
                        ce = ce || {};
                        var Se = H[de];
                        if (!Se) return l("Unsupported property: " + de);
                        if (!ce.weak || !this.props[de]) {
                            var Ve = Se[0],
                                Le = this.props[de];
                            return Le || (Le = this.props[de] = new Ve.Bare), Le.init(this.$el, me, Se, ce), Le
                        }
                    }

                    function A(te, ce, me) {
                        if (te) {
                            var de = typeof te;
                            if (ce || (this.timer && this.timer.destroy(), this.queue = [], this.active = !1), de == "number" && ce) return this.timer = new J({
                                duration: te,
                                context: this,
                                complete: R
                            }), void(this.active = !0);
                            if (de == "string" && ce) {
                                switch (te) {
                                    case "hide":
                                        V.call(this);
                                        break;
                                    case "stop":
                                        Q.call(this);
                                        break;
                                    case "redraw":
                                        ae.call(this);
                                        break;
                                    default:
                                        y.call(this, te, me && me[1])
                                }
                                return R.call(this)
                            }
                            if (de == "function") return void te.call(this, this);
                            if (de == "object") {
                                var Se = 0;
                                je.call(this, te, function(Ie, Vv) {
                                    Ie.span > Se && (Se = Ie.span), Ie.stop(), Ie.animate(Vv)
                                }, function(Ie) {
                                    "wait" in Ie && (Se = u(Ie.wait, 0))
                                }), _e.call(this), Se > 0 && (this.timer = new J({
                                    duration: Se,
                                    context: this
                                }), this.active = !0, ce && (this.timer.complete = R));
                                var Ve = this,
                                    Le = !1,
                                    Rr = {};
                                M(function() {
                                    je.call(Ve, te, function(Ie) {
                                        Ie.active && (Le = !0, Rr[Ie.name] = Ie.nextStyle)
                                    }), Le && Ve.$el.css(Rr)
                                })
                            }
                        }
                    }

                    function O(te) {
                        te = u(te, 0), this.active ? this.queue.push({
                            options: te
                        }) : (this.timer = new J({
                            duration: te,
                            context: this,
                            complete: R
                        }), this.active = !0)
                    }

                    function w(te) {
                        return this.active ? (this.queue.push({
                            options: te,
                            args: arguments
                        }), void(this.timer.complete = R)) : l("No active transition timer. Use start() or wait() before then().")
                    }

                    function R() {
                        if (this.timer && this.timer.destroy(), this.active = !1, this.queue.length) {
                            var te = this.queue.shift();
                            A.call(this, te.options, !0, te.args)
                        }
                    }

                    function Q(te) {
                        this.timer && this.timer.destroy(), this.queue = [], this.active = !1;
                        var ce;
                        typeof te == "string" ? (ce = {}, ce[te] = 1) : ce = typeof te == "object" && te != null ? te : this.props, je.call(this, ce, xe), _e.call(this)
                    }

                    function oe(te) {
                        Q.call(this, te), je.call(this, te, Zt, Gv)
                    }

                    function ge(te) {
                        typeof te != "string" && (te = "block"), this.el.style.display = te
                    }

                    function V() {
                        Q.call(this), this.el.style.display = "none"
                    }

                    function ae() {
                        this.el.offsetHeight
                    }

                    function ue() {
                        Q.call(this), e.removeData(this.el, T), this.$el = this.el = null
                    }

                    function _e() {
                        var te, ce, me = [];
                        this.upstream && me.push(this.upstream);
                        for (te in this.props) ce = this.props[te], ce.active && me.push(ce.string);
                        me = me.join(","), this.style !== me && (this.style = me, this.el.style[q.transition.dom] = me)
                    }

                    function je(te, ce, me) {
                        var de, Se, Ve, Le, Rr = ce !== xe,
                            Ie = {};
                        for (de in te) Ve = te[de], de in fe ? (Ie.transform || (Ie.transform = {}), Ie.transform[de] = Ve) : (C.test(de) && (de = r(de)), de in H ? Ie[de] = Ve : (Le || (Le = {}), Le[de] = Ve));
                        for (de in Ie) {
                            if (Ve = Ie[de], Se = this.props[de], !Se) {
                                if (!Rr) continue;
                                Se = y.call(this, de)
                            }
                            ce.call(this, Se, Ve)
                        }
                        me && Le && me.call(this, Le)
                    }

                    function xe(te) {
                        te.stop()
                    }

                    function Zt(te, ce) {
                        te.set(ce)
                    }

                    function Gv(te) {
                        this.$el.css(te)
                    }

                    function ke(te, ce) {
                        c[te] = function() {
                            return this.children ? kv.call(this, ce, arguments) : (this.el && ce.apply(this, arguments), this)
                        }
                    }

                    function kv(te, ce) {
                        var me, de = this.children.length;
                        for (me = 0; de > me; me++) te.apply(this.children[me], ce);
                        return this
                    }
                    c.init = function(te) {
                        if (this.$el = e(te), this.el = this.$el[0], this.props = {}, this.queue = [], this.style = "", this.active = !1, se.keepInherited && !se.fallback) {
                            var ce = G(this.el, "transition");
                            ce && !z.test(ce) && (this.upstream = ce)
                        }
                        q.backface && se.hideBackface && E(this.el, q.backface.css, "hidden")
                    }, ke("add", y), ke("start", A), ke("wait", O), ke("then", w), ke("next", R), ke("stop", Q), ke("set", oe), ke("show", ge), ke("hide", V), ke("redraw", ae), ke("destroy", ue)
                }),
                v = f(j, function(c) {
                    function y(A, O) {
                        var w = e.data(A, T) || e.data(A, T, new j.Bare);
                        return w.el || w.init(A), O ? w.start(O) : w
                    }
                    c.init = function(A, O) {
                        var w = e(A);
                        if (!w.length) return this;
                        if (w.length === 1) return y(w[0], O);
                        var R = [];
                        return w.each(function(Q, oe) {
                            R.push(y(oe, O))
                        }), this.children = R, this
                    }
                }),
                b = f(function(c) {
                    function y() {
                        var R = this.get();
                        this.update("auto");
                        var Q = this.get();
                        return this.update(R), Q
                    }

                    function A(R, Q, oe) {
                        return Q !== void 0 && (oe = Q), R in g ? R : oe
                    }

                    function O(R) {
                        var Q = /rgba?\((\d+),\s*(\d+),\s*(\d+)/.exec(R);
                        return (Q ? i(Q[1], Q[2], Q[3]) : R).replace(/#(\w)(\w)(\w)$/, "#$1$1$2$2$3$3")
                    }
                    var w = {
                        duration: 500,
                        ease: "ease",
                        delay: 0
                    };
                    c.init = function(R, Q, oe, ge) {
                        this.$el = R, this.el = R[0];
                        var V = Q[0];
                        oe[2] && (V = oe[2]), K[V] && (V = K[V]), this.name = V, this.type = oe[1], this.duration = u(Q[1], this.duration, w.duration), this.ease = A(Q[2], this.ease, w.ease), this.delay = u(Q[3], this.delay, w.delay), this.span = this.duration + this.delay, this.active = !1, this.nextStyle = null, this.auto = $.test(this.name), this.unit = ge.unit || this.unit || se.defaultUnit, this.angle = ge.angle || this.angle || se.defaultAngle, se.fallback || ge.fallback ? this.animate = this.fallback : (this.animate = this.transition, this.string = this.name + ie + this.duration + "ms" + (this.ease != "ease" ? ie + g[this.ease][0] : "") + (this.delay ? ie + this.delay + "ms" : ""))
                    }, c.set = function(R) {
                        R = this.convert(R, this.type), this.update(R), this.redraw()
                    }, c.transition = function(R) {
                        this.active = !0, R = this.convert(R, this.type), this.auto && (this.el.style[this.name] == "auto" && (this.update(this.get()), this.redraw()), R == "auto" && (R = y.call(this))), this.nextStyle = R
                    }, c.fallback = function(R) {
                        var Q = this.el.style[this.name] || this.convert(this.get(), this.type);
                        R = this.convert(R, this.type), this.auto && (Q == "auto" && (Q = this.convert(this.get(), this.type)), R == "auto" && (R = y.call(this))), this.tween = new Y({
                            from: Q,
                            to: R,
                            duration: this.duration,
                            delay: this.delay,
                            ease: this.ease,
                            update: this.update,
                            context: this
                        })
                    }, c.get = function() {
                        return G(this.el, this.name)
                    }, c.update = function(R) {
                        E(this.el, this.name, R)
                    }, c.stop = function() {
                        (this.active || this.nextStyle) && (this.active = !1, this.nextStyle = null, E(this.el, this.name, this.get()));
                        var R = this.tween;
                        R && R.context && R.destroy()
                    }, c.convert = function(R, Q) {
                        if (R == "auto" && this.auto) return R;
                        var oe, ge = typeof R == "number",
                            V = typeof R == "string";
                        switch (Q) {
                            case S:
                                if (ge) return R;
                                if (V && R.replace(I, "") === "") return +R;
                                oe = "number(unitless)";
                                break;
                            case P:
                                if (V) {
                                    if (R === "" && this.original) return this.original;
                                    if (Q.test(R)) return R.charAt(0) == "#" && R.length == 7 ? R : O(R)
                                }
                                oe = "hex or rgb string";
                                break;
                            case N:
                                if (ge) return R + this.unit;
                                if (V && Q.test(R)) return R;
                                oe = "number(px) or string(unit)";
                                break;
                            case L:
                                if (ge) return R + this.unit;
                                if (V && Q.test(R)) return R;
                                oe = "number(px) or string(unit or %)";
                                break;
                            case B:
                                if (ge) return R + this.angle;
                                if (V && Q.test(R)) return R;
                                oe = "number(deg) or string(angle)";
                                break;
                            case W:
                                if (ge || V && L.test(R)) return R;
                                oe = "number(unitless) or string(unit or %)"
                        }
                        return a(oe, R), R
                    }, c.redraw = function() {
                        this.el.offsetHeight
                    }
                }),
                k = f(b, function(c, y) {
                    c.init = function() {
                        y.init.apply(this, arguments), this.original || (this.original = this.convert(this.get(), P))
                    }
                }),
                ee = f(b, function(c, y) {
                    c.init = function() {
                        y.init.apply(this, arguments), this.animate = this.fallback
                    }, c.get = function() {
                        return this.$el[this.name]()
                    }, c.update = function(A) {
                        this.$el[this.name](A)
                    }
                }),
                ne = f(b, function(c, y) {
                    function A(O, w) {
                        var R, Q, oe, ge, V;
                        for (R in O) ge = fe[R], oe = ge[0], Q = ge[1] || R, V = this.convert(O[R], oe), w.call(this, Q, V, oe)
                    }
                    c.init = function() {
                        y.init.apply(this, arguments), this.current || (this.current = {}, fe.perspective && se.perspective && (this.current.perspective = se.perspective, E(this.el, this.name, this.style(this.current)), this.redraw()))
                    }, c.set = function(O) {
                        A.call(this, O, function(w, R) {
                            this.current[w] = R
                        }), E(this.el, this.name, this.style(this.current)), this.redraw()
                    }, c.transition = function(O) {
                        var w = this.values(O);
                        this.tween = new ye({
                            current: this.current,
                            values: w,
                            duration: this.duration,
                            delay: this.delay,
                            ease: this.ease
                        });
                        var R, Q = {};
                        for (R in this.current) Q[R] = R in w ? w[R] : this.current[R];
                        this.active = !0, this.nextStyle = this.style(Q)
                    }, c.fallback = function(O) {
                        var w = this.values(O);
                        this.tween = new ye({
                            current: this.current,
                            values: w,
                            duration: this.duration,
                            delay: this.delay,
                            ease: this.ease,
                            update: this.update,
                            context: this
                        })
                    }, c.update = function() {
                        E(this.el, this.name, this.style(this.current))
                    }, c.style = function(O) {
                        var w, R = "";
                        for (w in O) R += w + "(" + O[w] + ") ";
                        return R
                    }, c.values = function(O) {
                        var w, R = {};
                        return A.call(this, O, function(Q, oe, ge) {
                            R[Q] = oe, this.current[Q] === void 0 && (w = 0, ~Q.indexOf("scale") && (w = 1), this.current[Q] = this.convert(w, ge))
                        }), R
                    }
                }),
                Y = f(function(c) {
                    function y(V) {
                        oe.push(V) === 1 && M(A)
                    }

                    function A() {
                        var V, ae, ue, _e = oe.length;
                        if (_e)
                            for (M(A), ae = X(), V = _e; V--;) ue = oe[V], ue && ue.render(ae)
                    }

                    function O(V) {
                        var ae, ue = e.inArray(V, oe);
                        ue >= 0 && (ae = oe.slice(ue + 1), oe.length = ue, ae.length && (oe = oe.concat(ae)))
                    }

                    function w(V) {
                        return Math.round(V * ge) / ge
                    }

                    function R(V, ae, ue) {
                        return i(V[0] + ue * (ae[0] - V[0]), V[1] + ue * (ae[1] - V[1]), V[2] + ue * (ae[2] - V[2]))
                    }
                    var Q = {
                        ease: g.ease[1],
                        from: 0,
                        to: 1
                    };
                    c.init = function(V) {
                        this.duration = V.duration || 0, this.delay = V.delay || 0;
                        var ae = V.ease || Q.ease;
                        g[ae] && (ae = g[ae][1]), typeof ae != "function" && (ae = Q.ease), this.ease = ae, this.update = V.update || o, this.complete = V.complete || o, this.context = V.context || this, this.name = V.name;
                        var ue = V.from,
                            _e = V.to;
                        ue === void 0 && (ue = Q.from), _e === void 0 && (_e = Q.to), this.unit = V.unit || "", typeof ue == "number" && typeof _e == "number" ? (this.begin = ue, this.change = _e - ue) : this.format(_e, ue), this.value = this.begin + this.unit, this.start = X(), V.autoplay !== !1 && this.play()
                    }, c.play = function() {
                        this.active || (this.start || (this.start = X()), this.active = !0, y(this))
                    }, c.stop = function() {
                        this.active && (this.active = !1, O(this))
                    }, c.render = function(V) {
                        var ae, ue = V - this.start;
                        if (this.delay) {
                            if (ue <= this.delay) return;
                            ue -= this.delay
                        }
                        if (ue < this.duration) {
                            var _e = this.ease(ue, 0, 1, this.duration);
                            return ae = this.startRGB ? R(this.startRGB, this.endRGB, _e) : w(this.begin + _e * this.change), this.value = ae + this.unit, void this.update.call(this.context, this.value)
                        }
                        ae = this.endHex || this.begin + this.change, this.value = ae + this.unit, this.update.call(this.context, this.value), this.complete.call(this.context), this.destroy()
                    }, c.format = function(V, ae) {
                        if (ae += "", V += "", V.charAt(0) == "#") return this.startRGB = n(ae), this.endRGB = n(V), this.endHex = V, this.begin = 0, void(this.change = 1);
                        if (!this.unit) {
                            var ue = ae.replace(I, ""),
                                _e = V.replace(I, "");
                            ue !== _e && s("tween", ae, V), this.unit = ue
                        }
                        ae = parseFloat(ae), V = parseFloat(V), this.begin = this.value = ae, this.change = V - ae
                    }, c.destroy = function() {
                        this.stop(), this.context = null, this.ease = this.update = this.complete = o
                    };
                    var oe = [],
                        ge = 1e3
                }),
                J = f(Y, function(c) {
                    c.init = function(y) {
                        this.duration = y.duration || 0, this.complete = y.complete || o, this.context = y.context, this.play()
                    }, c.render = function(y) {
                        var A = y - this.start;
                        A < this.duration || (this.complete.call(this.context), this.destroy())
                    }
                }),
                ye = f(Y, function(c, y) {
                    c.init = function(A) {
                        this.context = A.context, this.update = A.update, this.tweens = [], this.current = A.current;
                        var O, w;
                        for (O in A.values) w = A.values[O], this.current[O] !== w && this.tweens.push(new Y({
                            name: O,
                            from: this.current[O],
                            to: w,
                            duration: A.duration,
                            delay: A.delay,
                            ease: A.ease,
                            autoplay: !1
                        }));
                        this.play()
                    }, c.render = function(A) {
                        var O, w, R = this.tweens.length,
                            Q = !1;
                        for (O = R; O--;) w = this.tweens[O], w.context && (w.render(A), this.current[w.name] = w.value, Q = !0);
                        return Q ? void(this.update && this.update.call(this.context)) : this.destroy()
                    }, c.destroy = function() {
                        if (y.destroy.call(this), this.tweens) {
                            var A, O = this.tweens.length;
                            for (A = O; A--;) this.tweens[A].destroy();
                            this.tweens = null, this.current = null
                        }
                    }
                }),
                se = t.config = {
                    debug: !1,
                    defaultUnit: "px",
                    defaultAngle: "deg",
                    keepInherited: !1,
                    hideBackface: !1,
                    perspective: "",
                    fallback: !q.transition,
                    agentTests: []
                };
            t.fallback = function(c) {
                if (!q.transition) return se.fallback = !0;
                se.agentTests.push("(" + c + ")");
                var y = new RegExp(se.agentTests.join("|"), "i");
                se.fallback = y.test(navigator.userAgent)
            }, t.fallback("6.0.[2-5] Safari"), t.tween = function(c) {
                return new Y(c)
            }, t.delay = function(c, y, A) {
                return new J({
                    complete: y,
                    duration: c,
                    context: A
                })
            }, e.fn.tram = function(c) {
                return t.call(null, this, c)
            };
            var E = e.style,
                G = e.css,
                K = {
                    transform: q.transform && q.transform.css
                },
                H = {
                    color: [k, P],
                    background: [k, P, "background-color"],
                    "outline-color": [k, P],
                    "border-color": [k, P],
                    "border-top-color": [k, P],
                    "border-right-color": [k, P],
                    "border-bottom-color": [k, P],
                    "border-left-color": [k, P],
                    "border-width": [b, N],
                    "border-top-width": [b, N],
                    "border-right-width": [b, N],
                    "border-bottom-width": [b, N],
                    "border-left-width": [b, N],
                    "border-spacing": [b, N],
                    "letter-spacing": [b, N],
                    margin: [b, N],
                    "margin-top": [b, N],
                    "margin-right": [b, N],
                    "margin-bottom": [b, N],
                    "margin-left": [b, N],
                    padding: [b, N],
                    "padding-top": [b, N],
                    "padding-right": [b, N],
                    "padding-bottom": [b, N],
                    "padding-left": [b, N],
                    "outline-width": [b, N],
                    opacity: [b, S],
                    top: [b, L],
                    right: [b, L],
                    bottom: [b, L],
                    left: [b, L],
                    "font-size": [b, L],
                    "text-indent": [b, L],
                    "word-spacing": [b, L],
                    width: [b, L],
                    "min-width": [b, L],
                    "max-width": [b, L],
                    height: [b, L],
                    "min-height": [b, L],
                    "max-height": [b, L],
                    "line-height": [b, W],
                    "scroll-top": [ee, S, "scrollTop"],
                    "scroll-left": [ee, S, "scrollLeft"]
                },
                fe = {};
            q.transform && (H.transform = [ne], fe = {
                x: [L, "translateX"],
                y: [L, "translateY"],
                rotate: [B],
                rotateX: [B],
                rotateY: [B],
                scale: [S],
                scaleX: [S],
                scaleY: [S],
                skew: [B],
                skewX: [B],
                skewY: [B]
            }), q.transform && q.backface && (fe.z = [L, "translateZ"], fe.rotateZ = [B], fe.scaleZ = [S], fe.perspective = [N]);
            var Ge = /ms/,
                Ce = /s|\./;
            return e.tram = t
        }(window.jQuery)
    });
    var pa = d((yF, da) => {
        "use strict";
        var Kv = window.$,
            jv = Bn() && Kv.tram;
        da.exports = function() {
            var e = {};
            e.VERSION = "1.6.0-Webflow";
            var t = {},
                r = Array.prototype,
                n = Object.prototype,
                i = Function.prototype,
                o = r.push,
                a = r.slice,
                s = r.concat,
                u = n.toString,
                l = n.hasOwnProperty,
                m = r.forEach,
                f = r.map,
                g = r.reduce,
                p = r.reduceRight,
                h = r.filter,
                _ = r.every,
                T = r.some,
                I = r.indexOf,
                C = r.lastIndexOf,
                S = Array.isArray,
                P = Object.keys,
                N = i.bind,
                L = e.each = e.forEach = function(x, D, U) {
                    if (x == null) return x;
                    if (m && x.forEach === m) x.forEach(D, U);
                    else if (x.length === +x.length) {
                        for (var q = 0, Z = x.length; q < Z; q++)
                            if (D.call(U, x[q], q, x) === t) return
                    } else
                        for (var re = e.keys(x), q = 0, Z = re.length; q < Z; q++)
                            if (D.call(U, x[re[q]], re[q], x) === t) return;
                    return x
                };
            e.map = e.collect = function(x, D, U) {
                var q = [];
                return x == null ? q : f && x.map === f ? x.map(D, U) : (L(x, function(Z, re, M) {
                    q.push(D.call(U, Z, re, M))
                }), q)
            }, e.find = e.detect = function(x, D, U) {
                var q;
                return B(x, function(Z, re, M) {
                    if (D.call(U, Z, re, M)) return q = Z, !0
                }), q
            }, e.filter = e.select = function(x, D, U) {
                var q = [];
                return x == null ? q : h && x.filter === h ? x.filter(D, U) : (L(x, function(Z, re, M) {
                    D.call(U, Z, re, M) && q.push(Z)
                }), q)
            };
            var B = e.some = e.any = function(x, D, U) {
                D || (D = e.identity);
                var q = !1;
                return x == null ? q : T && x.some === T ? x.some(D, U) : (L(x, function(Z, re, M) {
                    if (q || (q = D.call(U, Z, re, M))) return t
                }), !!q)
            };
            e.contains = e.include = function(x, D) {
                return x == null ? !1 : I && x.indexOf === I ? x.indexOf(D) != -1 : B(x, function(U) {
                    return U === D
                })
            }, e.delay = function(x, D) {
                var U = a.call(arguments, 2);
                return setTimeout(function() {
                    return x.apply(null, U)
                }, D)
            }, e.defer = function(x) {
                return e.delay.apply(e, [x, 1].concat(a.call(arguments, 1)))
            }, e.throttle = function(x) {
                var D, U, q;
                return function() {
                    D || (D = !0, U = arguments, q = this, jv.frame(function() {
                        D = !1, x.apply(q, U)
                    }))
                }
            }, e.debounce = function(x, D, U) {
                var q, Z, re, M, X, j = function() {
                    var v = e.now() - M;
                    v < D ? q = setTimeout(j, D - v) : (q = null, U || (X = x.apply(re, Z), re = Z = null))
                };
                return function() {
                    re = this, Z = arguments, M = e.now();
                    var v = U && !q;
                    return q || (q = setTimeout(j, D)), v && (X = x.apply(re, Z), re = Z = null), X
                }
            }, e.defaults = function(x) {
                if (!e.isObject(x)) return x;
                for (var D = 1, U = arguments.length; D < U; D++) {
                    var q = arguments[D];
                    for (var Z in q) x[Z] === void 0 && (x[Z] = q[Z])
                }
                return x
            }, e.keys = function(x) {
                if (!e.isObject(x)) return [];
                if (P) return P(x);
                var D = [];
                for (var U in x) e.has(x, U) && D.push(U);
                return D
            }, e.has = function(x, D) {
                return l.call(x, D)
            }, e.isObject = function(x) {
                return x === Object(x)
            }, e.now = Date.now || function() {
                return new Date().getTime()
            }, e.templateSettings = {
                evaluate: /<%([\s\S]+?)%>/g,
                interpolate: /<%=([\s\S]+?)%>/g,
                escape: /<%-([\s\S]+?)%>/g
            };
            var W = /(.)^/,
                z = {
                    "'": "'",
                    "\\": "\\",
                    "\r": "r",
                    "\n": "n",
                    "\u2028": "u2028",
                    "\u2029": "u2029"
                },
                $ = /\\|'|\r|\n|\u2028|\u2029/g,
                ie = function(x) {
                    return "\\" + z[x]
                },
                F = /^\s*(\w|\$)+\s*$/;
            return e.template = function(x, D, U) {
                !D && U && (D = U), D = e.defaults({}, D, e.templateSettings);
                var q = RegExp([(D.escape || W).source, (D.interpolate || W).source, (D.evaluate || W).source].join("|") + "|$", "g"),
                    Z = 0,
                    re = "__p+='";
                x.replace(q, function(v, b, k, ee, ne) {
                    return re += x.slice(Z, ne).replace($, ie), Z = ne + v.length, b ? re += `'+
((__t=(` + b + `))==null?'':_.escape(__t))+
'` : k ? re += `'+
((__t=(` + k + `))==null?'':__t)+
'` : ee && (re += `';
` + ee + `
__p+='`), v
                }), re += `';
`;
                var M = D.variable;
                if (M) {
                    if (!F.test(M)) throw new Error("variable is not a bare identifier: " + M)
                } else re = `with(obj||{}){
` + re + `}
`, M = "obj";
                re = `var __t,__p='',__j=Array.prototype.join,print=function(){__p+=__j.call(arguments,'');};
` + re + `return __p;
`;
                var X;
                try {
                    X = new Function(D.variable || "obj", "_", re)
                } catch (v) {
                    throw v.source = re, v
                }
                var j = function(v) {
                    return X.call(this, v, e)
                };
                return j.source = "function(" + M + `){
` + re + "}", j
            }, e
        }()
    });
    var qe = d((_F, Ia) => {
        "use strict";
        var pe = {},
            Tt = {},
            wt = [],
            zn = window.Webflow || [],
            ut = window.jQuery,
            He = ut(window),
            Yv = ut(document),
            Qe = ut.isFunction,
            Ue = pe._ = pa(),
            ha = pe.tram = Bn() && ut.tram,
            Pr = !1,
            Kn = !1;
        ha.config.hideBackface = !1;
        ha.config.keepInherited = !0;
        pe.define = function(e, t, r) {
            Tt[e] && ma(Tt[e]);
            var n = Tt[e] = t(ut, Ue, r) || {};
            return va(n), n
        };
        pe.require = function(e) {
            return Tt[e]
        };

        function va(e) {
            pe.env() && (Qe(e.design) && He.on("__wf_design", e.design), Qe(e.preview) && He.on("__wf_preview", e.preview)), Qe(e.destroy) && He.on("__wf_destroy", e.destroy), e.ready && Qe(e.ready) && Qv(e)
        }

        function Qv(e) {
            if (Pr) {
                e.ready();
                return
            }
            Ue.contains(wt, e.ready) || wt.push(e.ready)
        }

        function ma(e) {
            Qe(e.design) && He.off("__wf_design", e.design), Qe(e.preview) && He.off("__wf_preview", e.preview), Qe(e.destroy) && He.off("__wf_destroy", e.destroy), e.ready && Qe(e.ready) && $v(e)
        }

        function $v(e) {
            wt = Ue.filter(wt, function(t) {
                return t !== e.ready
            })
        }
        pe.push = function(e) {
            if (Pr) {
                Qe(e) && e();
                return
            }
            zn.push(e)
        };
        pe.env = function(e) {
            var t = window.__wf_design,
                r = typeof t < "u";
            if (!e) return r;
            if (e === "design") return r && t;
            if (e === "preview") return r && !t;
            if (e === "slug") return r && window.__wf_slug;
            if (e === "editor") return window.WebflowEditor;
            if (e === "test") return window.__wf_test;
            if (e === "frame") return window !== window.top
        };
        var Lr = navigator.userAgent.toLowerCase(),
            Ea = pe.env.touch = "ontouchstart" in window || window.DocumentTouch && document instanceof window.DocumentTouch,
            Zv = pe.env.chrome = /chrome/.test(Lr) && /Google/.test(navigator.vendor) && parseInt(Lr.match(/chrome\/(\d+)\./)[1], 10),
            Jv = pe.env.ios = /(ipod|iphone|ipad)/.test(Lr);
        pe.env.safari = /safari/.test(Lr) && !Zv && !Jv;
        var Wn;
        Ea && Yv.on("touchstart mousedown", function(e) {
            Wn = e.target
        });
        pe.validClick = Ea ? function(e) {
            return e === Wn || ut.contains(e, Wn)
        } : function() {
            return !0
        };
        var ya = "resize.webflow orientationchange.webflow load.webflow",
            em = "scroll.webflow " + ya;
        pe.resize = jn(He, ya);
        pe.scroll = jn(He, em);
        pe.redraw = jn();

        function jn(e, t) {
            var r = [],
                n = {};
            return n.up = Ue.throttle(function(i) {
                Ue.each(r, function(o) {
                    o(i)
                })
            }), e && t && e.on(t, n.up), n.on = function(i) {
                typeof i == "function" && (Ue.contains(r, i) || r.push(i))
            }, n.off = function(i) {
                if (!arguments.length) {
                    r = [];
                    return
                }
                r = Ue.filter(r, function(o) {
                    return o !== i
                })
            }, n
        }
        pe.location = function(e) {
            window.location = e
        };
        pe.env() && (pe.location = function() {});
        pe.ready = function() {
            Pr = !0, Kn ? tm() : Ue.each(wt, ga), Ue.each(zn, ga), pe.resize.up()
        };

        function ga(e) {
            Qe(e) && e()
        }

        function tm() {
            Kn = !1, Ue.each(Tt, va)
        }
        var ht;
        pe.load = function(e) {
            ht.then(e)
        };

        function _a() {
            ht && (ht.reject(), He.off("load", ht.resolve)), ht = new ut.Deferred, He.on("load", ht.resolve)
        }
        pe.destroy = function(e) {
            e = e || {}, Kn = !0, He.triggerHandler("__wf_destroy"), e.domready != null && (Pr = e.domready), Ue.each(Tt, ma), pe.resize.off(), pe.scroll.off(), pe.redraw.off(), wt = [], zn = [], ht.state() === "pending" && _a()
        };
        ut(pe.ready);
        _a();
        Ia.exports = window.Webflow = pe
    });
    var wa = d((IF, Ta) => {
        "use strict";
        var ba = qe();
        ba.define("brand", Ta.exports = function(e) {
            var t = {},
                r = document,
                n = e("html"),
                i = e("body"),
                o = ".w-webflow-badge",
                a = window.location,
                s = /PhantomJS/i.test(navigator.userAgent),
                u = "fullscreenchange webkitfullscreenchange mozfullscreenchange msfullscreenchange",
                l;
            t.ready = function() {
                var p = n.attr("data-wf-status"),
                    h = n.attr("data-wf-domain") || "";
                /\.webflow\.io$/i.test(h) && a.hostname !== h && (p = !0), p && !s && (l = l || f(), g(), setTimeout(g, 500), e(r).off(u, m).on(u, m))
            };

            function m() {
                var p = r.fullScreen || r.mozFullScreen || r.webkitIsFullScreen || r.msFullscreenElement || !!r.webkitFullscreenElement;
                e(l).attr("style", p ? "display: none !important;" : "")
            }

            function f() {
                var p = e('<a class="w-webflow-badge"></a>').attr("href", "https://webflow.com?utm_campaign=brandjs"),
                    h = e("<img>").attr("src", "https://d3e54v103j8qbb.cloudfront.net/img/webflow-badge-icon-d2.89e12c322e.svg").attr("alt", "").css({
                        marginRight: "4px",
                        width: "26px"
                    }),
                    _ = e("<img>").attr("src", "https://d3e54v103j8qbb.cloudfront.net/img/webflow-badge-text-d2.c82cec3b78.svg").attr("alt", "Made in Webflow");
                return p.append(h, _), p[0]
            }

            function g() {
                var p = i.children(o),
                    h = p.length && p.get(0) === l,
                    _ = ba.env("editor");
                if (h) {
                    _ && p.remove();
                    return
                }
                p.length && p.remove(), _ || i.append(l)
            }
            return t
        })
    });
    var xa = d((bF, Aa) => {
        "use strict";
        var Yn = qe();
        Yn.define("edit", Aa.exports = function(e, t, r) {
            if (r = r || {}, (Yn.env("test") || Yn.env("frame")) && !r.fixture && !rm()) return {
                exit: 1
            };
            var n = {},
                i = e(window),
                o = e(document.documentElement),
                a = document.location,
                s = "hashchange",
                u, l = r.load || g,
                m = !1;
            try {
                m = localStorage && localStorage.getItem && localStorage.getItem("WebflowEditor")
            } catch {}
            m ? l() : a.search ? (/[?&](edit)(?:[=&?]|$)/.test(a.search) || /\?edit$/.test(a.href)) && l() : i.on(s, f).triggerHandler(s);

            function f() {
                u || /\?edit/.test(a.hash) && l()
            }

            function g() {
                u = !0, window.WebflowEditor = !0, i.off(s, f), C(function(P) {
                    e.ajax({
                        url: I("https://editor-api.webflow.com/api/editor/view"),
                        data: {
                            siteId: o.attr("data-wf-site")
                        },
                        xhrFields: {
                            withCredentials: !0
                        },
                        dataType: "json",
                        crossDomain: !0,
                        success: p(P)
                    })
                })
            }

            function p(P) {
                return function(N) {
                    if (!N) {
                        console.error("Could not load editor data");
                        return
                    }
                    N.thirdPartyCookiesSupported = P, h(T(N.scriptPath), function() {
                        window.WebflowEditor(N)
                    })
                }
            }

            function h(P, N) {
                e.ajax({
                    type: "GET",
                    url: P,
                    dataType: "script",
                    cache: !0
                }).then(N, _)
            }

            function _(P, N, L) {
                throw console.error("Could not load editor script: " + N), L
            }

            function T(P) {
                return P.indexOf("//") >= 0 ? P : I("https://editor-api.webflow.com" + P)
            }

            function I(P) {
                return P.replace(/([^:])\/\//g, "$1/")
            }

            function C(P) {
                var N = window.document.createElement("iframe");
                N.src = "https://webflow.com/site/third-party-cookie-check.html", N.style.display = "none", N.sandbox = "allow-scripts allow-same-origin";
                var L = function(B) {
                    B.data === "WF_third_party_cookies_unsupported" ? (S(N, L), P(!1)) : B.data === "WF_third_party_cookies_supported" && (S(N, L), P(!0))
                };
                N.onerror = function() {
                    S(N, L), P(!1)
                }, window.addEventListener("message", L, !1), window.document.body.appendChild(N)
            }

            function S(P, N) {
                window.removeEventListener("message", N, !1), P.remove()
            }
            return n
        });

        function rm() {
            try {
                return window.top.__Cypress__
            } catch {
                return !1
            }
        }
    });
    var Oa = d((TF, Sa) => {
        "use strict";
        var nm = qe();
        nm.define("focus-visible", Sa.exports = function() {
            function e(r) {
                var n = !0,
                    i = !1,
                    o = null,
                    a = {
                        text: !0,
                        search: !0,
                        url: !0,
                        tel: !0,
                        email: !0,
                        password: !0,
                        number: !0,
                        date: !0,
                        month: !0,
                        week: !0,
                        time: !0,
                        datetime: !0,
                        "datetime-local": !0
                    };

                function s(S) {
                    return !!(S && S !== document && S.nodeName !== "HTML" && S.nodeName !== "BODY" && "classList" in S && "contains" in S.classList)
                }

                function u(S) {
                    var P = S.type,
                        N = S.tagName;
                    return !!(N === "INPUT" && a[P] && !S.readOnly || N === "TEXTAREA" && !S.readOnly || S.isContentEditable)
                }

                function l(S) {
                    S.getAttribute("data-wf-focus-visible") || S.setAttribute("data-wf-focus-visible", "true")
                }

                function m(S) {
                    S.getAttribute("data-wf-focus-visible") && S.removeAttribute("data-wf-focus-visible")
                }

                function f(S) {
                    S.metaKey || S.altKey || S.ctrlKey || (s(r.activeElement) && l(r.activeElement), n = !0)
                }

                function g() {
                    n = !1
                }

                function p(S) {
                    s(S.target) && (n || u(S.target)) && l(S.target)
                }

                function h(S) {
                    s(S.target) && S.target.hasAttribute("data-wf-focus-visible") && (i = !0, window.clearTimeout(o), o = window.setTimeout(function() {
                        i = !1
                    }, 100), m(S.target))
                }

                function _() {
                    document.visibilityState === "hidden" && (i && (n = !0), T())
                }

                function T() {
                    document.addEventListener("mousemove", C), document.addEventListener("mousedown", C), document.addEventListener("mouseup", C), document.addEventListener("pointermove", C), document.addEventListener("pointerdown", C), document.addEventListener("pointerup", C), document.addEventListener("touchmove", C), document.addEventListener("touchstart", C), document.addEventListener("touchend", C)
                }

                function I() {
                    document.removeEventListener("mousemove", C), document.removeEventListener("mousedown", C), document.removeEventListener("mouseup", C), document.removeEventListener("pointermove", C), document.removeEventListener("pointerdown", C), document.removeEventListener("pointerup", C), document.removeEventListener("touchmove", C), document.removeEventListener("touchstart", C), document.removeEventListener("touchend", C)
                }

                function C(S) {
                    S.target.nodeName && S.target.nodeName.toLowerCase() === "html" || (n = !1, I())
                }
                document.addEventListener("keydown", f, !0), document.addEventListener("mousedown", g, !0), document.addEventListener("pointerdown", g, !0), document.addEventListener("touchstart", g, !0), document.addEventListener("visibilitychange", _, !0), T(), r.addEventListener("focus", p, !0), r.addEventListener("blur", h, !0)
            }

            function t() {
                if (typeof document < "u") try {
                    document.querySelector(":focus-visible")
                } catch {
                    e(document)
                }
            }
            return {
                ready: t
            }
        })
    });
    var La = d((wF, Ca) => {
        "use strict";
        var Ra = qe();
        Ra.define("focus", Ca.exports = function() {
            var e = [],
                t = !1;

            function r(a) {
                t && (a.preventDefault(), a.stopPropagation(), a.stopImmediatePropagation(), e.unshift(a))
            }

            function n(a) {
                var s = a.target,
                    u = s.tagName;
                return /^a$/i.test(u) && s.href != null || /^(button|textarea)$/i.test(u) && s.disabled !== !0 || /^input$/i.test(u) && /^(button|reset|submit|radio|checkbox)$/i.test(s.type) && !s.disabled || !/^(button|input|textarea|select|a)$/i.test(u) && !Number.isNaN(Number.parseFloat(s.tabIndex)) || /^audio$/i.test(u) || /^video$/i.test(u) && s.controls === !0
            }

            function i(a) {
                n(a) && (t = !0, setTimeout(() => {
                    for (t = !1, a.target.focus(); e.length > 0;) {
                        var s = e.pop();
                        s.target.dispatchEvent(new MouseEvent(s.type, s))
                    }
                }, 0))
            }

            function o() {
                typeof document < "u" && document.body.hasAttribute("data-wf-focus-within") && Ra.env.safari && (document.addEventListener("mousedown", i, !0), document.addEventListener("mouseup", r, !0), document.addEventListener("click", r, !0))
            }
            return {
                ready: o
            }
        })
    });
    var Da = d((AF, Na) => {
        "use strict";
        var Qn = window.jQuery,
            $e = {},
            Nr = [],
            Pa = ".w-ix",
            Dr = {
                reset: function(e, t) {
                    t.__wf_intro = null
                },
                intro: function(e, t) {
                    t.__wf_intro || (t.__wf_intro = !0, Qn(t).triggerHandler($e.types.INTRO))
                },
                outro: function(e, t) {
                    t.__wf_intro && (t.__wf_intro = null, Qn(t).triggerHandler($e.types.OUTRO))
                }
            };
        $e.triggers = {};
        $e.types = {
            INTRO: "w-ix-intro" + Pa,
            OUTRO: "w-ix-outro" + Pa
        };
        $e.init = function() {
            for (var e = Nr.length, t = 0; t < e; t++) {
                var r = Nr[t];
                r[0](0, r[1])
            }
            Nr = [], Qn.extend($e.triggers, Dr)
        };
        $e.async = function() {
            for (var e in Dr) {
                var t = Dr[e];
                Dr.hasOwnProperty(e) && ($e.triggers[e] = function(r, n) {
                    Nr.push([t, n])
                })
            }
        };
        $e.async();
        Na.exports = $e
    });
    var Zn = d((xF, qa) => {
        "use strict";
        var $n = Da();

        function Ma(e, t) {
            var r = document.createEvent("CustomEvent");
            r.initCustomEvent(t, !0, !0, null), e.dispatchEvent(r)
        }
        var im = window.jQuery,
            Mr = {},
            Fa = ".w-ix",
            om = {
                reset: function(e, t) {
                    $n.triggers.reset(e, t)
                },
                intro: function(e, t) {
                    $n.triggers.intro(e, t), Ma(t, "COMPONENT_ACTIVE")
                },
                outro: function(e, t) {
                    $n.triggers.outro(e, t), Ma(t, "COMPONENT_INACTIVE")
                }
            };
        Mr.triggers = {};
        Mr.types = {
            INTRO: "w-ix-intro" + Fa,
            OUTRO: "w-ix-outro" + Fa
        };
        im.extend(Mr.triggers, om);
        qa.exports = Mr
    });
    var Jn = d((SF, Xa) => {
        var am = typeof global == "object" && global && global.Object === Object && global;
        Xa.exports = am
    });
    var Be = d((OF, Ga) => {
        var sm = Jn(),
            um = typeof self == "object" && self && self.Object === Object && self,
            cm = sm || um || Function("return this")();
        Ga.exports = cm
    });
    var At = d((RF, ka) => {
        var lm = Be(),
            fm = lm.Symbol;
        ka.exports = fm
    });
    var Ba = d((CF, Ha) => {
        var Va = At(),
            Ua = Object.prototype,
            dm = Ua.hasOwnProperty,
            pm = Ua.toString,
            Jt = Va ? Va.toStringTag : void 0;

        function gm(e) {
            var t = dm.call(e, Jt),
                r = e[Jt];
            try {
                e[Jt] = void 0;
                var n = !0
            } catch {}
            var i = pm.call(e);
            return n && (t ? e[Jt] = r : delete e[Jt]), i
        }
        Ha.exports = gm
    });
    var za = d((LF, Wa) => {
        var hm = Object.prototype,
            vm = hm.toString;

        function mm(e) {
            return vm.call(e)
        }
        Wa.exports = mm
    });
    var ct = d((PF, Ya) => {
        var Ka = At(),
            Em = Ba(),
            ym = za(),
            _m = "[object Null]",
            Im = "[object Undefined]",
            ja = Ka ? Ka.toStringTag : void 0;

        function bm(e) {
            return e == null ? e === void 0 ? Im : _m : ja && ja in Object(e) ? Em(e) : ym(e)
        }
        Ya.exports = bm
    });
    var ei = d((NF, Qa) => {
        function Tm(e, t) {
            return function(r) {
                return e(t(r))
            }
        }
        Qa.exports = Tm
    });
    var ti = d((DF, $a) => {
        var wm = ei(),
            Am = wm(Object.getPrototypeOf, Object);
        $a.exports = Am
    });
    var nt = d((MF, Za) => {
        function xm(e) {
            return e != null && typeof e == "object"
        }
        Za.exports = xm
    });
    var ri = d((FF, es) => {
        var Sm = ct(),
            Om = ti(),
            Rm = nt(),
            Cm = "[object Object]",
            Lm = Function.prototype,
            Pm = Object.prototype,
            Ja = Lm.toString,
            Nm = Pm.hasOwnProperty,
            Dm = Ja.call(Object);

        function Mm(e) {
            if (!Rm(e) || Sm(e) != Cm) return !1;
            var t = Om(e);
            if (t === null) return !0;
            var r = Nm.call(t, "constructor") && t.constructor;
            return typeof r == "function" && r instanceof r && Ja.call(r) == Dm
        }
        es.exports = Mm
    });
    var ts = d(ni => {
        "use strict";
        Object.defineProperty(ni, "__esModule", {
            value: !0
        });
        ni.default = Fm;

        function Fm(e) {
            var t, r = e.Symbol;
            return typeof r == "function" ? r.observable ? t = r.observable : (t = r("observable"), r.observable = t) : t = "@@observable", t
        }
    });
    var rs = d((oi, ii) => {
        "use strict";
        Object.defineProperty(oi, "__esModule", {
            value: !0
        });
        var qm = ts(),
            Xm = Gm(qm);

        function Gm(e) {
            return e && e.__esModule ? e : {
                default: e
            }
        }
        var xt;
        typeof self < "u" ? xt = self : typeof window < "u" ? xt = window : typeof global < "u" ? xt = global : typeof ii < "u" ? xt = ii : xt = Function("return this")();
        var km = (0, Xm.default)(xt);
        oi.default = km
    });
    var ai = d(er => {
        "use strict";
        er.__esModule = !0;
        er.ActionTypes = void 0;
        er.default = as;
        var Vm = ri(),
            Um = os(Vm),
            Hm = rs(),
            ns = os(Hm);

        function os(e) {
            return e && e.__esModule ? e : {
                default: e
            }
        }
        var is = er.ActionTypes = {
            INIT: "@@redux/INIT"
        };

        function as(e, t, r) {
            var n;
            if (typeof t == "function" && typeof r > "u" && (r = t, t = void 0), typeof r < "u") {
                if (typeof r != "function") throw new Error("Expected the enhancer to be a function.");
                return r(as)(e, t)
            }
            if (typeof e != "function") throw new Error("Expected the reducer to be a function.");
            var i = e,
                o = t,
                a = [],
                s = a,
                u = !1;

            function l() {
                s === a && (s = a.slice())
            }

            function m() {
                return o
            }

            function f(_) {
                if (typeof _ != "function") throw new Error("Expected listener to be a function.");
                var T = !0;
                return l(), s.push(_),
                    function() {
                        if (T) {
                            T = !1, l();
                            var C = s.indexOf(_);
                            s.splice(C, 1)
                        }
                    }
            }

            function g(_) {
                if (!(0, Um.default)(_)) throw new Error("Actions must be plain objects. Use custom middleware for async actions.");
                if (typeof _.type > "u") throw new Error('Actions may not have an undefined "type" property. Have you misspelled a constant?');
                if (u) throw new Error("Reducers may not dispatch actions.");
                try {
                    u = !0, o = i(o, _)
                } finally {
                    u = !1
                }
                for (var T = a = s, I = 0; I < T.length; I++) T[I]();
                return _
            }

            function p(_) {
                if (typeof _ != "function") throw new Error("Expected the nextReducer to be a function.");
                i = _, g({
                    type: is.INIT
                })
            }

            function h() {
                var _, T = f;
                return _ = {
                    subscribe: function(C) {
                        if (typeof C != "object") throw new TypeError("Expected the observer to be an object.");

                        function S() {
                            C.next && C.next(m())
                        }
                        S();
                        var P = T(S);
                        return {
                            unsubscribe: P
                        }
                    }
                }, _[ns.default] = function() {
                    return this
                }, _
            }
            return g({
                type: is.INIT
            }), n = {
                dispatch: g,
                subscribe: f,
                getState: m,
                replaceReducer: p
            }, n[ns.default] = h, n
        }
    });
    var ui = d(si => {
        "use strict";
        si.__esModule = !0;
        si.default = Bm;

        function Bm(e) {
            typeof console < "u" && typeof console.error == "function" && console.error(e);
            try {
                throw new Error(e)
            } catch {}
        }
    });
    var cs = d(ci => {
        "use strict";
        ci.__esModule = !0;
        ci.default = Ym;
        var ss = ai(),
            Wm = ri(),
            kF = us(Wm),
            zm = ui(),
            VF = us(zm);

        function us(e) {
            return e && e.__esModule ? e : {
                default: e
            }
        }

        function Km(e, t) {
            var r = t && t.type,
                n = r && '"' + r.toString() + '"' || "an action";
            return "Given action " + n + ', reducer "' + e + '" returned undefined. To ignore an action, you must explicitly return the previous state.'
        }

        function jm(e) {
            Object.keys(e).forEach(function(t) {
                var r = e[t],
                    n = r(void 0, {
                        type: ss.ActionTypes.INIT
                    });
                if (typeof n > "u") throw new Error('Reducer "' + t + '" returned undefined during initialization. If the state passed to the reducer is undefined, you must explicitly return the initial state. The initial state may not be undefined.');
                var i = "@@redux/PROBE_UNKNOWN_ACTION_" + Math.random().toString(36).substring(7).split("").join(".");
                if (typeof r(void 0, {
                        type: i
                    }) > "u") throw new Error('Reducer "' + t + '" returned undefined when probed with a random type. ' + ("Don't try to handle " + ss.ActionTypes.INIT + ' or other actions in "redux/*" ') + "namespace. They are considered private. Instead, you must return the current state for any unknown actions, unless it is undefined, in which case you must return the initial state, regardless of the action type. The initial state may not be undefined.")
            })
        }

        function Ym(e) {
            for (var t = Object.keys(e), r = {}, n = 0; n < t.length; n++) {
                var i = t[n];
                typeof e[i] == "function" && (r[i] = e[i])
            }
            var o = Object.keys(r);
            if (!1) var a;
            var s;
            try {
                jm(r)
            } catch (u) {
                s = u
            }
            return function() {
                var l = arguments.length <= 0 || arguments[0] === void 0 ? {} : arguments[0],
                    m = arguments[1];
                if (s) throw s;
                if (!1) var f;
                for (var g = !1, p = {}, h = 0; h < o.length; h++) {
                    var _ = o[h],
                        T = r[_],
                        I = l[_],
                        C = T(I, m);
                    if (typeof C > "u") {
                        var S = Km(_, m);
                        throw new Error(S)
                    }
                    p[_] = C, g = g || C !== I
                }
                return g ? p : l
            }
        }
    });
    var fs = d(li => {
        "use strict";
        li.__esModule = !0;
        li.default = Qm;

        function ls(e, t) {
            return function() {
                return t(e.apply(void 0, arguments))
            }
        }

        function Qm(e, t) {
            if (typeof e == "function") return ls(e, t);
            if (typeof e != "object" || e === null) throw new Error("bindActionCreators expected an object or a function, instead received " + (e === null ? "null" : typeof e) + '. Did you write "import ActionCreators from" instead of "import * as ActionCreators from"?');
            for (var r = Object.keys(e), n = {}, i = 0; i < r.length; i++) {
                var o = r[i],
                    a = e[o];
                typeof a == "function" && (n[o] = ls(a, t))
            }
            return n
        }
    });
    var di = d(fi => {
        "use strict";
        fi.__esModule = !0;
        fi.default = $m;

        function $m() {
            for (var e = arguments.length, t = Array(e), r = 0; r < e; r++) t[r] = arguments[r];
            if (t.length === 0) return function(o) {
                return o
            };
            if (t.length === 1) return t[0];
            var n = t[t.length - 1],
                i = t.slice(0, -1);
            return function() {
                return i.reduceRight(function(o, a) {
                    return a(o)
                }, n.apply(void 0, arguments))
            }
        }
    });
    var ds = d(pi => {
        "use strict";
        pi.__esModule = !0;
        var Zm = Object.assign || function(e) {
            for (var t = 1; t < arguments.length; t++) {
                var r = arguments[t];
                for (var n in r) Object.prototype.hasOwnProperty.call(r, n) && (e[n] = r[n])
            }
            return e
        };
        pi.default = rE;
        var Jm = di(),
            eE = tE(Jm);

        function tE(e) {
            return e && e.__esModule ? e : {
                default: e
            }
        }

        function rE() {
            for (var e = arguments.length, t = Array(e), r = 0; r < e; r++) t[r] = arguments[r];
            return function(n) {
                return function(i, o, a) {
                    var s = n(i, o, a),
                        u = s.dispatch,
                        l = [],
                        m = {
                            getState: s.getState,
                            dispatch: function(g) {
                                return u(g)
                            }
                        };
                    return l = t.map(function(f) {
                        return f(m)
                    }), u = eE.default.apply(void 0, l)(s.dispatch), Zm({}, s, {
                        dispatch: u
                    })
                }
            }
        }
    });
    var gi = d(Xe => {
        "use strict";
        Xe.__esModule = !0;
        Xe.compose = Xe.applyMiddleware = Xe.bindActionCreators = Xe.combineReducers = Xe.createStore = void 0;
        var nE = ai(),
            iE = St(nE),
            oE = cs(),
            aE = St(oE),
            sE = fs(),
            uE = St(sE),
            cE = ds(),
            lE = St(cE),
            fE = di(),
            dE = St(fE),
            pE = ui(),
            zF = St(pE);

        function St(e) {
            return e && e.__esModule ? e : {
                default: e
            }
        }
        Xe.createStore = iE.default;
        Xe.combineReducers = aE.default;
        Xe.bindActionCreators = uE.default;
        Xe.applyMiddleware = lE.default;
        Xe.compose = dE.default
    });
    var We, hi, Ze, gE, hE, Fr, vE, vi = ve(() => {
        "use strict";
        We = {
            NAVBAR_OPEN: "NAVBAR_OPEN",
            NAVBAR_CLOSE: "NAVBAR_CLOSE",
            TAB_ACTIVE: "TAB_ACTIVE",
            TAB_INACTIVE: "TAB_INACTIVE",
            SLIDER_ACTIVE: "SLIDER_ACTIVE",
            SLIDER_INACTIVE: "SLIDER_INACTIVE",
            DROPDOWN_OPEN: "DROPDOWN_OPEN",
            DROPDOWN_CLOSE: "DROPDOWN_CLOSE",
            MOUSE_CLICK: "MOUSE_CLICK",
            MOUSE_SECOND_CLICK: "MOUSE_SECOND_CLICK",
            MOUSE_DOWN: "MOUSE_DOWN",
            MOUSE_UP: "MOUSE_UP",
            MOUSE_OVER: "MOUSE_OVER",
            MOUSE_OUT: "MOUSE_OUT",
            MOUSE_MOVE: "MOUSE_MOVE",
            MOUSE_MOVE_IN_VIEWPORT: "MOUSE_MOVE_IN_VIEWPORT",
            SCROLL_INTO_VIEW: "SCROLL_INTO_VIEW",
            SCROLL_OUT_OF_VIEW: "SCROLL_OUT_OF_VIEW",
            SCROLLING_IN_VIEW: "SCROLLING_IN_VIEW",
            ECOMMERCE_CART_OPEN: "ECOMMERCE_CART_OPEN",
            ECOMMERCE_CART_CLOSE: "ECOMMERCE_CART_CLOSE",
            PAGE_START: "PAGE_START",
            PAGE_FINISH: "PAGE_FINISH",
            PAGE_SCROLL_UP: "PAGE_SCROLL_UP",
            PAGE_SCROLL_DOWN: "PAGE_SCROLL_DOWN",
            PAGE_SCROLL: "PAGE_SCROLL"
        }, hi = {
            ELEMENT: "ELEMENT",
            CLASS: "CLASS",
            PAGE: "PAGE"
        }, Ze = {
            ELEMENT: "ELEMENT",
            VIEWPORT: "VIEWPORT"
        }, gE = {
            X_AXIS: "X_AXIS",
            Y_AXIS: "Y_AXIS"
        }, hE = {
            CHILDREN: "CHILDREN",
            SIBLINGS: "SIBLINGS",
            IMMEDIATE_CHILDREN: "IMMEDIATE_CHILDREN"
        }, Fr = {
            FADE_EFFECT: "FADE_EFFECT",
            SLIDE_EFFECT: "SLIDE_EFFECT",
            GROW_EFFECT: "GROW_EFFECT",
            SHRINK_EFFECT: "SHRINK_EFFECT",
            SPIN_EFFECT: "SPIN_EFFECT",
            FLY_EFFECT: "FLY_EFFECT",
            POP_EFFECT: "POP_EFFECT",
            FLIP_EFFECT: "FLIP_EFFECT",
            JIGGLE_EFFECT: "JIGGLE_EFFECT",
            PULSE_EFFECT: "PULSE_EFFECT",
            DROP_EFFECT: "DROP_EFFECT",
            BLINK_EFFECT: "BLINK_EFFECT",
            BOUNCE_EFFECT: "BOUNCE_EFFECT",
            FLIP_LEFT_TO_RIGHT_EFFECT: "FLIP_LEFT_TO_RIGHT_EFFECT",
            FLIP_RIGHT_TO_LEFT_EFFECT: "FLIP_RIGHT_TO_LEFT_EFFECT",
            RUBBER_BAND_EFFECT: "RUBBER_BAND_EFFECT",
            JELLO_EFFECT: "JELLO_EFFECT",
            GROW_BIG_EFFECT: "GROW_BIG_EFFECT",
            SHRINK_BIG_EFFECT: "SHRINK_BIG_EFFECT",
            PLUGIN_LOTTIE_EFFECT: "PLUGIN_LOTTIE_EFFECT"
        }, vE = {
            LEFT: "LEFT",
            RIGHT: "RIGHT",
            BOTTOM: "BOTTOM",
            TOP: "TOP",
            BOTTOM_LEFT: "BOTTOM_LEFT",
            BOTTOM_RIGHT: "BOTTOM_RIGHT",
            TOP_RIGHT: "TOP_RIGHT",
            TOP_LEFT: "TOP_LEFT",
            CLOCKWISE: "CLOCKWISE",
            COUNTER_CLOCKWISE: "COUNTER_CLOCKWISE"
        }
    });
    var Ne, mE, qr = ve(() => {
        "use strict";
        Ne = {
            TRANSFORM_MOVE: "TRANSFORM_MOVE",
            TRANSFORM_SCALE: "TRANSFORM_SCALE",
            TRANSFORM_ROTATE: "TRANSFORM_ROTATE",
            TRANSFORM_SKEW: "TRANSFORM_SKEW",
            STYLE_OPACITY: "STYLE_OPACITY",
            STYLE_SIZE: "STYLE_SIZE",
            STYLE_FILTER: "STYLE_FILTER",
            STYLE_FONT_VARIATION: "STYLE_FONT_VARIATION",
            STYLE_BACKGROUND_COLOR: "STYLE_BACKGROUND_COLOR",
            STYLE_BORDER: "STYLE_BORDER",
            STYLE_TEXT_COLOR: "STYLE_TEXT_COLOR",
            OBJECT_VALUE: "OBJECT_VALUE",
            PLUGIN_LOTTIE: "PLUGIN_LOTTIE",
            PLUGIN_SPLINE: "PLUGIN_SPLINE",
            PLUGIN_VARIABLE: "PLUGIN_VARIABLE",
            GENERAL_DISPLAY: "GENERAL_DISPLAY",
            GENERAL_START_ACTION: "GENERAL_START_ACTION",
            GENERAL_CONTINUOUS_ACTION: "GENERAL_CONTINUOUS_ACTION",
            GENERAL_COMBO_CLASS: "GENERAL_COMBO_CLASS",
            GENERAL_STOP_ACTION: "GENERAL_STOP_ACTION",
            GENERAL_LOOP: "GENERAL_LOOP",
            STYLE_BOX_SHADOW: "STYLE_BOX_SHADOW"
        }, mE = {
            ELEMENT: "ELEMENT",
            ELEMENT_CLASS: "ELEMENT_CLASS",
            TRIGGER_ELEMENT: "TRIGGER_ELEMENT"
        }
    });
    var EE, ps = ve(() => {
        "use strict";
        EE = {
            MOUSE_CLICK_INTERACTION: "MOUSE_CLICK_INTERACTION",
            MOUSE_HOVER_INTERACTION: "MOUSE_HOVER_INTERACTION",
            MOUSE_MOVE_INTERACTION: "MOUSE_MOVE_INTERACTION",
            SCROLL_INTO_VIEW_INTERACTION: "SCROLL_INTO_VIEW_INTERACTION",
            SCROLLING_IN_VIEW_INTERACTION: "SCROLLING_IN_VIEW_INTERACTION",
            MOUSE_MOVE_IN_VIEWPORT_INTERACTION: "MOUSE_MOVE_IN_VIEWPORT_INTERACTION",
            PAGE_IS_SCROLLING_INTERACTION: "PAGE_IS_SCROLLING_INTERACTION",
            PAGE_LOAD_INTERACTION: "PAGE_LOAD_INTERACTION",
            PAGE_SCROLLED_INTERACTION: "PAGE_SCROLLED_INTERACTION",
            NAVBAR_INTERACTION: "NAVBAR_INTERACTION",
            DROPDOWN_INTERACTION: "DROPDOWN_INTERACTION",
            ECOMMERCE_CART_INTERACTION: "ECOMMERCE_CART_INTERACTION",
            TAB_INTERACTION: "TAB_INTERACTION",
            SLIDER_INTERACTION: "SLIDER_INTERACTION"
        }
    });
    var yE, _E, IE, bE, TE, wE, AE, mi, gs = ve(() => {
        "use strict";
        qr();
        ({
            TRANSFORM_MOVE: yE,
            TRANSFORM_SCALE: _E,
            TRANSFORM_ROTATE: IE,
            TRANSFORM_SKEW: bE,
            STYLE_SIZE: TE,
            STYLE_FILTER: wE,
            STYLE_FONT_VARIATION: AE
        } = Ne), mi = {
            [yE]: !0,
            [_E]: !0,
            [IE]: !0,
            [bE]: !0,
            [TE]: !0,
            [wE]: !0,
            [AE]: !0
        }
    });
    var be = {};
    Pe(be, {
        IX2_ACTION_LIST_PLAYBACK_CHANGED: () => UE,
        IX2_ANIMATION_FRAME_CHANGED: () => FE,
        IX2_CLEAR_REQUESTED: () => NE,
        IX2_ELEMENT_STATE_CHANGED: () => VE,
        IX2_EVENT_LISTENER_ADDED: () => DE,
        IX2_EVENT_STATE_CHANGED: () => ME,
        IX2_INSTANCE_ADDED: () => XE,
        IX2_INSTANCE_REMOVED: () => kE,
        IX2_INSTANCE_STARTED: () => GE,
        IX2_MEDIA_QUERIES_DEFINED: () => BE,
        IX2_PARAMETER_CHANGED: () => qE,
        IX2_PLAYBACK_REQUESTED: () => LE,
        IX2_PREVIEW_REQUESTED: () => CE,
        IX2_RAW_DATA_IMPORTED: () => xE,
        IX2_SESSION_INITIALIZED: () => SE,
        IX2_SESSION_STARTED: () => OE,
        IX2_SESSION_STOPPED: () => RE,
        IX2_STOP_REQUESTED: () => PE,
        IX2_TEST_FRAME_RENDERED: () => WE,
        IX2_VIEWPORT_WIDTH_CHANGED: () => HE
    });
    var xE, SE, OE, RE, CE, LE, PE, NE, DE, ME, FE, qE, XE, GE, kE, VE, UE, HE, BE, WE, hs = ve(() => {
        "use strict";
        xE = "IX2_RAW_DATA_IMPORTED", SE = "IX2_SESSION_INITIALIZED", OE = "IX2_SESSION_STARTED", RE = "IX2_SESSION_STOPPED", CE = "IX2_PREVIEW_REQUESTED", LE = "IX2_PLAYBACK_REQUESTED", PE = "IX2_STOP_REQUESTED", NE = "IX2_CLEAR_REQUESTED", DE = "IX2_EVENT_LISTENER_ADDED", ME = "IX2_EVENT_STATE_CHANGED", FE = "IX2_ANIMATION_FRAME_CHANGED", qE = "IX2_PARAMETER_CHANGED", XE = "IX2_INSTANCE_ADDED", GE = "IX2_INSTANCE_STARTED", kE = "IX2_INSTANCE_REMOVED", VE = "IX2_ELEMENT_STATE_CHANGED", UE = "IX2_ACTION_LIST_PLAYBACK_CHANGED", HE = "IX2_VIEWPORT_WIDTH_CHANGED", BE = "IX2_MEDIA_QUERIES_DEFINED", WE = "IX2_TEST_FRAME_RENDERED"
    });
    var Ae = {};
    Pe(Ae, {
        ABSTRACT_NODE: () => Hy,
        AUTO: () => Py,
        BACKGROUND: () => xy,
        BACKGROUND_COLOR: () => Ay,
        BAR_DELIMITER: () => My,
        BORDER_COLOR: () => Sy,
        BOUNDARY_SELECTOR: () => QE,
        CHILDREN: () => Fy,
        COLON_DELIMITER: () => Dy,
        COLOR: () => Oy,
        COMMA_DELIMITER: () => Ny,
        CONFIG_UNIT: () => iy,
        CONFIG_VALUE: () => ey,
        CONFIG_X_UNIT: () => ty,
        CONFIG_X_VALUE: () => $E,
        CONFIG_Y_UNIT: () => ry,
        CONFIG_Y_VALUE: () => ZE,
        CONFIG_Z_UNIT: () => ny,
        CONFIG_Z_VALUE: () => JE,
        DISPLAY: () => Ry,
        FILTER: () => Iy,
        FLEX: () => Cy,
        FONT_VARIATION_SETTINGS: () => by,
        HEIGHT: () => wy,
        HTML_ELEMENT: () => Vy,
        IMMEDIATE_CHILDREN: () => qy,
        IX2_ID_DELIMITER: () => zE,
        OPACITY: () => _y,
        PARENT: () => Gy,
        PLAIN_OBJECT: () => Uy,
        PRESERVE_3D: () => ky,
        RENDER_GENERAL: () => Wy,
        RENDER_PLUGIN: () => Ky,
        RENDER_STYLE: () => zy,
        RENDER_TRANSFORM: () => By,
        ROTATE_X: () => gy,
        ROTATE_Y: () => hy,
        ROTATE_Z: () => vy,
        SCALE_3D: () => py,
        SCALE_X: () => ly,
        SCALE_Y: () => fy,
        SCALE_Z: () => dy,
        SIBLINGS: () => Xy,
        SKEW: () => my,
        SKEW_X: () => Ey,
        SKEW_Y: () => yy,
        TRANSFORM: () => oy,
        TRANSLATE_3D: () => cy,
        TRANSLATE_X: () => ay,
        TRANSLATE_Y: () => sy,
        TRANSLATE_Z: () => uy,
        WF_PAGE: () => KE,
        WIDTH: () => Ty,
        WILL_CHANGE: () => Ly,
        W_MOD_IX: () => YE,
        W_MOD_JS: () => jE
    });
    var zE, KE, jE, YE, QE, $E, ZE, JE, ey, ty, ry, ny, iy, oy, ay, sy, uy, cy, ly, fy, dy, py, gy, hy, vy, my, Ey, yy, _y, Iy, by, Ty, wy, Ay, xy, Sy, Oy, Ry, Cy, Ly, Py, Ny, Dy, My, Fy, qy, Xy, Gy, ky, Vy, Uy, Hy, By, Wy, zy, Ky, vs = ve(() => {
        "use strict";
        zE = "|", KE = "data-wf-page", jE = "w-mod-js", YE = "w-mod-ix", QE = ".w-dyn-item", $E = "xValue", ZE = "yValue", JE = "zValue", ey = "value", ty = "xUnit", ry = "yUnit", ny = "zUnit", iy = "unit", oy = "transform", ay = "translateX", sy = "translateY", uy = "translateZ", cy = "translate3d", ly = "scaleX", fy = "scaleY", dy = "scaleZ", py = "scale3d", gy = "rotateX", hy = "rotateY", vy = "rotateZ", my = "skew", Ey = "skewX", yy = "skewY", _y = "opacity", Iy = "filter", by = "font-variation-settings", Ty = "width", wy = "height", Ay = "backgroundColor", xy = "background", Sy = "borderColor", Oy = "color", Ry = "display", Cy = "flex", Ly = "willChange", Py = "AUTO", Ny = ",", Dy = ":", My = "|", Fy = "CHILDREN", qy = "IMMEDIATE_CHILDREN", Xy = "SIBLINGS", Gy = "PARENT", ky = "preserve-3d", Vy = "HTML_ELEMENT", Uy = "PLAIN_OBJECT", Hy = "ABSTRACT_NODE", By = "RENDER_TRANSFORM", Wy = "RENDER_GENERAL", zy = "RENDER_STYLE", Ky = "RENDER_PLUGIN"
    });
    var ms = {};
    Pe(ms, {
        ActionAppliesTo: () => mE,
        ActionTypeConsts: () => Ne,
        EventAppliesTo: () => hi,
        EventBasedOn: () => Ze,
        EventContinuousMouseAxes: () => gE,
        EventLimitAffectedElements: () => hE,
        EventTypeConsts: () => We,
        IX2EngineActionTypes: () => be,
        IX2EngineConstants: () => Ae,
        InteractionTypeConsts: () => EE,
        QuickEffectDirectionConsts: () => vE,
        QuickEffectIds: () => Fr,
        ReducedMotionTypes: () => mi
    });
    var De = ve(() => {
        "use strict";
        vi();
        qr();
        ps();
        gs();
        hs();
        vs();
        qr();
        vi()
    });
    var jy, Es, ys = ve(() => {
        "use strict";
        De();
        ({
            IX2_RAW_DATA_IMPORTED: jy
        } = be), Es = (e = Object.freeze({}), t) => {
            switch (t.type) {
                case jy:
                    return t.payload.ixData || Object.freeze({});
                default:
                    return e
            }
        }
    });
    var Ot = d(Ee => {
        "use strict";
        Object.defineProperty(Ee, "__esModule", {
            value: !0
        });
        var Yy = typeof Symbol == "function" && typeof Symbol.iterator == "symbol" ? function(e) {
            return typeof e
        } : function(e) {
            return e && typeof Symbol == "function" && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e
        };
        Ee.clone = Gr;
        Ee.addLast = bs;
        Ee.addFirst = Ts;
        Ee.removeLast = ws;
        Ee.removeFirst = As;
        Ee.insert = xs;
        Ee.removeAt = Ss;
        Ee.replaceAt = Os;
        Ee.getIn = kr;
        Ee.set = Vr;
        Ee.setIn = Ur;
        Ee.update = Cs;
        Ee.updateIn = Ls;
        Ee.merge = Ps;
        Ee.mergeDeep = Ns;
        Ee.mergeIn = Ds;
        Ee.omit = Ms;
        Ee.addDefaults = Fs;
        var _s = "INVALID_ARGS";

        function Is(e) {
            throw new Error(e)
        }

        function Ei(e) {
            var t = Object.keys(e);
            return Object.getOwnPropertySymbols ? t.concat(Object.getOwnPropertySymbols(e)) : t
        }
        var Qy = {}.hasOwnProperty;

        function Gr(e) {
            if (Array.isArray(e)) return e.slice();
            for (var t = Ei(e), r = {}, n = 0; n < t.length; n++) {
                var i = t[n];
                r[i] = e[i]
            }
            return r
        }

        function Me(e, t, r) {
            var n = r;
            n == null && Is(_s);
            for (var i = !1, o = arguments.length, a = Array(o > 3 ? o - 3 : 0), s = 3; s < o; s++) a[s - 3] = arguments[s];
            for (var u = 0; u < a.length; u++) {
                var l = a[u];
                if (l != null) {
                    var m = Ei(l);
                    if (m.length)
                        for (var f = 0; f <= m.length; f++) {
                            var g = m[f];
                            if (!(e && n[g] !== void 0)) {
                                var p = l[g];
                                t && Xr(n[g]) && Xr(p) && (p = Me(e, t, n[g], p)), !(p === void 0 || p === n[g]) && (i || (i = !0, n = Gr(n)), n[g] = p)
                            }
                        }
                }
            }
            return n
        }

        function Xr(e) {
            var t = typeof e > "u" ? "undefined" : Yy(e);
            return e != null && (t === "object" || t === "function")
        }

        function bs(e, t) {
            return Array.isArray(t) ? e.concat(t) : e.concat([t])
        }

        function Ts(e, t) {
            return Array.isArray(t) ? t.concat(e) : [t].concat(e)
        }

        function ws(e) {
            return e.length ? e.slice(0, e.length - 1) : e
        }

        function As(e) {
            return e.length ? e.slice(1) : e
        }

        function xs(e, t, r) {
            return e.slice(0, t).concat(Array.isArray(r) ? r : [r]).concat(e.slice(t))
        }

        function Ss(e, t) {
            return t >= e.length || t < 0 ? e : e.slice(0, t).concat(e.slice(t + 1))
        }

        function Os(e, t, r) {
            if (e[t] === r) return e;
            for (var n = e.length, i = Array(n), o = 0; o < n; o++) i[o] = e[o];
            return i[t] = r, i
        }

        function kr(e, t) {
            if (!Array.isArray(t) && Is(_s), e != null) {
                for (var r = e, n = 0; n < t.length; n++) {
                    var i = t[n];
                    if (r = r ? .[i], r === void 0) return r
                }
                return r
            }
        }

        function Vr(e, t, r) {
            var n = typeof t == "number" ? [] : {},
                i = e ? ? n;
            if (i[t] === r) return i;
            var o = Gr(i);
            return o[t] = r, o
        }

        function Rs(e, t, r, n) {
            var i = void 0,
                o = t[n];
            if (n === t.length - 1) i = r;
            else {
                var a = Xr(e) && Xr(e[o]) ? e[o] : typeof t[n + 1] == "number" ? [] : {};
                i = Rs(a, t, r, n + 1)
            }
            return Vr(e, o, i)
        }

        function Ur(e, t, r) {
            return t.length ? Rs(e, t, r, 0) : r
        }

        function Cs(e, t, r) {
            var n = e ? .[t],
                i = r(n);
            return Vr(e, t, i)
        }

        function Ls(e, t, r) {
            var n = kr(e, t),
                i = r(n);
            return Ur(e, t, i)
        }

        function Ps(e, t, r, n, i, o) {
            for (var a = arguments.length, s = Array(a > 6 ? a - 6 : 0), u = 6; u < a; u++) s[u - 6] = arguments[u];
            return s.length ? Me.call.apply(Me, [null, !1, !1, e, t, r, n, i, o].concat(s)) : Me(!1, !1, e, t, r, n, i, o)
        }

        function Ns(e, t, r, n, i, o) {
            for (var a = arguments.length, s = Array(a > 6 ? a - 6 : 0), u = 6; u < a; u++) s[u - 6] = arguments[u];
            return s.length ? Me.call.apply(Me, [null, !1, !0, e, t, r, n, i, o].concat(s)) : Me(!1, !0, e, t, r, n, i, o)
        }

        function Ds(e, t, r, n, i, o, a) {
            var s = kr(e, t);
            s == null && (s = {});
            for (var u = void 0, l = arguments.length, m = Array(l > 7 ? l - 7 : 0), f = 7; f < l; f++) m[f - 7] = arguments[f];
            return m.length ? u = Me.call.apply(Me, [null, !1, !1, s, r, n, i, o, a].concat(m)) : u = Me(!1, !1, s, r, n, i, o, a), Ur(e, t, u)
        }

        function Ms(e, t) {
            for (var r = Array.isArray(t) ? t : [t], n = !1, i = 0; i < r.length; i++)
                if (Qy.call(e, r[i])) {
                    n = !0;
                    break
                }
            if (!n) return e;
            for (var o = {}, a = Ei(e), s = 0; s < a.length; s++) {
                var u = a[s];
                r.indexOf(u) >= 0 || (o[u] = e[u])
            }
            return o
        }

        function Fs(e, t, r, n, i, o) {
            for (var a = arguments.length, s = Array(a > 6 ? a - 6 : 0), u = 6; u < a; u++) s[u - 6] = arguments[u];
            return s.length ? Me.call.apply(Me, [null, !0, !1, e, t, r, n, i, o].concat(s)) : Me(!0, !1, e, t, r, n, i, o)
        }
        var $y = {
            clone: Gr,
            addLast: bs,
            addFirst: Ts,
            removeLast: ws,
            removeFirst: As,
            insert: xs,
            removeAt: Ss,
            replaceAt: Os,
            getIn: kr,
            set: Vr,
            setIn: Ur,
            update: Cs,
            updateIn: Ls,
            merge: Ps,
            mergeDeep: Ns,
            mergeIn: Ds,
            omit: Ms,
            addDefaults: Fs
        };
        Ee.default = $y
    });
    var Xs, Zy, Jy, e_, t_, r_, qs, Gs, ks = ve(() => {
        "use strict";
        De();
        Xs = le(Ot()), {
            IX2_PREVIEW_REQUESTED: Zy,
            IX2_PLAYBACK_REQUESTED: Jy,
            IX2_STOP_REQUESTED: e_,
            IX2_CLEAR_REQUESTED: t_
        } = be, r_ = {
            preview: {},
            playback: {},
            stop: {},
            clear: {}
        }, qs = Object.create(null, {
            [Zy]: {
                value: "preview"
            },
            [Jy]: {
                value: "playback"
            },
            [e_]: {
                value: "stop"
            },
            [t_]: {
                value: "clear"
            }
        }), Gs = (e = r_, t) => {
            if (t.type in qs) {
                let r = [qs[t.type]];
                return (0, Xs.setIn)(e, [r], { ...t.payload
                })
            }
            return e
        }
    });
    var Oe, n_, i_, o_, a_, s_, u_, c_, l_, f_, d_, Vs, p_, Us, Hs = ve(() => {
        "use strict";
        De();
        Oe = le(Ot()), {
            IX2_SESSION_INITIALIZED: n_,
            IX2_SESSION_STARTED: i_,
            IX2_TEST_FRAME_RENDERED: o_,
            IX2_SESSION_STOPPED: a_,
            IX2_EVENT_LISTENER_ADDED: s_,
            IX2_EVENT_STATE_CHANGED: u_,
            IX2_ANIMATION_FRAME_CHANGED: c_,
            IX2_ACTION_LIST_PLAYBACK_CHANGED: l_,
            IX2_VIEWPORT_WIDTH_CHANGED: f_,
            IX2_MEDIA_QUERIES_DEFINED: d_
        } = be, Vs = {
            active: !1,
            tick: 0,
            eventListeners: [],
            eventState: {},
            playbackState: {},
            viewportWidth: 0,
            mediaQueryKey: null,
            hasBoundaryNodes: !1,
            hasDefinedMediaQueries: !1,
            reducedMotion: !1
        }, p_ = 20, Us = (e = Vs, t) => {
            switch (t.type) {
                case n_:
                    {
                        let {
                            hasBoundaryNodes: r,
                            reducedMotion: n
                        } = t.payload;
                        return (0, Oe.merge)(e, {
                            hasBoundaryNodes: r,
                            reducedMotion: n
                        })
                    }
                case i_:
                    return (0, Oe.set)(e, "active", !0);
                case o_:
                    {
                        let {
                            payload: {
                                step: r = p_
                            }
                        } = t;
                        return (0, Oe.set)(e, "tick", e.tick + r)
                    }
                case a_:
                    return Vs;
                case c_:
                    {
                        let {
                            payload: {
                                now: r
                            }
                        } = t;
                        return (0, Oe.set)(e, "tick", r)
                    }
                case s_:
                    {
                        let r = (0, Oe.addLast)(e.eventListeners, t.payload);
                        return (0, Oe.set)(e, "eventListeners", r)
                    }
                case u_:
                    {
                        let {
                            stateKey: r,
                            newState: n
                        } = t.payload;
                        return (0, Oe.setIn)(e, ["eventState", r], n)
                    }
                case l_:
                    {
                        let {
                            actionListId: r,
                            isPlaying: n
                        } = t.payload;
                        return (0, Oe.setIn)(e, ["playbackState", r], n)
                    }
                case f_:
                    {
                        let {
                            width: r,
                            mediaQueries: n
                        } = t.payload,
                        i = n.length,
                        o = null;
                        for (let a = 0; a < i; a++) {
                            let {
                                key: s,
                                min: u,
                                max: l
                            } = n[a];
                            if (r >= u && r <= l) {
                                o = s;
                                break
                            }
                        }
                        return (0, Oe.merge)(e, {
                            viewportWidth: r,
                            mediaQueryKey: o
                        })
                    }
                case d_:
                    return (0, Oe.set)(e, "hasDefinedMediaQueries", !0);
                default:
                    return e
            }
        }
    });
    var Ws = d((d2, Bs) => {
        function g_() {
            this.__data__ = [], this.size = 0
        }
        Bs.exports = g_
    });
    var Hr = d((p2, zs) => {
        function h_(e, t) {
            return e === t || e !== e && t !== t
        }
        zs.exports = h_
    });
    var tr = d((g2, Ks) => {
        var v_ = Hr();

        function m_(e, t) {
            for (var r = e.length; r--;)
                if (v_(e[r][0], t)) return r;
            return -1
        }
        Ks.exports = m_
    });
    var Ys = d((h2, js) => {
        var E_ = tr(),
            y_ = Array.prototype,
            __ = y_.splice;

        function I_(e) {
            var t = this.__data__,
                r = E_(t, e);
            if (r < 0) return !1;
            var n = t.length - 1;
            return r == n ? t.pop() : __.call(t, r, 1), --this.size, !0
        }
        js.exports = I_
    });
    var $s = d((v2, Qs) => {
        var b_ = tr();

        function T_(e) {
            var t = this.__data__,
                r = b_(t, e);
            return r < 0 ? void 0 : t[r][1]
        }
        Qs.exports = T_
    });
    var Js = d((m2, Zs) => {
        var w_ = tr();

        function A_(e) {
            return w_(this.__data__, e) > -1
        }
        Zs.exports = A_
    });
    var tu = d((E2, eu) => {
        var x_ = tr();

        function S_(e, t) {
            var r = this.__data__,
                n = x_(r, e);
            return n < 0 ? (++this.size, r.push([e, t])) : r[n][1] = t, this
        }
        eu.exports = S_
    });
    var rr = d((y2, ru) => {
        var O_ = Ws(),
            R_ = Ys(),
            C_ = $s(),
            L_ = Js(),
            P_ = tu();

        function Rt(e) {
            var t = -1,
                r = e == null ? 0 : e.length;
            for (this.clear(); ++t < r;) {
                var n = e[t];
                this.set(n[0], n[1])
            }
        }
        Rt.prototype.clear = O_;
        Rt.prototype.delete = R_;
        Rt.prototype.get = C_;
        Rt.prototype.has = L_;
        Rt.prototype.set = P_;
        ru.exports = Rt
    });
    var iu = d((_2, nu) => {
        var N_ = rr();

        function D_() {
            this.__data__ = new N_, this.size = 0
        }
        nu.exports = D_
    });
    var au = d((I2, ou) => {
        function M_(e) {
            var t = this.__data__,
                r = t.delete(e);
            return this.size = t.size, r
        }
        ou.exports = M_
    });
    var uu = d((b2, su) => {
        function F_(e) {
            return this.__data__.get(e)
        }
        su.exports = F_
    });
    var lu = d((T2, cu) => {
        function q_(e) {
            return this.__data__.has(e)
        }
        cu.exports = q_
    });
    var Je = d((w2, fu) => {
        function X_(e) {
            var t = typeof e;
            return e != null && (t == "object" || t == "function")
        }
        fu.exports = X_
    });
    var yi = d((A2, du) => {
        var G_ = ct(),
            k_ = Je(),
            V_ = "[object AsyncFunction]",
            U_ = "[object Function]",
            H_ = "[object GeneratorFunction]",
            B_ = "[object Proxy]";

        function W_(e) {
            if (!k_(e)) return !1;
            var t = G_(e);
            return t == U_ || t == H_ || t == V_ || t == B_
        }
        du.exports = W_
    });
    var gu = d((x2, pu) => {
        var z_ = Be(),
            K_ = z_["__core-js_shared__"];
        pu.exports = K_
    });
    var mu = d((S2, vu) => {
        var _i = gu(),
            hu = function() {
                var e = /[^.]+$/.exec(_i && _i.keys && _i.keys.IE_PROTO || "");
                return e ? "Symbol(src)_1." + e : ""
            }();

        function j_(e) {
            return !!hu && hu in e
        }
        vu.exports = j_
    });
    var Ii = d((O2, Eu) => {
        var Y_ = Function.prototype,
            Q_ = Y_.toString;

        function $_(e) {
            if (e != null) {
                try {
                    return Q_.call(e)
                } catch {}
                try {
                    return e + ""
                } catch {}
            }
            return ""
        }
        Eu.exports = $_
    });
    var _u = d((R2, yu) => {
        var Z_ = yi(),
            J_ = mu(),
            eI = Je(),
            tI = Ii(),
            rI = /[\\^$.*+?()[\]{}|]/g,
            nI = /^\[object .+?Constructor\]$/,
            iI = Function.prototype,
            oI = Object.prototype,
            aI = iI.toString,
            sI = oI.hasOwnProperty,
            uI = RegExp("^" + aI.call(sI).replace(rI, "\\$&").replace(/hasOwnProperty|(function).*?(?=\\\()| for .+?(?=\\\])/g, "$1.*?") + "$");

        function cI(e) {
            if (!eI(e) || J_(e)) return !1;
            var t = Z_(e) ? uI : nI;
            return t.test(tI(e))
        }
        yu.exports = cI
    });
    var bu = d((C2, Iu) => {
        function lI(e, t) {
            return e ? .[t]
        }
        Iu.exports = lI
    });
    var lt = d((L2, Tu) => {
        var fI = _u(),
            dI = bu();

        function pI(e, t) {
            var r = dI(e, t);
            return fI(r) ? r : void 0
        }
        Tu.exports = pI
    });
    var Br = d((P2, wu) => {
        var gI = lt(),
            hI = Be(),
            vI = gI(hI, "Map");
        wu.exports = vI
    });
    var nr = d((N2, Au) => {
        var mI = lt(),
            EI = mI(Object, "create");
        Au.exports = EI
    });
    var Ou = d((D2, Su) => {
        var xu = nr();

        function yI() {
            this.__data__ = xu ? xu(null) : {}, this.size = 0
        }
        Su.exports = yI
    });
    var Cu = d((M2, Ru) => {
        function _I(e) {
            var t = this.has(e) && delete this.__data__[e];
            return this.size -= t ? 1 : 0, t
        }
        Ru.exports = _I
    });
    var Pu = d((F2, Lu) => {
        var II = nr(),
            bI = "__lodash_hash_undefined__",
            TI = Object.prototype,
            wI = TI.hasOwnProperty;

        function AI(e) {
            var t = this.__data__;
            if (II) {
                var r = t[e];
                return r === bI ? void 0 : r
            }
            return wI.call(t, e) ? t[e] : void 0
        }
        Lu.exports = AI
    });
    var Du = d((q2, Nu) => {
        var xI = nr(),
            SI = Object.prototype,
            OI = SI.hasOwnProperty;

        function RI(e) {
            var t = this.__data__;
            return xI ? t[e] !== void 0 : OI.call(t, e)
        }
        Nu.exports = RI
    });
    var Fu = d((X2, Mu) => {
        var CI = nr(),
            LI = "__lodash_hash_undefined__";

        function PI(e, t) {
            var r = this.__data__;
            return this.size += this.has(e) ? 0 : 1, r[e] = CI && t === void 0 ? LI : t, this
        }
        Mu.exports = PI
    });
    var Xu = d((G2, qu) => {
        var NI = Ou(),
            DI = Cu(),
            MI = Pu(),
            FI = Du(),
            qI = Fu();

        function Ct(e) {
            var t = -1,
                r = e == null ? 0 : e.length;
            for (this.clear(); ++t < r;) {
                var n = e[t];
                this.set(n[0], n[1])
            }
        }
        Ct.prototype.clear = NI;
        Ct.prototype.delete = DI;
        Ct.prototype.get = MI;
        Ct.prototype.has = FI;
        Ct.prototype.set = qI;
        qu.exports = Ct
    });
    var Vu = d((k2, ku) => {
        var Gu = Xu(),
            XI = rr(),
            GI = Br();

        function kI() {
            this.size = 0, this.__data__ = {
                hash: new Gu,
                map: new(GI || XI),
                string: new Gu
            }
        }
        ku.exports = kI
    });
    var Hu = d((V2, Uu) => {
        function VI(e) {
            var t = typeof e;
            return t == "string" || t == "number" || t == "symbol" || t == "boolean" ? e !== "__proto__" : e === null
        }
        Uu.exports = VI
    });
    var ir = d((U2, Bu) => {
        var UI = Hu();

        function HI(e, t) {
            var r = e.__data__;
            return UI(t) ? r[typeof t == "string" ? "string" : "hash"] : r.map
        }
        Bu.exports = HI
    });
    var zu = d((H2, Wu) => {
        var BI = ir();

        function WI(e) {
            var t = BI(this, e).delete(e);
            return this.size -= t ? 1 : 0, t
        }
        Wu.exports = WI
    });
    var ju = d((B2, Ku) => {
        var zI = ir();

        function KI(e) {
            return zI(this, e).get(e)
        }
        Ku.exports = KI
    });
    var Qu = d((W2, Yu) => {
        var jI = ir();

        function YI(e) {
            return jI(this, e).has(e)
        }
        Yu.exports = YI
    });
    var Zu = d((z2, $u) => {
        var QI = ir();

        function $I(e, t) {
            var r = QI(this, e),
                n = r.size;
            return r.set(e, t), this.size += r.size == n ? 0 : 1, this
        }
        $u.exports = $I
    });
    var Wr = d((K2, Ju) => {
        var ZI = Vu(),
            JI = zu(),
            eb = ju(),
            tb = Qu(),
            rb = Zu();

        function Lt(e) {
            var t = -1,
                r = e == null ? 0 : e.length;
            for (this.clear(); ++t < r;) {
                var n = e[t];
                this.set(n[0], n[1])
            }
        }
        Lt.prototype.clear = ZI;
        Lt.prototype.delete = JI;
        Lt.prototype.get = eb;
        Lt.prototype.has = tb;
        Lt.prototype.set = rb;
        Ju.exports = Lt
    });
    var tc = d((j2, ec) => {
        var nb = rr(),
            ib = Br(),
            ob = Wr(),
            ab = 200;

        function sb(e, t) {
            var r = this.__data__;
            if (r instanceof nb) {
                var n = r.__data__;
                if (!ib || n.length < ab - 1) return n.push([e, t]), this.size = ++r.size, this;
                r = this.__data__ = new ob(n)
            }
            return r.set(e, t), this.size = r.size, this
        }
        ec.exports = sb
    });
    var bi = d((Y2, rc) => {
        var ub = rr(),
            cb = iu(),
            lb = au(),
            fb = uu(),
            db = lu(),
            pb = tc();

        function Pt(e) {
            var t = this.__data__ = new ub(e);
            this.size = t.size
        }
        Pt.prototype.clear = cb;
        Pt.prototype.delete = lb;
        Pt.prototype.get = fb;
        Pt.prototype.has = db;
        Pt.prototype.set = pb;
        rc.exports = Pt
    });
    var ic = d((Q2, nc) => {
        var gb = "__lodash_hash_undefined__";

        function hb(e) {
            return this.__data__.set(e, gb), this
        }
        nc.exports = hb
    });
    var ac = d(($2, oc) => {
        function vb(e) {
            return this.__data__.has(e)
        }
        oc.exports = vb
    });
    var uc = d((Z2, sc) => {
        var mb = Wr(),
            Eb = ic(),
            yb = ac();

        function zr(e) {
            var t = -1,
                r = e == null ? 0 : e.length;
            for (this.__data__ = new mb; ++t < r;) this.add(e[t])
        }
        zr.prototype.add = zr.prototype.push = Eb;
        zr.prototype.has = yb;
        sc.exports = zr
    });
    var lc = d((J2, cc) => {
        function _b(e, t) {
            for (var r = -1, n = e == null ? 0 : e.length; ++r < n;)
                if (t(e[r], r, e)) return !0;
            return !1
        }
        cc.exports = _b
    });
    var dc = d((e1, fc) => {
        function Ib(e, t) {
            return e.has(t)
        }
        fc.exports = Ib
    });
    var Ti = d((t1, pc) => {
        var bb = uc(),
            Tb = lc(),
            wb = dc(),
            Ab = 1,
            xb = 2;

        function Sb(e, t, r, n, i, o) {
            var a = r & Ab,
                s = e.length,
                u = t.length;
            if (s != u && !(a && u > s)) return !1;
            var l = o.get(e),
                m = o.get(t);
            if (l && m) return l == t && m == e;
            var f = -1,
                g = !0,
                p = r & xb ? new bb : void 0;
            for (o.set(e, t), o.set(t, e); ++f < s;) {
                var h = e[f],
                    _ = t[f];
                if (n) var T = a ? n(_, h, f, t, e, o) : n(h, _, f, e, t, o);
                if (T !== void 0) {
                    if (T) continue;
                    g = !1;
                    break
                }
                if (p) {
                    if (!Tb(t, function(I, C) {
                            if (!wb(p, C) && (h === I || i(h, I, r, n, o))) return p.push(C)
                        })) {
                        g = !1;
                        break
                    }
                } else if (!(h === _ || i(h, _, r, n, o))) {
                    g = !1;
                    break
                }
            }
            return o.delete(e), o.delete(t), g
        }
        pc.exports = Sb
    });
    var hc = d((r1, gc) => {
        var Ob = Be(),
            Rb = Ob.Uint8Array;
        gc.exports = Rb
    });
    var mc = d((n1, vc) => {
        function Cb(e) {
            var t = -1,
                r = Array(e.size);
            return e.forEach(function(n, i) {
                r[++t] = [i, n]
            }), r
        }
        vc.exports = Cb
    });
    var yc = d((i1, Ec) => {
        function Lb(e) {
            var t = -1,
                r = Array(e.size);
            return e.forEach(function(n) {
                r[++t] = n
            }), r
        }
        Ec.exports = Lb
    });
    var wc = d((o1, Tc) => {
        var _c = At(),
            Ic = hc(),
            Pb = Hr(),
            Nb = Ti(),
            Db = mc(),
            Mb = yc(),
            Fb = 1,
            qb = 2,
            Xb = "[object Boolean]",
            Gb = "[object Date]",
            kb = "[object Error]",
            Vb = "[object Map]",
            Ub = "[object Number]",
            Hb = "[object RegExp]",
            Bb = "[object Set]",
            Wb = "[object String]",
            zb = "[object Symbol]",
            Kb = "[object ArrayBuffer]",
            jb = "[object DataView]",
            bc = _c ? _c.prototype : void 0,
            wi = bc ? bc.valueOf : void 0;

        function Yb(e, t, r, n, i, o, a) {
            switch (r) {
                case jb:
                    if (e.byteLength != t.byteLength || e.byteOffset != t.byteOffset) return !1;
                    e = e.buffer, t = t.buffer;
                case Kb:
                    return !(e.byteLength != t.byteLength || !o(new Ic(e), new Ic(t)));
                case Xb:
                case Gb:
                case Ub:
                    return Pb(+e, +t);
                case kb:
                    return e.name == t.name && e.message == t.message;
                case Hb:
                case Wb:
                    return e == t + "";
                case Vb:
                    var s = Db;
                case Bb:
                    var u = n & Fb;
                    if (s || (s = Mb), e.size != t.size && !u) return !1;
                    var l = a.get(e);
                    if (l) return l == t;
                    n |= qb, a.set(e, t);
                    var m = Nb(s(e), s(t), n, i, o, a);
                    return a.delete(e), m;
                case zb:
                    if (wi) return wi.call(e) == wi.call(t)
            }
            return !1
        }
        Tc.exports = Yb
    });
    var Kr = d((a1, Ac) => {
        function Qb(e, t) {
            for (var r = -1, n = t.length, i = e.length; ++r < n;) e[i + r] = t[r];
            return e
        }
        Ac.exports = Qb
    });
    var Te = d((s1, xc) => {
        var $b = Array.isArray;
        xc.exports = $b
    });
    var Ai = d((u1, Sc) => {
        var Zb = Kr(),
            Jb = Te();

        function eT(e, t, r) {
            var n = t(e);
            return Jb(e) ? n : Zb(n, r(e))
        }
        Sc.exports = eT
    });
    var Rc = d((c1, Oc) => {
        function tT(e, t) {
            for (var r = -1, n = e == null ? 0 : e.length, i = 0, o = []; ++r < n;) {
                var a = e[r];
                t(a, r, e) && (o[i++] = a)
            }
            return o
        }
        Oc.exports = tT
    });
    var xi = d((l1, Cc) => {
        function rT() {
            return []
        }
        Cc.exports = rT
    });
    var Si = d((f1, Pc) => {
        var nT = Rc(),
            iT = xi(),
            oT = Object.prototype,
            aT = oT.propertyIsEnumerable,
            Lc = Object.getOwnPropertySymbols,
            sT = Lc ? function(e) {
                return e == null ? [] : (e = Object(e), nT(Lc(e), function(t) {
                    return aT.call(e, t)
                }))
            } : iT;
        Pc.exports = sT
    });
    var Dc = d((d1, Nc) => {
        function uT(e, t) {
            for (var r = -1, n = Array(e); ++r < e;) n[r] = t(r);
            return n
        }
        Nc.exports = uT
    });
    var Fc = d((p1, Mc) => {
        var cT = ct(),
            lT = nt(),
            fT = "[object Arguments]";

        function dT(e) {
            return lT(e) && cT(e) == fT
        }
        Mc.exports = dT
    });
    var or = d((g1, Gc) => {
        var qc = Fc(),
            pT = nt(),
            Xc = Object.prototype,
            gT = Xc.hasOwnProperty,
            hT = Xc.propertyIsEnumerable,
            vT = qc(function() {
                return arguments
            }()) ? qc : function(e) {
                return pT(e) && gT.call(e, "callee") && !hT.call(e, "callee")
            };
        Gc.exports = vT
    });
    var Vc = d((h1, kc) => {
        function mT() {
            return !1
        }
        kc.exports = mT
    });
    var jr = d((ar, Nt) => {
        var ET = Be(),
            yT = Vc(),
            Bc = typeof ar == "object" && ar && !ar.nodeType && ar,
            Uc = Bc && typeof Nt == "object" && Nt && !Nt.nodeType && Nt,
            _T = Uc && Uc.exports === Bc,
            Hc = _T ? ET.Buffer : void 0,
            IT = Hc ? Hc.isBuffer : void 0,
            bT = IT || yT;
        Nt.exports = bT
    });
    var Yr = d((v1, Wc) => {
        var TT = 9007199254740991,
            wT = /^(?:0|[1-9]\d*)$/;

        function AT(e, t) {
            var r = typeof e;
            return t = t ? ? TT, !!t && (r == "number" || r != "symbol" && wT.test(e)) && e > -1 && e % 1 == 0 && e < t
        }
        Wc.exports = AT
    });
    var Qr = d((m1, zc) => {
        var xT = 9007199254740991;

        function ST(e) {
            return typeof e == "number" && e > -1 && e % 1 == 0 && e <= xT
        }
        zc.exports = ST
    });
    var jc = d((E1, Kc) => {
        var OT = ct(),
            RT = Qr(),
            CT = nt(),
            LT = "[object Arguments]",
            PT = "[object Array]",
            NT = "[object Boolean]",
            DT = "[object Date]",
            MT = "[object Error]",
            FT = "[object Function]",
            qT = "[object Map]",
            XT = "[object Number]",
            GT = "[object Object]",
            kT = "[object RegExp]",
            VT = "[object Set]",
            UT = "[object String]",
            HT = "[object WeakMap]",
            BT = "[object ArrayBuffer]",
            WT = "[object DataView]",
            zT = "[object Float32Array]",
            KT = "[object Float64Array]",
            jT = "[object Int8Array]",
            YT = "[object Int16Array]",
            QT = "[object Int32Array]",
            $T = "[object Uint8Array]",
            ZT = "[object Uint8ClampedArray]",
            JT = "[object Uint16Array]",
            ew = "[object Uint32Array]",
            he = {};
        he[zT] = he[KT] = he[jT] = he[YT] = he[QT] = he[$T] = he[ZT] = he[JT] = he[ew] = !0;
        he[LT] = he[PT] = he[BT] = he[NT] = he[WT] = he[DT] = he[MT] = he[FT] = he[qT] = he[XT] = he[GT] = he[kT] = he[VT] = he[UT] = he[HT] = !1;

        function tw(e) {
            return CT(e) && RT(e.length) && !!he[OT(e)]
        }
        Kc.exports = tw
    });
    var Qc = d((y1, Yc) => {
        function rw(e) {
            return function(t) {
                return e(t)
            }
        }
        Yc.exports = rw
    });
    var Zc = d((sr, Dt) => {
        var nw = Jn(),
            $c = typeof sr == "object" && sr && !sr.nodeType && sr,
            ur = $c && typeof Dt == "object" && Dt && !Dt.nodeType && Dt,
            iw = ur && ur.exports === $c,
            Oi = iw && nw.process,
            ow = function() {
                try {
                    var e = ur && ur.require && ur.require("util").types;
                    return e || Oi && Oi.binding && Oi.binding("util")
                } catch {}
            }();
        Dt.exports = ow
    });
    var $r = d((_1, tl) => {
        var aw = jc(),
            sw = Qc(),
            Jc = Zc(),
            el = Jc && Jc.isTypedArray,
            uw = el ? sw(el) : aw;
        tl.exports = uw
    });
    var Ri = d((I1, rl) => {
        var cw = Dc(),
            lw = or(),
            fw = Te(),
            dw = jr(),
            pw = Yr(),
            gw = $r(),
            hw = Object.prototype,
            vw = hw.hasOwnProperty;

        function mw(e, t) {
            var r = fw(e),
                n = !r && lw(e),
                i = !r && !n && dw(e),
                o = !r && !n && !i && gw(e),
                a = r || n || i || o,
                s = a ? cw(e.length, String) : [],
                u = s.length;
            for (var l in e)(t || vw.call(e, l)) && !(a && (l == "length" || i && (l == "offset" || l == "parent") || o && (l == "buffer" || l == "byteLength" || l == "byteOffset") || pw(l, u))) && s.push(l);
            return s
        }
        rl.exports = mw
    });
    var Zr = d((b1, nl) => {
        var Ew = Object.prototype;

        function yw(e) {
            var t = e && e.constructor,
                r = typeof t == "function" && t.prototype || Ew;
            return e === r
        }
        nl.exports = yw
    });
    var ol = d((T1, il) => {
        var _w = ei(),
            Iw = _w(Object.keys, Object);
        il.exports = Iw
    });
    var Jr = d((w1, al) => {
        var bw = Zr(),
            Tw = ol(),
            ww = Object.prototype,
            Aw = ww.hasOwnProperty;

        function xw(e) {
            if (!bw(e)) return Tw(e);
            var t = [];
            for (var r in Object(e)) Aw.call(e, r) && r != "constructor" && t.push(r);
            return t
        }
        al.exports = xw
    });
    var vt = d((A1, sl) => {
        var Sw = yi(),
            Ow = Qr();

        function Rw(e) {
            return e != null && Ow(e.length) && !Sw(e)
        }
        sl.exports = Rw
    });
    var cr = d((x1, ul) => {
        var Cw = Ri(),
            Lw = Jr(),
            Pw = vt();

        function Nw(e) {
            return Pw(e) ? Cw(e) : Lw(e)
        }
        ul.exports = Nw
    });
    var ll = d((S1, cl) => {
        var Dw = Ai(),
            Mw = Si(),
            Fw = cr();

        function qw(e) {
            return Dw(e, Fw, Mw)
        }
        cl.exports = qw
    });
    var pl = d((O1, dl) => {
        var fl = ll(),
            Xw = 1,
            Gw = Object.prototype,
            kw = Gw.hasOwnProperty;

        function Vw(e, t, r, n, i, o) {
            var a = r & Xw,
                s = fl(e),
                u = s.length,
                l = fl(t),
                m = l.length;
            if (u != m && !a) return !1;
            for (var f = u; f--;) {
                var g = s[f];
                if (!(a ? g in t : kw.call(t, g))) return !1
            }
            var p = o.get(e),
                h = o.get(t);
            if (p && h) return p == t && h == e;
            var _ = !0;
            o.set(e, t), o.set(t, e);
            for (var T = a; ++f < u;) {
                g = s[f];
                var I = e[g],
                    C = t[g];
                if (n) var S = a ? n(C, I, g, t, e, o) : n(I, C, g, e, t, o);
                if (!(S === void 0 ? I === C || i(I, C, r, n, o) : S)) {
                    _ = !1;
                    break
                }
                T || (T = g == "constructor")
            }
            if (_ && !T) {
                var P = e.constructor,
                    N = t.constructor;
                P != N && "constructor" in e && "constructor" in t && !(typeof P == "function" && P instanceof P && typeof N == "function" && N instanceof N) && (_ = !1)
            }
            return o.delete(e), o.delete(t), _
        }
        dl.exports = Vw
    });
    var hl = d((R1, gl) => {
        var Uw = lt(),
            Hw = Be(),
            Bw = Uw(Hw, "DataView");
        gl.exports = Bw
    });
    var ml = d((C1, vl) => {
        var Ww = lt(),
            zw = Be(),
            Kw = Ww(zw, "Promise");
        vl.exports = Kw
    });
    var yl = d((L1, El) => {
        var jw = lt(),
            Yw = Be(),
            Qw = jw(Yw, "Set");
        El.exports = Qw
    });
    var Ci = d((P1, _l) => {
        var $w = lt(),
            Zw = Be(),
            Jw = $w(Zw, "WeakMap");
        _l.exports = Jw
    });
    var en = d((N1, Sl) => {
        var Li = hl(),
            Pi = Br(),
            Ni = ml(),
            Di = yl(),
            Mi = Ci(),
            xl = ct(),
            Mt = Ii(),
            Il = "[object Map]",
            e0 = "[object Object]",
            bl = "[object Promise]",
            Tl = "[object Set]",
            wl = "[object WeakMap]",
            Al = "[object DataView]",
            t0 = Mt(Li),
            r0 = Mt(Pi),
            n0 = Mt(Ni),
            i0 = Mt(Di),
            o0 = Mt(Mi),
            mt = xl;
        (Li && mt(new Li(new ArrayBuffer(1))) != Al || Pi && mt(new Pi) != Il || Ni && mt(Ni.resolve()) != bl || Di && mt(new Di) != Tl || Mi && mt(new Mi) != wl) && (mt = function(e) {
            var t = xl(e),
                r = t == e0 ? e.constructor : void 0,
                n = r ? Mt(r) : "";
            if (n) switch (n) {
                case t0:
                    return Al;
                case r0:
                    return Il;
                case n0:
                    return bl;
                case i0:
                    return Tl;
                case o0:
                    return wl
            }
            return t
        });
        Sl.exports = mt
    });
    var Ml = d((D1, Dl) => {
        var Fi = bi(),
            a0 = Ti(),
            s0 = wc(),
            u0 = pl(),
            Ol = en(),
            Rl = Te(),
            Cl = jr(),
            c0 = $r(),
            l0 = 1,
            Ll = "[object Arguments]",
            Pl = "[object Array]",
            tn = "[object Object]",
            f0 = Object.prototype,
            Nl = f0.hasOwnProperty;

        function d0(e, t, r, n, i, o) {
            var a = Rl(e),
                s = Rl(t),
                u = a ? Pl : Ol(e),
                l = s ? Pl : Ol(t);
            u = u == Ll ? tn : u, l = l == Ll ? tn : l;
            var m = u == tn,
                f = l == tn,
                g = u == l;
            if (g && Cl(e)) {
                if (!Cl(t)) return !1;
                a = !0, m = !1
            }
            if (g && !m) return o || (o = new Fi), a || c0(e) ? a0(e, t, r, n, i, o) : s0(e, t, u, r, n, i, o);
            if (!(r & l0)) {
                var p = m && Nl.call(e, "__wrapped__"),
                    h = f && Nl.call(t, "__wrapped__");
                if (p || h) {
                    var _ = p ? e.value() : e,
                        T = h ? t.value() : t;
                    return o || (o = new Fi), i(_, T, r, n, o)
                }
            }
            return g ? (o || (o = new Fi), u0(e, t, r, n, i, o)) : !1
        }
        Dl.exports = d0
    });
    var qi = d((M1, Xl) => {
        var p0 = Ml(),
            Fl = nt();

        function ql(e, t, r, n, i) {
            return e === t ? !0 : e == null || t == null || !Fl(e) && !Fl(t) ? e !== e && t !== t : p0(e, t, r, n, ql, i)
        }
        Xl.exports = ql
    });
    var kl = d((F1, Gl) => {
        var g0 = bi(),
            h0 = qi(),
            v0 = 1,
            m0 = 2;

        function E0(e, t, r, n) {
            var i = r.length,
                o = i,
                a = !n;
            if (e == null) return !o;
            for (e = Object(e); i--;) {
                var s = r[i];
                if (a && s[2] ? s[1] !== e[s[0]] : !(s[0] in e)) return !1
            }
            for (; ++i < o;) {
                s = r[i];
                var u = s[0],
                    l = e[u],
                    m = s[1];
                if (a && s[2]) {
                    if (l === void 0 && !(u in e)) return !1
                } else {
                    var f = new g0;
                    if (n) var g = n(l, m, u, e, t, f);
                    if (!(g === void 0 ? h0(m, l, v0 | m0, n, f) : g)) return !1
                }
            }
            return !0
        }
        Gl.exports = E0
    });
    var Xi = d((q1, Vl) => {
        var y0 = Je();

        function _0(e) {
            return e === e && !y0(e)
        }
        Vl.exports = _0
    });
    var Hl = d((X1, Ul) => {
        var I0 = Xi(),
            b0 = cr();

        function T0(e) {
            for (var t = b0(e), r = t.length; r--;) {
                var n = t[r],
                    i = e[n];
                t[r] = [n, i, I0(i)]
            }
            return t
        }
        Ul.exports = T0
    });
    var Gi = d((G1, Bl) => {
        function w0(e, t) {
            return function(r) {
                return r == null ? !1 : r[e] === t && (t !== void 0 || e in Object(r))
            }
        }
        Bl.exports = w0
    });
    var zl = d((k1, Wl) => {
        var A0 = kl(),
            x0 = Hl(),
            S0 = Gi();

        function O0(e) {
            var t = x0(e);
            return t.length == 1 && t[0][2] ? S0(t[0][0], t[0][1]) : function(r) {
                return r === e || A0(r, e, t)
            }
        }
        Wl.exports = O0
    });
    var lr = d((V1, Kl) => {
        var R0 = ct(),
            C0 = nt(),
            L0 = "[object Symbol]";

        function P0(e) {
            return typeof e == "symbol" || C0(e) && R0(e) == L0
        }
        Kl.exports = P0
    });
    var rn = d((U1, jl) => {
        var N0 = Te(),
            D0 = lr(),
            M0 = /\.|\[(?:[^[\]]*|(["'])(?:(?!\1)[^\\]|\\.)*?\1)\]/,
            F0 = /^\w*$/;

        function q0(e, t) {
            if (N0(e)) return !1;
            var r = typeof e;
            return r == "number" || r == "symbol" || r == "boolean" || e == null || D0(e) ? !0 : F0.test(e) || !M0.test(e) || t != null && e in Object(t)
        }
        jl.exports = q0
    });
    var $l = d((H1, Ql) => {
        var Yl = Wr(),
            X0 = "Expected a function";

        function ki(e, t) {
            if (typeof e != "function" || t != null && typeof t != "function") throw new TypeError(X0);
            var r = function() {
                var n = arguments,
                    i = t ? t.apply(this, n) : n[0],
                    o = r.cache;
                if (o.has(i)) return o.get(i);
                var a = e.apply(this, n);
                return r.cache = o.set(i, a) || o, a
            };
            return r.cache = new(ki.Cache || Yl), r
        }
        ki.Cache = Yl;
        Ql.exports = ki
    });
    var Jl = d((B1, Zl) => {
        var G0 = $l(),
            k0 = 500;

        function V0(e) {
            var t = G0(e, function(n) {
                    return r.size === k0 && r.clear(), n
                }),
                r = t.cache;
            return t
        }
        Zl.exports = V0
    });
    var tf = d((W1, ef) => {
        var U0 = Jl(),
            H0 = /[^.[\]]+|\[(?:(-?\d+(?:\.\d+)?)|(["'])((?:(?!\2)[^\\]|\\.)*?)\2)\]|(?=(?:\.|\[\])(?:\.|\[\]|$))/g,
            B0 = /\\(\\)?/g,
            W0 = U0(function(e) {
                var t = [];
                return e.charCodeAt(0) === 46 && t.push(""), e.replace(H0, function(r, n, i, o) {
                    t.push(i ? o.replace(B0, "$1") : n || r)
                }), t
            });
        ef.exports = W0
    });
    var Vi = d((z1, rf) => {
        function z0(e, t) {
            for (var r = -1, n = e == null ? 0 : e.length, i = Array(n); ++r < n;) i[r] = t(e[r], r, e);
            return i
        }
        rf.exports = z0
    });
    var cf = d((K1, uf) => {
        var nf = At(),
            K0 = Vi(),
            j0 = Te(),
            Y0 = lr(),
            Q0 = 1 / 0,
            of = nf ? nf.prototype : void 0,
            af = of ? of .toString : void 0;

        function sf(e) {
            if (typeof e == "string") return e;
            if (j0(e)) return K0(e, sf) + "";
            if (Y0(e)) return af ? af.call(e) : "";
            var t = e + "";
            return t == "0" && 1 / e == -Q0 ? "-0" : t
        }
        uf.exports = sf
    });
    var ff = d((j1, lf) => {
        var $0 = cf();

        function Z0(e) {
            return e == null ? "" : $0(e)
        }
        lf.exports = Z0
    });
    var fr = d((Y1, df) => {
        var J0 = Te(),
            eA = rn(),
            tA = tf(),
            rA = ff();

        function nA(e, t) {
            return J0(e) ? e : eA(e, t) ? [e] : tA(rA(e))
        }
        df.exports = nA
    });
    var Ft = d((Q1, pf) => {
        var iA = lr(),
            oA = 1 / 0;

        function aA(e) {
            if (typeof e == "string" || iA(e)) return e;
            var t = e + "";
            return t == "0" && 1 / e == -oA ? "-0" : t
        }
        pf.exports = aA
    });
    var nn = d(($1, gf) => {
        var sA = fr(),
            uA = Ft();

        function cA(e, t) {
            t = sA(t, e);
            for (var r = 0, n = t.length; e != null && r < n;) e = e[uA(t[r++])];
            return r && r == n ? e : void 0
        }
        gf.exports = cA
    });
    var on = d((Z1, hf) => {
        var lA = nn();

        function fA(e, t, r) {
            var n = e == null ? void 0 : lA(e, t);
            return n === void 0 ? r : n
        }
        hf.exports = fA
    });
    var mf = d((J1, vf) => {
        function dA(e, t) {
            return e != null && t in Object(e)
        }
        vf.exports = dA
    });
    var yf = d((eq, Ef) => {
        var pA = fr(),
            gA = or(),
            hA = Te(),
            vA = Yr(),
            mA = Qr(),
            EA = Ft();

        function yA(e, t, r) {
            t = pA(t, e);
            for (var n = -1, i = t.length, o = !1; ++n < i;) {
                var a = EA(t[n]);
                if (!(o = e != null && r(e, a))) break;
                e = e[a]
            }
            return o || ++n != i ? o : (i = e == null ? 0 : e.length, !!i && mA(i) && vA(a, i) && (hA(e) || gA(e)))
        }
        Ef.exports = yA
    });
    var If = d((tq, _f) => {
        var _A = mf(),
            IA = yf();

        function bA(e, t) {
            return e != null && IA(e, t, _A)
        }
        _f.exports = bA
    });
    var Tf = d((rq, bf) => {
        var TA = qi(),
            wA = on(),
            AA = If(),
            xA = rn(),
            SA = Xi(),
            OA = Gi(),
            RA = Ft(),
            CA = 1,
            LA = 2;

        function PA(e, t) {
            return xA(e) && SA(t) ? OA(RA(e), t) : function(r) {
                var n = wA(r, e);
                return n === void 0 && n === t ? AA(r, e) : TA(t, n, CA | LA)
            }
        }
        bf.exports = PA
    });
    var an = d((nq, wf) => {
        function NA(e) {
            return e
        }
        wf.exports = NA
    });
    var Ui = d((iq, Af) => {
        function DA(e) {
            return function(t) {
                return t ? .[e]
            }
        }
        Af.exports = DA
    });
    var Sf = d((oq, xf) => {
        var MA = nn();

        function FA(e) {
            return function(t) {
                return MA(t, e)
            }
        }
        xf.exports = FA
    });
    var Rf = d((aq, Of) => {
        var qA = Ui(),
            XA = Sf(),
            GA = rn(),
            kA = Ft();

        function VA(e) {
            return GA(e) ? qA(kA(e)) : XA(e)
        }
        Of.exports = VA
    });
    var ft = d((sq, Cf) => {
        var UA = zl(),
            HA = Tf(),
            BA = an(),
            WA = Te(),
            zA = Rf();

        function KA(e) {
            return typeof e == "function" ? e : e == null ? BA : typeof e == "object" ? WA(e) ? HA(e[0], e[1]) : UA(e) : zA(e)
        }
        Cf.exports = KA
    });
    var Hi = d((uq, Lf) => {
        var jA = ft(),
            YA = vt(),
            QA = cr();

        function $A(e) {
            return function(t, r, n) {
                var i = Object(t);
                if (!YA(t)) {
                    var o = jA(r, 3);
                    t = QA(t), r = function(s) {
                        return o(i[s], s, i)
                    }
                }
                var a = e(t, r, n);
                return a > -1 ? i[o ? t[a] : a] : void 0
            }
        }
        Lf.exports = $A
    });
    var Bi = d((cq, Pf) => {
        function ZA(e, t, r, n) {
            for (var i = e.length, o = r + (n ? 1 : -1); n ? o-- : ++o < i;)
                if (t(e[o], o, e)) return o;
            return -1
        }
        Pf.exports = ZA
    });
    var Df = d((lq, Nf) => {
        var JA = /\s/;

        function ex(e) {
            for (var t = e.length; t-- && JA.test(e.charAt(t)););
            return t
        }
        Nf.exports = ex
    });
    var Ff = d((fq, Mf) => {
        var tx = Df(),
            rx = /^\s+/;

        function nx(e) {
            return e && e.slice(0, tx(e) + 1).replace(rx, "")
        }
        Mf.exports = nx
    });
    var sn = d((dq, Gf) => {
        var ix = Ff(),
            qf = Je(),
            ox = lr(),
            Xf = 0 / 0,
            ax = /^[-+]0x[0-9a-f]+$/i,
            sx = /^0b[01]+$/i,
            ux = /^0o[0-7]+$/i,
            cx = parseInt;

        function lx(e) {
            if (typeof e == "number") return e;
            if (ox(e)) return Xf;
            if (qf(e)) {
                var t = typeof e.valueOf == "function" ? e.valueOf() : e;
                e = qf(t) ? t + "" : t
            }
            if (typeof e != "string") return e === 0 ? e : +e;
            e = ix(e);
            var r = sx.test(e);
            return r || ux.test(e) ? cx(e.slice(2), r ? 2 : 8) : ax.test(e) ? Xf : +e
        }
        Gf.exports = lx
    });
    var Uf = d((pq, Vf) => {
        var fx = sn(),
            kf = 1 / 0,
            dx = 17976931348623157e292;

        function px(e) {
            if (!e) return e === 0 ? e : 0;
            if (e = fx(e), e === kf || e === -kf) {
                var t = e < 0 ? -1 : 1;
                return t * dx
            }
            return e === e ? e : 0
        }
        Vf.exports = px
    });
    var Wi = d((gq, Hf) => {
        var gx = Uf();

        function hx(e) {
            var t = gx(e),
                r = t % 1;
            return t === t ? r ? t - r : t : 0
        }
        Hf.exports = hx
    });
    var Wf = d((hq, Bf) => {
        var vx = Bi(),
            mx = ft(),
            Ex = Wi(),
            yx = Math.max;

        function _x(e, t, r) {
            var n = e == null ? 0 : e.length;
            if (!n) return -1;
            var i = r == null ? 0 : Ex(r);
            return i < 0 && (i = yx(n + i, 0)), vx(e, mx(t, 3), i)
        }
        Bf.exports = _x
    });
    var zi = d((vq, zf) => {
        var Ix = Hi(),
            bx = Wf(),
            Tx = Ix(bx);
        zf.exports = Tx
    });
    var Yf = {};
    Pe(Yf, {
        ELEMENT_MATCHES: () => wx,
        FLEX_PREFIXED: () => Ki,
        IS_BROWSER_ENV: () => ze,
        TRANSFORM_PREFIXED: () => dt,
        TRANSFORM_STYLE_PREFIXED: () => cn,
        withBrowser: () => un
    });
    var jf, ze, un, wx, Ki, dt, Kf, cn, ln = ve(() => {
        "use strict";
        jf = le(zi()), ze = typeof window < "u", un = (e, t) => ze ? e() : t, wx = un(() => (0, jf.default)(["matches", "matchesSelector", "mozMatchesSelector", "msMatchesSelector", "oMatchesSelector", "webkitMatchesSelector"], e => e in Element.prototype)), Ki = un(() => {
            let e = document.createElement("i"),
                t = ["flex", "-webkit-flex", "-ms-flexbox", "-moz-box", "-webkit-box"],
                r = "";
            try {
                let {
                    length: n
                } = t;
                for (let i = 0; i < n; i++) {
                    let o = t[i];
                    if (e.style.display = o, e.style.display === o) return o
                }
                return r
            } catch {
                return r
            }
        }, "flex"), dt = un(() => {
            let e = document.createElement("i");
            if (e.style.transform == null) {
                let t = ["Webkit", "Moz", "ms"],
                    r = "Transform",
                    {
                        length: n
                    } = t;
                for (let i = 0; i < n; i++) {
                    let o = t[i] + r;
                    if (e.style[o] !== void 0) return o
                }
            }
            return "transform"
        }, "transform"), Kf = dt.split("transform")[0], cn = Kf ? Kf + "TransformStyle" : "transformStyle"
    });
    var ji = d((mq, ed) => {
        var Ax = 4,
            xx = .001,
            Sx = 1e-7,
            Ox = 10,
            dr = 11,
            fn = 1 / (dr - 1),
            Rx = typeof Float32Array == "function";

        function Qf(e, t) {
            return 1 - 3 * t + 3 * e
        }

        function $f(e, t) {
            return 3 * t - 6 * e
        }

        function Zf(e) {
            return 3 * e
        }

        function dn(e, t, r) {
            return ((Qf(t, r) * e + $f(t, r)) * e + Zf(t)) * e
        }

        function Jf(e, t, r) {
            return 3 * Qf(t, r) * e * e + 2 * $f(t, r) * e + Zf(t)
        }

        function Cx(e, t, r, n, i) {
            var o, a, s = 0;
            do a = t + (r - t) / 2, o = dn(a, n, i) - e, o > 0 ? r = a : t = a; while (Math.abs(o) > Sx && ++s < Ox);
            return a
        }

        function Lx(e, t, r, n) {
            for (var i = 0; i < Ax; ++i) {
                var o = Jf(t, r, n);
                if (o === 0) return t;
                var a = dn(t, r, n) - e;
                t -= a / o
            }
            return t
        }
        ed.exports = function(t, r, n, i) {
            if (!(0 <= t && t <= 1 && 0 <= n && n <= 1)) throw new Error("bezier x values must be in [0, 1] range");
            var o = Rx ? new Float32Array(dr) : new Array(dr);
            if (t !== r || n !== i)
                for (var a = 0; a < dr; ++a) o[a] = dn(a * fn, t, n);

            function s(u) {
                for (var l = 0, m = 1, f = dr - 1; m !== f && o[m] <= u; ++m) l += fn;
                --m;
                var g = (u - o[m]) / (o[m + 1] - o[m]),
                    p = l + g * fn,
                    h = Jf(p, t, n);
                return h >= xx ? Lx(u, p, t, n) : h === 0 ? p : Cx(u, l, l + fn, t, n)
            }
            return function(l) {
                return t === r && n === i ? l : l === 0 ? 0 : l === 1 ? 1 : dn(s(l), r, i)
            }
        }
    });
    var gr = {};
    Pe(gr, {
        bounce: () => pS,
        bouncePast: () => gS,
        ease: () => Px,
        easeIn: () => Nx,
        easeInOut: () => Mx,
        easeOut: () => Dx,
        inBack: () => iS,
        inCirc: () => eS,
        inCubic: () => Gx,
        inElastic: () => sS,
        inExpo: () => $x,
        inOutBack: () => aS,
        inOutCirc: () => rS,
        inOutCubic: () => Vx,
        inOutElastic: () => cS,
        inOutExpo: () => Jx,
        inOutQuad: () => Xx,
        inOutQuart: () => Bx,
        inOutQuint: () => Kx,
        inOutSine: () => Qx,
        inQuad: () => Fx,
        inQuart: () => Ux,
        inQuint: () => Wx,
        inSine: () => jx,
        outBack: () => oS,
        outBounce: () => nS,
        outCirc: () => tS,
        outCubic: () => kx,
        outElastic: () => uS,
        outExpo: () => Zx,
        outQuad: () => qx,
        outQuart: () => Hx,
        outQuint: () => zx,
        outSine: () => Yx,
        swingFrom: () => fS,
        swingFromTo: () => lS,
        swingTo: () => dS
    });

    function Fx(e) {
        return Math.pow(e, 2)
    }

    function qx(e) {
        return -(Math.pow(e - 1, 2) - 1)
    }

    function Xx(e) {
        return (e /= .5) < 1 ? .5 * Math.pow(e, 2) : -.5 * ((e -= 2) * e - 2)
    }

    function Gx(e) {
        return Math.pow(e, 3)
    }

    function kx(e) {
        return Math.pow(e - 1, 3) + 1
    }

    function Vx(e) {
        return (e /= .5) < 1 ? .5 * Math.pow(e, 3) : .5 * (Math.pow(e - 2, 3) + 2)
    }

    function Ux(e) {
        return Math.pow(e, 4)
    }

    function Hx(e) {
        return -(Math.pow(e - 1, 4) - 1)
    }

    function Bx(e) {
        return (e /= .5) < 1 ? .5 * Math.pow(e, 4) : -.5 * ((e -= 2) * Math.pow(e, 3) - 2)
    }

    function Wx(e) {
        return Math.pow(e, 5)
    }

    function zx(e) {
        return Math.pow(e - 1, 5) + 1
    }

    function Kx(e) {
        return (e /= .5) < 1 ? .5 * Math.pow(e, 5) : .5 * (Math.pow(e - 2, 5) + 2)
    }

    function jx(e) {
        return -Math.cos(e * (Math.PI / 2)) + 1
    }

    function Yx(e) {
        return Math.sin(e * (Math.PI / 2))
    }

    function Qx(e) {
        return -.5 * (Math.cos(Math.PI * e) - 1)
    }

    function $x(e) {
        return e === 0 ? 0 : Math.pow(2, 10 * (e - 1))
    }

    function Zx(e) {
        return e === 1 ? 1 : -Math.pow(2, -10 * e) + 1
    }

    function Jx(e) {
        return e === 0 ? 0 : e === 1 ? 1 : (e /= .5) < 1 ? .5 * Math.pow(2, 10 * (e - 1)) : .5 * (-Math.pow(2, -10 * --e) + 2)
    }

    function eS(e) {
        return -(Math.sqrt(1 - e * e) - 1)
    }

    function tS(e) {
        return Math.sqrt(1 - Math.pow(e - 1, 2))
    }

    function rS(e) {
        return (e /= .5) < 1 ? -.5 * (Math.sqrt(1 - e * e) - 1) : .5 * (Math.sqrt(1 - (e -= 2) * e) + 1)
    }

    function nS(e) {
        return e < 1 / 2.75 ? 7.5625 * e * e : e < 2 / 2.75 ? 7.5625 * (e -= 1.5 / 2.75) * e + .75 : e < 2.5 / 2.75 ? 7.5625 * (e -= 2.25 / 2.75) * e + .9375 : 7.5625 * (e -= 2.625 / 2.75) * e + .984375
    }

    function iS(e) {
        let t = it;
        return e * e * ((t + 1) * e - t)
    }

    function oS(e) {
        let t = it;
        return (e -= 1) * e * ((t + 1) * e + t) + 1
    }

    function aS(e) {
        let t = it;
        return (e /= .5) < 1 ? .5 * (e * e * (((t *= 1.525) + 1) * e - t)) : .5 * ((e -= 2) * e * (((t *= 1.525) + 1) * e + t) + 2)
    }

    function sS(e) {
        let t = it,
            r = 0,
            n = 1;
        return e === 0 ? 0 : e === 1 ? 1 : (r || (r = .3), n < 1 ? (n = 1, t = r / 4) : t = r / (2 * Math.PI) * Math.asin(1 / n), -(n * Math.pow(2, 10 * (e -= 1)) * Math.sin((e - t) * (2 * Math.PI) / r)))
    }

    function uS(e) {
        let t = it,
            r = 0,
            n = 1;
        return e === 0 ? 0 : e === 1 ? 1 : (r || (r = .3), n < 1 ? (n = 1, t = r / 4) : t = r / (2 * Math.PI) * Math.asin(1 / n), n * Math.pow(2, -10 * e) * Math.sin((e - t) * (2 * Math.PI) / r) + 1)
    }

    function cS(e) {
        let t = it,
            r = 0,
            n = 1;
        return e === 0 ? 0 : (e /= 1 / 2) === 2 ? 1 : (r || (r = .3 * 1.5), n < 1 ? (n = 1, t = r / 4) : t = r / (2 * Math.PI) * Math.asin(1 / n), e < 1 ? -.5 * (n * Math.pow(2, 10 * (e -= 1)) * Math.sin((e - t) * (2 * Math.PI) / r)) : n * Math.pow(2, -10 * (e -= 1)) * Math.sin((e - t) * (2 * Math.PI) / r) * .5 + 1)
    }

    function lS(e) {
        let t = it;
        return (e /= .5) < 1 ? .5 * (e * e * (((t *= 1.525) + 1) * e - t)) : .5 * ((e -= 2) * e * (((t *= 1.525) + 1) * e + t) + 2)
    }

    function fS(e) {
        let t = it;
        return e * e * ((t + 1) * e - t)
    }

    function dS(e) {
        let t = it;
        return (e -= 1) * e * ((t + 1) * e + t) + 1
    }

    function pS(e) {
        return e < 1 / 2.75 ? 7.5625 * e * e : e < 2 / 2.75 ? 7.5625 * (e -= 1.5 / 2.75) * e + .75 : e < 2.5 / 2.75 ? 7.5625 * (e -= 2.25 / 2.75) * e + .9375 : 7.5625 * (e -= 2.625 / 2.75) * e + .984375
    }

    function gS(e) {
        return e < 1 / 2.75 ? 7.5625 * e * e : e < 2 / 2.75 ? 2 - (7.5625 * (e -= 1.5 / 2.75) * e + .75) : e < 2.5 / 2.75 ? 2 - (7.5625 * (e -= 2.25 / 2.75) * e + .9375) : 2 - (7.5625 * (e -= 2.625 / 2.75) * e + .984375)
    }
    var pr, it, Px, Nx, Dx, Mx, Yi = ve(() => {
        "use strict";
        pr = le(ji()), it = 1.70158, Px = (0, pr.default)(.25, .1, .25, 1), Nx = (0, pr.default)(.42, 0, 1, 1), Dx = (0, pr.default)(0, 0, .58, 1), Mx = (0, pr.default)(.42, 0, .58, 1)
    });
    var rd = {};
    Pe(rd, {
        applyEasing: () => vS,
        createBezierEasing: () => hS,
        optimizeFloat: () => hr
    });

    function hr(e, t = 5, r = 10) {
        let n = Math.pow(r, t),
            i = Number(Math.round(e * n) / n);
        return Math.abs(i) > 1e-4 ? i : 0
    }

    function hS(e) {
        return (0, td.default)(...e)
    }

    function vS(e, t, r) {
        return t === 0 ? 0 : t === 1 ? 1 : hr(r ? t > 0 ? r(t) : t : t > 0 && e && gr[e] ? gr[e](t) : t)
    }
    var td, Qi = ve(() => {
        "use strict";
        Yi();
        td = le(ji())
    });
    var od = {};
    Pe(od, {
        createElementState: () => id,
        ixElements: () => CS,
        mergeActionState: () => $i
    });

    function id(e, t, r, n, i) {
        let o = r === mS ? (0, qt.getIn)(i, ["config", "target", "objectId"]) : null;
        return (0, qt.mergeIn)(e, [n], {
            id: n,
            ref: t,
            refId: o,
            refType: r
        })
    }

    function $i(e, t, r, n, i) {
        let o = PS(i);
        return (0, qt.mergeIn)(e, [t, RS, r], n, o)
    }

    function PS(e) {
        let {
            config: t
        } = e;
        return LS.reduce((r, n) => {
            let i = n[0],
                o = n[1],
                a = t[i],
                s = t[o];
            return a != null && s != null && (r[o] = s), r
        }, {})
    }
    var qt, yq, mS, _q, ES, yS, _S, IS, bS, TS, wS, AS, xS, SS, OS, nd, RS, CS, LS, ad = ve(() => {
        "use strict";
        qt = le(Ot());
        De();
        ({
            HTML_ELEMENT: yq,
            PLAIN_OBJECT: mS,
            ABSTRACT_NODE: _q,
            CONFIG_X_VALUE: ES,
            CONFIG_Y_VALUE: yS,
            CONFIG_Z_VALUE: _S,
            CONFIG_VALUE: IS,
            CONFIG_X_UNIT: bS,
            CONFIG_Y_UNIT: TS,
            CONFIG_Z_UNIT: wS,
            CONFIG_UNIT: AS
        } = Ae), {
            IX2_SESSION_STOPPED: xS,
            IX2_INSTANCE_ADDED: SS,
            IX2_ELEMENT_STATE_CHANGED: OS
        } = be, nd = {}, RS = "refState", CS = (e = nd, t = {}) => {
            switch (t.type) {
                case xS:
                    return nd;
                case SS:
                    {
                        let {
                            elementId: r,
                            element: n,
                            origin: i,
                            actionItem: o,
                            refType: a
                        } = t.payload,
                        {
                            actionTypeId: s
                        } = o,
                        u = e;
                        return (0, qt.getIn)(u, [r, n]) !== n && (u = id(u, n, a, r, o)),
                        $i(u, r, s, i, o)
                    }
                case OS:
                    {
                        let {
                            elementId: r,
                            actionTypeId: n,
                            current: i,
                            actionItem: o
                        } = t.payload;
                        return $i(e, r, n, i, o)
                    }
                default:
                    return e
            }
        };
        LS = [
            [ES, bS],
            [yS, TS],
            [_S, wS],
            [IS, AS]
        ]
    });
    var sd = d(Zi => {
        "use strict";
        Object.defineProperty(Zi, "__esModule", {
            value: !0
        });

        function NS(e, t) {
            for (var r in t) Object.defineProperty(e, r, {
                enumerable: !0,
                get: t[r]
            })
        }
        NS(Zi, {
            clearPlugin: function() {
                return kS
            },
            createPluginInstance: function() {
                return XS
            },
            getPluginConfig: function() {
                return DS
            },
            getPluginDestination: function() {
                return qS
            },
            getPluginDuration: function() {
                return MS
            },
            getPluginOrigin: function() {
                return FS
            },
            renderPlugin: function() {
                return GS
            }
        });
        var DS = e => e.value,
            MS = (e, t) => {
                if (t.config.duration !== "auto") return null;
                let r = parseFloat(e.getAttribute("data-duration"));
                return r > 0 ? r * 1e3 : parseFloat(e.getAttribute("data-default-duration")) * 1e3
            },
            FS = e => e || {
                value: 0
            },
            qS = e => ({
                value: e.value
            }),
            XS = e => {
                let t = window.Webflow.require("lottie").createInstance(e);
                return t.stop(), t.setSubframe(!0), t
            },
            GS = (e, t, r) => {
                if (!e) return;
                let n = t[r.actionTypeId].value / 100;
                e.goToFrame(e.frames * n)
            },
            kS = e => {
                window.Webflow.require("lottie").createInstance(e).stop()
            }
    });
    var cd = d(Ji => {
        "use strict";
        Object.defineProperty(Ji, "__esModule", {
            value: !0
        });

        function VS(e, t) {
            for (var r in t) Object.defineProperty(e, r, {
                enumerable: !0,
                get: t[r]
            })
        }
        VS(Ji, {
            clearPlugin: function() {
                return $S
            },
            createPluginInstance: function() {
                return YS
            },
            getPluginConfig: function() {
                return WS
            },
            getPluginDestination: function() {
                return jS
            },
            getPluginDuration: function() {
                return zS
            },
            getPluginOrigin: function() {
                return KS
            },
            renderPlugin: function() {
                return QS
            }
        });
        var US = e => document.querySelector(`[data-w-id="${e}"]`),
            HS = () => window.Webflow.require("spline"),
            BS = (e, t) => e.filter(r => !t.includes(r)),
            WS = (e, t) => e.value[t],
            zS = () => null,
            ud = Object.freeze({
                positionX: 0,
                positionY: 0,
                positionZ: 0,
                rotationX: 0,
                rotationY: 0,
                rotationZ: 0,
                scaleX: 1,
                scaleY: 1,
                scaleZ: 1
            }),
            KS = (e, t) => {
                let r = t.config.value,
                    n = Object.keys(r);
                if (e) {
                    let o = Object.keys(e),
                        a = BS(n, o);
                    return a.length ? a.reduce((u, l) => (u[l] = ud[l], u), e) : e
                }
                return n.reduce((o, a) => (o[a] = ud[a], o), {})
            },
            jS = e => e.value,
            YS = (e, t) => {
                let r = t ? .config ? .target ? .pluginElement;
                return r ? US(r) : null
            },
            QS = (e, t, r) => {
                let n = HS(),
                    i = n.getInstance(e),
                    o = r.config.target.objectId,
                    a = s => {
                        if (!s) throw new Error("Invalid spline app passed to renderSpline");
                        let u = o && s.findObjectById(o);
                        if (!u) return;
                        let {
                            PLUGIN_SPLINE: l
                        } = t;
                        l.positionX != null && (u.position.x = l.positionX), l.positionY != null && (u.position.y = l.positionY), l.positionZ != null && (u.position.z = l.positionZ), l.rotationX != null && (u.rotation.x = l.rotationX), l.rotationY != null && (u.rotation.y = l.rotationY), l.rotationZ != null && (u.rotation.z = l.rotationZ), l.scaleX != null && (u.scale.x = l.scaleX), l.scaleY != null && (u.scale.y = l.scaleY), l.scaleZ != null && (u.scale.z = l.scaleZ)
                    };
                i ? a(i.spline) : n.setLoadHandler(e, a)
            },
            $S = () => null
    });
    var to = d(eo => {
        "use strict";
        Object.defineProperty(eo, "__esModule", {
            value: !0
        });
        Object.defineProperty(eo, "normalizeColor", {
            enumerable: !0,
            get: function() {
                return ZS
            }
        });
        var ld = {
            aliceblue: "#F0F8FF",
            antiquewhite: "#FAEBD7",
            aqua: "#00FFFF",
            aquamarine: "#7FFFD4",
            azure: "#F0FFFF",
            beige: "#F5F5DC",
            bisque: "#FFE4C4",
            black: "#000000",
            blanchedalmond: "#FFEBCD",
            blue: "#0000FF",
            blueviolet: "#8A2BE2",
            brown: "#A52A2A",
            burlywood: "#DEB887",
            cadetblue: "#5F9EA0",
            chartreuse: "#7FFF00",
            chocolate: "#D2691E",
            coral: "#FF7F50",
            cornflowerblue: "#6495ED",
            cornsilk: "#FFF8DC",
            crimson: "#DC143C",
            cyan: "#00FFFF",
            darkblue: "#00008B",
            darkcyan: "#008B8B",
            darkgoldenrod: "#B8860B",
            darkgray: "#A9A9A9",
            darkgreen: "#006400",
            darkgrey: "#A9A9A9",
            darkkhaki: "#BDB76B",
            darkmagenta: "#8B008B",
            darkolivegreen: "#556B2F",
            darkorange: "#FF8C00",
            darkorchid: "#9932CC",
            darkred: "#8B0000",
            darksalmon: "#E9967A",
            darkseagreen: "#8FBC8F",
            darkslateblue: "#483D8B",
            darkslategray: "#2F4F4F",
            darkslategrey: "#2F4F4F",
            darkturquoise: "#00CED1",
            darkviolet: "#9400D3",
            deeppink: "#FF1493",
            deepskyblue: "#00BFFF",
            dimgray: "#696969",
            dimgrey: "#696969",
            dodgerblue: "#1E90FF",
            firebrick: "#B22222",
            floralwhite: "#FFFAF0",
            forestgreen: "#228B22",
            fuchsia: "#FF00FF",
            gainsboro: "#DCDCDC",
            ghostwhite: "#F8F8FF",
            gold: "#FFD700",
            goldenrod: "#DAA520",
            gray: "#808080",
            green: "#008000",
            greenyellow: "#ADFF2F",
            grey: "#808080",
            honeydew: "#F0FFF0",
            hotpink: "#FF69B4",
            indianred: "#CD5C5C",
            indigo: "#4B0082",
            ivory: "#FFFFF0",
            khaki: "#F0E68C",
            lavender: "#E6E6FA",
            lavenderblush: "#FFF0F5",
            lawngreen: "#7CFC00",
            lemonchiffon: "#FFFACD",
            lightblue: "#ADD8E6",
            lightcoral: "#F08080",
            lightcyan: "#E0FFFF",
            lightgoldenrodyellow: "#FAFAD2",
            lightgray: "#D3D3D3",
            lightgreen: "#90EE90",
            lightgrey: "#D3D3D3",
            lightpink: "#FFB6C1",
            lightsalmon: "#FFA07A",
            lightseagreen: "#20B2AA",
            lightskyblue: "#87CEFA",
            lightslategray: "#778899",
            lightslategrey: "#778899",
            lightsteelblue: "#B0C4DE",
            lightyellow: "#FFFFE0",
            lime: "#00FF00",
            limegreen: "#32CD32",
            linen: "#FAF0E6",
            magenta: "#FF00FF",
            maroon: "#800000",
            mediumaquamarine: "#66CDAA",
            mediumblue: "#0000CD",
            mediumorchid: "#BA55D3",
            mediumpurple: "#9370DB",
            mediumseagreen: "#3CB371",
            mediumslateblue: "#7B68EE",
            mediumspringgreen: "#00FA9A",
            mediumturquoise: "#48D1CC",
            mediumvioletred: "#C71585",
            midnightblue: "#191970",
            mintcream: "#F5FFFA",
            mistyrose: "#FFE4E1",
            moccasin: "#FFE4B5",
            navajowhite: "#FFDEAD",
            navy: "#000080",
            oldlace: "#FDF5E6",
            olive: "#808000",
            olivedrab: "#6B8E23",
            orange: "#FFA500",
            orangered: "#FF4500",
            orchid: "#DA70D6",
            palegoldenrod: "#EEE8AA",
            palegreen: "#98FB98",
            paleturquoise: "#AFEEEE",
            palevioletred: "#DB7093",
            papayawhip: "#FFEFD5",
            peachpuff: "#FFDAB9",
            peru: "#CD853F",
            pink: "#FFC0CB",
            plum: "#DDA0DD",
            powderblue: "#B0E0E6",
            purple: "#800080",
            rebeccapurple: "#663399",
            red: "#FF0000",
            rosybrown: "#BC8F8F",
            royalblue: "#4169E1",
            saddlebrown: "#8B4513",
            salmon: "#FA8072",
            sandybrown: "#F4A460",
            seagreen: "#2E8B57",
            seashell: "#FFF5EE",
            sienna: "#A0522D",
            silver: "#C0C0C0",
            skyblue: "#87CEEB",
            slateblue: "#6A5ACD",
            slategray: "#708090",
            slategrey: "#708090",
            snow: "#FFFAFA",
            springgreen: "#00FF7F",
            steelblue: "#4682B4",
            tan: "#D2B48C",
            teal: "#008080",
            thistle: "#D8BFD8",
            tomato: "#FF6347",
            turquoise: "#40E0D0",
            violet: "#EE82EE",
            wheat: "#F5DEB3",
            white: "#FFFFFF",
            whitesmoke: "#F5F5F5",
            yellow: "#FFFF00",
            yellowgreen: "#9ACD32"
        };

        function ZS(e) {
            let t, r, n, i = 1,
                o = e.replace(/\s/g, "").toLowerCase(),
                s = (typeof ld[o] == "string" ? ld[o].toLowerCase() : null) || o;
            if (s.startsWith("#")) {
                let u = s.substring(1);
                u.length === 3 || u.length === 4 ? (t = parseInt(u[0] + u[0], 16), r = parseInt(u[1] + u[1], 16), n = parseInt(u[2] + u[2], 16), u.length === 4 && (i = parseInt(u[3] + u[3], 16) / 255)) : (u.length === 6 || u.length === 8) && (t = parseInt(u.substring(0, 2), 16), r = parseInt(u.substring(2, 4), 16), n = parseInt(u.substring(4, 6), 16), u.length === 8 && (i = parseInt(u.substring(6, 8), 16) / 255))
            } else if (s.startsWith("rgba")) {
                let u = s.match(/rgba\(([^)]+)\)/)[1].split(",");
                t = parseInt(u[0], 10), r = parseInt(u[1], 10), n = parseInt(u[2], 10), i = parseFloat(u[3])
            } else if (s.startsWith("rgb")) {
                let u = s.match(/rgb\(([^)]+)\)/)[1].split(",");
                t = parseInt(u[0], 10), r = parseInt(u[1], 10), n = parseInt(u[2], 10)
            } else if (s.startsWith("hsla")) {
                let u = s.match(/hsla\(([^)]+)\)/)[1].split(","),
                    l = parseFloat(u[0]),
                    m = parseFloat(u[1].replace("%", "")) / 100,
                    f = parseFloat(u[2].replace("%", "")) / 100;
                i = parseFloat(u[3]);
                let g = (1 - Math.abs(2 * f - 1)) * m,
                    p = g * (1 - Math.abs(l / 60 % 2 - 1)),
                    h = f - g / 2,
                    _, T, I;
                l >= 0 && l < 60 ? (_ = g, T = p, I = 0) : l >= 60 && l < 120 ? (_ = p, T = g, I = 0) : l >= 120 && l < 180 ? (_ = 0, T = g, I = p) : l >= 180 && l < 240 ? (_ = 0, T = p, I = g) : l >= 240 && l < 300 ? (_ = p, T = 0, I = g) : (_ = g, T = 0, I = p), t = Math.round((_ + h) * 255), r = Math.round((T + h) * 255), n = Math.round((I + h) * 255)
            } else if (s.startsWith("hsl")) {
                let u = s.match(/hsl\(([^)]+)\)/)[1].split(","),
                    l = parseFloat(u[0]),
                    m = parseFloat(u[1].replace("%", "")) / 100,
                    f = parseFloat(u[2].replace("%", "")) / 100,
                    g = (1 - Math.abs(2 * f - 1)) * m,
                    p = g * (1 - Math.abs(l / 60 % 2 - 1)),
                    h = f - g / 2,
                    _, T, I;
                l >= 0 && l < 60 ? (_ = g, T = p, I = 0) : l >= 60 && l < 120 ? (_ = p, T = g, I = 0) : l >= 120 && l < 180 ? (_ = 0, T = g, I = p) : l >= 180 && l < 240 ? (_ = 0, T = p, I = g) : l >= 240 && l < 300 ? (_ = p, T = 0, I = g) : (_ = g, T = 0, I = p), t = Math.round((_ + h) * 255), r = Math.round((T + h) * 255), n = Math.round((I + h) * 255)
            }
            if (Number.isNaN(t) || Number.isNaN(r) || Number.isNaN(n)) throw new Error(`Invalid color in [ix2/shared/utils/normalizeColor.js] '${e}'`);
            return {
                red: t,
                green: r,
                blue: n,
                alpha: i
            }
        }
    });
    var fd = d(ro => {
        "use strict";
        Object.defineProperty(ro, "__esModule", {
            value: !0
        });

        function JS(e, t) {
            for (var r in t) Object.defineProperty(e, r, {
                enumerable: !0,
                get: t[r]
            })
        }
        JS(ro, {
            clearPlugin: function() {
                return sO
            },
            createPluginInstance: function() {
                return oO
            },
            getPluginConfig: function() {
                return tO
            },
            getPluginDestination: function() {
                return iO
            },
            getPluginDuration: function() {
                return rO
            },
            getPluginOrigin: function() {
                return nO
            },
            renderPlugin: function() {
                return aO
            }
        });
        var eO = to(),
            tO = (e, t) => e.value[t],
            rO = () => null,
            nO = (e, t) => {
                if (e) return e;
                let r = t.config.value,
                    n = t.config.target.objectId,
                    i = getComputedStyle(document.documentElement).getPropertyValue(n);
                if (r.size != null) return {
                    size: parseInt(i, 10)
                };
                if (r.red != null && r.green != null && r.blue != null) return (0, eO.normalizeColor)(i)
            },
            iO = e => e.value,
            oO = () => null,
            aO = (e, t, r) => {
                let n = r.config.target.objectId,
                    i = r.config.value.unit,
                    {
                        PLUGIN_VARIABLE: o
                    } = t,
                    {
                        size: a,
                        red: s,
                        green: u,
                        blue: l,
                        alpha: m
                    } = o,
                    f;
                a != null && (f = a + i), s != null && l != null && u != null && m != null && (f = `rgba(${s}, ${u}, ${l}, ${m})`), f != null && document.documentElement.style.setProperty(n, f)
            },
            sO = (e, t) => {
                let r = t.config.target.objectId;
                document.documentElement.style.removeProperty(r)
            }
    });
    var pd = d(oo => {
        "use strict";
        Object.defineProperty(oo, "__esModule", {
            value: !0
        });
        Object.defineProperty(oo, "pluginMethodMap", {
            enumerable: !0,
            get: function() {
                return fO
            }
        });
        var no = (De(), Ye(ms)),
            uO = io(sd()),
            cO = io(cd()),
            lO = io(fd());

        function dd(e) {
            if (typeof WeakMap != "function") return null;
            var t = new WeakMap,
                r = new WeakMap;
            return (dd = function(n) {
                return n ? r : t
            })(e)
        }

        function io(e, t) {
            if (!t && e && e.__esModule) return e;
            if (e === null || typeof e != "object" && typeof e != "function") return {
                default: e
            };
            var r = dd(t);
            if (r && r.has(e)) return r.get(e);
            var n = {
                    __proto__: null
                },
                i = Object.defineProperty && Object.getOwnPropertyDescriptor;
            for (var o in e)
                if (o !== "default" && Object.prototype.hasOwnProperty.call(e, o)) {
                    var a = i ? Object.getOwnPropertyDescriptor(e, o) : null;
                    a && (a.get || a.set) ? Object.defineProperty(n, o, a) : n[o] = e[o]
                }
            return n.default = e, r && r.set(e, n), n
        }
        var fO = new Map([
            [no.ActionTypeConsts.PLUGIN_LOTTIE, { ...uO
            }],
            [no.ActionTypeConsts.PLUGIN_SPLINE, { ...cO
            }],
            [no.ActionTypeConsts.PLUGIN_VARIABLE, { ...lO
            }]
        ])
    });
    var gd = {};
    Pe(gd, {
        clearPlugin: () => fo,
        createPluginInstance: () => pO,
        getPluginConfig: () => so,
        getPluginDestination: () => co,
        getPluginDuration: () => dO,
        getPluginOrigin: () => uo,
        isPluginType: () => Et,
        renderPlugin: () => lo
    });

    function Et(e) {
        return ao.pluginMethodMap.has(e)
    }
    var ao, yt, so, uo, dO, co, pO, lo, fo, po = ve(() => {
        "use strict";
        ln();
        ao = le(pd());
        yt = e => t => {
            if (!ze) return () => null;
            let r = ao.pluginMethodMap.get(t);
            if (!r) throw new Error(`IX2 no plugin configured for: ${t}`);
            let n = r[e];
            if (!n) throw new Error(`IX2 invalid plugin method: ${e}`);
            return n
        }, so = yt("getPluginConfig"), uo = yt("getPluginOrigin"), dO = yt("getPluginDuration"), co = yt("getPluginDestination"), pO = yt("createPluginInstance"), lo = yt("renderPlugin"), fo = yt("clearPlugin")
    });
    var vd = d((Sq, hd) => {
        function gO(e, t) {
            return e == null || e !== e ? t : e
        }
        hd.exports = gO
    });
    var Ed = d((Oq, md) => {
        function hO(e, t, r, n) {
            var i = -1,
                o = e == null ? 0 : e.length;
            for (n && o && (r = e[++i]); ++i < o;) r = t(r, e[i], i, e);
            return r
        }
        md.exports = hO
    });
    var _d = d((Rq, yd) => {
        function vO(e) {
            return function(t, r, n) {
                for (var i = -1, o = Object(t), a = n(t), s = a.length; s--;) {
                    var u = a[e ? s : ++i];
                    if (r(o[u], u, o) === !1) break
                }
                return t
            }
        }
        yd.exports = vO
    });
    var bd = d((Cq, Id) => {
        var mO = _d(),
            EO = mO();
        Id.exports = EO
    });
    var go = d((Lq, Td) => {
        var yO = bd(),
            _O = cr();

        function IO(e, t) {
            return e && yO(e, t, _O)
        }
        Td.exports = IO
    });
    var Ad = d((Pq, wd) => {
        var bO = vt();

        function TO(e, t) {
            return function(r, n) {
                if (r == null) return r;
                if (!bO(r)) return e(r, n);
                for (var i = r.length, o = t ? i : -1, a = Object(r);
                    (t ? o-- : ++o < i) && n(a[o], o, a) !== !1;);
                return r
            }
        }
        wd.exports = TO
    });
    var ho = d((Nq, xd) => {
        var wO = go(),
            AO = Ad(),
            xO = AO(wO);
        xd.exports = xO
    });
    var Od = d((Dq, Sd) => {
        function SO(e, t, r, n, i) {
            return i(e, function(o, a, s) {
                r = n ? (n = !1, o) : t(r, o, a, s)
            }), r
        }
        Sd.exports = SO
    });
    var Cd = d((Mq, Rd) => {
        var OO = Ed(),
            RO = ho(),
            CO = ft(),
            LO = Od(),
            PO = Te();

        function NO(e, t, r) {
            var n = PO(e) ? OO : LO,
                i = arguments.length < 3;
            return n(e, CO(t, 4), r, i, RO)
        }
        Rd.exports = NO
    });
    var Pd = d((Fq, Ld) => {
        var DO = Bi(),
            MO = ft(),
            FO = Wi(),
            qO = Math.max,
            XO = Math.min;

        function GO(e, t, r) {
            var n = e == null ? 0 : e.length;
            if (!n) return -1;
            var i = n - 1;
            return r !== void 0 && (i = FO(r), i = r < 0 ? qO(n + i, 0) : XO(i, n - 1)), DO(e, MO(t, 3), i, !0)
        }
        Ld.exports = GO
    });
    var Dd = d((qq, Nd) => {
        var kO = Hi(),
            VO = Pd(),
            UO = kO(VO);
        Nd.exports = UO
    });

    function Md(e, t) {
        return e === t ? e !== 0 || t !== 0 || 1 / e === 1 / t : e !== e && t !== t
    }

    function HO(e, t) {
        if (Md(e, t)) return !0;
        if (typeof e != "object" || e === null || typeof t != "object" || t === null) return !1;
        let r = Object.keys(e),
            n = Object.keys(t);
        if (r.length !== n.length) return !1;
        for (let i = 0; i < r.length; i++)
            if (!Object.hasOwn(t, r[i]) || !Md(e[r[i]], t[r[i]])) return !1;
        return !0
    }
    var vo, Fd = ve(() => {
        "use strict";
        vo = HO
    });
    var ep = {};
    Pe(ep, {
        cleanupHTMLElement: () => kR,
        clearAllStyles: () => GR,
        clearObjectCache: () => aR,
        getActionListProgress: () => UR,
        getAffectedElements: () => Io,
        getComputedStyle: () => gR,
        getDestinationValues: () => IR,
        getElementId: () => lR,
        getInstanceId: () => uR,
        getInstanceOrigin: () => mR,
        getItemConfigByKey: () => _R,
        getMaxDurationItemIndex: () => Jd,
        getNamespacedParameterId: () => WR,
        getRenderType: () => Qd,
        getStyleProp: () => bR,
        mediaQueriesEqual: () => KR,
        observeStore: () => pR,
        reduceListToGroup: () => HR,
        reifyState: () => fR,
        renderHTMLElement: () => TR,
        shallowEqual: () => vo,
        shouldAllowMediaQuery: () => zR,
        shouldNamespaceEventParameter: () => BR,
        stringifyTarget: () => jR
    });

    function aR() {
        pn.clear()
    }

    function uR() {
        return "i" + sR++
    }

    function lR(e, t) {
        for (let r in e) {
            let n = e[r];
            if (n && n.ref === t) return n.id
        }
        return "e" + cR++
    }

    function fR({
        events: e,
        actionLists: t,
        site: r
    } = {}) {
        let n = (0, mn.default)(e, (a, s) => {
                let {
                    eventTypeId: u
                } = s;
                return a[u] || (a[u] = {}), a[u][s.id] = s, a
            }, {}),
            i = r && r.mediaQueries,
            o = [];
        return i ? o = i.map(a => a.key) : (i = [], console.warn("IX2 missing mediaQueries in site data")), {
            ixData: {
                events: e,
                actionLists: t,
                eventTypeMap: n,
                mediaQueries: i,
                mediaQueryKeys: o
            }
        }
    }

    function pR({
        store: e,
        select: t,
        onChange: r,
        comparator: n = dR
    }) {
        let {
            getState: i,
            subscribe: o
        } = e, a = o(u), s = t(i());

        function u() {
            let l = t(i());
            if (l == null) {
                a();
                return
            }
            n(l, s) || (s = l, r(s, e))
        }
        return a
    }

    function Gd(e) {
        let t = typeof e;
        if (t === "string") return {
            id: e
        };
        if (e != null && t === "object") {
            let {
                id: r,
                objectId: n,
                selector: i,
                selectorGuids: o,
                appliesTo: a,
                useEventTarget: s
            } = e;
            return {
                id: r,
                objectId: n,
                selector: i,
                selectorGuids: o,
                appliesTo: a,
                useEventTarget: s
            }
        }
        return {}
    }

    function Io({
        config: e,
        event: t,
        eventTarget: r,
        elementRoot: n,
        elementApi: i
    }) {
        if (!i) throw new Error("IX2 missing elementApi");
        let {
            targets: o
        } = e;
        if (Array.isArray(o) && o.length > 0) return o.reduce((F, x) => F.concat(Io({
            config: {
                target: x
            },
            event: t,
            eventTarget: r,
            elementRoot: n,
            elementApi: i
        })), []);
        let {
            getValidDocument: a,
            getQuerySelector: s,
            queryDocument: u,
            getChildElements: l,
            getSiblingElements: m,
            matchSelector: f,
            elementContains: g,
            isSiblingNode: p
        } = i, {
            target: h
        } = e;
        if (!h) return [];
        let {
            id: _,
            objectId: T,
            selector: I,
            selectorGuids: C,
            appliesTo: S,
            useEventTarget: P
        } = Gd(h);
        if (T) return [pn.has(T) ? pn.get(T) : pn.set(T, {}).get(T)];
        if (S === hi.PAGE) {
            let F = a(_);
            return F ? [F] : []
        }
        let L = (t ? .action ? .config ? .affectedElements ? ? {})[_ || I] || {},
            B = !!(L.id || L.selector),
            W, z, $, ie = t && s(Gd(t.target));
        if (B ? (W = L.limitAffectedElements, z = ie, $ = s(L)) : z = $ = s({
                id: _,
                selector: I,
                selectorGuids: C
            }), t && P) {
            let F = r && ($ || P === !0) ? [r] : u(ie);
            if ($) {
                if (P === nR) return u($).filter(x => F.some(D => g(x, D)));
                if (P === qd) return u($).filter(x => F.some(D => g(D, x)));
                if (P === Xd) return u($).filter(x => F.some(D => p(D, x)))
            }
            return F
        }
        return z == null || $ == null ? [] : ze && n ? u($).filter(F => n.contains(F)) : W === qd ? u(z, $) : W === rR ? l(u(z)).filter(f($)) : W === Xd ? m(u(z)).filter(f($)) : u($)
    }

    function gR({
        element: e,
        actionItem: t
    }) {
        if (!ze) return {};
        let {
            actionTypeId: r
        } = t;
        switch (r) {
            case Ut:
            case Ht:
            case Bt:
            case Wt:
            case yn:
                return window.getComputedStyle(e);
            default:
                return {}
        }
    }

    function mR(e, t = {}, r = {}, n, i) {
        let {
            getStyle: o
        } = i, {
            actionTypeId: a
        } = n;
        if (Et(a)) return uo(a)(t[a], n);
        switch (n.actionTypeId) {
            case Gt:
            case kt:
            case Vt:
            case yr:
                return t[n.actionTypeId] || bo[n.actionTypeId];
            case _r:
                return hR(t[n.actionTypeId], n.config.filters);
            case Ir:
                return vR(t[n.actionTypeId], n.config.fontVariations);
            case Kd:
                return {
                    value: (0, ot.default)(parseFloat(o(e, hn)), 1)
                };
            case Ut:
                {
                    let s = o(e, et),
                        u = o(e, tt),
                        l, m;
                    return n.config.widthUnit === pt ? l = kd.test(s) ? parseFloat(s) : parseFloat(r.width) : l = (0, ot.default)(parseFloat(s), parseFloat(r.width)),
                    n.config.heightUnit === pt ? m = kd.test(u) ? parseFloat(u) : parseFloat(r.height) : m = (0, ot.default)(parseFloat(u), parseFloat(r.height)),
                    {
                        widthValue: l,
                        heightValue: m
                    }
                }
            case Ht:
            case Bt:
            case Wt:
                return FR({
                    element: e,
                    actionTypeId: n.actionTypeId,
                    computedStyle: r,
                    getStyle: o
                });
            case yn:
                return {
                    value: (0, ot.default)(o(e, vn), r.display)
                };
            case oR:
                return t[n.actionTypeId] || {
                    value: 0
                };
            default:
                return
        }
    }

    function IR({
        element: e,
        actionItem: t,
        elementApi: r
    }) {
        if (Et(t.actionTypeId)) return co(t.actionTypeId)(t.config);
        switch (t.actionTypeId) {
            case Gt:
            case kt:
            case Vt:
            case yr:
                {
                    let {
                        xValue: n,
                        yValue: i,
                        zValue: o
                    } = t.config;
                    return {
                        xValue: n,
                        yValue: i,
                        zValue: o
                    }
                }
            case Ut:
                {
                    let {
                        getStyle: n,
                        setStyle: i,
                        getProperty: o
                    } = r,
                    {
                        widthUnit: a,
                        heightUnit: s
                    } = t.config,
                    {
                        widthValue: u,
                        heightValue: l
                    } = t.config;
                    if (!ze) return {
                        widthValue: u,
                        heightValue: l
                    };
                    if (a === pt) {
                        let m = n(e, et);
                        i(e, et, ""), u = o(e, "offsetWidth"), i(e, et, m)
                    }
                    if (s === pt) {
                        let m = n(e, tt);
                        i(e, tt, ""), l = o(e, "offsetHeight"), i(e, tt, m)
                    }
                    return {
                        widthValue: u,
                        heightValue: l
                    }
                }
            case Ht:
            case Bt:
            case Wt:
                {
                    let {
                        rValue: n,
                        gValue: i,
                        bValue: o,
                        aValue: a,
                        globalSwatchId: s
                    } = t.config;
                    if (s && s.startsWith("--")) {
                        let {
                            getStyle: u
                        } = r, l = u(e, s), m = (0, Hd.normalizeColor)(l);
                        return {
                            rValue: m.red,
                            gValue: m.green,
                            bValue: m.blue,
                            aValue: m.alpha
                        }
                    }
                    return {
                        rValue: n,
                        gValue: i,
                        bValue: o,
                        aValue: a
                    }
                }
            case _r:
                return t.config.filters.reduce(ER, {});
            case Ir:
                return t.config.fontVariations.reduce(yR, {});
            default:
                {
                    let {
                        value: n
                    } = t.config;
                    return {
                        value: n
                    }
                }
        }
    }

    function Qd(e) {
        if (/^TRANSFORM_/.test(e)) return Wd;
        if (/^STYLE_/.test(e)) return yo;
        if (/^GENERAL_/.test(e)) return Eo;
        if (/^PLUGIN_/.test(e)) return zd
    }

    function bR(e, t) {
        return e === yo ? t.replace("STYLE_", "").toLowerCase() : null
    }

    function TR(e, t, r, n, i, o, a, s, u) {
        switch (s) {
            case Wd:
                return OR(e, t, r, i, a);
            case yo:
                return qR(e, t, r, i, o, a);
            case Eo:
                return XR(e, i, a);
            case zd:
                {
                    let {
                        actionTypeId: l
                    } = i;
                    if (Et(l)) return lo(l)(u, t, i)
                }
        }
    }

    function OR(e, t, r, n, i) {
        let o = SR.map(s => {
                let u = bo[s],
                    {
                        xValue: l = u.xValue,
                        yValue: m = u.yValue,
                        zValue: f = u.zValue,
                        xUnit: g = "",
                        yUnit: p = "",
                        zUnit: h = ""
                    } = t[s] || {};
                switch (s) {
                    case Gt:
                        return `${zO}(${l}${g}, ${m}${p}, ${f}${h})`;
                    case kt:
                        return `${KO}(${l}${g}, ${m}${p}, ${f}${h})`;
                    case Vt:
                        return `${jO}(${l}${g}) ${YO}(${m}${p}) ${QO}(${f}${h})`;
                    case yr:
                        return `${$O}(${l}${g}, ${m}${p})`;
                    default:
                        return ""
                }
            }).join(" "),
            {
                setStyle: a
            } = i;
        _t(e, dt, i), a(e, dt, o), LR(n, r) && a(e, cn, ZO)
    }

    function RR(e, t, r, n) {
        let i = (0, mn.default)(t, (a, s, u) => `${a} ${u}(${s}${xR(u,r)})`, ""),
            {
                setStyle: o
            } = n;
        _t(e, vr, n), o(e, vr, i)
    }

    function CR(e, t, r, n) {
        let i = (0, mn.default)(t, (a, s, u) => (a.push(`"${u}" ${s}`), a), []).join(", "),
            {
                setStyle: o
            } = n;
        _t(e, mr, n), o(e, mr, i)
    }

    function LR({
        actionTypeId: e
    }, {
        xValue: t,
        yValue: r,
        zValue: n
    }) {
        return e === Gt && n !== void 0 || e === kt && n !== void 0 || e === Vt && (t !== void 0 || r !== void 0)
    }

    function MR(e, t) {
        let r = e.exec(t);
        return r ? r[1] : ""
    }

    function FR({
        element: e,
        actionTypeId: t,
        computedStyle: r,
        getStyle: n
    }) {
        let i = _o[t],
            o = n(e, i),
            a = NR.test(o) ? o : r[i],
            s = MR(DR, a).split(Er);
        return {
            rValue: (0, ot.default)(parseInt(s[0], 10), 255),
            gValue: (0, ot.default)(parseInt(s[1], 10), 255),
            bValue: (0, ot.default)(parseInt(s[2], 10), 255),
            aValue: (0, ot.default)(parseFloat(s[3]), 1)
        }
    }

    function qR(e, t, r, n, i, o) {
        let {
            setStyle: a
        } = o;
        switch (n.actionTypeId) {
            case Ut:
                {
                    let {
                        widthUnit: s = "",
                        heightUnit: u = ""
                    } = n.config,
                    {
                        widthValue: l,
                        heightValue: m
                    } = r;l !== void 0 && (s === pt && (s = "px"), _t(e, et, o), a(e, et, l + s)),
                    m !== void 0 && (u === pt && (u = "px"), _t(e, tt, o), a(e, tt, m + u));
                    break
                }
            case _r:
                {
                    RR(e, r, n.config, o);
                    break
                }
            case Ir:
                {
                    CR(e, r, n.config, o);
                    break
                }
            case Ht:
            case Bt:
            case Wt:
                {
                    let s = _o[n.actionTypeId],
                        u = Math.round(r.rValue),
                        l = Math.round(r.gValue),
                        m = Math.round(r.bValue),
                        f = r.aValue;_t(e, s, o),
                    a(e, s, f >= 1 ? `rgb(${u},${l},${m})` : `rgba(${u},${l},${m},${f})`);
                    break
                }
            default:
                {
                    let {
                        unit: s = ""
                    } = n.config;_t(e, i, o),
                    a(e, i, r.value + s);
                    break
                }
        }
    }

    function XR(e, t, r) {
        let {
            setStyle: n
        } = r;
        switch (t.actionTypeId) {
            case yn:
                {
                    let {
                        value: i
                    } = t.config;i === JO && ze ? n(e, vn, Ki) : n(e, vn, i);
                    return
                }
        }
    }

    function _t(e, t, r) {
        if (!ze) return;
        let n = Yd[t];
        if (!n) return;
        let {
            getStyle: i,
            setStyle: o
        } = r, a = i(e, Xt);
        if (!a) {
            o(e, Xt, n);
            return
        }
        let s = a.split(Er).map(jd);
        s.indexOf(n) === -1 && o(e, Xt, s.concat(n).join(Er))
    }

    function $d(e, t, r) {
        if (!ze) return;
        let n = Yd[t];
        if (!n) return;
        let {
            getStyle: i,
            setStyle: o
        } = r, a = i(e, Xt);
        !a || a.indexOf(n) === -1 || o(e, Xt, a.split(Er).map(jd).filter(s => s !== n).join(Er))
    }

    function GR({
        store: e,
        elementApi: t
    }) {
        let {
            ixData: r
        } = e.getState(), {
            events: n = {},
            actionLists: i = {}
        } = r;
        Object.keys(n).forEach(o => {
            let a = n[o],
                {
                    config: s
                } = a.action,
                {
                    actionListId: u
                } = s,
                l = i[u];
            l && Vd({
                actionList: l,
                event: a,
                elementApi: t
            })
        }), Object.keys(i).forEach(o => {
            Vd({
                actionList: i[o],
                elementApi: t
            })
        })
    }

    function Vd({
        actionList: e = {},
        event: t,
        elementApi: r
    }) {
        let {
            actionItemGroups: n,
            continuousParameterGroups: i
        } = e;
        n && n.forEach(o => {
            Ud({
                actionGroup: o,
                event: t,
                elementApi: r
            })
        }), i && i.forEach(o => {
            let {
                continuousActionGroups: a
            } = o;
            a.forEach(s => {
                Ud({
                    actionGroup: s,
                    event: t,
                    elementApi: r
                })
            })
        })
    }

    function Ud({
        actionGroup: e,
        event: t,
        elementApi: r
    }) {
        let {
            actionItems: n
        } = e;
        n.forEach(i => {
            let {
                actionTypeId: o,
                config: a
            } = i, s;
            Et(o) ? s = u => fo(o)(u, i) : s = Zd({
                effect: VR,
                actionTypeId: o,
                elementApi: r
            }), Io({
                config: a,
                event: t,
                elementApi: r
            }).forEach(s)
        })
    }

    function kR(e, t, r) {
        let {
            setStyle: n,
            getStyle: i
        } = r, {
            actionTypeId: o
        } = t;
        if (o === Ut) {
            let {
                config: a
            } = t;
            a.widthUnit === pt && n(e, et, ""), a.heightUnit === pt && n(e, tt, "")
        }
        i(e, Xt) && Zd({
            effect: $d,
            actionTypeId: o,
            elementApi: r
        })(e)
    }

    function VR(e, t, r) {
        let {
            setStyle: n
        } = r;
        $d(e, t, r), n(e, t, ""), t === dt && n(e, cn, "")
    }

    function Jd(e) {
        let t = 0,
            r = 0;
        return e.forEach((n, i) => {
            let {
                config: o
            } = n, a = o.delay + o.duration;
            a >= t && (t = a, r = i)
        }), r
    }

    function UR(e, t) {
        let {
            actionItemGroups: r,
            useFirstGroupAsInitialState: n
        } = e, {
            actionItem: i,
            verboseTimeElapsed: o = 0
        } = t, a = 0, s = 0;
        return r.forEach((u, l) => {
            if (n && l === 0) return;
            let {
                actionItems: m
            } = u, f = m[Jd(m)], {
                config: g,
                actionTypeId: p
            } = f;
            i.id === f.id && (s = a + o);
            let h = Qd(p) === Eo ? 0 : g.duration;
            a += g.delay + h
        }), a > 0 ? hr(s / a) : 0
    }

    function HR({
        actionList: e,
        actionItemId: t,
        rawData: r
    }) {
        let {
            actionItemGroups: n,
            continuousParameterGroups: i
        } = e, o = [], a = s => (o.push((0, En.mergeIn)(s, ["config"], {
            delay: 0,
            duration: 0
        })), s.id === t);
        return n && n.some(({
            actionItems: s
        }) => s.some(a)), i && i.some(s => {
            let {
                continuousActionGroups: u
            } = s;
            return u.some(({
                actionItems: l
            }) => l.some(a))
        }), (0, En.setIn)(r, ["actionLists"], {
            [e.id]: {
                id: e.id,
                actionItemGroups: [{
                    actionItems: o
                }]
            }
        })
    }

    function BR(e, {
        basedOn: t
    }) {
        return e === We.SCROLLING_IN_VIEW && (t === Ze.ELEMENT || t == null) || e === We.MOUSE_MOVE && t === Ze.ELEMENT
    }

    function WR(e, t) {
        return e + iR + t
    }

    function zR(e, t) {
        return t == null ? !0 : e.indexOf(t) !== -1
    }

    function KR(e, t) {
        return vo(e && e.sort(), t && t.sort())
    }

    function jR(e) {
        if (typeof e == "string") return e;
        if (e.pluginElement && e.objectId) return e.pluginElement + mo + e.objectId;
        if (e.objectId) return e.objectId;
        let {
            id: t = "",
            selector: r = "",
            useEventTarget: n = ""
        } = e;
        return t + mo + r + mo + n
    }
    var ot, mn, gn, En, Hd, BO, WO, zO, KO, jO, YO, QO, $O, ZO, JO, hn, vr, mr, et, tt, Bd, eR, tR, qd, rR, Xd, nR, vn, Xt, pt, Er, iR, mo, Wd, Eo, yo, zd, Gt, kt, Vt, yr, Kd, _r, Ir, Ut, Ht, Bt, Wt, yn, oR, jd, _o, Yd, pn, sR, cR, dR, kd, hR, vR, ER, yR, _R, bo, wR, AR, xR, SR, PR, NR, DR, Zd, tp = ve(() => {
        "use strict";
        ot = le(vd()), mn = le(Cd()), gn = le(Dd()), En = le(Ot());
        De();
        Fd();
        Qi();
        Hd = le(to());
        po();
        ln();
        ({
            BACKGROUND: BO,
            TRANSFORM: WO,
            TRANSLATE_3D: zO,
            SCALE_3D: KO,
            ROTATE_X: jO,
            ROTATE_Y: YO,
            ROTATE_Z: QO,
            SKEW: $O,
            PRESERVE_3D: ZO,
            FLEX: JO,
            OPACITY: hn,
            FILTER: vr,
            FONT_VARIATION_SETTINGS: mr,
            WIDTH: et,
            HEIGHT: tt,
            BACKGROUND_COLOR: Bd,
            BORDER_COLOR: eR,
            COLOR: tR,
            CHILDREN: qd,
            IMMEDIATE_CHILDREN: rR,
            SIBLINGS: Xd,
            PARENT: nR,
            DISPLAY: vn,
            WILL_CHANGE: Xt,
            AUTO: pt,
            COMMA_DELIMITER: Er,
            COLON_DELIMITER: iR,
            BAR_DELIMITER: mo,
            RENDER_TRANSFORM: Wd,
            RENDER_GENERAL: Eo,
            RENDER_STYLE: yo,
            RENDER_PLUGIN: zd
        } = Ae), {
            TRANSFORM_MOVE: Gt,
            TRANSFORM_SCALE: kt,
            TRANSFORM_ROTATE: Vt,
            TRANSFORM_SKEW: yr,
            STYLE_OPACITY: Kd,
            STYLE_FILTER: _r,
            STYLE_FONT_VARIATION: Ir,
            STYLE_SIZE: Ut,
            STYLE_BACKGROUND_COLOR: Ht,
            STYLE_BORDER: Bt,
            STYLE_TEXT_COLOR: Wt,
            GENERAL_DISPLAY: yn,
            OBJECT_VALUE: oR
        } = Ne, jd = e => e.trim(), _o = Object.freeze({
            [Ht]: Bd,
            [Bt]: eR,
            [Wt]: tR
        }), Yd = Object.freeze({
            [dt]: WO,
            [Bd]: BO,
            [hn]: hn,
            [vr]: vr,
            [et]: et,
            [tt]: tt,
            [mr]: mr
        }), pn = new Map;
        sR = 1;
        cR = 1;
        dR = (e, t) => e === t;
        kd = /px/, hR = (e, t) => t.reduce((r, n) => (r[n.type] == null && (r[n.type] = wR[n.type]), r), e || {}), vR = (e, t) => t.reduce((r, n) => (r[n.type] == null && (r[n.type] = AR[n.type] || n.defaultValue || 0), r), e || {});
        ER = (e, t) => (t && (e[t.type] = t.value || 0), e), yR = (e, t) => (t && (e[t.type] = t.value || 0), e), _R = (e, t, r) => {
            if (Et(e)) return so(e)(r, t);
            switch (e) {
                case _r:
                    {
                        let n = (0, gn.default)(r.filters, ({
                            type: i
                        }) => i === t);
                        return n ? n.value : 0
                    }
                case Ir:
                    {
                        let n = (0, gn.default)(r.fontVariations, ({
                            type: i
                        }) => i === t);
                        return n ? n.value : 0
                    }
                default:
                    return r[t]
            }
        };
        bo = {
            [Gt]: Object.freeze({
                xValue: 0,
                yValue: 0,
                zValue: 0
            }),
            [kt]: Object.freeze({
                xValue: 1,
                yValue: 1,
                zValue: 1
            }),
            [Vt]: Object.freeze({
                xValue: 0,
                yValue: 0,
                zValue: 0
            }),
            [yr]: Object.freeze({
                xValue: 0,
                yValue: 0
            })
        }, wR = Object.freeze({
            blur: 0,
            "hue-rotate": 0,
            invert: 0,
            grayscale: 0,
            saturate: 100,
            sepia: 0,
            contrast: 100,
            brightness: 100
        }), AR = Object.freeze({
            wght: 0,
            opsz: 0,
            wdth: 0,
            slnt: 0
        }), xR = (e, t) => {
            let r = (0, gn.default)(t.filters, ({
                type: n
            }) => n === e);
            if (r && r.unit) return r.unit;
            switch (e) {
                case "blur":
                    return "px";
                case "hue-rotate":
                    return "deg";
                default:
                    return "%"
            }
        }, SR = Object.keys(bo);
        PR = "\\(([^)]+)\\)", NR = /^rgb/, DR = RegExp(`rgba?${PR}`);
        Zd = ({
            effect: e,
            actionTypeId: t,
            elementApi: r
        }) => n => {
            switch (t) {
                case Gt:
                case kt:
                case Vt:
                case yr:
                    e(n, dt, r);
                    break;
                case _r:
                    e(n, vr, r);
                    break;
                case Ir:
                    e(n, mr, r);
                    break;
                case Kd:
                    e(n, hn, r);
                    break;
                case Ut:
                    e(n, et, r), e(n, tt, r);
                    break;
                case Ht:
                case Bt:
                case Wt:
                    e(n, _o[t], r);
                    break;
                case yn:
                    e(n, vn, r);
                    break
            }
        }
    });
    var It = d(To => {
        "use strict";
        Object.defineProperty(To, "__esModule", {
            value: !0
        });

        function YR(e, t) {
            for (var r in t) Object.defineProperty(e, r, {
                enumerable: !0,
                get: t[r]
            })
        }
        YR(To, {
            IX2BrowserSupport: function() {
                return QR
            },
            IX2EasingUtils: function() {
                return ZR
            },
            IX2Easings: function() {
                return $R
            },
            IX2ElementsReducer: function() {
                return JR
            },
            IX2VanillaPlugins: function() {
                return eC
            },
            IX2VanillaUtils: function() {
                return tC
            }
        });
        var QR = zt((ln(), Ye(Yf))),
            $R = zt((Yi(), Ye(gr))),
            ZR = zt((Qi(), Ye(rd))),
            JR = zt((ad(), Ye(od))),
            eC = zt((po(), Ye(gd))),
            tC = zt((tp(), Ye(ep)));

        function rp(e) {
            if (typeof WeakMap != "function") return null;
            var t = new WeakMap,
                r = new WeakMap;
            return (rp = function(n) {
                return n ? r : t
            })(e)
        }

        function zt(e, t) {
            if (!t && e && e.__esModule) return e;
            if (e === null || typeof e != "object" && typeof e != "function") return {
                default: e
            };
            var r = rp(t);
            if (r && r.has(e)) return r.get(e);
            var n = {
                    __proto__: null
                },
                i = Object.defineProperty && Object.getOwnPropertyDescriptor;
            for (var o in e)
                if (o !== "default" && Object.prototype.hasOwnProperty.call(e, o)) {
                    var a = i ? Object.getOwnPropertyDescriptor(e, o) : null;
                    a && (a.get || a.set) ? Object.defineProperty(n, o, a) : n[o] = e[o]
                }
            return n.default = e, r && r.set(e, n), n
        }
    });
    var In, at, rC, nC, iC, oC, aC, sC, _n, np, uC, cC, wo, lC, fC, dC, pC, ip, op = ve(() => {
        "use strict";
        De();
        In = le(It()), at = le(Ot()), {
            IX2_RAW_DATA_IMPORTED: rC,
            IX2_SESSION_STOPPED: nC,
            IX2_INSTANCE_ADDED: iC,
            IX2_INSTANCE_STARTED: oC,
            IX2_INSTANCE_REMOVED: aC,
            IX2_ANIMATION_FRAME_CHANGED: sC
        } = be, {
            optimizeFloat: _n,
            applyEasing: np,
            createBezierEasing: uC
        } = In.IX2EasingUtils, {
            RENDER_GENERAL: cC
        } = Ae, {
            getItemConfigByKey: wo,
            getRenderType: lC,
            getStyleProp: fC
        } = In.IX2VanillaUtils, dC = (e, t) => {
            let {
                position: r,
                parameterId: n,
                actionGroups: i,
                destinationKeys: o,
                smoothing: a,
                restingValue: s,
                actionTypeId: u,
                customEasingFn: l,
                skipMotion: m,
                skipToValue: f
            } = e, {
                parameters: g
            } = t.payload, p = Math.max(1 - a, .01), h = g[n];
            h == null && (p = 1, h = s);
            let _ = Math.max(h, 0) || 0,
                T = _n(_ - r),
                I = m ? f : _n(r + T * p),
                C = I * 100;
            if (I === r && e.current) return e;
            let S, P, N, L;
            for (let W = 0, {
                    length: z
                } = i; W < z; W++) {
                let {
                    keyframe: $,
                    actionItems: ie
                } = i[W];
                if (W === 0 && (S = ie[0]), C >= $) {
                    S = ie[0];
                    let F = i[W + 1],
                        x = F && C !== $;
                    P = x ? F.actionItems[0] : null, x && (N = $ / 100, L = (F.keyframe - $) / 100)
                }
            }
            let B = {};
            if (S && !P)
                for (let W = 0, {
                        length: z
                    } = o; W < z; W++) {
                    let $ = o[W];
                    B[$] = wo(u, $, S.config)
                } else if (S && P && N !== void 0 && L !== void 0) {
                    let W = (I - N) / L,
                        z = S.config.easing,
                        $ = np(z, W, l);
                    for (let ie = 0, {
                            length: F
                        } = o; ie < F; ie++) {
                        let x = o[ie],
                            D = wo(u, x, S.config),
                            Z = (wo(u, x, P.config) - D) * $ + D;
                        B[x] = Z
                    }
                }
            return (0, at.merge)(e, {
                position: I,
                current: B
            })
        }, pC = (e, t) => {
            let {
                active: r,
                origin: n,
                start: i,
                immediate: o,
                renderType: a,
                verbose: s,
                actionItem: u,
                destination: l,
                destinationKeys: m,
                pluginDuration: f,
                instanceDelay: g,
                customEasingFn: p,
                skipMotion: h
            } = e, _ = u.config.easing, {
                duration: T,
                delay: I
            } = u.config;
            f != null && (T = f), I = g ? ? I, a === cC ? T = 0 : (o || h) && (T = I = 0);
            let {
                now: C
            } = t.payload;
            if (r && n) {
                let S = C - (i + I);
                if (s) {
                    let W = C - i,
                        z = T + I,
                        $ = _n(Math.min(Math.max(0, W / z), 1));
                    e = (0, at.set)(e, "verboseTimeElapsed", z * $)
                }
                if (S < 0) return e;
                let P = _n(Math.min(Math.max(0, S / T), 1)),
                    N = np(_, P, p),
                    L = {},
                    B = null;
                return m.length && (B = m.reduce((W, z) => {
                    let $ = l[z],
                        ie = parseFloat(n[z]) || 0,
                        x = (parseFloat($) - ie) * N + ie;
                    return W[z] = x, W
                }, {})), L.current = B, L.position = P, P === 1 && (L.active = !1, L.complete = !0), (0, at.merge)(e, L)
            }
            return e
        }, ip = (e = Object.freeze({}), t) => {
            switch (t.type) {
                case rC:
                    return t.payload.ixInstances || Object.freeze({});
                case nC:
                    return Object.freeze({});
                case iC:
                    {
                        let {
                            instanceId: r,
                            elementId: n,
                            actionItem: i,
                            eventId: o,
                            eventTarget: a,
                            eventStateKey: s,
                            actionListId: u,
                            groupIndex: l,
                            isCarrier: m,
                            origin: f,
                            destination: g,
                            immediate: p,
                            verbose: h,
                            continuous: _,
                            parameterId: T,
                            actionGroups: I,
                            smoothing: C,
                            restingValue: S,
                            pluginInstance: P,
                            pluginDuration: N,
                            instanceDelay: L,
                            skipMotion: B,
                            skipToValue: W
                        } = t.payload,
                        {
                            actionTypeId: z
                        } = i,
                        $ = lC(z),
                        ie = fC($, z),
                        F = Object.keys(g).filter(D => g[D] != null && typeof g[D] != "string"),
                        {
                            easing: x
                        } = i.config;
                        return (0, at.set)(e, r, {
                            id: r,
                            elementId: n,
                            active: !1,
                            position: 0,
                            start: 0,
                            origin: f,
                            destination: g,
                            destinationKeys: F,
                            immediate: p,
                            verbose: h,
                            current: null,
                            actionItem: i,
                            actionTypeId: z,
                            eventId: o,
                            eventTarget: a,
                            eventStateKey: s,
                            actionListId: u,
                            groupIndex: l,
                            renderType: $,
                            isCarrier: m,
                            styleProp: ie,
                            continuous: _,
                            parameterId: T,
                            actionGroups: I,
                            smoothing: C,
                            restingValue: S,
                            pluginInstance: P,
                            pluginDuration: N,
                            instanceDelay: L,
                            skipMotion: B,
                            skipToValue: W,
                            customEasingFn: Array.isArray(x) && x.length === 4 ? uC(x) : void 0
                        })
                    }
                case oC:
                    {
                        let {
                            instanceId: r,
                            time: n
                        } = t.payload;
                        return (0, at.mergeIn)(e, [r], {
                            active: !0,
                            complete: !1,
                            start: n
                        })
                    }
                case aC:
                    {
                        let {
                            instanceId: r
                        } = t.payload;
                        if (!e[r]) return e;
                        let n = {},
                            i = Object.keys(e),
                            {
                                length: o
                            } = i;
                        for (let a = 0; a < o; a++) {
                            let s = i[a];
                            s !== r && (n[s] = e[s])
                        }
                        return n
                    }
                case sC:
                    {
                        let r = e,
                            n = Object.keys(e),
                            {
                                length: i
                            } = n;
                        for (let o = 0; o < i; o++) {
                            let a = n[o],
                                s = e[a],
                                u = s.continuous ? dC : pC;
                            r = (0, at.set)(r, a, u(s, t))
                        }
                        return r
                    }
                default:
                    return e
            }
        }
    });
    var gC, hC, vC, ap, sp = ve(() => {
        "use strict";
        De();
        ({
            IX2_RAW_DATA_IMPORTED: gC,
            IX2_SESSION_STOPPED: hC,
            IX2_PARAMETER_CHANGED: vC
        } = be), ap = (e = {}, t) => {
            switch (t.type) {
                case gC:
                    return t.payload.ixParameters || {};
                case hC:
                    return {};
                case vC:
                    {
                        let {
                            key: r,
                            value: n
                        } = t.payload;
                        return e[r] = n,
                        e
                    }
                default:
                    return e
            }
        }
    });
    var lp = {};
    Pe(lp, {
        default: () => EC
    });
    var up, cp, mC, EC, fp = ve(() => {
        "use strict";
        up = le(gi());
        ys();
        ks();
        Hs();
        cp = le(It());
        op();
        sp();
        ({
            ixElements: mC
        } = cp.IX2ElementsReducer), EC = (0, up.combineReducers)({
            ixData: Es,
            ixRequest: Gs,
            ixSession: Us,
            ixElements: mC,
            ixInstances: ip,
            ixParameters: ap
        })
    });
    var pp = d((tX, dp) => {
        var yC = ct(),
            _C = Te(),
            IC = nt(),
            bC = "[object String]";

        function TC(e) {
            return typeof e == "string" || !_C(e) && IC(e) && yC(e) == bC
        }
        dp.exports = TC
    });
    var hp = d((rX, gp) => {
        var wC = Ui(),
            AC = wC("length");
        gp.exports = AC
    });
    var mp = d((nX, vp) => {
        var xC = "\\ud800-\\udfff",
            SC = "\\u0300-\\u036f",
            OC = "\\ufe20-\\ufe2f",
            RC = "\\u20d0-\\u20ff",
            CC = SC + OC + RC,
            LC = "\\ufe0e\\ufe0f",
            PC = "\\u200d",
            NC = RegExp("[" + PC + xC + CC + LC + "]");

        function DC(e) {
            return NC.test(e)
        }
        vp.exports = DC
    });
    var xp = d((iX, Ap) => {
        var yp = "\\ud800-\\udfff",
            MC = "\\u0300-\\u036f",
            FC = "\\ufe20-\\ufe2f",
            qC = "\\u20d0-\\u20ff",
            XC = MC + FC + qC,
            GC = "\\ufe0e\\ufe0f",
            kC = "[" + yp + "]",
            Ao = "[" + XC + "]",
            xo = "\\ud83c[\\udffb-\\udfff]",
            VC = "(?:" + Ao + "|" + xo + ")",
            _p = "[^" + yp + "]",
            Ip = "(?:\\ud83c[\\udde6-\\uddff]){2}",
            bp = "[\\ud800-\\udbff][\\udc00-\\udfff]",
            UC = "\\u200d",
            Tp = VC + "?",
            wp = "[" + GC + "]?",
            HC = "(?:" + UC + "(?:" + [_p, Ip, bp].join("|") + ")" + wp + Tp + ")*",
            BC = wp + Tp + HC,
            WC = "(?:" + [_p + Ao + "?", Ao, Ip, bp, kC].join("|") + ")",
            Ep = RegExp(xo + "(?=" + xo + ")|" + WC + BC, "g");

        function zC(e) {
            for (var t = Ep.lastIndex = 0; Ep.test(e);) ++t;
            return t
        }
        Ap.exports = zC
    });
    var Op = d((oX, Sp) => {
        var KC = hp(),
            jC = mp(),
            YC = xp();

        function QC(e) {
            return jC(e) ? YC(e) : KC(e)
        }
        Sp.exports = QC
    });
    var Cp = d((aX, Rp) => {
        var $C = Jr(),
            ZC = en(),
            JC = vt(),
            eL = pp(),
            tL = Op(),
            rL = "[object Map]",
            nL = "[object Set]";

        function iL(e) {
            if (e == null) return 0;
            if (JC(e)) return eL(e) ? tL(e) : e.length;
            var t = ZC(e);
            return t == rL || t == nL ? e.size : $C(e).length
        }
        Rp.exports = iL
    });
    var Pp = d((sX, Lp) => {
        var oL = "Expected a function";

        function aL(e) {
            if (typeof e != "function") throw new TypeError(oL);
            return function() {
                var t = arguments;
                switch (t.length) {
                    case 0:
                        return !e.call(this);
                    case 1:
                        return !e.call(this, t[0]);
                    case 2:
                        return !e.call(this, t[0], t[1]);
                    case 3:
                        return !e.call(this, t[0], t[1], t[2])
                }
                return !e.apply(this, t)
            }
        }
        Lp.exports = aL
    });
    var So = d((uX, Np) => {
        var sL = lt(),
            uL = function() {
                try {
                    var e = sL(Object, "defineProperty");
                    return e({}, "", {}), e
                } catch {}
            }();
        Np.exports = uL
    });
    var Oo = d((cX, Mp) => {
        var Dp = So();

        function cL(e, t, r) {
            t == "__proto__" && Dp ? Dp(e, t, {
                configurable: !0,
                enumerable: !0,
                value: r,
                writable: !0
            }) : e[t] = r
        }
        Mp.exports = cL
    });
    var qp = d((lX, Fp) => {
        var lL = Oo(),
            fL = Hr(),
            dL = Object.prototype,
            pL = dL.hasOwnProperty;

        function gL(e, t, r) {
            var n = e[t];
            (!(pL.call(e, t) && fL(n, r)) || r === void 0 && !(t in e)) && lL(e, t, r)
        }
        Fp.exports = gL
    });
    var kp = d((fX, Gp) => {
        var hL = qp(),
            vL = fr(),
            mL = Yr(),
            Xp = Je(),
            EL = Ft();

        function yL(e, t, r, n) {
            if (!Xp(e)) return e;
            t = vL(t, e);
            for (var i = -1, o = t.length, a = o - 1, s = e; s != null && ++i < o;) {
                var u = EL(t[i]),
                    l = r;
                if (u === "__proto__" || u === "constructor" || u === "prototype") return e;
                if (i != a) {
                    var m = s[u];
                    l = n ? n(m, u, s) : void 0, l === void 0 && (l = Xp(m) ? m : mL(t[i + 1]) ? [] : {})
                }
                hL(s, u, l), s = s[u]
            }
            return e
        }
        Gp.exports = yL
    });
    var Up = d((dX, Vp) => {
        var _L = nn(),
            IL = kp(),
            bL = fr();

        function TL(e, t, r) {
            for (var n = -1, i = t.length, o = {}; ++n < i;) {
                var a = t[n],
                    s = _L(e, a);
                r(s, a) && IL(o, bL(a, e), s)
            }
            return o
        }
        Vp.exports = TL
    });
    var Bp = d((pX, Hp) => {
        var wL = Kr(),
            AL = ti(),
            xL = Si(),
            SL = xi(),
            OL = Object.getOwnPropertySymbols,
            RL = OL ? function(e) {
                for (var t = []; e;) wL(t, xL(e)), e = AL(e);
                return t
            } : SL;
        Hp.exports = RL
    });
    var zp = d((gX, Wp) => {
        function CL(e) {
            var t = [];
            if (e != null)
                for (var r in Object(e)) t.push(r);
            return t
        }
        Wp.exports = CL
    });
    var jp = d((hX, Kp) => {
        var LL = Je(),
            PL = Zr(),
            NL = zp(),
            DL = Object.prototype,
            ML = DL.hasOwnProperty;

        function FL(e) {
            if (!LL(e)) return NL(e);
            var t = PL(e),
                r = [];
            for (var n in e) n == "constructor" && (t || !ML.call(e, n)) || r.push(n);
            return r
        }
        Kp.exports = FL
    });
    var Qp = d((vX, Yp) => {
        var qL = Ri(),
            XL = jp(),
            GL = vt();

        function kL(e) {
            return GL(e) ? qL(e, !0) : XL(e)
        }
        Yp.exports = kL
    });
    var Zp = d((mX, $p) => {
        var VL = Ai(),
            UL = Bp(),
            HL = Qp();

        function BL(e) {
            return VL(e, HL, UL)
        }
        $p.exports = BL
    });
    var eg = d((EX, Jp) => {
        var WL = Vi(),
            zL = ft(),
            KL = Up(),
            jL = Zp();

        function YL(e, t) {
            if (e == null) return {};
            var r = WL(jL(e), function(n) {
                return [n]
            });
            return t = zL(t), KL(e, r, function(n, i) {
                return t(n, i[0])
            })
        }
        Jp.exports = YL
    });
    var rg = d((yX, tg) => {
        var QL = ft(),
            $L = Pp(),
            ZL = eg();

        function JL(e, t) {
            return ZL(e, $L(QL(t)))
        }
        tg.exports = JL
    });
    var ig = d((_X, ng) => {
        var eP = Jr(),
            tP = en(),
            rP = or(),
            nP = Te(),
            iP = vt(),
            oP = jr(),
            aP = Zr(),
            sP = $r(),
            uP = "[object Map]",
            cP = "[object Set]",
            lP = Object.prototype,
            fP = lP.hasOwnProperty;

        function dP(e) {
            if (e == null) return !0;
            if (iP(e) && (nP(e) || typeof e == "string" || typeof e.splice == "function" || oP(e) || sP(e) || rP(e))) return !e.length;
            var t = tP(e);
            if (t == uP || t == cP) return !e.size;
            if (aP(e)) return !eP(e).length;
            for (var r in e)
                if (fP.call(e, r)) return !1;
            return !0
        }
        ng.exports = dP
    });
    var ag = d((IX, og) => {
        var pP = Oo(),
            gP = go(),
            hP = ft();

        function vP(e, t) {
            var r = {};
            return t = hP(t, 3), gP(e, function(n, i, o) {
                pP(r, i, t(n, i, o))
            }), r
        }
        og.exports = vP
    });
    var ug = d((bX, sg) => {
        function mP(e, t) {
            for (var r = -1, n = e == null ? 0 : e.length; ++r < n && t(e[r], r, e) !== !1;);
            return e
        }
        sg.exports = mP
    });
    var lg = d((TX, cg) => {
        var EP = an();

        function yP(e) {
            return typeof e == "function" ? e : EP
        }
        cg.exports = yP
    });
    var dg = d((wX, fg) => {
        var _P = ug(),
            IP = ho(),
            bP = lg(),
            TP = Te();

        function wP(e, t) {
            var r = TP(e) ? _P : IP;
            return r(e, bP(t))
        }
        fg.exports = wP
    });
    var gg = d((AX, pg) => {
        var AP = Be(),
            xP = function() {
                return AP.Date.now()
            };
        pg.exports = xP
    });
    var mg = d((xX, vg) => {
        var SP = Je(),
            Ro = gg(),
            hg = sn(),
            OP = "Expected a function",
            RP = Math.max,
            CP = Math.min;

        function LP(e, t, r) {
            var n, i, o, a, s, u, l = 0,
                m = !1,
                f = !1,
                g = !0;
            if (typeof e != "function") throw new TypeError(OP);
            t = hg(t) || 0, SP(r) && (m = !!r.leading, f = "maxWait" in r, o = f ? RP(hg(r.maxWait) || 0, t) : o, g = "trailing" in r ? !!r.trailing : g);

            function p(L) {
                var B = n,
                    W = i;
                return n = i = void 0, l = L, a = e.apply(W, B), a
            }

            function h(L) {
                return l = L, s = setTimeout(I, t), m ? p(L) : a
            }

            function _(L) {
                var B = L - u,
                    W = L - l,
                    z = t - B;
                return f ? CP(z, o - W) : z
            }

            function T(L) {
                var B = L - u,
                    W = L - l;
                return u === void 0 || B >= t || B < 0 || f && W >= o
            }

            function I() {
                var L = Ro();
                if (T(L)) return C(L);
                s = setTimeout(I, _(L))
            }

            function C(L) {
                return s = void 0, g && n ? p(L) : (n = i = void 0, a)
            }

            function S() {
                s !== void 0 && clearTimeout(s), l = 0, n = u = i = s = void 0
            }

            function P() {
                return s === void 0 ? a : C(Ro())
            }

            function N() {
                var L = Ro(),
                    B = T(L);
                if (n = arguments, i = this, u = L, B) {
                    if (s === void 0) return h(u);
                    if (f) return clearTimeout(s), s = setTimeout(I, t), p(u)
                }
                return s === void 0 && (s = setTimeout(I, t)), a
            }
            return N.cancel = S, N.flush = P, N
        }
        vg.exports = LP
    });
    var yg = d((SX, Eg) => {
        var PP = mg(),
            NP = Je(),
            DP = "Expected a function";

        function MP(e, t, r) {
            var n = !0,
                i = !0;
            if (typeof e != "function") throw new TypeError(DP);
            return NP(r) && (n = "leading" in r ? !!r.leading : n, i = "trailing" in r ? !!r.trailing : i), PP(e, t, {
                leading: n,
                maxWait: t,
                trailing: i
            })
        }
        Eg.exports = MP
    });
    var Ig = {};
    Pe(Ig, {
        actionListPlaybackChanged: () => jt,
        animationFrameChanged: () => Tn,
        clearRequested: () => aN,
        elementStateChanged: () => qo,
        eventListenerAdded: () => bn,
        eventStateChanged: () => Do,
        instanceAdded: () => Mo,
        instanceRemoved: () => Fo,
        instanceStarted: () => wn,
        mediaQueriesDefined: () => Go,
        parameterChanged: () => Kt,
        playbackRequested: () => iN,
        previewRequested: () => nN,
        rawDataImported: () => Co,
        sessionInitialized: () => Lo,
        sessionStarted: () => Po,
        sessionStopped: () => No,
        stopRequested: () => oN,
        testFrameRendered: () => sN,
        viewportWidthChanged: () => Xo
    });
    var _g, FP, qP, XP, GP, kP, VP, UP, HP, BP, WP, zP, KP, jP, YP, QP, $P, ZP, JP, eN, tN, rN, Co, Lo, Po, No, nN, iN, oN, aN, bn, sN, Do, Tn, Kt, Mo, wn, Fo, qo, jt, Xo, Go, An = ve(() => {
        "use strict";
        De();
        _g = le(It()), {
            IX2_RAW_DATA_IMPORTED: FP,
            IX2_SESSION_INITIALIZED: qP,
            IX2_SESSION_STARTED: XP,
            IX2_SESSION_STOPPED: GP,
            IX2_PREVIEW_REQUESTED: kP,
            IX2_PLAYBACK_REQUESTED: VP,
            IX2_STOP_REQUESTED: UP,
            IX2_CLEAR_REQUESTED: HP,
            IX2_EVENT_LISTENER_ADDED: BP,
            IX2_TEST_FRAME_RENDERED: WP,
            IX2_EVENT_STATE_CHANGED: zP,
            IX2_ANIMATION_FRAME_CHANGED: KP,
            IX2_PARAMETER_CHANGED: jP,
            IX2_INSTANCE_ADDED: YP,
            IX2_INSTANCE_STARTED: QP,
            IX2_INSTANCE_REMOVED: $P,
            IX2_ELEMENT_STATE_CHANGED: ZP,
            IX2_ACTION_LIST_PLAYBACK_CHANGED: JP,
            IX2_VIEWPORT_WIDTH_CHANGED: eN,
            IX2_MEDIA_QUERIES_DEFINED: tN
        } = be, {
            reifyState: rN
        } = _g.IX2VanillaUtils, Co = e => ({
            type: FP,
            payload: { ...rN(e)
            }
        }), Lo = ({
            hasBoundaryNodes: e,
            reducedMotion: t
        }) => ({
            type: qP,
            payload: {
                hasBoundaryNodes: e,
                reducedMotion: t
            }
        }), Po = () => ({
            type: XP
        }), No = () => ({
            type: GP
        }), nN = ({
            rawData: e,
            defer: t
        }) => ({
            type: kP,
            payload: {
                defer: t,
                rawData: e
            }
        }), iN = ({
            actionTypeId: e = Ne.GENERAL_START_ACTION,
            actionListId: t,
            actionItemId: r,
            eventId: n,
            allowEvents: i,
            immediate: o,
            testManual: a,
            verbose: s,
            rawData: u
        }) => ({
            type: VP,
            payload: {
                actionTypeId: e,
                actionListId: t,
                actionItemId: r,
                testManual: a,
                eventId: n,
                allowEvents: i,
                immediate: o,
                verbose: s,
                rawData: u
            }
        }), oN = e => ({
            type: UP,
            payload: {
                actionListId: e
            }
        }), aN = () => ({
            type: HP
        }), bn = (e, t) => ({
            type: BP,
            payload: {
                target: e,
                listenerParams: t
            }
        }), sN = (e = 1) => ({
            type: WP,
            payload: {
                step: e
            }
        }), Do = (e, t) => ({
            type: zP,
            payload: {
                stateKey: e,
                newState: t
            }
        }), Tn = (e, t) => ({
            type: KP,
            payload: {
                now: e,
                parameters: t
            }
        }), Kt = (e, t) => ({
            type: jP,
            payload: {
                key: e,
                value: t
            }
        }), Mo = e => ({
            type: YP,
            payload: { ...e
            }
        }), wn = (e, t) => ({
            type: QP,
            payload: {
                instanceId: e,
                time: t
            }
        }), Fo = e => ({
            type: $P,
            payload: {
                instanceId: e
            }
        }), qo = (e, t, r, n) => ({
            type: ZP,
            payload: {
                elementId: e,
                actionTypeId: t,
                current: r,
                actionItem: n
            }
        }), jt = ({
            actionListId: e,
            isPlaying: t
        }) => ({
            type: JP,
            payload: {
                actionListId: e,
                isPlaying: t
            }
        }), Xo = ({
            width: e,
            mediaQueries: t
        }) => ({
            type: eN,
            payload: {
                width: e,
                mediaQueries: t
            }
        }), Go = () => ({
            type: tN
        })
    });
    var Re = {};
    Pe(Re, {
        elementContains: () => Uo,
        getChildElements: () => mN,
        getClosestElement: () => br,
        getProperty: () => dN,
        getQuerySelector: () => Vo,
        getRefType: () => Ho,
        getSiblingElements: () => EN,
        getStyle: () => fN,
        getValidDocument: () => gN,
        isSiblingNode: () => vN,
        matchSelector: () => pN,
        queryDocument: () => hN,
        setStyle: () => lN
    });

    function lN(e, t, r) {
        e.style[t] = r
    }

    function fN(e, t) {
        return t.startsWith("--") ? window.getComputedStyle(document.documentElement).getPropertyValue(t) : e.style[t]
    }

    function dN(e, t) {
        return e[t]
    }

    function pN(e) {
        return t => t[ko](e)
    }

    function Vo({
        id: e,
        selector: t
    }) {
        if (e) {
            let r = e;
            if (e.indexOf(bg) !== -1) {
                let n = e.split(bg),
                    i = n[0];
                if (r = n[1], i !== document.documentElement.getAttribute(wg)) return null
            }
            return `[data-w-id="${r}"], [data-w-id^="${r}_instance"]`
        }
        return t
    }

    function gN(e) {
        return e == null || e === document.documentElement.getAttribute(wg) ? document : null
    }

    function hN(e, t) {
        return Array.prototype.slice.call(document.querySelectorAll(t ? e + " " + t : e))
    }

    function Uo(e, t) {
        return e.contains(t)
    }

    function vN(e, t) {
        return e !== t && e.parentNode === t.parentNode
    }

    function mN(e) {
        let t = [];
        for (let r = 0, {
                length: n
            } = e || []; r < n; r++) {
            let {
                children: i
            } = e[r], {
                length: o
            } = i;
            if (o)
                for (let a = 0; a < o; a++) t.push(i[a])
        }
        return t
    }

    function EN(e = []) {
        let t = [],
            r = [];
        for (let n = 0, {
                length: i
            } = e; n < i; n++) {
            let {
                parentNode: o
            } = e[n];
            if (!o || !o.children || !o.children.length || r.indexOf(o) !== -1) continue;
            r.push(o);
            let a = o.firstElementChild;
            for (; a != null;) e.indexOf(a) === -1 && t.push(a), a = a.nextElementSibling
        }
        return t
    }

    function Ho(e) {
        return e != null && typeof e == "object" ? e instanceof Element ? uN : cN : null
    }
    var Tg, ko, bg, uN, cN, wg, br, Ag = ve(() => {
        "use strict";
        Tg = le(It());
        De();
        ({
            ELEMENT_MATCHES: ko
        } = Tg.IX2BrowserSupport), {
            IX2_ID_DELIMITER: bg,
            HTML_ELEMENT: uN,
            PLAIN_OBJECT: cN,
            WF_PAGE: wg
        } = Ae;
        br = Element.prototype.closest ? (e, t) => document.documentElement.contains(e) ? e.closest(t) : null : (e, t) => {
            if (!document.documentElement.contains(e)) return null;
            let r = e;
            do {
                if (r[ko] && r[ko](t)) return r;
                r = r.parentNode
            } while (r != null);
            return null
        }
    });
    var Bo = d((CX, Sg) => {
        var yN = Je(),
            xg = Object.create,
            _N = function() {
                function e() {}
                return function(t) {
                    if (!yN(t)) return {};
                    if (xg) return xg(t);
                    e.prototype = t;
                    var r = new e;
                    return e.prototype = void 0, r
                }
            }();
        Sg.exports = _N
    });
    var xn = d((LX, Og) => {
        function IN() {}
        Og.exports = IN
    });
    var On = d((PX, Rg) => {
        var bN = Bo(),
            TN = xn();

        function Sn(e, t) {
            this.__wrapped__ = e, this.__actions__ = [], this.__chain__ = !!t, this.__index__ = 0, this.__values__ = void 0
        }
        Sn.prototype = bN(TN.prototype);
        Sn.prototype.constructor = Sn;
        Rg.exports = Sn
    });
    var Ng = d((NX, Pg) => {
        var Cg = At(),
            wN = or(),
            AN = Te(),
            Lg = Cg ? Cg.isConcatSpreadable : void 0;

        function xN(e) {
            return AN(e) || wN(e) || !!(Lg && e && e[Lg])
        }
        Pg.exports = xN
    });
    var Fg = d((DX, Mg) => {
        var SN = Kr(),
            ON = Ng();

        function Dg(e, t, r, n, i) {
            var o = -1,
                a = e.length;
            for (r || (r = ON), i || (i = []); ++o < a;) {
                var s = e[o];
                t > 0 && r(s) ? t > 1 ? Dg(s, t - 1, r, n, i) : SN(i, s) : n || (i[i.length] = s)
            }
            return i
        }
        Mg.exports = Dg
    });
    var Xg = d((MX, qg) => {
        var RN = Fg();

        function CN(e) {
            var t = e == null ? 0 : e.length;
            return t ? RN(e, 1) : []
        }
        qg.exports = CN
    });
    var kg = d((FX, Gg) => {
        function LN(e, t, r) {
            switch (r.length) {
                case 0:
                    return e.call(t);
                case 1:
                    return e.call(t, r[0]);
                case 2:
                    return e.call(t, r[0], r[1]);
                case 3:
                    return e.call(t, r[0], r[1], r[2])
            }
            return e.apply(t, r)
        }
        Gg.exports = LN
    });
    var Hg = d((qX, Ug) => {
        var PN = kg(),
            Vg = Math.max;

        function NN(e, t, r) {
            return t = Vg(t === void 0 ? e.length - 1 : t, 0),
                function() {
                    for (var n = arguments, i = -1, o = Vg(n.length - t, 0), a = Array(o); ++i < o;) a[i] = n[t + i];
                    i = -1;
                    for (var s = Array(t + 1); ++i < t;) s[i] = n[i];
                    return s[t] = r(a), PN(e, this, s)
                }
        }
        Ug.exports = NN
    });
    var Wg = d((XX, Bg) => {
        function DN(e) {
            return function() {
                return e
            }
        }
        Bg.exports = DN
    });
    var jg = d((GX, Kg) => {
        var MN = Wg(),
            zg = So(),
            FN = an(),
            qN = zg ? function(e, t) {
                return zg(e, "toString", {
                    configurable: !0,
                    enumerable: !1,
                    value: MN(t),
                    writable: !0
                })
            } : FN;
        Kg.exports = qN
    });
    var Qg = d((kX, Yg) => {
        var XN = 800,
            GN = 16,
            kN = Date.now;

        function VN(e) {
            var t = 0,
                r = 0;
            return function() {
                var n = kN(),
                    i = GN - (n - r);
                if (r = n, i > 0) {
                    if (++t >= XN) return arguments[0]
                } else t = 0;
                return e.apply(void 0, arguments)
            }
        }
        Yg.exports = VN
    });
    var Zg = d((VX, $g) => {
        var UN = jg(),
            HN = Qg(),
            BN = HN(UN);
        $g.exports = BN
    });
    var eh = d((UX, Jg) => {
        var WN = Xg(),
            zN = Hg(),
            KN = Zg();

        function jN(e) {
            return KN(zN(e, void 0, WN), e + "")
        }
        Jg.exports = jN
    });
    var nh = d((HX, rh) => {
        var th = Ci(),
            YN = th && new th;
        rh.exports = YN
    });
    var oh = d((BX, ih) => {
        function QN() {}
        ih.exports = QN
    });
    var Wo = d((WX, sh) => {
        var ah = nh(),
            $N = oh(),
            ZN = ah ? function(e) {
                return ah.get(e)
            } : $N;
        sh.exports = ZN
    });
    var ch = d((zX, uh) => {
        var JN = {};
        uh.exports = JN
    });
    var zo = d((KX, fh) => {
        var lh = ch(),
            eD = Object.prototype,
            tD = eD.hasOwnProperty;

        function rD(e) {
            for (var t = e.name + "", r = lh[t], n = tD.call(lh, t) ? r.length : 0; n--;) {
                var i = r[n],
                    o = i.func;
                if (o == null || o == e) return i.name
            }
            return t
        }
        fh.exports = rD
    });
    var Cn = d((jX, dh) => {
        var nD = Bo(),
            iD = xn(),
            oD = 4294967295;

        function Rn(e) {
            this.__wrapped__ = e, this.__actions__ = [], this.__dir__ = 1, this.__filtered__ = !1, this.__iteratees__ = [], this.__takeCount__ = oD, this.__views__ = []
        }
        Rn.prototype = nD(iD.prototype);
        Rn.prototype.constructor = Rn;
        dh.exports = Rn
    });
    var gh = d((YX, ph) => {
        function aD(e, t) {
            var r = -1,
                n = e.length;
            for (t || (t = Array(n)); ++r < n;) t[r] = e[r];
            return t
        }
        ph.exports = aD
    });
    var vh = d((QX, hh) => {
        var sD = Cn(),
            uD = On(),
            cD = gh();

        function lD(e) {
            if (e instanceof sD) return e.clone();
            var t = new uD(e.__wrapped__, e.__chain__);
            return t.__actions__ = cD(e.__actions__), t.__index__ = e.__index__, t.__values__ = e.__values__, t
        }
        hh.exports = lD
    });
    var yh = d(($X, Eh) => {
        var fD = Cn(),
            mh = On(),
            dD = xn(),
            pD = Te(),
            gD = nt(),
            hD = vh(),
            vD = Object.prototype,
            mD = vD.hasOwnProperty;

        function Ln(e) {
            if (gD(e) && !pD(e) && !(e instanceof fD)) {
                if (e instanceof mh) return e;
                if (mD.call(e, "__wrapped__")) return hD(e)
            }
            return new mh(e)
        }
        Ln.prototype = dD.prototype;
        Ln.prototype.constructor = Ln;
        Eh.exports = Ln
    });
    var Ih = d((ZX, _h) => {
        var ED = Cn(),
            yD = Wo(),
            _D = zo(),
            ID = yh();

        function bD(e) {
            var t = _D(e),
                r = ID[t];
            if (typeof r != "function" || !(t in ED.prototype)) return !1;
            if (e === r) return !0;
            var n = yD(r);
            return !!n && e === n[0]
        }
        _h.exports = bD
    });
    var Ah = d((JX, wh) => {
        var bh = On(),
            TD = eh(),
            wD = Wo(),
            Ko = zo(),
            AD = Te(),
            Th = Ih(),
            xD = "Expected a function",
            SD = 8,
            OD = 32,
            RD = 128,
            CD = 256;

        function LD(e) {
            return TD(function(t) {
                var r = t.length,
                    n = r,
                    i = bh.prototype.thru;
                for (e && t.reverse(); n--;) {
                    var o = t[n];
                    if (typeof o != "function") throw new TypeError(xD);
                    if (i && !a && Ko(o) == "wrapper") var a = new bh([], !0)
                }
                for (n = a ? n : r; ++n < r;) {
                    o = t[n];
                    var s = Ko(o),
                        u = s == "wrapper" ? wD(o) : void 0;
                    u && Th(u[0]) && u[1] == (RD | SD | OD | CD) && !u[4].length && u[9] == 1 ? a = a[Ko(u[0])].apply(a, u[3]) : a = o.length == 1 && Th(o) ? a[s]() : a.thru(o)
                }
                return function() {
                    var l = arguments,
                        m = l[0];
                    if (a && l.length == 1 && AD(m)) return a.plant(m).value();
                    for (var f = 0, g = r ? t[f].apply(this, l) : m; ++f < r;) g = t[f].call(this, g);
                    return g
                }
            })
        }
        wh.exports = LD
    });
    var Sh = d((eG, xh) => {
        var PD = Ah(),
            ND = PD();
        xh.exports = ND
    });
    var Rh = d((tG, Oh) => {
        function DD(e, t, r) {
            return e === e && (r !== void 0 && (e = e <= r ? e : r), t !== void 0 && (e = e >= t ? e : t)), e
        }
        Oh.exports = DD
    });
    var Lh = d((rG, Ch) => {
        var MD = Rh(),
            jo = sn();

        function FD(e, t, r) {
            return r === void 0 && (r = t, t = void 0), r !== void 0 && (r = jo(r), r = r === r ? r : 0), t !== void 0 && (t = jo(t), t = t === t ? t : 0), MD(jo(e), t, r)
        }
        Ch.exports = FD
    });
    var kh, Vh, Uh, Hh, qD, XD, GD, kD, VD, UD, HD, BD, WD, zD, KD, jD, YD, QD, $D, Bh, Wh, ZD, JD, eM, zh, tM, rM, Kh, nM, Yo, jh, Ph, Nh, Yh, wr, iM, rt, Qh, oM, Fe, Ke, Ar, $h, Qo, Dh, $o, aM, Tr, sM, uM, cM, Zh, Mh, lM, Fh, fM, dM, pM, qh, Pn, Nn, Xh, Gh, Jh, ev = ve(() => {
        "use strict";
        kh = le(Sh()), Vh = le(on()), Uh = le(Lh());
        De();
        Zo();
        An();
        Hh = le(It()), {
            MOUSE_CLICK: qD,
            MOUSE_SECOND_CLICK: XD,
            MOUSE_DOWN: GD,
            MOUSE_UP: kD,
            MOUSE_OVER: VD,
            MOUSE_OUT: UD,
            DROPDOWN_CLOSE: HD,
            DROPDOWN_OPEN: BD,
            SLIDER_ACTIVE: WD,
            SLIDER_INACTIVE: zD,
            TAB_ACTIVE: KD,
            TAB_INACTIVE: jD,
            NAVBAR_CLOSE: YD,
            NAVBAR_OPEN: QD,
            MOUSE_MOVE: $D,
            PAGE_SCROLL_DOWN: Bh,
            SCROLL_INTO_VIEW: Wh,
            SCROLL_OUT_OF_VIEW: ZD,
            PAGE_SCROLL_UP: JD,
            SCROLLING_IN_VIEW: eM,
            PAGE_FINISH: zh,
            ECOMMERCE_CART_CLOSE: tM,
            ECOMMERCE_CART_OPEN: rM,
            PAGE_START: Kh,
            PAGE_SCROLL: nM
        } = We, Yo = "COMPONENT_ACTIVE", jh = "COMPONENT_INACTIVE", {
            COLON_DELIMITER: Ph
        } = Ae, {
            getNamespacedParameterId: Nh
        } = Hh.IX2VanillaUtils, Yh = e => t => typeof t == "object" && e(t) ? !0 : t, wr = Yh(({
            element: e,
            nativeEvent: t
        }) => e === t.target), iM = Yh(({
            element: e,
            nativeEvent: t
        }) => e.contains(t.target)), rt = (0, kh.default)([wr, iM]), Qh = (e, t) => {
            if (t) {
                let {
                    ixData: r
                } = e.getState(), {
                    events: n
                } = r, i = n[t];
                if (i && !aM[i.eventTypeId]) return i
            }
            return null
        }, oM = ({
            store: e,
            event: t
        }) => {
            let {
                action: r
            } = t, {
                autoStopEventId: n
            } = r.config;
            return !!Qh(e, n)
        }, Fe = ({
            store: e,
            event: t,
            element: r,
            eventStateKey: n
        }, i) => {
            let {
                action: o,
                id: a
            } = t, {
                actionListId: s,
                autoStopEventId: u
            } = o.config, l = Qh(e, u);
            return l && Yt({
                store: e,
                eventId: u,
                eventTarget: r,
                eventStateKey: u + Ph + n.split(Ph)[1],
                actionListId: (0, Vh.default)(l, "action.config.actionListId")
            }), Yt({
                store: e,
                eventId: a,
                eventTarget: r,
                eventStateKey: n,
                actionListId: s
            }), xr({
                store: e,
                eventId: a,
                eventTarget: r,
                eventStateKey: n,
                actionListId: s
            }), i
        }, Ke = (e, t) => (r, n) => e(r, n) === !0 ? t(r, n) : n, Ar = {
            handler: Ke(rt, Fe)
        }, $h = { ...Ar,
            types: [Yo, jh].join(" ")
        }, Qo = [{
            target: window,
            types: "resize orientationchange",
            throttle: !0
        }, {
            target: document,
            types: "scroll wheel readystatechange IX2_PAGE_UPDATE",
            throttle: !0
        }], Dh = "mouseover mouseout", $o = {
            types: Qo
        }, aM = {
            PAGE_START: Kh,
            PAGE_FINISH: zh
        }, Tr = (() => {
            let e = window.pageXOffset !== void 0,
                r = document.compatMode === "CSS1Compat" ? document.documentElement : document.body;
            return () => ({
                scrollLeft: e ? window.pageXOffset : r.scrollLeft,
                scrollTop: e ? window.pageYOffset : r.scrollTop,
                stiffScrollTop: (0, Uh.default)(e ? window.pageYOffset : r.scrollTop, 0, r.scrollHeight - window.innerHeight),
                scrollWidth: r.scrollWidth,
                scrollHeight: r.scrollHeight,
                clientWidth: r.clientWidth,
                clientHeight: r.clientHeight,
                innerWidth: window.innerWidth,
                innerHeight: window.innerHeight
            })
        })(), sM = (e, t) => !(e.left > t.right || e.right < t.left || e.top > t.bottom || e.bottom < t.top), uM = ({
            element: e,
            nativeEvent: t
        }) => {
            let {
                type: r,
                target: n,
                relatedTarget: i
            } = t, o = e.contains(n);
            if (r === "mouseover" && o) return !0;
            let a = e.contains(i);
            return !!(r === "mouseout" && o && a)
        }, cM = e => {
            let {
                element: t,
                event: {
                    config: r
                }
            } = e, {
                clientWidth: n,
                clientHeight: i
            } = Tr(), o = r.scrollOffsetValue, u = r.scrollOffsetUnit === "PX" ? o : i * (o || 0) / 100;
            return sM(t.getBoundingClientRect(), {
                left: 0,
                top: u,
                right: n,
                bottom: i - u
            })
        }, Zh = e => (t, r) => {
            let {
                type: n
            } = t.nativeEvent, i = [Yo, jh].indexOf(n) !== -1 ? n === Yo : r.isActive, o = { ...r,
                isActive: i
            };
            return (!r || o.isActive !== r.isActive) && e(t, o) || o
        }, Mh = e => (t, r) => {
            let n = {
                elementHovered: uM(t)
            };
            return (r ? n.elementHovered !== r.elementHovered : n.elementHovered) && e(t, n) || n
        }, lM = e => (t, r) => {
            let n = { ...r,
                elementVisible: cM(t)
            };
            return (r ? n.elementVisible !== r.elementVisible : n.elementVisible) && e(t, n) || n
        }, Fh = e => (t, r = {}) => {
            let {
                stiffScrollTop: n,
                scrollHeight: i,
                innerHeight: o
            } = Tr(), {
                event: {
                    config: a,
                    eventTypeId: s
                }
            } = t, {
                scrollOffsetValue: u,
                scrollOffsetUnit: l
            } = a, m = l === "PX", f = i - o, g = Number((n / f).toFixed(2));
            if (r && r.percentTop === g) return r;
            let p = (m ? u : o * (u || 0) / 100) / f,
                h, _, T = 0;
            r && (h = g > r.percentTop, _ = r.scrollingDown !== h, T = _ ? g : r.anchorTop);
            let I = s === Bh ? g >= T + p : g <= T - p,
                C = { ...r,
                    percentTop: g,
                    inBounds: I,
                    anchorTop: T,
                    scrollingDown: h
                };
            return r && I && (_ || C.inBounds !== r.inBounds) && e(t, C) || C
        }, fM = (e, t) => e.left > t.left && e.left < t.right && e.top > t.top && e.top < t.bottom, dM = e => (t, r) => {
            let n = {
                finished: document.readyState === "complete"
            };
            return n.finished && !(r && r.finshed) && e(t), n
        }, pM = e => (t, r) => {
            let n = {
                started: !0
            };
            return r || e(t), n
        }, qh = e => (t, r = {
            clickCount: 0
        }) => {
            let n = {
                clickCount: r.clickCount % 2 + 1
            };
            return n.clickCount !== r.clickCount && e(t, n) || n
        }, Pn = (e = !0) => ({ ...$h,
            handler: Ke(e ? rt : wr, Zh((t, r) => r.isActive ? Ar.handler(t, r) : r))
        }), Nn = (e = !0) => ({ ...$h,
            handler: Ke(e ? rt : wr, Zh((t, r) => r.isActive ? r : Ar.handler(t, r)))
        }), Xh = { ...$o,
            handler: lM((e, t) => {
                let {
                    elementVisible: r
                } = t, {
                    event: n,
                    store: i
                } = e, {
                    ixData: o
                } = i.getState(), {
                    events: a
                } = o;
                return !a[n.action.config.autoStopEventId] && t.triggered ? t : n.eventTypeId === Wh === r ? (Fe(e), { ...t,
                    triggered: !0
                }) : t
            })
        }, Gh = .05, Jh = {
            [WD]: Pn(),
            [zD]: Nn(),
            [BD]: Pn(),
            [HD]: Nn(),
            [QD]: Pn(!1),
            [YD]: Nn(!1),
            [KD]: Pn(),
            [jD]: Nn(),
            [rM]: {
                types: "ecommerce-cart-open",
                handler: Ke(rt, Fe)
            },
            [tM]: {
                types: "ecommerce-cart-close",
                handler: Ke(rt, Fe)
            },
            [qD]: {
                types: "click",
                handler: Ke(rt, qh((e, {
                    clickCount: t
                }) => {
                    oM(e) ? t === 1 && Fe(e) : Fe(e)
                }))
            },
            [XD]: {
                types: "click",
                handler: Ke(rt, qh((e, {
                    clickCount: t
                }) => {
                    t === 2 && Fe(e)
                }))
            },
            [GD]: { ...Ar,
                types: "mousedown"
            },
            [kD]: { ...Ar,
                types: "mouseup"
            },
            [VD]: {
                types: Dh,
                handler: Ke(rt, Mh((e, t) => {
                    t.elementHovered && Fe(e)
                }))
            },
            [UD]: {
                types: Dh,
                handler: Ke(rt, Mh((e, t) => {
                    t.elementHovered || Fe(e)
                }))
            },
            [$D]: {
                types: "mousemove mouseout scroll",
                handler: ({
                    store: e,
                    element: t,
                    eventConfig: r,
                    nativeEvent: n,
                    eventStateKey: i
                }, o = {
                    clientX: 0,
                    clientY: 0,
                    pageX: 0,
                    pageY: 0
                }) => {
                    let {
                        basedOn: a,
                        selectedAxis: s,
                        continuousParameterGroupId: u,
                        reverse: l,
                        restingState: m = 0
                    } = r, {
                        clientX: f = o.clientX,
                        clientY: g = o.clientY,
                        pageX: p = o.pageX,
                        pageY: h = o.pageY
                    } = n, _ = s === "X_AXIS", T = n.type === "mouseout", I = m / 100, C = u, S = !1;
                    switch (a) {
                        case Ze.VIEWPORT:
                            {
                                I = _ ? Math.min(f, window.innerWidth) / window.innerWidth : Math.min(g, window.innerHeight) / window.innerHeight;
                                break
                            }
                        case Ze.PAGE:
                            {
                                let {
                                    scrollLeft: P,
                                    scrollTop: N,
                                    scrollWidth: L,
                                    scrollHeight: B
                                } = Tr();I = _ ? Math.min(P + p, L) / L : Math.min(N + h, B) / B;
                                break
                            }
                        case Ze.ELEMENT:
                        default:
                            {
                                C = Nh(i, u);
                                let P = n.type.indexOf("mouse") === 0;
                                if (P && rt({
                                        element: t,
                                        nativeEvent: n
                                    }) !== !0) break;
                                let N = t.getBoundingClientRect(),
                                    {
                                        left: L,
                                        top: B,
                                        width: W,
                                        height: z
                                    } = N;
                                if (!P && !fM({
                                        left: f,
                                        top: g
                                    }, N)) break;S = !0,
                                I = _ ? (f - L) / W : (g - B) / z;
                                break
                            }
                    }
                    return T && (I > 1 - Gh || I < Gh) && (I = Math.round(I)), (a !== Ze.ELEMENT || S || S !== o.elementHovered) && (I = l ? 1 - I : I, e.dispatch(Kt(C, I))), {
                        elementHovered: S,
                        clientX: f,
                        clientY: g,
                        pageX: p,
                        pageY: h
                    }
                }
            },
            [nM]: {
                types: Qo,
                handler: ({
                    store: e,
                    eventConfig: t
                }) => {
                    let {
                        continuousParameterGroupId: r,
                        reverse: n
                    } = t, {
                        scrollTop: i,
                        scrollHeight: o,
                        clientHeight: a
                    } = Tr(), s = i / (o - a);
                    s = n ? 1 - s : s, e.dispatch(Kt(r, s))
                }
            },
            [eM]: {
                types: Qo,
                handler: ({
                    element: e,
                    store: t,
                    eventConfig: r,
                    eventStateKey: n
                }, i = {
                    scrollPercent: 0
                }) => {
                    let {
                        scrollLeft: o,
                        scrollTop: a,
                        scrollWidth: s,
                        scrollHeight: u,
                        clientHeight: l
                    } = Tr(), {
                        basedOn: m,
                        selectedAxis: f,
                        continuousParameterGroupId: g,
                        startsEntering: p,
                        startsExiting: h,
                        addEndOffset: _,
                        addStartOffset: T,
                        addOffsetValue: I = 0,
                        endOffsetValue: C = 0
                    } = r, S = f === "X_AXIS";
                    if (m === Ze.VIEWPORT) {
                        let P = S ? o / s : a / u;
                        return P !== i.scrollPercent && t.dispatch(Kt(g, P)), {
                            scrollPercent: P
                        }
                    } else {
                        let P = Nh(n, g),
                            N = e.getBoundingClientRect(),
                            L = (T ? I : 0) / 100,
                            B = (_ ? C : 0) / 100;
                        L = p ? L : 1 - L, B = h ? B : 1 - B;
                        let W = N.top + Math.min(N.height * L, l),
                            $ = N.top + N.height * B - W,
                            ie = Math.min(l + $, u),
                            x = Math.min(Math.max(0, l - W), ie) / ie;
                        return x !== i.scrollPercent && t.dispatch(Kt(P, x)), {
                            scrollPercent: x
                        }
                    }
                }
            },
            [Wh]: Xh,
            [ZD]: Xh,
            [Bh]: { ...$o,
                handler: Fh((e, t) => {
                    t.scrollingDown && Fe(e)
                })
            },
            [JD]: { ...$o,
                handler: Fh((e, t) => {
                    t.scrollingDown || Fe(e)
                })
            },
            [zh]: {
                types: "readystatechange IX2_PAGE_UPDATE",
                handler: Ke(wr, dM(Fe))
            },
            [Kh]: {
                types: "readystatechange IX2_PAGE_UPDATE",
                handler: Ke(wr, pM(Fe))
            }
        }
    });
    var mv = {};
    Pe(mv, {
        observeRequests: () => NM,
        startActionGroup: () => xr,
        startEngine: () => Gn,
        stopActionGroup: () => Yt,
        stopAllActionGroups: () => gv,
        stopEngine: () => kn
    });

    function NM(e) {
        bt({
            store: e,
            select: ({
                ixRequest: t
            }) => t.preview,
            onChange: FM
        }), bt({
            store: e,
            select: ({
                ixRequest: t
            }) => t.playback,
            onChange: qM
        }), bt({
            store: e,
            select: ({
                ixRequest: t
            }) => t.stop,
            onChange: XM
        }), bt({
            store: e,
            select: ({
                ixRequest: t
            }) => t.clear,
            onChange: GM
        })
    }

    function DM(e) {
        bt({
            store: e,
            select: ({
                ixSession: t
            }) => t.mediaQueryKey,
            onChange: () => {
                kn(e), lv({
                    store: e,
                    elementApi: Re
                }), Gn({
                    store: e,
                    allowEvents: !0
                }), fv()
            }
        })
    }

    function MM(e, t) {
        let r = bt({
            store: e,
            select: ({
                ixSession: n
            }) => n.tick,
            onChange: n => {
                t(n), r()
            }
        })
    }

    function FM({
        rawData: e,
        defer: t
    }, r) {
        let n = () => {
            Gn({
                store: r,
                rawData: e,
                allowEvents: !0
            }), fv()
        };
        t ? setTimeout(n, 0) : n()
    }

    function fv() {
        document.dispatchEvent(new CustomEvent("IX2_PAGE_UPDATE"))
    }

    function qM(e, t) {
        let {
            actionTypeId: r,
            actionListId: n,
            actionItemId: i,
            eventId: o,
            allowEvents: a,
            immediate: s,
            testManual: u,
            verbose: l = !0
        } = e, {
            rawData: m
        } = e;
        if (n && i && m && s) {
            let f = m.actionLists[n];
            f && (m = bM({
                actionList: f,
                actionItemId: i,
                rawData: m
            }))
        }
        if (Gn({
                store: t,
                rawData: m,
                allowEvents: a,
                testManual: u
            }), n && r === Ne.GENERAL_START_ACTION || Jo(r)) {
            Yt({
                store: t,
                actionListId: n
            }), pv({
                store: t,
                actionListId: n,
                eventId: o
            });
            let f = xr({
                store: t,
                eventId: o,
                actionListId: n,
                immediate: s,
                verbose: l
            });
            l && f && t.dispatch(jt({
                actionListId: n,
                isPlaying: !s
            }))
        }
    }

    function XM({
        actionListId: e
    }, t) {
        e ? Yt({
            store: t,
            actionListId: e
        }) : gv({
            store: t
        }), kn(t)
    }

    function GM(e, t) {
        kn(t), lv({
            store: t,
            elementApi: Re
        })
    }

    function Gn({
        store: e,
        rawData: t,
        allowEvents: r,
        testManual: n
    }) {
        let {
            ixSession: i
        } = e.getState();
        t && e.dispatch(Co(t)), i.active || (e.dispatch(Lo({
            hasBoundaryNodes: !!document.querySelector(Mn),
            reducedMotion: document.body.hasAttribute("data-wf-ix-vacation") && window.matchMedia("(prefers-reduced-motion)").matches
        })), r && (WM(e), kM(), e.getState().ixSession.hasDefinedMediaQueries && DM(e)), e.dispatch(Po()), VM(e, n))
    }

    function kM() {
        let {
            documentElement: e
        } = document;
        e.className.indexOf(tv) === -1 && (e.className += ` ${tv}`)
    }

    function VM(e, t) {
        let r = n => {
            let {
                ixSession: i,
                ixParameters: o
            } = e.getState();
            i.active && (e.dispatch(Tn(n, o)), t ? MM(e, r) : requestAnimationFrame(r))
        };
        r(window.performance.now())
    }

    function kn(e) {
        let {
            ixSession: t
        } = e.getState();
        if (t.active) {
            let {
                eventListeners: r
            } = t;
            r.forEach(UM), xM(), e.dispatch(No())
        }
    }

    function UM({
        target: e,
        listenerParams: t
    }) {
        e.removeEventListener.apply(e, t)
    }

    function HM({
        store: e,
        eventStateKey: t,
        eventTarget: r,
        eventId: n,
        eventConfig: i,
        actionListId: o,
        parameterGroup: a,
        smoothing: s,
        restingValue: u
    }) {
        let {
            ixData: l,
            ixSession: m
        } = e.getState(), {
            events: f
        } = l, g = f[n], {
            eventTypeId: p
        } = g, h = {}, _ = {}, T = [], {
            continuousActionGroups: I
        } = a, {
            id: C
        } = a;
        TM(p, i) && (C = wM(t, C));
        let S = m.hasBoundaryNodes && r ? br(r, Mn) : null;
        I.forEach(P => {
            let {
                keyframe: N,
                actionItems: L
            } = P;
            L.forEach(B => {
                let {
                    actionTypeId: W
                } = B, {
                    target: z
                } = B.config;
                if (!z) return;
                let $ = z.boundaryMode ? S : null,
                    ie = SM(z) + ea + W;
                if (_[ie] = BM(_[ie], N, B), !h[ie]) {
                    h[ie] = !0;
                    let {
                        config: F
                    } = B;
                    Fn({
                        config: F,
                        event: g,
                        eventTarget: r,
                        elementRoot: $,
                        elementApi: Re
                    }).forEach(x => {
                        T.push({
                            element: x,
                            key: ie
                        })
                    })
                }
            })
        }), T.forEach(({
            element: P,
            key: N
        }) => {
            let L = _[N],
                B = (0, st.default)(L, "[0].actionItems[0]", {}),
                {
                    actionTypeId: W
                } = B,
                z = Xn(W) ? ra(W)(P, B) : null,
                $ = ta({
                    element: P,
                    actionItem: B,
                    elementApi: Re
                }, z);
            na({
                store: e,
                element: P,
                eventId: n,
                actionListId: o,
                actionItem: B,
                destination: $,
                continuous: !0,
                parameterId: C,
                actionGroups: L,
                smoothing: s,
                restingValue: u,
                pluginInstance: z
            })
        })
    }

    function BM(e = [], t, r) {
        let n = [...e],
            i;
        return n.some((o, a) => o.keyframe === t ? (i = a, !0) : !1), i == null && (i = n.length, n.push({
            keyframe: t,
            actionItems: []
        })), n[i].actionItems.push(r), n
    }

    function WM(e) {
        let {
            ixData: t
        } = e.getState(), {
            eventTypeMap: r
        } = t;
        dv(e), (0, Qt.default)(r, (i, o) => {
            let a = Jh[o];
            if (!a) {
                console.warn(`IX2 event type not configured: ${o}`);
                return
            }
            $M({
                logic: a,
                store: e,
                events: i
            })
        });
        let {
            ixSession: n
        } = e.getState();
        n.eventListeners.length && KM(e)
    }

    function KM(e) {
        let t = () => {
            dv(e)
        };
        zM.forEach(r => {
            window.addEventListener(r, t), e.dispatch(bn(window, [r, t]))
        }), t()
    }

    function dv(e) {
        let {
            ixSession: t,
            ixData: r
        } = e.getState(), n = window.innerWidth;
        if (n !== t.viewportWidth) {
            let {
                mediaQueries: i
            } = r;
            e.dispatch(Xo({
                width: n,
                mediaQueries: i
            }))
        }
    }

    function $M({
        logic: e,
        store: t,
        events: r
    }) {
        ZM(r);
        let {
            types: n,
            handler: i
        } = e, {
            ixData: o
        } = t.getState(), {
            actionLists: a
        } = o, s = jM(r, QM);
        if (!(0, iv.default)(s)) return;
        (0, Qt.default)(s, (f, g) => {
            let p = r[g],
                {
                    action: h,
                    id: _,
                    mediaQueries: T = o.mediaQueryKeys
                } = p,
                {
                    actionListId: I
                } = h.config;
            OM(T, o.mediaQueryKeys) || t.dispatch(Go()), h.actionTypeId === Ne.GENERAL_CONTINUOUS_ACTION && (Array.isArray(p.config) ? p.config : [p.config]).forEach(S => {
                let {
                    continuousParameterGroupId: P
                } = S, N = (0, st.default)(a, `${I}.continuousParameterGroups`, []), L = (0, nv.default)(N, ({
                    id: z
                }) => z === P), B = (S.smoothing || 0) / 100, W = (S.restingState || 0) / 100;
                L && f.forEach((z, $) => {
                    let ie = _ + ea + $;
                    HM({
                        store: t,
                        eventStateKey: ie,
                        eventTarget: z,
                        eventId: _,
                        eventConfig: S,
                        actionListId: I,
                        parameterGroup: L,
                        smoothing: B,
                        restingValue: W
                    })
                })
            }), (h.actionTypeId === Ne.GENERAL_START_ACTION || Jo(h.actionTypeId)) && pv({
                store: t,
                actionListId: I,
                eventId: _
            })
        });
        let u = f => {
                let {
                    ixSession: g
                } = t.getState();
                YM(s, (p, h, _) => {
                    let T = r[h],
                        I = g.eventState[_],
                        {
                            action: C,
                            mediaQueries: S = o.mediaQueryKeys
                        } = T;
                    if (!qn(S, g.mediaQueryKey)) return;
                    let P = (N = {}) => {
                        let L = i({
                            store: t,
                            element: p,
                            event: T,
                            eventConfig: N,
                            nativeEvent: f,
                            eventStateKey: _
                        }, I);
                        RM(L, I) || t.dispatch(Do(_, L))
                    };
                    C.actionTypeId === Ne.GENERAL_CONTINUOUS_ACTION ? (Array.isArray(T.config) ? T.config : [T.config]).forEach(P) : P()
                })
            },
            l = (0, uv.default)(u, PM),
            m = ({
                target: f = document,
                types: g,
                throttle: p
            }) => {
                g.split(" ").filter(Boolean).forEach(h => {
                    let _ = p ? l : u;
                    f.addEventListener(h, _), t.dispatch(bn(f, [h, _]))
                })
            };
        Array.isArray(n) ? n.forEach(m) : typeof n == "string" && m(e)
    }

    function ZM(e) {
        if (!LM) return;
        let t = {},
            r = "";
        for (let n in e) {
            let {
                eventTypeId: i,
                target: o
            } = e[n], a = Vo(o);
            t[a] || (i === We.MOUSE_CLICK || i === We.MOUSE_SECOND_CLICK) && (t[a] = !0, r += a + "{cursor: pointer;touch-action: manipulation;}")
        }
        if (r) {
            let n = document.createElement("style");
            n.textContent = r, document.body.appendChild(n)
        }
    }

    function pv({
        store: e,
        actionListId: t,
        eventId: r
    }) {
        let {
            ixData: n,
            ixSession: i
        } = e.getState(), {
            actionLists: o,
            events: a
        } = n, s = a[r], u = o[t];
        if (u && u.useFirstGroupAsInitialState) {
            let l = (0, st.default)(u, "actionItemGroups[0].actionItems", []),
                m = (0, st.default)(s, "mediaQueries", n.mediaQueryKeys);
            if (!qn(m, i.mediaQueryKey)) return;
            l.forEach(f => {
                let {
                    config: g,
                    actionTypeId: p
                } = f, h = g ? .target ? .useEventTarget === !0 && g ? .target ? .objectId == null ? {
                    target: s.target,
                    targets: s.targets
                } : g, _ = Fn({
                    config: h,
                    event: s,
                    elementApi: Re
                }), T = Xn(p);
                _.forEach(I => {
                    let C = T ? ra(p)(I, f) : null;
                    na({
                        destination: ta({
                            element: I,
                            actionItem: f,
                            elementApi: Re
                        }, C),
                        immediate: !0,
                        store: e,
                        element: I,
                        eventId: r,
                        actionItem: f,
                        actionListId: t,
                        pluginInstance: C
                    })
                })
            })
        }
    }

    function gv({
        store: e
    }) {
        let {
            ixInstances: t
        } = e.getState();
        (0, Qt.default)(t, r => {
            if (!r.continuous) {
                let {
                    actionListId: n,
                    verbose: i
                } = r;
                ia(r, e), i && e.dispatch(jt({
                    actionListId: n,
                    isPlaying: !1
                }))
            }
        })
    }

    function Yt({
        store: e,
        eventId: t,
        eventTarget: r,
        eventStateKey: n,
        actionListId: i
    }) {
        let {
            ixInstances: o,
            ixSession: a
        } = e.getState(), s = a.hasBoundaryNodes && r ? br(r, Mn) : null;
        (0, Qt.default)(o, u => {
            let l = (0, st.default)(u, "actionItem.config.target.boundaryMode"),
                m = n ? u.eventStateKey === n : !0;
            if (u.actionListId === i && u.eventId === t && m) {
                if (s && l && !Uo(s, u.element)) return;
                ia(u, e), u.verbose && e.dispatch(jt({
                    actionListId: i,
                    isPlaying: !1
                }))
            }
        })
    }

    function xr({
        store: e,
        eventId: t,
        eventTarget: r,
        eventStateKey: n,
        actionListId: i,
        groupIndex: o = 0,
        immediate: a,
        verbose: s
    }) {
        let {
            ixData: u,
            ixSession: l
        } = e.getState(), {
            events: m
        } = u, f = m[t] || {}, {
            mediaQueries: g = u.mediaQueryKeys
        } = f, p = (0, st.default)(u, `actionLists.${i}`, {}), {
            actionItemGroups: h,
            useFirstGroupAsInitialState: _
        } = p;
        if (!h || !h.length) return !1;
        o >= h.length && (0, st.default)(f, "config.loop") && (o = 0), o === 0 && _ && o++;
        let I = (o === 0 || o === 1 && _) && Jo(f.action ? .actionTypeId) ? f.config.delay : void 0,
            C = (0, st.default)(h, [o, "actionItems"], []);
        if (!C.length || !qn(g, l.mediaQueryKey)) return !1;
        let S = l.hasBoundaryNodes && r ? br(r, Mn) : null,
            P = yM(C),
            N = !1;
        return C.forEach((L, B) => {
            let {
                config: W,
                actionTypeId: z
            } = L, $ = Xn(z), {
                target: ie
            } = W;
            if (!ie) return;
            let F = ie.boundaryMode ? S : null;
            Fn({
                config: W,
                event: f,
                eventTarget: r,
                elementRoot: F,
                elementApi: Re
            }).forEach((D, U) => {
                let q = $ ? ra(z)(D, L) : null,
                    Z = $ ? CM(z)(D, L) : null;
                N = !0;
                let re = P === B && U === 0,
                    M = _M({
                        element: D,
                        actionItem: L
                    }),
                    X = ta({
                        element: D,
                        actionItem: L,
                        elementApi: Re
                    }, q);
                na({
                    store: e,
                    element: D,
                    actionItem: L,
                    eventId: t,
                    eventTarget: r,
                    eventStateKey: n,
                    actionListId: i,
                    groupIndex: o,
                    isCarrier: re,
                    computedStyle: M,
                    destination: X,
                    immediate: a,
                    verbose: s,
                    pluginInstance: q,
                    pluginDuration: Z,
                    instanceDelay: I
                })
            })
        }), N
    }

    function na(e) {
        let {
            store: t,
            computedStyle: r,
            ...n
        } = e, {
            element: i,
            actionItem: o,
            immediate: a,
            pluginInstance: s,
            continuous: u,
            restingValue: l,
            eventId: m
        } = n, f = !u, g = mM(), {
            ixElements: p,
            ixSession: h,
            ixData: _
        } = t.getState(), T = vM(p, i), {
            refState: I
        } = p[T] || {}, C = Ho(i), S = h.reducedMotion && mi[o.actionTypeId], P;
        if (S && u) switch (_.events[m] ? .eventTypeId) {
            case We.MOUSE_MOVE:
            case We.MOUSE_MOVE_IN_VIEWPORT:
                P = l;
                break;
            default:
                P = .5;
                break
        }
        let N = IM(i, I, r, o, Re, s);
        if (t.dispatch(Mo({
                instanceId: g,
                elementId: T,
                origin: N,
                refType: C,
                skipMotion: S,
                skipToValue: P,
                ...n
            })), hv(document.body, "ix2-animation-started", g), a) {
            JM(t, g);
            return
        }
        bt({
            store: t,
            select: ({
                ixInstances: L
            }) => L[g],
            onChange: vv
        }), f && t.dispatch(wn(g, h.tick))
    }

    function ia(e, t) {
        hv(document.body, "ix2-animation-stopping", {
            instanceId: e.id,
            state: t.getState()
        });
        let {
            elementId: r,
            actionItem: n
        } = e, {
            ixElements: i
        } = t.getState(), {
            ref: o,
            refType: a
        } = i[r] || {};
        a === cv && AM(o, n, Re), t.dispatch(Fo(e.id))
    }

    function hv(e, t, r) {
        let n = document.createEvent("CustomEvent");
        n.initCustomEvent(t, !0, !0, r), e.dispatchEvent(n)
    }

    function JM(e, t) {
        let {
            ixParameters: r
        } = e.getState();
        e.dispatch(wn(t, 0)), e.dispatch(Tn(performance.now(), r));
        let {
            ixInstances: n
        } = e.getState();
        vv(n[t], e)
    }

    function vv(e, t) {
        let {
            active: r,
            continuous: n,
            complete: i,
            elementId: o,
            actionItem: a,
            actionTypeId: s,
            renderType: u,
            current: l,
            groupIndex: m,
            eventId: f,
            eventTarget: g,
            eventStateKey: p,
            actionListId: h,
            isCarrier: _,
            styleProp: T,
            verbose: I,
            pluginInstance: C
        } = e, {
            ixData: S,
            ixSession: P
        } = t.getState(), {
            events: N
        } = S, L = N && N[f] ? N[f] : {}, {
            mediaQueries: B = S.mediaQueryKeys
        } = L;
        if (qn(B, P.mediaQueryKey) && (n || r || i)) {
            if (l || u === hM && i) {
                t.dispatch(qo(o, s, l, a));
                let {
                    ixElements: W
                } = t.getState(), {
                    ref: z,
                    refType: $,
                    refState: ie
                } = W[o] || {}, F = ie && ie[s];
                ($ === cv || Xn(s)) && EM(z, ie, F, f, a, T, Re, u, C)
            }
            if (i) {
                if (_) {
                    let W = xr({
                        store: t,
                        eventId: f,
                        eventTarget: g,
                        eventStateKey: p,
                        actionListId: h,
                        groupIndex: m + 1,
                        verbose: I
                    });
                    I && !W && t.dispatch(jt({
                        actionListId: h,
                        isPlaying: !1
                    }))
                }
                ia(e, t)
            }
        }
    }
    var nv, st, iv, ov, av, sv, Qt, uv, Dn, gM, Jo, ea, Mn, cv, hM, tv, Fn, vM, ta, bt, mM, EM, lv, yM, _M, IM, bM, TM, wM, qn, AM, xM, SM, OM, RM, Xn, ra, CM, rv, LM, PM, zM, jM, YM, QM, Zo = ve(() => {
        "use strict";
        nv = le(zi()), st = le(on()), iv = le(Cp()), ov = le(rg()), av = le(ig()), sv = le(ag()), Qt = le(dg()), uv = le(yg());
        De();
        Dn = le(It());
        An();
        Ag();
        ev();
        gM = Object.keys(Fr), Jo = e => gM.includes(e), {
            COLON_DELIMITER: ea,
            BOUNDARY_SELECTOR: Mn,
            HTML_ELEMENT: cv,
            RENDER_GENERAL: hM,
            W_MOD_IX: tv
        } = Ae, {
            getAffectedElements: Fn,
            getElementId: vM,
            getDestinationValues: ta,
            observeStore: bt,
            getInstanceId: mM,
            renderHTMLElement: EM,
            clearAllStyles: lv,
            getMaxDurationItemIndex: yM,
            getComputedStyle: _M,
            getInstanceOrigin: IM,
            reduceListToGroup: bM,
            shouldNamespaceEventParameter: TM,
            getNamespacedParameterId: wM,
            shouldAllowMediaQuery: qn,
            cleanupHTMLElement: AM,
            clearObjectCache: xM,
            stringifyTarget: SM,
            mediaQueriesEqual: OM,
            shallowEqual: RM
        } = Dn.IX2VanillaUtils, {
            isPluginType: Xn,
            createPluginInstance: ra,
            getPluginDuration: CM
        } = Dn.IX2VanillaPlugins, rv = navigator.userAgent, LM = rv.match(/iPad/i) || rv.match(/iPhone/), PM = 12;
        zM = ["resize", "orientationchange"];
        jM = (e, t) => (0, ov.default)((0, sv.default)(e, t), av.default), YM = (e, t) => {
            (0, Qt.default)(e, (r, n) => {
                r.forEach((i, o) => {
                    let a = n + ea + o;
                    t(i, n, a)
                })
            })
        }, QM = e => {
            let t = {
                target: e.target,
                targets: e.targets
            };
            return Fn({
                config: t,
                elementApi: Re
            })
        }
    });
    var _v = d(aa => {
        "use strict";
        Object.defineProperty(aa, "__esModule", {
            value: !0
        });

        function eF(e, t) {
            for (var r in t) Object.defineProperty(e, r, {
                enumerable: !0,
                get: t[r]
            })
        }
        eF(aa, {
            actions: function() {
                return nF
            },
            destroy: function() {
                return yv
            },
            init: function() {
                return sF
            },
            setEnv: function() {
                return aF
            },
            store: function() {
                return Vn
            }
        });
        var tF = gi(),
            rF = iF((fp(), Ye(lp))),
            oa = (Zo(), Ye(mv)),
            nF = oF((An(), Ye(Ig)));

        function iF(e) {
            return e && e.__esModule ? e : {
                default: e
            }
        }

        function Ev(e) {
            if (typeof WeakMap != "function") return null;
            var t = new WeakMap,
                r = new WeakMap;
            return (Ev = function(n) {
                return n ? r : t
            })(e)
        }

        function oF(e, t) {
            if (!t && e && e.__esModule) return e;
            if (e === null || typeof e != "object" && typeof e != "function") return {
                default: e
            };
            var r = Ev(t);
            if (r && r.has(e)) return r.get(e);
            var n = {
                    __proto__: null
                },
                i = Object.defineProperty && Object.getOwnPropertyDescriptor;
            for (var o in e)
                if (o !== "default" && Object.prototype.hasOwnProperty.call(e, o)) {
                    var a = i ? Object.getOwnPropertyDescriptor(e, o) : null;
                    a && (a.get || a.set) ? Object.defineProperty(n, o, a) : n[o] = e[o]
                }
            return n.default = e, r && r.set(e, n), n
        }
        var Vn = (0, tF.createStore)(rF.default);

        function aF(e) {
            e() && (0, oa.observeRequests)(Vn)
        }

        function sF(e) {
            yv(), (0, oa.startEngine)({
                store: Vn,
                rawData: e,
                allowEvents: !0
            })
        }

        function yv() {
            (0, oa.stopEngine)(Vn)
        }
    });
    var wv = d((dG, Tv) => {
        "use strict";
        var Iv = qe(),
            bv = _v();
        bv.setEnv(Iv.env);
        Iv.define("ix2", Tv.exports = function() {
            return bv
        })
    });
    var xv = d((pG, Av) => {
        "use strict";
        var $t = qe();
        $t.define("links", Av.exports = function(e, t) {
            var r = {},
                n = e(window),
                i, o = $t.env(),
                a = window.location,
                s = document.createElement("a"),
                u = "w--current",
                l = /index\.(html|php)$/,
                m = /\/$/,
                f, g;
            r.ready = r.design = r.preview = p;

            function p() {
                i = o && $t.env("design"), g = $t.env("slug") || a.pathname || "", $t.scroll.off(_), f = [];
                for (var I = document.links, C = 0; C < I.length; ++C) h(I[C]);
                f.length && ($t.scroll.on(_), _())
            }

            function h(I) {
                if (!I.getAttribute("hreflang")) {
                    var C = i && I.getAttribute("href-disabled") || I.getAttribute("href");
                    if (s.href = C, !(C.indexOf(":") >= 0)) {
                        var S = e(I);
                        if (s.hash.length > 1 && s.host + s.pathname === a.host + a.pathname) {
                            if (!/^#[a-zA-Z0-9\-\_]+$/.test(s.hash)) return;
                            var P = e(s.hash);
                            P.length && f.push({
                                link: S,
                                sec: P,
                                active: !1
                            });
                            return
                        }
                        if (!(C === "#" || C === "")) {
                            var N = s.href === a.href || C === g || l.test(C) && m.test(g);
                            T(S, u, N)
                        }
                    }
                }
            }

            function _() {
                var I = n.scrollTop(),
                    C = n.height();
                t.each(f, function(S) {
                    if (!S.link.attr("hreflang")) {
                        var P = S.link,
                            N = S.sec,
                            L = N.offset().top,
                            B = N.outerHeight(),
                            W = C * .5,
                            z = N.is(":visible") && L + B - W >= I && L + W <= I + C;
                        S.active !== z && (S.active = z, T(P, u, z))
                    }
                })
            }

            function T(I, C, S) {
                var P = I.hasClass(C);
                S && P || !S && !P || (S ? I.addClass(C) : I.removeClass(C))
            }
            return r
        })
    });
    var Ov = d((gG, Sv) => {
        "use strict";
        var Un = qe();
        Un.define("scroll", Sv.exports = function(e) {
            var t = {
                    WF_CLICK_EMPTY: "click.wf-empty-link",
                    WF_CLICK_SCROLL: "click.wf-scroll"
                },
                r = window.location,
                n = h() ? null : window.history,
                i = e(window),
                o = e(document),
                a = e(document.body),
                s = window.requestAnimationFrame || window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame || function(F) {
                    window.setTimeout(F, 15)
                },
                u = Un.env("editor") ? ".w-editor-body" : "body",
                l = "header, " + u + " > .header, " + u + " > .w-nav:not([data-no-scroll])",
                m = 'a[href="#"]',
                f = 'a[href*="#"]:not(.w-tab-link):not(' + m + ")",
                g = '.wf-force-outline-none[tabindex="-1"]:focus{outline:none;}',
                p = document.createElement("style");
            p.appendChild(document.createTextNode(g));

            function h() {
                try {
                    return !!window.frameElement
                } catch {
                    return !0
                }
            }
            var _ = /^#[a-zA-Z0-9][\w:.-]*$/;

            function T(F) {
                return _.test(F.hash) && F.host + F.pathname === r.host + r.pathname
            }
            let I = typeof window.matchMedia == "function" && window.matchMedia("(prefers-reduced-motion: reduce)");

            function C() {
                return document.body.getAttribute("data-wf-scroll-motion") === "none" || I.matches
            }

            function S(F, x) {
                var D;
                switch (x) {
                    case "add":
                        D = F.attr("tabindex"), D ? F.attr("data-wf-tabindex-swap", D) : F.attr("tabindex", "-1");
                        break;
                    case "remove":
                        D = F.attr("data-wf-tabindex-swap"), D ? (F.attr("tabindex", D), F.removeAttr("data-wf-tabindex-swap")) : F.removeAttr("tabindex");
                        break
                }
                F.toggleClass("wf-force-outline-none", x === "add")
            }

            function P(F) {
                var x = F.currentTarget;
                if (!(Un.env("design") || window.$.mobile && /(?:^|\s)ui-link(?:$|\s)/.test(x.className))) {
                    var D = T(x) ? x.hash : "";
                    if (D !== "") {
                        var U = e(D);
                        U.length && (F && (F.preventDefault(), F.stopPropagation()), N(D, F), window.setTimeout(function() {
                            L(U, function() {
                                S(U, "add"), U.get(0).focus({
                                    preventScroll: !0
                                }), S(U, "remove")
                            })
                        }, F ? 0 : 300))
                    }
                }
            }

            function N(F) {
                if (r.hash !== F && n && n.pushState && !(Un.env.chrome && r.protocol === "file:")) {
                    var x = n.state && n.state.hash;
                    x !== F && n.pushState({
                        hash: F
                    }, "", F)
                }
            }

            function L(F, x) {
                var D = i.scrollTop(),
                    U = B(F);
                if (D !== U) {
                    var q = W(F, D, U),
                        Z = Date.now(),
                        re = function() {
                            var M = Date.now() - Z;
                            window.scroll(0, z(D, U, M, q)), M <= q ? s(re) : typeof x == "function" && x()
                        };
                    s(re)
                }
            }

            function B(F) {
                var x = e(l),
                    D = x.css("position") === "fixed" ? x.outerHeight() : 0,
                    U = F.offset().top - D;
                if (F.data("scroll") === "mid") {
                    var q = i.height() - D,
                        Z = F.outerHeight();
                    Z < q && (U -= Math.round((q - Z) / 2))
                }
                return U
            }

            function W(F, x, D) {
                if (C()) return 0;
                var U = 1;
                return a.add(F).each(function(q, Z) {
                    var re = parseFloat(Z.getAttribute("data-scroll-time"));
                    !isNaN(re) && re >= 0 && (U = re)
                }), (472.143 * Math.log(Math.abs(x - D) + 125) - 2e3) * U
            }

            function z(F, x, D, U) {
                return D > U ? x : F + (x - F) * $(D / U)
            }

            function $(F) {
                return F < .5 ? 4 * F * F * F : (F - 1) * (2 * F - 2) * (2 * F - 2) + 1
            }

            function ie() {
                var {
                    WF_CLICK_EMPTY: F,
                    WF_CLICK_SCROLL: x
                } = t;
                o.on(x, f, P), o.on(F, m, function(D) {
                    D.preventDefault()
                }), document.head.insertBefore(p, document.head.firstChild)
            }
            return {
                ready: ie
            }
        })
    });
    var Cv = d((hG, Rv) => {
        "use strict";
        var uF = qe();
        uF.define("touch", Rv.exports = function(e) {
            var t = {},
                r = window.getSelection;
            e.event.special.tap = {
                bindType: "click",
                delegateType: "click"
            }, t.init = function(o) {
                return o = typeof o == "string" ? e(o).get(0) : o, o ? new n(o) : null
            };

            function n(o) {
                var a = !1,
                    s = !1,
                    u = Math.min(Math.round(window.innerWidth * .04), 40),
                    l, m;
                o.addEventListener("touchstart", f, !1), o.addEventListener("touchmove", g, !1), o.addEventListener("touchend", p, !1), o.addEventListener("touchcancel", h, !1), o.addEventListener("mousedown", f, !1), o.addEventListener("mousemove", g, !1), o.addEventListener("mouseup", p, !1), o.addEventListener("mouseout", h, !1);

                function f(T) {
                    var I = T.touches;
                    I && I.length > 1 || (a = !0, I ? (s = !0, l = I[0].clientX) : l = T.clientX, m = l)
                }

                function g(T) {
                    if (a) {
                        if (s && T.type === "mousemove") {
                            T.preventDefault(), T.stopPropagation();
                            return
                        }
                        var I = T.touches,
                            C = I ? I[0].clientX : T.clientX,
                            S = C - m;
                        m = C, Math.abs(S) > u && r && String(r()) === "" && (i("swipe", T, {
                            direction: S > 0 ? "right" : "left"
                        }), h())
                    }
                }

                function p(T) {
                    if (a && (a = !1, s && T.type === "mouseup")) {
                        T.preventDefault(), T.stopPropagation(), s = !1;
                        return
                    }
                }

                function h() {
                    a = !1
                }

                function _() {
                    o.removeEventListener("touchstart", f, !1), o.removeEventListener("touchmove", g, !1), o.removeEventListener("touchend", p, !1), o.removeEventListener("touchcancel", h, !1), o.removeEventListener("mousedown", f, !1), o.removeEventListener("mousemove", g, !1), o.removeEventListener("mouseup", p, !1), o.removeEventListener("mouseout", h, !1), o = null
                }
                this.destroy = _
            }

            function i(o, a, s) {
                var u = e.Event(o, {
                    originalEvent: a
                });
                e(a.target).trigger(u, s)
            }
            return t.instance = t.init(document), t
        })
    });
    var Lv = d(sa => {
        "use strict";
        Object.defineProperty(sa, "__esModule", {
            value: !0
        });
        Object.defineProperty(sa, "default", {
            enumerable: !0,
            get: function() {
                return cF
            }
        });

        function cF(e, t, r, n, i, o, a, s, u, l, m, f, g) {
            return function(p) {
                e(p);
                var h = p.form,
                    _ = {
                        name: h.attr("data-name") || h.attr("name") || "Untitled Form",
                        pageId: h.attr("data-wf-page-id") || "",
                        elementId: h.attr("data-wf-element-id") || "",
                        source: t.href,
                        test: r.env(),
                        fields: {},
                        fileUploads: {},
                        dolphin: /pass[\s-_]?(word|code)|secret|login|credentials/i.test(h.html()),
                        trackingCookies: n()
                    };
                let T = h.attr("data-wf-flow");
                T && (_.wfFlow = T), i(p);
                var I = o(h, _.fields);
                if (I) return a(I);
                if (_.fileUploads = s(h), u(p), !l) {
                    m(p);
                    return
                }
                f.ajax({
                    url: g,
                    type: "POST",
                    data: _,
                    dataType: "json",
                    crossDomain: !0
                }).done(function(C) {
                    C && C.code === 200 && (p.success = !0), m(p)
                }).fail(function() {
                    m(p)
                })
            }
        }
    });
    var Nv = d((mG, Pv) => {
        "use strict";
        var Hn = qe();
        Hn.define("forms", Pv.exports = function(e, t) {
            var r = {},
                n = e(document),
                i, o = window.location,
                a = window.XDomainRequest && !window.atob,
                s = ".w-form",
                u, l = /e(-)?mail/i,
                m = /^\S+@\S+$/,
                f = window.alert,
                g = Hn.env(),
                p, h, _, T = /list-manage[1-9]?.com/i,
                I = t.debounce(function() {
                    f("Oops! This page has improperly configured forms. Please contact your website administrator to fix this issue.")
                }, 100);
            r.ready = r.design = r.preview = function() {
                C(), !g && !p && P()
            };

            function C() {
                u = e("html").attr("data-wf-site"), h = "https://webflow.com/api/v1/form/" + u, a && h.indexOf("https://webflow.com") >= 0 && (h = h.replace("https://webflow.com", "https://formdata.webflow.com")), _ = `${h}/signFile`, i = e(s + " form"), i.length && i.each(S)
            }

            function S(M, X) {
                var j = e(X),
                    v = e.data(X, s);
                v || (v = e.data(X, s, {
                    form: j
                })), N(v);
                var b = j.closest("div.w-form");
                v.done = b.find("> .w-form-done"), v.fail = b.find("> .w-form-fail"), v.fileUploads = b.find(".w-file-upload"), v.fileUploads.each(function(ne) {
                    q(ne, v)
                });
                var k = v.form.attr("aria-label") || v.form.attr("data-name") || "Form";
                v.done.attr("aria-label") || v.form.attr("aria-label", k), v.done.attr("tabindex", "-1"), v.done.attr("role", "region"), v.done.attr("aria-label") || v.done.attr("aria-label", k + " success"), v.fail.attr("tabindex", "-1"), v.fail.attr("role", "region"), v.fail.attr("aria-label") || v.fail.attr("aria-label", k + " failure");
                var ee = v.action = j.attr("action");
                if (v.handler = null, v.redirect = j.attr("data-redirect"), T.test(ee)) {
                    v.handler = x;
                    return
                }
                if (!ee) {
                    if (u) {
                        v.handler = (() => {
                            let ne = Lv().default;
                            return ne(N, o, Hn, $, U, B, f, W, L, u, D, e, h)
                        })();
                        return
                    }
                    I()
                }
            }

            function P() {
                p = !0, n.on("submit", s + " form", function(ne) {
                    var Y = e.data(this, s);
                    Y.handler && (Y.evt = ne, Y.handler(Y))
                });
                let M = ".w-checkbox-input",
                    X = ".w-radio-input",
                    j = "w--redirected-checked",
                    v = "w--redirected-focus",
                    b = "w--redirected-focus-visible",
                    k = ":focus-visible, [data-wf-focus-visible]",
                    ee = [
                        ["checkbox", M],
                        ["radio", X]
                    ];
                n.on("change", s + ' form input[type="checkbox"]:not(' + M + ")", ne => {
                    e(ne.target).siblings(M).toggleClass(j)
                }), n.on("change", s + ' form input[type="radio"]', ne => {
                    e(`input[name="${ne.target.name}"]:not(${M})`).map((J, ye) => e(ye).siblings(X).removeClass(j));
                    let Y = e(ne.target);
                    Y.hasClass("w-radio-input") || Y.siblings(X).addClass(j)
                }), ee.forEach(([ne, Y]) => {
                    n.on("focus", s + ` form input[type="${ne}"]:not(` + Y + ")", J => {
                        e(J.target).siblings(Y).addClass(v), e(J.target).filter(k).siblings(Y).addClass(b)
                    }), n.on("blur", s + ` form input[type="${ne}"]:not(` + Y + ")", J => {
                        e(J.target).siblings(Y).removeClass(`${v} ${b}`)
                    })
                })
            }

            function N(M) {
                var X = M.btn = M.form.find(':input[type="submit"]');
                M.wait = M.btn.attr("data-wait") || null, M.success = !1, X.prop("disabled", !1), M.label && X.val(M.label)
            }

            function L(M) {
                var X = M.btn,
                    j = M.wait;
                X.prop("disabled", !0), j && (M.label = X.val(), X.val(j))
            }

            function B(M, X) {
                var j = null;
                return X = X || {}, M.find(':input:not([type="submit"]):not([type="file"])').each(function(v, b) {
                    var k = e(b),
                        ee = k.attr("type"),
                        ne = k.attr("data-name") || k.attr("name") || "Field " + (v + 1);
                    ne = encodeURIComponent(ne);
                    var Y = k.val();
                    if (ee === "checkbox") Y = k.is(":checked");
                    else if (ee === "radio") {
                        if (X[ne] === null || typeof X[ne] == "string") return;
                        Y = M.find('input[name="' + k.attr("name") + '"]:checked').val() || null
                    }
                    typeof Y == "string" && (Y = e.trim(Y)), X[ne] = Y, j = j || ie(k, ee, ne, Y)
                }), j
            }

            function W(M) {
                var X = {};
                return M.find(':input[type="file"]').each(function(j, v) {
                    var b = e(v),
                        k = b.attr("data-name") || b.attr("name") || "File " + (j + 1),
                        ee = b.attr("data-value");
                    typeof ee == "string" && (ee = e.trim(ee)), X[k] = ee
                }), X
            }
            let z = {
                _mkto_trk: "marketo"
            };

            function $() {
                return document.cookie.split("; ").reduce(function(X, j) {
                    let v = j.split("="),
                        b = v[0];
                    if (b in z) {
                        let k = z[b],
                            ee = v.slice(1).join("=");
                        X[k] = ee
                    }
                    return X
                }, {})
            }

            function ie(M, X, j, v) {
                var b = null;
                return X === "password" ? b = "Passwords cannot be submitted." : M.attr("required") ? v ? l.test(M.attr("type")) && (m.test(v) || (b = "Please enter a valid email address for: " + j)) : b = "Please fill out the required field: " + j : j === "g-recaptcha-response" && !v && (b = "Please confirm you\u2019re not a robot."), b
            }

            function F(M) {
                U(M), D(M)
            }

            function x(M) {
                N(M);
                var X = M.form,
                    j = {};
                if (/^https/.test(o.href) && !/^https/.test(M.action)) {
                    X.attr("method", "post");
                    return
                }
                U(M);
                var v = B(X, j);
                if (v) return f(v);
                L(M);
                var b;
                t.each(j, function(Y, J) {
                    l.test(J) && (j.EMAIL = Y), /^((full[ _-]?)?name)$/i.test(J) && (b = Y), /^(first[ _-]?name)$/i.test(J) && (j.FNAME = Y), /^(last[ _-]?name)$/i.test(J) && (j.LNAME = Y)
                }), b && !j.FNAME && (b = b.split(" "), j.FNAME = b[0], j.LNAME = j.LNAME || b[1]);
                var k = M.action.replace("/post?", "/post-json?") + "&c=?",
                    ee = k.indexOf("u=") + 2;
                ee = k.substring(ee, k.indexOf("&", ee));
                var ne = k.indexOf("id=") + 3;
                ne = k.substring(ne, k.indexOf("&", ne)), j["b_" + ee + "_" + ne] = "", e.ajax({
                    url: k,
                    data: j,
                    dataType: "jsonp"
                }).done(function(Y) {
                    M.success = Y.result === "success" || /already/.test(Y.msg), M.success || console.info("MailChimp error: " + Y.msg), D(M)
                }).fail(function() {
                    D(M)
                })
            }

            function D(M) {
                var X = M.form,
                    j = M.redirect,
                    v = M.success;
                if (v && j) {
                    Hn.location(j);
                    return
                }
                M.done.toggle(v), M.fail.toggle(!v), v ? M.done.focus() : M.fail.focus(), X.toggle(!v), N(M)
            }

            function U(M) {
                M.evt && M.evt.preventDefault(), M.evt = null
            }

            function q(M, X) {
                if (!X.fileUploads || !X.fileUploads[M]) return;
                var j, v = e(X.fileUploads[M]),
                    b = v.find("> .w-file-upload-default"),
                    k = v.find("> .w-file-upload-uploading"),
                    ee = v.find("> .w-file-upload-success"),
                    ne = v.find("> .w-file-upload-error"),
                    Y = b.find(".w-file-upload-input"),
                    J = b.find(".w-file-upload-label"),
                    ye = J.children(),
                    se = ne.find(".w-file-upload-error-msg"),
                    E = ee.find(".w-file-upload-file"),
                    G = ee.find(".w-file-remove-link"),
                    K = E.find(".w-file-upload-file-name"),
                    H = se.attr("data-w-size-error"),
                    fe = se.attr("data-w-type-error"),
                    Ge = se.attr("data-w-generic-error");
                if (g || J.on("click keydown", function(w) {
                        w.type === "keydown" && w.which !== 13 && w.which !== 32 || (w.preventDefault(), Y.click())
                    }), J.find(".w-icon-file-upload-icon").attr("aria-hidden", "true"), G.find(".w-icon-file-upload-remove").attr("aria-hidden", "true"), g) Y.on("click", function(w) {
                    w.preventDefault()
                }), J.on("click", function(w) {
                    w.preventDefault()
                }), ye.on("click", function(w) {
                    w.preventDefault()
                });
                else {
                    G.on("click keydown", function(w) {
                        if (w.type === "keydown") {
                            if (w.which !== 13 && w.which !== 32) return;
                            w.preventDefault()
                        }
                        Y.removeAttr("data-value"), Y.val(""), K.html(""), b.toggle(!0), ee.toggle(!1), J.focus()
                    }), Y.on("change", function(w) {
                        j = w.target && w.target.files && w.target.files[0], j && (b.toggle(!1), ne.toggle(!1), k.toggle(!0), k.focus(), K.text(j.name), O() || L(X), X.fileUploads[M].uploading = !0, Z(j, y))
                    });
                    var Ce = J.outerHeight();
                    Y.height(Ce), Y.width(1)
                }

                function c(w) {
                    var R = w.responseJSON && w.responseJSON.msg,
                        Q = Ge;
                    typeof R == "string" && R.indexOf("InvalidFileTypeError") === 0 ? Q = fe : typeof R == "string" && R.indexOf("MaxFileSizeError") === 0 && (Q = H), se.text(Q), Y.removeAttr("data-value"), Y.val(""), k.toggle(!1), b.toggle(!0), ne.toggle(!0), ne.focus(), X.fileUploads[M].uploading = !1, O() || N(X)
                }

                function y(w, R) {
                    if (w) return c(w);
                    var Q = R.fileName,
                        oe = R.postData,
                        ge = R.fileId,
                        V = R.s3Url;
                    Y.attr("data-value", ge), re(V, oe, j, Q, A)
                }

                function A(w) {
                    if (w) return c(w);
                    k.toggle(!1), ee.css("display", "inline-block"), ee.focus(), X.fileUploads[M].uploading = !1, O() || N(X)
                }

                function O() {
                    var w = X.fileUploads && X.fileUploads.toArray() || [];
                    return w.some(function(R) {
                        return R.uploading
                    })
                }
            }

            function Z(M, X) {
                var j = new URLSearchParams({
                    name: M.name,
                    size: M.size
                });
                e.ajax({
                    type: "GET",
                    url: `${_}?${j}`,
                    crossDomain: !0
                }).done(function(v) {
                    X(null, v)
                }).fail(function(v) {
                    X(v)
                })
            }

            function re(M, X, j, v, b) {
                var k = new FormData;
                for (var ee in X) k.append(ee, X[ee]);
                k.append("file", j, v), e.ajax({
                    type: "POST",
                    url: M,
                    data: k,
                    processData: !1,
                    contentType: !1
                }).done(function() {
                    b(null)
                }).fail(function(ne) {
                    b(ne)
                })
            }
            return r
        })
    });
    var Fv = d((EG, Mv) => {
        "use strict";
        var ua = qe(),
            Dv = "w-condition-invisible",
            lF = "." + Dv;

        function fF(e) {
            return e.filter(function(t) {
                return !Or(t)
            })
        }

        function Or(e) {
            return !!(e.$el && e.$el.closest(lF).length)
        }

        function ca(e, t) {
            for (var r = e; r >= 0; r--)
                if (!Or(t[r])) return r;
            return -1
        }

        function la(e, t) {
            for (var r = e; r <= t.length - 1; r++)
                if (!Or(t[r])) return r;
            return -1
        }

        function dF(e, t) {
            return ca(e - 1, t) === -1
        }

        function pF(e, t) {
            return la(e + 1, t) === -1
        }

        function Sr(e, t) {
            e.attr("aria-label") || e.attr("aria-label", t)
        }

        function gF(e, t, r, n) {
            var i = r.tram,
                o = Array.isArray,
                a = "w-lightbox",
                s = a + "-",
                u = /(^|\s+)/g,
                l = [],
                m, f, g, p = [];

            function h(v, b) {
                return l = o(v) ? v : [v], f || h.build(), fF(l).length > 1 && (f.items = f.empty, l.forEach(function(k, ee) {
                    var ne = X("thumbnail"),
                        Y = X("item").prop("tabIndex", 0).attr("aria-controls", "w-lightbox-view").attr("role", "tab").append(ne);
                    Sr(Y, `show item ${ee+1} of ${l.length}`), Or(k) && Y.addClass(Dv), f.items = f.items.add(Y), $(k.thumbnailUrl || k.url, function(J) {
                        J.prop("width") > J.prop("height") ? q(J, "wide") : q(J, "tall"), ne.append(q(J, "thumbnail-image"))
                    })
                }), f.strip.empty().append(f.items), q(f.content, "group")), i(Z(f.lightbox, "hide").trigger("focus")).add("opacity .3s").start({
                    opacity: 1
                }), q(f.html, "noscroll"), h.show(b || 0)
            }
            h.build = function() {
                return h.destroy(), f = {
                    html: r(t.documentElement),
                    empty: r()
                }, f.arrowLeft = X("control left inactive").attr("role", "button").attr("aria-hidden", !0).attr("aria-controls", "w-lightbox-view"), f.arrowRight = X("control right inactive").attr("role", "button").attr("aria-hidden", !0).attr("aria-controls", "w-lightbox-view"), f.close = X("control close").attr("role", "button"), Sr(f.arrowLeft, "previous image"), Sr(f.arrowRight, "next image"), Sr(f.close, "close lightbox"), f.spinner = X("spinner").attr("role", "progressbar").attr("aria-live", "polite").attr("aria-hidden", !1).attr("aria-busy", !0).attr("aria-valuemin", 0).attr("aria-valuemax", 100).attr("aria-valuenow", 0).attr("aria-valuetext", "Loading image"), f.strip = X("strip").attr("role", "tablist"), g = new x(f.spinner, D("hide")), f.content = X("content").append(f.spinner, f.arrowLeft, f.arrowRight, f.close), f.container = X("container").append(f.content, f.strip), f.lightbox = X("backdrop hide").append(f.container), f.strip.on("click", U("item"), S), f.content.on("swipe", P).on("click", U("left"), T).on("click", U("right"), I).on("click", U("close"), C).on("click", U("image, caption"), I), f.container.on("click", U("view"), C).on("dragstart", U("img"), L), f.lightbox.on("keydown", B).on("focusin", N), r(n).append(f.lightbox), h
            }, h.destroy = function() {
                f && (Z(f.html, "noscroll"), f.lightbox.remove(), f = void 0)
            }, h.show = function(v) {
                if (v !== m) {
                    var b = l[v];
                    if (!b) return h.hide();
                    if (Or(b)) {
                        if (v < m) {
                            var k = ca(v - 1, l);
                            v = k > -1 ? k : v
                        } else {
                            var ee = la(v + 1, l);
                            v = ee > -1 ? ee : v
                        }
                        b = l[v]
                    }
                    var ne = m;
                    m = v, f.spinner.attr("aria-hidden", !1).attr("aria-busy", !0).attr("aria-valuenow", 0).attr("aria-valuetext", "Loading image"), g.show();
                    var Y = b.html && j(b.width, b.height) || b.url;
                    return $(Y, function(J) {
                        if (v !== m) return;
                        var ye = X("figure", "figure").append(q(J, "image")),
                            se = X("frame").append(ye),
                            E = X("view").prop("tabIndex", 0).attr("id", "w-lightbox-view").append(se),
                            G, K;
                        b.html && (G = r(b.html), K = G.is("iframe"), K && G.on("load", H), ye.append(q(G, "embed"))), b.caption && ye.append(X("caption", "figcaption").text(b.caption)), f.spinner.before(E), K || H();

                        function H() {
                            if (f.spinner.attr("aria-hidden", !0).attr("aria-busy", !1).attr("aria-valuenow", 100).attr("aria-valuetext", "Loaded image"), g.hide(), v !== m) {
                                E.remove();
                                return
                            }
                            let fe = dF(v, l);
                            re(f.arrowLeft, "inactive", fe), M(f.arrowLeft, fe), fe && f.arrowLeft.is(":focus") && f.arrowRight.focus();
                            let Ge = pF(v, l);
                            if (re(f.arrowRight, "inactive", Ge), M(f.arrowRight, Ge), Ge && f.arrowRight.is(":focus") && f.arrowLeft.focus(), f.view ? (i(f.view).add("opacity .3s").start({
                                    opacity: 0
                                }).then(ie(f.view)), i(E).add("opacity .3s").add("transform .3s").set({
                                    x: v > ne ? "80px" : "-80px"
                                }).start({
                                    opacity: 1,
                                    x: 0
                                })) : E.css("opacity", 1), f.view = E, f.view.prop("tabIndex", 0), f.items) {
                                Z(f.items, "active"), f.items.removeAttr("aria-selected");
                                var Ce = f.items.eq(v);
                                q(Ce, "active"), Ce.attr("aria-selected", !0), F(Ce)
                            }
                        }
                    }), f.close.prop("tabIndex", 0), r(":focus").addClass("active-lightbox"), p.length === 0 && (r("body").children().each(function() {
                        r(this).hasClass("w-lightbox-backdrop") || r(this).is("script") || (p.push({
                            node: r(this),
                            hidden: r(this).attr("aria-hidden"),
                            tabIndex: r(this).attr("tabIndex")
                        }), r(this).attr("aria-hidden", !0).attr("tabIndex", -1))
                    }), f.close.focus()), h
                }
            }, h.hide = function() {
                return i(f.lightbox).add("opacity .3s").start({
                    opacity: 0
                }).then(z), h
            }, h.prev = function() {
                var v = ca(m - 1, l);
                v > -1 && h.show(v)
            }, h.next = function() {
                var v = la(m + 1, l);
                v > -1 && h.show(v)
            };

            function _(v) {
                return function(b) {
                    this === b.target && (b.stopPropagation(), b.preventDefault(), v())
                }
            }
            var T = _(h.prev),
                I = _(h.next),
                C = _(h.hide),
                S = function(v) {
                    var b = r(this).index();
                    v.preventDefault(), h.show(b)
                },
                P = function(v, b) {
                    v.preventDefault(), b.direction === "left" ? h.next() : b.direction === "right" && h.prev()
                },
                N = function() {
                    this.focus()
                };

            function L(v) {
                v.preventDefault()
            }

            function B(v) {
                var b = v.keyCode;
                b === 27 || W(b, "close") ? h.hide() : b === 37 || W(b, "left") ? h.prev() : b === 39 || W(b, "right") ? h.next() : W(b, "item") && r(":focus").click()
            }

            function W(v, b) {
                if (v !== 13 && v !== 32) return !1;
                var k = r(":focus").attr("class"),
                    ee = D(b).trim();
                return k.includes(ee)
            }

            function z() {
                f && (f.strip.scrollLeft(0).empty(), Z(f.html, "noscroll"), q(f.lightbox, "hide"), f.view && f.view.remove(), Z(f.content, "group"), q(f.arrowLeft, "inactive"), q(f.arrowRight, "inactive"), m = f.view = void 0, p.forEach(function(v) {
                    var b = v.node;
                    b && (v.hidden ? b.attr("aria-hidden", v.hidden) : b.removeAttr("aria-hidden"), v.tabIndex ? b.attr("tabIndex", v.tabIndex) : b.removeAttr("tabIndex"))
                }), p = [], r(".active-lightbox").removeClass("active-lightbox").focus())
            }

            function $(v, b) {
                var k = X("img", "img");
                return k.one("load", function() {
                    b(k)
                }), k.attr("src", v), k
            }

            function ie(v) {
                return function() {
                    v.remove()
                }
            }

            function F(v) {
                var b = v.get(0),
                    k = f.strip.get(0),
                    ee = b.offsetLeft,
                    ne = b.clientWidth,
                    Y = k.scrollLeft,
                    J = k.clientWidth,
                    ye = k.scrollWidth - J,
                    se;
                ee < Y ? se = Math.max(0, ee + ne - J) : ee + ne > J + Y && (se = Math.min(ee, ye)), se != null && i(f.strip).add("scroll-left 500ms").start({
                    "scroll-left": se
                })
            }

            function x(v, b, k) {
                this.$element = v, this.className = b, this.delay = k || 200, this.hide()
            }
            x.prototype.show = function() {
                var v = this;
                v.timeoutId || (v.timeoutId = setTimeout(function() {
                    v.$element.removeClass(v.className), delete v.timeoutId
                }, v.delay))
            }, x.prototype.hide = function() {
                var v = this;
                if (v.timeoutId) {
                    clearTimeout(v.timeoutId), delete v.timeoutId;
                    return
                }
                v.$element.addClass(v.className)
            };

            function D(v, b) {
                return v.replace(u, (b ? " ." : " ") + s)
            }

            function U(v) {
                return D(v, !0)
            }

            function q(v, b) {
                return v.addClass(D(b))
            }

            function Z(v, b) {
                return v.removeClass(D(b))
            }

            function re(v, b, k) {
                return v.toggleClass(D(b), k)
            }

            function M(v, b) {
                return v.attr("aria-hidden", b).attr("tabIndex", b ? -1 : 0)
            }

            function X(v, b) {
                return q(r(t.createElement(b || "div")), v)
            }

            function j(v, b) {
                var k = '<svg xmlns="http://www.w3.org/2000/svg" width="' + v + '" height="' + b + '"/>';
                return "data:image/svg+xml;charset=utf-8," + encodeURI(k)
            }
            return function() {
                var v = e.navigator.userAgent,
                    b = /(iPhone|iPad|iPod);[^OS]*OS (\d)/,
                    k = v.match(b),
                    ee = v.indexOf("Android ") > -1 && v.indexOf("Chrome") === -1;
                if (!ee && (!k || k[2] > 7)) return;
                var ne = t.createElement("style");
                t.head.appendChild(ne), e.addEventListener("resize", Y, !0);

                function Y() {
                    var J = e.innerHeight,
                        ye = e.innerWidth,
                        se = ".w-lightbox-content, .w-lightbox-view, .w-lightbox-view:before {height:" + J + "px}.w-lightbox-view {width:" + ye + "px}.w-lightbox-group, .w-lightbox-group .w-lightbox-view, .w-lightbox-group .w-lightbox-view:before {height:" + .86 * J + "px}.w-lightbox-image {max-width:" + ye + "px;max-height:" + J + "px}.w-lightbox-group .w-lightbox-image {max-height:" + .86 * J + "px}.w-lightbox-strip {padding: 0 " + .01 * J + "px}.w-lightbox-item {width:" + .1 * J + "px;padding:" + .02 * J + "px " + .01 * J + "px}.w-lightbox-thumbnail {height:" + .1 * J + "px}@media (min-width: 768px) {.w-lightbox-content, .w-lightbox-view, .w-lightbox-view:before {height:" + .96 * J + "px}.w-lightbox-content {margin-top:" + .02 * J + "px}.w-lightbox-group, .w-lightbox-group .w-lightbox-view, .w-lightbox-group .w-lightbox-view:before {height:" + .84 * J + "px}.w-lightbox-image {max-width:" + .96 * ye + "px;max-height:" + .96 * J + "px}.w-lightbox-group .w-lightbox-image {max-width:" + .823 * ye + "px;max-height:" + .84 * J + "px}}";
                    ne.textContent = se
                }
                Y()
            }(), h
        }
        ua.define("lightbox", Mv.exports = function(e) {
            var t = {},
                r = ua.env(),
                n = gF(window, document, e, r ? "#lightbox-mountpoint" : "body"),
                i = e(document),
                o, a, s = ".w-lightbox",
                u;
            t.ready = t.design = t.preview = l;

            function l() {
                a = r && ua.env("design"), n.destroy(), u = {}, o = i.find(s), o.webflowLightBox(), o.each(function() {
                    Sr(e(this), "open lightbox"), e(this).attr("aria-haspopup", "dialog")
                })
            }
            jQuery.fn.extend({
                webflowLightBox: function() {
                    var p = this;
                    e.each(p, function(h, _) {
                        var T = e.data(_, s);
                        T || (T = e.data(_, s, {
                            el: e(_),
                            mode: "images",
                            images: [],
                            embed: ""
                        })), T.el.off(s), m(T), a ? T.el.on("setting" + s, m.bind(null, T)) : T.el.on("click" + s, f(T)).on("click" + s, function(I) {
                            I.preventDefault()
                        })
                    })
                }
            });

            function m(p) {
                var h = p.el.children(".w-json").html(),
                    _, T;
                if (!h) {
                    p.items = [];
                    return
                }
                try {
                    h = JSON.parse(h)
                } catch (I) {
                    console.error("Malformed lightbox JSON configuration.", I)
                }
                g(h), h.items.forEach(function(I) {
                    I.$el = p.el
                }), _ = h.group, _ ? (T = u[_], T || (T = u[_] = []), p.items = T, h.items.length && (p.index = T.length, T.push.apply(T, h.items))) : (p.items = h.items, p.index = 0)
            }

            function f(p) {
                return function() {
                    p.items.length && n(p.items, p.index || 0)
                }
            }

            function g(p) {
                p.images && (p.images.forEach(function(h) {
                    h.type = "image"
                }), p.items = p.images), p.embed && (p.embed.type = "video", p.items = [p.embed]), p.groupId && (p.group = p.groupId)
            }
            return t
        })
    });
    var Xv = d((yG, qv) => {
        "use strict";
        var gt = qe(),
            hF = Zn(),
            we = {
                ARROW_LEFT: 37,
                ARROW_UP: 38,
                ARROW_RIGHT: 39,
                ARROW_DOWN: 40,
                ESCAPE: 27,
                SPACE: 32,
                ENTER: 13,
                HOME: 36,
                END: 35
            };
        gt.define("navbar", qv.exports = function(e, t) {
            var r = {},
                n = e.tram,
                i = e(window),
                o = e(document),
                a = t.debounce,
                s, u, l, m, f = gt.env(),
                g = '<div class="w-nav-overlay" data-wf-ignore />',
                p = ".w-nav",
                h = "w--open",
                _ = "w--nav-dropdown-open",
                T = "w--nav-dropdown-toggle-open",
                I = "w--nav-dropdown-list-open",
                C = "w--nav-link-open",
                S = hF.triggers,
                P = e();
            r.ready = r.design = r.preview = N, r.destroy = function() {
                P = e(), L(), u && u.length && u.each($)
            };

            function N() {
                l = f && gt.env("design"), m = gt.env("editor"), s = e(document.body), u = o.find(p), u.length && (u.each(z), L(), B())
            }

            function L() {
                gt.resize.off(W)
            }

            function B() {
                gt.resize.on(W)
            }

            function W() {
                u.each(b)
            }

            function z(E, G) {
                var K = e(G),
                    H = e.data(G, p);
                H || (H = e.data(G, p, {
                    open: !1,
                    el: K,
                    config: {},
                    selectedIdx: -1
                })), H.menu = K.find(".w-nav-menu"), H.links = H.menu.find(".w-nav-link"), H.dropdowns = H.menu.find(".w-dropdown"), H.dropdownToggle = H.menu.find(".w-dropdown-toggle"), H.dropdownList = H.menu.find(".w-dropdown-list"), H.button = K.find(".w-nav-button"), H.container = K.find(".w-container"), H.overlayContainerId = "w-nav-overlay-" + E, H.outside = j(H);
                var fe = K.find(".w-nav-brand");
                fe && fe.attr("href") === "/" && fe.attr("aria-label") == null && fe.attr("aria-label", "home"), H.button.attr("style", "-webkit-user-select: text;"), H.button.attr("aria-label") == null && H.button.attr("aria-label", "menu"), H.button.attr("role", "button"), H.button.attr("tabindex", "0"), H.button.attr("aria-controls", H.overlayContainerId), H.button.attr("aria-haspopup", "menu"), H.button.attr("aria-expanded", "false"), H.el.off(p), H.button.off(p), H.menu.off(p), x(H), l ? (ie(H), H.el.on("setting" + p, D(H))) : (F(H), H.button.on("click" + p, M(H)), H.menu.on("click" + p, "a", X(H)), H.button.on("keydown" + p, U(H)), H.el.on("keydown" + p, q(H))), b(E, G)
            }

            function $(E, G) {
                var K = e.data(G, p);
                K && (ie(K), e.removeData(G, p))
            }

            function ie(E) {
                E.overlay && (se(E, !0), E.overlay.remove(), E.overlay = null)
            }

            function F(E) {
                E.overlay || (E.overlay = e(g).appendTo(E.el), E.overlay.attr("id", E.overlayContainerId), E.parent = E.menu.parent(), se(E, !0))
            }

            function x(E) {
                var G = {},
                    K = E.config || {},
                    H = G.animation = E.el.attr("data-animation") || "default";
                G.animOver = /^over/.test(H), G.animDirect = /left$/.test(H) ? -1 : 1, K.animation !== H && E.open && t.defer(re, E), G.easing = E.el.attr("data-easing") || "ease", G.easing2 = E.el.attr("data-easing2") || "ease";
                var fe = E.el.attr("data-duration");
                G.duration = fe != null ? Number(fe) : 400, G.docHeight = E.el.attr("data-doc-height"), E.config = G
            }

            function D(E) {
                return function(G, K) {
                    K = K || {};
                    var H = i.width();
                    x(E), K.open === !0 && J(E, !0), K.open === !1 && se(E, !0), E.open && t.defer(function() {
                        H !== i.width() && re(E)
                    })
                }
            }

            function U(E) {
                return function(G) {
                    switch (G.keyCode) {
                        case we.SPACE:
                        case we.ENTER:
                            return M(E)(), G.preventDefault(), G.stopPropagation();
                        case we.ESCAPE:
                            return se(E), G.preventDefault(), G.stopPropagation();
                        case we.ARROW_RIGHT:
                        case we.ARROW_DOWN:
                        case we.HOME:
                        case we.END:
                            return E.open ? (G.keyCode === we.END ? E.selectedIdx = E.links.length - 1 : E.selectedIdx = 0, Z(E), G.preventDefault(), G.stopPropagation()) : (G.preventDefault(), G.stopPropagation())
                    }
                }
            }

            function q(E) {
                return function(G) {
                    if (E.open) switch (E.selectedIdx = E.links.index(document.activeElement), G.keyCode) {
                        case we.HOME:
                        case we.END:
                            return G.keyCode === we.END ? E.selectedIdx = E.links.length - 1 : E.selectedIdx = 0, Z(E), G.preventDefault(), G.stopPropagation();
                        case we.ESCAPE:
                            return se(E), E.button.focus(), G.preventDefault(), G.stopPropagation();
                        case we.ARROW_LEFT:
                        case we.ARROW_UP:
                            return E.selectedIdx = Math.max(-1, E.selectedIdx - 1), Z(E), G.preventDefault(), G.stopPropagation();
                        case we.ARROW_RIGHT:
                        case we.ARROW_DOWN:
                            return E.selectedIdx = Math.min(E.links.length - 1, E.selectedIdx + 1), Z(E), G.preventDefault(), G.stopPropagation()
                    }
                }
            }

            function Z(E) {
                if (E.links[E.selectedIdx]) {
                    var G = E.links[E.selectedIdx];
                    G.focus(), X(G)
                }
            }

            function re(E) {
                E.open && (se(E, !0), J(E, !0))
            }

            function M(E) {
                return a(function() {
                    E.open ? se(E) : J(E)
                })
            }

            function X(E) {
                return function(G) {
                    var K = e(this),
                        H = K.attr("href");
                    if (!gt.validClick(G.currentTarget)) {
                        G.preventDefault();
                        return
                    }
                    H && H.indexOf("#") === 0 && E.open && se(E)
                }
            }

            function j(E) {
                return E.outside && o.off("click" + p, E.outside),
                    function(G) {
                        var K = e(G.target);
                        m && K.closest(".w-editor-bem-EditorOverlay").length || v(E, K)
                    }
            }
            var v = a(function(E, G) {
                if (E.open) {
                    var K = G.closest(".w-nav-menu");
                    E.menu.is(K) || se(E)
                }
            });

            function b(E, G) {
                var K = e.data(G, p),
                    H = K.collapsed = K.button.css("display") !== "none";
                if (K.open && !H && !l && se(K, !0), K.container.length) {
                    var fe = ee(K);
                    K.links.each(fe), K.dropdowns.each(fe)
                }
                K.open && ye(K)
            }
            var k = "max-width";

            function ee(E) {
                var G = E.container.css(k);
                return G === "none" && (G = ""),
                    function(K, H) {
                        H = e(H), H.css(k, ""), H.css(k) === "none" && H.css(k, G)
                    }
            }

            function ne(E, G) {
                G.setAttribute("data-nav-menu-open", "")
            }

            function Y(E, G) {
                G.removeAttribute("data-nav-menu-open")
            }

            function J(E, G) {
                if (E.open) return;
                E.open = !0, E.menu.each(ne), E.links.addClass(C), E.dropdowns.addClass(_), E.dropdownToggle.addClass(T), E.dropdownList.addClass(I), E.button.addClass(h);
                var K = E.config,
                    H = K.animation;
                (H === "none" || !n.support.transform || K.duration <= 0) && (G = !0);
                var fe = ye(E),
                    Ge = E.menu.outerHeight(!0),
                    Ce = E.menu.outerWidth(!0),
                    c = E.el.height(),
                    y = E.el[0];
                if (b(0, y), S.intro(0, y), gt.redraw.up(), l || o.on("click" + p, E.outside), G) {
                    w();
                    return
                }
                var A = "transform " + K.duration + "ms " + K.easing;
                if (E.overlay && (P = E.menu.prev(), E.overlay.show().append(E.menu)), K.animOver) {
                    n(E.menu).add(A).set({
                        x: K.animDirect * Ce,
                        height: fe
                    }).start({
                        x: 0
                    }).then(w), E.overlay && E.overlay.width(Ce);
                    return
                }
                var O = c + Ge;
                n(E.menu).add(A).set({
                    y: -O
                }).start({
                    y: 0
                }).then(w);

                function w() {
                    E.button.attr("aria-expanded", "true")
                }
            }

            function ye(E) {
                var G = E.config,
                    K = G.docHeight ? o.height() : s.height();
                return G.animOver ? E.menu.height(K) : E.el.css("position") !== "fixed" && (K -= E.el.outerHeight(!0)), E.overlay && E.overlay.height(K), K
            }

            function se(E, G) {
                if (!E.open) return;
                E.open = !1, E.button.removeClass(h);
                var K = E.config;
                if ((K.animation === "none" || !n.support.transform || K.duration <= 0) && (G = !0), S.outro(0, E.el[0]), o.off("click" + p, E.outside), G) {
                    n(E.menu).stop(), y();
                    return
                }
                var H = "transform " + K.duration + "ms " + K.easing2,
                    fe = E.menu.outerHeight(!0),
                    Ge = E.menu.outerWidth(!0),
                    Ce = E.el.height();
                if (K.animOver) {
                    n(E.menu).add(H).start({
                        x: Ge * K.animDirect
                    }).then(y);
                    return
                }
                var c = Ce + fe;
                n(E.menu).add(H).start({
                    y: -c
                }).then(y);

                function y() {
                    E.menu.height(""), n(E.menu).set({
                        x: 0,
                        y: 0
                    }), E.menu.each(Y), E.links.removeClass(C), E.dropdowns.removeClass(_), E.dropdownToggle.removeClass(T), E.dropdownList.removeClass(I), E.overlay && E.overlay.children().length && (P.length ? E.menu.insertAfter(P) : E.menu.prependTo(E.parent), E.overlay.attr("style", "").hide()), E.el.triggerHandler("w-close"), E.button.attr("aria-expanded", "false")
                }
            }
            return r
        })
    });
    wa();
    xa();
    Oa();
    La();
    Zn();
    wv();
    xv();
    Ov();
    Cv();
    Nv();
    Fv();
    Xv();
})();
/*!
 * tram.js v0.8.2-global
 * Cross-browser CSS3 transitions in JavaScript
 * https://github.com/bkwld/tram
 * MIT License
 */
/*!
 * Webflow._ (aka) Underscore.js 1.6.0 (custom build)
 *
 * http://underscorejs.org
 * (c) 2009-2013 Jeremy Ashkenas, DocumentCloud and Investigative Reporters & Editors
 * Underscore may be freely distributed under the MIT license.
 * @license MIT
 */
/*! Bundled license information:

timm/lib/timm.js:
  (*!
   * Timm
   *
   * Immutability helpers with fast reads and acceptable writes.
   *
   * @copyright Guillermo Grau Panea 2016
   * @license MIT
   *)
*/
/**
 * ----------------------------------------------------------------------
 * Webflow: Interactions 2.0: Init
 */
Webflow.require('ix2').init({
    "events": {
        "e": {
            "id": "e",
            "name": "",
            "animationType": "preset",
            "eventTypeId": "NAVBAR_OPEN",
            "action": {
                "id": "",
                "actionTypeId": "GENERAL_START_ACTION",
                "config": {
                    "delay": 0,
                    "easing": "",
                    "duration": 0,
                    "actionListId": "a",
                    "affectedElements": {},
                    "playInReverse": false,
                    "autoStopEventId": "e-591"
                }
            },
            "mediaQueries": ["main", "medium", "small", "tiny"],
            "target": {
                "id": "65f05b3ab3ea937565a752e0|bc8ac64c-e5a3-9bca-2793-85e40bc9be5a",
                "appliesTo": "ELEMENT",
                "styleBlockIds": []
            },
            "targets": [{
                "id": "65f05b3ab3ea937565a752e0|bc8ac64c-e5a3-9bca-2793-85e40bc9be5a",
                "appliesTo": "ELEMENT",
                "styleBlockIds": []
            }],
            "config": {
                "loop": false,
                "playInReverse": false,
                "scrollOffsetValue": null,
                "scrollOffsetUnit": null,
                "delay": null,
                "direction": null,
                "effectIn": null
            },
            "createdOn": 1626169409644
        },
        "e-2": {
            "id": "e-2",
            "name": "",
            "animationType": "preset",
            "eventTypeId": "NAVBAR_CLOSE",
            "action": {
                "id": "",
                "actionTypeId": "GENERAL_START_ACTION",
                "config": {
                    "delay": 0,
                    "easing": "",
                    "duration": 0,
                    "actionListId": "a-2",
                    "affectedElements": {},
                    "playInReverse": false,
                    "autoStopEventId": "e-394"
                }
            },
            "mediaQueries": ["main", "medium", "small", "tiny"],
            "target": {
                "id": "65f05b3ab3ea937565a752e0|bc8ac64c-e5a3-9bca-2793-85e40bc9be5a",
                "appliesTo": "ELEMENT",
                "styleBlockIds": []
            },
            "targets": [{
                "id": "65f05b3ab3ea937565a752e0|bc8ac64c-e5a3-9bca-2793-85e40bc9be5a",
                "appliesTo": "ELEMENT",
                "styleBlockIds": []
            }],
            "config": {
                "loop": false,
                "playInReverse": false,
                "scrollOffsetValue": null,
                "scrollOffsetUnit": null,
                "delay": null,
                "direction": null,
                "effectIn": null
            },
            "createdOn": 1626169409644
        },
        "e-7": {
            "id": "e-7",
            "name": "",
            "animationType": "custom",
            "eventTypeId": "MOUSE_CLICK",
            "action": {
                "id": "",
                "actionTypeId": "GENERAL_START_ACTION",
                "config": {
                    "delay": 0,
                    "easing": "",
                    "duration": 0,
                    "actionListId": "a-7",
                    "affectedElements": {},
                    "playInReverse": false,
                    "autoStopEventId": "e-16"
                }
            },
            "mediaQueries": ["main", "medium", "small", "tiny"],
            "target": {
                "id": "65f05b3ab3ea937565a752e0|cb8f00df-8907-4d0c-bdd5-2aa093cca3e3",
                "appliesTo": "ELEMENT",
                "styleBlockIds": []
            },
            "targets": [{
                "id": "65f05b3ab3ea937565a752e0|cb8f00df-8907-4d0c-bdd5-2aa093cca3e3",
                "appliesTo": "ELEMENT",
                "styleBlockIds": []
            }],
            "config": {
                "loop": false,
                "playInReverse": false,
                "scrollOffsetValue": null,
                "scrollOffsetUnit": null,
                "delay": null,
                "direction": null,
                "effectIn": null
            },
            "createdOn": 1692695801416
        },
        "e-8": {
            "id": "e-8",
            "name": "",
            "animationType": "preset",
            "eventTypeId": "MOUSE_CLICK",
            "action": {
                "id": "",
                "actionTypeId": "GENERAL_START_ACTION",
                "config": {
                    "delay": 0,
                    "easing": "",
                    "duration": 0,
                    "actionListId": "a-7",
                    "affectedElements": {},
                    "playInReverse": false,
                    "autoStopEventId": "e-13"
                }
            },
            "mediaQueries": ["main", "medium", "small", "tiny"],
            "target": {
                "id": "65f05b3ab3ea937565a752e0|cb8f00df-8907-4d0c-bdd5-2aa093cca3ed",
                "appliesTo": "ELEMENT",
                "styleBlockIds": []
            },
            "targets": [{
                "id": "65f05b3ab3ea937565a752e0|cb8f00df-8907-4d0c-bdd5-2aa093cca3ed",
                "appliesTo": "ELEMENT",
                "styleBlockIds": []
            }],
            "config": {
                "loop": false,
                "playInReverse": false,
                "scrollOffsetValue": null,
                "scrollOffsetUnit": null,
                "delay": null,
                "direction": null,
                "effectIn": null
            },
            "createdOn": 1648715934950
        },
        "e-9": {
            "id": "e-9",
            "name": "",
            "animationType": "preset",
            "eventTypeId": "MOUSE_SECOND_CLICK",
            "action": {
                "id": "",
                "actionTypeId": "GENERAL_START_ACTION",
                "config": {
                    "delay": 0,
                    "easing": "",
                    "duration": 0,
                    "actionListId": "a-8",
                    "affectedElements": {},
                    "playInReverse": false,
                    "autoStopEventId": "e-12"
                }
            },
            "mediaQueries": ["main", "medium", "small", "tiny"],
            "target": {
                "id": "65f05b3ab3ea937565a752e0|cb8f00df-8907-4d0c-bdd5-2aa093cca3f7",
                "appliesTo": "ELEMENT",
                "styleBlockIds": []
            },
            "targets": [{
                "id": "65f05b3ab3ea937565a752e0|cb8f00df-8907-4d0c-bdd5-2aa093cca3f7",
                "appliesTo": "ELEMENT",
                "styleBlockIds": []
            }],
            "config": {
                "loop": false,
                "playInReverse": false,
                "scrollOffsetValue": null,
                "scrollOffsetUnit": null,
                "delay": null,
                "direction": null,
                "effectIn": null
            },
            "createdOn": 1648715934169
        },
        "e-12": {
            "id": "e-12",
            "name": "",
            "animationType": "preset",
            "eventTypeId": "MOUSE_CLICK",
            "action": {
                "id": "",
                "actionTypeId": "GENERAL_START_ACTION",
                "config": {
                    "delay": 0,
                    "easing": "",
                    "duration": 0,
                    "actionListId": "a-7",
                    "affectedElements": {},
                    "playInReverse": false,
                    "autoStopEventId": "e-9"
                }
            },
            "mediaQueries": ["main", "medium", "small", "tiny"],
            "target": {
                "id": "65f05b3ab3ea937565a752e0|cb8f00df-8907-4d0c-bdd5-2aa093cca3f7",
                "appliesTo": "ELEMENT",
                "styleBlockIds": []
            },
            "targets": [{
                "id": "65f05b3ab3ea937565a752e0|cb8f00df-8907-4d0c-bdd5-2aa093cca3f7",
                "appliesTo": "ELEMENT",
                "styleBlockIds": []
            }],
            "config": {
                "loop": false,
                "playInReverse": false,
                "scrollOffsetValue": null,
                "scrollOffsetUnit": null,
                "delay": null,
                "direction": null,
                "effectIn": null
            },
            "createdOn": 1648715934169
        },
        "e-13": {
            "id": "e-13",
            "name": "",
            "animationType": "preset",
            "eventTypeId": "MOUSE_SECOND_CLICK",
            "action": {
                "id": "",
                "actionTypeId": "GENERAL_START_ACTION",
                "config": {
                    "delay": 0,
                    "easing": "",
                    "duration": 0,
                    "actionListId": "a-8",
                    "affectedElements": {},
                    "playInReverse": false,
                    "autoStopEventId": "e-8"
                }
            },
            "mediaQueries": ["main", "medium", "small", "tiny"],
            "target": {
                "id": "65f05b3ab3ea937565a752e0|cb8f00df-8907-4d0c-bdd5-2aa093cca3ed",
                "appliesTo": "ELEMENT",
                "styleBlockIds": []
            },
            "targets": [{
                "id": "65f05b3ab3ea937565a752e0|cb8f00df-8907-4d0c-bdd5-2aa093cca3ed",
                "appliesTo": "ELEMENT",
                "styleBlockIds": []
            }],
            "config": {
                "loop": false,
                "playInReverse": false,
                "scrollOffsetValue": null,
                "scrollOffsetUnit": null,
                "delay": null,
                "direction": null,
                "effectIn": null
            },
            "createdOn": 1648715934950
        },
        "e-14": {
            "id": "e-14",
            "name": "",
            "animationType": "preset",
            "eventTypeId": "MOUSE_CLICK",
            "action": {
                "id": "",
                "actionTypeId": "GENERAL_START_ACTION",
                "config": {
                    "delay": 0,
                    "easing": "",
                    "duration": 0,
                    "actionListId": "a-7",
                    "affectedElements": {},
                    "playInReverse": false,
                    "autoStopEventId": "e-15"
                }
            },
            "mediaQueries": ["main", "medium", "small", "tiny"],
            "target": {
                "id": "65f05b3ab3ea937565a752e0|cb8f00df-8907-4d0c-bdd5-2aa093cca401",
                "appliesTo": "ELEMENT",
                "styleBlockIds": []
            },
            "targets": [{
                "id": "65f05b3ab3ea937565a752e0|cb8f00df-8907-4d0c-bdd5-2aa093cca401",
                "appliesTo": "ELEMENT",
                "styleBlockIds": []
            }],
            "config": {
                "loop": false,
                "playInReverse": false,
                "scrollOffsetValue": null,
                "scrollOffsetUnit": null,
                "delay": null,
                "direction": null,
                "effectIn": null
            },
            "createdOn": 1648715933357
        },
        "e-15": {
            "id": "e-15",
            "name": "",
            "animationType": "preset",
            "eventTypeId": "MOUSE_SECOND_CLICK",
            "action": {
                "id": "",
                "actionTypeId": "GENERAL_START_ACTION",
                "config": {
                    "delay": 0,
                    "easing": "",
                    "duration": 0,
                    "actionListId": "a-8",
                    "affectedElements": {},
                    "playInReverse": false,
                    "autoStopEventId": "e-2062"
                }
            },
            "mediaQueries": ["main", "medium", "small", "tiny"],
            "target": {
                "id": "65f05b3ab3ea937565a752e0|cb8f00df-8907-4d0c-bdd5-2aa093cca401",
                "appliesTo": "ELEMENT",
                "styleBlockIds": []
            },
            "targets": [{
                "id": "65f05b3ab3ea937565a752e0|cb8f00df-8907-4d0c-bdd5-2aa093cca401",
                "appliesTo": "ELEMENT",
                "styleBlockIds": []
            }],
            "config": {
                "loop": false,
                "playInReverse": false,
                "scrollOffsetValue": null,
                "scrollOffsetUnit": null,
                "delay": null,
                "direction": null,
                "effectIn": null
            },
            "createdOn": 1648715933357
        },
        "e-16": {
            "id": "e-16",
            "name": "",
            "animationType": "custom",
            "eventTypeId": "MOUSE_SECOND_CLICK",
            "action": {
                "id": "",
                "actionTypeId": "GENERAL_START_ACTION",
                "config": {
                    "delay": 0,
                    "easing": "",
                    "duration": 0,
                    "actionListId": "a-8",
                    "affectedElements": {},
                    "playInReverse": false,
                    "autoStopEventId": "e-7"
                }
            },
            "mediaQueries": ["main", "medium", "small", "tiny"],
            "target": {
                "id": "65f05b3ab3ea937565a752e0|cb8f00df-8907-4d0c-bdd5-2aa093cca3e3",
                "appliesTo": "ELEMENT",
                "styleBlockIds": []
            },
            "targets": [{
                "id": "65f05b3ab3ea937565a752e0|cb8f00df-8907-4d0c-bdd5-2aa093cca3e3",
                "appliesTo": "ELEMENT",
                "styleBlockIds": []
            }],
            "config": {
                "loop": false,
                "playInReverse": false,
                "scrollOffsetValue": null,
                "scrollOffsetUnit": null,
                "delay": null,
                "direction": null,
                "effectIn": null
            },
            "createdOn": 1692695801424
        },
        "e-17": {
            "id": "e-17",
            "name": "",
            "animationType": "preset",
            "eventTypeId": "MOUSE_CLICK",
            "action": {
                "id": "",
                "actionTypeId": "GENERAL_START_ACTION",
                "config": {
                    "delay": 0,
                    "easing": "",
                    "duration": 0,
                    "actionListId": "a-7",
                    "affectedElements": {},
                    "playInReverse": false,
                    "autoStopEventId": "e-18"
                }
            },
            "mediaQueries": ["main", "medium", "small", "tiny"],
            "target": {
                "id": "65f05b3ab3ea937565a752e0|bddc322a-0570-26b2-602b-e5fc05c05e94",
                "appliesTo": "ELEMENT",
                "styleBlockIds": []
            },
            "targets": [{
                "id": "65f05b3ab3ea937565a752e0|bddc322a-0570-26b2-602b-e5fc05c05e94",
                "appliesTo": "ELEMENT",
                "styleBlockIds": []
            }],
            "config": {
                "loop": false,
                "playInReverse": false,
                "scrollOffsetValue": null,
                "scrollOffsetUnit": null,
                "delay": null,
                "direction": null,
                "effectIn": null
            },
            "createdOn": 1710256771744
        },
        "e-18": {
            "id": "e-18",
            "name": "",
            "animationType": "preset",
            "eventTypeId": "MOUSE_SECOND_CLICK",
            "action": {
                "id": "",
                "actionTypeId": "GENERAL_START_ACTION",
                "config": {
                    "delay": 0,
                    "easing": "",
                    "duration": 0,
                    "actionListId": "a-8",
                    "affectedElements": {},
                    "playInReverse": false,
                    "autoStopEventId": "e-17"
                }
            },
            "mediaQueries": ["main", "medium", "small", "tiny"],
            "target": {
                "id": "65f05b3ab3ea937565a752e0|bddc322a-0570-26b2-602b-e5fc05c05e94",
                "appliesTo": "ELEMENT",
                "styleBlockIds": []
            },
            "targets": [{
                "id": "65f05b3ab3ea937565a752e0|bddc322a-0570-26b2-602b-e5fc05c05e94",
                "appliesTo": "ELEMENT",
                "styleBlockIds": []
            }],
            "config": {
                "loop": false,
                "playInReverse": false,
                "scrollOffsetValue": null,
                "scrollOffsetUnit": null,
                "delay": null,
                "direction": null,
                "effectIn": null
            },
            "createdOn": 1710256771744
        },
        "e-23": {
            "id": "e-23",
            "name": "",
            "animationType": "custom",
            "eventTypeId": "SCROLL_INTO_VIEW",
            "action": {
                "id": "",
                "actionTypeId": "GENERAL_START_ACTION",
                "config": {
                    "delay": 0,
                    "easing": "",
                    "duration": 0,
                    "actionListId": "a-9",
                    "affectedElements": {},
                    "playInReverse": false,
                    "autoStopEventId": "e-24"
                }
            },
            "mediaQueries": ["main", "medium", "small", "tiny"],
            "target": {
                "id": "65f05b3ab3ea937565a752e0|00b95747-4bff-ec4e-264a-ba685e7552c9",
                "appliesTo": "ELEMENT",
                "styleBlockIds": []
            },
            "targets": [{
                "id": "65f05b3ab3ea937565a752e0|00b95747-4bff-ec4e-264a-ba685e7552c9",
                "appliesTo": "ELEMENT",
                "styleBlockIds": []
            }],
            "config": {
                "loop": false,
                "playInReverse": false,
                "scrollOffsetValue": 20,
                "scrollOffsetUnit": "%",
                "delay": null,
                "direction": null,
                "effectIn": null
            },
            "createdOn": 1710935463826
        },
        "e-28": {
            "id": "e-28",
            "name": "",
            "animationType": "custom",
            "eventTypeId": "PAGE_FINISH",
            "action": {
                "id": "",
                "actionTypeId": "GENERAL_START_ACTION",
                "config": {
                    "delay": 0,
                    "easing": "",
                    "duration": 0,
                    "actionListId": "a-11",
                    "affectedElements": {},
                    "playInReverse": false,
                    "autoStopEventId": "e-27"
                }
            },
            "mediaQueries": ["main", "medium", "small", "tiny"],
            "target": {
                "id": "65f05b3ab3ea937565a752e0",
                "appliesTo": "PAGE",
                "styleBlockIds": []
            },
            "targets": [{
                "id": "65f05b3ab3ea937565a752e0",
                "appliesTo": "PAGE",
                "styleBlockIds": []
            }],
            "config": {
                "loop": false,
                "playInReverse": false,
                "scrollOffsetValue": null,
                "scrollOffsetUnit": null,
                "delay": null,
                "direction": null,
                "effectIn": null
            },
            "createdOn": 1710935907128
        },
        "e-31": {
            "id": "e-31",
            "name": "",
            "animationType": "custom",
            "eventTypeId": "SCROLL_INTO_VIEW",
            "action": {
                "id": "",
                "actionTypeId": "GENERAL_START_ACTION",
                "config": {
                    "delay": 0,
                    "easing": "",
                    "duration": 0,
                    "actionListId": "a-12",
                    "affectedElements": {},
                    "playInReverse": false,
                    "autoStopEventId": "e-32"
                }
            },
            "mediaQueries": ["main", "medium", "small"],
            "target": {
                "id": "65f05b3ab3ea937565a752e0|96fba8c8-b3a8-2106-3757-787ee899156a",
                "appliesTo": "ELEMENT",
                "styleBlockIds": []
            },
            "targets": [{
                "id": "65f05b3ab3ea937565a752e0|96fba8c8-b3a8-2106-3757-787ee899156a",
                "appliesTo": "ELEMENT",
                "styleBlockIds": []
            }],
            "config": {
                "loop": false,
                "playInReverse": false,
                "scrollOffsetValue": 20,
                "scrollOffsetUnit": "%",
                "delay": null,
                "direction": null,
                "effectIn": null
            },
            "createdOn": 1711022010636
        },
        "e-35": {
            "id": "e-35",
            "name": "",
            "animationType": "custom",
            "eventTypeId": "SCROLL_INTO_VIEW",
            "action": {
                "id": "",
                "actionTypeId": "GENERAL_START_ACTION",
                "config": {
                    "delay": 0,
                    "easing": "",
                    "duration": 0,
                    "actionListId": "a-9",
                    "affectedElements": {},
                    "playInReverse": false,
                    "autoStopEventId": "e-36"
                }
            },
            "mediaQueries": ["main", "medium", "small", "tiny"],
            "target": {
                "selector": ".feature-section_image-on-left",
                "originalId": "65f05b3ab3ea937565a752e0|e45adce1-c071-95d1-f699-a1e62d49b43e",
                "appliesTo": "CLASS"
            },
            "targets": [{
                "selector": ".feature-section_image-on-left",
                "originalId": "65f05b3ab3ea937565a752e0|e45adce1-c071-95d1-f699-a1e62d49b43e",
                "appliesTo": "CLASS"
            }],
            "config": {
                "loop": false,
                "playInReverse": false,
                "scrollOffsetValue": 50,
                "scrollOffsetUnit": "%",
                "delay": null,
                "direction": null,
                "effectIn": null
            },
            "createdOn": 1711024618180
        },
        "e-37": {
            "id": "e-37",
            "name": "",
            "animationType": "custom",
            "eventTypeId": "SCROLL_INTO_VIEW",
            "action": {
                "id": "",
                "actionTypeId": "GENERAL_START_ACTION",
                "config": {
                    "delay": 0,
                    "easing": "",
                    "duration": 0,
                    "actionListId": "a-12",
                    "affectedElements": {},
                    "playInReverse": false,
                    "autoStopEventId": "e-38"
                }
            },
            "mediaQueries": ["main", "medium", "small"],
            "target": {
                "id": "65f05b3ab3ea937565a752e0|813cc470-972d-c9d4-a60a-1a978a6b3eb0",
                "appliesTo": "ELEMENT",
                "styleBlockIds": []
            },
            "targets": [{
                "id": "65f05b3ab3ea937565a752e0|813cc470-972d-c9d4-a60a-1a978a6b3eb0",
                "appliesTo": "ELEMENT",
                "styleBlockIds": []
            }],
            "config": {
                "loop": false,
                "playInReverse": false,
                "scrollOffsetValue": 20,
                "scrollOffsetUnit": "%",
                "delay": null,
                "direction": null,
                "effectIn": null
            },
            "createdOn": 1722421731881
        },
        "e-39": {
            "id": "e-39",
            "name": "",
            "animationType": "custom",
            "eventTypeId": "SCROLL_INTO_VIEW",
            "action": {
                "id": "",
                "actionTypeId": "GENERAL_START_ACTION",
                "config": {
                    "delay": 0,
                    "easing": "",
                    "duration": 0,
                    "actionListId": "a-13",
                    "affectedElements": {},
                    "playInReverse": false,
                    "autoStopEventId": "e-40"
                }
            },
            "mediaQueries": ["tiny"],
            "target": {
                "id": "65f05b3ab3ea937565a752e0|813cc470-972d-c9d4-a60a-1a978a6b3eb0",
                "appliesTo": "ELEMENT",
                "styleBlockIds": []
            },
            "targets": [{
                "id": "65f05b3ab3ea937565a752e0|813cc470-972d-c9d4-a60a-1a978a6b3eb0",
                "appliesTo": "ELEMENT",
                "styleBlockIds": []
            }],
            "config": {
                "loop": false,
                "playInReverse": false,
                "scrollOffsetValue": 0,
                "scrollOffsetUnit": "%",
                "delay": null,
                "direction": null,
                "effectIn": null
            },
            "createdOn": 1722421808560
        },
        "e-41": {
            "id": "e-41",
            "name": "",
            "animationType": "custom",
            "eventTypeId": "SCROLL_INTO_VIEW",
            "action": {
                "id": "",
                "actionTypeId": "GENERAL_START_ACTION",
                "config": {
                    "delay": 0,
                    "easing": "",
                    "duration": 0,
                    "actionListId": "a-14",
                    "affectedElements": {},
                    "playInReverse": false,
                    "autoStopEventId": "e-42"
                }
            },
            "mediaQueries": ["main", "medium", "small", "tiny"],
            "target": {
                "id": "65f05b3ab3ea937565a752e0|ca813dd5-7886-970b-a7d0-ba103a198fcf",
                "appliesTo": "ELEMENT",
                "styleBlockIds": []
            },
            "targets": [{
                "id": "65f05b3ab3ea937565a752e0|ca813dd5-7886-970b-a7d0-ba103a198fcf",
                "appliesTo": "ELEMENT",
                "styleBlockIds": []
            }],
            "config": {
                "loop": false,
                "playInReverse": false,
                "scrollOffsetValue": 20,
                "scrollOffsetUnit": "%",
                "delay": 0,
                "direction": null,
                "effectIn": null
            },
            "createdOn": 1722435220126
        },
        "e-43": {
            "id": "e-43",
            "name": "",
            "animationType": "custom",
            "eventTypeId": "SCROLL_INTO_VIEW",
            "action": {
                "id": "",
                "actionTypeId": "GENERAL_START_ACTION",
                "config": {
                    "delay": 0,
                    "easing": "",
                    "duration": 0,
                    "actionListId": "a-10",
                    "affectedElements": {},
                    "playInReverse": false,
                    "autoStopEventId": "e-44"
                }
            },
            "mediaQueries": ["main", "medium", "small", "tiny"],
            "target": {
                "appliesTo": "ELEMENT",
                "styleBlockIds": [],
                "id": "65f05b3ab3ea937565a752e0|00b95747-4bff-ec4e-264a-ba685e7552ca"
            },
            "targets": [],
            "config": {
                "loop": false,
                "playInReverse": false,
                "scrollOffsetValue": 50,
                "scrollOffsetUnit": "%",
                "delay": null,
                "direction": null,
                "effectIn": null
            },
            "createdOn": 1724687342457
        }
    },
    "actionLists": {
        "a": {
            "id": "a",
            "title": "Navbar 2 menu [Open]",
            "actionItemGroups": [{
                "actionItems": [{
                    "id": "a-n",
                    "actionTypeId": "TRANSFORM_MOVE",
                    "config": {
                        "delay": 0,
                        "easing": "inOutQuint",
                        "duration": 400,
                        "target": {
                            "useEventTarget": "CHILDREN",
                            "selector": ".menu-icon2_line-top",
                            "selectorGuids": ["45784019-2c84-b6cb-2b04-942ddaac2362"]
                        },
                        "yValue": 8,
                        "xUnit": "PX",
                        "yUnit": "px",
                        "zUnit": "PX"
                    }
                }, {
                    "id": "a-n-2",
                    "actionTypeId": "TRANSFORM_MOVE",
                    "config": {
                        "delay": 0,
                        "easing": "inOutQuint",
                        "duration": 400,
                        "target": {
                            "useEventTarget": "CHILDREN",
                            "selector": ".menu-icon2_line-bottom",
                            "selectorGuids": ["45784019-2c84-b6cb-2b04-942ddaac235e"]
                        },
                        "yValue": -8,
                        "xUnit": "PX",
                        "yUnit": "px",
                        "zUnit": "PX"
                    }
                }, {
                    "id": "a-n-3",
                    "actionTypeId": "TRANSFORM_ROTATE",
                    "config": {
                        "delay": 0,
                        "easing": "inOutQuint",
                        "duration": 400,
                        "target": {
                            "useEventTarget": "CHILDREN",
                            "selector": ".menu-icon2_line-bottom",
                            "selectorGuids": ["45784019-2c84-b6cb-2b04-942ddaac235e"]
                        },
                        "zValue": -45,
                        "xUnit": "DEG",
                        "yUnit": "DEG",
                        "zUnit": "deg"
                    }
                }, {
                    "id": "a-n-4",
                    "actionTypeId": "TRANSFORM_ROTATE",
                    "config": {
                        "delay": 0,
                        "easing": "inOutQuint",
                        "duration": 400,
                        "target": {
                            "useEventTarget": "CHILDREN",
                            "selector": ".menu-icon2_line-top",
                            "selectorGuids": ["45784019-2c84-b6cb-2b04-942ddaac2362"]
                        },
                        "zValue": 45,
                        "xUnit": "DEG",
                        "yUnit": "DEG",
                        "zUnit": "deg"
                    }
                }, {
                    "id": "a-n-5",
                    "actionTypeId": "STYLE_OPACITY",
                    "config": {
                        "delay": 0,
                        "easing": "inOutQuint",
                        "duration": 400,
                        "target": {
                            "useEventTarget": "CHILDREN",
                            "selector": ".menu-icon2_line-middle",
                            "selectorGuids": ["45784019-2c84-b6cb-2b04-942ddaac236c"]
                        },
                        "value": 0,
                        "unit": ""
                    }
                }]
            }],
            "useFirstGroupAsInitialState": false,
            "createdOn": 1626225663494
        },
        "a-2": {
            "id": "a-2",
            "title": "Navbar 2 menu [Close]",
            "actionItemGroups": [{
                "actionItems": [{
                    "id": "a-2-n",
                    "actionTypeId": "TRANSFORM_MOVE",
                    "config": {
                        "delay": 0,
                        "easing": "inOutQuint",
                        "duration": 400,
                        "target": {
                            "useEventTarget": "CHILDREN",
                            "selector": ".menu-icon2_line-top",
                            "selectorGuids": ["45784019-2c84-b6cb-2b04-942ddaac2362"]
                        },
                        "yValue": 0,
                        "xUnit": "PX",
                        "yUnit": "px",
                        "zUnit": "PX"
                    }
                }, {
                    "id": "a-2-n-2",
                    "actionTypeId": "TRANSFORM_MOVE",
                    "config": {
                        "delay": 0,
                        "easing": "inOutQuint",
                        "duration": 400,
                        "target": {
                            "useEventTarget": "CHILDREN",
                            "selector": ".menu-icon2_line-bottom",
                            "selectorGuids": ["45784019-2c84-b6cb-2b04-942ddaac235e"]
                        },
                        "yValue": 0,
                        "xUnit": "PX",
                        "yUnit": "px",
                        "zUnit": "PX"
                    }
                }, {
                    "id": "a-2-n-3",
                    "actionTypeId": "TRANSFORM_ROTATE",
                    "config": {
                        "delay": 0,
                        "easing": "inOutQuint",
                        "duration": 400,
                        "target": {
                            "useEventTarget": "CHILDREN",
                            "selector": ".menu-icon2_line-bottom",
                            "selectorGuids": ["45784019-2c84-b6cb-2b04-942ddaac235e"]
                        },
                        "zValue": 0,
                        "xUnit": "DEG",
                        "yUnit": "DEG",
                        "zUnit": "deg"
                    }
                }, {
                    "id": "a-2-n-4",
                    "actionTypeId": "TRANSFORM_ROTATE",
                    "config": {
                        "delay": 0,
                        "easing": "inOutQuint",
                        "duration": 400,
                        "target": {
                            "useEventTarget": "CHILDREN",
                            "selector": ".menu-icon2_line-top",
                            "selectorGuids": ["45784019-2c84-b6cb-2b04-942ddaac2362"]
                        },
                        "zValue": 0,
                        "xUnit": "DEG",
                        "yUnit": "DEG",
                        "zUnit": "deg"
                    }
                }, {
                    "id": "a-2-n-5",
                    "actionTypeId": "STYLE_OPACITY",
                    "config": {
                        "delay": 0,
                        "easing": "inOutQuint",
                        "duration": 400,
                        "target": {
                            "useEventTarget": "CHILDREN",
                            "selector": ".menu-icon2_line-middle",
                            "selectorGuids": ["45784019-2c84-b6cb-2b04-942ddaac236c"]
                        },
                        "value": 1,
                        "unit": ""
                    }
                }]
            }],
            "useFirstGroupAsInitialState": false,
            "createdOn": 1626226496146
        },
        "a-7": {
            "id": "a-7",
            "title": "FAQ 1 accordion [Open]",
            "actionItemGroups": [{
                "actionItems": [{
                    "id": "a-7-n",
                    "actionTypeId": "STYLE_SIZE",
                    "config": {
                        "delay": 0,
                        "easing": "",
                        "duration": 500,
                        "target": {
                            "useEventTarget": "SIBLINGS",
                            "selector": ".faq_answer",
                            "selectorGuids": ["61a065f4-6c2b-2495-808c-00abc4af86ac"]
                        },
                        "widthValue": 100,
                        "heightValue": 0,
                        "widthUnit": "%",
                        "heightUnit": "px",
                        "locked": false
                    }
                }]
            }, {
                "actionItems": [{
                    "id": "a-7-n-2",
                    "actionTypeId": "STYLE_SIZE",
                    "config": {
                        "delay": 0,
                        "easing": "ease",
                        "duration": 400,
                        "target": {
                            "useEventTarget": "SIBLINGS",
                            "selector": ".faq_answer",
                            "selectorGuids": ["61a065f4-6c2b-2495-808c-00abc4af86ac"]
                        },
                        "widthValue": 100,
                        "widthUnit": "%",
                        "heightUnit": "AUTO",
                        "locked": false
                    }
                }, {
                    "id": "a-7-n-3",
                    "actionTypeId": "TRANSFORM_ROTATE",
                    "config": {
                        "delay": 0,
                        "easing": "ease",
                        "duration": 400,
                        "target": {
                            "useEventTarget": "CHILDREN",
                            "selector": ".faq_icon-wrapper",
                            "selectorGuids": ["61a065f4-6c2b-2495-808c-00abc4af86ad"]
                        },
                        "zValue": 180,
                        "xUnit": "DEG",
                        "yUnit": "DEG",
                        "zUnit": "deg"
                    }
                }]
            }],
            "useFirstGroupAsInitialState": true,
            "createdOn": 1628306749914
        },
        "a-8": {
            "id": "a-8",
            "title": "FAQ 1 accordion [Close]",
            "actionItemGroups": [{
                "actionItems": [{
                    "id": "a-8-n",
                    "actionTypeId": "STYLE_SIZE",
                    "config": {
                        "delay": 0,
                        "easing": "ease",
                        "duration": 400,
                        "target": {
                            "useEventTarget": "SIBLINGS",
                            "selector": ".faq_answer",
                            "selectorGuids": ["61a065f4-6c2b-2495-808c-00abc4af86ac"]
                        },
                        "widthValue": 100,
                        "heightValue": 0,
                        "widthUnit": "%",
                        "heightUnit": "px",
                        "locked": false
                    }
                }, {
                    "id": "a-8-n-2",
                    "actionTypeId": "TRANSFORM_ROTATE",
                    "config": {
                        "delay": 0,
                        "easing": "ease",
                        "duration": 400,
                        "target": {
                            "useEventTarget": "CHILDREN",
                            "selector": ".faq_icon-wrapper",
                            "selectorGuids": ["61a065f4-6c2b-2495-808c-00abc4af86ad"]
                        },
                        "zValue": 0,
                        "xUnit": "DEG",
                        "yUnit": "DEG",
                        "zUnit": "deg"
                    }
                }]
            }],
            "useFirstGroupAsInitialState": false,
            "createdOn": 1628306749914
        },
        "a-9": {
            "id": "a-9",
            "title": "Feature Image Hinge In From Left",
            "actionItemGroups": [{
                "actionItems": [{
                    "id": "a-9-n",
                    "actionTypeId": "TRANSFORM_ROTATE",
                    "config": {
                        "delay": 0,
                        "easing": "",
                        "duration": 500,
                        "target": {
                            "useEventTarget": "CHILDREN",
                            "selector": ".feature-section_image-on-left",
                            "selectorGuids": ["73c66fe6-884e-20e5-d148-e27841fb6cc1"]
                        },
                        "zValue": -15,
                        "xUnit": "DEG",
                        "yUnit": "DEG",
                        "zUnit": "deg"
                    }
                }, {
                    "id": "a-9-n-2",
                    "actionTypeId": "TRANSFORM_MOVE",
                    "config": {
                        "delay": 0,
                        "easing": "",
                        "duration": 500,
                        "target": {
                            "useEventTarget": "CHILDREN",
                            "selector": ".feature-section_image-on-left",
                            "selectorGuids": ["73c66fe6-884e-20e5-d148-e27841fb6cc1"]
                        },
                        "xValue": -5,
                        "yValue": 2.5,
                        "xUnit": "rem",
                        "yUnit": "rem",
                        "zUnit": "PX"
                    }
                }, {
                    "id": "a-9-n-5",
                    "actionTypeId": "STYLE_OPACITY",
                    "config": {
                        "delay": 0,
                        "easing": "",
                        "duration": 500,
                        "target": {
                            "useEventTarget": "CHILDREN",
                            "selector": ".feature-section_image-on-left",
                            "selectorGuids": ["73c66fe6-884e-20e5-d148-e27841fb6cc1"]
                        },
                        "value": 0,
                        "unit": ""
                    }
                }]
            }, {
                "actionItems": [{
                    "id": "a-9-n-4",
                    "actionTypeId": "TRANSFORM_MOVE",
                    "config": {
                        "delay": 0,
                        "easing": "swingTo",
                        "duration": 400,
                        "target": {
                            "useEventTarget": "CHILDREN",
                            "selector": ".feature-section_image-on-left",
                            "selectorGuids": ["73c66fe6-884e-20e5-d148-e27841fb6cc1"]
                        },
                        "xValue": 0,
                        "yValue": 0,
                        "xUnit": "rem",
                        "yUnit": "rem",
                        "zUnit": "PX"
                    }
                }, {
                    "id": "a-9-n-6",
                    "actionTypeId": "STYLE_OPACITY",
                    "config": {
                        "delay": 0,
                        "easing": "swingTo",
                        "duration": 400,
                        "target": {
                            "useEventTarget": "CHILDREN",
                            "selector": ".feature-section_image-on-left",
                            "selectorGuids": ["73c66fe6-884e-20e5-d148-e27841fb6cc1"]
                        },
                        "value": 1,
                        "unit": ""
                    }
                }, {
                    "id": "a-9-n-3",
                    "actionTypeId": "TRANSFORM_ROTATE",
                    "config": {
                        "delay": 0,
                        "easing": "swingTo",
                        "duration": 400,
                        "target": {
                            "useEventTarget": "CHILDREN",
                            "selector": ".feature-section_image-on-left",
                            "selectorGuids": ["73c66fe6-884e-20e5-d148-e27841fb6cc1"]
                        },
                        "zValue": 0,
                        "xUnit": "DEG",
                        "yUnit": "DEG",
                        "zUnit": "deg"
                    }
                }]
            }],
            "useFirstGroupAsInitialState": true,
            "createdOn": 1710934399306
        },
        "a-11": {
            "id": "a-11",
            "title": "Page Load",
            "actionItemGroups": [{
                "actionItems": [{
                    "id": "a-11-n",
                    "actionTypeId": "TRANSFORM_SCALE",
                    "config": {
                        "delay": 0,
                        "easing": "swingTo",
                        "duration": 400,
                        "target": {
                            "id": "65f05b3ab3ea937565a752e0|3f0a4d5f-89ab-fe0a-212b-957318b2a2a7"
                        },
                        "xValue": 0.7,
                        "yValue": 0.7,
                        "locked": true
                    }
                }, {
                    "id": "a-11-n-3",
                    "actionTypeId": "STYLE_OPACITY",
                    "config": {
                        "delay": 0,
                        "easing": "",
                        "duration": 500,
                        "target": {
                            "id": "65f05b3ab3ea937565a752e0|3f0a4d5f-89ab-fe0a-212b-957318b2a2a7"
                        },
                        "value": 0,
                        "unit": ""
                    }
                }, {
                    "id": "a-11-n-5",
                    "actionTypeId": "TRANSFORM_SCALE",
                    "config": {
                        "delay": 0,
                        "easing": "swingTo",
                        "duration": 400,
                        "target": {
                            "id": "65f05b3ab3ea937565a752e0|3f0a4d5f-89ab-fe0a-212b-957318b2a2a9"
                        },
                        "xValue": 0.7,
                        "yValue": 0.7,
                        "locked": true
                    }
                }, {
                    "id": "a-11-n-6",
                    "actionTypeId": "STYLE_OPACITY",
                    "config": {
                        "delay": 0,
                        "easing": "",
                        "duration": 500,
                        "target": {
                            "id": "65f05b3ab3ea937565a752e0|3f0a4d5f-89ab-fe0a-212b-957318b2a2a9"
                        },
                        "value": 0,
                        "unit": ""
                    }
                }, {
                    "id": "a-11-n-9",
                    "actionTypeId": "TRANSFORM_SCALE",
                    "config": {
                        "delay": 0,
                        "easing": "swingTo",
                        "duration": 400,
                        "target": {
                            "id": "65f05b3ab3ea937565a752e0|3f0a4d5f-89ab-fe0a-212b-957318b2a2ab"
                        },
                        "xValue": 0.7,
                        "yValue": 0.7,
                        "locked": true
                    }
                }, {
                    "id": "a-11-n-10",
                    "actionTypeId": "STYLE_OPACITY",
                    "config": {
                        "delay": 0,
                        "easing": "",
                        "duration": 500,
                        "target": {
                            "id": "65f05b3ab3ea937565a752e0|3f0a4d5f-89ab-fe0a-212b-957318b2a2ab"
                        },
                        "value": 0,
                        "unit": ""
                    }
                }, {
                    "id": "a-11-n-17",
                    "actionTypeId": "TRANSFORM_ROTATE",
                    "config": {
                        "delay": 0,
                        "easing": "",
                        "duration": 500,
                        "target": {
                            "id": "65f05b3ab3ea937565a752e0|f2eb36fb-b42f-bc07-2ba1-3a2f3a2ba472"
                        },
                        "zValue": -20,
                        "xUnit": "DEG",
                        "yUnit": "DEG",
                        "zUnit": "deg"
                    }
                }, {
                    "id": "a-11-n-21",
                    "actionTypeId": "TRANSFORM_MOVE",
                    "config": {
                        "delay": 0,
                        "easing": "",
                        "duration": 500,
                        "target": {
                            "id": "65f05b3ab3ea937565a752e0|f2eb36fb-b42f-bc07-2ba1-3a2f3a2ba472"
                        },
                        "xValue": -4,
                        "yValue": 2,
                        "xUnit": "rem",
                        "yUnit": "rem",
                        "zUnit": "PX"
                    }
                }, {
                    "id": "a-11-n-18",
                    "actionTypeId": "STYLE_OPACITY",
                    "config": {
                        "delay": 0,
                        "easing": "",
                        "duration": 500,
                        "target": {
                            "id": "65f05b3ab3ea937565a752e0|f2eb36fb-b42f-bc07-2ba1-3a2f3a2ba472"
                        },
                        "value": 0,
                        "unit": ""
                    }
                }, {
                    "id": "a-11-n-23",
                    "actionTypeId": "TRANSFORM_ROTATE",
                    "config": {
                        "delay": 0,
                        "easing": "",
                        "duration": 500,
                        "target": {
                            "id": "65f05b3ab3ea937565a752e0|459e0323-90f8-c724-0ac1-e6e7b48bc04c"
                        },
                        "zValue": 20,
                        "xUnit": "DEG",
                        "yUnit": "DEG",
                        "zUnit": "deg"
                    }
                }, {
                    "id": "a-11-n-25",
                    "actionTypeId": "STYLE_OPACITY",
                    "config": {
                        "delay": 0,
                        "easing": "",
                        "duration": 500,
                        "target": {
                            "id": "65f05b3ab3ea937565a752e0|459e0323-90f8-c724-0ac1-e6e7b48bc04c"
                        },
                        "value": 0,
                        "unit": ""
                    }
                }, {
                    "id": "a-11-n-24",
                    "actionTypeId": "TRANSFORM_MOVE",
                    "config": {
                        "delay": 0,
                        "easing": "",
                        "duration": 500,
                        "target": {
                            "id": "65f05b3ab3ea937565a752e0|459e0323-90f8-c724-0ac1-e6e7b48bc04c"
                        },
                        "xValue": 4,
                        "yValue": 2,
                        "xUnit": "rem",
                        "yUnit": "rem",
                        "zUnit": "PX"
                    }
                }]
            }, {
                "actionItems": [{
                    "id": "a-11-n-2",
                    "actionTypeId": "TRANSFORM_SCALE",
                    "config": {
                        "delay": 0,
                        "easing": "inOutQuart",
                        "duration": 300,
                        "target": {
                            "id": "65f05b3ab3ea937565a752e0|3f0a4d5f-89ab-fe0a-212b-957318b2a2a7"
                        },
                        "xValue": 1,
                        "yValue": 1,
                        "locked": true
                    }
                }, {
                    "id": "a-11-n-4",
                    "actionTypeId": "STYLE_OPACITY",
                    "config": {
                        "delay": 0,
                        "easing": "inOutQuart",
                        "duration": 300,
                        "target": {
                            "id": "65f05b3ab3ea937565a752e0|3f0a4d5f-89ab-fe0a-212b-957318b2a2a7"
                        },
                        "value": 1,
                        "unit": ""
                    }
                }, {
                    "id": "a-11-n-7",
                    "actionTypeId": "TRANSFORM_SCALE",
                    "config": {
                        "delay": 100,
                        "easing": "inOutQuart",
                        "duration": 300,
                        "target": {
                            "id": "65f05b3ab3ea937565a752e0|3f0a4d5f-89ab-fe0a-212b-957318b2a2a9"
                        },
                        "xValue": 1,
                        "yValue": 1,
                        "locked": true
                    }
                }, {
                    "id": "a-11-n-8",
                    "actionTypeId": "STYLE_OPACITY",
                    "config": {
                        "delay": 100,
                        "easing": "inOutQuart",
                        "duration": 300,
                        "target": {
                            "id": "65f05b3ab3ea937565a752e0|3f0a4d5f-89ab-fe0a-212b-957318b2a2a9"
                        },
                        "value": 1,
                        "unit": ""
                    }
                }, {
                    "id": "a-11-n-13",
                    "actionTypeId": "TRANSFORM_SCALE",
                    "config": {
                        "delay": 200,
                        "easing": "inOutQuart",
                        "duration": 300,
                        "target": {
                            "id": "65f05b3ab3ea937565a752e0|3f0a4d5f-89ab-fe0a-212b-957318b2a2ab"
                        },
                        "xValue": 1,
                        "yValue": 1,
                        "locked": true
                    }
                }, {
                    "id": "a-11-n-14",
                    "actionTypeId": "STYLE_OPACITY",
                    "config": {
                        "delay": 200,
                        "easing": "inOutQuart",
                        "duration": 300,
                        "target": {
                            "id": "65f05b3ab3ea937565a752e0|3f0a4d5f-89ab-fe0a-212b-957318b2a2ab"
                        },
                        "value": 1,
                        "unit": ""
                    }
                }]
            }, {
                "actionItems": [{
                    "id": "a-11-n-19",
                    "actionTypeId": "TRANSFORM_ROTATE",
                    "config": {
                        "delay": 100,
                        "easing": "swingTo",
                        "duration": 300,
                        "target": {
                            "id": "65f05b3ab3ea937565a752e0|f2eb36fb-b42f-bc07-2ba1-3a2f3a2ba472"
                        },
                        "zValue": 0,
                        "xUnit": "DEG",
                        "yUnit": "DEG",
                        "zUnit": "deg"
                    }
                }, {
                    "id": "a-11-n-22",
                    "actionTypeId": "TRANSFORM_MOVE",
                    "config": {
                        "delay": 100,
                        "easing": "swingTo",
                        "duration": 300,
                        "target": {
                            "id": "65f05b3ab3ea937565a752e0|f2eb36fb-b42f-bc07-2ba1-3a2f3a2ba472"
                        },
                        "xValue": 0,
                        "yValue": 0,
                        "xUnit": "px",
                        "yUnit": "px",
                        "zUnit": "PX"
                    }
                }, {
                    "id": "a-11-n-20",
                    "actionTypeId": "STYLE_OPACITY",
                    "config": {
                        "delay": 100,
                        "easing": "swingTo",
                        "duration": 300,
                        "target": {
                            "id": "65f05b3ab3ea937565a752e0|f2eb36fb-b42f-bc07-2ba1-3a2f3a2ba472"
                        },
                        "value": 1,
                        "unit": ""
                    }
                }, {
                    "id": "a-11-n-26",
                    "actionTypeId": "TRANSFORM_ROTATE",
                    "config": {
                        "delay": 100,
                        "easing": "swingTo",
                        "duration": 300,
                        "target": {
                            "id": "65f05b3ab3ea937565a752e0|459e0323-90f8-c724-0ac1-e6e7b48bc04c"
                        },
                        "zValue": 0,
                        "xUnit": "DEG",
                        "yUnit": "DEG",
                        "zUnit": "deg"
                    }
                }, {
                    "id": "a-11-n-28",
                    "actionTypeId": "TRANSFORM_MOVE",
                    "config": {
                        "delay": 100,
                        "easing": "swingTo",
                        "duration": 300,
                        "target": {
                            "id": "65f05b3ab3ea937565a752e0|459e0323-90f8-c724-0ac1-e6e7b48bc04c"
                        },
                        "xValue": 0,
                        "yValue": 0,
                        "xUnit": "rem",
                        "yUnit": "rem",
                        "zUnit": "PX"
                    }
                }, {
                    "id": "a-11-n-27",
                    "actionTypeId": "STYLE_OPACITY",
                    "config": {
                        "delay": 100,
                        "easing": "swingTo",
                        "duration": 300,
                        "target": {
                            "id": "65f05b3ab3ea937565a752e0|459e0323-90f8-c724-0ac1-e6e7b48bc04c"
                        },
                        "value": 1,
                        "unit": ""
                    }
                }]
            }],
            "useFirstGroupAsInitialState": true,
            "createdOn": 1710935932512
        },
        "a-12": {
            "id": "a-12",
            "title": "Cards Come In",
            "actionItemGroups": [{
                "actionItems": [{
                    "id": "a-12-n",
                    "actionTypeId": "TRANSFORM_MOVE",
                    "config": {
                        "delay": 0,
                        "easing": "",
                        "duration": 500,
                        "target": {
                            "useEventTarget": "CHILDREN",
                            "selector": ".feature-cards_item.border-and-shadow-plum.is-first",
                            "selectorGuids": ["dd2ae3a3-64a7-99a8-7051-b55690481ee8", "7e3462cb-cd5f-c217-d380-909262922499", "1768d81c-9303-aba2-f103-9c4576f371e7"]
                        },
                        "xValue": -4,
                        "xUnit": "rem",
                        "yUnit": "PX",
                        "zUnit": "PX"
                    }
                }, {
                    "id": "a-12-n-10",
                    "actionTypeId": "TRANSFORM_MOVE",
                    "config": {
                        "delay": 0,
                        "easing": "",
                        "duration": 500,
                        "target": {
                            "useEventTarget": "CHILDREN",
                            "selector": ".feature-cards_item.border-and-shadow-plum",
                            "selectorGuids": ["dd2ae3a3-64a7-99a8-7051-b55690481ee8", "7e3462cb-cd5f-c217-d380-909262922499"]
                        },
                        "yValue": 0,
                        "xUnit": "PX",
                        "yUnit": "rem",
                        "zUnit": "PX"
                    }
                }, {
                    "id": "a-12-n-5",
                    "actionTypeId": "STYLE_OPACITY",
                    "config": {
                        "delay": 0,
                        "easing": "outQuart",
                        "duration": 500,
                        "target": {
                            "useEventTarget": "CHILDREN",
                            "selector": ".feature-cards_item.border-and-shadow-plum",
                            "selectorGuids": ["dd2ae3a3-64a7-99a8-7051-b55690481ee8", "7e3462cb-cd5f-c217-d380-909262922499"]
                        },
                        "value": 0,
                        "unit": ""
                    }
                }, {
                    "id": "a-12-n-6",
                    "actionTypeId": "TRANSFORM_MOVE",
                    "config": {
                        "delay": 0,
                        "easing": "",
                        "duration": 500,
                        "target": {
                            "useEventTarget": "CHILDREN",
                            "selector": ".feature-cards_item.border-and-shadow-plum.is-last",
                            "selectorGuids": ["dd2ae3a3-64a7-99a8-7051-b55690481ee8", "7e3462cb-cd5f-c217-d380-909262922499", "e79fa848-8c7f-893a-791b-b01c15b5df0d"]
                        },
                        "xValue": 4,
                        "xUnit": "rem",
                        "yUnit": "PX",
                        "zUnit": "PX"
                    }
                }]
            }, {
                "actionItems": [{
                    "id": "a-12-n-8",
                    "actionTypeId": "TRANSFORM_MOVE",
                    "config": {
                        "delay": 0,
                        "easing": "swingTo",
                        "duration": 200,
                        "target": {
                            "useEventTarget": "CHILDREN",
                            "selector": ".feature-cards_item.border-and-shadow-plum",
                            "selectorGuids": ["dd2ae3a3-64a7-99a8-7051-b55690481ee8", "7e3462cb-cd5f-c217-d380-909262922499"]
                        },
                        "yValue": -2,
                        "xUnit": "PX",
                        "yUnit": "rem",
                        "zUnit": "PX"
                    }
                }]
            }, {
                "actionItems": [{
                    "id": "a-12-n-2",
                    "actionTypeId": "TRANSFORM_MOVE",
                    "config": {
                        "delay": 0,
                        "easing": "swingTo",
                        "duration": 400,
                        "target": {
                            "useEventTarget": "CHILDREN",
                            "selector": ".feature-cards_item.border-and-shadow-plum.is-first",
                            "selectorGuids": ["dd2ae3a3-64a7-99a8-7051-b55690481ee8", "7e3462cb-cd5f-c217-d380-909262922499", "1768d81c-9303-aba2-f103-9c4576f371e7"]
                        },
                        "xValue": 0,
                        "xUnit": "rem",
                        "yUnit": "PX",
                        "zUnit": "PX"
                    }
                }, {
                    "id": "a-12-n-7",
                    "actionTypeId": "TRANSFORM_MOVE",
                    "config": {
                        "delay": 0,
                        "easing": "swingTo",
                        "duration": 400,
                        "target": {
                            "useEventTarget": "CHILDREN",
                            "selector": ".feature-cards_item.border-and-shadow-plum.is-last",
                            "selectorGuids": ["dd2ae3a3-64a7-99a8-7051-b55690481ee8", "7e3462cb-cd5f-c217-d380-909262922499", "e79fa848-8c7f-893a-791b-b01c15b5df0d"]
                        },
                        "xValue": 0,
                        "xUnit": "rem",
                        "yUnit": "PX",
                        "zUnit": "PX"
                    }
                }, {
                    "id": "a-12-n-4",
                    "actionTypeId": "STYLE_OPACITY",
                    "config": {
                        "delay": 0,
                        "easing": "swingTo",
                        "duration": 500,
                        "target": {
                            "useEventTarget": "CHILDREN",
                            "selector": ".feature-cards_item.border-and-shadow-plum",
                            "selectorGuids": ["dd2ae3a3-64a7-99a8-7051-b55690481ee8", "7e3462cb-cd5f-c217-d380-909262922499"]
                        },
                        "value": 1,
                        "unit": ""
                    }
                }, {
                    "id": "a-12-n-9",
                    "actionTypeId": "TRANSFORM_MOVE",
                    "config": {
                        "delay": 0,
                        "easing": "swingTo",
                        "duration": 300,
                        "target": {
                            "useEventTarget": "CHILDREN",
                            "selector": ".feature-cards_item.border-and-shadow-plum",
                            "selectorGuids": ["dd2ae3a3-64a7-99a8-7051-b55690481ee8", "7e3462cb-cd5f-c217-d380-909262922499"]
                        },
                        "xValue": null,
                        "yValue": 0,
                        "xUnit": "px",
                        "yUnit": "rem",
                        "zUnit": "PX"
                    }
                }]
            }],
            "useFirstGroupAsInitialState": true,
            "createdOn": 1710948497418
        },
        "a-13": {
            "id": "a-13",
            "title": "Cards Come In Mobile Portrait",
            "actionItemGroups": [{
                "actionItems": [{
                    "id": "a-13-n",
                    "actionTypeId": "TRANSFORM_MOVE",
                    "config": {
                        "delay": 0,
                        "easing": "",
                        "duration": 500,
                        "target": {
                            "useEventTarget": "CHILDREN",
                            "selector": ".feature-cards_item.border-and-shadow-plum.is-first",
                            "selectorGuids": ["dd2ae3a3-64a7-99a8-7051-b55690481ee8", "7e3462cb-cd5f-c217-d380-909262922499", "1768d81c-9303-aba2-f103-9c4576f371e7"]
                        },
                        "xValue": null,
                        "yValue": -4,
                        "xUnit": "rem",
                        "yUnit": "rem",
                        "zUnit": "PX"
                    }
                }, {
                    "id": "a-13-n-10",
                    "actionTypeId": "STYLE_OPACITY",
                    "config": {
                        "delay": 0,
                        "easing": "",
                        "duration": 500,
                        "target": {
                            "useEventTarget": "CHILDREN",
                            "selector": ".feature-cards_item.border-and-shadow-plum.is-first",
                            "selectorGuids": ["dd2ae3a3-64a7-99a8-7051-b55690481ee8", "7e3462cb-cd5f-c217-d380-909262922499", "1768d81c-9303-aba2-f103-9c4576f371e7"]
                        },
                        "value": 0,
                        "unit": ""
                    }
                }, {
                    "id": "a-13-n-2",
                    "actionTypeId": "TRANSFORM_MOVE",
                    "config": {
                        "delay": 0,
                        "easing": "",
                        "duration": 500,
                        "target": {
                            "useEventTarget": "CHILDREN",
                            "selector": ".feature-cards_item.border-and-shadow-plum",
                            "selectorGuids": ["dd2ae3a3-64a7-99a8-7051-b55690481ee8", "7e3462cb-cd5f-c217-d380-909262922499"]
                        },
                        "yValue": 0,
                        "xUnit": "PX",
                        "yUnit": "rem",
                        "zUnit": "PX"
                    }
                }, {
                    "id": "a-13-n-3",
                    "actionTypeId": "STYLE_OPACITY",
                    "config": {
                        "delay": 0,
                        "easing": "outQuart",
                        "duration": 500,
                        "target": {
                            "useEventTarget": "CHILDREN",
                            "selector": ".feature-cards_item.border-and-shadow-plum",
                            "selectorGuids": ["dd2ae3a3-64a7-99a8-7051-b55690481ee8", "7e3462cb-cd5f-c217-d380-909262922499"]
                        },
                        "value": 0,
                        "unit": ""
                    }
                }, {
                    "id": "a-13-n-4",
                    "actionTypeId": "TRANSFORM_MOVE",
                    "config": {
                        "delay": 0,
                        "easing": "",
                        "duration": 500,
                        "target": {
                            "useEventTarget": "CHILDREN",
                            "selector": ".feature-cards_item.border-and-shadow-plum.is-last",
                            "selectorGuids": ["dd2ae3a3-64a7-99a8-7051-b55690481ee8", "7e3462cb-cd5f-c217-d380-909262922499", "e79fa848-8c7f-893a-791b-b01c15b5df0d"]
                        },
                        "xValue": null,
                        "yValue": 4,
                        "xUnit": "rem",
                        "yUnit": "rem",
                        "zUnit": "PX"
                    }
                }]
            }, {
                "actionItems": [{
                    "id": "a-13-n-5",
                    "actionTypeId": "TRANSFORM_MOVE",
                    "config": {
                        "delay": 0,
                        "easing": "swingTo",
                        "duration": 200,
                        "target": {
                            "useEventTarget": "CHILDREN",
                            "selector": ".feature-cards_item.border-and-shadow-plum",
                            "selectorGuids": ["dd2ae3a3-64a7-99a8-7051-b55690481ee8", "7e3462cb-cd5f-c217-d380-909262922499"]
                        },
                        "yValue": -2,
                        "xUnit": "PX",
                        "yUnit": "rem",
                        "zUnit": "PX"
                    }
                }]
            }, {
                "actionItems": [{
                    "id": "a-13-n-6",
                    "actionTypeId": "TRANSFORM_MOVE",
                    "config": {
                        "delay": 0,
                        "easing": "swingTo",
                        "duration": 400,
                        "target": {
                            "useEventTarget": "CHILDREN",
                            "selector": ".feature-cards_item.border-and-shadow-plum.is-first",
                            "selectorGuids": ["dd2ae3a3-64a7-99a8-7051-b55690481ee8", "7e3462cb-cd5f-c217-d380-909262922499", "1768d81c-9303-aba2-f103-9c4576f371e7"]
                        },
                        "xValue": null,
                        "yValue": 0,
                        "xUnit": "rem",
                        "yUnit": "rem",
                        "zUnit": "PX"
                    }
                }, {
                    "id": "a-13-n-7",
                    "actionTypeId": "TRANSFORM_MOVE",
                    "config": {
                        "delay": 0,
                        "easing": "swingTo",
                        "duration": 400,
                        "target": {
                            "useEventTarget": "CHILDREN",
                            "selector": ".feature-cards_item.border-and-shadow-plum.is-last",
                            "selectorGuids": ["dd2ae3a3-64a7-99a8-7051-b55690481ee8", "7e3462cb-cd5f-c217-d380-909262922499", "e79fa848-8c7f-893a-791b-b01c15b5df0d"]
                        },
                        "xValue": null,
                        "yValue": 0,
                        "xUnit": "rem",
                        "yUnit": "rem",
                        "zUnit": "PX"
                    }
                }, {
                    "id": "a-13-n-8",
                    "actionTypeId": "STYLE_OPACITY",
                    "config": {
                        "delay": 0,
                        "easing": "swingTo",
                        "duration": 500,
                        "target": {
                            "useEventTarget": "CHILDREN",
                            "selector": ".feature-cards_item.border-and-shadow-plum",
                            "selectorGuids": ["dd2ae3a3-64a7-99a8-7051-b55690481ee8", "7e3462cb-cd5f-c217-d380-909262922499"]
                        },
                        "value": 1,
                        "unit": ""
                    }
                }, {
                    "id": "a-13-n-9",
                    "actionTypeId": "TRANSFORM_MOVE",
                    "config": {
                        "delay": 0,
                        "easing": "swingTo",
                        "duration": 300,
                        "target": {
                            "useEventTarget": "CHILDREN",
                            "selector": ".feature-cards_item.border-and-shadow-plum",
                            "selectorGuids": ["dd2ae3a3-64a7-99a8-7051-b55690481ee8", "7e3462cb-cd5f-c217-d380-909262922499"]
                        },
                        "xValue": null,
                        "yValue": 0,
                        "xUnit": "px",
                        "yUnit": "rem",
                        "zUnit": "PX"
                    }
                }, {
                    "id": "a-13-n-11",
                    "actionTypeId": "STYLE_OPACITY",
                    "config": {
                        "delay": 0,
                        "easing": "swingTo",
                        "duration": 300,
                        "target": {
                            "useEventTarget": "CHILDREN",
                            "selector": ".feature-cards_item.border-and-shadow-plum.is-first",
                            "selectorGuids": ["dd2ae3a3-64a7-99a8-7051-b55690481ee8", "7e3462cb-cd5f-c217-d380-909262922499", "1768d81c-9303-aba2-f103-9c4576f371e7"]
                        },
                        "value": 1,
                        "unit": ""
                    }
                }]
            }],
            "useFirstGroupAsInitialState": true,
            "createdOn": 1710948497418
        },
        "a-14": {
            "id": "a-14",
            "title": "CTA Image Bounce In",
            "actionItemGroups": [{
                "actionItems": [{
                    "id": "a-14-n",
                    "actionTypeId": "TRANSFORM_MOVE",
                    "config": {
                        "delay": 0,
                        "easing": "",
                        "duration": 500,
                        "target": {
                            "useEventTarget": true,
                            "id": "65f05b3ab3ea937565a752e0|ca813dd5-7886-970b-a7d0-ba103a198fcf"
                        },
                        "xValue": -10,
                        "yValue": -4,
                        "zValue": null,
                        "xUnit": "rem",
                        "yUnit": "rem",
                        "zUnit": "px"
                    }
                }, {
                    "id": "a-14-n-2",
                    "actionTypeId": "STYLE_OPACITY",
                    "config": {
                        "delay": 0,
                        "easing": "",
                        "duration": 500,
                        "target": {
                            "useEventTarget": true,
                            "id": "65f05b3ab3ea937565a752e0|ca813dd5-7886-970b-a7d0-ba103a198fcf"
                        },
                        "value": 0,
                        "unit": ""
                    }
                }]
            }, {
                "actionItems": [{
                    "id": "a-14-n-3",
                    "actionTypeId": "TRANSFORM_MOVE",
                    "config": {
                        "delay": 0,
                        "easing": "swingTo",
                        "duration": 400,
                        "target": {
                            "useEventTarget": true,
                            "id": "65f05b3ab3ea937565a752e0|ca813dd5-7886-970b-a7d0-ba103a198fcf"
                        },
                        "xValue": 0,
                        "yValue": 0,
                        "xUnit": "rem",
                        "yUnit": "rem",
                        "zUnit": "PX"
                    }
                }, {
                    "id": "a-14-n-4",
                    "actionTypeId": "STYLE_OPACITY",
                    "config": {
                        "delay": 0,
                        "easing": "swingTo",
                        "duration": 400,
                        "target": {
                            "useEventTarget": true,
                            "id": "65f05b3ab3ea937565a752e0|ca813dd5-7886-970b-a7d0-ba103a198fcf"
                        },
                        "value": 1,
                        "unit": ""
                    }
                }]
            }],
            "useFirstGroupAsInitialState": true,
            "createdOn": 1722435291675
        },
        "a-10": {
            "id": "a-10",
            "title": "Feature Image Hinge In From Right",
            "actionItemGroups": [{
                "actionItems": [{
                    "id": "a-10-n",
                    "actionTypeId": "TRANSFORM_ROTATE",
                    "config": {
                        "delay": 0,
                        "easing": "",
                        "duration": 500,
                        "target": {
                            "selector": ".feature-section_image-on-right",
                            "selectorGuids": ["77878f74-6be7-d998-be65-689e8e264220"]
                        },
                        "zValue": 15,
                        "xUnit": "DEG",
                        "yUnit": "DEG",
                        "zUnit": "deg"
                    }
                }, {
                    "id": "a-10-n-2",
                    "actionTypeId": "TRANSFORM_MOVE",
                    "config": {
                        "delay": 0,
                        "easing": "",
                        "duration": 500,
                        "target": {
                            "selector": ".feature-section_image-on-right",
                            "selectorGuids": ["77878f74-6be7-d998-be65-689e8e264220"]
                        },
                        "xValue": 5,
                        "yValue": 2.5,
                        "xUnit": "rem",
                        "yUnit": "rem",
                        "zUnit": "PX"
                    }
                }, {
                    "id": "a-10-n-5",
                    "actionTypeId": "STYLE_OPACITY",
                    "config": {
                        "delay": 0,
                        "easing": "",
                        "duration": 500,
                        "target": {
                            "selector": ".feature-section_image-on-right",
                            "selectorGuids": ["77878f74-6be7-d998-be65-689e8e264220"]
                        },
                        "value": 0,
                        "unit": ""
                    }
                }]
            }, {
                "actionItems": [{
                    "id": "a-10-n-3",
                    "actionTypeId": "TRANSFORM_MOVE",
                    "config": {
                        "delay": 0,
                        "easing": "swingTo",
                        "duration": 400,
                        "target": {
                            "selector": ".feature-section_image-on-right",
                            "selectorGuids": ["77878f74-6be7-d998-be65-689e8e264220"]
                        },
                        "xValue": 0,
                        "yValue": 0,
                        "xUnit": "rem",
                        "yUnit": "rem",
                        "zUnit": "PX"
                    }
                }, {
                    "id": "a-10-n-4",
                    "actionTypeId": "TRANSFORM_ROTATE",
                    "config": {
                        "delay": 0,
                        "easing": "swingTo",
                        "duration": 400,
                        "target": {
                            "selector": ".feature-section_image-on-right",
                            "selectorGuids": ["77878f74-6be7-d998-be65-689e8e264220"]
                        },
                        "zValue": 0,
                        "xUnit": "DEG",
                        "yUnit": "DEG",
                        "zUnit": "deg"
                    }
                }, {
                    "id": "a-10-n-6",
                    "actionTypeId": "STYLE_OPACITY",
                    "config": {
                        "delay": 0,
                        "easing": "swingTo",
                        "duration": 400,
                        "target": {
                            "selector": ".feature-section_image-on-right",
                            "selectorGuids": ["77878f74-6be7-d998-be65-689e8e264220"]
                        },
                        "value": 1,
                        "unit": ""
                    }
                }]
            }],
            "useFirstGroupAsInitialState": true,
            "createdOn": 1710934399306
        }
    },
    "site": {
        "mediaQueries": [{
            "key": "main",
            "min": 992,
            "max": 10000
        }, {
            "key": "medium",
            "min": 768,
            "max": 991
        }, {
            "key": "small",
            "min": 480,
            "max": 767
        }, {
            "key": "tiny",
            "min": 0,
            "max": 479
        }]
    }
});