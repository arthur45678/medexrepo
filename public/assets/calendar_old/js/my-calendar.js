(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["/assets/calendar/js/my-calendar"],{

/***/ "./resources/js/calendar/my-calendar.js":
/*!**********************************************!*\
  !*** ./resources/js/calendar/my-calendar.js ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _createForOfIteratorHelper(o, allowArrayLike) {
  var it;

  if (typeof Symbol === "undefined" || o[Symbol.iterator] == null) {
    if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") {
      if (it) o = it;
      var i = 0;

      var F = function F() {};

      return {
        s: F,
        n: function n() {
          if (i >= o.length) return {
            done: true
          };
          return {
            done: false,
            value: o[i++]
          };
        },
        e: function e(_e) {
          throw _e;
        },
        f: F
      };
    }

    throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.");
  }

  var normalCompletion = true,
      didErr = false,
      err;
  return {
    s: function s() {
      it = o[Symbol.iterator]();
    },
    n: function n() {
      var step = it.next();
      normalCompletion = step.done;
      return step;
    },
    e: function e(_e2) {
      didErr = true;
      err = _e2;
    },
    f: function f() {
      try {
        if (!normalCompletion && it["return"] != null) it["return"]();
      } finally {
        if (didErr) throw err;
      }
    }
  };
}

function _unsupportedIterableToArray(o, minLen) {
  if (!o) return;
  if (typeof o === "string") return _arrayLikeToArray(o, minLen);
  var n = Object.prototype.toString.call(o).slice(8, -1);
  if (n === "Object" && o.constructor) n = o.constructor.name;
  if (n === "Map" || n === "Set") return Array.from(o);
  if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen);
}

function _arrayLikeToArray(arr, len) {
  if (len == null || len > arr.length) len = arr.length;

  for (var i = 0, arr2 = new Array(len); i < len; i++) {
    arr2[i] = arr[i];
  }

  return arr2;
} // $("#calendar").evoCalendar();


$("li.month").click(function () {
  $(".name_info").html(this.innerHTML);
});
$(".iks").click(function () {
  $(".modal").fadeToggle();
});
$(".modal").click(function (e) {
  if (e.target == e.currentTarget) {
    $(this).fadeToggle();
  }
});

function getData(data) {
  dt = data.split(" ");
  return dt[1];
}

function getTime(data) {
  dt = data.split(":");
  return dt[0] + ":" + dt[1];
}

function getDay(data) {
  dt = data.split("/");
  return dt[1];
}

function getAmsativ(data) {
  dt = data.split(" ");
  return dt[0];
}

function getStart(data) {
  dt = getAmsativ(data);
  or = dt.split("-");
  return or[2];
}

function getInfo(elem) {
  $(".event-list").html(""); // console.log(elem);

  if (elem.length == 0) {
    $(".event-list").html("<div class='event-empty'><p>Գրանցումներ չկան</p></div>");
  } else {
    var _iterator = _createForOfIteratorHelper(elem),
        _step;

    try {
      for (_iterator.s(); !(_step = _iterator.n()).done;) {
        today = _step.value; // console.log(today)

        if (today.patient == null) {
          if (today.soc == null) {
            today.soc = '';
          }

          event_result.innerHTML += "<div class='event-empty'>" + "<p class='p_anun'>" + today.name + "</p>" + "<p>" + "<span class='skizb'>" + getData(getTime(today.start)) + "</span>-" + "<span class='verj'>" + getTime(today.end) + "</span>" + "</p>" + "<p class='coment'>" + today.comments + "</p>" + "<input type='hidden' value=" + today.id + " class='p_id'>" + "<input type='hidden' value=" + today.soc + " class='p_soc'>" + "<button onclick='edit(this)'>Փոփոխել</button>" + "</div>";
        } else {
          if (today.name == null) {
            today.name = "";
          }

          if (today.comments == null) {
            today.comments = "";
          }

          if (today.soc == null) {
            today.soc = '';
          }

          event_result.innerHTML += "<div class='event-empty'>" + "<p>" + today.patient["all_names"] + "</p>" + "<p>" + "<span class='skizb'>" + getData(getTime(today.start)) + "</span>-" + "<span class='verj'>" + getTime(today.end) + "</span>" + "</p>" + "<p class='p_anun'>" + today.name + "</p>" + "<p class='coment'>" + today.comments + "</p>" + "<input type='hidden' value=" + today.id + " class='p_id'>" + "<input type='hidden' value=" + today.patient.soc_card + " class='p_soc'>" + "<button onclick='edit(this)'>Փոփոխել</button>" + "</div>";
        }
      }
    } catch (err) {
      _iterator.e(err);
    } finally {
      _iterator.f();
    }
  }
}

function galochka(elem) {
  $(".day").each(function () {
    var or = getDay($(this).attr("data-date-val")); // console.log(or);

    var _iterator2 = _createForOfIteratorHelper(elem),
        _step2;

    try {
      for (_iterator2.s(); !(_step2 = _iterator2.n()).done;) {
        esor = _step2.value;

        if (or == getStart(esor.start)) {
          // console.log(or+" "+getStart(esor.start));
          $(this).append("<span class=\"event-indicator\"><div class=\"type-bullet\">\n                    <div class=\"type-bullet\"><div class=\"type-event\"></div></div>\n                </span>");
        }
      }
    } catch (err) {
      _iterator2.e(err);
    } finally {
      _iterator2.f();
    }
  });
}

$(window).on("load", function () {
  getInfo(todayData);

  if (auth_man_type == 0) {
    $("button.plus").css({
      "display": "none"
    });
  }

  galochka(all); // console.log(all);
});
var data = new Date();

function plus(that) {
  var date = new Date(that.getAttribute("data-date-val"));
  var day = date.getDate();
  var month = date.getMonth();
  var year = date.getFullYear();

  if (day < data.getDate() && month <= data.getMonth()) {
    $(".plus").prop("disabled", true);
  } else if (year < data.getFullYear()) {
    $(".plus").prop("disabled", true);
  } else {
    $(".plus").prop("disabled", false);
  }

  if (year > data.getFullYear()) {
    $(".plus").prop("disabled", false);
  }
}

function modalToggle() {
  var data = $(".calendar-active").attr("data-date-val");
  $(".modal").fadeToggle();
  $(".modal").css("display", "flex");
  $("#amsativ").val(data);
  $(".block input:not([name='_token'],[name='user_id']),.block textarea").val("");
  that = $(".calendar-active").attr("data-date-val");
  document.getElementById('datehidden').value = that;
}

$("input,textarea").on("input", function () {
  var anun = $("#anun").val();
  var cart = $("#carti_hamar").val();
  var start_jam = $("#start_jam").val();
  var end_jam = $("#end_jam").val();
  var txt = $("#txt").val();

  if (anun != "" && start_jam != "" && end_jam.value != "" && txt != "") {
    $(".send").prop("disabled", false);
  } else {
    $(".send").prop("disabled", true);
  }
});

function ajax(that) {
  var result = that.getAttribute("data-date-val"); // console.log(result);

  var user_data = [{
    "user_id": user_id,
    "calendar": result
  }];
  save(user_data);
}

function fetchsend(token, url, method, data, dataName) {
  fetch(url, {
    method: method,
    body: JSON.stringify(data),
    headers: {
      'Content-Type': 'application/json',
      "X-CSRF-Token": token
    }
  }).then(function (response) {
    return response.json();
  }).then(function (json) {
    window[dataName](json);
  })["catch"](function (error) {});
}

document.querySelector(".send").onclick = function () {
  var data = $(".calendar-active").attr("data-date-val");
  console.log(anun.value);
  console.log(carti_hamar.value);
  console.log(data);
  console.log(start_jam.value);
  console.log(end_jam.value);
  console.log(txt.value);
  var user_add_data = [{
    "name": anun.value,
    "soc": carti_hamar.value,
    "user_id": user_id,
    "calendar": data + ' ' + start_jam.value,
    "end": end_jam.value,
    "description": txt.value
  }];
  addCalendar(user_add_data);
};

function htmltype(data) {
  console.log(data);
  getInfo(data);
}

function resultCal(json) {
  alert(json);
}

function edit(that) {
  $(".modal").fadeToggle();
  $(".modal").css("display", "flex");
  anun.value = $(that).parent().find(".p_anun").text();
  carti_hamar.value = $(that).parent().find(".p_soc").val();

  if (carti_hamar.value == "undefined") {
    carti_hamar.value = "";
  }

  start_jam.value = $(that).parent().find(".skizb").text();
  end_jam.value = $(that).parent().find(".verj").text();
  txt.value = $(that).parent().find(".coment").text();
  hid_id.value = $(that).parent().find(".p_id").val();
  var data = $(".calendar-active").attr("data-date-val");
  document.getElementById('datehidden').value = data;
}

/***/ }),

/***/ 6:
/*!****************************************************!*\
  !*** multi ./resources/js/calendar/my-calendar.js ***!
  \****************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\OpenServer\domains\medexrepo\resources\js\calendar\my-calendar.js */"./resources/js/calendar/my-calendar.js");


/***/ })

},[[6,"/js/components/manifest"]]]);