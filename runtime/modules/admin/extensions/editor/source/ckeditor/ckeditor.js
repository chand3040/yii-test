﻿/*

 Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.

 For licensing, see LICENSE.html or http://ckeditor.com/license

 */


(function () {
    if (!window.CKEDITOR)window.CKEDITOR = (function () {
        var a = {
            timestamp: 'ABLC4TW',
            version: '3.5',
            revision: '6260',
            _: {},
            status: 'unloaded',
            basePath: (function () {
                var d = window.CKEDITOR_BASEPATH || '';
                if (!d) {
                    var e = document.getElementsByTagName('script');
                    for (var f = 0; f < e.length; f++) {
                        var g = e[f].src.match(/(^|.*[\\\/])ckeditor(?:_basic)?(?:_source)?.js(?:\?.*)?$/i);
                        if (g) {
                            d = g[1];
                            break;
                        }
                    }
                }
                if (d.indexOf(':/') == -1)if (d.indexOf('/') === 0)d = location.href.match(/^.*?:\/\/[^\/]*/)[0] + d; else d = location.href.match(/^[^\?]*\/(?:)/)[0] + d;
                if (!d)throw 'The CKEditor installation path could not be automatically detected. Please set the global variable "CKEDITOR_BASEPATH" before creating editor instances.';
                return d;
            })(),
            getUrl: function (d) {
                if (d.indexOf(':/') == -1 && d.indexOf('/') !== 0)d = this.basePath + d;
                if (this.timestamp && d.charAt(d.length - 1) != '/' && !/[&?]t=/.test(d))d += (d.indexOf('?') >= 0 ? '&' : '?') + 't=' + this.timestamp;
                return d;
            }
        }, b = window.CKEDITOR_GETURL;
        if (b) {
            var c = a.getUrl;
            a.getUrl = function (d) {
                return b.call(a, d) || c.call(a, d);
            };
        }
        return a;
    })();
    var a = CKEDITOR;
    if (!a.event) {
        a.event = function () {
        };
        a.event.implementOn = function (b) {
            var c = a.event.prototype;
            for (var d in c) {
                if (b[d] == undefined)b[d] = c[d];
            }
        };
        a.event.prototype = (function () {
            var b = function (d) {
                var e = d.getPrivate && d.getPrivate() || d._ || (d._ = {});
                return e.events || (e.events = {});
            }, c = function (d) {
                this.name = d;
                this.listeners = [];
            };
            c.prototype = {
                getListenerIndex: function (d) {
                    for (var e = 0, f = this.listeners; e < f.length; e++) {
                        if (f[e].fn == d)return e;
                    }
                    return -1;
                }
            };
            return {
                on: function (d, e, f, g, h) {
                    var i = b(this), j = i[d] || (i[d] = new c(d));
                    if (j.getListenerIndex(e) < 0) {
                        var k = j.listeners;
                        if (!f)f = this;
                        if (isNaN(h))h = 10;
                        var l = this, m = function (o, p, q, r) {
                            var s = {
                                name: d,
                                sender: this,
                                editor: o,
                                data: p,
                                listenerData: g,
                                stop: q,
                                cancel: r,
                                removeListener: function () {
                                    l.removeListener(d, e);
                                }
                            };
                            e.call(f, s);
                            return s.data;
                        };
                        m.fn = e;
                        m.priority = h;
                        for (var n = k.length - 1; n >= 0; n--) {
                            if (k[n].priority <= h) {
                                k.splice(n + 1, 0, m);
                                return;
                            }
                        }
                        k.unshift(m);
                    }
                }, fire: (function () {
                    var d = false, e = function () {
                        d = true;
                    }, f = false, g = function () {
                        f = true;
                    };
                    return function (h, i, j) {
                        var k = b(this)[h], l = d, m = f;
                        d = f = false;
                        if (k) {
                            var n = k.listeners;
                            if (n.length) {
                                n = n.slice(0);
                                for (var o = 0; o < n.length; o++) {
                                    var p = n[o].call(this, j, i, e, g);
                                    if (typeof p != 'undefined')i = p;
                                    if (d || f)break;
                                }
                            }
                        }
                        var q = f || (typeof i == 'undefined' ? false : i);
                        d = l;
                        f = m;
                        return q;
                    };
                })(), fireOnce: function (d, e, f) {
                    var g = this.fire(d, e, f);
                    delete b(this)[d];
                    return g;
                }, removeListener: function (d, e) {
                    var f = b(this)[d];
                    if (f) {
                        var g = f.getListenerIndex(e);
                        if (g >= 0)f.listeners.splice(g, 1);
                    }
                }, hasListeners: function (d) {
                    var e = b(this)[d];

                    return e && e.listeners.length > 0;
                }
            };
        })();
    }
    if (!a.editor) {
        a.ELEMENT_MODE_NONE = 0;
        a.ELEMENT_MODE_REPLACE = 1;
        a.ELEMENT_MODE_APPENDTO = 2;
        a.editor = function (b, c, d, e) {
            var f = this;
            f._ = {instanceConfig: b, element: c, data: e};
            f.elementMode = d || 0;
            a.event.call(f);
            f._init();
        };
        a.editor.replace = function (b, c) {
            var d = b;
            if (typeof d != 'object') {
                d = document.getElementById(b);
                if (!d) {
                    var e = 0, f = document.getElementsByName(b);
                    while ((d = f[e++]) && d.tagName.toLowerCase() != 'textarea') {
                    }
                }
                if (!d)throw '[CKEDITOR.editor.replace] The element with id or name "' + b + '" was not found.';
            }
            d.style.visibility = 'hidden';
            return new a.editor(c, d, 1);
        };
        a.editor.appendTo = function (b, c, d) {
            var e = b;
            if (typeof e != 'object') {
                e = document.getElementById(b);
                if (!e)throw '[CKEDITOR.editor.appendTo] The element with id "' + b + '" was not found.';
            }
            return new a.editor(c, e, 2, d);
        };
        a.editor.prototype = {
            _init: function () {
                var b = a.editor._pending || (a.editor._pending = []);
                b.push(this);
            }, fire: function (b, c) {
                return a.event.prototype.fire.call(this, b, c, this);
            }, fireOnce: function (b, c) {
                return a.event.prototype.fireOnce.call(this, b, c, this);
            }
        };
        a.event.implementOn(a.editor.prototype, true);
    }
    if (!a.env)a.env = (function () {
        var b = navigator.userAgent.toLowerCase(), c = window.opera, d = {
            ie: /*@cc_on!@*/false,
            opera: !!c && c.version,
            webkit: b.indexOf(' applewebkit/') > -1,
            air: b.indexOf(' adobeair/') > -1,
            mac: b.indexOf('macintosh') > -1,
            quirks: document.compatMode == 'BackCompat',
            mobile: b.indexOf('mobile') > -1,
            isCustomDomain: function () {
                if (!this.ie)return false;
                var g = document.domain, h = window.location.hostname;
                return g != h && g != '[' + h + ']';
            }
        };
        d.gecko = navigator.product == 'Gecko' && !d.webkit && !d.opera;
        var e = 0;
        if (d.ie) {
            e = parseFloat(b.match(/msie (\d+)/)[1]);
            d.ie8 = !!document.documentMode;
            d.ie8Compat = document.documentMode == 8;
            d.ie7Compat = e == 7 && !document.documentMode || document.documentMode == 7;
            d.ie6Compat = e < 7 || d.quirks;
        }
        if (d.gecko) {
            var f = b.match(/rv:([\d\.]+)/);
            if (f) {
                f = f[1].split('.');
                e = f[0] * 10000 + (f[1] || 0) * 100 + +(f[2] || 0);
            }
        }
        if (d.opera)e = parseFloat(c.version());
        if (d.air)e = parseFloat(b.match(/ adobeair\/(\d+)/)[1]);
        if (d.webkit)e = parseFloat(b.match(/ applewebkit\/(\d+)/)[1]);
        d.version = e;
        d.isCompatible = !d.mobile && (d.ie && e >= 6 || d.gecko && e >= 10801 || d.opera && e >= 9.5 || d.air && e >= 1 || d.webkit && e >= 522 || false);
        d.cssClass = 'cke_browser_' + (d.ie ? 'ie' : d.gecko ? 'gecko' : d.opera ? 'opera' : d.webkit ? 'webkit' : 'unknown');
        if (d.quirks)d.cssClass += ' cke_browser_quirks';
        if (d.ie) {
            d.cssClass += ' cke_browser_ie' + (d.version < 7 ? '6' : d.version >= 8 ? document.documentMode : '7');
            if (d.quirks)d.cssClass += ' cke_browser_iequirks';
        }
        if (d.gecko && e < 10900)d.cssClass += ' cke_browser_gecko18';

        if (d.air)d.cssClass += ' cke_browser_air';
        return d;
    })();
    var b = a.env;
    var c = b.ie;
    if (a.status == 'unloaded')(function () {
        a.event.implementOn(a);
        a.loadFullCore = function () {
            if (a.status != 'basic_ready') {
                a.loadFullCore._load = 1;
                return;
            }
            delete a.loadFullCore;
            var e = document.createElement('script');
            e.type = 'text/javascript';
            e.src = a.basePath + 'ckeditor.js';
            document.getElementsByTagName('head')[0].appendChild(e);
        };
        a.loadFullCoreTimeout = 0;
        a.replaceClass = 'ckeditor';
        a.replaceByClassEnabled = 1;
        var d = function (e, f, g, h) {
            if (b.isCompatible) {
                if (a.loadFullCore)a.loadFullCore();
                var i = g(e, f, h);
                a.add(i);
                return i;
            }
            return null;
        };
        a.replace = function (e, f) {
            return d(e, f, a.editor.replace);
        };
        a.appendTo = function (e, f, g) {
            return d(e, f, a.editor.appendTo, g);
        };
        a.add = function (e) {
            var f = this._.pending || (this._.pending = []);
            f.push(e);
        };
        a.replaceAll = function () {
            var e = document.getElementsByTagName('textarea');
            for (var f = 0; f < e.length; f++) {
                var g = null, h = e[f], i = h.name;
                if (!h.name && !h.id)continue;
                if (typeof arguments[0] == 'string') {
                    var j = new RegExp('(?:^|\\s)' + arguments[0] + '(?:$|\\s)');
                    if (!j.test(h.className))continue;
                } else if (typeof arguments[0] == 'function') {
                    g = {};
                    if (arguments[0](h, g) === false)continue;
                }
                this.replace(h, g);
            }
        };
        (function () {
            var e = function () {
                var f = a.loadFullCore, g = a.loadFullCoreTimeout;
                if (a.replaceByClassEnabled)a.replaceAll(a.replaceClass);
                a.status = 'basic_ready';
                if (f && f._load)f(); else if (g)setTimeout(function () {
                    if (a.loadFullCore)a.loadFullCore();
                }, g * 1000);
            };
            if (window.addEventListener)window.addEventListener('load', e, false); else if (window.attachEvent)window.attachEvent('onload', e);
        })();
        a.status = 'basic_loaded';
    })();
    a.dom = {};
    var d = a.dom;
    (function () {
        var e = [];
        a.on('reset', function () {
            e = [];
        });
        a.tools = {
            arrayCompare: function (f, g) {
                if (!f && !g)return true;
                if (!f || !g || f.length != g.length)return false;
                for (var h = 0; h < f.length; h++) {
                    if (f[h] != g[h])return false;
                }
                return true;
            }, clone: function (f) {
                var g;
                if (f && f instanceof Array) {
                    g = [];
                    for (var h = 0; h < f.length; h++)g[h] = this.clone(f[h]);
                    return g;
                }
                if (f === null || typeof f != 'object' || f instanceof String || f instanceof Number || f instanceof Boolean || f instanceof Date || f instanceof RegExp)return f;
                g = new f.constructor();
                for (var i in f) {
                    var j = f[i];
                    g[i] = this.clone(j);
                }
                return g;
            }, capitalize: function (f) {
                return f.charAt(0).toUpperCase() + f.substring(1).toLowerCase();
            }, extend: function (f) {
                var g = arguments.length, h, i;
                if (typeof (h = arguments[g - 1]) == 'boolean')g--; else if (typeof (h = arguments[g - 2]) == 'boolean') {
                    i = arguments[g - 1];
                    g -= 2;
                }
                for (var j = 1; j < g; j++) {
                    var k = arguments[j];
                    for (var l in k) {
                        if (h === true || f[l] == undefined)if (!i || l in i)f[l] = k[l];

                    }
                }
                return f;
            }, prototypedCopy: function (f) {
                var g = function () {
                };
                g.prototype = f;
                return new g();
            }, isArray: function (f) {
                return !!f && f instanceof Array;
            }, isEmpty: function (f) {
                for (var g in f) {
                    if (f.hasOwnProperty(g))return false;
                }
                return true;
            }, cssStyleToDomStyle: (function () {
                var f = document.createElement('div').style, g = typeof f.cssFloat != 'undefined' ? 'cssFloat' : typeof f.styleFloat != 'undefined' ? 'styleFloat' : 'float';
                return function (h) {
                    if (h == 'float')return g; else return h.replace(/-./g, function (i) {
                        return i.substr(1).toUpperCase();
                    });
                };
            })(), buildStyleHtml: function (f) {
                f = [].concat(f);
                var g, h = [];
                for (var i = 0; i < f.length; i++) {
                    g = f[i];
                    if (/@import|[{}]/.test(g))h.push('<style>' + g + '</style>'); else h.push('<link type="text/css" rel=stylesheet href="' + g + '">');
                }
                return h.join('');
            }, htmlEncode: function (f) {
                var g = function (k) {
                    var l = new d.element('span');
                    l.setText(k);
                    return l.getHtml();
                }, h = g('\n').toLowerCase() == '<br>' ? function (k) {
                    return g(k).replace(/<br>/gi, '\n');
                } : g, i = g('>') == '>' ? function (k) {
                    return h(k).replace(/>/g, '&gt;');
                } : h, j = g('  ') == '&nbsp; ' ? function (k) {
                    return i(k).replace(/&nbsp;/g, ' ');
                } : i;
                this.htmlEncode = j;
                return this.htmlEncode(f);
            }, htmlEncodeAttr: function (f) {
                return f.replace(/"/g, '&quot;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
            }, getNextNumber: (function () {
                var f = 0;
                return function () {
                    return ++f;
                };
            })(), getNextId: function () {
                return 'cke_' + this.getNextNumber();
            }, override: function (f, g) {
                return g(f);
            }, setTimeout: function (f, g, h, i, j) {
                if (!j)j = window;
                if (!h)h = j;
                return j.setTimeout(function () {
                    if (i)f.apply(h, [].concat(i)); else f.apply(h);
                }, g || 0);
            }, trim: (function () {
                var f = /(?:^[ \t\n\r]+)|(?:[ \t\n\r]+$)/g;
                return function (g) {
                    return g.replace(f, '');
                };
            })(), ltrim: (function () {
                var f = /^[ \t\n\r]+/g;
                return function (g) {
                    return g.replace(f, '');
                };
            })(), rtrim: (function () {
                var f = /[ \t\n\r]+$/g;
                return function (g) {
                    return g.replace(f, '');
                };
            })(), indexOf: Array.prototype.indexOf ? function (f, g) {
                return f.indexOf(g);
            } : function (f, g) {
                for (var h = 0, i = f.length; h < i; h++) {
                    if (f[h] === g)return h;
                }
                return -1;
            }, bind: function (f, g) {
                return function () {
                    return f.apply(g, arguments);
                };
            }, createClass: function (f) {
                var g = f.$, h = f.base, i = f.privates || f._, j = f.proto, k = f.statics;
                if (i) {
                    var l = g;
                    g = function () {
                        var p = this;
                        var m = p._ || (p._ = {});
                        for (var n in i) {
                            var o = i[n];
                            m[n] = typeof o == 'function' ? a.tools.bind(o, p) : o;
                        }
                        l.apply(p, arguments);
                    };
                }
                if (h) {
                    g.prototype = this.prototypedCopy(h.prototype);
                    g.prototype['constructor'] = g;
                    g.prototype.base = function () {
                        this.base = h.prototype.base;
                        h.apply(this, arguments);
                        this.base = arguments.callee;
                    };
                }
                if (j)this.extend(g.prototype, j, true);
                if (k)this.extend(g, k, true);

                return g;
            }, addFunction: function (f, g) {
                return e.push(function () {
                    return f.apply(g || this, arguments);
                }) - 1;
            }, removeFunction: function (f) {
                e[f] = null;
            }, callFunction: function (f) {
                var g = e[f];
                return g && g.apply(window, Array.prototype.slice.call(arguments, 1));
            }, cssLength: (function () {
                var f = /^\d+(?:\.\d+)?$/;
                return function (g) {
                    return g + (f.test(g) ? 'px' : '');
                };
            })(), repeat: function (f, g) {
                return new Array(g + 1).join(f);
            }, tryThese: function () {
                var f;
                for (var g = 0, h = arguments.length; g < h; g++) {
                    var i = arguments[g];
                    try {
                        f = i();
                        break;
                    } catch (j) {
                    }
                }
                return f;
            }, genKey: function () {
                return Array.prototype.slice.call(arguments).join('-');
            }
        };
    })();
    var e = a.tools;
    a.dtd = (function () {
        var f = e.extend, g = {isindex: 1, fieldset: 1}, h = {
            input: 1,
            button: 1,
            select: 1,
            textarea: 1,
            label: 1
        }, i = f({a: 1}, h), j = f({iframe: 1}, i), k = {
            hr: 1,
            ul: 1,
            menu: 1,
            div: 1,
            blockquote: 1,
            noscript: 1,
            table: 1,
            center: 1,
            address: 1,
            dir: 1,
            pre: 1,
            h5: 1,
            dl: 1,
            h4: 1,
            noframes: 1,
            h6: 1,
            ol: 1,
            h1: 1,
            h3: 1,
            h2: 1
        }, l = {ins: 1, del: 1, script: 1, style: 1}, m = f({
            b: 1,
            acronym: 1,
            bdo: 1,
            'var': 1,
            '#': 1,
            abbr: 1,
            code: 1,
            br: 1,
            i: 1,
            cite: 1,
            kbd: 1,
            u: 1,
            strike: 1,
            s: 1,
            tt: 1,
            strong: 1,
            q: 1,
            samp: 1,
            em: 1,
            dfn: 1,
            span: 1
        }, l), n = f({
            sub: 1,
            img: 1,
            object: 1,
            sup: 1,
            basefont: 1,
            map: 1,
            applet: 1,
            font: 1,
            big: 1,
            small: 1
        }, m), o = f({p: 1}, n), p = f({iframe: 1}, n, h), q = {
            img: 1,
            noscript: 1,
            br: 1,
            kbd: 1,
            center: 1,
            button: 1,
            basefont: 1,
            h5: 1,
            h4: 1,
            samp: 1,
            h6: 1,
            ol: 1,
            h1: 1,
            h3: 1,
            h2: 1,
            form: 1,
            font: 1,
            '#': 1,
            select: 1,
            menu: 1,
            ins: 1,
            abbr: 1,
            label: 1,
            code: 1,
            table: 1,
            script: 1,
            cite: 1,
            input: 1,
            iframe: 1,
            strong: 1,
            textarea: 1,
            noframes: 1,
            big: 1,
            small: 1,
            span: 1,
            hr: 1,
            sub: 1,
            bdo: 1,
            'var': 1,
            div: 1,
            object: 1,
            sup: 1,
            strike: 1,
            dir: 1,
            map: 1,
            dl: 1,
            applet: 1,
            del: 1,
            isindex: 1,
            fieldset: 1,
            ul: 1,
            b: 1,
            acronym: 1,
            a: 1,
            blockquote: 1,
            i: 1,
            u: 1,
            s: 1,
            tt: 1,
            address: 1,
            q: 1,
            pre: 1,
            p: 1,
            em: 1,
            dfn: 1
        }, r = f({a: 1}, p), s = {tr: 1}, t = {'#': 1}, u = f({param: 1}, q), v = f({form: 1}, g, j, k, o), w = {li: 1}, x = {
            style: 1,
            script: 1
        }, y = {base: 1, link: 1, meta: 1, title: 1}, z = f(y, x), A = {
            head: 1,
            body: 1
        }, B = {html: 1}, C = {
            address: 1,
            blockquote: 1,
            center: 1,
            dir: 1,
            div: 1,
            dl: 1,
            fieldset: 1,
            form: 1,
            h1: 1,
            h2: 1,
            h3: 1,
            h4: 1,
            h5: 1,
            h6: 1,
            hr: 1,
            isindex: 1,
            menu: 1,
            noframes: 1,
            ol: 1,
            p: 1,
            pre: 1,
            table: 1,
            ul: 1
        };
        return {
            $nonBodyContent: f(B, A, y),
            $block: C,
            $blockLimit: {body: 1, div: 1, td: 1, th: 1, caption: 1, form: 1},
            $inline: r,
            $body: f({script: 1, style: 1}, C),
            $cdata: {script: 1, style: 1},
            $empty: {area: 1, base: 1, br: 1, col: 1, hr: 1, img: 1, input: 1, link: 1, meta: 1, param: 1},
            $listItem: {dd: 1, dt: 1, li: 1},
            $list: {ul: 1, ol: 1, dl: 1},
            $nonEditable: {
                applet: 1,
                button: 1,
                embed: 1,
                iframe: 1,
                map: 1,
                object: 1,
                option: 1,
                script: 1,
                textarea: 1,
                param: 1
            },
            $removeEmpty: {
                abbr: 1,
                acronym: 1,
                address: 1,
                b: 1,
                bdo: 1,
                big: 1,
                cite: 1,
                code: 1,
                del: 1,
                dfn: 1,
                em: 1,
                font: 1,
                i: 1,
                ins: 1,
                label: 1,
                kbd: 1,
                q: 1,
                s: 1,
                samp: 1,
                small: 1,
                span: 1,
                strike: 1,
                strong: 1,
                sub: 1,
                sup: 1,
                tt: 1,
                u: 1,
                'var': 1
            },
            $tabIndex: {a: 1, area: 1, button: 1, input: 1, object: 1, select: 1, textarea: 1},
            $tableContent: {caption: 1, col: 1, colgroup: 1, tbody: 1, td: 1, tfoot: 1, th: 1, thead: 1, tr: 1},
            html: A,
            head: z,
            style: t,
            script: t,
            body: v,
            base: {},
            link: {},
            meta: {},
            title: t,
            col: {},
            tr: {td: 1, th: 1},
            img: {},
            colgroup: {col: 1},
            noscript: v,
            td: v,
            br: {},
            th: v,
            center: v,
            kbd: r,
            button: f(o, k),
            basefont: {},
            h5: r,
            h4: r,
            samp: r,
            h6: r,
            ol: w,
            h1: r,
            h3: r,
            option: t,
            h2: r,
            form: f(g, j, k, o),
            select: {optgroup: 1, option: 1},
            font: r,
            ins: r,
            menu: w,
            abbr: r,
            label: r,
            table: {thead: 1, col: 1, tbody: 1, tr: 1, colgroup: 1, caption: 1, tfoot: 1},
            code: r,
            script: t,
            tfoot: s,
            cite: r,
            li: v,
            input: {},
            iframe: v,
            strong: r,
            textarea: t,
            noframes: v,
            big: r,
            small: r,
            span: r,
            hr: {},
            dt: r,
            sub: r,
            optgroup: {option: 1},
            param: {},
            bdo: r,
            'var': r,
            div: v,
            object: u,
            sup: r,
            dd: v,
            strike: r,
            area: {},
            dir: w,
            map: f({area: 1, form: 1, p: 1}, g, l, k),
            applet: u,
            dl: {dt: 1, dd: 1},
            del: r,
            isindex: {},
            fieldset: f({legend: 1}, q),
            thead: s,
            ul: w,
            acronym: r,
            b: r,
            a: p,
            blockquote: v,
            caption: r,
            i: r,
            u: r,
            tbody: s,
            s: r,
            address: f(j, o),
            tt: r,
            legend: r,
            q: r,
            pre: f(m, i),
            p: r,
            em: r,
            dfn: r
        };

    })();
    var f = a.dtd;
    d.event = function (g) {
        this.$ = g;
    };
    d.event.prototype = {
        getKey: function () {
            return this.$.keyCode || this.$.which;
        }, getKeystroke: function () {
            var h = this;
            var g = h.getKey();
            if (h.$.ctrlKey || h.$.metaKey)g += 1000;
            if (h.$.shiftKey)g += 2000;
            if (h.$.altKey)g += 4000;
            return g;
        }, preventDefault: function (g) {
            var h = this.$;
            if (h.preventDefault)h.preventDefault(); else h.returnValue = false;
            if (g)this.stopPropagation();
        }, stopPropagation: function () {
            var g = this.$;
            if (g.stopPropagation)g.stopPropagation(); else g.cancelBubble = true;
        }, getTarget: function () {
            var g = this.$.target || this.$.srcElement;
            return g ? new d.node(g) : null;
        }
    };
    a.CTRL = 1000;
    a.SHIFT = 2000;
    a.ALT = 4000;
    d.domObject = function (g) {
        if (g)this.$ = g;
    };
    d.domObject.prototype = (function () {
        var g = function (h, i) {
            return function (j) {
                if (typeof a != 'undefined')h.fire(i, new d.event(j));
            };
        };
        return {
            getPrivate: function () {
                var h;
                if (!(h = this.getCustomData('_')))this.setCustomData('_', h = {});
                return h;
            }, on: function (h) {
                var k = this;
                var i = k.getCustomData('_cke_nativeListeners');
                if (!i) {
                    i = {};
                    k.setCustomData('_cke_nativeListeners', i);
                }
                if (!i[h]) {
                    var j = i[h] = g(k, h);
                    if (k.$.attachEvent)k.$.attachEvent('on' + h, j); else if (k.$.addEventListener)k.$.addEventListener(h, j, !!a.event.useCapture);
                }
                return a.event.prototype.on.apply(k, arguments);
            }, removeListener: function (h) {
                var k = this;
                a.event.prototype.removeListener.apply(k, arguments);
                if (!k.hasListeners(h)) {
                    var i = k.getCustomData('_cke_nativeListeners'), j = i && i[h];
                    if (j) {
                        if (k.$.detachEvent)k.$.detachEvent('on' + h, j); else if (k.$.removeEventListener)k.$.removeEventListener(h, j, false);
                        delete i[h];
                    }
                }
            }, removeAllListeners: function () {
                var k = this;
                var h = k.getCustomData('_cke_nativeListeners');
                for (var i in h) {
                    var j = h[i];
                    if (k.$.detachEvent)k.$.detachEvent('on' + i, j); else if (k.$.removeEventListener)k.$.removeEventListener(i, j, false);
                    delete h[i];
                }
            }
        };
    })();
    (function (g) {
        var h = {};
        a.on('reset', function () {
            h = {};
        });
        g.equals = function (i) {
            return i && i.$ === this.$;
        };
        g.setCustomData = function (i, j) {
            var k = this.getUniqueId(), l = h[k] || (h[k] = {});
            l[i] = j;
            return this;
        };
        g.getCustomData = function (i) {
            var j = this.$['data-cke-expando'], k = j && h[j];
            return k && k[i];
        };
        g.removeCustomData = function (i) {
            var j = this.$['data-cke-expando'], k = j && h[j], l = k && k[i];
            if (typeof l != 'undefined')delete k[i];
            return l || null;
        };
        g.clearCustomData = function () {
            this.removeAllListeners();
            var i = this.$['data-cke-expando'];
            i && delete h[i];
        };
        g.getUniqueId = function () {
            return this.$['data-cke-expando'] || (this.$['data-cke-expando'] = e.getNextNumber());
        };
        a.event.implementOn(g);
    })(d.domObject.prototype);
    d.window = function (g) {
        d.domObject.call(this, g);

    };
    d.window.prototype = new d.domObject();
    e.extend(d.window.prototype, {
        focus: function () {
            if (b.webkit && this.$.parent)this.$.parent.focus();
            this.$.focus();
        }, getViewPaneSize: function () {
            var g = this.$.document, h = g.compatMode == 'CSS1Compat';
            return {
                width: (h ? g.documentElement.clientWidth : g.body.clientWidth) || 0,
                height: (h ? g.documentElement.clientHeight : g.body.clientHeight) || 0
            };
        }, getScrollPosition: function () {
            var g = this.$;
            if ('pageXOffset' in g)return {x: g.pageXOffset || 0, y: g.pageYOffset || 0}; else {
                var h = g.document;
                return {
                    x: h.documentElement.scrollLeft || h.body.scrollLeft || 0,
                    y: h.documentElement.scrollTop || h.body.scrollTop || 0
                };
            }
        }
    });
    d.document = function (g) {
        d.domObject.call(this, g);
    };
    var g = d.document;
    g.prototype = new d.domObject();
    e.extend(g.prototype, {
        appendStyleSheet: function (h) {
            if (this.$.createStyleSheet)this.$.createStyleSheet(h); else {
                var i = new d.element('link');
                i.setAttributes({rel: 'stylesheet', type: 'text/css', href: h});
                this.getHead().append(i);
            }
        }, appendStyleText: function (h) {
            var k = this;
            if (k.$.createStyleSheet) {
                var i = k.$.createStyleSheet('');
                i.cssText = h;
            } else {
                var j = new d.element('style', k);
                j.append(new d.text(h, k));
                k.getHead().append(j);
            }
        }, createElement: function (h, i) {
            var j = new d.element(h, this);
            if (i) {
                if (i.attributes)j.setAttributes(i.attributes);
                if (i.styles)j.setStyles(i.styles);
            }
            return j;
        }, createText: function (h) {
            return new d.text(h, this);
        }, focus: function () {
            this.getWindow().focus();
        }, getById: function (h) {
            var i = this.$.getElementById(h);
            return i ? new d.element(i) : null;
        }, getByAddress: function (h, i) {
            var j = this.$.documentElement;
            for (var k = 0; j && k < h.length; k++) {
                var l = h[k];
                if (!i) {
                    j = j.childNodes[l];
                    continue;
                }
                var m = -1;
                for (var n = 0; n < j.childNodes.length; n++) {
                    var o = j.childNodes[n];
                    if (i === true && o.nodeType == 3 && o.previousSibling && o.previousSibling.nodeType == 3)continue;
                    m++;
                    if (m == l) {
                        j = o;
                        break;
                    }
                }
            }
            return j ? new d.node(j) : null;
        }, getElementsByTag: function (h, i) {
            if (!(c && !(document.documentMode > 8)) && i)h = i + ':' + h;
            return new d.nodeList(this.$.getElementsByTagName(h));
        }, getHead: function () {
            var h = this.$.getElementsByTagName('head')[0];
            if (!h)h = this.getDocumentElement().append(new d.element('head'), true); else h = new d.element(h);
            return (this.getHead = function () {
                return h;
            })();
        }, getBody: function () {
            var h = new d.element(this.$.body);
            return (this.getBody = function () {
                return h;
            })();
        }, getDocumentElement: function () {
            var h = new d.element(this.$.documentElement);
            return (this.getDocumentElement = function () {
                return h;
            })();
        }, getWindow: function () {
            var h = new d.window(this.$.parentWindow || this.$.defaultView);
            return (this.getWindow = function () {
                return h;

            })();
        }, write: function (h) {
            var i = this;
            i.$.open('text/html', 'replace');
            b.isCustomDomain() && (i.$.domain = document.domain);
            i.$.write(h);
            i.$.close();
        }
    });
    d.node = function (h) {
        if (h) {
            switch (h.nodeType) {
                case 9:
                    return new g(h);
                case 1:
                    return new d.element(h);
                case 3:
                    return new d.text(h);
            }
            d.domObject.call(this, h);
        }
        return this;
    };
    d.node.prototype = new d.domObject();
    a.NODE_ELEMENT = 1;
    a.NODE_DOCUMENT = 9;
    a.NODE_TEXT = 3;
    a.NODE_COMMENT = 8;
    a.NODE_DOCUMENT_FRAGMENT = 11;
    a.POSITION_IDENTICAL = 0;
    a.POSITION_DISCONNECTED = 1;
    a.POSITION_FOLLOWING = 2;
    a.POSITION_PRECEDING = 4;
    a.POSITION_IS_CONTAINED = 8;
    a.POSITION_CONTAINS = 16;
    e.extend(d.node.prototype, {
        appendTo: function (h, i) {
            h.append(this, i);
            return h;
        }, clone: function (h, i) {
            var j = this.$.cloneNode(h), k = function (l) {
                if (l.nodeType != 1)return;
                if (!i)l.removeAttribute('id', false);
                l.removeAttribute('data-cke-expando', false);
                if (h) {
                    var m = l.childNodes;
                    for (var n = 0; n < m.length; n++)k(m[n]);
                }
            };
            k(j);
            return new d.node(j);
        }, hasPrevious: function () {
            return !!this.$.previousSibling;
        }, hasNext: function () {
            return !!this.$.nextSibling;
        }, insertAfter: function (h) {
            h.$.parentNode.insertBefore(this.$, h.$.nextSibling);
            return h;
        }, insertBefore: function (h) {
            h.$.parentNode.insertBefore(this.$, h.$);
            return h;
        }, insertBeforeMe: function (h) {
            this.$.parentNode.insertBefore(h.$, this.$);
            return h;
        }, getAddress: function (h) {
            var i = [], j = this.getDocument().$.documentElement, k = this.$;
            while (k && k != j) {
                var l = k.parentNode, m = -1;
                if (l) {
                    for (var n = 0; n < l.childNodes.length; n++) {
                        var o = l.childNodes[n];
                        if (h && o.nodeType == 3 && o.previousSibling && o.previousSibling.nodeType == 3)continue;
                        m++;
                        if (o == k)break;
                    }
                    i.unshift(m);
                }
                k = l;
            }
            return i;
        }, getDocument: function () {
            return new g(this.$.ownerDocument || this.$.parentNode.ownerDocument);
        }, getIndex: function () {
            var h = this.$, i = h.parentNode && h.parentNode.firstChild, j = -1;
            while (i) {
                j++;
                if (i == h)return j;
                i = i.nextSibling;
            }
            return -1;
        }, getNextSourceNode: function (h, i, j) {
            if (j && !j.call) {
                var k = j;
                j = function (n) {
                    return !n.equals(k);
                };
            }
            var l = !h && this.getFirst && this.getFirst(), m;
            if (!l) {
                if (this.type == 1 && j && j(this, true) === false)return null;
                l = this.getNext();
            }
            while (!l && (m = (m || this).getParent())) {
                if (j && j(m, true) === false)return null;
                l = m.getNext();
            }
            if (!l)return null;
            if (j && j(l) === false)return null;
            if (i && i != l.type)return l.getNextSourceNode(false, i, j);
            return l;
        }, getPreviousSourceNode: function (h, i, j) {
            if (j && !j.call) {
                var k = j;
                j = function (n) {
                    return !n.equals(k);
                };
            }
            var l = !h && this.getLast && this.getLast(), m;
            if (!l) {
                if (this.type == 1 && j && j(this, true) === false)return null;
                l = this.getPrevious();
            }
            while (!l && (m = (m || this).getParent())) {
                if (j && j(m, true) === false)return null;

                l = m.getPrevious();
            }
            if (!l)return null;
            if (j && j(l) === false)return null;
            if (i && l.type != i)return l.getPreviousSourceNode(false, i, j);
            return l;
        }, getPrevious: function (h) {
            var i = this.$, j;
            do {
                i = i.previousSibling;
                j = i && new d.node(i);
            } while (j && h && !h(j))
            return j;
        }, getNext: function (h) {
            var i = this.$, j;
            do {
                i = i.nextSibling;
                j = i && new d.node(i);
            } while (j && h && !h(j))
            return j;
        }, getParent: function () {
            var h = this.$.parentNode;
            return h && h.nodeType == 1 ? new d.node(h) : null;
        }, getParents: function (h) {
            var i = this, j = [];
            do j[h ? 'push' : 'unshift'](i); while (i = i.getParent())
            return j;
        }, getCommonAncestor: function (h) {
            var j = this;
            if (h.equals(j))return j;
            if (h.contains && h.contains(j))return h;
            var i = j.contains ? j : j.getParent();
            do {
                if (i.contains(h))return i;
            } while (i = i.getParent())
            return null;
        }, getPosition: function (h) {
            var i = this.$, j = h.$;
            if (i.compareDocumentPosition)return i.compareDocumentPosition(j);
            if (i == j)return 0;
            if (this.type == 1 && h.type == 1) {
                if (i.contains) {
                    if (i.contains(j))return 16 + 4;
                    if (j.contains(i))return 8 + 2;
                }
                if ('sourceIndex' in i)return i.sourceIndex < 0 || j.sourceIndex < 0 ? 1 : i.sourceIndex < j.sourceIndex ? 4 : 2;
            }
            var k = this.getAddress(), l = h.getAddress(), m = Math.min(k.length, l.length);
            for (var n = 0; n <= m - 1; n++) {
                if (k[n] != l[n]) {
                    if (n < m)return k[n] < l[n] ? 4 : 2;
                    break;
                }
            }
            return k.length < l.length ? 16 + 4 : 8 + 2;
        }, getAscendant: function (h, i) {
            var j = this.$;
            if (!i)j = j.parentNode;
            while (j) {
                if (j.nodeName && j.nodeName.toLowerCase() == h)return new d.node(j);
                j = j.parentNode;
            }
            return null;
        }, hasAscendant: function (h, i) {
            var j = this.$;
            if (!i)j = j.parentNode;
            while (j) {
                if (j.nodeName && j.nodeName.toLowerCase() == h)return true;
                j = j.parentNode;
            }
            return false;
        }, move: function (h, i) {
            h.append(this.remove(), i);
        }, remove: function (h) {
            var i = this.$, j = i.parentNode;
            if (j) {
                if (h)for (var k; k = i.firstChild;)j.insertBefore(i.removeChild(k), i);
                j.removeChild(i);
            }
            return this;
        }, replace: function (h) {
            this.insertBefore(h);
            h.remove();
        }, trim: function () {
            this.ltrim();
            this.rtrim();
        }, ltrim: function () {
            var k = this;
            var h;
            while (k.getFirst && (h = k.getFirst())) {
                if (h.type == 3) {
                    var i = e.ltrim(h.getText()), j = h.getLength();
                    if (!i) {
                        h.remove();
                        continue;
                    } else if (i.length < j) {
                        h.split(j - i.length);
                        k.$.removeChild(k.$.firstChild);
                    }
                }
                break;
            }
        }, rtrim: function () {
            var k = this;
            var h;
            while (k.getLast && (h = k.getLast())) {
                if (h.type == 3) {
                    var i = e.rtrim(h.getText()), j = h.getLength();
                    if (!i) {
                        h.remove();
                        continue;
                    } else if (i.length < j) {
                        h.split(i.length);
                        k.$.lastChild.parentNode.removeChild(k.$.lastChild);
                    }
                }
                break;
            }
            if (!c && !b.opera) {
                h = k.$.lastChild;
                if (h && h.type == 1 && h.nodeName.toLowerCase() == 'br')h.parentNode.removeChild(h);
            }
        }, isReadOnly: function () {
            var h = this;
            while (h) {
                if (h.type == 1) {
                    if (h.is('body') || h.getCustomData('_cke_notReadOnly'))break;

                    if (h.getAttribute('contentEditable') == 'false')return h; else if (h.getAttribute('contentEditable') == 'true')break;
                }
                h = h.getParent();
            }
            return false;
        }
    });
    d.nodeList = function (h) {
        this.$ = h;
    };
    d.nodeList.prototype = {
        count: function () {
            return this.$.length;
        }, getItem: function (h) {
            var i = this.$[h];
            return i ? new d.node(i) : null;
        }
    };
    d.element = function (h, i) {
        if (typeof h == 'string')h = (i ? i.$ : document).createElement(h);
        d.domObject.call(this, h);
    };
    var h = d.element;
    h.get = function (i) {
        return i && (i.$ ? i : new h(i));
    };
    h.prototype = new d.node();
    h.createFromHtml = function (i, j) {
        var k = new h('div', j);
        k.setHtml(i);
        return k.getFirst().remove();
    };
    h.setMarker = function (i, j, k, l) {
        var m = j.getCustomData('list_marker_id') || j.setCustomData('list_marker_id', e.getNextNumber()).getCustomData('list_marker_id'), n = j.getCustomData('list_marker_names') || j.setCustomData('list_marker_names', {}).getCustomData('list_marker_names');
        i[m] = j;
        n[k] = 1;
        return j.setCustomData(k, l);
    };
    h.clearAllMarkers = function (i) {
        for (var j in i)h.clearMarkers(i, i[j], 1);
    };
    h.clearMarkers = function (i, j, k) {
        var l = j.getCustomData('list_marker_names'), m = j.getCustomData('list_marker_id');
        for (var n in l)j.removeCustomData(n);
        j.removeCustomData('list_marker_names');
        if (k) {
            j.removeCustomData('list_marker_id');
            delete i[m];
        }
    };
    e.extend(h.prototype, {
        type: 1, addClass: function (i) {
            var j = this.$.className;
            if (j) {
                var k = new RegExp('(?:^|\\s)' + i + '(?:\\s|$)', '');
                if (!k.test(j))j += ' ' + i;
            }
            this.$.className = j || i;
        }, removeClass: function (i) {
            var j = this.getAttribute('class');
            if (j) {
                var k = new RegExp('(?:^|\\s+)' + i + '(?=\\s|$)', 'i');
                if (k.test(j)) {
                    j = j.replace(k, '').replace(/^\s+/, '');
                    if (j)this.setAttribute('class', j); else this.removeAttribute('class');
                }
            }
        }, hasClass: function (i) {
            var j = new RegExp('(?:^|\\s+)' + i + '(?=\\s|$)', '');
            return j.test(this.getAttribute('class'));
        }, append: function (i, j) {
            var k = this;
            if (typeof i == 'string')i = k.getDocument().createElement(i);
            if (j)k.$.insertBefore(i.$, k.$.firstChild); else k.$.appendChild(i.$);
            return i;
        }, appendHtml: function (i) {
            var k = this;
            if (!k.$.childNodes.length)k.setHtml(i); else {
                var j = new h('div', k.getDocument());
                j.setHtml(i);
                j.moveChildren(k);
            }
        }, appendText: function (i) {
            if (this.$.text != undefined)this.$.text += i; else this.append(new d.text(i));
        }, appendBogus: function () {
            var k = this;
            var i = k.getLast();
            while (i && i.type == 3 && !e.rtrim(i.getText()))i = i.getPrevious();
            if (!i || !i.is || !i.is('br')) {
                var j = b.opera ? k.getDocument().createText('') : k.getDocument().createElement('br');
                b.gecko && j.setAttribute('type', '_moz');
                k.append(j);
            }
        }, breakParent: function (i) {
            var l = this;
            var j = new d.range(l.getDocument());

            j.setStartAfter(l);
            j.setEndAfter(i);
            var k = j.extractContents();
            j.insertNode(l.remove());
            k.insertAfterNode(l);
        }, contains: c || b.webkit ? function (i) {
            var j = this.$;
            return i.type != 1 ? j.contains(i.getParent().$) : j != i.$ && j.contains(i.$);
        } : function (i) {
            return !!(this.$.compareDocumentPosition(i.$) & 16);
        }, focus: (function () {
            function i() {
                try {
                    this.$.focus();
                } catch (j) {
                }
            };
            return function (j) {
                if (j)e.setTimeout(i, 100, this); else i.call(this);
            };
        })(), getHtml: function () {
            var i = this.$.innerHTML;
            return c ? i.replace(/<\?[^>]*>/g, '') : i;
        }, getOuterHtml: function () {
            var j = this;
            if (j.$.outerHTML)return j.$.outerHTML.replace(/<\?[^>]*>/, '');
            var i = j.$.ownerDocument.createElement('div');
            i.appendChild(j.$.cloneNode(true));
            return i.innerHTML;
        }, setHtml: function (i) {
            return this.$.innerHTML = i;
        }, setText: function (i) {
            h.prototype.setText = this.$.innerText != undefined ? function (j) {
                return this.$.innerText = j;
            } : function (j) {
                return this.$.textContent = j;
            };
            return this.setText(i);
        }, getAttribute: (function () {
            var i = function (j) {
                return this.$.getAttribute(j, 2);
            };
            if (c && (b.ie7Compat || b.ie6Compat))return function (j) {
                var n = this;
                switch (j) {
                    case 'class':
                        j = 'className';
                        break;
                    case 'tabindex':
                        var k = i.call(n, j);
                        if (k !== 0 && n.$.tabIndex === 0)k = null;
                        return k;
                        break;
                    case 'checked':
                        var l = n.$.attributes.getNamedItem(j), m = l.specified ? l.nodeValue : n.$.checked;
                        return m ? 'checked' : null;
                    case 'hspace':
                        return n.$.hspace;
                    case 'style':
                        return n.$.style.cssText;
                }
                return i.call(n, j);
            }; else return i;
        })(), getChildren: function () {
            return new d.nodeList(this.$.childNodes);
        }, getComputedStyle: c ? function (i) {
            return this.$.currentStyle[e.cssStyleToDomStyle(i)];
        } : function (i) {
            return this.getWindow().$.getComputedStyle(this.$, '').getPropertyValue(i);
        }, getDtd: function () {
            var i = f[this.getName()];
            this.getDtd = function () {
                return i;
            };
            return i;
        }, getElementsByTag: g.prototype.getElementsByTag, getTabIndex: c ? function () {
            var i = this.$.tabIndex;
            if (i === 0 && !f.$tabIndex[this.getName()] && parseInt(this.getAttribute('tabindex'), 10) !== 0)i = -1;
            return i;
        } : b.webkit ? function () {
            var i = this.$.tabIndex;
            if (i == undefined) {
                i = parseInt(this.getAttribute('tabindex'), 10);
                if (isNaN(i))i = -1;
            }
            return i;
        } : function () {
            return this.$.tabIndex;
        }, getText: function () {
            return this.$.textContent || this.$.innerText || '';
        }, getWindow: function () {
            return this.getDocument().getWindow();
        }, getId: function () {
            return this.$.id || null;
        }, getNameAtt: function () {
            return this.$.name || null;
        }, getName: function () {
            var i = this.$.nodeName.toLowerCase();
            if (c && !(document.documentMode > 8)) {
                var j = this.$.scopeName;
                if (j != 'HTML')i = j.toLowerCase() + ':' + i;
            }
            return (this.getName = function () {
                return i;

            })();
        }, getValue: function () {
            return this.$.value;
        }, getFirst: function (i) {
            var j = this.$.firstChild, k = j && new d.node(j);
            if (k && i && !i(k))k = k.getNext(i);
            return k;
        }, getLast: function (i) {
            var j = this.$.lastChild, k = j && new d.node(j);
            if (k && i && !i(k))k = k.getPrevious(i);
            return k;
        }, getStyle: function (i) {
            return this.$.style[e.cssStyleToDomStyle(i)];
        }, is: function () {
            var i = this.getName();
            for (var j = 0; j < arguments.length; j++) {
                if (arguments[j] == i)return true;
            }
            return false;
        }, isEditable: function () {
            var i = this.getName(), j = !f.$nonEditable[i] && (f[i] || f.span);
            return j && j['#'];
        }, isIdentical: function (i) {
            if (this.getName() != i.getName())return false;
            var j = this.$.attributes, k = i.$.attributes, l = j.length, m = k.length;
            for (var n = 0; n < l; n++) {
                var o = j[n];
                if (o.nodeName == '_moz_dirty')continue;
                if ((!c || o.specified && o.nodeName != 'data-cke-expando') && o.nodeValue != i.getAttribute(o.nodeName))return false;
            }
            if (c)for (n = 0; n < m; n++) {
                o = k[n];
                if (o.specified && o.nodeName != 'data-cke-expando' && o.nodeValue != this.getAttribute(o.nodeName))return false;
            }
            return true;
        }, isVisible: function () {
            var i = !!this.$.offsetHeight && this.getComputedStyle('visibility') != 'hidden', j, k;
            if (i && (b.webkit || b.opera)) {
                j = this.getWindow();
                if (!j.equals(a.document.getWindow()) && (k = j.$.frameElement))i = new h(k).isVisible();
            }
            return i;
        }, isEmptyInlineRemoveable: function () {
            if (!f.$removeEmpty[this.getName()])return false;
            var i = this.getChildren();
            for (var j = 0, k = i.count(); j < k; j++) {
                var l = i.getItem(j);
                if (l.type == 1 && l.data('cke-bookmark'))continue;
                if (l.type == 1 && !l.isEmptyInlineRemoveable() || l.type == 3 && e.trim(l.getText()))return false;
            }
            return true;
        }, hasAttributes: c && (b.ie7Compat || b.ie6Compat) ? function () {
            var i = this.$.attributes;
            for (var j = 0; j < i.length; j++) {
                var k = i[j];
                switch (k.nodeName) {
                    case 'class':
                        if (this.getAttribute('class'))return true;
                    case 'data-cke-expando':
                        continue;
                    default:
                        if (k.specified)return true;
                }
            }
            return false;
        } : function () {
            var i = this.$.attributes, j = i.length, k = {'data-cke-expando': 1, _moz_dirty: 1};
            return j > 0 && (j > 2 || !k[i[0].nodeName] || j == 2 && !k[i[1].nodeName]);
        }, hasAttribute: function (i) {
            var j = this.$.attributes.getNamedItem(i);
            return !!(j && j.specified);
        }, hide: function () {
            this.setStyle('display', 'none');
        }, moveChildren: function (i, j) {
            var k = this.$;
            i = i.$;
            if (k == i)return;
            var l;
            if (j)while (l = k.lastChild)i.insertBefore(k.removeChild(l), i.firstChild); else while (l = k.firstChild)i.appendChild(k.removeChild(l));
        }, mergeSiblings: (function () {
            function i(j, k, l) {
                if (k && k.type == 1) {
                    var m = [];
                    while (k.data('cke-bookmark') || k.isEmptyInlineRemoveable()) {
                        m.push(k);
                        k = l ? k.getNext() : k.getPrevious();
                        if (!k || k.type != 1)return;

                    }
                    if (j.isIdentical(k)) {
                        var n = l ? j.getLast() : j.getFirst();
                        while (m.length)m.shift().move(j, !l);
                        k.moveChildren(j, !l);
                        k.remove();
                        if (n && n.type == 1)n.mergeSiblings();
                    }
                }
            };
            return function () {
                var j = this;
                if (!(f.$removeEmpty[j.getName()] || j.is('a')))return;
                i(j, j.getNext(), true);
                i(j, j.getPrevious());
            };
        })(), show: function () {
            this.setStyles({display: '', visibility: ''});
        }, setAttribute: (function () {
            var i = function (j, k) {
                this.$.setAttribute(j, k);
                return this;
            };
            if (c && (b.ie7Compat || b.ie6Compat))return function (j, k) {
                var l = this;
                if (j == 'class')l.$.className = k; else if (j == 'style')l.$.style.cssText = k; else if (j == 'tabindex')l.$.tabIndex = k; else if (j == 'checked')l.$.checked = k; else i.apply(l, arguments);
                return l;
            }; else return i;
        })(), setAttributes: function (i) {
            for (var j in i)this.setAttribute(j, i[j]);
            return this;
        }, setValue: function (i) {
            this.$.value = i;
            return this;
        }, removeAttribute: (function () {
            var i = function (j) {
                this.$.removeAttribute(j);
            };
            if (c && (b.ie7Compat || b.ie6Compat))return function (j) {
                if (j == 'class')j = 'className'; else if (j == 'tabindex')j = 'tabIndex';
                i.call(this, j);
            }; else return i;
        })(), removeAttributes: function (i) {
            if (e.isArray(i))for (var j = 0; j < i.length; j++)this.removeAttribute(i[j]); else for (var k in i)i.hasOwnProperty(k) && this.removeAttribute(k);
        }, removeStyle: function (i) {
            var j = this;
            j.setStyle(i, '');
            if (j.$.style.removeAttribute)j.$.style.removeAttribute(e.cssStyleToDomStyle(i));
            if (!j.$.style.cssText)j.removeAttribute('style');
        }, setStyle: function (i, j) {
            this.$.style[e.cssStyleToDomStyle(i)] = j;
            return this;
        }, setStyles: function (i) {
            for (var j in i)this.setStyle(j, i[j]);
            return this;
        }, setOpacity: function (i) {
            if (c) {
                i = Math.round(i * 100);
                this.setStyle('filter', i >= 100 ? '' : 'progid:DXImageTransform.Microsoft.Alpha(opacity=' + i + ')');
            } else this.setStyle('opacity', i);
        }, unselectable: b.gecko ? function () {
            this.$.style.MozUserSelect = 'none';
            this.on('dragstart', function (i) {
                i.data.preventDefault();
            });
        } : b.webkit ? function () {
            this.$.style.KhtmlUserSelect = 'none';
            this.on('dragstart', function (i) {
                i.data.preventDefault();
            });
        } : function () {
            if (c || b.opera) {
                var i = this.$, j, k = 0;
                i.unselectable = 'on';
                while (j = i.all[k++])switch (j.tagName.toLowerCase()) {
                    case 'iframe':
                    case 'textarea':
                    case 'input':
                    case 'select':
                        break;
                    default:
                        j.unselectable = 'on';
                }
            }
        }, getPositionedAncestor: function () {
            var i = this;
            while (i.getName() != 'html') {
                if (i.getComputedStyle('position') != 'static')return i;
                i = i.getParent();
            }
            return null;
        }, getDocumentPosition: function (i) {
            var D = this;
            var j = 0, k = 0, l = D.getDocument().getBody(), m = D.getDocument().$.compatMode == 'BackCompat', n = D.getDocument();
            if (document.documentElement.getBoundingClientRect) {
                var o = D.$.getBoundingClientRect(), p = n.$, q = p.documentElement, r = q.clientTop || l.$.clientTop || 0, s = q.clientLeft || l.$.clientLeft || 0, t = true;

                if (c) {
                    var u = n.getDocumentElement().contains(D), v = n.getBody().contains(D);
                    t = m && v || !m && u;
                }
                if (t) {
                    j = o.left + (!m && q.scrollLeft || l.$.scrollLeft);
                    j -= s;
                    k = o.top + (!m && q.scrollTop || l.$.scrollTop);
                    k -= r;
                }
            } else {
                var w = D, x = null, y;
                while (w && !(w.getName() == 'body' || w.getName() == 'html')) {
                    j += w.$.offsetLeft - w.$.scrollLeft;
                    k += w.$.offsetTop - w.$.scrollTop;
                    if (!w.equals(D)) {
                        j += w.$.clientLeft || 0;
                        k += w.$.clientTop || 0;
                    }
                    var z = x;
                    while (z && !z.equals(w)) {
                        j -= z.$.scrollLeft;
                        k -= z.$.scrollTop;
                        z = z.getParent();
                    }
                    x = w;
                    w = (y = w.$.offsetParent) ? new h(y) : null;
                }
            }
            if (i) {
                var A = D.getWindow(), B = i.getWindow();
                if (!A.equals(B) && A.$.frameElement) {
                    var C = new h(A.$.frameElement).getDocumentPosition(i);
                    j += C.x;
                    k += C.y;
                }
            }
            if (!document.documentElement.getBoundingClientRect)if (b.gecko && !m) {
                j += D.$.clientLeft ? 1 : 0;
                k += D.$.clientTop ? 1 : 0;
            }
            return {x: j, y: k};
        }, scrollIntoView: function (i) {
            var o = this;
            var j = o.getWindow(), k = j.getViewPaneSize().height, l = k * -1;
            if (i)l += k; else {
                l += o.$.offsetHeight || 0;
                l += parseInt(o.getComputedStyle('marginBottom') || 0, 10) || 0;
            }
            var m = o.getDocumentPosition();
            l += m.y;
            l = l < 0 ? 0 : l;
            var n = j.getScrollPosition().y;
            if (l > n || l < n - k)j.$.scrollTo(0, l);
        }, setState: function (i) {
            var j = this;
            switch (i) {
                case 1:
                    j.addClass('cke_on');
                    j.removeClass('cke_off');
                    j.removeClass('cke_disabled');
                    break;
                case 0:
                    j.addClass('cke_disabled');
                    j.removeClass('cke_off');
                    j.removeClass('cke_on');
                    break;
                default:
                    j.addClass('cke_off');
                    j.removeClass('cke_on');
                    j.removeClass('cke_disabled');
                    break;
            }
        }, getFrameDocument: function () {
            var i = this.$;
            try {
                i.contentWindow.document;
            } catch (j) {
                i.src = i.src;
                if (c && b.version < 7)window.showModalDialog('javascript:document.write("<script type="text/javascript">window.setTimeout(function(){window.close();},50);</script>")');
            }
            return i && new g(i.contentWindow.document);
        }, copyAttributes: function (i, j) {
            var p = this;
            var k = p.$.attributes;
            j = j || {};
            for (var l = 0; l < k.length; l++) {
                var m = k[l], n = m.nodeName.toLowerCase(), o;
                if (n in j)continue;
                if (n == 'checked' && (o = p.getAttribute(n)))i.setAttribute(n, o); else if (m.specified || c && m.nodeValue && n == 'value') {
                    o = p.getAttribute(n);
                    if (o === null)o = m.nodeValue;
                    i.setAttribute(n, o);
                }
            }
            if (p.$.style.cssText !== '')i.$.style.cssText = p.$.style.cssText;
        }, renameNode: function (i) {
            var l = this;
            if (l.getName() == i)return;
            var j = l.getDocument(), k = new h(i, j);
            l.copyAttributes(k);
            l.moveChildren(k);
            l.getParent() && l.$.parentNode.replaceChild(k.$, l.$);
            k.$['data-cke-expando'] = l.$['data-cke-expando'];
            l.$ = k.$;
        }, getChild: function (i) {
            var j = this.$;
            if (!i.slice)j = j.childNodes[i]; else while (i.length > 0 && j)j = j.childNodes[i.shift()];
            return j ? new d.node(j) : null;
        }, getChildCount: function () {
            return this.$.childNodes.length;

        }, disableContextMenu: function () {
            this.on('contextmenu', function (i) {
                if (!i.data.getTarget().hasClass('cke_enable_context_menu'))i.data.preventDefault();
            });
        }, getDirection: function (i) {
            return i ? this.getComputedStyle('direction') : this.getStyle('direction') || this.getAttribute('dir');
        }, data: function (i, j) {
            i = 'data-' + i;
            if (j === undefined)return this.getAttribute(i); else if (j === false)this.removeAttribute(i); else this.setAttribute(i, j);
        }
    });
    (function () {
        var i = {
            width: ['border-left-width', 'border-right-width', 'padding-left', 'padding-right'],
            height: ['border-top-width', 'border-bottom-width', 'padding-top', 'padding-bottom']
        };

        function j(k) {
            var l = 0;
            for (var m = 0, n = i[k].length; m < n; m++)l += parseInt(this.getComputedStyle(i[k][m]) || 0, 10) || 0;
            return l;
        };
        h.prototype.setSize = function (k, l, m) {
            if (typeof l == 'number') {
                if (m && !(c && b.quirks))l -= j.call(this, k);
                this.setStyle(k, l + 'px');
            }
        };
        h.prototype.getSize = function (k, l) {
            var m = Math.max(this.$['offset' + e.capitalize(k)], this.$['client' + e.capitalize(k)]) || 0;
            if (l)m -= j.call(this, k);
            return m;
        };
    })();
    a.command = function (i, j) {
        this.uiItems = [];
        this.exec = function (k) {
            if (this.state == 0)return false;
            if (this.editorFocus)i.focus();
            return j.exec.call(this, i, k) !== false;
        };
        e.extend(this, j, {modes: {wysiwyg: 1}, editorFocus: 1, state: 2});
        a.event.call(this);
    };
    a.command.prototype = {
        enable: function () {
            var i = this;
            if (i.state == 0)i.setState(!i.preserveState || typeof i.previousState == 'undefined' ? 2 : i.previousState);
        }, disable: function () {
            this.setState(0);
        }, setState: function (i) {
            var j = this;
            if (j.state == i)return false;
            j.previousState = j.state;
            j.state = i;
            j.fire('state');
            return true;
        }, toggleState: function () {
            var i = this;
            if (i.state == 2)i.setState(1); else if (i.state == 1)i.setState(2);
        }
    };
    a.event.implementOn(a.command.prototype, true);
    a.ENTER_P = 1;
    a.ENTER_BR = 2;
    a.ENTER_DIV = 3;
    a.config = {
        customConfig: 'config.js',
        autoUpdateElement: true,
        baseHref: '',
        contentsCss: a.basePath + 'contents.css',
        contentsLangDirection: 'ui',
        contentsLanguage: '',
        language: '',
        defaultLanguage: 'en',
        enterMode: 1,
        forceEnterMode: false,
        shiftEnterMode: 2,
        corePlugins: '',
        docType: '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">',
        bodyId: '',
        bodyClass: '',
        fullPage: false,
        height: 200,
        plugins: 'about,a11yhelp,basicstyles,bidi,blockquote,button,clipboard,colorbutton,colordialog,contextmenu,dialogadvtab,div,elementspath,enterkey,entities,filebrowser,find,flash,font,format,forms,horizontalrule,htmldataprocessor,iframe,image,indent,justify,keystrokes,link,list,liststyle,maximize,newpage,pagebreak,pastefromword,pastetext,popup,preview,print,removeformat,resize,save,scayt,smiley,showblocks,showborders,sourcearea,stylescombo,table,tabletools,specialchar,tab,templates,toolbar,undo,wysiwygarea,wsc',
        extraPlugins: '',
        removePlugins: '',
        protectedSource: [],
        tabIndex: 0,
        theme: 'default',
        skin: 'kama',
        width: '',
        baseFloatZIndex: 10000
    };

    var i = a.config;
    a.focusManager = function (j) {
        if (j.focusManager)return j.focusManager;
        this.hasFocus = false;
        this._ = {editor: j};
        return this;
    };
    a.focusManager.prototype = {
        focus: function () {
            var k = this;
            if (k._.timer)clearTimeout(k._.timer);
            if (!k.hasFocus) {
                if (a.currentInstance)a.currentInstance.focusManager.forceBlur();
                var j = k._.editor;
                j.container.getChild(1).addClass('cke_focus');
                k.hasFocus = true;
                j.fire('focus');
            }
        }, blur: function () {
            var j = this;
            if (j._.timer)clearTimeout(j._.timer);
            j._.timer = setTimeout(function () {
                delete j._.timer;
                j.forceBlur();
            }, 100);
        }, forceBlur: function () {
            if (this.hasFocus) {
                var j = this._.editor;
                j.container.getChild(1).removeClass('cke_focus');
                this.hasFocus = false;
                j.fire('blur');
            }
        }
    };
    (function () {
        var j = {};
        a.lang = {
            languages: {
                af: 1,
                ar: 1,
                bg: 1,
                bn: 1,
                bs: 1,
                ca: 1,
                cs: 1,
                cy: 1,
                da: 1,
                de: 1,
                el: 1,
                'en-au': 1,
                'en-ca': 1,
                'en-gb': 1,
                en: 1,
                eo: 1,
                es: 1,
                et: 1,
                eu: 1,
                fa: 1,
                fi: 1,
                fo: 1,
                'fr-ca': 1,
                fr: 1,
                gl: 1,
                gu: 1,
                he: 1,
                hi: 1,
                hr: 1,
                hu: 1,
                is: 1,
                it: 1,
                ja: 1,
                km: 1,
                ko: 1,
                lt: 1,
                lv: 1,
                mn: 1,
                ms: 1,
                nb: 1,
                nl: 1,
                no: 1,
                pl: 1,
                'pt-br': 1,
                pt: 1,
                ro: 1,
                ru: 1,
                sk: 1,
                sl: 1,
                'sr-latn': 1,
                sr: 1,
                sv: 1,
                th: 1,
                tr: 1,
                uk: 1,
                vi: 1,
                'zh-cn': 1,
                zh: 1
            }, load: function (k, l, m) {
                if (!k || !a.lang.languages[k])k = this.detect(l, k);
                if (!this[k])a.scriptLoader.load(a.getUrl('lang/' + k + '.js'), function () {
                    m(k, this[k]);
                }, this); else m(k, this[k]);
            }, detect: function (k, l) {
                var m = this.languages;
                l = l || navigator.userLanguage || navigator.language;
                var n = l.toLowerCase().match(/([a-z]+)(?:-([a-z]+))?/), o = n[1], p = n[2];
                if (m[o + '-' + p])o = o + '-' + p; else if (!m[o])o = null;
                a.lang.detect = o ? function () {
                    return o;
                } : function (q) {
                    return q;
                };
                return o || k;
            }
        };
    })();
    a.scriptLoader = (function () {
        var j = {}, k = {};
        return {
            load: function (l, m, n, o, p) {
                var q = typeof l == 'string';
                if (q)l = [l];
                if (!n)n = a;
                var r = l.length, s = [], t = [], u = function (z) {
                    if (m)if (q)m.call(n, z); else m.call(n, s, t);
                };
                if (r === 0) {
                    u(true);
                    return;
                }
                var v = function (z, A) {
                    (A ? s : t).push(z);
                    if (--r <= 0) {
                        p && a.document.getDocumentElement().removeStyle('cursor');
                        u(A);
                    }
                }, w = function (z, A) {
                    j[z] = 1;
                    var B = k[z];
                    delete k[z];
                    for (var C = 0; C < B.length; C++)B[C](z, A);
                }, x = function (z) {
                    if (o !== true && j[z]) {
                        v(z, true);
                        return;
                    }
                    var A = k[z] || (k[z] = []);
                    A.push(v);
                    if (A.length > 1)return;
                    var B = new h('script');
                    B.setAttributes({type: 'text/javascript', src: z});
                    if (m)if (c)B.$.onreadystatechange = function () {
                        if (B.$.readyState == 'loaded' || B.$.readyState == 'complete') {
                            B.$.onreadystatechange = null;
                            w(z, true);
                        }
                    }; else {
                        B.$.onload = function () {
                            setTimeout(function () {
                                w(z, true);
                            }, 0);
                        };
                        B.$.onerror = function () {
                            w(z, false);
                        };
                    }
                    B.appendTo(a.document.getHead());
                };
                p && a.document.getDocumentElement().setStyle('cursor', 'wait');
                for (var y = 0; y < r; y++)x(l[y]);
            }, loadCode: function (l) {
                var m = new h('script');

                m.setAttribute('type', 'text/javascript');
                m.appendText(l);
                m.appendTo(a.document.getHead());
            }
        };
    })();
    a.resourceManager = function (j, k) {
        var l = this;
        l.basePath = j;
        l.fileName = k;
        l.registered = {};
        l.loaded = {};
        l.externals = {};
        l._ = {waitingList: {}};
    };
    a.resourceManager.prototype = {
        add: function (j, k) {
            if (this.registered[j])throw '[CKEDITOR.resourceManager.add] The resource name "' + j + '" is already registered.';
            a.fire(j + e.capitalize(this.fileName) + 'Ready', this.registered[j] = k || {});
        }, get: function (j) {
            return this.registered[j] || null;
        }, getPath: function (j) {
            var k = this.externals[j];
            return a.getUrl(k && k.dir || this.basePath + j + '/');
        }, getFilePath: function (j) {
            var k = this.externals[j];
            return a.getUrl(this.getPath(j) + (k && typeof k.file == 'string' ? k.file : this.fileName + '.js'));
        }, addExternal: function (j, k, l) {
            j = j.split(',');
            for (var m = 0; m < j.length; m++) {
                var n = j[m];
                this.externals[n] = {dir: k, file: l};
            }
        }, load: function (j, k, l) {
            if (!e.isArray(j))j = j ? [j] : [];
            var m = this.loaded, n = this.registered, o = [], p = {}, q = {};
            for (var r = 0; r < j.length; r++) {
                var s = j[r];
                if (!s)continue;
                if (!m[s] && !n[s]) {
                    var t = this.getFilePath(s);
                    o.push(t);
                    if (!(t in p))p[t] = [];
                    p[t].push(s);
                } else q[s] = this.get(s);
            }
            a.scriptLoader.load(o, function (u, v) {
                if (v.length)throw '[CKEDITOR.resourceManager.load] Resource name "' + p[v[0]].join(',') + '" was not found at "' + v[0] + '".';
                for (var w = 0; w < u.length; w++) {
                    var x = p[u[w]];
                    for (var y = 0; y < x.length; y++) {
                        var z = x[y];
                        q[z] = this.get(z);
                        m[z] = 1;
                    }
                }
                k.call(l, q);
            }, this);
        }
    };
    a.plugins = new a.resourceManager('plugins/', 'plugin');
    var j = a.plugins;
    j.load = e.override(j.load, function (k) {
        return function (l, m, n) {
            var o = {}, p = function (q) {
                k.call(this, q, function (r) {
                    e.extend(o, r);
                    var s = [];
                    for (var t in r) {
                        var u = r[t], v = u && u.requires;
                        if (v)for (var w = 0; w < v.length; w++) {
                            if (!o[v[w]])s.push(v[w]);
                        }
                    }
                    if (s.length)p.call(this, s); else {
                        for (t in o) {
                            u = o[t];
                            if (u.onLoad && !u.onLoad._called) {
                                u.onLoad();
                                u.onLoad._called = 1;
                            }
                        }
                        if (m)m.call(n || window, o);
                    }
                }, this);
            };
            p.call(this, l);
        };
    });
    j.setLang = function (k, l, m) {
        var n = this.get(k), o = n.lang || (n.lang = {});
        o[l] = m;
    };
    a.skins = (function () {
        var k = {}, l = {}, m = function (n, o, p, q) {
            var r = k[o];
            if (!n.skin) {
                n.skin = r;
                if (r.init)r.init(n);
            }
            var s = function (B) {
                for (var C = 0; C < B.length; C++)B[C] = a.getUrl(l[o] + B[C]);
            };

            function t(B, C) {
                return B.replace(/url\s*\(([\s'"]*)(.*?)([\s"']*)\)/g, function (D, E, F, G) {
                    if (/^\/|^\w?:/.test(F))return D; else return 'url(' + C + E + F + G + ')';
                });
            };
            p = r[p];
            var u = !p || !!p._isLoaded;
            if (u)q && q(); else {
                var v = p._pending || (p._pending = []);
                v.push(q);
                if (v.length > 1)return;
                var w = !p.css || !p.css.length, x = !p.js || !p.js.length, y = function () {
                    if (w && x) {
                        p._isLoaded = 1;
                        for (var B = 0;

                             B < v.length; B++) {
                            if (v[B])v[B]();
                        }
                    }
                };
                if (!w) {
                    var z = p.css;
                    if (e.isArray(z)) {
                        s(z);
                        for (var A = 0; A < z.length; A++)a.document.appendStyleSheet(z[A]);
                    } else {
                        z = t(z, a.getUrl(l[o]));
                        a.document.appendStyleText(z);
                    }
                    p.css = z;
                    w = 1;
                }
                if (!x) {
                    s(p.js);
                    a.scriptLoader.load(p.js, function () {
                        x = 1;
                        y();
                    });
                }
                y();
            }
        };
        return {
            add: function (n, o) {
                k[n] = o;
                o.skinPath = l[n] || (l[n] = a.getUrl('skins/' + n + '/'));
            }, load: function (n, o, p) {
                var q = n.skinName, r = n.skinPath;
                if (k[q])m(n, q, o, p); else {
                    l[q] = r;
                    a.scriptLoader.load(a.getUrl(r + 'skin.js'), function () {
                        m(n, q, o, p);
                    });
                }
            }
        };
    })();
    a.themes = new a.resourceManager('themes/', 'theme');
    a.ui = function (k) {
        if (k.ui)return k.ui;
        this._ = {handlers: {}, items: {}, editor: k};
        return this;
    };
    var k = a.ui;
    k.prototype = {
        add: function (l, m, n) {
            this._.items[l] = {type: m, command: n.command || null, args: Array.prototype.slice.call(arguments, 2)};
        }, create: function (l) {
            var q = this;
            var m = q._.items[l], n = m && q._.handlers[m.type], o = m && m.command && q._.editor.getCommand(m.command), p = n && n.create.apply(q, m.args);
            if (o)o.uiItems.push(p);
            return p;
        }, addHandler: function (l, m) {
            this._.handlers[l] = m;
        }
    };
    a.event.implementOn(k);
    (function () {
        var l = 0, m = function () {
            var x = 'editor' + ++l;
            return a.instances && a.instances[x] ? m() : x;
        }, n = {}, o = function (x) {
            var y = x.config.customConfig;
            if (!y)return false;
            y = a.getUrl(y);
            var z = n[y] || (n[y] = {});
            if (z.fn) {
                z.fn.call(x, x.config);
                if (a.getUrl(x.config.customConfig) == y || !o(x))x.fireOnce('customConfigLoaded');
            } else a.scriptLoader.load(y, function () {
                if (a.editorConfig)z.fn = a.editorConfig; else z.fn = function () {
                };
                o(x);
            });
            return true;
        }, p = function (x, y) {
            x.on('customConfigLoaded', function () {
                if (y) {
                    if (y.on)for (var z in y.on)x.on(z, y.on[z]);
                    e.extend(x.config, y, true);
                    delete x.config.on;
                }
                q(x);
            });
            if (y && y.customConfig != undefined)x.config.customConfig = y.customConfig;
            if (!o(x))x.fireOnce('customConfigLoaded');
        }, q = function (x) {
            var y = x.config.skin.split(','), z = y[0], A = a.getUrl(y[1] || 'skins/' + z + '/');
            x.skinName = z;
            x.skinPath = A;
            x.skinClass = 'cke_skin_' + z;
            x.tabIndex = x.config.tabIndex || x.element.getAttribute('tabindex') || 0;
            x.fireOnce('configLoaded');
            t(x);
        }, r = function (x) {
            a.lang.load(x.config.language, x.config.defaultLanguage, function (y, z) {
                x.langCode = y;
                x.lang = e.prototypedCopy(z);
                if (b.gecko && b.version < 10900 && x.lang.dir == 'rtl')x.lang.dir = 'ltr';
                var A = x.config;
                A.contentsLangDirection == 'ui' && (A.contentsLangDirection = x.lang.dir);
                s(x);
            });
        }, s = function (x) {
            var y = x.config, z = y.plugins, A = y.extraPlugins, B = y.removePlugins;
            if (A) {
                var C = new RegExp('(?:^|,)(?:' + A.replace(/\s*,\s*/g, '|') + ')(?=,|$)', 'g');
                z = z.replace(C, '');
                z += ',' + A;
            }
            if (B) {
                C = new RegExp('(?:^|,)(?:' + B.replace(/\s*,\s*/g, '|') + ')(?=,|$)', 'g');

                z = z.replace(C, '');
            }
            b.air && (z += ',adobeair');
            j.load(z.split(','), function (D) {
                var E = [], F = [], G = [];
                x.plugins = D;
                for (var H in D) {
                    var I = D[H], J = I.lang, K = j.getPath(H), L = null;
                    I.path = K;
                    if (J) {
                        L = e.indexOf(J, x.langCode) >= 0 ? x.langCode : J[0];
                        if (!I.lang[L])G.push(a.getUrl(K + 'lang/' + L + '.js')); else {
                            e.extend(x.lang, I.lang[L]);
                            L = null;
                        }
                    }
                    F.push(L);
                    E.push(I);
                }
                a.scriptLoader.load(G, function () {
                    var M = ['beforeInit', 'init', 'afterInit'];
                    for (var N = 0; N < M.length; N++)for (var O = 0; O < E.length; O++) {
                        var P = E[O];
                        if (N === 0 && F[O] && P.lang)e.extend(x.lang, P.lang[F[O]]);
                        if (P[M[N]])P[M[N]](x);
                    }
                    x.fire('pluginsLoaded');
                    u(x);
                });
            });
        }, t = function (x) {
            a.skins.load(x, 'editor', function () {
                r(x);
            });
        }, u = function (x) {
            var y = x.config.theme;
            a.themes.load(y, function () {
                var z = x.theme = a.themes.get(y);
                z.path = a.themes.getPath(y);
                z.build(x);
                if (x.config.autoUpdateElement)v(x);
            });
        }, v = function (x) {
            var y = x.element;
            if (x.elementMode == 1 && y.is('textarea')) {
                var z = y.$.form && new h(y.$.form);
                if (z) {
                    function A() {
                        x.updateElement();
                    };
                    z.on('submit', A);
                    if (!z.$.submit.nodeName)z.$.submit = e.override(z.$.submit, function (B) {
                        return function () {
                            x.updateElement();
                            if (B.apply)B.apply(this, arguments); else B();
                        };
                    });
                    x.on('destroy', function () {
                        z.removeListener('submit', A);
                    });
                }
            }
        };

        function w() {
            var x, y = this._.commands, z = this.mode;
            for (var A in y) {
                x = y[A];
                x[x.startDisabled ? 'disable' : x.modes[z] ? 'enable' : 'disable']();
            }
        };
        a.editor.prototype._init = function () {
            var z = this;
            var x = h.get(z._.element), y = z._.instanceConfig;
            delete z._.element;
            delete z._.instanceConfig;
            z._.commands = {};
            z._.styles = [];
            z.element = x;
            z.name = x && z.elementMode == 1 && (x.getId() || x.getNameAtt()) || m();
            if (z.name in a.instances)throw '[CKEDITOR.editor] The instance "' + z.name + '" already exists.';
            z.id = e.getNextId();
            z.config = e.prototypedCopy(i);
            z.ui = new k(z);
            z.focusManager = new a.focusManager(z);
            a.fire('instanceCreated', null, z);
            z.on('mode', w, null, null, 1);
            p(z, y);
        };
    })();
    e.extend(a.editor.prototype, {
        addCommand: function (l, m) {
            return this._.commands[l] = new a.command(this, m);
        }, addCss: function (l) {
            this._.styles.push(l);
        }, destroy: function (l) {
            var r = this;
            if (!l)r.updateElement();
            if (r.mode)r._.modes[r.mode].unload(r.getThemeSpace('contents'));
            r.theme.destroy(r);
            var m, n = 0, o, p, q;
            if (r.toolbox) {
                m = r.toolbox.toolbars;
                for (; n < m.length; n++) {
                    p = m[n].items;
                    for (o = 0; o < p.length; o++) {
                        q = p[o];
                        if (q.clickFn)e.removeFunction(q.clickFn);
                        if (q.keyDownFn)e.removeFunction(q.keyDownFn);
                        if (q.index)k.button._.instances[q.index] = null;
                    }
                }
            }
            if (r.contextMenu)e.removeFunction(r.contextMenu._.functionId);
            if (r._.filebrowserFn)e.removeFunction(r._.filebrowserFn);
            r.fire('destroy');

            a.remove(r);
            a.fire('instanceDestroyed', null, r);
        }, execCommand: function (l, m) {
            var n = this.getCommand(l), o = {name: l, commandData: m, command: n};
            if (n && n.state != 0)if (this.fire('beforeCommandExec', o) !== true) {
                o.returnValue = n.exec(o.commandData);
                if (!n.async && this.fire('afterCommandExec', o) !== true)return o.returnValue;
            }
            return false;
        }, getCommand: function (l) {
            return this._.commands[l];
        }, getData: function () {
            var n = this;
            n.fire('beforeGetData');
            var l = n._.data;
            if (typeof l != 'string') {
                var m = n.element;
                if (m && n.elementMode == 1)l = m.is('textarea') ? m.getValue() : m.getHtml(); else l = '';
            }
            l = {dataValue: l};
            n.fire('getData', l);
            return l.dataValue;
        }, getSnapshot: function () {
            var l = this.fire('getSnapshot');
            if (typeof l != 'string') {
                var m = this.element;
                if (m && this.elementMode == 1)l = m.is('textarea') ? m.getValue() : m.getHtml();
            }
            return l;
        }, loadSnapshot: function (l) {
            this.fire('loadSnapshot', l);
        }, setData: function (l, m) {
            if (m)this.on('dataReady', function (o) {
                o.removeListener();
                m.call(o.editor);
            });
            var n = {dataValue: l};
            this.fire('setData', n);
            this._.data = n.dataValue;
            this.fire('afterSetData', n);
        }, insertHtml: function (l) {
            this.fire('insertHtml', l);
        }, insertText: function (l) {
            this.fire('insertText', l);
        }, insertElement: function (l) {
            this.fire('insertElement', l);
        }, checkDirty: function () {
            return this.mayBeDirty && this._.previousValue !== this.getSnapshot();
        }, resetDirty: function () {
            if (this.mayBeDirty)this._.previousValue = this.getSnapshot();
        }, updateElement: function () {
            var n = this;
            var l = n.element;
            if (l && n.elementMode == 1) {
                var m = n.getData();
                if (n.config.htmlEncodeOutput)m = e.htmlEncode(m);
                if (l.is('textarea'))l.setValue(m); else l.setHtml(m);
            }
        }
    });
    a.on('loaded', function () {
        var l = a.editor._pending;
        if (l) {
            delete a.editor._pending;
            for (var m = 0; m < l.length; m++)l[m]._init();
        }
    });
    a.htmlParser = function () {
        this._ = {htmlPartsRegex: new RegExp("<(?:(?:\\/([^>]+)>)|(?:!--([\\S|\\s]*?)-->)|(?:([^\\s>]+)\\s*((?:(?:[^\"'>]+)|(?:\"[^\"]*\")|(?:'[^']*'))*)\\/?>))", 'g')};
    };
    (function () {
        var l = /([\w\-:.]+)(?:(?:\s*=\s*(?:(?:"([^"]*)")|(?:'([^']*)')|([^\s>]+)))|(?=\s|$))/g, m = {
            checked: 1,
            compact: 1,
            declare: 1,
            defer: 1,
            disabled: 1,
            ismap: 1,
            multiple: 1,
            nohref: 1,
            noresize: 1,
            noshade: 1,
            nowrap: 1,
            readonly: 1,
            selected: 1
        };
        a.htmlParser.prototype = {
            onTagOpen: function () {
            }, onTagClose: function () {
            }, onText: function () {
            }, onCDATA: function () {
            }, onComment: function () {
            }, parse: function (n) {
                var A = this;
                var o, p, q = 0, r;
                while (o = A._.htmlPartsRegex.exec(n)) {
                    var s = o.index;
                    if (s > q) {
                        var t = n.substring(q, s);
                        if (r)r.push(t); else A.onText(t);
                    }
                    q = A._.htmlPartsRegex.lastIndex;
                    if (p = o[1]) {
                        p = p.toLowerCase();
                        if (r && f.$cdata[p]) {
                            A.onCDATA(r.join(''));

                            r = null;
                        }
                        if (!r) {
                            A.onTagClose(p);
                            continue;
                        }
                    }
                    if (r) {
                        r.push(o[0]);
                        continue;
                    }
                    if (p = o[3]) {
                        p = p.toLowerCase();
                        if (/="/.test(p))continue;
                        var u = {}, v, w = o[4], x = !!(w && w.charAt(w.length - 1) == '/');
                        if (w)while (v = l.exec(w)) {
                            var y = v[1].toLowerCase(), z = v[2] || v[3] || v[4] || '';
                            if (!z && m[y])u[y] = y; else u[y] = z;
                        }
                        A.onTagOpen(p, u, x);
                        if (!r && f.$cdata[p])r = [];
                        continue;
                    }
                    if (p = o[2])A.onComment(p);
                }
                if (n.length > q)A.onText(n.substring(q, n.length));
            }
        };
    })();
    a.htmlParser.comment = function (l) {
        this.value = l;
        this._ = {isBlockLike: false};
    };
    a.htmlParser.comment.prototype = {
        type: 8, writeHtml: function (l, m) {
            var n = this.value;
            if (m) {
                if (!(n = m.onComment(n, this)))return;
                if (typeof n != 'string') {
                    n.parent = this.parent;
                    n.writeHtml(l, m);
                    return;
                }
            }
            l.comment(n);
        }
    };
    (function () {
        var l = /[\t\r\n ]{2,}|[\t\r\n]/g;
        a.htmlParser.text = function (m) {
            this.value = m;
            this._ = {isBlockLike: false};
        };
        a.htmlParser.text.prototype = {
            type: 3, writeHtml: function (m, n) {
                var o = this.value;
                if (n && !(o = n.onText(o, this)))return;
                m.text(o);
            }
        };
    })();
    (function () {
        a.htmlParser.cdata = function (l) {
            this.value = l;
        };
        a.htmlParser.cdata.prototype = {
            type: 3, writeHtml: function (l) {
                l.write(this.value);
            }
        };
    })();
    a.htmlParser.fragment = function () {
        this.children = [];
        this.parent = null;
        this._ = {isBlockLike: true, hasInlineStarted: false};
    };
    (function () {
        var l = {
            colgroup: 1,
            dd: 1,
            dt: 1,
            li: 1,
            option: 1,
            p: 1,
            td: 1,
            tfoot: 1,
            th: 1,
            thead: 1,
            tr: 1
        }, m = e.extend({table: 1, ul: 1, ol: 1, dl: 1}, f.table, f.ul, f.ol, f.dl), n = f.$list, o = f.$listItem;
        a.htmlParser.fragment.fromHtml = function (p, q) {
            var r = new a.htmlParser(), s = [], t = new a.htmlParser.fragment(), u = [], v = [], w = t, x = false, y;

            function z(E) {
                var F;
                if (u.length > 0)for (var G = 0; G < u.length; G++) {
                    var H = u[G], I = H.name, J = f[I], K = w.name && f[w.name];
                    if ((!K || K[I]) && (!E || !J || J[E] || !f[E])) {
                        if (!F) {
                            A();
                            F = 1;
                        }
                        H = H.clone();
                        H.parent = w;
                        w = H;
                        u.splice(G, 1);
                        G--;
                    }
                }
            };
            function A(E) {
                while (v.length - (E || 0) > 0)w.add(v.shift());
            };
            function B(E, F, G) {
                F = F || w || t;
                if (q && !F.type) {
                    var H, I;
                    if (E.attributes && (I = E.attributes['data-cke-real-element-type']))H = I; else H = E.name;
                    if (H && !(H in f.$body) && !(H in f.$nonBodyContent)) {
                        var J = w;
                        w = F;
                        r.onTagOpen(q, {});
                        F = w;
                        if (G)w = J;
                    }
                }
                if (E._.isBlockLike && E.name != 'pre') {
                    var K = E.children.length, L = E.children[K - 1], M;
                    if (L && L.type == 3)if (!(M = e.rtrim(L.value)))E.children.length = K - 1; else L.value = M;
                }
                F.add(E);
                if (E.returnPoint) {
                    w = E.returnPoint;
                    delete E.returnPoint;
                }
            };
            r.onTagOpen = function (E, F, G) {
                var H = new a.htmlParser.element(E, F);
                if (H.isUnknown && G)H.isEmpty = true;
                if (f.$removeEmpty[E]) {
                    u.push(H);
                    return;
                } else if (E == 'pre')x = true; else if (E == 'br' && x) {
                    w.add(new a.htmlParser.text('\n'));
                    return;
                }
                if (E == 'br') {
                    v.push(H);
                    return;
                }
                var I = w.name, J = I && (f[I] || (w._.isBlockLike ? f.div : f.span));

                if (J && !H.isUnknown && !w.isUnknown && !J[E]) {
                    var K = false, L;
                    if (E in n && I in n) {
                        var M = w.children, N = M[M.length - 1];
                        if (!(N && N.name in o))B(N = new a.htmlParser.element('li'), w);
                        y = w, L = N;
                    } else if (E == I)B(w, w.parent); else if (E in f.$listItem) {
                        r.onTagOpen('ul', {});
                        L = w;
                        K = true;
                    } else {
                        if (m[I]) {
                            if (!y)y = w;
                        } else {
                            B(w, w.parent, true);
                            if (!l[I])u.unshift(w);
                        }
                        K = true;
                    }
                    if (L)w = L; else w = w.returnPoint || w.parent;
                    if (K) {
                        r.onTagOpen.apply(this, arguments);
                        return;
                    }
                }
                z(E);
                A();
                H.parent = w;
                H.returnPoint = y;
                y = 0;
                if (H.isEmpty)B(H); else w = H;
            };
            r.onTagClose = function (E) {
                for (var F = u.length - 1; F >= 0; F--) {
                    if (E == u[F].name) {
                        u.splice(F, 1);
                        return;
                    }
                }
                var G = [], H = [], I = w;
                while (I.type && I.name != E) {
                    if (!I._.isBlockLike)H.unshift(I);
                    G.push(I);
                    I = I.parent;
                }
                if (I.type) {
                    for (F = 0; F < G.length; F++) {
                        var J = G[F];
                        B(J, J.parent);
                    }
                    w = I;
                    if (w.name == 'pre')x = false;
                    if (I._.isBlockLike)A();
                    B(I, I.parent);
                    if (I == w)w = w.parent;
                    u = u.concat(H);
                }
                if (E == 'body')q = false;
            };
            r.onText = function (E) {
                if (!w._.hasInlineStarted && !x) {
                    E = e.ltrim(E);
                    if (E.length === 0)return;
                }
                A();
                z();
                if (q && (!w.type || w.name == 'body') && e.trim(E))this.onTagOpen(q, {});
                if (!x)E = E.replace(/[\t\r\n ]{2,}|[\t\r\n]/g, ' ');
                w.add(new a.htmlParser.text(E));
            };
            r.onCDATA = function (E) {
                w.add(new a.htmlParser.cdata(E));
            };
            r.onComment = function (E) {
                z();
                w.add(new a.htmlParser.comment(E));
            };
            r.parse(p);
            A(!c && 1);
            while (w.type) {
                var C = w.parent, D = w;
                if (q && (!C.type || C.name == 'body') && !f.$body[D.name]) {
                    w = C;
                    r.onTagOpen(q, {});
                    C = w;
                }
                C.add(D);
                w = C;
            }
            return t;
        };
        a.htmlParser.fragment.prototype = {
            add: function (p) {
                var s = this;
                var q = s.children.length, r = q > 0 && s.children[q - 1] || null;
                if (r) {
                    if (p._.isBlockLike && r.type == 3) {
                        r.value = e.rtrim(r.value);
                        if (r.value.length === 0) {
                            s.children.pop();
                            s.add(p);
                            return;
                        }
                    }
                    r.next = p;
                }
                p.previous = r;
                p.parent = s;
                s.children.push(p);
                s._.hasInlineStarted = p.type == 3 || p.type == 1 && !p._.isBlockLike;
            }, writeHtml: function (p, q) {
                var r;
                this.filterChildren = function () {
                    var s = new a.htmlParser.basicWriter();
                    this.writeChildrenHtml.call(this, s, q, true);
                    var t = s.getHtml();
                    this.children = new a.htmlParser.fragment.fromHtml(t).children;
                    r = 1;
                };
                !this.name && q && q.onFragment(this);
                this.writeChildrenHtml(p, r ? null : q);
            }, writeChildrenHtml: function (p, q) {
                for (var r = 0; r < this.children.length; r++)this.children[r].writeHtml(p, q);
            }
        };
    })();
    a.htmlParser.element = function (l, m) {
        var r = this;
        r.name = l;
        r.attributes = m || (m = {});
        r.children = [];
        var n = m['data-cke-real-element-type'] || l, o = f, p = !!(o.$nonBodyContent[n] || o.$block[n] || o.$listItem[n] || o.$tableContent[n] || o.$nonEditable[n] || n == 'br'), q = !!o.$empty[l];
        r.isEmpty = q;
        r.isUnknown = !o[l];
        r._ = {isBlockLike: p, hasInlineStarted: q || !p};
    };
    (function () {
        var l = function (m, n) {
            m = m[0];

            n = n[0];
            return m < n ? -1 : m > n ? 1 : 0;
        };
        a.htmlParser.element.prototype = {
            type: 1, add: a.htmlParser.fragment.prototype.add, clone: function () {
                return new a.htmlParser.element(this.name, this.attributes);
            }, writeHtml: function (m, n) {
                var o = this.attributes, p = this, q = p.name, r, s, t, u;
                p.filterChildren = function () {
                    if (!u) {
                        var z = new a.htmlParser.basicWriter();
                        a.htmlParser.fragment.prototype.writeChildrenHtml.call(p, z, n);
                        p.children = new a.htmlParser.fragment.fromHtml(z.getHtml()).children;
                        u = 1;
                    }
                };
                if (n) {
                    for (; ;) {
                        if (!(q = n.onElementName(q)))return;
                        p.name = q;
                        if (!(p = n.onElement(p)))return;
                        p.parent = this.parent;
                        if (p.name == q)break;
                        if (p.type != 1) {
                            p.writeHtml(m, n);
                            return;
                        }
                        q = p.name;
                        if (!q) {
                            this.writeChildrenHtml.call(p, m, u ? null : n);
                            return;
                        }
                    }
                    o = p.attributes;
                }
                m.openTag(q, o);
                var v = [];
                for (var w = 0; w < 2; w++)for (r in o) {
                    s = r;
                    t = o[r];
                    if (w == 1)v.push([r, t]); else if (n) {
                        for (; ;) {
                            if (!(s = n.onAttributeName(r))) {
                                delete o[r];
                                break;
                            } else if (s != r) {
                                delete o[r];
                                r = s;
                                continue;
                            } else break;
                        }
                        if (s)if ((t = n.onAttribute(p, s, t)) === false)delete o[s]; else o[s] = t;
                    }
                }
                if (m.sortAttributes)v.sort(l);
                var x = v.length;
                for (w = 0; w < x; w++) {
                    var y = v[w];
                    m.attribute(y[0], y[1]);
                }
                m.openTagClose(q, p.isEmpty);
                if (!p.isEmpty) {
                    this.writeChildrenHtml.call(p, m, u ? null : n);
                    m.closeTag(q);
                }
            }, writeChildrenHtml: function (m, n) {
                a.htmlParser.fragment.prototype.writeChildrenHtml.apply(this, arguments);
            }
        };
    })();
    (function () {
        a.htmlParser.filter = e.createClass({
            $: function (q) {
                this._ = {elementNames: [], attributeNames: [], elements: {$length: 0}, attributes: {$length: 0}};
                if (q)this.addRules(q, 10);
            }, proto: {
                addRules: function (q, r) {
                    var s = this;
                    if (typeof r != 'number')r = 10;
                    m(s._.elementNames, q.elementNames, r);
                    m(s._.attributeNames, q.attributeNames, r);
                    n(s._.elements, q.elements, r);
                    n(s._.attributes, q.attributes, r);
                    s._.text = o(s._.text, q.text, r) || s._.text;
                    s._.comment = o(s._.comment, q.comment, r) || s._.comment;
                    s._.root = o(s._.root, q.root, r) || s._.root;
                }, onElementName: function (q) {
                    return l(q, this._.elementNames);
                }, onAttributeName: function (q) {
                    return l(q, this._.attributeNames);
                }, onText: function (q) {
                    var r = this._.text;
                    return r ? r.filter(q) : q;
                }, onComment: function (q, r) {
                    var s = this._.comment;
                    return s ? s.filter(q, r) : q;
                }, onFragment: function (q) {
                    var r = this._.root;
                    return r ? r.filter(q) : q;
                }, onElement: function (q) {
                    var v = this;
                    var r = [v._.elements['^'], v._.elements[q.name], v._.elements.$], s, t;
                    for (var u = 0; u < 3; u++) {
                        s = r[u];
                        if (s) {
                            t = s.filter(q, v);
                            if (t === false)return null;
                            if (t && t != q)return v.onNode(t);
                            if (q.parent && !q.name)break;
                        }
                    }
                    return q;
                }, onNode: function (q) {
                    var r = q.type;
                    return r == 1 ? this.onElement(q) : r == 3 ? new a.htmlParser.text(this.onText(q.value)) : r == 8 ? new a.htmlParser.comment(this.onComment(q.value)) : null;

                }, onAttribute: function (q, r, s) {
                    var t = this._.attributes[r];
                    if (t) {
                        var u = t.filter(s, q, this);
                        if (u === false)return false;
                        if (typeof u != 'undefined')return u;
                    }
                    return s;
                }
            }
        });
        function l(q, r) {
            for (var s = 0; q && s < r.length; s++) {
                var t = r[s];
                q = q.replace(t[0], t[1]);
            }
            return q;
        };
        function m(q, r, s) {
            if (typeof r == 'function')r = [r];
            var t, u, v = q.length, w = r && r.length;
            if (w) {
                for (t = 0; t < v && q[t].pri < s; t++) {
                }
                for (u = w - 1; u >= 0; u--) {
                    var x = r[u];
                    if (x) {
                        x.pri = s;
                        q.splice(t, 0, x);
                    }
                }
            }
        };
        function n(q, r, s) {
            if (r)for (var t in r) {
                var u = q[t];
                q[t] = o(u, r[t], s);
                if (!u)q.$length++;
            }
        };
        function o(q, r, s) {
            if (r) {
                r.pri = s;
                if (q) {
                    if (!q.splice) {
                        if (q.pri > s)q = [r, q]; else q = [q, r];
                        q.filter = p;
                    } else m(q, r, s);
                    return q;
                } else {
                    r.filter = r;
                    return r;
                }
            }
        };
        function p(q) {
            var r = q.type || q instanceof a.htmlParser.fragment;
            for (var s = 0; s < this.length; s++) {
                if (r)var t = q.type, u = q.name;
                var v = this[s], w = v.apply(window, arguments);
                if (w === false)return w;
                if (r) {
                    if (w && (w.name != u || w.type != t))return w;
                } else if (typeof w != 'string')return w;
                w != undefined && (q = w);
            }
            return q;
        };
    })();
    a.htmlParser.basicWriter = e.createClass({
        $: function () {
            this._ = {output: []};
        }, proto: {
            openTag: function (l, m) {
                this._.output.push('<', l);
            }, openTagClose: function (l, m) {
                if (m)this._.output.push(' />'); else this._.output.push('>');
            }, attribute: function (l, m) {
                if (typeof m == 'string')m = e.htmlEncodeAttr(m);
                this._.output.push(' ', l, '="', m, '"');
            }, closeTag: function (l) {
                this._.output.push('</', l, '>');
            }, text: function (l) {
                this._.output.push(l);
            }, comment: function (l) {
                this._.output.push('<!--', l, '-->');
            }, write: function (l) {
                this._.output.push(l);
            }, reset: function () {
                this._.output = [];
                this._.indent = false;
            }, getHtml: function (l) {
                var m = this._.output.join('');
                if (l)this.reset();
                return m;
            }
        }
    });
    delete a.loadFullCore;
    a.instances = {};
    a.document = new g(document);
    a.add = function (l) {
        a.instances[l.name] = l;
        l.on('focus', function () {
            if (a.currentInstance != l) {
                a.currentInstance = l;
                a.fire('currentInstance');
            }
        });
        l.on('blur', function () {
            if (a.currentInstance == l) {
                a.currentInstance = null;
                a.fire('currentInstance');
            }
        });
    };
    a.remove = function (l) {
        delete a.instances[l.name];
    };
    a.on('instanceDestroyed', function () {
        if (e.isEmpty(this.instances))a.fire('reset');
    });
    a.TRISTATE_ON = 1;
    a.TRISTATE_OFF = 2;
    a.TRISTATE_DISABLED = 0;
    d.comment = e.createClass({
        base: d.node, $: function (l, m) {
            if (typeof l == 'string')l = (m ? m.$ : document).createComment(l);
            this.base(l);
        }, proto: {
            type: 8, getOuterHtml: function () {
                return '<!--' + this.$.nodeValue + '-->';
            }
        }
    });
    (function () {
        var l = {
            address: 1,
            blockquote: 1,
            dl: 1,
            h1: 1,
            h2: 1,
            h3: 1,
            h4: 1,
            h5: 1,
            h6: 1,
            p: 1,
            pre: 1,
            li: 1,
            dt: 1,
            dd: 1
        }, m = {body: 1, div: 1, table: 1, tbody: 1, tr: 1, td: 1, th: 1, caption: 1, form: 1}, n = function (o) {
            var p = o.getChildren();

            for (var q = 0, r = p.count(); q < r; q++) {
                var s = p.getItem(q);
                if (s.type == 1 && f.$block[s.getName()])return true;
            }
            return false;
        };
        d.elementPath = function (o) {
            var u = this;
            var p = null, q = null, r = [], s = o;
            while (s) {
                if (s.type == 1) {
                    if (!u.lastElement)u.lastElement = s;
                    var t = s.getName();
                    if (c && s.$.scopeName != 'HTML')t = s.$.scopeName.toLowerCase() + ':' + t;
                    if (!q) {
                        if (!p && l[t])p = s;
                        if (m[t])if (!p && t == 'div' && !n(s))p = s; else q = s;
                    }
                    r.push(s);
                    if (t == 'body')break;
                }
                s = s.getParent();
            }
            u.block = p;
            u.blockLimit = q;
            u.elements = r;
        };
    })();
    d.elementPath.prototype = {
        compare: function (l) {
            var m = this.elements, n = l && l.elements;
            if (!n || m.length != n.length)return false;
            for (var o = 0; o < m.length; o++) {
                if (!m[o].equals(n[o]))return false;
            }
            return true;
        }, contains: function (l) {
            var m = this.elements;
            for (var n = 0; n < m.length; n++) {
                if (m[n].getName() in l)return m[n];
            }
            return null;
        }
    };
    d.text = function (l, m) {
        if (typeof l == 'string')l = (m ? m.$ : document).createTextNode(l);
        this.$ = l;
    };
    d.text.prototype = new d.node();
    e.extend(d.text.prototype, {
        type: 3, getLength: function () {
            return this.$.nodeValue.length;
        }, getText: function () {
            return this.$.nodeValue;
        }, split: function (l) {
            var q = this;
            if (c && l == q.getLength()) {
                var m = q.getDocument().createText('');
                m.insertAfter(q);
                return m;
            }
            var n = q.getDocument(), o = new d.text(q.$.splitText(l), n);
            if (b.ie8) {
                var p = new d.text('', n);
                p.insertAfter(o);
                p.remove();
            }
            return o;
        }, substring: function (l, m) {
            if (typeof m != 'number')return this.$.nodeValue.substr(l); else return this.$.nodeValue.substring(l, m);
        }
    });
    d.documentFragment = function (l) {
        l = l || a.document;
        this.$ = l.$.createDocumentFragment();
    };
    e.extend(d.documentFragment.prototype, h.prototype, {
        type: 11, insertAfterNode: function (l) {
            l = l.$;
            l.parentNode.insertBefore(this.$, l.nextSibling);
        }
    }, true, {
        append: 1,
        appendBogus: 1,
        getFirst: 1,
        getLast: 1,
        appendTo: 1,
        moveChildren: 1,
        insertBefore: 1,
        insertAfterNode: 1,
        replace: 1,
        trim: 1,
        type: 1,
        ltrim: 1,
        rtrim: 1,
        getDocument: 1,
        getChildCount: 1,
        getChild: 1,
        getChildren: 1
    });
    (function () {
        function l(s, t) {
            if (this._.end)return null;
            var u, v = this.range, w, x = this.guard, y = this.type, z = s ? 'getPreviousSourceNode' : 'getNextSourceNode';
            if (!this._.start) {
                this._.start = 1;
                v.trim();
                if (v.collapsed) {
                    this.end();
                    return null;
                }
            }
            if (!s && !this._.guardLTR) {
                var A = v.endContainer, B = A.getChild(v.endOffset);
                this._.guardLTR = function (F, G) {
                    return (!G || !A.equals(F)) && (!B || !F.equals(B)) && (F.type != 1 || !G || F.getName() != 'body');
                };
            }
            if (s && !this._.guardRTL) {
                var C = v.startContainer, D = v.startOffset > 0 && C.getChild(v.startOffset - 1);
                this._.guardRTL = function (F, G) {
                    return (!G || !C.equals(F)) && (!D || !F.equals(D)) && (F.type != 1 || !G || F.getName() != 'body');
                };
            }
            var E = s ? this._.guardRTL : this._.guardLTR;

            if (x)w = function (F, G) {
                if (E(F, G) === false)return false;
                return x(F, G);
            }; else w = E;
            if (this.current)u = this.current[z](false, y, w); else if (s) {
                u = v.endContainer;
                if (v.endOffset > 0) {
                    u = u.getChild(v.endOffset - 1);
                    if (w(u) === false)u = null;
                } else u = w(u, true) === false ? null : u.getPreviousSourceNode(true, y, w);
            } else {
                u = v.startContainer;
                u = u.getChild(v.startOffset);
                if (u) {
                    if (w(u) === false)u = null;
                } else u = w(v.startContainer, true) === false ? null : v.startContainer.getNextSourceNode(true, y, w);
            }
            while (u && !this._.end) {
                this.current = u;
                if (!this.evaluator || this.evaluator(u) !== false) {
                    if (!t)return u;
                } else if (t && this.evaluator)return false;
                u = u[z](false, y, w);
            }
            this.end();
            return this.current = null;
        };
        function m(s) {
            var t, u = null;
            while (t = l.call(this, s))u = t;
            return u;
        };
        d.walker = e.createClass({
            $: function (s) {
                this.range = s;
                this._ = {};
            }, proto: {
                end: function () {
                    this._.end = 1;
                }, next: function () {
                    return l.call(this);
                }, previous: function () {
                    return l.call(this, 1);
                }, checkForward: function () {
                    return l.call(this, 0, 1) !== false;
                }, checkBackward: function () {
                    return l.call(this, 1, 1) !== false;
                }, lastForward: function () {
                    return m.call(this);
                }, lastBackward: function () {
                    return m.call(this, 1);
                }, reset: function () {
                    delete this.current;
                    this._ = {};
                }
            }
        });
        var n = {
            block: 1,
            'list-item': 1,
            table: 1,
            'table-row-group': 1,
            'table-header-group': 1,
            'table-footer-group': 1,
            'table-row': 1,
            'table-column-group': 1,
            'table-column': 1,
            'table-cell': 1,
            'table-caption': 1
        };
        h.prototype.isBlockBoundary = function (s) {
            var t = e.extend({}, f.$block, s || {});
            return this.getComputedStyle('float') == 'none' && n[this.getComputedStyle('display')] || t[this.getName()];
        };
        d.walker.blockBoundary = function (s) {
            return function (t, u) {
                return !(t.type == 1 && t.isBlockBoundary(s));
            };
        };
        d.walker.listItemBoundary = function () {
            return this.blockBoundary({br: 1});
        };
        d.walker.bookmark = function (s, t) {
            function u(v) {
                return v && v.getName && v.getName() == 'span' && v.data('cke-bookmark');
            };
            return function (v) {
                var w, x;
                w = v && !v.getName && (x = v.getParent()) && u(x);
                w = s ? w : w || u(v);
                return !!(t ^ w);
            };
        };
        d.walker.whitespaces = function (s) {
            return function (t) {
                var u = t && t.type == 3 && !e.trim(t.getText());
                return !!(s ^ u);
            };
        };
        d.walker.invisible = function (s) {
            var t = d.walker.whitespaces();
            return function (u) {
                var v = t(u) || u.is && !u.$.offsetHeight;
                return !!(s ^ v);
            };
        };
        var o = /^[\t\r\n ]*(?:&nbsp;|\xa0)$/, p = d.walker.whitespaces(1), q = d.walker.bookmark(0, 1), r = function (s) {
            return q(s) && p(s);
        };
        h.prototype.getBogus = function () {
            var s = this.getLast(r);
            if (s && (!c ? s.is && s.is('br') : s.getText && o.test(s.getText())))return s;
            return false;
        };
    })();
    d.range = function (l) {
        var m = this;
        m.startContainer = null;
        m.startOffset = null;
        m.endContainer = null;

        m.endOffset = null;
        m.collapsed = true;
        m.document = l;
    };
    (function () {
        var l = function (t) {
            t.collapsed = t.startContainer && t.endContainer && t.startContainer.equals(t.endContainer) && t.startOffset == t.endOffset;
        }, m = function (t, u, v) {
            t.optimizeBookmark();
            var w = t.startContainer, x = t.endContainer, y = t.startOffset, z = t.endOffset, A, B;
            if (x.type == 3)x = x.split(z); else if (x.getChildCount() > 0)if (z >= x.getChildCount()) {
                x = x.append(t.document.createText(''));
                B = true;
            } else x = x.getChild(z);
            if (w.type == 3) {
                w.split(y);
                if (w.equals(x))x = w.getNext();
            } else if (!y) {
                w = w.getFirst().insertBeforeMe(t.document.createText(''));
                A = true;
            } else if (y >= w.getChildCount()) {
                w = w.append(t.document.createText(''));
                A = true;
            } else w = w.getChild(y).getPrevious();
            var C = w.getParents(), D = x.getParents(), E, F, G;
            for (E = 0; E < C.length; E++) {
                F = C[E];
                G = D[E];
                if (!F.equals(G))break;
            }
            var H = v, I, J, K, L;
            for (var M = E; M < C.length; M++) {
                I = C[M];
                if (H && !I.equals(w))J = H.append(I.clone());
                K = I.getNext();
                while (K) {
                    if (K.equals(D[M]) || K.equals(x))break;
                    L = K.getNext();
                    if (u == 2)H.append(K.clone(true)); else {
                        K.remove();
                        if (u == 1)H.append(K);
                    }
                    K = L;
                }
                if (H)H = J;
            }
            H = v;
            for (var N = E; N < D.length; N++) {
                I = D[N];
                if (u > 0 && !I.equals(x))J = H.append(I.clone());
                if (!C[N] || I.$.parentNode != C[N].$.parentNode) {
                    K = I.getPrevious();
                    while (K) {
                        if (K.equals(C[N]) || K.equals(w))break;
                        L = K.getPrevious();
                        if (u == 2)H.$.insertBefore(K.$.cloneNode(true), H.$.firstChild); else {
                            K.remove();
                            if (u == 1)H.$.insertBefore(K.$, H.$.firstChild);
                        }
                        K = L;
                    }
                }
                if (H)H = J;
            }
            if (u == 2) {
                var O = t.startContainer;
                if (O.type == 3) {
                    O.$.data += O.$.nextSibling.data;
                    O.$.parentNode.removeChild(O.$.nextSibling);
                }
                var P = t.endContainer;
                if (P.type == 3 && P.$.nextSibling) {
                    P.$.data += P.$.nextSibling.data;
                    P.$.parentNode.removeChild(P.$.nextSibling);
                }
            } else {
                if (F && G && (w.$.parentNode != F.$.parentNode || x.$.parentNode != G.$.parentNode)) {
                    var Q = G.getIndex();
                    if (A && G.$.parentNode == w.$.parentNode)Q--;
                    t.setStart(G.getParent(), Q);
                }
                t.collapse(true);
            }
            if (A)w.remove();
            if (B && x.$.parentNode)x.remove();
        }, n = {
            abbr: 1,
            acronym: 1,
            b: 1,
            bdo: 1,
            big: 1,
            cite: 1,
            code: 1,
            del: 1,
            dfn: 1,
            em: 1,
            font: 1,
            i: 1,
            ins: 1,
            label: 1,
            kbd: 1,
            q: 1,
            samp: 1,
            small: 1,
            span: 1,
            strike: 1,
            strong: 1,
            sub: 1,
            sup: 1,
            tt: 1,
            u: 1,
            'var': 1
        };

        function o(t) {
            var u = false, v = d.walker.bookmark(true);
            return function (w) {
                if (v(w))return true;
                if (w.type == 3) {
                    if (e.trim(w.getText()).length)return false;
                } else if (w.type == 1)if (!n[w.getName()])if (!t && !c && w.getName() == 'br' && !u)u = true; else return false;
                return true;
            };
        };
        function p(t) {
            return t.type != 3 && t.getName() in f.$removeEmpty || !e.trim(t.getText()) || !!t.getParent().data('cke-bookmark');
        };
        var q = new d.walker.whitespaces(), r = new d.walker.bookmark();

        function s(t) {
            return !q(t) && !r(t);
        };
        d.range.prototype = {
            clone: function () {
                var u = this;
                var t = new d.range(u.document);
                t.startContainer = u.startContainer;
                t.startOffset = u.startOffset;
                t.endContainer = u.endContainer;
                t.endOffset = u.endOffset;
                t.collapsed = u.collapsed;
                return t;
            }, collapse: function (t) {
                var u = this;
                if (t) {
                    u.endContainer = u.startContainer;
                    u.endOffset = u.startOffset;
                } else {
                    u.startContainer = u.endContainer;
                    u.startOffset = u.endOffset;
                }
                u.collapsed = true;
            }, cloneContents: function () {
                var t = new d.documentFragment(this.document);
                if (!this.collapsed)m(this, 2, t);
                return t;
            }, deleteContents: function () {
                if (this.collapsed)return;
                m(this, 0);
            }, extractContents: function () {
                var t = new d.documentFragment(this.document);
                if (!this.collapsed)m(this, 1, t);
                return t;
            }, createBookmark: function (t) {
                var z = this;
                var u, v, w, x, y = z.collapsed;
                u = z.document.createElement('span');
                u.data('cke-bookmark', 1);
                u.setStyle('display', 'none');
                u.setHtml('&nbsp;');
                if (t) {
                    w = 'cke_bm_' + e.getNextNumber();
                    u.setAttribute('id', w + 'S');
                }
                if (!y) {
                    v = u.clone();
                    v.setHtml('&nbsp;');
                    if (t)v.setAttribute('id', w + 'E');
                    x = z.clone();
                    x.collapse();
                    x.insertNode(v);
                }
                x = z.clone();
                x.collapse(true);
                x.insertNode(u);
                if (v) {
                    z.setStartAfter(u);
                    z.setEndBefore(v);
                } else z.moveToPosition(u, 4);
                return {startNode: t ? w + 'S' : u, endNode: t ? w + 'E' : v, serializable: t, collapsed: y};
            }, createBookmark2: function (t) {
                var B = this;
                var u = B.startContainer, v = B.endContainer, w = B.startOffset, x = B.endOffset, y = B.collapsed, z, A;
                if (!u || !v)return {start: 0, end: 0};
                if (t) {
                    if (u.type == 1) {
                        z = u.getChild(w);
                        if (z && z.type == 3 && w > 0 && z.getPrevious().type == 3) {
                            u = z;
                            w = 0;
                        }
                    }
                    while (u.type == 3 && (A = u.getPrevious()) && A.type == 3) {
                        u = A;
                        w += A.getLength();
                    }
                    if (!y) {
                        if (v.type == 1) {
                            z = v.getChild(x);
                            if (z && z.type == 3 && x > 0 && z.getPrevious().type == 3) {
                                v = z;
                                x = 0;
                            }
                        }
                        while (v.type == 3 && (A = v.getPrevious()) && A.type == 3) {
                            v = A;
                            x += A.getLength();
                        }
                    }
                }
                return {
                    start: u.getAddress(t),
                    end: y ? null : v.getAddress(t),
                    startOffset: w,
                    endOffset: x,
                    normalized: t,
                    collapsed: y,
                    is2: true
                };
            }, moveToBookmark: function (t) {
                var B = this;
                if (t.is2) {
                    var u = B.document.getByAddress(t.start, t.normalized), v = t.startOffset, w = t.end && B.document.getByAddress(t.end, t.normalized), x = t.endOffset;
                    B.setStart(u, v);
                    if (w)B.setEnd(w, x); else B.collapse(true);
                } else {
                    var y = t.serializable, z = y ? B.document.getById(t.startNode) : t.startNode, A = y ? B.document.getById(t.endNode) : t.endNode;
                    B.setStartBefore(z);
                    z.remove();
                    if (A) {
                        B.setEndBefore(A);
                        A.remove();
                    } else B.collapse(true);
                }
            }, getBoundaryNodes: function () {
                var y = this;
                var t = y.startContainer, u = y.endContainer, v = y.startOffset, w = y.endOffset, x;
                if (t.type == 1) {
                    x = t.getChildCount();
                    if (x > v)t = t.getChild(v); else if (x < 1)t = t.getPreviousSourceNode();

                    else {
                        t = t.$;
                        while (t.lastChild)t = t.lastChild;
                        t = new d.node(t);
                        t = t.getNextSourceNode() || t;
                    }
                }
                if (u.type == 1) {
                    x = u.getChildCount();
                    if (x > w)u = u.getChild(w).getPreviousSourceNode(true); else if (x < 1)u = u.getPreviousSourceNode(); else {
                        u = u.$;
                        while (u.lastChild)u = u.lastChild;
                        u = new d.node(u);
                    }
                }
                if (t.getPosition(u) & 2)t = u;
                return {startNode: t, endNode: u};
            }, getCommonAncestor: function (t, u) {
                var y = this;
                var v = y.startContainer, w = y.endContainer, x;
                if (v.equals(w)) {
                    if (t && v.type == 1 && y.startOffset == y.endOffset - 1)x = v.getChild(y.startOffset); else x = v;
                } else x = v.getCommonAncestor(w);
                return u && !x.is ? x.getParent() : x;
            }, optimize: function () {
                var v = this;
                var t = v.startContainer, u = v.startOffset;
                if (t.type != 1)if (!u)v.setStartBefore(t); else if (u >= t.getLength())v.setStartAfter(t);
                t = v.endContainer;
                u = v.endOffset;
                if (t.type != 1)if (!u)v.setEndBefore(t); else if (u >= t.getLength())v.setEndAfter(t);
            }, optimizeBookmark: function () {
                var v = this;
                var t = v.startContainer, u = v.endContainer;
                if (t.is && t.is('span') && t.data('cke-bookmark'))v.setStartAt(t, 3);
                if (u && u.is && u.is('span') && u.data('cke-bookmark'))v.setEndAt(u, 4);
            }, trim: function (t, u) {
                var B = this;
                var v = B.startContainer, w = B.startOffset, x = B.collapsed;
                if ((!t || x) && v && v.type == 3) {
                    if (!w) {
                        w = v.getIndex();
                        v = v.getParent();
                    } else if (w >= v.getLength()) {
                        w = v.getIndex() + 1;
                        v = v.getParent();
                    } else {
                        var y = v.split(w);
                        w = v.getIndex() + 1;
                        v = v.getParent();
                        if (B.startContainer.equals(B.endContainer))B.setEnd(y, B.endOffset - B.startOffset); else if (v.equals(B.endContainer))B.endOffset += 1;
                    }
                    B.setStart(v, w);
                    if (x) {
                        B.collapse(true);
                        return;
                    }
                }
                var z = B.endContainer, A = B.endOffset;
                if (!(u || x) && z && z.type == 3) {
                    if (!A) {
                        A = z.getIndex();
                        z = z.getParent();
                    } else if (A >= z.getLength()) {
                        A = z.getIndex() + 1;
                        z = z.getParent();
                    } else {
                        z.split(A);
                        A = z.getIndex() + 1;
                        z = z.getParent();
                    }
                    B.setEnd(z, A);
                }
            }, enlarge: function (t) {
                switch (t) {
                    case 1:
                        if (this.collapsed)return;
                        var u = this.getCommonAncestor(), v = this.document.getBody(), w, x, y, z, A, B = false, C, D, E = this.startContainer, F = this.startOffset;
                        if (E.type == 3) {
                            if (F) {
                                E = !e.trim(E.substring(0, F)).length && E;
                                B = !!E;
                            }
                            if (E)if (!(z = E.getPrevious()))y = E.getParent();
                        } else {
                            if (F)z = E.getChild(F - 1) || E.getLast();
                            if (!z)y = E;
                        }
                        while (y || z) {
                            if (y && !z) {
                                if (!A && y.equals(u))A = true;
                                if (!v.contains(y))break;
                                if (!B || y.getComputedStyle('display') != 'inline') {
                                    B = false;
                                    if (A)w = y; else this.setStartBefore(y);
                                }
                                z = y.getPrevious();
                            }
                            while (z) {
                                C = false;
                                if (z.type == 3) {
                                    D = z.getText();
                                    if (/[^\s\ufeff]/.test(D))z = null;
                                    C = /[\s\ufeff]$/.test(D);
                                } else if (z.$.offsetWidth > 0 && !z.data('cke-bookmark'))if (B && f.$removeEmpty[z.getName()]) {
                                    D = z.getText();
                                    if (/[^\s\ufeff]/.test(D))z = null; else {
                                        var G = z.$.all || z.$.getElementsByTagName('*');

                                        for (var H = 0, I; I = G[H++];) {
                                            if (!f.$removeEmpty[I.nodeName.toLowerCase()]) {
                                                z = null;
                                                break;
                                            }
                                        }
                                    }
                                    if (z)C = !!D.length;
                                } else z = null;
                                if (C)if (B) {
                                    if (A)w = y; else if (y)this.setStartBefore(y);
                                } else B = true;
                                if (z) {
                                    var J = z.getPrevious();
                                    if (!y && !J) {
                                        y = z;
                                        z = null;
                                        break;
                                    }
                                    z = J;
                                } else y = null;
                            }
                            if (y)y = y.getParent();
                        }
                        E = this.endContainer;
                        F = this.endOffset;
                        y = z = null;
                        A = B = false;
                        if (E.type == 3) {
                            E = !e.trim(E.substring(F)).length && E;
                            B = !(E && E.getLength());
                            if (E)if (!(z = E.getNext()))y = E.getParent();
                        } else {
                            z = E.getChild(F);
                            if (!z)y = E;
                        }
                        while (y || z) {
                            if (y && !z) {
                                if (!A && y.equals(u))A = true;
                                if (!v.contains(y))break;
                                if (!B || y.getComputedStyle('display') != 'inline') {
                                    B = false;
                                    if (A)x = y; else if (y)this.setEndAfter(y);
                                }
                                z = y.getNext();
                            }
                            while (z) {
                                C = false;
                                if (z.type == 3) {
                                    D = z.getText();
                                    if (/[^\s\ufeff]/.test(D))z = null;
                                    C = /^[\s\ufeff]/.test(D);
                                } else if (z.$.offsetWidth > 0 && !z.data('cke-bookmark'))if (B && f.$removeEmpty[z.getName()]) {
                                    D = z.getText();
                                    if (/[^\s\ufeff]/.test(D))z = null; else {
                                        G = z.$.all || z.$.getElementsByTagName('*');
                                        for (H = 0; I = G[H++];) {
                                            if (!f.$removeEmpty[I.nodeName.toLowerCase()]) {
                                                z = null;
                                                break;
                                            }
                                        }
                                    }
                                    if (z)C = !!D.length;
                                } else z = null;
                                if (C)if (B)if (A)x = y; else this.setEndAfter(y);
                                if (z) {
                                    J = z.getNext();
                                    if (!y && !J) {
                                        y = z;
                                        z = null;
                                        break;
                                    }
                                    z = J;
                                } else y = null;
                            }
                            if (y)y = y.getParent();
                        }
                        if (w && x) {
                            u = w.contains(x) ? x : w;
                            this.setStartBefore(u);
                            this.setEndAfter(u);
                        }
                        break;
                    case 2:
                    case 3:
                        var K = new d.range(this.document);
                        v = this.document.getBody();
                        K.setStartAt(v, 1);
                        K.setEnd(this.startContainer, this.startOffset);
                        var L = new d.walker(K), M, N, O = d.walker.blockBoundary(t == 3 ? {br: 1} : null), P = function (R) {
                            var S = O(R);
                            if (!S)M = R;
                            return S;
                        }, Q = function (R) {
                            var S = P(R);
                            if (!S && R.is && R.is('br'))N = R;
                            return S;
                        };
                        L.guard = P;
                        y = L.lastBackward();
                        M = M || v;
                        this.setStartAt(M, !M.is('br') && (!y && this.checkStartOfBlock() || y && M.contains(y)) ? 1 : 4);
                        K = this.clone();
                        K.collapse();
                        K.setEndAt(v, 2);
                        L = new d.walker(K);
                        L.guard = t == 3 ? Q : P;
                        M = null;
                        y = L.lastForward();
                        M = M || v;
                        this.setEndAt(M, !y && this.checkEndOfBlock() || y && M.contains(y) ? 2 : 3);
                        if (N)this.setEndAfter(N);
                }
            }, shrink: function (t, u) {
                if (!this.collapsed) {
                    t = t || 2;
                    var v = this.clone(), w = this.startContainer, x = this.endContainer, y = this.startOffset, z = this.endOffset, A = this.collapsed, B = 1, C = 1;
                    if (w && w.type == 3)if (!y)v.setStartBefore(w); else if (y >= w.getLength())v.setStartAfter(w); else {
                        v.setStartBefore(w);
                        B = 0;
                    }
                    if (x && x.type == 3)if (!z)v.setEndBefore(x); else if (z >= x.getLength())v.setEndAfter(x); else {
                        v.setEndAfter(x);
                        C = 0;
                    }
                    var D = new d.walker(v), E = d.walker.bookmark();
                    D.evaluator = function (I) {
                        return I.type == (t == 1 ? 1 : 3);
                    };
                    var F;
                    D.guard = function (I, J) {
                        if (E(I))return true;
                        if (t == 1 && I.type == 3)return false;
                        if (J && I.equals(F))return false;

                        if (!J && I.type == 1)F = I;
                        return true;
                    };
                    if (B) {
                        var G = D[t == 1 ? 'lastForward' : 'next']();
                        G && this.setStartAt(G, u ? 1 : 3);
                    }
                    if (C) {
                        D.reset();
                        var H = D[t == 1 ? 'lastBackward' : 'previous']();
                        H && this.setEndAt(H, u ? 2 : 4);
                    }
                    return !!(B || C);
                }
            }, insertNode: function (t) {
                var x = this;
                x.optimizeBookmark();
                x.trim(false, true);
                var u = x.startContainer, v = x.startOffset, w = u.getChild(v);
                if (w)t.insertBefore(w); else u.append(t);
                if (t.getParent().equals(x.endContainer))x.endOffset++;
                x.setStartBefore(t);
            }, moveToPosition: function (t, u) {
                this.setStartAt(t, u);
                this.collapse(true);
            }, selectNodeContents: function (t) {
                this.setStart(t, 0);
                this.setEnd(t, t.type == 3 ? t.getLength() : t.getChildCount());
            }, setStart: function (t, u) {
                var v = this;
                if (t.type == 1 && f.$empty[t.getName()])u = t.getIndex(), t = t.getParent();
                v.startContainer = t;
                v.startOffset = u;
                if (!v.endContainer) {
                    v.endContainer = t;
                    v.endOffset = u;
                }
                l(v);
            }, setEnd: function (t, u) {
                var v = this;
                if (t.type == 1 && f.$empty[t.getName()])u = t.getIndex() + 1, t = t.getParent();
                v.endContainer = t;
                v.endOffset = u;
                if (!v.startContainer) {
                    v.startContainer = t;
                    v.startOffset = u;
                }
                l(v);
            }, setStartAfter: function (t) {
                this.setStart(t.getParent(), t.getIndex() + 1);
            }, setStartBefore: function (t) {
                this.setStart(t.getParent(), t.getIndex());
            }, setEndAfter: function (t) {
                this.setEnd(t.getParent(), t.getIndex() + 1);
            }, setEndBefore: function (t) {
                this.setEnd(t.getParent(), t.getIndex());
            }, setStartAt: function (t, u) {
                var v = this;
                switch (u) {
                    case 1:
                        v.setStart(t, 0);
                        break;
                    case 2:
                        if (t.type == 3)v.setStart(t, t.getLength()); else v.setStart(t, t.getChildCount());
                        break;
                    case 3:
                        v.setStartBefore(t);
                        break;
                    case 4:
                        v.setStartAfter(t);
                }
                l(v);
            }, setEndAt: function (t, u) {
                var v = this;
                switch (u) {
                    case 1:
                        v.setEnd(t, 0);
                        break;
                    case 2:
                        if (t.type == 3)v.setEnd(t, t.getLength()); else v.setEnd(t, t.getChildCount());
                        break;
                    case 3:
                        v.setEndBefore(t);
                        break;
                    case 4:
                        v.setEndAfter(t);
                }
                l(v);
            }, fixBlock: function (t, u) {
                var x = this;
                var v = x.createBookmark(), w = x.document.createElement(u);
                x.collapse(t);
                x.enlarge(2);
                x.extractContents().appendTo(w);
                w.trim();
                if (!c)w.appendBogus();
                x.insertNode(w);
                x.moveToBookmark(v);
                return w;
            }, splitBlock: function (t) {
                var D = this;
                var u = new d.elementPath(D.startContainer), v = new d.elementPath(D.endContainer), w = u.blockLimit, x = v.blockLimit, y = u.block, z = v.block, A = null;
                if (!w.equals(x))return null;
                if (t != 'br') {
                    if (!y) {
                        y = D.fixBlock(true, t);
                        z = new d.elementPath(D.endContainer).block;
                    }
                    if (!z)z = D.fixBlock(false, t);
                }
                var B = y && D.checkStartOfBlock(), C = z && D.checkEndOfBlock();
                D.deleteContents();
                if (y && y.equals(z))if (C) {
                    A = new d.elementPath(D.startContainer);
                    D.moveToPosition(z, 4);
                    z = null;
                } else if (B) {
                    A = new d.elementPath(D.startContainer);

                    D.moveToPosition(y, 3);
                    y = null;
                } else {
                    z = D.splitElement(y);
                    if (!c && !y.is('ul', 'ol'))y.appendBogus();
                }
                return {previousBlock: y, nextBlock: z, wasStartOfBlock: B, wasEndOfBlock: C, elementPath: A};
            }, splitElement: function (t) {
                var w = this;
                if (!w.collapsed)return null;
                w.setEndAt(t, 2);
                var u = w.extractContents(), v = t.clone(false);
                u.appendTo(v);
                v.insertAfter(t);
                w.moveToPosition(t, 4);
                return v;
            }, checkBoundaryOfElement: function (t, u) {
                var v = u == 1, w = this.clone();
                w.collapse(v);
                w[v ? 'setStartAt' : 'setEndAt'](t, v ? 1 : 2);
                var x = new d.walker(w);
                x.evaluator = p;
                return x[v ? 'checkBackward' : 'checkForward']();
            }, checkStartOfBlock: function () {
                var z = this;
                var t = z.startContainer, u = z.startOffset;
                if (u && t.type == 3) {
                    var v = e.ltrim(t.substring(0, u));
                    if (v.length)return false;
                }
                z.trim();
                var w = new d.elementPath(z.startContainer), x = z.clone();
                x.collapse(true);
                x.setStartAt(w.block || w.blockLimit, 1);
                var y = new d.walker(x);
                y.evaluator = o(true);
                return y.checkBackward();
            }, checkEndOfBlock: function () {
                var z = this;
                var t = z.endContainer, u = z.endOffset;
                if (t.type == 3) {
                    var v = e.rtrim(t.substring(u));
                    if (v.length)return false;
                }
                z.trim();
                var w = new d.elementPath(z.endContainer), x = z.clone();
                x.collapse(false);
                x.setEndAt(w.block || w.blockLimit, 2);
                var y = new d.walker(x);
                y.evaluator = o(false);
                return y.checkForward();
            }, moveToElementEditablePosition: function (t, u) {
                var v;
                if (f.$empty[t.getName()])return false;
                while (t && t.type == 1) {
                    v = t.isEditable();
                    if (v)this.moveToPosition(t, u ? 2 : 1); else if (f.$inline[t.getName()]) {
                        this.moveToPosition(t, u ? 4 : 3);
                        return true;
                    }
                    if (f.$empty[t.getName()])t = t[u ? 'getPrevious' : 'getNext'](s); else t = t[u ? 'getLast' : 'getFirst'](s);
                    if (t && t.type == 3) {
                        this.moveToPosition(t, u ? 4 : 3);
                        return true;
                    }
                }
                return v;
            }, moveToElementEditStart: function (t) {
                return this.moveToElementEditablePosition(t);
            }, moveToElementEditEnd: function (t) {
                return this.moveToElementEditablePosition(t, true);
            }, getEnclosedNode: function () {
                var t = this.clone();
                t.optimize();
                if (t.startContainer.type != 1 || t.endContainer.type != 1)return null;
                var u = new d.walker(t), v = d.walker.bookmark(true), w = d.walker.whitespaces(true), x = function (z) {
                    return w(z) && v(z);
                };
                t.evaluator = x;
                var y = u.next();
                u.reset();
                return y && y.equals(u.previous()) ? y : null;
            }, getTouchedStartNode: function () {
                var t = this.startContainer;
                if (this.collapsed || t.type != 1)return t;
                return t.getChild(this.startOffset) || t;
            }, getTouchedEndNode: function () {
                var t = this.endContainer;
                if (this.collapsed || t.type != 1)return t;
                return t.getChild(this.endOffset - 1) || t;
            }
        };
    })();
    a.POSITION_AFTER_START = 1;
    a.POSITION_BEFORE_END = 2;
    a.POSITION_BEFORE_START = 3;
    a.POSITION_AFTER_END = 4;
    a.ENLARGE_ELEMENT = 1;

    a.ENLARGE_BLOCK_CONTENTS = 2;
    a.ENLARGE_LIST_ITEM_CONTENTS = 3;
    a.START = 1;
    a.END = 2;
    a.STARTEND = 3;
    a.SHRINK_ELEMENT = 1;
    a.SHRINK_TEXT = 2;
    (function () {
        d.rangeList = function (n) {
            if (n instanceof d.rangeList)return n;
            if (!n)n = []; else if (n instanceof d.range)n = [n];
            return e.extend(n, l);
        };
        var l = {
            createIterator: function () {
                var n = this, o = d.walker.bookmark(), p = function (s) {
                    return !(s.is && s.is('tr'));
                }, q = [], r;
                return {
                    getNextRange: function (s) {
                        r = r == undefined ? 0 : r + 1;
                        var t = n[r];
                        if (t && n.length > 1) {
                            if (!r)for (var u = n.length - 1; u >= 0; u--)q.unshift(n[u].createBookmark(true));
                            if (s) {
                                var v = 0;
                                while (n[r + v + 1]) {
                                    var w = t.document, x = 0, y = w.getById(q[v].endNode), z = w.getById(q[v + 1].startNode), A;
                                    while (1) {
                                        A = y.getNextSourceNode(false);
                                        if (!z.equals(A)) {
                                            if (o(A) || A.type == 1 && A.isBlockBoundary()) {
                                                y = A;
                                                continue;
                                            }
                                        } else x = 1;
                                        break;
                                    }
                                    if (!x)break;
                                    v++;
                                }
                            }
                            t.moveToBookmark(q.shift());
                            while (v--) {
                                A = n[++r];
                                A.moveToBookmark(q.shift());
                                t.setEnd(A.endContainer, A.endOffset);
                            }
                        }
                        return t;
                    }
                };
            }, createBookmarks: function (n) {
                var s = this;
                var o = [], p;
                for (var q = 0; q < s.length; q++) {
                    o.push(p = s[q].createBookmark(n, true));
                    for (var r = q + 1; r < s.length; r++) {
                        s[r] = m(p, s[r]);
                        s[r] = m(p, s[r], true);
                    }
                }
                return o;
            }, createBookmarks2: function (n) {
                var o = [];
                for (var p = 0; p < this.length; p++)o.push(this[p].createBookmark2(n));
                return o;
            }, moveToBookmarks: function (n) {
                for (var o = 0; o < this.length; o++)this[o].moveToBookmark(n[o]);
            }
        };

        function m(n, o, p) {
            var q = n.serializable, r = o[p ? 'endContainer' : 'startContainer'], s = p ? 'endOffset' : 'startOffset', t = q ? o.document.getById(n.startNode) : n.startNode, u = q ? o.document.getById(n.endNode) : n.endNode;
            if (r.equals(t.getPrevious())) {
                o.startOffset = o.startOffset - r.getLength() - u.getPrevious().getLength();
                r = u.getNext();
            } else if (r.equals(u.getPrevious())) {
                o.startOffset = o.startOffset - r.getLength();
                r = u.getNext();
            }
            r.equals(t.getParent()) && o[s]++;
            r.equals(u.getParent()) && o[s]++;
            o[p ? 'endContainer' : 'startContainer'] = r;
            return o;
        };
    })();
    (function () {
        if (b.webkit) {
            b.hc = false;
            return;
        }
        var l = c && b.version < 7, m = c && b.version == 7, n = l ? a.basePath + 'images/spacer.gif' : m ? 'about:blank' : 'data:image/png;base64,', o = h.createFromHtml('<div style="width:0px;height:0px;position:absolute;left:-10000px;background-image:url(' + n + ')"></div>', a.document);
        o.appendTo(a.document.getHead());
        try {
            b.hc = o.getComputedStyle('background-image') == 'none';
        } catch (p) {
            b.hc = false;
        }
        if (b.hc)b.cssClass += ' cke_hc';
        o.remove();
    })();
    j.load(i.corePlugins.split(','), function () {
        a.status = 'loaded';
        a.fire('loaded');
        var l = a._.pending;
        if (l) {
            delete a._.pending;
            for (var m = 0; m < l.length; m++)a.add(l[m]);
        }
    });
    if (c)try {
        document.execCommand('BackgroundImageCache', false, true);

    } catch (l) {
    }
    a.skins.add('kama', (function () {
        var m = 'cke_ui_color';
        return {
            editor: {css: ['editor.css']},
            dialog: {css: ['dialog.css']},
            templates: {css: ['templates.css']},
            margins: [0, 0, 0, 0],
            init: function (n) {
                if (n.config.width && !isNaN(n.config.width))n.config.width -= 12;
                var o = [], p = /\$color/g, q = '/* UI Color Support */.cke_skin_kama .cke_menuitem .cke_icon_wrapper{\tbackground-color: $color !important;\tborder-color: $color !important;}.cke_skin_kama .cke_menuitem a:hover .cke_icon_wrapper,.cke_skin_kama .cke_menuitem a:focus .cke_icon_wrapper,.cke_skin_kama .cke_menuitem a:active .cke_icon_wrapper{\tbackground-color: $color !important;\tborder-color: $color !important;}.cke_skin_kama .cke_menuitem a:hover .cke_label,.cke_skin_kama .cke_menuitem a:focus .cke_label,.cke_skin_kama .cke_menuitem a:active .cke_label{\tbackground-color: $color !important;}.cke_skin_kama .cke_menuitem a.cke_disabled:hover .cke_label,.cke_skin_kama .cke_menuitem a.cke_disabled:focus .cke_label,.cke_skin_kama .cke_menuitem a.cke_disabled:active .cke_label{\tbackground-color: transparent !important;}.cke_skin_kama .cke_menuitem a.cke_disabled:hover .cke_icon_wrapper,.cke_skin_kama .cke_menuitem a.cke_disabled:focus .cke_icon_wrapper,.cke_skin_kama .cke_menuitem a.cke_disabled:active .cke_icon_wrapper{\tbackground-color: $color !important;\tborder-color: $color !important;}.cke_skin_kama .cke_menuitem a.cke_disabled .cke_icon_wrapper{\tbackground-color: $color !important;\tborder-color: $color !important;}.cke_skin_kama .cke_menuseparator{\tbackground-color: $color !important;}.cke_skin_kama .cke_menuitem a:hover,.cke_skin_kama .cke_menuitem a:focus,.cke_skin_kama .cke_menuitem a:active{\tbackground-color: $color !important;}';
                if (b.webkit) {
                    q = q.split('}').slice(0, -1);
                    for (var r = 0; r < q.length; r++)q[r] = q[r].split('{');
                }
                function s(v) {
                    var w = v.getById(m);
                    if (!w) {
                        w = v.getHead().append('style');
                        w.setAttribute('id', m);
                        w.setAttribute('type', 'text/css');
                    }
                    return w;
                };
                function t(v, w, x) {
                    var y, z, A;
                    for (var B = 0; B < v.length; B++) {
                        if (b.webkit)for (z = 0; z < w.length; z++) {
                            A = w[z][1];
                            for (y = 0; y < x.length; y++)A = A.replace(x[y][0], x[y][1]);
                            v[B].$.sheet.addRule(w[z][0], A);
                        } else {
                            A = w;
                            for (y = 0; y < x.length; y++)A = A.replace(x[y][0], x[y][1]);
                            if (c)v[B].$.styleSheet.cssText += A; else v[B].$.innerHTML += A;
                        }
                    }
                };
                var u = /\$color/g;
                e.extend(n, {
                    uiColor: null, getUiColor: function () {
                        return this.uiColor;
                    }, setUiColor: function (v) {
                        var w, x = s(a.document), y = '.' + n.id, z = [y + ' .cke_wrapper', y + '_dialog .cke_dialog_contents', y + '_dialog a.cke_dialog_tab', y + '_dialog .cke_dialog_footer'].join(','), A = 'background-color: $color !important;';

                        if (b.webkit)w = [[z, A]]; else w = z + '{' + A + '}';
                        return (this.setUiColor = function (B) {
                            var C = [[u, B]];
                            n.uiColor = B;
                            t([x], w, C);
                            t(o, q, C);
                        })(v);
                    }
                });
                n.on('menuShow', function (v) {
                    var w = v.data[0], x = w.element.getElementsByTag('iframe').getItem(0).getFrameDocument();
                    if (!x.getById('cke_ui_color')) {
                        var y = s(x);
                        o.push(y);
                        var z = n.getUiColor();
                        if (z)t([y], q, [[u, z]]);
                    }
                });
                if (n.config.uiColor)n.setUiColor(n.config.uiColor);
            }
        };
    })());
    (function () {
        a.dialog ? m() : a.on('dialogPluginReady', m);
        function m() {
            a.dialog.on('resize', function (n) {
                var o = n.data, p = o.width, q = o.height, r = o.dialog, s = r.parts.contents;
                if (o.skin != 'kama')return;
                s.setStyles({width: p + 'px', height: q + 'px'});
                setTimeout(function () {
                    var t = r.parts.dialog.getChild([0, 0, 0]), u = t.getChild(0), v = t.getChild(2);
                    v.setStyle('width', u.$.offsetWidth + 'px');
                    v = t.getChild(7);
                    v.setStyle('width', u.$.offsetWidth - 28 + 'px');
                    v = t.getChild(4);
                    v.setStyle('height', q + u.getChild(0).$.offsetHeight + 'px');
                    v = t.getChild(5);
                    v.setStyle('height', q + u.getChild(0).$.offsetHeight + 'px');
                }, 100);
            });
        };
    })();
    j.add('about', {
        requires: ['dialog'], init: function (m) {
            var n = m.addCommand('about', new a.dialogCommand('about'));
            n.modes = {wysiwyg: 1, source: 1};
            n.canUndo = false;
            m.ui.addButton('About', {label: m.lang.about.title, command: 'about'});
            a.dialog.add('about', this.path + 'dialogs/about.js');
        }
    });
    (function () {
        var m = 'a11yhelp', n = 'a11yHelp';
        j.add(m, {
            availableLangs: {en: 1, he: 1}, init: function (o) {
                var p = this;
                o.addCommand(n, {
                    exec: function () {
                        var q = o.langCode;
                        q = p.availableLangs[q] ? q : 'en';
                        a.scriptLoader.load(a.getUrl(p.path + 'lang/' + q + '.js'), function () {
                            e.extend(o.lang, p.lang[q]);
                            o.openDialog(n);
                        });
                    }, modes: {wysiwyg: 1, source: 1}, canUndo: false
                });
                a.dialog.add(n, this.path + 'dialogs/a11yhelp.js');
            }
        });
    })();
    j.add('basicstyles', {
        requires: ['styles', 'button'], init: function (m) {
            var n = function (q, r, s, t) {
                var u = new a.style(t);
                m.attachStyleStateChange(u, function (v) {
                    m.getCommand(s).setState(v);
                });
                m.addCommand(s, new a.styleCommand(u));
                m.ui.addButton(q, {label: r, command: s});
            }, o = m.config, p = m.lang;
            n('Bold', p.bold, 'bold', o.coreStyles_bold);
            n('Italic', p.italic, 'italic', o.coreStyles_italic);
            n('Underline', p.underline, 'underline', o.coreStyles_underline);
            n('Strike', p.strike, 'strike', o.coreStyles_strike);
            n('Subscript', p.subscript, 'subscript', o.coreStyles_subscript);
            n('Superscript', p.superscript, 'superscript', o.coreStyles_superscript);
        }
    });
    i.coreStyles_bold = {element: 'strong', overrides: 'b'};
    i.coreStyles_italic = {element: 'em', overrides: 'i'};
    i.coreStyles_underline = {element: 'u'};
    i.coreStyles_strike = {element: 'strike'};
    i.coreStyles_subscript = {element: 'sub'};
    i.coreStyles_superscript = {element: 'sup'};

    (function () {
        var m = {table: 1, tbody: 1, ul: 1, ol: 1, blockquote: 1, div: 1, tr: 1}, n = {}, o = {};
        e.extend(n, m, {tr: 1, p: 1, div: 1, li: 1});
        e.extend(o, n, {td: 1});
        function p(w) {
            q(w);
            r(w);
        };
        function q(w) {
            var x = w.editor, y = w.data.path, z = x.config.useComputedState, A;
            z = z === undefined || z;
            if (!z)A = s(y.lastElement);
            A = A || y.block || y.blockLimit;
            if (!A || A.getName() == 'body')return;
            var B = z ? A.getComputedStyle('direction') : A.getStyle('direction') || A.getAttribute('dir');
            x.getCommand('bidirtl').setState(B == 'rtl' ? 1 : 2);
            x.getCommand('bidiltr').setState(B == 'ltr' ? 1 : 2);
        };
        function r(w) {
            var x = w.editor, y = x.container.getChild(1), z = w.data.path.block || w.data.path.blockLimit;
            if (z && x.lang.dir != z.getComputedStyle('direction'))y.addClass('cke_mixed_dir_content'); else y.removeClass('cke_mixed_dir_content');
        };
        function s(w) {
            while (w && !(w.getName() in o || w.is('body'))) {
                var x = w.getParent();
                if (!x)break;
                w = x;
            }
            return w;
        };
        function t(w, x, y, z) {
            h.setMarker(z, w, 'bidi_processed', 1);
            var A = w;
            while ((A = A.getParent()) && !A.is('body')) {
                if (A.getCustomData('bidi_processed')) {
                    w.removeStyle('direction');
                    w.removeAttribute('dir');
                    return null;
                }
            }
            var B = 'useComputedState' in y.config ? y.config.useComputedState : 1, C = B ? w.getComputedStyle('direction') : w.getStyle('direction') || w.hasAttribute('dir');
            if (C == x)return null;
            var D = B ? C : w.getComputedStyle('direction');
            w.removeStyle('direction');
            if (B) {
                w.removeAttribute('dir');
                if (x != w.getComputedStyle('direction'))w.setAttribute('dir', x);
            } else w.setAttribute('dir', x);
            if (x != D)y.fire('dirChanged', {node: w, dir: x});
            y.forceNextSelectionCheck();
            return null;
        };
        function u(w, x) {
            var y = w.getCommonAncestor(false, true);
            w.enlarge(2);
            if (w.checkBoundaryOfElement(y, 1) && w.checkBoundaryOfElement(y, 2)) {
                var z;
                while (y && y.type == 1 && (z = y.getParent()) && z.getChildCount() == 1 && (!(y.getName() in x) || z.getName() in x))y = z;
                return y.type == 1 && y.getName() in x && y;
            }
        };
        function v(w) {
            return function (x) {
                var y = x.getSelection(), z = x.config.enterMode, A = y.getRanges();
                if (A && A.length) {
                    var B = {}, C = y.createBookmarks(), D = A.createIterator(), E, F = 0;
                    while (E = D.getNextRange(1)) {
                        var G = E.getEnclosedNode();
                        if (!G || G && !(G.type == 1 && G.getName() in n))G = u(E, m);
                        if (G && !G.isReadOnly())t(G, w, x, B);
                        var H, I, J = new d.walker(E), K = C[F].startNode, L = C[F++].endNode;
                        J.evaluator = function (M) {
                            return !!(M.type == 1 && M.getName() in m && !(M.getName() == (z == 1) ? 'p' : 'div' && M.getParent().type == 1 && M.getParent().getName() == 'blockquote') && M.getPosition(K) & 2 && (M.getPosition(L) & 4 + 16) == 4);
                        };
                        while (I = J.next())t(I, w, x, B);
                        H = E.createIterator();
                        H.enlargeBr = z != 2;
                        while (I = H.getNextParagraph(z == 1 ? 'p' : 'div'))!I.isReadOnly() && t(I, w, x, B);

                    }
                    h.clearAllMarkers(B);
                    x.forceNextSelectionCheck();
                    y.selectBookmarks(C);
                    x.focus();
                }
            };
        };
        j.add('bidi', {
            requires: ['styles', 'button'], init: function (w) {
                var x = function (z, A, B, C) {
                    w.addCommand(B, new a.command(w, {exec: C}));
                    w.ui.addButton(z, {label: A, command: B});
                }, y = w.lang.bidi;
                x('BidiLtr', y.ltr, 'bidiltr', v('ltr'));
                x('BidiRtl', y.rtl, 'bidirtl', v('rtl'));
                w.on('selectionChange', p);
            }
        });
    })();
    (function () {
        function m(q, r) {
            var s = r.block || r.blockLimit;
            if (!s || s.getName() == 'body')return 2;
            if (s.getAscendant('blockquote', true))return 1;
            return 2;
        };
        function n(q) {
            var r = q.editor, s = r.getCommand('blockquote');
            s.state = m(r, q.data.path);
            s.fire('state');
        };
        function o(q) {
            for (var r = 0, s = q.getChildCount(), t; r < s && (t = q.getChild(r)); r++) {
                if (t.type == 1 && t.isBlockBoundary())return false;
            }
            return true;
        };
        var p = {
            exec: function (q) {
                var r = q.getCommand('blockquote').state, s = q.getSelection(), t = s && s.getRanges(true)[0];
                if (!t)return;
                var u = s.createBookmarks();
                if (c) {
                    var v = u[0].startNode, w = u[0].endNode, x;
                    if (v && v.getParent().getName() == 'blockquote') {
                        x = v;
                        while (x = x.getNext()) {
                            if (x.type == 1 && x.isBlockBoundary()) {
                                v.move(x, true);
                                break;
                            }
                        }
                    }
                    if (w && w.getParent().getName() == 'blockquote') {
                        x = w;
                        while (x = x.getPrevious()) {
                            if (x.type == 1 && x.isBlockBoundary()) {
                                w.move(x);
                                break;
                            }
                        }
                    }
                }
                var y = t.createIterator(), z;
                if (r == 2) {
                    var A = [];
                    while (z = y.getNextParagraph())A.push(z);
                    if (A.length < 1) {
                        var B = q.document.createElement(q.config.enterMode == 1 ? 'p' : 'div'), C = u.shift();
                        t.insertNode(B);
                        B.append(new d.text('\ufeff', q.document));
                        t.moveToBookmark(C);
                        t.selectNodeContents(B);
                        t.collapse(true);
                        C = t.createBookmark();
                        A.push(B);
                        u.unshift(C);
                    }
                    var D = A[0].getParent(), E = [];
                    for (var F = 0; F < A.length; F++) {
                        z = A[F];
                        D = D.getCommonAncestor(z.getParent());
                    }
                    var G = {table: 1, tbody: 1, tr: 1, ol: 1, ul: 1};
                    while (G[D.getName()])D = D.getParent();
                    var H = null;
                    while (A.length > 0) {
                        z = A.shift();
                        while (!z.getParent().equals(D))z = z.getParent();
                        if (!z.equals(H))E.push(z);
                        H = z;
                    }
                    while (E.length > 0) {
                        z = E.shift();
                        if (z.getName() == 'blockquote') {
                            var I = new d.documentFragment(q.document);
                            while (z.getFirst()) {
                                I.append(z.getFirst().remove());
                                A.push(I.getLast());
                            }
                            I.replace(z);
                        } else A.push(z);
                    }
                    var J = q.document.createElement('blockquote');
                    J.insertBefore(A[0]);
                    while (A.length > 0) {
                        z = A.shift();
                        J.append(z);
                    }
                } else if (r == 1) {
                    var K = [], L = {};
                    while (z = y.getNextParagraph()) {
                        var M = null, N = null;
                        while (z.getParent()) {
                            if (z.getParent().getName() == 'blockquote') {
                                M = z.getParent();
                                N = z;
                                break;
                            }
                            z = z.getParent();
                        }
                        if (M && N && !N.getCustomData('blockquote_moveout')) {
                            K.push(N);
                            h.setMarker(L, N, 'blockquote_moveout', true);
                        }
                    }
                    h.clearAllMarkers(L);
                    var O = [], P = [];
                    L = {};
                    while (K.length > 0) {
                        var Q = K.shift();

                        J = Q.getParent();
                        if (!Q.getPrevious())Q.remove().insertBefore(J); else if (!Q.getNext())Q.remove().insertAfter(J); else {
                            Q.breakParent(Q.getParent());
                            P.push(Q.getNext());
                        }
                        if (!J.getCustomData('blockquote_processed')) {
                            P.push(J);
                            h.setMarker(L, J, 'blockquote_processed', true);
                        }
                        O.push(Q);
                    }
                    h.clearAllMarkers(L);
                    for (F = P.length - 1; F >= 0; F--) {
                        J = P[F];
                        if (o(J))J.remove();
                    }
                    if (q.config.enterMode == 2) {
                        var R = true;
                        while (O.length) {
                            Q = O.shift();
                            if (Q.getName() == 'div') {
                                I = new d.documentFragment(q.document);
                                var S = R && Q.getPrevious() && !(Q.getPrevious().type == 1 && Q.getPrevious().isBlockBoundary());
                                if (S)I.append(q.document.createElement('br'));
                                var T = Q.getNext() && !(Q.getNext().type == 1 && Q.getNext().isBlockBoundary());
                                while (Q.getFirst())Q.getFirst().remove().appendTo(I);
                                if (T)I.append(q.document.createElement('br'));
                                I.replace(Q);
                                R = false;
                            }
                        }
                    }
                }
                s.selectBookmarks(u);
                q.focus();
            }
        };
        j.add('blockquote', {
            init: function (q) {
                q.addCommand('blockquote', p);
                q.ui.addButton('Blockquote', {label: q.lang.blockquote, command: 'blockquote'});
                q.on('selectionChange', n);
            }, requires: ['domiterator']
        });
    })();
    j.add('button', {
        beforeInit: function (m) {
            m.ui.addHandler(1, k.button.handler);
        }
    });
    a.UI_BUTTON = 1;
    k.button = function (m) {
        e.extend(this, m, {
            title: m.label,
            className: m.className || m.command && 'cke_button_' + m.command || '',
            click: m.click || (function (n) {
                n.execCommand(m.command);
            })
        });
        this._ = {};
    };
    k.button.handler = {
        create: function (m) {
            return new k.button(m);
        }
    };
    k.button._ = {
        instances: [], keydown: function (m, n) {
            var o = k.button._.instances[m];
            if (o.onkey) {
                n = new d.event(n);
                return o.onkey(o, n.getKeystroke()) !== false;
            }
        }, focus: function (m, n) {
            var o = k.button._.instances[m], p;
            if (o.onfocus)p = o.onfocus(o, new d.event(n)) !== false;
            if (b.gecko && b.version < 10900)n.preventBubble();
            return p;
        }
    };
    (function () {
        var m = e.addFunction(k.button._.keydown, k.button._), n = e.addFunction(k.button._.focus, k.button._);
        k.button.prototype = {
            canGroup: true, render: function (o, p) {
                var q = b, r = this._.id = e.getNextId(), s = '', t = this.command, u, v;
                this._.editor = o;
                var w = {
                    id: r, button: this, editor: o, focus: function () {
                        var z = a.document.getById(r);
                        z.focus();
                    }, execute: function () {
                        this.button.click(o);
                    }
                };
                w.clickFn = u = e.addFunction(w.execute, w);
                w.index = v = k.button._.instances.push(w) - 1;
                if (this.modes) {
                    var x = {};
                    o.on('beforeModeUnload', function () {
                        x[o.mode] = this._.state;
                    }, this);
                    o.on('mode', function () {
                        var z = o.mode;
                        this.setState(this.modes[z] ? x[z] != undefined ? x[z] : 2 : 0);
                    }, this);
                } else if (t) {
                    t = o.getCommand(t);
                    if (t) {
                        t.on('state', function () {
                            this.setState(t.state);
                        }, this);
                        s += 'cke_' + (t.state == 1 ? 'on' : t.state == 0 ? 'disabled' : 'off');
                    }
                }
                if (!t)s += 'cke_off';

                if (this.className)s += ' ' + this.className;
                p.push('<span class="cke_button">', '<a id="', r, '" class="', s, '"', q.gecko && q.version >= 10900 && !q.hc ? '' : '" href="javascript:void(\'' + (this.title || '').replace("'", '') + "')\"", ' title="', this.title, '" tabindex="-1" hidefocus="true" role="button" aria-labelledby="' + r + '_label"' + (this.hasArrow ? ' aria-haspopup="true"' : ''));
                if (q.opera || q.gecko && q.mac)p.push(' onkeypress="return false;"');
                if (q.gecko)p.push(' onblur="this.style.cssText = this.style.cssText;"');
                p.push(' onkeydown="return CKEDITOR.tools.callFunction(', m, ', ', v, ', event);" onfocus="return CKEDITOR.tools.callFunction(', n, ', ', v, ', event);" onclick="CKEDITOR.tools.callFunction(', u, ', this); return false;"><span class="cke_icon"');
                if (this.icon) {
                    var y = (this.iconOffset || 0) * -16;
                    p.push(' style="background-image:url(', a.getUrl(this.icon), ');background-position:0 ' + y + 'px;"');
                }
                p.push('>&nbsp;</span><span id="', r, '_label" class="cke_label">', this.label, '</span>');
                if (this.hasArrow)p.push('<span class="cke_buttonarrow">' + (b.hc ? '&#9660;' : '&nbsp;') + '</span>');
                p.push('</a>', '</span>');
                if (this.onRender)this.onRender();
                return w;
            }, setState: function (o) {
                if (this._.state == o)return false;
                this._.state = o;
                var p = a.document.getById(this._.id);
                if (p) {
                    p.setState(o);
                    o == 0 ? p.setAttribute('aria-disabled', true) : p.removeAttribute('aria-disabled');
                    o == 1 ? p.setAttribute('aria-pressed', true) : p.removeAttribute('aria-pressed');
                    return true;
                } else return false;
            }
        };
    })();
    k.prototype.addButton = function (m, n) {
        this.add(m, 1, n);
    };
    a.on('reset', function () {
        k.button._.instances = [];
    });
    (function () {
        var m = function (t, u) {
            var v = t.document, w = v.getBody(), x = 0, y = function () {
                x = 1;
            };
            w.on(u, y);
            (b.version > 7 ? v.$ : v.$.selection.createRange()).execCommand(u);
            w.removeListener(u, y);
            return x;
        }, n = c ? function (t, u) {
            return m(t, u);
        } : function (t, u) {
            try {
                return t.document.$.execCommand(u, false, null);
            } catch (v) {
                return false;
            }
        }, o = function (t) {
            this.type = t;
            this.canUndo = this.type == 'cut';
        };
        o.prototype = {
            exec: function (t, u) {
                this.type == 'cut' && s(t);
                var v = n(t, this.type);
                if (!v)alert(t.lang.clipboard[this.type + 'Error']);
                return v;
            }
        };
        var p = {
            canUndo: false, exec: c ? function (t) {
                t.focus();
                if (!t.document.getBody().fire('beforepaste') && !m(t, 'paste')) {
                    t.fire('pasteDialog');
                    return false;
                }
            } : function (t) {
                try {
                    if (!t.document.getBody().fire('beforepaste') && !t.document.$.execCommand('Paste', false, null))throw 0;
                } catch (u) {
                    setTimeout(function () {
                        t.fire('pasteDialog');
                    }, 0);
                    return false;
                }
            }
        }, q = function (t) {
            if (this.mode != 'wysiwyg')return;
            switch (t.data.keyCode) {
                case 1000 + 86:
                case 2000 + 45:
                    var u = this.document.getBody();

                    if (!c && u.fire('beforepaste'))t.cancel(); else if (b.opera || b.gecko && b.version < 10900)u.fire('paste');
                    return;
                case 1000 + 88:
                case 2000 + 46:
                    var v = this;
                    this.fire('saveSnapshot');
                    setTimeout(function () {
                        v.fire('saveSnapshot');
                    }, 0);
            }
        };

        function r(t, u, v) {
            var w = this.document;
            if (w.getById('cke_pastebin'))return;
            if (u == 'text' && t.data && t.data.$.clipboardData) {
                var x = t.data.$.clipboardData.getData('text/plain');
                if (x) {
                    t.data.preventDefault();
                    v(x);
                    return;
                }
            }
            var y = this.getSelection(), z = new d.range(w), A = new h(u == 'text' ? 'textarea' : b.webkit ? 'body' : 'div', w);
            A.setAttribute('id', 'cke_pastebin');
            b.webkit && A.append(w.createText('\xa0'));
            w.getBody().append(A);
            A.setStyles({
                position: 'absolute',
                top: y.getStartElement().getDocumentPosition().y + 'px',
                width: '1px',
                height: '1px',
                overflow: 'hidden'
            });
            A.setStyle(this.config.contentsLangDirection == 'ltr' ? 'left' : 'right', '-1000px');
            var B = y.createBookmarks();
            if (u == 'text') {
                if (c) {
                    var C = w.getBody().$.createTextRange();
                    C.moveToElementText(A.$);
                    C.execCommand('Paste');
                    t.data.preventDefault();
                } else {
                    w.$.designMode = 'off';
                    A.$.focus();
                }
            } else {
                z.setStartAt(A, 1);
                z.setEndAt(A, 2);
                z.select(true);
            }
            window.setTimeout(function () {
                u == 'text' && !c && (w.$.designMode = 'on');
                A.remove();
                var D;
                A = b.webkit && (D = A.getFirst()) && D.is && D.hasClass('Apple-style-span') ? D : A;
                y.selectBookmarks(B);
                v(A['get' + (u == 'text' ? 'Value' : 'Html')]());
            }, 0);
        };
        function s(t) {
            if (!c || b.quirks)return;
            var u = t.getSelection(), v;
            if (u.getType() == 3 && (v = u.getSelectedElement())) {
                var w = u.getRanges()[0], x = t.document.createText('');
                x.insertBefore(v);
                w.setStartBefore(x);
                w.setEndAfter(v);
                u.selectRanges([w]);
                setTimeout(function () {
                    if (v.getParent()) {
                        x.remove();
                        u.selectElement(v);
                    }
                }, 0);
            }
        };
        j.add('clipboard', {
            requires: ['dialog', 'htmldataprocessor'], init: function (t) {
                t.on('paste', function (y) {
                    var z = y.data;
                    if (z.html)t.insertHtml(z.html); else if (z.text)t.insertText(z.text);
                }, null, null, 1000);
                t.on('pasteDialog', function (y) {
                    setTimeout(function () {
                        t.openDialog('paste');
                    }, 0);
                });
                function u(y, z, A, B) {
                    var C = t.lang[z];
                    t.addCommand(z, A);
                    t.ui.addButton(y, {label: C, command: z});
                    if (t.addMenuItems)t.addMenuItem(z, {label: C, command: z, group: 'clipboard', order: B});
                };
                u('Cut', 'cut', new o('cut'), 1);
                u('Copy', 'copy', new o('copy'), 4);
                u('Paste', 'paste', p, 8);
                a.dialog.add('paste', a.getUrl(this.path + 'dialogs/paste.js'));
                t.on('key', q, t);
                var v = t.config.forcePasteAsPlainText ? 'text' : 'html';
                t.on('contentDom', function () {
                    var y = t.document.getBody();
                    y.on(v == 'text' && c || b.webkit ? 'paste' : 'beforepaste', function (z) {
                        if (w)return;
                        r.call(t, z, v, function (A) {
                            if (!A)return;
                            var B = {};
                            B[v] = A;
                            t.fire('paste', B);

                        });
                    });
                    y.on('beforecut', function () {
                        !w && s(t);
                    });
                });
                if (t.contextMenu) {
                    var w;

                    function x(y) {
                        c && (w = 1);
                        var z = t.document.$.queryCommandEnabled(y) ? 2 : 0;
                        w = 0;
                        return z;
                    };
                    t.contextMenu.addListener(function (y, z) {
                        var A = z.getCommonAncestor().isReadOnly();
                        return {cut: !A && x('Cut'), copy: x('Copy'), paste: !A && (b.webkit ? 2 : x('Paste'))};
                    });
                }
            }
        });
    })();
    j.add('colorbutton', {
        requires: ['panelbutton', 'floatpanel', 'styles'], init: function (m) {
            var n = m.config, o = m.lang.colorButton, p;
            if (!b.hc) {
                q('TextColor', 'fore', o.textColorTitle);
                q('BGColor', 'back', o.bgColorTitle);
            }
            function q(t, u, v) {
                var w = e.getNextId() + '_colorBox';
                m.ui.add(t, 4, {
                    label: v,
                    title: v,
                    className: 'cke_button_' + t.toLowerCase(),
                    modes: {wysiwyg: 1},
                    panel: {css: m.skin.editor.css, attributes: {role: 'listbox', 'aria-label': o.panelTitle}},
                    onBlock: function (x, y) {
                        y.autoSize = true;
                        y.element.addClass('cke_colorblock');
                        y.element.setHtml(r(x, u, w));
                        y.element.getDocument().getBody().setStyle('overflow', 'hidden');
                        k.fire('ready', this);
                        var z = y.keys, A = m.lang.dir == 'rtl';
                        z[A ? 37 : 39] = 'next';
                        z[40] = 'next';
                        z[9] = 'next';
                        z[A ? 39 : 37] = 'prev';
                        z[38] = 'prev';
                        z[2000 + 9] = 'prev';
                        z[32] = 'click';
                    },
                    onOpen: function () {
                        var x = m.getSelection(), y = x && x.getStartElement(), z = new d.elementPath(y), A;
                        y = z.block || z.blockLimit;
                        do A = y && y.getComputedStyle(u == 'back' ? 'background-color' : 'color') || 'transparent'; while (u == 'back' && A == 'transparent' && (y = y.getParent()))
                        if (!A || A == 'transparent')A = '#ffffff';
                        this._.panel._.iframe.getFrameDocument().getById(w).setStyle('background-color', A);
                    }
                });
            };
            function r(t, u, v) {
                var w = [], x = n.colorButton_colors.split(','), y = x.length + (n.colorButton_enableMore ? 2 : 1), z = e.addFunction(function (F, G) {
                    if (F == '?') {
                        var H = arguments.callee;

                        function I(K) {
                            this.removeListener('ok', I);
                            this.removeListener('cancel', I);
                            K.name == 'ok' && H(this.getContentElement('picker', 'selectedColor').getValue(), G);
                        };
                        m.openDialog('colordialog', function () {
                            this.on('ok', I);
                            this.on('cancel', I);
                        });
                        return;
                    }
                    m.focus();
                    t.hide();
                    m.fire('saveSnapshot');
                    new a.style(n['colorButton_' + G + 'Style'], {color: 'inherit'}).remove(m.document);
                    if (F) {
                        var J = n['colorButton_' + G + 'Style'];
                        J.childRule = G == 'back' ? function (K) {
                            return s(K);
                        } : function (K) {
                            return K.getName() != 'a' || s(K);
                        };
                        new a.style(J, {color: F}).apply(m.document);
                    }
                    m.fire('saveSnapshot');
                });
                w.push('<a class="cke_colorauto" _cke_focus=1 hidefocus=true title="', o.auto, '" onclick="CKEDITOR.tools.callFunction(', z, ",null,'", u, "');return false;\" href=\"javascript:void('", o.auto, '\')" role="option" aria-posinset="1" aria-setsize="', y, '"><table role="presentation" cellspacing=0 cellpadding=0 width="100%"><tr><td><span class="cke_colorbox" id="', v, '"></span></td><td colspan=7 align=center>', o.auto, '</td></tr></table></a><table role="presentation" cellspacing=0 cellpadding=0 width="100%">');

                for (var A = 0; A < x.length; A++) {
                    if (A % 8 === 0)w.push('</tr><tr>');
                    var B = x[A].split('/'), C = B[0], D = B[1] || C;
                    if (!B[1])C = '#' + C.replace(/^(.)(.)(.)$/, '$1$1$2$2$3$3');
                    var E = m.lang.colors[D] || D;
                    w.push('<td><a class="cke_colorbox" _cke_focus=1 hidefocus=true title="', E, '" onclick="CKEDITOR.tools.callFunction(', z, ",'", C, "','", u, "'); return false;\" href=\"javascript:void('", E, '\')" role="option" aria-posinset="', A + 2, '" aria-setsize="', y, '"><span class="cke_colorbox" style="background-color:#', D, '"></span></a></td>');
                }
                if (n.colorButton_enableMore === undefined || n.colorButton_enableMore)w.push('</tr><tr><td colspan=8 align=center><a class="cke_colormore" _cke_focus=1 hidefocus=true title="', o.more, '" onclick="CKEDITOR.tools.callFunction(', z, ",'?','", u, "');return false;\" href=\"javascript:void('", o.more, "')\"", ' role="option" aria-posinset="', y, '" aria-setsize="', y, '">', o.more, '</a></td>');
                w.push('</tr></table>');
                return w.join('');
            };
            function s(t) {
                return t.getAttribute('contentEditable') == 'false' || t.getAttribute('data-cke-nostyle');
            };
        }
    });
    i.colorButton_colors = '000,800000,8B4513,2F4F4F,008080,000080,4B0082,696969,B22222,A52A2A,DAA520,006400,40E0D0,0000CD,800080,808080,F00,FF8C00,FFD700,008000,0FF,00F,EE82EE,A9A9A9,FFA07A,FFA500,FFFF00,00FF00,AFEEEE,ADD8E6,DDA0DD,D3D3D3,FFF0F5,FAEBD7,FFFFE0,F0FFF0,F0FFFF,F0F8FF,E6E6FA,FFF';
    i.colorButton_foreStyle = {
        element: 'span',
        styles: {color: '#(color)'},
        overrides: [{element: 'font', attributes: {color: null}}]
    };
    i.colorButton_backStyle = {element: 'span', styles: {'background-color': '#(color)'}};
    (function () {
        j.colordialog = {
            init: function (m) {
                m.addCommand('colordialog', new a.dialogCommand('colordialog'));
                a.dialog.add('colordialog', this.path + 'dialogs/colordialog.js');
            }
        };
        j.add('colordialog', j.colordialog);
    })();
    j.add('contextmenu', {
        requires: ['menu'], onLoad: function () {
            j.contextMenu = e.createClass({
                base: a.menu, $: function (m) {
                    this.base.call(this, m, {
                        panel: {
                            className: m.skinClass + ' cke_contextmenu',
                            attributes: {'aria-label': m.lang.contextmenu.options}
                        }
                    });
                }, proto: {
                    addTarget: function (m, n) {
                        if (b.opera && !('oncontextmenu' in document.body)) {
                            var o;
                            m.on('mousedown', function (s) {
                                s = s.data;
                                if (s.$.button != 2) {
                                    if (s.getKeystroke() == 1000 + 1)m.fire('contextmenu', s);
                                    return;
                                }
                                if (n && (b.mac ? s.$.metaKey : s.$.ctrlKey))return;
                                var t = s.getTarget();
                                if (!o) {
                                    var u = t.getDocument();
                                    o = u.createElement('input');
                                    o.$.type = 'button';
                                    u.getBody().append(o);
                                }
                                o.setAttribute('style', 'position:absolute;top:' + (s.$.clientY - 2) + 'px;left:' + (s.$.clientX - 2) + 'px;width:5px;height:5px;opacity:0.01');
                            });
                            m.on('mouseup', function (s) {
                                if (o) {
                                    o.remove();

                                    o = undefined;
                                    m.fire('contextmenu', s.data);
                                }
                            });
                        }
                        m.on('contextmenu', function (s) {
                            var t = s.data;
                            if (n && (b.webkit ? p : b.mac ? t.$.metaKey : t.$.ctrlKey))return;
                            t.preventDefault();
                            var u = t.getTarget().getDocument().getDocumentElement(), v = t.$.clientX, w = t.$.clientY;
                            e.setTimeout(function () {
                                this.open(u, null, v, w);
                            }, 0, this);
                        }, this);
                        if (b.opera)m.on('keypress', function (s) {
                            var t = s.data;
                            if (t.$.keyCode === 0)t.preventDefault();
                        });
                        if (b.webkit) {
                            var p, q = function (s) {
                                p = b.mac ? s.data.$.metaKey : s.data.$.ctrlKey;
                            }, r = function () {
                                p = 0;
                            };
                            m.on('keydown', q);
                            m.on('keyup', r);
                            m.on('contextmenu', r);
                        }
                    }, open: function (m, n, o, p) {
                        this.editor.focus();
                        m = m || a.document.getDocumentElement();
                        this.show(m, n, o, p);
                    }
                }
            });
        }, beforeInit: function (m) {
            m.contextMenu = new j.contextMenu(m);
            m.addCommand('contextMenu', {
                exec: function () {
                    m.contextMenu.open(m.document.getBody());
                }
            });
        }
    });
    (function () {
        function m(o) {
            var p = this.att, q = o && o.hasAttribute(p) && o.getAttribute(p) || '';
            if (q !== undefined)this.setValue(q);
        };
        function n() {
            var o;
            for (var p = 0; p < arguments.length; p++) {
                if (arguments[p] instanceof h) {
                    o = arguments[p];
                    break;
                }
            }
            if (o) {
                var q = this.att, r = this.getValue();
                if (q == 'dir') {
                    var s = o.getAttribute(q);
                    if (s != r && o.getParent())this._.dialog._.editor.fire('dirChanged', {
                        node: o,
                        dir: r || o.getDirection(1)
                    });
                }
                if (r)o.setAttribute(q, r); else o.removeAttribute(q, r);
            }
        };
        j.add('dialogadvtab', {
            createAdvancedTab: function (o, p) {
                if (!p)p = {id: 1, dir: 1, classes: 1, styles: 1};
                var q = o.lang.common, r = {
                    id: 'advanced',
                    label: q.advancedTab,
                    title: q.advancedTab,
                    elements: [{type: 'vbox', padding: 1, children: []}]
                }, s = [];
                if (p.id || p.dir) {
                    if (p.id)s.push({id: 'advId', att: 'id', type: 'text', label: q.id, setup: m, commit: n});
                    if (p.dir)s.push({
                        id: 'advLangDir',
                        att: 'dir',
                        type: 'select',
                        label: q.langDir,
                        'default': '',
                        style: 'width:100%',
                        items: [[q.notSet, ''], [q.langDirLTR, 'ltr'], [q.langDirRTL, 'rtl']],
                        setup: m,
                        commit: n
                    });
                    r.elements[0].children.push({type: 'hbox', widths: ['50%', '50%'], children: [].concat(s)});
                }
                if (p.styles || p.classes) {
                    s = [];
                    if (p.styles)s.push({
                        id: 'advStyles',
                        att: 'style',
                        type: 'text',
                        label: q.styles,
                        'default': '',
                        getStyle: function (t, u) {
                            var v = this.getValue().match(new RegExp(t + '\\s*:s*([^;]*)', 'i'));
                            return v ? v[1] : u;
                        },
                        updateStyle: function (t, u) {
                            var v = this.getValue();
                            if (v)v = v.replace(new RegExp('\\s*' + t + 's*:[^;]*(?:$|;s*)', 'i'), '').replace(/^[;\s]+/, '').replace(/\s+$/, '');
                            if (u) {
                                v && !/;\s*$/.test(v) && (v += '; ');
                                v += t + ': ' + u;
                            }
                            this.setValue(v, 1);
                        },
                        setup: m,
                        commit: n
                    });
                    if (p.classes)s.push({
                        type: 'hbox',
                        widths: ['45%', '55%'],
                        children: [{
                            id: 'advCSSClasses',
                            att: 'class',
                            type: 'text',
                            label: q.cssClasses,
                            'default': '',
                            setup: m,
                            commit: n
                        }]
                    });
                    r.elements[0].children.push({type: 'hbox', widths: ['50%', '50%'], children: [].concat(s)});

                }
                return r;
            }
        });
    })();
    (function () {
        j.add('div', {
            requires: ['editingblock', 'domiterator', 'styles'], init: function (m) {
                var n = m.lang.div;
                m.addCommand('creatediv', new a.dialogCommand('creatediv'));
                m.addCommand('editdiv', new a.dialogCommand('editdiv'));
                m.addCommand('removediv', {
                    exec: function (o) {
                        var p = o.getSelection(), q = p && p.getRanges(), r, s = p.createBookmarks(), t, u = [];

                        function v(x) {
                            var y = new d.elementPath(x), z = y.blockLimit, A = z.is('div') && z;
                            if (A && !A.data('cke-div-added')) {
                                u.push(A);
                                A.data('cke-div-added');
                            }
                        };
                        for (var w = 0; w < q.length; w++) {
                            r = q[w];
                            if (r.collapsed)v(p.getStartElement()); else {
                                t = new d.walker(r);
                                t.evaluator = v;
                                t.lastForward();
                            }
                        }
                        for (w = 0; w < u.length; w++)u[w].remove(true);
                        p.selectBookmarks(s);
                    }
                });
                m.ui.addButton('CreateDiv', {label: n.toolbar, command: 'creatediv'});
                if (m.addMenuItems) {
                    m.addMenuItems({
                        editdiv: {label: n.edit, command: 'editdiv', group: 'div', order: 1},
                        removediv: {label: n.remove, command: 'removediv', group: 'div', order: 5}
                    });
                    if (m.contextMenu)m.contextMenu.addListener(function (o, p) {
                        if (!o || o.isReadOnly())return null;
                        var q = new d.elementPath(o), r = q.blockLimit;
                        if (r && r.getAscendant('div', true))return {editdiv: 2, removediv: 2};
                        return null;
                    });
                }
                a.dialog.add('creatediv', this.path + 'dialogs/div.js');
                a.dialog.add('editdiv', this.path + 'dialogs/div.js');
            }
        });
    })();
    (function () {
        var m = {
            toolbarFocus: {
                exec: function (o) {
                    var p = o._.elementsPath.idBase, q = a.document.getById(p + '0');
                    q && q.focus(c || b.air);
                }
            }
        }, n = '<span class="cke_empty">&nbsp;</span>';
        j.add('elementspath', {
            requires: ['selection'], init: function (o) {
                var p = 'cke_path_' + o.name, q, r = function () {
                    if (!q)q = a.document.getById(p);
                    return q;
                }, s = 'cke_elementspath_' + e.getNextNumber() + '_';
                o._.elementsPath = {idBase: s, filters: []};
                o.on('themeSpace', function (w) {
                    if (w.data.space == 'bottom')w.data.html += '<span id="' + p + '_label" class="cke_voice_label">' + o.lang.elementsPath.eleLabel + '</span>' + '<div id="' + p + '" class="cke_path" role="group" aria-labelledby="' + p + '_label">' + n + '</div>';
                });
                function t(w) {
                    o.focus();
                    var x = o._.elementsPath.list[w];
                    if (x.is('body')) {
                        var y = new d.range(o.document);
                        y.selectNodeContents(x);
                        y.select();
                    } else o.getSelection().selectElement(x);
                };
                var u = e.addFunction(t), v = e.addFunction(function (w, x) {
                    var y = o._.elementsPath.idBase, z;
                    x = new d.event(x);
                    var A = o.lang.dir == 'rtl';
                    switch (x.getKeystroke()) {
                        case A ? 39 : 37:
                        case 9:
                            z = a.document.getById(y + (w + 1));
                            if (!z)z = a.document.getById(y + '0');
                            z.focus();
                            return false;
                        case A ? 37 : 39:
                        case 2000 + 9:
                            z = a.document.getById(y + (w - 1));
                            if (!z)z = a.document.getById(y + (o._.elementsPath.list.length - 1));
                            z.focus();
                            return false;
                        case 27:
                            o.focus();
                            return false;

                        case 13:
                        case 32:
                            t(w);
                            return false;
                    }
                    return true;
                });
                o.on('selectionChange', function (w) {
                    var x = b, y = w.data.selection, z = y.getStartElement(), A = [], B = w.editor, C = B._.elementsPath.list = [], D = B._.elementsPath.filters;
                    while (z) {
                        var E = 0;
                        for (var F = 0; F < D.length; F++) {
                            if (D[F](z) === false) {
                                E = 1;
                                break;
                            }
                        }
                        if (!E) {
                            var G = C.push(z) - 1, H;
                            if (z.data('cke-real-element-type'))H = z.data('cke-real-element-type'); else H = z.getName();
                            var I = '';
                            if (x.opera || x.gecko && x.mac)I += ' onkeypress="return false;"';
                            if (x.gecko)I += ' onblur="this.style.cssText = this.style.cssText;"';
                            var J = B.lang.elementsPath.eleTitle.replace(/%1/, H);
                            A.unshift('<a id="', s, G, '" href="javascript:void(\'', H, '\')" tabindex="-1" title="', J, '"' + (b.gecko && b.version < 10900 ? ' onfocus="event.preventBubble();"' : '') + ' hidefocus="true" ' + ' onkeydown="return CKEDITOR.tools.callFunction(', v, ',', G, ', event );"' + I, ' onclick="CKEDITOR.tools.callFunction(' + u, ',', G, '); return false;"', ' role="button" aria-labelledby="' + s + G + '_label">', H, '<span id="', s, G, '_label" class="cke_label">' + J + '</span>', '</a>');
                        }
                        if (H == 'body')break;
                        z = z.getParent();
                    }
                    var K = r();
                    K.setHtml(A.join('') + n);
                    B.fire('elementsPathUpdate', {space: K});
                });
                o.on('contentDomUnload', function () {
                    q && q.setHtml(n);
                });
                o.addCommand('elementsPathFocus', m.toolbarFocus);
            }
        });
    })();
    (function () {
        j.add('enterkey', {
            requires: ['keystrokes', 'indent'], init: function (t) {
                var u = t.specialKeys;
                u[13] = r;
                u[2000 + 13] = q;
            }
        });
        j.enterkey = {
            enterBlock: function (t, u, v, w) {
                v = v || s(t);
                if (!v)return;
                var x = v.document;
                if (v.checkStartOfBlock() && v.checkEndOfBlock()) {
                    var y = new d.elementPath(v.startContainer), z = y.block;
                    if (z && (z.is('li') || z.getParent().is('li'))) {
                        t.execCommand('outdent');
                        return;
                    }
                }
                var A = u == 3 ? 'div' : 'p', B = v.splitBlock(A);
                if (!B)return;
                var C = B.previousBlock, D = B.nextBlock, E = B.wasStartOfBlock, F = B.wasEndOfBlock, G;
                if (D) {
                    G = D.getParent();
                    if (G.is('li')) {
                        D.breakParent(G);
                        D.move(D.getNext(), 1);
                    }
                } else if (C && (G = C.getParent()) && G.is('li')) {
                    C.breakParent(G);
                    v.moveToElementEditStart(C.getNext());
                    C.move(C.getPrevious());
                }
                if (!E && !F) {
                    if (D.is('li') && (G = D.getFirst(d.walker.invisible(true))) && G.is && G.is('ul', 'ol'))(c ? x.createText('\xa0') : x.createElement('br')).insertBefore(G);
                    if (D)v.moveToElementEditStart(D);
                } else {
                    var H, I;
                    if (C) {
                        if (C.is('li') || !p.test(C.getName()))H = C.clone();
                    } else if (D)H = D.clone();
                    if (!H) {
                        H = x.createElement(A);
                        if (C && (I = C.getDirection()))H.setAttribute('dir', I);
                    } else if (w && !H.is('li'))H.renameNode(A);
                    var J = B.elementPath;
                    if (J)for (var K = 0, L = J.elements.length; K < L; K++) {
                        var M = J.elements[K];
                        if (M.equals(J.block) || M.equals(J.blockLimit))break;
                        if (f.$removeEmpty[M.getName()]) {
                            M = M.clone();

                            H.moveChildren(M);
                            H.append(M);
                        }
                    }
                    if (!c)H.appendBogus();
                    v.insertNode(H);
                    if (c && E && (!F || !C.getChildCount())) {
                        v.moveToElementEditStart(F ? C : H);
                        v.select();
                    }
                    v.moveToElementEditStart(E && !F ? D : H);
                }
                if (!c)if (D) {
                    var N = x.createElement('span');
                    N.setHtml('&nbsp;');
                    v.insertNode(N);
                    N.scrollIntoView();
                    v.deleteContents();
                } else H.scrollIntoView();
                v.select();
            }, enterBr: function (t, u, v, w) {
                v = v || s(t);
                if (!v)return;
                var x = v.document, y = u == 3 ? 'div' : 'p', z = v.checkEndOfBlock(), A = new d.elementPath(t.getSelection().getStartElement()), B = A.block, C = B && A.block.getName(), D = false;
                if (!w && C == 'li') {
                    o(t, u, v, w);
                    return;
                }
                if (!w && z && p.test(C)) {
                    var E, F;
                    if (F = B.getDirection()) {
                        E = x.createElement('div');
                        E.setAttribute('dir', F);
                        E.insertAfter(B);
                        v.setStart(E, 0);
                    } else {
                        x.createElement('br').insertAfter(B);
                        if (b.gecko)x.createText('').insertAfter(B);
                        v.setStartAt(B.getNext(), c ? 3 : 1);
                    }
                } else {
                    var G;
                    D = C == 'pre';
                    if (D && !b.gecko)G = x.createText(c ? '\r' : '\n'); else G = x.createElement('br');
                    v.deleteContents();
                    v.insertNode(G);
                    if (!c)x.createText('\ufeff').insertAfter(G);
                    if (z && !c)G.getParent().appendBogus();
                    if (!c)G.getNext().$.nodeValue = '';
                    if (c)v.setStartAt(G, 4); else v.setStartAt(G.getNext(), 1);
                    if (!c) {
                        var H = null;
                        if (!b.gecko) {
                            H = x.createElement('span');
                            H.setHtml('&nbsp;');
                        } else H = x.createElement('br');
                        H.insertBefore(G.getNext());
                        H.scrollIntoView();
                        H.remove();
                    }
                }
                v.collapse(true);
                v.select(D);
            }
        };
        var m = j.enterkey, n = m.enterBr, o = m.enterBlock, p = /^h[1-6]$/;

        function q(t) {
            if (t.mode != 'wysiwyg')return false;
            if (t.getSelection().getStartElement().hasAscendant('pre', true)) {
                setTimeout(function () {
                    o(t, t.config.enterMode, null, true);
                }, 0);
                return true;
            } else return r(t, t.config.shiftEnterMode, 1);
        };
        function r(t, u, v) {
            v = t.config.forceEnterMode || v;
            if (t.mode != 'wysiwyg')return false;
            if (!u)u = t.config.enterMode;
            setTimeout(function () {
                t.fire('saveSnapshot');
                if (u == 2 || t.getSelection().getStartElement().hasAscendant('pre', 1))n(t, u, null, v); else o(t, u, null, v);
            }, 0);
            return true;
        };
        function s(t) {
            var u = t.getSelection().getRanges(true);
            for (var v = u.length - 1; v > 0; v--)u[v].deleteContents();
            return u[0];
        };
    })();
    (function () {
        var m = 'nbsp,gt,lt,quot', n = 'iexcl,cent,pound,curren,yen,brvbar,sect,uml,copy,ordf,laquo,not,shy,reg,macr,deg,plusmn,sup2,sup3,acute,micro,para,middot,cedil,sup1,ordm,raquo,frac14,frac12,frac34,iquest,times,divide,fnof,bull,hellip,prime,Prime,oline,frasl,weierp,image,real,trade,alefsym,larr,uarr,rarr,darr,harr,crarr,lArr,uArr,rArr,dArr,hArr,forall,part,exist,empty,nabla,isin,notin,ni,prod,sum,minus,lowast,radic,prop,infin,ang,and,or,cap,cup,int,there4,sim,cong,asymp,ne,equiv,le,ge,sub,sup,nsub,sube,supe,oplus,otimes,perp,sdot,lceil,rceil,lfloor,rfloor,lang,rang,loz,spades,clubs,hearts,diams,circ,tilde,ensp,emsp,thinsp,zwnj,zwj,lrm,rlm,ndash,mdash,lsquo,rsquo,sbquo,ldquo,rdquo,bdquo,dagger,Dagger,permil,lsaquo,rsaquo,euro', o = 'Agrave,Aacute,Acirc,Atilde,Auml,Aring,AElig,Ccedil,Egrave,Eacute,Ecirc,Euml,Igrave,Iacute,Icirc,Iuml,ETH,Ntilde,Ograve,Oacute,Ocirc,Otilde,Ouml,Oslash,Ugrave,Uacute,Ucirc,Uuml,Yacute,THORN,szlig,agrave,aacute,acirc,atilde,auml,aring,aelig,ccedil,egrave,eacute,ecirc,euml,igrave,iacute,icirc,iuml,eth,ntilde,ograve,oacute,ocirc,otilde,ouml,oslash,ugrave,uacute,ucirc,uuml,yacute,thorn,yuml,OElig,oelig,Scaron,scaron,Yuml', p = 'Alpha,Beta,Gamma,Delta,Epsilon,Zeta,Eta,Theta,Iota,Kappa,Lambda,Mu,Nu,Xi,Omicron,Pi,Rho,Sigma,Tau,Upsilon,Phi,Chi,Psi,Omega,alpha,beta,gamma,delta,epsilon,zeta,eta,theta,iota,kappa,lambda,mu,nu,xi,omicron,pi,rho,sigmaf,sigma,tau,upsilon,phi,chi,psi,omega,thetasym,upsih,piv';

        function q(r, s) {
            var t = {}, u = [], v = {nbsp: '\xa0', shy: '­', gt: '>', lt: '<'};
            r = r.replace(/\b(nbsp|shy|gt|lt|amp)(?:,|$)/g, function (A, B) {
                var C = s ? '&' + B + ';' : v[B], D = s ? v[B] : '&' + B + ';';
                t[C] = D;
                u.push(C);
                return '';
            });
            if (!s) {
                r = r.split(',');
                var w = document.createElement('div'), x;
                w.innerHTML = '&' + r.join(';&') + ';';
                x = w.innerHTML;
                w = null;
                for (var y = 0; y < x.length; y++) {
                    var z = x.charAt(y);
                    t[z] = '&' + r[y] + ';';
                    u.push(z);
                }
            }
            t.regex = u.join(s ? '|' : '');
            return t;
        };
        j.add('entities', {
            afterInit: function (r) {
                var s = r.config, t = r.dataProcessor, u = t && t.htmlFilter;
                if (u) {
                    var v = m;
                    if (s.entities) {
                        v += ',' + n;
                        if (s.entities_latin)v += ',' + o;
                        if (s.entities_greek)v += ',' + p;
                        if (s.entities_additional)v += ',' + s.entities_additional;
                    }
                    var w = q(v), x = '[' + w.regex + ']';
                    delete w.regex;
                    if (s.entities && s.entities_processNumerical)x = '[^ -~]|' + x;
                    x = new RegExp(x, 'g');
                    function y(C) {
                        return s.entities_processNumerical == 'force' || !w[C] ? '&#' + C.charCodeAt(0) + ';' : w[C];
                    };
                    var z = q([m, 'shy'].join(','), true), A = new RegExp(z.regex, 'g');

                    function B(C) {
                        return z[C];
                    };
                    u.addRules({
                        text: function (C) {
                            return C.replace(A, B).replace(x, y);
                        }
                    });
                }
            }
        });
    })();
    i.entities = true;
    i.entities_latin = true;
    i.entities_greek = true;
    i.entities_additional = '#39';
    (function () {
        function m(v, w) {
            var x = [];
            if (!w)return v; else for (var y in w)x.push(y + '=' + encodeURIComponent(w[y]));
            return v + (v.indexOf('?') != -1 ? '&' : '?') + x.join('&');
        };
        function n(v) {
            v += '';
            var w = v.charAt(0).toUpperCase();
            return w + v.substr(1);
        };
        function o(v) {
            var C = this;
            var w = C.getDialog(), x = w.getParentEditor();
            x._.filebrowserSe = C;
            var y = x.config['filebrowser' + n(w.getName()) + 'WindowWidth'] || x.config.filebrowserWindowWidth || '80%', z = x.config['filebrowser' + n(w.getName()) + 'WindowHeight'] || x.config.filebrowserWindowHeight || '70%', A = C.filebrowser.params || {};
            A.CKEditor = x.name;
            A.CKEditorFuncNum = x._.filebrowserFn;
            if (!A.langCode)A.langCode = x.langCode;
            var B = m(C.filebrowser.url, A);
            x.popup(B, y, z, x.config.fileBrowserWindowFeatures);
        };
        function p(v) {
            var y = this;
            var w = y.getDialog(), x = w.getParentEditor();
            x._.filebrowserSe = y;
            if (!w.getContentElement(y['for'][0], y['for'][1]).getInputElement().$.value)return false;
            if (!w.getContentElement(y['for'][0], y['for'][1]).getAction())return false;
            return true;
        };
        function q(v, w, x) {
            var y = x.params || {};
            y.CKEditor = v.name;
            y.CKEditorFuncNum = v._.filebrowserFn;
            if (!y.langCode)y.langCode = v.langCode;
            w.action = m(x.url, y);
            w.filebrowser = x;
        };
        function r(v, w, x, y) {
            var z, A;
            for (var B in y) {
                z = y[B];
                if (z.type == 'hbox' || z.type == 'vbox')r(v, w, x, z.children);
                if (!z.filebrowser)continue;
                if (typeof z.filebrowser == 'string') {
                    var C = {action: z.type == 'fileButton' ? 'QuickUpload' : 'Browse', target: z.filebrowser};

                    z.filebrowser = C;
                }
                if (z.filebrowser.action == 'Browse') {
                    var D = z.filebrowser.url;
                    if (D === undefined) {
                        D = v.config['filebrowser' + n(w) + 'BrowseUrl'];
                        if (D === undefined)D = v.config.filebrowserBrowseUrl;
                    }
                    if (D) {
                        z.onClick = o;
                        z.filebrowser.url = D;
                        z.hidden = false;
                    }
                } else if (z.filebrowser.action == 'QuickUpload' && z['for']) {
                    D = z.filebrowser.url;
                    if (D === undefined) {
                        D = v.config['filebrowser' + n(w) + 'UploadUrl'];
                        if (D === undefined)D = v.config.filebrowserUploadUrl;
                    }
                    if (D) {
                        var E = z.onClick;
                        z.onClick = function (F) {
                            var G = F.sender;
                            if (E && E.call(G, F) === false)return false;
                            return p.call(G, F);
                        };
                        z.filebrowser.url = D;
                        z.hidden = false;
                        q(v, x.getContents(z['for'][0]).get(z['for'][1]), z.filebrowser);
                    }
                }
            }
        };
        function s(v, w) {
            var x = w.getDialog(), y = w.filebrowser.target || null;
            v = v.replace(/#/g, '%23');
            if (y) {
                var z = y.split(':'), A = x.getContentElement(z[0], z[1]);
                if (A) {
                    A.setValue(v);
                    x.selectPage(z[0]);
                }
            }
        };
        function t(v, w, x) {
            if (x.indexOf(';') !== -1) {
                var y = x.split(';');
                for (var z = 0; z < y.length; z++) {
                    if (t(v, w, y[z]))return true;
                }
                return false;
            }
            var A = v.getContents(w).get(x).filebrowser;
            return A && A.url;
        };
        function u(v, w) {
            var A = this;
            var x = A._.filebrowserSe.getDialog(), y = A._.filebrowserSe['for'], z = A._.filebrowserSe.filebrowser.onSelect;
            if (y)x.getContentElement(y[0], y[1]).reset();
            if (typeof w == 'function' && w.call(A._.filebrowserSe) === false)return;
            if (z && z.call(A._.filebrowserSe, v, w) === false)return;
            if (typeof w == 'string' && w)alert(w);
            if (v)s(v, A._.filebrowserSe);
        };
        j.add('filebrowser', {
            init: function (v, w) {
                v._.filebrowserFn = e.addFunction(u, v);
            }
        });
        a.on('dialogDefinition', function (v) {
            var w = v.data.definition, x;
            for (var y in w.contents) {
                if (x = w.contents[y]) {
                    r(v.editor, v.data.name, w, x.elements);
                    if (x.hidden && x.filebrowser)x.hidden = !t(w, x.id, x.filebrowser);
                }
            }
        });
    })();
    j.add('find', {
        init: function (m) {
            var n = j.find;
            m.ui.addButton('Find', {label: m.lang.findAndReplace.find, command: 'find'});
            var o = m.addCommand('find', new a.dialogCommand('find'));
            o.canUndo = false;
            m.ui.addButton('Replace', {label: m.lang.findAndReplace.replace, command: 'replace'});
            var p = m.addCommand('replace', new a.dialogCommand('replace'));
            p.canUndo = false;
            a.dialog.add('find', this.path + 'dialogs/find.js');
            a.dialog.add('replace', this.path + 'dialogs/find.js');
        }, requires: ['styles']
    });
    i.find_highlight = {element: 'span', styles: {'background-color': '#004', color: '#fff'}};
    (function () {
        var m = /\.swf(?:$|\?)/i, n = e.cssLength;

        function o(q) {
            var r = q.attributes;
            return r.type == 'application/x-shockwave-flash' || m.test(r.src || '');
        };
        function p(q, r) {
            var s = q.createFakeParserElement(r, 'cke_flash', 'flash', true), t = s.attributes.style || '', u = r.attributes.width, v = r.attributes.height;

            if (typeof u != 'undefined')t = s.attributes.style = t + 'width:' + n(u) + ';';
            if (typeof v != 'undefined')t = s.attributes.style = t + 'height:' + n(v) + ';';
            return s;
        };
        j.add('flash', {
            init: function (q) {
                q.addCommand('flash', new a.dialogCommand('flash'));
                q.ui.addButton('Flash', {label: q.lang.common.flash, command: 'flash'});
                a.dialog.add('flash', this.path + 'dialogs/flash.js');
                q.addCss('img.cke_flash{background-image: url(' + a.getUrl(this.path + 'images/placeholder.png') + ');' + 'background-position: center center;' + 'background-repeat: no-repeat;' + 'border: 1px solid #a9a9a9;' + 'width: 80px;' + 'height: 80px;' + '}');
                if (q.addMenuItems)q.addMenuItems({
                    flash: {
                        label: q.lang.flash.properties,
                        command: 'flash',
                        group: 'flash'
                    }
                });
                q.on('doubleclick', function (r) {
                    var s = r.data.element;
                    if (s.is('img') && s.data('cke-real-element-type') == 'flash')r.data.dialog = 'flash';
                });
                if (q.contextMenu)q.contextMenu.addListener(function (r, s) {
                    if (r && r.is('img') && !r.isReadOnly() && r.data('cke-real-element-type') == 'flash')return {flash: 2};
                });
            }, afterInit: function (q) {
                var r = q.dataProcessor, s = r && r.dataFilter;
                if (s)s.addRules({
                    elements: {
                        'cke:object': function (t) {
                            var u = t.attributes, v = u.classid && String(u.classid).toLowerCase();
                            if (!v) {
                                for (var w = 0; w < t.children.length; w++) {
                                    if (t.children[w].name == 'cke:embed') {
                                        if (!o(t.children[w]))return null;
                                        return p(q, t);
                                    }
                                }
                                return null;
                            }
                            return p(q, t);
                        }, 'cke:embed': function (t) {
                            if (!o(t))return null;
                            return p(q, t);
                        }
                    }
                }, 5);
            }, requires: ['fakeobjects']
        });
    })();
    e.extend(i, {flashEmbedTagOnly: false, flashAddEmbedTag: true, flashConvertOnEdit: false});
    (function () {
        function m(n, o, p, q, r, s, t) {
            var u = n.config, v = r.split(';'), w = [], x = {};
            for (var y = 0; y < v.length; y++) {
                var z = v[y];
                if (z) {
                    z = z.split('/');
                    var A = {}, B = v[y] = z[0];
                    A[p] = w[y] = z[1] || B;
                    x[B] = new a.style(t, A);
                    x[B]._.definition.name = B;
                } else v.splice(y--, 1);
            }
            n.ui.addRichCombo(o, {
                label: q.label,
                title: q.panelTitle,
                className: 'cke_' + (p == 'size' ? 'fontSize' : 'font'),
                panel: {
                    css: n.skin.editor.css.concat(u.contentsCss),
                    multiSelect: false,
                    attributes: {'aria-label': q.panelTitle}
                },
                init: function () {
                    this.startGroup(q.panelTitle);
                    for (var C = 0; C < v.length; C++) {
                        var D = v[C];
                        this.add(D, x[D].buildPreview(), D);
                    }
                },
                onClick: function (C) {
                    n.focus();
                    n.fire('saveSnapshot');
                    var D = x[C];
                    if (this.getValue() == C)D.remove(n.document); else D.apply(n.document);
                    n.fire('saveSnapshot');
                },
                onRender: function () {
                    n.on('selectionChange', function (C) {
                        var D = this.getValue(), E = C.data.path, F = E.elements;
                        for (var G = 0, H; G < F.length; G++) {
                            H = F[G];
                            for (var I in x) {
                                if (x[I].checkElementRemovable(H, true)) {
                                    if (I != D)this.setValue(I);
                                    return;
                                }
                            }
                        }
                        this.setValue('', s);
                    }, this);
                }
            });
        };
        j.add('font', {
            requires: ['richcombo', 'styles'], init: function (n) {
                var o = n.config;

                m(n, 'Font', 'family', n.lang.font, o.font_names, o.font_defaultLabel, o.font_style);
                m(n, 'FontSize', 'size', n.lang.fontSize, o.fontSize_sizes, o.fontSize_defaultLabel, o.fontSize_style);
            }
        });
    })();
    i.font_names = 'Arial/Arial, Helvetica, sans-serif;Comic Sans MS/Comic Sans MS, cursive;Courier New/Courier New, Courier, monospace;Georgia/Georgia, serif;Lucida Sans Unicode/Lucida Sans Unicode, Lucida Grande, sans-serif;Tahoma/Tahoma, Geneva, sans-serif;Times New Roman/Times New Roman, Times, serif;Trebuchet MS/Trebuchet MS, Helvetica, sans-serif;Verdana/Verdana, Geneva, sans-serif';
    i.font_defaultLabel = '';
    i.font_style = {
        element: 'span',
        styles: {'font-family': '#(family)'},
        overrides: [{element: 'font', attributes: {face: null}}]
    };
    i.fontSize_sizes = '8/8px;9/9px;10/10px;11/11px;12/12px;14/14px;16/16px;18/18px;20/20px;22/22px;24/24px;26/26px;28/28px;36/36px;48/48px;72/72px';
    i.fontSize_defaultLabel = '';
    i.fontSize_style = {
        element: 'span',
        styles: {'font-size': '#(size)'},
        overrides: [{element: 'font', attributes: {size: null}}]
    };
    j.add('format', {
        requires: ['richcombo', 'styles'], init: function (m) {
            var n = m.config, o = m.lang.format, p = n.format_tags.split(';'), q = {};
            for (var r = 0; r < p.length; r++) {
                var s = p[r];
                q[s] = new a.style(n['format_' + s]);
                q[s]._.enterMode = m.config.enterMode;
            }
            m.ui.addRichCombo('Format', {
                label: o.label,
                title: o.panelTitle,
                className: 'cke_format',
                panel: {
                    css: m.skin.editor.css.concat(n.contentsCss),
                    multiSelect: false,
                    attributes: {'aria-label': o.panelTitle}
                },
                init: function () {
                    this.startGroup(o.panelTitle);
                    for (var t in q) {
                        var u = o['tag_' + t];
                        this.add(t, '<' + t + '>' + u + '</' + t + '>', u);
                    }
                },
                onClick: function (t) {
                    m.focus();
                    m.fire('saveSnapshot');
                    q[t].apply(m.document);
                    setTimeout(function () {
                        m.fire('saveSnapshot');
                    }, 0);
                },
                onRender: function () {
                    m.on('selectionChange', function (t) {
                        var u = this.getValue(), v = t.data.path;
                        for (var w in q) {
                            if (q[w].checkActive(v)) {
                                if (w != u)this.setValue(w, m.lang.format['tag_' + w]);
                                return;
                            }
                        }
                        this.setValue('');
                    }, this);
                }
            });
        }
    });
    i.format_tags = 'p;h1;h2;h3;h4;h5;h6;pre;address;div';
    i.format_p = {element: 'p'};
    i.format_div = {element: 'div'};
    i.format_pre = {element: 'pre'};
    i.format_address = {element: 'address'};
    i.format_h1 = {element: 'h1'};
    i.format_h2 = {element: 'h2'};
    i.format_h3 = {element: 'h3'};
    i.format_h4 = {element: 'h4'};
    i.format_h5 = {element: 'h5'};
    i.format_h6 = {element: 'h6'};
    j.add('forms', {
        init: function (m) {
            var n = m.lang;
            m.addCss('form{border: 1px dotted #FF0000;padding: 2px;}\n');
            m.addCss('img.cke_hidden{background-image: url(' + a.getUrl(this.path + 'images/hiddenfield.gif') + ');' + 'background-position: center center;' + 'background-repeat: no-repeat;' + 'border: 1px solid #a9a9a9;' + 'width: 16px !important;' + 'height: 16px !important;' + '}');

            var o = function (q, r, s) {
                m.addCommand(r, new a.dialogCommand(r));
                m.ui.addButton(q, {label: n.common[q.charAt(0).toLowerCase() + q.slice(1)], command: r});
                a.dialog.add(r, s);
            }, p = this.path + 'dialogs/';
            o('Form', 'form', p + 'form.js');
            o('Checkbox', 'checkbox', p + 'checkbox.js');
            o('Radio', 'radio', p + 'radio.js');
            o('TextField', 'textfield', p + 'textfield.js');
            o('Textarea', 'textarea', p + 'textarea.js');
            o('Select', 'select', p + 'select.js');
            o('Button', 'button', p + 'button.js');
            o('ImageButton', 'imagebutton', j.getPath('image') + 'dialogs/image.js');
            o('HiddenField', 'hiddenfield', p + 'hiddenfield.js');
            if (m.addMenuItems)m.addMenuItems({
                form: {label: n.form.menu, command: 'form', group: 'form'},
                checkbox: {label: n.checkboxAndRadio.checkboxTitle, command: 'checkbox', group: 'checkbox'},
                radio: {label: n.checkboxAndRadio.radioTitle, command: 'radio', group: 'radio'},
                textfield: {label: n.textfield.title, command: 'textfield', group: 'textfield'},
                hiddenfield: {label: n.hidden.title, command: 'hiddenfield', group: 'hiddenfield'},
                imagebutton: {label: n.image.titleButton, command: 'imagebutton', group: 'imagebutton'},
                button: {label: n.button.title, command: 'button', group: 'button'},
                select: {label: n.select.title, command: 'select', group: 'select'},
                textarea: {label: n.textarea.title, command: 'textarea', group: 'textarea'}
            });
            if (m.contextMenu) {
                m.contextMenu.addListener(function (q) {
                    if (q && q.hasAscendant('form', true) && !q.isReadOnly())return {form: 2};
                });
                m.contextMenu.addListener(function (q) {
                    if (q && !q.isReadOnly()) {
                        var r = q.getName();
                        if (r == 'select')return {select: 2};
                        if (r == 'textarea')return {textarea: 2};
                        if (r == 'input') {
                            var s = q.getAttribute('type');
                            if (s == 'text' || s == 'password')return {textfield: 2};
                            if (s == 'button' || s == 'submit' || s == 'reset')return {button: 2};
                            if (s == 'checkbox')return {checkbox: 2};
                            if (s == 'radio')return {radio: 2};
                            if (s == 'image')return {imagebutton: 2};
                        }
                        if (r == 'img' && q.data('cke-real-element-type') == 'hiddenfield')return {hiddenfield: 2};
                    }
                });
            }
            m.on('doubleclick', function (q) {
                var r = q.data.element;
                if (r.is('form'))q.data.dialog = 'form'; else if (r.is('select'))q.data.dialog = 'select'; else if (r.is('textarea'))q.data.dialog = 'textarea'; else if (r.is('img') && r.data('cke-real-element-type') == 'hiddenfield')q.data.dialog = 'hiddenfield'; else if (r.is('input')) {
                    var s = r.getAttribute('type');
                    switch (s) {
                        case 'text':
                        case 'password':
                            q.data.dialog = 'textfield';
                            break;
                        case 'button':
                        case 'submit':
                        case 'reset':
                            q.data.dialog = 'button';
                            break;
                        case 'checkbox':
                            q.data.dialog = 'checkbox';
                            break;
                        case 'radio':
                            q.data.dialog = 'radio';
                            break;
                        case 'image':
                            q.data.dialog = 'imagebutton';
                            break;
                    }
                }
            });
        }, afterInit: function (m) {
            var n = m.dataProcessor, o = n && n.htmlFilter, p = n && n.dataFilter;

            if (c)o && o.addRules({
                elements: {
                    input: function (q) {
                        var r = q.attributes, s = r.type;
                        if (s == 'checkbox' || s == 'radio')r.value == 'on' && delete r.value;
                    }
                }
            });
            if (p)p.addRules({
                elements: {
                    input: function (q) {
                        if (q.attributes.type == 'hidden')return m.createFakeParserElement(q, 'cke_hidden', 'hiddenfield');
                    }
                }
            });
        }, requires: ['image', 'fakeobjects']
    });
    if (c)h.prototype.hasAttribute = function (m) {
        var p = this;
        var n = p.$.attributes.getNamedItem(m);
        if (p.getName() == 'input')switch (m) {
            case 'class':
                return p.$.className.length > 0;
            case 'checked':
                return !!p.$.checked;
            case 'value':
                var o = p.getAttribute('type');
                if (o == 'checkbox' || o == 'radio')return p.$.value != 'on';
                break;
            default:
        }
        return !!(n && n.specified);
    };
    (function () {
        var m = {
            canUndo: false, exec: function (o) {
                o.insertElement(o.document.createElement('hr'));
            }
        }, n = 'horizontalrule';
        j.add(n, {
            init: function (o) {
                o.addCommand(n, m);
                o.ui.addButton('HorizontalRule', {label: o.lang.horizontalrule, command: n});
            }
        });
    })();
    (function () {
        var m = /^[\t\r\n ]*(?:&nbsp;|\xa0)$/, n = '{cke_protected}';

        function o(R) {
            var S = R.children.length, T = R.children[S - 1];
            while (T && T.type == 3 && !e.trim(T.value))T = R.children[--S];
            return T;
        };
        function p(R, S) {
            var T = R.children, U = o(R);
            if (U) {
                if ((S || !c) && U.type == 1 && U.name == 'br')T.pop();
                if (U.type == 3 && m.test(U.value))T.pop();
            }
        };
        function q(R, S, T) {
            if (!S && (!T || typeof T == 'function' && T(R) === false))return false;
            if (S && c && (document.documentMode > 7 || R.name in f.tr || R.name in f.$listItem))return false;
            var U = o(R);
            return !U || U && (U.type == 1 && U.name == 'br' || R.name == 'form' && U.name == 'input');
        };
        function r(R, S) {
            return function (T) {
                p(T, !R);
                if (q(T, !R, S))if (R || c)T.add(new a.htmlParser.text('\xa0')); else T.add(new a.htmlParser.element('br', {}));
            };
        };
        var s = f, t = e.extend({}, s.$block, s.$listItem, s.$tableContent);
        for (var u in t) {
            if (!('br' in s[u]))delete t[u];
        }
        delete t.pre;
        var v = {elements: {}, attributeNames: [[/^on/, 'data-cke-pa-on']]}, w = {elements: {}};
        for (u in t)w.elements[u] = r();
        var x = {
            elementNames: [[/^cke:/, ''], [/^\?xml:namespace$/, '']],
            attributeNames: [[/^data-cke-(saved|pa)-/, ''], [/^data-cke.*/, ''], ['hidefocus', '']],
            elements: {
                $: function (R) {
                    var S = R.attributes;
                    if (S) {
                        if (S['data-cke-temp'])return false;
                        var T = ['name', 'href', 'src'], U;
                        for (var V = 0; V < T.length; V++) {
                            U = 'data-cke-saved-' + T[V];
                            U in S && delete S[T[V]];
                        }
                    }
                    return R;
                }, embed: function (R) {
                    var S = R.parent;
                    if (S && S.name == 'object') {
                        var T = S.attributes.width, U = S.attributes.height;
                        T && (R.attributes.width = T);
                        U && (R.attributes.height = U);
                    }
                }, param: function (R) {
                    R.children = [];
                    R.isEmpty = true;
                    return R;
                }, a: function (R) {
                    if (!(R.children.length || R.attributes.name || R.attributes['data-cke-saved-name']))return false;

                }, span: function (R) {
                    if (R.attributes['class'] == 'Apple-style-span')delete R.name;
                }, html: function (R) {
                    delete R.attributes.contenteditable;
                    delete R.attributes['class'];
                }, body: function (R) {
                    delete R.attributes.spellcheck;
                    delete R.attributes.contenteditable;
                }, style: function (R) {
                    var S = R.children[0];
                    S && S.value && (S.value = e.trim(S.value));
                    if (!R.attributes.type)R.attributes.type = 'text/css';
                }, title: function (R) {
                    var S = R.children[0];
                    S && (S.value = R.attributes['data-cke-title'] || '');
                }
            },
            attributes: {
                'class': function (R, S) {
                    return e.ltrim(R.replace(/(?:^|\s+)cke_[^\s]*/g, '')) || false;
                }
            },
            comment: function (R) {
                if (R.substr(0, n.length) == n) {
                    if (R.substr(n.length, 3) == '{C}')R = R.substr(n.length + 3); else R = R.substr(n.length);
                    return new a.htmlParser.cdata(decodeURIComponent(R));
                }
                return R;
            }
        };
        if (c)x.attributes.style = function (R, S) {
            return R.toLowerCase();
        };
        function y(R) {
            R.attributes.contenteditable = 'false';
        };
        function z(R) {
            delete R.attributes.contenteditable;
        };
        for (u in {input: 1, textarea: 1}) {
            v.elements[u] = y;
            x.elements[u] = z;
        }
        var A = /<((?:a|area|img|input)\b[\s\S]*?\s)((href|src|name)\s*=\s*(?:(?:"[^"]*")|(?:'[^']*')|(?:[^ "'>]+)))([^>]*)>/gi, B = /\sdata-cke-saved-src\s*=/, C = /(?:<style(?=[ >])[^>]*>[\s\S]*<\/style>)|(?:<(:?link|meta|base)[^>]*>)/gi, D = /<cke:encoded>([^<]*)<\/cke:encoded>/gi, E = /(<\/?)((?:object|embed|param|html|body|head|title)[^>]*>)/gi, F = /(<\/?)cke:((?:html|body|head|title)[^>]*>)/gi, G = /<cke:(param|embed)([^>]*?)\/?>(?!\s*<\/cke:\1)/gi;

        function H(R) {
            return R.replace(A, function (S, T, U, V, W) {
                if (V == 'src' && B.test(S))return S; else return '<' + T + U + ' data-cke-saved-' + U + W + '>';
            });
        };
        function I(R) {
            return R.replace(C, function (S) {
                return '<cke:encoded>' + encodeURIComponent(S) + '</cke:encoded>';
            });
        };
        function J(R) {
            return R.replace(D, function (S, T) {
                return decodeURIComponent(T);
            });
        };
        function K(R) {
            return R.replace(E, '$1cke:$2');
        };
        function L(R) {
            return R.replace(F, '$1$2');
        };
        function M(R) {
            return R.replace(G, '<cke:$1$2></cke:$1>');
        };
        function N(R) {
            return R.replace(/(<pre\b[^>]*>)(\r\n|\n)/g, '$1$2$2');
        };
        function O(R) {
            return R.replace(/<!--(?!{cke_protected})[\s\S]+?-->/g, function (S) {
                return '<!--' + n + '{C}' + encodeURIComponent(S).replace(/--/g, '%2D%2D') + '-->';
            });
        };
        function P(R) {
            return R.replace(/<!--\{cke_protected\}\{C\}([\s\S]+?)-->/g, function (S, T) {
                return decodeURIComponent(T);
            });
        };
        function Q(R, S) {
            var T = [], U = /<\!--\{cke_temp(comment)?\}(\d*?)-->/g, V = [/<script[\s\S]*?<\/script>/gi, /<noscript[\s\S]*?<\/noscript>/gi].concat(S);
            R = R.replace(/<!--[\s\S]*?-->/g, function (X) {
                return '<!--{cke_tempcomment}' + (T.push(X) - 1) + '-->';
            });
            for (var W = 0;

                 W < V.length; W++)R = R.replace(V[W], function (X) {
                X = X.replace(U, function (Y, Z, aa) {
                    return T[aa];
                });
                return '<!--{cke_temp}' + (T.push(X) - 1) + '-->';
            });
            R = R.replace(U, function (X, Y, Z) {
                return '<!--' + n + (Y ? '{C}' : '') + encodeURIComponent(T[Z]).replace(/--/g, '%2D%2D') + '-->';
            });
            return R;
        };
        j.add('htmldataprocessor', {
            requires: ['htmlwriter'], init: function (R) {
                var S = R.dataProcessor = new a.htmlDataProcessor(R);
                S.writer.forceSimpleAmpersand = R.config.forceSimpleAmpersand;
                S.dataFilter.addRules(v);
                S.dataFilter.addRules(w);
                S.htmlFilter.addRules(x);
                var T = {elements: {}};
                for (u in t)T.elements[u] = r(true, R.config.fillEmptyBlocks);
                S.htmlFilter.addRules(T);
            }, onLoad: function () {
                !('fillEmptyBlocks' in i) && (i.fillEmptyBlocks = 1);
            }
        });
        a.htmlDataProcessor = function (R) {
            var S = this;
            S.editor = R;
            S.writer = new a.htmlWriter();
            S.dataFilter = new a.htmlParser.filter();
            S.htmlFilter = new a.htmlParser.filter();
        };
        a.htmlDataProcessor.prototype = {
            toHtml: function (R, S) {
                R = Q(R, this.editor.config.protectedSource);
                R = H(R);
                R = I(R);
                R = K(R);
                R = M(R);
                R = N(R);
                var T = new h('div');
                T.setHtml('a' + R);
                R = T.getHtml().substr(1);
                R = L(R);
                R = J(R);
                R = P(R);
                var U = a.htmlParser.fragment.fromHtml(R, S), V = new a.htmlParser.basicWriter();
                U.writeHtml(V, this.dataFilter);
                R = V.getHtml(true);
                R = O(R);
                return R;
            }, toDataFormat: function (R, S) {
                var T = this.writer, U = a.htmlParser.fragment.fromHtml(R, S);
                T.reset();
                U.writeHtml(T, this.htmlFilter);
                return T.getHtml(true);
            }
        };
    })();
    (function () {
        function m(n, o) {
            var p = n.createFakeParserElement(o, 'cke_iframe', 'iframe', true), q = p.attributes.style || '', r = o.attributes.width, s = o.attributes.height;
            if (typeof r != 'undefined')q += 'width:' + e.cssLength(r) + ';';
            if (typeof s != 'undefined')q += 'height:' + e.cssLength(s) + ';';
            p.attributes.style = q;
            return p;
        };
        j.add('iframe', {
            requires: ['dialog', 'fakeobjects'], init: function (n) {
                var o = 'iframe', p = n.lang.iframe;
                a.dialog.add(o, this.path + 'dialogs/iframe.js');
                n.addCommand(o, new a.dialogCommand(o));
                n.addCss('img.cke_iframe{background-image: url(' + a.getUrl(this.path + 'images/placeholder.png') + ');' + 'background-position: center center;' + 'background-repeat: no-repeat;' + 'border: 1px solid #a9a9a9;' + 'width: 80px;' + 'height: 80px;' + '}');
                n.ui.addButton('Iframe', {label: p.toolbar, command: o});
                n.on('doubleclick', function (q) {
                    var r = q.data.element;
                    if (r.is('img') && r.data('cke-real-element-type') == 'iframe')q.data.dialog = 'iframe';
                });
                if (n.addMenuItems)n.addMenuItems({iframe: {label: p.title, command: 'iframe', group: 'image'}});
                if (n.contextMenu)n.contextMenu.addListener(function (q, r) {
                    if (q && q.is('img') && q.data('cke-real-element-type') == 'iframe')return {iframe: 2};
                });
            }, afterInit: function (n) {
                var o = n.dataProcessor, p = o && o.dataFilter;

                if (p)p.addRules({
                    elements: {
                        iframe: function (q) {
                            return m(n, q);
                        }
                    }
                });
            }
        });
    })();
    j.add('image', {
        init: function (m) {
            var n = 'image';
            a.dialog.add(n, this.path + 'dialogs/image.js');
            m.addCommand(n, new a.dialogCommand(n));
            m.ui.addButton('Image', {label: m.lang.common.image, command: n});
            m.on('doubleclick', function (o) {
                var p = o.data.element;
                if (p.is('img') && !p.data('cke-realelement'))o.data.dialog = 'image';
            });
            if (m.addMenuItems)m.addMenuItems({image: {label: m.lang.image.menu, command: 'image', group: 'image'}});
            if (m.contextMenu)m.contextMenu.addListener(function (o, p) {
                if (!o || !o.is('img') || o.data('cke-realelement') || o.isReadOnly())return null;
                return {image: 2};
            });
        }
    });
    i.image_removeLinkByEmptyURL = true;
    (function () {
        var m = {ol: 1, ul: 1}, n = d.walker.whitespaces(true), o = d.walker.bookmark(false, true);

        function p(u, v) {
            u.getCommand(this.name).setState(v);
        };
        function q(u) {
            var D = this;
            var v = u.editor, w = u.data.path, x = w && w.contains(m);
            if (x)return p.call(D, v, 2);
            if (!D.useIndentClasses && D.name == 'indent')return p.call(D, v, 2);
            var y = u.data.path, z = y.block || y.blockLimit;
            if (!z)return p.call(D, v, 0);
            if (D.useIndentClasses) {
                var A = z.$.className.match(D.classNameRegex), B = 0;
                if (A) {
                    A = A[1];
                    B = D.indentClassMap[A];
                }
                if (D.name == 'outdent' && !B || D.name == 'indent' && B == v.config.indentClasses.length)return p.call(D, v, 0);
                return p.call(D, v, 2);
            } else {
                var C = parseInt(z.getStyle(s(z)), 10);
                if (isNaN(C))C = 0;
                if (C <= 0)return p.call(D, v, 0);
                return p.call(D, v, 2);
            }
        };
        function r(u, v) {
            var x = this;
            x.name = v;
            x.useIndentClasses = u.config.indentClasses && u.config.indentClasses.length > 0;
            if (x.useIndentClasses) {
                x.classNameRegex = new RegExp('(?:^|\\s+)(' + u.config.indentClasses.join('|') + ')(?=$|\\s)');
                x.indentClassMap = {};
                for (var w = 0; w < u.config.indentClasses.length; w++)x.indentClassMap[u.config.indentClasses[w]] = w + 1;
            }
            x.startDisabled = v == 'outdent';
        };
        function s(u, v) {
            return (v || u.getComputedStyle('direction')) == 'ltr' ? 'margin-left' : 'margin-right';
        };
        function t(u) {
            return u.type = 1 && u.is('li');
        };
        r.prototype = {
            exec: function (u) {
                var v = this, w = {};

                function x(N) {
                    var O = D.startContainer, P = D.endContainer;
                    while (O && !O.getParent().equals(N))O = O.getParent();
                    while (P && !P.getParent().equals(N))P = P.getParent();
                    if (!O || !P)return;
                    var Q = O, R = [], S = false;
                    while (!S) {
                        if (Q.equals(P))S = true;
                        R.push(Q);
                        Q = Q.getNext();
                    }
                    if (R.length < 1)return;
                    var T = N.getParents(true);
                    for (var U = 0; U < T.length; U++) {
                        if (T[U].getName && m[T[U].getName()]) {
                            N = T[U];
                            break;
                        }
                    }
                    var V = v.name == 'indent' ? 1 : -1, W = R[0], X = R[R.length - 1], Y = j.list.listToArray(N, w), Z = Y[X.getCustomData('listarray_index')].indent;
                    for (U = W.getCustomData('listarray_index'); U <= X.getCustomData('listarray_index');

                         U++) {
                        Y[U].indent += V;
                        var aa = Y[U].parent;
                        Y[U].parent = new h(aa.getName(), aa.getDocument());
                    }
                    for (U = X.getCustomData('listarray_index') + 1; U < Y.length && Y[U].indent > Z; U++)Y[U].indent += V;
                    var ab = j.list.arrayToList(Y, w, null, u.config.enterMode, N.getDirection());
                    if (v.name == 'outdent') {
                        var ac;
                        if ((ac = N.getParent()) && ac.is('li')) {
                            var ad = ab.listNode.getChildren(), ae = [], af = ad.count(), ag;
                            for (U = af - 1; U >= 0; U--) {
                                if ((ag = ad.getItem(U)) && ag.is && ag.is('li'))ae.push(ag);
                            }
                        }
                    }
                    if (ab)ab.listNode.replace(N);
                    if (ae && ae.length)for (U = 0; U < ae.length; U++) {
                        var ah = ae[U], ai = ah;
                        while ((ai = ai.getNext()) && ai.is && ai.getName() in m) {
                            if (c && !ah.getFirst(function (aj) {
                                    return n(aj) && o(aj);
                                }))ah.append(D.document.createText('\xa0'));
                            ah.append(ai);
                        }
                        ah.insertAfter(ac);
                    }
                };
                function y() {
                    var N = D.createIterator(), O = u.config.enterMode;
                    N.enforceRealBlocks = true;
                    N.enlargeBr = O != 2;
                    var P;
                    while (P = N.getNextParagraph())z(P);
                };
                function z(N, O) {
                    if (N.getCustomData('indent_processed'))return false;
                    if (v.useIndentClasses) {
                        var P = N.$.className.match(v.classNameRegex), Q = 0;
                        if (P) {
                            P = P[1];
                            Q = v.indentClassMap[P];
                        }
                        if (v.name == 'outdent')Q--; else Q++;
                        if (Q < 0)return false;
                        Q = Math.min(Q, u.config.indentClasses.length);
                        Q = Math.max(Q, 0);
                        N.$.className = e.ltrim(N.$.className.replace(v.classNameRegex, ''));
                        if (Q > 0)N.addClass(u.config.indentClasses[Q - 1]);
                    } else {
                        var R = s(N, O), S = parseInt(N.getStyle(R), 10);
                        if (isNaN(S))S = 0;
                        var T = u.config.indentOffset || 40;
                        S += (v.name == 'indent' ? 1 : -1) * T;
                        if (S < 0)return false;
                        S = Math.max(S, 0);
                        S = Math.ceil(S / T) * T;
                        N.setStyle(R, S ? S + (u.config.indentUnit || 'px') : '');
                        if (N.getAttribute('style') === '')N.removeAttribute('style');
                    }
                    h.setMarker(w, N, 'indent_processed', 1);
                    return true;
                };
                var A = u.getSelection(), B = A.createBookmarks(1), C = A && A.getRanges(1), D, E = C.createIterator();
                while (D = E.getNextRange()) {
                    var F = D.getCommonAncestor(), G = F;
                    while (G && !(G.type == 1 && m[G.getName()]))G = G.getParent();
                    if (!G) {
                        var H = D.getEnclosedNode();
                        if (H && H.type == 1 && H.getName() in m) {
                            D.setStartAt(H, 1);
                            D.setEndAt(H, 2);
                            G = H;
                        }
                    }
                    if (G && D.startContainer.type == 1 && D.startContainer.getName() in m) {
                        var I = new d.walker(D);
                        I.evaluator = t;
                        D.startContainer = I.next();
                    }
                    if (G && D.endContainer.type == 1 && D.endContainer.getName() in m) {
                        I = new d.walker(D);
                        I.evaluator = t;
                        D.endContainer = I.previous();
                    }
                    if (G) {
                        var J = G.getFirst(t), K = !!J.getNext(t), L = D.startContainer, M = J.equals(L) || J.contains(L);
                        if (!(M && (v.name == 'indent' || v.useIndentClasses || parseInt(G.getStyle(s(G)), 10)) && z(G, !K && J.getDirection())))x(G);
                    } else y();
                }
                h.clearAllMarkers(w);
                u.forceNextSelectionCheck();
                A.selectBookmarks(B);
            }
        };
        j.add('indent', {
            init: function (u) {
                var v = new r(u, 'indent'), w = new r(u, 'outdent');

                u.addCommand('indent', v);
                u.addCommand('outdent', w);
                u.ui.addButton('Indent', {label: u.lang.indent, command: 'indent'});
                u.ui.addButton('Outdent', {label: u.lang.outdent, command: 'outdent'});
                u.on('selectionChange', e.bind(q, v));
                u.on('selectionChange', e.bind(q, w));
                if (b.ie6Compat || b.ie7Compat)u.addCss('ul,ol{\tmargin-left: 0px;\tpadding-left: 40px;}');
                u.on('dirChanged', function (x) {
                    var y = new d.range(u.document);
                    y.setStartBefore(x.data.node);
                    y.setEndAfter(x.data.node);
                    var z = new d.walker(y), A;
                    while (A = z.next()) {
                        if (A.type == 1) {
                            if (!A.equals(x.data.node) && A.getDirection()) {
                                y.setStartAfter(A);
                                z = new d.walker(y);
                                continue;
                            }
                            var B = u.config.indentClasses;
                            if (B) {
                                var C = x.data.dir == 'ltr' ? ['_rtl', ''] : ['', '_rtl'];
                                for (var D = 0; D < B.length; D++) {
                                    if (A.hasClass(B[D] + C[0])) {
                                        A.removeClass(B[D] + C[0]);
                                        A.addClass(B[D] + C[1]);
                                    }
                                }
                            }
                            var E = A.getStyle('margin-right'), F = A.getStyle('margin-left');
                            E ? A.setStyle('margin-left', E) : A.removeStyle('margin-left');
                            F ? A.setStyle('margin-right', F) : A.removeStyle('margin-right');
                        }
                    }
                });
            }, requires: ['domiterator', 'list']
        });
    })();
    (function () {
        function m(r, s) {
            var t = s.block || s.blockLimit;
            if (!t || t.getName() == 'body')return 2;
            return n(t, r.config.useComputedState) == this.value ? 1 : 2;
        };
        function n(r, s) {
            s = s === undefined || s;
            var t;
            if (s)t = r.getComputedStyle('text-align'); else {
                while (!r.hasAttribute || !(r.hasAttribute('align') || r.getStyle('text-align'))) {
                    var u = r.getParent();
                    if (!u)break;
                    r = u;
                }
                t = r.getStyle('text-align') || r.getAttribute('align') || '';
            }
            t && (t = t.replace(/-moz-|-webkit-|start|auto/i, ''));
            !t && s && (t = r.getComputedStyle('direction') == 'rtl' ? 'right' : 'left');
            return t;
        };
        function o(r) {
            var s = r.editor.getCommand(this.name);
            s.state = m.call(this, r.editor, r.data.path);
            s.fire('state');
        };
        function p(r, s, t) {
            var v = this;
            v.name = s;
            v.value = t;
            var u = r.config.justifyClasses;
            if (u) {
                switch (t) {
                    case 'left':
                        v.cssClassName = u[0];
                        break;
                    case 'center':
                        v.cssClassName = u[1];
                        break;
                    case 'right':
                        v.cssClassName = u[2];
                        break;
                    case 'justify':
                        v.cssClassName = u[3];
                        break;
                }
                v.cssClassRegex = new RegExp('(?:^|\\s+)(?:' + u.join('|') + ')(?=$|\\s)');
            }
        };
        function q(r) {
            var s = r.editor, t = new d.range(s.document);
            t.setStartBefore(r.data.node);
            t.setEndAfter(r.data.node);
            var u = new d.walker(t), v;
            while (v = u.next()) {
                if (v.type == 1) {
                    if (!v.equals(r.data.node) && v.getDirection()) {
                        t.setStartAfter(v);
                        u = new d.walker(t);
                        continue;
                    }
                    var w = s.config.justifyClasses;
                    if (w)if (v.hasClass(w[0])) {
                        v.removeClass(w[0]);
                        v.addClass(w[2]);
                    } else if (v.hasClass(w[2])) {
                        v.removeClass(w[2]);
                        v.addClass(w[0]);
                    }
                    var x = 'text-align', y = v.getStyle(x);
                    if (y == 'left')v.setStyle(x, 'right'); else if (y == 'right')v.setStyle(x, 'left');

                }
            }
        };
        p.prototype = {
            exec: function (r) {
                var D = this;
                var s = r.getSelection(), t = r.config.enterMode;
                if (!s)return;
                var u = s.createBookmarks(), v = s.getRanges(true), w = D.cssClassName, x, y, z = r.config.useComputedState;
                z = z === undefined || z;
                for (var A = v.length - 1; A >= 0; A--) {
                    x = v[A].createIterator();
                    x.enlargeBr = t != 2;
                    while (y = x.getNextParagraph()) {
                        y.removeAttribute('align');
                        y.removeStyle('text-align');
                        var B = w && (y.$.className = e.ltrim(y.$.className.replace(D.cssClassRegex, ''))), C = D.state == 2 && (!z || n(y, true) != D.value);
                        if (w) {
                            if (C)y.addClass(w); else if (!B)y.removeAttribute('class');
                        } else if (C)y.setStyle('text-align', D.value);
                    }
                }
                r.focus();
                r.forceNextSelectionCheck();
                s.selectBookmarks(u);
            }
        };
        j.add('justify', {
            init: function (r) {
                var s = new p(r, 'justifyleft', 'left'), t = new p(r, 'justifycenter', 'center'), u = new p(r, 'justifyright', 'right'), v = new p(r, 'justifyblock', 'justify');
                r.addCommand('justifyleft', s);
                r.addCommand('justifycenter', t);
                r.addCommand('justifyright', u);
                r.addCommand('justifyblock', v);
                r.ui.addButton('JustifyLeft', {label: r.lang.justify.left, command: 'justifyleft'});
                r.ui.addButton('JustifyCenter', {label: r.lang.justify.center, command: 'justifycenter'});
                r.ui.addButton('JustifyRight', {label: r.lang.justify.right, command: 'justifyright'});
                r.ui.addButton('JustifyBlock', {label: r.lang.justify.block, command: 'justifyblock'});
                r.on('selectionChange', e.bind(o, s));
                r.on('selectionChange', e.bind(o, u));
                r.on('selectionChange', e.bind(o, t));
                r.on('selectionChange', e.bind(o, v));
                r.on('dirChanged', q);
            }, requires: ['domiterator']
        });
    })();
    j.add('keystrokes', {
        beforeInit: function (m) {
            m.keystrokeHandler = new a.keystrokeHandler(m);
            m.specialKeys = {};
        }, init: function (m) {
            var n = m.config.keystrokes, o = m.config.blockedKeystrokes, p = m.keystrokeHandler.keystrokes, q = m.keystrokeHandler.blockedKeystrokes;
            for (var r = 0; r < n.length; r++)p[n[r][0]] = n[r][1];
            for (r = 0; r < o.length; r++)q[o[r]] = 1;
        }
    });
    a.keystrokeHandler = function (m) {
        var n = this;
        if (m.keystrokeHandler)return m.keystrokeHandler;
        n.keystrokes = {};
        n.blockedKeystrokes = {};
        n._ = {editor: m};
        return n;
    };
    (function () {
        var m, n = function (p) {
            p = p.data;
            var q = p.getKeystroke(), r = this.keystrokes[q], s = this._.editor;
            m = s.fire('key', {keyCode: q}) === true;
            if (!m) {
                if (r) {
                    var t = {from: 'keystrokeHandler'};
                    m = s.execCommand(r, t) !== false;
                }
                if (!m) {
                    var u = s.specialKeys[q];
                    m = u && u(s) === true;
                    if (!m)m = !!this.blockedKeystrokes[q];
                }
            }
            if (m)p.preventDefault(true);
            return !m;
        }, o = function (p) {
            if (m) {
                m = false;
                p.data.preventDefault(true);
            }
        };
        a.keystrokeHandler.prototype = {
            attach: function (p) {
                p.on('keydown', n, this);
                if (b.opera || b.gecko && b.mac)p.on('keypress', o, this);
            }
        };
    })();

    i.blockedKeystrokes = [1000 + 66, 1000 + 73, 1000 + 85];
    i.keystrokes = [[4000 + 121, 'toolbarFocus'], [4000 + 122, 'elementsPathFocus'], [2000 + 121, 'contextMenu'], [1000 + 2000 + 121, 'contextMenu'], [1000 + 90, 'undo'], [1000 + 89, 'redo'], [1000 + 2000 + 90, 'redo'], [1000 + 76, 'link'], [1000 + 66, 'bold'], [1000 + 73, 'italic'], [1000 + 85, 'underline'], [4000 + 109, 'toolbarCollapse'], [4000 + 48, 'a11yHelp']];
    j.add('link', {
        init: function (m) {
            m.addCommand('link', new a.dialogCommand('link'));
            m.addCommand('anchor', new a.dialogCommand('anchor'));
            m.addCommand('unlink', new a.unlinkCommand());
            m.ui.addButton('Link', {label: m.lang.link.toolbar, command: 'link'});
            m.ui.addButton('Unlink', {label: m.lang.unlink, command: 'unlink'});
            m.ui.addButton('Anchor', {label: m.lang.anchor.toolbar, command: 'anchor'});
            a.dialog.add('link', this.path + 'dialogs/link.js');
            a.dialog.add('anchor', this.path + 'dialogs/anchor.js');
            m.addCss('img.cke_anchor{background-image: url(' + a.getUrl(this.path + 'images/anchor.gif') + ');' + 'background-position: center center;' + 'background-repeat: no-repeat;' + 'border: 1px solid #a9a9a9;' + 'width: 18px !important;' + 'height: 18px !important;' + '}\n' + 'a.cke_anchor' + '{' + 'background-image: url(' + a.getUrl(this.path + 'images/anchor.gif') + ');' + 'background-position: 0 center;' + 'background-repeat: no-repeat;' + 'border: 1px solid #a9a9a9;' + 'padding-left: 18px;' + '}');
            m.on('selectionChange', function (n) {
                var o = m.getCommand('unlink'), p = n.data.path.lastElement && n.data.path.lastElement.getAscendant('a', true);
                if (p && p.getName() == 'a' && p.getAttribute('href'))o.setState(2); else o.setState(0);
            });
            m.on('doubleclick', function (n) {
                var o = j.link.getSelectedLink(m) || n.data.element;
                if (!o.isReadOnly())if (o.is('a'))n.data.dialog = o.getAttribute('name') && !o.getAttribute('href') ? 'anchor' : 'link'; else if (o.is('img') && o.data('cke-real-element-type') == 'anchor')n.data.dialog = 'anchor';
            });
            if (m.addMenuItems)m.addMenuItems({
                anchor: {label: m.lang.anchor.menu, command: 'anchor', group: 'anchor'},
                link: {label: m.lang.link.menu, command: 'link', group: 'link', order: 1},
                unlink: {label: m.lang.unlink, command: 'unlink', group: 'link', order: 5}
            });
            if (m.contextMenu)m.contextMenu.addListener(function (n, o) {
                if (!n || n.isReadOnly())return null;
                var p = n.is('img') && n.data('cke-real-element-type') == 'anchor';
                if (!p) {
                    if (!(n = j.link.getSelectedLink(m)))return null;
                    p = n.getAttribute('name') && !n.getAttribute('href');
                }
                return p ? {anchor: 2} : {link: 2, unlink: 2};
            });
        }, afterInit: function (m) {
            var n = m.dataProcessor, o = n && n.dataFilter;
            if (o)o.addRules({
                elements: {
                    a: function (p) {
                        var q = p.attributes;
                        if (q.name && !q.href)return m.createFakeParserElement(p, 'cke_anchor', 'anchor');

                    }
                }
            });
        }, requires: ['fakeobjects']
    });
    j.link = {
        getSelectedLink: function (m) {
            try {
                var n = m.getSelection();
                if (n.getType() == 3) {
                    var o = n.getSelectedElement();
                    if (o.is('a'))return o;
                }
                var p = n.getRanges(true)[0];
                p.shrink(2);
                var q = p.getCommonAncestor();
                return q.getAscendant('a', true);
            } catch (r) {
                return null;
            }
        }
    };
    a.unlinkCommand = function () {
    };
    a.unlinkCommand.prototype = {
        exec: function (m) {
            var n = m.getSelection(), o = n.createBookmarks(), p = n.getRanges(), q, r;
            for (var s = 0; s < p.length; s++) {
                q = p[s].getCommonAncestor(true);
                r = q.getAscendant('a', true);
                if (!r)continue;
                p[s].selectNodeContents(r);
            }
            n.selectRanges(p);
            m.document.$.execCommand('unlink', false, null);
            n.selectBookmarks(o);
        }, startDisabled: true
    };
    e.extend(i, {linkShowAdvancedTab: true, linkShowTargetTab: true});
    (function () {
        var m = {
            ol: 1,
            ul: 1
        }, n = /^[\n\r\t ]*$/, o = d.walker.whitespaces(), p = d.walker.bookmark(), q = function (F) {
            return !(o(F) || p(F));
        };
        j.list = {
            listToArray: function (F, G, H, I, J) {
                if (!m[F.getName()])return [];
                if (!I)I = 0;
                if (!H)H = [];
                for (var K = 0, L = F.getChildCount(); K < L; K++) {
                    var M = F.getChild(K);
                    if (M.$.nodeName.toLowerCase() != 'li')continue;
                    var N = {parent: F, indent: I, element: M, contents: []};
                    if (!J) {
                        N.grandparent = F.getParent();
                        if (N.grandparent && N.grandparent.$.nodeName.toLowerCase() == 'li')N.grandparent = N.grandparent.getParent();
                    } else N.grandparent = J;
                    if (G)h.setMarker(G, M, 'listarray_index', H.length);
                    H.push(N);
                    for (var O = 0, P = M.getChildCount(), Q; O < P; O++) {
                        Q = M.getChild(O);
                        if (Q.type == 1 && m[Q.getName()])j.list.listToArray(Q, G, H, I + 1, N.grandparent); else N.contents.push(Q);
                    }
                }
                return H;
            }, arrayToList: function (F, G, H, I, J) {
                if (!H)H = 0;
                if (!F || F.length < H + 1)return null;
                var K = F[H].parent.getDocument(), L = new d.documentFragment(K), M = null, N = H, O = Math.max(F[H].indent, 0), P = null, Q = I == 1 ? 'p' : 'div';
                while (1) {
                    var R = F[N];
                    if (R.indent == O) {
                        if (!M || F[N].parent.getName() != M.getName()) {
                            M = F[N].parent.clone(false, 1);
                            J && M.setAttribute('dir', J);
                            L.append(M);
                        }
                        P = M.append(R.element.clone(0, 1));
                        for (var S = 0; S < R.contents.length; S++)P.append(R.contents[S].clone(1, 1));
                        N++;
                    } else if (R.indent == Math.max(O, 0) + 1) {
                        var T = j.list.arrayToList(F, null, N, I);
                        P.append(T.listNode);
                        N = T.nextIndex;
                    } else if (R.indent == -1 && !H && R.grandparent) {
                        P;
                        if (m[R.grandparent.getName()])P = R.element.clone(false, true); else if (J || R.element.hasAttributes() || I != 2 && R.grandparent.getName() != 'td') {
                            P = K.createElement(Q);
                            R.element.copyAttributes(P, {type: 1, value: 1});
                            J && P.setAttribute('dir', J);
                            if (!J && I == 2 && !P.hasAttributes())P = new d.documentFragment(K);
                        } else P = new d.documentFragment(K);
                        for (S = 0; S < R.contents.length; S++)P.append(R.contents[S].clone(1, 1));
                        if (P.type == 11 && N != F.length - 1) {
                            var U = P.getLast();

                            if (U && U.type == 1 && U.getAttribute('type') == '_moz')U.remove();
                            if (!(U = P.getLast(q) && U.type == 1 && U.getName() in f.$block))P.append(K.createElement('br'));
                        }
                        if (P.type == 1 && P.getName() == Q && P.$.firstChild) {
                            P.trim();
                            var V = P.getFirst();
                            if (V.type == 1 && V.isBlockBoundary()) {
                                var W = new d.documentFragment(K);
                                P.moveChildren(W);
                                P = W;
                            }
                        }
                        var X = P.$.nodeName.toLowerCase();
                        if (!c && (X == 'div' || X == 'p'))P.appendBogus();
                        L.append(P);
                        M = null;
                        N++;
                    } else return null;
                    if (F.length <= N || Math.max(F[N].indent, 0) < O)break;
                }
                if (G) {
                    var Y = L.getFirst();
                    while (Y) {
                        if (Y.type == 1)h.clearMarkers(G, Y);
                        Y = Y.getNextSourceNode();
                    }
                }
                return {listNode: L, nextIndex: N};
            }
        };
        function r(F, G) {
            F.getCommand(this.name).setState(G);
        };
        function s(F) {
            var G = F.data.path, H = G.blockLimit, I = G.elements, J;
            for (var K = 0; K < I.length && (J = I[K]) && !J.equals(H); K++) {
                if (m[I[K].getName()])return r.call(this, F.editor, this.type == I[K].getName() ? 1 : 2);
            }
            return r.call(this, F.editor, 2);
        };
        function t(F, G, H, I) {
            var J = j.list.listToArray(G.root, H), K = [];
            for (var L = 0; L < G.contents.length; L++) {
                var M = G.contents[L];
                M = M.getAscendant('li', true);
                if (!M || M.getCustomData('list_item_processed'))continue;
                K.push(M);
                h.setMarker(H, M, 'list_item_processed', true);
            }
            var N = G.root, O = N.getDocument().createElement(this.type);
            N.copyAttributes(O, {start: 1, type: 1});
            O.removeStyle('list-style-type');
            for (L = 0; L < K.length; L++) {
                var P = K[L].getCustomData('listarray_index');
                J[P].parent = O;
            }
            var Q = j.list.arrayToList(J, H, null, F.config.enterMode), R, S = Q.listNode.getChildCount();
            for (L = 0; L < S && (R = Q.listNode.getChild(L)); L++) {
                if (R.getName() == this.type)I.push(R);
            }
            Q.listNode.replace(G.root);
        };
        var u = /^h[1-6]$/;

        function v(F, G, H) {
            var I = G.contents, J = G.root.getDocument(), K = [];
            if (I.length == 1 && I[0].equals(G.root)) {
                var L = J.createElement('div');
                I[0].moveChildren && I[0].moveChildren(L);
                I[0].append(L);
                I[0] = L;
            }
            var M = G.contents[0].getParent();
            for (var N = 0; N < I.length; N++)M = M.getCommonAncestor(I[N].getParent());
            var O = F.config.useComputedState, P, Q;
            O = O === undefined || O;
            for (N = 0; N < I.length; N++) {
                var R = I[N], S;
                while (S = R.getParent()) {
                    if (S.equals(M)) {
                        K.push(R);
                        if (!Q && R.getDirection())Q = 1;
                        var T = R.getDirection(O);
                        if (P !== null)if (P && P != T)P = null; else P = T;
                        break;
                    }
                    R = S;
                }
            }
            if (K.length < 1)return;
            var U = K[K.length - 1].getNext(), V = J.createElement(this.type);
            H.push(V);
            var W, X;
            while (K.length) {
                W = K.shift();
                X = J.createElement('li');
                if (W.is('pre') || u.test(W.getName()))W.appendTo(X); else {
                    if (P && W.getDirection()) {
                        W.removeStyle('direction');
                        W.removeAttribute('dir');
                    }
                    W.copyAttributes(X);
                    W.moveChildren(X);
                    W.remove();
                }
                X.appendTo(V);
            }
            if (P && Q)V.setAttribute('dir', P);
            if (U)V.insertBefore(U);

            else V.appendTo(M);
        };
        function w(F, G, H) {
            var I = j.list.listToArray(G.root, H), J = [];
            for (var K = 0; K < G.contents.length; K++) {
                var L = G.contents[K];
                L = L.getAscendant('li', true);
                if (!L || L.getCustomData('list_item_processed'))continue;
                J.push(L);
                h.setMarker(H, L, 'list_item_processed', true);
            }
            var M = null;
            for (K = 0; K < J.length; K++) {
                var N = J[K].getCustomData('listarray_index');
                I[N].indent = -1;
                M = N;
            }
            for (K = M + 1; K < I.length; K++) {
                if (I[K].indent > I[K - 1].indent + 1) {
                    var O = I[K - 1].indent + 1 - I[K].indent, P = I[K].indent;
                    while (I[K] && I[K].indent >= P) {
                        I[K].indent += O;
                        K++;
                    }
                    K--;
                }
            }
            var Q = j.list.arrayToList(I, H, null, F.config.enterMode, G.root.getAttribute('dir')), R = Q.listNode, S, T;

            function U(V) {
                if ((S = R[V ? 'getFirst' : 'getLast']()) && !(S.is && S.isBlockBoundary()) && (T = G.root[V ? 'getPrevious' : 'getNext'](d.walker.whitespaces(true))) && !(T.is && T.isBlockBoundary({br: 1})))F.document.createElement('br')[V ? 'insertBefore' : 'insertAfter'](S);
            };
            U(true);
            U();
            R.replace(G.root);
        };
        function x(F, G) {
            this.name = F;
            this.type = G;
        };
        x.prototype = {
            exec: function (F) {
                F.focus();
                var G = F.document, H = F.getSelection(), I = H && H.getRanges(true);
                if (!I || I.length < 1)return;
                if (this.state == 2) {
                    var J = G.getBody();
                    J.trim();
                    if (!J.getFirst()) {
                        var K = G.createElement(F.config.enterMode == 1 ? 'p' : F.config.enterMode == 3 ? 'div' : 'br');
                        K.appendTo(J);
                        I = new d.rangeList([new d.range(G)]);
                        if (K.is('br')) {
                            I[0].setStartBefore(K);
                            I[0].setEndAfter(K);
                        } else I[0].selectNodeContents(K);
                        H.selectRanges(I);
                    } else {
                        var L = I.length == 1 && I[0], M = L && L.getEnclosedNode();
                        if (M && M.is && this.type == M.getName())r.call(this, F, 1);
                    }
                }
                var N = H.createBookmarks(true), O = [], P = {}, Q = I.createIterator(), R = 0;
                while ((L = Q.getNextRange()) && ++R) {
                    var S = L.getBoundaryNodes(), T = S.startNode, U = S.endNode;
                    if (T.type == 1 && T.getName() == 'td')L.setStartAt(S.startNode, 1);
                    if (U.type == 1 && U.getName() == 'td')L.setEndAt(S.endNode, 2);
                    var V = L.createIterator(), W;
                    V.forceBrBreak = this.state == 2;
                    while (W = V.getNextParagraph()) {
                        if (W.getCustomData('list_block'))continue; else h.setMarker(P, W, 'list_block', 1);
                        var X = new d.elementPath(W), Y = X.elements, Z = Y.length, aa = null, ab = 0, ac = X.blockLimit, ad;
                        for (var ae = Z - 1; ae >= 0 && (ad = Y[ae]); ae--) {
                            if (m[ad.getName()] && ac.contains(ad)) {
                                ac.removeCustomData('list_group_object_' + R);
                                var af = ad.getCustomData('list_group_object');
                                if (af)af.contents.push(W); else {
                                    af = {root: ad, contents: [W]};
                                    O.push(af);
                                    h.setMarker(P, ad, 'list_group_object', af);
                                }
                                ab = 1;
                                break;
                            }
                        }
                        if (ab)continue;
                        var ag = ac;
                        if (ag.getCustomData('list_group_object_' + R))ag.getCustomData('list_group_object_' + R).contents.push(W); else {
                            af = {root: ag, contents: [W]};
                            h.setMarker(P, ag, 'list_group_object_' + R, af);
                            O.push(af);

                        }
                    }
                }
                var ah = [];
                while (O.length > 0) {
                    af = O.shift();
                    if (this.state == 2) {
                        if (m[af.root.getName()])t.call(this, F, af, P, ah); else v.call(this, F, af, ah);
                    } else if (this.state == 1 && m[af.root.getName()])w.call(this, F, af, P);
                }
                for (ae = 0; ae < ah.length; ae++) {
                    aa = ah[ae];
                    var ai, aj = this;
                    (ai = function (ak) {
                        var al = aa[ak ? 'getPrevious' : 'getNext'](d.walker.whitespaces(true));
                        if (al && al.getName && al.getName() == aj.type) {
                            al.remove();
                            al.moveChildren(aa, ak);
                        }
                    })();
                    ai(1);
                }
                h.clearAllMarkers(P);
                H.selectBookmarks(N);
                F.focus();
            }
        };
        var y = f, z = /[\t\r\n ]*(?:&nbsp;|\xa0)$/;

        function A(F, G) {
            var H, I = F.children, J = I.length;
            for (var K = 0; K < J; K++) {
                H = I[K];
                if (H.name && H.name in G)return K;
            }
            return J;
        };
        function B(F) {
            return function (G) {
                var H = G.children, I = A(G, y.$list), J = H[I], K = J && J.previous, L;
                if (K && (K.name && K.name == 'br' || K.value && (L = K.value.match(z)))) {
                    var M = K;
                    if (!(L && L.index) && M == H[0])H[0] = F || c ? new a.htmlParser.text('\xa0') : new a.htmlParser.element('br', {}); else if (M.name == 'br')H.splice(I - 1, 1); else M.value = M.value.replace(z, '');
                }
            };
        };
        var C = {elements: {}};
        for (var D in y.$listItem)C.elements[D] = B();
        var E = {elements: {}};
        for (D in y.$listItem)E.elements[D] = B(true);
        j.add('list', {
            init: function (F) {
                var G = new x('numberedlist', 'ol'), H = new x('bulletedlist', 'ul');
                F.addCommand('numberedlist', G);
                F.addCommand('bulletedlist', H);
                F.ui.addButton('NumberedList', {label: F.lang.numberedlist, command: 'numberedlist'});
                F.ui.addButton('BulletedList', {label: F.lang.bulletedlist, command: 'bulletedlist'});
                F.on('selectionChange', e.bind(s, G));
                F.on('selectionChange', e.bind(s, H));
            }, afterInit: function (F) {
                var G = F.dataProcessor;
                if (G) {
                    G.dataFilter.addRules(C);
                    G.htmlFilter.addRules(E);
                }
            }, requires: ['domiterator']
        });
    })();
    (function () {
        j.liststyle = {
            requires: ['dialog'], init: function (m) {
                m.addCommand('numberedListStyle', new a.dialogCommand('numberedListStyle'));
                a.dialog.add('numberedListStyle', this.path + 'dialogs/liststyle.js');
                m.addCommand('bulletedListStyle', new a.dialogCommand('bulletedListStyle'));
                a.dialog.add('bulletedListStyle', this.path + 'dialogs/liststyle.js');
                if (m.addMenuItems) {
                    m.addMenuGroup('list', 108);
                    m.addMenuItems({
                        numberedlist: {
                            label: m.lang.list.numberedTitle,
                            group: 'list',
                            command: 'numberedListStyle'
                        }, bulletedlist: {label: m.lang.list.bulletedTitle, group: 'list', command: 'bulletedListStyle'}
                    });
                }
                if (m.contextMenu)m.contextMenu.addListener(function (n, o) {
                    if (!n || n.isReadOnly())return null;
                    while (n) {
                        var p = n.getName();
                        if (p == 'ol')return {numberedlist: 2}; else if (p == 'ul')return {bulletedlist: 2};
                        n = n.getParent();
                    }
                    return null;
                });
            }
        };
        j.add('liststyle', j.liststyle);
    })();
    (function () {
        function m(s) {
            if (!s || s.type != 1 || s.getName() != 'form')return [];

            var t = [], u = ['style', 'className'];
            for (var v = 0; v < u.length; v++) {
                var w = u[v], x = s.$.elements.namedItem(w);
                if (x) {
                    var y = new h(x);
                    t.push([y, y.nextSibling]);
                    y.remove();
                }
            }
            return t;
        };
        function n(s, t) {
            if (!s || s.type != 1 || s.getName() != 'form')return;
            if (t.length > 0)for (var u = t.length - 1; u >= 0; u--) {
                var v = t[u][0], w = t[u][1];
                if (w)v.insertBefore(w); else v.appendTo(s);
            }
        };
        function o(s, t) {
            var u = m(s), v = {}, w = s.$;
            if (!t) {
                v['class'] = w.className || '';
                w.className = '';
            }
            v.inline = w.style.cssText || '';
            if (!t)w.style.cssText = 'position: static; overflow: visible';
            n(u);
            return v;
        };
        function p(s, t) {
            var u = m(s), v = s.$;
            if ('class' in t)v.className = t['class'];
            if ('inline' in t)v.style.cssText = t.inline;
            n(u);
        };
        function q(s) {
            var t = a.instances;
            for (var u in t) {
                var v = t[u];
                if (v.mode == 'wysiwyg') {
                    var w = v.document.getBody();
                    w.setAttribute('contentEditable', false);
                    w.setAttribute('contentEditable', true);
                }
            }
            if (s.focusManager.hasFocus) {
                s.toolbox.focus();
                s.focus();
            }
        };
        function r(s) {
            if (!c || b.version > 6)return null;
            var t = h.createFromHtml('<iframe frameborder="0" tabindex="-1" src="javascript:void((function(){document.open();' + (b.isCustomDomain() ? "document.domain='" + this.getDocument().$.domain + "';" : '') + 'document.close();' + '})())"' + ' style="display:block;position:absolute;z-index:-1;' + 'progid:DXImageTransform.Microsoft.Alpha(opacity=0);' + '"></iframe>');
            return s.append(t, true);
        };
        j.add('maximize', {
            init: function (s) {
                var t = s.lang, u = a.document, v = u.getWindow(), w, x, y, z;

                function A() {
                    var C = v.getViewPaneSize();
                    z && z.setStyles({width: C.width + 'px', height: C.height + 'px'});
                    s.resize(C.width, C.height, null, true);
                };
                var B = 2;
                s.addCommand('maximize', {
                    modes: {wysiwyg: 1, source: 1}, editorFocus: false, exec: function () {
                        var C = s.container.getChild(1), D = s.getThemeSpace('contents');
                        if (s.mode == 'wysiwyg') {
                            var E = s.getSelection();
                            w = E && E.getRanges();
                            x = v.getScrollPosition();
                        } else {
                            var F = s.textarea.$;
                            w = !c && [F.selectionStart, F.selectionEnd];
                            x = [F.scrollLeft, F.scrollTop];
                        }
                        if (this.state == 2) {
                            v.on('resize', A);
                            y = v.getScrollPosition();
                            var G = s.container;
                            while (G = G.getParent()) {
                                G.setCustomData('maximize_saved_styles', o(G));
                                G.setStyle('z-index', s.config.baseFloatZIndex - 1);
                            }
                            D.setCustomData('maximize_saved_styles', o(D, true));
                            C.setCustomData('maximize_saved_styles', o(C, true));
                            var H = v.getViewPaneSize(), I = {overflow: 'hidden', width: 0, height: 0};
                            u.getDocumentElement().setStyles(I);
                            !b.gecko && u.getDocumentElement().setStyle('position', 'fixed');
                            u.getBody().setStyles(I);
                            c ? setTimeout(function () {
                                v.$.scrollTo(0, 0);
                            }, 0) : v.$.scrollTo(0, 0);
                            C.setStyle('position', 'absolute');
                            C.$.offsetLeft;
                            C.setStyles({'z-index': s.config.baseFloatZIndex - 1, left: '0px', top: '0px'});

                            z = r(C);
                            C.addClass('cke_maximized');
                            A();
                            var J = C.getDocumentPosition();
                            C.setStyles({left: -1 * J.x + 'px', top: -1 * J.y + 'px'});
                            b.gecko && q(s);
                        } else if (this.state == 1) {
                            v.removeListener('resize', A);
                            var K = [D, C];
                            for (var L = 0; L < K.length; L++) {
                                p(K[L], K[L].getCustomData('maximize_saved_styles'));
                                K[L].removeCustomData('maximize_saved_styles');
                            }
                            G = s.container;
                            while (G = G.getParent()) {
                                p(G, G.getCustomData('maximize_saved_styles'));
                                G.removeCustomData('maximize_saved_styles');
                            }
                            c ? setTimeout(function () {
                                v.$.scrollTo(y.x, y.y);
                            }, 0) : v.$.scrollTo(y.x, y.y);
                            C.removeClass('cke_maximized');
                            if (z) {
                                z.remove();
                                z = null;
                            }
                            s.fire('resize');
                        }
                        this.toggleState();
                        var M = this.uiItems[0], N = this.state == 2 ? t.maximize : t.minimize, O = s.element.getDocument().getById(M._.id);
                        O.getChild(1).setHtml(N);
                        O.setAttribute('title', N);
                        O.setAttribute('href', 'javascript:void("' + N + '");');
                        if (s.mode == 'wysiwyg') {
                            if (w) {
                                b.gecko && q(s);
                                s.getSelection().selectRanges(w);
                                var P = s.getSelection().getStartElement();
                                P && P.scrollIntoView(true);
                            } else v.$.scrollTo(x.x, x.y);
                        } else {
                            if (w) {
                                F.selectionStart = w[0];
                                F.selectionEnd = w[1];
                            }
                            F.scrollLeft = x[0];
                            F.scrollTop = x[1];
                        }
                        w = x = null;
                        B = this.state;
                    }, canUndo: false
                });
                s.ui.addButton('Maximize', {label: t.maximize, command: 'maximize'});
                s.on('mode', function () {
                    var C = s.getCommand('maximize');
                    C.setState(C.state == 0 ? 0 : B);
                }, null, null, 100);
            }
        });
    })();
    j.add('newpage', {
        init: function (m) {
            m.addCommand('newpage', {
                modes: {wysiwyg: 1, source: 1}, exec: function (n) {
                    var o = this;
                    n.setData(n.config.newpage_html || '', function () {
                        setTimeout(function () {
                            n.fire('afterCommandExec', {name: o.name, command: o});
                        }, 200);
                    });
                    n.focus();
                }, async: true
            });
            m.ui.addButton('NewPage', {label: m.lang.newPage, command: 'newpage'});
        }
    });
    j.add('pagebreak', {
        init: function (m) {
            m.addCommand('pagebreak', j.pagebreakCmd);
            m.ui.addButton('PageBreak', {label: m.lang.pagebreak, command: 'pagebreak'});
            m.addCss('img.cke_pagebreak{background-image: url(' + a.getUrl(this.path + 'images/pagebreak.gif') + ');' + 'background-position: center center;' + 'background-repeat: no-repeat;' + 'clear: both;' + 'display: block;' + 'float: none;' + 'width:100% !important; _width:99.9% !important;' + 'border-top: #999999 1px dotted;' + 'border-bottom: #999999 1px dotted;' + 'height: 5px !important;' + 'page-break-after: always;' + '}');
        }, afterInit: function (m) {
            var n = m.dataProcessor, o = n && n.dataFilter;
            if (o)o.addRules({
                elements: {
                    div: function (p) {
                        var q = p.attributes, r = q && q.style, s = r && p.children.length == 1 && p.children[0], t = s && s.name == 'span' && s.attributes.style;
                        if (t && /page-break-after\s*:\s*always/i.test(r) && /display\s*:\s*none/i.test(t)) {
                            var u = m.createFakeParserElement(p, 'cke_pagebreak', 'div'), v = m.lang.pagebreakAlt;

                            u.attributes.alt = v;
                            u.attributes['aria-label'] = v;
                            return u;
                        }
                    }
                }
            });
        }, requires: ['fakeobjects']
    });
    j.pagebreakCmd = {
        exec: function (m) {
            var n = m.lang.pagebreakAlt, o = h.createFromHtml('<div style="page-break-after: always;"><span style="display: none;">&nbsp;</span></div>');
            o = m.createFakeElement(o, 'cke_pagebreak', 'div');
            o.setAttributes({alt: n, 'aria-label': n, title: n});
            var p = m.getSelection().getRanges(true);
            m.fire('saveSnapshot');
            for (var q, r = p.length - 1; r >= 0; r--) {
                q = p[r];
                if (r < p.length - 1)o = o.clone(true);
                q.splitBlock('p');
                q.insertNode(o);
                if (r == p.length - 1) {
                    q.moveToPosition(o, 4);
                    q.select();
                }
                var s = o.getPrevious();
                if (s && f[s.getName()].div)o.move(s);
            }
            m.fire('saveSnapshot');
        }
    };
    (function () {
        j.add('pastefromword', {
            init: function (m) {
                var n = 0, o = function () {
                    setTimeout(function () {
                        n = 0;
                    }, 0);
                };
                m.addCommand('pastefromword', {
                    canUndo: false, exec: function () {
                        n = 1;
                        if (m.execCommand('paste') === false)m.on('dialogHide', function (p) {
                            p.removeListener();
                            o();
                        }); else o();
                    }
                });
                m.ui.addButton('PasteFromWord', {label: m.lang.pastefromword.toolbar, command: 'pastefromword'});
                m.on('paste', function (p) {
                    var q = p.data, r;
                    if ((r = q.html) && (n || /(class=\"?Mso|style=\"[^\"]*\bmso\-|w:WordDocument)/.test(r))) {
                        var s = this.loadFilterRules(function () {
                            if (s)m.fire('paste', q); else if (!m.config.pasteFromWordPromptCleanup || n || confirm(m.lang.pastefromword.confirmCleanup))q.html = a.cleanWord(r, m);
                        });
                        s && p.cancel();
                    }
                }, this);
            }, loadFilterRules: function (m) {
                var n = a.cleanWord;
                if (n)m(); else {
                    var o = a.getUrl(i.pasteFromWordCleanupFile || this.path + 'filter/default.js');
                    a.scriptLoader.load(o, m, null, false, true);
                }
                return !n;
            }
        });
    })();
    (function () {
        var m = {
            exec: function (n) {
                var o = e.tryThese(function () {
                    var p = window.clipboardData.getData('Text');
                    if (!p)throw 0;
                    return p;
                });
                if (!o) {
                    n.openDialog('pastetext');
                    return false;
                } else n.fire('paste', {text: o});
                return true;
            }
        };
        j.add('pastetext', {
            init: function (n) {
                var o = 'pastetext', p = n.addCommand(o, m);
                n.ui.addButton('PasteText', {label: n.lang.pasteText.button, command: o});
                a.dialog.add(o, a.getUrl(this.path + 'dialogs/pastetext.js'));
                if (n.config.forcePasteAsPlainText)n.on('beforeCommandExec', function (q) {
                    if (q.data.name == 'paste') {
                        n.execCommand('pastetext');
                        q.cancel();
                    }
                }, null, null, 0);
            }, requires: ['clipboard']
        });
    })();
    j.add('popup');
    e.extend(a.editor.prototype, {
        popup: function (m, n, o, p) {
            n = n || '80%';
            o = o || '70%';
            if (typeof n == 'string' && n.length > 1 && n.substr(n.length - 1, 1) == '%')n = parseInt(window.screen.width * parseInt(n, 10) / 100, 10);
            if (typeof o == 'string' && o.length > 1 && o.substr(o.length - 1, 1) == '%')o = parseInt(window.screen.height * parseInt(o, 10) / 100, 10);
            if (n < 640)n = 640;
            if (o < 420)o = 420;

            var q = parseInt((window.screen.height - o) / 2, 10), r = parseInt((window.screen.width - n) / 2, 10);
            p = (p || 'location=no,menubar=no,toolbar=no,dependent=yes,minimizable=no,modal=yes,alwaysRaised=yes,resizable=yes,scrollbars=yes') + ',width=' + n + ',height=' + o + ',top=' + q + ',left=' + r;
            var s = window.open('', null, p, true);
            if (!s)return false;
            try {
                s.moveTo(r, q);
                s.resizeTo(n, o);
                s.focus();
                s.location.href = m;
            } catch (t) {
                s = window.open(m, null, p, true);
            }
            return true;
        }
    });
    (function () {
        var m = {
            modes: {wysiwyg: 1, source: 1}, canUndo: false, exec: function (o) {
                var p, q = o.config, r = q.baseHref ? '<base href="' + q.baseHref + '"/>' : '', s = b.isCustomDomain();
                if (q.fullPage)p = o.getData().replace(/<head>/, '$&' + r).replace(/[^>]*(?=<\/title>)/, o.lang.preview); else {
                    var t = '<body ', u = o.document && o.document.getBody();
                    if (u) {
                        if (u.getAttribute('id'))t += 'id="' + u.getAttribute('id') + '" ';
                        if (u.getAttribute('class'))t += 'class="' + u.getAttribute('class') + '" ';
                    }
                    t += '>';
                    p = o.config.docType + '<html dir="' + o.config.contentsLangDirection + '">' + '<head>' + r + '<title>' + o.lang.preview + '</title>' + e.buildStyleHtml(o.config.contentsCss) + '</head>' + t + o.getData() + '</body></html>';
                }
                var v = 640, w = 420, x = 80;
                try {
                    var y = window.screen;
                    v = Math.round(y.width * 0.8);
                    w = Math.round(y.height * 0.7);
                    x = Math.round(y.width * 0.1);
                } catch (B) {
                }
                var z = '';
                if (s) {
                    window._cke_htmlToLoad = p;
                    z = 'javascript:void( (function(){document.open();document.domain="' + document.domain + '";' + 'document.write( window.opener._cke_htmlToLoad );' + 'document.close();' + 'window.opener._cke_htmlToLoad = null;' + '})() )';
                }
                var A = window.open(z, null, 'toolbar=yes,location=no,status=yes,menubar=yes,scrollbars=yes,resizable=yes,width=' + v + ',height=' + w + ',left=' + x);
                if (!s) {
                    A.document.open();
                    A.document.write(p);
                    A.document.close();
                }
            }
        }, n = 'preview';
        j.add(n, {
            init: function (o) {
                o.addCommand(n, m);
                o.ui.addButton('Preview', {label: o.lang.preview, command: n});
            }
        });
    })();
    j.add('print', {
        init: function (m) {
            var n = 'print', o = m.addCommand(n, j.print);
            m.ui.addButton('Print', {label: m.lang.print, command: n});
        }
    });
    j.print = {
        exec: function (m) {
            if (b.opera)return; else if (b.gecko)m.window.$.print(); else m.document.$.execCommand('Print');
        }, canUndo: false, modes: {wysiwyg: !b.opera}
    };
    j.add('removeformat', {
        requires: ['selection'], init: function (m) {
            m.addCommand('removeFormat', j.removeformat.commands.removeformat);
            m.ui.addButton('RemoveFormat', {label: m.lang.removeFormat, command: 'removeFormat'});
            m._.removeFormat = {filters: []};
        }
    });
    j.removeformat = {
        commands: {
            removeformat: {
                exec: function (m) {
                    var n = m._.removeFormatRegex || (m._.removeFormatRegex = new RegExp('^(?:' + m.config.removeFormatTags.replace(/,/g, '|') + ')$', 'i')), o = m._.removeAttributes || (m._.removeAttributes = m.config.removeFormatAttributes.split(',')), p = j.removeformat.filter, q = m.getSelection().getRanges(1), r = q.createIterator(), s;

                    while (s = r.getNextRange()) {
                        if (s.collapsed)continue;
                        s.enlarge(1);
                        var t = s.createBookmark(), u = t.startNode, v = t.endNode, w = function (z) {
                            var A = new d.elementPath(z), B = A.elements;
                            for (var C = 1, D; D = B[C]; C++) {
                                if (D.equals(A.block) || D.equals(A.blockLimit))break;
                                if (n.test(D.getName()) && p(m, D))z.breakParent(D);
                            }
                        };
                        w(u);
                        w(v);
                        var x = u.getNextSourceNode(true, 1);
                        while (x) {
                            if (x.equals(v))break;
                            var y = x.getNextSourceNode(false, 1);
                            if (!(x.getName() == 'img' && x.data('cke-realelement')) && p(m, x))if (n.test(x.getName()))x.remove(1); else {
                                x.removeAttributes(o);
                                m.fire('removeFormatCleanup', x);
                            }
                            x = y;
                        }
                        s.moveToBookmark(t);
                    }
                    m.getSelection().selectRanges(q);
                }
            }
        }, filter: function (m, n) {
            var o = m._.removeFormat.filters;
            for (var p = 0; p < o.length; p++) {
                if (o[p](n) === false)return false;
            }
            return true;
        }
    };
    a.editor.prototype.addRemoveFormatFilter = function (m) {
        this._.removeFormat.filters.push(m);
    };
    i.removeFormatTags = 'b,big,code,del,dfn,em,font,i,ins,kbd,q,samp,small,span,strike,strong,sub,sup,tt,u,var';
    i.removeFormatAttributes = 'class,style,lang,width,height,align,hspace,valign';
    j.add('resize', {
        init: function (m) {
            var n = m.config;
            !n.resize_dir && (n.resize_dir = 'both');
            n.resize_maxWidth == undefined && (n.resize_maxWidth = 3000);
            n.resize_maxHeight == undefined && (n.resize_maxHeight = 3000);
            n.resize_minWidth == undefined && (n.resize_minWidth = 750);
            n.resize_minHeight == undefined && (n.resize_minHeight = 250);
            if (n.resize_enabled !== false) {
                var o = null, p, q, r = (n.resize_dir == 'both' || n.resize_dir == 'horizontal') && n.resize_minWidth != n.resize_maxWidth, s = (n.resize_dir == 'both' || n.resize_dir == 'vertical') && n.resize_minHeight != n.resize_maxHeight;

                function t(w) {
                    var x = w.data.$.screenX - p.x, y = w.data.$.screenY - p.y, z = q.width, A = q.height, B = z + x * (m.lang.dir == 'rtl' ? -1 : 1), C = A + y;
                    if (r)z = Math.max(n.resize_minWidth, Math.min(B, n.resize_maxWidth));
                    if (s)A = Math.max(n.resize_minHeight, Math.min(C, n.resize_maxHeight));
                    m.resize(z, A);
                };
                function u(w) {
                    a.document.removeListener('mousemove', t);
                    a.document.removeListener('mouseup', u);
                    if (m.document) {
                        m.document.removeListener('mousemove', t);
                        m.document.removeListener('mouseup', u);
                    }
                };
                var v = e.addFunction(function (w) {
                    if (!o)o = m.getResizable();
                    q = {width: o.$.offsetWidth || 0, height: o.$.offsetHeight || 0};
                    p = {x: w.screenX, y: w.screenY};
                    n.resize_minWidth > q.width && (n.resize_minWidth = q.width);
                    n.resize_minHeight > q.height && (n.resize_minHeight = q.height);
                    a.document.on('mousemove', t);
                    a.document.on('mouseup', u);
                    if (m.document) {
                        m.document.on('mousemove', t);
                        m.document.on('mouseup', u);
                    }
                });
                m.on('destroy', function () {
                    e.removeFunction(v);
                });
                m.on('themeSpace', function (w) {
                    if (w.data.space == 'bottom') {
                        var x = '';

                        if (r && !s)x = ' cke_resizer_horizontal';
                        if (!r && s)x = ' cke_resizer_vertical';
                        w.data.html += '<div class="cke_resizer' + x + '"' + ' title="' + e.htmlEncode(m.lang.resize) + '"' + ' onmousedown="CKEDITOR.tools.callFunction(' + v + ', event)"' + '></div>';
                    }
                }, m, null, 100);
            }
        }
    });
    (function () {
        var m = {
            modes: {wysiwyg: 1, source: 1}, exec: function (o) {
                var p = o.element.$.form;
                if (p)try {
                    p.submit();
                } catch (q) {
                    if (p.submit.click)p.submit.click();
                }
            }
        }, n = 'save';
        j.add(n, {
            init: function (o) {
                var p = o.addCommand(n, m);
                p.modes = {wysiwyg: !!o.element.$.form};
                o.ui.addButton('Save', {label: o.lang.save, command: n});
            }
        });
    })();
    (function () {
        var m = 'scaytcheck', n = '';

        function o(t, u) {
            var v = 0, w;
            for (w in u) {
                if (u[w] == t) {
                    v = 1;
                    break;
                }
            }
            return v;
        };
        var p = function () {
            var t = this, u = function () {
                var y = t.config, z = {};
                z.srcNodeRef = t.document.getWindow().$.frameElement;
                z.assocApp = 'CKEDITOR.' + a.version + '@' + a.revision;
                z.customerid = y.scayt_customerid || '1:WvF0D4-UtPqN1-43nkD4-NKvUm2-daQqk3-LmNiI-z7Ysb4-mwry24-T8YrS3-Q2tpq2';
                z.customDictionaryIds = y.scayt_customDictionaryIds || '';
                z.userDictionaryName = y.scayt_userDictionaryName || '';
                z.sLang = y.scayt_sLang || 'en_US';
                z.onLoad = function () {
                    if (!(c && b.version < 8))this.addStyle(this.selectorCss(), 'padding-bottom: 2px !important;');
                    if (t.focusManager.hasFocus && !q.isControlRestored(t))this.focus();
                };
                z.onBeforeChange = function () {
                    if (q.getScayt(t) && !t.checkDirty())setTimeout(function () {
                        t.resetDirty();
                    }, 0);
                };
                var A = window.scayt_custom_params;
                if (typeof A == 'object')for (var B in A)z[B] = A[B];
                if (q.getControlId(t))z.id = q.getControlId(t);
                var C = new window.scayt(z);
                C.afterMarkupRemove.push(function (J) {
                    new h(J, C.document).mergeSiblings();
                });
                var D = q.instances[t.name];
                if (D) {
                    C.sLang = D.sLang;
                    C.option(D.option());
                    C.paused = D.paused;
                }
                q.instances[t.name] = C;
                var E = 'scaytButton', F = window.scayt.uiTags, G = [];
                for (var H = 0, I = 4; H < I; H++)G.push(F[H] && q.uiTabs[H]);
                q.uiTabs = G;
                try {
                    C.setDisabled(q.isPaused(t) === false);
                } catch (J) {
                }
                t.fire('showScaytState');
            };
            t.on('contentDom', u);
            t.on('contentDomUnload', function () {
                var y = a.document.getElementsByTag('script'), z = /^dojoIoScript(\d+)$/i, A = /^https?:\/\/svc\.spellchecker\.net\/spellcheck\/script\/ssrv\.cgi/i;
                for (var B = 0; B < y.count(); B++) {
                    var C = y.getItem(B), D = C.getId(), E = C.getAttribute('src');
                    if (D && E && D.match(z) && E.match(A))C.remove();
                }
            });
            t.on('beforeCommandExec', function (y) {
                if ((y.data.name == 'source' || y.data.name == 'newpage') && t.mode == 'wysiwyg') {
                    var z = q.getScayt(t);
                    if (z) {
                        q.setPaused(t, !z.disabled);
                        q.setControlId(t, z.id);
                        z.destroy(true);
                        delete q.instances[t.name];
                    }
                } else if (y.data.name == 'source' && t.mode == 'source')q.markControlRestore(t);

            });
            t.on('afterCommandExec', function (y) {
                if (!q.isScaytEnabled(t))return;
                if (t.mode == 'wysiwyg' && (y.data.name == 'undo' || y.data.name == 'redo'))window.setTimeout(function () {
                    q.getScayt(t).refresh();
                }, 10);
            });
            t.on('destroy', function (y) {
                var z = y.editor, A = q.getScayt(z);
                if (!A)return;
                delete q.instances[z.name];
                q.setControlId(z, A.id);
                A.destroy(true);
            });
            t.on('afterSetData', function () {
                if (q.isScaytEnabled(t))window.setTimeout(function () {
                    var y = q.getScayt(t);
                    y && y.refresh();
                }, 10);
            });
            t.on('insertElement', function () {
                var y = q.getScayt(t);
                if (q.isScaytEnabled(t)) {
                    if (c)t.getSelection().unlock(true);
                    window.setTimeout(function () {
                        y.focus();
                        y.refresh();
                    }, 10);
                }
            }, this, null, 50);
            t.on('insertHtml', function () {
                var y = q.getScayt(t);
                if (q.isScaytEnabled(t)) {
                    if (c)t.getSelection().unlock(true);
                    window.setTimeout(function () {
                        y.focus();
                        y.refresh();
                    }, 10);
                }
            }, this, null, 50);
            t.on('scaytDialog', function (y) {
                y.data.djConfig = window.djConfig;
                y.data.scayt_control = q.getScayt(t);
                y.data.tab = n;
                y.data.scayt = window.scayt;
            });
            var v = t.dataProcessor, w = v && v.htmlFilter;
            if (w)w.addRules({
                elements: {
                    span: function (y) {
                        if (y.attributes['data-scayt_word'] && y.attributes['data-scaytid']) {
                            delete y.name;
                            return y;
                        }
                    }
                }
            });
            var x = j.undo.Image.prototype;
            x.equals = e.override(x.equals, function (y) {
                return function (z) {
                    var E = this;
                    var A = E.contents, B = z.contents, C = q.getScayt(E.editor);
                    if (C && q.isScaytReady(E.editor)) {
                        E.contents = C.reset(A) || '';
                        z.contents = C.reset(B) || '';
                    }
                    var D = y.apply(E, arguments);
                    E.contents = A;
                    z.contents = B;
                    return D;
                };
            });
            if (t.document)u();
        };
        j.scayt = {
            engineLoaded: false, instances: {}, controlInfo: {}, setControlInfo: function (t, u) {
                if (t && t.name && typeof this.controlInfo[t.name] != 'object')this.controlInfo[t.name] = {};
                for (var v in u)this.controlInfo[t.name][v] = u[v];
            }, isControlRestored: function (t) {
                if (t && t.name && this.controlInfo[t.name])return this.controlInfo[t.name].restored;
                return false;
            }, markControlRestore: function (t) {
                this.setControlInfo(t, {restored: true});
            }, setControlId: function (t, u) {
                this.setControlInfo(t, {id: u});
            }, getControlId: function (t) {
                if (t && t.name && this.controlInfo[t.name] && this.controlInfo[t.name].id)return this.controlInfo[t.name].id;
                return null;
            }, setPaused: function (t, u) {
                this.setControlInfo(t, {paused: u});
            }, isPaused: function (t) {
                if (t && t.name && this.controlInfo[t.name])return this.controlInfo[t.name].paused;
                return undefined;
            }, getScayt: function (t) {
                return this.instances[t.name];
            }, isScaytReady: function (t) {
                return this.engineLoaded === true && 'undefined' !== typeof window.scayt && this.getScayt(t);
            }, isScaytEnabled: function (t) {
                var u = this.getScayt(t);
                return u ? u.disabled === false : false;

            }, loadEngine: function (t) {
                if (b.gecko && b.version < 10900 || b.opera || b.air)return t.fire('showScaytState');
                if (this.engineLoaded === true)return p.apply(t); else if (this.engineLoaded == -1)return a.on('scaytReady', function () {
                    p.apply(t);
                });
                a.on('scaytReady', p, t);
                a.on('scaytReady', function () {
                    this.engineLoaded = true;
                }, this, null, 0);
                this.engineLoaded = -1;
                var u = document.location.protocol;
                u = u.search(/https?:/) != -1 ? u : 'http:';
                var v = 'svc.spellchecker.net/scayt26/loader__base.js', w = t.config.scayt_srcUrl || u + '//' + v, x = q.parseUrl(w).path + '/';
                if (window.scayt == undefined) {
                    a._djScaytConfig = {
                        baseUrl: x, addOnLoad: [function () {
                            a.fireOnce('scaytReady');
                        }], isDebug: false
                    };
                    a.document.getHead().append(a.document.createElement('script', {
                        attributes: {
                            type: 'text/javascript',
                            async: 'true',
                            src: w
                        }
                    }));
                } else a.fireOnce('scaytReady');
                return null;
            }, parseUrl: function (t) {
                var u;
                if (t.match && (u = t.match(/(.*)[\/\\](.*?\.\w+)$/)))return {path: u[1], file: u[2]}; else return t;
            }
        };
        var q = j.scayt, r = function (t, u, v, w, x, y, z) {
            t.addCommand(w, x);
            t.addMenuItem(w, {label: v, command: w, group: y, order: z});
        }, s = {
            preserveState: true, editorFocus: false, canUndo: false, exec: function (t) {
                if (q.isScaytReady(t)) {
                    var u = q.isScaytEnabled(t);
                    this.setState(u ? 2 : 1);
                    var v = q.getScayt(t);
                    v.focus();
                    v.setDisabled(u);
                } else if (!t.config.scayt_autoStartup && q.engineLoaded >= 0) {
                    this.setState(0);
                    q.loadEngine(t);
                }
            }
        };
        j.add('scayt', {
            requires: ['menubutton'], beforeInit: function (t) {
                var u = t.config.scayt_contextMenuItemsOrder || 'suggest|moresuggest|control', v = '';
                u = u.split('|');
                if (u && u.length)for (var w = 0; w < u.length; w++)v += 'scayt_' + u[w] + (u.length != parseInt(w, 10) + 1 ? ',' : '');
                t.config.menu_groups = v + ',' + t.config.menu_groups;
            }, init: function (t) {
                var u = {}, v = {}, w = t.addCommand(m, s);
                a.dialog.add(m, a.getUrl(this.path + 'dialogs/options.js'));
                var x = t.config.scayt_uiTabs || '1,1,1', y = [];
                x = x.split(',');
                for (var z = 0, A = 3; z < A; z++) {
                    var B = parseInt(x[z] || '1', 10);
                    y.push(B);
                }
                var C = 'scaytButton';
                t.addMenuGroup(C);
                var D = {}, E = t.lang.scayt;
                D.scaytToggle = {label: E.enable, command: m, group: C};
                if (y[0] == 1)D.scaytOptions = {
                    label: E.options, group: C, onClick: function () {
                        n = 'options';
                        t.openDialog(m);
                    }
                };
                if (y[1] == 1)D.scaytLangs = {
                    label: E.langs, group: C, onClick: function () {
                        n = 'langs';
                        t.openDialog(m);
                    }
                };
                if (y[2] == 1)D.scaytDict = {
                    label: E.dictionariesTab, group: C, onClick: function () {
                        n = 'dictionaries';
                        t.openDialog(m);
                    }
                };
                D.scaytAbout = {
                    label: t.lang.scayt.about, group: C, onClick: function () {
                        n = 'about';
                        t.openDialog(m);
                    }
                };
                y[3] = 1;
                q.uiTabs = y;
                t.addMenuItems(D);
                t.ui.add('Scayt', 5, {
                    label: E.title,
                    title: b.opera ? E.opera_title : E.title,
                    className: 'cke_button_scayt',
                    modes: {wysiwyg: 1},
                    onRender: function () {
                        w.on('state', function () {
                            this.setState(w.state);

                        }, this);
                    },
                    onMenu: function () {
                        var G = q.isScaytEnabled(t);
                        t.getMenuItem('scaytToggle').label = E[G ? 'disable' : 'enable'];
                        return {
                            scaytToggle: 2,
                            scaytOptions: G && q.uiTabs[0] ? 2 : 0,
                            scaytLangs: G && q.uiTabs[1] ? 2 : 0,
                            scaytDict: G && q.uiTabs[2] ? 2 : 0,
                            scaytAbout: G && q.uiTabs[3] ? 2 : 0
                        };
                    }
                });
                if (t.contextMenu && t.addMenuItems)t.contextMenu.addListener(function (G, H) {
                    if (!q.isScaytEnabled(t) || H.getCommonAncestor().isReadOnly())return null;
                    var I = q.getScayt(t), J = I.getScaytNode();
                    if (!J)return null;
                    var K = I.getWord(J);
                    if (!K)return null;
                    var L = I.getLang(), M = {}, N = window.scayt.getSuggestion(K, L);
                    if (!N || !N.length)return null;
                    for (z in u) {
                        delete t._.menuItems[z];
                        delete t._.commands[z];
                    }
                    for (z in v) {
                        delete t._.menuItems[z];
                        delete t._.commands[z];
                    }
                    u = {};
                    v = {};
                    var O = t.config.scayt_moreSuggestions || 'on', P = false, Q = t.config.scayt_maxSuggestions;
                    typeof Q != 'number' && (Q = 5);
                    !Q && (Q = N.length);
                    var R = t.config.scayt_contextCommands || 'all';
                    R = R.split('|');
                    for (var S = 0, T = N.length; S < T; S += 1) {
                        var U = 'scayt_suggestion_' + N[S].replace(' ', '_'), V = (function (Z, aa) {
                            return {
                                exec: function () {
                                    I.replace(Z, aa);
                                }
                            };
                        })(J, N[S]);
                        if (S < Q) {
                            r(t, 'button_' + U, N[S], U, V, 'scayt_suggest', S + 1);
                            M[U] = 2;
                            v[U] = 2;
                        } else if (O == 'on') {
                            r(t, 'button_' + U, N[S], U, V, 'scayt_moresuggest', S + 1);
                            u[U] = 2;
                            P = true;
                        }
                    }
                    if (P) {
                        t.addMenuItem('scayt_moresuggest', {
                            label: E.moreSuggestions,
                            group: 'scayt_moresuggest',
                            order: 10,
                            getItems: function () {
                                return u;
                            }
                        });
                        v.scayt_moresuggest = 2;
                    }
                    if (o('all', R) || o('ignore', R)) {
                        var W = {
                            exec: function () {
                                I.ignore(J);
                            }
                        };
                        r(t, 'ignore', E.ignore, 'scayt_ignore', W, 'scayt_control', 1);
                        v.scayt_ignore = 2;
                    }
                    if (o('all', R) || o('ignoreall', R)) {
                        var X = {
                            exec: function () {
                                I.ignoreAll(J);
                            }
                        };
                        r(t, 'ignore_all', E.ignoreAll, 'scayt_ignore_all', X, 'scayt_control', 2);
                        v.scayt_ignore_all = 2;
                    }
                    if (o('all', R) || o('add', R)) {
                        var Y = {
                            exec: function () {
                                window.scayt.addWordToUserDictionary(J);
                            }
                        };
                        r(t, 'add_word', E.addWord, 'scayt_add_word', Y, 'scayt_control', 3);
                        v.scayt_add_word = 2;
                    }
                    if (I.fireOnContextMenu)I.fireOnContextMenu(t);
                    return v;
                });
                var F = function () {
                    t.removeListener('showScaytState', F);
                    if (!b.opera && !b.air)w.setState(q.isScaytEnabled(t) ? 1 : 2); else w.setState(0);
                };
                t.on('showScaytState', F);
                if (b.opera || b.air)t.on('instanceReady', function () {
                    F();
                });
                if (t.config.scayt_autoStartup)t.on('instanceReady', function () {
                    q.loadEngine(t);
                });
            }, afterInit: function (t) {
                var u, v = function (w) {
                    if (w.hasAttribute('data-scaytid'))return false;
                };
                if (t._.elementsPath && (u = t._.elementsPath.filters))u.push(v);
                t.addRemoveFormatFilter && t.addRemoveFormatFilter(v);
            }
        });
    })();
    j.add('smiley', {
        requires: ['dialog'], init: function (m) {
            m.config.smiley_path = m.config.smiley_path || this.path + 'images/';

            m.addCommand('smiley', new a.dialogCommand('smiley'));
            m.ui.addButton('Smiley', {label: m.lang.smiley.toolbar, command: 'smiley'});
            a.dialog.add('smiley', this.path + 'dialogs/smiley.js');
        }
    });
    i.smiley_images = ['regular_smile.gif', 'sad_smile.gif', 'wink_smile.gif', 'teeth_smile.gif', 'confused_smile.gif', 'tounge_smile.gif', 'embaressed_smile.gif', 'omg_smile.gif', 'whatchutalkingabout_smile.gif', 'angry_smile.gif', 'angel_smile.gif', 'shades_smile.gif', 'devil_smile.gif', 'cry_smile.gif', 'lightbulb.gif', 'thumbs_down.gif', 'thumbs_up.gif', 'heart.gif', 'broken_heart.gif', 'kiss.gif', 'envelope.gif'];
    i.smiley_descriptions = ['smiley', 'sad', 'wink', 'laugh', 'frown', 'cheeky', 'blush', 'surprise', 'indecision', 'angry', 'angel', 'cool', 'devil', 'crying', 'enlightened', 'no', 'yes', 'heart', 'broken heart', 'kiss', 'mail'];
    (function () {
        var m = '.%2 p,.%2 div,.%2 pre,.%2 address,.%2 blockquote,.%2 h1,.%2 h2,.%2 h3,.%2 h4,.%2 h5,.%2 h6{background-repeat: no-repeat;background-position: top %3;border: 1px dotted gray;padding-top: 8px;padding-%3: 8px;}.%2 p{%1p.png);}.%2 div{%1div.png);}.%2 pre{%1pre.png);}.%2 address{%1address.png);}.%2 blockquote{%1blockquote.png);}.%2 h1{%1h1.png);}.%2 h2{%1h2.png);}.%2 h3{%1h3.png);}.%2 h4{%1h4.png);}.%2 h5{%1h5.png);}.%2 h6{%1h6.png);}', n = /%1/g, o = /%2/g, p = /%3/g, q = {
            preserveState: true,
            editorFocus: false,
            exec: function (r) {
                this.toggleState();
                this.refresh(r);
            },
            refresh: function (r) {
                var s = this.state == 1 ? 'addClass' : 'removeClass';
                r.document.getBody()[s]('cke_show_blocks');
            }
        };
        j.add('showblocks', {
            requires: ['wysiwygarea'], init: function (r) {
                var s = r.addCommand('showblocks', q);
                s.canUndo = false;
                if (r.config.startupOutlineBlocks)s.setState(1);
                r.addCss(m.replace(n, 'background-image: url(' + a.getUrl(this.path) + 'images/block_').replace(o, 'cke_show_blocks ').replace(p, r.lang.dir == 'rtl' ? 'right' : 'left'));
                r.ui.addButton('ShowBlocks', {label: r.lang.showBlocks, command: 'showblocks'});
                r.on('mode', function () {
                    if (s.state != 0)s.refresh(r);
                });
                r.on('contentDom', function () {
                    if (s.state != 0)s.refresh(r);
                });
            }
        });
    })();
    (function () {
        var m = 'cke_show_border', n, o = (b.ie6Compat ? ['.%1 table.%2,', '.%1 table.%2 td, .%1 table.%2 th,', '{', 'border : #d3d3d3 1px dotted', '}'] : ['.%1 table.%2,', '.%1 table.%2 > tr > td, .%1 table.%2 > tr > th,', '.%1 table.%2 > tbody > tr > td, .%1 table.%2 > tbody > tr > th,', '.%1 table.%2 > thead > tr > td, .%1 table.%2 > thead > tr > th,', '.%1 table.%2 > tfoot > tr > td, .%1 table.%2 > tfoot > tr > th', '{', 'border : #d3d3d3 1px dotted', '}']).join('');
        n = o.replace(/%2/g, m).replace(/%1/g, 'cke_show_borders ');
        var p = {
            preserveState: true, editorFocus: false, exec: function (q) {
                this.toggleState();

                this.refresh(q);
            }, refresh: function (q) {
                var r = this.state == 1 ? 'addClass' : 'removeClass';
                q.document.getBody()[r]('cke_show_borders');
            }
        };
        j.add('showborders', {
            requires: ['wysiwygarea'], modes: {wysiwyg: 1}, init: function (q) {
                var r = q.addCommand('showborders', p);
                r.canUndo = false;
                if (q.config.startupShowBorders !== false)r.setState(1);
                q.addCss(n);
                q.on('mode', function () {
                    if (r.state != 0)r.refresh(q);
                }, null, null, 100);
                q.on('contentDom', function () {
                    if (r.state != 0)r.refresh(q);
                });
                q.on('removeFormatCleanup', function (s) {
                    var t = s.data;
                    if (q.getCommand('showborders').state == 1 && t.is('table') && (!t.hasAttribute('border') || parseInt(t.getAttribute('border'), 10) <= 0))t.addClass(m);
                });
            }, afterInit: function (q) {
                var r = q.dataProcessor, s = r && r.dataFilter, t = r && r.htmlFilter;
                if (s)s.addRules({
                    elements: {
                        table: function (u) {
                            var v = u.attributes, w = v['class'], x = parseInt(v.border, 10);
                            if (!x || x <= 0)v['class'] = (w || '') + ' ' + m;
                        }
                    }
                });
                if (t)t.addRules({
                    elements: {
                        table: function (u) {
                            var v = u.attributes, w = v['class'];
                            w && (v['class'] = w.replace(m, '').replace(/\s{2}/, ' ').replace(/^\s+|\s+$/, ''));
                        }
                    }
                });
            }
        });
        a.on('dialogDefinition', function (q) {
            var r = q.data.name;
            if (r == 'table' || r == 'tableProperties') {
                var s = q.data.definition, t = s.getContents('info'), u = t.get('txtBorder'), v = u.commit;
                u.commit = e.override(v, function (y) {
                    return function (z, A) {
                        y.apply(this, arguments);
                        var B = parseInt(this.getValue(), 10);
                        A[!B || B <= 0 ? 'addClass' : 'removeClass'](m);
                    };
                });
                var w = s.getContents('advanced'), x = w && w.get('advCSSClasses');
                if (x) {
                    x.setup = e.override(x.setup, function (y) {
                        return function () {
                            y.apply(this, arguments);
                            this.setValue(this.getValue().replace(/cke_show_border/, ''));
                        };
                    });
                    x.commit = e.override(x.commit, function (y) {
                        return function (z, A) {
                            y.apply(this, arguments);
                            if (!parseInt(A.getAttribute('border'), 10))A.addClass('cke_show_border');
                        };
                    });
                }
            }
        });
    })();
    j.add('sourcearea', {
        requires: ['editingblock'], init: function (m) {
            var n = j.sourcearea, o = a.document.getWindow();
            m.on('editingBlockReady', function () {
                var p, q;
                m.addMode('source', {
                    load: function (r, s) {
                        if (c && b.version < 8)r.setStyle('position', 'relative');
                        m.textarea = p = new h('textarea');
                        p.setAttributes({
                            dir: 'ltr',
                            tabIndex: b.webkit ? -1 : m.tabIndex,
                            role: 'textbox',
                            'aria-label': m.lang.editorTitle.replace('%1', m.name)
                        });
                        p.addClass('cke_source');
                        p.addClass('cke_enable_context_menu');
                        var t = {
                            width: b.ie7Compat ? '99%' : '100%',
                            height: '100%',
                            resize: 'none',
                            outline: 'none',
                            'text-align': 'left'
                        };
                        if (c) {
                            q = function () {
                                p.hide();
                                p.setStyle('height', r.$.clientHeight + 'px');
                                p.setStyle('width', r.$.clientWidth + 'px');
                                p.show();
                            };
                            m.on('resize', q);
                            o.on('resize', q);
                            setTimeout(q, 0);
                        }
                        r.setHtml('');

                        r.append(p);
                        p.setStyles(t);
                        m.fire('ariaWidget', p);
                        p.on('blur', function () {
                            m.focusManager.blur();
                        });
                        p.on('focus', function () {
                            m.focusManager.focus();
                        });
                        m.mayBeDirty = true;
                        this.loadData(s);
                        var u = m.keystrokeHandler;
                        if (u)u.attach(p);
                        setTimeout(function () {
                            m.mode = 'source';
                            m.fire('mode');
                        }, b.gecko || b.webkit ? 100 : 0);
                    }, loadData: function (r) {
                        p.setValue(r);
                        m.fire('dataReady');
                    }, getData: function () {
                        return p.getValue();
                    }, getSnapshotData: function () {
                        return p.getValue();
                    }, unload: function (r) {
                        p.clearCustomData();
                        m.textarea = p = null;
                        if (q) {
                            m.removeListener('resize', q);
                            o.removeListener('resize', q);
                        }
                        if (c && b.version < 8)r.removeStyle('position');
                    }, focus: function () {
                        p.focus();
                    }
                });
            });
            m.addCommand('source', n.commands.source);
            if (m.ui.addButton)m.ui.addButton('Source', {label: m.lang.source, command: 'source'});
            m.on('mode', function () {
                m.getCommand('source').setState(m.mode == 'source' ? 1 : 2);
            });
        }
    });
    j.sourcearea = {
        commands: {
            source: {
                modes: {wysiwyg: 1, source: 1}, editorFocus: false, exec: function (m) {
                    if (m.mode == 'wysiwyg')m.fire('saveSnapshot');
                    m.getCommand('source').setState(0);
                    m.setMode(m.mode == 'source' ? 'wysiwyg' : 'source');
                }, canUndo: false
            }
        }
    };
    (function () {
        j.add('stylescombo', {
            requires: ['richcombo', 'styles'], init: function (n) {
                var o = n.config, p = n.lang.stylesCombo, q = {}, r = [];

                function s(t) {
                    n.getStylesSet(function (u) {
                        if (!r.length) {
                            var v, w;
                            for (var x = 0, y = u.length; x < y; x++) {
                                var z = u[x];
                                w = z.name;
                                v = q[w] = new a.style(z);
                                v._name = w;
                                v._.enterMode = o.enterMode;
                                r.push(v);
                            }
                            r.sort(m);
                        }
                        t && t();
                    });
                };
                n.ui.addRichCombo('Styles', {
                    label: p.label,
                    title: p.panelTitle,
                    className: 'cke_styles',
                    panel: {
                        css: n.skin.editor.css.concat(o.contentsCss),
                        multiSelect: true,
                        attributes: {'aria-label': p.panelTitle}
                    },
                    init: function () {
                        var t = this;
                        s(function () {
                            var u, v, w;
                            for (var x = 0, y = r.length; x < y; x++) {
                                u = r[x];
                                v = u._name;
                                var z = u.type;
                                if (z != w) {
                                    t.startGroup(p['panelTitle' + String(z)]);
                                    w = z;
                                }
                                t.add(v, u.type == 3 ? v : u.buildPreview(), v);
                            }
                            t.commit();
                            t.onOpen();
                        });
                    },
                    onClick: function (t) {
                        n.focus();
                        n.fire('saveSnapshot');
                        var u = q[t], v = n.getSelection(), w = new d.elementPath(v.getStartElement());
                        if (u.type == 2 && u.checkActive(w))u.remove(n.document); else if (u.type == 3 && u.checkActive(w))u.remove(n.document); else u.apply(n.document);
                        n.fire('saveSnapshot');
                    },
                    onRender: function () {
                        n.on('selectionChange', function (t) {
                            var u = this.getValue(), v = t.data.path, w = v.elements;
                            for (var x = 0, y = w.length, z; x < y; x++) {
                                z = w[x];
                                for (var A in q) {
                                    if (q[A].checkElementRemovable(z, true)) {
                                        if (A != u)this.setValue(A);
                                        return;
                                    }
                                }
                            }
                            this.setValue('');
                        }, this);
                    },
                    onOpen: function () {
                        var A = this;
                        if (c || b.webkit)n.focus();
                        var t = n.getSelection(), u = t.getSelectedElement(), v = new d.elementPath(u || t.getStartElement()), w = [0, 0, 0, 0];

                        A.showAll();
                        A.unmarkAll();
                        for (var x in q) {
                            var y = q[x], z = y.type;
                            if (y.checkActive(v))A.mark(x); else if (z == 3 && !y.checkApplicable(v)) {
                                A.hideItem(x);
                                w[z]--;
                            }
                            w[z]++;
                        }
                        if (!w[1])A.hideGroup(p['panelTitle' + String(1)]);
                        if (!w[2])A.hideGroup(p['panelTitle' + String(2)]);
                        if (!w[3])A.hideGroup(p['panelTitle' + String(3)]);
                    }
                });
                n.on('instanceReady', function () {
                    s();
                });
            }
        });
        function m(n, o) {
            var p = n.type, q = o.type;
            return p == q ? 0 : p == 3 ? -1 : q == 3 ? 1 : q == 1 ? 1 : -1;
        };
    })();
    j.add('table', {
        init: function (m) {
            var n = j.table, o = m.lang.table;
            m.addCommand('table', new a.dialogCommand('table'));
            m.addCommand('tableProperties', new a.dialogCommand('tableProperties'));
            m.ui.addButton('Table', {label: o.toolbar, command: 'table'});
            a.dialog.add('table', this.path + 'dialogs/table.js');
            a.dialog.add('tableProperties', this.path + 'dialogs/table.js');
            if (m.addMenuItems)m.addMenuItems({
                table: {label: o.menu, command: 'tableProperties', group: 'table', order: 5},
                tabledelete: {label: o.deleteTable, command: 'tableDelete', group: 'table', order: 1}
            });
            m.on('doubleclick', function (p) {
                var q = p.data.element;
                if (q.is('table'))p.data.dialog = 'tableProperties';
            });
            if (m.contextMenu)m.contextMenu.addListener(function (p, q) {
                if (!p || p.isReadOnly())return null;
                var r = p.hasAscendant('table', 1);
                if (r)return {tabledelete: 2, table: 2};
                return null;
            });
        }
    });
    (function () {
        function m(G, H) {
            if (c)G.removeAttribute(H); else delete G[H];
        };
        var n = /^(?:td|th)$/;

        function o(G) {
            var H = G.createBookmarks(), I = G.getRanges(), J = [], K = {};

            function L(T) {
                if (J.length > 0)return;
                if (T.type == 1 && n.test(T.getName()) && !T.getCustomData('selected_cell')) {
                    h.setMarker(K, T, 'selected_cell', true);
                    J.push(T);
                }
            };
            for (var M = 0; M < I.length; M++) {
                var N = I[M];
                if (N.collapsed) {
                    var O = N.getCommonAncestor(), P = O.getAscendant('td', true) || O.getAscendant('th', true);
                    if (P)J.push(P);
                } else {
                    var Q = new d.walker(N), R;
                    Q.guard = L;
                    while (R = Q.next()) {
                        var S = R.getParent();
                        if (S && n.test(S.getName()) && !S.getCustomData('selected_cell')) {
                            h.setMarker(K, S, 'selected_cell', true);
                            J.push(S);
                        }
                    }
                }
            }
            h.clearAllMarkers(K);
            G.selectBookmarks(H);
            return J;
        };
        function p(G) {
            var H = 0, I = G.length - 1, J = {}, K, L, M;
            while (K = G[H++])h.setMarker(J, K, 'delete_cell', true);
            H = 0;
            while (K = G[H++]) {
                if ((L = K.getPrevious()) && !L.getCustomData('delete_cell') || (L = K.getNext()) && !L.getCustomData('delete_cell')) {
                    h.clearAllMarkers(J);
                    return L;
                }
            }
            h.clearAllMarkers(J);
            M = G[0].getParent();
            if (M = M.getPrevious())return M.getLast();
            M = G[I].getParent();
            if (M = M.getNext())return M.getChild(0);
            return null;
        };
        function q(G) {
            var H = G.cells;
            for (var I = 0; I < H.length; I++) {
                H[I].innerHTML = '';
                if (!c)new h(H[I]).appendBogus();
            }
        };
        function r(G, H) {
            var I = G.getStartElement().getAscendant('tr');

            if (!I)return;
            var J = I.clone(1);
            H ? J.insertBefore(I) : J.insertAfter(I);
            q(J.$);
        };
        function s(G) {
            if (G instanceof d.selection) {
                var H = o(G), I = H.length, J = [], K, L, M;
                for (var N = 0; N < I; N++) {
                    var O = H[N].getParent(), P = O.$.rowIndex;
                    !N && (L = P - 1);
                    J[P] = O;
                    N == I - 1 && (M = P + 1);
                }
                var Q = O.getAscendant('table'), R = Q.$.rows, S = R.length;
                K = new h(M < S && Q.$.rows[M] || L > 0 && Q.$.rows[L] || Q.$.parentNode);
                for (N = J.length; N >= 0; N--) {
                    if (J[N])s(J[N]);
                }
                return K;
            } else if (G instanceof h) {
                Q = G.getAscendant('table');
                if (Q.$.rows.length == 1)Q.remove(); else G.remove();
            }
            return 0;
        };
        function t(G, H) {
            var I = G.getStartElement(), J = I.getAscendant('td', 1) || I.getAscendant('th', 1);
            if (!J)return;
            var K = J.getAscendant('table'), L = J.$.cellIndex;
            for (var M = 0; M < K.$.rows.length; M++) {
                var N = K.$.rows[M];
                if (N.cells.length < L + 1)continue;
                J = new h(N.cells[L]).clone(0);
                if (!c)J.appendBogus();
                var O = new h(N.cells[L]);
                if (H)J.insertBefore(O); else J.insertAfter(O);
            }
        };
        function u(G) {
            var H = [], I = G[0] && G[0].getAscendant('table'), J, K, L, M;
            for (J = 0, K = G.length; J < K; J++)H.push(G[J].$.cellIndex);
            H.sort();
            for (J = 1, K = H.length; J < K; J++) {
                if (H[J] - H[J - 1] > 1) {
                    L = H[J - 1] + 1;
                    break;
                }
            }
            if (!L)L = H[0] > 0 ? H[0] - 1 : H[H.length - 1] + 1;
            var N = I.$.rows;
            for (J = 0, K = N.length; J < K; J++) {
                M = N[J].cells[L];
                if (M)break;
            }
            return M ? new h(M) : I.getPrevious();
        };
        function v(G) {
            if (G instanceof d.selection) {
                var H = o(G), I = u(H);
                for (var J = H.length - 1; J >= 0; J--) {
                    if (H[J])v(H[J]);
                }
                return I;
            } else if (G instanceof h) {
                var K = G.getAscendant('table');
                if (!K)return null;
                var L = G.$.cellIndex;
                for (J = K.$.rows.length - 1; J >= 0; J--) {
                    var M = new h(K.$.rows[J]);
                    if (!L && M.$.cells.length == 1) {
                        s(M);
                        continue;
                    }
                    if (M.$.cells[L])M.$.removeChild(M.$.cells[L]);
                }
            }
            return null;
        };
        function w(G, H) {
            var I = G.getStartElement(), J = I.getAscendant('td', 1) || I.getAscendant('th', 1);
            if (!J)return;
            var K = J.clone();
            if (!c)K.appendBogus();
            if (H)K.insertBefore(J); else K.insertAfter(J);
        };
        function x(G) {
            if (G instanceof d.selection) {
                var H = o(G), I = H[0] && H[0].getAscendant('table'), J = p(H);
                for (var K = H.length - 1; K >= 0; K--)x(H[K]);
                if (J)z(J, true); else if (I)I.remove();
            } else if (G instanceof h) {
                var L = G.getParent();
                if (L.getChildCount() == 1)L.remove(); else G.remove();
            }
        };
        function y(G) {
            var H = G.getBogus();
            H && H.remove();
            G.trim();
        };
        function z(G, H) {
            var I = new d.range(G.getDocument());
            if (!I['moveToElementEdit' + (H ? 'End' : 'Start')](G)) {
                I.selectNodeContents(G);
                I.collapse(H ? false : true);
            }
            I.select(true);
        };
        function A(G, H, I) {
            var J = G[H];
            if (typeof I == 'undefined')return J;
            for (var K = 0; J && K < J.length; K++) {
                if (I.is && J[K] == I.$)return K; else if (K == I)return new h(J[K]);
            }
            return I.is ? -1 : null;
        };
        function B(G, H, I) {
            var J = [];
            for (var K = 0; K < G.length;

                 K++) {
                var L = G[K];
                if (typeof I == 'undefined')J.push(L[H]); else if (I.is && L[H] == I.$)return K; else if (K == I)return new h(L[H]);
            }
            return typeof I == 'undefined' ? J : I.is ? -1 : null;
        };
        function C(G, H, I) {
            var J = o(G), K;
            if ((H ? J.length != 1 : J.length < 2) || (K = G.getCommonAncestor()) && K.type == 1 && K.is('table'))return false;
            var L, M = J[0], N = M.getAscendant('table'), O = e.buildTableMap(N), P = O.length, Q = O[0].length, R = M.getParent().$.rowIndex, S = A(O, R, M);
            if (H) {
                var T;
                try {
                    T = O[H == 'up' ? R - 1 : H == 'down' ? R + 1 : R][H == 'left' ? S - 1 : H == 'right' ? S + 1 : S];
                } catch (al) {
                    return false;
                }
                if (!T || M.$ == T)return false;
                J[H == 'up' || H == 'left' ? 'unshift' : 'push'](new h(T));
            }
            var U = M.getDocument(), V = R, W = 0, X = 0, Y = !I && new d.documentFragment(U), Z = 0;
            for (var aa = 0; aa < J.length; aa++) {
                L = J[aa];
                var ab = L.getParent(), ac = L.getFirst(), ad = L.$.colSpan, ae = L.$.rowSpan, af = ab.$.rowIndex, ag = A(O, af, L);
                Z += ad * ae;
                X = Math.max(X, ag - S + ad);
                W = Math.max(W, af - R + ae);
                if (!I) {
                    if (y(L), L.getChildren().count()) {
                        if (af != V && ac && !(ac.isBlockBoundary && ac.isBlockBoundary({br: 1}))) {
                            var ah = Y.getLast(d.walker.whitespaces(true));
                            if (ah && !(ah.is && ah.is('br')))Y.append(new h('br'));
                        }
                        L.moveChildren(Y);
                    }
                    aa ? L.remove() : L.setHtml('');
                }
                V = af;
            }
            if (!I) {
                Y.moveChildren(M);
                if (!c)M.appendBogus();
                if (X >= Q)M.removeAttribute('rowSpan'); else M.$.rowSpan = W;
                if (W >= P)M.removeAttribute('colSpan'); else M.$.colSpan = X;
                var ai = new d.nodeList(N.$.rows), aj = ai.count();
                for (aa = aj - 1; aa >= 0; aa--) {
                    var ak = ai.getItem(aa);
                    if (!ak.$.cells.length) {
                        ak.remove();
                        aj++;
                        continue;
                    }
                }
                return M;
            } else return W * X == Z;
        };
        function D(G, H) {
            var I = o(G);
            if (I.length > 1)return false; else if (H)return true;
            var J = I[0], K = J.getParent(), L = K.getAscendant('table'), M = e.buildTableMap(L), N = K.$.rowIndex, O = A(M, N, J), P = J.$.rowSpan, Q, R, S, T;
            if (P > 1) {
                R = Math.ceil(P / 2);
                S = Math.floor(P / 2);
                T = N + R;
                var U = new h(L.$.rows[T]), V = A(M, T), W;
                Q = J.clone();
                for (var X = 0; X < V.length; X++) {
                    W = V[X];
                    if (W.parentNode == U.$ && X > O) {
                        Q.insertBefore(new h(W));
                        break;
                    } else W = null;
                }
                if (!W)U.append(Q, true);
            } else {
                S = R = 1;
                U = K.clone();
                U.insertAfter(K);
                U.append(Q = J.clone());
                var Y = A(M, N);
                for (var Z = 0; Z < Y.length; Z++)Y[Z].rowSpan++;
            }
            if (!c)Q.appendBogus();
            J.$.rowSpan = R;
            Q.$.rowSpan = S;
            if (R == 1)J.removeAttribute('rowSpan');
            if (S == 1)Q.removeAttribute('rowSpan');
            return Q;
        };
        function E(G, H) {
            var I = o(G);
            if (I.length > 1)return false; else if (H)return true;
            var J = I[0], K = J.getParent(), L = K.getAscendant('table'), M = e.buildTableMap(L), N = K.$.rowIndex, O = A(M, N, J), P = J.$.colSpan, Q, R, S;
            if (P > 1) {
                R = Math.ceil(P / 2);
                S = Math.floor(P / 2);
            } else {
                S = R = 1;
                var T = B(M, O);
                for (var U = 0; U < T.length; U++)T[U].colSpan++;
            }
            Q = J.clone();
            Q.insertAfter(J);
            if (!c)Q.appendBogus();
            J.$.colSpan = R;
            Q.$.colSpan = S;

            if (R == 1)J.removeAttribute('colSpan');
            if (S == 1)Q.removeAttribute('colSpan');
            return Q;
        };
        var F = {thead: 1, tbody: 1, tfoot: 1, td: 1, tr: 1, th: 1};
        j.tabletools = {
            init: function (G) {
                var H = G.lang.table;
                G.addCommand('cellProperties', new a.dialogCommand('cellProperties'));
                a.dialog.add('cellProperties', this.path + 'dialogs/tableCell.js');
                G.addCommand('tableDelete', {
                    exec: function (I) {
                        var J = I.getSelection(), K = J && J.getStartElement(), L = K && K.getAscendant('table', 1);
                        if (!L)return;
                        J.selectElement(L);
                        var M = J.getRanges()[0];
                        M.collapse();
                        J.selectRanges([M]);
                        var N = L.getParent();
                        if (N.getChildCount() == 1 && !N.is('body', 'td', 'th'))N.remove(); else L.remove();
                    }
                });
                G.addCommand('rowDelete', {
                    exec: function (I) {
                        var J = I.getSelection();
                        z(s(J));
                    }
                });
                G.addCommand('rowInsertBefore', {
                    exec: function (I) {
                        var J = I.getSelection();
                        r(J, true);
                    }
                });
                G.addCommand('rowInsertAfter', {
                    exec: function (I) {
                        var J = I.getSelection();
                        r(J);
                    }
                });
                G.addCommand('columnDelete', {
                    exec: function (I) {
                        var J = I.getSelection(), K = v(J);
                        K && z(K, true);
                    }
                });
                G.addCommand('columnInsertBefore', {
                    exec: function (I) {
                        var J = I.getSelection();
                        t(J, true);
                    }
                });
                G.addCommand('columnInsertAfter', {
                    exec: function (I) {
                        var J = I.getSelection();
                        t(J);
                    }
                });
                G.addCommand('cellDelete', {
                    exec: function (I) {
                        var J = I.getSelection();
                        x(J);
                    }
                });
                G.addCommand('cellMerge', {
                    exec: function (I) {
                        z(C(I.getSelection()), true);
                    }
                });
                G.addCommand('cellMergeRight', {
                    exec: function (I) {
                        z(C(I.getSelection(), 'right'), true);
                    }
                });
                G.addCommand('cellMergeDown', {
                    exec: function (I) {
                        z(C(I.getSelection(), 'down'), true);
                    }
                });
                G.addCommand('cellVerticalSplit', {
                    exec: function (I) {
                        z(D(I.getSelection()));
                    }
                });
                G.addCommand('cellHorizontalSplit', {
                    exec: function (I) {
                        z(E(I.getSelection()));
                    }
                });
                G.addCommand('cellInsertBefore', {
                    exec: function (I) {
                        var J = I.getSelection();
                        w(J, true);
                    }
                });
                G.addCommand('cellInsertAfter', {
                    exec: function (I) {
                        var J = I.getSelection();
                        w(J);
                    }
                });
                if (G.addMenuItems)G.addMenuItems({
                    tablecell: {
                        label: H.cell.menu, group: 'tablecell', order: 1, getItems: function () {
                            var I = G.getSelection(), J = o(I);
                            return {
                                tablecell_insertBefore: 2,
                                tablecell_insertAfter: 2,
                                tablecell_delete: 2,
                                tablecell_merge: C(I, null, true) ? 2 : 0,
                                tablecell_merge_right: C(I, 'right', true) ? 2 : 0,
                                tablecell_merge_down: C(I, 'down', true) ? 2 : 0,
                                tablecell_split_vertical: D(I, true) ? 2 : 0,
                                tablecell_split_horizontal: E(I, true) ? 2 : 0,
                                tablecell_properties: J.length > 0 ? 2 : 0
                            };
                        }
                    },
                    tablecell_insertBefore: {
                        label: H.cell.insertBefore,
                        group: 'tablecell',
                        command: 'cellInsertBefore',
                        order: 5
                    },
                    tablecell_insertAfter: {
                        label: H.cell.insertAfter,
                        group: 'tablecell',
                        command: 'cellInsertAfter',
                        order: 10
                    },
                    tablecell_delete: {label: H.cell.deleteCell, group: 'tablecell', command: 'cellDelete', order: 15},
                    tablecell_merge: {label: H.cell.merge, group: 'tablecell', command: 'cellMerge', order: 16},
                    tablecell_merge_right: {
                        label: H.cell.mergeRight,
                        group: 'tablecell',
                        command: 'cellMergeRight',
                        order: 17
                    },
                    tablecell_merge_down: {
                        label: H.cell.mergeDown,
                        group: 'tablecell',
                        command: 'cellMergeDown',
                        order: 18
                    },
                    tablecell_split_horizontal: {
                        label: H.cell.splitHorizontal,
                        group: 'tablecell',
                        command: 'cellHorizontalSplit',
                        order: 19
                    },
                    tablecell_split_vertical: {
                        label: H.cell.splitVertical,
                        group: 'tablecell',
                        command: 'cellVerticalSplit',
                        order: 20
                    },
                    tablecell_properties: {
                        label: H.cell.title,
                        group: 'tablecellproperties',
                        command: 'cellProperties',
                        order: 21
                    },
                    tablerow: {
                        label: H.row.menu, group: 'tablerow', order: 1, getItems: function () {
                            return {tablerow_insertBefore: 2, tablerow_insertAfter: 2, tablerow_delete: 2};

                        }
                    },
                    tablerow_insertBefore: {
                        label: H.row.insertBefore,
                        group: 'tablerow',
                        command: 'rowInsertBefore',
                        order: 5
                    },
                    tablerow_insertAfter: {
                        label: H.row.insertAfter,
                        group: 'tablerow',
                        command: 'rowInsertAfter',
                        order: 10
                    },
                    tablerow_delete: {label: H.row.deleteRow, group: 'tablerow', command: 'rowDelete', order: 15},
                    tablecolumn: {
                        label: H.column.menu, group: 'tablecolumn', order: 1, getItems: function () {
                            return {tablecolumn_insertBefore: 2, tablecolumn_insertAfter: 2, tablecolumn_delete: 2};
                        }
                    },
                    tablecolumn_insertBefore: {
                        label: H.column.insertBefore,
                        group: 'tablecolumn',
                        command: 'columnInsertBefore',
                        order: 5
                    },
                    tablecolumn_insertAfter: {
                        label: H.column.insertAfter,
                        group: 'tablecolumn',
                        command: 'columnInsertAfter',
                        order: 10
                    },
                    tablecolumn_delete: {
                        label: H.column.deleteColumn,
                        group: 'tablecolumn',
                        command: 'columnDelete',
                        order: 15
                    }
                });
                if (G.contextMenu)G.contextMenu.addListener(function (I, J) {
                    if (!I || I.isReadOnly())return null;
                    while (I) {
                        if (I.getName() in F)return {tablecell: 2, tablerow: 2, tablecolumn: 2};
                        I = I.getParent();
                    }
                    return null;
                });
            }, getSelectedCells: o
        };
        j.add('tabletools', j.tabletools);
    })();
    e.buildTableMap = function (m) {
        var n = m.$.rows, o = -1, p = [];
        for (var q = 0; q < n.length; q++) {
            o++;
            !p[o] && (p[o] = []);
            var r = -1;
            for (var s = 0; s < n[q].cells.length; s++) {
                var t = n[q].cells[s];
                r++;
                while (p[o][r])r++;
                var u = isNaN(t.colSpan) ? 1 : t.colSpan, v = isNaN(t.rowSpan) ? 1 : t.rowSpan;
                for (var w = 0; w < v; w++) {
                    if (!p[o + w])p[o + w] = [];
                    for (var x = 0; x < u; x++)p[o + w][r + x] = n[q].cells[s];
                }
                r += u - 1;
            }
        }
        return p;
    };
    j.add('specialchar', {
        availableLangs: {en: 1}, init: function (m) {
            var n = 'specialchar', o = this;
            a.dialog.add(n, this.path + 'dialogs/specialchar.js');
            m.addCommand(n, {
                exec: function () {
                    var p = m.langCode;
                    p = o.availableLangs[p] ? p : 'en';
                    a.scriptLoader.load(a.getUrl(o.path + 'lang/' + p + '.js'), function () {
                        e.extend(m.lang.specialChar, o.lang[p]);
                        m.openDialog(n);
                    });
                }, modes: {wysiwyg: 1}, canUndo: false
            });
            m.ui.addButton('SpecialChar', {label: m.lang.specialChar.toolbar, command: n});
        }
    });
    i.specialChars = ['!', '&quot;', '#', '$', '%', '&amp;', "'", '(', ')', '*', '+', '-', '.', '/', '0', '1', '2', '3', '4', '5', '6', '7', '8', '9', ':', ';', '&lt;', '=', '&gt;', '?', '@', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', '[', ']', '^', '_', '`', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', '{', '|', '}', '~', '&euro;', '&lsquo;', '&rsquo;', '&ldquo;', '&rdquo;', '&ndash;', '&mdash;', '&iexcl;', '&cent;', '&pound;', '&curren;', '&yen;', '&brvbar;', '&sect;', '&uml;', '&copy;', '&ordf;', '&laquo;', '&not;', '&reg;', '&macr;', '&deg;', '&', '&sup2;', '&sup3;', '&acute;', '&micro;', '&para;', '&middot;', '&cedil;', '&sup1;', '&ordm;', '&', '&frac14;', '&frac12;', '&frac34;', '&iquest;', '&Agrave;', '&Aacute;', '&Acirc;', '&Atilde;', '&Auml;', '&Aring;', '&AElig;', '&Ccedil;', '&Egrave;', '&Eacute;', '&Ecirc;', '&Euml;', '&Igrave;', '&Iacute;', '&Icirc;', '&Iuml;', '&ETH;', '&Ntilde;', '&Ograve;', '&Oacute;', '&Ocirc;', '&Otilde;', '&Ouml;', '&times;', '&Oslash;', '&Ugrave;', '&Uacute;', '&Ucirc;', '&Uuml;', '&Yacute;', '&THORN;', '&szlig;', '&agrave;', '&aacute;', '&acirc;', '&atilde;', '&auml;', '&aring;', '&aelig;', '&ccedil;', '&egrave;', '&eacute;', '&ecirc;', '&euml;', '&igrave;', '&iacute;', '&icirc;', '&iuml;', '&eth;', '&ntilde;', '&ograve;', '&oacute;', '&ocirc;', '&otilde;', '&ouml;', '&divide;', '&oslash;', '&ugrave;', '&uacute;', '&ucirc;', '&uuml;', '&uuml;', '&yacute;', '&thorn;', '&yuml;', '&OElig;', '&oelig;', '&#372;', '&#374', '&#373', '&#375;', '&sbquo;', '&#8219;', '&bdquo;', '&hellip;', '&trade;', '&#9658;', '&bull;', '&rarr;', '&rArr;', '&hArr;', '&diams;', '&asymp;'];

    (function () {
        var m = {editorFocus: false, modes: {wysiwyg: 1, source: 1}}, n = {
            exec: function (q) {
                q.container.focusNext(true, q.tabIndex);
            }
        }, o = {
            exec: function (q) {
                q.container.focusPrevious(true, q.tabIndex);
            }
        };

        function p(q) {
            return {
                editorFocus: false, canUndo: false, modes: {wysiwyg: 1}, exec: function (r) {
                    if (r.focusManager.hasFocus) {
                        var s = r.getSelection(), t = s.getCommonAncestor(), u;
                        if (u = t.getAscendant('td', true) || t.getAscendant('th', true)) {
                            var v = new d.range(r.document), w = e.tryThese(function () {
                                var D = u.getParent(), E = D.$.cells[u.$.cellIndex + (q ? -1 : 1)];
                                E.parentNode.parentNode;
                                return E;
                            }, function () {
                                var D = u.getParent(), E = D.getAscendant('table'), F = E.$.rows[D.$.rowIndex + (q ? -1 : 1)];
                                return F.cells[q ? F.cells.length - 1 : 0];
                            });
                            if (!(w || q)) {
                                var x = u.getAscendant('table').$, y = u.getParent().$.cells, z = new h(x.insertRow(-1), r.document);
                                for (var A = 0, B = y.length; A < B; A++) {
                                    var C = z.append(new h(y[A], r.document).clone(false, false));
                                    !c && C.appendBogus();
                                }
                                v.moveToElementEditStart(z);
                            } else if (w) {
                                w = new h(w);
                                v.moveToElementEditStart(w);
                                if (!(v.checkStartOfBlock() && v.checkEndOfBlock()))v.selectNodeContents(w);
                            } else return true;
                            v.select(true);
                            return true;
                        }
                    }
                    return false;
                }
            };
        };
        j.add('tab', {
            requires: ['keystrokes'], init: function (q) {
                var r = q.config.enableTabKeyTools !== false, s = q.config.tabSpaces || 0, t = '';
                while (s--)t += '\xa0';
                if (t)q.on('key', function (u) {
                    if (u.data.keyCode == 9) {
                        q.insertHtml(t);
                        u.cancel();
                    }
                });
                if (r)q.on('key', function (u) {
                    if (u.data.keyCode == 9 && q.execCommand('selectNextCell') || u.data.keyCode == 2000 + 9 && q.execCommand('selectPreviousCell'))u.cancel();
                });
                if (b.webkit || b.gecko)q.on('key', function (u) {
                    var v = u.data.keyCode;
                    if (v == 9 && !t) {
                        u.cancel();
                        q.execCommand('blur');
                    }
                    if (v == 2000 + 9) {
                        q.execCommand('blurBack');
                        u.cancel();
                    }
                });
                q.addCommand('blur', e.extend(n, m));
                q.addCommand('blurBack', e.extend(o, m));
                q.addCommand('selectNextCell', p());
                q.addCommand('selectPreviousCell', p(true));
            }
        });
    })();
    h.prototype.focusNext = function (m, n) {
        var w = this;
        var o = w.$, p = n === undefined ? w.getTabIndex() : n, q, r, s, t, u, v;
        if (p <= 0) {
            u = w.getNextSourceNode(m, 1);
            while (u) {
                if (u.isVisible() && u.getTabIndex() === 0) {
                    s = u;
                    break;
                }
                u = u.getNextSourceNode(false, 1);
            }
        } else {
            u = w.getDocument().getBody().getFirst();
            while (u = u.getNextSourceNode(false, 1)) {
                if (!q)if (!r && u.equals(w)) {
                    r = true;
                    if (m) {
                        if (!(u = u.getNextSourceNode(true, 1)))break;
                        q = 1;
                    }
                } else if (r && !w.contains(u))q = 1;
                if (!u.isVisible() || (v = u.getTabIndex()) < 0)continue;
                if (q && v == p) {
                    s = u;
                    break;
                }
                if (v > p && (!s || !t || v < t)) {
                    s = u;
                    t = v;
                } else if (!s && v === 0) {
                    s = u;
                    t = v;
                }
            }
        }
        if (s)s.focus();
    };
    h.prototype.focusPrevious = function (m, n) {
        var w = this;
        var o = w.$, p = n === undefined ? w.getTabIndex() : n, q, r, s, t = 0, u, v = w.getDocument().getBody().getLast();

        while (v = v.getPreviousSourceNode(false, 1)) {
            if (!q)if (!r && v.equals(w)) {
                r = true;
                if (m) {
                    if (!(v = v.getPreviousSourceNode(true, 1)))break;
                    q = 1;
                }
            } else if (r && !w.contains(v))q = 1;
            if (!v.isVisible() || (u = v.getTabIndex()) < 0)continue;
            if (p <= 0) {
                if (q && u === 0) {
                    s = v;
                    break;
                }
                if (u > t) {
                    s = v;
                    t = u;
                }
            } else {
                if (q && u == p) {
                    s = v;
                    break;
                }
                if (u < p && (!s || u > t)) {
                    s = v;
                    t = u;
                }
            }
        }
        if (s)s.focus();
    };
    (function () {
        j.add('templates', {
            requires: ['dialog'], init: function (o) {
                a.dialog.add('templates', a.getUrl(this.path + 'dialogs/templates.js'));
                o.addCommand('templates', new a.dialogCommand('templates'));
                o.ui.addButton('Templates', {label: o.lang.templates.button, command: 'templates'});
            }
        });
        var m = {}, n = {};
        a.addTemplates = function (o, p) {
            m[o] = p;
        };
        a.getTemplates = function (o) {
            return m[o];
        };
        a.loadTemplates = function (o, p) {
            var q = [];
            for (var r = 0, s = o.length; r < s; r++) {
                if (!n[o[r]]) {
                    q.push(o[r]);
                    n[o[r]] = 1;
                }
            }
            if (q.length)a.scriptLoader.load(q, p); else setTimeout(p, 0);
        };
    })();
    i.templates_files = [a.getUrl('plugins/templates/templates/default.js')];
    i.templates_replaceContent = true;
    (function () {
        var m = function () {
            this.toolbars = [];
            this.focusCommandExecuted = false;
        };
        m.prototype.focus = function () {
            for (var o = 0, p; p = this.toolbars[o++];)for (var q = 0, r; r = p.items[q++];) {
                if (r.focus) {
                    r.focus();
                    return;
                }
            }
        };
        var n = {
            toolbarFocus: {
                modes: {wysiwyg: 1, source: 1}, exec: function (o) {
                    if (o.toolbox) {
                        o.toolbox.focusCommandExecuted = true;
                        if (c || b.air)setTimeout(function () {
                            o.toolbox.focus();
                        }, 100); else o.toolbox.focus();
                    }
                }
            }
        };
        j.add('toolbar', {
            init: function (o) {
                var p = function (q, r) {
                    var s, t, u, v = o.lang.dir == 'rtl';
                    switch (r) {
                        case v ? 37 : 39:
                        case 9:
                            do {
                                s = q.next;
                                if (!s) {
                                    t = q.toolbar.next;
                                    u = t && t.items.length;
                                    while (u === 0) {
                                        t = t.next;
                                        u = t && t.items.length;
                                    }
                                    if (t)s = t.items[0];
                                }
                                q = s;
                            } while (q && !q.focus)
                            if (q)q.focus(); else o.toolbox.focus();
                            return false;
                        case v ? 39 : 37:
                        case 2000 + 9:
                            do {
                                s = q.previous;
                                if (!s) {
                                    t = q.toolbar.previous;
                                    u = t && t.items.length;
                                    while (u === 0) {
                                        t = t.previous;
                                        u = t && t.items.length;
                                    }
                                    if (t)s = t.items[u - 1];
                                }
                                q = s;
                            } while (q && !q.focus)
                            if (q)q.focus(); else {
                                var w = o.toolbox.toolbars[o.toolbox.toolbars.length - 1].items;
                                w[w.length - 1].focus();
                            }
                            return false;
                        case 27:
                            o.focus();
                            return false;
                        case 13:
                        case 32:
                            q.execute();
                            return false;
                    }
                    return true;
                };
                o.on('themeSpace', function (q) {
                    if (q.data.space == o.config.toolbarLocation) {
                        o.toolbox = new m();
                        var r = e.getNextId(), s = ['<div class="cke_toolbox" role="toolbar" aria-labelledby="', r, '" onmousedown="return false;"'], t = o.config.toolbarStartupExpanded !== false, u;
                        s.push(t ? '>' : ' style="display:none">');
                        s.push('<span id="', r, '" class="cke_voice_label">', o.lang.toolbar, '</span>');
                        var v = o.toolbox.toolbars, w = o.config.toolbar instanceof Array ? o.config.toolbar : o.config['toolbar_' + o.config.toolbar];

                        for (var x = 0; x < w.length; x++) {
                            var y = w[x];
                            if (!y)continue;
                            var z = e.getNextId(), A = {id: z, items: []};
                            if (u) {
                                s.push('</div>');
                                u = 0;
                            }
                            if (y === '/') {
                                s.push('<div class="cke_break"></div>');
                                continue;
                            }
                            s.push('<span id="', z, '" class="cke_toolbar" role="presentation"><span class="cke_toolbar_start"></span>');
                            var B = v.push(A) - 1;
                            if (B > 0) {
                                A.previous = v[B - 1];
                                A.previous.next = A;
                            }
                            for (var C = 0; C < y.length; C++) {
                                var D, E = y[C];
                                if (E == '-')D = k.separator; else D = o.ui.create(E);
                                if (D) {
                                    if (D.canGroup) {
                                        if (!u) {
                                            s.push('<span class="cke_toolgroup" role="presentation">');
                                            u = 1;
                                        }
                                    } else if (u) {
                                        s.push('</span>');
                                        u = 0;
                                    }
                                    var F = D.render(o, s);
                                    B = A.items.push(F) - 1;
                                    if (B > 0) {
                                        F.previous = A.items[B - 1];
                                        F.previous.next = F;
                                    }
                                    F.toolbar = A;
                                    F.onkey = p;
                                    F.onfocus = function () {
                                        if (!o.toolbox.focusCommandExecuted)o.focus();
                                    };
                                }
                            }
                            if (u) {
                                s.push('</span>');
                                u = 0;
                            }
                            s.push('<span class="cke_toolbar_end"></span></span>');
                        }
                        s.push('</div>');
                        if (o.config.toolbarCanCollapse) {
                            var G = e.addFunction(function () {
                                o.execCommand('toolbarCollapse');
                            });
                            o.on('destroy', function () {
                                e.removeFunction(G);
                            });
                            var H = e.getNextId();
                            o.addCommand('toolbarCollapse', {
                                exec: function (I) {
                                    var J = a.document.getById(H), K = J.getPrevious(), L = I.getThemeSpace('contents'), M = K.getParent(), N = parseInt(L.$.style.height, 10), O = M.$.offsetHeight, P = !K.isVisible();
                                    if (!P) {
                                        K.hide();
                                        J.addClass('cke_toolbox_collapser_min');
                                        J.setAttribute('title', I.lang.toolbarExpand);
                                    } else {
                                        K.show();
                                        J.removeClass('cke_toolbox_collapser_min');
                                        J.setAttribute('title', I.lang.toolbarCollapse);
                                    }
                                    J.getFirst().setText(P ? '▲' : '◀');
                                    var Q = M.$.offsetHeight - O;
                                    L.setStyle('height', N - Q + 'px');
                                    I.fire('resize');
                                }, modes: {wysiwyg: 1, source: 1}
                            });
                            s.push('<a title="' + (t ? o.lang.toolbarCollapse : o.lang.toolbarExpand) + '" id="' + H + '" tabIndex="-1" class="cke_toolbox_collapser');
                            if (!t)s.push(' cke_toolbox_collapser_min');
                            s.push('" onclick="CKEDITOR.tools.callFunction(' + G + ')">', '<span>&#9650;</span>', '</a>');
                        }
                        q.data.html += s.join('');
                    }
                });
                o.addCommand('toolbarFocus', n.toolbarFocus);
            }
        });
    })();
    k.separator = {
        render: function (m, n) {
            n.push('<span class="cke_separator" role="separator"></span>');
            return {};
        }
    };
    i.toolbarLocation = 'top';
    i.toolbar_Basic = [['Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink', '-', 'About']];
    i.toolbar_Full = [['Source', '-', 'Save', 'NewPage', 'Preview', '-', 'Templates'], ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Print', 'SpellChecker', 'Scayt'], ['Undo', 'Redo', '-', 'Find', 'Replace', '-', 'SelectAll', 'RemoveFormat'], ['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField'], '/', ['Bold', 'Italic', 'Underline', 'Strike', '-', 'Subscript', 'Superscript'], ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', 'Blockquote', 'CreateDiv'], ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'], ['BidiLtr', 'BidiRtl'], ['Link', 'Unlink', 'Anchor'], ['Image', 'Flash', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe'], '/', ['Styles', 'Format', 'Font', 'FontSize'], ['TextColor', 'BGColor'], ['Maximize', 'ShowBlocks', '-', 'About']];

    i.toolbar = 'Full';
    i.toolbarCanCollapse = true;
    (function () {
        j.add('undo', {
            requires: ['selection', 'wysiwygarea'], init: function (s) {
                var t = new o(s), u = s.addCommand('undo', {
                    exec: function () {
                        if (t.undo()) {
                            s.selectionChange();
                            this.fire('afterUndo');
                        }
                    }, state: 0, canUndo: false
                }), v = s.addCommand('redo', {
                    exec: function () {
                        if (t.redo()) {
                            s.selectionChange();
                            this.fire('afterRedo');
                        }
                    }, state: 0, canUndo: false
                });
                t.onChange = function () {
                    u.setState(t.undoable() ? 2 : 0);
                    v.setState(t.redoable() ? 2 : 0);
                };
                function w(x) {
                    if (t.enabled && x.data.command.canUndo !== false)t.save();
                };
                s.on('beforeCommandExec', w);
                s.on('afterCommandExec', w);
                s.on('saveSnapshot', function () {
                    t.save();
                });
                s.on('contentDom', function () {
                    s.document.on('keydown', function (x) {
                        if (!x.data.$.ctrlKey && !x.data.$.metaKey)t.type(x);
                    });
                });
                s.on('beforeModeUnload', function () {
                    s.mode == 'wysiwyg' && t.save(true);
                });
                s.on('mode', function () {
                    t.enabled = s.mode == 'wysiwyg';
                    t.onChange();
                });
                s.ui.addButton('Undo', {label: s.lang.undo, command: 'undo'});
                s.ui.addButton('Redo', {label: s.lang.redo, command: 'redo'});
                s.resetUndo = function () {
                    t.reset();
                    s.fire('saveSnapshot');
                };
                s.on('updateSnapshot', function () {
                    if (t.currentImage && new m(s).equals(t.currentImage))setTimeout(function () {
                        t.update();
                    }, 0);
                });
            }
        });
        j.undo = {};
        var m = j.undo.Image = function (s) {
            this.editor = s;
            var t = s.getSnapshot(), u = t && s.getSelection();
            c && t && (t = t.replace(/\s+data-cke-expando=".*?"/g, ''));
            this.contents = t;
            this.bookmarks = u && u.createBookmarks2(true);
        }, n = /\b(?:href|src|name)="[^"]*?"/gi;
        m.prototype = {
            equals: function (s, t) {
                var u = this.contents, v = s.contents;
                if (c && (b.ie7Compat || b.ie6Compat)) {
                    u = u.replace(n, '');
                    v = v.replace(n, '');
                }
                if (u != v)return false;
                if (t)return true;
                var w = this.bookmarks, x = s.bookmarks;
                if (w || x) {
                    if (!w || !x || w.length != x.length)return false;
                    for (var y = 0; y < w.length; y++) {
                        var z = w[y], A = x[y];
                        if (z.startOffset != A.startOffset || z.endOffset != A.endOffset || !e.arrayCompare(z.start, A.start) || !e.arrayCompare(z.end, A.end))return false;
                    }
                }
                return true;
            }
        };
        function o(s) {
            this.editor = s;
            this.reset();
        };
        var p = {8: 1, 46: 1}, q = {16: 1, 17: 1, 18: 1}, r = {37: 1, 38: 1, 39: 1, 40: 1};
        o.prototype = {
            type: function (s) {
                var t = s && s.data.getKey(), u = t in q, v = t in p, w = this.lastKeystroke in p, x = v && t == this.lastKeystroke, y = t in r, z = this.lastKeystroke in r, A = !v && !y, B = v && !x, C = !(u || this.typing) || A && (w || z);
                if (C || B) {
                    var D = new m(this.editor);
                    e.setTimeout(function () {
                        var F = this;
                        var E = F.editor.getSnapshot();
                        if (c)E = E.replace(/\s+data-cke-expando=".*?"/g, '');
                        if (D.contents != E) {
                            F.typing = true;
                            if (!F.save(false, D, false))F.snapshots.splice(F.index + 1, F.snapshots.length - F.index - 1);
                            F.hasUndo = true;
                            F.hasRedo = false;

                            F.typesCount = 1;
                            F.modifiersCount = 1;
                            F.onChange();
                        }
                    }, 0, this);
                }
                this.lastKeystroke = t;
                if (v) {
                    this.typesCount = 0;
                    this.modifiersCount++;
                    if (this.modifiersCount > 25) {
                        this.save(false, null, false);
                        this.modifiersCount = 1;
                    }
                } else if (!y) {
                    this.modifiersCount = 0;
                    this.typesCount++;
                    if (this.typesCount > 25) {
                        this.save(false, null, false);
                        this.typesCount = 1;
                    }
                }
            }, reset: function () {
                var s = this;
                s.lastKeystroke = 0;
                s.snapshots = [];
                s.index = -1;
                s.limit = s.editor.config.undoStackSize || 20;
                s.currentImage = null;
                s.hasUndo = false;
                s.hasRedo = false;
                s.resetType();
            }, resetType: function () {
                var s = this;
                s.typing = false;
                delete s.lastKeystroke;
                s.typesCount = 0;
                s.modifiersCount = 0;
            }, fireChange: function () {
                var s = this;
                s.hasUndo = !!s.getNextImage(true);
                s.hasRedo = !!s.getNextImage(false);
                s.resetType();
                s.onChange();
            }, save: function (s, t, u) {
                var w = this;
                var v = w.snapshots;
                if (!t)t = new m(w.editor);
                if (t.contents === false)return false;
                if (w.currentImage && t.equals(w.currentImage, s))return false;
                v.splice(w.index + 1, v.length - w.index - 1);
                if (v.length == w.limit)v.shift();
                w.index = v.push(t) - 1;
                w.currentImage = t;
                if (u !== false)w.fireChange();
                return true;
            }, restoreImage: function (s) {
                var u = this;
                u.editor.loadSnapshot(s.contents);
                if (s.bookmarks)u.editor.getSelection().selectBookmarks(s.bookmarks); else if (c) {
                    var t = u.editor.document.getBody().$.createTextRange();
                    t.collapse(true);
                    t.select();
                }
                u.index = s.index;
                u.update();
                u.fireChange();
            }, getNextImage: function (s) {
                var x = this;
                var t = x.snapshots, u = x.currentImage, v, w;
                if (u)if (s)for (w = x.index - 1; w >= 0; w--) {
                    v = t[w];
                    if (!u.equals(v, true)) {
                        v.index = w;
                        return v;
                    }
                } else for (w = x.index + 1; w < t.length; w++) {
                    v = t[w];
                    if (!u.equals(v, true)) {
                        v.index = w;
                        return v;
                    }
                }
                return null;
            }, redoable: function () {
                return this.enabled && this.hasRedo;
            }, undoable: function () {
                return this.enabled && this.hasUndo;
            }, undo: function () {
                var t = this;
                if (t.undoable()) {
                    t.save(true);
                    var s = t.getNextImage(true);
                    if (s)return t.restoreImage(s), true;
                }
                return false;
            }, redo: function () {
                var t = this;
                if (t.redoable()) {
                    t.save(true);
                    if (t.redoable()) {
                        var s = t.getNextImage(false);
                        if (s)return t.restoreImage(s), true;
                    }
                }
                return false;
            }, update: function () {
                var s = this;
                s.snapshots.splice(s.index, 1, s.currentImage = new m(s.editor));
            }
        };
    })();
    (function () {
        var m = {
            table: 1,
            pre: 1
        }, n = /(^|<body\b[^>]*>)\s*<(p|div|address|h\d|center)[^>]*>\s*(?:<br[^>]*>|&nbsp;|\u00A0|&#160;)?\s*(:?<\/\2>)?\s*(?=$|<\/body>)/gi, o = d.walker.whitespaces(true);

        function p(E) {
            return E.getName() in m || E.isBlockBoundary() && f.$empty[E.getName()];
        };
        function q(E) {
            if (E.getType() == 3)return E.getSelectedElement().isReadOnly(); else return E.getCommonAncestor().isReadOnly();
        };

        function r(E) {
            return function (F) {
                if (this.mode == 'wysiwyg') {
                    this.focus();
                    var G = this.getSelection();
                    if (q(G))return;
                    this.fire('saveSnapshot');
                    E.call(this, F.data);
                    e.setTimeout(function () {
                        this.fire('saveSnapshot');
                    }, 0, this);
                }
            };
        };
        function s(E) {
            var K = this;
            if (K.dataProcessor)E = K.dataProcessor.toHtml(E);
            var F = K.getSelection();
            if (c) {
                var G = F.isLocked;
                if (G)F.unlock();
                var H = F.getNative();
                if (H.type == 'Control')H.clear(); else if (F.getType() == 2) {
                    var I = F.getRanges()[0], J = I && I.endContainer;
                    if (J && J.type == 1 && J.getAttribute('contenteditable') == 'false' && I.checkBoundaryOfElement(J, 2)) {
                        I.setEndAfter(I.endContainer);
                        I.deleteContents();
                    }
                }
                try {
                    H.createRange().pasteHTML(E);
                } catch (L) {
                }
                if (G)K.getSelection().lock();
            } else K.document.$.execCommand('inserthtml', false, E);
            if (b.webkit) {
                F = K.getSelection();
                F.scrollIntoView();
            }
        };
        function t(E) {
            var F = this.getSelection(), G = F.getStartElement().hasAscendant('pre', true) ? 2 : this.config.enterMode, H = G == 2, I = e.htmlEncode(E.replace(/\r\n|\r/g, '\n'));
            I = I.replace(/^[ \t]+|[ \t]+$/g, function (O, P, Q) {
                if (O.length == 1)return '&nbsp;'; else if (!P)return e.repeat('&nbsp;', O.length - 1) + ' '; else return ' ' + e.repeat('&nbsp;', O.length - 1);
            });
            I = I.replace(/[ \t]{2,}/g, function (O) {
                return e.repeat('&nbsp;', O.length - 1) + ' ';
            });
            var J = G == 1 ? 'p' : 'div';
            if (!H)I = I.replace(/(\n{2})([\s\S]*?)(?:$|\1)/g, function (O, P, Q) {
                return '<' + J + '>' + Q + '</' + J + '>';
            });
            I = I.replace(/\n/g, '<br>');
            if (!(H || c))I = I.replace(new RegExp('<br>(?=</' + J + '>)'), function (O) {
                return e.repeat(O, 2);
            });
            if (b.gecko || b.webkit) {
                var K = new d.elementPath(F.getStartElement()), L = [];
                for (var M = 0; M < K.elements.length; M++) {
                    var N = K.elements[M].getName();
                    if (N in f.$inline)L.unshift(K.elements[M].getOuterHtml().match(/^<.*?>/)); else if (N in f.$block)break;
                }
                I = L.join('') + I;
            }
            s.call(this, I);
        };
        function u(E) {
            var F = this.getSelection(), G = F.getRanges(), H = E.getName(), I = f.$block[H], J = F.isLocked;
            if (J)F.unlock();
            var K, L, M, N;
            for (var O = G.length - 1; O >= 0; O--) {
                K = G[O];
                K.deleteContents();
                L = !O && E || E.clone(1);
                var P, Q;
                if (I)while ((P = K.getCommonAncestor(0, 1)) && (Q = f[P.getName()]) && !(Q && Q[H])) {
                    if (P.getName() in f.span)K.splitElement(P); else if (K.checkStartOfBlock() && K.checkEndOfBlock()) {
                        K.setStartBefore(P);
                        K.collapse(true);
                        P.remove();
                    } else K.splitBlock();
                }
                K.insertNode(L);
                if (!M)M = L;
            }
            K.moveToPosition(M, 4);
            if (I) {
                var R = M.getNext(o), S = R && R.type == 1 && R.getName();
                if (S && f.$block[S] && f[S]['#'])K.moveToElementEditStart(R);
            }
            F.selectRanges([K]);
            if (J)this.getSelection().lock();
        };
        function v(E) {
            if (!E.checkDirty())setTimeout(function () {
                E.resetDirty();
            }, 0);
        };
        var w = d.walker.whitespaces(true), x = d.walker.bookmark(false, true);

        function y(E) {
            return w(E) && x(E);
        };
        function z(E) {
            return E.type == 3 && e.trim(E.getText()).match(/^(?:&nbsp;|\xa0)$/);
        };
        function A(E) {
            if (E.isLocked) {
                E.unlock();
                setTimeout(function () {
                    E.lock();
                }, 0);
            }
        };
        function B(E) {
            return E.getOuterHtml().match(n);
        };
        w = d.walker.whitespaces(true);
        function C(E) {
            var F = E.window, G = E.document, H = E.document.getBody(), I = H.getChildren().count();
            if (!I || I == 1 && H.getFirst().hasAttribute('_moz_editor_bogus_node')) {
                v(E);
                var J = E.element.getDocument(), K = J.getDocumentElement(), L = K.$.scrollTop, M = K.$.scrollLeft, N = G.$.createEvent('KeyEvents');
                N.initKeyEvent('keypress', true, true, F.$, false, false, false, false, 0, 32);
                G.$.dispatchEvent(N);
                if (L != K.$.scrollTop || M != K.$.scrollLeft)J.getWindow().$.scrollTo(M, L);
                I && H.getFirst().remove();
                G.getBody().appendBogus();
                var O = new d.range(G);
                O.setStartAt(H, 1);
                O.select();
            }
        };
        function D(E) {
            var F = E.editor, G = E.data.path, H = G.blockLimit, I = E.data.selection, J = I.getRanges()[0], K = F.document.getBody(), L = F.config.enterMode;
            b.gecko && C(F);
            if (L != 2 && J.collapsed && H.getName() == 'body' && !G.block) {
                F.fire('updateSnapshot');
                v(F);
                c && A(I);
                var M = J.fixBlock(true, F.config.enterMode == 3 ? 'div' : 'p');
                if (c) {
                    var N = M.getFirst(y);
                    N && z(N) && N.remove();
                }
                if (B(M)) {
                    var O = M.getNext(w);
                    if (O && O.type == 1 && !p(O)) {
                        J.moveToElementEditStart(O);
                        M.remove();
                    } else {
                        O = M.getPrevious(w);
                        if (O && O.type == 1 && !p(O)) {
                            J.moveToElementEditEnd(O);
                            M.remove();
                        }
                    }
                }
                J.select();
                if (!c)F.selectionChange();
            }
            var P = new d.range(F.document), Q = new d.walker(P);
            P.selectNodeContents(K);
            Q.evaluator = function (S) {
                return S.type == 1 && S.getName() in m;
            };
            Q.guard = function (S, T) {
                return !(S.type == 3 && w(S) || T);
            };
            if (Q.previous()) {
                F.fire('updateSnapshot');
                v(F);
                c && A(I);
                var R;
                if (L != 2)R = K.append(new h(L == 1 ? 'p' : 'div')); else R = K;
                if (!c)R.appendBogus();
            }
        };
        j.add('wysiwygarea', {
            requires: ['editingblock'], init: function (E) {
                var F = E.config.enterMode != 2 ? E.config.enterMode == 3 ? 'div' : 'p' : false, G = E.lang.editorTitle.replace('%1', E.name), H;
                E.on('editingBlockReady', function () {
                    var N, O, P, Q, R, S, T = b.isCustomDomain(), U = function (X) {
                        if (O)O.remove();
                        var Y = 'document.open();' + (T ? 'document.domain="' + document.domain + '";' : '') + 'document.close();';
                        Y = b.air ? 'javascript:void(0)' : c ? 'javascript:void(function(){' + encodeURIComponent(Y) + '}())' : '';
                        O = h.createFromHtml('<iframe style="width:100%;height:100%" frameBorder="0" title="' + G + '"' + ' src="' + Y + '"' + ' tabIndex="' + (b.webkit ? -1 : E.tabIndex) + '"' + ' allowTransparency="true"' + '></iframe>');
                        if (document.location.protocol == 'chrome:')a.event.useCapture = true;
                        O.on('load', function (ac) {
                            R = 1;
                            ac.removeListener();
                            var ad = O.getFrameDocument();
                            ad.write(X);

                            b.air && W(ad.getWindow().$);
                        });
                        if (document.location.protocol == 'chrome:')a.event.useCapture = false;
                        var Z = E.element, aa = b.gecko && !Z.isVisible(), ab = {};
                        if (aa) {
                            Z.show();
                            ab = {position: Z.getStyle('position'), top: Z.getStyle('top')};
                            Z.setStyles({position: 'absolute', top: '-3000px'});
                        }
                        N.append(O);
                        if (aa)setTimeout(function () {
                            Z.hide();
                            Z.setStyles(ab);
                        }, 1000);
                    };
                    H = e.addFunction(W);
                    var V = '<script id="cke_actscrpt" type="text/javascript" data-cke-temp="1">' + (T ? 'document.domain="' + document.domain + '";' : '') + 'window.parent.CKEDITOR.tools.callFunction( ' + H + ', window );' + '</script>';

                    function W(X) {
                        if (!R)return;
                        R = 0;
                        E.fire('ariaWidget', O);
                        var Y = X.document, Z = Y.body, aa = Y.getElementById('cke_actscrpt');
                        aa && aa.parentNode.removeChild(aa);
                        Z.spellcheck = !E.config.disableNativeSpellChecker;
                        if (c) {
                            Z.hideFocus = true;
                            Z.disabled = true;
                            Z.contentEditable = true;
                            Z.removeAttribute('disabled');
                        } else setTimeout(function () {
                            if (b.gecko && b.version >= 10900 || b.opera)Y.$.body.contentEditable = true; else if (b.webkit)Y.$.body.parentNode.contentEditable = true; else Y.$.designMode = 'on';
                        }, 0);
                        b.gecko && e.setTimeout(C, 0, null, E);
                        X = E.window = new d.window(X);
                        Y = E.document = new g(Y);
                        Y.on('dblclick', function (af) {
                            var ag = af.data.getTarget(), ah = {element: ag, dialog: ''};
                            E.fire('doubleclick', ah);
                            ah.dialog && E.openDialog(ah.dialog);
                        });
                        if (!(c || b.opera))Y.on('mousedown', function (af) {
                            var ag = af.data.getTarget();
                            if (ag.is('img', 'hr', 'input', 'textarea', 'select'))E.getSelection().selectElement(ag);
                        });
                        if (b.gecko)Y.on('mouseup', function (af) {
                            if (af.data.$.button == 2) {
                                var ag = af.data.getTarget();
                                if (!ag.getOuterHtml().replace(n, '')) {
                                    var ah = new d.range(Y);
                                    ah.moveToElementEditStart(ag);
                                    ah.select(true);
                                }
                            }
                        });
                        Y.on('click', function (af) {
                            af = af.data;
                            if (af.getTarget().is('a') && af.$.button != 2)af.preventDefault();
                        });
                        if (b.webkit) {
                            Y.on('click', function (af) {
                                if (af.data.getTarget().is('input', 'select'))af.data.preventDefault();
                            });
                            Y.on('mouseup', function (af) {
                                if (af.data.getTarget().is('input', 'textarea'))af.data.preventDefault();
                            });
                        }
                        if (c && Y.$.compatMode == 'CSS1Compat' || b.gecko || b.opera) {
                            var ab = Y.getDocumentElement();
                            ab.on('mousedown', function (af) {
                                if (af.data.getTarget().equals(ab)) {
                                    if (b.gecko && b.version >= 10900)L();
                                    M.focus();
                                }
                            });
                        }
                        X.on('blur', function () {
                            E.focusManager.blur();
                        });
                        var ac;
                        X.on('focus', function () {
                            var af = E.document;
                            if (b.gecko && b.version >= 10900)L(); else if (b.opera)af.getBody().focus(); else if (b.webkit)if (!ac) {
                                E.document.getDocumentElement().focus();
                                ac = 1;
                            }
                            E.focusManager.focus();
                        });
                        var ad = E.keystrokeHandler;
                        if (ad)ad.attach(Y);
                        if (c) {
                            Y.getDocumentElement().addClass(Y.$.compatMode);

                            Y.on('keydown', function (af) {
                                var ag = af.data.getKeystroke();
                                if (ag in {8: 1, 46: 1}) {
                                    var ah = E.getSelection(), ai = ah.getSelectedElement();
                                    if (ai) {
                                        E.fire('saveSnapshot');
                                        var aj = ah.getRanges()[0].createBookmark();
                                        ai.remove();
                                        ah.selectBookmarks([aj]);
                                        E.fire('saveSnapshot');
                                        af.data.preventDefault();
                                    }
                                }
                            });
                            if (Y.$.compatMode == 'CSS1Compat') {
                                var ae = {33: 1, 34: 1};
                                Y.on('keydown', function (af) {
                                    if (af.data.getKeystroke() in ae)setTimeout(function () {
                                        E.getSelection().scrollIntoView();
                                    }, 0);
                                });
                            }
                        }
                        if (E.contextMenu)E.contextMenu.addTarget(Y, E.config.browserContextMenuOnCtrl !== false);
                        setTimeout(function () {
                            E.fire('contentDom');
                            if (S) {
                                E.mode = 'wysiwyg';
                                E.fire('mode');
                                S = false;
                            }
                            P = false;
                            if (Q) {
                                E.focus();
                                Q = false;
                            }
                            setTimeout(function () {
                                E.fire('dataReady');
                            }, 0);
                            try {
                                E.document.$.execCommand('enableObjectResizing', false, !E.config.disableObjectResizing);
                            } catch (af) {
                            }
                            try {
                                E.document.$.execCommand('enableInlineTableEditing', false, !E.config.disableNativeTableHandles);
                            } catch (ag) {
                            }
                            if (c)setTimeout(function () {
                                if (E.document) {
                                    var ah = E.document.$.body;
                                    ah.runtimeStyle.marginBottom = '0px';
                                    ah.runtimeStyle.marginBottom = '';
                                }
                            }, 1000);
                        }, 0);
                    };
                    E.addMode('wysiwyg', {
                        load: function (X, Y, Z) {
                            N = X;
                            if (c && b.quirks)X.setStyle('position', 'relative');
                            E.mayBeDirty = true;
                            S = true;
                            if (Z)this.loadSnapshotData(Y); else this.loadData(Y);
                        }, loadData: function (X) {
                            P = true;
                            var Y = E.config, Z = Y.fullPage, aa = Y.docType, ab = '<style type="text/css" data-cke-temp="1">' + E._.styles.join('\n') + '</style>';
                            !Z && (ab = e.buildStyleHtml(E.config.contentsCss) + ab);
                            var ac = Y.baseHref ? '<base href="' + Y.baseHref + '" data-cke-temp="1" />' : '';
                            if (Z)X = X.replace(/<!DOCTYPE[^>]*>/i, function (ad) {
                                E.docType = aa = ad;
                                return '';
                            });
                            if (E.dataProcessor)X = E.dataProcessor.toHtml(X, F);
                            if (Z) {
                                if (!/<body[\s|>]/.test(X))X = '<body>' + X;
                                if (!/<html[\s|>]/.test(X))X = '<html>' + X + '</html>';
                                if (!/<head[\s|>]/.test(X))X = X.replace(/<html[^>]*>/, '$&<head><title></title></head>'); else if (!/<title[\s|>]/.test(X))X = X.replace(/<head[^>]*>/, '$&<title></title>');
                                ac && (X = X.replace(/<head>/, '$&' + ac));
                                X = X.replace(/<\/head\s*>/, ab + '$&');
                                X = aa + X;
                            } else X = Y.docType + '<html dir="' + Y.contentsLangDirection + '"' + ' lang="' + (Y.contentsLanguage || E.langCode) + '">' + '<head>' + '<title>' + G + '</title>' + ac + ab + '</head>' + '<body' + (Y.bodyId ? ' id="' + Y.bodyId + '"' : '') + (Y.bodyClass ? ' class="' + Y.bodyClass + '"' : '') + '>' + X + '</html>';
                            X += V;
                            this.onDispose();
                            U(X);
                        }, getData: function () {
                            var X = E.config, Y = X.fullPage, Z = Y && E.docType, aa = O.getFrameDocument(), ab = Y ? aa.getDocumentElement().getOuterHtml() : aa.getBody().getHtml();
                            if (E.dataProcessor)ab = E.dataProcessor.toDataFormat(ab, F);
                            if (X.ignoreEmptyParagraph)ab = ab.replace(n, function (ac, ad) {
                                return ad;

                            });
                            if (Z)ab = Z + '\n' + ab;
                            return ab;
                        }, getSnapshotData: function () {
                            return O.getFrameDocument().getBody().getHtml();
                        }, loadSnapshotData: function (X) {
                            O.getFrameDocument().getBody().setHtml(X);
                        }, onDispose: function () {
                            if (!E.document)return;
                            E.document.getDocumentElement().clearCustomData();
                            E.document.getBody().clearCustomData();
                            E.window.clearCustomData();
                            E.document.clearCustomData();
                            O.clearCustomData();
                            O.remove();
                        }, unload: function (X) {
                            this.onDispose();
                            E.window = E.document = O = N = Q = null;
                            E.fire('contentDomUnload');
                        }, focus: function () {
                            var X = E.window;
                            if (P)Q = true; else if (b.opera && E.document) {
                                var Y = E.window.$.frameElement;
                                Y.blur(), Y.focus();
                                E.document.getBody().focus();
                                E.selectionChange();
                            } else if (!b.opera && X) {
                                b.air ? setTimeout(function () {
                                    X.focus();
                                }, 0) : X.focus();
                                E.selectionChange();
                            }
                        }
                    });
                    E.on('insertHtml', r(s), null, null, 20);
                    E.on('insertElement', r(u), null, null, 20);
                    E.on('insertText', r(t), null, null, 20);
                    E.on('selectionChange', D, null, null, 1);
                });
                var I;
                E.on('contentDom', function () {
                    var N = E.document.getElementsByTag('title').getItem(0);
                    N.data('cke-title', E.document.$.title);
                    E.document.$.title = G;
                });
                if (b.ie8Compat) {
                    E.addCss('html.CSS1Compat [contenteditable=false]{ min-height:0 !important;}');
                    var J = [];
                    for (var K in f.$removeEmpty)J.push('html.CSS1Compat ' + K + '[contenteditable=false]');
                    E.addCss(J.join(',') + '{ display:inline-block;}');
                } else if (b.gecko)E.addCss('html { height: 100% !important; }');
                function L(N) {
                    e.tryThese(function () {
                        E.document.$.designMode = 'on';
                        setTimeout(function () {
                            E.document.$.designMode = 'off';
                            if (a.currentInstance == E)E.document.getBody().focus();
                        }, 50);
                    }, function () {
                        E.document.$.designMode = 'off';
                        var O = E.document.getBody();
                        O.setAttribute('contentEditable', false);
                        O.setAttribute('contentEditable', true);
                        !N && L(1);
                    });
                };
                if (b.gecko || c || b.opera) {
                    var M;
                    E.on('uiReady', function () {
                        M = E.container.append(h.createFromHtml('<span tabindex="-1" style="position:absolute;" role="presentation"></span>'));
                        M.on('focus', function () {
                            E.focus();
                        });
                    });
                    E.on('destroy', function () {
                        e.removeFunction(H);
                        M.clearCustomData();
                    });
                }
                E.on('insertElement', function (N) {
                    var O = N.data;
                    if (O.type == 1 && (O.is('input') || O.is('textarea')))if (!O.isReadOnly()) {
                        O.setAttribute('contentEditable', false);
                        O.setCustomData('_cke_notReadOnly', 1);
                    }
                });
            }
        });
        if (b.gecko)(function () {
            var E = document.body;
            if (!E)window.addEventListener('load', arguments.callee, false); else {
                var F = E.getAttribute('onpageshow');
                E.setAttribute('onpageshow', (F ? F + ';' : '') + 'event.persisted && (function(){' + 'var allInstances = CKEDITOR.instances, editor, doc;' + 'for ( var i in allInstances )' + '{' + '\teditor = allInstances[ i ];' + '\tdoc = editor.document;' + '\tif ( doc )' + '\t{' + '\t\tdoc.$.designMode = "off";' + '\t\tdoc.$.designMode = "on";' + '\t}' + '}' + '})();');

            }
        })();
    })();
    i.disableObjectResizing = false;
    i.disableNativeTableHandles = true;
    i.disableNativeSpellChecker = true;
    i.ignoreEmptyParagraph = true;
    j.add('wsc', {
        requires: ['dialog'], init: function (m) {
            var n = 'checkspell', o = m.addCommand(n, new a.dialogCommand(n));
            o.modes = {wysiwyg: !b.opera && !b.air && document.domain == window.location.hostname};
            m.ui.addButton('SpellChecker', {label: m.lang.spellCheck.toolbar, command: n});
            a.dialog.add(n, this.path + 'dialogs/wsc.js');
        }
    });
    i.wsc_customerId = i.wsc_customerId || '1:ua3xw1-2XyGJ3-GWruD3-6OFNT1-oXcuB1-nR6Bp4-hgQHc-EcYng3-sdRXG3-NOfFk';
    i.wsc_customLoaderScript = i.wsc_customLoaderScript || null;
    a.DIALOG_RESIZE_NONE = 0;
    a.DIALOG_RESIZE_WIDTH = 1;
    a.DIALOG_RESIZE_HEIGHT = 2;
    a.DIALOG_RESIZE_BOTH = 3;
    (function () {
        var m = e.cssLength;

        function n(P) {
            return !!this._.tabs[P][0].$.offsetHeight;
        };
        function o() {
            var T = this;
            var P = T._.currentTabId, Q = T._.tabIdList.length, R = e.indexOf(T._.tabIdList, P) + Q;
            for (var S = R - 1; S > R - Q; S--) {
                if (n.call(T, T._.tabIdList[S % Q]))return T._.tabIdList[S % Q];
            }
            return null;
        };
        function p() {
            var T = this;
            var P = T._.currentTabId, Q = T._.tabIdList.length, R = e.indexOf(T._.tabIdList, P);
            for (var S = R + 1; S < R + Q; S++) {
                if (n.call(T, T._.tabIdList[S % Q]))return T._.tabIdList[S % Q];
            }
            return null;
        };
        function q(P, Q) {
            var R = P.$.getElementsByTagName('input');
            for (var S = 0, T = R.length; S < T; S++) {
                var U = new h(R[S]);
                if (U.getAttribute('type').toLowerCase() == 'text')if (Q) {
                    U.setAttribute('value', U.getCustomData('fake_value') || '');
                    U.removeCustomData('fake_value');
                } else {
                    U.setCustomData('fake_value', U.getAttribute('value'));
                    U.setAttribute('value', '');
                }
            }
        };
        a.dialog = function (P, Q) {
            var R = a.dialog._.dialogDefinitions[Q], S = e.clone(s), T = P.config.dialog_buttonsOrder || 'OS', U = P.lang.dir;
            if (T == 'OS' && b.mac || T == 'rtl' && U == 'ltr' || T == 'ltr' && U == 'rtl')S.buttons.reverse();
            R = e.extend(R(P), S);
            R = e.clone(R);
            R = new w(this, R);
            var V = a.document, W = P.theme.buildDialog(P);
            this._ = {
                editor: P,
                element: W.element,
                name: Q,
                contentSize: {width: 0, height: 0},
                size: {width: 0, height: 0},
                contents: {},
                buttons: {},
                accessKeyMap: {},
                tabs: {},
                tabIdList: [],
                currentTabId: null,
                currentTabIndex: null,
                pageCount: 0,
                lastTab: null,
                tabBarMode: false,
                focusList: [],
                currentFocusIndex: 0,
                hasFocus: false
            };
            this.parts = W.parts;
            e.setTimeout(function () {
                P.fire('ariaWidget', this.parts.contents);
            }, 0, this);
            this.parts.dialog.setStyles({
                position: b.ie6Compat ? 'absolute' : 'fixed',
                top: 0,
                left: 0,
                visibility: 'hidden'
            });
            a.event.call(this);
            this.definition = R = a.fire('dialogDefinition', {name: Q, definition: R}, P).definition;
            var X = {};
            if (!('removeDialogTabs' in P._) && P.config.removeDialogTabs) {
                var Y = P.config.removeDialogTabs.split(';');

                for (i = 0; i < Y.length; i++) {
                    var Z = Y[i].split(':');
                    if (Z.length == 2) {
                        var aa = Z[0];
                        if (!X[aa])X[aa] = [];
                        X[aa].push(Z[1]);
                    }
                }
                P._.removeDialogTabs = X;
            }
            if (P._.removeDialogTabs && (X = P._.removeDialogTabs[Q]))for (i = 0; i < X.length; i++)R.removeContents(X[i]);
            if (R.onLoad)this.on('load', R.onLoad);
            if (R.onShow)this.on('show', R.onShow);
            if (R.onHide)this.on('hide', R.onHide);
            if (R.onOk)this.on('ok', function (an) {
                P.fire('saveSnapshot');
                setTimeout(function () {
                    P.fire('saveSnapshot');
                }, 0);
                if (R.onOk.call(this, an) === false)an.data.hide = false;
            });
            if (R.onCancel)this.on('cancel', function (an) {
                if (R.onCancel.call(this, an) === false)an.data.hide = false;
            });
            var ab = this, ac = function (an) {
                var ao = ab._.contents, ap = false;
                for (var aq in ao)for (var ar in ao[aq]) {
                    ap = an.call(this, ao[aq][ar]);
                    if (ap)return;
                }
            };
            this.on('ok', function (an) {
                ac(function (ao) {
                    if (ao.validate) {
                        var ap = ao.validate(this);
                        if (typeof ap == 'string') {
                            alert(ap);
                            ap = false;
                        }
                        if (ap === false) {
                            if (ao.select)ao.select(); else ao.focus();
                            an.data.hide = false;
                            an.stop();
                            return true;
                        }
                    }
                });
            }, this, null, 0);
            this.on('cancel', function (an) {
                ac(function (ao) {
                    if (ao.isChanged()) {
                        if (!confirm(P.lang.common.confirmCancel))an.data.hide = false;
                        return true;
                    }
                });
            }, this, null, 0);
            this.parts.close.on('click', function (an) {
                if (this.fire('cancel', {hide: true}).hide !== false)this.hide();
                an.data.preventDefault();
            }, this);
            function ad() {
                var an = ab._.focusList;
                an.sort(function (aq, ar) {
                    if (aq.tabIndex != ar.tabIndex)return ar.tabIndex - aq.tabIndex; else return aq.focusIndex - ar.focusIndex;
                });
                var ao = an.length;
                for (var ap = 0; ap < ao; ap++)an[ap].focusIndex = ap;
            };
            function ae(an) {
                var ao = ab._.focusList, ap = an ? 1 : -1;
                if (ao.length < 1)return;
                var aq = ab._.currentFocusIndex;
                try {
                    ao[aq].getInputElement().$.blur();
                } catch (at) {
                }
                var ar = (aq + ap + ao.length) % ao.length, as = ar;
                while (!ao[as].isFocusable()) {
                    as = (as + ap + ao.length) % ao.length;
                    if (as == ar)break;
                }
                ao[as].focus();
                if (ao[as].type == 'text')ao[as].select();
            };
            this.changeFocus = ae;
            var af;

            function ag(an) {
                var as = this;
                if (ab != a.dialog._.currentTop)return;
                var ao = an.data.getKeystroke(), ap = P.lang.dir == 'rtl';
                af = 0;
                if (ao == 9 || ao == 2000 + 9) {
                    var aq = ao == 2000 + 9;
                    if (ab._.tabBarMode) {
                        var ar = aq ? o.call(ab) : p.call(ab);
                        ab.selectPage(ar);
                        ab._.tabs[ar][0].focus();
                    } else ae(!aq);
                    af = 1;
                } else if (ao == 4000 + 121 && !ab._.tabBarMode && ab.getPageCount() > 1) {
                    ab._.tabBarMode = true;
                    ab._.tabs[ab._.currentTabId][0].focus();
                    af = 1;
                } else if ((ao == 37 || ao == 39) && ab._.tabBarMode) {
                    ar = ao == (ap ? 39 : 37) ? o.call(ab) : p.call(ab);
                    ab.selectPage(ar);
                    ab._.tabs[ar][0].focus();
                    af = 1;
                } else if ((ao == 13 || ao == 32) && ab._.tabBarMode) {
                    as.selectPage(as._.currentTabId);
                    as._.tabBarMode = false;
                    as._.currentFocusIndex = -1;

                    ae(true);
                    af = 1;
                }
                if (af) {
                    an.stop();
                    an.data.preventDefault();
                }
            };
            function ah(an) {
                af && an.data.preventDefault();
            };
            var ai = this._.element;
            this.on('show', function () {
                ai.on('keydown', ag, this, null, 0);
                if (b.opera || b.gecko && b.mac)ai.on('keypress', ah, this);
            });
            this.on('hide', function () {
                ai.removeListener('keydown', ag);
                if (b.opera || b.gecko && b.mac)ai.removeListener('keypress', ah);
            });
            this.on('iframeAdded', function (an) {
                var ao = new g(an.data.iframe.$.contentWindow.document);
                ao.on('keydown', ag, this, null, 0);
            });
            this.on('show', function () {
                var ar = this;
                ad();
                if (P.config.dialog_startupFocusTab && ab._.pageCount > 1) {
                    ab._.tabBarMode = true;
                    ab._.tabs[ab._.currentTabId][0].focus();
                } else if (!ar._.hasFocus) {
                    ar._.currentFocusIndex = -1;
                    if (R.onFocus) {
                        var an = R.onFocus.call(ar);
                        an && an.focus();
                    } else ae(true);
                    if (ar._.editor.mode == 'wysiwyg' && c) {
                        var ao = P.document.$.selection, ap = ao.createRange();
                        if (ap)if (ap.parentElement && ap.parentElement().ownerDocument == P.document.$ || ap.item && ap.item(0).ownerDocument == P.document.$) {
                            var aq = document.body.createTextRange();
                            aq.moveToElementText(ar.getElement().getFirst().$);
                            aq.collapse(true);
                            aq.select();
                        }
                    }
                }
            }, this, null, 4294967295);
            if (b.ie6Compat)this.on('load', function (an) {
                var ao = this.getElement(), ap = ao.getFirst();
                ap.remove();
                ap.appendTo(ao);
            }, this);
            y(this);
            z(this);
            new d.text(R.title, a.document).appendTo(this.parts.title);
            for (var aj = 0; aj < R.contents.length; aj++) {
                var ak = R.contents[aj];
                ak && this.addPage(ak);
            }
            this.parts.tabs.on('click', function (an) {
                var aq = this;
                var ao = an.data.getTarget();
                if (ao.hasClass('cke_dialog_tab')) {
                    var ap = ao.$.id;
                    aq.selectPage(ap.substring(4, ap.lastIndexOf('_')));
                    if (aq._.tabBarMode) {
                        aq._.tabBarMode = false;
                        aq._.currentFocusIndex = -1;
                        ae(true);
                    }
                    an.data.preventDefault();
                }
            }, this);
            var al = [], am = a.dialog._.uiElementBuilders.hbox.build(this, {
                type: 'hbox',
                className: 'cke_dialog_footer_buttons',
                widths: [],
                children: R.buttons
            }, al).getChild();
            this.parts.footer.setHtml(al.join(''));
            for (aj = 0; aj < am.length; aj++)this._.buttons[am[aj].id] = am[aj];
        };
        function r(P, Q, R) {
            this.element = Q;
            this.focusIndex = R;
            this.tabIndex = 0;
            this.isFocusable = function () {
                return !Q.getAttribute('disabled') && Q.isVisible();
            };
            this.focus = function () {
                P._.currentFocusIndex = this.focusIndex;
                this.element.focus();
            };
            Q.on('keydown', function (S) {
                if (S.data.getKeystroke() in {32: 1, 13: 1})this.fire('click');
            });
            Q.on('focus', function () {
                this.fire('mouseover');
            });
            Q.on('blur', function () {
                this.fire('mouseout');
            });
        };
        a.dialog.prototype = {
            destroy: function () {
                this.hide();
                this._.element.remove();
            }, resize: (function () {
                return function (P, Q) {
                    var R = this;
                    if (R._.contentSize && R._.contentSize.width == P && R._.contentSize.height == Q)return;

                    a.dialog.fire('resize', {dialog: R, skin: R._.editor.skinName, width: P, height: Q}, R._.editor);
                    R._.contentSize = {width: P, height: Q};
                };
            })(), getSize: function () {
                var P = this._.element.getFirst();
                return {width: P.$.offsetWidth || 0, height: P.$.offsetHeight || 0};
            }, move: (function () {
                var P;
                return function (Q, R, S) {
                    var V = this;
                    var T = V._.element.getFirst();
                    if (P === undefined)P = T.getComputedStyle('position') == 'fixed';
                    if (P && V._.position && V._.position.x == Q && V._.position.y == R)return;
                    V._.position = {x: Q, y: R};
                    if (!P) {
                        var U = a.document.getWindow().getScrollPosition();
                        Q += U.x;
                        R += U.y;
                    }
                    T.setStyles({left: (Q > 0 ? Q : 0) + 'px', top: (R > 0 ? R : 0) + 'px'});
                    S && (V._.moved = 1);
                };
            })(), getPosition: function () {
                return e.extend({}, this._.position);
            }, show: function () {
                var P = this._.editor;
                if (P.mode == 'wysiwyg' && c) {
                    var Q = P.getSelection();
                    Q && Q.lock();
                }
                var R = this._.element, S = this.definition;
                if (!(R.getParent() && R.getParent().equals(a.document.getBody())))R.appendTo(a.document.getBody()); else R.setStyle('display', 'block');
                if (b.gecko && b.version < 10900) {
                    var T = this.parts.dialog;
                    T.setStyle('position', 'absolute');
                    setTimeout(function () {
                        T.setStyle('position', 'fixed');
                    }, 0);
                }
                this.resize(this._.contentSize && this._.contentSize.width || S.minWidth, this._.contentSize && this._.contentSize.height || S.minHeight);
                this.reset();
                this.selectPage(this.definition.contents[0].id);
                if (a.dialog._.currentZIndex === null)a.dialog._.currentZIndex = this._.editor.config.baseFloatZIndex;
                this._.element.getFirst().setStyle('z-index', a.dialog._.currentZIndex += 10);
                if (a.dialog._.currentTop === null) {
                    a.dialog._.currentTop = this;
                    this._.parentDialog = null;
                    D(this._.editor);
                    R.on('keydown', H);
                    R.on(b.opera ? 'keypress' : 'keyup', I);
                    for (var U in {keyup: 1, keydown: 1, keypress: 1})R.on(U, O);
                } else {
                    this._.parentDialog = a.dialog._.currentTop;
                    var V = this._.parentDialog.getElement().getFirst();
                    V.$.style.zIndex -= Math.floor(this._.editor.config.baseFloatZIndex / 2);
                    a.dialog._.currentTop = this;
                }
                J(this, this, '\x1b', null, function () {
                    this.getButton('cancel') && this.getButton('cancel').click();
                });
                this._.hasFocus = false;
                e.setTimeout(function () {
                    this.layout();
                    this.parts.dialog.setStyle('visibility', '');
                    this.fireOnce('load', {});
                    k.fire('ready', this);
                    this.fire('show', {});
                    this._.editor.fire('dialogShow', this);
                    this.foreach(function (W) {
                        W.setInitValue && W.setInitValue();
                    });
                }, 100, this);
            }, layout: function () {
                var R = this;
                var P = a.document.getWindow().getViewPaneSize(), Q = R.getSize();
                R.move(R._.moved ? R._.position.x : (P.width - Q.width) / 2, R._.moved ? R._.position.y : (P.height - Q.height) / 2);
            }, foreach: function (P) {
                var S = this;
                for (var Q in S._.contents)for (var R in S._.contents[Q])P(S._.contents[Q][R]);

                return S;
            }, reset: (function () {
                var P = function (Q) {
                    if (Q.reset)Q.reset(1);
                };
                return function () {
                    this.foreach(P);
                    return this;
                };
            })(), setupContent: function () {
                var P = arguments;
                this.foreach(function (Q) {
                    if (Q.setup)Q.setup.apply(Q, P);
                });
            }, commitContent: function () {
                var P = arguments;
                this.foreach(function (Q) {
                    if (Q.commit)Q.commit.apply(Q, P);
                });
            }, hide: function () {
                if (!this.parts.dialog.isVisible())return;
                this.fire('hide', {});
                this._.editor.fire('dialogHide', this);
                var P = this._.element;
                P.setStyle('display', 'none');
                this.parts.dialog.setStyle('visibility', 'hidden');
                K(this);
                while (a.dialog._.currentTop != this)a.dialog._.currentTop.hide();
                if (!this._.parentDialog)E(); else {
                    var Q = this._.parentDialog.getElement().getFirst();
                    Q.setStyle('z-index', parseInt(Q.$.style.zIndex, 10) + Math.floor(this._.editor.config.baseFloatZIndex / 2));
                }
                a.dialog._.currentTop = this._.parentDialog;
                if (!this._.parentDialog) {
                    a.dialog._.currentZIndex = null;
                    P.removeListener('keydown', H);
                    P.removeListener(b.opera ? 'keypress' : 'keyup', I);
                    for (var R in {keyup: 1, keydown: 1, keypress: 1})P.removeListener(R, O);
                    var S = this._.editor;
                    S.focus();
                    if (S.mode == 'wysiwyg' && c) {
                        var T = S.getSelection();
                        T && T.unlock(true);
                    }
                } else a.dialog._.currentZIndex -= 10;
                delete this._.parentDialog;
                this.foreach(function (U) {
                    U.resetInitValue && U.resetInitValue();
                });
            }, addPage: function (P) {
                var ab = this;
                var Q = [], R = P.label ? ' title="' + e.htmlEncode(P.label) + '"' : '', S = P.elements, T = a.dialog._.uiElementBuilders.vbox.build(ab, {
                    type: 'vbox',
                    className: 'cke_dialog_page_contents',
                    children: P.elements,
                    expand: !!P.expand,
                    padding: P.padding,
                    style: P.style || 'width: 100%;'
                }, Q), U = h.createFromHtml(Q.join(''));
                U.setAttribute('role', 'tabpanel');
                var V = b, W = 'cke_' + P.id + '_' + e.getNextNumber(), X = h.createFromHtml(['<a class="cke_dialog_tab"', ab._.pageCount > 0 ? ' cke_last' : 'cke_first', R, !!P.hidden ? ' style="display:none"' : '', ' id="', W, '"', V.gecko && V.version >= 10900 && !V.hc ? '' : ' href="javascript:void(0)"', ' tabIndex="-1"', ' hidefocus="true"', ' role="tab">', P.label, '</a>'].join(''));
                U.setAttribute('aria-labelledby', W);
                ab._.tabs[P.id] = [X, U];
                ab._.tabIdList.push(P.id);
                !P.hidden && ab._.pageCount++;
                ab._.lastTab = X;
                ab.updateStyle();
                var Y = ab._.contents[P.id] = {}, Z, aa = T.getChild();
                while (Z = aa.shift()) {
                    Y[Z.id] = Z;
                    if (typeof Z.getChild == 'function')aa.push.apply(aa, Z.getChild());
                }
                U.setAttribute('name', P.id);
                U.appendTo(ab.parts.contents);
                X.unselectable();
                ab.parts.tabs.append(X);
                if (P.accessKey) {
                    J(ab, ab, 'CTRL+' + P.accessKey, M, L);
                    ab._.accessKeyMap['CTRL+' + P.accessKey] = P.id;
                }
            }, selectPage: function (P) {
                if (this._.currentTabId == P)return;
                if (this.fire('selectPage', {page: P, currentPage: this._.currentTabId}) === true)return;

                for (var Q in this._.tabs) {
                    var R = this._.tabs[Q][0], S = this._.tabs[Q][1];
                    if (Q != P) {
                        R.removeClass('cke_dialog_tab_selected');
                        S.hide();
                    }
                    S.setAttribute('aria-hidden', Q != P);
                }
                var T = this._.tabs[P];
                T[0].addClass('cke_dialog_tab_selected');
                if (b.ie6Compat || b.ie7Compat) {
                    q(T[1]);
                    T[1].show();
                    setTimeout(function () {
                        q(T[1], 1);
                    }, 0);
                } else T[1].show();
                this._.currentTabId = P;
                this._.currentTabIndex = e.indexOf(this._.tabIdList, P);
            }, updateStyle: function () {
                this.parts.dialog[(this._.pageCount === 1 ? 'add' : 'remove') + 'Class']('cke_single_page');
            }, hidePage: function (P) {
                var R = this;
                var Q = R._.tabs[P] && R._.tabs[P][0];
                if (!Q || R._.pageCount == 1 || !Q.isVisible())return; else if (P == R._.currentTabId)R.selectPage(o.call(R));
                Q.hide();
                R._.pageCount--;
                R.updateStyle();
            }, showPage: function (P) {
                var R = this;
                var Q = R._.tabs[P] && R._.tabs[P][0];
                if (!Q)return;
                Q.show();
                R._.pageCount++;
                R.updateStyle();
            }, getElement: function () {
                return this._.element;
            }, getName: function () {
                return this._.name;
            }, getContentElement: function (P, Q) {
                var R = this._.contents[P];
                return R && R[Q];
            }, getValueOf: function (P, Q) {
                return this.getContentElement(P, Q).getValue();
            }, setValueOf: function (P, Q, R) {
                return this.getContentElement(P, Q).setValue(R);
            }, getButton: function (P) {
                return this._.buttons[P];
            }, click: function (P) {
                return this._.buttons[P].click();
            }, disableButton: function (P) {
                return this._.buttons[P].disable();
            }, enableButton: function (P) {
                return this._.buttons[P].enable();
            }, getPageCount: function () {
                return this._.pageCount;
            }, getParentEditor: function () {
                return this._.editor;
            }, getSelectedElement: function () {
                return this.getParentEditor().getSelection().getSelectedElement();
            }, addFocusable: function (P, Q) {
                var S = this;
                if (typeof Q == 'undefined') {
                    Q = S._.focusList.length;
                    S._.focusList.push(new r(S, P, Q));
                } else {
                    S._.focusList.splice(Q, 0, new r(S, P, Q));
                    for (var R = Q + 1; R < S._.focusList.length; R++)S._.focusList[R].focusIndex++;
                }
            }
        };
        e.extend(a.dialog, {
            add: function (P, Q) {
                if (!this._.dialogDefinitions[P] || typeof Q == 'function')this._.dialogDefinitions[P] = Q;
            }, exists: function (P) {
                return !!this._.dialogDefinitions[P];
            }, getCurrent: function () {
                return a.dialog._.currentTop;
            }, okButton: (function () {
                var P = function (Q, R) {
                    R = R || {};
                    return e.extend({
                        id: 'ok',
                        type: 'button',
                        label: Q.lang.common.ok,
                        'class': 'cke_dialog_ui_button_ok',
                        onClick: function (S) {
                            var T = S.data.dialog;
                            if (T.fire('ok', {hide: true}).hide !== false)T.hide();
                        }
                    }, R, true);
                };
                P.type = 'button';
                P.override = function (Q) {
                    return e.extend(function (R) {
                        return P(R, Q);
                    }, {type: 'button'}, true);
                };
                return P;
            })(), cancelButton: (function () {
                var P = function (Q, R) {
                    R = R || {};
                    return e.extend({
                        id: 'cancel',
                        type: 'button',
                        label: Q.lang.common.cancel,
                        'class': 'cke_dialog_ui_button_cancel',
                        onClick: function (S) {
                            var T = S.data.dialog;

                            if (T.fire('cancel', {hide: true}).hide !== false)T.hide();
                        }
                    }, R, true);
                };
                P.type = 'button';
                P.override = function (Q) {
                    return e.extend(function (R) {
                        return P(R, Q);
                    }, {type: 'button'}, true);
                };
                return P;
            })(), addUIElement: function (P, Q) {
                this._.uiElementBuilders[P] = Q;
            }
        });
        a.dialog._ = {uiElementBuilders: {}, dialogDefinitions: {}, currentTop: null, currentZIndex: null};
        a.event.implementOn(a.dialog);
        a.event.implementOn(a.dialog.prototype, true);
        var s = {
            resizable: 3,
            minWidth: 600,
            minHeight: 400,
            buttons: [a.dialog.okButton, a.dialog.cancelButton]
        }, t = function (P, Q, R) {
            for (var S = 0, T; T = P[S]; S++) {
                if (T.id == Q)return T;
                if (R && T[R]) {
                    var U = t(T[R], Q, R);
                    if (U)return U;
                }
            }
            return null;
        }, u = function (P, Q, R, S, T) {
            if (R) {
                for (var U = 0, V; V = P[U]; U++) {
                    if (V.id == R) {
                        P.splice(U, 0, Q);
                        return Q;
                    }
                    if (S && V[S]) {
                        var W = u(V[S], Q, R, S, true);
                        if (W)return W;
                    }
                }
                if (T)return null;
            }
            P.push(Q);
            return Q;
        }, v = function (P, Q, R) {
            for (var S = 0, T; T = P[S]; S++) {
                if (T.id == Q)return P.splice(S, 1);
                if (R && T[R]) {
                    var U = v(T[R], Q, R);
                    if (U)return U;
                }
            }
            return null;
        }, w = function (P, Q) {
            this.dialog = P;
            var R = Q.contents;
            for (var S = 0, T; T = R[S]; S++)R[S] = T && new x(P, T);
            e.extend(this, Q);
        };
        w.prototype = {
            getContents: function (P) {
                return t(this.contents, P);
            }, getButton: function (P) {
                return t(this.buttons, P);
            }, addContents: function (P, Q) {
                return u(this.contents, P, Q);
            }, addButton: function (P, Q) {
                return u(this.buttons, P, Q);
            }, removeContents: function (P) {
                v(this.contents, P);
            }, removeButton: function (P) {
                v(this.buttons, P);
            }
        };
        function x(P, Q) {
            this._ = {dialog: P};
            e.extend(this, Q);
        };
        x.prototype = {
            get: function (P) {
                return t(this.elements, P, 'children');
            }, add: function (P, Q) {
                return u(this.elements, P, Q, 'children');
            }, remove: function (P) {
                v(this.elements, P, 'children');
            }
        };
        function y(P) {
            var Q = null, R = null, S = P.getElement().getFirst(), T = P.getParentEditor(), U = T.config.dialog_magnetDistance, V = T.skin.margins || [0, 0, 0, 0];
            if (typeof U == 'undefined')U = 20;
            function W(Y) {
                var Z = P.getSize(), aa = a.document.getWindow().getViewPaneSize(), ab = Y.data.$.screenX, ac = Y.data.$.screenY, ad = ab - Q.x, ae = ac - Q.y, af, ag;
                Q = {x: ab, y: ac};
                R.x += ad;
                R.y += ae;
                if (R.x + V[3] < U)af = -V[3]; else if (R.x - V[1] > aa.width - Z.width - U)af = aa.width - Z.width + (T.lang.dir == 'rtl' ? 0 : V[1]); else af = R.x;
                if (R.y + V[0] < U)ag = -V[0]; else if (R.y - V[2] > aa.height - Z.height - U)ag = aa.height - Z.height + V[2]; else ag = R.y;
                P.move(af, ag, 1);
                Y.data.preventDefault();
            };
            function X(Y) {
                a.document.removeListener('mousemove', W);
                a.document.removeListener('mouseup', X);
                if (b.ie6Compat) {
                    var Z = C.getChild(0).getFrameDocument();
                    Z.removeListener('mousemove', W);
                    Z.removeListener('mouseup', X);
                }
            };
            P.parts.title.on('mousedown', function (Y) {
                Q = {x: Y.data.$.screenX, y: Y.data.$.screenY};

                a.document.on('mousemove', W);
                a.document.on('mouseup', X);
                R = P.getPosition();
                if (b.ie6Compat) {
                    var Z = C.getChild(0).getFrameDocument();
                    Z.on('mousemove', W);
                    Z.on('mouseup', X);
                }
                Y.data.preventDefault();
            }, P);
        };
        function z(P) {
            var Q = P.definition, R = Q.resizable;
            if (R == 0)return;
            var S = P.getParentEditor(), T, U, V, W, X;

            function Y(ac) {
                if (P._.moved && S.lang.dir == 'rtl') {
                    var ad = P._.element.getFirst();
                    ad.setStyle('right', ac + 'px');
                    ad.removeStyle('left');
                } else if (!P._.moved)P.layout();
            };
            var Z = e.addFunction(function (ac) {
                X = P.getSize();
                U = X.height - P.parts.contents.getSize('height', !(b.gecko || b.opera || c && b.quirks));
                T = X.width - P.parts.contents.getSize('width', 1);
                W = {x: ac.screenX, y: ac.screenY};
                V = a.document.getWindow().getViewPaneSize();
                a.document.on('mousemove', aa);
                a.document.on('mouseup', ab);
                if (b.ie6Compat) {
                    var ad = C.getChild(0).getFrameDocument();
                    ad.on('mousemove', aa);
                    ad.on('mouseup', ab);
                }
                ac.preventDefault && ac.preventDefault();
            });
            P.on('load', function () {
                var ac = '';
                if (R == 1)ac = ' cke_resizer_horizontal'; else if (R == 2)ac = ' cke_resizer_vertical';
                var ad = h.createFromHtml('<div class="cke_resizer' + ac + '"' + ' title="' + e.htmlEncode(S.lang.resize) + '"' + ' onmousedown="CKEDITOR.tools.callFunction(' + Z + ', event )"></div>');
                P.parts.footer.append(ad, 1);
            });
            S.on('destroy', function () {
                e.removeFunction(Z);
            });
            function aa(ac) {
                var ad = S.lang.dir == 'rtl', ae = (ac.data.$.screenX - W.x) * (ad ? -1 : 1), af = ac.data.$.screenY - W.y, ag = X.width, ah = X.height, ai = ag + ae * (P._.moved ? 1 : 2), aj = ah + af * (P._.moved ? 1 : 2), ak = P._.element.getFirst(), al = ad && ak.getComputedStyle('right'), am = P.getPosition();
                if (al)al = al == 'auto' ? V.width - (am.x || 0) - ak.getSize('width') : parseInt(al, 10);
                if (am.y + aj > V.height)aj = V.height - am.y;
                if ((ad ? al : am.x) + ai > V.width)ai = V.width - (ad ? al : am.x);
                if ((R == 1 || R == 3) && !(ad && ae > 0 && !am.x))ag = Math.max(Q.minWidth || 0, ai - T);
                if (R == 2 || R == 3)ah = Math.max(Q.minHeight || 0, aj - U);
                P.resize(ag, ah);
                Y(al);
                ac.data.preventDefault();
            };
            function ab() {
                a.document.removeListener('mouseup', ab);
                a.document.removeListener('mousemove', aa);
                if (b.ie6Compat) {
                    var ac = C.getChild(0).getFrameDocument();
                    ac.removeListener('mouseup', ab);
                    ac.removeListener('mousemove', aa);
                }
                if (S.lang.dir == 'rtl') {
                    var ad = P._.element.getFirst(), ae = ad.getComputedStyle('left');
                    if (ae == 'auto')ae = V.width - parseInt(ad.getStyle('right'), 10) - P.getSize().width; else ae = parseInt(ae, 10);
                    ad.removeStyle('right');
                    P._.position.x += 1;
                    P.move(ae, P._.position.y);
                }
            };
        };
        var A, B = {}, C;

        function D(P) {
            var Q = a.document.getWindow(), R = P.config, S = R.dialog_backgroundCoverColor || 'white', T = R.dialog_backgroundCoverOpacity, U = R.baseFloatZIndex, V = e.genKey(S, T, U), W = B[V];

            if (!W) {
                var X = ['<div style="position: ', b.ie6Compat ? 'absolute' : 'fixed', '; z-index: ', U, '; top: 0px; left: 0px; ', !b.ie6Compat ? 'background-color: ' + S : '', '" class="cke_dialog_background_cover">'];
                if (b.ie6Compat) {
                    var Y = b.isCustomDomain(), Z = "<html><body style=\\'background-color:" + S + ";\\'></body></html>";
                    X.push('<iframe hidefocus="true" frameborder="0" id="cke_dialog_background_iframe" src="javascript:');
                    X.push('void((function(){document.open();' + (Y ? "document.domain='" + document.domain + "';" : '') + "document.write( '" + Z + "' );" + 'document.close();' + '})())');
                    X.push('" style="position:absolute;left:0;top:0;width:100%;height: 100%;progid:DXImageTransform.Microsoft.Alpha(opacity=0)"></iframe>');
                }
                X.push('</div>');
                W = h.createFromHtml(X.join(''));
                W.setOpacity(T != undefined ? T : 0.5);
                W.appendTo(a.document.getBody());
                B[V] = W;
            } else W.show();
            C = W;
            var aa = function () {
                var ad = Q.getViewPaneSize();
                W.setStyles({width: ad.width + 'px', height: ad.height + 'px'});
            }, ab = function () {
                var ad = Q.getScrollPosition(), ae = a.dialog._.currentTop;
                W.setStyles({left: ad.x + 'px', top: ad.y + 'px'});
                do {
                    var af = ae.getPosition();
                    ae.move(af.x, af.y);
                } while (ae = ae._.parentDialog)
            };
            A = aa;
            Q.on('resize', aa);
            aa();
            if (b.ie6Compat) {
                var ac = function () {
                    ab();
                    arguments.callee.prevScrollHandler.apply(this, arguments);
                };
                Q.$.setTimeout(function () {
                    ac.prevScrollHandler = window.onscroll || (function () {
                    });
                    window.onscroll = ac;
                }, 0);
                ab();
            }
        };
        function E() {
            if (!C)return;
            var P = a.document.getWindow();
            C.hide();
            P.removeListener('resize', A);
            if (b.ie6Compat)P.$.setTimeout(function () {
                var Q = window.onscroll && window.onscroll.prevScrollHandler;
                window.onscroll = Q || null;
            }, 0);
            A = null;
        };
        function F() {
            for (var P in B)B[P].remove();
            B = {};
        };
        var G = {}, H = function (P) {
            var Q = P.data.$.ctrlKey || P.data.$.metaKey, R = P.data.$.altKey, S = P.data.$.shiftKey, T = String.fromCharCode(P.data.$.keyCode), U = G[(Q ? 'CTRL+' : '') + (R ? 'ALT+' : '') + (S ? 'SHIFT+' : '') + T];
            if (!U || !U.length)return;
            U = U[U.length - 1];
            U.keydown && U.keydown.call(U.uiElement, U.dialog, U.key);
            P.data.preventDefault();
        }, I = function (P) {
            var Q = P.data.$.ctrlKey || P.data.$.metaKey, R = P.data.$.altKey, S = P.data.$.shiftKey, T = String.fromCharCode(P.data.$.keyCode), U = G[(Q ? 'CTRL+' : '') + (R ? 'ALT+' : '') + (S ? 'SHIFT+' : '') + T];
            if (!U || !U.length)return;
            U = U[U.length - 1];
            if (U.keyup) {
                U.keyup.call(U.uiElement, U.dialog, U.key);
                P.data.preventDefault();
            }
        }, J = function (P, Q, R, S, T) {
            var U = G[R] || (G[R] = []);
            U.push({uiElement: P, dialog: Q, key: R, keyup: T || P.accessKeyUp, keydown: S || P.accessKeyDown});
        }, K = function (P) {
            for (var Q in G) {
                var R = G[Q];
                for (var S = R.length - 1; S >= 0; S--) {
                    if (R[S].dialog == P || R[S].uiElement == P)R.splice(S, 1);

                }
                if (R.length === 0)delete G[Q];
            }
        }, L = function (P, Q) {
            if (P._.accessKeyMap[Q])P.selectPage(P._.accessKeyMap[Q]);
        }, M = function (P, Q) {
        }, N = {27: 1, 13: 1}, O = function (P) {
            if (P.data.getKeystroke() in N)P.data.stopPropagation();
        };
        (function () {
            k.dialog = {
                uiElement: function (P, Q, R, S, T, U, V) {
                    if (arguments.length < 4)return;
                    var W = (S.call ? S(Q) : S) || 'div', X = ['<', W, ' '], Y = (T && T.call ? T(Q) : T) || {}, Z = (U && U.call ? U(Q) : U) || {}, aa = (V && V.call ? V.call(this, P, Q) : V) || '', ab = this.domId = Z.id || e.getNextId() + '_uiElement', ac = this.id = Q.id, ad;
                    Z.id = ab;
                    var ae = {};
                    if (Q.type)ae['cke_dialog_ui_' + Q.type] = 1;
                    if (Q.className)ae[Q.className] = 1;
                    var af = Z['class'] && Z['class'].split ? Z['class'].split(' ') : [];
                    for (ad = 0; ad < af.length; ad++) {
                        if (af[ad])ae[af[ad]] = 1;
                    }
                    var ag = [];
                    for (ad in ae)ag.push(ad);
                    Z['class'] = ag.join(' ');
                    if (Q.title)Z.title = Q.title;
                    var ah = (Q.style || '').split(';');
                    for (ad in Y)ah.push(ad + ':' + Y[ad]);
                    if (Q.hidden)ah.push('display:none');
                    for (ad = ah.length - 1; ad >= 0; ad--) {
                        if (ah[ad] === '')ah.splice(ad, 1);
                    }
                    if (ah.length > 0)Z.style = (Z.style ? Z.style + '; ' : '') + ah.join('; ');
                    for (ad in Z)X.push(ad + '="' + e.htmlEncode(Z[ad]) + '" ');
                    X.push('>', aa, '</', W, '>');
                    R.push(X.join(''));
                    (this._ || (this._ = {})).dialog = P;
                    if (typeof Q.isChanged == 'boolean')this.isChanged = function () {
                        return Q.isChanged;
                    };
                    if (typeof Q.isChanged == 'function')this.isChanged = Q.isChanged;
                    a.event.implementOn(this);
                    this.registerEvents(Q);
                    if (this.accessKeyUp && this.accessKeyDown && Q.accessKey)J(this, P, 'CTRL+' + Q.accessKey);
                    var ai = this;
                    P.on('load', function () {
                        if (ai.getInputElement())ai.getInputElement().on('focus', function () {
                            P._.tabBarMode = false;
                            P._.hasFocus = true;
                            ai.fire('focus');
                        }, ai);
                    });
                    if (this.keyboardFocusable) {
                        this.tabIndex = Q.tabIndex || 0;
                        this.focusIndex = P._.focusList.push(this) - 1;
                        this.on('focus', function () {
                            P._.currentFocusIndex = ai.focusIndex;
                        });
                    }
                    e.extend(this, Q);
                }, hbox: function (P, Q, R, S, T) {
                    if (arguments.length < 4)return;
                    this._ || (this._ = {});
                    var U = this._.children = Q, V = T && T.widths || null, W = T && T.height || null, X = {}, Y, Z = function () {
                        var ab = ['<tbody><tr class="cke_dialog_ui_hbox">'];
                        for (Y = 0; Y < R.length; Y++) {
                            var ac = 'cke_dialog_ui_hbox_child', ad = [];
                            if (Y === 0)ac = 'cke_dialog_ui_hbox_first';
                            if (Y == R.length - 1)ac = 'cke_dialog_ui_hbox_last';
                            ab.push('<td class="', ac, '" role="presentation" ');
                            if (V) {
                                if (V[Y])ad.push('width:' + m(V[Y]));
                            } else ad.push('width:' + Math.floor(100 / R.length) + '%');
                            if (W)ad.push('height:' + m(W));
                            if (T && T.padding != undefined)ad.push('padding:' + m(T.padding));
                            if (ad.length > 0)ab.push('style="' + ad.join('; ') + '" ');
                            ab.push('>', R[Y], '</td>');
                        }
                        ab.push('</tr></tbody>');
                        return ab.join('');
                    }, aa = {role: 'presentation'};

                    T && T.align && (aa.align = T.align);
                    k.dialog.uiElement.call(this, P, T || {type: 'hbox'}, S, 'table', X, aa, Z);
                }, vbox: function (P, Q, R, S, T) {
                    if (arguments.length < 3)return;
                    this._ || (this._ = {});
                    var U = this._.children = Q, V = T && T.width || null, W = T && T.heights || null, X = function () {
                        var Y = ['<table role="presentation" cellspacing="0" border="0" '];
                        Y.push('style="');
                        if (T && T.expand)Y.push('height:100%;');
                        Y.push('width:' + m(V || '100%'), ';');
                        Y.push('"');
                        Y.push('align="', e.htmlEncode(T && T.align || (P.getParentEditor().lang.dir == 'ltr' ? 'left' : 'right')), '" ');
                        Y.push('><tbody>');
                        for (var Z = 0; Z < R.length; Z++) {
                            var aa = [];
                            Y.push('<tr><td role="presentation" ');
                            if (V)aa.push('width:' + m(V || '100%'));
                            if (W)aa.push('height:' + m(W[Z])); else if (T && T.expand)aa.push('height:' + Math.floor(100 / R.length) + '%');
                            if (T && T.padding != undefined)aa.push('padding:' + m(T.padding));
                            if (aa.length > 0)Y.push('style="', aa.join('; '), '" ');
                            Y.push(' class="cke_dialog_ui_vbox_child">', R[Z], '</td></tr>');
                        }
                        Y.push('</tbody></table>');
                        return Y.join('');
                    };
                    k.dialog.uiElement.call(this, P, T || {type: 'vbox'}, S, 'div', null, {role: 'presentation'}, X);
                }
            };
        })();
        k.dialog.uiElement.prototype = {
            getElement: function () {
                return a.document.getById(this.domId);
            }, getInputElement: function () {
                return this.getElement();
            }, getDialog: function () {
                return this._.dialog;
            }, setValue: function (P, Q) {
                this.getInputElement().setValue(P);
                !Q && this.fire('change', {value: P});
                return this;
            }, getValue: function () {
                return this.getInputElement().getValue();
            }, isChanged: function () {
                return false;
            }, selectParentTab: function () {
                var S = this;
                var P = S.getInputElement(), Q = P, R;
                while ((Q = Q.getParent()) && Q.$.className.search('cke_dialog_page_contents') == -1) {
                }
                if (!Q)return S;
                R = Q.getAttribute('name');
                if (S._.dialog._.currentTabId != R)S._.dialog.selectPage(R);
                return S;
            }, focus: function () {
                this.selectParentTab().getInputElement().focus();
                return this;
            }, registerEvents: function (P) {
                var Q = /^on([A-Z]\w+)/, R, S = function (U, V, W, X) {
                    V.on('load', function () {
                        U.getInputElement().on(W, X, U);
                    });
                };
                for (var T in P) {
                    if (!(R = T.match(Q)))continue;
                    if (this.eventProcessors[T])this.eventProcessors[T].call(this, this._.dialog, P[T]); else S(this, this._.dialog, R[1].toLowerCase(), P[T]);
                }
                return this;
            }, eventProcessors: {
                onLoad: function (P, Q) {
                    P.on('load', Q, this);
                }, onShow: function (P, Q) {
                    P.on('show', Q, this);
                }, onHide: function (P, Q) {
                    P.on('hide', Q, this);
                }
            }, accessKeyDown: function (P, Q) {
                this.focus();
            }, accessKeyUp: function (P, Q) {
            }, disable: function () {
                var P = this.getInputElement();
                P.setAttribute('disabled', 'true');
                P.addClass('cke_disabled');
            }, enable: function () {
                var P = this.getInputElement();
                P.removeAttribute('disabled');

                P.removeClass('cke_disabled');
            }, isEnabled: function () {
                return !this.getInputElement().getAttribute('disabled');
            }, isVisible: function () {
                return this.getInputElement().isVisible();
            }, isFocusable: function () {
                if (!this.isEnabled() || !this.isVisible())return false;
                return true;
            }
        };
        k.dialog.hbox.prototype = e.extend(new k.dialog.uiElement(), {
            getChild: function (P) {
                var Q = this;
                if (arguments.length < 1)return Q._.children.concat();
                if (!P.splice)P = [P];
                if (P.length < 2)return Q._.children[P[0]]; else return Q._.children[P[0]] && Q._.children[P[0]].getChild ? Q._.children[P[0]].getChild(P.slice(1, P.length)) : null;
            }
        }, true);
        k.dialog.vbox.prototype = new k.dialog.hbox();
        (function () {
            var P = {
                build: function (Q, R, S) {
                    var T = R.children, U, V = [], W = [];
                    for (var X = 0; X < T.length && (U = T[X]); X++) {
                        var Y = [];
                        V.push(Y);
                        W.push(a.dialog._.uiElementBuilders[U.type].build(Q, U, Y));
                    }
                    return new k.dialog[R.type](Q, W, V, S, R);
                }
            };
            a.dialog.addUIElement('hbox', P);
            a.dialog.addUIElement('vbox', P);
        })();
        a.dialogCommand = function (P) {
            this.dialogName = P;
        };
        a.dialogCommand.prototype = {
            exec: function (P) {
                P.openDialog(this.dialogName);
            }, canUndo: false, editorFocus: c || b.webkit
        };
        (function () {
            var P = /^([a]|[^a])+$/, Q = /^\d*$/, R = /^\d*(?:\.\d+)?$/;
            a.VALIDATE_OR = 1;
            a.VALIDATE_AND = 2;
            a.dialog.validate = {
                functions: function () {
                    return function () {
                        var Y = this;
                        var S = Y && Y.getValue ? Y.getValue() : arguments[0], T = undefined, U = 2, V = [], W;
                        for (W = 0; W < arguments.length; W++) {
                            if (typeof arguments[W] == 'function')V.push(arguments[W]); else break;
                        }
                        if (W < arguments.length && typeof arguments[W] == 'string') {
                            T = arguments[W];
                            W++;
                        }
                        if (W < arguments.length && typeof arguments[W] == 'number')U = arguments[W];
                        var X = U == 2 ? true : false;
                        for (W = 0; W < V.length; W++) {
                            if (U == 2)X = X && V[W](S); else X = X || V[W](S);
                        }
                        if (!X) {
                            if (T !== undefined)alert(T);
                            if (Y && (Y.select || Y.focus))Y.select || Y.focus();
                            return false;
                        }
                        return true;
                    };
                }, regex: function (S, T) {
                    return function () {
                        var V = this;
                        var U = V && V.getValue ? V.getValue() : arguments[0];
                        if (!S.test(U)) {
                            if (T !== undefined)alert(T);
                            if (V && (V.select || V.focus))if (V.select)V.select(); else V.focus();
                            return false;
                        }
                        return true;
                    };
                }, notEmpty: function (S) {
                    return this.regex(P, S);
                }, integer: function (S) {
                    return this.regex(Q, S);
                }, number: function (S) {
                    return this.regex(R, S);
                }, equals: function (S, T) {
                    return this.functions(function (U) {
                        return U == S;
                    }, T);
                }, notEqual: function (S, T) {
                    return this.functions(function (U) {
                        return U != S;
                    }, T);
                }
            };
            a.on('instanceDestroyed', function (S) {
                if (e.isEmpty(a.instances)) {
                    var T;
                    while (T = a.dialog._.currentTop)T.hide();
                    F();
                }
                var U = S.editor._.storedDialogs;
                for (var V in U)U[V].destroy();
            });
        })();
    })();
    e.extend(a.editor.prototype, {
        openDialog: function (m, n) {
            var o = a.dialog._.dialogDefinitions[m], p = this.skin.dialog;

            if (typeof o == 'function' && p._isLoaded) {
                var q = this._.storedDialogs || (this._.storedDialogs = {}), r = q[m] || (q[m] = new a.dialog(this, m));
                n && n.call(r, r);
                r.show();
                return r;
            } else if (o == 'failed')throw new Error('[CKEDITOR.dialog.openDialog] Dialog "' + m + '" failed when loading definition.');
            var s = a.document.getBody(), t = s.$.style.cursor, u = this;
            s.setStyle('cursor', 'wait');
            function v(x) {
                var y = a.dialog._.dialogDefinitions[m], z = u.skin.dialog;
                if (!z._isLoaded || w && typeof x == 'undefined')return;
                if (typeof y != 'function')a.dialog._.dialogDefinitions[m] = 'failed';
                u.openDialog(m, n);
                s.setStyle('cursor', t);
            };
            if (typeof o == 'string') {
                var w = 1;
                a.scriptLoader.load(a.getUrl(o), v);
            }
            a.skins.load(this, 'dialog', v);
            return null;
        }
    });
    j.add('dialog', {requires: ['dialogui']});
    j.add('styles', {
        requires: ['selection'], init: function (m) {
            m.on('contentDom', function () {
                m.document.setCustomData('cke_includeReadonly', !m.config.disableReadonlyStyling);
            });
        }
    });
    a.editor.prototype.attachStyleStateChange = function (m, n) {
        var o = this._.styleStateChangeCallbacks;
        if (!o) {
            o = this._.styleStateChangeCallbacks = [];
            this.on('selectionChange', function (p) {
                for (var q = 0; q < o.length; q++) {
                    var r = o[q], s = r.style.checkActive(p.data.path) ? 1 : 2;
                    if (r.state !== s) {
                        r.fn.call(this, s);
                        r.state = s;
                    }
                }
            });
        }
        o.push({style: m, fn: n});
    };
    a.STYLE_BLOCK = 1;
    a.STYLE_INLINE = 2;
    a.STYLE_OBJECT = 3;
    (function () {
        var m = {address: 1, div: 1, h1: 1, h2: 1, h3: 1, h4: 1, h5: 1, h6: 1, p: 1, pre: 1}, n = {
            a: 1,
            embed: 1,
            hr: 1,
            img: 1,
            li: 1,
            object: 1,
            ol: 1,
            table: 1,
            td: 1,
            tr: 1,
            th: 1,
            ul: 1,
            dl: 1,
            dt: 1,
            dd: 1,
            form: 1
        }, o = /\s*(?:;\s*|$)/;
        a.style = function (R, S) {
            if (S) {
                R = e.clone(R);
                J(R.attributes, S);
                J(R.styles, S);
            }
            var T = this.element = (R.element || '*').toLowerCase();
            this.type = T == '#' || m[T] ? 1 : n[T] ? 3 : 2;
            this._ = {definition: R};
        };
        a.style.prototype = {
            apply: function (R) {
                Q.call(this, R, false);
            }, remove: function (R) {
                Q.call(this, R, true);
            }, applyToRange: function (R) {
                var S = this;
                return (S.applyToRange = S.type == 2 ? q : S.type == 1 ? u : S.type == 3 ? s : null).call(S, R);
            }, removeFromRange: function (R) {
                var S = this;
                return (S.removeFromRange = S.type == 2 ? r : S.type == 3 ? t : null).call(S, R);
            }, applyToObject: function (R) {
                H(R, this);
            }, checkActive: function (R) {
                var V = this;
                switch (V.type) {
                    case 1:
                        return V.checkElementRemovable(R.block || R.blockLimit, true);
                    case 3:
                    case 2:
                        var S = R.elements;
                        for (var T = 0, U; T < S.length; T++) {
                            U = S[T];
                            if (V.type == 2 && (U == R.block || U == R.blockLimit))continue;
                            if (V.type == 3 && !(U.getName() in n))continue;
                            if (V.checkElementRemovable(U, true))return true;
                        }
                }
                return false;
            }, checkApplicable: function (R) {
                switch (this.type) {
                    case 2:
                    case 1:
                        break;
                    case 3:
                        return R.lastElement.getAscendant(this.element, true);
                }
                return true;

            }, checkElementRemovable: function (R, S) {
                if (!R)return false;
                var T = this._.definition, U;
                if (R.getName() == this.element) {
                    if (!S && !R.hasAttributes())return true;
                    U = K(T);
                    if (U._length) {
                        for (var V in U) {
                            if (V == '_length')continue;
                            var W = R.getAttribute(V) || '';
                            if (V == 'style' ? P(U[V], N(W, false)) : U[V] == W) {
                                if (!S)return true;
                            } else if (S)return false;
                        }
                        if (S)return true;
                    } else return true;
                }
                var X = L(this)[R.getName()];
                if (X) {
                    if (!(U = X.attributes))return true;
                    for (var Y = 0; Y < U.length; Y++) {
                        V = U[Y][0];
                        var Z = R.getAttribute(V);
                        if (Z) {
                            var aa = U[Y][1];
                            if (aa === null || typeof aa == 'string' && Z == aa || aa.test(Z))return true;
                        }
                    }
                }
                return false;
            }, buildPreview: function () {
                var R = this._.definition, S = [], T = R.element;
                if (T == 'bdo')T = 'span';
                S = ['<', T];
                var U = R.attributes;
                if (U)for (var V in U)S.push(' ', V, '="', U[V], '"');
                var W = a.style.getStyleText(R);
                if (W)S.push(' style="', W, '"');
                S.push('>', R.name, '</', T, '>');
                return S.join('');
            }
        };
        a.style.getStyleText = function (R) {
            var S = R._ST;
            if (S)return S;
            S = R.styles;
            var T = R.attributes && R.attributes.style || '', U = '';
            if (T.length)T = T.replace(o, ';');
            for (var V in S) {
                var W = S[V], X = (V + ':' + W).replace(o, ';');
                if (W == 'inherit')U += X; else T += X;
            }
            if (T.length)T = N(T);
            T += U;
            return R._ST = T;
        };
        function p(R) {
            var S, T;
            while (R = R.getParent()) {
                if (R.getName() == 'body')break;
                if (R.getAttribute('data-cke-nostyle'))S = R; else if (!T) {
                    var U = R.getAttribute('contentEditable');
                    if (U == 'false')S = R; else if (U == 'true')T = 1;
                }
            }
            return S;
        };
        function q(R) {
            var av = this;
            var S = R.document;
            if (R.collapsed) {
                var T = G(av, S);
                R.insertNode(T);
                R.moveToPosition(T, 2);
                return;
            }
            var U = av.element, V = av._.definition, W, X = V.includeReadonly;
            if (X == undefined)X = S.getCustomData('cke_includeReadonly');
            var Y = f[U] || (W = true, f.span);
            R.enlarge(1);
            R.trim();
            var Z = R.createBookmark(), aa = Z.startNode, ab = Z.endNode, ac = aa, ad, ae = p(aa), af = p(ab);
            if (ae)ac = ae.getNextSourceNode(true);
            if (af)ab = af;
            if (ac.getPosition(ab) == 2)ac = 0;
            while (ac) {
                var ag = false;
                if (ac.equals(ab)) {
                    ac = null;
                    ag = true;
                } else {
                    var ah = ac.type, ai = ah == 1 ? ac.getName() : null, aj = ai && ac.getAttribute('contentEditable') == 'false', ak = ai && ac.getAttribute('data-cke-nostyle');
                    if (ai && ac.data('cke-bookmark')) {
                        ac = ac.getNextSourceNode(true);
                        continue;
                    }
                    if (!ai || Y[ai] && !ak && (!aj || X) && (ac.getPosition(ab) | 4 | 0 | 8) == 4 + 0 + 8 && (!V.childRule || V.childRule(ac))) {
                        var al = ac.getParent();
                        if (al && ((al.getDtd() || f.span)[U] || W) && (!V.parentRule || V.parentRule(al))) {
                            if (!ad && (!ai || !f.$removeEmpty[ai] || (ac.getPosition(ab) | 4 | 0 | 8) == 4 + 0 + 8)) {
                                ad = new d.range(S);
                                ad.setStartBefore(ac);
                            }
                            if (ah == 3 || aj || ah == 1 && !ac.getChildCount()) {
                                var am = ac, an;
                                while (!am.$.nextSibling && (an = am.getParent(), Y[an.getName()]) && (an.getPosition(aa) | 2 | 0 | 8) == 2 + 0 + 8 && (!V.childRule || V.childRule(an)))am = an;

                                ad.setEndAfter(am);
                                if (!am.$.nextSibling)ag = true;
                            }
                        } else ag = true;
                    } else ag = true;
                    ac = ac.getNextSourceNode(ak || aj);
                }
                if (ag && ad && !ad.collapsed) {
                    var ao = G(av, S), ap = ao.hasAttributes(), aq = ad.getCommonAncestor(), ar = {
                        styles: {},
                        attrs: {},
                        blockedStyles: {},
                        blockedAttrs: {}
                    }, as, at, au;
                    while (ao && aq) {
                        if (aq.getName() == U) {
                            for (as in V.attributes) {
                                if (ar.blockedAttrs[as] || !(au = aq.getAttribute(at)))continue;
                                if (ao.getAttribute(as) == au)ar.attrs[as] = 1; else ar.blockedAttrs[as] = 1;
                            }
                            for (at in V.styles) {
                                if (ar.blockedStyles[at] || !(au = aq.getStyle(at)))continue;
                                if (ao.getStyle(at) == au)ar.styles[at] = 1; else ar.blockedStyles[at] = 1;
                            }
                        }
                        aq = aq.getParent();
                    }
                    for (as in ar.attrs)ao.removeAttribute(as);
                    for (at in ar.styles)ao.removeStyle(at);
                    if (ap && !ao.hasAttributes())ao = null;
                    if (ao) {
                        ad.extractContents().appendTo(ao);
                        D(av, ao);
                        ad.insertNode(ao);
                        ao.mergeSiblings();
                        if (!c)ao.$.normalize();
                    } else {
                        ao = new h('span');
                        ad.extractContents().appendTo(ao);
                        ad.insertNode(ao);
                        D(av, ao);
                        ao.remove(true);
                    }
                    ad = null;
                }
            }
            R.moveToBookmark(Z);
            R.shrink(2);
        };
        function r(R) {
            R.enlarge(1);
            var S = R.createBookmark(), T = S.startNode;
            if (R.collapsed) {
                var U = new d.elementPath(T.getParent()), V;
                for (var W = 0, X; W < U.elements.length && (X = U.elements[W]); W++) {
                    if (X == U.block || X == U.blockLimit)break;
                    if (this.checkElementRemovable(X)) {
                        var Y;
                        if (R.collapsed && (R.checkBoundaryOfElement(X, 2) || (Y = R.checkBoundaryOfElement(X, 1)))) {
                            V = X;
                            V.match = Y ? 'start' : 'end';
                        } else {
                            X.mergeSiblings();
                            C(this, X);
                        }
                    }
                }
                if (V) {
                    var Z = T;
                    for (W = 0; true; W++) {
                        var aa = U.elements[W];
                        if (aa.equals(V))break; else if (aa.match)continue; else aa = aa.clone();
                        aa.append(Z);
                        Z = aa;
                    }
                    Z[V.match == 'start' ? 'insertBefore' : 'insertAfter'](V);
                }
            } else {
                var ab = S.endNode, ac = this;

                function ad() {
                    var ag = new d.elementPath(T.getParent()), ah = new d.elementPath(ab.getParent()), ai = null, aj = null;
                    for (var ak = 0; ak < ag.elements.length; ak++) {
                        var al = ag.elements[ak];
                        if (al == ag.block || al == ag.blockLimit)break;
                        if (ac.checkElementRemovable(al))ai = al;
                    }
                    for (ak = 0; ak < ah.elements.length; ak++) {
                        al = ah.elements[ak];
                        if (al == ah.block || al == ah.blockLimit)break;
                        if (ac.checkElementRemovable(al))aj = al;
                    }
                    if (aj)ab.breakParent(aj);
                    if (ai)T.breakParent(ai);
                };
                ad();
                var ae = T.getNext();
                while (!ae.equals(ab)) {
                    var af = ae.getNextSourceNode();
                    if (ae.type == 1 && this.checkElementRemovable(ae)) {
                        if (ae.getName() == this.element)C(this, ae); else E(ae, L(this)[ae.getName()]);
                        if (af.type == 1 && af.contains(T)) {
                            ad();
                            af = T.getNext();
                        }
                    }
                    ae = af;
                }
            }
            R.moveToBookmark(S);
        };
        function s(R) {
            var S = R.getCommonAncestor(true, true), T = S.getAscendant(this.element, true);
            T && H(T, this);
        };
        function t(R) {
            var S = R.getCommonAncestor(true, true), T = S.getAscendant(this.element, true);

            if (!T)return;
            var U = this, V = U._.definition, W = V.attributes, X = a.style.getStyleText(V);
            if (W)for (var Y in W)T.removeAttribute(Y, W[Y]);
            if (V.styles)for (var Z in V.styles) {
                if (!V.styles.hasOwnProperty(Z))continue;
                T.removeStyle(Z);
            }
        };
        function u(R) {
            var S = R.createBookmark(true), T = R.createIterator();
            T.enforceRealBlocks = true;
            if (this._.enterMode)T.enlargeBr = this._.enterMode != 2;
            var U, V = R.document, W;
            while (U = T.getNextParagraph()) {
                var X = G(this, V, U);
                v(U, X);
            }
            R.moveToBookmark(S);
        };
        function v(R, S) {
            var T = S.is('pre'), U = R.is('pre'), V = T && !U, W = !T && U;
            if (V)S = B(R, S); else if (W)S = A(y(R), S); else R.moveChildren(S);
            S.replace(R);
            if (T)x(S);
        };
        var w = d.walker.whitespaces(true);

        function x(R) {
            var S;
            if (!((S = R.getPrevious(w)) && S.is && S.is('pre')))return;
            var T = z(S.getHtml(), /\n$/, '') + '\n\n' + z(R.getHtml(), /^\n/, '');
            if (c)R.$.outerHTML = '<pre>' + T + '</pre>'; else R.setHtml(T);
            S.remove();
        };
        function y(R) {
            var S = /(\S\s*)\n(?:\s|(<span[^>]+data-cke-bookmark.*?\/span>))*\n(?!$)/gi, T = R.getName(), U = z(R.getOuterHtml(), S, function (W, X, Y) {
                return X + '</pre>' + Y + '<pre>';
            }), V = [];
            U.replace(/<pre\b.*?>([\s\S]*?)<\/pre>/gi, function (W, X) {
                V.push(X);
            });
            return V;
        };
        function z(R, S, T) {
            var U = '', V = '';
            R = R.replace(/(^<span[^>]+data-cke-bookmark.*?\/span>)|(<span[^>]+data-cke-bookmark.*?\/span>$)/gi, function (W, X, Y) {
                X && (U = X);
                Y && (V = Y);
                return '';
            });
            return U + R.replace(S, T) + V;
        };
        function A(R, S) {
            var T = new d.documentFragment(S.getDocument());
            for (var U = 0; U < R.length; U++) {
                var V = R[U];
                V = V.replace(/(\r\n|\r)/g, '\n');
                V = z(V, /^[ \t]*\n/, '');
                V = z(V, /\n$/, '');
                V = z(V, /^[ \t]+|[ \t]+$/g, function (X, Y, Z) {
                    if (X.length == 1)return '&nbsp;'; else if (!Y)return e.repeat('&nbsp;', X.length - 1) + ' '; else return ' ' + e.repeat('&nbsp;', X.length - 1);
                });
                V = V.replace(/\n/g, '<br>');
                V = V.replace(/[ \t]{2,}/g, function (X) {
                    return e.repeat('&nbsp;', X.length - 1) + ' ';
                });
                var W = S.clone();
                W.setHtml(V);
                T.append(W);
            }
            return T;
        };
        function B(R, S) {
            var T = R.getHtml();
            T = z(T, /(?:^[ \t\n\r]+)|(?:[ \t\n\r]+$)/g, '');
            T = T.replace(/[ \t\r\n]*(<br[^>]*>)[ \t\r\n]*/gi, '$1');
            T = T.replace(/([ \t\n\r]+|&nbsp;)/g, ' ');
            T = T.replace(/<br\b[^>]*>/gi, '\n');
            if (c) {
                var U = R.getDocument().createElement('div');
                U.append(S);
                S.$.outerHTML = '<pre>' + T + '</pre>';
                S = U.getFirst().remove();
            } else S.setHtml(T);
            return S;
        };
        function C(R, S) {
            var T = R._.definition, U = e.extend({}, T.attributes, L(R)[S.getName()]), V = T.styles, W = e.isEmpty(U) && e.isEmpty(V);
            for (var X in U) {
                if ((X == 'class' || R._.definition.fullMatch) && S.getAttribute(X) != M(X, U[X]))continue;
                W = S.hasAttribute(X);
                S.removeAttribute(X);
            }
            for (var Y in V) {
                if (R._.definition.fullMatch && S.getStyle(Y) != M(Y, V[Y], true))continue;

                W = W || !!S.getStyle(Y);
                S.removeStyle(Y);
            }
            W && F(S);
        };
        function D(R, S) {
            var T = R._.definition, U = T.attributes, V = T.styles, W = L(R), X = S.getElementsByTag(R.element);
            for (var Y = X.count(); --Y >= 0;)C(R, X.getItem(Y));
            for (var Z in W) {
                if (Z != R.element) {
                    X = S.getElementsByTag(Z);
                    for (Y = X.count() - 1; Y >= 0; Y--) {
                        var aa = X.getItem(Y);
                        E(aa, W[Z]);
                    }
                }
            }
        };
        function E(R, S) {
            var T = S && S.attributes;
            if (T)for (var U = 0; U < T.length; U++) {
                var V = T[U][0], W;
                if (W = R.getAttribute(V)) {
                    var X = T[U][1];
                    if (X === null || X.test && X.test(W) || typeof X == 'string' && W == X)R.removeAttribute(V);
                }
            }
            F(R);
        };
        function F(R) {
            if (!R.hasAttributes()) {
                var S = R.getFirst(), T = R.getLast();
                R.remove(true);
                if (S) {
                    S.type == 1 && S.mergeSiblings();
                    if (T && !S.equals(T) && T.type == 1)T.mergeSiblings();
                }
            }
        };
        function G(R, S, T) {
            var U, V = R._.definition, W = R.element;
            if (W == '*')W = 'span';
            U = new h(W, S);
            if (T)T.copyAttributes(U);
            return H(U, R);
        };
        function H(R, S) {
            var T = S._.definition, U = T.attributes, V = a.style.getStyleText(T);
            if (U)for (var W in U)R.setAttribute(W, U[W]);
            if (V)R.setAttribute('style', V);
            return R;
        };
        var I = /#\((.+?)\)/g;

        function J(R, S) {
            for (var T in R)R[T] = R[T].replace(I, function (U, V) {
                return S[V];
            });
        };
        function K(R) {
            var S = R._AC;
            if (S)return S;
            S = {};
            var T = 0, U = R.attributes;
            if (U)for (var V in U) {
                T++;
                S[V] = U[V];
            }
            var W = a.style.getStyleText(R);
            if (W) {
                if (!S.style)T++;
                S.style = W;
            }
            S._length = T;
            return R._AC = S;
        };
        function L(R) {
            if (R._.overrides)return R._.overrides;
            var S = R._.overrides = {}, T = R._.definition.overrides;
            if (T) {
                if (!e.isArray(T))T = [T];
                for (var U = 0; U < T.length; U++) {
                    var V = T[U], W, X, Y;
                    if (typeof V == 'string')W = V.toLowerCase(); else {
                        W = V.element ? V.element.toLowerCase() : R.element;
                        Y = V.attributes;
                    }
                    X = S[W] || (S[W] = {});
                    if (Y) {
                        var Z = X.attributes = X.attributes || [];
                        for (var aa in Y)Z.push([aa.toLowerCase(), Y[aa]]);
                    }
                }
            }
            return S;
        };
        function M(R, S, T) {
            var U = new h('span');
            U[T ? 'setStyle' : 'setAttribute'](R, S);
            return U[T ? 'getStyle' : 'getAttribute'](R);
        };
        function N(R, S) {
            var T;
            if (S !== false) {
                var U = new h('span');
                U.setAttribute('style', R);
                T = U.getAttribute('style') || '';
            } else T = R;
            return T.replace(/\s*([;:])\s*/, '$1').replace(/([^\s;])$/, '$1;').replace(/,\s+/g, ',').replace(/\"/g, '').toLowerCase();
        };
        function O(R) {
            var S = {};
            R.replace(/&quot;/g, '"').replace(/\s*([^ :;]+)\s*:\s*([^;]+)\s*(?=;|$)/g, function (T, U, V) {
                S[U] = V;
            });
            return S;
        };
        function P(R, S) {
            typeof R == 'string' && (R = O(R));
            typeof S == 'string' && (S = O(S));
            for (var T in R) {
                if (!(T in S && (S[T] == R[T] || R[T] == 'inherit' || S[T] == 'inherit')))return false;
            }
            return true;
        };
        function Q(R, S) {
            var T = R.getSelection(), U = T.createBookmarks(1), V = T.getRanges(), W = S ? this.removeFromRange : this.applyToRange, X, Y = V.createIterator();

            while (X = Y.getNextRange())W.call(this, X);
            if (U.length == 1 && U[0].collapsed) {
                T.selectRanges(V);
                R.getById(U[0].startNode).remove();
            } else T.selectBookmarks(U);
        };
    })();
    a.styleCommand = function (m) {
        this.style = m;
    };
    a.styleCommand.prototype.exec = function (m) {
        var o = this;
        m.focus();
        var n = m.document;
        if (n)if (o.state == 2)o.style.apply(n); else if (o.state == 1)o.style.remove(n);
        return !!n;
    };
    a.stylesSet = new a.resourceManager('', 'stylesSet');
    a.addStylesSet = e.bind(a.stylesSet.add, a.stylesSet);
    a.loadStylesSet = function (m, n, o) {
        a.stylesSet.addExternal(m, n, '');
        a.stylesSet.load(m, o);
    };
    a.editor.prototype.getStylesSet = function (m) {
        if (!this._.stylesDefinitions) {
            var n = this, o = n.config.stylesCombo_stylesSet || n.config.stylesSet || 'default';
            if (o instanceof Array) {
                n._.stylesDefinitions = o;
                m(o);
                return;
            }
            var p = o.split(':'), q = p[0], r = p[1], s = j.registered.styles.path;
            a.stylesSet.addExternal(q, r ? p.slice(1).join(':') : s + 'styles/' + q + '.js', '');
            a.stylesSet.load(q, function (t) {
                n._.stylesDefinitions = t[q];
                m(n._.stylesDefinitions);
            });
        } else m(this._.stylesDefinitions);
    };
    j.add('domiterator');
    (function () {
        function m(p) {
            var q = this;
            if (arguments.length < 1)return;
            q.range = p;
            q.forceBrBreak = 0;
            q.enlargeBr = 1;
            q.enforceRealBlocks = 0;
            q._ || (q._ = {});
        };
        var n = /^[\r\n\t ]+$/, o = d.walker.bookmark();
        m.prototype = {
            getNextParagraph: function (p) {
                var q, r, s, t, u, v;
                if (!this._.lastNode) {
                    r = this.range.clone();
                    r.shrink(1, true);
                    t = r.endContainer.hasAscendant('pre', true) || r.startContainer.hasAscendant('pre', true);
                    r.enlarge(this.forceBrBreak && !t || !this.enlargeBr ? 3 : 2);
                    var w = new d.walker(r), x = d.walker.bookmark(true, true);
                    w.evaluator = x;
                    this._.nextNode = w.next();
                    w = new d.walker(r);
                    w.evaluator = x;
                    var y = w.previous();
                    this._.lastNode = y.getNextSourceNode(true);
                    if (this._.lastNode && this._.lastNode.type == 3 && !e.trim(this._.lastNode.getText()) && this._.lastNode.getParent().isBlockBoundary()) {
                        var z = new d.range(r.document);
                        z.moveToPosition(this._.lastNode, 4);
                        if (z.checkEndOfBlock()) {
                            var A = new d.elementPath(z.endContainer), B = A.block || A.blockLimit;
                            this._.lastNode = B.getNextSourceNode(true);
                        }
                    }
                    if (!this._.lastNode) {
                        this._.lastNode = this._.docEndMarker = r.document.createText('');
                        this._.lastNode.insertAfter(y);
                    }
                    r = null;
                }
                var C = this._.nextNode;
                y = this._.lastNode;
                this._.nextNode = null;
                while (C) {
                    var D = 0, E = C.hasAscendant('pre'), F = C.type != 1, G = 0;
                    if (!F) {
                        var H = C.getName();
                        if (C.isBlockBoundary(this.forceBrBreak && !E && {br: 1})) {
                            if (H == 'br')F = 1; else if (!r && !C.getChildCount() && H != 'hr') {
                                q = C;
                                s = C.equals(y);
                                break;
                            }
                            if (r) {
                                r.setEndAt(C, 3);
                                if (H != 'br')this._.nextNode = C;
                            }
                            D = 1;
                        } else {
                            if (C.getFirst()) {
                                if (!r) {
                                    r = new d.range(this.range.document);

                                    r.setStartAt(C, 3);
                                }
                                C = C.getFirst();
                                continue;
                            }
                            F = 1;
                        }
                    } else if (C.type == 3)if (n.test(C.getText()))F = 0;
                    if (F && !r) {
                        r = new d.range(this.range.document);
                        r.setStartAt(C, 3);
                    }
                    s = (!D || F) && C.equals(y);
                    if (r && !D)while (!C.getNext() && !s) {
                        var I = C.getParent();
                        if (I.isBlockBoundary(this.forceBrBreak && !E && {br: 1})) {
                            D = 1;
                            s = s || I.equals(y);
                            break;
                        }
                        C = I;
                        F = 1;
                        s = C.equals(y);
                        G = 1;
                    }
                    if (F)r.setEndAt(C, 4);
                    C = C.getNextSourceNode(G, null, y);
                    s = !C;
                    if (s || D && r)break;
                }
                if (!q) {
                    if (!r) {
                        this._.docEndMarker && this._.docEndMarker.remove();
                        this._.nextNode = null;
                        return null;
                    }
                    var J = new d.elementPath(r.startContainer), K = J.blockLimit, L = {div: 1, th: 1, td: 1};
                    q = J.block;
                    if (!q && !this.enforceRealBlocks && L[K.getName()] && r.checkStartOfBlock() && r.checkEndOfBlock())q = K; else if (!q || this.enforceRealBlocks && q.getName() == 'li') {
                        q = this.range.document.createElement(p || 'p');
                        r.extractContents().appendTo(q);
                        q.trim();
                        r.insertNode(q);
                        u = v = true;
                    } else if (q.getName() != 'li') {
                        if (!r.checkStartOfBlock() || !r.checkEndOfBlock()) {
                            q = q.clone(false);
                            r.extractContents().appendTo(q);
                            q.trim();
                            var M = r.splitBlock();
                            u = !M.wasStartOfBlock;
                            v = !M.wasEndOfBlock;
                            r.insertNode(q);
                        }
                    } else if (!s)this._.nextNode = q.equals(y) ? null : r.getBoundaryNodes().endNode.getNextSourceNode(true, null, y);
                }
                var N = d.walker.bookmark(false, true);
                if (u) {
                    var O = q.getPrevious();
                    if (O && O.type == 1)if (O.getName() == 'br')O.remove(); else if (O.getLast() && O.getLast().$.nodeName.toLowerCase() == 'br')O.getLast().remove();
                }
                if (v) {
                    var P = q.getLast();
                    if (P && P.type == 1 && P.getName() == 'br')if (c || P.getPrevious(N) || P.getNext(N))P.remove();
                }
                if (!this._.nextNode)this._.nextNode = s || q.equals(y) ? null : q.getNextSourceNode(true, null, y);
                if (!N(this._.nextNode))this._.nextNode = this._.nextNode.getNextSourceNode(true, null, function (Q) {
                    return !Q.equals(y) && N(Q);
                });
                return q;
            }
        };
        d.range.prototype.createIterator = function () {
            return new m(this);
        };
    })();
    j.add('panelbutton', {
        requires: ['button'], beforeInit: function (m) {
            m.ui.addHandler(4, k.panelButton.handler);
        }
    });
    a.UI_PANELBUTTON = 4;
    (function () {
        var m = function (n) {
            var p = this;
            var o = p._;
            if (o.state == 0)return;
            p.createPanel(n);
            if (o.on) {
                o.panel.hide();
                return;
            }
            o.panel.showBlock(p._.id, p.document.getById(p._.id), 4);
        };
        k.panelButton = e.createClass({
            base: k.button, $: function (n) {
                var p = this;
                var o = n.panel;
                delete n.panel;
                p.base(n);
                p.document = o && o.parent && o.parent.getDocument() || a.document;
                o.block = {attributes: o.attributes};
                p.hasArrow = true;
                p.click = m;
                p._ = {panelDefinition: o};
            }, statics: {
                handler: {
                    create: function (n) {
                        return new k.panelButton(n);
                    }
                }
            }, proto: {
                createPanel: function (n) {
                    var o = this._;
                    if (o.panel)return;
                    var p = this._.panelDefinition || {}, q = this._.panelDefinition.block, r = p.parent || a.document.getBody(), s = this._.panel = new k.floatPanel(n, r, p), t = s.addBlock(o.id, q), u = this;

                    s.onShow = function () {
                        if (u.className)this.element.getFirst().addClass(u.className + '_panel');
                        u.setState(1);
                        o.on = 1;
                        if (u.onOpen)u.onOpen();
                    };
                    s.onHide = function (v) {
                        if (u.className)this.element.getFirst().removeClass(u.className + '_panel');
                        u.setState(u.modes && u.modes[n.mode] ? 2 : 0);
                        o.on = 0;
                        if (!v && u.onClose)u.onClose();
                    };
                    s.onEscape = function () {
                        s.hide();
                        u.document.getById(o.id).focus();
                    };
                    if (this.onBlock)this.onBlock(s, t);
                    t.onHide = function () {
                        o.on = 0;
                        u.setState(2);
                    };
                }
            }
        });
    })();
    j.add('floatpanel', {requires: ['panel']});
    (function () {
        var m = {}, n = false;

        function o(p, q, r, s, t) {
            var u = e.genKey(q.getUniqueId(), r.getUniqueId(), p.skinName, p.lang.dir, p.uiColor || '', s.css || '', t || ''), v = m[u];
            if (!v) {
                v = m[u] = new k.panel(q, s);
                v.element = r.append(h.createFromHtml(v.renderHtml(p), q));
                v.element.setStyles({display: 'none', position: 'absolute'});
            }
            return v;
        };
        k.floatPanel = e.createClass({
            $: function (p, q, r, s) {
                r.forceIFrame = 1;
                var t = q.getDocument(), u = o(p, t, q, r, s || 0), v = u.element, w = v.getFirst().getFirst();
                this.element = v;
                this._ = {
                    panel: u,
                    parentElement: q,
                    definition: r,
                    document: t,
                    iframe: w,
                    children: [],
                    dir: p.lang.dir
                };
                p.on('mode', function () {
                    this.hide();
                }, this);
            }, proto: {
                addBlock: function (p, q) {
                    return this._.panel.addBlock(p, q);
                }, addListBlock: function (p, q) {
                    return this._.panel.addListBlock(p, q);
                }, getBlock: function (p) {
                    return this._.panel.getBlock(p);
                }, showBlock: function (p, q, r, s, t) {
                    var u = this._.panel, v = u.showBlock(p);
                    this.allowBlur(false);
                    n = 1;
                    var w = this.element, x = this._.iframe, y = this._.definition, z = q.getDocumentPosition(w.getDocument()), A = this._.dir == 'rtl', B = z.x + (s || 0), C = z.y + (t || 0);
                    if (A && (r == 1 || r == 4))B += q.$.offsetWidth; else if (!A && (r == 2 || r == 3))B += q.$.offsetWidth - 1;
                    if (r == 3 || r == 4)C += q.$.offsetHeight - 1;
                    this._.panel._.offsetParentId = q.getId();
                    w.setStyles({top: C + 'px', left: 0, display: ''});
                    w.setOpacity(0);
                    w.getFirst().removeStyle('width');
                    if (!this._.blurSet) {
                        var D = c ? x : new d.window(x.$.contentWindow);
                        a.event.useCapture = true;
                        D.on('blur', function (E) {
                            var G = this;
                            if (!G.allowBlur())return;
                            var F;
                            if (c && !G.allowBlur() || (F = E.data.getTarget()) && F.getName && F.getName() != 'iframe')return;
                            if (G.visible && !G._.activeChild && !n)G.hide();
                        }, this);
                        D.on('focus', function () {
                            this._.focused = true;
                            this.hideChild();
                            this.allowBlur(true);
                        }, this);
                        a.event.useCapture = false;
                        this._.blurSet = 1;
                    }
                    u.onEscape = e.bind(function (E) {
                        if (this.onEscape && this.onEscape(E) === false)return false;
                    }, this);
                    e.setTimeout(function () {
                        if (A)B -= w.$.offsetWidth;
                        var E = e.bind(function () {
                            var F = w.getFirst();
                            if (v.autoSize) {
                                var G = v.element.$;
                                if (b.gecko || b.opera)G = G.parentNode;
                                if (c)G = G.document.body;
                                var H = G.scrollWidth;

                                if (c && b.quirks && H > 0)H += (F.$.offsetWidth || 0) - (F.$.clientWidth || 0);
                                H += 4;
                                F.setStyle('width', H + 'px');
                                v.element.addClass('cke_frameLoaded');
                                var I = v.element.$.scrollHeight;
                                if (c && b.quirks && I > 0)I += (F.$.offsetHeight || 0) - (F.$.clientHeight || 0);
                                F.setStyle('height', I + 'px');
                                u._.currentBlock.element.setStyle('display', 'none').removeStyle('display');
                            } else F.removeStyle('height');
                            var J = u.element, K = J.getWindow(), L = K.getScrollPosition(), M = K.getViewPaneSize(), N = {
                                height: J.$.offsetHeight,
                                width: J.$.offsetWidth
                            };
                            if (A ? B < 0 : B + N.width > M.width + L.x)B += N.width * (A ? 1 : -1);
                            if (C + N.height > M.height + L.y)C -= N.height;
                            if (c) {
                                var O = new h(w.$.offsetParent), P = O;
                                if (P.getName() == 'html')P = P.getDocument().getBody();
                                if (P.getComputedStyle('direction') == 'rtl')if (b.ie8Compat)B -= w.getDocument().getDocumentElement().$.scrollLeft * 2; else B -= O.$.scrollWidth - O.$.clientWidth;
                            }
                            var Q = w.getFirst(), R;
                            if (R = Q.getCustomData('activePanel'))R.onHide && R.onHide.call(this, 1);
                            Q.setCustomData('activePanel', this);
                            w.setStyles({top: C + 'px', left: B + 'px'});
                            w.setOpacity(1);
                        }, this);
                        u.isLoaded ? E() : u.onLoad = E;
                        e.setTimeout(function () {
                            x.$.contentWindow.focus();
                            this.allowBlur(true);
                        }, 0, this);
                    }, b.air ? 200 : 0, this);
                    this.visible = 1;
                    if (this.onShow)this.onShow.call(this);
                    n = 0;
                }, hide: function () {
                    var p = this;
                    if (p.visible && (!p.onHide || p.onHide.call(p) !== true)) {
                        p.hideChild();
                        p.element.setStyle('display', 'none');
                        p.visible = 0;
                        p.element.getFirst().removeCustomData('activePanel');
                    }
                }, allowBlur: function (p) {
                    var q = this._.panel;
                    if (p != undefined)q.allowBlur = p;
                    return q.allowBlur;
                }, showAsChild: function (p, q, r, s, t, u) {
                    if (this._.activeChild == p && p._.panel._.offsetParentId == r.getId())return;
                    this.hideChild();
                    p.onHide = e.bind(function () {
                        e.setTimeout(function () {
                            if (!this._.focused)this.hide();
                        }, 0, this);
                    }, this);
                    this._.activeChild = p;
                    this._.focused = false;
                    p.showBlock(q, r, s, t, u);
                    if (b.ie7Compat || b.ie8 && b.ie6Compat)setTimeout(function () {
                        p.element.getChild(0).$.style.cssText += '';
                    }, 100);
                }, hideChild: function () {
                    var p = this._.activeChild;
                    if (p) {
                        delete p.onHide;
                        delete this._.activeChild;
                        p.hide();
                    }
                }
            }
        });
        a.on('instanceDestroyed', function () {
            var p = e.isEmpty(a.instances);
            for (var q in m) {
                var r = m[q];
                if (p)r.destroy(); else r.element.hide();
            }
            p && (m = {});
        });
    })();
    j.add('menu', {
        beforeInit: function (m) {
            var n = m.config.menu_groups.split(','), o = m._.menuGroups = {}, p = m._.menuItems = {};
            for (var q = 0; q < n.length; q++)o[n[q]] = q + 1;
            m.addMenuGroup = function (r, s) {
                o[r] = s || 100;
            };
            m.addMenuItem = function (r, s) {
                if (o[s.group])p[r] = new a.menuItem(this, r, s);
            };
            m.addMenuItems = function (r) {
                for (var s in r)this.addMenuItem(s, r[s]);
            };
            m.getMenuItem = function (r) {
                return p[r];

            };
        }, requires: ['floatpanel']
    });
    (function () {
        a.menu = e.createClass({
            $: function (n, o) {
                var r = this;
                o = r._.definition = o || {};
                r.id = 'cke_' + e.getNextNumber();
                r.editor = n;
                r.items = [];
                r._.listeners = [];
                r._.level = o.level || 1;
                var p = e.extend({}, o.panel, {
                    css: n.skin.editor.css,
                    level: r._.level - 1,
                    block: {}
                }), q = p.block.attributes = p.attributes || {};
                !q.role && (q.role = 'menu');
                r._.panelDefinition = p;
            }, _: {
                onShow: function () {
                    var v = this;
                    var n = v.editor.getSelection();
                    if (c)n && n.lock();
                    var o = n && n.getStartElement(), p = v._.listeners, q = [];
                    v.removeAll();
                    for (var r = 0; r < p.length; r++) {
                        var s = p[r](o, n);
                        if (s)for (var t in s) {
                            var u = v.editor.getMenuItem(t);
                            if (u) {
                                u.state = s[t];
                                v.add(u);
                            }
                        }
                    }
                }, onClick: function (n) {
                    this.hide();
                    if (n.onClick)n.onClick(); else if (n.command)this.editor.execCommand(n.command);
                }, onEscape: function (n) {
                    var o = this.parent;
                    if (o) {
                        o._.panel.hideChild();
                        var p = o._.panel._.panel._.currentBlock, q = p._.focusIndex;
                        p._.markItem(q);
                    } else if (n == 27) {
                        this.hide();
                        this.editor.focus();
                    }
                    return false;
                }, onHide: function () {
                    if (c) {
                        var n = this.editor.getSelection();
                        n && n.unlock();
                    }
                    this.onHide && this.onHide();
                }, showSubMenu: function (n) {
                    var v = this;
                    var o = v._.subMenu, p = v.items[n], q = p.getItems && p.getItems();
                    if (!q) {
                        v._.panel.hideChild();
                        return;
                    }
                    var r = v._.panel.getBlock(v.id);
                    r._.focusIndex = n;
                    if (o)o.removeAll(); else {
                        o = v._.subMenu = new a.menu(v.editor, e.extend({}, v._.definition, {level: v._.level + 1}, true));
                        o.parent = v;
                        o._.onClick = e.bind(v._.onClick, v);
                    }
                    for (var s in q) {
                        var t = v.editor.getMenuItem(s);
                        if (t) {
                            t.state = q[s];
                            o.add(t);
                        }
                    }
                    var u = v._.panel.getBlock(v.id).element.getDocument().getById(v.id + String(n));
                    o.show(u, 2);
                }
            }, proto: {
                add: function (n) {
                    if (!n.order)n.order = this.items.length;
                    this.items.push(n);
                }, removeAll: function () {
                    this.items = [];
                }, show: function (n, o, p, q) {
                    if (!this.parent) {
                        this._.onShow();
                        if (!this.items.length)return;
                    }
                    o = o || (this.editor.lang.dir == 'rtl' ? 2 : 1);
                    var r = this.items, s = this.editor, t = this._.panel, u = this._.element;
                    if (!t) {
                        t = this._.panel = new k.floatPanel(this.editor, a.document.getBody(), this._.panelDefinition, this._.level);
                        t.onEscape = e.bind(function (F) {
                            if (this._.onEscape(F) === false)return false;
                        }, this);
                        t.onHide = e.bind(function () {
                            this._.onHide && this._.onHide();
                        }, this);
                        var v = t.addBlock(this.id, this._.panelDefinition.block);
                        v.autoSize = true;
                        var w = v.keys;
                        w[40] = 'next';
                        w[9] = 'next';
                        w[38] = 'prev';
                        w[2000 + 9] = 'prev';
                        w[32] = 'click';
                        w[s.lang.dir == 'rtl' ? 37 : 39] = 'click';
                        u = this._.element = v.element;
                        u.addClass(s.skinClass);
                        var x = u.getDocument();
                        x.getBody().setStyle('overflow', 'hidden');
                        x.getElementsByTag('html').getItem(0).setStyle('overflow', 'hidden');
                        this._.itemOverFn = e.addFunction(function (F) {
                            var G = this;

                            clearTimeout(G._.showSubTimeout);
                            G._.showSubTimeout = e.setTimeout(G._.showSubMenu, s.config.menu_subMenuDelay || 400, G, [F]);
                        }, this);
                        this._.itemOutFn = e.addFunction(function (F) {
                            clearTimeout(this._.showSubTimeout);
                        }, this);
                        this._.itemClickFn = e.addFunction(function (F) {
                            var H = this;
                            var G = H.items[F];
                            if (G.state == 0) {
                                H.hide();
                                return;
                            }
                            if (G.getItems)H._.showSubMenu(F); else H._.onClick(G);
                        }, this);
                    }
                    m(r);
                    var y = s.container.getChild(1), z = y.hasClass('cke_mixed_dir_content') ? ' cke_mixed_dir_content' : '', A = ['<div class="cke_menu' + z + '" role="presentation">'], B = r.length, C = B && r[0].group;
                    for (var D = 0; D < B; D++) {
                        var E = r[D];
                        if (C != E.group) {
                            A.push('<div class="cke_menuseparator" role="separator"></div>');
                            C = E.group;
                        }
                        E.render(this, D, A);
                    }
                    A.push('</div>');
                    u.setHtml(A.join(''));
                    k.fire('ready', this);
                    if (this.parent)this.parent._.panel.showAsChild(t, this.id, n, o, p, q); else t.showBlock(this.id, n, o, p, q);
                    s.fire('menuShow', [t]);
                }, addListener: function (n) {
                    this._.listeners.push(n);
                }, hide: function () {
                    var n = this;
                    n._.onHide && n._.onHide();
                    n._.panel && n._.panel.hide();
                }
            }
        });
        function m(n) {
            n.sort(function (o, p) {
                if (o.group < p.group)return -1; else if (o.group > p.group)return 1;
                return o.order < p.order ? -1 : o.order > p.order ? 1 : 0;
            });
        };
        a.menuItem = e.createClass({
            $: function (n, o, p) {
                var q = this;
                e.extend(q, p, {order: 0, className: 'cke_button_' + o});
                q.group = n._.menuGroups[q.group];
                q.editor = n;
                q.name = o;
            }, proto: {
                render: function (n, o, p) {
                    var w = this;
                    var q = n.id + String(o), r = typeof w.state == 'undefined' ? 2 : w.state, s = ' cke_' + (r == 1 ? 'on' : r == 0 ? 'disabled' : 'off'), t = w.label;
                    if (w.className)s += ' ' + w.className;
                    var u = w.getItems;
                    p.push('<span class="cke_menuitem"><a id="', q, '" class="', s, '" href="javascript:void(\'', (w.label || '').replace("'", ''), '\')" title="', w.label, '" tabindex="-1"_cke_focus=1 hidefocus="true" role="menuitem"' + (u ? 'aria-haspopup="true"' : '') + (r == 0 ? 'aria-disabled="true"' : '') + (r == 1 ? 'aria-pressed="true"' : ''));
                    if (b.opera || b.gecko && b.mac)p.push(' onkeypress="return false;"');
                    if (b.gecko)p.push(' onblur="this.style.cssText = this.style.cssText;"');
                    var v = (w.iconOffset || 0) * -16;
                    p.push(' onmouseover="CKEDITOR.tools.callFunction(', n._.itemOverFn, ',', o, ');" onmouseout="CKEDITOR.tools.callFunction(', n._.itemOutFn, ',', o, ');" onclick="CKEDITOR.tools.callFunction(', n._.itemClickFn, ',', o, '); return false;"><span class="cke_icon_wrapper"><span class="cke_icon"' + (w.icon ? ' style="background-image:url(' + a.getUrl(w.icon) + ');background-position:0 ' + v + 'px;"' : '') + '></span></span>' + '<span class="cke_label">');
                    if (u)p.push('<span class="cke_menuarrow">', '<span>&#', w.editor.lang.dir == 'rtl' ? '9668' : '9658', ';</span>', '</span>');

                    p.push(t, '</span></a></span>');
                }
            }
        });
    })();
    i.menu_groups = 'clipboard,form,tablecell,tablecellproperties,tablerow,tablecolumn,table,anchor,link,image,flash,checkbox,radio,textfield,hiddenfield,imagebutton,button,select,textarea,div';
    (function () {
        var m = function (o, p) {
            return o._.modes && o._.modes[p || o.mode];
        }, n;
        j.add('editingblock', {
            init: function (o) {
                if (!o.config.editingBlock)return;
                o.on('themeSpace', function (p) {
                    if (p.data.space == 'contents')p.data.html += '<br>';
                });
                o.on('themeLoaded', function () {
                    o.fireOnce('editingBlockReady');
                });
                o.on('uiReady', function () {
                    o.setMode(o.config.startupMode);
                });
                o.on('afterSetData', function () {
                    if (!n) {
                        function p() {
                            n = true;
                            m(o).loadData(o.getData());
                            n = false;
                        };
                        if (o.mode)p(); else o.on('mode', function () {
                            p();
                            o.removeListener('mode', arguments.callee);
                        });
                    }
                });
                o.on('beforeGetData', function () {
                    if (!n && o.mode) {
                        n = true;
                        o.setData(m(o).getData());
                        n = false;
                    }
                });
                o.on('getSnapshot', function (p) {
                    if (o.mode)p.data = m(o).getSnapshotData();
                });
                o.on('loadSnapshot', function (p) {
                    if (o.mode)m(o).loadSnapshotData(p.data);
                });
                o.on('mode', function (p) {
                    p.removeListener();
                    b.webkit && o.container.on('focus', function () {
                        o.focus();
                    });
                    if (o.config.startupFocus)o.focus();
                    setTimeout(function () {
                        o.fireOnce('instanceReady');
                        a.fire('instanceReady', null, o);
                    }, 0);
                });
            }
        });
        a.editor.prototype.mode = '';
        a.editor.prototype.addMode = function (o, p) {
            p.name = o;
            (this._.modes || (this._.modes = {}))[o] = p;
        };
        a.editor.prototype.setMode = function (o) {
            var p, q = this.getThemeSpace('contents'), r = this.checkDirty();
            if (this.mode) {
                if (o == this.mode)return;
                this.fire('beforeModeUnload');
                var s = m(this);
                p = s.getData();
                s.unload(q);
                this.mode = '';
            }
            q.setHtml('');
            var t = m(this, o);
            if (!t)throw '[CKEDITOR.editor.setMode] Unknown mode "' + o + '".';
            if (!r)this.on('mode', function () {
                this.resetDirty();
                this.removeListener('mode', arguments.callee);
            });
            t.load(q, typeof p != 'string' ? this.getData() : p);
        };
        a.editor.prototype.focus = function () {
            var o = m(this);
            if (o)o.focus();
        };
    })();
    i.startupMode = 'wysiwyg';
    i.editingBlock = true;
    (function () {
        function m() {
            var w = this;
            try {
                var t = w.getSelection();
                if (!t || !t.document.getWindow().$)return;
                var u = t.getStartElement(), v = new d.elementPath(u);
                if (!v.compare(w._.selectionPreviousPath)) {
                    w._.selectionPreviousPath = v;
                    w.fire('selectionChange', {selection: t, path: v, element: u});
                }
            } catch (x) {
            }
        };
        var n, o;

        function p() {
            o = true;
            if (n)return;
            q.call(this);
            n = e.setTimeout(q, 200, this);
        };
        function q() {
            n = null;
            if (o) {
                e.setTimeout(m, 0, this);
                o = false;
            }
        };
        var r = {
            modes: {wysiwyg: 1, source: 1}, exec: function (t) {
                switch (t.mode) {
                    case 'wysiwyg':
                        t.document.$.execCommand('SelectAll', false, null);
                        break;

                    case 'source':
                        var u = t.textarea.$;
                        if (c)u.createTextRange().execCommand('SelectAll'); else {
                            u.selectionStart = 0;
                            u.selectionEnd = u.value.length;
                        }
                        u.focus();
                }
            }, canUndo: false
        };
        j.add('selection', {
            init: function (t) {
                t.on('contentDom', function () {
                    var u = t.document, v = u.getBody(), w = u.getDocumentElement();
                    if (c) {
                        var x, y, z = 1;
                        v.on('focusin', function (D) {
                            if (D.data.$.srcElement.nodeName != 'BODY')return;
                            if (x) {
                                var E = u.getCustomData('cke_locked_selection');
                                if (z && !E)try {
                                    x.select();
                                } catch (F) {
                                }
                                x = null;
                            }
                        });
                        v.on('focus', function () {
                            y = 1;
                            C();
                        });
                        v.on('beforedeactivate', function (D) {
                            if (D.data.$.toElement)return;
                            y = 0;
                            z = 1;
                        });
                        if (c && b.version < 8)t.on('blur', function (D) {
                            try {
                                t.document && t.document.$.selection.empty();
                            } catch (E) {
                            }
                        });
                        w.on('mousedown', function () {
                            z = 0;
                        });
                        w.on('mouseup', function () {
                            z = 1;
                        });
                        if (c && (b.ie7Compat || b.version < 8 || b.quirks))w.on('click', function (D) {
                            if (D.data.getTarget().getName() == 'html')t.getSelection().getRanges()[0].select();
                        });
                        var A;
                        v.on('mousedown', function (D) {
                            if (D.data.$.button == 2) {
                                var E = t.document.$.selection;
                                if (E.type == 'None')A = t.window.getScrollPosition();
                            }
                            B();
                        });
                        v.on('mouseup', function (D) {
                            if (D.data.$.button == 2 && A) {
                                t.document.$.documentElement.scrollLeft = A.x;
                                t.document.$.documentElement.scrollTop = A.y;
                            }
                            A = null;
                            y = 1;
                            setTimeout(function () {
                                C(true);
                            }, 0);
                        });
                        v.on('keydown', B);
                        v.on('keyup', function () {
                            y = 1;
                            C();
                        });
                        u.on('selectionchange', C);
                        function B() {
                            y = 0;
                        };
                        function C(D) {
                            if (y) {
                                var E = t.document, F = t.getSelection(), G = F && F.getNative();
                                if (D && G && G.type == 'None')if (!E.$.queryCommandEnabled('InsertImage')) {
                                    e.setTimeout(C, 50, this, true);
                                    return;
                                }
                                var H;
                                if (G && G.type && G.type != 'Control' && (H = G.createRange()) && (H = H.parentElement()) && (H = H.nodeName) && H.toLowerCase() in {
                                        input: 1,
                                        textarea: 1
                                    })return;
                                x = G && F.getRanges()[0];
                                p.call(t);
                            }
                        };
                    } else {
                        u.on('mouseup', p, t);
                        u.on('keyup', p, t);
                    }
                });
                t.addCommand('selectAll', r);
                t.ui.addButton('SelectAll', {label: t.lang.selectAll, command: 'selectAll'});
                t.selectionChange = p;
            }
        });
        a.editor.prototype.getSelection = function () {
            return this.document && this.document.getSelection();
        };
        a.editor.prototype.forceNextSelectionCheck = function () {
            delete this._.selectionPreviousPath;
        };
        g.prototype.getSelection = function () {
            var t = new d.selection(this);
            return !t || t.isInvalid ? null : t;
        };
        a.SELECTION_NONE = 1;
        a.SELECTION_TEXT = 2;
        a.SELECTION_ELEMENT = 3;
        d.selection = function (t) {
            var w = this;
            var u = t.getCustomData('cke_locked_selection');
            if (u)return u;
            w.document = t;
            w.isLocked = 0;
            w._ = {cache: {}};
            if (c) {
                var v = w.getNative().createRange();
                if (!v || v.item && v.item(0).ownerDocument != w.document.$ || v.parentElement && v.parentElement().ownerDocument != w.document.$)w.isInvalid = true;

            }
            return w;
        };
        var s = {
            img: 1,
            hr: 1,
            li: 1,
            table: 1,
            tr: 1,
            td: 1,
            th: 1,
            embed: 1,
            object: 1,
            ol: 1,
            ul: 1,
            a: 1,
            input: 1,
            form: 1,
            select: 1,
            textarea: 1,
            button: 1,
            fieldset: 1,
            th: 1,
            thead: 1,
            tfoot: 1
        };
        d.selection.prototype = {
            getNative: c ? function () {
                return this._.cache.nativeSel || (this._.cache.nativeSel = this.document.$.selection);
            } : function () {
                return this._.cache.nativeSel || (this._.cache.nativeSel = this.document.getWindow().$.getSelection());
            }, getType: c ? function () {
                var t = this._.cache;
                if (t.type)return t.type;
                var u = 1;
                try {
                    var v = this.getNative(), w = v.type;
                    if (w == 'Text')u = 2;
                    if (w == 'Control')u = 3;
                    if (v.createRange().parentElement)u = 2;
                } catch (x) {
                }
                return t.type = u;
            } : function () {
                var t = this._.cache;
                if (t.type)return t.type;
                var u = 2, v = this.getNative();
                if (!v)u = 1; else if (v.rangeCount == 1) {
                    var w = v.getRangeAt(0), x = w.startContainer;
                    if (x == w.endContainer && x.nodeType == 1 && w.endOffset - w.startOffset == 1 && s[x.childNodes[w.startOffset].nodeName.toLowerCase()])u = 3;
                }
                return t.type = u;
            }, getRanges: (function () {
                var t = c ? (function () {
                    var u = function (v, w) {
                        v = v.duplicate();
                        v.collapse(w);
                        var x = v.parentElement(), y = x.childNodes, z;
                        for (var A = 0; A < y.length; A++) {
                            var B = y[A];
                            if (B.nodeType == 1) {
                                z = v.duplicate();
                                z.moveToElementText(B);
                                var C = z.compareEndPoints('StartToStart', v), D = z.compareEndPoints('EndToStart', v);
                                z.collapse();
                                if (C > 0)break; else if (!C || D == 1 && C == -1)return {
                                    container: x,
                                    offset: A
                                }; else if (!D)return {container: x, offset: A + 1};
                                z = null;
                            }
                        }
                        if (!z) {
                            z = v.duplicate();
                            z.moveToElementText(x);
                            z.collapse(false);
                        }
                        z.setEndPoint('StartToStart', v);
                        var E = z.text.replace(/(\r\n|\r)/g, '\n').length;
                        try {
                            while (E > 0)E -= y[--A].nodeValue.length;
                        } catch (F) {
                            E = 0;
                        }
                        if (E === 0)return {container: x, offset: A}; else return {container: y[A], offset: -E};
                    };
                    return function () {
                        var F = this;
                        var v = F.getNative(), w = v && v.createRange(), x = F.getType(), y;
                        if (!v)return [];
                        if (x == 2) {
                            y = new d.range(F.document);
                            var z = u(w, true);
                            y.setStart(new d.node(z.container), z.offset);
                            z = u(w);
                            y.setEnd(new d.node(z.container), z.offset);
                            if (y.endContainer.getPosition(y.startContainer) & 4 && y.endOffset <= y.startContainer.getIndex())y.collapse();
                            return [y];
                        } else if (x == 3) {
                            var A = [];
                            for (var B = 0; B < w.length; B++) {
                                var C = w.item(B), D = C.parentNode, E = 0;
                                y = new d.range(F.document);
                                for (; E < D.childNodes.length && D.childNodes[E] != C; E++) {
                                }
                                y.setStart(new d.node(D), E);
                                y.setEnd(new d.node(D), E + 1);
                                A.push(y);
                            }
                            return A;
                        }
                        return [];
                    };
                })() : function () {
                    var u = [], v, w = this.document, x = this.getNative();
                    if (!x)return u;
                    if (!x.rangeCount) {
                        v = new d.range(w);
                        v.moveToElementEditStart(w.getBody());
                        u.push(v);
                    }
                    for (var y = 0; y < x.rangeCount; y++) {
                        var z = x.getRangeAt(y);
                        v = new d.range(w);
                        v.setStart(new d.node(z.startContainer), z.startOffset);

                        v.setEnd(new d.node(z.endContainer), z.endOffset);
                        u.push(v);
                    }
                    return u;
                };
                return function (u) {
                    var v = this._.cache;
                    if (v.ranges && !u)return v.ranges; else if (!v.ranges)v.ranges = new d.rangeList(t.call(this));
                    if (u) {
                        var w = v.ranges;
                        for (var x = 0; x < w.length; x++) {
                            var y = w[x], z = y.getCommonAncestor();
                            if (z.isReadOnly())w.splice(x, 1);
                            if (y.collapsed)continue;
                            var A = y.startContainer, B = y.endContainer, C = y.startOffset, D = y.endOffset, E = y.clone(), F;
                            if (F = A.isReadOnly())y.setStartAfter(F);
                            if (A && A.type == 3)if (C >= A.getLength())E.setStartAfter(A); else E.setStartBefore(A);
                            if (B && B.type == 3)if (!D)E.setEndBefore(B); else E.setEndAfter(B);
                            var G = new d.walker(E);
                            G.evaluator = function (H) {
                                if (H.type == 1 && H.getAttribute('contenteditable') == 'false') {
                                    var I = y.clone();
                                    y.setEndBefore(H);
                                    if (y.collapsed)w.splice(x--, 1);
                                    if (!(H.getPosition(E.endContainer) & 16)) {
                                        I.setStartAfter(H);
                                        if (!I.collapsed)w.splice(x + 1, 0, I);
                                    }
                                    return true;
                                }
                                return false;
                            };
                            G.next();
                        }
                    }
                    return v.ranges;
                };
            })(), getStartElement: function () {
                var A = this;
                var t = A._.cache;
                if (t.startElement !== undefined)return t.startElement;
                var u, v = A.getNative();
                switch (A.getType()) {
                    case 3:
                        return A.getSelectedElement();
                    case 2:
                        var w = A.getRanges()[0];
                        if (w) {
                            if (!w.collapsed) {
                                w.optimize();
                                while (1) {
                                    var x = w.startContainer, y = w.startOffset;
                                    if (y == (x.getChildCount ? x.getChildCount() : x.getLength()) && !x.isBlockBoundary())w.setStartAfter(x); else break;
                                }
                                u = w.startContainer;
                                if (u.type != 1)return u.getParent();
                                u = u.getChild(w.startOffset);
                                if (!u || u.type != 1)u = w.startContainer; else {
                                    var z = u.getFirst();
                                    while (z && z.type == 1) {
                                        u = z;
                                        z = z.getFirst();
                                    }
                                }
                            } else {
                                u = w.startContainer;
                                if (u.type != 1)u = u.getParent();
                            }
                            u = u.$;
                        }
                }
                return t.startElement = u ? new h(u) : null;
            }, getSelectedElement: function () {
                var t = this._.cache;
                if (t.selectedElement !== undefined)return t.selectedElement;
                var u = this, v = e.tryThese(function () {
                    return u.getNative().createRange().item(0);
                }, function () {
                    var w = u.getRanges()[0], x, y;
                    for (var z = 2; z && !((x = w.getEnclosedNode()) && x.type == 1 && s[x.getName()] && (y = x)); z--)w.shrink(1);
                    return y.$;
                });
                return t.selectedElement = v ? new h(v) : null;
            }, lock: function () {
                var t = this;
                t.getRanges();
                t.getStartElement();
                t.getSelectedElement();
                t._.cache.nativeSel = {};
                t.isLocked = 1;
                t.document.setCustomData('cke_locked_selection', t);
            }, unlock: function (t) {
                var y = this;
                var u = y.document, v = u.getCustomData('cke_locked_selection');
                if (v) {
                    u.setCustomData('cke_locked_selection', null);
                    if (t) {
                        var w = v.getSelectedElement(), x = !w && v.getRanges();
                        y.isLocked = 0;
                        y.reset();
                        u.getBody().focus();
                        if (w)y.selectElement(w); else y.selectRanges(x);
                    }
                }
                if (!v || !t) {
                    y.isLocked = 0;
                    y.reset();
                }
            }, reset: function () {
                this._.cache = {};

            }, selectElement: function (t) {
                var w = this;
                if (w.isLocked) {
                    var u = new d.range(w.document);
                    u.setStartBefore(t);
                    u.setEndAfter(t);
                    w._.cache.selectedElement = t;
                    w._.cache.startElement = t;
                    w._.cache.ranges = new d.rangeList(u);
                    w._.cache.type = 3;
                    return;
                }
                if (c) {
                    w.getNative().empty();
                    try {
                        u = w.document.$.body.createControlRange();
                        u.addElement(t.$);
                        u.select();
                    } catch (x) {
                        u = w.document.$.body.createTextRange();
                        u.moveToElementText(t.$);
                        u.select();
                    } finally {
                        w.document.fire('selectionchange');
                    }
                    w.reset();
                } else {
                    u = w.document.$.createRange();
                    u.selectNode(t.$);
                    var v = w.getNative();
                    v.removeAllRanges();
                    v.addRange(u);
                    w.reset();
                }
            }, selectRanges: function (t) {
                var D = this;
                if (D.isLocked) {
                    D._.cache.selectedElement = null;
                    D._.cache.startElement = t[0] && t[0].getTouchedStartNode();
                    D._.cache.ranges = new d.rangeList(t);
                    D._.cache.type = 2;
                    return;
                }
                if (c) {
                    if (t.length > 1) {
                        var u = t[t.length - 1];
                        t[0].setEnd(u.endContainer, u.endOffset);
                        t.length = 1;
                    }
                    if (t[0])t[0].select();
                    D.reset();
                } else {
                    var v = D.getNative();
                    if (t.length)v.removeAllRanges();
                    for (var w = 0; w < t.length; w++) {
                        if (w < t.length - 1) {
                            var x = t[w], y = t[w + 1], z = x.clone();
                            z.setStart(x.endContainer, x.endOffset);
                            z.setEnd(y.startContainer, y.startOffset);
                            if (!z.collapsed) {
                                z.shrink(1, true);
                                if (z.getCommonAncestor().isReadOnly()) {
                                    y.setStart(x.startContainer, x.startOffset);
                                    t.splice(w--, 1);
                                    continue;
                                }
                            }
                        }
                        var A = t[w], B = D.document.$.createRange(), C = A.startContainer;
                        if (A.collapsed && (b.opera || b.gecko && b.version < 10900) && C.type == 1 && !C.getChildCount())C.appendText('');
                        B.setStart(C.$, A.startOffset);
                        B.setEnd(A.endContainer.$, A.endOffset);
                        v.addRange(B);
                    }
                    D.reset();
                }
            }, createBookmarks: function (t) {
                return this.getRanges().createBookmarks(t);
            }, createBookmarks2: function (t) {
                return this.getRanges().createBookmarks2(t);
            }, selectBookmarks: function (t) {
                var u = [];
                for (var v = 0; v < t.length; v++) {
                    var w = new d.range(this.document);
                    w.moveToBookmark(t[v]);
                    u.push(w);
                }
                this.selectRanges(u);
                return this;
            }, getCommonAncestor: function () {
                var t = this.getRanges(), u = t[0].startContainer, v = t[t.length - 1].endContainer;
                return u.getCommonAncestor(v);
            }, scrollIntoView: function () {
                var t = this.getStartElement();
                t.scrollIntoView();
            }
        };
    })();
    (function () {
        var m = d.walker.whitespaces(true), n = /\ufeff|\u00a0/, o = {table: 1, tbody: 1, tr: 1};
        d.range.prototype.select = c ? function (p) {
            var z = this;
            var q = z.collapsed, r, s;
            if (z.startContainer.type == 1 && z.startContainer.getName() in o || z.endContainer.type == 1 && z.endContainer.getName() in o)z.shrink(1, true);
            var t = z.createBookmark(), u = t.startNode, v;
            if (!q)v = t.endNode;
            var w = z.document.$.body.createTextRange();
            w.moveToElementText(u.$);
            w.moveStart('character', 1);

            if (v) {
                var x = z.document.$.body.createTextRange();
                x.moveToElementText(v.$);
                w.setEndPoint('EndToEnd', x);
                w.moveEnd('character', -1);
            } else {
                var y = u.getNext(m);
                r = !(y && y.getText && y.getText().match(n)) && (p || !u.hasPrevious() || u.getPrevious().is && u.getPrevious().is('br'));
                s = z.document.createElement('span');
                s.setHtml('&#65279;');
                s.insertBefore(u);
                if (r)z.document.createText('\ufeff').insertBefore(u);
            }
            z.setStartBefore(u);
            u.remove();
            if (q) {
                if (r) {
                    w.moveStart('character', -1);
                    w.select();
                    z.document.$.selection.clear();
                } else w.select();
                z.moveToPosition(s, 3);
                s.remove();
            } else {
                z.setEndBefore(v);
                v.remove();
                w.select();
            }
            z.document.fire('selectionchange');
        } : function () {
            var s = this;
            var p = s.startContainer;
            if (s.collapsed && p.type == 1 && !p.getChildCount())p.append(new d.text(''));
            var q = s.document.$.createRange();
            q.setStart(p.$, s.startOffset);
            try {
                q.setEnd(s.endContainer.$, s.endOffset);
            } catch (t) {
                if (t.toString().indexOf('NS_ERROR_ILLEGAL_VALUE') >= 0) {
                    s.collapse(true);
                    q.setEnd(s.endContainer.$, s.endOffset);
                } else throw t;
            }
            var r = s.document.getSelection().getNative();
            r.removeAllRanges();
            r.addRange(q);
        };
    })();
    (function () {
        var m = {
            elements: {
                $: function (n) {
                    var o = n.attributes, p = o && o['data-cke-realelement'], q = p && new a.htmlParser.fragment.fromHtml(decodeURIComponent(p)), r = q && q.children[0];
                    if (r && n.attributes['data-cke-resizable']) {
                        var s = n.attributes.style;
                        if (s) {
                            var t = /(?:^|\s)width\s*:\s*(\d+)/i.exec(s), u = t && t[1];
                            t = /(?:^|\s)height\s*:\s*(\d+)/i.exec(s);
                            var v = t && t[1];
                            if (u)r.attributes.width = u;
                            if (v)r.attributes.height = v;
                        }
                    }
                    return r;
                }
            }
        };
        j.add('fakeobjects', {
            requires: ['htmlwriter'], afterInit: function (n) {
                var o = n.dataProcessor, p = o && o.htmlFilter;
                if (p)p.addRules(m);
            }
        });
    })();
    a.editor.prototype.createFakeElement = function (m, n, o, p) {
        var q = this.lang.fakeobjects, r = q[o] || q.unknown, s = {
            'class': n,
            src: a.getUrl('images/spacer.gif'),
            'data-cke-realelement': encodeURIComponent(m.getOuterHtml()),
            'data-cke-real-node-type': m.type,
            alt: r,
            title: r,
            align: m.getAttribute('align') || ''
        };
        if (o)s['data-cke-real-element-type'] = o;
        if (p)s['data-cke-resizable'] = p;
        return this.document.createElement('img', {attributes: s});
    };
    a.editor.prototype.createFakeParserElement = function (m, n, o, p) {
        var q = this.lang.fakeobjects, r = q[o] || q.unknown, s, t = new a.htmlParser.basicWriter();
        m.writeHtml(t);
        s = t.getHtml();
        var u = {
            'class': n,
            src: a.getUrl('images/spacer.gif'),
            'data-cke-realelement': encodeURIComponent(s),
            'data-cke-real-node-type': m.type,
            alt: r,
            title: r,
            align: m.attributes.align || ''
        };
        if (o)u['data-cke-real-element-type'] = o;
        if (p)u['data-cke-resizable'] = p;
        return new a.htmlParser.element('img', u);

    };
    a.editor.prototype.restoreRealElement = function (m) {
        if (m.data('cke-real-node-type') != 1)return null;
        return h.createFromHtml(decodeURIComponent(m.data('cke-realelement')), this.document);
    };
    j.add('richcombo', {
        requires: ['floatpanel', 'listblock', 'button'], beforeInit: function (m) {
            m.ui.addHandler(3, k.richCombo.handler);
        }
    });
    a.UI_RICHCOMBO = 3;
    k.richCombo = e.createClass({
        $: function (m) {
            var o = this;
            e.extend(o, m, {title: m.label, modes: {wysiwyg: 1}});
            var n = o.panel || {};
            delete o.panel;
            o.id = e.getNextNumber();
            o.document = n && n.parent && n.parent.getDocument() || a.document;
            n.className = (n.className || '') + ' cke_rcombopanel';
            n.block = {multiSelect: n.multiSelect, attributes: n.attributes};
            o._ = {panelDefinition: n, items: {}, state: 2};
        }, statics: {
            handler: {
                create: function (m) {
                    return new k.richCombo(m);
                }
            }
        }, proto: {
            renderHtml: function (m) {
                var n = [];
                this.render(m, n);
                return n.join('');
            }, render: function (m, n) {
                var o = b, p = 'cke_' + this.id, q = e.addFunction(function (t) {
                    var w = this;
                    var u = w._;
                    if (u.state == 0)return;
                    w.createPanel(m);
                    if (u.on) {
                        u.panel.hide();
                        return;
                    }
                    w.commit();
                    var v = w.getValue();
                    if (v)u.list.mark(v); else u.list.unmarkAll();
                    u.panel.showBlock(w.id, new h(t), 4);
                }, this), r = {
                    id: p, combo: this, focus: function () {
                        var t = a.document.getById(p).getChild(1);
                        t.focus();
                    }, clickFn: q
                };
                m.on('mode', function () {
                    this.setState(this.modes[m.mode] ? 2 : 0);
                }, this);
                var s = e.addFunction(function (t, u) {
                    t = new d.event(t);
                    var v = t.getKeystroke();
                    switch (v) {
                        case 13:
                        case 32:
                        case 40:
                            e.callFunction(q, u);
                            break;
                        default:
                            r.onkey(r, v);
                    }
                    t.preventDefault();
                });
                r.keyDownFn = s;
                n.push('<span class="cke_rcombo">', '<span id=', p);
                if (this.className)n.push(' class="', this.className, ' cke_off"');
                n.push('>', '<span id="' + p + '_label" class=cke_label>', this.label, '</span>', '<a hidefocus=true title="', this.title, '" tabindex="-1"', o.gecko && o.version >= 10900 && !o.hc ? '' : " href=\"javascript:void('" + this.label + "')\"", ' role="button" aria-labelledby="', p, '_label" aria-describedby="', p, '_text" aria-haspopup="true"');
                if (b.opera || b.gecko && b.mac)n.push(' onkeypress="return false;"');
                if (b.gecko)n.push(' onblur="this.style.cssText = this.style.cssText;"');
                n.push(' onkeydown="CKEDITOR.tools.callFunction( ', s, ', event, this );" onclick="CKEDITOR.tools.callFunction(', q, ', this); return false;"><span><span id="' + p + '_text" class="cke_text cke_inline_label">' + this.label + '</span>' + '</span>' + '<span class=cke_openbutton>' + (b.hc ? '<span>&#9660;</span>' : b.air ? '&nbsp;' : '') + '</span>' + '</a>' + '</span>' + '</span>');
                if (this.onRender)this.onRender();
                return r;
            }, createPanel: function (m) {
                if (this._.panel)return;
                var n = this._.panelDefinition, o = this._.panelDefinition.block, p = n.parent || a.document.getBody(), q = new k.floatPanel(m, p, n), r = q.addListBlock(this.id, o), s = this;

                q.onShow = function () {
                    if (s.className)this.element.getFirst().addClass(s.className + '_panel');
                    s.setState(1);
                    r.focus(!s.multiSelect && s.getValue());
                    s._.on = 1;
                    if (s.onOpen)s.onOpen();
                };
                q.onHide = function (t) {
                    if (s.className)this.element.getFirst().removeClass(s.className + '_panel');
                    s.setState(s.modes && s.modes[m.mode] ? 2 : 0);
                    s._.on = 0;
                    if (!t && s.onClose)s.onClose();
                };
                q.onEscape = function () {
                    q.hide();
                    s.document.getById('cke_' + s.id).getFirst().getNext().focus();
                };
                r.onClick = function (t, u) {
                    s.document.getWindow().focus();
                    if (s.onClick)s.onClick.call(s, t, u);
                    if (u)s.setValue(t, s._.items[t]); else s.setValue('');
                    q.hide();
                };
                this._.panel = q;
                this._.list = r;
                q.getBlock(this.id).onHide = function () {
                    s._.on = 0;
                    s.setState(2);
                };
                if (this.init)this.init();
            }, setValue: function (m, n) {
                var p = this;
                p._.value = m;
                var o = p.document.getById('cke_' + p.id + '_text');
                if (!(m || n)) {
                    n = p.label;
                    o.addClass('cke_inline_label');
                } else o.removeClass('cke_inline_label');
                o.setHtml(typeof n != 'undefined' ? n : m);
            }, getValue: function () {
                return this._.value || '';
            }, unmarkAll: function () {
                this._.list.unmarkAll();
            }, mark: function (m) {
                this._.list.mark(m);
            }, hideItem: function (m) {
                this._.list.hideItem(m);
            }, hideGroup: function (m) {
                this._.list.hideGroup(m);
            }, showAll: function () {
                this._.list.showAll();
            }, add: function (m, n, o) {
                this._.items[m] = o || m;
                this._.list.add(m, n, o);
            }, startGroup: function (m) {
                this._.list.startGroup(m);
            }, commit: function () {
                var m = this;
                if (!m._.committed) {
                    m._.list.commit();
                    m._.committed = 1;
                    k.fire('ready', m);
                }
                m._.committed = 1;
            }, setState: function (m) {
                var n = this;
                if (n._.state == m)return;
                n.document.getById('cke_' + n.id).setState(m);
                n._.state = m;
            }
        }
    });
    k.prototype.addRichCombo = function (m, n) {
        this.add(m, 3, n);
    };
    j.add('htmlwriter');
    a.htmlWriter = e.createClass({
        base: a.htmlParser.basicWriter, $: function () {
            var o = this;
            o.base();
            o.indentationChars = '\t';
            o.selfClosingEnd = ' />';
            o.lineBreakChars = '\n';
            o.forceSimpleAmpersand = 0;
            o.sortAttributes = 1;
            o._.indent = 0;
            o._.indentation = '';
            o._.inPre = 0;
            o._.rules = {};
            var m = f;
            for (var n in e.extend({}, m.$nonBodyContent, m.$block, m.$listItem, m.$tableContent))o.setRules(n, {
                indent: 1,
                breakBeforeOpen: 1,
                breakAfterOpen: 1,
                breakBeforeClose: !m[n]['#'],
                breakAfterClose: 1
            });
            o.setRules('br', {breakAfterOpen: 1});
            o.setRules('title', {indent: 0, breakAfterOpen: 0});
            o.setRules('style', {indent: 0, breakBeforeClose: 1});
            o.setRules('pre', {indent: 0});
        }, proto: {
            openTag: function (m, n) {
                var p = this;
                var o = p._.rules[m];
                if (p._.indent)p.indentation(); else if (o && o.breakBeforeOpen) {
                    p.lineBreak();
                    p.indentation();
                }
                p._.output.push('<', m);
            }, openTagClose: function (m, n) {
                var p = this;
                var o = p._.rules[m];
                if (n)p._.output.push(p.selfClosingEnd);

                else {
                    p._.output.push('>');
                    if (o && o.indent)p._.indentation += p.indentationChars;
                }
                if (o && o.breakAfterOpen)p.lineBreak();
                m == 'pre' && (p._.inPre = 1);
            }, attribute: function (m, n) {
                if (typeof n == 'string') {
                    this.forceSimpleAmpersand && (n = n.replace(/&amp;/g, '&'));
                    n = e.htmlEncodeAttr(n);
                }
                this._.output.push(' ', m, '="', n, '"');
            }, closeTag: function (m) {
                var o = this;
                var n = o._.rules[m];
                if (n && n.indent)o._.indentation = o._.indentation.substr(o.indentationChars.length);
                if (o._.indent)o.indentation(); else if (n && n.breakBeforeClose) {
                    o.lineBreak();
                    o.indentation();
                }
                o._.output.push('</', m, '>');
                m == 'pre' && (o._.inPre = 0);
                if (n && n.breakAfterClose)o.lineBreak();
            }, text: function (m) {
                var n = this;
                if (n._.indent) {
                    n.indentation();
                    !n._.inPre && (m = e.ltrim(m));
                }
                n._.output.push(m);
            }, comment: function (m) {
                if (this._.indent)this.indentation();
                this._.output.push('<!--', m, '-->');
            }, lineBreak: function () {
                var m = this;
                if (!m._.inPre && m._.output.length > 0)m._.output.push(m.lineBreakChars);
                m._.indent = 1;
            }, indentation: function () {
                var m = this;
                if (!m._.inPre)m._.output.push(m._.indentation);
                m._.indent = 0;
            }, setRules: function (m, n) {
                var o = this._.rules[m];
                if (o)e.extend(o, n, true); else this._.rules[m] = n;
            }
        }
    });
    j.add('menubutton', {
        requires: ['button', 'menu'], beforeInit: function (m) {
            m.ui.addHandler(5, k.menuButton.handler);
        }
    });
    a.UI_MENUBUTTON = 5;
    (function () {
        var m = function (n) {
            var o = this._;
            if (o.state === 0)return;
            o.previousState = o.state;
            var p = o.menu;
            if (!p) {
                p = o.menu = new a.menu(n, {
                    panel: {
                        className: n.skinClass + ' cke_contextmenu',
                        attributes: {'aria-label': n.lang.common.options}
                    }
                });
                p.onHide = e.bind(function () {
                    this.setState(this.modes && this.modes[n.mode] ? o.previousState : 0);
                }, this);
                if (this.onMenu)p.addListener(this.onMenu);
            }
            if (o.on) {
                p.hide();
                return;
            }
            this.setState(1);
            p.show(a.document.getById(this._.id), 4);
        };
        k.menuButton = e.createClass({
            base: k.button, $: function (n) {
                var o = n.panel;
                delete n.panel;
                this.base(n);
                this.hasArrow = true;
                this.click = m;
            }, statics: {
                handler: {
                    create: function (n) {
                        return new k.menuButton(n);
                    }
                }
            }
        });
    })();
    j.add('dialogui');
    (function () {
        var m = function (u) {
            var x = this;
            x._ || (x._ = {});
            x._['default'] = x._.initValue = u['default'] || '';
            x._.required = u.required || false;
            var v = [x._];
            for (var w = 1; w < arguments.length; w++)v.push(arguments[w]);
            v.push(true);
            e.extend.apply(e, v);
            return x._;
        }, n = {
            build: function (u, v, w) {
                return new k.dialog.textInput(u, v, w);
            }
        }, o = {
            build: function (u, v, w) {
                return new k.dialog[v.type](u, v, w);
            }
        }, p = {
            build: function (u, v, w) {
                var x = v.children, y, z = [], A = [];
                for (var B = 0; B < x.length && (y = x[B]); B++) {
                    var C = [];
                    z.push(C);
                    A.push(a.dialog._.uiElementBuilders[y.type].build(u, y, C));
                }
                return new k.dialog[v.type](u, A, z, w, v);

            }
        }, q = {
            isChanged: function () {
                return this.getValue() != this.getInitValue();
            }, reset: function (u) {
                this.setValue(this.getInitValue(), u);
            }, setInitValue: function () {
                this._.initValue = this.getValue();
            }, resetInitValue: function () {
                this._.initValue = this._['default'];
            }, getInitValue: function () {
                return this._.initValue;
            }
        }, r = e.extend({}, k.dialog.uiElement.prototype.eventProcessors, {
            onChange: function (u, v) {
                if (!this._.domOnChangeRegistered) {
                    u.on('load', function () {
                        this.getInputElement().on('change', function () {
                            if (!u.parts.dialog.isVisible())return;
                            this.fire('change', {value: this.getValue()});
                        }, this);
                    }, this);
                    this._.domOnChangeRegistered = true;
                }
                this.on('change', v);
            }
        }, true), s = /^on([A-Z]\w+)/, t = function (u) {
            for (var v in u) {
                if (s.test(v) || v == 'title' || v == 'type')delete u[v];
            }
            return u;
        };
        e.extend(k.dialog, {
            labeledElement: function (u, v, w, x) {
                if (arguments.length < 4)return;
                var y = m.call(this, v);
                y.labelId = e.getNextId() + '_label';
                var z = this._.children = [], A = function () {
                    var B = [], C = v.required ? ' cke_required' : '';
                    if (v.labelLayout != 'horizontal')B.push('<label class="cke_dialog_ui_labeled_label' + C + '" ', ' id="' + y.labelId + '"', ' for="' + y.inputId + '"', ' style="' + v.labelStyle + '">', v.label, '</label>', '<div class="cke_dialog_ui_labeled_content" role="presentation">', x.call(this, u, v), '</div>'); else {
                        var D = {
                            type: 'hbox',
                            widths: v.widths,
                            padding: 0,
                            children: [{
                                type: 'html',
                                html: '<label class="cke_dialog_ui_labeled_label' + C + '"' + ' id="' + y.labelId + '"' + ' for="' + y.inputId + '"' + ' style="' + v.labelStyle + '">' + e.htmlEncode(v.label) + '</span>'
                            }, {
                                type: 'html',
                                html: '<span class="cke_dialog_ui_labeled_content">' + x.call(this, u, v) + '</span>'
                            }]
                        };
                        a.dialog._.uiElementBuilders.hbox.build(u, D, B);
                    }
                    return B.join('');
                };
                k.dialog.uiElement.call(this, u, v, w, 'div', null, {role: 'presentation'}, A);
            }, textInput: function (u, v, w) {
                if (arguments.length < 3)return;
                m.call(this, v);
                var x = this._.inputId = e.getNextId() + '_textInput', y = {
                    'class': 'cke_dialog_ui_input_' + v.type,
                    id: x,
                    type: 'text'
                }, z;
                if (v.validate)this.validate = v.validate;
                if (v.maxLength)y.maxlength = v.maxLength;
                if (v.size)y.size = v.size;
                if (v.controlStyle)y.style = v.controlStyle;
                var A = this, B = false;
                u.on('load', function () {
                    A.getInputElement().on('keydown', function (D) {
                        if (D.data.getKeystroke() == 13)B = true;
                    });
                    A.getInputElement().on('keyup', function (D) {
                        if (D.data.getKeystroke() == 13 && B) {
                            u.getButton('ok') && setTimeout(function () {
                                u.getButton('ok').click();
                            }, 0);
                            B = false;
                        }
                    }, null, null, 1000);
                });
                var C = function () {
                    var D = ['<div class="cke_dialog_ui_input_', v.type, '" role="presentation"'];
                    if (v.width)D.push('style="width:' + v.width + '" ');
                    D.push('><input ');

                    y['aria-labelledby'] = this._.labelId;
                    this._.required && (y['aria-required'] = this._.required);
                    for (var E in y)D.push(E + '="' + y[E] + '" ');
                    D.push(' /></div>');
                    return D.join('');
                };
                k.dialog.labeledElement.call(this, u, v, w, C);
            }, textarea: function (u, v, w) {
                if (arguments.length < 3)return;
                m.call(this, v);
                var x = this, y = this._.inputId = e.getNextId() + '_textarea', z = {};
                if (v.validate)this.validate = v.validate;
                z.rows = v.rows || 5;
                z.cols = v.cols || 20;
                var A = function () {
                    z['aria-labelledby'] = this._.labelId;
                    this._.required && (z['aria-required'] = this._.required);
                    var B = ['<div class="cke_dialog_ui_input_textarea" role="presentation"><textarea class="cke_dialog_ui_input_textarea" id="', y, '" '];
                    for (var C in z)B.push(C + '="' + e.htmlEncode(z[C]) + '" ');
                    B.push('>', e.htmlEncode(x._['default']), '</textarea></div>');
                    return B.join('');
                };
                k.dialog.labeledElement.call(this, u, v, w, A);
            }, checkbox: function (u, v, w) {
                if (arguments.length < 3)return;
                var x = m.call(this, v, {'default': !!v['default']});
                if (v.validate)this.validate = v.validate;
                var y = function () {
                    var z = e.extend({}, v, {id: v.id ? v.id + '_checkbox' : e.getNextId() + '_checkbox'}, true), A = [], B = e.getNextId() + '_label', C = {
                        'class': 'cke_dialog_ui_checkbox_input',
                        type: 'checkbox',
                        'aria-labelledby': B
                    };
                    t(z);
                    if (v['default'])C.checked = 'checked';
                    if (typeof z.controlStyle != 'undefined')z.style = z.controlStyle;
                    x.checkbox = new k.dialog.uiElement(u, z, A, 'input', null, C);
                    A.push(' <label id="', B, '" for="', C.id, '">', e.htmlEncode(v.label), '</label>');
                    return A.join('');
                };
                k.dialog.uiElement.call(this, u, v, w, 'span', null, null, y);
            }, radio: function (u, v, w) {
                if (arguments.length < 3)return;
                m.call(this, v);
                if (!this._['default'])this._['default'] = this._.initValue = v.items[0][1];
                if (v.validate)this.validate = v.valdiate;
                var x = [], y = this, z = function () {
                    var A = [], B = [], C = {
                        'class': 'cke_dialog_ui_radio_item',
                        'aria-labelledby': this._.labelId
                    }, D = v.id ? v.id + '_radio' : e.getNextId() + '_radio';
                    for (var E = 0; E < v.items.length; E++) {
                        var F = v.items[E], G = F[2] !== undefined ? F[2] : F[0], H = F[1] !== undefined ? F[1] : F[0], I = e.getNextId() + '_radio_input', J = I + '_label', K = e.extend({}, v, {
                            id: I,
                            title: null,
                            type: null
                        }, true), L = e.extend({}, K, {title: G}, true), M = {
                            type: 'radio',
                            'class': 'cke_dialog_ui_radio_input',
                            name: D,
                            value: H,
                            'aria-labelledby': J
                        }, N = [];
                        if (y._['default'] == H)M.checked = 'checked';
                        t(K);
                        t(L);
                        if (typeof K.controlStyle != 'undefined')K.style = K.controlStyle;
                        x.push(new k.dialog.uiElement(u, K, N, 'input', null, M));
                        N.push(' ');
                        new k.dialog.uiElement(u, L, N, 'label', null, {id: J, 'for': M.id}, F[0]);
                        A.push(N.join(''));
                    }
                    new k.dialog.hbox(u, [], A, B);
                    return B.join('');
                };
                k.dialog.labeledElement.call(this, u, v, w, z);

                this._.children = x;
            }, button: function (u, v, w) {
                if (!arguments.length)return;
                if (typeof v == 'function')v = v(u.getParentEditor());
                m.call(this, v, {disabled: v.disabled || false});
                a.event.implementOn(this);
                var x = this;
                u.on('load', function (A) {
                    var B = this.getElement();
                    (function () {
                        B.on('click', function (C) {
                            x.fire('click', {dialog: x.getDialog()});
                            C.data.preventDefault();
                        });
                        B.on('keydown', function (C) {
                            if (C.data.getKeystroke() in {32: 1}) {
                                x.click();
                                C.data.preventDefault();
                            }
                        });
                    })();
                    B.unselectable();
                }, this);
                var y = e.extend({}, v);
                delete y.style;
                var z = e.getNextId() + '_label';
                k.dialog.uiElement.call(this, u, y, w, 'a', null, {
                    style: v.style,
                    href: 'javascript:void(0)',
                    title: v.label,
                    hidefocus: 'true',
                    'class': v['class'],
                    role: 'button',
                    'aria-labelledby': z
                }, '<span id="' + z + '" class="cke_dialog_ui_button">' + e.htmlEncode(v.label) + '</span>');
            }, select: function (u, v, w) {
                if (arguments.length < 3)return;
                var x = m.call(this, v);
                if (v.validate)this.validate = v.validate;
                x.inputId = e.getNextId() + '_select';
                var y = function () {
                    var z = e.extend({}, v, {id: v.id ? v.id + '_select' : e.getNextId() + '_select'}, true), A = [], B = [], C = {
                        id: x.inputId,
                        'class': 'cke_dialog_ui_input_select',
                        'aria-labelledby': this._.labelId
                    };
                    if (v.size != undefined)C.size = v.size;
                    if (v.multiple != undefined)C.multiple = v.multiple;
                    t(z);
                    for (var D = 0, E; D < v.items.length && (E = v.items[D]); D++)B.push('<option value="', e.htmlEncode(E[1] !== undefined ? E[1] : E[0]), '" /> ', e.htmlEncode(E[0]));
                    if (typeof z.controlStyle != 'undefined')z.style = z.controlStyle;
                    x.select = new k.dialog.uiElement(u, z, A, 'select', null, C, B.join(''));
                    return A.join('');
                };
                k.dialog.labeledElement.call(this, u, v, w, y);
            }, file: function (u, v, w) {
                if (arguments.length < 3)return;
                if (v['default'] === undefined)v['default'] = '';
                var x = e.extend(m.call(this, v), {definition: v, buttons: []});
                if (v.validate)this.validate = v.validate;
                var y = function () {
                    x.frameId = e.getNextId() + '_fileInput';
                    var z = b.isCustomDomain(), A = ['<iframe frameborder="0" allowtransparency="0" class="cke_dialog_ui_input_file" id="', x.frameId, '" title="', v.label, '" src="javascript:void('];
                    A.push(z ? "(function(){document.open();document.domain='" + document.domain + "';" + 'document.close();' + '})()' : '0');
                    A.push(')"></iframe>');
                    return A.join('');
                };
                u.on('load', function () {
                    var z = a.document.getById(x.frameId), A = z.getParent();
                    A.addClass('cke_dialog_ui_input_file');
                });
                k.dialog.labeledElement.call(this, u, v, w, y);
            }, fileButton: function (u, v, w) {
                if (arguments.length < 3)return;
                var x = m.call(this, v), y = this;
                if (v.validate)this.validate = v.validate;
                var z = e.extend({}, v), A = z.onClick;
                z.className = (z.className ? z.className + ' ' : '') + 'cke_dialog_ui_button';

                z.onClick = function (B) {
                    var C = v['for'];
                    if (!A || A.call(this, B) !== false) {
                        u.getContentElement(C[0], C[1]).submit();
                        this.disable();
                    }
                };
                u.on('load', function () {
                    u.getContentElement(v['for'][0], v['for'][1])._.buttons.push(y);
                });
                k.dialog.button.call(this, u, z, w);
            }, html: (function () {
                var u = /^\s*<[\w:]+\s+([^>]*)?>/, v = /^(\s*<[\w:]+(?:\s+[^>]*)?)((?:.|\r|\n)+)$/, w = /\/$/;
                return function (x, y, z) {
                    if (arguments.length < 3)return;
                    var A = [], B, C = y.html, D, E;
                    if (C.charAt(0) != '<')C = '<span>' + C + '</span>';
                    var F = y.focus;
                    if (F) {
                        var G = this.focus;
                        this.focus = function () {
                            G.call(this);
                            typeof F == 'function' && F.call(this);
                            this.fire('focus');
                        };
                        if (y.isFocusable) {
                            var H = this.isFocusable;
                            this.isFocusable = H;
                        }
                        this.keyboardFocusable = true;
                    }
                    k.dialog.uiElement.call(this, x, y, A, 'span', null, null, '');
                    B = A.join('');
                    D = B.match(u);
                    E = C.match(v) || ['', '', ''];
                    if (w.test(E[1])) {
                        E[1] = E[1].slice(0, -1);
                        E[2] = '/' + E[2];
                    }
                    z.push([E[1], ' ', D[1] || '', E[2]].join(''));
                };
            })(), fieldset: function (u, v, w, x, y) {
                var z = y.label, A = function () {
                    var B = [];
                    z && B.push('<legend>' + z + '</legend>');
                    for (var C = 0; C < w.length; C++)B.push(w[C]);
                    return B.join('');
                };
                this._ = {children: v};
                k.dialog.uiElement.call(this, u, y, x, 'fieldset', null, null, A);
            }
        }, true);
        k.dialog.html.prototype = new k.dialog.uiElement();
        k.dialog.labeledElement.prototype = e.extend(new k.dialog.uiElement(), {
            setLabel: function (u) {
                var v = a.document.getById(this._.labelId);
                if (v.getChildCount() < 1)new d.text(u, a.document).appendTo(v); else v.getChild(0).$.nodeValue = u;
                return this;
            }, getLabel: function () {
                var u = a.document.getById(this._.labelId);
                if (!u || u.getChildCount() < 1)return ''; else return u.getChild(0).getText();
            }, eventProcessors: r
        }, true);
        k.dialog.button.prototype = e.extend(new k.dialog.uiElement(), {
            click: function () {
                var u = this;
                if (!u._.disabled)return u.fire('click', {dialog: u._.dialog});
                u.getElement().$.blur();
                return false;
            }, enable: function () {
                this._.disabled = false;
                var u = this.getElement();
                u && u.removeClass('cke_disabled');
            }, disable: function () {
                this._.disabled = true;
                this.getElement().addClass('cke_disabled');
            }, isVisible: function () {
                return this.getElement().getFirst().isVisible();
            }, isEnabled: function () {
                return !this._.disabled;
            }, eventProcessors: e.extend({}, k.dialog.uiElement.prototype.eventProcessors, {
                onClick: function (u, v) {
                    this.on('click', v);
                }
            }, true), accessKeyUp: function () {
                this.click();
            }, accessKeyDown: function () {
                this.focus();
            }, keyboardFocusable: true
        }, true);
        k.dialog.textInput.prototype = e.extend(new k.dialog.labeledElement(), {
            getInputElement: function () {
                return a.document.getById(this._.inputId);
            }, focus: function () {
                var u = this.selectParentTab();

                setTimeout(function () {
                    var v = u.getInputElement();
                    v && v.$.focus();
                }, 0);
            }, select: function () {
                var u = this.selectParentTab();
                setTimeout(function () {
                    var v = u.getInputElement();
                    if (v) {
                        v.$.focus();
                        v.$.select();
                    }
                }, 0);
            }, accessKeyUp: function () {
                this.select();
            }, setValue: function (u) {
                !u && (u = '');
                return k.dialog.uiElement.prototype.setValue.apply(this, arguments);
            }, keyboardFocusable: true
        }, q, true);
        k.dialog.textarea.prototype = new k.dialog.textInput();
        k.dialog.select.prototype = e.extend(new k.dialog.labeledElement(), {
            getInputElement: function () {
                return this._.select.getElement();
            }, add: function (u, v, w) {
                var x = new h('option', this.getDialog().getParentEditor().document), y = this.getInputElement().$;
                x.$.text = u;
                x.$.value = v === undefined || v === null ? u : v;
                if (w === undefined || w === null) {
                    if (c)y.add(x.$); else y.add(x.$, null);
                } else y.add(x.$, w);
                return this;
            }, remove: function (u) {
                var v = this.getInputElement().$;
                v.remove(u);
                return this;
            }, clear: function () {
                var u = this.getInputElement().$;
                while (u.length > 0)u.remove(0);
                return this;
            }, keyboardFocusable: true
        }, q, true);
        k.dialog.checkbox.prototype = e.extend(new k.dialog.uiElement(), {
            getInputElement: function () {
                return this._.checkbox.getElement();
            }, setValue: function (u, v) {
                this.getInputElement().$.checked = u;
                !v && this.fire('change', {value: u});
            }, getValue: function () {
                return this.getInputElement().$.checked;
            }, accessKeyUp: function () {
                this.setValue(!this.getValue());
            }, eventProcessors: {
                onChange: function (u, v) {
                    if (!c)return r.onChange.apply(this, arguments); else {
                        u.on('load', function () {
                            var w = this._.checkbox.getElement();
                            w.on('propertychange', function (x) {
                                x = x.data.$;
                                if (x.propertyName == 'checked')this.fire('change', {value: w.$.checked});
                            }, this);
                        }, this);
                        this.on('change', v);
                    }
                    return null;
                }
            }, keyboardFocusable: true
        }, q, true);
        k.dialog.radio.prototype = e.extend(new k.dialog.uiElement(), {
            setValue: function (u, v) {
                var w = this._.children, x;
                for (var y = 0; y < w.length && (x = w[y]); y++)x.getElement().$.checked = x.getValue() == u;
                !v && this.fire('change', {value: u});
            }, getValue: function () {
                var u = this._.children;
                for (var v = 0; v < u.length; v++) {
                    if (u[v].getElement().$.checked)return u[v].getValue();
                }
                return null;
            }, accessKeyUp: function () {
                var u = this._.children, v;
                for (v = 0; v < u.length; v++) {
                    if (u[v].getElement().$.checked) {
                        u[v].getElement().focus();
                        return;
                    }
                }
                u[0].getElement().focus();
            }, eventProcessors: {
                onChange: function (u, v) {
                    if (!c)return r.onChange.apply(this, arguments); else {
                        u.on('load', function () {
                            var w = this._.children, x = this;
                            for (var y = 0; y < w.length; y++) {
                                var z = w[y].getElement();
                                z.on('propertychange', function (A) {
                                    A = A.data.$;
                                    if (A.propertyName == 'checked' && this.$.checked)x.fire('change', {value: this.getAttribute('value')});

                                });
                            }
                        }, this);
                        this.on('change', v);
                    }
                    return null;
                }
            }, keyboardFocusable: true
        }, q, true);
        k.dialog.file.prototype = e.extend(new k.dialog.labeledElement(), q, {
            getInputElement: function () {
                var u = a.document.getById(this._.frameId).getFrameDocument();
                return u.$.forms.length > 0 ? new h(u.$.forms[0].elements[0]) : this.getElement();
            }, submit: function () {
                this.getInputElement().getParent().$.submit();
                return this;
            }, getAction: function () {
                return this.getInputElement().getParent().$.action;
            }, registerEvents: function (u) {
                var v = /^on([A-Z]\w+)/, w, x = function (z, A, B, C) {
                    z.on('formLoaded', function () {
                        z.getInputElement().on(B, C, z);
                    });
                };
                for (var y in u) {
                    if (!(w = y.match(v)))continue;
                    if (this.eventProcessors[y])this.eventProcessors[y].call(this, this._.dialog, u[y]); else x(this, this._.dialog, w[1].toLowerCase(), u[y]);
                }
                return this;
            }, reset: function () {
                var u = this._, v = a.document.getById(u.frameId), w = v.getFrameDocument(), x = u.definition, y = u.buttons, z = this.formLoadedNumber, A = this.formUnloadNumber, B = u.dialog._.editor.lang.dir, C = u.dialog._.editor.langCode;
                if (!z) {
                    z = this.formLoadedNumber = e.addFunction(function () {
                        this.fire('formLoaded');
                    }, this);
                    A = this.formUnloadNumber = e.addFunction(function () {
                        this.getInputElement().clearCustomData();
                    }, this);
                    this.getDialog()._.editor.on('destroy', function () {
                        e.removeFunction(z);
                        e.removeFunction(A);
                    });
                }
                function D() {
                    w.$.open();
                    if (b.isCustomDomain())w.$.domain = document.domain;
                    var E = '';
                    if (x.size)E = x.size - (c ? 7 : 0);
                    w.$.write(['<html dir="' + B + '" lang="' + C + '"><head><title></title></head><body style="margin: 0; overflow: hidden; background: transparent;">', '<form enctype="multipart/form-data" method="POST" dir="' + B + '" lang="' + C + '" action="', e.htmlEncode(x.action), '">', '<input type="file" name="', e.htmlEncode(x.id || 'cke_upload'), '" size="', e.htmlEncode(E > 0 ? E : ''), '" />', '</form>', '</body></html>', '<script type="text/javascript">window.parent.CKEDITOR.tools.callFunction(' + z + ');', 'window.onbeforeunload = function() {window.parent.CKEDITOR.tools.callFunction(' + A + ')}</script>'].join(''));
                    w.$.close();
                    for (var F = 0; F < y.length; F++)y[F].enable();
                };
                if (b.gecko)setTimeout(D, 500); else D();
            }, getValue: function () {
                return this.getInputElement().$.value || '';
            }, setInitValue: function () {
                this._.initValue = '';
            }, eventProcessors: {
                onChange: function (u, v) {
                    if (!this._.domOnChangeRegistered) {
                        this.on('formLoaded', function () {
                            this.getInputElement().on('change', function () {
                                this.fire('change', {value: this.getValue()});
                            }, this);
                        }, this);
                        this._.domOnChangeRegistered = true;
                    }
                    this.on('change', v);
                }
            }, keyboardFocusable: true
        }, true);
        k.dialog.fileButton.prototype = new k.dialog.button();

        k.dialog.fieldset.prototype = e.clone(k.dialog.hbox.prototype);
        a.dialog.addUIElement('text', n);
        a.dialog.addUIElement('password', n);
        a.dialog.addUIElement('textarea', o);
        a.dialog.addUIElement('checkbox', o);
        a.dialog.addUIElement('radio', o);
        a.dialog.addUIElement('button', o);
        a.dialog.addUIElement('select', o);
        a.dialog.addUIElement('file', o);
        a.dialog.addUIElement('fileButton', o);
        a.dialog.addUIElement('html', o);
        a.dialog.addUIElement('fieldset', p);
    })();
    j.add('panel', {
        beforeInit: function (m) {
            m.ui.addHandler(2, k.panel.handler);
        }
    });
    a.UI_PANEL = 2;
    k.panel = function (m, n) {
        var o = this;
        if (n)e.extend(o, n);
        e.extend(o, {className: '', css: []});
        o.id = e.getNextId();
        o.document = m;
        o._ = {blocks: {}};
    };
    k.panel.handler = {
        create: function (m) {
            return new k.panel(m);
        }
    };
    k.panel.prototype = {
        renderHtml: function (m) {
            var n = [];
            this.render(m, n);
            return n.join('');
        }, render: function (m, n) {
            var p = this;
            var o = p.id;
            n.push('<div class="', m.skinClass, '" lang="', m.langCode, '" role="presentation" style="display:none;z-index:' + (m.config.baseFloatZIndex + 1) + '">' + '<div' + ' id=', o, ' dir=', m.lang.dir, ' role="presentation" class="cke_panel cke_', m.lang.dir);
            if (p.className)n.push(' ', p.className);
            n.push('">');
            if (p.forceIFrame || p.css.length) {
                n.push('<iframe id="', o, '_frame" frameborder="0" role="application" src="javascript:void(');
                n.push(b.isCustomDomain() ? "(function(){document.open();document.domain='" + document.domain + "';" + 'document.close();' + '})()' : '0');
                n.push(')"></iframe>');
            }
            n.push('</div></div>');
            return o;
        }, getHolderElement: function () {
            var m = this._.holder;
            if (!m) {
                if (this.forceIFrame || this.css.length) {
                    var n = this.document.getById(this.id + '_frame'), o = n.getParent(), p = o.getAttribute('dir'), q = o.getParent().getAttribute('class'), r = o.getParent().getAttribute('lang'), s = n.getFrameDocument(), t = e.addFunction(e.bind(function (w) {
                        this.isLoaded = true;
                        if (this.onLoad)this.onLoad();
                    }, this)), u = '<!DOCTYPE html><html dir="' + p + '" class="' + q + '_container" lang="' + r + '">' + '<head>' + '<style>.' + q + '_container{visibility:hidden}</style>' + '</head>' + '<body class="cke_' + p + ' cke_panel_frame ' + b.cssClass + '" style="margin:0;padding:0"' + ' onload="( window.CKEDITOR || window.parent.CKEDITOR ).tools.callFunction(' + t + ');"></body>' + e.buildStyleHtml(this.css) + '</html>';
                    s.write(u);
                    var v = s.getWindow();
                    v.$.CKEDITOR = a;
                    s.on('key' + (b.opera ? 'press' : 'down'), function (w) {
                        var z = this;
                        var x = w.data.getKeystroke(), y = z.document.getById(z.id).getAttribute('dir');
                        if (z._.onKeyDown && z._.onKeyDown(x) === false) {
                            w.data.preventDefault();
                            return;
                        }
                        if (x == 27 || x == (y == 'rtl' ? 39 : 37))if (z.onEscape && z.onEscape(x) === false)w.data.preventDefault();

                    }, this);
                    m = s.getBody();
                    m.unselectable();
                    b.air && e.callFunction(t);
                } else m = this.document.getById(this.id);
                this._.holder = m;
            }
            return m;
        }, addBlock: function (m, n) {
            var o = this;
            n = o._.blocks[m] = n instanceof k.panel.block ? n : new k.panel.block(o.getHolderElement(), n);
            if (!o._.currentBlock)o.showBlock(m);
            return n;
        }, getBlock: function (m) {
            return this._.blocks[m];
        }, showBlock: function (m) {
            var n = this._.blocks, o = n[m], p = this._.currentBlock, q = this.forceIFrame ? this.document.getById(this.id + '_frame') : this._.holder;
            q.getParent().getParent().disableContextMenu();
            if (p) {
                q.removeAttributes(p.attributes);
                p.hide();
            }
            this._.currentBlock = o;
            q.setAttributes(o.attributes);
            a.fire('ariaWidget', q);
            o._.focusIndex = -1;
            this._.onKeyDown = o.onKeyDown && e.bind(o.onKeyDown, o);
            o.onMark = function (r) {
                q.setAttribute('aria-activedescendant', r.getId() + '_option');
            };
            o.onUnmark = function () {
                q.removeAttribute('aria-activedescendant');
            };
            o.show();
            return o;
        }, destroy: function () {
            this.element && this.element.remove();
        }
    };
    k.panel.block = e.createClass({
        $: function (m, n) {
            var o = this;
            o.element = m.append(m.getDocument().createElement('div', {
                attributes: {
                    tabIndex: -1,
                    'class': 'cke_panel_block',
                    role: 'presentation'
                }, styles: {display: 'none'}
            }));
            if (n)e.extend(o, n);
            if (!o.attributes.title)o.attributes.title = o.attributes['aria-label'];
            o.keys = {};
            o._.focusIndex = -1;
            o.element.disableContextMenu();
        }, _: {
            markItem: function (m) {
                var p = this;
                if (m == -1)return;
                var n = p.element.getElementsByTag('a'), o = n.getItem(p._.focusIndex = m);
                if (b.webkit || b.opera)o.getDocument().getWindow().focus();
                o.focus();
                p.onMark && p.onMark(o);
            }
        }, proto: {
            show: function () {
                this.element.setStyle('display', '');
            }, hide: function () {
                var m = this;
                if (!m.onHide || m.onHide.call(m) !== true)m.element.setStyle('display', 'none');
            }, onKeyDown: function (m) {
                var r = this;
                var n = r.keys[m];
                switch (n) {
                    case 'next':
                        var o = r._.focusIndex, p = r.element.getElementsByTag('a'), q;
                        while (q = p.getItem(++o)) {
                            if (q.getAttribute('_cke_focus') && q.$.offsetWidth) {
                                r._.focusIndex = o;
                                q.focus();
                                break;
                            }
                        }
                        return false;
                    case 'prev':
                        o = r._.focusIndex;
                        p = r.element.getElementsByTag('a');
                        while (o > 0 && (q = p.getItem(--o))) {
                            if (q.getAttribute('_cke_focus') && q.$.offsetWidth) {
                                r._.focusIndex = o;
                                q.focus();
                                break;
                            }
                        }
                        return false;
                    case 'click':
                        o = r._.focusIndex;
                        q = o >= 0 && r.element.getElementsByTag('a').getItem(o);
                        if (q)q.$.click ? q.$.click() : q.$.onclick();
                        return false;
                }
                return true;
            }
        }
    });
    j.add('listblock', {
        requires: ['panel'], onLoad: function () {
            k.panel.prototype.addListBlock = function (m, n) {
                return this.addBlock(m, new k.listBlock(this.getHolderElement(), n));
            };
            k.listBlock = e.createClass({
                base: k.panel.block, $: function (m, n) {
                    var q = this;

                    n = n || {};
                    var o = n.attributes || (n.attributes = {});
                    (q.multiSelect = !!n.multiSelect) && (o['aria-multiselectable'] = true);
                    !o.role && (o.role = 'listbox');
                    q.base.apply(q, arguments);
                    var p = q.keys;
                    p[40] = 'next';
                    p[9] = 'next';
                    p[38] = 'prev';
                    p[2000 + 9] = 'prev';
                    p[32] = 'click';
                    q._.pendingHtml = [];
                    q._.items = {};
                    q._.groups = {};
                }, _: {
                    close: function () {
                        if (this._.started) {
                            this._.pendingHtml.push('</ul>');
                            delete this._.started;
                        }
                    }, getClick: function () {
                        if (!this._.click)this._.click = e.addFunction(function (m) {
                            var o = this;
                            var n = true;
                            if (o.multiSelect)n = o.toggle(m); else o.mark(m);
                            if (o.onClick)o.onClick(m, n);
                        }, this);
                        return this._.click;
                    }
                }, proto: {
                    add: function (m, n, o) {
                        var r = this;
                        var p = r._.pendingHtml, q = e.getNextId();
                        if (!r._.started) {
                            p.push('<ul role="presentation" class=cke_panel_list>');
                            r._.started = 1;
                            r._.size = r._.size || 0;
                        }
                        r._.items[m] = q;
                        p.push('<li id=', q, ' class=cke_panel_listItem role=presentation><a id="', q, '_option" _cke_focus=1 hidefocus=true title="', o || m, '" href="javascript:void(\'', m, '\')" onclick="CKEDITOR.tools.callFunction(', r._.getClick(), ",'", m, "'); return false;\"", ' role="option" aria-posinset="' + ++r._.size + '">', n || m, '</a></li>');
                    }, startGroup: function (m) {
                        this._.close();
                        var n = e.getNextId();
                        this._.groups[m] = n;
                        this._.pendingHtml.push('<h1 role="presentation" id=', n, ' class=cke_panel_grouptitle>', m, '</h1>');
                    }, commit: function () {
                        var p = this;
                        p._.close();
                        p.element.appendHtml(p._.pendingHtml.join(''));
                        var m = p._.items, n = p.element.getDocument();
                        for (var o in m)n.getById(m[o] + '_option').setAttribute('aria-setsize', p._.size);
                        delete p._.size;
                        p._.pendingHtml = [];
                    }, toggle: function (m) {
                        var n = this.isMarked(m);
                        if (n)this.unmark(m); else this.mark(m);
                        return !n;
                    }, hideGroup: function (m) {
                        var n = this.element.getDocument().getById(this._.groups[m]), o = n && n.getNext();
                        if (n) {
                            n.setStyle('display', 'none');
                            if (o && o.getName() == 'ul')o.setStyle('display', 'none');
                        }
                    }, hideItem: function (m) {
                        this.element.getDocument().getById(this._.items[m]).setStyle('display', 'none');
                    }, showAll: function () {
                        var m = this._.items, n = this._.groups, o = this.element.getDocument();
                        for (var p in m)o.getById(m[p]).setStyle('display', '');
                        for (var q in n) {
                            var r = o.getById(n[q]), s = r.getNext();
                            r.setStyle('display', '');
                            if (s && s.getName() == 'ul')s.setStyle('display', '');
                        }
                    }, mark: function (m) {
                        var p = this;
                        if (!p.multiSelect)p.unmarkAll();
                        var n = p._.items[m], o = p.element.getDocument().getById(n);
                        o.addClass('cke_selected');
                        p.element.getDocument().getById(n + '_option').setAttribute('aria-selected', true);
                        p.element.setAttribute('aria-activedescendant', n + '_option');
                        p.onMark && p.onMark(o);
                    }, unmark: function (m) {
                        var n = this;

                        n.element.getDocument().getById(n._.items[m]).removeClass('cke_selected');
                        n.onUnmark && n.onUnmark(n._.items[m]);
                    }, unmarkAll: function () {
                        var p = this;
                        var m = p._.items, n = p.element.getDocument();
                        for (var o in m)n.getById(m[o]).removeClass('cke_selected');
                        p.onUnmark && p.onUnmark();
                    }, isMarked: function (m) {
                        return this.element.getDocument().getById(this._.items[m]).hasClass('cke_selected');
                    }, focus: function (m) {
                        this._.focusIndex = -1;
                        if (m) {
                            var n = this.element.getDocument().getById(this._.items[m]).getFirst(), o = this.element.getElementsByTag('a'), p, q = -1;
                            while (p = o.getItem(++q)) {
                                if (p.equals(n)) {
                                    this._.focusIndex = q;
                                    break;
                                }
                            }
                            setTimeout(function () {
                                n.focus();
                            }, 0);
                        }
                    }
                }
            });
        }
    });
    a.themes.add('default', (function () {
        function m(n, o) {
            var p, q;
            q = n.config.sharedSpaces;
            q = q && q[o];
            q = q && a.document.getById(q);
            if (q) {
                var r = '<span class="cke_shared"><span class="' + n.skinClass + ' ' + n.id + ' cke_editor_' + n.name + '">' + '<span class="' + b.cssClass + '">' + '<span class="cke_wrapper cke_' + n.lang.dir + '">' + '<span class="cke_editor">' + '<div class="cke_' + o + '">' + '</div></span></span></span></span></span>', s = q.append(h.createFromHtml(r, q.getDocument()));
                if (q.getCustomData('cke_hasshared'))s.hide(); else q.setCustomData('cke_hasshared', 1);
                p = s.getChild([0, 0, 0, 0]);
                !n.sharedSpaces && (n.sharedSpaces = {});
                n.sharedSpaces[o] = p;
                n.on('focus', function () {
                    for (var t = 0, u, v = q.getChildren(); u = v.getItem(t); t++) {
                        if (u.type == 1 && !u.equals(s) && u.hasClass('cke_shared'))u.hide();
                    }
                    s.show();
                });
                n.on('destroy', function () {
                    s.remove();
                });
            }
            return p;
        };
        return {
            build: function (n, o) {
                var p = n.name, q = n.element, r = n.elementMode;
                if (!q || r == 0)return;
                if (r == 1)q.hide();
                var s = n.fire('themeSpace', {
                    space: 'top',
                    html: ''
                }).html, t = n.fire('themeSpace', {
                    space: 'contents',
                    html: ''
                }).html, u = n.fireOnce('themeSpace', {
                    space: 'bottom',
                    html: ''
                }).html, v = t && n.config.height, w = n.config.tabIndex || n.element.getAttribute('tabindex') || 0;
                if (!t)v = 'auto'; else if (!isNaN(v))v += 'px';
                var x = '', y = n.config.width;
                if (y) {
                    if (!isNaN(y))y += 'px';
                    x += 'width: ' + y + ';';
                }
                var z = s && m(n, 'top'), A = m(n, 'bottom');
                z && (z.setHtml(s), s = '');
                A && (A.setHtml(u), u = '');
                var B = h.createFromHtml(['<span id="cke_', p, '" class="', n.skinClass, ' ', n.id, ' cke_editor_', p, '" dir="', n.lang.dir, '" title="', b.gecko ? ' ' : '', '" lang="', n.langCode, '"' + (b.webkit ? ' tabindex="' + w + '"' : '') + ' role="application"' + ' aria-labelledby="cke_', p, '_arialbl"' + (x ? ' style="' + x + '"' : '') + '>' + '<span id="cke_', p, '_arialbl" class="cke_voice_label">' + n.lang.editor + '</span>' + '<span class="', b.cssClass, '" role="presentation"><span class="cke_wrapper cke_', n.lang.dir, '" role="presentation"><table class="cke_editor" border="0" cellspacing="0" cellpadding="0" role="presentation"><tbody><tr', s ? '' : ' style="display:none"', ' role="presentation"><td id="cke_top_', p, '" class="cke_top" role="presentation">', s, '</td></tr><tr', t ? '' : ' style="display:none"', ' role="presentation"><td id="cke_contents_', p, '" class="cke_contents" style="height:', v, '" role="presentation">', t, '</td></tr><tr', u ? '' : ' style="display:none"', ' role="presentation"><td id="cke_bottom_', p, '" class="cke_bottom" role="presentation">', u, '</td></tr></tbody></table><style>.', n.skinClass, '{visibility:hidden;}</style></span></span></span>'].join(''));

                B.getChild([1, 0, 0, 0, 0]).unselectable();
                B.getChild([1, 0, 0, 0, 2]).unselectable();
                if (r == 1)B.insertAfter(q); else q.append(B);
                n.container = B;
                B.disableContextMenu();
                n.fireOnce('themeLoaded');
                n.fireOnce('uiReady');
            }, buildDialog: function (n) {
                var o = e.getNextNumber(), p = h.createFromHtml(['<div class="', n.id, '_dialog cke_editor_', n.name.replace('.', '\\.'), '_dialog cke_skin_', n.skinName, '" dir="', n.lang.dir, '" lang="', n.langCode, '" role="dialog" aria-labelledby="%title#"><table class="cke_dialog', ' ' + b.cssClass, ' cke_', n.lang.dir, '" style="position:absolute" role="presentation"><tr><td role="presentation"><div class="%body" role="presentation"><div id="%title#" class="%title" role="presentation"></div><a id="%close_button#" class="%close_button" href="javascript:void(0)" title="' + n.lang.common.close + '" role="button"><span class="cke_label">X</span></a>' + '<div id="%tabs#" class="%tabs" role="tablist"></div>' + '<table class="%contents" role="presentation">' + '<tr>' + '<td id="%contents#" class="%contents" role="presentation"></td>' + '</tr>' + '<tr>' + '<td id="%footer#" class="%footer" role="presentation"></td>' + '</tr>' + '</table>' + '</div>' + '<div id="%tl#" class="%tl"></div>' + '<div id="%tc#" class="%tc"></div>' + '<div id="%tr#" class="%tr"></div>' + '<div id="%ml#" class="%ml"></div>' + '<div id="%mr#" class="%mr"></div>' + '<div id="%bl#" class="%bl"></div>' + '<div id="%bc#" class="%bc"></div>' + '<div id="%br#" class="%br"></div>' + '</td></tr>' + '</table>', c ? '' : '<style>.cke_dialog{visibility:hidden;}</style>', '</div>'].join('').replace(/#/g, '_' + o).replace(/%/g, 'cke_dialog_')), q = p.getChild([0, 0, 0, 0, 0]), r = q.getChild(0), s = q.getChild(1);
                r.unselectable();
                s.unselectable();
                return {
                    element: p,
                    parts: {
                        dialog: p.getChild(0),
                        title: r,
                        close: s,
                        tabs: q.getChild(2),
                        contents: q.getChild([3, 0, 0, 0]),
                        footer: q.getChild([3, 0, 1, 0])
                    }
                };
            }, destroy: function (n) {
                var o = n.container;
                o.clearCustomData();
                n.element.clearCustomData();
                if (o)o.remove();
                if (n.elementMode == 1)n.element.show();
                delete n.element;
            }
        };
    })());
    a.editor.prototype.getThemeSpace = function (m) {
        var n = 'cke_' + m, o = this._[n] || (this._[n] = a.document.getById(n + '_' + this.name));
        return o;
    };
    a.editor.prototype.resize = function (m, n, o, p) {
        var q = this.container, r = a.document.getById('cke_contents_' + this.name), s = p ? q.getChild(1) : q;
        b.webkit && s.setStyle('display', 'none');
        s.setSize('width', m, true);
        if (b.webkit) {
            s.$.offsetWidth;
            s.setStyle('display', '');
        }
        var t = o ? 0 : (s.$.offsetHeight || 0) - (r.$.clientHeight || 0);
        r.setStyle('height', Math.max(n - t, 0) + 'px');
        this.fire('resize');
    };
    a.editor.prototype.getResizable = function () {
        return this.container.getChild(1);

    };
})();

