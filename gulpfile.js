const elixir = require('laravel-elixir');
var postStylus = require('poststylus');
require('laravel-elixir-stylus');

elixir.config.publicPath = 'public/';


elixir(mix => {

    // This should not be newed up to much but rather keep it in here.
    mix.styles([
        './node_modules/sweetalert2/dist/sweetalert2.css'
        ], './resources/assets/stylus/Components/Custom/Custom.styl');

    mix.stylus('app.styl', null, {
        use: [postStylus(['lost', 'postcss-position'])]
    });

    mix.version([
        'css/app.css',
    ]);
});