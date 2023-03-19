const usernameLabel = document.getElementById("username-label");
const usernameInput = document.getElementById("username-input");
const passwordLabel = document.getElementById("password-label");
const passwordInput = document.getElementById("password-input");
const submitButton = document.getElementById("submit-button");
const usernameLabelText = "Username:";
const passwordLabelText = "Password:";
let usernameIndex = 0;
let passwordIndex = 0;

function typeUsernameLabel() {
  if (usernameIndex < usernameLabelText.length) {
    usernameLabel.textContent += usernameLabelText.charAt(usernameIndex);
    usernameIndex++;
    setTimeout(typeUsernameLabel, 100);
  } else {
    usernameInput.disabled = false;
    usernameInput.focus();
  }
}

function typePasswordLabel() {
  if (passwordIndex < passwordLabelText.length) {
    passwordLabel.textContent += passwordLabelText.charAt(passwordIndex);
    passwordIndex++;
    setTimeout(typePasswordLabel, 100);
  } else {
    passwordInput.disabled = false;
    passwordInput.focus();
    document.getElementById("submit-button").classList.remove("hidden");
    document.getElementById("submit-button").removeAttribute("disabled"); // Remove the disabled attribute
  }
}



function handleFormSubmit(e) {
  e.preventDefault();
  const username = usernameInput.value;
  const password = passwordInput.value;
  // Do something with the username and password inputs here
  console.log(`Username: ${username}, Password: ${password}`);
}

function handleUsernameInput(e) {
  if (e.keyCode === 13) { // Enter key
    usernameInput.disabled = true;
    passwordLabel.classList.remove("hidden");
    passwordInput.classList.remove("hidden");
    typePasswordLabel();
  }
}

function handlePasswordInput(e) {
  if (e.keyCode === 13) { // Enter key
    document.getElementById("submit-button").click(); // Submit the form
  }
}


submitButton.classList.add("hidden");
submitButton.disabled = true;
usernameInput.disabled = true;
typeUsernameLabel();
usernameInput.addEventListener("keydown", handleUsernameInput);

passwordLabel.classList.add("hidden");
passwordInput.classList.add("hidden");
passwordInput.disabled = true;
passwordInput.addEventListener("keydown", handlePasswordInput);

submitButton.addEventListener("click", handleFormSubmit);
