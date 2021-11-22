const form = document.querySelector('.signup form'),
  continueBtn = document.querySelector('.button input'),
  errorText = document.querySelector('.error-txt');

form.onsubmit = (e) => {
  e.preventDefault(); // prevent the form from submitting
};

continueBtn.onclick = () => {
  // let's start Ajax request
  let xhr = new XMLHttpRequest(); // create a new XHR object
  xhr.open('POST', 'php/signup.php', true); // open the request
  xhr.onload = () => {
    // when the request is loaded
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.responseText;
        // success
        if (data === 'success') {
          window.location.href = 'users.php';
        } else {
          errorText.textContent = data;
          errorText.style.display = 'block';
        }
      } else {
        // error
        console.log('error');
      }
    }
  };
  //   we have to send the form data through ajax request to php
  let formData = new FormData(form);
  xhr.send(formData); // send the form data
};
