<html lang="en"><head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="MedEx">
    <meta name="author" content="Webex">
    <meta name="keyword" content="">
    <meta name="csrf-token" content="OlSBqeF5JQKyVKPIvFXrwkk5U5HEGb731gkpyIm7">
    {{-- <meta name="csrf-token" content='{{csrf_token()}}'> --}}

    <title>MedEx</title>



    <link rel="manifest" href="/assets/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <!-- Icons-->
    <link href="/css/free.min.css?id=c5d9f8c87f1adc95eec6" rel="stylesheet"> <!-- icons -->

    <!-- Main styles for this application-->
    <link href="/css/style.css?id=4102f9c361a11bc09c89" rel="stylesheet">
    <link href="/css/pace.min.css?id=63e793e7006be0ad806b" rel="stylesheet">



    <script>
        window.Laravel = {};
        window.Laravel.user = {"id":1,"department_id":1,"department_code":"45","f_name":"\u054d\u056b\u0574\u0578\u0576","l_name":"\u054d\u056b\u0574\u0578\u0576\u0575\u0561\u0576","p_name":"\u054d\u056b\u0574\u0578\u0576\u056b","username":"s.simonyan","account_suspended":0,"residence_region":"\u0535\u0580\u0587\u0561\u0576","town_village":"\u0535\u0580\u0587\u0561\u0576","street_house":"\u0534\u0561\u057e\u0569\u0561\u0577\u0565\u0576, I \u0569., 22 \u0577\u0565\u0576\u0584","degree":"\u0532\u056a\u0577\u056f\u0561\u056f\u0561\u0576 \u0533\u056b\u057f\u0578\u0582\u0569\u0575\u0578\u0582\u0576\u0576\u0565\u0580\u056b \u0569\u0565\u056f\u0576\u0561\u056e\u0578\u0582","position":"\u0562\u056a\u056b\u0577\u056f","birth_date":"1972-04-02","passport":"AF010020030","soc_card":"2000099887766","nationality":"\u0570\u0561\u0575","is_male":1,"m_phone":"091887766","c_phone":"010887766","email":"simon.simonyan@gmail.com","background":"c-app","cashbox_id":null,"created_at":"2020-11-18T12:24:06.000000Z","updated_at":"2020-11-18T12:24:06.000000Z","full_name":"\u054d\u056b\u0574\u0578\u0576 \u054d\u056b\u0574\u0578\u0576\u0575\u0561\u0576"};
    </script>
    <style>
        .phpdebugbar-restore-btn{
          width:5px !important;
            height: 5px !important;
        }
    </style>
