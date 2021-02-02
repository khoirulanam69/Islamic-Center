@extends('layouts.main')

@section('title', 'Kiblat')

@section('content')
    <div class="container"  style="margin-top: 100px">
        <div class="kompas mt-5">
            <div class="images">
              <img src="./assets/img/compass.png" width="350px" alt="compass" />
            </div>
          </div>
          <div class="row justify-content-between mt-5">
            <div class="col-sm-3 text-center">
              <label for="heading">HEAD</label>
              <h5 class="heading"></h5>
            </div>
            <div class="col-sm-3 text-center">
              <label for="latitude">LAT</label>
              <h5 class="latitude"></h5>
            </div>
            <div class="col-sm-3 text-center">
              <label>LONG</label>
              <h5 class="longtitude"></h5>
            </div>
          </div>
    </div>
    <script>
        var debug = false;

var images = document.querySelector(".kompas .images");
var head = document.querySelector(".heading");
var latitude = document.querySelector(".latitude");
var longtitude = document.querySelector(".longtitude");

var defaultOrientation;

function getBrowserOrientation() {
  var orientation;

  if (screen.orientation && screen.orientation.type) {
    orientation = screen.orientation.type;
  } else {
    orientation =
      screen.orientation || screen.mozOrientation || screen.msOrientation;
  }
  return orientation;
}

function onHeadingChange(event) {
  var heading = event.alpha;

  if (typeof event.webkitCompassHeading !== "undefined") {
    heading = event.webkitCompassHeading; //iOS non-standard
  }

  var orientation = getBrowserOrientation();

  if (typeof heading !== "undefined" && heading !== null) {
    if (debug) {
      debugOrientation.textContent = orientation;
    }

    // what adjustment we have to add to rotation to allow for current device orientation
    var adjustment = 0;
    if (defaultOrientation === "landscape") {
      adjustment -= 90;
    }

    if (typeof orientation !== "undefined") {
      var currentOrientation = orientation.split("-");

      if (defaultOrientation !== currentOrientation[0]) {
        if (defaultOrientation === "landscape") {
          adjustment -= 270;
        } else {
          adjustment -= 90;
        }
      }

      if (currentOrientation[1] === "secondary") {
        adjustment -= 180;
      }
    }
    var tot = heading + adjustment;

    var phase = tot < 0 ? 360 + tot : tot;
    head.innerHTML = ((360 - phase) | 0) + "°";

    // apply rotation to compass rose
    if (typeof images.style.transform !== "undefined") {
      images.style.transform = `rotateZ(${tot}deg)`;
    } else if (typeof images.style.webkitTransform !== "undefined") {
      images.style.webkitTransform = `rotateZ(${tot}deg)`;
    }
  } else {
    // device can't show heading
    head.innerHTML = "N/A";
  }
}

if (screen.width > screen.height) {
  defaultOrientation = "landscape";
} else {
  defaultOrientation = "portrait";
}
if (debug) {
  debugOrientationDefault.textContent = defaultOrientation;
}

window.addEventListener("deviceorientation", onHeadingChange);

function decimalToSexagesimal(decimal, type) {
  var degrees = decimal | 0;
  var fraction = Math.abs(decimal - degrees);
  var minutes = (fraction * 60) | 0;
  var seconds = (fraction * 3600 - minutes * 60) | 0;

  var direction = "";
  var positive = degrees > 0;
  degrees = Math.abs(degrees);
  switch (type) {
    case "lat":
      direction = positive ? "N" : "S";
      break;
    case "lng":
      direction = positive ? "E" : "W";
      break;
  }

  return degrees + "° " + minutes + "' " + seconds + '" ' + direction;
}

navigator.geolocation.watchPosition((value) => {
  var lat = value.coords.latitude;
  var long = value.coords.longitude;
  latitude.innerHTML = decimalToSexagesimal(lat, "lat");
  longtitude.innerHTML = decimalToSexagesimal(long, "lng");
});
</script>
@endsection
