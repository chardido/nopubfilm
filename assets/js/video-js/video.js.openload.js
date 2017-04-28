function supports_html5_storage() {
    try {
        return 'localStorage'in window && window['localStorage'] !== null;
    } catch (e) {
        return false;
    }
}
var percentage = 100;
var styleEl = null;
function removeNode(node) {
    if (node != null) {
        node.parentNode.removeChild(node);
    }
}
function insertCss(code) {
    var style = document.createElement('style');
    style.type = 'text/css';
    if (style.styleSheet) {
        style.styleSheet.cssText = code;
    } else {
        style.innerHTML = code;
    }
    document.getElementsByTagName("head")[0].appendChild(style);
    return style;
}
function changeSize(change) {
    percentage = percentage + change;
    if (percentage < 25)
        percentage = 25;
    removeNode(styleEl);
    styleEl = insertCss(".vjs-text-track-display div div div{font-size:" + percentage + "%}");
}
function addtrack(src, label) {
    var track = document.createElement("track");
    track.kind = "captions";
    track.label = label;
    track.srclang = "su";
    track.src = src;
    document.getElementById("olvideo").appendChild(track);
}
function getJsonFromUrl() {
    var query = location.search.substr(1);
    var result = {};
    query.split("&").forEach(function(part) {
        var item = part.split("=");
        result[item[0]] = decodeURIComponent(item[1]);
    });
    return result;
}
var customsubs = false;
try {
    if ($(window).attr('name').indexOf("subs:") === 0) {
        addtrack(suburl + window.btoa($(window).attr('name').substring(5)), "embedded subs");
    }
    var querystring = getJsonFromUrl();
    var i = 1;
    while (true) {
        if (typeof querystring["c" + i + "_file"] !== "undefined" && typeof querystring["c" + i + "_label"] !== "undefined") {
            customsubs = true;
            addtrack(suburl + window.btoa(querystring["c" + i + "_file"]), querystring["c" + i + "_label"]);
        } else {
            break;
        }
        i++;
    }
} catch (e) {}
function trim(dataAndEvents) {
    return (dataAndEvents + "").replace(/^\s+|\s+$/g, "");
};
function parseSrt(dataAndEvents, oncue) {
    if (dataAndEvents == "") {
        alert("Invalid srt file!");
    }
    var tempData;
    var splitted;
    var collection;
    var nodes = dataAndEvents.split("\n");
    var resp = "";
    var user_id;
    var cuelength = 0;
    var i = 1;
    var n = nodes["length"];
    for (; i < n; i++) {
        resp = trim(nodes[i]);
        if (resp) {
            if (resp.indexOf("-->")==-1) {
                user_id = resp;
                resp = trim(nodes[++i]);
            } else {
                user_id = cuelength;
            }
            tempData = {
                id: user_id,
                index: cuelength
            };
            splitted = resp.split(/[\t ]+/);
            tempData["startTime"] = parseCueTime(splitted[0]);
            tempData["endTime"] = parseCueTime(splitted[2]);
            collection = [];
            for (; nodes[++i] && (resp = trim(nodes[i]));) {
                collection.push(resp);
            }
            tempData["text"] = collection.join("\n");
            oncue(new VTTCue(tempData["startTime"], tempData["endTime"], tempData["text"]));
            cuelength += 1;
        }
    }
};
function parseCueTime(dataAndEvents) {
    var parts = dataAndEvents.split(":");
    var sum = 0;
    var minutes;
    var part;
    var url;
    var x;
    var i;
    if (parts["length"] == 3) {
        minutes = parts[0];
        part = parts[1];
        url = parts[2];
    } else {
        minutes = 0;
        part = parts[0];
        url = parts[1];
    }
    url = url.split(/\s+/);
    x = url.splice(0, 1)[0];
    x = x.split(/\.|,/);
    i = parseFloat(x[1]);
    x = x[0];
    sum += parseFloat(minutes) * 3600;
    sum += parseFloat(part) * 60;
    sum += parseFloat(x);
    if (i) {
        sum += i / 1E3;
    }
    return sum;
};
var player = videojs("olvideo", {}, function() {
    this.hotkeys({
        volumeStep: 0.1,
        seekStep: 5,
        enableMute: true,
        enableFullscreen: true,
        enableNumbers: true
    });
    if (supports_html5_storage()) {
        var volume = localStorage.getItem("volume");
        if (volume != null) {
            try {
                this.volume(volume);
            } catch (e) {}
        }
    }
    var lastindex;
    function reattachEvents() {
        $("li.vjs-menu-item").click(function() {
            if ($(this).html().indexOf("Size") === 0 || $(this).html().indexOf("Load SRT") === 0)
                return;
            lastindex = $("li.vjs-menu-item").index(this);
        });
        $("li.vjs-menu-item:contains('Load SRT from PC')").click(function() {
            $("#srtSelector").trigger('click');
        });
        $("li.vjs-menu-item:contains('Load SRT from URL')").click(function() {
            loadSrtFromUrl();
        });
        $("li.vjs-menu-item:contains('Size+')").click(function() {
            changeSize(25);
            $("li.vjs-menu-item").eq(lastindex).trigger('click');
        });
        $("li.vjs-menu-item:contains('Size-')").click(function() {
            changeSize( - 25);
            $("li.vjs-menu-item").eq(lastindex).trigger('click');
        });
    }
    reattachEvents();
    function loadSrtFromUrl() {
        var url = prompt("Please enter the Url of the .srt file you want to use");
        if (url != null && url != "") {
            $.get(suburl + window.btoa(url), function(srcContent) {
                var track = videojs("olvideo").addTextTrack("captions", "Subs from your url", "su");
                var parser = new window['WebVTT']['Parser'](window, window['vttjs'], window['WebVTT']['StringDecoder']());
                parser['oncue'] = function(cue) {
                    track.addCue(cue);
                };
                parser['onparsingerror'] = function(error) {};
                parser['parse'](srcContent);
                parser['flush']();
                $("li.vjs-menu-item:last").trigger('click');
                reattachEvents();
            });
        }
    };
    $("#srtSelector").on("change", function() {
        var collection = new FileReader;
        collection.onload = function(dataAndEvents) {
            if (collection.result.indexOf("-->")!==-1) {
                var track = videojs("olvideo").addTextTrack("captions", $("#srtSelector").prop("files")[0].name, "su");
                parseSrt(collection.result, function(cue) {
                    track.addCue(cue);
                });
                $("li.vjs-menu-item:last").trigger('click');
                reattachEvents();
            } else {
                alert("Invaid subtitle file");
            }
        };
        collection.readAsText($("#srtSelector").prop("files")[0], "ISO-8859-1");
    });
    var html = $("li.vjs-menu-item").eq(3).html();
    if (html && html.indexOf("Load SRT from PC")==-1) {
        $("li.vjs-menu-item").eq(3).trigger('click');
    }
    $("li.vjs-menu-item:contains('embedded subs')").trigger("click");
    if (customsubs) {
        var html = $("li.vjs-menu-item:last").html();
        if (html && html.indexOf("Load SRT from PC")==-1 && html.indexOf("Size-")==-1) {
            $("li.vjs-menu-item:last").trigger('click');
        }
    }
}).one('firstplay', function() {
    $("#videooverlay, .title, .logocontainer").hide();
}).one('loadedmetadata', function() {
    if (typeof window.shouldreport !== "undefined") {
        if ((window.filesize * 8 / (1024 * 1024)) / this.duration() > 2.5) {
            $.get("/reportDuration/" + window.shouldreport + "/" + this.duration());
        }
    }
    $(".media-player .video-js").css({
        "padding-top": ($("video:first").videoHeight / $("video:first").videoWidth) * 100 + "%"
    });
}).one('volumechange', function() {
    if (supports_html5_storage()) {
        localStorage.setItem("volume", this.volume());
    }
});
