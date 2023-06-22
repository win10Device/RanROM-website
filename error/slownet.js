var slowLoad = window.setTimeout( function() { window.stop(); console.log("Page too long to load!"); }, 1000 ); window.addEventListener( 'load', function() { window.clearTimeout( slowLoad ); }, false );

