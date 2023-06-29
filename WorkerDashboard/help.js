const updatesContainer = document.querySelector('.updates-container');
const updates = updatesContainer.querySelectorAll('.update');

setInterval(() => {
    const firstUpdate = updates[0];
    updatesContainer.appendChild(firstUpdate);
}, 3000);

// function stopScrolling(element) {
//     element.stop();
//   }
  
//   function resumeScrolling(element) {
//     element.start();
//   }
  
