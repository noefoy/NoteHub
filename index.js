// index.js

// Function to fetch and update text from file
// Function to fetch and update text from file
function updateText() {
  // Fetch the raw text file
  fetch('recognized_text.txt')
    .then(response => {
      if (response.ok) {
        return response.text(); // Read the response as text
      } else {
        throw new Error('Text file not available');
      }
    })
    .then(text => {
      // Remove line breaks from the text
      text = text.replace(/\n/g, '');
      // Display the text in the textarea
      document.getElementById('recognized-text').value = text;
    })
    .catch(error => {
      console.error('Error fetching text file:', error);
      // Optionally, you can display a message to the user indicating that the text is not available yet
    });
}

// Set interval to update text every 5 seconds (5000 milliseconds)
setInterval(updateText, 500);

// Update text initially
updateText();

function disableSubmitButton() {
  // Disable the submit button
  document.getElementById('submit-btn').disabled = true;
}

function clearText() {
    document.getElementById('recognized-text').value = '';
}