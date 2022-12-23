const inputForm = document.getElementById("input-form");
const inputField = document.getElementById("input-field");
const responseContainer = document.getElementById("response-container");

inputForm.addEventListener("submit", event => {
  event.preventDefault();
  const question = inputField.value;

  // Send the question to the server and display the response
  sendRequest(question).then(response => {
    responseContainer.innerHTML = response;
  });

  // Clear the input field
  inputField.value = "";
});

async function sendRequest(question) {
  const endpoint = "api.php";

  const response = await fetch(endpoint, {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded"
    },
    body: "question=" + encodeURIComponent(question)
  });
  const data = await response.text();
  return data;
