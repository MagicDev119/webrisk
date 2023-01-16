(function () {
  function createCookie(name, value, days) {
    if (days) {
      var date = new Date();
      date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
      var expires = "; expires=" + date.toGMTString();
    }
    else var expires = "";
    document.cookie = name + "=" + value + expires + "; path=/";
  }
  function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == ' ') c = c.substring(1, c.length);
      if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
  }
  function eraseCookie(name) {
    createCookie(name, "", -1);
  }
  var ie = /MSIE (\d+)/.exec(navigator.userAgent); ie = ie && ie[1];
  var reIt, countRe, prefix = '<span>', suffix = '</span> seconds',
    refreshdisabled = 'Disabled',
    regex = [/ class="digits2"/, /span/], recounter = document.getElementById('reCounter');
  function doit() {
    recounter.innerHTML = prefix + '0' + suffix;
    if (ie) {
      createCookie('iescroll', document.documentElement.scrollLeft + 'and' + document.documentElement.scrollTop);
    }
    setTimeout(function () {
      if (window.location.reload)
        window.location.reload();
      else if (window.location.replace)
        window.location.replace(unescape(location.href))
      else
        window.location.href = unescape(location.href)
    }, 300);
  }
  function startUp(saved) {
    // uncomment below line for testing only
    //alert(readCookie('resetInt'))
    clearInterval(countRe);
    var cookval = readCookie('resetInt'), iescroll = readCookie('iescroll');
    if (cookval != null) {//console.log(cookval);
      prefix = prefix.replace(regex[0], '');
      prefix = cookval / 1000 < 100 ? prefix.replace(regex[1], 'span class="digits2"') : prefix;
      var counter = saved === true && startUp.saved ? startUp.saved : cookval / 1000;
      document.getElementById('reCounter').innerHTML = prefix + counter + suffix;
      var opts = document.getElementById('selRe').options
      for (var i_tem = 0; i_tem < opts.length; i_tem++)
        if (opts[i_tem].value == readCookie('resetInt') / 1000)
          opts.selectedIndex = i_tem
      countRe = setInterval(function () {
        recounter.innerHTML = prefix + (--counter) + suffix;
        startUp.saved = counter;
      }, 1000)
      reIt = setTimeout(doit, counter * 1000);
      if (ie && iescroll) {
        eraseCookie('iescroll');
        //alert(iescroll);
        iescroll = iescroll.split('and');
        attachEvent('onload', function () { window.scrollTo(iescroll[0], iescroll[1]); });
      }
    }
    else
      recounter.innerHTML = refreshdisabled;
    return;
  }
  function setRe(val) {
    clearTimeout(reIt)
    if (val == 0) {
      clearInterval(countRe)
      recounter.innerHTML = refreshdisabled;
      eraseCookie('resetInt')
      return;
    }
    else
      // 7 (or the last value) in the below line is the number of days persistence
      createCookie('resetInt', val * 1000, 7)
    startUp();
  }
  onload = startUp;

  function stopTimer() {
    if (document.getElementById('selRe').value == 0) { return; }
    clearTimeout(countRe)
    clearTimeout(reIt)
    recounter.innerHTML = 'Paused'
  }
  document.getElementById('selRe').onchange = function () { setRe(this.value); };
  document.getElementById('pause').onclick = stopTimer;
  document.getElementById('continue').onclick = function () { startUp(true); };
  document.getElementById('update').onclick = doit;
})();