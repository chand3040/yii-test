/*

 Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.

 For licensing, see LICENSE.html or http://ckeditor.com/license

 */


CKEDITOR.dialog.add('colordialog', function (a) {
    var b = CKEDITOR.dom.element, c = CKEDITOR.document, d = CKEDITOR.tools, e = a.lang.colordialog, f, g = {
        type: 'html',
        html: '&nbsp;'
    };

    function h() {
        c.getById(x).removeStyle('background-color');
        f.getContentElement('picker', 'selectedColor').setValue('');
    };
    function i(z) {
        if (!(z instanceof CKEDITOR.dom.event))z = new CKEDITOR.dom.event(z);
        var A = z.getTarget(), B;
        if (A.getName() == 'a' && (B = A.getChild(0).getHtml()))f.getContentElement('picker', 'selectedColor').setValue(B);
    };
    function j(z) {
        if (!(z instanceof CKEDITOR.dom.event))z = z.data;
        var A = z.getTarget(), B;
        if (A.getName() == 'a' && (B = A.getChild(0).getHtml())) {
            c.getById(v).setStyle('background-color', B);
            c.getById(w).setHtml(B);
        }
    };
    function k() {
        c.getById(v).removeStyle('background-color');
        c.getById(w).setHtml('&nbsp;');
    };
    var l = d.addFunction(k), m = i, n = CKEDITOR.tools.addFunction(m), o = j, p = k, q = CKEDITOR.tools.addFunction(function (z) {
        z = new CKEDITOR.dom.event(z);
        var A = z.getTarget(), B, C, D = z.getKeystroke(), E = a.lang.dir == 'rtl';
        switch (D) {
            case 38:
                if (B = A.getParent().getParent().getPrevious()) {
                    C = B.getChild([A.getParent().getIndex(), 0]);
                    C.focus();
                    p(z, A);
                    o(z, C);
                }
                z.preventDefault();
                break;
            case 40:
                if (B = A.getParent().getParent().getNext()) {
                    C = B.getChild([A.getParent().getIndex(), 0]);
                    if (C && C.type == 1) {
                        C.focus();
                        p(z, A);
                        o(z, C);
                    }
                }
                z.preventDefault();
                break;
            case 32:
                m(z);
                z.preventDefault();
                break;
            case E ? 37 : 39:
                if (B = A.getParent().getNext()) {
                    C = B.getChild(0);
                    if (C.type == 1) {
                        C.focus();
                        p(z, A);
                        o(z, C);
                        z.preventDefault(true);
                    } else p(null, A);
                } else if (B = A.getParent().getParent().getNext()) {
                    C = B.getChild([0, 0]);
                    if (C && C.type == 1) {
                        C.focus();
                        p(z, A);
                        o(z, C);
                        z.preventDefault(true);
                    } else p(null, A);
                }
                break;
            case E ? 39 : 37:
                if (B = A.getParent().getPrevious()) {
                    C = B.getChild(0);
                    C.focus();
                    p(z, A);
                    o(z, C);
                    z.preventDefault(true);
                } else if (B = A.getParent().getParent().getPrevious()) {
                    C = B.getLast().getChild(0);
                    C.focus();
                    p(z, A);
                    o(z, C);
                    z.preventDefault(true);
                } else p(null, A);
                break;
            default:
                return;
        }
    });

    function r() {
        var z = ['00', '33', '66', '99', 'cc', 'ff'];

        function A(F, G) {
            for (var H = F; H < F + 3; H++) {
                var I = s.$.insertRow(-1);
                for (var J = G; J < G + 3; J++)for (var K = 0; K < 6; K++)B(I, '#' + z[J] + z[K] + z[H]);
            }
        };
        function B(F, G) {
            var H = new b(F.insertCell(-1));
            H.setAttribute('class', 'ColorCell');
            H.setStyle('background-color', G);
            H.setStyle('width', '15px');
            H.setStyle('height', '15px');
            var I = H.$.cellIndex + 1 + 18 * F.rowIndex;
            H.append(CKEDITOR.dom.element.createFromHtml('<a href="javascript: void(0);" role="option" aria-posinset="' + I + '"' + ' aria-setsize="' + 234 + '"' + ' style="cursor: pointer;display:block;width:100%;height:100% " title="' + CKEDITOR.tools.htmlEncode(G) + '"' + ' onkeydown="CKEDITOR.tools.callFunction( ' + q + ', event, this )"' + ' onclick="CKEDITOR.tools.callFunction(' + n + ', event, this ); return false;"' + ' tabindex="-1"><span class="cke_voice_label">' + G + '</span>&nbsp;</a>', CKEDITOR.document));

        };
        A(0, 0);
        A(3, 0);
        A(0, 3);
        A(3, 3);
        var C = s.$.insertRow(-1);
        for (var D = 0; D < 6; D++)B(C, '#' + z[D] + z[D] + z[D]);
        for (var E = 0; E < 12; E++)B(C, '#000000');
    };
    var s = new b('table');
    r();
    var t = s.getHtml(), u = function (z) {
        return CKEDITOR.tools.getNextId() + '_' + z;
    }, v = u('hicolor'), w = u('hicolortext'), x = u('selhicolor'), y = u('color_table_label');
    return {
        title: e.title,
        minWidth: 360,
        minHeight: 220,
        onLoad: function () {
            f = this;
        },
        contents: [{
            id: 'picker',
            label: e.title,
            accessKey: 'I',
            elements: [{
                type: 'hbox',
                padding: 0,
                widths: ['70%', '10%', '30%'],
                children: [{
                    type: 'html',
                    html: '<table role="listbox" aria-labelledby="' + y + '" onmouseout="CKEDITOR.tools.callFunction( ' + l + ' );">' + (!CKEDITOR.env.webkit ? t : '') + '</table><span id="' + y + '" class="cke_voice_label">' + e.options + '</span>',
                    onLoad: function () {
                        var z = CKEDITOR.document.getById(this.domId);
                        z.on('mouseover', j);
                        CKEDITOR.env.webkit && z.setHtml(t);
                    },
                    focus: function () {
                        var z = this.getElement().getElementsByTag('a').getItem(0);
                        z.focus();
                    }
                }, g, {
                    type: 'vbox',
                    padding: 0,
                    widths: ['70%', '5%', '25%'],
                    children: [{
                        type: 'html',
                        html: '<span>' + e.highlight + '</span>\t\t\t\t\t\t\t\t\t\t\t\t<div id="' + v + '" style="border: 1px solid; height: 74px; width: 74px;"></div>\t\t\t\t\t\t\t\t\t\t\t\t<div id="' + w + '">&nbsp;</div><span>' + e.selected + '</span>\t\t\t\t\t\t\t\t\t\t\t\t<div id="' + x + '" style="border: 1px solid; height: 20px; width: 74px;"></div>'
                    }, {
                        type: 'text',
                        label: e.selected,
                        labelStyle: 'display:none',
                        id: 'selectedColor',
                        style: 'width: 74px',
                        onChange: function () {
                            try {
                                c.getById(x).setStyle('background-color', this.getValue());
                            } catch (z) {
                                h();
                            }
                        }
                    }, g, {type: 'button', id: 'clear', style: 'margin-top: 5px', label: e.clear, onClick: h}]
                }]
            }]
        }]
    };
});

