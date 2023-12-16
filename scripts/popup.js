const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);

const stat = urlParams.get("status");
const error = urlParams.get("error");

const popup = document.createElement("div");
popup.setAttribute("id", "popup");
let text = null;

if (stat && !error) {
  popup.removeAttribute("class");
  popup.setAttribute("class", "status");
  switch (stat) {
    case "account_removed":
      text = document.createTextNode("Account removed");
      break;
    case "balance_withdrawn":
      text = document.createTextNode("Money withdrawn successfully");
      break;
    case "deposit_added":
      text = document.createTextNode("Money deposited successfully");
      break;
    case "created":
      text = document.createTextNode("New account created");
      break;
  }
}
if (!stat && error) {
  popup.removeAttribute("class");
  popup.setAttribute("class", "error");
  switch (error) {
    case "empty_fields":
      text = document.createTextNode("Fields cannot be empty");
      break;
    case "balance_not_zero":
      text = document.createTextNode("Cannot delete accounts with non-zero balance");
      break;
    case "short":
      text = document.createTextNode(
        "First and Last name has to be at least 3 characters long"
      );
      break;
    case "invalid_personal_code":
      text = document.createTextNode("Invalid personal code");
      break;
    case "duplicate_personal_code":
      text = document.createTextNode("Account with such personal code already exists");
      break;
  }
}
if (!stat && !error) {
  popup.removeAttribute("class");
  popup.setAttribute("class", "nothing");
  text = document.createTextNode("Nothing");
}

popup.appendChild(text);
document.getElementById("navbar").insertAdjacentElement("afterend", popup);
