/*
 * Author: Yme-Jan Iedema <yme-jan@iedema.me>
 * Based off the work of Sunny Li (https://github.com/SunnyLi/videojs-ass)
 */

if (typeof require !== 'undefined' || typeof window.require !== 'undefined') {
  const videojs = require('video.js');
}

if (typeof videojs === 'undefined') {
  throw Error('videojs not found');
}

const Plugin = videojs.getPlugin('plugin');

class AASSubtitles extends Plugin {

  constructor(player, options) {
    super(player, options);

    this.player = player;
    this.delay = 0;

    this.overlay = this.createOverlay();

    this.current_track = null;
    this.subtitles = [];

    this.is_switching = false;

    player.textTracks().on('change', this.switchTrack.bind(this));
    player.on('play', this.play.bind(this));
    player.on('pause', this.pause.bind(this));
    player.on('seeking', this.seeking.bind(this));
    player.on('ratechange', this.ratechange.bind(this));

    window.addEventListener('resize', this.updateDisplayArea.bind(this));
    player.on('loadedmetadata', this.updateDisplayArea.bind(this));
    player.on('resize', this.updateDisplayArea.bind(this));
    player.on('fullscreenchange', this.updateDisplayArea.bind(this));


    if (options.subtitles) {
      for (const sub of options.subtitles) {
        this.addSubtitle(sub.src, sub.label, sub.srclang, sub.enabled);
      }
    }

  }

  createOverlay() {
    const overlay = document.createElement('div');
    overlay.className = 'vjs-ass';

    const OverlayComponent = {
      name: () => {
        return 'AssOverlay';
      },
      el: () => {
        return overlay;
      }
    };

    this.player.addChild(OverlayComponent, {}, 3);

    return overlay;
  }

  getCurrentTime() {
    return this.player.currentTime() - this.delay;
  }

  async addSubtitle(url, label, srclang = 'en', enabled = false) {
    console.log('Adding track', label);
    const track = {
      src: '',
      kind: 'subtitles',
      label: label || 'Unknown',
      srclang: srclang,
      default: enabled,
      mode: enabled ? 'showing' : 'disabled'
    };

    const ass = await libjass.ASS.fromUrl(url, libjass.Format.ASS);
    const clock = new libjass.renderers.AutoClock(this.getCurrentTime.bind(this), 500);

    const rendererSettings = new libjass.renderers.RendererSettings();
    rendererSettings.enableSvg = false;
    const renderer = new libjass.renderers.WebRenderer(ass, clock, this.overlay, rendererSettings);

    this.subtitles.push({
      track: this.player.addRemoteTextTrack(track, true).track,
      clock: clock,
      renderer: renderer,
    });
  }

  switchTrack() {
    if (this.is_switching) return;
    this.is_switching = true; // recursion prevention, changing track.mode triggers track change
    const selected_track = this.player.textTracks().tracks_.find(t => t.mode === 'showing');

    if (this.current_track) {
      this.stop(this.current_track);
    }

    if (selected_track) {
      this.current_track = selected_track;
      this.start(selected_track);
    }

    this.is_switching = false;
  }

  start(track) {
    const subtitle = this.subtitles.find(e => e.track.id === track.id);

    if (!subtitle) {
      return;
    }

    console.log('Starting ', subtitle.track.label);
    subtitle.track.mode = 'showing';

    subtitle.renderer.clock.enable();
    this.updateDisplayArea();
    subtitle.clock.play();
  }

  stop(track) {
    const subtitle = this.subtitles.find(e => e.track.id === track.id);
    if (!subtitle) return;

    console.log('Stopping ', subtitle.track.label);
    subtitle.track.mode = 'disabled';
    subtitle.renderer.clock.disable();

  }

  play() {
    const sub = this.current();
    if (!sub) return;
    sub.clock.play();
  }

  pause() {
    const sub = this.current();
    if (!sub) return;
    sub.clock.pause();
  }

  seeking() {
    const sub = this.current();
    if (!sub) return;
    sub.clock.seeking();
  }

  ratechange() {
    const sub = this.current();
    if (!sub) return;
    sub.clock.setRate(this.player.playbackRate());
  }

  current() {
    if (!this.current_track) return;
    return this.subtitles.find(e => e.track.id === this.current_track.id);
  }

  updateDisplayArea() {
    setTimeout(() => {
      if (!this.player) return;
      // player might not have information on video dimensions when using external providers
      let videoWidth = this.player.videoWidth() || this.player.el().offsetWidth,
        videoHeight = this.player.videoHeight() || this.player.el().offsetHeight,
        videoOffsetWidth = this.player.el().offsetWidth,
        videoOffsetHeight = this.player.el().offsetHeight,

        ratio = Math.min(videoOffsetWidth / videoWidth, videoOffsetHeight / videoHeight),
        subsWrapperWidth = videoWidth * ratio,
        subsWrapperHeight = videoHeight * ratio,
        subsWrapperLeft = (videoOffsetWidth - subsWrapperWidth) / 2,
        subsWrapperTop = (videoOffsetHeight - subsWrapperHeight) / 2;

      const sub = this.current();
      if (!sub) return;
      sub.renderer.resize(subsWrapperWidth, subsWrapperHeight, subsWrapperLeft, subsWrapperTop);
    }, 100);
  }

  dispose() {
    for (const sub of this.subtitles) {
      sub.clock.disable();
    }

    this.player.textTracks().removeEventListener('change', this.switchTrack.bind(this));
    this.player.off('play', this.play.bind(this));
    this.player.off('pause', this.pause.bind(this));
    this.player.off('seeking', this.seeking.bind(this));
    this.player.off('ratechange', this.ratechange.bind(this));

    window.removeEventListener('resize', this.updateDisplayArea.bind(this));
    this.player.off('loadedmetadata', this.updateDisplayArea.bind(this));
    this.player.off('resize', this.updateDisplayArea.bind(this));
    this.player.off('fullscreenchange', this.updateDisplayArea.bind(this));
  }
}

videojs.registerPlugin('ass', AASSubtitles);
