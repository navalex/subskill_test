require('../scss/app.scss');

const $ = require('jquery');

require('bootstrap');

$(document).ready(() => {
	$('[data-toggle="tooltip"]').tooltip();
});
