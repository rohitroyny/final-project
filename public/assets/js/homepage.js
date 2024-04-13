console.log('Homepage is now loaded');

// Function to fetch upcoming events
function fetchUpcomingEvents() {
    fetch('/events/upcoming') // Adjust the endpoint as necessary
        .then(response => response.json())
        .then(events => displayEvents(events))
        .catch(error => console.error('Error fetching events:', error));
}

// Function to display events on the homepage
function displayEvents(events) {
    const eventsContainer = document.getElementById('upcoming-events');
    events.forEach(event => {
        const eventElement = document.createElement('div');
        eventElement.className = 'event';
        eventElement.innerHTML = `<h4>${event.title}</h4><p>${event.date} - ${event.time}</p>`;
        eventsContainer.appendChild(eventElement);
    });
}

// Function to show reminders
function checkReminders() {
    fetch('/reminders/today') // Adjust the endpoint as necessary
        .then(response => response.json())
        .then(reminders => {
            reminders.forEach(reminder => {
                alert('Reminder: ' + reminder.title);
            });
        })
        .catch(error => console.error('Error checking reminders:', error));
}

// Event listener for adding a quick event
document.getElementById('add-event-btn').addEventListener('click', function() {
    const title = document.getElementById('event-title').value;
    const date = document.getElementById('event-date').value;
    const time = document.getElementById('event-time').value;

    fetch('/events/create', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ title, date, time })
    })
    .then(response => {
        if (response.ok) {
            console.log('Event added successfully');
            fetchUpcomingEvents(); // Refresh the list of upcoming events
        } else {
            console.error('Failed to add event');
        }
    })
    .catch(error => console.error('Error adding event:', error));
});

// Call these functions when the page loads
window.onload = function() {
    fetchUpcomingEvents();
    checkReminders();
}
