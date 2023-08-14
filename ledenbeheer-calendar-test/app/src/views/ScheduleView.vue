<template>
    <div class="schedule">
        <div class="week-container" v-if="coursesPerDay.length">
                <div class="day-wrapper" v-for="data in coursesPerDay" :key="data.day">
                    <h2 class="all-caps" >{{ data.day }}</h2>
                    <div class="courses-wrapper" v-for="course in data.filteredData" :key="course.id">
                        <div >
                            <CourseComponent :course="course" @close="toggleModal"/>
                        </div>
                    </div>
                </div>
        </div>
        <div v-else> loading schedule...</div>
    </div>
    <div v-if="showModal">
        <ModalComponent @close="toggleModal"/>
    </div>
    
    
</template>

  <script>
    import CourseComponent from "../components/CourseComponent.vue"
    import ModalComponent from "../components/ModalComponent.vue"
  export default {
    components:{
    CourseComponent,
    ModalComponent
  },
    data(){
    return {
        days:["maandag","dinsdag","woensdag","donderdag","vrijdag","zaterdag","zondag"],
        coursesPerDay:[],
        showModal: false
    }
  },
  mounted(){
    fetch('http://localhost:8000/calendar/events')
    .then(res=> res.json())
    .then(data=> this.filterCourses(data))
    .catch(err=> console.log(err.message));
  },
  methods: {
    filterCourses(data){
        const perDay = this.days.map(day=>{
            const filteredData = data.filter((course)=> {
                let date = new Date(course.date);
                const options = { weekday: 'long' }
                let dayOfWeek = date.toLocaleDateString('nl-BE', options);
                return dayOfWeek === day
            }
            )
            const d = {day,filteredData}
            return d
        })
        this.coursesPerDay = this.coursesPerDay.concat(perDay)

        
    },
    toggleModal(){
        this.showModal=!this.showModal
    }
  }
  }
  </script>

<style>
.all-caps {
    text-transform: uppercase;
}
.week-container {
    display: flex;
    gap: 2rem;
    flex-wrap: wrap;
    margin: 1rem;
}
.day-wrapper {
    display: flex;
    flex-direction: column;
    gap: 2rem;
    max-width: 100%;
}

.courses-wrapper {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

</style>