<link rel="stylesheet" type="text/css" property="stylesheet" href="//127.0.0.1:8000/_debugbar/assets/stylesheets?v=1604327074&amp;theme=auto"><script type="text/javascript" src="//127.0.0.1:8000/_debugbar/assets/javascript?v=1604327074"></script><script type="text/javascript">jQuery.noConflict(true);</script>
<script> Sfdump = window.Sfdump || (function (doc) { var refStyle = doc.createElement('style'), rxEsc = /([.*+?^${}()|\[\]\/\\])/g, idRx = /\bsf-dump-\d+-ref[012]\w+\b/, keyHint = 0 <= navigator.platform.toUpperCase().indexOf('MAC') ? 'Cmd' : 'Ctrl', addEventListener = function (e, n, cb) { e.addEventListener(n, cb, false); }; (doc.documentElement.firstElementChild || doc.documentElement.children[0]).appendChild(refStyle); if (!doc.addEventListener) { addEventListener = function (element, eventName, callback) { element.attachEvent('on' + eventName, function (e) { e.preventDefault = function () {e.returnValue = false;}; e.target = e.srcElement; callback(e); }); }; } function toggle(a, recursive) { var s = a.nextSibling || {}, oldClass = s.className, arrow, newClass; if (/\bsf-dump-compact\b/.test(oldClass)) { arrow = '▼'; newClass = 'sf-dump-expanded'; } else if (/\bsf-dump-expanded\b/.test(oldClass)) { arrow = '▶'; newClass = 'sf-dump-compact'; } else { return false; } if (doc.createEvent && s.dispatchEvent) { var event = doc.createEvent('Event'); event.initEvent('sf-dump-expanded' === newClass ? 'sfbeforedumpexpand' : 'sfbeforedumpcollapse', true, false); s.dispatchEvent(event); } a.lastChild.innerHTML = arrow; s.className = s.className.replace(/\bsf-dump-(compact|expanded)\b/, newClass); if (recursive) { try { a = s.querySelectorAll('.'+oldClass); for (s = 0; s < a.length; ++s) { if (-1 == a[s].className.indexOf(newClass)) { a[s].className = newClass; a[s].previousSibling.lastChild.innerHTML = arrow; } } } catch (e) { } } return true; }; function collapse(a, recursive) { var s = a.nextSibling || {}, oldClass = s.className; if (/\bsf-dump-expanded\b/.test(oldClass)) { toggle(a, recursive); return true; } return false; }; function expand(a, recursive) { var s = a.nextSibling || {}, oldClass = s.className; if (/\bsf-dump-compact\b/.test(oldClass)) { toggle(a, recursive); return true; } return false; }; function collapseAll(root) { var a = root.querySelector('a.sf-dump-toggle'); if (a) { collapse(a, true); expand(a); return true; } return false; } function reveal(node) { var previous, parents = []; while ((node = node.parentNode || {}) && (previous = node.previousSibling) && 'A' === previous.tagName) { parents.push(previous); } if (0 !== parents.length) { parents.forEach(function (parent) { expand(parent); }); return true; } return false; } function highlight(root, activeNode, nodes) { resetHighlightedNodes(root); Array.from(nodes||[]).forEach(function (node) { if (!/\bsf-dump-highlight\b/.test(node.className)) { node.className = node.className + ' sf-dump-highlight'; } }); if (!/\bsf-dump-highlight-active\b/.test(activeNode.className)) { activeNode.className = activeNode.className + ' sf-dump-highlight-active'; } } function resetHighlightedNodes(root) { Array.from(root.querySelectorAll('.sf-dump-str, .sf-dump-key, .sf-dump-public, .sf-dump-protected, .sf-dump-private')).forEach(function (strNode) { strNode.className = strNode.className.replace(/\bsf-dump-highlight\b/, ''); strNode.className = strNode.className.replace(/\bsf-dump-highlight-active\b/, ''); }); } return function (root, x) { root = doc.getElementById(root); var indentRx = new RegExp('^('+(root.getAttribute('data-indent-pad') || ' ').replace(rxEsc, '\\$1')+')+', 'm'), options = {"maxDepth":1,"maxStringLength":160,"fileLinkFormat":false}, elt = root.getElementsByTagName('A'), len = elt.length, i = 0, s, h, t = []; while (i < len) t.push(elt[i++]); for (i in x) { options[i] = x[i]; } function a(e, f) { addEventListener(root, e, function (e, n) { if ('A' == e.target.tagName) { f(e.target, e); } else if ('A' == e.target.parentNode.tagName) { f(e.target.parentNode, e); } else { n = /\bsf-dump-ellipsis\b/.test(e.target.className) ? e.target.parentNode : e.target; if ((n = n.nextElementSibling) && 'A' == n.tagName) { if (!/\bsf-dump-toggle\b/.test(n.className)) { n = n.nextElementSibling || n; } f(n, e, true); } } }); }; function isCtrlKey(e) { return e.ctrlKey || e.metaKey; } function xpathString(str) { var parts = str.match(/[^'"]+|['"]/g).map(function (part) { if ("'" == part) { return '"\'"'; } if ('"' == part) { return "'\"'"; } return "'" + part + "'"; }); return "concat(" + parts.join(",") + ", '')"; } function xpathHasClass(className) { return "contains(concat(' ', normalize-space(@class), ' '), ' " + className +" ')"; } addEventListener(root, 'mouseover', function (e) { if ('' != refStyle.innerHTML) { refStyle.innerHTML = ''; } }); a('mouseover', function (a, e, c) { if (c) { e.target.style.cursor = "pointer"; } else if (a = idRx.exec(a.className)) { try { refStyle.innerHTML = '.phpdebugbar pre.sf-dump .'+a[0]+'{background-color: #B729D9; color: #FFF !important; border-radius: 2px}'; } catch (e) { } } }); a('click', function (a, e, c) { if (/\bsf-dump-toggle\b/.test(a.className)) { e.preventDefault(); if (!toggle(a, isCtrlKey(e))) { var r = doc.getElementById(a.getAttribute('href').substr(1)), s = r.previousSibling, f = r.parentNode, t = a.parentNode; t.replaceChild(r, a); f.replaceChild(a, s); t.insertBefore(s, r); f = f.firstChild.nodeValue.match(indentRx); t = t.firstChild.nodeValue.match(indentRx); if (f && t && f[0] !== t[0]) { r.innerHTML = r.innerHTML.replace(new RegExp('^'+f[0].replace(rxEsc, '\\$1'), 'mg'), t[0]); } if (/\bsf-dump-compact\b/.test(r.className)) { toggle(s, isCtrlKey(e)); } } if (c) { } else if (doc.getSelection) { try { doc.getSelection().removeAllRanges(); } catch (e) { doc.getSelection().empty(); } } else { doc.selection.empty(); } } else if (/\bsf-dump-str-toggle\b/.test(a.className)) { e.preventDefault(); e = a.parentNode.parentNode; e.className = e.className.replace(/\bsf-dump-str-(expand|collapse)\b/, a.parentNode.className); } }); elt = root.getElementsByTagName('SAMP'); len = elt.length; i = 0; while (i < len) t.push(elt[i++]); len = t.length; for (i = 0; i < len; ++i) { elt = t[i]; if ('SAMP' == elt.tagName) { a = elt.previousSibling || {}; if ('A' != a.tagName) { a = doc.createElement('A'); a.className = 'sf-dump-ref'; elt.parentNode.insertBefore(a, elt); } else { a.innerHTML += ' '; } a.title = (a.title ? a.title+'\n[' : '[')+keyHint+'+click] Expand all children'; a.innerHTML += '<span>▼</span>'; a.className += ' sf-dump-toggle'; x = 1; if ('sf-dump' != elt.parentNode.className) { x += elt.parentNode.getAttribute('data-depth')/1; } elt.setAttribute('data-depth', x); var className = elt.className; elt.className = 'sf-dump-expanded'; if (className ? 'sf-dump-expanded' !== className : (x > options.maxDepth)) { toggle(a); } } else if (/\bsf-dump-ref\b/.test(elt.className) && (a = elt.getAttribute('href'))) { a = a.substr(1); elt.className += ' '+a; if (/[\[{]$/.test(elt.previousSibling.nodeValue)) { a = a != elt.nextSibling.id && doc.getElementById(a); try { s = a.nextSibling; elt.appendChild(a); s.parentNode.insertBefore(a, s); if (/^[@#]/.test(elt.innerHTML)) { elt.innerHTML += ' <span>▶</span>'; } else { elt.innerHTML = '<span>▶</span>'; elt.className = 'sf-dump-ref'; } elt.className += ' sf-dump-toggle'; } catch (e) { if ('&' == elt.innerHTML.charAt(0)) { elt.innerHTML = '…'; elt.className = 'sf-dump-ref'; } } } } } if (doc.evaluate && Array.from && root.children.length > 1) { root.setAttribute('tabindex', 0); SearchState = function () { this.nodes = []; this.idx = 0; }; SearchState.prototype = { next: function () { if (this.isEmpty()) { return this.current(); } this.idx = this.idx < (this.nodes.length - 1) ? this.idx + 1 : 0; return this.current(); }, previous: function () { if (this.isEmpty()) { return this.current(); } this.idx = this.idx > 0 ? this.idx - 1 : (this.nodes.length - 1); return this.current(); }, isEmpty: function () { return 0 === this.count(); }, current: function () { if (this.isEmpty()) { return null; } return this.nodes[this.idx]; }, reset: function () { this.nodes = []; this.idx = 0; }, count: function () { return this.nodes.length; }, }; function showCurrent(state) { var currentNode = state.current(), currentRect, searchRect; if (currentNode) { reveal(currentNode); highlight(root, currentNode, state.nodes); if ('scrollIntoView' in currentNode) { currentNode.scrollIntoView(true); currentRect = currentNode.getBoundingClientRect(); searchRect = search.getBoundingClientRect(); if (currentRect.top < (searchRect.top + searchRect.height)) { window.scrollBy(0, -(searchRect.top + searchRect.height + 5)); } } } counter.textContent = (state.isEmpty() ? 0 : state.idx + 1) + ' of ' + state.count(); } var search = doc.createElement('div'); search.className = 'sf-dump-search-wrapper sf-dump-search-hidden'; search.innerHTML = ' <input type="text" class="sf-dump-search-input"> <span class="sf-dump-search-count">0 of 0<\/span> <button type="button" class="sf-dump-search-input-previous" tabindex="-1"> <svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1683 1331l-166 165q-19 19-45 19t-45-19L896 965l-531 531q-19 19-45 19t-45-19l-166-165q-19-19-19-45.5t19-45.5l742-741q19-19 45-19t45 19l742 741q19 19 19 45.5t-19 45.5z"\/><\/svg> <\/button> <button type="button" class="sf-dump-search-input-next" tabindex="-1"> <svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1683 808l-742 741q-19 19-45 19t-45-19L109 808q-19-19-19-45.5t19-45.5l166-165q19-19 45-19t45 19l531 531 531-531q19-19 45-19t45 19l166 165q19 19 19 45.5t-19 45.5z"\/><\/svg> <\/button> '; root.insertBefore(search, root.firstChild); var state = new SearchState(); var searchInput = search.querySelector('.sf-dump-search-input'); var counter = search.querySelector('.sf-dump-search-count'); var searchInputTimer = 0; var previousSearchQuery = ''; addEventListener(searchInput, 'keyup', function (e) { var searchQuery = e.target.value; /* Don't perform anything if the pressed key didn't change the query */ if (searchQuery === previousSearchQuery) { return; } previousSearchQuery = searchQuery; clearTimeout(searchInputTimer); searchInputTimer = setTimeout(function () { state.reset(); collapseAll(root); resetHighlightedNodes(root); if ('' === searchQuery) { counter.textContent = '0 of 0'; return; } var classMatches = [ "sf-dump-str", "sf-dump-key", "sf-dump-public", "sf-dump-protected", "sf-dump-private", ].map(xpathHasClass).join(' or '); var xpathResult = doc.evaluate('.//span[' + classMatches + '][contains(translate(child::text(), ' + xpathString(searchQuery.toUpperCase()) + ', ' + xpathString(searchQuery.toLowerCase()) + '), ' + xpathString(searchQuery.toLowerCase()) + ')]', root, null, XPathResult.ORDERED_NODE_ITERATOR_TYPE, null); while (node = xpathResult.iterateNext()) state.nodes.push(node); showCurrent(state); }, 400); }); Array.from(search.querySelectorAll('.sf-dump-search-input-next, .sf-dump-search-input-previous')).forEach(function (btn) { addEventListener(btn, 'click', function (e) { e.preventDefault(); -1 !== e.target.className.indexOf('next') ? state.next() : state.previous(); searchInput.focus(); collapseAll(root); showCurrent(state); }) }); addEventListener(root, 'keydown', function (e) { var isSearchActive = !/\bsf-dump-search-hidden\b/.test(search.className); if ((114 === e.keyCode && !isSearchActive) || (isCtrlKey(e) && 70 === e.keyCode)) { /* F3 or CMD/CTRL + F */ if (70 === e.keyCode && document.activeElement === searchInput) { /* * If CMD/CTRL + F is hit while having focus on search input, * the user probably meant to trigger browser search instead. * Let the browser execute its behavior: */ return; } e.preventDefault(); search.className = search.className.replace(/\bsf-dump-search-hidden\b/, ''); searchInput.focus(); } else if (isSearchActive) { if (27 === e.keyCode) { /* ESC key */ search.className += ' sf-dump-search-hidden'; e.preventDefault(); resetHighlightedNodes(root); searchInput.value = ''; } else if ( (isCtrlKey(e) && 71 === e.keyCode) /* CMD/CTRL + G */ || 13 === e.keyCode /* Enter */ || 114 === e.keyCode /* F3 */ ) { e.preventDefault(); e.shiftKey ? state.previous() : state.next(); collapseAll(root); showCurrent(state); } } }); } if (0 >= options.maxStringLength) { return; } try { elt = root.querySelectorAll('.sf-dump-str'); len = elt.length; i = 0; t = []; while (i < len) t.push(elt[i++]); len = t.length; for (i = 0; i < len; ++i) { elt = t[i]; s = elt.innerText || elt.textContent; x = s.length - options.maxStringLength; if (0 < x) { h = elt.innerHTML; elt[elt.innerText ? 'innerText' : 'textContent'] = s.substring(0, options.maxStringLength); elt.className += ' sf-dump-str-collapse'; elt.innerHTML = '<span class=sf-dump-str-collapse>'+h+'<a class="sf-dump-ref sf-dump-str-toggle" title="Collapse"> ◀</a></span>'+ '<span class=sf-dump-str-expand>'+elt.innerHTML+'<a class="sf-dump-ref sf-dump-str-toggle" title="'+x+' remaining characters"> ▶</a></span>'; } } } catch (e) { } }; })(document); </script><style></style><style> .phpdebugbar pre.sf-dump { display: block; white-space: pre; padding: 5px; overflow: initial !important; } .phpdebugbar pre.sf-dump:after { content: ""; visibility: hidden; display: block; height: 0; clear: both; } .phpdebugbar pre.sf-dump span { display: inline; } .phpdebugbar pre.sf-dump .sf-dump-compact { display: none; } .phpdebugbar pre.sf-dump a { text-decoration: none; cursor: pointer; border: 0; outline: none; color: inherit; } .phpdebugbar pre.sf-dump img { max-width: 50em; max-height: 50em; margin: .5em 0 0 0; padding: 0; background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAAAAAA6mKC9AAAAHUlEQVQY02O8zAABilCaiQEN0EeA8QuUcX9g3QEAAjcC5piyhyEAAAAASUVORK5CYII=) #D3D3D3; } .phpdebugbar pre.sf-dump .sf-dump-ellipsis { display: inline-block; overflow: visible; text-overflow: ellipsis; max-width: 5em; white-space: nowrap; overflow: hidden; vertical-align: top; } .phpdebugbar pre.sf-dump .sf-dump-ellipsis+.sf-dump-ellipsis { max-width: none; } .phpdebugbar pre.sf-dump code { display:inline; padding:0; background:none; } .sf-dump-str-collapse .sf-dump-str-collapse { display: none; } .sf-dump-str-expand .sf-dump-str-expand { display: none; } .sf-dump-public.sf-dump-highlight, .sf-dump-protected.sf-dump-highlight, .sf-dump-private.sf-dump-highlight, .sf-dump-str.sf-dump-highlight, .sf-dump-key.sf-dump-highlight { background: rgba(111, 172, 204, 0.3); border: 1px solid #7DA0B1; border-radius: 3px; } .sf-dump-public.sf-dump-highlight-active, .sf-dump-protected.sf-dump-highlight-active, .sf-dump-private.sf-dump-highlight-active, .sf-dump-str.sf-dump-highlight-active, .sf-dump-key.sf-dump-highlight-active { background: rgba(253, 175, 0, 0.4); border: 1px solid #ffa500; border-radius: 3px; } .phpdebugbar pre.sf-dump .sf-dump-search-hidden { display: none !important; } .phpdebugbar pre.sf-dump .sf-dump-search-wrapper { font-size: 0; white-space: nowrap; margin-bottom: 5px; display: flex; position: -webkit-sticky; position: sticky; top: 5px; } .phpdebugbar pre.sf-dump .sf-dump-search-wrapper > * { vertical-align: top; box-sizing: border-box; height: 21px; font-weight: normal; border-radius: 0; background: #FFF; color: #757575; border: 1px solid #BBB; } .phpdebugbar pre.sf-dump .sf-dump-search-wrapper > input.sf-dump-search-input { padding: 3px; height: 21px; font-size: 12px; border-right: none; border-top-left-radius: 3px; border-bottom-left-radius: 3px; color: #000; min-width: 15px; width: 100%; } .phpdebugbar pre.sf-dump .sf-dump-search-wrapper > .sf-dump-search-input-next, .phpdebugbar pre.sf-dump .sf-dump-search-wrapper > .sf-dump-search-input-previous { background: #F2F2F2; outline: none; border-left: none; font-size: 0; line-height: 0; } .phpdebugbar pre.sf-dump .sf-dump-search-wrapper > .sf-dump-search-input-next { border-top-right-radius: 3px; border-bottom-right-radius: 3px; } .phpdebugbar pre.sf-dump .sf-dump-search-wrapper > .sf-dump-search-input-next > svg, .phpdebugbar pre.sf-dump .sf-dump-search-wrapper > .sf-dump-search-input-previous > svg { pointer-events: none; width: 12px; height: 12px; } .phpdebugbar pre.sf-dump .sf-dump-search-wrapper > .sf-dump-search-count { display: inline-block; padding: 0 5px; margin: 0; border-left: none; line-height: 21px; font-size: 12px; }.phpdebugbar pre.sf-dump, .phpdebugbar pre.sf-dump .sf-dump-default{word-wrap: break-word; white-space: pre-wrap; word-break: normal}.phpdebugbar pre.sf-dump .sf-dump-num{font-weight:bold; color:#1299DA}.phpdebugbar pre.sf-dump .sf-dump-const{font-weight:bold}.phpdebugbar pre.sf-dump .sf-dump-str{font-weight:bold; color:#3A9B26}.phpdebugbar pre.sf-dump .sf-dump-note{color:#1299DA}.phpdebugbar pre.sf-dump .sf-dump-ref{color:#7B7B7B}.phpdebugbar pre.sf-dump .sf-dump-public{color:#000000}.phpdebugbar pre.sf-dump .sf-dump-protected{color:#000000}.phpdebugbar pre.sf-dump .sf-dump-private{color:#000000}.phpdebugbar pre.sf-dump .sf-dump-meta{color:#B729D9}.phpdebugbar pre.sf-dump .sf-dump-key{color:#3A9B26}.phpdebugbar pre.sf-dump .sf-dump-index{color:#1299DA}.phpdebugbar pre.sf-dump .sf-dump-ellipsis{color:#A0A000}.phpdebugbar pre.sf-dump .sf-dump-ns{user-select:none;}.phpdebugbar pre.sf-dump .sf-dump-ellipsis-note{color:#1299DA}</style>
</head>



<body class="c-app          pace-done" style=""><div class="pace  pace-inactive"><div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(100%, 0px, 0px);">
  <div class="pace-progress-inner"></div>
</div>
{{-- <div class="pace-activity"></div></div>
    <audio id="notification-audio" src="http://127.0.0.1:8000/audio/swiftly.mp3" muted=""></audio>
    <div class="c-sidebar c-sidebar-dark c-sidebar-fixed" id="sidebar">

        <div class="c-sidebar-brand" style=" background-image: linear-gradient(white, #3F9D94);">
    <img class="c-sidebar-brand-full" src="http://127.0.0.1:8000/assets/brand/medex.svg" width="118" height="46" alt="MedEx Logo">
    <img class="c-sidebar-brand-minimized" src="http://127.0.0.1:8000/assets/brand/m-signet.svg" width="118" height="46" alt="MedEx">
</div>
<ul class="c-sidebar-nav ps ps--active-y" style=" background-image: linear-gradient(#3F9D94, #2B6C65);">

    <!-- Բոլորը -->
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="http://127.0.0.1:8000/departments">
             <svg class="c-sidebar-nav-icon">
    <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-medical-cross"></use>
</svg>

            Բաժիններ
        </a>
    </li>

    <!-- Տնօրեն, գլխ․ և այլ բժիշկներ, կադրեր -->
    <!-- չունի դեղատունը -->

    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="http://127.0.0.1:8000/patients">
             <svg class="c-sidebar-nav-icon">
    <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-people"></use>
</svg>

            Հիվանդներ
        </a>
    </li>

    <!-- Ընդունակարան (araqsya.poghosyan)։ Առցանց հերթեր -->

    <!-- Բոլորը -->


    <!-- Բոլորը բուժական գծով -->
        <li class="c-sidebar-nav-title">Փաստաթղթեր</li>
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="http://127.0.0.1:8000/referrals/patients/received">
             <svg class="c-icon">
    <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-cloud-download"></use>
</svg>

             <svg class="c-sidebar-nav-icon">
    <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-bed"></use>
</svg>

            Ստացածներ
        </a>
        <a class="c-sidebar-nav-link" href="http://127.0.0.1:8000/referrals/patients/sent">
             <svg class="c-icon">
    <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-cloud-upload"></use>
</svg>

             <svg class="c-sidebar-nav-icon">
    <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-bed"></use>
</svg>

            Ուղարկվածներ
        </a>
    </li>





            <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="http://127.0.0.1:8000/departments/1/user/queue">
                 <svg class="c-sidebar-nav-icon">
    <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-list-numbered"></use>
</svg>

                Հիվանդների հերթացուցակ
            </a>
        </li>
        <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="http://127.0.0.1:8000/referrals/patients/services">
                 <svg class="c-sidebar-nav-icon">
    <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-list-numbered"></use>
</svg>

                Կատարած ծառայություններ
            </a>
        </li>
    <li class="c-sidebar-nav-item">
            <a class="c-sidebar-nav-link" href="http://127.0.0.1:8000/otherSamples/parentOtherSamples">
                 <svg class="c-sidebar-nav-icon">
    <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-calendar"></use>
</svg>

              Այլ ձևանմուշներ
            </a>
        </li>


    <!-- Կադրերի բաժին -->

    <!-- հաշվապահ, Դրամարկղ -->


    <li class="c-sidebar-nav-title">Դրամարկղ</li>









    <!-- Պահեստ -->

    <!-- Տնօրեն -->

    <!-- Տնօրեն, հաշվապահ, Ավագ քույր -->
        <li class="c-sidebar-nav-title">Դեղորայք</li>
    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="http://127.0.0.1:8000/pharmacy/pharmacy">
             <svg class="c-sidebar-nav-icon">
    <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-healing"></use>
</svg>

            Դեղորայքի մնացորդ
        </a>
    </li>

    <!-- Արխիվ -->



    <li class="c-sidebar-nav-item">
        <a class="c-sidebar-nav-link" href="http://127.0.0.1:8000/nonmedical-referrals/create">
             <svg class="c-sidebar-nav-icon">
    <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-list-numbered"></use>
</svg>

            Ուղեգրեր
        </a>
    </li>

<div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; height: 354px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 208px;"></div></div></ul>
<button class="c-sidebar-minimizer c-class-toggler" style="background:  #2C6E67;" type="button" data-target="_parent" data-class="c-sidebar-minimized">
</button> --}}
</div>


        <div class="c-wrapper">
    <header class="c-header c-header-light c-header-fixed c-header-with-subheader">
        <button class="c-header-toggler c-class-toggler d-lg-none mr-auto" type="button" data-target="#sidebar" data-class="c-sidebar-show">
            <span class="c-header-toggler-icon"></span>
        </button>
        <a class="c-header-brand d-sm-none" href="#">
            <img class="c-header-brand" src="/assets/brand/coreui-base.svg" width="97" height="46" alt="MedEx Logo">
        </a>
        <button class="c-header-toggler c-class-toggler ml-3 d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true">
            <span class="c-header-toggler-icon"></span>
        </button>
        <ul class="c-header-nav d-md-down-none">
            <li class="c-header-nav-item px-1">
                <a class="c-header-nav-link" href="/">Գլխավոր</a>
            </li>
            <li class="c-header-nav-item px-1">
                <a class="c-header-nav-link" href="/structure">Կառուցվածք</a>
            </li>
        </ul>
        <ul class="c-header-nav ml-auto mr-4">
            <li class="c-header-nav-item mx-2 c-d-legacy-none">
                <button class="c-class-toggler c-header-nav-btn c-header-nav" type="button" id="header-tooltip" data-target="body" data-class="c-dark-theme" data-toggle="c-tooltip" data-placement="bottom" title="" data-original-title="Toggle Light/Dark Mode">
                     <svg class="c-icon c-d-dark-none">
    <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-moon"></use>
</svg>

                     <svg class="c-icon c-d-default-none">
    <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-sun"></use>
</svg>

                </button>
            </li>

            <li class="c-header-nav-item d-md-down-none mx-2" id="received-referrals"><a class="c-header-nav-link " data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><svg class="c-icon"><use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-cloud-download"></use></svg><span class="badge badge-danger">0</span></a><div class="dropdown-menu dropdown-menu-right dropdown-menu-lg dropdown-limited pt-0"><div class="dropdown-header"><strong>Ստացված է 0 նոր ուղեգիր</strong></div><a class="dropdown-item text-center border-top" href="/referrals/patients/received"><strong>Բոլորը</strong></a></div></li>



            <li class="c-header-nav-item d-md-down-none mx-2">
                <a href="#" class="c-header-nav-link">
                     <svg class="c-icon">
    <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-list-rich"></use>
</svg>

                </a>
            </li>
            <li class="c-header-nav-item dropdown">
                <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                    <div class="c-avatar">
                        <img class="c-avatar-img" src="/assets/img/avatars/avatar.png" alt="user@email.com">
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right pt-0">
                    <div class="dropdown-header bg-light py-2">
                        <strong>Հաշիվ</strong>
                    </div>
                    <a class="dropdown-item" href="/referrals/patients/received">
                         <svg class="c-icon mr-2">
    <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-bell"></use>
</svg>

                        Ստացվածներ<span class="badge badge-info ml-auto">42</span>
                    </a>
                    <a class="dropdown-item" href="/referrals/patients/sent">
                         <svg class="c-icon mr-2">
    <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-envelope-open"></use>
</svg>

                        Ուղարկվածներ<span class="badge badge-success ml-auto">42</span>
                    </a>
                    <div class="dropdown-header bg-light py-2">
                        <strong>Կարգավորումներ</strong>
                    </div>
                    <a class="dropdown-item" href="#">
                         <svg class="c-icon mr-2">
    <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-user"></use>
</svg>
  Սիմոն Սիմոնյան
                    </a>
                    <a class="dropdown-item" href="#">
                         <svg class="c-icon mr-2">
    <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-settings"></use>
</svg>
  Փոխել գաղտնաբառը
                    </a>
                    <div class="dropdown-divider"></div>
                    <div class="dropdown-item">
                         <svg class="c-icon mr-2">
    <use xlink:href="/assets/icons/coreui/free-symbol-defs.svg#cui-account-logout"></use>
</svg>

                        <form action="/logout" method="POST">
                            <input type="hidden" name="_token" value="OlSBqeF5JQKyVKPIvFXrwkk5U5HEGb731gkpyIm7">                            <button type="submit" class="btn btn-ghost-dark btn-block">Դուրս գալ</button>
                        </form>
                    </div>
                </div>
            </li>
            <!-- settings-button -->

        </ul>
        <div class="c-subheader px-3">
            <ol class="breadcrumb border-0 m-0">
                <li class="breadcrumb-item"><a href="/">Գլխավոր</a></li>
                                                                         <li class="breadcrumb-item active">structure</li>
                                                </ol>
        </div>
    </header>

        <div class="c-body" style="background-image:url(/assets/img/avatars/samples/background.png); background-size: cover;background-attachment: fixed;
    background-position: bottom;">
            <main class="c-main">








                        <div class="container" style="margin-top:5%" >

                            <div class="row">
                                <a class="c-header-nav-link" href="/departments">
                                    <div class="col-sm-6 col-md-3">
                                    <div class="card">
                                    <div class="card-header" style="cursor:pointer; font-size:22px; text-align:center; background-color:004a82; color:white">
                                        Բաժիններ


                                    </div>
                                    <div class="card-body" style="cursor:pointer;">
                                         <img style="margin-left:36%" src="/assets/icons/structure/sheeld.png" width="60" height="auto">
                                    </div>
                                    </div>
                                </a>
                                </div>

                                    <div class="col-sm-6 col-md-3">
                                        <a class="c-header-nav-link" href="/patients">
                                            <div class="card">
                                            <div class="card-header" style="cursor:pointer; font-size:22px; text-align:center; background-color:3399ff; color:white">
                                                Հիվանդներ

                                            <input class="c-switch-input" type="checkbox"><span class="c-switch-label" data-on="On" data-off="Off"></span><span class="c-switch-handle"></span>

                                            </div>
                                            <div class="card-body" style="cursor:pointer;">
                                                <img style=" margin-left:36%" src="/assets/icons/structure/user.png" width="60" height="auto">
                                            </div>
                                            </div>
                                        </a>
                                    </div>

                                <div class="col-sm-6 col-md-3">
                                    <a class="c-header-nav-link" href="/pharmacy/pharmacy">
                                        <div class="card">
                                        <div class="card-header" style="cursor:pointer; font-size:22px; text-align:center; background-color:32cdc9 ;color:white">
                                            Դեղորայք

                                        <input class="c-switch-input" type="checkbox"><span class="c-switch-label" data-on="On" data-off="Off"></span><span class="c-switch-handle"></span>

                                        </div>
                                        <div class="card-body" style="cursor:pointer;">
                                            <img style=" margin-left:36%" src="/assets/icons/structure/sheet.png" width="60" height="auto">
                                        </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-sm-6 col-md-3">
                                    <a class="c-header-nav-link" href="/otherSamples/parentOtherSamples">
                                        <div class="card">
                                        <div class="card-header" style="cursor:pointer; font-size:22px; text-align:center; background-color:00cc99 ; color:white">
                                            Ձևանմուշներ

                                        <input class="c-switch-input" type="checkbox"><span class="c-switch-label" data-on="On" data-off="Off"></span><span class="c-switch-handle"></span>

                                        </div>
                                        <div class="card-body" style="cursor:pointer;">
                                            <img style="margin-left:36%" src="/assets/icons/structure/send.png" width="60" height="auto">
                                        </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-sm-6 col-md-3">
                                    <a class="c-header-nav-link" href="/warehouses">
                                        <div class="card">
                                        <div class="card-header" style="cursor:pointer; font-size:22px; text-align:center; background-color:ff9834 ; color:white">
                                            Պահեստ

                                        <input class="c-switch-input" type="checkbox"><span class="c-switch-label" data-on="On" data-off="Off"></span><span class="c-switch-handle"></span>

                                        </div>
                                        <div class="card-body" style="cursor:pointer;">
                                            <img style=" margin-left:36%" src="/assets/icons/structure/pahest.png" width="80" height="auto">
                                        </div>
                                        </div>
                                    </a>
                                </div>

                                <div class="col-sm-6 col-md-3">
                                    <div class="card">
                                    <div class="card-header" style="cursor:pointer; font-size:22px; text-align:center; background-color:c80033 ;color:white">
                                        Հաշվետվություն

                                    <input class="c-switch-input" type="checkbox"><span class="c-switch-label" data-on="On" data-off="Off"></span><span class="c-switch-handle"></span>

                                    </div>
                                    <div class="card-body" style="cursor:pointer;">
                                        <img style=" margin-left:36%" src="/assets/icons/structure/hashv.png" width="71" height="auto">
                                    </div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-md-3">
                                    <a class="c-header-nav-link" href="/cashbox/cashboxFirst/orderinput">
                                        <div class="card">
                                        <div class="card-header" style="cursor:pointer; font-size:22px; text-align:center; background-color:c90066 ; color:white">
                                            Դրամարկղ

                                        <input class="c-switch-input" type="checkbox"><span class="c-switch-label" data-on="On" data-off="Off"></span><span class="c-switch-handle"></span>

                                        </div>
                                        <div class="card-body" style="cursor:pointer;">
                                            <img style=" margin-left:36%" src="/assets/icons/structure/dram.png" width="63" height="auto">
                                        </div>
                                        </div>
                                    </a>
                                </div>


                                <div class="col-sm-6 col-md-3">
                                    <a class="c-header-nav-link" href="/nonmedical-referrals/create">
                                        <div class="card">
                                        <div class="card-header" style="cursor:pointer; font-size:22px; text-align:center; background-color:9966ff ;color:white">
                                            Ուղեգրեր

                                        <input class="c-switch-input" type="checkbox"><span class="c-switch-label" data-on="On" data-off="Off"></span><span class="c-switch-handle"></span>

                                        </div>
                                        <div class="card-body" style="cursor:pointer;">
                                            <img style="margin-left:36%" src="/assets/icons/structure/arxiv.png" width="68" height="auto">
                                        </div>
                                        </div>
                                    </a>
                                </div>


                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



            </main>
        </div>
        <footer class="c-footer">
    <div><a href="#">MedEx</a> © 2020 All rights reserverd.</div>
    <div class="ml-auto">
        Powered by&nbsp;
        <a href="https://web-ex.tech/" class="d-inline-flex align-items-center">
            <img width="30" class="mr-1" src="/assets/brand/webex_logo.png">ebexTech
        </a>
    </div>
</footer>
    </div>



    <!-- CoreUI and necessary plugins-->
    <script src="/js/pace.min.js?id=24d2d5e3e331c4efa3cd"></script>
    <script src="/js/coreui.bundle.min.js?id=a4c6e6109cd038b054c2"></script>
    <script src="/js/components/manifest.js?id=5b154769292f35fd862f"></script>
    <script src="/js/components/vendor.js?id=729a14f4d8a8eb341ea8"></script>
    <script src="/js/broadcast.js?id=5c8335f1342a8d795adc"></script>
    <script src="/js/components/ReceivedReferrals.js?id=edb11527e5b979a371c1"></script>

            <script>
        $('#header-tooltip').click(function (){
            let _token   = $('meta[name="csrf-token"]').attr('content');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: 'http://127.0.0.1:8000/change/Background',
                type:"get",
                success: function (data) {
                    console.log(data);
                }
            });
        })
    </script>
<script type="text/javascript">
var phpdebugbar = new PhpDebugBar.DebugBar();
phpdebugbar.addIndicator("php_version", new PhpDebugBar.DebugBar.Indicator({"icon":"code","tooltip":"PHP Version"}), "right");
phpdebugbar.addTab("messages", new PhpDebugBar.DebugBar.Tab({"icon":"list-alt","title":"Messages", "widget": new PhpDebugBar.Widgets.MessagesWidget()}));
phpdebugbar.addIndicator("time", new PhpDebugBar.DebugBar.Indicator({"icon":"clock-o","tooltip":"Request Duration"}), "right");
phpdebugbar.addTab("timeline", new PhpDebugBar.DebugBar.Tab({"icon":"tasks","title":"Timeline", "widget": new PhpDebugBar.Widgets.TimelineWidget()}));
phpdebugbar.addIndicator("memory", new PhpDebugBar.DebugBar.Indicator({"icon":"cogs","tooltip":"Memory Usage"}), "right");
phpdebugbar.addTab("exceptions", new PhpDebugBar.DebugBar.Tab({"icon":"bug","title":"Exceptions", "widget": new PhpDebugBar.Widgets.ExceptionsWidget()}));
phpdebugbar.addTab("views", new PhpDebugBar.DebugBar.Tab({"icon":"leaf","title":"Views", "widget": new PhpDebugBar.Widgets.TemplatesWidget()}));
phpdebugbar.addTab("route", new PhpDebugBar.DebugBar.Tab({"icon":"share","title":"Route", "widget": new PhpDebugBar.Widgets.VariableListWidget()}));
phpdebugbar.addIndicator("currentroute", new PhpDebugBar.DebugBar.Indicator({"icon":"share","tooltip":"Route"}), "right");
phpdebugbar.addTab("queries", new PhpDebugBar.DebugBar.Tab({"icon":"database","title":"Queries", "widget": new PhpDebugBar.Widgets.LaravelSQLQueriesWidget()}));
phpdebugbar.addTab("models", new PhpDebugBar.DebugBar.Tab({"icon":"cubes","title":"Models", "widget": new PhpDebugBar.Widgets.HtmlVariableListWidget()}));
phpdebugbar.addTab("emails", new PhpDebugBar.DebugBar.Tab({"icon":"inbox","title":"Mails", "widget": new PhpDebugBar.Widgets.MailsWidget()}));
phpdebugbar.addTab("gate", new PhpDebugBar.DebugBar.Tab({"icon":"list-alt","title":"Gate", "widget": new PhpDebugBar.Widgets.MessagesWidget()}));
phpdebugbar.addTab("session", new PhpDebugBar.DebugBar.Tab({"icon":"archive","title":"Session", "widget": new PhpDebugBar.Widgets.VariableListWidget()}));
phpdebugbar.addTab("request", new PhpDebugBar.DebugBar.Tab({"icon":"tags","title":"Request", "widget": new PhpDebugBar.Widgets.HtmlVariableListWidget()}));
phpdebugbar.setDataMap({
"php_version": ["php.version", ],
"messages": ["messages.messages", []],
"messages:badge": ["messages.count", null],
"time": ["time.duration_str", '0ms'],
"timeline": ["time", {}],
"memory": ["memory.peak_usage_str", '0B'],
"exceptions": ["exceptions.exceptions", []],
"exceptions:badge": ["exceptions.count", null],
"views": ["views", []],
"views:badge": ["views.nb_templates", 0],
"route": ["route", {}],
"currentroute": ["route.uri", ],
"queries": ["queries", []],
"queries:badge": ["queries.nb_statements", 0],
"models": ["models.data", {}],
"models:badge": ["models.count", 0],
"emails": ["swiftmailer_mails.mails", []],
"emails:badge": ["swiftmailer_mails.count", null],
"gate": ["gate.messages", []],
"gate:badge": ["gate.count", null],
"session": ["session", {}],
"request": ["request", {}]
});
phpdebugbar.restoreState();
phpdebugbar.ajaxHandler = new PhpDebugBar.AjaxHandler(phpdebugbar, undefined, true);
phpdebugbar.ajaxHandler.bindToFetch();
phpdebugbar.ajaxHandler.bindToXHR();
phpdebugbar.setOpenHandler(new PhpDebugBar.OpenHandler({"url":"http:\/\/127.0.0.1:8000\/_debugbar\/open"}));
phpdebugbar.addDataSet({"__meta":{"id":"X91df36ffc3329048a3cd771e30a6b656","datetime":"2020-12-14 13:26:01","utime":1607937961.682259,"method":"GET","uri":"\/structure","ip":"127.0.0.1"},"php":{"version":"7.4.5","interface":"cli-server"},"messages":{"count":0,"messages":[]},"time":{"start":1607937961.495357,"end":1607937961.682273,"duration":0.18691587448120117,"duration_str":"187ms","measures":[{"label":"Booting","start":1607937961.495357,"relative_start":0,"end":1607937961.591507,"relative_end":1607937961.591507,"duration":0.09614992141723633,"duration_str":"96.15ms","params":[],"collector":null},{"label":"Application","start":1607937961.593432,"relative_start":0.09807491302490234,"end":1607937961.682274,"relative_end":1.1920928955078125e-6,"duration":0.08884215354919434,"duration_str":"88.84ms","params":[],"collector":null}]},"memory":{"peak_usage":23815312,"peak_usage_str":"23MB"},"exceptions":{"count":0,"exceptions":[]},"views":{"nb_templates":26,"templates":[{"name":"auth.structure (\\resources\\views\\auth\\structure.blade.php)","param_count":0,"params":[],"type":"blade"},{"name":"layouts.cardBase (\\resources\\views\\layouts\\cardBase.blade.php)","param_count":4,"params":["obLevel","__env","app","errors"],"type":"blade"},{"name":"shared.info-box (\\resources\\views\\shared\\info-box.blade.php)","param_count":4,"params":["obLevel","__env","app","errors"],"type":"blade"},{"name":"layouts.base (\\resources\\views\\layouts\\base.blade.php)","param_count":4,"params":["obLevel","__env","app","errors"],"type":"blade"},{"name":"shared.nav-admin (\\resources\\views\\shared\\nav-admin.blade.php)","param_count":4,"params":["obLevel","__env","app","errors"],"type":"blade"},{"name":"components.svg (\\resources\\views\\components\\svg.blade.php)","param_count":6,"params":["icon","sidebarIcon","componentName","attributes","getClassName","slot"],"type":"blade"},{"name":"components.svg (\\resources\\views\\components\\svg.blade.php)","param_count":6,"params":["icon","sidebarIcon","componentName","attributes","getClassName","slot"],"type":"blade"},{"name":"components.svg (\\resources\\views\\components\\svg.blade.php)","param_count":6,"params":["icon","sidebarIcon","componentName","attributes","getClassName","slot"],"type":"blade"},{"name":"components.svg (\\resources\\views\\components\\svg.blade.php)","param_count":6,"params":["icon","sidebarIcon","componentName","attributes","getClassName","slot"],"type":"blade"},{"name":"components.svg (\\resources\\views\\components\\svg.blade.php)","param_count":6,"params":["icon","sidebarIcon","componentName","attributes","getClassName","slot"],"type":"blade"},{"name":"components.svg (\\resources\\views\\components\\svg.blade.php)","param_count":6,"params":["icon","sidebarIcon","componentName","attributes","getClassName","slot"],"type":"blade"},{"name":"components.svg (\\resources\\views\\components\\svg.blade.php)","param_count":6,"params":["icon","sidebarIcon","componentName","attributes","getClassName","slot"],"type":"blade"},{"name":"components.svg (\\resources\\views\\components\\svg.blade.php)","param_count":6,"params":["icon","sidebarIcon","componentName","attributes","getClassName","slot"],"type":"blade"},{"name":"components.svg (\\resources\\views\\components\\svg.blade.php)","param_count":6,"params":["icon","sidebarIcon","componentName","attributes","getClassName","slot"],"type":"blade"},{"name":"components.svg (\\resources\\views\\components\\svg.blade.php)","param_count":6,"params":["icon","sidebarIcon","componentName","attributes","getClassName","slot"],"type":"blade"},{"name":"components.svg (\\resources\\views\\components\\svg.blade.php)","param_count":6,"params":["icon","sidebarIcon","componentName","attributes","getClassName","slot"],"type":"blade"},{"name":"shared.header (\\resources\\views\\shared\\header.blade.php)","param_count":4,"params":["obLevel","__env","app","errors"],"type":"blade"},{"name":"components.svg (\\resources\\views\\components\\svg.blade.php)","param_count":6,"params":["icon","sidebarIcon","componentName","attributes","getClassName","slot"],"type":"blade"},{"name":"components.svg (\\resources\\views\\components\\svg.blade.php)","param_count":6,"params":["icon","sidebarIcon","componentName","attributes","getClassName","slot"],"type":"blade"},{"name":"components.svg (\\resources\\views\\components\\svg.blade.php)","param_count":6,"params":["icon","sidebarIcon","componentName","attributes","getClassName","slot"],"type":"blade"},{"name":"components.svg (\\resources\\views\\components\\svg.blade.php)","param_count":6,"params":["icon","sidebarIcon","componentName","attributes","getClassName","slot"],"type":"blade"},{"name":"components.svg (\\resources\\views\\components\\svg.blade.php)","param_count":6,"params":["icon","sidebarIcon","componentName","attributes","getClassName","slot"],"type":"blade"},{"name":"components.svg (\\resources\\views\\components\\svg.blade.php)","param_count":6,"params":["icon","sidebarIcon","componentName","attributes","getClassName","slot"],"type":"blade"},{"name":"components.svg (\\resources\\views\\components\\svg.blade.php)","param_count":6,"params":["icon","sidebarIcon","componentName","attributes","getClassName","slot"],"type":"blade"},{"name":"components.svg (\\resources\\views\\components\\svg.blade.php)","param_count":6,"params":["icon","sidebarIcon","componentName","attributes","getClassName","slot"],"type":"blade"},{"name":"shared.footer (\\resources\\views\\shared\\footer.blade.php)","param_count":4,"params":["obLevel","__env","app","errors"],"type":"blade"}]},"route":{"uri":"GET structure","middleware":"web, auth","as":"structure.index","controller":"App\\Http\\Controllers\\StructureController@index","namespace":"App\\Http\\Controllers","prefix":null,"where":[],"file":"\\app\\Http\\Controllers\\StructureController.php:16-19"},"queries":{"nb_statements":5,"nb_failed_statements":0,"accumulated_duration":0.01563,"accumulated_duration_str":"15.63ms","statements":[{"sql":"select * from `users` where `id` = 1 limit 1","type":"query","params":[],"bindings":["1"],"hints":null,"show_copy":false,"backtrace":[{"index":15,"namespace":null,"name":"\\vendor\\laravel\\framework\\src\\Illuminate\\Auth\\EloquentUserProvider.php","line":52},{"index":16,"namespace":null,"name":"\\vendor\\laravel\\framework\\src\\Illuminate\\Auth\\SessionGuard.php","line":139},{"index":17,"namespace":null,"name":"\\vendor\\laravel\\framework\\src\\Illuminate\\Auth\\GuardHelpers.php","line":60},{"index":18,"namespace":"middleware","name":"auth","line":63},{"index":19,"namespace":"middleware","name":"auth","line":42}],"duration":0.01293,"duration_str":"12.93ms","stmt_id":"\\vendor\\laravel\\framework\\src\\Illuminate\\Auth\\EloquentUserProvider.php:52","connection":"medex_db"},{"sql":"select column_name as `column_name` from information_schema.columns where table_schema = 'medex_db' and table_name = 'permissions'","type":"query","params":[],"bindings":["medex_db","permissions"],"hints":null,"show_copy":false,"backtrace":[{"index":14,"namespace":null,"name":"\\vendor\\spatie\\laravel-permission\\src\\Models\\Permission.php","line":27},{"index":16,"namespace":null,"name":"\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php","line":849},{"index":17,"namespace":null,"name":"\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php","line":691},{"index":18,"namespace":null,"name":"\\vendor\\laravel\\framework\\src\\Illuminate\\Foundation\\Application.php","line":796},{"index":19,"namespace":null,"name":"\\vendor\\laravel\\framework\\src\\Illuminate\\Container\\Container.php","line":637}],"duration":0.00093,"duration_str":"930\u03bcs","stmt_id":"\\vendor\\spatie\\laravel-permission\\src\\Models\\Permission.php:27","connection":"medex_db"},{"sql":"select `permissions`.*, `model_has_permissions`.`model_id` as `pivot_model_id`, `model_has_permissions`.`permission_id` as `pivot_permission_id`, `model_has_permissions`.`model_type` as `pivot_model_type` from `permissions` inner join `model_has_permissions` on `permissions`.`id` = `model_has_permissions`.`permission_id` where `model_has_permissions`.`model_id` = 1 and `model_has_permissions`.`model_type` = 'App\\Models\\User'","type":"query","params":[],"bindings":["1","App\\Models\\User"],"hints":null,"show_copy":false,"backtrace":[{"index":19,"namespace":null,"name":"\\vendor\\spatie\\laravel-permission\\src\\Traits\\HasPermissions.php","line":285},{"index":20,"namespace":null,"name":"\\vendor\\spatie\\laravel-permission\\src\\Traits\\HasPermissions.php","line":139},{"index":21,"namespace":null,"name":"\\vendor\\spatie\\laravel-permission\\src\\Traits\\HasPermissions.php","line":201},{"index":22,"namespace":null,"name":"\\vendor\\spatie\\laravel-permission\\src\\PermissionRegistrar.php","line":90},{"index":23,"namespace":null,"name":"\\vendor\\laravel\\framework\\src\\Illuminate\\Auth\\Access\\Gate.php","line":491}],"duration":0.0005,"duration_str":"500\u03bcs","stmt_id":"\\vendor\\spatie\\laravel-permission\\src\\Traits\\HasPermissions.php:285","connection":"medex_db"},{"sql":"select column_name as `column_name` from information_schema.columns where table_schema = 'medex_db' and table_name = 'roles'","type":"query","params":[],"bindings":["medex_db","roles"],"hints":null,"show_copy":false,"backtrace":[{"index":14,"namespace":null,"name":"\\vendor\\spatie\\laravel-permission\\src\\Models\\Role.php","line":26},{"index":17,"namespace":null,"name":"\\vendor\\spatie\\laravel-permission\\src\\Traits\\HasRoles.php","line":47},{"index":22,"namespace":null,"name":"\\vendor\\spatie\\laravel-permission\\src\\Traits\\HasRoles.php","line":207},{"index":23,"namespace":null,"name":"\\vendor\\spatie\\laravel-permission\\src\\Traits\\HasPermissions.php","line":258},{"index":24,"namespace":null,"name":"\\vendor\\spatie\\laravel-permission\\src\\Traits\\HasPermissions.php","line":139}],"duration":0.0007700000000000001,"duration_str":"770\u03bcs","stmt_id":"\\vendor\\spatie\\laravel-permission\\src\\Models\\Role.php:26","connection":"medex_db"},{"sql":"select `roles`.*, `model_has_roles`.`model_id` as `pivot_model_id`, `model_has_roles`.`role_id` as `pivot_role_id`, `model_has_roles`.`model_type` as `pivot_model_type` from `roles` inner join `model_has_roles` on `roles`.`id` = `model_has_roles`.`role_id` where `model_has_roles`.`model_id` = 1 and `model_has_roles`.`model_type` = 'App\\Models\\User'","type":"query","params":[],"bindings":["1","App\\Models\\User"],"hints":null,"show_copy":false,"backtrace":[{"index":19,"namespace":null,"name":"\\vendor\\spatie\\laravel-permission\\src\\Traits\\HasRoles.php","line":207},{"index":20,"namespace":null,"name":"\\vendor\\spatie\\laravel-permission\\src\\Traits\\HasPermissions.php","line":258},{"index":21,"namespace":null,"name":"\\vendor\\spatie\\laravel-permission\\src\\Traits\\HasPermissions.php","line":139},{"index":22,"namespace":null,"name":"\\vendor\\spatie\\laravel-permission\\src\\Traits\\HasPermissions.php","line":201},{"index":23,"namespace":null,"name":"\\vendor\\spatie\\laravel-permission\\src\\PermissionRegistrar.php","line":90}],"duration":0.0005,"duration_str":"500\u03bcs","stmt_id":"\\vendor\\spatie\\laravel-permission\\src\\Traits\\HasRoles.php:207","connection":"medex_db"}]},"models":{"data":{"Spatie\\Permission\\Models\\Role":1,"App\\Models\\User":1},"count":2},"swiftmailer_mails":{"count":0,"mails":[]},"gate":{"count":11,"messages":[{"message":"[ability => view patients, result => true, user => 1, arguments => []]","message_html":"<pre class=sf-dump id=sf-dump-2050569013 data-indent-pad=\"  \"><span class=sf-dump-note>array:4<\/span> [<samp>\n  \"<span class=sf-dump-key>ability<\/span>\" => \"<span class=sf-dump-str title=\"13 characters\">view patients<\/span>\"\n  \"<span class=sf-dump-key>result<\/span>\" => <span class=sf-dump-const>true<\/span>\n  \"<span class=sf-dump-key>user<\/span>\" => <span class=sf-dump-num>1<\/span>\n  \"<span class=sf-dump-key>arguments<\/span>\" => \"<span class=sf-dump-str title=\"2 characters\">[]<\/span>\"\n<\/samp>]\n<\/pre><script>Sfdump(\"sf-dump-2050569013\", {\"maxDepth\":0})<\/script>\n","is_string":false,"label":"success","time":1607937961.665567},{"message":"[ability => view users, result => null, user => 1, arguments => []]","message_html":"<pre class=sf-dump id=sf-dump-1426637065 data-indent-pad=\"  \"><span class=sf-dump-note>array:4<\/span> [<samp>\n  \"<span class=sf-dump-key>ability<\/span>\" => \"<span class=sf-dump-str title=\"10 characters\">view users<\/span>\"\n  \"<span class=sf-dump-key>result<\/span>\" => <span class=sf-dump-const>null<\/span>\n  \"<span class=sf-dump-key>user<\/span>\" => <span class=sf-dump-num>1<\/span>\n  \"<span class=sf-dump-key>arguments<\/span>\" => \"<span class=sf-dump-str title=\"2 characters\">[]<\/span>\"\n<\/samp>]\n<\/pre><script>Sfdump(\"sf-dump-1426637065\", {\"maxDepth\":0})<\/script>\n","is_string":false,"label":"error","time":1607937961.668514},{"message":"[ability => view cashboxes, result => null, user => 1, arguments => []]","message_html":"<pre class=sf-dump id=sf-dump-1538012178 data-indent-pad=\"  \"><span class=sf-dump-note>array:4<\/span> [<samp>\n  \"<span class=sf-dump-key>ability<\/span>\" => \"<span class=sf-dump-str title=\"14 characters\">view cashboxes<\/span>\"\n  \"<span class=sf-dump-key>result<\/span>\" => <span class=sf-dump-const>null<\/span>\n  \"<span class=sf-dump-key>user<\/span>\" => <span class=sf-dump-num>1<\/span>\n  \"<span class=sf-dump-key>arguments<\/span>\" => \"<span class=sf-dump-str title=\"2 characters\">[]<\/span>\"\n<\/samp>]\n<\/pre><script>Sfdump(\"sf-dump-1538012178\", {\"maxDepth\":0})<\/script>\n","is_string":false,"label":"error","time":1607937961.669103},{"message":"[ability => view cashboxes 1, result => null, user => 1, arguments => []]","message_html":"<pre class=sf-dump id=sf-dump-1554437403 data-indent-pad=\"  \"><span class=sf-dump-note>array:4<\/span> [<samp>\n  \"<span class=sf-dump-key>ability<\/span>\" => \"<span class=sf-dump-str title=\"16 characters\">view cashboxes 1<\/span>\"\n  \"<span class=sf-dump-key>result<\/span>\" => <span class=sf-dump-const>null<\/span>\n  \"<span class=sf-dump-key>user<\/span>\" => <span class=sf-dump-num>1<\/span>\n  \"<span class=sf-dump-key>arguments<\/span>\" => \"<span class=sf-dump-str title=\"2 characters\">[]<\/span>\"\n<\/samp>]\n<\/pre><script>Sfdump(\"sf-dump-1554437403\", {\"maxDepth\":0})<\/script>\n","is_string":false,"label":"error","time":1607937961.669666},{"message":"[ability => view cashboxes 2, result => null, user => 1, arguments => []]","message_html":"<pre class=sf-dump id=sf-dump-1300201481 data-indent-pad=\"  \"><span class=sf-dump-note>array:4<\/span> [<samp>\n  \"<span class=sf-dump-key>ability<\/span>\" => \"<span class=sf-dump-str title=\"16 characters\">view cashboxes 2<\/span>\"\n  \"<span class=sf-dump-key>result<\/span>\" => <span class=sf-dump-const>null<\/span>\n  \"<span class=sf-dump-key>user<\/span>\" => <span class=sf-dump-num>1<\/span>\n  \"<span class=sf-dump-key>arguments<\/span>\" => \"<span class=sf-dump-str title=\"2 characters\">[]<\/span>\"\n<\/samp>]\n<\/pre><script>Sfdump(\"sf-dump-1300201481\", {\"maxDepth\":0})<\/script>\n","is_string":false,"label":"error","time":1607937961.67023},{"message":"[ability => view cashboxes 3, result => null, user => 1, arguments => []]","message_html":"<pre class=sf-dump id=sf-dump-1823749523 data-indent-pad=\"  \"><span class=sf-dump-note>array:4<\/span> [<samp>\n  \"<span class=sf-dump-key>ability<\/span>\" => \"<span class=sf-dump-str title=\"16 characters\">view cashboxes 3<\/span>\"\n  \"<span class=sf-dump-key>result<\/span>\" => <span class=sf-dump-const>null<\/span>\n  \"<span class=sf-dump-key>user<\/span>\" => <span class=sf-dump-num>1<\/span>\n  \"<span class=sf-dump-key>arguments<\/span>\" => \"<span class=sf-dump-str title=\"2 characters\">[]<\/span>\"\n<\/samp>]\n<\/pre><script>Sfdump(\"sf-dump-1823749523\", {\"maxDepth\":0})<\/script>\n","is_string":false,"label":"error","time":1607937961.670787},{"message":"[ability => view cashboxes 4, result => null, user => 1, arguments => []]","message_html":"<pre class=sf-dump id=sf-dump-4129070 data-indent-pad=\"  \"><span class=sf-dump-note>array:4<\/span> [<samp>\n  \"<span class=sf-dump-key>ability<\/span>\" => \"<span class=sf-dump-str title=\"16 characters\">view cashboxes 4<\/span>\"\n  \"<span class=sf-dump-key>result<\/span>\" => <span class=sf-dump-const>null<\/span>\n  \"<span class=sf-dump-key>user<\/span>\" => <span class=sf-dump-num>1<\/span>\n  \"<span class=sf-dump-key>arguments<\/span>\" => \"<span class=sf-dump-str title=\"2 characters\">[]<\/span>\"\n<\/samp>]\n<\/pre><script>Sfdump(\"sf-dump-4129070\", {\"maxDepth\":0})<\/script>\n","is_string":false,"label":"error","time":1607937961.671347},{"message":"[ability => view warehouse-items, result => null, user => 1, arguments => []]","message_html":"<pre class=sf-dump id=sf-dump-1943360565 data-indent-pad=\"  \"><span class=sf-dump-note>array:4<\/span> [<samp>\n  \"<span class=sf-dump-key>ability<\/span>\" => \"<span class=sf-dump-str title=\"20 characters\">view warehouse-items<\/span>\"\n  \"<span class=sf-dump-key>result<\/span>\" => <span class=sf-dump-const>null<\/span>\n  \"<span class=sf-dump-key>user<\/span>\" => <span class=sf-dump-num>1<\/span>\n  \"<span class=sf-dump-key>arguments<\/span>\" => \"<span class=sf-dump-str title=\"2 characters\">[]<\/span>\"\n<\/samp>]\n<\/pre><script>Sfdump(\"sf-dump-1943360565\", {\"maxDepth\":0})<\/script>\n","is_string":false,"label":"error","time":1607937961.671901},{"message":"[ability => view reports, result => null, user => 1, arguments => []]","message_html":"<pre class=sf-dump id=sf-dump-1809272471 data-indent-pad=\"  \"><span class=sf-dump-note>array:4<\/span> [<samp>\n  \"<span class=sf-dump-key>ability<\/span>\" => \"<span class=sf-dump-str title=\"12 characters\">view reports<\/span>\"\n  \"<span class=sf-dump-key>result<\/span>\" => <span class=sf-dump-const>null<\/span>\n  \"<span class=sf-dump-key>user<\/span>\" => <span class=sf-dump-num>1<\/span>\n  \"<span class=sf-dump-key>arguments<\/span>\" => \"<span class=sf-dump-str title=\"2 characters\">[]<\/span>\"\n<\/samp>]\n<\/pre><script>Sfdump(\"sf-dump-1809272471\", {\"maxDepth\":0})<\/script>\n","is_string":false,"label":"error","time":1607937961.672753},{"message":"[ability => view medicines, result => true, user => 1, arguments => []]","message_html":"<pre class=sf-dump id=sf-dump-1552101513 data-indent-pad=\"  \"><span class=sf-dump-note>array:4<\/span> [<samp>\n  \"<span class=sf-dump-key>ability<\/span>\" => \"<span class=sf-dump-str title=\"14 characters\">view medicines<\/span>\"\n  \"<span class=sf-dump-key>result<\/span>\" => <span class=sf-dump-const>true<\/span>\n  \"<span class=sf-dump-key>user<\/span>\" => <span class=sf-dump-num>1<\/span>\n  \"<span class=sf-dump-key>arguments<\/span>\" => \"<span class=sf-dump-str title=\"2 characters\">[]<\/span>\"\n<\/samp>]\n<\/pre><script>Sfdump(\"sf-dump-1552101513\", {\"maxDepth\":0})<\/script>\n","is_string":false,"label":"success","time":1607937961.673495},{"message":"[ability => view archives, result => null, user => 1, arguments => []]","message_html":"<pre class=sf-dump id=sf-dump-2034510331 data-indent-pad=\"  \"><span class=sf-dump-note>array:4<\/span> [<samp>\n  \"<span class=sf-dump-key>ability<\/span>\" => \"<span class=sf-dump-str title=\"13 characters\">view archives<\/span>\"\n  \"<span class=sf-dump-key>result<\/span>\" => <span class=sf-dump-const>null<\/span>\n  \"<span class=sf-dump-key>user<\/span>\" => <span class=sf-dump-num>1<\/span>\n  \"<span class=sf-dump-key>arguments<\/span>\" => \"<span class=sf-dump-str title=\"2 characters\">[]<\/span>\"\n<\/samp>]\n<\/pre><script>Sfdump(\"sf-dump-2034510331\", {\"maxDepth\":0})<\/script>\n","is_string":false,"label":"error","time":1607937961.674479}]},"session":{"_token":"OlSBqeF5JQKyVKPIvFXrwkk5U5HEGb731gkpyIm7","_flash":"array:2 [\n  \"old\" => []\n  \"new\" => []\n]","_previous":"array:1 [\n  \"url\" => \"http:\/\/127.0.0.1:8000\/structure\"\n]","login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d":"1","PHPDEBUGBAR_STACK_DATA":"[]"},"request":{"path_info":"\/structure","status_code":"<pre class=sf-dump id=sf-dump-1551777006 data-indent-pad=\"  \"><span class=sf-dump-num>200<\/span>\n<\/pre><script>Sfdump(\"sf-dump-1551777006\", {\"maxDepth\":0})<\/script>\n","status_text":"OK","format":"html","content_type":"text\/html; charset=UTF-8","request_query":"<pre class=sf-dump id=sf-dump-776087045 data-indent-pad=\"  \">[]\n<\/pre><script>Sfdump(\"sf-dump-776087045\", {\"maxDepth\":0})<\/script>\n","request_request":"<pre class=sf-dump id=sf-dump-169431659 data-indent-pad=\"  \">[]\n<\/pre><script>Sfdump(\"sf-dump-169431659\", {\"maxDepth\":0})<\/script>\n","request_headers":"<pre class=sf-dump id=sf-dump-206844560 data-indent-pad=\"  \"><span class=sf-dump-note>array:13<\/span> [<samp>\n  \"<span class=sf-dump-key>host<\/span>\" => <span class=sf-dump-note>array:1<\/span> [<samp>\n    <span class=sf-dump-index>0<\/span> => \"<span class=sf-dump-str title=\"14 characters\">127.0.0.1:8000<\/span>\"\n  <\/samp>]\n  \"<span class=sf-dump-key>connection<\/span>\" => <span class=sf-dump-note>array:1<\/span> [<samp>\n    <span class=sf-dump-index>0<\/span> => \"<span class=sf-dump-str title=\"10 characters\">keep-alive<\/span>\"\n  <\/samp>]\n  \"<span class=sf-dump-key>cache-control<\/span>\" => <span class=sf-dump-note>array:1<\/span> [<samp>\n    <span class=sf-dump-index>0<\/span> => \"<span class=sf-dump-str title=\"9 characters\">max-age=0<\/span>\"\n  <\/samp>]\n  \"<span class=sf-dump-key>upgrade-insecure-requests<\/span>\" => <span class=sf-dump-note>array:1<\/span> [<samp>\n    <span class=sf-dump-index>0<\/span> => \"<span class=sf-dump-str>1<\/span>\"\n  <\/samp>]\n  \"<span class=sf-dump-key>user-agent<\/span>\" => <span class=sf-dump-note>array:1<\/span> [<samp>\n    <span class=sf-dump-index>0<\/span> => \"<span class=sf-dump-str title=\"114 characters\">Mozilla\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\/537.36 (KHTML, like Gecko) Chrome\/87.0.4280.88 Safari\/537.36<\/span>\"\n  <\/samp>]\n  \"<span class=sf-dump-key>accept<\/span>\" => <span class=sf-dump-note>array:1<\/span> [<samp>\n    <span class=sf-dump-index>0<\/span> => \"<span class=sf-dump-str title=\"135 characters\">text\/html,application\/xhtml+xml,application\/xml;q=0.9,image\/avif,image\/webp,image\/apng,*\/*;q=0.8,application\/signed-exchange;v=b3;q=0.9<\/span>\"\n  <\/samp>]\n  \"<span class=sf-dump-key>sec-fetch-site<\/span>\" => <span class=sf-dump-note>array:1<\/span> [<samp>\n    <span class=sf-dump-index>0<\/span> => \"<span class=sf-dump-str title=\"4 characters\">none<\/span>\"\n  <\/samp>]\n  \"<span class=sf-dump-key>sec-fetch-mode<\/span>\" => <span class=sf-dump-note>array:1<\/span> [<samp>\n    <span class=sf-dump-index>0<\/span> => \"<span class=sf-dump-str title=\"8 characters\">navigate<\/span>\"\n  <\/samp>]\n  \"<span class=sf-dump-key>sec-fetch-user<\/span>\" => <span class=sf-dump-note>array:1<\/span> [<samp>\n    <span class=sf-dump-index>0<\/span> => \"<span class=sf-dump-str title=\"2 characters\">?1<\/span>\"\n  <\/samp>]\n  \"<span class=sf-dump-key>sec-fetch-dest<\/span>\" => <span class=sf-dump-note>array:1<\/span> [<samp>\n    <span class=sf-dump-index>0<\/span> => \"<span class=sf-dump-str title=\"8 characters\">document<\/span>\"\n  <\/samp>]\n  \"<span class=sf-dump-key>accept-encoding<\/span>\" => <span class=sf-dump-note>array:1<\/span> [<samp>\n    <span class=sf-dump-index>0<\/span> => \"<span class=sf-dump-str title=\"17 characters\">gzip, deflate, br<\/span>\"\n  <\/samp>]\n  \"<span class=sf-dump-key>accept-language<\/span>\" => <span class=sf-dump-note>array:1<\/span> [<samp>\n    <span class=sf-dump-index>0<\/span> => \"<span class=sf-dump-str title=\"35 characters\">ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7<\/span>\"\n  <\/samp>]\n  \"<span class=sf-dump-key>cookie<\/span>\" => <span class=sf-dump-note>array:1<\/span> [<samp>\n    <span class=sf-dump-index>0<\/span> => \"<span class=sf-dump-str title=\"691 characters\">XSRF-TOKEN=eyJpdiI6InRxMmRGRWZpZUxqQ1lYVk1QNzF1WEE9PSIsInZhbHVlIjoiTDBESDJmR2ZWK0FMSXNpdVBGV3lsQThNQk5QSHY4Z0hURWRYTTFHNUtPWnNzek1KYTZmaDdQMUZGeU9mWFlwc2tmSWQxQXBndFcvYy9CVlZkSEtCNHplSnBKT3NVOEpuc3p3VFJIakg1SVVzeTI2d1QxdmlLeEVwTzhQVFlmZ3YiLCJtYWMiOiIxNDE5YjBmYjdjOWYyY2ZkM2NiZmFhMmM1MmQ2MWMxN2I1ZWExNzZiYTExMmM3N2FkNzc3YTVmMDc1OTkyNjFhIn0%3D; medexrepo_session=eyJpdiI6ImhpUWpkUkM1ZVU0eUhWb1cvdjNyNGc9PSIsInZhbHVlIjoicUw3amZHS0E2NkV2U2Z6d25aL2NJbzJOMWNBamFtNEhONDcrNm5DbHJJOFl3RnNOOURUMmdDWFMvWHRIMXBaYzZXQmtwcU5XdnRqM0RZZmFjMTRPanRDZkF0ZkpqYjY1L0FXN2dNMHhaelZjTmtERnY3V2dCcTQ3UGErZFI2UEciLCJtYWMiOiI3ZDYxMGQ5OGQ1NTM3OTQyZWRiMmJmNTM1NDk1MTI1NzMyOGUxMjI5YmQ0NGEzZmJmNDZiZDhlMWZmZTY0MDE0In0%3D<\/span>\"\n  <\/samp>]\n<\/samp>]\n<\/pre><script>Sfdump(\"sf-dump-206844560\", {\"maxDepth\":0})<\/script>\n","request_server":"<pre class=sf-dump id=sf-dump-1630051439 data-indent-pad=\"  \"><span class=sf-dump-note>array:30<\/span> [<samp>\n  \"<span class=sf-dump-key>DOCUMENT_ROOT<\/span>\" => \"<span class=sf-dump-str title=\"38 characters\">C:\\OpenServer\\domains\\medexrepo\\public<\/span>\"\n  \"<span class=sf-dump-key>REMOTE_ADDR<\/span>\" => \"<span class=sf-dump-str title=\"9 characters\">127.0.0.1<\/span>\"\n  \"<span class=sf-dump-key>REMOTE_PORT<\/span>\" => \"<span class=sf-dump-str title=\"5 characters\">54968<\/span>\"\n  \"<span class=sf-dump-key>SERVER_SOFTWARE<\/span>\" => \"<span class=sf-dump-str title=\"28 characters\">PHP 7.4.5 Development Server<\/span>\"\n  \"<span class=sf-dump-key>SERVER_PROTOCOL<\/span>\" => \"<span class=sf-dump-str title=\"8 characters\">HTTP\/1.1<\/span>\"\n  \"<span class=sf-dump-key>SERVER_NAME<\/span>\" => \"<span class=sf-dump-str title=\"9 characters\">127.0.0.1<\/span>\"\n  \"<span class=sf-dump-key>SERVER_PORT<\/span>\" => \"<span class=sf-dump-str title=\"4 characters\">8000<\/span>\"\n  \"<span class=sf-dump-key>REQUEST_URI<\/span>\" => \"<span class=sf-dump-str title=\"10 characters\">\/structure<\/span>\"\n  \"<span class=sf-dump-key>REQUEST_METHOD<\/span>\" => \"<span class=sf-dump-str title=\"3 characters\">GET<\/span>\"\n  \"<span class=sf-dump-key>SCRIPT_NAME<\/span>\" => \"<span class=sf-dump-str title=\"10 characters\">\/index.php<\/span>\"\n  \"<span class=sf-dump-key>SCRIPT_FILENAME<\/span>\" => \"<span class=sf-dump-str title=\"48 characters\">C:\\OpenServer\\domains\\medexrepo\\public\\index.php<\/span>\"\n  \"<span class=sf-dump-key>PATH_INFO<\/span>\" => \"<span class=sf-dump-str title=\"10 characters\">\/structure<\/span>\"\n  \"<span class=sf-dump-key>PHP_SELF<\/span>\" => \"<span class=sf-dump-str title=\"20 characters\">\/index.php\/structure<\/span>\"\n  \"<span class=sf-dump-key>HTTP_HOST<\/span>\" => \"<span class=sf-dump-str title=\"14 characters\">127.0.0.1:8000<\/span>\"\n  \"<span class=sf-dump-key>HTTP_CONNECTION<\/span>\" => \"<span class=sf-dump-str title=\"10 characters\">keep-alive<\/span>\"\n  \"<span class=sf-dump-key>HTTP_CACHE_CONTROL<\/span>\" => \"<span class=sf-dump-str title=\"9 characters\">max-age=0<\/span>\"\n  \"<span class=sf-dump-key>HTTP_UPGRADE_INSECURE_REQUESTS<\/span>\" => \"<span class=sf-dump-str>1<\/span>\"\n  \"<span class=sf-dump-key>HTTP_USER_AGENT<\/span>\" => \"<span class=sf-dump-str title=\"114 characters\">Mozilla\/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit\/537.36 (KHTML, like Gecko) Chrome\/87.0.4280.88 Safari\/537.36<\/span>\"\n  \"<span class=sf-dump-key>HTTP_ACCEPT<\/span>\" => \"<span class=sf-dump-str title=\"135 characters\">text\/html,application\/xhtml+xml,application\/xml;q=0.9,image\/avif,image\/webp,image\/apng,*\/*;q=0.8,application\/signed-exchange;v=b3;q=0.9<\/span>\"\n  \"<span class=sf-dump-key>HTTP_SEC_FETCH_SITE<\/span>\" => \"<span class=sf-dump-str title=\"4 characters\">none<\/span>\"\n  \"<span class=sf-dump-key>HTTP_SEC_FETCH_MODE<\/span>\" => \"<span class=sf-dump-str title=\"8 characters\">navigate<\/span>\"\n  \"<span class=sf-dump-key>HTTP_SEC_FETCH_USER<\/span>\" => \"<span class=sf-dump-str title=\"2 characters\">?1<\/span>\"\n  \"<span class=sf-dump-key>HTTP_SEC_FETCH_DEST<\/span>\" => \"<span class=sf-dump-str title=\"8 characters\">document<\/span>\"\n  \"<span class=sf-dump-key>HTTP_ACCEPT_ENCODING<\/span>\" => \"<span class=sf-dump-str title=\"17 characters\">gzip, deflate, br<\/span>\"\n  \"<span class=sf-dump-key>HTTP_ACCEPT_LANGUAGE<\/span>\" => \"<span class=sf-dump-str title=\"35 characters\">ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7<\/span>\"\n  \"<span class=sf-dump-key>HTTP_COOKIE<\/span>\" => \"<span class=sf-dump-str title=\"691 characters\">XSRF-TOKEN=eyJpdiI6InRxMmRGRWZpZUxqQ1lYVk1QNzF1WEE9PSIsInZhbHVlIjoiTDBESDJmR2ZWK0FMSXNpdVBGV3lsQThNQk5QSHY4Z0hURWRYTTFHNUtPWnNzek1KYTZmaDdQMUZGeU9mWFlwc2tmSWQxQXBndFcvYy9CVlZkSEtCNHplSnBKT3NVOEpuc3p3VFJIakg1SVVzeTI2d1QxdmlLeEVwTzhQVFlmZ3YiLCJtYWMiOiIxNDE5YjBmYjdjOWYyY2ZkM2NiZmFhMmM1MmQ2MWMxN2I1ZWExNzZiYTExMmM3N2FkNzc3YTVmMDc1OTkyNjFhIn0%3D; medexrepo_session=eyJpdiI6ImhpUWpkUkM1ZVU0eUhWb1cvdjNyNGc9PSIsInZhbHVlIjoicUw3amZHS0E2NkV2U2Z6d25aL2NJbzJOMWNBamFtNEhONDcrNm5DbHJJOFl3RnNOOURUMmdDWFMvWHRIMXBaYzZXQmtwcU5XdnRqM0RZZmFjMTRPanRDZkF0ZkpqYjY1L0FXN2dNMHhaelZjTmtERnY3V2dCcTQ3UGErZFI2UEciLCJtYWMiOiI3ZDYxMGQ5OGQ1NTM3OTQyZWRiMmJmNTM1NDk1MTI1NzMyOGUxMjI5YmQ0NGEzZmJmNDZiZDhlMWZmZTY0MDE0In0%3D<\/span>\"\n  \"<span class=sf-dump-key>REQUEST_TIME_FLOAT<\/span>\" => <span class=sf-dump-num>1607937961.4954<\/span>\n  \"<span class=sf-dump-key>REQUEST_TIME<\/span>\" => <span class=sf-dump-num>1607937961<\/span>\n  \"<span class=sf-dump-key>argv<\/span>\" => []\n  \"<span class=sf-dump-key>argc<\/span>\" => <span class=sf-dump-num>0<\/span>\n<\/samp>]\n<\/pre><script>Sfdump(\"sf-dump-1630051439\", {\"maxDepth\":0})<\/script>\n","request_cookies":"<pre class=sf-dump id=sf-dump-799987032 data-indent-pad=\"  \"><span class=sf-dump-note>array:2<\/span> [<samp>\n  \"<span class=sf-dump-key>XSRF-TOKEN<\/span>\" => \"<span class=sf-dump-str title=\"40 characters\">OlSBqeF5JQKyVKPIvFXrwkk5U5HEGb731gkpyIm7<\/span>\"\n  \"<span class=sf-dump-key>medexrepo_session<\/span>\" => \"<span class=sf-dump-str title=\"40 characters\">PZ047Y3MSR5v91Ha4maYZrrEkD5wGHeNpSIPWpe2<\/span>\"\n<\/samp>]\n<\/pre><script>Sfdump(\"sf-dump-799987032\", {\"maxDepth\":0})<\/script>\n","response_headers":"<pre class=sf-dump id=sf-dump-575764646 data-indent-pad=\"  \"><span class=sf-dump-note>array:5<\/span> [<samp>\n  \"<span class=sf-dump-key>content-type<\/span>\" => <span class=sf-dump-note>array:1<\/span> [<samp>\n    <span class=sf-dump-index>0<\/span> => \"<span class=sf-dump-str title=\"24 characters\">text\/html; charset=UTF-8<\/span>\"\n  <\/samp>]\n  \"<span class=sf-dump-key>cache-control<\/span>\" => <span class=sf-dump-note>array:1<\/span> [<samp>\n    <span class=sf-dump-index>0<\/span> => \"<span class=sf-dump-str title=\"17 characters\">no-cache, private<\/span>\"\n  <\/samp>]\n  \"<span class=sf-dump-key>date<\/span>\" => <span class=sf-dump-note>array:1<\/span> [<samp>\n    <span class=sf-dump-index>0<\/span> => \"<span class=sf-dump-str title=\"29 characters\">Mon, 14 Dec 2020 09:26:01 GMT<\/span>\"\n  <\/samp>]\n  \"<span class=sf-dump-key>set-cookie<\/span>\" => <span class=sf-dump-note>array:2<\/span> [<samp>\n    <span class=sf-dump-index>0<\/span> => \"<span class=sf-dump-str title=\"416 characters\">XSRF-TOKEN=eyJpdiI6IjVLenFhbGsvTDI0NUE2TlM5Q2tkS0E9PSIsInZhbHVlIjoiWnQybXdLZE53Z0hTTjdYNkpnbWhld1ZGbEFnbitDdkZ4SW9pRjkwU0xLUnFrT2I0eTVhUDBYalhMcDYyN0Y0Y3l2WU8wUlN3K2ZVTlo3TTNOc3BxTk5JVnlQS1lKT2hsSVc4WWN2ck1JM0xtelZXa203d2k0QSt5NlAzNUNNdngiLCJtYWMiOiJiZjFjZDlmNzFiOTRhMDg2ZTk1ZDQwODY4ZmZlNDdiZTYzZmE2OGI3YWZkOTc2MTdhNjU5NmE1OWUyY2I3OWNjIn0%3D; expires=Mon, 14-Dec-2020 11:26:01 GMT; Max-Age=7200; path=\/; samesite=lax<\/span>\"\n    <span class=sf-dump-index>1<\/span> => \"<span class=sf-dump-str title=\"433 characters\">medexrepo_session=eyJpdiI6ImR0eGxsNEcwWm9YQXpWMXF0Z29mYnc9PSIsInZhbHVlIjoiMDdQeGREcnd6MFZQRTFPR0grZDdtQWtOVmhtT3ZpUm0yYS90aTdpdUxGMWovdGJqTk9nMm1pYkd2WUt2N3hTaDBBcXZQWHRtV2FIS1l5ZGQrYWNTZ0MycmJ2bGdOdzZ5MzRTdjA3c2NTZVR0WlVRT0wyVFVDNDJhYnlVY0MzdlIiLCJtYWMiOiJhMmZkZWMzZDhmMTQzMzkzZTQ3OTYxNDY0YjI3ZjY4ZmViMDYyOTg2NWZkODc2NDc5NTU5OWNhZGFhYjBhZDk4In0%3D; expires=Mon, 14-Dec-2020 11:26:01 GMT; Max-Age=7200; path=\/; httponly; samesite=lax<\/span>\"\n  <\/samp>]\n  \"<span class=sf-dump-key>Set-Cookie<\/span>\" => <span class=sf-dump-note>array:2<\/span> [<samp>\n    <span class=sf-dump-index>0<\/span> => \"<span class=sf-dump-str title=\"388 characters\">XSRF-TOKEN=eyJpdiI6IjVLenFhbGsvTDI0NUE2TlM5Q2tkS0E9PSIsInZhbHVlIjoiWnQybXdLZE53Z0hTTjdYNkpnbWhld1ZGbEFnbitDdkZ4SW9pRjkwU0xLUnFrT2I0eTVhUDBYalhMcDYyN0Y0Y3l2WU8wUlN3K2ZVTlo3TTNOc3BxTk5JVnlQS1lKT2hsSVc4WWN2ck1JM0xtelZXa203d2k0QSt5NlAzNUNNdngiLCJtYWMiOiJiZjFjZDlmNzFiOTRhMDg2ZTk1ZDQwODY4ZmZlNDdiZTYzZmE2OGI3YWZkOTc2MTdhNjU5NmE1OWUyY2I3OWNjIn0%3D; expires=Mon, 14-Dec-2020 11:26:01 GMT; path=\/<\/span>\"\n    <span class=sf-dump-index>1<\/span> => \"<span class=sf-dump-str title=\"405 characters\">medexrepo_session=eyJpdiI6ImR0eGxsNEcwWm9YQXpWMXF0Z29mYnc9PSIsInZhbHVlIjoiMDdQeGREcnd6MFZQRTFPR0grZDdtQWtOVmhtT3ZpUm0yYS90aTdpdUxGMWovdGJqTk9nMm1pYkd2WUt2N3hTaDBBcXZQWHRtV2FIS1l5ZGQrYWNTZ0MycmJ2bGdOdzZ5MzRTdjA3c2NTZVR0WlVRT0wyVFVDNDJhYnlVY0MzdlIiLCJtYWMiOiJhMmZkZWMzZDhmMTQzMzkzZTQ3OTYxNDY0YjI3ZjY4ZmViMDYyOTg2NWZkODc2NDc5NTU5OWNhZGFhYjBhZDk4In0%3D; expires=Mon, 14-Dec-2020 11:26:01 GMT; path=\/; httponly<\/span>\"\n  <\/samp>]\n<\/samp>]\n<\/pre><script>Sfdump(\"sf-dump-575764646\", {\"maxDepth\":0})<\/script>\n","session_attributes":"<pre class=sf-dump id=sf-dump-277628866 data-indent-pad=\"  \"><span class=sf-dump-note>array:5<\/span> [<samp>\n  \"<span class=sf-dump-key>_token<\/span>\" => \"<span class=sf-dump-str title=\"40 characters\">OlSBqeF5JQKyVKPIvFXrwkk5U5HEGb731gkpyIm7<\/span>\"\n  \"<span class=sf-dump-key>_flash<\/span>\" => <span class=sf-dump-note>array:2<\/span> [<samp>\n    \"<span class=sf-dump-key>old<\/span>\" => []\n    \"<span class=sf-dump-key>new<\/span>\" => []\n  <\/samp>]\n  \"<span class=sf-dump-key>_previous<\/span>\" => <span class=sf-dump-note>array:1<\/span> [<samp>\n    \"<span class=sf-dump-key>url<\/span>\" => \"<span class=sf-dump-str title=\"31 characters\">http:\/\/127.0.0.1:8000\/structure<\/span>\"\n  <\/samp>]\n  \"<span class=sf-dump-key>login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d<\/span>\" => <span class=sf-dump-num>1<\/span>\n  \"<span class=sf-dump-key>PHPDEBUGBAR_STACK_DATA<\/span>\" => []\n<\/samp>]\n<\/pre><script>Sfdump(\"sf-dump-277628866\", {\"maxDepth\":0})<\/script>\n"}}, "X91df36ffc3329048a3cd771e30a6b656");

</script><div class="phpdebugbar phpdebugbar-minimized phpdebugbar-closed"><div class="phpdebugbar-drag-capture"></div><div class="phpdebugbar-resize-handle" style="display: none;"></div><div class="phpdebugbar-header" style="display: none;"><div class="phpdebugbar-header-left"><a class="phpdebugbar-tab"><i class="phpdebugbar-fa phpdebugbar-fa-list-alt"></i><span class="phpdebugbar-text">Messages</span><span class="phpdebugbar-badge"></span></a><a class="phpdebugbar-tab"><i class="phpdebugbar-fa phpdebugbar-fa-tasks"></i><span class="phpdebugbar-text">Timeline</span><span class="phpdebugbar-badge"></span></a><a class="phpdebugbar-tab"><i class="phpdebugbar-fa phpdebugbar-fa-bug"></i><span class="phpdebugbar-text">Exceptions</span><span class="phpdebugbar-badge"></span></a><a class="phpdebugbar-tab"><i class="phpdebugbar-fa phpdebugbar-fa-leaf"></i><span class="phpdebugbar-text">Views</span><span class="phpdebugbar-badge phpdebugbar-visible">0</span></a><a class="phpdebugbar-tab"><i class="phpdebugbar-fa phpdebugbar-fa-share"></i><span class="phpdebugbar-text">Route</span><span class="phpdebugbar-badge"></span></a><a class="phpdebugbar-tab"><i class="phpdebugbar-fa phpdebugbar-fa-database"></i><span class="phpdebugbar-text">Queries</span><span class="phpdebugbar-badge phpdebugbar-visible">2</span></a><a class="phpdebugbar-tab"><i class="phpdebugbar-fa phpdebugbar-fa-cubes"></i><span class="phpdebugbar-text">Models</span><span class="phpdebugbar-badge phpdebugbar-visible">1</span></a><a class="phpdebugbar-tab"><i class="phpdebugbar-fa phpdebugbar-fa-inbox"></i><span class="phpdebugbar-text">Mails</span><span class="phpdebugbar-badge"></span></a><a class="phpdebugbar-tab"><i class="phpdebugbar-fa phpdebugbar-fa-list-alt"></i><span class="phpdebugbar-text">Gate</span><span class="phpdebugbar-badge">11</span></a><a class="phpdebugbar-tab"><i class="phpdebugbar-fa phpdebugbar-fa-archive"></i><span class="phpdebugbar-text">Session</span><span class="phpdebugbar-badge"></span></a><a class="phpdebugbar-tab"><i class="phpdebugbar-fa phpdebugbar-fa-tags"></i><span class="phpdebugbar-text">Request</span><span class="phpdebugbar-badge"></span></a></div><div class="phpdebugbar-header-right"><a class="phpdebugbar-close-btn"></a><a class="phpdebugbar-minimize-btn"></a><a class="phpdebugbar-maximize-btn"></a><a class="phpdebugbar-open-btn" style=""></a><select class="phpdebugbar-datasets-switcher" style="display: block;"><option value="X91df36ffc3329048a3cd771e30a6b656">#1 structure (13:26:01)</option><option value="X68dacb7d7ca31d70517c642bd929680b">#2 received (ajax) (13:26:02)</option></select><span class="phpdebugbar-indicator"><i class="phpdebugbar-fa phpdebugbar-fa-code"></i><span class="phpdebugbar-text">7.4.5</span><span class="phpdebugbar-tooltip">PHP Version</span></span><span class="phpdebugbar-indicator"><i class="phpdebugbar-fa phpdebugbar-fa-clock-o"></i><span class="phpdebugbar-text">161ms</span><span class="phpdebugbar-tooltip">Request Duration</span></span><span class="phpdebugbar-indicator"><i class="phpdebugbar-fa phpdebugbar-fa-cogs"></i><span class="phpdebugbar-text">20MB</span><span class="phpdebugbar-tooltip">Memory Usage</span></span><span class="phpdebugbar-indicator"><i class="phpdebugbar-fa phpdebugbar-fa-share"></i><span class="phpdebugbar-text">GET referrals/patients/received</span><span class="phpdebugbar-tooltip">Route</span></span></div></div><div class="phpdebugbar-body" style="height: 40px; display: none;"><div class="phpdebugbar-panel"><div class="phpdebugbar-widgets-messages"><ul class="phpdebugbar-widgets-list"></ul><div class="phpdebugbar-widgets-toolbar"><i class="phpdebugbar-fa phpdebugbar-fa-search"></i><input type="text"></div></div></div><div class="phpdebugbar-panel"><ul class="phpdebugbar-widgets-timeline"><li><div class="phpdebugbar-widgets-measure"><span class="phpdebugbar-widgets-value" style="left: 0%; width: 64.24%;"></span><span class="phpdebugbar-widgets-label">Booting (104ms)</span></div></li><li><div class="phpdebugbar-widgets-measure"><span class="phpdebugbar-widgets-value" style="left: 65.46%; width: 34.54%;"></span><span class="phpdebugbar-widgets-label">Application (55.7ms)</span></div></li><li><table style="display: table; border: 0; width: 99%" class="phpdebugbar-widgets-params"><tr><td class="phpdebugbar-widgets-name">1 x Booting (64.24%)</td><td class="phpdebugbar-widgets-value"><div class="phpdebugbar-widgets-measure"><span class="phpdebugbar-widgets-value" style="width:64.24%"></span><span class="phpdebugbar-widgets-label">103.60ms</span></div></td></tr><tr><td class="phpdebugbar-widgets-name">1 x Application (34.54%)</td><td class="phpdebugbar-widgets-value"><div class="phpdebugbar-widgets-measure"><span class="phpdebugbar-widgets-value" style="width:34.54%"></span><span class="phpdebugbar-widgets-label">55.70ms</span></div></td></tr></table></li></ul></div><div class="phpdebugbar-panel"><div class="phpdebugbar-widgets-exceptions"><ul class="phpdebugbar-widgets-list"></ul></div></div><div class="phpdebugbar-panel"><div class="phpdebugbar-widgets-templates"><div class="phpdebugbar-widgets-status"><span>0 templates were rendered</span></div><ul class="phpdebugbar-widgets-list"></ul><div class="phpdebugbar-widgets-callgraph"></div></div></div><div class="phpdebugbar-panel"><dl class="phpdebugbar-widgets-kvlist phpdebugbar-widgets-varlist"><dt class="phpdebugbar-widgets-key"><span title="uri">uri</span></dt><dd class="phpdebugbar-widgets-value">GET referrals/patients/received</dd><dt class="phpdebugbar-widgets-key"><span title="middleware">middleware</span></dt><dd class="phpdebugbar-widgets-value">web, auth</dd><dt class="phpdebugbar-widgets-key"><span title="controller">controller</span></dt><dd class="phpdebugbar-widgets-value">App\Http\Controllers\ReferralController@receivedIndex</dd><dt class="phpdebugbar-widgets-key"><span title="namespace">namespace</span></dt><dd class="phpdebugbar-widgets-value">App\Http\Controllers</dd><dt class="phpdebugbar-widgets-key"><span title="prefix">prefix</span></dt><dd class="phpdebugbar-widgets-value"></dd><dt class="phpdebugbar-widgets-key"><span title="where">where</span></dt><dd class="phpdebugbar-widgets-value"></dd><dt class="phpdebugbar-widgets-key"><span title="as">as</span></dt><dd class="phpdebugbar-widgets-value">referrals.patients.received</dd><dt class="phpdebugbar-widgets-key"><span title="file">file</span></dt><dd class="phpdebugbar-widgets-value">\app\Http\Controllers\ReferralController.php:36-49</dd></dl></div><div class="phpdebugbar-panel"><div class="phpdebugbar-widgets-sqlqueries"><div class="phpdebugbar-widgets-status"><span>2 statements were executed</span><span title="Accumulated duration" class="phpdebugbar-widgets-duration">13.19ms</span></div><div class="phpdebugbar-widgets-toolbar"><a class="phpdebugbar-widgets-filter" rel="medex_db">medex_db</a></div><ul class="phpdebugbar-widgets-list"><li class="phpdebugbar-widgets-list-item" connection="medex_db" style="cursor: pointer;"><code class="phpdebugbar-widgets-sql"><span class="hljs-operator"><span class="hljs-keyword">select</span> * <span class="hljs-keyword">from</span> <span class="hljs-string">`users`</span> <span class="hljs-keyword">where</span> <span class="hljs-string">`id`</span> = <span class="hljs-number">1</span> limit <span class="hljs-number">1</span></span></code><span title="Duration" class="phpdebugbar-widgets-duration">12.63ms</span><span title="Prepared statement ID" class="phpdebugbar-widgets-stmt-id">\vendor\laravel\framework\src\Illuminate\Auth\EloquentUserProvider.php:52</span><span title="Connection" class="phpdebugbar-widgets-database">medex_db</span><table class="phpdebugbar-widgets-params"><tbody><tr><th colspan="2">Metadata</th></tr><tr><td class="phpdebugbar-widgets-name">Bindings <i class="phpdebugbar-fa phpdebugbar-fa-thumb-tack phpdebugbar-text-muted"></i></td><td class="phpdebugbar-widgets-value"><ul class="phpdebugbar-widgets-table-list"><li class="phpdebugbar-widgets-table-list-item"><span class="phpdebugbar-text-muted">0.</span>&nbsp;1</li></ul></td></tr><tr><td class="phpdebugbar-widgets-name">Backtrace <i class="phpdebugbar-fa phpdebugbar-fa-list-ul phpdebugbar-text-muted"></i></td><td class="phpdebugbar-widgets-value"><ul class="phpdebugbar-widgets-table-list"><li class="phpdebugbar-widgets-table-list-item"><span class="phpdebugbar-text-muted">15.</span>&nbsp;\vendor\laravel\framework\src\Illuminate\Auth\EloquentUserProvider.php<span class="phpdebugbar-text-muted">:52</span></li><li class="phpdebugbar-widgets-table-list-item"><span class="phpdebugbar-text-muted">16.</span>&nbsp;\vendor\laravel\framework\src\Illuminate\Auth\SessionGuard.php<span class="phpdebugbar-text-muted">:139</span></li><li class="phpdebugbar-widgets-table-list-item"><span class="phpdebugbar-text-muted">17.</span>&nbsp;\vendor\laravel\framework\src\Illuminate\Auth\GuardHelpers.php<span class="phpdebugbar-text-muted">:60</span></li><li class="phpdebugbar-widgets-table-list-item"><span class="phpdebugbar-text-muted">18.</span>&nbsp;middleware::auth<span class="phpdebugbar-text-muted">:63</span></li><li class="phpdebugbar-widgets-table-list-item"><span class="phpdebugbar-text-muted">19.</span>&nbsp;middleware::auth<span class="phpdebugbar-text-muted">:42</span></li></ul></td></tr></tbody></table></li><li class="phpdebugbar-widgets-list-item" connection="medex_db" style="cursor: pointer;"><code class="phpdebugbar-widgets-sql"><span class="hljs-operator"><span class="hljs-keyword">select</span> * <span class="hljs-keyword">from</span> <span class="hljs-string">`referrals`</span> <span class="hljs-keyword">where</span> <span class="hljs-string">`referrals`</span>.<span class="hljs-string">`receiver_id`</span> = <span class="hljs-number">1</span> <span class="hljs-keyword">and</span> <span class="hljs-string">`referrals`</span>.<span class="hljs-string">`receiver_id`</span> <span class="hljs-keyword">is</span> <span class="hljs-keyword">not</span> <span class="hljs-keyword">null</span> <span class="hljs-keyword">order</span> <span class="hljs-keyword">by</span> <span class="hljs-string">`opened_at`</span> <span class="hljs-keyword">asc</span> limit <span class="hljs-number">20</span></span></code><span title="Duration" class="phpdebugbar-widgets-duration">560μs</span><span title="Prepared statement ID" class="phpdebugbar-widgets-stmt-id">\app\Http\Controllers\ReferralController.php:39</span><span title="Connection" class="phpdebugbar-widgets-database">medex_db</span><table class="phpdebugbar-widgets-params"><tbody><tr><th colspan="2">Metadata</th></tr><tr><td class="phpdebugbar-widgets-name">Bindings <i class="phpdebugbar-fa phpdebugbar-fa-thumb-tack phpdebugbar-text-muted"></i></td><td class="phpdebugbar-widgets-value"><ul class="phpdebugbar-widgets-table-list"><li class="phpdebugbar-widgets-table-list-item"><span class="phpdebugbar-text-muted">0.</span>&nbsp;1</li></ul></td></tr><tr><td class="phpdebugbar-widgets-name">Backtrace <i class="phpdebugbar-fa phpdebugbar-fa-list-ul phpdebugbar-text-muted"></i></td><td class="phpdebugbar-widgets-value"><ul class="phpdebugbar-widgets-table-list"><li class="phpdebugbar-widgets-table-list-item"><span class="phpdebugbar-text-muted">15.</span>&nbsp;\app\Http\Controllers\ReferralController.php<span class="phpdebugbar-text-muted">:39</span></li><li class="phpdebugbar-widgets-table-list-item"><span class="phpdebugbar-text-muted">16.</span>&nbsp;\vendor\laravel\framework\src\Illuminate\Routing\Controller.php<span class="phpdebugbar-text-muted">:54</span></li><li class="phpdebugbar-widgets-table-list-item"><span class="phpdebugbar-text-muted">17.</span>&nbsp;\vendor\laravel\framework\src\Illuminate\Routing\ControllerDispatcher.php<span class="phpdebugbar-text-muted">:45</span></li><li class="phpdebugbar-widgets-table-list-item"><span class="phpdebugbar-text-muted">18.</span>&nbsp;\vendor\laravel\framework\src\Illuminate\Routing\Route.php<span class="phpdebugbar-text-muted">:239</span></li><li class="phpdebugbar-widgets-table-list-item"><span class="phpdebugbar-text-muted">19.</span>&nbsp;\vendor\laravel\framework\src\Illuminate\Routing\Route.php<span class="phpdebugbar-text-muted">:196</span></li></ul></td></tr></tbody></table></li></ul></div></div><div class="phpdebugbar-panel"><dl class="phpdebugbar-widgets-kvlist phpdebugbar-widgets-htmlvarlist"><dt class="phpdebugbar-widgets-key"><span title="App\Models\User">App\Models\User</span></dt><dd class="phpdebugbar-widgets-value">1</dd></dl></div><div class="phpdebugbar-panel"><div class="phpdebugbar-widgets-mails"><ul class="phpdebugbar-widgets-list"></ul></div></div><div class="phpdebugbar-panel"><div class="phpdebugbar-widgets-messages"><ul class="phpdebugbar-widgets-list"></ul><div class="phpdebugbar-widgets-toolbar"><i class="phpdebugbar-fa phpdebugbar-fa-search"></i><input type="text"></div></div></div><div class="phpdebugbar-panel"><dl class="phpdebugbar-widgets-kvlist phpdebugbar-widgets-varlist"><dt class="phpdebugbar-widgets-key"><span title="_token">_token</span></dt><dd class="phpdebugbar-widgets-value">OlSBqeF5JQKyVKPIvFXrwkk5U5HEGb731gkpyIm7</dd><dt class="phpdebugbar-widgets-key"><span title="_flash">_flash</span></dt><dd class="phpdebugbar-widgets-value">array:2 [
  "old" =&gt; []
  "new" =&gt; []
]</dd><dt class="phpdebugbar-widgets-key"><span title="_previous">_previous</span></dt><dd class="phpdebugbar-widgets-value">array:1 [
  "url" =&gt; "http://127.0.0.1:8000/structure"
]</dd><dt class="phpdebugbar-widgets-key"><span title="login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d">login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d</span></dt><dd class="phpdebugbar-widgets-value">1</dd></dl></div><div class="phpdebugbar-panel"><dl class="phpdebugbar-widgets-kvlist phpdebugbar-widgets-htmlvarlist"><dt class="phpdebugbar-widgets-key"><span title="path_info">path_info</span></dt><dd class="phpdebugbar-widgets-value">/referrals/patients/received</dd><dt class="phpdebugbar-widgets-key"><span title="status_code">status_code</span></dt><dd class="phpdebugbar-widgets-value"><pre class="sf-dump" id="sf-dump-2137659767" data-indent-pad="  "><span class="sf-dump-num">200</span>
</pre><script>Sfdump("sf-dump-2137659767", {"maxDepth":0})</script>
</dd><dt class="phpdebugbar-widgets-key"><span title="status_text">status_text</span></dt><dd class="phpdebugbar-widgets-value">OK</dd><dt class="phpdebugbar-widgets-key"><span title="format">format</span></dt><dd class="phpdebugbar-widgets-value">html</dd><dt class="phpdebugbar-widgets-key"><span title="content_type">content_type</span></dt><dd class="phpdebugbar-widgets-value">application/json</dd><dt class="phpdebugbar-widgets-key"><span title="request_query">request_query</span></dt><dd class="phpdebugbar-widgets-value"><pre class="sf-dump" id="sf-dump-1944120752" data-indent-pad="  ">[]
</pre><script>Sfdump("sf-dump-1944120752", {"maxDepth":0})</script>
</dd><dt class="phpdebugbar-widgets-key"><span title="request_request">request_request</span></dt><dd class="phpdebugbar-widgets-value"><pre class="sf-dump" id="sf-dump-198991912" data-indent-pad="  ">[]
</pre><script>Sfdump("sf-dump-198991912", {"maxDepth":0})</script>
</dd><dt class="phpdebugbar-widgets-key"><span title="request_headers">request_headers</span></dt><dd class="phpdebugbar-widgets-value"><pre class="sf-dump" id="sf-dump-1933959226" data-indent-pad="  " tabindex="0"><div class="sf-dump-search-wrapper sf-dump-search-hidden"> <input type="text" class="sf-dump-search-input"> <span class="sf-dump-search-count">0 of 0</span> <button type="button" class="sf-dump-search-input-previous" tabindex="-1"> <svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1683 1331l-166 165q-19 19-45 19t-45-19L896 965l-531 531q-19 19-45 19t-45-19l-166-165q-19-19-19-45.5t19-45.5l742-741q19-19 45-19t45 19l742 741q19 19 19 45.5t-19 45.5z"></path></svg> </button> <button type="button" class="sf-dump-search-input-next" tabindex="-1"> <svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1683 808l-742 741q-19 19-45 19t-45-19L109 808q-19-19-19-45.5t19-45.5l166-165q19-19 45-19t45 19l531 531 531-531q19-19 45-19t45 19l166 165q19 19 19 45.5t-19 45.5z"></path></svg> </button> </div><span class="sf-dump-note">array:13</span> [<a class="sf-dump-ref sf-dump-toggle" title="[Ctrl+click] Expand all children"><span>▶</span></a><samp data-depth="1" class="sf-dump-compact">
  "<span class="sf-dump-key">host</span>" =&gt; <span class="sf-dump-note">array:1</span> [<a class="sf-dump-ref sf-dump-toggle" title="[Ctrl+click] Expand all children"><span>▶</span></a><samp data-depth="2" class="sf-dump-compact">
    <span class="sf-dump-index">0</span> =&gt; "<span class="sf-dump-str" title="14 characters">127.0.0.1:8000</span>"
  </samp>]
  "<span class="sf-dump-key">connection</span>" =&gt; <span class="sf-dump-note">array:1</span> [<a class="sf-dump-ref sf-dump-toggle" title="[Ctrl+click] Expand all children"><span>▶</span></a><samp data-depth="2" class="sf-dump-compact">
    <span class="sf-dump-index">0</span> =&gt; "<span class="sf-dump-str" title="10 characters">keep-alive</span>"
  </samp>]
  "<span class="sf-dump-key">x-requested-with</span>" =&gt; <span class="sf-dump-note">array:1</span> [<a class="sf-dump-ref sf-dump-toggle" title="[Ctrl+click] Expand all children"><span>▶</span></a><samp data-depth="2" class="sf-dump-compact">
    <span class="sf-dump-index">0</span> =&gt; "<span class="sf-dump-str" title="14 characters">XMLHttpRequest</span>"
  </samp>]
  "<span class="sf-dump-key">user-agent</span>" =&gt; <span class="sf-dump-note">array:1</span> [<a class="sf-dump-ref sf-dump-toggle" title="[Ctrl+click] Expand all children"><span>▶</span></a><samp data-depth="2" class="sf-dump-compact">
    <span class="sf-dump-index">0</span> =&gt; "<span class="sf-dump-str" title="114 characters">Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36</span>"
  </samp>]
  "<span class="sf-dump-key">x-csrf-token</span>" =&gt; <span class="sf-dump-note">array:1</span> [<a class="sf-dump-ref sf-dump-toggle" title="[Ctrl+click] Expand all children"><span>▶</span></a><samp data-depth="2" class="sf-dump-compact">
    <span class="sf-dump-index">0</span> =&gt; "<span class="sf-dump-str" title="40 characters">OlSBqeF5JQKyVKPIvFXrwkk5U5HEGb731gkpyIm7</span>"
  </samp>]
  "<span class="sf-dump-key">accept</span>" =&gt; <span class="sf-dump-note">array:1</span> [<a class="sf-dump-ref sf-dump-toggle" title="[Ctrl+click] Expand all children"><span>▶</span></a><samp data-depth="2" class="sf-dump-compact">
    <span class="sf-dump-index">0</span> =&gt; "<span class="sf-dump-str" title="3 characters">*/*</span>"
  </samp>]
  "<span class="sf-dump-key">sec-fetch-site</span>" =&gt; <span class="sf-dump-note">array:1</span> [<a class="sf-dump-ref sf-dump-toggle" title="[Ctrl+click] Expand all children"><span>▶</span></a><samp data-depth="2" class="sf-dump-compact">
    <span class="sf-dump-index">0</span> =&gt; "<span class="sf-dump-str" title="11 characters">same-origin</span>"
  </samp>]
  "<span class="sf-dump-key">sec-fetch-mode</span>" =&gt; <span class="sf-dump-note">array:1</span> [<a class="sf-dump-ref sf-dump-toggle" title="[Ctrl+click] Expand all children"><span>▶</span></a><samp data-depth="2" class="sf-dump-compact">
    <span class="sf-dump-index">0</span> =&gt; "<span class="sf-dump-str" title="4 characters">cors</span>"
  </samp>]
  "<span class="sf-dump-key">sec-fetch-dest</span>" =&gt; <span class="sf-dump-note">array:1</span> [<a class="sf-dump-ref sf-dump-toggle" title="[Ctrl+click] Expand all children"><span>▶</span></a><samp data-depth="2" class="sf-dump-compact">
    <span class="sf-dump-index">0</span> =&gt; "<span class="sf-dump-str" title="5 characters">empty</span>"
  </samp>]
  "<span class="sf-dump-key">referer</span>" =&gt; <span class="sf-dump-note">array:1</span> [<a class="sf-dump-ref sf-dump-toggle" title="[Ctrl+click] Expand all children"><span>▶</span></a><samp data-depth="2" class="sf-dump-compact">
    <span class="sf-dump-index">0</span> =&gt; "<span class="sf-dump-str" title="31 characters">http://127.0.0.1:8000/structure</span>"
  </samp>]
  "<span class="sf-dump-key">accept-encoding</span>" =&gt; <span class="sf-dump-note">array:1</span> [<a class="sf-dump-ref sf-dump-toggle" title="[Ctrl+click] Expand all children"><span>▶</span></a><samp data-depth="2" class="sf-dump-compact">
    <span class="sf-dump-index">0</span> =&gt; "<span class="sf-dump-str" title="17 characters">gzip, deflate, br</span>"
  </samp>]
  "<span class="sf-dump-key">accept-language</span>" =&gt; <span class="sf-dump-note">array:1</span> [<a class="sf-dump-ref sf-dump-toggle" title="[Ctrl+click] Expand all children"><span>▶</span></a><samp data-depth="2" class="sf-dump-compact">
    <span class="sf-dump-index">0</span> =&gt; "<span class="sf-dump-str" title="35 characters">ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7</span>"
  </samp>]
  "<span class="sf-dump-key">cookie</span>" =&gt; <span class="sf-dump-note">array:1</span> [<a class="sf-dump-ref sf-dump-toggle" title="[Ctrl+click] Expand all children"><span>▶</span></a><samp data-depth="2" class="sf-dump-compact">
    <span class="sf-dump-index">0</span> =&gt; "<span class="sf-dump-str sf-dump-str-collapse" title="691 characters"><span class="sf-dump-str-collapse">XSRF-TOKEN=eyJpdiI6IjVLenFhbGsvTDI0NUE2TlM5Q2tkS0E9PSIsInZhbHVlIjoiWnQybXdLZE53Z0hTTjdYNkpnbWhld1ZGbEFnbitDdkZ4SW9pRjkwU0xLUnFrT2I0eTVhUDBYalhMcDYyN0Y0Y3l2WU8wUlN3K2ZVTlo3TTNOc3BxTk5JVnlQS1lKT2hsSVc4WWN2ck1JM0xtelZXa203d2k0QSt5NlAzNUNNdngiLCJtYWMiOiJiZjFjZDlmNzFiOTRhMDg2ZTk1ZDQwODY4ZmZlNDdiZTYzZmE2OGI3YWZkOTc2MTdhNjU5NmE1OWUyY2I3OWNjIn0%3D; medexrepo_session=eyJpdiI6ImR0eGxsNEcwWm9YQXpWMXF0Z29mYnc9PSIsInZhbHVlIjoiMDdQeGREcnd6MFZQRTFPR0grZDdtQWtOVmhtT3ZpUm0yYS90aTdpdUxGMWovdGJqTk9nMm1pYkd2WUt2N3hTaDBBcXZQWHRtV2FIS1l5ZGQrYWNTZ0MycmJ2bGdOdzZ5MzRTdjA3c2NTZVR0WlVRT0wyVFVDNDJhYnlVY0MzdlIiLCJtYWMiOiJhMmZkZWMzZDhmMTQzMzkzZTQ3OTYxNDY0YjI3ZjY4ZmViMDYyOTg2NWZkODc2NDc5NTU5OWNhZGFhYjBhZDk4In0%3D<a class="sf-dump-ref sf-dump-str-toggle" title="Collapse"> ◀</a></span><span class="sf-dump-str-expand">XSRF-TOKEN=eyJpdiI6IjVLenFhbGsvTDI0NUE2TlM5Q2tkS0E9PSIsInZhbHVlIjoiWnQybXdLZE53Z0hTTjdYNkpnbWhld1ZGbEFnbitDdkZ4SW9pRjkwU0xLUnFrT2I0eTVhUDBYalhMcDYyN0Y0Y3l2WU8wU<a class="sf-dump-ref sf-dump-str-toggle" title="531 remaining characters"> ▶</a></span></span>"
  </samp>]
</samp>]
</pre><script>Sfdump("sf-dump-1933959226", {"maxDepth":0})</script>
</dd><dt class="phpdebugbar-widgets-key"><span title="request_server">request_server</span></dt><dd class="phpdebugbar-widgets-value"><pre class="sf-dump" id="sf-dump-273831327" data-indent-pad="  " tabindex="0"><div class="sf-dump-search-wrapper sf-dump-search-hidden"> <input type="text" class="sf-dump-search-input"> <span class="sf-dump-search-count">0 of 0</span> <button type="button" class="sf-dump-search-input-previous" tabindex="-1"> <svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1683 1331l-166 165q-19 19-45 19t-45-19L896 965l-531 531q-19 19-45 19t-45-19l-166-165q-19-19-19-45.5t19-45.5l742-741q19-19 45-19t45 19l742 741q19 19 19 45.5t-19 45.5z"></path></svg> </button> <button type="button" class="sf-dump-search-input-next" tabindex="-1"> <svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1683 808l-742 741q-19 19-45 19t-45-19L109 808q-19-19-19-45.5t19-45.5l166-165q19-19 45-19t45 19l531 531 531-531q19-19 45-19t45 19l166 165q19 19 19 45.5t-19 45.5z"></path></svg> </button> </div><span class="sf-dump-note">array:30</span> [<a class="sf-dump-ref sf-dump-toggle" title="[Ctrl+click] Expand all children"><span>▶</span></a><samp data-depth="1" class="sf-dump-compact">
  "<span class="sf-dump-key">DOCUMENT_ROOT</span>" =&gt; "<span class="sf-dump-str" title="38 characters">C:\OpenServer\domains\medexrepo\public</span>"
  "<span class="sf-dump-key">REMOTE_ADDR</span>" =&gt; "<span class="sf-dump-str" title="9 characters">127.0.0.1</span>"
  "<span class="sf-dump-key">REMOTE_PORT</span>" =&gt; "<span class="sf-dump-str" title="5 characters">54989</span>"
  "<span class="sf-dump-key">SERVER_SOFTWARE</span>" =&gt; "<span class="sf-dump-str" title="28 characters">PHP 7.4.5 Development Server</span>"
  "<span class="sf-dump-key">SERVER_PROTOCOL</span>" =&gt; "<span class="sf-dump-str" title="8 characters">HTTP/1.1</span>"
  "<span class="sf-dump-key">SERVER_NAME</span>" =&gt; "<span class="sf-dump-str" title="9 characters">127.0.0.1</span>"
  "<span class="sf-dump-key">SERVER_PORT</span>" =&gt; "<span class="sf-dump-str" title="4 characters">8000</span>"
  "<span class="sf-dump-key">REQUEST_URI</span>" =&gt; "<span class="sf-dump-str" title="28 characters">/referrals/patients/received</span>"
  "<span class="sf-dump-key">REQUEST_METHOD</span>" =&gt; "<span class="sf-dump-str" title="3 characters">GET</span>"
  "<span class="sf-dump-key">SCRIPT_NAME</span>" =&gt; "<span class="sf-dump-str" title="10 characters">/index.php</span>"
  "<span class="sf-dump-key">SCRIPT_FILENAME</span>" =&gt; "<span class="sf-dump-str" title="48 characters">C:\OpenServer\domains\medexrepo\public\index.php</span>"
  "<span class="sf-dump-key">PATH_INFO</span>" =&gt; "<span class="sf-dump-str" title="28 characters">/referrals/patients/received</span>"
  "<span class="sf-dump-key">PHP_SELF</span>" =&gt; "<span class="sf-dump-str" title="38 characters">/index.php/referrals/patients/received</span>"
  "<span class="sf-dump-key">HTTP_HOST</span>" =&gt; "<span class="sf-dump-str" title="14 characters">127.0.0.1:8000</span>"
  "<span class="sf-dump-key">HTTP_CONNECTION</span>" =&gt; "<span class="sf-dump-str" title="10 characters">keep-alive</span>"
  "<span class="sf-dump-key">HTTP_X_REQUESTED_WITH</span>" =&gt; "<span class="sf-dump-str" title="14 characters">XMLHttpRequest</span>"
  "<span class="sf-dump-key">HTTP_USER_AGENT</span>" =&gt; "<span class="sf-dump-str" title="114 characters">Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36</span>"
  "<span class="sf-dump-key">HTTP_X_CSRF_TOKEN</span>" =&gt; "<span class="sf-dump-str" title="40 characters">OlSBqeF5JQKyVKPIvFXrwkk5U5HEGb731gkpyIm7</span>"
  "<span class="sf-dump-key">HTTP_ACCEPT</span>" =&gt; "<span class="sf-dump-str" title="3 characters">*/*</span>"
  "<span class="sf-dump-key">HTTP_SEC_FETCH_SITE</span>" =&gt; "<span class="sf-dump-str" title="11 characters">same-origin</span>"
  "<span class="sf-dump-key">HTTP_SEC_FETCH_MODE</span>" =&gt; "<span class="sf-dump-str" title="4 characters">cors</span>"
  "<span class="sf-dump-key">HTTP_SEC_FETCH_DEST</span>" =&gt; "<span class="sf-dump-str" title="5 characters">empty</span>"
  "<span class="sf-dump-key">HTTP_REFERER</span>" =&gt; "<span class="sf-dump-str" title="31 characters">http://127.0.0.1:8000/structure</span>"
  "<span class="sf-dump-key">HTTP_ACCEPT_ENCODING</span>" =&gt; "<span class="sf-dump-str" title="17 characters">gzip, deflate, br</span>"
  "<span class="sf-dump-key">HTTP_ACCEPT_LANGUAGE</span>" =&gt; "<span class="sf-dump-str" title="35 characters">ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7</span>"
  "<span class="sf-dump-key">HTTP_COOKIE</span>" =&gt; "<span class="sf-dump-str sf-dump-str-collapse" title="691 characters"><span class="sf-dump-str-collapse">XSRF-TOKEN=eyJpdiI6IjVLenFhbGsvTDI0NUE2TlM5Q2tkS0E9PSIsInZhbHVlIjoiWnQybXdLZE53Z0hTTjdYNkpnbWhld1ZGbEFnbitDdkZ4SW9pRjkwU0xLUnFrT2I0eTVhUDBYalhMcDYyN0Y0Y3l2WU8wUlN3K2ZVTlo3TTNOc3BxTk5JVnlQS1lKT2hsSVc4WWN2ck1JM0xtelZXa203d2k0QSt5NlAzNUNNdngiLCJtYWMiOiJiZjFjZDlmNzFiOTRhMDg2ZTk1ZDQwODY4ZmZlNDdiZTYzZmE2OGI3YWZkOTc2MTdhNjU5NmE1OWUyY2I3OWNjIn0%3D; medexrepo_session=eyJpdiI6ImR0eGxsNEcwWm9YQXpWMXF0Z29mYnc9PSIsInZhbHVlIjoiMDdQeGREcnd6MFZQRTFPR0grZDdtQWtOVmhtT3ZpUm0yYS90aTdpdUxGMWovdGJqTk9nMm1pYkd2WUt2N3hTaDBBcXZQWHRtV2FIS1l5ZGQrYWNTZ0MycmJ2bGdOdzZ5MzRTdjA3c2NTZVR0WlVRT0wyVFVDNDJhYnlVY0MzdlIiLCJtYWMiOiJhMmZkZWMzZDhmMTQzMzkzZTQ3OTYxNDY0YjI3ZjY4ZmViMDYyOTg2NWZkODc2NDc5NTU5OWNhZGFhYjBhZDk4In0%3D<a class="sf-dump-ref sf-dump-str-toggle" title="Collapse"> ◀</a></span><span class="sf-dump-str-expand">XSRF-TOKEN=eyJpdiI6IjVLenFhbGsvTDI0NUE2TlM5Q2tkS0E9PSIsInZhbHVlIjoiWnQybXdLZE53Z0hTTjdYNkpnbWhld1ZGbEFnbitDdkZ4SW9pRjkwU0xLUnFrT2I0eTVhUDBYalhMcDYyN0Y0Y3l2WU8wU<a class="sf-dump-ref sf-dump-str-toggle" title="531 remaining characters"> ▶</a></span></span>"
  "<span class="sf-dump-key">REQUEST_TIME_FLOAT</span>" =&gt; <span class="sf-dump-num">1607937962.1922</span>
  "<span class="sf-dump-key">REQUEST_TIME</span>" =&gt; <span class="sf-dump-num">1607937962</span>
  "<span class="sf-dump-key">argv</span>" =&gt; []
  "<span class="sf-dump-key">argc</span>" =&gt; <span class="sf-dump-num">0</span>
</samp>]
</pre><script>Sfdump("sf-dump-273831327", {"maxDepth":0})</script>
</dd><dt class="phpdebugbar-widgets-key"><span title="request_cookies">request_cookies</span></dt><dd class="phpdebugbar-widgets-value"><pre class="sf-dump" id="sf-dump-393138826" data-indent-pad="  " tabindex="0"><div class="sf-dump-search-wrapper sf-dump-search-hidden"> <input type="text" class="sf-dump-search-input"> <span class="sf-dump-search-count">0 of 0</span> <button type="button" class="sf-dump-search-input-previous" tabindex="-1"> <svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1683 1331l-166 165q-19 19-45 19t-45-19L896 965l-531 531q-19 19-45 19t-45-19l-166-165q-19-19-19-45.5t19-45.5l742-741q19-19 45-19t45 19l742 741q19 19 19 45.5t-19 45.5z"></path></svg> </button> <button type="button" class="sf-dump-search-input-next" tabindex="-1"> <svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1683 808l-742 741q-19 19-45 19t-45-19L109 808q-19-19-19-45.5t19-45.5l166-165q19-19 45-19t45 19l531 531 531-531q19-19 45-19t45 19l166 165q19 19 19 45.5t-19 45.5z"></path></svg> </button> </div><span class="sf-dump-note">array:2</span> [<a class="sf-dump-ref sf-dump-toggle" title="[Ctrl+click] Expand all children"><span>▶</span></a><samp data-depth="1" class="sf-dump-compact">
  "<span class="sf-dump-key">XSRF-TOKEN</span>" =&gt; "<span class="sf-dump-str" title="40 characters">OlSBqeF5JQKyVKPIvFXrwkk5U5HEGb731gkpyIm7</span>"
  "<span class="sf-dump-key">medexrepo_session</span>" =&gt; "<span class="sf-dump-str" title="40 characters">PZ047Y3MSR5v91Ha4maYZrrEkD5wGHeNpSIPWpe2</span>"
</samp>]
</pre><script>Sfdump("sf-dump-393138826", {"maxDepth":0})</script>
</dd><dt class="phpdebugbar-widgets-key"><span title="response_headers">response_headers</span></dt><dd class="phpdebugbar-widgets-value"><pre class="sf-dump" id="sf-dump-528811108" data-indent-pad="  " tabindex="0"><div class="sf-dump-search-wrapper sf-dump-search-hidden"> <input type="text" class="sf-dump-search-input"> <span class="sf-dump-search-count">0 of 0</span> <button type="button" class="sf-dump-search-input-previous" tabindex="-1"> <svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1683 1331l-166 165q-19 19-45 19t-45-19L896 965l-531 531q-19 19-45 19t-45-19l-166-165q-19-19-19-45.5t19-45.5l742-741q19-19 45-19t45 19l742 741q19 19 19 45.5t-19 45.5z"></path></svg> </button> <button type="button" class="sf-dump-search-input-next" tabindex="-1"> <svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1683 808l-742 741q-19 19-45 19t-45-19L109 808q-19-19-19-45.5t19-45.5l166-165q19-19 45-19t45 19l531 531 531-531q19-19 45-19t45 19l166 165q19 19 19 45.5t-19 45.5z"></path></svg> </button> </div><span class="sf-dump-note">array:5</span> [<a class="sf-dump-ref sf-dump-toggle" title="[Ctrl+click] Expand all children"><span>▶</span></a><samp data-depth="1" class="sf-dump-compact">
  "<span class="sf-dump-key">cache-control</span>" =&gt; <span class="sf-dump-note">array:1</span> [<a class="sf-dump-ref sf-dump-toggle" title="[Ctrl+click] Expand all children"><span>▶</span></a><samp data-depth="2" class="sf-dump-compact">
    <span class="sf-dump-index">0</span> =&gt; "<span class="sf-dump-str" title="17 characters">no-cache, private</span>"
  </samp>]
  "<span class="sf-dump-key">date</span>" =&gt; <span class="sf-dump-note">array:1</span> [<a class="sf-dump-ref sf-dump-toggle" title="[Ctrl+click] Expand all children"><span>▶</span></a><samp data-depth="2" class="sf-dump-compact">
    <span class="sf-dump-index">0</span> =&gt; "<span class="sf-dump-str" title="29 characters">Mon, 14 Dec 2020 09:26:02 GMT</span>"
  </samp>]
  "<span class="sf-dump-key">content-type</span>" =&gt; <span class="sf-dump-note">array:1</span> [<a class="sf-dump-ref sf-dump-toggle" title="[Ctrl+click] Expand all children"><span>▶</span></a><samp data-depth="2" class="sf-dump-compact">
    <span class="sf-dump-index">0</span> =&gt; "<span class="sf-dump-str" title="16 characters">application/json</span>"
  </samp>]
  "<span class="sf-dump-key">set-cookie</span>" =&gt; <span class="sf-dump-note">array:2</span> [<a class="sf-dump-ref sf-dump-toggle" title="[Ctrl+click] Expand all children"><span>▶</span></a><samp data-depth="2" class="sf-dump-compact">
    <span class="sf-dump-index">0</span> =&gt; "<span class="sf-dump-str sf-dump-str-collapse" title="416 characters"><span class="sf-dump-str-collapse">XSRF-TOKEN=eyJpdiI6IjVRRkpreVIzaDdrb0FXQXhqKzlhbkE9PSIsInZhbHVlIjoicTcxcHJrM2xNaE9EaUxWQ3UwcDVrK1F0TmJMdEtLV1RoTHdCaWt3b0Q4R1RVNzhuallORVpvWVZzenpBYi9Cdkw2Z3VSTkRBTDhHb0pWVVNGQ0xBaWMwWWRmaTRGeXoxbjM3UjFtNm53RVNhcDVBUlZHajlTTU5SdTNqWHZWU0EiLCJtYWMiOiJkNmM5NzUyYWNmYTkyNDdlNTc2YTVjOTk2MzA3ZDliZTQ0YTFjZGUzYjNhZmRjMzgxMTRkZDk4YzYxYjllNWY3In0%3D; expires=Mon, 14-Dec-2020 11:26:02 GMT; Max-Age=7200; path=/; samesite=lax<a class="sf-dump-ref sf-dump-str-toggle" title="Collapse"> ◀</a></span><span class="sf-dump-str-expand">XSRF-TOKEN=eyJpdiI6IjVRRkpreVIzaDdrb0FXQXhqKzlhbkE9PSIsInZhbHVlIjoicTcxcHJrM2xNaE9EaUxWQ3UwcDVrK1F0TmJMdEtLV1RoTHdCaWt3b0Q4R1RVNzhuallORVpvWVZzenpBYi9Cdkw2Z3VST<a class="sf-dump-ref sf-dump-str-toggle" title="256 remaining characters"> ▶</a></span></span>"
    <span class="sf-dump-index">1</span> =&gt; "<span class="sf-dump-str sf-dump-str-collapse" title="433 characters"><span class="sf-dump-str-collapse">medexrepo_session=eyJpdiI6Ik9GV2tTTWZMdGlPNllsMlRwb1k2QVE9PSIsInZhbHVlIjoiWFRPM0ZYd3NnVWY3ditDN1V6emFaMHpPWkZDdmZhZS9ZREpBemZlTzEzb0NDRVhRU1dyUURySUMyTDF1bGtTRHlwZVgwZWtELzhQN25kSERINlBQcGs1MllHMVppSHVWTFY1dGlBWVZ3U3VPbnJxcVN0cy8zTW95VE9GWklhcnIiLCJtYWMiOiIyYWUzYmQ0ZTI2Nzc1MmMwMjc5YTExZGU4MDc2NzM1ZmI5MWQ1M2NkOWViY2UzNWY4MWQxYWRhYjkzODZmMmY0In0%3D; expires=Mon, 14-Dec-2020 11:26:02 GMT; Max-Age=7200; path=/; httponly; samesite=lax<a class="sf-dump-ref sf-dump-str-toggle" title="Collapse"> ◀</a></span><span class="sf-dump-str-expand">medexrepo_session=eyJpdiI6Ik9GV2tTTWZMdGlPNllsMlRwb1k2QVE9PSIsInZhbHVlIjoiWFRPM0ZYd3NnVWY3ditDN1V6emFaMHpPWkZDdmZhZS9ZREpBemZlTzEzb0NDRVhRU1dyUURySUMyTDF1bGtTRH<a class="sf-dump-ref sf-dump-str-toggle" title="273 remaining characters"> ▶</a></span></span>"
  </samp>]
  "<span class="sf-dump-key">Set-Cookie</span>" =&gt; <span class="sf-dump-note">array:2</span> [<a class="sf-dump-ref sf-dump-toggle" title="[Ctrl+click] Expand all children"><span>▶</span></a><samp data-depth="2" class="sf-dump-compact">
    <span class="sf-dump-index">0</span> =&gt; "<span class="sf-dump-str sf-dump-str-collapse" title="388 characters"><span class="sf-dump-str-collapse">XSRF-TOKEN=eyJpdiI6IjVRRkpreVIzaDdrb0FXQXhqKzlhbkE9PSIsInZhbHVlIjoicTcxcHJrM2xNaE9EaUxWQ3UwcDVrK1F0TmJMdEtLV1RoTHdCaWt3b0Q4R1RVNzhuallORVpvWVZzenpBYi9Cdkw2Z3VSTkRBTDhHb0pWVVNGQ0xBaWMwWWRmaTRGeXoxbjM3UjFtNm53RVNhcDVBUlZHajlTTU5SdTNqWHZWU0EiLCJtYWMiOiJkNmM5NzUyYWNmYTkyNDdlNTc2YTVjOTk2MzA3ZDliZTQ0YTFjZGUzYjNhZmRjMzgxMTRkZDk4YzYxYjllNWY3In0%3D; expires=Mon, 14-Dec-2020 11:26:02 GMT; path=/<a class="sf-dump-ref sf-dump-str-toggle" title="Collapse"> ◀</a></span><span class="sf-dump-str-expand">XSRF-TOKEN=eyJpdiI6IjVRRkpreVIzaDdrb0FXQXhqKzlhbkE9PSIsInZhbHVlIjoicTcxcHJrM2xNaE9EaUxWQ3UwcDVrK1F0TmJMdEtLV1RoTHdCaWt3b0Q4R1RVNzhuallORVpvWVZzenpBYi9Cdkw2Z3VST<a class="sf-dump-ref sf-dump-str-toggle" title="228 remaining characters"> ▶</a></span></span>"
    <span class="sf-dump-index">1</span> =&gt; "<span class="sf-dump-str sf-dump-str-collapse" title="405 characters"><span class="sf-dump-str-collapse">medexrepo_session=eyJpdiI6Ik9GV2tTTWZMdGlPNllsMlRwb1k2QVE9PSIsInZhbHVlIjoiWFRPM0ZYd3NnVWY3ditDN1V6emFaMHpPWkZDdmZhZS9ZREpBemZlTzEzb0NDRVhRU1dyUURySUMyTDF1bGtTRHlwZVgwZWtELzhQN25kSERINlBQcGs1MllHMVppSHVWTFY1dGlBWVZ3U3VPbnJxcVN0cy8zTW95VE9GWklhcnIiLCJtYWMiOiIyYWUzYmQ0ZTI2Nzc1MmMwMjc5YTExZGU4MDc2NzM1ZmI5MWQ1M2NkOWViY2UzNWY4MWQxYWRhYjkzODZmMmY0In0%3D; expires=Mon, 14-Dec-2020 11:26:02 GMT; path=/; httponly<a class="sf-dump-ref sf-dump-str-toggle" title="Collapse"> ◀</a></span><span class="sf-dump-str-expand">medexrepo_session=eyJpdiI6Ik9GV2tTTWZMdGlPNllsMlRwb1k2QVE9PSIsInZhbHVlIjoiWFRPM0ZYd3NnVWY3ditDN1V6emFaMHpPWkZDdmZhZS9ZREpBemZlTzEzb0NDRVhRU1dyUURySUMyTDF1bGtTRH<a class="sf-dump-ref sf-dump-str-toggle" title="245 remaining characters"> ▶</a></span></span>"
  </samp>]
</samp>]
</pre><script>Sfdump("sf-dump-528811108", {"maxDepth":0})</script>
</dd><dt class="phpdebugbar-widgets-key"><span title="session_attributes">session_attributes</span></dt><dd class="phpdebugbar-widgets-value"><pre class="sf-dump" id="sf-dump-517717898" data-indent-pad="  " tabindex="0"><div class="sf-dump-search-wrapper sf-dump-search-hidden"> <input type="text" class="sf-dump-search-input"> <span class="sf-dump-search-count">0 of 0</span> <button type="button" class="sf-dump-search-input-previous" tabindex="-1"> <svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1683 1331l-166 165q-19 19-45 19t-45-19L896 965l-531 531q-19 19-45 19t-45-19l-166-165q-19-19-19-45.5t19-45.5l742-741q19-19 45-19t45 19l742 741q19 19 19 45.5t-19 45.5z"></path></svg> </button> <button type="button" class="sf-dump-search-input-next" tabindex="-1"> <svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1683 808l-742 741q-19 19-45 19t-45-19L109 808q-19-19-19-45.5t19-45.5l166-165q19-19 45-19t45 19l531 531 531-531q19-19 45-19t45 19l166 165q19 19 19 45.5t-19 45.5z"></path></svg> </button> </div><span class="sf-dump-note">array:4</span> [<a class="sf-dump-ref sf-dump-toggle" title="[Ctrl+click] Expand all children"><span>▶</span></a><samp data-depth="1" class="sf-dump-compact">
  "<span class="sf-dump-key">_token</span>" =&gt; "<span class="sf-dump-str" title="40 characters">OlSBqeF5JQKyVKPIvFXrwkk5U5HEGb731gkpyIm7</span>"
  "<span class="sf-dump-key">_flash</span>" =&gt; <span class="sf-dump-note">array:2</span> [<a class="sf-dump-ref sf-dump-toggle" title="[Ctrl+click] Expand all children"><span>▶</span></a><samp data-depth="2" class="sf-dump-compact">
    "<span class="sf-dump-key">old</span>" =&gt; []
    "<span class="sf-dump-key">new</span>" =&gt; []
  </samp>]
  "<span class="sf-dump-key">_previous</span>" =&gt; <span class="sf-dump-note">array:1</span> [<a class="sf-dump-ref sf-dump-toggle" title="[Ctrl+click] Expand all children"><span>▶</span></a><samp data-depth="2" class="sf-dump-compact">
    "<span class="sf-dump-key">url</span>" =&gt; "<span class="sf-dump-str" title="31 characters">http://127.0.0.1:8000/structure</span>"
  </samp>]
  "<span class="sf-dump-key">login_web_59ba36addc2b2f9401580f014c7f58ea4e30989d</span>" =&gt; <span class="sf-dump-num">1</span>
</samp>]
</pre><script>Sfdump("sf-dump-517717898", {"maxDepth":0})</script>
</dd></dl></div></div><a class="phpdebugbar-restore-btn" style=""></a></div><div class="phpdebugbar-openhandler" style="display: none;"><div class="phpdebugbar-openhandler-header">PHP DebugBar | Open<a><i class="phpdebugbar-fa phpdebugbar-fa-times"></i></a></div><table><thead><tr><th width="150">Date</th><th width="55">Method</th><th>URL</th><th width="125">IP</th><th width="100">Filter data</th></tr></thead><tbody></tbody></table><div class="phpdebugbar-openhandler-actions"><a>Load more</a><a>Show only current URL</a><a>Show all</a><a>Delete all</a><form><br><b>Filter results</b><br>Method: <select name="method"><option></option><option>GET</option><option>POST</option><option>PUT</option><option>DELETE</option></select><br>Uri: <input type="text" name="uri"><br>IP: <input type="text" name="ip"><br><button type="submit">Search</button></form></div></div><div class="phpdebugbar-openhandler-overlay" style="display: none;"></div>



</body></html>
