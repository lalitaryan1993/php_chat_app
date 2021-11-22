const form = document.querySelector('.typing-area'),
  inputField = document.querySelector('.input-field'),
  sendBtn = document.querySelector('.send-button'),
  chatBox = document.querySelector('.chat-box');

const ajaxRequest = () => {
  // let's start Ajax request
  let xhr = new XMLHttpRequest(); // create a new XHR object
  xhr.open('POST', 'php/insert-chat.php', true); // open the request
  xhr.onload = () => {
    // when the request is loaded
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.responseText;
        // console.log(data);
        // success
        inputField.value = ''; // once the message is inserted into database clear the input field
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
sendBtn.onclick = (e) => {
  e.preventDefault();
  ajaxRequest();
};
// Execute a function when the user releases a key on the keyboard
// inputField.addEventListener('submit', function (event) {
//   console.log(event.keyCode);
//   // Number 13 is the "Enter" key on the keyboard
//   if (event.keyCode === 13) {
//     // Cancel the default action, if needed
//     event.preventDefault();
//     // Trigger the button element with a click
//     ajaxRequest();
//   }
// });

chatBox.onmouseenter = () => {
  chatBox.classList.add('active');
};

chatBox.onmouseleave = () => {
  chatBox.classList.remove('active');
};

setInterval(() => {
  // let's start Ajax request
  let xhr = new XMLHttpRequest(); // create a new XHR object
  xhr.open('POST', 'php/get-chat.php', true); // open the request
  xhr.onload = () => {
    // when the request is loaded
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.responseText;
        // success
        chatBox.innerHTML = data;
        if (!chatBox.classList.contains('active')) {
          // if the chat box is not active
          scrollToBottom();
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
}, 500);

function scrollToBottom() {
  chatBox.scrollTop = chatBox.scrollHeight;
}
