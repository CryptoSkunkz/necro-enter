<?php

// Replace with your own API key
$apiKey = "YOUR_API_KEY";

// Read the question from the request
$question = $_POST["question"];

// Send the request to the ChatGPT API and get the response
$response = sendRequest($apiKey, $question);

// Return the response to the client
echo $response;

// Function to send the request to the ChatGPT API
function sendRequest($apiKey, $question) {
  $endpoint = "https://api.openai.com/v1/chat";
  $model = "chatbot";

  // Create the request body
  $data = array(
    "model" => $model,
    "prompt" => $question
  );
  $options = array(
    "http" => array(
      "header" => "Content-type: application/x-www-form-urlencoded\r\n" .
                  "Authorization: Bearer " . $apiKey . "\r\n",
      "method" => "POST",
      "content" => http_build_query($data)
    )
  );

  // Send the request and get the response
  $context = stream_context_create($options);
  $result = file_get_contents($endpoint, false, $context);
  if ($result === false) {
    return "Error making request";
  }
  $response = json_decode($result);
  return $response->choices[0]->text;
}
