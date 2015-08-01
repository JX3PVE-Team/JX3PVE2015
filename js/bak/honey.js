! function(e, n) {
	"use strict";

	function t() {}

	function r(e, n) {
		if (e) {
			"object" == typeof e && (e = [].slice.call(e));
			for (var t = 0, r = e.length; r > t; t++) n.call(e, e[t], t)
		}
	}

	function o(e, t) {
		var r = Object.prototype.toString.call(t).slice(8, -1);
		return t !== n && null !== t && r === e
	}

	function a(e) {
		return o("Function", e)
	}

	function u(e) {
		return o("Array", e)
	}

	function i(e) {
		var n = e.split("/"),
			t = n[n.length - 1],
			r = t.indexOf("?");
		return -1 !== r ? t.substring(0, r) : t
	}

	function c(e) {
		e = e || t, e._done || (e(), e._done = 1)
	}

	function l(e) {
		var n = {};
		if ("object" == typeof e)
			for (var t in e) e[t] && (n = {
				name: t,
				url: e[t]
			});
		else n = {
			name: i(e),
			url: e
		};
		var r = b[n.name];
		return r && r.url === n.url ? r : (b[n.name] = n, n)
	}

	function s(e) {
		e = e || b;
		for (var n in e)
			if (e.hasOwnProperty(n) && e[n].state !== k) return !1;
		return !0
	}

	function f(e) {
		e.state = A, r(e.onpreload, function(e) {
			e.call()
		})
	}

	function d(e, t) {
		e.state === n && (e.state = w, e.onpreload = [], m({
			url: e.url,
			type: "cache"
		}, function() {
			f(e)
		}))
	}

	function h(e, n) {
		return n = n || t, e.state === k ? void n() : e.state === R ? void M.ready(e.name, n) : e.state === w ? void e.onpreload.push(function() {
			h(e, n)
		}) : (e.state = R, void m(e, function() {
			e.state = k, n(), r(T[e.name], function(e) {
				c(e)
			}), g && s() && r(T.ALL, function(e) {
				c(e)
			})
		}))
	}

	function m(n, r) {
		function o(n) {
			n = n || e.event, u.onload = u.onreadystatechange = u.onerror = null, r()
		}

		function a(n) {
			n = n || e.event, ("load" === n.type || /loaded|complete/.test(u.readyState) && (!E.documentMode || E.documentMode < 9)) && (u.onload = u.onreadystatechange = u.onerror = null, r())
		}
		r = r || t;
		var u;
		/\.css[^\.]*$/.test(n.url) ? (u = E.createElement("link"), u.type = "text/" + (n.type || "css"), u.rel = "stylesheet", u.href = n.url) : (u = E.createElement("script"), u.type = "text/" + (n.type || "javascript"), u.src = n.url), u.onload = u.onreadystatechange = a, u.onerror = o, u.async = !1, u.defer = !1;
		var i = E.head || E.getElementsByTagName("head")[0];
		i.insertBefore(u, i.lastChild)
	}

	function v() {
		return E.body ? void(g || (g = !0, r(O, function(e) {
			c(e)
		}))) : (e.clearTimeout(M.readyTimeout), void(M.readyTimeout = e.setTimeout(v, 50)))
	}

	function p() {
		E.addEventListener ? (E.removeEventListener("DOMContentLoaded", p, !1), v()) : "complete" === E.readyState && (E.detachEvent("onreadystatechange", p), v())
	}
	var y, g, E = e.document,
		O = [],
		L = [],
		T = {},
		b = {},
		S = "async" in E.createElement("script") || "MozAppearance" in E.documentElement.style || e.opera,
		j = e.head_conf && e.head_conf.head || "head",
		M = e[j] = e[j] || function() {
			M.ready.apply(null, arguments)
		},
		w = 1,
		A = 2,
		R = 3,
		k = 4;
	if (S ? M.load = function() {
		var e = arguments,
			n = e[e.length - 1],
			t = {};
		return a(n) || (n = null), r(e, function(r, o) {
			r !== n && (r = l(r), t[r.name] = r, h(r, n && o === e.length - 2 ? function() {
				s(t) && c(n)
			} : null))
		}), M
	} : M.load = function() {
		var e = arguments,
			n = [].slice.call(e, 1),
			t = n[0];
		return y ? (t ? (r(n, function(e) {
			a(e) || d(l(e))
		}), h(l(e[0]), a(t) ? t : function() {
			M.load.apply(null, n)
		})) : h(l(e[0])), M) : (L.push(function() {
			M.load.apply(null, e)
		}), M)
	}, M.js = M.load, M.test = function(e, n, r, o) {
		var a = "object" == typeof e ? e : {
				test: e,
				success: n ? u(n) ? n : [n] : !1,
				failure: r ? u(r) ? r : [r] : !1,
				callback: o || t
			},
			i = !!a.test;
		return i && a.success ? (a.success.push(a.callback), M.load.apply(null, a.success)) : !i && a.failure ? (a.failure.push(a.callback), M.load.apply(null, a.failure)) : o(), M
	}, M.ready = function(e, n) {
		if (e === E) return g ? c(n) : O.push(n), M;
		if (a(e) && (n = e, e = "ALL"), "string" != typeof e || !a(n)) return M;
		var t = b[e];
		if (t && t.state === k || "ALL" === e && s() && g) return c(n), M;
		var r = T[e];
		return r ? r.push(n) : r = T[e] = [n], M
	}, M.ready(E, function() {
		s() && r(T.ALL, function(e) {
			c(e)
		}), M.feature && M.feature("domloaded", !0)
	}), "complete" === E.readyState) v();
	else if (E.addEventListener) E.addEventListener("DOMContentLoaded", p, !1), e.addEventListener("load", v, !1);
	else {
		E.attachEvent("onreadystatechange", p), e.attachEvent("onload", v);
		var B = !1;
		try {
			B = null == e.frameElement && E.documentElement
		} catch (C) {}
		B && B.doScroll && ! function _() {
			if (!g) {
				try {
					B.doScroll("left")
				} catch (n) {
					return e.clearTimeout(M.readyTimeout), void(M.readyTimeout = e.setTimeout(_, 50))
				}
				v()
			}
		}()
	}
	setTimeout(function() {
		y = !0, r(L, function(e) {
			e()
		})
	}, 300)
}(window),
function(e, n, t) {
	function r(e) {
		var n = o.trim(e),
			t = n.indexOf(":") > 0,
			r = t ? PUBROOT : ROOT,
			a = {},
			u = n.split(t ? ":" : "_");
		"package" === u[0] && (window.package_name = u[1]);
		var i = u[0] + "/" + u[1] + (DEV ? ".source" : "") + ".js";
		return i = r + "/" + i + "?v" + VERSION, i = i.replace(/([^:])\/\//g, "$1/"), a[n] = i, a
	}
	var o = function() {
			this.version = "2.1.0"
		},
		a = e.location.hash.match(/\bdebug\b/);
	o.go = function(n, t) {
		var u = n.split(","),
			i = t || null,
			c = [];
		for (!a && !DEV || e.console || u.splice(0, 0, "lib:debug"); u.length;) c.push(r(u.shift()));
		return i && c.push(i), head.js.apply(e, c), o
	}, o.ready = head.ready, o.load = head.load, o.config = function(n, r) {
		if (o.isString(n) && o.isString(r)) return e[n] = r, o;
		if (r === t && !o.isString(n)) {
			for (var a in n) e[a] = n[a];
			return o
		}
	}, o.def = function(e, n) {
		if (1 == arguments.length) return n = e, e = "", n(o);
		var t = (e.split(","), function() {
			return n(o)
		});
		t()
	}, o.trim = function(e) {
		return e.replace(/^\s+|\s+$/g, "")
	}, o.ie = function() {
		for (var e, n = 3, t = document.createElement("div"), r = t.getElementsByTagName("i"); t.innerHTML = "<!--[if gt IE " + ++n + "]><i></i><![endif]-->", r[0];);
		return n > 4 ? n : e
	}(), o.inArray = function(e, n) {
		for (var t = 0; t < n.length; t++)
			if (n[t] == e) return t;
		return -1
	}, o.isString = function(e) {
		return "string" == typeof e
	}, o.random = function(e, n) {
		return (n - e) * Math.random() + e
	}, o.css = function(e) {
		head.js(e)
	}, o.delegate = function(e) {
		return function(n) {
			var t = n || window.event,
				r = $(t.target || t.srcElement);
			for (var o in e)
				if (r.is(o)) return e[o].apply(r, $.makeArray(arguments))
		}
	}, o.debug = e.console ? console.log : function() {}, e.H = e.Honey = e.honey = e.HN = o
}(window, document);