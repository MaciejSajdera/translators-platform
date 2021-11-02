jQuery(document).ready(function($) {
	// ProgressBar.js 1.1.0
	// https://kimmobrunfeldt.github.io/progressbar.js
	// License: MIT

	(function(f) {
		if (typeof exports === "object" && typeof module !== "undefined") {
			module.exports = f();
		} else if (typeof define === "function" && define.amd) {
			define([], f);
		} else {
			var g;
			if (typeof window !== "undefined") {
				g = window;
			} else if (typeof global !== "undefined") {
				g = global;
			} else if (typeof self !== "undefined") {
				g = self;
			} else {
				g = this;
			}
			g.ProgressBar = f();
		}
	})(function() {
		var define, module, exports;
		return (function() {
			function r(e, n, t) {
				function o(i, f) {
					if (!n[i]) {
						if (!e[i]) {
							var c = "function" == typeof require && require;
							if (!f && c) return c(i, !0);
							if (u) return u(i, !0);
							var a = new Error("Cannot find module '" + i + "'");
							throw ((a.code = "MODULE_NOT_FOUND"), a);
						}
						var p = (n[i] = { exports: {} });
						e[i][0].call(
							p.exports,
							function(r) {
								var n = e[i][1][r];
								return o(n || r);
							},
							p,
							p.exports,
							r,
							e,
							n,
							t
						);
					}
					return n[i].exports;
				}
				for (
					var u = "function" == typeof require && require, i = 0;
					i < t.length;
					i++
				)
					o(t[i]);
				return o;
			}
			return r;
		})()(
			{
				1: [
					function(require, module, exports) {
						/*! Shifty 2.8.0 - https://github.com/jeremyckahn/shifty */
						!(function(t, n) {
							"object" == typeof exports && "object" == typeof module
								? (module.exports = n())
								: "function" == typeof define && define.amd
								? define("shifty", [], n)
								: "object" == typeof exports
								? (exports.shifty = n())
								: (t.shifty = n());
						})(window, function() {
							return (function(t) {
								var n = {};
								function e(r) {
									if (n[r]) return n[r].exports;
									var i = (n[r] = { i: r, l: !1, exports: {} });
									return (
										t[r].call(i.exports, i, i.exports, e), (i.l = !0), i.exports
									);
								}
								return (
									(e.m = t),
									(e.c = n),
									(e.d = function(t, n, r) {
										e.o(t, n) ||
											Object.defineProperty(t, n, { enumerable: !0, get: r });
									}),
									(e.r = function(t) {
										"undefined" != typeof Symbol &&
											Symbol.toStringTag &&
											Object.defineProperty(t, Symbol.toStringTag, {
												value: "Module"
											}),
											Object.defineProperty(t, "__esModule", { value: !0 });
									}),
									(e.t = function(t, n) {
										if ((1 & n && (t = e(t)), 8 & n)) return t;
										if (4 & n && "object" == typeof t && t && t.__esModule)
											return t;
										var r = Object.create(null);
										if (
											(e.r(r),
											Object.defineProperty(r, "default", {
												enumerable: !0,
												value: t
											}),
											2 & n && "string" != typeof t)
										)
											for (var i in t)
												e.d(
													r,
													i,
													function(n) {
														return t[n];
													}.bind(null, i)
												);
										return r;
									}),
									(e.n = function(t) {
										var n =
											t && t.__esModule
												? function() {
														return t.default;
												  }
												: function() {
														return t;
												  };
										return e.d(n, "a", n), n;
									}),
									(e.o = function(t, n) {
										return Object.prototype.hasOwnProperty.call(t, n);
									}),
									(e.p = ""),
									e((e.s = 3))
								);
							})([
								function(t, n, e) {
									"use strict";
									(function(t) {
										e.d(n, "e", function() {
											return d;
										}),
											e.d(n, "c", function() {
												return y;
											}),
											e.d(n, "b", function() {
												return _;
											}),
											e.d(n, "a", function() {
												return g;
											}),
											e.d(n, "d", function() {
												return w;
											});
										var r = e(1);
										function i(t, n) {
											for (var e = 0; e < n.length; e++) {
												var r = n[e];
												(r.enumerable = r.enumerable || !1),
													(r.configurable = !0),
													"value" in r && (r.writable = !0),
													Object.defineProperty(t, r.key, r);
											}
										}
										function u(t) {
											return (u =
												"function" == typeof Symbol &&
												"symbol" == typeof Symbol.iterator
													? function(t) {
															return typeof t;
													  }
													: function(t) {
															return t &&
																"function" == typeof Symbol &&
																t.constructor === Symbol &&
																t !== Symbol.prototype
																? "symbol"
																: typeof t;
													  })(t);
										}
										function o(t) {
											for (var n = 1; n < arguments.length; n++) {
												var e = null != arguments[n] ? arguments[n] : {},
													r = Object.keys(e);
												"function" == typeof Object.getOwnPropertySymbols &&
													(r = r.concat(
														Object.getOwnPropertySymbols(e).filter(function(t) {
															return Object.getOwnPropertyDescriptor(
																e,
																t
															).enumerable;
														})
													)),
													r.forEach(function(n) {
														a(t, n, e[n]);
													});
											}
											return t;
										}
										function a(t, n, e) {
											return (
												n in t
													? Object.defineProperty(t, n, {
															value: e,
															enumerable: !0,
															configurable: !0,
															writable: !0
													  })
													: (t[n] = e),
												t
											);
										}
										var c = "undefined" != typeof window ? window : t,
											f =
												c.requestAnimationFrame ||
												c.webkitRequestAnimationFrame ||
												c.oRequestAnimationFrame ||
												c.msRequestAnimationFrame ||
												(c.mozCancelRequestAnimationFrame &&
													c.mozRequestAnimationFrame) ||
												setTimeout,
											s = function() {},
											l = null,
											h = null,
											p = o({}, r),
											d = function(t, n, e, r, i, u, o) {
												var a = t < u ? 0 : (t - u) / i;
												for (var c in n) {
													var f = o[c],
														s = f.call ? f : p[f],
														l = e[c];
													n[c] = l + (r[c] - l) * s(a);
												}
												return n;
											},
											v = function(t, n) {
												var e = t._attachment,
													r = t._currentState,
													i = t._delay,
													u = t._easing,
													o = t._originalState,
													a = t._duration,
													c = t._step,
													f = t._targetState,
													s = t._timestamp,
													l = s + i + a,
													h = n > l ? l : n,
													p = a - (l - h);
												h >= l
													? (c(f, e, p), t.stop(!0))
													: (t._applyFilter("beforeTween"),
													  h < s + i ? ((h = 1), (a = 1), (s = 1)) : (s += i),
													  d(h, r, o, f, a, s, u),
													  t._applyFilter("afterTween"),
													  c(r, e, p));
											},
											y = function() {
												for (var t = g.now(), n = l; n; ) {
													var e = n._next;
													v(n, t), (n = e);
												}
											},
											_ = function(t) {
												var n =
														arguments.length > 1 && void 0 !== arguments[1]
															? arguments[1]
															: "linear",
													e = {},
													r = u(n);
												if ("string" === r || "function" === r)
													for (var i in t) e[i] = n;
												else for (var o in t) e[o] = n[o] || "linear";
												return e;
											},
											m = function(t) {
												if (t === l)
													(l = t._next) ? (l._previous = null) : (h = null);
												else if (t === h)
													(h = t._previous) ? (h._next = null) : (l = null);
												else {
													var n = t._previous,
														e = t._next;
													(n._next = e), (e._previous = n);
												}
												t._previous = t._next = null;
											},
											g = (function() {
												function t() {
													var n =
															arguments.length > 0 && void 0 !== arguments[0]
																? arguments[0]
																: {},
														e =
															arguments.length > 1 && void 0 !== arguments[1]
																? arguments[1]
																: void 0;
													!(function(t, n) {
														if (!(t instanceof n))
															throw new TypeError(
																"Cannot call a class as a function"
															);
													})(this, t),
														(this._currentState = n),
														(this._configured = !1),
														(this._filters = []),
														(this._timestamp = null),
														(this._next = null),
														(this._previous = null),
														e && this.setConfig(e);
												}
												var n, e, r;
												return (
													(n = t),
													(e = [
														{
															key: "_applyFilter",
															value: function(t) {
																var n = !0,
																	e = !1,
																	r = void 0;
																try {
																	for (
																		var i, u = this._filters[Symbol.iterator]();
																		!(n = (i = u.next()).done);
																		n = !0
																	) {
																		var o = i.value[t];
																		o && o(this);
																	}
																} catch (t) {
																	(e = !0), (r = t);
																} finally {
																	try {
																		n || null == u.return || u.return();
																	} finally {
																		if (e) throw r;
																	}
																}
															}
														},
														{
															key: "tween",
															value: function() {
																var n =
																		arguments.length > 0 &&
																		void 0 !== arguments[0]
																			? arguments[0]
																			: void 0,
																	e = this._attachment,
																	r = this._configured;
																return (
																	(!n && r) || this.setConfig(n),
																	(this._pausedAtTime = null),
																	(this._timestamp = t.now()),
																	this._start(this.get(), e),
																	this.resume()
																);
															}
														},
														{
															key: "setConfig",
															value: function() {
																var n = this,
																	e =
																		arguments.length > 0 &&
																		void 0 !== arguments[0]
																			? arguments[0]
																			: {},
																	r = e.attachment,
																	i = e.delay,
																	u = void 0 === i ? 0 : i,
																	a = e.duration,
																	c = void 0 === a ? 500 : a,
																	f = e.easing,
																	l = e.from,
																	h = e.promise,
																	p = void 0 === h ? Promise : h,
																	d = e.start,
																	v = void 0 === d ? s : d,
																	y = e.step,
																	m = void 0 === y ? s : y,
																	g = e.to;
																(this._configured = !0),
																	(this._attachment = r),
																	(this._isPlaying = !1),
																	(this._pausedAtTime = null),
																	(this._scheduleId = null),
																	(this._delay = u),
																	(this._start = v),
																	(this._step = m),
																	(this._duration = c),
																	(this._currentState = o({}, l || this.get())),
																	(this._originalState = this.get()),
																	(this._targetState = o({}, g || this.get()));
																var w = this._currentState;
																(this._targetState = o(
																	{},
																	w,
																	this._targetState
																)),
																	(this._easing = _(w, f));
																var b = t.filters;
																for (var S in ((this._filters.length = 0), b))
																	b[S].doesApply(this) &&
																		this._filters.push(b[S]);
																return (
																	this._applyFilter("tweenCreated"),
																	(this._promise = new p(function(t, e) {
																		(n._resolve = t), (n._reject = e);
																	})),
																	this._promise.catch(s),
																	this
																);
															}
														},
														{
															key: "get",
															value: function() {
																return o({}, this._currentState);
															}
														},
														{
															key: "set",
															value: function(t) {
																this._currentState = t;
															}
														},
														{
															key: "pause",
															value: function() {
																if (this._isPlaying)
																	return (
																		(this._pausedAtTime = t.now()),
																		(this._isPlaying = !1),
																		m(this),
																		this
																	);
															}
														},
														{
															key: "resume",
															value: function() {
																if (null === this._timestamp)
																	return this.tween();
																if (this._isPlaying) return this._promise;
																var n = t.now();
																return (
																	this._pausedAtTime &&
																		((this._timestamp +=
																			n - this._pausedAtTime),
																		(this._pausedAtTime = null)),
																	(this._isPlaying = !0),
																	null === l
																		? ((l = this),
																		  (h = this),
																		  (function t() {
																				l && (f.call(c, t, 1e3 / 60), y());
																		  })())
																		: ((this._previous = h),
																		  (h._next = this),
																		  (h = this)),
																	this._promise
																);
															}
														},
														{
															key: "seek",
															value: function(n) {
																n = Math.max(n, 0);
																var e = t.now();
																return this._timestamp + n === 0
																	? this
																	: ((this._timestamp = e - n),
																	  this._isPlaying || v(this, e),
																	  this);
															}
														},
														{
															key: "stop",
															value: function() {
																var t =
																		arguments.length > 0 &&
																		void 0 !== arguments[0] &&
																		arguments[0],
																	n = this._attachment,
																	e = this._currentState,
																	r = this._easing,
																	i = this._originalState,
																	u = this._targetState;
																if (this._isPlaying)
																	return (
																		(this._isPlaying = !1),
																		m(this),
																		t
																			? (this._applyFilter("beforeTween"),
																			  d(1, e, i, u, 1, 0, r),
																			  this._applyFilter("afterTween"),
																			  this._applyFilter("afterTweenEnd"),
																			  this._resolve(e, n))
																			: this._reject(e, n),
																		this
																	);
															}
														},
														{
															key: "isPlaying",
															value: function() {
																return this._isPlaying;
															}
														},
														{
															key: "setScheduleFunction",
															value: function(n) {
																t.setScheduleFunction(n);
															}
														},
														{
															key: "dispose",
															value: function() {
																for (var t in this) delete this[t];
															}
														}
													]) && i(n.prototype, e),
													r && i(n, r),
													t
												);
											})();
										function w() {
											var t =
													arguments.length > 0 && void 0 !== arguments[0]
														? arguments[0]
														: {},
												n = new g(),
												e = n.tween(t);
											return (e.tweenable = n), e;
										}
										(g.setScheduleFunction = function(t) {
											return (f = t);
										}),
											(g.formulas = p),
											(g.filters = {}),
											(g.now =
												Date.now ||
												function() {
													return +new Date();
												});
									}.call(this, e(2)));
								},
								function(t, n, e) {
									"use strict";
									e.r(n),
										e.d(n, "linear", function() {
											return r;
										}),
										e.d(n, "easeInQuad", function() {
											return i;
										}),
										e.d(n, "easeOutQuad", function() {
											return u;
										}),
										e.d(n, "easeInOutQuad", function() {
											return o;
										}),
										e.d(n, "easeInCubic", function() {
											return a;
										}),
										e.d(n, "easeOutCubic", function() {
											return c;
										}),
										e.d(n, "easeInOutCubic", function() {
											return f;
										}),
										e.d(n, "easeInQuart", function() {
											return s;
										}),
										e.d(n, "easeOutQuart", function() {
											return l;
										}),
										e.d(n, "easeInOutQuart", function() {
											return h;
										}),
										e.d(n, "easeInQuint", function() {
											return p;
										}),
										e.d(n, "easeOutQuint", function() {
											return d;
										}),
										e.d(n, "easeInOutQuint", function() {
											return v;
										}),
										e.d(n, "easeInSine", function() {
											return y;
										}),
										e.d(n, "easeOutSine", function() {
											return _;
										}),
										e.d(n, "easeInOutSine", function() {
											return m;
										}),
										e.d(n, "easeInExpo", function() {
											return g;
										}),
										e.d(n, "easeOutExpo", function() {
											return w;
										}),
										e.d(n, "easeInOutExpo", function() {
											return b;
										}),
										e.d(n, "easeInCirc", function() {
											return S;
										}),
										e.d(n, "easeOutCirc", function() {
											return O;
										}),
										e.d(n, "easeInOutCirc", function() {
											return M;
										}),
										e.d(n, "easeOutBounce", function() {
											return k;
										}),
										e.d(n, "easeInBack", function() {
											return j;
										}),
										e.d(n, "easeOutBack", function() {
											return P;
										}),
										e.d(n, "easeInOutBack", function() {
											return x;
										}),
										e.d(n, "elastic", function() {
											return T;
										}),
										e.d(n, "swingFromTo", function() {
											return F;
										}),
										e.d(n, "swingFrom", function() {
											return A;
										}),
										e.d(n, "swingTo", function() {
											return E;
										}),
										e.d(n, "bounce", function() {
											return I;
										}),
										e.d(n, "bouncePast", function() {
											return C;
										}),
										e.d(n, "easeFromTo", function() {
											return q;
										}),
										e.d(n, "easeFrom", function() {
											return Q;
										}),
										e.d(n, "easeTo", function() {
											return D;
										});
									/*!
									 * All equations are adapted from Thomas Fuchs'
									 * [Scripty2](https://github.com/madrobby/scripty2/blob/master/src/effects/transitions/penner.js).
									 *
									 * Based on Easing Equations (c) 2003 [Robert
									 * Penner](http://www.robertpenner.com/), all rights reserved. This work is
									 * [subject to terms](http://www.robertpenner.com/easing_terms_of_use.html).
									 */
									/*!
									 *  TERMS OF USE - EASING EQUATIONS
									 *  Open source under the BSD License.
									 *  Easing Equations (c) 2003 Robert Penner, all rights reserved.
									 */
									var r = function(t) {
											return t;
										},
										i = function(t) {
											return Math.pow(t, 2);
										},
										u = function(t) {
											return -(Math.pow(t - 1, 2) - 1);
										},
										o = function(t) {
											return (t /= 0.5) < 1
												? 0.5 * Math.pow(t, 2)
												: -0.5 * ((t -= 2) * t - 2);
										},
										a = function(t) {
											return Math.pow(t, 3);
										},
										c = function(t) {
											return Math.pow(t - 1, 3) + 1;
										},
										f = function(t) {
											return (t /= 0.5) < 1
												? 0.5 * Math.pow(t, 3)
												: 0.5 * (Math.pow(t - 2, 3) + 2);
										},
										s = function(t) {
											return Math.pow(t, 4);
										},
										l = function(t) {
											return -(Math.pow(t - 1, 4) - 1);
										},
										h = function(t) {
											return (t /= 0.5) < 1
												? 0.5 * Math.pow(t, 4)
												: -0.5 * ((t -= 2) * Math.pow(t, 3) - 2);
										},
										p = function(t) {
											return Math.pow(t, 5);
										},
										d = function(t) {
											return Math.pow(t - 1, 5) + 1;
										},
										v = function(t) {
											return (t /= 0.5) < 1
												? 0.5 * Math.pow(t, 5)
												: 0.5 * (Math.pow(t - 2, 5) + 2);
										},
										y = function(t) {
											return 1 - Math.cos(t * (Math.PI / 2));
										},
										_ = function(t) {
											return Math.sin(t * (Math.PI / 2));
										},
										m = function(t) {
											return -0.5 * (Math.cos(Math.PI * t) - 1);
										},
										g = function(t) {
											return 0 === t ? 0 : Math.pow(2, 10 * (t - 1));
										},
										w = function(t) {
											return 1 === t ? 1 : 1 - Math.pow(2, -10 * t);
										},
										b = function(t) {
											return 0 === t
												? 0
												: 1 === t
												? 1
												: (t /= 0.5) < 1
												? 0.5 * Math.pow(2, 10 * (t - 1))
												: 0.5 * (2 - Math.pow(2, -10 * --t));
										},
										S = function(t) {
											return -(Math.sqrt(1 - t * t) - 1);
										},
										O = function(t) {
											return Math.sqrt(1 - Math.pow(t - 1, 2));
										},
										M = function(t) {
											return (t /= 0.5) < 1
												? -0.5 * (Math.sqrt(1 - t * t) - 1)
												: 0.5 * (Math.sqrt(1 - (t -= 2) * t) + 1);
										},
										k = function(t) {
											return t < 1 / 2.75
												? 7.5625 * t * t
												: t < 2 / 2.75
												? 7.5625 * (t -= 1.5 / 2.75) * t + 0.75
												: t < 2.5 / 2.75
												? 7.5625 * (t -= 2.25 / 2.75) * t + 0.9375
												: 7.5625 * (t -= 2.625 / 2.75) * t + 0.984375;
										},
										j = function(t) {
											var n = 1.70158;
											return t * t * ((n + 1) * t - n);
										},
										P = function(t) {
											var n = 1.70158;
											return (t -= 1) * t * ((n + 1) * t + n) + 1;
										},
										x = function(t) {
											var n = 1.70158;
											return (t /= 0.5) < 1
												? t * t * ((1 + (n *= 1.525)) * t - n) * 0.5
												: 0.5 *
														((t -= 2) * t * ((1 + (n *= 1.525)) * t + n) + 2);
										},
										T = function(t) {
											return (
												-1 *
													Math.pow(4, -8 * t) *
													Math.sin(((6 * t - 1) * (2 * Math.PI)) / 2) +
												1
											);
										},
										F = function(t) {
											var n = 1.70158;
											return (t /= 0.5) < 1
												? t * t * ((1 + (n *= 1.525)) * t - n) * 0.5
												: 0.5 *
														((t -= 2) * t * ((1 + (n *= 1.525)) * t + n) + 2);
										},
										A = function(t) {
											var n = 1.70158;
											return t * t * ((n + 1) * t - n);
										},
										E = function(t) {
											var n = 1.70158;
											return (t -= 1) * t * ((n + 1) * t + n) + 1;
										},
										I = function(t) {
											return t < 1 / 2.75
												? 7.5625 * t * t
												: t < 2 / 2.75
												? 7.5625 * (t -= 1.5 / 2.75) * t + 0.75
												: t < 2.5 / 2.75
												? 7.5625 * (t -= 2.25 / 2.75) * t + 0.9375
												: 7.5625 * (t -= 2.625 / 2.75) * t + 0.984375;
										},
										C = function(t) {
											return t < 1 / 2.75
												? 7.5625 * t * t
												: t < 2 / 2.75
												? 2 - (7.5625 * (t -= 1.5 / 2.75) * t + 0.75)
												: t < 2.5 / 2.75
												? 2 - (7.5625 * (t -= 2.25 / 2.75) * t + 0.9375)
												: 2 - (7.5625 * (t -= 2.625 / 2.75) * t + 0.984375);
										},
										q = function(t) {
											return (t /= 0.5) < 1
												? 0.5 * Math.pow(t, 4)
												: -0.5 * ((t -= 2) * Math.pow(t, 3) - 2);
										},
										Q = function(t) {
											return Math.pow(t, 4);
										},
										D = function(t) {
											return Math.pow(t, 0.25);
										};
								},
								function(t, n) {
									var e;
									e = (function() {
										return this;
									})();
									try {
										e = e || new Function("return this")();
									} catch (t) {
										"object" == typeof window && (e = window);
									}
									t.exports = e;
								},
								function(t, n, e) {
									"use strict";
									e.r(n);
									var r = {};
									e.r(r),
										e.d(r, "doesApply", function() {
											return x;
										}),
										e.d(r, "tweenCreated", function() {
											return T;
										}),
										e.d(r, "beforeTween", function() {
											return F;
										}),
										e.d(r, "afterTween", function() {
											return A;
										});
									var i,
										u,
										o = e(0),
										a = /(\d|-|\.)/,
										c = /([^\-0-9.]+)/g,
										f = /[0-9.-]+/g,
										s =
											((i = f.source),
											(u = /,\s*/.source),
											new RegExp(
												"rgb\\("
													.concat(i)
													.concat(u)
													.concat(i)
													.concat(u)
													.concat(i, "\\)"),
												"g"
											)),
										l = /^.*\(/,
										h = /#([0-9]|[a-f]){3,6}/gi,
										p = function(t, n) {
											return t.map(function(t, e) {
												return "_".concat(n, "_").concat(e);
											});
										};
									function d(t) {
										return parseInt(t, 16);
									}
									var v = function(t) {
											return "rgb(".concat(
												((n = t),
												3 === (n = n.replace(/#/, "")).length &&
													(n =
														(n = n.split(""))[0] +
														n[0] +
														n[1] +
														n[1] +
														n[2] +
														n[2]),
												[
													d(n.substr(0, 2)),
													d(n.substr(2, 2)),
													d(n.substr(4, 2))
												]).join(","),
												")"
											);
											var n;
										},
										y = function(t, n, e) {
											var r = n.match(t),
												i = n.replace(t, "VAL");
											return (
												r &&
													r.forEach(function(t) {
														return (i = i.replace("VAL", e(t)));
													}),
												i
											);
										},
										_ = function(t) {
											for (var n in t) {
												var e = t[n];
												"string" == typeof e &&
													e.match(h) &&
													(t[n] = y(h, e, v));
											}
										},
										m = function(t) {
											var n = t.match(f).map(Math.floor),
												e = t.match(l)[0];
											return "".concat(e).concat(n.join(","), ")");
										},
										g = function(t) {
											return t.match(f);
										},
										w = function(t) {
											var n,
												e,
												r = {};
											for (var i in t) {
												var u = t[i];
												"string" == typeof u &&
													(r[i] = {
														formatString:
															((n = u),
															(e = void 0),
															(e = n.match(c)),
															e
																? (1 === e.length || n.charAt(0).match(a)) &&
																  e.unshift("")
																: (e = ["", ""]),
															e.join("VAL")),
														chunkNames: p(g(u), i)
													});
											}
											return r;
										},
										b = function(t, n) {
											var e = function(e) {
												g(t[e]).forEach(function(r, i) {
													return (t[n[e].chunkNames[i]] = +r);
												}),
													delete t[e];
											};
											for (var r in n) e(r);
										},
										S = function(t, n) {
											var e = {};
											return (
												n.forEach(function(n) {
													(e[n] = t[n]), delete t[n];
												}),
												e
											);
										},
										O = function(t, n) {
											return n.map(function(n) {
												return t[n];
											});
										},
										M = function(t, n) {
											return (
												n.forEach(function(n) {
													return (t = t.replace("VAL", +n.toFixed(4)));
												}),
												t
											);
										},
										k = function(t, n) {
											for (var e in n) {
												var r = n[e],
													i = r.chunkNames,
													u = r.formatString,
													o = M(u, O(S(t, i), i));
												t[e] = y(s, o, m);
											}
										},
										j = function(t, n) {
											var e = function(e) {
												var r = n[e].chunkNames,
													i = t[e];
												if ("string" == typeof i) {
													var u = i.split(" "),
														o = u[u.length - 1];
													r.forEach(function(n, e) {
														return (t[n] = u[e] || o);
													});
												} else
													r.forEach(function(n) {
														return (t[n] = i);
													});
												delete t[e];
											};
											for (var r in n) e(r);
										},
										P = function(t, n) {
											for (var e in n) {
												var r = n[e].chunkNames,
													i = t[r[0]];
												t[e] =
													"string" == typeof i
														? r
																.map(function(n) {
																	var e = t[n];
																	return delete t[n], e;
																})
																.join(" ")
														: i;
											}
										},
										x = function(t) {
											var n = t._currentState;
											return Object.keys(n).some(function(t) {
												return "string" == typeof n[t];
											});
										};
									function T(t) {
										var n = t._currentState;
										[n, t._originalState, t._targetState].forEach(_),
											(t._tokenData = w(n));
									}
									function F(t) {
										var n = t._currentState,
											e = t._originalState,
											r = t._targetState,
											i = t._easing,
											u = t._tokenData;
										j(i, u),
											[n, e, r].forEach(function(t) {
												return b(t, u);
											});
									}
									function A(t) {
										var n = t._currentState,
											e = t._originalState,
											r = t._targetState,
											i = t._easing,
											u = t._tokenData;
										[n, e, r].forEach(function(t) {
											return k(t, u);
										}),
											P(i, u);
									}
									function E(t, n, e) {
										return (
											n in t
												? Object.defineProperty(t, n, {
														value: e,
														enumerable: !0,
														configurable: !0,
														writable: !0
												  })
												: (t[n] = e),
											t
										);
									}
									var I = new o.a(),
										C = o.a.filters,
										q = function(t, n, e, r) {
											var i =
													arguments.length > 4 && void 0 !== arguments[4]
														? arguments[4]
														: 0,
												u = (function(t) {
													for (var n = 1; n < arguments.length; n++) {
														var e = null != arguments[n] ? arguments[n] : {},
															r = Object.keys(e);
														"function" == typeof Object.getOwnPropertySymbols &&
															(r = r.concat(
																Object.getOwnPropertySymbols(e).filter(function(
																	t
																) {
																	return Object.getOwnPropertyDescriptor(e, t)
																		.enumerable;
																})
															)),
															r.forEach(function(n) {
																E(t, n, e[n]);
															});
													}
													return t;
												})({}, t),
												a = Object(o.b)(t, r);
											for (var c in ((I._filters.length = 0),
											I.set({}),
											(I._currentState = u),
											(I._originalState = t),
											(I._targetState = n),
											(I._easing = a),
											C))
												C[c].doesApply(I) && I._filters.push(C[c]);
											I._applyFilter("tweenCreated"),
												I._applyFilter("beforeTween");
											var f = Object(o.e)(e, u, t, n, 1, i, a);
											return I._applyFilter("afterTween"), f;
										};
									function Q(t) {
										return (
											(function(t) {
												if (Array.isArray(t)) {
													for (
														var n = 0, e = new Array(t.length);
														n < t.length;
														n++
													)
														e[n] = t[n];
													return e;
												}
											})(t) ||
											(function(t) {
												if (
													Symbol.iterator in Object(t) ||
													"[object Arguments]" ===
														Object.prototype.toString.call(t)
												)
													return Array.from(t);
											})(t) ||
											(function() {
												throw new TypeError(
													"Invalid attempt to spread non-iterable instance"
												);
											})()
										);
									}
									function D(t, n) {
										for (var e = 0; e < n.length; e++) {
											var r = n[e];
											(r.enumerable = r.enumerable || !1),
												(r.configurable = !0),
												"value" in r && (r.writable = !0),
												Object.defineProperty(t, r.key, r);
										}
									}
									function B(t, n) {
										if (!n.has(t))
											throw new TypeError(
												"attempted to get private field on non-instance"
											);
										var e = n.get(t);
										return e.get ? e.get.call(t) : e.value;
									}
									var N = (function() {
											function t() {
												!(function(t, n) {
													if (!(t instanceof n))
														throw new TypeError(
															"Cannot call a class as a function"
														);
												})(this, t),
													R.set(this, { writable: !0, value: [] });
												for (
													var n = arguments.length, e = new Array(n), r = 0;
													r < n;
													r++
												)
													e[r] = arguments[r];
												e.forEach(this.add.bind(this));
											}
											var n, e, r;
											return (
												(n = t),
												(e = [
													{
														key: "add",
														value: function(t) {
															return B(this, R).push(t), t;
														}
													},
													{
														key: "remove",
														value: function(t) {
															var n = B(this, R).indexOf(t);
															return ~n && B(this, R).splice(n, 1), t;
														}
													},
													{
														key: "empty",
														value: function() {
															return this.tweenables.map(
																this.remove.bind(this)
															);
														}
													},
													{
														key: "isPlaying",
														value: function() {
															return B(this, R).some(function(t) {
																return t.isPlaying();
															});
														}
													},
													{
														key: "play",
														value: function() {
															return (
																B(this, R).forEach(function(t) {
																	return t.tween();
																}),
																this
															);
														}
													},
													{
														key: "pause",
														value: function() {
															return (
																B(this, R).forEach(function(t) {
																	return t.pause();
																}),
																this
															);
														}
													},
													{
														key: "resume",
														value: function() {
															return (
																B(this, R).forEach(function(t) {
																	return t.resume();
																}),
																this
															);
														}
													},
													{
														key: "stop",
														value: function(t) {
															return (
																B(this, R).forEach(function(n) {
																	return n.stop(t);
																}),
																this
															);
														}
													},
													{
														key: "tweenables",
														get: function() {
															return Q(B(this, R));
														}
													},
													{
														key: "promises",
														get: function() {
															return B(this, R).map(function(t) {
																return t._promise;
															});
														}
													}
												]) && D(n.prototype, e),
												r && D(n, r),
												t
											);
										})(),
										R = new WeakMap();
									function z(t, n, e, r, i, u) {
										var o = 0,
											a = 0,
											c = 0,
											f = 0,
											s = 0,
											l = 0,
											h = function(t) {
												return ((o * t + a) * t + c) * t;
											},
											p = function(t) {
												return t >= 0 ? t : 0 - t;
											};
										return (
											(o = 1 - (c = 3 * n) - (a = 3 * (r - n) - c)),
											(f = 1 - (l = 3 * e) - (s = 3 * (i - e) - l)),
											(function(t, n) {
												return (
													(e = (function(t, n) {
														var e, r, i, u, f, s, l;
														for (i = t, s = 0; s < 8; s++) {
															if (((u = h(i) - t), p(u) < n)) return i;
															if (
																p((f = (3 * o * (l = i) + 2 * a) * l + c)) <
																1e-6
															)
																break;
															i -= u / f;
														}
														if ((i = t) < (e = 0)) return e;
														if (i > (r = 1)) return r;
														for (; e < r; ) {
															if (((u = h(i)), p(u - t) < n)) return i;
															t > u ? (e = i) : (r = i),
																(i = 0.5 * (r - e) + e);
														}
														return i;
													})(t, n)),
													((f * e + s) * e + l) * e
												);
												var e;
											})(
												t,
												(function(t) {
													return 1 / (200 * t);
												})(u)
											)
										);
									}
									var L = function(t, n, e, r, i) {
											var u = (function(t, n, e, r) {
												return function(i) {
													return z(i, t, n, e, r, 1);
												};
											})(n, e, r, i);
											return (
												(u.displayName = t),
												(u.x1 = n),
												(u.y1 = e),
												(u.x2 = r),
												(u.y2 = i),
												(o.a.formulas[t] = u)
											);
										},
										V = function(t) {
											return delete o.a.formulas[t];
										};
									e.d(n, "processTweens", function() {
										return o.c;
									}),
										e.d(n, "Tweenable", function() {
											return o.a;
										}),
										e.d(n, "tween", function() {
											return o.d;
										}),
										e.d(n, "interpolate", function() {
											return q;
										}),
										e.d(n, "Scene", function() {
											return N;
										}),
										e.d(n, "setBezierFunction", function() {
											return L;
										}),
										e.d(n, "unsetBezierFunction", function() {
											return V;
										}),
										(o.a.filters.token = r);
								}
							]);
						});
					},
					{}
				],
				2: [
					function(require, module, exports) {
						// Circle shaped progress bar

						var Shape = require("./shape");
						var utils = require("./utils");

						var Circle = function Circle(container, options) {
							// Use two arcs to form a circle
							// See this answer http://stackoverflow.com/a/10477334/1446092
							this._pathTemplate =
								"M 50,50 m 0,-{radius}" +
								" a {radius},{radius} 0 1 1 0,{2radius}" +
								" a {radius},{radius} 0 1 1 0,-{2radius}";

							this.containerAspectRatio = 1;

							Shape.apply(this, arguments);
						};

						Circle.prototype = new Shape();
						Circle.prototype.constructor = Circle;

						Circle.prototype._pathString = function _pathString(opts) {
							var widthOfWider = opts.strokeWidth;
							if (opts.trailWidth && opts.trailWidth > opts.strokeWidth) {
								widthOfWider = opts.trailWidth;
							}

							var r = 50 - widthOfWider / 2;

							return utils.render(this._pathTemplate, {
								radius: r,
								"2radius": r * 2
							});
						};

						Circle.prototype._trailString = function _trailString(opts) {
							return this._pathString(opts);
						};

						module.exports = Circle;
					},
					{ "./shape": 7, "./utils": 9 }
				],
				3: [
					function(require, module, exports) {
						// Line shaped progress bar

						var Shape = require("./shape");
						var utils = require("./utils");

						var Line = function Line(container, options) {
							this._pathTemplate = "M 0,{center} L 100,{center}";
							Shape.apply(this, arguments);
						};

						Line.prototype = new Shape();
						Line.prototype.constructor = Line;

						Line.prototype._initializeSvg = function _initializeSvg(svg, opts) {
							svg.setAttribute("viewBox", "0 0 100 " + opts.strokeWidth);
							svg.setAttribute("preserveAspectRatio", "none");
						};

						Line.prototype._pathString = function _pathString(opts) {
							return utils.render(this._pathTemplate, {
								center: opts.strokeWidth / 2
							});
						};

						Line.prototype._trailString = function _trailString(opts) {
							return this._pathString(opts);
						};

						module.exports = Line;
					},
					{ "./shape": 7, "./utils": 9 }
				],
				4: [
					function(require, module, exports) {
						module.exports = {
							// Higher level API, different shaped progress bars
							Line: require("./line"),
							Circle: require("./circle"),
							SemiCircle: require("./semicircle"),
							Square: require("./square"),

							// Lower level API to use any SVG path
							Path: require("./path"),

							// Base-class for creating new custom shapes
							// to be in line with the API of built-in shapes
							// Undocumented.
							Shape: require("./shape"),

							// Internal utils, undocumented.
							utils: require("./utils")
						};
					},
					{
						"./circle": 2,
						"./line": 3,
						"./path": 5,
						"./semicircle": 6,
						"./shape": 7,
						"./square": 8,
						"./utils": 9
					}
				],
				5: [
					function(require, module, exports) {
						// Lower level API to animate any kind of svg path

						var shifty = require("shifty");
						var utils = require("./utils");

						var Tweenable = shifty.Tweenable;

						var EASING_ALIASES = {
							easeIn: "easeInCubic",
							easeOut: "easeOutCubic",
							easeInOut: "easeInOutCubic"
						};

						var Path = function Path(path, opts) {
							// Throw a better error if not initialized with `new` keyword
							if (!(this instanceof Path)) {
								throw new Error("Constructor was called without new keyword");
							}

							// Default parameters for animation
							opts = utils.extend(
								{
									delay: 0,
									duration: 800,
									easing: "linear",
									from: {},
									to: {},
									step: function() {}
								},
								opts
							);

							var element;
							if (utils.isString(path)) {
								element = document.querySelector(path);
							} else {
								element = path;
							}

							// Reveal .path as public attribute
							this.path = element;
							this._opts = opts;
							this._tweenable = null;

							// Set up the starting positions
							var length = this.path.getTotalLength();
							this.path.style.strokeDasharray = length + " " + length;
							this.set(0);
						};

						Path.prototype.value = function value() {
							var offset = this._getComputedDashOffset();
							var length = this.path.getTotalLength();

							var progress = 1 - offset / length;
							// Round number to prevent returning very small number like 1e-30, which
							// is practically 0
							return parseFloat(progress.toFixed(6), 10);
						};

						Path.prototype.set = function set(progress) {
							this.stop();

							this.path.style.strokeDashoffset = this._progressToOffset(
								progress
							);

							var step = this._opts.step;
							if (utils.isFunction(step)) {
								var easing = this._easing(this._opts.easing);
								var values = this._calculateTo(progress, easing);
								var reference = this._opts.shape || this;
								step(values, reference, this._opts.attachment);
							}
						};

						Path.prototype.stop = function stop() {
							this._stopTween();
							this.path.style.strokeDashoffset = this._getComputedDashOffset();
						};

						// Method introduced here:
						// http://jakearchibald.com/2013/animated-line-drawing-svg/
						Path.prototype.animate = function animate(progress, opts, cb) {
							opts = opts || {};

							if (utils.isFunction(opts)) {
								cb = opts;
								opts = {};
							}

							var passedOpts = utils.extend({}, opts);

							// Copy default opts to new object so defaults are not modified
							var defaultOpts = utils.extend({}, this._opts);
							opts = utils.extend(defaultOpts, opts);

							var shiftyEasing = this._easing(opts.easing);
							var values = this._resolveFromAndTo(
								progress,
								shiftyEasing,
								passedOpts
							);

							this.stop();

							// Trigger a layout so styles are calculated & the browser
							// picks up the starting position before animating
							this.path.getBoundingClientRect();

							var offset = this._getComputedDashOffset();
							var newOffset = this._progressToOffset(progress);

							var self = this;
							this._tweenable = new Tweenable();
							this._tweenable
								.tween({
									from: utils.extend({ offset: offset }, values.from),
									to: utils.extend({ offset: newOffset }, values.to),
									duration: opts.duration,
									delay: opts.delay,
									easing: shiftyEasing,
									step: function(state) {
										self.path.style.strokeDashoffset = state.offset;
										var reference = opts.shape || self;
										opts.step(state, reference, opts.attachment);
									}
								})
								.then(function(state) {
									if (utils.isFunction(cb)) {
										cb();
									}
								});
						};

						Path.prototype._getComputedDashOffset = function _getComputedDashOffset() {
							var computedStyle = window.getComputedStyle(this.path, null);
							return parseFloat(
								computedStyle.getPropertyValue("stroke-dashoffset"),
								10
							);
						};

						Path.prototype._progressToOffset = function _progressToOffset(
							progress
						) {
							var length = this.path.getTotalLength();
							return length - progress * length;
						};

						// Resolves from and to values for animation.
						Path.prototype._resolveFromAndTo = function _resolveFromAndTo(
							progress,
							easing,
							opts
						) {
							if (opts.from && opts.to) {
								return {
									from: opts.from,
									to: opts.to
								};
							}

							return {
								from: this._calculateFrom(easing),
								to: this._calculateTo(progress, easing)
							};
						};

						// Calculate `from` values from options passed at initialization
						Path.prototype._calculateFrom = function _calculateFrom(easing) {
							return shifty.interpolate(
								this._opts.from,
								this._opts.to,
								this.value(),
								easing
							);
						};

						// Calculate `to` values from options passed at initialization
						Path.prototype._calculateTo = function _calculateTo(
							progress,
							easing
						) {
							return shifty.interpolate(
								this._opts.from,
								this._opts.to,
								progress,
								easing
							);
						};

						Path.prototype._stopTween = function _stopTween() {
							if (this._tweenable !== null) {
								this._tweenable.stop();
								this._tweenable = null;
							}
						};

						Path.prototype._easing = function _easing(easing) {
							if (EASING_ALIASES.hasOwnProperty(easing)) {
								return EASING_ALIASES[easing];
							}

							return easing;
						};

						module.exports = Path;
					},
					{ "./utils": 9, shifty: 1 }
				],
				6: [
					function(require, module, exports) {
						// Semi-SemiCircle shaped progress bar

						var Shape = require("./shape");
						var Circle = require("./circle");
						var utils = require("./utils");

						var SemiCircle = function SemiCircle(container, options) {
							// Use one arc to form a SemiCircle
							// See this answer http://stackoverflow.com/a/10477334/1446092
							this._pathTemplate =
								"M 50,50 m -{radius},0" +
								" a {radius},{radius} 0 1 1 {2radius},0";

							this.containerAspectRatio = 2;

							Shape.apply(this, arguments);
						};

						SemiCircle.prototype = new Shape();
						SemiCircle.prototype.constructor = SemiCircle;

						SemiCircle.prototype._initializeSvg = function _initializeSvg(
							svg,
							opts
						) {
							svg.setAttribute("viewBox", "0 0 100 50");
						};

						SemiCircle.prototype._initializeTextContainer = function _initializeTextContainer(
							opts,
							container,
							textContainer
						) {
							if (opts.text.style) {
								// Reset top style
								textContainer.style.top = "auto";
								textContainer.style.bottom = "0";

								if (opts.text.alignToBottom) {
									utils.setStyle(
										textContainer,
										"transform",
										"translate(-50%, 0)"
									);
								} else {
									utils.setStyle(
										textContainer,
										"transform",
										"translate(-50%, 50%)"
									);
								}
							}
						};

						// Share functionality with Circle, just have different path
						SemiCircle.prototype._pathString = Circle.prototype._pathString;
						SemiCircle.prototype._trailString = Circle.prototype._trailString;

						module.exports = SemiCircle;
					},
					{ "./circle": 2, "./shape": 7, "./utils": 9 }
				],
				7: [
					function(require, module, exports) {
						// Base object for different progress bar shapes

						var Path = require("./path");
						var utils = require("./utils");

						var DESTROYED_ERROR = "Object is destroyed";

						var Shape = function Shape(container, opts) {
							// Throw a better error if progress bars are not initialized with `new`
							// keyword
							if (!(this instanceof Shape)) {
								throw new Error("Constructor was called without new keyword");
							}

							// Prevent calling constructor without parameters so inheritance
							// works correctly. To understand, this is how Shape is inherited:
							//
							//   Line.prototype = new Shape();
							//
							// We just want to set the prototype for Line.
							if (arguments.length === 0) {
								return;
							}

							// Default parameters for progress bar creation
							this._opts = utils.extend(
								{
									color: "#555",
									strokeWidth: 1.0,
									trailColor: null,
									trailWidth: null,
									fill: null,
									text: {
										style: {
											color: null,
											position: "absolute",
											left: "50%",
											top: "50%",
											padding: 0,
											margin: 0,
											transform: {
												prefix: true,
												value: "translate(-50%, -50%)"
											}
										},
										autoStyleContainer: true,
										alignToBottom: true,
										value: null,
										className: "progressbar-text"
									},
									svgStyle: {
										display: "block",
										width: "100%"
									},
									warnings: false
								},
								opts,
								true
							); // Use recursive extend

							// If user specifies e.g. svgStyle or text style, the whole object
							// should replace the defaults to make working with styles easier
							if (utils.isObject(opts) && opts.svgStyle !== undefined) {
								this._opts.svgStyle = opts.svgStyle;
							}
							if (
								utils.isObject(opts) &&
								utils.isObject(opts.text) &&
								opts.text.style !== undefined
							) {
								this._opts.text.style = opts.text.style;
							}

							var svgView = this._createSvgView(this._opts);

							var element;
							if (utils.isString(container)) {
								element = document.querySelector(container);
							} else {
								element = container;
							}

							if (!element) {
								throw new Error("Container does not exist: " + container);
							}

							this._container = element;
							this._container.appendChild(svgView.svg);
							if (this._opts.warnings) {
								this._warnContainerAspectRatio(this._container);
							}

							if (this._opts.svgStyle) {
								utils.setStyles(svgView.svg, this._opts.svgStyle);
							}

							// Expose public attributes before Path initialization
							this.svg = svgView.svg;
							this.path = svgView.path;
							this.trail = svgView.trail;
							this.text = null;

							var newOpts = utils.extend(
								{
									attachment: undefined,
									shape: this
								},
								this._opts
							);
							this._progressPath = new Path(svgView.path, newOpts);

							if (
								utils.isObject(this._opts.text) &&
								this._opts.text.value !== null
							) {
								this.setText(this._opts.text.value);
							}
						};

						Shape.prototype.animate = function animate(progress, opts, cb) {
							if (this._progressPath === null) {
								throw new Error(DESTROYED_ERROR);
							}

							this._progressPath.animate(progress, opts, cb);
						};

						Shape.prototype.stop = function stop() {
							if (this._progressPath === null) {
								throw new Error(DESTROYED_ERROR);
							}

							// Don't crash if stop is called inside step function
							if (this._progressPath === undefined) {
								return;
							}

							this._progressPath.stop();
						};

						Shape.prototype.pause = function pause() {
							if (this._progressPath === null) {
								throw new Error(DESTROYED_ERROR);
							}

							if (this._progressPath === undefined) {
								return;
							}

							if (!this._progressPath._tweenable) {
								// It seems that we can't pause this
								return;
							}

							this._progressPath._tweenable.pause();
						};

						Shape.prototype.resume = function resume() {
							if (this._progressPath === null) {
								throw new Error(DESTROYED_ERROR);
							}

							if (this._progressPath === undefined) {
								return;
							}

							if (!this._progressPath._tweenable) {
								// It seems that we can't resume this
								return;
							}

							this._progressPath._tweenable.resume();
						};

						Shape.prototype.destroy = function destroy() {
							if (this._progressPath === null) {
								throw new Error(DESTROYED_ERROR);
							}

							this.stop();
							this.svg.parentNode.removeChild(this.svg);
							this.svg = null;
							this.path = null;
							this.trail = null;
							this._progressPath = null;

							if (this.text !== null) {
								this.text.parentNode.removeChild(this.text);
								this.text = null;
							}
						};

						Shape.prototype.set = function set(progress) {
							if (this._progressPath === null) {
								throw new Error(DESTROYED_ERROR);
							}

							this._progressPath.set(progress);
						};

						Shape.prototype.value = function value() {
							if (this._progressPath === null) {
								throw new Error(DESTROYED_ERROR);
							}

							if (this._progressPath === undefined) {
								return 0;
							}

							return this._progressPath.value();
						};

						Shape.prototype.setText = function setText(newText) {
							if (this._progressPath === null) {
								throw new Error(DESTROYED_ERROR);
							}

							if (this.text === null) {
								// Create new text node
								this.text = this._createTextContainer(
									this._opts,
									this._container
								);
								this._container.appendChild(this.text);
							}

							// Remove previous text and add new
							if (utils.isObject(newText)) {
								utils.removeChildren(this.text);
								this.text.appendChild(newText);
							} else {
								this.text.innerHTML = newText;
							}
						};

						Shape.prototype._createSvgView = function _createSvgView(opts) {
							var svg = document.createElementNS(
								"http://www.w3.org/2000/svg",
								"svg"
							);
							this._initializeSvg(svg, opts);

							var trailPath = null;
							// Each option listed in the if condition are 'triggers' for creating
							// the trail path
							if (opts.trailColor || opts.trailWidth) {
								trailPath = this._createTrail(opts);
								svg.appendChild(trailPath);
							}

							var path = this._createPath(opts);
							svg.appendChild(path);

							return {
								svg: svg,
								path: path,
								trail: trailPath
							};
						};

						Shape.prototype._initializeSvg = function _initializeSvg(
							svg,
							opts
						) {
							svg.setAttribute("viewBox", "0 0 100 100");
						};

						Shape.prototype._createPath = function _createPath(opts) {
							var pathString = this._pathString(opts);
							return this._createPathElement(pathString, opts);
						};

						Shape.prototype._createTrail = function _createTrail(opts) {
							// Create path string with original passed options
							var pathString = this._trailString(opts);

							// Prevent modifying original
							var newOpts = utils.extend({}, opts);

							// Defaults for parameters which modify trail path
							if (!newOpts.trailColor) {
								newOpts.trailColor = "#eee";
							}
							if (!newOpts.trailWidth) {
								newOpts.trailWidth = newOpts.strokeWidth;
							}

							newOpts.color = newOpts.trailColor;
							newOpts.strokeWidth = newOpts.trailWidth;

							// When trail path is set, fill must be set for it instead of the
							// actual path to prevent trail stroke from clipping
							newOpts.fill = null;

							return this._createPathElement(pathString, newOpts);
						};

						Shape.prototype._createPathElement = function _createPathElement(
							pathString,
							opts
						) {
							var path = document.createElementNS(
								"http://www.w3.org/2000/svg",
								"path"
							);
							path.setAttribute("d", pathString);
							path.setAttribute("stroke", opts.color);
							path.setAttribute("stroke-width", opts.strokeWidth);

							if (opts.fill) {
								path.setAttribute("fill", opts.fill);
							} else {
								path.setAttribute("fill-opacity", "0");
							}

							return path;
						};

						Shape.prototype._createTextContainer = function _createTextContainer(
							opts,
							container
						) {
							var textContainer = document.createElement("div");
							textContainer.className = opts.text.className;

							var textStyle = opts.text.style;
							if (textStyle) {
								if (opts.text.autoStyleContainer) {
									container.style.position = "relative";
								}

								utils.setStyles(textContainer, textStyle);
								// Default text color to progress bar's color
								if (!textStyle.color) {
									textContainer.style.color = opts.color;
								}
							}

							this._initializeTextContainer(opts, container, textContainer);
							return textContainer;
						};

						// Give custom shapes possibility to modify text element
						Shape.prototype._initializeTextContainer = function(
							opts,
							container,
							element
						) {
							// By default, no-op
							// Custom shapes should respect API options, such as text.style
						};

						Shape.prototype._pathString = function _pathString(opts) {
							throw new Error("Override this function for each progress bar");
						};

						Shape.prototype._trailString = function _trailString(opts) {
							throw new Error("Override this function for each progress bar");
						};

						Shape.prototype._warnContainerAspectRatio = function _warnContainerAspectRatio(
							container
						) {
							if (!this.containerAspectRatio) {
								return;
							}

							var computedStyle = window.getComputedStyle(container, null);
							var width = parseFloat(
								computedStyle.getPropertyValue("width"),
								10
							);
							var height = parseFloat(
								computedStyle.getPropertyValue("height"),
								10
							);
							if (
								!utils.floatEquals(this.containerAspectRatio, width / height)
							) {
								console.warn(
									"Incorrect aspect ratio of container",
									"#" + container.id,
									"detected:",
									computedStyle.getPropertyValue("width") + "(width)",
									"/",
									computedStyle.getPropertyValue("height") + "(height)",
									"=",
									width / height
								);

								console.warn(
									"Aspect ratio of should be",
									this.containerAspectRatio
								);
							}
						};

						module.exports = Shape;
					},
					{ "./path": 5, "./utils": 9 }
				],
				8: [
					function(require, module, exports) {
						// Square shaped progress bar
						// Note: Square is not core part of API anymore. It's left here
						//       for reference. square is not included to the progressbar
						//       build anymore

						var Shape = require("./shape");
						var utils = require("./utils");

						var Square = function Square(container, options) {
							this._pathTemplate =
								"M 0,{halfOfStrokeWidth}" +
								" L {width},{halfOfStrokeWidth}" +
								" L {width},{width}" +
								" L {halfOfStrokeWidth},{width}" +
								" L {halfOfStrokeWidth},{strokeWidth}";

							this._trailTemplate =
								"M {startMargin},{halfOfStrokeWidth}" +
								" L {width},{halfOfStrokeWidth}" +
								" L {width},{width}" +
								" L {halfOfStrokeWidth},{width}" +
								" L {halfOfStrokeWidth},{halfOfStrokeWidth}";

							Shape.apply(this, arguments);
						};

						Square.prototype = new Shape();
						Square.prototype.constructor = Square;

						Square.prototype._pathString = function _pathString(opts) {
							var w = 100 - opts.strokeWidth / 2;

							return utils.render(this._pathTemplate, {
								width: w,
								strokeWidth: opts.strokeWidth,
								halfOfStrokeWidth: opts.strokeWidth / 2
							});
						};

						Square.prototype._trailString = function _trailString(opts) {
							var w = 100 - opts.strokeWidth / 2;

							return utils.render(this._trailTemplate, {
								width: w,
								strokeWidth: opts.strokeWidth,
								halfOfStrokeWidth: opts.strokeWidth / 2,
								startMargin: opts.strokeWidth / 2 - opts.trailWidth / 2
							});
						};

						module.exports = Square;
					},
					{ "./shape": 7, "./utils": 9 }
				],
				9: [
					function(require, module, exports) {
						// Utility functions

						var PREFIXES = "Webkit Moz O ms".split(" ");
						var FLOAT_COMPARISON_EPSILON = 0.001;

						// Copy all attributes from source object to destination object.
						// destination object is mutated.
						function extend(destination, source, recursive) {
							destination = destination || {};
							source = source || {};
							recursive = recursive || false;

							for (var attrName in source) {
								if (source.hasOwnProperty(attrName)) {
									var destVal = destination[attrName];
									var sourceVal = source[attrName];
									if (recursive && isObject(destVal) && isObject(sourceVal)) {
										destination[attrName] = extend(
											destVal,
											sourceVal,
											recursive
										);
									} else {
										destination[attrName] = sourceVal;
									}
								}
							}

							return destination;
						}

						// Renders templates with given variables. Variables must be surrounded with
						// braces without any spaces, e.g. {variable}
						// All instances of variable placeholders will be replaced with given content
						// Example:
						// render('Hello, {message}!', {message: 'world'})
						function render(template, vars) {
							var rendered = template;

							for (var key in vars) {
								if (vars.hasOwnProperty(key)) {
									var val = vars[key];
									var regExpString = "\\{" + key + "\\}";
									var regExp = new RegExp(regExpString, "g");

									rendered = rendered.replace(regExp, val);
								}
							}

							return rendered;
						}

						function setStyle(element, style, value) {
							var elStyle = element.style; // cache for performance

							for (var i = 0; i < PREFIXES.length; ++i) {
								var prefix = PREFIXES[i];
								elStyle[prefix + capitalize(style)] = value;
							}

							elStyle[style] = value;
						}

						function setStyles(element, styles) {
							forEachObject(styles, function(styleValue, styleName) {
								// Allow disabling some individual styles by setting them
								// to null or undefined
								if (styleValue === null || styleValue === undefined) {
									return;
								}

								// If style's value is {prefix: true, value: '50%'},
								// Set also browser prefixed styles
								if (isObject(styleValue) && styleValue.prefix === true) {
									setStyle(element, styleName, styleValue.value);
								} else {
									element.style[styleName] = styleValue;
								}
							});
						}

						function capitalize(text) {
							return text.charAt(0).toUpperCase() + text.slice(1);
						}

						function isString(obj) {
							return typeof obj === "string" || obj instanceof String;
						}

						function isFunction(obj) {
							return typeof obj === "function";
						}

						function isArray(obj) {
							return Object.prototype.toString.call(obj) === "[object Array]";
						}

						// Returns true if `obj` is object as in {a: 1, b: 2}, not if it's function or
						// array
						function isObject(obj) {
							if (isArray(obj)) {
								return false;
							}

							var type = typeof obj;
							return type === "object" && !!obj;
						}

						function forEachObject(object, callback) {
							for (var key in object) {
								if (object.hasOwnProperty(key)) {
									var val = object[key];
									callback(val, key);
								}
							}
						}

						function floatEquals(a, b) {
							return Math.abs(a - b) < FLOAT_COMPARISON_EPSILON;
						}

						// https://coderwall.com/p/nygghw/don-t-use-innerhtml-to-empty-dom-elements
						function removeChildren(el) {
							while (el.firstChild) {
								el.removeChild(el.firstChild);
							}
						}

						module.exports = {
							extend: extend,
							render: render,
							setStyle: setStyle,
							setStyles: setStyles,
							capitalize: capitalize,
							isString: isString,
							isFunction: isFunction,
							isObject: isObject,
							forEachObject: forEachObject,
							floatEquals: floatEquals,
							removeChildren: removeChildren
						};
					},
					{}
				]
			},
			{},
			[4]
		)(4);
	});

	/***************** ADDITIONAL FUNCTIONALITIES RELATED TO FORMS ******************/

	/* 	Modal for displaying errors */
	const modal = document.querySelector(".modal");
	const modalContent = modal.querySelector(".modal-content");
	const modalMessageHolder = modal.querySelector(".modal-message-holder");
	const closeButton = document.querySelector(".close-button");

	function showModal(modalContent) {
		modal.classList.add("unlock-modal");
		modal.classList.add("show-modal");

		setTimeout(() => modal.classList.add("show-modal"), 300);

		if (modalContent) {
			console.log(modalContent);

			typeof modalContent === "object" ? showObjectInModal(modalContent) : "";
		}

		// modal.classList.contains("show-modal")
		// 	? modal.classList.remove("show-modal")
		// 	: modal.classList.add("show-modal");
	}

	function showObjectInModal(modalContent) {
		const objectValues = Object.values(modalContent);
		objectValues.forEach(value => {
			let newParagraph = document.createElement("P");

			newParagraph.classList.add("modal-message");
			modalMessageHolder.appendChild(newParagraph);
			newParagraph.innerText = value.innerText;

			if (value.classList.contains("php-error__text")) {
				newParagraph.classList.add("php-error__text");
			}

			console.log(value);
		});
	}

	function closeModal() {
		modal.classList.remove("show-modal");
		modal.classList.remove("unlock-modal");
		modalMessageHolder.innerHTML = "";
	}

	function windowOnClick(event) {
		if (event.target === modal && event.target !== closeButton) {
			closeModal();
		}
	}

	closeButton.addEventListener("click", closeModal);
	window.addEventListener("click", windowOnClick);

	/* 	For handling previews of files added by repeaters */

	const allRepeaterHolders = document.querySelectorAll(".repeater__holder");

	allRepeaterHolders.forEach(wrapper => {
		let repeaterFieldWrapper = wrapper.querySelector(
			".repeater__field-wrapper"
		);

		const allOriginalInputs = wrapper.querySelectorAll(".input-preview__src");

		//static for already existing inputs
		allOriginalInputs.forEach(thisInput => {
			thisInput.addEventListener("change", function(e) {
				console.log(e);

				let closestRowWrapper = thisInput.closest(".row-wrapper");

				let newAttachmentPlaceholder = closestRowWrapper?.querySelector(
					".new-attachment__placeholder"
				);

				if (newAttachmentPlaceholder.tagName == "IMG") {
					console.log(newAttachmentPlaceholder);
					newAttachmentPlaceholder.setAttribute(
						"src",
						URL.createObjectURL(e.target.files[0])
					);
				}

				if (!closestRowWrapper.querySelector("input[type='file']").files[0]) {
					let soundLabel = thisInput
						.closest(".repeater__field")
						.querySelector(".input-text").value;
					let soundDescription = thisInput
						.closest(".repeater__field")
						.querySelector(".input-textarea").value;

					let newAttachmentPlaceholderContent = `
					<div class="new-attachment__preview row-wrapper my-sounds__gallery-attachment my-sounds__gallery-row-wrapper" style="position: absolute; display: none;">

						<a class="remove-item remove" data-id="clear-input" href="#"></a>

						<div class="my-sounds__gallery-text-wrapper">

							<div class="my-sounds__gallery-attachment--label">

								<p>${soundLabel}</p>

							</div>

							<div class="my-sounds__gallery-attachment--description">

								<p>${soundDescription}</p>

							</div>

						</div>

					</div>
					`;

					newAttachmentPlaceholder.innerHTML = newAttachmentPlaceholderContent;
				}

				if (
					closestRowWrapper.querySelector("input[type='file']").files[0] &&
					newAttachmentPlaceholder.id === "newSoundInGalleryPlaceholder"
				) {
					// newAttachmentPlaceholder.querySelector(".sound-title").textContent =
					// 	e.target.files[0].name;
					let soundLabel = thisInput
						.closest(".repeater__field")
						.querySelector(".input-text").value;
					let soundDescription = thisInput
						.closest(".repeater__field")
						.querySelector(".input-textarea").value;

					let newAttachmentPlaceholderContent = `
					<div class="new-attachment__preview row-wrapper my-sounds__gallery-attachment my-sounds__gallery-row-wrapper">

					<a class="remove-item remove" data-id="clear-input" href="#"></a>
					
					<div class="my-sounds__gallery-text-wrapper">
					
						<div class="my-sounds__gallery-attachment--label" style="display: none">
					
							<p>${soundLabel}</p>
					
						</div>
					
						<div class="my-sounds__gallery-attachment--description" style="display: none">
					
							<p>${soundDescription}</p>
					
						</div>
					
					</div>
					
					<div class="my-sounds__gallery-attachment my-sounds__gallery-attachment--file-info">
					
						<div class="new-attachment__icon ">
					
							<svg width="44" height="38" viewBox="0 0 44 38" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M26.4822 19.0011C26.4822 13.3803 26.4822 7.74847 26.4822 2.12766C26.4822 1.44301 26.681 0.857736 27.2221 0.438109C27.8405 -0.0477762 28.5362 -0.136119 29.254 0.206209C29.9828 0.548537 30.3362 1.14485 30.3804 1.93993C30.3804 2.00619 30.3804 2.08349 30.3804 2.14975C30.3804 13.3803 30.3804 24.6219 30.3804 35.8525C30.3804 36.6917 30.0822 37.3543 29.3313 37.7629C28.0834 38.4365 26.5595 37.5752 26.4822 36.1617C26.4712 36.0181 26.4712 35.8746 26.4712 35.731C26.4822 30.1544 26.4822 24.5778 26.4822 19.0011Z" fill="#18A0AA"/>
							<path d="M23.744 19.0233C23.744 23.0428 23.744 27.0624 23.744 31.082C23.744 32.098 23.1587 32.8599 22.2201 33.0697C21.0385 33.3458 19.8901 32.4513 19.8569 31.2366C19.8569 31.1704 19.8569 31.0931 19.8569 31.0268C19.8569 23.0097 19.8569 14.9816 19.8569 6.96447C19.8569 6.13626 20.1661 5.49577 20.895 5.10928C22.1649 4.42462 23.733 5.34118 23.744 6.78779C23.7661 8.95218 23.7551 11.1055 23.7551 13.2699C23.744 15.1803 23.744 17.1018 23.744 19.0233Z" fill="#16538C"/>
							<path d="M6.62239 18.9791C6.62239 15.7877 6.62239 12.5853 6.62239 9.39391C6.62239 8.46631 7.05306 7.78166 7.81502 7.46141C9.0739 6.93136 10.4543 7.81478 10.5205 9.19514C10.5205 9.2614 10.5205 9.31661 10.5205 9.38287C10.5205 15.7877 10.5205 22.2036 10.5205 28.6084C10.5205 29.536 10.0457 30.2649 9.25059 30.552C8.00274 31.0158 6.6776 30.1434 6.63343 28.8293C6.61135 28.0784 6.62239 27.3275 6.62239 26.5766C6.62239 24.0478 6.62239 21.5079 6.62239 18.9791Z" fill="#16538C"/>
							<path d="M36.9919 19.001C36.9919 22.1924 36.9919 25.3948 36.9919 28.5862C36.9919 29.3702 36.7158 29.9996 36.0422 30.3972C34.7723 31.1591 33.1821 30.2868 33.0938 28.807C33.0938 28.7408 33.0938 28.6856 33.0938 28.6193C33.0938 22.2034 33.0938 15.7875 33.0938 9.37163C33.0938 8.4109 33.6017 7.68208 34.4741 7.40601C35.6557 7.01951 36.9256 7.89189 36.9808 9.12869C37.0029 9.55936 36.9919 10.0011 36.9919 10.4317C36.9919 13.2808 36.9919 16.1409 36.9919 19.001Z" fill="#16538C"/>
							<path d="M17.1435 18.9906C17.1435 21.3869 17.1435 23.7832 17.1435 26.1795C17.1435 26.9967 16.8233 27.6261 16.0945 28.0126C14.8135 28.6972 13.3006 27.7917 13.2344 26.312C13.2344 26.2678 13.2344 26.2126 13.2344 26.1684C13.2344 21.3869 13.2344 16.5943 13.2344 11.8127C13.2344 10.8741 13.7203 10.1453 14.5264 9.85817C15.7411 9.41645 17.0662 10.2778 17.1215 11.5698C17.1546 12.3649 17.1325 13.171 17.1325 13.9661C17.1435 15.6336 17.1435 17.3121 17.1435 18.9906Z" fill="#18A0AA"/>
							<path d="M0.0110428 18.9687C0.0110428 17.3454 0.0110428 15.7221 0.0110428 14.1099C0.0110428 13.1933 0.66257 12.4203 1.55704 12.2215C2.44047 12.0228 3.36806 12.4866 3.72144 13.3258C3.83186 13.5798 3.89812 13.878 3.89812 14.154C3.90916 17.3896 3.90916 20.6251 3.89812 23.8607C3.89812 24.965 3.01469 25.8373 1.94354 25.8263C0.850298 25.8153 0 24.9429 0 23.8165C0.0110428 22.2043 0.0110428 20.581 0.0110428 18.9687Z" fill="#18A0AA"/>
							<path d="M39.7158 18.9904C39.7158 18.1732 39.7048 17.345 39.7158 16.5278C39.7268 15.6002 40.3784 14.8383 41.2949 14.6505C42.1783 14.4738 43.0949 14.9376 43.4483 15.7879C43.5477 16.0198 43.6029 16.2959 43.6139 16.5499C43.625 18.1842 43.625 19.8186 43.6139 21.464C43.6139 22.5241 42.7526 23.3744 41.6925 23.3854C40.6103 23.3965 39.7489 22.5682 39.7158 21.4971C39.7158 21.475 39.7158 21.4529 39.7158 21.4308C39.7048 20.6026 39.7048 19.7965 39.7158 18.9904C39.7048 18.9904 39.7158 18.9904 39.7158 18.9904Z" fill="#18A0AA"/>
							</svg>
					
						</div>
					
						<div class="new-attachment__description">
					
							<p class="sound-title">${
								closestRowWrapper.querySelector("input[type='file']").files[0]
									.name
							}</p>
					
						</div>
					
					</div>
					
					</div>
					`;

					newAttachmentPlaceholder.innerHTML = newAttachmentPlaceholderContent;
				}

				if (newAttachmentPlaceholder) {
					newAttachmentPlaceholder.style.display = "block";
				}
			});
		});

		//dynamic for inputs added with repeater
		let observer = new MutationObserver(function(mutations) {
			mutations.forEach(function(mutation) {
				console.log(mutation);

				if (mutation.type === "childList") {
					const allFileInputs = wrapper.querySelectorAll(".input-preview__src");

					allFileInputs.forEach(thisInput => {
						thisInput.addEventListener("change", function(e) {
							console.log(e);

							let closestRowWrapper = thisInput.closest(".row-wrapper");

							let newAttachmentPlaceholder = closestRowWrapper?.querySelector(
								".new-attachment__placeholder"
							);

							if (newAttachmentPlaceholder.tagName == "IMG") {
								newAttachmentPlaceholder.setAttribute(
									"src",
									URL.createObjectURL(e.target.files[0])
								);
							}

							console.log(
								e.target
									.closest(".row-wrapper")
									.querySelector("input[type='file']").files[0]
							);

							if (
								!closestRowWrapper.querySelector("input[type='file']").files[0]
							) {
								let soundLabel = thisInput
									.closest(".repeater__field")
									.querySelector(".input-text").value;
								let soundDescription = thisInput
									.closest(".repeater__field")
									.querySelector(".input-textarea").value;

								let newAttachmentPlaceholderContent = `
								<div class="new-attachment__preview row-wrapper my-sounds__gallery-attachment my-sounds__gallery-row-wrapper" style="position: absolute; display: none;">
			
									<a class="remove-item remove" data-id="clear-input" href="#"></a>
			
									<div class="my-sounds__gallery-text-wrapper">
			
										<div class="my-sounds__gallery-attachment--label">
			
											<p>${soundLabel}</p>
			
										</div>
			
										<div class="my-sounds__gallery-attachment--description">
			
											<p>${soundDescription}</p>
			
										</div>
			
									</div>
			
								</div>
								`;
								newAttachmentPlaceholder.innerHTML = newAttachmentPlaceholderContent;
							}

							if (
								e.target.files &&
								newAttachmentPlaceholder.id === "newSoundInGalleryPlaceholder"
							) {
								// newAttachmentPlaceholder.querySelector(".sound-title").textContent =
								// 	e.target.files[0].name;
								let soundLabel = thisInput
									.closest(".repeater__field")
									.querySelector(".input-text").value;
								let soundDescription = thisInput
									.closest(".repeater__field")
									.querySelector(".input-textarea").value;

								let newAttachmentPlaceholderContent = `
								<div class="new-attachment__preview row-wrapper my-sounds__gallery-attachment my-sounds__gallery-row-wrapper">
			
								<a class="remove-item remove" data-id="clear-input" href="#"></a>
								
								<div class="my-sounds__gallery-text-wrapper">
								
									<div class="my-sounds__gallery-attachment--label" style="display: none">
								
										<p>${soundLabel}</p>
								
									</div>
								
									<div class="my-sounds__gallery-attachment--description" style="display: none">
								
										<p>${soundDescription}</p>
								
									</div>
								
								</div>
								
								<div class="my-sounds__gallery-attachment my-sounds__gallery-attachment--file-info">
								
									<div class="new-attachment__icon ">
								
										<svg width="44" height="38" viewBox="0 0 44 38" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path d="M26.4822 19.0011C26.4822 13.3803 26.4822 7.74847 26.4822 2.12766C26.4822 1.44301 26.681 0.857736 27.2221 0.438109C27.8405 -0.0477762 28.5362 -0.136119 29.254 0.206209C29.9828 0.548537 30.3362 1.14485 30.3804 1.93993C30.3804 2.00619 30.3804 2.08349 30.3804 2.14975C30.3804 13.3803 30.3804 24.6219 30.3804 35.8525C30.3804 36.6917 30.0822 37.3543 29.3313 37.7629C28.0834 38.4365 26.5595 37.5752 26.4822 36.1617C26.4712 36.0181 26.4712 35.8746 26.4712 35.731C26.4822 30.1544 26.4822 24.5778 26.4822 19.0011Z" fill="#18A0AA"/>
										<path d="M23.744 19.0233C23.744 23.0428 23.744 27.0624 23.744 31.082C23.744 32.098 23.1587 32.8599 22.2201 33.0697C21.0385 33.3458 19.8901 32.4513 19.8569 31.2366C19.8569 31.1704 19.8569 31.0931 19.8569 31.0268C19.8569 23.0097 19.8569 14.9816 19.8569 6.96447C19.8569 6.13626 20.1661 5.49577 20.895 5.10928C22.1649 4.42462 23.733 5.34118 23.744 6.78779C23.7661 8.95218 23.7551 11.1055 23.7551 13.2699C23.744 15.1803 23.744 17.1018 23.744 19.0233Z" fill="#16538C"/>
										<path d="M6.62239 18.9791C6.62239 15.7877 6.62239 12.5853 6.62239 9.39391C6.62239 8.46631 7.05306 7.78166 7.81502 7.46141C9.0739 6.93136 10.4543 7.81478 10.5205 9.19514C10.5205 9.2614 10.5205 9.31661 10.5205 9.38287C10.5205 15.7877 10.5205 22.2036 10.5205 28.6084C10.5205 29.536 10.0457 30.2649 9.25059 30.552C8.00274 31.0158 6.6776 30.1434 6.63343 28.8293C6.61135 28.0784 6.62239 27.3275 6.62239 26.5766C6.62239 24.0478 6.62239 21.5079 6.62239 18.9791Z" fill="#16538C"/>
										<path d="M36.9919 19.001C36.9919 22.1924 36.9919 25.3948 36.9919 28.5862C36.9919 29.3702 36.7158 29.9996 36.0422 30.3972C34.7723 31.1591 33.1821 30.2868 33.0938 28.807C33.0938 28.7408 33.0938 28.6856 33.0938 28.6193C33.0938 22.2034 33.0938 15.7875 33.0938 9.37163C33.0938 8.4109 33.6017 7.68208 34.4741 7.40601C35.6557 7.01951 36.9256 7.89189 36.9808 9.12869C37.0029 9.55936 36.9919 10.0011 36.9919 10.4317C36.9919 13.2808 36.9919 16.1409 36.9919 19.001Z" fill="#16538C"/>
										<path d="M17.1435 18.9906C17.1435 21.3869 17.1435 23.7832 17.1435 26.1795C17.1435 26.9967 16.8233 27.6261 16.0945 28.0126C14.8135 28.6972 13.3006 27.7917 13.2344 26.312C13.2344 26.2678 13.2344 26.2126 13.2344 26.1684C13.2344 21.3869 13.2344 16.5943 13.2344 11.8127C13.2344 10.8741 13.7203 10.1453 14.5264 9.85817C15.7411 9.41645 17.0662 10.2778 17.1215 11.5698C17.1546 12.3649 17.1325 13.171 17.1325 13.9661C17.1435 15.6336 17.1435 17.3121 17.1435 18.9906Z" fill="#18A0AA"/>
										<path d="M0.0110428 18.9687C0.0110428 17.3454 0.0110428 15.7221 0.0110428 14.1099C0.0110428 13.1933 0.66257 12.4203 1.55704 12.2215C2.44047 12.0228 3.36806 12.4866 3.72144 13.3258C3.83186 13.5798 3.89812 13.878 3.89812 14.154C3.90916 17.3896 3.90916 20.6251 3.89812 23.8607C3.89812 24.965 3.01469 25.8373 1.94354 25.8263C0.850298 25.8153 0 24.9429 0 23.8165C0.0110428 22.2043 0.0110428 20.581 0.0110428 18.9687Z" fill="#18A0AA"/>
										<path d="M39.7158 18.9904C39.7158 18.1732 39.7048 17.345 39.7158 16.5278C39.7268 15.6002 40.3784 14.8383 41.2949 14.6505C42.1783 14.4738 43.0949 14.9376 43.4483 15.7879C43.5477 16.0198 43.6029 16.2959 43.6139 16.5499C43.625 18.1842 43.625 19.8186 43.6139 21.464C43.6139 22.5241 42.7526 23.3744 41.6925 23.3854C40.6103 23.3965 39.7489 22.5682 39.7158 21.4971C39.7158 21.475 39.7158 21.4529 39.7158 21.4308C39.7048 20.6026 39.7048 19.7965 39.7158 18.9904C39.7048 18.9904 39.7158 18.9904 39.7158 18.9904Z" fill="#18A0AA"/>
										</svg>
									
								
									</div>
								
									<div class="new-attachment__description">
								
										<p class="sound-title">${e.target.files[0].name}</p>
								
									</div>
								
								</div>
								
								</div>
								`;

								newAttachmentPlaceholder.innerHTML = newAttachmentPlaceholderContent;
							}

							if (newAttachmentPlaceholder) {
								newAttachmentPlaceholder.style.display = "block";
							}
						});
					});
				}
			});
		});

		observer.observe(repeaterFieldWrapper, {
			attributes: true,
			childList: true,
			characterData: true
		});
	});

	const removeArrayOfNodes = arr => {
		arr &&
			arr.forEach(node => {
				node && node.remove();
			});
	};

	// Animate progress bar

	/* 	You need use strokeWidth < 7. If it more then 7 it won't work in the IE. You can detect browser. For IE use less 7. For other use what you want. */

	const progressRingHolder = document.querySelector("#progressRing");

	if (progressRingHolder) {
		var progressRing = new ProgressBar.Circle(progressRingHolder, {
			color: "#16538c",
			// This has to be the same size as the maximum width to
			// prevent clipping
			strokeWidth: 0,
			trailWidth: 0,
			easing: "easeInOut",
			duration: 1800,
			text: {
				autoStyleContainer: false
			},
			from: { color: "#18a0aa", width: 10 },
			to: { color: "#16538c", width: 12 },
			// Set default step function for all animate calls
			step: function(state, circle) {
				circle.path.setAttribute("stroke", state.color);
				circle.path.setAttribute("stroke-width", state.width);

				var value = Math.round(circle.value() * 100);
				if (value === 0) {
					circle.setText("0%");
				} else {
					circle.setText(`${value}%`);
				}
			}
		});

		progressRing.animate(
			ajax_forms_params.initial_percent_value_of_account_fill_completness / 100
		);
	}

	const updateProfileCompletness = dataJSON => {
		console.log(dataJSON);

		const accountFillCompletenessWrapper = document.querySelector(
			".account__fill-completeness-wrapper"
		);
		const accountFillCompletness = document.querySelector(
			"#accountFillCompletness"
		);

		const percentValueOfAccountFillCompletnessHolder = document.querySelector(
			"#percentValueOfAccountFillCompletness"
		);

		// Refresh percent Value Of Account Fill Completness

		const percentValueOfAccountFillCompletness =
			dataJSON.percent_value_of_account_fill_completness;

		percentValueOfAccountFillCompletnessHolder.textContent = percentValueOfAccountFillCompletness;

		progressRing.animate(percentValueOfAccountFillCompletness / 100);

		// if (dataJSON.percent_value_of_account_fill_completness < 49) {
		// 	accountFillCompletness.className = "";
		// 	accountFillCompletness.classList.add("value__low");
		// }

		// if (
		// 	dataJSON.percent_value_of_account_fill_completness > 49 &&
		// 	75 > dataJSON.percent_value_of_account_fill_completness
		// ) {
		// 	accountFillCompletness.className = "";
		// 	accountFillCompletness.classList.add("value__medium");
		// }

		// if (
		// 	dataJSON.percent_value_of_account_fill_completness > 75 &&
		// 	95 > dataJSON.percent_value_of_account_fill_completness
		// ) {
		// 	accountFillCompletness.className = "";
		// 	accountFillCompletness.classList.add("value__high");
		// }

		// if (dataJSON.percent_value_of_account_fill_completness < 100) {
		// 	accountFillCompletenessWrapper.classList.remove("hide");
		// 	accountFillCompletenessWrapper.classList.add("show");
		// }

		// if (dataJSON.percent_value_of_account_fill_completness === 100) {
		// 	accountFillCompletenessWrapper.classList.remove("show");
		// 	accountFillCompletenessWrapper.classList.add("hide");
		// }

		// Refresh list of empty fields

		const emptyProfileFieldsLabelsContainer = document.querySelector(
			"#emptyProfileFieldsLabels"
		);

		const oldlabelsOfEmptyTranslatorFields = document.querySelectorAll(
			"#emptyProfileFieldsLabels .empty-field-label"
		);

		const labelsOfEmptyTranslatorFieldsAjax =
			dataJSON.labels_of_empty_translator_fields;

		oldlabelsOfEmptyTranslatorFields &&
			removeArrayOfNodes(oldlabelsOfEmptyTranslatorFields);

		labelsOfEmptyTranslatorFieldsAjax &&
			labelsOfEmptyTranslatorFieldsAjax.forEach(label => {
				const newParagraph = document.createElement("P");
				newParagraph.classList.add("empty-field-label");
				newParagraph.textContent = label;

				emptyProfileFieldsLabelsContainer.appendChild(newParagraph);
			});
	};

	/******************************* FORMS ***********************************/

	/* 	AJAX URL path */

	var ajaxurl = ajax_forms_params.ajaxurl;

	/* 	User Basic Info Form */

	const basicUserDataForm = document.querySelector("#basic_user_data_form");

	$(basicUserDataForm).submit(function(event) {
		event.preventDefault();

		const thisAjaxLoader = this.closest(".ajax-content-wrapper").querySelector(
			".my-ajax-loader"
		);

		$.ajax({
			url: ajaxurl + "?action=add_basic_user_data_with_ajax",
			type: "post",
			headers: {
				"Content-Type": "application/x-www-form-urlencoded"
			},
			data: $(basicUserDataForm).serialize(),
			beforeSend: function() {
				// Before we send the request, remove the .hidden class from the spinner and default to inline-block.
				thisAjaxLoader.classList.add("my-ajax-loader--active");

				// And scroll intro view
				basicUserDataForm.closest(".account__box-container").scrollIntoView({
					behavior: "smooth",
					block: "start",
					inline: "nearest"
				});
			},

			complete: function() {
				thisAjaxLoader.classList.remove("my-ajax-loader--active");
			},

			success: function(data) {
				console.log("SUCCESS!");
				console.log(data);
				console.log(JSON.parse(data));
				const dataJSON = JSON.parse(data);

				const postData = dataJSON.post_data;

				const allAccountFirstNames = document.querySelectorAll(
					".account__user-first-name"
				);

				const allAccountLastNames = document.querySelectorAll(
					".account__user-last-name"
				);

				const accountUserName = document.querySelector(
					".account__user-fullname"
				);
				const userBioText = document.querySelector("#user_about_short_text");
				const userLanguagesText = document.querySelector(
					"#user_languages_text"
				);
				const userSpecializationsText = document.querySelector(
					"#user_specializations_text"
				);

				allAccountFirstNames &&
					allAccountFirstNames.forEach(field => {
						field.innerText = postData.user_first_name;
					});

				allAccountLastNames &&
					allAccountLastNames.forEach(field => {
						field.innerText = postData.user_last_name;
					});

				accountUserName.innerText = `${postData.user_first_name} ${postData.user_last_name}`;
				userBioText.innerText = `${postData.user_about_short}`;

				postData.user_languages && postData.user_languages.length > 0
					? (userLanguagesText.innerText = `${postData.user_languages.join(
							", "
					  )}`)
					: (userLanguagesText.innerText = "");

				postData.user_specializations &&
				postData.user_specializations.length > 0
					? (userSpecializationsText.innerText = `${postData.user_specializations.join(
							", "
					  )}`)
					: (userSpecializationsText.innerText = "");

				updateProfileCompletness(dataJSON);

				return data;
			},

			error: function(err) {
				console.log("FAILURE");
				console.log(err);
			}
		});
	});

	/* 	User About Form */

	const aboutUserDataForm = document.querySelector("#about_user_data_form");

	$(aboutUserDataForm).submit(function(event) {
		event.preventDefault();

		const thisAjaxLoader = this.closest(".ajax-content-wrapper").querySelector(
			".my-ajax-loader"
		);

		$.ajax({
			url: ajaxurl + "?action=add_about_user_data_with_ajax",
			type: "post",
			data: $(aboutUserDataForm).serialize(),
			beforeSend: function() {
				// Before we send the request, remove the .hidden class from the spinner and default to inline-block.
				thisAjaxLoader.classList.add("my-ajax-loader--active");

				// And scroll intro view
				// aboutUserDataForm.closest(".account__box-container").scrollIntoView({
				// 	behavior: "smooth",
				// 	block: "start",
				// 	inline: "nearest"
				// });
			},

			complete: function() {
				thisAjaxLoader.classList.remove("my-ajax-loader--active");
			},

			success: function(data) {
				console.log("SUCCESS!");
				console.log(data);

				const dataJSON = JSON.parse(data);
				const postData = dataJSON.post_data;

				const userAboutText = document.querySelector("#user_about_text");
				userAboutText.innerText = `${postData.user_about}`;

				updateProfileCompletness(dataJSON);

				return data;
			},
			error: function(err) {
				console.log("FAILURE");
				console.log(err);
			}
		});
	});

	/* 	User Contact Data Form */

	const contactUserDataForm = document.querySelector("#contact_user_data_form");

	//inputs: #user_city and #user_localization_city needs to share the same value

	$("#user_city").change(function() {
		$("#user_localization_city").val($(this).val());
	});

	$(contactUserDataForm).submit(function(event) {
		event.preventDefault();

		const thisAjaxLoader = this.closest(".ajax-content-wrapper").querySelector(
			".my-ajax-loader"
		);

		$.ajax({
			url: ajaxurl + "?action=add_contact_user_data_with_ajax",
			type: "post",
			data: $(contactUserDataForm).serialize(),
			beforeSend: function() {
				// Before we send the request, remove the .hidden class from the spinner and default to inline-block.
				thisAjaxLoader.classList.add("my-ajax-loader--active");

				// And scroll intro view
				// contactUserDataForm.closest(".account__box-container").scrollIntoView({
				// 	behavior: "smooth",
				// 	block: "start",
				// 	inline: "nearest"
				// });
			},

			complete: function() {
				thisAjaxLoader.classList.remove("my-ajax-loader--active");
			},

			success: function(data) {
				console.log("SUCCESS!");
				console.log(data);

				const dataJSON = JSON.parse(data);

				const postData = dataJSON.post_data;

				const userContactPhoneText = document.querySelector(
					"#user_contact_phone_text"
				);

				if (postData.user_contact_phone) {
					userContactPhoneText.innerText = `${postData.user_contact_phone}`;
				}

				const userContactEmailText = document.querySelector(
					"#user_contact_email_text"
				);

				if (postData.user_contact_email) {
					userContactEmailText.innerText = `${postData.user_contact_email}`;
				}

				const userCityText = document.querySelector("#user_city_text");

				if (postData.user_city) {
					userCityText.innerText = `${postData.user_city}`;
				}

				if (
					postData.user_localizations &&
					postData.user_localizations.length > 0
				) {
					//remove old localizations

					const allUserLocalizations = document.querySelectorAll(
						".user_localization"
					);

					allUserLocalizations.forEach(localization => {
						localization.remove();
					});

					//display all checked localizations

					let allUniqueLocalizations = [
						...new Set(postData.user_localizations)
					];

					allUniqueLocalizations
						.filter(
							localization =>
								localization.length > 0 &&
								localization !== userCityText.innerText
						)
						.forEach(localization => {
							const userLocalizationsColumn = document.querySelector(
								".user_localizations__column"
							);
							let newAddedLocalization = document.createElement("P");
							newAddedLocalization.classList.add(
								"user_localization",
								"info-box__content"
							);

							newAddedLocalization.innerText = localization;

							userLocalizationsColumn.appendChild(newAddedLocalization);
						});

					//remove emoty fields
					console.log(contactUserDataForm);
					let allRepeaterFieldsInThisForm = contactUserDataForm.querySelectorAll(
						".repeater__field"
					);

					allRepeaterFieldsInThisForm.forEach(repeaterField => {
						console.log(repeaterField.querySelector("INPUT").value);
						!repeaterField.querySelector("INPUT").value
							? repeaterField.remove()
							: "";
					});
				}

				updateProfileCompletness(dataJSON);

				return data;
			},
			error: function(err) {
				console.log("FAILURE");
				console.log(err);
			}
		});
	});

	/* 	Upload sound to gallery Form */

	//removing items

	const soundsGalleryWrapper = document.querySelector(".my-sounds__wrapper");
	const soundsToDeleteInput = document.querySelector("#sounds_to_delete");
	let soundsToDeleteArray = [];

	soundsGalleryWrapper &&
		soundsGalleryWrapper.addEventListener("mouseover", function(e) {
			if (e.target.classList.contains("my-sounds__gallery-row-wrapper")) {
				e.target.classList.add("my-sounds__gallery-attachment--hovered");

				e.target.addEventListener("mouseleave", e => {
					e.target.classList.contains("my-sounds__gallery-attachment--hovered")
						? e.target.classList.remove(
								"my-sounds__gallery-attachment--hovered"
						  )
						: "";
				});
			}

			if (e.target.classList.contains("remove-item")) {
				e.target.addEventListener("click", e => {
					e.preventDefault();

					let soundId = e.target.dataset.id;

					let thisSoundWrapper;

					//form
					if (e.target.closest("#upload_sound_to_gallery_form")) {
						// console.log("form");
						thisSoundWrapper = e.target.closest(".new-attachment__preview");

						thisSoundWrapper
							.closest("FORM")
							.querySelector("input[type='file']").value = null;
						thisSoundWrapper.closest(
							".new-attachment__placeholder"
						).style.display = "none";
						thisSoundWrapper.querySelector("p").innerText = null;

						thisSoundWrapper.remove();
					}

					//gallery
					if (e.target.closest(".my-sounds__gallery")) {
						// console.log("gallery");
						thisSoundWrapper = e.target.closest(".row-wrapper");

						let thisSoundPreview = thisSoundWrapper.querySelector(
							".new-attachment__preview"
						);

						thisSoundWrapper && thisSoundWrapper.remove();
						thisSoundPreview && thisSoundPreview.remove();
					}

					if (soundId) {
						!soundsToDeleteArray.includes(soundId)
							? soundsToDeleteArray.push(soundId)
							: "";

						console.log(soundsToDeleteArray);
						soundsToDeleteInput.value = soundsToDeleteArray;
					}
				});
			}
		});

	//uploading

	var uploadSoundToGalleryForm = document.querySelector(
		"#upload_sound_to_gallery_form"
	);

	$(uploadSoundToGalleryForm).submit(function(event) {
		event.preventDefault();

		const submitButton = this.querySelector("input[type='submit']");
		submitButton.classList.remove("reveal-button");
		const uploadSoundPreview = this.querySelector(".input-preview__wrapper");

		const thisAjaxLoader = this.closest(".ajax-content-wrapper").querySelector(
			".my-ajax-loader"
		);

		const allSoundToGalleryInputs = this.querySelectorAll(
			"#sound-to-gallery__input"
		);

		var soundGalleryFormData = new FormData(this);

		const progress = this.querySelector(".progress");
		const progressBar = progress.querySelector(".progress-bar");
		const progressPercents = progress.querySelector(".progress-percents");

		$.ajax({
			xhr: function() {
				const xhr = new window.XMLHttpRequest();
				xhr.upload.addEventListener(
					"progress",
					function(e) {
						if (e.lengthComputable) {
							const percentComplete = (e.loaded / e.total) * 100;
							console.log(percentComplete);
							progress.classList.add("progress-show");
							progressBar.style.width = percentComplete + "%";
							progressPercents.innerText = Math.round(percentComplete) + "%";
						}
					},
					false
				);
				return xhr;
			},
			url: ajaxurl + "?action=handle_sound_to_gallery_upload",
			type: "POST",
			data: soundGalleryFormData,
			async: true,
			cache: false,
			contentType: false,
			enctype: "multipart/form-data",
			processData: false,

			beforeSend: function() {
				// Before we send the request, remove the .hidden class from the spinner and default to inline-block.
				thisAjaxLoader.classList.add("my-ajax-loader--active");

				// And scroll intro view
				// uploadSoundToGalleryForm
				// 	.closest(".account__box-container")
				// 	.scrollIntoView({
				// 		behavior: "smooth",
				// 		block: "start",
				// 		inline: "nearest"
				// 	});
			},

			complete: function(data) {
				thisAjaxLoader.classList.remove("my-ajax-loader--active");
				progress.classList.remove("progress-show");
				const dataJSON = JSON.parse(data.responseText);
				updateProfileCompletness(dataJSON);
			},

			success: function(data) {
				console.log("SUCCESS!");
				console.log(data);

				const dataJSON = JSON.parse(data);

				let addedFilesIds = dataJSON.added_files_ids;
				let addedRows = dataJSON.added_rows;
				let deletedRows = dataJSON.deleted_rows;

				let allNewlyAddedSounds = $(
					"#upload_sound_to_gallery_form .new-attachment__preview"
				);

				// console.log(allNewlyAddedSounds);

				if (addedRows.length > 0) {
					allNewlyAddedSounds.each(function(index) {
						console.log(addedRows[index]);

						let numberOfDeletedRows = deletedRows.length;

						console.log(`numberOfDeletedRows: ${numberOfDeletedRows}`);

						let addedRowIndex = addedRows[index];

						let sound = $(this)
							.clone()
							.css("transform", "scale(0)")
							.css("position", "static")
							.css("transition", "all 0.3s ease-in")
							.css("display", "flex")
							.appendTo(".my-sounds__gallery")
							.addClass(
								"newlyAddedSound row-wrapper my-sounds__gallery-row-wrapper wrapper-flex-drow-mcol"
							);

						sound.find(".my-sounds__gallery-text-wrapper").addClass("col-d50");

						sound
							.find(".my-sounds__gallery-attachment--file-info")
							.addClass("col-d50");

						sound
							.find(".my-sounds__gallery-attachment--label")
							.css("display", "block");

						sound
							.find(".my-sounds__gallery-attachment--description")
							.css("display", "block");

						//clear input
						$(this).css("display", "none");

						setTimeout(function() {
							$(".newlyAddedSound")
								.css("transform", "scale(1)")
								.removeClass("newlyAddedSound");
						}, 200);
					});
				}

				let allRepeaterFieldsInThisForm = $(
					"#upload_sound_to_gallery_form .repeater__field"
				);

				//remove empty repeater fields and leave the 1st one

				if (allRepeaterFieldsInThisForm) {
					allRepeaterFieldsInThisForm.each(function(index) {
						if (index > 0) {
							$(this).remove();
						}
					});
				}

				//reset form
				$(uploadSoundToGalleryForm).trigger("reset");

				soundsToDeleteInput.value = "";
				soundsToDeleteArray = [];

				//re-index fields

				$(".my-sounds__gallery .row-wrapper").each(function(index) {
					//because ACF repeater row indexes starts at 1
					$(this)
						.find("A")
						.attr("data-id", index + 1);
				});

				// Change is-gallery-empty status

				const soundsGallery = document.querySelector(".my-sounds__gallery");

				let addedSounds = soundsGallery.querySelectorAll(
					".my-sounds__gallery-row-wrapper"
				);

				const isGalleryEmptyStatusTextHolder = soundsGallery.querySelector(
					".is-gallery-empty__status-text-holder"
				);

				if (addedSounds.length > 0) {
					isGalleryEmptyStatusTextHolder.textContent = soundsGallery.querySelector(
						".is-gallery-empty__no"
					).textContent;
				} else {
					isGalleryEmptyStatusTextHolder.textContent = soundsGallery.querySelector(
						".is-gallery-empty__yes"
					).textContent;
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(jqXHR);
				console.log(textStatus);
				console.log(errorThrown);

				let errorMessage = jqXHR.responseText;

				console.log(errorMessage);

				let errorMessageNode = $.parseHTML(errorMessage);

				console.log(errorMessageNode);

				modalMessageHolder.appendChild(errorMessageNode[0]);

				showModal();
			}
		});
	});

	/* 	User Linkedin Form */

	const linkedinUserDataForm = document.querySelector(
		"#linkedin_user_data_form"
	);

	$(linkedinUserDataForm).submit(function(event) {
		event.preventDefault();

		const thisAjaxLoader = this.closest(".ajax-content-wrapper").querySelector(
			".my-ajax-loader"
		);

		$.ajax({
			url: ajaxurl + "?action=add_linkedin_user_data_with_ajax",
			type: "post",
			data: $(linkedinUserDataForm).serialize(),
			beforeSend: function() {
				// Before we send the request, remove the .hidden class from the spinner and default to inline-block.
				thisAjaxLoader.classList.add("my-ajax-loader--active");

				// And scroll intro view
				// linkedinUserDataForm.closest(".account__box-container").scrollIntoView({
				// 	behavior: "smooth",
				// 	block: "start",
				// 	inline: "nearest"
				// });
			},

			complete: function() {
				thisAjaxLoader.classList.remove("my-ajax-loader--active");
			},

			success: function(data) {
				console.log("SUCCESS!");
				console.log(data);

				const dataJSON = JSON.parse(data);
				console.log(dataJSON);

				const userlinkedinText = document.querySelector("#user_linkedin_text");

				userlinkedinText.innerText = `${dataJSON.user_linkedin}`;

				updateProfileCompletness(dataJSON);

				return data;
			},
			error: function(err) {
				console.log("FAILURE");
				console.log(err);
			}
		});
	});

	/* 	User work Form */

	const workUserDataForm = document.querySelector("#work_user_data_form");

	$(workUserDataForm).submit(function(event) {
		event.preventDefault();

		const thisAjaxLoader = this.closest(".ajax-content-wrapper").querySelector(
			".my-ajax-loader"
		);

		$.ajax({
			url: ajaxurl + "?action=add_work_user_data_with_ajax",
			type: "post",
			data: $(workUserDataForm).serialize(),
			beforeSend: function() {
				// Before we send the request, remove the .hidden class from the spinner and default to inline-block.
				thisAjaxLoader.classList.add("my-ajax-loader--active");

				// And scroll intro view
				// workUserDataForm.closest(".account__box-container").scrollIntoView({
				// 	behavior: "smooth",
				// 	block: "start",
				// 	inline: "nearest"
				// });
			},

			complete: function() {
				thisAjaxLoader.classList.remove("my-ajax-loader--active");
			},

			success: function(data) {
				console.log("SUCCESS!");
				console.log(data);

				const dataJSON = JSON.parse(data);
				console.log(dataJSON);

				const userworkText = document.querySelector("#user_work_text");

				userworkText.innerText = `${dataJSON.user_work}`;

				updateProfileCompletness(dataJSON);

				return data;
			},
			error: function(err) {
				console.log("FAILURE");
				console.log(err);
			}
		});
	});

	/* 	Upload profile picture Form */

	const uploadProfilePictureForm = document.querySelector(
		"#upload_profile_picture_form"
	);

	$(uploadProfilePictureForm).submit(function(event) {
		event.preventDefault();

		const submitButton = this.querySelector("input[type='submit']");
		submitButton.classList.remove("reveal-button");
		const originalImage = document.querySelector(
			".profile-picture__wrapper .post-thumbnail img"
		);
		const uploadPicturePreview = this.querySelector(".input-preview__wrapper");

		const thisAjaxLoader = this.closest(".ajax-content-wrapper").querySelector(
			".my-ajax-loader"
		);

		var profilePictureformData = new FormData(this);

		$.ajax({
			url: ajaxurl + "?action=handle_profile_picture_upload",
			type: "POST",
			data: profilePictureformData,
			async: true,
			cache: false,
			contentType: false,
			enctype: "multipart/form-data",
			processData: false,

			beforeSend: function() {
				// Before we send the request, remove the .hidden class from the spinner and default to inline-block.
				thisAjaxLoader.classList.add("my-ajax-loader--active");
			},

			complete: function() {
				thisAjaxLoader.classList.remove("my-ajax-loader--active");
				// uploadPicturePreview.classList.remove("has-image");
				uploadPicturePreview.classList.remove("preview-mode");
			},

			success: function(data) {
				console.log("SUCCESS!");
				console.log(data);

				const dataJSON = JSON.parse(data);
				console.log(dataJSON);

				updateProfileCompletness(dataJSON);

				return data;
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(jqXHR);
				console.log(textStatus);
				console.log(errorThrown);

				let errorMessage = jqXHR.responseText;

				console.log(errorMessage);

				let errorMessageNode = $.parseHTML(errorMessage);

				console.log(errorMessageNode);

				modalMessageHolder.appendChild(errorMessageNode[0]);

				showModal();

				originalImage.style.opacity = "1";
				uploadPicturePreview.classList.remove("has-image");
				uploadPicturePreview.classList.remove("preview-mode");
			}
		});
	});

	/* 	Upload image to gallery Form */

	const uploadImageToGalleryForm = document.querySelector(
		"#upload_image_to_gallery_form"
	);

	$(uploadImageToGalleryForm).submit(function(event) {
		event.preventDefault();

		const submitButton = this.querySelector("input[type='submit']");
		submitButton.classList.remove("reveal-button");
		const uploadPicturePreview = this.querySelector(".input-preview__wrapper");

		const thisAjaxLoader = this.closest(".ajax-content-wrapper").querySelector(
			".my-ajax-loader"
		);

		var galleryFormData = new FormData(this);

		const progress = this.querySelector(".progress");
		const progressBar = progress.querySelector(".progress-bar");
		const progressPercents = progress.querySelector(".progress-percents");

		$.ajax({
			xhr: function() {
				const xhr = new window.XMLHttpRequest();
				xhr.upload.addEventListener(
					"progress",
					function(e) {
						if (e.lengthComputable) {
							const percentComplete = (e.loaded / e.total) * 100;
							console.log(percentComplete);
							progress.classList.add("progress-show");
							progressBar.style.width = percentComplete + "%";
							progressPercents.innerText = Math.round(percentComplete) + "%";
						}
					},
					false
				);
				return xhr;
			},
			type: "POST",
			url: ajaxurl + "?action=handle_image_to_gallery_upload",
			data: galleryFormData,
			async: true,
			cache: false,
			contentType: false,
			enctype: "multipart/form-data",
			processData: false,

			beforeSend: function() {
				// Before we send the request, remove the .hidden class from the spinner and default to inline-block.
				thisAjaxLoader.classList.add("my-ajax-loader--active");
			},

			complete: function(data) {
				thisAjaxLoader.classList.remove("my-ajax-loader--active");
				progress.classList.remove("progress-show");
				const dataJSON = JSON.parse(data.responseText);
				updateProfileCompletness(dataJSON);
			},

			success: function(data) {
				console.log("SUCCESS!");
				console.log(data);

				const dataJSON = JSON.parse(data);
				console.log(dataJSON);

				let addedFilesIds = dataJSON.added_files_ids;
				let addedRows = dataJSON.added_rows;
				let deletedRows = dataJSON.deleted_rows;

				let allRepeaterFieldsInThisForm = $(
					"#upload_image_to_gallery_form .repeater__field"
				);

				allRepeaterFieldsInThisForm.each(function(index) {
					console.log(this.querySelector("INPUT").value);

					let allNewAttachmentWrappersInThisForm = this.querySelector(
						".new-attachment__wrapper"
					);

					let repeaterInputValue = this.querySelector("INPUT").value;

					if (repeaterInputValue) {
						$(allNewAttachmentWrappersInThisForm)
							.clone()
							.css("transform", "scale(0)")
							.css("transition", "all 0.3s ease-in")
							.addClass("my-pictures__gallery-attachment")
							.addClass("newlyAddedImage")
							.appendTo(".my-pictures__gallery")
							.children("A")
							.attr("data-id", addedFilesIds[index]);

						// console.log(arrayOfIndexesToDelete[index]);

						// $(this).attr("data-id", arrayOfIndexesToDelete[index]);

						setTimeout(function() {
							$(".newlyAddedImage")
								.css("transform", "scale(1)")
								.removeClass("newlyAddedImage");
						}, 200);
					}
				});

				// let allNewAttachmentWrappersInThisForm = $(
				// 	"#upload_image_to_gallery_form .new-attachment__wrapper"
				// );

				// allNewAttachmentWrappersInThisForm.each(function(index) {

				// });

				//clearings

				$(uploadImageToGalleryForm).trigger("reset");

				allRepeaterFieldsInThisForm.each(function(index) {
					//clear first one
					if (index === 0) {
						$(this)
							.find(".new-attachment__placeholder")
							.attr("src", "");
					}

					//delete rest
					if (index > 0) {
						$(this).remove();
					}
				});

				// Change is-gallery-empty status

				const picturesGallery = document.querySelector(".my-pictures__gallery");

				let addedPictures = picturesGallery.querySelectorAll(
					".my-pictures__gallery-attachment"
				);

				const isGalleryEmptyStatusTextHolder = picturesGallery.querySelector(
					".is-gallery-empty__status-text-holder"
				);

				if (addedPictures.length > 0) {
					isGalleryEmptyStatusTextHolder.textContent = picturesGallery.querySelector(
						".is-gallery-empty__no"
					).textContent;
				} else {
					isGalleryEmptyStatusTextHolder.textContent = picturesGallery.querySelector(
						".is-gallery-empty__yes"
					).textContent;
				}

				return data;
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(jqXHR);
				console.log(textStatus);
				console.log(errorThrown);

				let errorMessage = jqXHR.responseText;

				console.log(errorMessage);

				let errorMessageNode = $.parseHTML(errorMessage);

				console.log(errorMessageNode);

				modalMessageHolder.appendChild(errorMessageNode[0]);

				showModal();

				// jsonValue = jQuery.parseJSON( jqXHR.responseText );
				// console.log(jsonValue.Message);
			}
		});
	});

	/* 	Upload video to gallery Form */

	const uploadVideoToGalleryForm = document.querySelector(
		"#upload_video_to_gallery_form"
	);

	$(uploadVideoToGalleryForm).submit(function(event) {
		event.preventDefault();

		const submitButton = this.querySelector("input[type='submit']");
		submitButton.classList.remove("reveal-button");
		const uploadPicturePreview = this.querySelector(".input-preview__wrapper");

		const thisAjaxLoader = this.closest(".ajax-content-wrapper").querySelector(
			".my-ajax-loader"
		);

		const videoToGalleryInput = this.querySelector("#video-to-gallery__input");

		// console.log(this);

		var videoGalleryFormData = new FormData(this);

		const progress = this.querySelector(".progress");
		const progressBar = progress.querySelector(".progress-bar");
		const progressPercents = progress.querySelector(".progress-percents");

		$.ajax({
			xhr: function() {
				const xhr = new window.XMLHttpRequest();
				xhr.upload.addEventListener(
					"progress",
					function(e) {
						if (e.lengthComputable) {
							const percentComplete = (e.loaded / e.total) * 100;
							console.log(percentComplete);
							progress.classList.add("progress-show");
							progressBar.style.width = percentComplete + "%";
							progressPercents.innerText = Math.round(percentComplete) + "%";
						}
					},
					false
				);
				return xhr;
			},
			url: ajaxurl + "?action=handle_video_to_gallery_upload",
			type: "POST",
			data: videoGalleryFormData,
			async: true,
			cache: false,
			contentType: false,
			enctype: "multipart/form-data",
			processData: false,

			beforeSend: function() {
				// Before we send the request, remove the .hidden class from the spinner and default to inline-block.
				thisAjaxLoader.classList.add("my-ajax-loader--active");

				// uploadVideoToGalleryForm
				// 	.closest(".account__box-container")
				// 	.scrollIntoView({
				// 		behavior: "smooth",
				// 		block: "start",
				// 		inline: "nearest"
				// 	});
			},

			complete: function(data) {
				thisAjaxLoader.classList.remove("my-ajax-loader--active");
				progress.classList.remove("progress-show");
				const dataJSON = JSON.parse(data.responseText);
				updateProfileCompletness(dataJSON);
			},

			success: function(data) {
				console.log("SUCCESS!");
				console.log(data);

				const dataJSON = JSON.parse(data);

				console.log(dataJSON);

				let addedFilesIds = dataJSON.added_files_ids;
				let addedRows = dataJSON.added_rows;
				let deletedRows = dataJSON.deleted_rows;

				let newlyAddedVideo = $("#newVideoInGalleryPlaceholder").clone();

				if (addedRows > 0) {
					newlyAddedVideo
						.css("transform", "scale(0)")
						.css("transition", "all 0.3s ease-in")
						.appendTo(".my-videos__gallery")
						.attr("id", "newlyAddedVideo");

					setTimeout(function() {
						$("#newlyAddedVideo .remove-item").attr("data-id", addedRows[0]);

						$("#newlyAddedVideo")
							.css("transform", "scale(1)")
							.attr("id", "");
					}, 100);

					$("#newVideoInGalleryPlaceholder").css("display", "none");
				}

				//clear input

				videoToGalleryInput.value = null;

				// Change is-gallery-empty status

				const videosGallery = document.querySelector(".my-videos__gallery");

				let addedVideos = videosGallery.querySelectorAll(
					".my-videos__gallery-attachment"
				);

				const isGalleryEmptyStatusTextHolder = videosGallery.querySelector(
					".is-gallery-empty__status-text-holder"
				);

				if (addedVideos.length > 0) {
					isGalleryEmptyStatusTextHolder.textContent = videosGallery.querySelector(
						".is-gallery-empty__no"
					).textContent;
				} else {
					isGalleryEmptyStatusTextHolder.textContent = videosGallery.querySelector(
						".is-gallery-empty__yes"
					).textContent;
				}
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(jqXHR);
				console.log(textStatus);
				console.log(errorThrown);

				let errorMessage = jqXHR.responseText;

				console.log(errorMessage);

				let errorMessageNode = $.parseHTML(errorMessage);

				console.log(errorMessageNode);

				modalMessageHolder.appendChild(errorMessageNode[0]);

				showModal();

				// jsonValue = jQuery.parseJSON( jqXHR.responseText );
				// console.log(jsonValue.Message);
			}
		});
	});

	$("#video-to-gallery__input").change(function(event) {
		$("#newVideoInGalleryPlaceholder").fadeIn(300);
		$("#newVideoInGalleryPlaceholder p").text(event.target.files[0].name);
	});

	/* USERS SETTINGS */

	/* 	User Settings Update Email Form */

	const changeSettingsUserLoginEmail = document.querySelector(
		"#settings_user_login_email_form"
	);

	$(changeSettingsUserLoginEmail).submit(function(event) {
		event.preventDefault();

		const thisAjaxLoader = this.closest(".ajax-content-wrapper").querySelector(
			".my-ajax-loader"
		);

		var changeSettingsUserLoginEmailFormData = new FormData(this);

		$.ajax({
			url: ajaxurl + "?action=change_settings_user_login_email_with_ajax",
			type: "POST",
			data: changeSettingsUserLoginEmailFormData,
			async: true,
			cache: false,
			contentType: false,
			processData: false,

			beforeSend: function() {
				// Before we send the request, remove the .hidden class from the spinner and default to inline-block.
				thisAjaxLoader.classList.add("my-ajax-loader--active");

				// changeSettingsUserLoginEmail
				// 	.closest(".account__box-container")
				// 	.scrollIntoView({
				// 		behavior: "smooth",
				// 		block: "start",
				// 		inline: "nearest"
				// 	});
			},

			complete: function() {
				thisAjaxLoader.classList.remove("my-ajax-loader--active");
			},

			success: function(data) {
				console.log("SUCCESS!");
				console.log(data);

				const dataJSON = JSON.parse(data);

				const userCurrentLoginEmailText = document.querySelector(
					"#user_current_login_email"
				);

				userCurrentLoginEmailText.innerText = `${dataJSON}`;

				return data;
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(jqXHR);
				console.log(textStatus);
				console.log(errorThrown);

				let errorMessage = jqXHR.responseText;

				console.log(errorMessage);

				let errorMessageNode = $.parseHTML(errorMessage);

				console.log(errorMessageNode);

				modalMessageHolder.appendChild(errorMessageNode[0]);

				showModal();

				// jsonValue = jQuery.parseJSON( jqXHR.responseText );
				// console.log(jsonValue.Message);
			}
		});
	});

	/* 	User Settings Update Password */

	// Modal for errors displayed on page reload

	const allphpErrorContentainers = document.querySelectorAll(
		".php-error__content"
	);

	allphpErrorContentainers &&
		allphpErrorContentainers.forEach(container => {
			let singleErrors = container.querySelectorAll(".php-error__text");
			showModal(singleErrors);
		});

	// var changeSettingsUserPassword =
	// 	ajax_forms_params.settings_user_password_form;

	// $(changeSettingsUserPassword).submit(function(event) {
	// 	event.preventDefault();

	// 	const thisAjaxLoader = this.closest(".ajax-content-wrapper").querySelector(
	// 		".my-ajax-loader"
	// 	);

	// 	var changeSettingsUserPasswordFormData = new FormData(this);

	// 	$.ajax({
	// 		url: ajaxurl + "?action=change_settings_user_password_with_ajax",
	// 		type: "POST",
	// 		data: changeSettingsUserPasswordFormData,
	// 		async: true,
	// 		cache: false,
	// 		contentType: false,
	// 		processData: false,

	// 		beforeSend: function() {
	// 			// Before we send the request, remove the .hidden class from the spinner and default to inline-block.
	// 			thisAjaxLoader.classList.add("my-ajax-loader--active");
	// 		},

	// 		complete: function() {
	// 			thisAjaxLoader.classList.remove("my-ajax-loader--active");
	// 		},

	// 		success: function(data) {
	// 			console.log("SUCCESS!");
	// 			console.log(data);

	// 			// const dataJSON = JSON.parse(data);

	// 			// console.log(dataJSON);

	// 			// const userCurrentLoginEmailText = document.querySelector(
	// 			// 	"#user_current_login_email"
	// 			// );

	// 			// userCurrentLoginEmailText.innerText = `${dataJSON}`;

	// 			let successMessageNode = $.parseHTML(data);

	// 			modalMessageHolder.appendChild(successMessageNode[0]);

	// 			showModal();

	// 			return data;
	// 		},
	// 		error: function(jqXHR, textStatus, errorThrown) {
	// 			console.log(jqXHR);
	// 			console.log(textStatus);
	// 			console.log(errorThrown);

	// 			let errorMessage = jqXHR.responseText;

	// 			console.log(errorMessage);

	// 			let errorMessageNode = $.parseHTML(errorMessage);

	// 			console.log(errorMessageNode);

	// 			modalMessageHolder.appendChild(errorMessageNode[0]);

	// 			showModal();

	// 			// jsonValue = jQuery.parseJSON( jqXHR.responseText );
	// 			// console.log(jsonValue.Message);
	// 		}
	// 	});
	// });

	/* UPDATE VISIBILITY SETTINGS FORM */

	var userDataVisibilityForm = document.querySelector(
		"#settings_user_data_visibility_form"
	);

	$(userDataVisibilityForm).submit(function(event) {
		event.preventDefault();

		const thisAjaxLoader = this.closest(".ajax-content-wrapper").querySelector(
			".my-ajax-loader"
		);

		$.ajax({
			url: ajaxurl + "?action=change_settings_user_data_visibility_with_ajax",
			type: "post",
			data: $(userDataVisibilityForm).serialize(),
			beforeSend: function() {
				// Before we send the request, remove the .hidden class from the spinner and default to inline-block.
				thisAjaxLoader.classList.add("my-ajax-loader--active");

				// userDataVisibilityForm
				// 	.closest(".account__box-container")
				// 	.scrollIntoView({
				// 		behavior: "smooth",
				// 		block: "start",
				// 		inline: "nearest"
				// 	});
			},

			complete: function() {
				thisAjaxLoader.classList.remove("my-ajax-loader--active");
			},

			success: function(data) {
				console.log("SUCCESS!");
				console.log(data);
				const dataJSON = JSON.parse(data);

				const isProfilePublic = dataJSON.profile_is_public;

				let isProfilePublicStatus = document.querySelector(
					".account__privacy-status"
				);

				if (isProfilePublic && isProfilePublicStatus) {
					// profileStatusIcon.style.fill = "green";
					isProfilePublicStatus.classList.remove("account__private");
					isProfilePublicStatus.classList.add("account__public");
				} else {
					// profileStatusIcon.style.fill = "#cacaca";
					isProfilePublicStatus.classList.remove("account__public");
					isProfilePublicStatus.classList.add("account__private");
				}

				// accountIsPublicIcon.style.

				// const dataJSON = JSON.parse(data);

				// const userworkText = document.querySelector("#user_work_text");

				// userworkText.innerText = `${dataJSON.user_work}`;

				return data;
			},
			error: function(err) {
				console.log("FAILURE");
				console.log(err);
			}
		});
	});
});
