var number = 0;
var cards = document.getElementsByClassName('card');
var next = document.getElementById('next');
var submit = document.getElementById('final');

next.addEventListener("click", function(e) {
	cards[number].classList.add("hidden");
	number += 1;
	cards[number].classList.remove("hidden");
	if(number == (cards.length - 1)){
		final.classList.remove("hidden");
	}
});