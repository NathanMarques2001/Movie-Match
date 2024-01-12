const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const error = urlParams.get('error');

if (error != null) {
  alert(error);
  window.history.replaceState({}, document.title, window.location.pathname);
}