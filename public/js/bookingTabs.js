// JavaScript for Tabs in mybooking page
document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('.tabs .tab');
    const bookingItems = document.querySelectorAll('.booking-list .booking');

    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            // Update active tab class
            tabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');

            const filter = this.getAttribute('data-tab-filter');

            // Filter booking items
            bookingItems.forEach(item => {
                const itemStatus = item.getAttribute('data-status');
                if (filter === 'all') {
                    item.style.display = 'flex'; 
                } else {
                    if (itemStatus === filter) {
                       item.style.display = 'flex';
                    } else {
                       item.style.display = 'none';
                    }
                }
             });
        });
    });
});

