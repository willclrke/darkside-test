<template>
    <form id="customer" @submit.prevent="submitForm">
        <label for="name">Name:</label>
        <input v-model="formData.name" type="text" id="name" :class="{'input-error': errors.name}">
        <span v-if="errors.name" class="error">{{ errors.name }}</span>

        <label for="email">Email:</label>
        <input v-model="formData.email" type="email" id="email" :class="{'input-error': errors.email}">
        <span v-if="errors.email" class="error">{{ errors.email }}</span>

        <label for="phone">Phone:</label>
        <input v-model="formData.phone" type="tel" id="phone" :class="{'input-error': errors.phone}">
        <span v-if="errors.phone" class="error">{{ errors.phone }}</span>

        <label for="address">Address:</label>
        <input v-model="formData.address" type="text" id="address" :class="{'input-error': errors.address}">
        <span v-if="errors.address" class="error">{{ errors.address }}</span>

        <br>

        <button type="submit">Submit</button>
    </form>
    <div v-if="message" :class="['toast', isSuccess ? 'toast-success' : 'toast-error']" @click="dismissToast">
        {{ message }}
    </div>
</template>

<script>
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
            if (!this.formData.address.trim()) {
                this.errors.address = 'Address is required.';
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
</script>
