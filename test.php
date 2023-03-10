<?php
header("Access-Control-Allow-Origin: *");

?>
<head>
  <link href="https://vjs.zencdn.net/8.0.4/video-js.css" rel="stylesheet" />
  <link href="https://www.ranrom.xyz/test/libjass.css" rel="stylesheet">
  <!-- If you'd like to support IE8 (for Video.js versions prior to v7) -->
  <!-- <script src="https://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script> -->
</head>

<body>
  <video
    id="my-video"
    class="video-js"
    crossorigin="anonymous"
    controls=true
    preload="true"
    width="1280"
    height="720"
    poster="MY_VIDEO_POSTER.jpg"
    data-setup="{}"
    options="{navigationUI: 'hide'}"
  >
    <source src="https://kiyo.ranrom.xyz/vid/anime/The_Angle_Next_Door_Spoils_Me_rotten/The%20Angel%20Next%20Door%20Spoils%20Me%20Rotten%20-%2001.mp4" type="video/mp4">
    <!--track kind="subtitles" src="https://kiyo.ranrom.xyz/vid/anime/The_Angle_Next_Door_Spoils_Me_rotten/esp1.captions.vtt" srclang="en" label="English (VTT)"--!>

    <p class="vjs-no-js">
      To view this video please enable JavaScript, and consider upgrading to a
      web browser that
      <a href="https://videojs.com/html5-video-support/" target="_blank"
        >supports HTML5 video</a
      >
    </p>
  </video>

  <script src="https://vjs.zencdn.net/8.0.4/video.min.js"></script>
  <script src="//cdn.sc.gl/videojs-hotkeys/latest/videojs.hotkeys.min.js"></script>
  <script src="https://www.ranrom.xyz/test/libjass.js"></script>
  <link href="https://www.ranrom.xyz/test/videojs.ass.css" rel="stylesheet">
  <script src="https://www.ranrom.xyz/test/videojs.ass.js"></script>
    <script>
	videojs('my-video', {
            html5: {
                nativeTextTracks: false
  	    },
  	    plugins: {
    		ass: {
      		    subtitles: [{src: 'https://kiyo.ranrom.xyz/vid/anime/The_Angle_Next_Door_Spoils_Me_rotten/esp1.ssa', label: 'English (SSA)', srclang: 'en', 'default': false, 'delay': -0.1/*-0.1*/}]
    	        }
  	    }
      });
      var HasSwitched = false;
      var player = videojs('my-video');
      var tracks = player.textTracks();
      var delayInMilliseconds = 1500; //1 second
      player.on('playing', function() {
         if(!HasSwitched) {
             HasSwitched = true;
             setTimeout(function() {
                 for (var i = 0; i < tracks.length; i++) {
                     var track = tracks[i];
                     if (track.kind === 'subtitles' && track.language === 'en') {
                         track.mode = 'showing';
                     }
                  }
              }, delayInMilliseconds);
          }
      });
      videojs('my-video').ready(function() {
        this.hotkeys({
          volumeStep: 0.1,
          seekStep: 5,
          enableMute: true,
          enableFullscreen: true,
          enableNumbers: false,
          enableVolumeScroll: true,
          enableHoverScroll: true,
          captureDocumentHotkeys: true,
          documentHotkeysFocusElementFilter: e => e.tagName.toLowerCase() === "body",

          // Mimic VLC seek behavior, and default to 5.
          seekStep: function(e) {
            if (e.ctrlKey && e.altKey) {
              return 5*60;
            } else if (e.ctrlKey) {
              return 60;
            } else if (e.altKey) {
              return 10;
            } else {
              return 5;
            }
          },

          // Enhance existing simple hotkey with a complex hotkey
          fullscreenKey: function(e) {
            // fullscreen with the F key or Ctrl+Enter
            return ((e.which === 70) || (e.ctrlKey && e.which === 13));
          },

          // Custom Keys
          customKeys: {

            // Add new simple hotkey
            simpleKey: {
              key: function(e) {
                // Toggle something with S Key
                return (e.which === 83);
              },
              handler: function(player, options, e) {
                // Example
                if (player.paused()) {
                  player.play();
                } else {
                  player.pause();
                }
              }
            },

            // Add new complex hotkey
            complexKey: {
              key: function(e) {
                // Toggle something with CTRL + D Key
                return (e.ctrlKey && e.which === 68);
              },
              handler: function(player, options, event) {
                // Example
                if (options.enableMute) {
                  player.muted(!player.muted());
                }
              }
            },

            // Override number keys example from https://github.com/ctd1500/videojs-hotkeys/pull/36
            numbersKey: {
              key: function(event) {
                // Override number keys
                return ((event.which > 47 && event.which < 59) || (event.which > 95 && event.which < 106));
              },
              handler: function(player, options, event) {
                // Do not handle if enableModifiersForNumbers set to false and keys are Ctrl, Cmd or Alt
                if (options.enableModifiersForNumbers || !(event.metaKey || event.ctrlKey || event.altKey)) {
                  var sub = 48;
                  if (event.which > 95) {
                    sub = 96;
                  }
                  var number = event.which - sub;
                  player.currentTime(player.duration() * number * 0.1);
                }
              }
            },

            emptyHotkey: {
              // Empty
            },

            withoutKey: {
              handler: function(player, options, event) {
                  console.log('withoutKey handler');
              }
            },

            withoutHandler: {
              key: function(e) {
                  return true;
              }
            },

            malformedKey: {
              key: function() {
                console.log('I have a malformed customKey. The Key function must return a boolean.');
              },
              handler: function(player, options, event) {
                //Empty
              }
            }
          }
        });
      });
    </script>
</body>
