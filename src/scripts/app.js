const openFormBtn = document.getElementById("js-open-form");
const formSignup = document.getElementById("js-form");

openFormBtn.addEventListener("click", function () {
  formSignup.classList.remove("hidden");
  openFormBtn.classList.add("hidden");
  setTimeout(function () {
    formSignup.classList.remove("opacity-0");
  }, 200);
});

function loadQuotes() {
  let elements = document.querySelector("#quote-list").children;

  if (window.screen.width < "1023") {
    for (let index = 0; index < 2; index++) {
      elements[index].classList.add("quote-card-" + index);
      elements[index].classList.remove("quote-card-hidden");
    }
  } else {
    for (let index = 0; index < 4; index++) {
      elements[index].classList.add("quote-card-" + index);
      elements[index].classList.remove("quote-card-hidden");
    }
  }

  // TO-DO: Fix fadeOut timing error
  // let interval = 1250;
  // let loop = 1;
  // let fadeOut = () => {
  //   clearInterval(fadeOut);
  //   ++loop;
  //   elements[hidePos].classList.add("animate__fadeOut");
  //   console.log(interval, loop);
  // };

  // setInterval(fadeOut, interval * loop - 50);

  let index = 0;
  let hidePos = 0;
  let showPos = 0;

  if (window.screen.width < "1023") {
    showPos = 2;
  } else {
    showPos = 4;
  }

  let hideQuotes = () => {
    // Hide
    elements[hidePos].classList.remove("quote-card-" + index);
    elements[hidePos].classList.add("quote-card-hidden");

    // TO-DO: Fix fadeOut timing error: elements[hidePos].classList.remove("animate__fadeOut");

    // Show
    elements[showPos].classList.remove("quote-card-hidden");
    elements[showPos].classList.add("quote-card-" + index);

    ++index;
    ++hidePos;
    ++showPos;

    if (showPos === elements.length) {
      showPos = 0;
    }
    if (hidePos === elements.length) {
      hidePos = 0;
    }
    if (window.screen.width < "1023") {
      if (index === 2) {
        index = 0;
      }
    } else {
      if (index === 4) {
        index = 0;
      }
    }
  };
  setInterval(hideQuotes, 1250);
}

loadQuotes();

// TO-DO: When resizing clean list items and start loadQuotes() function
// window.addEventListener("resize", function () {
//   loadQuotes();
// });
