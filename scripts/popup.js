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
    case "user_created":
      text = document.createTextNode("New user created");
      break;
    case "signed_in":
      text = document.createTextNode("Signed In");
      break;
    case "signed_out":
      text = document.createTextNode("Signed out");
      break;
    case "wrong_password":
      text = document.createTextNode("Wrong password");
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
      text = document.createTextNode("Cannot close accounts with non-zero balance");
      break;
    case "invalid_amount":
      text = document.createTextNode("Invalid amount");
      break;
    case "short":
      text = document.createTextNode(
        "First and Last name has to be at least 3 characters long"
      );
      break;
    case "long":
      text = document.createTextNode(
        "First and Last name cannot be longer than 13 characters"
      );
      break;
    case "invalid_personal_code":
      text = document.createTextNode("Invalid personal code");
      break;
    case "duplicate_personal_code":
      text = document.createTextNode("Account with such personal code already exists");
      break;
    case "duplicate_email":
      text = document.createTextNode("Account with such email already exists");
      break;
    case "invalid_email":
      text = document.createTextNode("Invalid email address");
      break;
    case "passwords_do_not_match":
      text = document.createTextNode("Passwords do not match");
      break;
    case "email_not_found":
      text = document.createTextNode("Account with such email address does not exist");
      break;
    case "wrong_password":
      text = document.createTextNode("Wrong password");
      break;
    case "not_signed_in":
      text = document.createTextNode("Sign in to use this feature");
      break;
    case "already_signed_in":
      text = document.createTextNode("Sign out to access this page");
      break;
    case "unauthorized":
      text = document.createTextNode("Unauthorized");
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
