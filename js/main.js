/* jshint browser: true, devel: true, indent: 2, curly: true, eqeqeq: true, futurehostile: true, latedef: true, undef: true, unused: true */
/* global $, jQuery, document, Modernizr */

var $loadingOverlay = $('#loading');
var fadeSpeed = 800;

var $header = $('#header');
var $mainContent = $('#main-content');

jQuery(document).ready(function () {
  'use strict';

  // set main-content padding top to outer height of header

  $mainContent.css({
    'padding-top': ($header.outerHeight() + 3),
  });

  // on load remove loading gif overlay

  $loadingOverlay.fadeOut(fadeSpeed);

  // utility class mainly for use on headines to avoid widows [single words on a new line]

  $('.js-fix-widows').each(function(){
    var string = $(this).html();

    string = string.replace(/ ([^ ]*)$/,'&nbsp;$1');
    $(this).html(string);
  });

});
