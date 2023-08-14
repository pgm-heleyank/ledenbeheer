<template>
    <div class="backdrop"   @click.self="closeModal">
        <div class="modal">
            <button  class="close-btn" @click="closeModal">close</button>
        </div>
    </div>
</template>
<script>
export default {
    methods: {
    closeModal() {
        this.$emit('close')
    },
  }
}
</script>
<style>
    .modal {
        width: 25rem;
        padding: 1.5rem;
        margin: 6.25rem auto;
        background-color: white;
        border-radius: 10px;
        display: flex;
        flex-direction: column;
    }
    .backdrop {
        top: 0;
        position:fixed;
        background-color:rgba(0, 0, 0, 0.5);
        width: 100%;
        height: 100%;
    }
    .close-btn {
        color: #e43a36;
        width: fit-content;
        padding: 0.5rem;
        align-self: flex-end;
    }
    .close-btn:hover {
        cursor: pointer;
    }
</style>