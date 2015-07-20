( function($) {
  $(".hello").fitText(1.2);
  $('.loves').textillate({
    selector: '.texts',
    loop: true,
    minDisplayTime: 4000,
    initialDelay: 0,
    autoStart: true,

    // custom set of 'in' effects. This effects whether or not the
    // character is shown/hidden before or after an animation
    inEffects: [],

    // custom set of 'out' effects
    outEffects: [],

    // in animation settings
    in: {
      effect: 'fadeIn',
      delayScale: 3,
      delay: 50,
      sync: false,
      shuffle: true,
      reverse: false,
      callback: function () {}
    },

    // out animation settings.
    out: {
      effect: 'fadeOut',
      delayScale: 3,
      delay: 50,
      sync: false,
      shuffle: true,
      reverse: false,
      callback: function () {}
    },

    // callback that executes once textillate has finished
    callback: function () {},

    // set the type of token to animate (available types: 'char' and 'word')
    type: 'char'
  });
})( jQuery );
