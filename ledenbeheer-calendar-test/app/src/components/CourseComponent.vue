<template>
    
    <div class="course"  :data-cat="course.category">
        <h3 class="course__title">{{ course.title }}</h3>
        <div class="course__details">
            <p>{{ replaceColon(course.from) }} - {{ replaceColon(course.to) }}</p>
        </div>
        <button class="button all-caps" @click="toggleModal">meer info</button>
    </div>
</template> 

<script>

export default {
    props:['course'],
    methods: {
    replaceColon(string){
        return string.replace(':', 'u')
    },
    toggleModal() {
        this.$emit('close')
    },
  }

}
</script>

<style>
.course {
    border-left: 0.4rem solid black;
    padding-left: 0.5rem;
    display: flex;
    flex-direction: column;
    text-align: left;
    gap: 0.3rem;
}
.course:hover {
    background-color:rgba(0, 0, 0, 0.04);
    cursor: pointer;
    transition: all .3s ease;
}
.course[data-cat="1"] {
    border-left: 0.4rem solid #288990;
}
.course[data-cat="2"] {
    border-left: 0.4rem solid #495e35;
}
.course[data-cat="3"] {
    border-left: 0.4rem solid #f6d59f;
}
.course[data-cat="4"] {
    border-left: 0.4rem solid #ff9904;
}
.course[data-cat="5"] {
    border-left: 0.4rem solid #e9190c;
}


.course__title {
    max-width: 12rem;
}
.button {
    border: 2px solid #0cf;
    border-radius: 4px;
    padding: 0.1rem 0.5rem;
    color: #0cf;
    width: fit-content;
}
.button:hover {
    background-color: #0cf;
    color: white;
    cursor: pointer;
    transition: all .3s ease;
}

.call-to-action {
    display: flex;
    gap: 0.5rem;
    padding-top: 1rem;
    justify-content: flex-end;
}

</style>