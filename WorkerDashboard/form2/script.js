// Variables to track the current section and total sections
let currentSection = 0;
const totalSections = document.querySelectorAll('.form-section').length;

// Show the current section and hide the rest
function showSection() {
  const sections = document.querySelectorAll('.form-section');
  sections.forEach((section, index) => {
    if (index === currentSection) {
      section.style.display = 'block';
    } else {
      section.style.display = 'none';
    }
  });

  // Update the buttons
  updateButtons();
}

// Handle previous section
function prevSection() {
  if (currentSection > 0) {
    currentSection--;
    showSection();
  }
}

// Handle next section
function nextSection() {
  if (validateSection()) {
    if (currentSection < totalSections - 1) {
      currentSection++;
      showSection();
    } else {
      // Submit the form if it's the last section
      document.getElementById('emergencyContactForm').submit();
    }
  }
}

// Validate the current section
function validateSection() {
  const currentForm = document.getElementById(`section${currentSection + 1}`).querySelector('form');
  if (currentForm.checkValidity()) {
    return true;
  } else {
    currentForm.reportValidity();
    return false;
  }
}

// Update the buttons based on the current section
function updateButtons() {
  const prevBtn = document.getElementById('prevBtn');
  const nextBtn = document.getElementById('nextBtn');

  if (currentSection === 0) {
    prevBtn.style.display = 'none';
  } else {
    prevBtn.style.display = 'inline-block';
  }

  if (currentSection === totalSections - 1) {
    nextBtn.textContent = 'Submit';
  } else {
    nextBtn.textContent = 'Next';
  }
}

// Show the initial section on page load
showSection();
