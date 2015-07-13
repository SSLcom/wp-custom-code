/*! calc-polyfill 10-04-2015 */
!function(win,doc){"use strict";function contentLoaded(a,b){var c=!1,d=!0,e=a.document,f=e.documentElement,g=e.addEventListener,h=g?"addEventListener":"attachEvent",i=g?"removeEventListener":"detachEvent",j=g?"":"on",k=function(d){("readystatechange"!=d.type||"complete"==e.readyState)&&(("load"==d.type?a:e)[i](j+d.type,k,!1),!c&&(c=!0)&&b.call(a,d.type||d))},l=function(){try{f.doScroll("left")}catch(a){return void setTimeout(l,50)}k("poll")};if("complete"==e.readyState)b.call(a,"lazy");else{if(!g&&f.doScroll){try{d=!a.frameElement}catch(m){}d&&l()}e[h](j+"DOMContentLoaded",k,!1),e[h](j+"readystatechange",k,!1),a[h](j+"load",k,!1)}}if(!doc.querySelectorAll)return!1;var EMPTY="",CALC_RULE="^(\\s*?[\\s\\S]*):(\\s*?[\\s\\S]*?((\\-(webkit|moz)\\-)?calc\\(([\\s\\S]+)\\))[\\s\\S]*)?$",CSSRULES="((\\s*?@media[\\s\\S]*?){([\\s\\S]*?)}\\s*?})|(([\\s\\S]*?){([\\s\\S]*?)})",KEYFRAMES=new RegExp("((@.*?keyframes [\\s\\S]*?){([\\s\\S]*?}\\s*?)})","gi"),FONTFACE=new RegExp("((@font-face\\s*?){([\\s\\S]*?)})","gi"),COMMENTS=new RegExp("(\\/\\*[\\s\\S]*?\\*\\/)","gi"),IMPORTS=new RegExp("@import .*?;","gi"),CHARSET=new RegExp("@charset .*?;","gi"),PERCENT=/[\d\.]+%/,PT=/\d+pt/,PIXEL=/(\d+)px/g,REMEM=/[\d\.]+r?em/,REM=/[\d\.]+rem/,EM=/[\d\.]+em/,MATH_EXP=/[\+\-\/\*]?[\d\.]+(px|%|em|rem)?/g,PLACEHOLDER="$1",ONLYNUMBERS=/[\s\-0-9]/g,FONTSIZE="font-size",ADDMEDIA="@media",onTextResize=[],onWindowResize=[],utilities={camelize:function(a){return a.replace(/\-(\w)/g,function(a,b){return b.toUpperCase()})},trim:function(a){var b=/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;return String.prototype.trim?a.trim():a.replace(b,"")},indexOf:function(a,b,c){var d=a.length>>>0;for(c=Number(c)||0,c=0>c?Math.ceil(c):Math.floor(c),0>c&&(c+=d);d>c;c++)if(c in a&&a[c]===b)return c;return-1},getStyle:function(a,b){return a.currentStyle?a.currentStyle[utilities.camelize(b)]:doc.defaultView&&doc.defaultView.getComputedStyle?doc.defaultView.getComputedStyle(a,null).getPropertyValue(b):a.style[utilities.camelize(b)]},getFontsize:function(a){var b,c=doc.createElement("span");return c.innerHTML="&nbsp;",c.style.position="absolute",c.style.lineHeight="1em",c.style.fontSize="1em",a.appendChild(c),b=c.offsetHeight,a.removeChild(c),b},addEvent:function(a,b,c){doc.addEventListener?a.addEventListener(b,c,!1):a.attachEvent("on"+b,c)},textResize:function(a){var b,c,d=function(){b=doc.createElement("span"),b.id="text-resize-control",b.innerHTML="&nbsp;",b.style.position="absolute",b.style.left="-9999px",b.style.lineHeight="1em",b.style.fontSize="1em",doc.body.insertBefore(b,doc.body.firstChild),c=b.offsetHeight},e=function(){var d=b.offsetHeight;return c===d?(win.requestAnimationFrame(e),!1):(c=d,a&&"function"==typeof a&&a(),void win.requestAnimationFrame(e))};d(),win.requestAnimationFrame(e)}},calcTest=function(){var a=document.createElement("div");return a.style.cssText="width: -moz-calc(10px); width: -webkit-calc(10px); width: calc(10px)",!!a.style.length},getStyleSheets=function(){for(var a,b=[],c=0,d=doc.styleSheets.length;d>c;c++)a=doc.styleSheets[c],a.href&&a.href!==EMPTY&&b.push(a.href);b.length>0&&loadStylesheets(b)},loadStylesheets=function(a){var b,c=0,d=a.length,e=[];if(win.XMLHttpRequest)b=new XMLHttpRequest;else try{b=new ActiveXObject("Microsoft.XMLHTTP")}catch(f){b=null}if(b)for(;d>c;c++)try{b.open("GET",a[c],!1),b.send(),200===b.status&&e.push(b.responseText)}catch(f){console.log("Error making request for file "+a[c]+": "+f.message)}e.length>0&&parseStylesheets(e)},parseStylesheets=function(a){for(var b=0,c=a.length;c>b;b++)a[b]=a[b].replace(COMMENTS,EMPTY).replace(CHARSET,EMPTY).replace(IMPORTS,EMPTY).replace(KEYFRAMES,EMPTY).replace(FONTFACE,EMPTY),dotheCalc(parseCSS(a[b]))},removeStyles=function(a){for(var b=0,c=a.length;c>b;b++)a[b].removeAttribute("style")},parseCSS=function(a,b){var c,d,e,f,g,h,i,j,k,l=[];for(b=b||"",e=new RegExp(CSSRULES,"gi");;){if(f=e.exec(a),null===f)break;if(g=utilities.trim((f[2]||f[5]).split("\r\n").join("\n")),-1!==g.indexOf(ADDMEDIA))h=f[3]+"\n}",l=l.concat(parseCSS(h,g.replace(ADDMEDIA,"")));else for(h=f[6].split("\r\n").join("\n").split(";"),c=0,d=h.length;d>c;c++){i=new RegExp(CALC_RULE,"gi").exec(h[c]);try{j=doc.querySelectorAll(g)}catch(m){console.log('Error trying to select "'+g+'": '+m.message);break}null!==i&&j.length&&(k={elements:j,media:b,values:utilities.trim(i[2]),formula:i[6],prop:utilities.trim(i[1]),placholder:utilities.trim(i[3])},k.formula.match(PERCENT)&&(k.onresize=!0),k.formula.match(REMEM)&&(k.ontextresize=!0),l.push(k))}}return l},dotheCalc=function(calcRules){for(var index=0,len=calcRules.length,obj,calc=function(obj){for(var i=0,len=obj.elements.length,refValue,modifier,matches,l,j,result,formula;len>i;i++){for(formula=obj.formula.replace(PIXEL,PLACEHOLDER),matches=formula.match(MATH_EXP),l=matches.length,j=0;l>j;j++)modifier=null,matches[j].match(PERCENT)&&(refValue=obj.elements[i].parentNode.clientWidth,modifier=parseFloat(matches[j],10)/100),matches[j].match(EM)&&(refValue=obj.elements[i].currentStyle?utilities.getFontsize(obj.elements[i]):parseInt(utilities.getStyle(obj.elements[i],FONTSIZE).replace(/px/,EMPTY),10),refValue.match&&refValue.match(PT)&&(refValue=Math.round(1.333333333*parseInt(refValue.replace(/pt/,""),10))),modifier=parseFloat(matches[j],10)),matches[j].match(REM)&&(refValue=utilities.getStyle(doc.body,FONTSIZE).match(PERCENT)?16*parseInt(utilities.getStyle(doc.body,FONTSIZE).replace(/%/,EMPTY),10)/100:utilities.getStyle(doc.body,FONTSIZE).match(PT)?Math.round(1.333333333*parseInt(utilities.getStyle(doc.body,FONTSIZE).replace(/pt/,""),10)):parseInt(utilities.getStyle(doc.body,FONTSIZE).replace(/px/,EMPTY),10),modifier=parseFloat(matches[j],10)),modifier&&(formula=formula.replace(matches[j],refValue*modifier));try{formula.match(ONLYNUMBERS)&&(result=eval(formula),obj.elements[i].style[utilities.trim(utilities.camelize(obj.prop))]=obj.values.replace(obj.placholder,result+"px"))}catch(e){}}};len>index;index++)obj=calcRules[index],obj.onresize&&-1===utilities.indexOf(onWindowResize,obj)&&onWindowResize.push(obj),obj.ontextresize&&-1===utilities.indexOf(onTextResize,obj)&&onTextResize.push(obj),obj.media!==EMPTY?win.matchMedia&&win.matchMedia(obj.media).matches?calc(obj):removeStyles(obj.elements):calc(obj)};contentLoaded(win,function(){calcTest()||(getStyleSheets(),onTextResize.length>0&&utilities.textResize(function(){dotheCalc(onTextResize)}),onWindowResize.length>0&&utilities.addEvent(win,"resize",function(){dotheCalc(onWindowResize)}))}),function(){for(var a=0,b=["ms","moz","webkit","o"],c=0;c<b.length&&!win.requestAnimationFrame;++c)win.requestAnimationFrame=win[b[c]+"RequestAnimationFrame"],win.cancelAnimationFrame=win[b[c]+"CancelAnimationFrame"]||win[b[c]+"CancelRequestAnimationFrame"];win.requestAnimationFrame||(win.requestAnimationFrame=function(b){var c=(new Date).getTime(),d=Math.max(0,16-(c-a)),e=win.setTimeout(function(){b(c+d)},d);return a=c+d,e}),win.cancelAnimationFrame||(win.cancelAnimationFrame=function(a){clearTimeout(a)})}()}(window,document);

