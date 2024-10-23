<template>
    <div class="form">
        <form @submit.prevent="submitForm">
            <label for="name">Name:</label>
            <input v-model="formData.name" type="text" id="name">
            <label for="email">Email:</label>
            <input v-model="formData.email" type="email" id="email">
            <label for="phone">Phone:</label>
            <input v-model="formData.phone" type="tel" id="phone">
            <label for="address">Address:</label>
            <input v-model="formData.address" type="text" id="address">
            <button type="submit">Submit</button>
        </form>
        <div v-if="message" :class="['toast', isSuccess ? 'toast-success' : 'toast-error']" @click="dismissToast">
            {{ message }}
        </div>
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
            isSuccess: false
        };
    },
    methods: {
        async submitForm() {
            try {
                const response = await axios.post('/submit', this.formData);
                this.message = response.data.success;
                this.isSuccess = true;
                this.formData = {}; // Reset form data
                this.autoDismiss();
            } catch (error) {
                if (error.response && error.response.data.errors) {
                    // If there are validation errors, concatenate them
                    this.message = Object.values(error.response.data.errors)
                        .flat()
                        .join(' '); // Join error messages into a single string
                } else {
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
