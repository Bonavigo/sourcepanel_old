// Dropdowns
var elems = document.querySelectorAll('.dropdown-trigger');
var options = {'coverTrigger':false};
var instances = M.Dropdown.init(elems, options);

// Modais
document.addEventListener('DOMContentLoaded', function() {
  var elems = document.querySelectorAll('.modal');
  var instances = M.Modal.init(elems);
});

// Sidenav
document.addEventListener('DOMContentLoaded', function() {
  var elems = document.querySelectorAll('.sidenav');
  var instances = M.Sidenav.init(elems);
});

//Select
document.addEventListener('DOMContentLoaded', function() {
	var elems = document.querySelectorAll('select');
	var instances = M.FormSelect.init(elems);
});

document.addEventListener('DOMContentLoaded', function() {
  var elems = document.querySelectorAll('.collapsible');
  var instances = M.Collapsible.init(elems);
});

var elems = document.querySelectorAll('.dropdown-notificacoes-trigger');
var options = {alignment:'right', constrainWidth:false};
var instances = M.Dropdown.init(elems, options);

document.addEventListener('DOMContentLoaded', function() {
  var elems = document.querySelectorAll('.tooltippednav');
  var options = {margin:1.25, transitionMovement:2};
  var instances = M.Tooltip.init(elems, options);
});

document.addEventListener('DOMContentLoaded', function() {
  var elems = document.querySelectorAll('.tooltippedbtn');
  var options = {margin:2, transitionMovement:5};
  var instances = M.Tooltip.init(elems, options);
});

document.addEventListener('DOMContentLoaded', function() {
  var elems = document.querySelectorAll('.carousel');
  var options = {fullWidth: true, indicators: true};
  var instances = M.Carousel.init(elems, options);
});

document.addEventListener('DOMContentLoaded', function() {
  var elems = document.querySelectorAll('.dropdown-trigger-not');
  var options = {constrainWidth: false, coverTrigger: false, closeOnClick: false, alignment: 'right'};
  var instances = M.Dropdown.init(elems, options);
});

document.addEventListener('DOMContentLoaded', function() {
  var elems = document.querySelectorAll('.dropdown-trigger-eu');
  var options = {coverTrigger: false, closeOnClick: false, alignment: 'right'};
  var instances = M.Dropdown.init(elems, options);
});