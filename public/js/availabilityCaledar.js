// --- Interactive Calendar Script ---
    const calendarBody = document.getElementById('calendar-body');
            const monthYearDisplay = document.getElementById('current-month-year-display');
            const prevMonthBtn = document.getElementById('prev-month-btn');
            const nextMonthBtn = document.getElementById('next-month-btn');

            if (calendarBody && monthYearDisplay && prevMonthBtn && nextMonthBtn) {
                let currentDate = new Date(); // Use current date as a starting point
                currentDate.setMonth(2);      // Set to March (0-indexed, so 2 is March)
                currentDate.setFullYear(2025);// Set to 2025 (to match initial display)


                // --- Mock data for event statuses (replace with actual data source) ---
                // Format: 'YYYY-MM-DD': 'statusClass'
                const eventData = {
                    '2025-03-11': 'reserved', '2025-03-12': 'reserved', '2025-03-13': 'reserved',
                    '2025-03-18': 'reserved', '2025-03-19': 'reserved', '2025-03-20': 'reserved',
                    '2025-03-27': 'required',
                    '2025-03-30': 'vacation', '2025-03-31': 'vacation',
                    // Add more dates and statuses as needed for different months
                    '2025-04-05': 'reserved',
                    '2025-04-10': 'required',
                };

                function renderCalendar(year, month) { // month is 0-indexed
                    calendarBody.innerHTML = ''; // Clear previous days
                    monthYearDisplay.textContent = `${new Date(year, month).toLocaleString('default', { month: 'long' })} ${year}`;

                    let firstDayOfMonth = new Date(year, month, 1).getDay(); // 0 (Sun) to 6 (Sat)
                    let daysInMonth = new Date(year, month + 1, 0).getDate();

                    let date = 1;
                    for (let i = 0; i < 6; i++) { // Max 6 rows for a month
                        let row = document.createElement('tr');

                        for (let j = 0; j < 7; j++) {
                            let cell = document.createElement('td');
                            if (i === 0 && j < firstDayOfMonth) {
                                // Empty cell before the first day
                                cell.classList.add('empty');
                            } else if (date > daysInMonth) {
                                // Empty cell after the last day
                                cell.classList.add('empty');
                            } else {
                                cell.classList.add('day');
                                cell.textContent = date;

                                // Check for event status
                                const dateString = `${year}-${String(month + 1).padStart(2, '0')}-${String(date).padStart(2, '0')}`;
                                if (eventData[dateString]) {
                                    cell.classList.add(eventData[dateString]);
                                }

                                // Optional: Add click listener for date selection
                                cell.addEventListener('click', function() {
                                    console.log(`Selected date: ${year}-${month + 1}-${this.textContent}`);
                                    // Add logic here to handle date selection, e.g., highlight, open modal
                                    // Remove previous selections if any
                                    document.querySelectorAll('#calendar-body .day.selected').forEach(d => d.classList.remove('selected'));
                                    this.classList.add('selected');
                                });
                                date++;
                            }
                            row.appendChild(cell);
                        }
                        calendarBody.appendChild(row);
                        if (date > daysInMonth && i > 0) break; // Stop if all days are rendered
                    }
                }

                prevMonthBtn.addEventListener('click', () => {
                    currentDate.setMonth(currentDate.getMonth() - 1);
                    renderCalendar(currentDate.getFullYear(), currentDate.getMonth());
                });

                nextMonthBtn.addEventListener('click', () => {
                    currentDate.setMonth(currentDate.getMonth() + 1);
                    renderCalendar(currentDate.getFullYear(), currentDate.getMonth());
                });
                
                // Initial render
                renderCalendar(currentDate.getFullYear(), currentDate.getMonth());
            } else {
                console.warn("Calendar elements not found. Interactive calendar disabled.");
            }

            document.addEventListener('DOMContentLoaded', () => {
                const menuContainer = document.querySelector('.user-menu-container');
                const triggerButton = document.querySelector('.user-menu-trigger');
    
                if (menuContainer && triggerButton) {
                    triggerButton.addEventListener('click', (event) => {
                        event.stopPropagation();
                        menuContainer.classList.toggle('open');
                        const isOpen = menuContainer.classList.contains('open');
                        triggerButton.setAttribute('aria-expanded', isOpen.toString());
                    });
                    document.addEventListener('click', (event) => {
                        if (menuContainer.classList.contains('open') && !menuContainer.contains(event.target)) {
                            menuContainer.classList.remove('open');
                            triggerButton.setAttribute('aria-expanded', 'false');
                        }
                    });
                    document.addEventListener('keydown', (event) => {
                        if (event.key === 'Escape' && menuContainer.classList.contains('open')) {
                            menuContainer.classList.remove('open');
                            triggerButton.setAttribute('aria-expanded', 'false');
                            triggerButton.focus();
                        }
                    });
                }
            }); 
            
        


        



