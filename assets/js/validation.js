const errorContainer = document.getElementById('js-error-container');
let errorMessage     = [];
const arrowIcon      = document.getElementById("js-arrow-icon");
const input          = document.getElementById('js-email-input');

window.onload = function() {
  if(button.style.cursor !== "auto") {
    button.addEventListener("mouseover", function() {
      addArrowClass();
    })

    button.addEventListener("mouseout", function() {
      removeArrowClass();
    })
  }
}

function validateRegEx(email) {
  const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  const result = re.test(String(email).toLowerCase());

  if (!result) {
    errorMessage.push("Please provide a valid e-mail address");
  }
}

function isEmpty(email) {
  if (email.length == 0) {
     errorMessage.push("Email address is required");
  }
}

function validateDomain(email) {
  const rejectedDomain = ".co";

  if (email.endsWith(rejectedDomain)) {
    errorMessage.push("We are not accepting subscriptions from Colombia emails");
  }
}

function validateCheckbox() {
  const checkbox = document.getElementById("js-checkbox");

  if(checkbox.checked === false) {
    errorMessage.push("You must accept the terms and conditions");
  }
}

function oncheckValidation() {
  onsubmitValidation();
}

function onsubmitValidation() {
  errorMessage = [];
  validateCheckbox();
  displayError();
}

function oninputValidation() {
  errorMessage = [];

  let email = input.value;

  if (email.length >= 5) {
    validateRegEx(email);
    validateDomain(email);
  }

  isEmpty(email);
  formatSubmitBtn(email);
  displayError();
}

function generateError(error) {
  let p = document.createElement("p");
  errorContainer.appendChild(p);
  p.setAttribute("class", "error");
  p.innerHTML = `${error}`;
}

function deleteError() {
  errorContainer.innerHTML = "";
}

function displayError() {
  deleteError();

  if (errorMessage.length !== 0) {
    errorContainer.style.display = "block";
  }

  errorMessage.forEach(error => {
    generateError(error);
  });
}

function formatSubmitBtn(email) {
  const button = document.getElementById("button");

  if(errorMessage.length !== 0 || isEmpty(email)) {
    button.disabled = true;
    button.style.cursor = "auto";
    removeArrowClass();
  } else {
    button.style.cursor = "pointer";
    button.disabled = false;
  }
}

input.addEventListener("focusin", function() {
  addArrowClass();
});

input.addEventListener("focusout", function() {
  removeArrowClass();
});

function addArrowClass() {
  arrowIcon.classList.add("active-arrow");
}

function removeArrowClass() {
  arrowIcon.classList.remove("active-arrow");
}


// ============Ajax for pineaple page

$(document).ready(function() {

  $('form').submit(function(event) {
    var formData = {
        'email'  : $('input[name=email]').val()
    };

    $.ajax({
        type     : 'POST',
        url      :'assets/php/functionality.php',
        data     : formData,
        dataType : 'json',
        encode   : true
    })
    .done(function(data) {

        console.log("Kafija");
        console.log(data);
        //atgriez'is success lapu
    });

      event.preventDefault();
  });
});
