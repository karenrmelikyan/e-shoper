<template>
    <div>
        <button class="open-btn" @click="openPopup">Support</button>
        <div class="chat-popup" :style="{height: popupHeight}" ref="popup">
            <div class="chat-popup-header">
                <h3>Support</h3>
                <button class="close-btn" @click="closePopup">&times;</button>
            </div>
            <div class="chat-popup-body">
                <form @submit.prevent="sendMessage">
                    <input type="text" placeholder="Type your message..." v-model="message">
                    <button type="submit">Send</button>
                </form>
                <div class="message" v-for="(message, index) in messages" :key="index">
                    {{ message }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            popupHeight: 0,
            message: '',
            messages: [],
        };
    },
    methods: {
        openPopup() {
            this.popupHeight = '500px';
            this.$refs.popup.style.display = 'block';
        },
        closePopup() {
            this.popupHeight = 0;
            this.$refs.popup.style.display = 'none';
        },
        sendMessage() {
            if (this.message.trim() !== '') {
                this.messages.push(this.message);
                this.message = '';
            }
        },
    },
};
</script>

<style>
.chat-popup {
    display: none;
    position: fixed;
    bottom: 20px;
    right: 20px;
    width: 350px;
    height: 0;
    max-height: 500px;
    background-color: #fff;
    border: 1px solid #ccc;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
    overflow-y: scroll;
    transition: height 0.3s ease;
    z-index: 999;
}

.chat-popup-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px;
    background-color: #f5f5f5;
    border-bottom: 1px solid #ccc;
}

.chat-popup-header h3 {
    margin: 0;
}

.close-btn {
    background-color: transparent;
    border: none;
    color: #000;
    font-size: 24px;
    cursor: pointer;
}

.chat-popup-body form {
    display: flex;
    margin: 10px;
}

.chat-popup-body input[type="text"] {
    flex-grow: 1;
    padding: 10px;
    border: none;
    border-bottom-left-radius: 5px;
    border-top-left-radius: 5px;
}

.chat-popup-body button[type="submit"] {
    padding: 10px 15px;
    background-color: #4CAF50;
    color: #fff;
    border: none;
    border-bottom-right-radius: 5px;
    border-top-right-radius: 5px;
    cursor: pointer;
}

.message {
    background-color: #f5f5f5;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin: 10px;
    padding: 10px;
}

.open-btn {
    position: fixed;
    bottom: 20px;
    right: 20px;
    padding: 10px;
    background-color: #4CAF50;
    color: #fff;
    border: none;
    border-radius: 5px;
    font-size: 18px;
    cursor: pointer;
    box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.3);
    z-index: 999;
}
</style>
