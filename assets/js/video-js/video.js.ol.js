videojs.Openload = videojs.Button.extend({
    init: function(player, options) {
        videojs.Button.call(this, player, options);
        this.on('click', this.onClick);
    }
});
videojs.Openload.prototype.onClick = function() {};
var createOpenloadButton = function() {
    var props = {
        className: 'vjs-ol-button vjs-control',
        innerHTML: '<div class="vjs-control-content vjs-ol-button"><a target="_blank" href="https://openload.io/"><img src="/assets/img/logowhite.png" class="logobrand" /></a></div>',
        role: 'button',
        tabIndex: 0
    };
    return videojs.Component.prototype.createEl(null, props);
};
var ol;
videojs.plugin('Openload', function() {
    var options = {
        'el': createOpenloadButton()
    };
    ol = new videojs.Openload(this, options);
    this.controlBar.el().insertBefore(ol.el(), this.controlBar.volumeControl.el());
});
function supportsTransitions() {
    var b = document.body || document.documentElement, s = b.style, p = 'transition';
    if (typeof s[p] == 'string') {
        return true;
    }
    var v = ['Moz', 'webkit', 'Webkit', 'Khtml', 'O', 'ms'];
    p = p.charAt(0).toUpperCase() + p.substr(1);
    for (var i = 0; i < v.length; i++) {
        if (typeof s[v[i] + p] == 'string') {
            return true;
        }
    }
    return false;
}
videojs.plugin('OpenloadAnim', function(options) {
    if (!supportsTransitions())
        return;
    var props = {
        id: 'anim-container',
        innerHTML: '<div id="playeranim"></div>'
    };
    var el = videojs.Component.prototype.createEl(null, props);
    this.bigPlayButton.el().parentNode.appendChild(el);
    document.getElementById("anim-container").style.visibility = "hidden";
    var playinganimation = false;
    function timeAnim() {
        window.setTimeout(function() {
            document.getElementById("anim-container").style.visibility = "hidden";
            document.getElementById("anim-container").className = "";
            playinganimation = false;
        }, 500);
    }
    $("video:first").click("click", function(e) {
        if (playinganimation)
            return;
        playinganimation = true;
        if (this.paused()) {
            document.getElementById("anim-container").style.visibility = "visible";
            document.getElementById("anim-container").className = "pause anim";
            timeAnim();
        } else {
            document.getElementById("anim-container").style.visibility = "visible";
            document.getElementById("anim-container").className = "play anim";
            timeAnim();
        }
    }.bind(this));
});
videojs.plugin('progressTips', function(options) {
    var init;
    var player = this;
    init = function() {
        if ($("#olvideo_html5_api").length == 0)
            return;
        $(".vjs-progress-control").after($("      <div id='vjs-tip'>      <div id='vjs-tip-arrow'></div>      <div id='vjs-tip-inner'></div>      </div>    "));
        $(".vjs-progress-control").on("mousemove", function(event) {
            var barHeight, minutes, seconds, seekBar, timeInSeconds;
            seekBar = player.controlBar.progressControl.seekBar;
            var mousePosition = (event.pageX - $(seekBar.el()).offset().left) / seekBar.width();
            timeInSeconds = mousePosition * player.duration();
            if (timeInSeconds === player.duration()) {
                timeInSeconds = timeInSeconds - 0.1;
            }
            minutes = Math.floor(timeInSeconds / 60);
            seconds = Math.floor(timeInSeconds - minutes * 60);
            if (seconds < 10) {
                seconds = "0" + seconds;
            }
            $('#vjs-tip-inner').html("" + minutes + ":" + seconds);
            barHeight = $('.vjs-control-bar').height();
            $("#vjs-tip").css("bottom", "" + (barHeight + 14) + "px").css("left", "" + (event.pageX - $(this).offset().left - 23) + "px").css("visibility", "visible");
            return;
        });
        $(".vjs-progress-control, .vjs-play-control").on("mouseout", function() {
            $("#vjs-tip").css("visibility", "hidden");
        });
    };
    this.on("loadedmetadata", init);
});
videojs.plugin('wm', function() {
    if (typeof logourl == "undefined")
        return;
    var img = document.createElement("img");
    img.src = logourl;
    img.className = "videologo";
    this.bigPlayButton.el().parentNode.appendChild(img);
});
!function(e, r) {
    "function" == typeof define && define.amd ? define([], r.bind(this, e, e.videojs)) : "undefined" != typeof module && module.exports ? module.exports = r(e, e.videojs) : r(e, e.videojs)
}(window, function(e, r) {
    "use strict";
    e.videojs_hotkeys = {
        version: "0.2.12"
    };
    var t = function(t) {
        function n(e) {
            return 32 === e.which
        }
        function u(e) {
            return 37 === e.which
        }
        function l(e) {
            return 39 === e.which
        }
        function o(e) {
            return 38 === e.which
        }
        function a(e) {
            return 40 === e.which
        }
        function i(e) {
            return 77 === e.which
        }
        function c(e) {
            return 70 === e.which
        }
        var s = this, m = s.el(), y = {
            volumeStep: .1,
            seekStep: 5,
            enableMute: !0,
            enableVolumeScroll: !0,
            enableFullscreen: !0,
            enableNumbers: !0,
            enableJogStyle: !1,
            alwaysCaptureHotkeys: !1,
            playPauseKey: n,
            rewindKey: u,
            forwardKey: l,
            volumeUpKey: o,
            volumeDownKey: a,
            muteKey: i,
            fullscreenKey: c,
            customKeys: {}
        }, f = 1, v = 2, d = 3, b = 4, h = 5, p = 6, w = 7, k = r.mergeOptions || r.util.mergeOptions;
        t = k(y, t || {});
        var K = t.volumeStep, S = t.seekStep, T = t.enableMute, g = t.enableVolumeScroll, j = t.enableFullscreen, F = t.enableNumbers, q = t.enableJogStyle, x = t.alwaysCaptureHotkeys;
        m.hasAttribute("tabIndex") || m.setAttribute("tabIndex", "-1"), x && s.one("play", function() {
            m.focus()
        }), s.on("play", function() {
            var e = m.querySelector(".iframeblocker");
            e && "" === e.style.display && (e.style.display = "block", e.style.bottom = "39px")
        });
        var D = function(e) {
            var r, n = e.which, u = e.preventDefault;
            if (s.controls()) {
                var l = document.activeElement;
                if (x || l == m || l == m.querySelector(".vjs-tech") || l == m.querySelector(".vjs-control-bar") || l == m.querySelector(".iframeblocker"))
                    switch (E(e, s)) {
                    case f:
                        u(), x && e.stopPropagation(), s.paused() ? s.play() : s.pause();
                        break;
                    case v:
                        u(), r = s.currentTime() - S, s.currentTime() <= S && (r = 0), s.currentTime(r);
                        break;
                    case d:
                        u(), s.currentTime(s.currentTime() + S);
                        break;
                    case h:
                        u(), q ? (r = s.currentTime() - 1, s.currentTime() <= 1 && (r = 0), s.currentTime(r)) : s.volume(s.volume() - K);
                        break;
                    case b:
                        u(), q ? s.currentTime(s.currentTime() + 1) : s.volume(s.volume() + K);
                        break;
                    case p:
                        T && s.muted(!s.muted());
                        break;
                    case w:
                        j && (s.isFullscreen() ? s.exitFullscreen() : s.requestFullscreen());
                        break;
                    default:
                        if ((n > 47 && 59 > n || n > 95 && 106 > n) && F) {
                            var o = 48;
                            n > 95 && (o = 96);
                            var a = n - o;
                            u(), s.currentTime(s.duration() * a * .1)
                        }
                        for (var i in t.customKeys) {
                            var c = t.customKeys[i];
                            c && c.key && c.handler && c.key(e) && (u(), c.handler(s, t))
                        }
                    }
                }
            }, M = function(e) {
            if (s.controls()) {
                var r = e.relatedTarget || e.toElement || document.activeElement;
                (r == m || r == m.querySelector(".vjs-tech") || r == m.querySelector(".iframeblocker")) && j && (s.isFullscreen() ? s.exitFullscreen() : s.requestFullscreen())
            }
        }, C = function(r) {
            if (s.controls()) {
                if (!s.isFullscreen() && 0 == $(r.target).first().parents(".vjs-control-bar").length&&!$(r.target).first().hasClass("vjs-control-bar"))
                    return;
                if (g) {
                    r = e.event || r;
                    var t = Math.max( - 1, Math.min(1, r.wheelDelta||-r.detail));
                    r.preventDefault(), 1 == t ? s.volume(s.volume() + K) : - 1 == t && s.volume(s.volume() - K)
                }
            }
        }, E = function(e, r) {
            return t.playPauseKey(e, r) ? f : t.rewindKey(e, r) ? v : t.forwardKey(e, r) ? d : t.volumeUpKey(e, r) ? b : t.volumeDownKey(e, r) ? h : t.muteKey(e, r) ? p : t.fullscreenKey(e, r) ? w : void 0
        };
        return s.on("keydown", D), s.on("dblclick", M), s.on("mousewheel", C), s.on("DOMMouseScroll", C), this
    };
    r.plugin("hotkeys", t)
});
