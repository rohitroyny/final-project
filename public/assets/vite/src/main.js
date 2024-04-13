// Import custom SCSS for styling
import './scss/styles.scss';

// Import all of Bootstrap's JavaScript
import * as bootstrap from 'bootstrap';

// Import jQuery
import * as JQuery from "jquery";
const $ = JQuery.default;

// Example jQuery code for dynamic content loading
$(document).ready(function() {
    // Log jQuery to ensure it's loaded
    console.log('jQuery version:', $.fn.jquery);

    // Example of using jQuery to handle button clicks
    $('#loadEventsButton').on('click', function() {
        loadEvents();
    });

    // Function to load events via AJAX
    function loadEvents() {
        $.ajax({
            url: '/api/events', // API endpoint to get events
            method: 'GET',
            success: function(data) {
                displayEvents(data);
            },
            error: function(error) {
                console.error('Error fetching events:', error);
            }
        });
    }

    // Function to display events
    function displayEvents(events) {
        const eventsList = $('#eventsList');
        eventsList.empty(); // Clear existing events

        // Append each event to the list
        events.forEach(event => {
            eventsList.append(`<li>${event.title} - ${event.date}</li>`);
        });
    }

    // Initialize Bootstrap tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});

// Additional bootstrap JavaScript components initialization if needed
// This ensures that any bootstrap component with JS functionality is active
document.addEventListener('DOMContentLoaded', function () {
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl)
    });
});
