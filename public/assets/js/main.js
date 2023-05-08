(function($) {

	"use strict";

	var fullHeight = function() {

		$('.js-fullheight').css('height', $(window).height());
		$(window).resize(function(){
			$('.js-fullheight').css('height', $(window).height());
		});

	};
	fullHeight();

	$('#sidebarCollapse').on('click', function () {
      $('#sidebar').toggleClass('active');
  });

})(jQuery);


// add object hidde
function hideDiv() {
	document.getElementById("convocation").style.display = "none";
}
function showDiv() {
	document.getElementById("convocation").style.display = "block";
}
function hideDive() {
	document.getElementById("convocatione").style.display = "none";
}
function showDive() {
	document.getElementById("convocatione").style.display = "block";
}


function toggleText() {
	var elms = document.querySelectorAll("#maDIV1, #maDIV2, #maDIV3, #maDIV0")

	Array.from(elms).forEach((x) => {
		if (x.style.display === "none") {
			x.style.display = "block";
		} else {
			x.style.display = "none";
		}
	})
}
// categories et sous categories 


Categoriesanddetails(0, 0, 1)
Categoriesanddetails(1, 1, 5)
Categoriesanddetails(2, 5, 8)
Categoriesanddetails(3, 8, 11)
Categoriesanddetails(4, 11, 14)
Categoriesanddetails(5, 14, 17)
Categoriesanddetails(6, 17, 20)
Categoriesanddetails(7, 20, 23)
Categoriesanddetails(8, 23, 30)


function Categoriesanddetails(ev, Nmin, Nmax) {

	var options = document.querySelector('#ad_lost_categoriesdetails').options;
	for (let i = 0; i < options.length; i++) {
		options[i].style.display = 'none';
	}

	document.querySelector('#ad_lost_categoriesdetails').style.display = 'none';
	options[0].style.display = 'none';
	const categories = document.querySelector("#ad_lost_categories");
	categories.addEventListener("change", function () {

		let category = categories.value;
		console.log('categories' + category);

		if (category == ev) {


			document.querySelector('#ad_lost_categoriesdetails').style.display = 'block';
			for (let i = Nmin; i < Nmax; i++) {
				document.querySelector('#ad_lost_categoriesdetails').options[Nmin].selected = "true"
				document.querySelector('#ad_lost_categoriesdetails').options[i].style.display = 'block';
			}
		} else {
			for (let i = Nmin; i < Nmax; i++) {
				document.querySelector('#ad_lost_categoriesdetails').options[i].style.display = 'none';
			}
		};
	});
}