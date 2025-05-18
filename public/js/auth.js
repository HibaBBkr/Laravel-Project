document.addEventListener('DOMContentLoaded', () => {
    let jsCurrentSelectedRole = 'customer'; // Default role for signup, can be updated

    // Attempt to read server-side configuration
    let initialRoleFromServer = 'customer';
    let openModalIdFromServer = null;

    if (window.authConfig) {
        console.log("Initial authConfig:", window.authConfig);
        if (window.authConfig.initialRole) {
            initialRoleFromServer = window.authConfig.initialRole;
        }
        jsCurrentSelectedRole = initialRoleFromServer; // Set current role based on server (for signup)
        
        if (window.authConfig.errorsExist && window.authConfig.openModal) {
            openModalIdFromServer = window.authConfig.openModal; // 'login' or 'signup'
            console.log(`Server indicates to open modal: ${openModalIdFromServer} with initial role (for signup): ${initialRoleFromServer}`);
        }
    }

    console.log('DOM fully loaded and parsed.');
    // --- LOGIN MODAL RELEVANT ---
    const loginModalEl = document.getElementById('loginModal'); 
    const openLoginModalButton = document.getElementById('openLoginModalButton');
    const loginToSignupLink = document.getElementById('loginToSignupLink');
    const loginForm = document.getElementById('loginForm');
    // --- END LOGIN MODAL RELEVANT ---

    // --- SIGNUP MODAL RELEVANT ---
    const signupModalEl = document.getElementById('signupModal');
    const openSignupModalButton = document.getElementById('openSignupModalButton');
    const signupToLoginLink = document.getElementById('signupToLoginLink');
    const customerSignupFormEl = document.getElementById('custumerSignupForm'); // Note: HTML ID is 'custumerSignupForm'
    const ownerSignupFormEl = document.getElementById('ownerSignupForm');
    const roleSelector = signupModalEl ? signupModalEl.querySelector('.role-selector') : null;
    const roleButtons = roleSelector ? Array.from(roleSelector.querySelectorAll('.role-btn')) : [];
    const customerFormFieldsEl = document.getElementById('customerFormFields');
    const ownerFormFieldsEl = document.getElementById('ownerFormFields');
    const allFormSections = [];
    if (customerFormFieldsEl) allFormSections.push(customerFormFieldsEl);
    if (ownerFormFieldsEl) allFormSections.push(ownerFormFieldsEl);
    // --- END SIGNUP MODAL RELEVANT ---


    // --- GENERIC MODAL FUNCTIONS (USED BY BOTH) ---
    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        console.log(`Opening modal: ${modalId}`, modal);
        if (!modal) return;

        modal.style.display = 'flex';
        requestAnimationFrame(() => { 
            modal.classList.add('modal-active');
        });

        // If opening signup modal, ensure correct role is selected and form displayed
        if (modalId === 'signupModal') {
            // jsCurrentSelectedRole should reflect the latest state (initial from server or user's last choice)
            selectRole(jsCurrentSelectedRole);
        }
    }

    function closeModal(modalId, callback) {
        const modal = document.getElementById(modalId);
        console.log(`Closing modal: ${modalId}`, modal);
        if (!modal || !modal.classList.contains('modal-active')) {
            if (callback) callback();
            return;
        }

        modal.classList.remove('modal-active');

        function handleTransitionEnd(event) {
            if (event.target === modal && event.propertyName === 'opacity') {
                modal.style.display = 'none';
                modal.removeEventListener('transitionend', handleTransitionEnd);
                if (callback) callback();
            }
        }
        modal.addEventListener('transitionend', handleTransitionEnd);

        setTimeout(() => {
            if (modal.style.display !== 'none' && !modal.classList.contains('modal-active')) {
                console.warn(`Transitionend fallback for closing modal ${modalId}`);
                modal.style.display = 'none';
                modal.removeEventListener('transitionend', handleTransitionEnd);
                if (callback) callback();
            }
        }, 350); 
    }
    // --- END GENERIC MODAL FUNCTIONS ---

    // --- LOGIN MODAL EVENT LISTENERS ---
    if (openLoginModalButton) {
        openLoginModalButton.addEventListener('click', () => openModal('loginModal'));
    }
    // --- END LOGIN MODAL EVENT LISTENERS ---

    // --- SIGNUP MODAL EVENT LISTENERS & FUNCTIONS ---
    if (openSignupModalButton) {
        openSignupModalButton.addEventListener('click', () => {
            openModal('signupModal'); // openModal will call selectRole for signup
        });
    }

    // File upload display for owner license (within ownerFormFieldsEl - signup specific)
    if (ownerFormFieldsEl) {
        const hallLicenseFileInput = ownerFormFieldsEl.querySelector('#hall-license-file');
        const hallLicenseFilenameDisplay = ownerFormFieldsEl.querySelector('#hall-license-filename');

        if (hallLicenseFileInput && hallLicenseFilenameDisplay) {
            hallLicenseFileInput.addEventListener('change', function() {
                if (this.files && this.files.length > 0) {
                    hallLicenseFilenameDisplay.value = this.files[0].name;
                } else {
                    hallLicenseFilenameDisplay.value = hallLicenseFilenameDisplay.getAttribute('placeholder') || 'No file chosen';
                }
            });
        }
    }
    
    const commonFieldsMap = { /* ... names for common inputs ... */
        'name': 'name', 'email': 'email', 'password': 'password',
        'password_confirmation': 'password_confirmation', 'phone_number': 'phone_number'
    };
    const ownerSpecificFieldsMap = { /* ... names for owner inputs ... */
        'id_card_number': 'id_card_number', 'license_file': 'license_file', 'terms': 'terms'
    };

    function configureFormSection(sectionElement, isActive, isOwnerSectionContext) {
        // (Logic to enable/disable/require fields within a signup form section)
        if (!sectionElement) return;
        const inputs = sectionElement.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
            input.disabled = !isActive;
            let originalIdPart = '';

            if (input.id.startsWith('signup-customer-')) originalIdPart = input.id.substring('signup-customer-'.length);
            else if (input.id.startsWith('signup-owner-')) originalIdPart = input.id.substring('signup-owner-'.length);
            else if (input.id === 'signup-id-card') originalIdPart = 'id_card_number';
            else if (input.id === 'hall-license-file') originalIdPart = 'license_file';
            else if (input.id === 'hall-license-filename') { input.name = ''; return; }
            else if (input.id === 'signup-terms') originalIdPart = 'terms';
            else if (input.id.startsWith('signup-')) originalIdPart = input.id.substring('signup-'.length);

            if (isActive) {
                if (commonFieldsMap[originalIdPart]) {
                    input.name = commonFieldsMap[originalIdPart];
                    input.required = (originalIdPart !== 'phone_number'); // Example: phone optional
                } else if (isOwnerSectionContext && ownerSpecificFieldsMap[originalIdPart]) {
                    input.name = ownerSpecificFieldsMap[originalIdPart];
                    input.required = (originalIdPart !== 'license_file'); // Example: license optional
                } else {
                    input.name = ''; input.required = false;
                }
                if (input.name === 'password_confirmation') {
                    const pwField = sectionElement.querySelector('[name="password"]');
                    input.required = !!(pwField && pwField.required);
                }
            } else {
                input.name = ''; input.required = false;
                if (input.type === 'file') {
                    input.value = '';
                    if (originalIdPart === 'license_file' && sectionElement.id === 'ownerFormFields') {
                        const display = sectionElement.querySelector('#hall-license-filename');
                        if(display) display.value = display.getAttribute('placeholder') || "No file chosen"; 
                    }
                }
                if (input.type === 'checkbox' || input.type === 'radio') input.checked = false;
            }
        });
    }

    function setActiveFormsAndFields(selectedRole) {
    console.log(`setActiveFormsAndFields called with role: ${selectedRole}`);

    if (customerSignupFormEl) {
        customerSignupFormEl.style.display = (selectedRole === 'customer') ? 'block' : 'none';
    }
    if (ownerSignupFormEl) {
        ownerSignupFormEl.style.display = (selectedRole === 'owner') ? 'block' : 'none';
    }

    allFormSections.forEach(section => {
        if (!section) return; // Should not happen if IDs are correct

        const isCustomerSectionTarget = section.id === 'customerFormFields';
        const isOwnerSectionTarget = section.id === 'ownerFormFields';
        let isActive = false;

        if (selectedRole === 'customer' && isCustomerSectionTarget) {
            isActive = true;
        } else if (selectedRole === 'owner' && isOwnerSectionTarget) {
            isActive = true;
        }

        if (isActive) {
            section.style.display = 'block'; // Ensure it's in the layout flow
            section.classList.add('active-section'); // Apply CSS rules for active state (e.g., initial large max-height, opacity)

            // Defer scrollHeight calculation to ensure styles are applied and dimensions are correct
            setTimeout(() => {
                // Double check it's still supposed to be active, in case of rapid changes
                if (section.classList.contains('active-section')) {
                    section.style.maxHeight = section.scrollHeight + 'px';
                    console.log(`Section ${section.id} scrollHeight: ${section.scrollHeight}px, new maxHeight: ${section.style.maxHeight}`); // For debugging
                }
            }, 50); // A small delay (e.g., 50ms) can be enough

            // Opacity and visibility are often better handled by the .active-section class via CSS
            section.style.opacity = '1';
            section.style.visibility = 'visible';
        } else {
            section.classList.remove('active-section');
            // Let CSS primarily handle the collapsed state via :not(.active-section) or base .form-section styles
            // but explicitly setting can be a fallback.
            section.style.opacity = '0';
            section.style.visibility = 'hidden';
            section.style.maxHeight = '0';

            // Optional: to ensure display:none after transition, you'd need a transitionend listener.
            // For now, max-height: 0 and visibility: hidden should suffice.
        }
        // configureFormSection should be called regardless of the setTimeout for scrollHeight
        configureFormSection(section, isActive, isOwnerSectionTarget);
    });
}

    function selectRole(selectedRole) { // For signup
        console.log('Role selected (signup):', selectedRole);
        jsCurrentSelectedRole = selectedRole; // Update global JS state

        roleButtons.forEach(btn => btn.classList.toggle('active', btn.dataset.role === selectedRole));
        setActiveFormsAndFields(selectedRole);
    }

    // Initialize signup form state based on server info or default
    if (signupModalEl) { // Only if signup modal exists
      selectRole(initialRoleFromServer); // Uses role from authConfig or 'customer'
    }


    if (roleSelector) { // Signup role selector
        roleSelector.addEventListener('click', (event) => {
            const targetButton = event.target.closest('.role-btn');
            if (!targetButton || targetButton.classList.contains('active')) return;
            selectRole(targetButton.dataset.role);
        });
    }
    // --- END SIGNUP MODAL EVENT LISTENERS & FUNCTIONS ---

    // --- FORM SUBMIT HANDLERS ---
    if (customerSignupFormEl) { // Signup customer
        customerSignupFormEl.addEventListener('submit', function(event) {
            console.log(`Customer Signup form submitted.`);
            // Actual submission is handled by browser unless event.preventDefault() is called for AJAX
        });
    }

    if (ownerSignupFormEl) { // Signup owner
        ownerSignupFormEl.addEventListener('submit', function(event) {
            console.log(`Owner Signup form submitted.`);
            if (ownerFormFieldsEl) {
                const termsCheckbox = ownerFormFieldsEl.querySelector('#signup-terms');
                if (termsCheckbox && termsCheckbox.required && !termsCheckbox.checked) {
                    alert("Please agree to the terms and conditions to sign up as an owner.");
                    event.preventDefault(); 
                }
            }
        });
    }

    // --- LOGIN FORM SUBMIT HANDLER ---
    if (loginForm) {
        loginForm.addEventListener('submit', function(event) {
            console.log('Log In form submitted.');
            // Actual submission is handled by browser unless event.preventDefault() is called for AJAX
        });
    }
    // --- END FORM SUBMIT HANDLERS ---


    // --- GENERIC CLOSE BUTTON & MODAL SWITCHING LINKS (USED BY BOTH) ---
    document.querySelectorAll('.close-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const modal = btn.closest('.login-modal, .signup-modal');
            if (modal) closeModal(modal.id);
        });
    });

    if (loginToSignupLink) { // Link in Login Modal to open Signup
        loginToSignupLink.addEventListener('click', (e) => {
            e.preventDefault();
            closeModal('loginModal', () => {
                openModal('signupModal'); // Will use jsCurrentSelectedRole (last selected, or initial from server)
            });
        });
    }
    if (signupToLoginLink) { // Link in Signup Modal to open Login
        signupToLoginLink.addEventListener('click', (e) => {
            e.preventDefault();
            closeModal('signupModal', () => {
                openModal('loginModal');
            });
        });
    }
    // --- END GENERIC CLOSE BUTTON & MODAL SWITCHING ---

    // --- INITIAL MODAL OPENING LOGIC (ON PAGE LOAD) ---
    if (openModalIdFromServer) {
        openModal(openModalIdFromServer); 
        // If 'signupModal', selectRole(initialRoleFromServer) was already handled by its openModal path.
    } else {
        // Fallback if authConfig isn't set but errors are visible in HTML (less ideal)
        if (loginForm && loginForm.querySelector('.alert-danger:not([style*="display: none"])')) {
            console.log("Fallback: Opening login modal due to visible error alert.");
            openModal('loginModal');
        }
        // Fallback for signup (if authConfig didn't specify, but errors are present)
        // This relies on `initialRoleFromServer` being correctly set even if `openModalIdFromServer` is not.
        else if (signupModalEl && signupModalEl.querySelector('.alert-danger:not([style*="display: none"])')) {
             console.log("Fallback: Opening signup modal due to visible error alert.");
             openModal('signupModal'); // This will call selectRole with initialRoleFromServer
        }
    }
    // --- END INITIAL MODAL OPENING ---
});