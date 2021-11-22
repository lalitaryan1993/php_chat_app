const searchBar = document.querySelector('.users .search input'),
  searchBtn = document.querySelector('.users .search button'),
  usersList = document.querySelector('.users-list');

searchBtn.onclick = () => {
  searchBar.classList.toggle('active');
  searchBar.focus();
  searchBtn.classList.toggle('active');
  searchBar.value = '';
};

searchBar.onkeyup = () => {
  const searchTerm = searchBar.value;

  if (searchTerm != '') {
    searchBar.classList.add('active');
  } else {
    searchBar.classList.remove('active');
  }

  // let's start Ajax request
  let xhr = new XMLHttpRequest(); // create a new XHR object
  xhr.open('POST', 'php/search.php', true); // open the request
  xhr.onload = () => {
    // when the request is loaded
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.responseText;
        // success
        // console.log(data);
        usersList.innerHTML = data;
      } else {
        // error
        console.log('error');
      }
    }
  };
  //   we have to send the form data through ajax request to php
  xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhr.send('searchTerm=' + searchTerm); // send the form data
};

setInterval(() => {
  // let's start Ajax request
  let xhr = new XMLHttpRequest(); // create a new XHR object
  xhr.open('GET', 'php/users.php', true); // open the request
  xhr.onload = () => {
    // when the request is loaded
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        let data = xhr.responseText;
        // success
        if (!searchBar.classList.contains('active')) {
          // if the search bar is not active
          usersList.innerHTML = data;
        }
      } else {
        // error
        console.log('error');
      }
    }
  };
  //   we have to send the form data through ajax request to php

  xhr.send(); // send the form data
}, 500);