/*!
 * textStretch.js v1.0.0 (2013-12-16)
 * https://github.com/friday/textStretch.js
 *
 * Copyright (c) 2012 - 2013 Albin Larsson
 * Released under the MIT licence: http://www.opensource.org/licenses/mit-license.php
 */

!function(t,e){"use strict";var n,i,r,s=!1,a={},o={elements:[],settings:[]};t("<style>.textStretch-calc{display:inline-block !important;*display:inline !important;white-space:nowrap !important;width:auto !important;padding:0 !important;text-align:left !important}</style>").appendTo("head"),t.fn.textStretch=function(l){function c(t,e){var n,i;return t.currentStyle&&!t.currentStyle.hasLayout&&(t.style.zoom="1"),n=t.clientWidth,t.style.fontSize="100px",t.className+=" textStretch-calc",i=parseInt(n/(t.clientWidth/100),10),i=Math.min(Math.max(i,e.minFontSize),e.maxFontSize),t.style.fontSize=i+"px",t.clientWidth>n&&(t.style.fontSize=i-2+"px"),t.className=t.className.substr(0,t.className.length-17),n===t.clientWidth}function m(t,e,i){for(n=0,r=!1;n<t.length&&!r;n+=1)r=!c(t[n],e[n]||e);r&&!i&&m(t,e,!0)}for(function(t){for(n=0;n<t.length;n+=1)if(a[t[n]]=l&&l[t[n]]?l[t[n]]:e[t[n]],"number"!=typeof a[t[n]])throw'textStretch error. Argument "'+t[n]+'" must be a number. Argument given was "'+a[t[n]]+'".'}(["minFontSize","maxFontSize"]),a.maxFontSize=a.maxFontSize||Number.POSITIVE_INFINITY,m(this,a),n=0;n<this.length;n+=1)i=t.inArray(this[n],o.elements),-1===i?(o.elements.push(this[n]),o.settings.push(a)):o.settings[i]=a;return s||(t(window).on("orientationchange.textStretch resize.textStretch",function(){m(o.elements,o.settings)}),s=!0),this},e.minFontSize=0,e.maxFontSize=0}(jQuery,jQuery.textStretch={});

$(".fitwidth").textStretch();

$(window).resize(function() {
    $(".pricing-panel").css("min-height", '');

    $(".pricing-panel-content:last-child").css("min-height", '');
    
    $(".sph").css("min-height", '');

    if ($(window).width() > 752) {
        var ppheights = $(".pricing-panel").map(function() {
            return $(this).outerHeight();
        }).get();
        $(".pricing-panel").css("min-height", Math.max.apply(Math, ppheights));

        var pheights = $(".pricing-column").map(function() {
            return $(this).outerHeight();
        });
        var ptalletest = Math.max.apply(Math, pheights);

        $(".pricing-column").each(function() {
            var h = Math.abs($(this).outerHeight() - ptalletest);
            var child = $(this).children(".pricing-panel-content").children().last();
            child.css("min-height", child.outerHeight() + h);
        });

        $(".sph").each(function(){
            $(this).css("min-height", $(this).parent().height());
        });
    }
});

$(window).load(function() {
    $(window).resize();
    $("body").css("opacity", "");
});

jQuery.fn.extend({
    scrollTo: function(speed, easing) {
        return this.each(function() {
            var targetOffset = $(this).offset().top;
            $('html,body').animate({
                scrollTop: targetOffset
            }, speed, easing);
        });
    }
});