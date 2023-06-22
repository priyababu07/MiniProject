// JavaScript code for handling form submission and showing progress indicator

// Get the form and form elements
const form = document.getElementById('update-form');
const updateButton = document.getElementById('update-button');
const progressIndicator = document.getElementById('progress-indicator');
const errorMessage = document.getElementById('error-message');

// Form submission event listener
form.addEventListener('submit', function(event) {
  event.preventDefault(); // Prevent default form submission
  
  // Show progress indicator and disable update button
  progressIndicator.style.display = 'block';
  updateButton.disabled = true;
  
  // Simulate update process with a delay of 2 seconds (Replace with actual update logic)
  setTimeout(() => {
    // Hide progress indicator and enable update button
    progressIndicator.style.display = 'none';
    updateButton.disabled = false;
    
    // Display success message or error message
    const success = true; // Replace with actual success/error check
    if (success) {
      showMessage('Update successful', 'success');
    } else {
      showMessage('Update failed. Please try again.', 'error');
    }
  }, 2000);
});

// Function to display success or error message
function showMessage(message, type) {
  errorMessage.textContent = message;
  
  if (type === 'success') {
    errorMessage.style.backgroundColor = '#d4edda';
    errorMessage.style.color = '#155724';
    errorMessage.style.borderColor = '#c3e6cb';
  } else if (type === 'error') {
    errorMessage.style.backgroundColor = '#f8d7da';
    errorMessage.style.color = '#721c24';
    errorMessage.style.borderColor = '#f5c6cb';
  }
  
  errorMessage.style.display = 'block';
}
