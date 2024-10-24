import axios from 'axios';

export default {
    data() {
        return {
            formData: {
                name: '',
                email: '',
                phone: '',
                address: ''
            },
            message: '',
            isSuccess: false,
            errors: {
                name: '',
                email: '',
                phone: '',
                address: ''
            }
        };
    },
    methods: {
        validateForm() {
            this.errors = { name: '', email: '', phone: '', address: '' }; // Reset errors

            let valid = true;

            if (!this.formData.name.trim()) {
                this.errors.name = 'Name is required.';
                valid = false;
            }
            if (!this.validateEmail(this.formData.email)) {
                this.errors.email = 'Invalid email format.';
                valid = false;
            }
            if (!this.validatePhone(this.formData.phone)) {
                this.errors.phone = 'Invalid phone number format.';
                valid = false;
            }
            if (!this.validateAddress(this.formData.address)) {
                this.errors.address = 'Please enter a valid UK address.';
                valid = false;
            }

            return valid; // Return true only if all fields are valid
        },
        validateEmail(email) {
            const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return regex.test(email);
        },
        validatePhone(phone) {
            const regex = /^(?:\+44|0)7\d{9}$|^(?:\+44|0)1\d{3} \d{3} \d{3}$|^(?:\+44|0)2\d{3} \d{3} \d{4}$|^(\+44\s?7\d{3}|\(0\)7\d{3}|\(0\)\d{3}|\d{4})\s?\d{3}\s?\d{3}$/; // UK phone number regex
            return regex.test(phone);
        },
        validateAddress(address) {
            const regex = /^(.|\n)+$/; // Match any character (including line breaks) at least once
            return regex.test(address.trim());
        },
        sanitizeInput() {
            this.formData.name = this.formData.name.replace(/[<>]/g, ''); // Simple XSS protection
            this.formData.address = this.formData.address.replace(/[<>]/g, ''); // Simple XSS protection
        },
        async submitForm() {
            // Check if passed frontend validation
            if (!this.validateForm()) {
                return; // Stop submission if validation fails
            }

            // Sanitize
            this.sanitizeInput();

            try {
                const response = await axios.post('/submit', this.formData);
                this.message = response.data.success;
                this.isSuccess = true;
                this.formData = { name: '', email: '', phone: '', address: '' }; // Reset form data
                this.autoDismiss();
            } catch (error) {
                if (error.response && error.response.data.errors) {
                    // If there are validation errors from controller, concatenate them
                    this.errors = error.response.data.errors;
                } else {
                    // Default error
                    this.message = 'An unexpected error occurred. Please try again.';
                }
                this.isSuccess = false;
                this.autoDismiss();
            }
        },
        autoDismiss() {
            setTimeout(() => {
                this.message = '';
            }, 6000);
        },
        dismissToast() {
            this.message = '';
        }
    }
};