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
        <textarea v-model="formData.address" type="text" id="address" :class="{'input-error': errors.address}"></textarea>
        <span v-if="errors.address" class="error">{{ errors.address }}</span>

        <br>

        <button type="submit">Submit</button>
    </form>
    <div v-if="message" :class="['toast', isSuccess ? 'toast-success' : 'toast-error']" @click="dismissToast">
        {{ message }}
    </div>
</template>

<script>
import form from '../form';

export default {
    ...form // Spread the component from the imported file
};
</script>
